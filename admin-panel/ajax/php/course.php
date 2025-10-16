<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

// Handle file upload (same as projects but for courses)
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
    $file_name = uniqid('course_') . '.' . strtolower($file_extension);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return ['status' => true, 'file_name' => $file_name];
    }

    return ['status' => false, 'message' => 'Failed to upload file.'];
}

// Create course
if (isset($_POST['create'])) {
    $COURSE = new Course(NULL);
    $upload_dir = dirname(__DIR__, 3) . '/upload/course/';

    // Handle image upload
    if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handleFileUpload($_FILES['image_name'], $upload_dir);
        if (!$uploadResult['status']) {
            echo json_encode(['status' => 'error', 'message' => $uploadResult['message']]);
            exit();
        }
        $COURSE->image_name = $uploadResult['file_name'];
    }

    // Sanitize and assign fields
    $COURSE->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $COURSE->price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $COURSE->short_description = filter_input(INPUT_POST, 'short_description', FILTER_SANITIZE_STRING);
    $COURSE->description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $COURSE->staff_id = filter_input(INPUT_POST, 'staff_id', FILTER_SANITIZE_NUMBER_INT);
    $COURSE->queue = filter_input(INPUT_POST, 'queue', FILTER_SANITIZE_NUMBER_INT);
    $COURSE->duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_NUMBER_INT);
    $COURSE->is_certified = filter_input(INPUT_POST, 'is_certified', FILTER_SANITIZE_NUMBER_INT);

    if ($COURSE->create()) {
        echo json_encode(['status' => 'success', 'message' => 'Course created successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create course.']);
    }
    exit();
}

// Update course
if (isset($_POST['update'])) {
    if (!isset($_POST['course_id']) || empty($_POST['course_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Course ID is required.']);
        exit();
    }

    $COURSE = new Course($_POST['course_id']);
    $upload_dir = dirname(__DIR__, 3) . '/upload/course/';

    // Handle image upload
    if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handleFileUpload($_FILES['image_name'], $upload_dir);
        if (!$uploadResult['status']) {
            echo json_encode(['status' => 'error', 'message' => $uploadResult['message']]);
            exit();
        }
        // Remove old image if exists
        if (!empty($COURSE->image_name)) {
            $oldFile = $upload_dir . $COURSE->image_name;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        $COURSE->image_name = $uploadResult['file_name'];
    }

    // Sanitize and update fields
    $COURSE->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $COURSE->price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $COURSE->short_description = filter_input(INPUT_POST, 'short_description', FILTER_SANITIZE_STRING);
    $COURSE->description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $COURSE->staff_id = filter_input(INPUT_POST, 'staff_id', FILTER_SANITIZE_NUMBER_INT);
    $COURSE->queue = filter_input(INPUT_POST, 'queue', FILTER_SANITIZE_NUMBER_INT);
    $COURSE->duration = filter_input(INPUT_POST, 'duration', FILTER_SANITIZE_NUMBER_INT);
    $COURSE->is_certified = filter_input(INPUT_POST, 'is_certified', FILTER_SANITIZE_NUMBER_INT);

    if ($COURSE->update()) {
        echo json_encode(['status' => 'success', 'message' => 'Course updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update course.']);
    }
    exit();
}

// Delete course
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $COURSE = new Course($_POST['id']);
    if ($COURSE->id && $COURSE->delete()) {
        echo json_encode(['status' => 'success', 'message' => 'Course deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete course.']);
    }
    exit();
}
