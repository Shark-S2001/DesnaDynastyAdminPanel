<?php
// Strict referer validation
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) {
    http_response_code(403);
    die(json_encode(['status' => 'error', 'message' => 'Direct access not allowed']));
}

require_once("../config/database.php");
require_once("../config/functions.php");
require_once("../config/sessions.php");

// Validate CSRF token if you have it implemented
/*
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid CSRF token']));
}
*/

// Configuration
define('ALLOWED_MIME_TYPES', [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp'
]);
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Validate and clean input
$id_number = clean_input($_POST["id_number"] ?? '');
if (empty($id_number)) {
    die(json_encode(['status' => 'error', 'message' => 'Invalid model ID']));
}

uploadModelImage($conn, $id_number);

function checkIfModelExists($conn, $id_number) {
    $stmt = $conn->prepare("SELECT 1 FROM model WHERE id_number = :id_number LIMIT 1");
    $stmt->execute(['id_number' => $id_number]);
    return (bool)$stmt->fetchColumn();
}

function uploadModelImage($conn, $id_number) {
    $response = ['status' => 'error', 'message' => ''];

    try {
        // Validate file upload
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('File upload error: ' . ($_FILES['file']['error'] ?? 'No file uploaded'));
        }

        $file = $_FILES['file'];

        // Check file size
        if ($file['size'] > MAX_FILE_SIZE) {
            throw new Exception('File size exceeds 5MB limit');
        }

        // Verify MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!isset(ALLOWED_MIME_TYPES[$mimeType])) {
            throw new Exception('Invalid file type. Only JPG, PNG, and WebP allowed');
        }

        // Check if model exists
        if (checkIfModelExists($conn, $id_number)) {
            throw new Exception('Model already exists');
        }

        // Generate secure filename
        $extension = ALLOWED_MIME_TYPES[$mimeType];
        $filename = "model_{$id_number}_" . time() . ".{$extension}";
        $filename = rename_image($filename, $id_number); // Assuming this sanitizes the filename

        // Set upload directory
        $baseDir = realpath(__DIR__ . '/../..'); // Adjust based on your structure
        $uploadDir = $baseDir . '/public/images/models';

        // Create directory if needed
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception('Failed to create models directory');
            }
        }

        // Verify directory is writable
        if (!is_writable($uploadDir)) {
            throw new Exception('Upload directory is not writable');
        }

        $destination = $uploadDir . '/' . $filename;

        // Move the uploaded file
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new Exception('Failed to move uploaded file');
        }

        // Store in session
        $_SESSION["model_image_path"] = $filename;

        // Prepare success response
        $response = [
            'status' => 'success',
            'message' => 'Model image uploaded successfully',
            'filename' => $filename,
            'path' => '/images/models/' . $filename
        ];

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
        error_log('Model image upload error: ' . $e->getMessage());
    }

    header("Content-type: application/json");
    echo json_encode($response);
}