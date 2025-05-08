<?php
// Strict referer validation with HTTPS support
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) === false) {
    http_response_code(403);
    die(json_encode(['status' => 'error', 'message' => 'Direct access not allowed']));
}

require_once("../config/database.php");
require_once("../config/functions.php");
require_once("../config/sessions.php");

// Configuration
define('ALLOWED_MIME_TYPES', [
    'video/mp4' => 'mp4',
    'video/webm' => 'webm',
    'video/ogg' => 'ogg',
    'video/quicktime' => 'mov'
]);
define('MAX_FILE_SIZE', 50 * 1024 * 1024); // 50MB
define('UPLOAD_DIR', 'promo_videos');

uploadPromoVideo();

function uploadPromoVideo() {
    $response = ['status' => 'error', 'message' => ''];

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

        // Check file size
        if ($file['size'] > MAX_FILE_SIZE) {
            throw new Exception('File size exceeds 50MB limit');
        }

        // Verify MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!isset(ALLOWED_MIME_TYPES[$mimeType])) {
            throw new Exception('Invalid file type. Only MP4, WebM, Ogg, and MOV videos allowed');
        }

        // Generate secure filename
        $timestamp = time();
        $extension = ALLOWED_MIME_TYPES[$mimeType];
        $filename = "promo_{$timestamp}.{$extension}";
        $filename = rename_video($filename, $timestamp); // Custom function to sanitize filename

        // Set upload directory
        $uploadDir = $_SESSION['path'] . '/' . UPLOAD_DIR;

        // Create directory if needed
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception('Failed to create promo videos directory');
            }
        }

        // Verify directory is writable
        if (!is_writable($uploadDir)) {
            throw new Exception('Promo videos directory is not writable');
        }

        $destination = $uploadDir . '/' . $filename;

        // Move the uploaded file
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new Exception('Failed to move uploaded video file');
        }

        // Prepare success response
        $response = [
            'status' => 'success',
            'message' => 'Promo video uploaded successfully',
            'filename' => $filename,
            'path' => UPLOAD_DIR . '/' . $filename,
            'mime_type' => $mimeType,
            'size' => $file['size']
        ];

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
        error_log('Promo video upload error: ' . $e->getMessage());
    }

    header("Content-type: application/json");
    echo json_encode($response);
}

// Custom function to sanitize video filenames
function rename_video($filename, $timestamp) {
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
    return "promo_" . $timestamp . "_" . substr(md5($filename), 0, 8) . "." . pathinfo($filename, PATHINFO_EXTENSION);
}