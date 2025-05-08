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
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
    'image/gif' => 'gif'
]);
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('UPLOAD_DIR', 'testimonial');

uploadTestimonialImage();

function uploadTestimonialImage() {
    $response = [
        'status' => 'error',
        'message' => '',
        'filename' => '',
        'path' => ''
    ];

    try {
        // Validate CSRF token if implemented
        /*
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            throw new Exception('Invalid CSRF token');
        }
        */

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
            throw new Exception('File size exceeds 5MB limit');
        }

        // Verify MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!isset(ALLOWED_MIME_TYPES[$mimeType])) {
            throw new Exception('Invalid file type. Only JPG, PNG, WebP, and GIF allowed');
        }

        // Generate secure filename
        $timestamp = time();
        $extension = ALLOWED_MIME_TYPES[$mimeType];
        $filename = "testimonial_{$timestamp}.{$extension}";
        $filename = rename_image($filename, $timestamp); // Custom sanitization function

        // Set upload directory
        $uploadDir = $_SESSION['path'] . '/' . UPLOAD_DIR;

        // Create directory if needed
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception('Failed to create testimonial directory');
            }
        }

        // Verify directory is writable
        if (!is_writable($uploadDir)) {
            throw new Exception('Testimonial directory is not writable');
        }

        $destination = $uploadDir . '/' . $filename;

        // Move the uploaded file
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new Exception('Failed to move uploaded file');
        }

        // Prepare success response
        $response = [
            'status' => 'success',
            'message' => 'Testimonial image uploaded successfully',
            'filename' => $filename,
            'path' => UPLOAD_DIR . '/' . $filename,
            'mime_type' => $mimeType,
            'size' => $file['size']
        ];

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
        error_log('Testimonial image upload error: ' . $e->getMessage());
    }

    header("Content-type: application/json");
    echo json_encode($response);
}

/**
 * Custom function to sanitize image filenames
 */
function rename_image($filename, $timestamp) {
    // Remove special characters
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
    // Add timestamp and random string for uniqueness
    return "testimonial_" . $timestamp . "_" . substr(md5($filename), 0, 8) . "." . pathinfo($filename, PATHINFO_EXTENSION);
}