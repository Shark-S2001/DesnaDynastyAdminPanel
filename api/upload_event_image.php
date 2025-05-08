<?php
// Strict referer check with HTTPS support
$referer = $_SERVER['HTTP_REFERER'] ?? '';
$serverHost = $_SERVER['HTTP_HOST'];
if (!preg_match('#^https?://'.preg_quote($serverHost).'/#i', $referer)) {
    http_response_code(403);
    die(json_encode(['status' => 'error', 'message' => 'Direct access not allowed']));
}

require_once("../config/database.php");
require_once("../config/functions.php");
require_once("../config/sessions.php");

// Allowed image types and max size (5MB)
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('MAX_FILE_SIZE', 5242880); // 5MB in bytes

function uploadEventImage() {
    $response = [
        'status' => 'error',
        'message' => 'Initialization error'
    ];

    try {
        // Validate file upload
        if (!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
            throw new Exception('No file uploaded or upload error');
        }

        $file = $_FILES['file'];

        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Upload error: ' . $file['error']);
        }

        // Validate file size
        if ($file['size'] > MAX_FILE_SIZE) {
            throw new Exception('File size exceeds 5MB limit');
        }

        // Verify MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mime, ALLOWED_TYPES)) {
            throw new Exception('Invalid file type. Only JPEG, PNG, GIF, and WebP allowed');
        }

        // Generate secure filename
        $id_number = time();
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = "event_{$id_number}." . strtolower($extension);
        $filename = rename_image($filename, $id_number); // Assuming this sanitizes the name

        // Set upload directory - adjusted for your structure
        $baseDir = realpath(__DIR__ . '/../..'); // Goes up to project root
        $uploadDir = $baseDir . '/public/images/events';

        // Create directory if needed
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception('Failed to create events directory');
            }
        }

        // Verify directory is writable
        if (!is_writable($uploadDir)) {
            throw new Exception('Upload directory is not writable');
        }

        $destination = $uploadDir . '/' . $filename;

        // Move the file
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $_SESSION["event_image_path"] = $filename;
            $response = [
                'status' => 'success',
                'message' => 'Event image uploaded successfully',
                'filename' => $filename,
                'path' => '/images/events/' . $filename
            ];
        } else {
            throw new Exception('Failed to move uploaded file');
        }
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
        error_log('Event image upload error: ' . $e->getMessage());
    }

    header("Content-type: application/json");
    echo json_encode($response);
}

uploadEventImage();