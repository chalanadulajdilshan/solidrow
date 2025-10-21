<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new job
if (isset($_POST['create'])) {
     
    $JOB = new Job(NULL);

    // Validate required fields
    $required = ['title', 'position', 'description', 'country', 'respons_person'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => 'error', "message" => ucfirst($field) . " is required"]);
            exit();
        }
    }

    // Assign values
    $JOB->title = $_POST['title'];
    $JOB->position = $_POST['position'];
    $JOB->description = $_POST['description'];
    $JOB->country = $_POST['country'];
    $JOB->respons_person = $_POST['respons_person'];

    // Handle image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $upload_dir = dirname(__DIR__, 3) . '/upload/job/';
        if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $fileName = uniqid() . "_" . preg_replace("/[^A-Za-z0-9_\-\.]/", "_", basename($_FILES["image"]["name"]));
        $targetFilePath = $upload_dir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $JOB->image = $fileName;
        } else {
            $error = error_get_last();
            echo json_encode([
                "status" => 'error',
                "message" => "Image upload failed: " . ($error['message'] ?? 'Unknown error')
            ]);
            exit();
        }
    }

  $res = $JOB->create();

echo json_encode([
    "status" => $res ? 'success' : 'error',
    "message" => $res ? 'Job created successfully!' : 'Failed to create job.'
]);
exit();

}


// Update job
if (isset($_POST['update'])) {

    $JOB = new Job($_POST['job_id']); // Load job by ID

    $JOB->title = $_POST['title'];
    $JOB->position = $_POST['position'];
    $JOB->description = $_POST['description'];
    $JOB->country = $_POST['country'];
    $JOB->respons_person = $_POST['respons_person'];

    // Update image only if new one is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $upload_dir = dirname(__DIR__, 3) . '/upload/job/';
        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
        $targetFilePath = $upload_dir . $fileName;

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
