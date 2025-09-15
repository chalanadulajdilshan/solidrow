jobs.php<?php

include '../../class/include.php';
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
        $targetDir = "../../upload/jobs/";
        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $JOB->image = $fileName;
        } else {
            echo json_encode(["status" => 'error', "message" => "Image upload failed"]);
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
