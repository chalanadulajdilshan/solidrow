<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new company
if (isset($_POST['create'])) {

    $COMPANY = new Company(NULL); // New company object

    $COMPANY->name = $_POST['name'];
    $COMPANY->short_desc = $_POST['short_desc'];
    $COMPANY->image_name = $_POST['image_name'];
    $COMPANY->image_url = $_POST['image_url'];

    $res = $COMPANY->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Update company
if (isset($_POST['update'])) {

    $COMPANY = new Company($_POST['company_id']); // Load company by ID

    $COMPANY->name = $_POST['name'];
    $COMPANY->short_desc = $_POST['short_desc'];
    $COMPANY->image_name = $_POST['image_name'];
    $COMPANY->image_url = $_POST['image_url'];

    $res = $COMPANY->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Delete company
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $COMPANY = new Company($_POST['id']);
    $res = $COMPANY->delete();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
