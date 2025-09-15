<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

// Handle file upload
function handleFileUpload($file, $upload_dir) {
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['status' => false, 'message' => 'File upload error.'];
    }

    if (!in_array($file['type'], $allowed_types)) {
        return ['status' => false, 'message' => 'Only JPG, JPEG, PNG, and GIF files are allowed.'];
    }

    if ($file['size'] > $max_size) {
        return ['status' => false, 'message' => 'File size must be less than 2MB.'];
    }

    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = uniqid('company_') . '.' . strtolower($file_extension);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return [
            'status' => true,
            'file_name' => $file_name,
            'file_path' => $file_path
        ];
    }

    return ['status' => false, 'message' => 'Failed to upload file.'];
}

// Create a new company
if (isset($_POST['create'])) {
    $response = [];
    $COMPANY = new Company(NULL);
    $upload_dir = dirname(__DIR__, 3) . '/upload/company/';

    // Handle file upload if exists
    if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handleFileUpload($_FILES['image_name'], $upload_dir);
        if (!$uploadResult['status']) {
            echo json_encode([
                'status' => 'error',
                'message' => $uploadResult['message']
            ]);
            exit();
        }
        $COMPANY->image_name = $uploadResult['file_name'];
    }

    $COMPANY->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $COMPANY->short_desc = filter_input(INPUT_POST, 'short_desc', FILTER_SANITIZE_STRING);
    $COMPANY->image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);

    if ($COMPANY->create()) {
        $response = [
            'status' => 'success',
            'message' => 'Company created successfully.',
            'data' => [
                'id' => $COMPANY->id,
                'name' => $COMPANY->name
            ]
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to create company.'
        ];
    }
    
    echo json_encode($response);
    exit();
}

// Update company
if (isset($_POST['update'])) {
    $response = [];
    
    if (!isset($_POST['company_id']) || empty($_POST['company_id'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Company ID is required for update.'
        ]);
        exit();
    }

    $COMPANY = new Company($_POST['company_id']);
    $upload_dir = dirname(__DIR__, 3) . '/upload/company/';

    if (!$COMPANY->id) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Company not found.'
        ]);
        exit();
    }

    // Handle file upload if exists
    if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handleFileUpload($_FILES['image_name'], $upload_dir);
        if (!$uploadResult['status']) {
            echo json_encode([
                'status' => 'error',
                'message' => $uploadResult['message']
            ]);
            exit();
        }
        // Delete old file if exists
        if (!empty($COMPANY->image_name)) {
            $oldFile = $upload_dir . $COMPANY->image_name;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        $COMPANY->image_name = $uploadResult['file_name'];
    }

    $COMPANY->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $COMPANY->short_desc = filter_input(INPUT_POST, 'short_desc', FILTER_SANITIZE_STRING);
    $COMPANY->image_url = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);

    if ($COMPANY->update()) {
        $response = [
            'status' => 'success',
            'message' => 'Company updated successfully.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to update company.'
        ];
    }
    
    echo json_encode($response);
    exit();
}

// Delete company
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $COMPANY = new Company($_POST['id']);
    
    if ($COMPANY->id && $COMPANY->delete()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Company deleted successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to delete company.'
        ]);
    }
    exit();
}