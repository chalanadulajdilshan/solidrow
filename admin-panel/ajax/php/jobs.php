jobs.php<?php

include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new job
if (isset($_POST['create'])) {

    $JOB = new Job(NULL); // New Job object

    $JOB->title = $_POST['title'];
    $JOB->description = $_POST['description'];
    $JOB->country = $_POST['country'];
    $JOB->respons_person = $_POST['respons_person'];

    // Handle image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $targetDir = __DIR__ . '/../../../upload/jobs/';
        
        // Create upload directory if it doesn't exist
        if (!file_exists($targetDir)) {
            if (!mkdir($targetDir, 0755, true)) {
                echo json_encode(["status" => 'error', "message" => "Failed to create upload directory"]);
                exit();
            }
        }
        
        // Sanitize the file name
        $fileName = uniqid() . "_" . preg_replace("/[^\w\d._-]/", "", basename($_FILES["image"]["name"]));
        $targetFilePath = $targetDir . $fileName;

        // Check for upload errors
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(["status" => 'error', "message" => "Upload error: " . $_FILES['image']['error']]);
            exit();
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $JOB->image = $fileName;
        } else {
            // Get the specific error message
            $error = error_get_last();
            $errorMsg = $error ? $error['message'] : 'Unknown error occurred';
            echo json_encode(["status" => 'error', "message" => "Image upload failed: " . $errorMsg]);
            exit();
        }
    }

    $res = $JOB->create();

    echo json_encode(["status" => $res ? 'success' : 'error']);
    exit();
}

// Update job
if (isset($_POST['update'])) {

    $JOB = new Job($_POST['job_id']); // Load job by ID

    $JOB->title = $_POST['title'];
    $JOB->description = $_POST['description'];
    $JOB->country = $_POST['country'];
    $JOB->respons_person = $_POST['respons_person'];

    // Update image only if new one is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $targetDir = "../../upload/jobs/";
        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $JOB->image = $fileName;
        }
    }

    $res = $JOB->update();

    echo json_encode(["status" => $res ? 'success' : 'error']);
    exit();
}

// Delete job
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $JOB = new Job($_POST['id']);
    $res = $JOB->delete();

    echo json_encode(["status" => $res ? 'success' : 'error']);
    exit();
}
