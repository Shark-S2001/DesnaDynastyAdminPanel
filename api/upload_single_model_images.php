<?php
// Strict referer validation with HTTPS support
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) {
    http_response_code(403);
    die(json_encode(['status' => 'error', 'message' => 'Direct access not allowed']));
}

require_once("../config/sessions.php");
require_once("../config/functions.php");

// Configuration
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB per file
define('MAX_TOTAL_SIZE', 50 * 1024 * 1024); // 50MB total
define('MAX_FILES', 20); // Maximum number of files allowed
define('UPLOAD_DIR', 'single_model_photos');

// Initialize response
$response = [
    'status' => 'error',
    'message' => '',
    'uploaded_files' => [],
    'errors' => []
];

try {
    // Validate CSRF token if implemented
    /*
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        throw new Exception('Invalid CSRF token');
    }
    */

    // Validate ID number
    $id_number = clean_input($_POST['id_number'] ?? '');
    if (empty($id_number)) {
        throw new Exception('Invalid ID number');
    }

    // Store ID number in session
    $_SESSION['id_number'] = $id_number;

    // Check if files were uploaded
    if (!isset($_FILES['files']) || empty($_FILES['files']['name'][0])) {
        throw new Exception('No files uploaded');
    }

    // Count total files
    $fileCount = count($_FILES['files']['name']);
    $_SESSION['no_of_images'] = $fileCount;

    // Validate file count
    if ($fileCount > MAX_FILES) {
        throw new Exception('Maximum ' . MAX_FILES . ' files allowed');
    }

    // Create upload directory
    $uploadDir = $_SESSION['path'] . '/' . UPLOAD_DIR . '/' . $id_number;
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            throw new Exception('Failed to create upload directory');
        }
    }

    // Check directory writable
    if (!is_writable($uploadDir)) {
        throw new Exception('Upload directory is not writable');
    }

    // Initialize counters
    $totalSize = 0;
    $successCount = 0;

    // Process each file
    for ($i = 0; $i < $fileCount; $i++) {
        if ($_FILES['files']['error'][$i] !== UPLOAD_ERR_OK) {
            $response['errors'][] = 'File ' . ($i+1) . ': ' . getUploadError($_FILES['files']['error'][$i]);
            continue;
        }

        // Validate file size
        $fileSize = $_FILES['files']['size'][$i];
        $totalSize += $fileSize;

        if ($fileSize > MAX_FILE_SIZE) {
            $response['errors'][] = 'File ' . ($i+1) . ': Exceeds maximum file size of 5MB';
            continue;
        }

        if ($totalSize > MAX_TOTAL_SIZE) {
            $response['errors'][] = 'Total upload size exceeds 50MB limit';
            break;
        }

        // Validate file type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES['files']['tmp_name'][$i]);
        finfo_close($finfo);

        $extension = strtolower(pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION));
        if (!in_array($extension, ALLOWED_EXTENSIONS)) {
            $response['errors'][] = 'File ' . ($i+1) . ': Invalid file type. Only JPG, PNG, and WebP allowed';
            continue;
        }

        // Generate secure filename
        $filename = "model_{$id_number}_" . time() . "_{$i}." . $extension;
        $filename = rename_image($filename, $id_number);

        // Store in session
        $_SESSION['photos'][] = $filename;

        // Move uploaded file
        $destination = $uploadDir . '/' . $filename;
        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $destination)) {
            $successCount++;
            $response['uploaded_files'][] = [
                'name' => $filename,
                'path' => UPLOAD_DIR . '/' . $id_number . '/' . $filename,
                'size' => $fileSize,
                'type' => $mimeType
            ];
        } else {
            $response['errors'][] = 'File ' . ($i+1) . ': Failed to upload';
        }
    }

    // Set final response
    if ($successCount > 0) {
        $response['status'] = $successCount === $fileCount ? 'success' : 'partial';
        $response['message'] = "Uploaded {$successCount} of {$fileCount} files";
    } else {
        $response['message'] = 'No files were uploaded';
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
    error_log('Multiple upload error: ' . $e->getMessage());
}

// Return JSON response
header("Content-type: application/json");
echo json_encode($response);

// Helper function to get upload error messages
function getUploadError($errorCode) {
    $errors = [
        UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize directive',
        UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE directive',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
    ];
    return $errors[$errorCode] ?? 'Unknown upload error';
}