<?php
// Enable error reporting for debugging
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Set JSON header
header('Content-Type: application/json; charset=UTF-8');

// Function to send JSON response and exit
function sendResponse($status, $message, $data = []) {
    http_response_code($status === 'error' ? 400 : 200);
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

try {
    // Check if the class file exists
    $includeFile = __DIR__ . '/../../class/include.php';
    if (!file_exists($includeFile)) {
        throw new Exception('Required files are missing');
    }

    // Include the main application file
    include $includeFile;

    // Handle the request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['create'])) {
        throw new Exception('Invalid request');
    }

    // Validate required fields
    $required = ['name', 'mobile', 'address', 'position', 'experience'];
    $missing = [];
    foreach ($required as $field) {
        if (empty(trim($_POST[$field] ?? ''))) {
            $missing[] = $field;
        }
    }
    
    if (!empty($missing)) {
        throw new Exception('Please fill in all required fields: ' . implode(', ', $missing));
    }

    // Validate CV file
    if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('CV is required');
    }

    // Set up upload directory
    $upload_dir = dirname(__DIR__, 2) . '/upload/careers/';
    
    // Create the directory if it doesn't exist
    if (!file_exists($upload_dir) && !mkdir($upload_dir, 0777, true)) {
        throw new Exception('Failed to create upload directory');
    }
    
    // Validate file type
    $fileInfo = new finfo(FILEINFO_MIME_TYPE);
    $fileType = $fileInfo->file($_FILES['cv']['tmp_name']);
    $allowedMimeTypes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];
    
    if (!in_array($fileType, $allowedMimeTypes)) {
        throw new Exception('Only PDF, DOC & DOCX files are allowed');
    }
    
    // Generate a safe file name
    $fileName = uniqid() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $_FILES['cv']['name']);
    $targetFilePath = $upload_dir . $fileName;
    
    // Move the uploaded file
    if (!move_uploaded_file($_FILES['cv']['tmp_name'], $targetFilePath)) {
        throw new Exception('Failed to upload CV. Please try again.');
    }

    // Create and save the career application
    $career = new Career(NULL);
    // Sanitize input data
    $career->name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $career->mobile = htmlspecialchars(trim($_POST['mobile']), ENT_QUOTES, 'UTF-8');
    $career->address = htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8');
    $career->position = htmlspecialchars(trim($_POST['position']), ENT_QUOTES, 'UTF-8');
    $career->experience = htmlspecialchars(trim($_POST['experience']), ENT_QUOTES, 'UTF-8');
    $career->cv = $fileName;
    
    if ($career->create()) {
        sendResponse('success', 'Your application has been submitted successfully!');
    } else {
        // Clean up the uploaded file if save failed
        @unlink($targetFilePath);
        throw new Exception('Failed to save your application. Please try again.');
    }
    
} catch (Exception $e) {
    sendResponse('error', $e->getMessage());
}
