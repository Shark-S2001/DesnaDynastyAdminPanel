<?php
// Enhanced security check
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST')) === false) {
    http_response_code(403);
    die('<h3>No Direct script access allowed!</h3>');
}

require_once("../config/database.php");
require_once("../config/functions.php");
require_once("../config/sessions.php");  

// Define allowed image types
const ALLOWED_MIME_TYPES = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/gif' => 'gif',
    'image/webp' => 'webp'
];

const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB

function uploadBlogImage() {
    $response = [
        'status' => 'error',
        'message' => 'Unknown error occurred'
    ];

    try {
        // Check if file was uploaded
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('No file uploaded or upload error');
        }

        // Validate file size
        if ($_FILES['file']['size'] > MAX_FILE_SIZE) {
            throw new Exception('File size exceeds maximum limit of 5MB');
        }

        // Get file info
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $_FILES['file']['tmp_name']);
        finfo_close($fileInfo);

        // Validate file type
        if (!array_key_exists($mimeType, ALLOWED_MIME_TYPES)) {
            throw new Exception('Invalid file type. Only JPG, PNG, GIF, and WebP are allowed');
        }

        // Generate unique filename
        $id_number = time();
        $extension = ALLOWED_MIME_TYPES[$mimeType];
        $filename = "blog_{$id_number}.{$extension}";

        // Define upload directory - relative to your file structure
        $uploadDir = __DIR__ . '/../../public/images';
        
        // Ensure directory exists (create if not)
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception('Failed to create upload directory');
            }
        }

        // Verify directory is writable
        if (!is_writable($uploadDir)) {
            throw new Exception('Upload directory is not writable');
        }

        $destination = $uploadDir . '/' . $filename;

        // Move uploaded file
        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
            $_SESSION["blog_image_path"] = $filename;
            $response = [
                'status' => 'success',
                'message' => 'Blog Image Uploaded Successfully',
                'filename' => $filename,
                'path' => '/images/' . $filename  // Relative path for frontend use
            ];
        } else {
            throw new Exception('Failed to move uploaded file');
        }
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    header("Content-type: application/json; charset=UTF-8");
    echo json_encode($response);
}

uploadBlogImage();