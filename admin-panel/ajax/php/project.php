<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

// Handle file upload
function handleFileUpload($file, $upload_dir) {
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    $max_size = 5 * 1024 * 1024; // 5MB

    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['status' => false, 'message' => 'File upload error.'];
    }

    if (!in_array($file['type'], $allowed_types)) {
        return ['status' => false, 'message' => 'Only JPG, JPEG, PNG, and GIF files are allowed.'];
    }

    if ($file['size'] > $max_size) {
        return ['status' => false, 'message' => 'File size must be less than 5MB.'];
    }

    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = uniqid('project_') . '.' . strtolower($file_extension);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return ['status' => true, 'file_name' => $file_name];
    }

    return ['status' => false, 'message' => 'Failed to upload file.'];
}

// Create project
if (isset($_POST['create'])) {
    $PROJECT = new Project(NULL);
    $upload_dir = dirname(__DIR__, 3) . '/upload/project/';

    if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handleFileUpload($_FILES['image_name'], $upload_dir);
        if (!$uploadResult['status']) {
            echo json_encode(['status' => 'error', 'message' => $uploadResult['message']]);
            exit();
        }
        $PROJECT->image_name = $uploadResult['file_name'];
    }

    $PROJECT->title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $PROJECT->short_description = filter_input(INPUT_POST, 'short_description', FILTER_SANITIZE_STRING);
    $PROJECT->project_date = filter_input(INPUT_POST, 'project_date', FILTER_SANITIZE_STRING);

    if ($PROJECT->create()) {
        echo json_encode(['status' => 'success', 'message' => 'Project created successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create project.']);
    }
    exit();
}

// Update project
if (isset($_POST['update'])) {
    if (!isset($_POST['project_id']) || empty($_POST['project_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Project ID is required.']);
        exit();
    }

    $PROJECT = new Project($_POST['project_id']);
    $upload_dir = dirname(__DIR__, 3) . '/upload/project/';

    if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handleFileUpload($_FILES['image_name'], $upload_dir);
        if (!$uploadResult['status']) {
            echo json_encode(['status' => 'error', 'message' => $uploadResult['message']]);
            exit();
        }
        if (!empty($PROJECT->image_name)) {
            $oldFile = $upload_dir . $PROJECT->image_name;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        $PROJECT->image_name = $uploadResult['file_name'];
    }

    $PROJECT->title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $PROJECT->short_description = filter_input(INPUT_POST, 'short_description', FILTER_SANITIZE_STRING);
    $PROJECT->project_date = filter_input(INPUT_POST, 'project_date', FILTER_SANITIZE_STRING);

    if ($PROJECT->update()) {
        echo json_encode(['status' => 'success', 'message' => 'Project updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update project.']);
    }
    exit();
}

// Delete project
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $PROJECT = new Project($_POST['id']);
    if ($PROJECT->id && $PROJECT->delete()) {
        echo json_encode(['status' => 'success', 'message' => 'Project deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete project.']);
    }
    exit();
}
