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
    $file_name = uniqid('staff_') . '.' . strtolower($file_extension);
    $file_path = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return ['status' => true, 'file_name' => $file_name];
    }

    return ['status' => false, 'message' => 'Failed to upload file.'];
}

// Create staff
if (isset($_POST['create'])) {
    $STAFF = new Staff(NULL);
    $upload_dir = dirname(__DIR__, 3) . '/upload/staff/id-copy/';

    if (isset($_FILES['id_copy']) && $_FILES['id_copy']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handleFileUpload($_FILES['id_copy'], $upload_dir);
        if (!$uploadResult['status']) {
            echo json_encode(['status' => 'error', 'message' => $uploadResult['message']]);
            exit();
        }
        $STAFF->id_copy = $uploadResult['file_name'];
    }

    $STAFF->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $STAFF->position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    $STAFF->contact_no = filter_input(INPUT_POST, 'contact_no', FILTER_SANITIZE_STRING);
    $STAFF->whatsapp_no = filter_input(INPUT_POST, 'whatsapp_no', FILTER_SANITIZE_STRING);
    $STAFF->nic = filter_input(INPUT_POST, 'nic', FILTER_SANITIZE_STRING);
    $STAFF->education_qualification = filter_input(INPUT_POST, 'education_qualification', FILTER_SANITIZE_STRING);
    $STAFF->position_qualification = filter_input(INPUT_POST, 'position_qualification', FILTER_SANITIZE_STRING);
    $STAFF->service_experience = filter_input(INPUT_POST, 'service_experience', FILTER_SANITIZE_STRING);
    $STAFF->epf_no = filter_input(INPUT_POST, 'epf_no', FILTER_SANITIZE_STRING);
    $STAFF->salary = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $STAFF->district = filter_input(INPUT_POST, 'district', FILTER_SANITIZE_NUMBER_INT);
    $STAFF->province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_NUMBER_INT);
    $STAFF->company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_NUMBER_INT);
    $STAFF->join_date = filter_input(INPUT_POST, 'join_date', FILTER_SANITIZE_STRING);
    $STAFF->group_id = filter_input(INPUT_POST, 'group_id', FILTER_SANITIZE_NUMBER_INT);

    if ($STAFF->create()) {
        echo json_encode(['status' => 'success', 'message' => 'Staff member created successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create staff member.']);
    }
    exit();
}

// Update staff
if (isset($_POST['update'])) {
    if (!isset($_POST['staff_id']) || empty($_POST['staff_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Staff ID is required.']);
        exit();
    }

    $STAFF = new Staff($_POST['staff_id']);
    $upload_dir = dirname(__DIR__, 3) . '/upload/staff/id-copy/';

    if (!$STAFF->id) {
        echo json_encode(['status' => 'error', 'message' => 'Staff member not found.']);
        exit();
    }

    if (isset($_FILES['id_copy']) && $_FILES['id_copy']['error'] === UPLOAD_ERR_OK) {
        $uploadResult = handleFileUpload($_FILES['id_copy'], $upload_dir);
        if (!$uploadResult['status']) {
            echo json_encode(['status' => 'error', 'message' => $uploadResult['message']]);
            exit();
        }
        if (!empty($STAFF->id_copy)) {
            $oldFile = $upload_dir . $STAFF->id_copy;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        $STAFF->id_copy = $uploadResult['file_name'];
    }

    $STAFF->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $STAFF->position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);
    $STAFF->contact_no = filter_input(INPUT_POST, 'contact_no', FILTER_SANITIZE_STRING);
    $STAFF->whatsapp_no = filter_input(INPUT_POST, 'whatsapp_no', FILTER_SANITIZE_STRING);
    $STAFF->nic = filter_input(INPUT_POST, 'nic', FILTER_SANITIZE_STRING);
    $STAFF->education_qualification = filter_input(INPUT_POST, 'education_qualification', FILTER_SANITIZE_STRING);
    $STAFF->position_qualification = filter_input(INPUT_POST, 'position_qualification', FILTER_SANITIZE_STRING);
    $STAFF->service_experience = filter_input(INPUT_POST, 'service_experience', FILTER_SANITIZE_STRING);
    $STAFF->epf_no = filter_input(INPUT_POST, 'epf_no', FILTER_SANITIZE_STRING);
    $STAFF->salary = filter_input(INPUT_POST, 'salary', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $STAFF->district = filter_input(INPUT_POST, 'district', FILTER_SANITIZE_NUMBER_INT);
    $STAFF->province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_NUMBER_INT);
    $STAFF->company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_NUMBER_INT);
    $STAFF->join_date = filter_input(INPUT_POST, 'join_date', FILTER_SANITIZE_STRING);
    $STAFF->group_id = filter_input(INPUT_POST, 'group_id', FILTER_SANITIZE_NUMBER_INT);

    if ($STAFF->update()) {
        echo json_encode(['status' => 'success', 'message' => 'Staff member updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update staff member.']);
    }
    exit();
}

// Delete staff
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $STAFF = new Staff($_POST['id']);
    if ($STAFF->id && $STAFF->delete()) {
        echo json_encode(['status' => 'success', 'message' => 'Staff member deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete staff member.']);
    }
    exit();
}
