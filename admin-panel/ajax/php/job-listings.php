<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Helper function to handle file upload
function handleFileUpload($file, $oldImage = null)
{
    $upload_dir = dirname(__DIR__, 3) . '/upload/joblisting/';

    // Create directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Delete old image if it exists
    if ($oldImage && file_exists($upload_dir . $oldImage)) {
        unlink($upload_dir . $oldImage);
    }

    // Handle new file upload
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $fileName = uniqid() . '_' . basename($file["name"]);
        $targetFilePath = $upload_dir . $fileName;

        // Check if file type is allowed
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                return $fileName;
            }
        }
    }

    return $oldImage; // Return old image if no new file was uploaded or upload failed
}

// Create Job Listing
if (isset($_POST['create'])) {
    $JOB = new JobListing();

    $JOB->name = $_POST['name'];
    $JOB->position = $_POST['position'];
    $JOB->description = $_POST['description'];
    $JOB->is_active = isset($_POST['is_active']) ? 1 : 0;
    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $JOB->image = handleFileUpload($_FILES['image']);
    }

    $result = $JOB->create();

    echo json_encode([
        'status' => $result ? 'success' : 'error',
        'message' => $result ? 'Job listing created successfully!' : 'Failed to create job listing.'
    ]);
    exit();
}

// Update Job Listing
if (isset($_POST['update'])) {
    $JOB = new JobListing($_POST['job_id']);

    if (!$JOB->id) {
        echo json_encode(['status' => 'error', 'message' => 'Job listing not found.']);
        exit();
    }

    $JOB->name = $_POST['name'];
    $JOB->position = $_POST['position'];
    $JOB->description = $_POST['description'];
    $JOB->is_active = isset($_POST['is_active']) ? 1 : 0;

    // Handle file upload if a new file is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $JOB->image = handleFileUpload($_FILES['image'], $JOB->image);
    }

    $result = $JOB->update();

    echo json_encode([
        'status' => $result ? 'success' : 'error',
        'message' => $result ? 'Job listing updated successfully!' : 'Failed to update job listing.'
    ]);
    exit();
}

// Delete Job Listing
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $JOB = new JobListing($_POST['id']);

    if ($JOB->id) {
        // Delete the associated image if it exists
        if ($JOB->image) {
            $upload_dir = dirname(__DIR__, 3) . '/upload/joblisting/';
            if (file_exists($upload_dir . $JOB->image)) {
                unlink($upload_dir . $JOB->image);
            }
        }

        $result = $JOB->delete();

        echo json_encode([
            'status' => $result ? 'success' : 'error',
            'message' => $result ? 'Job listing deleted successfully!' : 'Failed to delete job listing.'
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Job listing not found.']);
    }
    exit();
}

// Toggle Job Listing Status
if (isset($_POST['toggle_status']) && isset($_POST['id'])) {
    $JOB = new JobListing($_POST['id']);

    if ($JOB->id) {
        $JOB->is_active = $_POST['status'];
        $result = $JOB->update();

        echo json_encode([
            'status' => $result ? 'success' : 'error',
            'message' => $result ? 'Status updated successfully!' : 'Failed to update status.'
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Job listing not found.']);
    }
    exit();
}

// Get Job Listing Details
if (isset($_GET['get_job']) && isset($_GET['id'])) {
    $JOB = new JobListing($_GET['id']);

    if ($JOB->id) {
        echo json_encode([
            'status' => 'success',
            'data' => [
                'id' => $JOB->id,
                'name' => $JOB->name,
                'position' => $JOB->position,
                'description' => $JOB->description,
                'image' => $JOB->image,
                'is_active' => $JOB->is_active
            ]
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Job listing not found.']);
    }
    exit();
}
