<?php

include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new remark
if (isset($_POST['create'])) {

    $REMARK = new Remark(NULL); // New remark object

    $REMARK->remark = $_POST['remark'];
    $REMARK->status = $_POST['status'];

    $res = $REMARK->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Update remark
if (isset($_POST['update'])) {

    $REMARK = new Remark($_POST['remark_id']); // Load remark by ID

    $REMARK->remark = $_POST['remark'];
    $REMARK->status = $_POST['status'];

    $res = $REMARK->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Delete remark
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $REMARK = new Remark($_POST['id']);
    $res = $REMARK->delete();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
