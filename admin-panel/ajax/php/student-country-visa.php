<?php

include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new Student Visa Country
if (isset($_POST['create'])) {

    $SVC = new StudentCountryVisa(); // New object

    $SVC->country_id = $_POST['country_id'];
    $SVC->visa_category = $_POST['visa_category'];

    $res = $SVC->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Update Student Visa Country
if (isset($_POST['update'])) {

    $SVC = new StudentCountryVisa($_POST['id']); // Load by ID

    $SVC->country_id = $_POST['country_id'];
    $SVC->visa_category = $_POST['visa_category'];

    $res = $SVC->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Delete Student Visa Country
if (isset($_POST['delete']) && isset($_POST['id'])) {

    $SVC = new StudentCountryVisa($_POST['id']);
    $res = $SVC->delete();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
