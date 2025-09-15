<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new job role
if (isset($_POST['create'])) {

    $JOB = new JobRole(NULL); // New JobRole object

    $JOB->name = $_POST['name'];
    $JOB->is_active = isset($_POST['activeStatus']) ? 1 : 0;

    $res = $JOB->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Update job role
if (isset($_POST['update'])) {

    $JOB = new JobRole($_POST['jobrole_id']); // Load job role by ID

    $JOB->name = $_POST['name'];
    $JOB->is_active = isset($_POST['activeStatus']) ? 1 : 0;

    $res = $JOB->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Delete job role
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $JOB = new JobRole($_POST['id']);
    $res = $JOB->delete();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
