<?php

include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new location
if (isset($_POST['create'])) {

    $LOCATION = new Location(NULL);

    $LOCATION->name = $_POST['name'];

    $res = $LOCATION->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Update location
if (isset($_POST['update'])) {

    $LOCATION = new Location($_POST['location_id']);

    $LOCATION->name = $_POST['name'];

    $res = $LOCATION->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Delete location
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $LOCATION = new Location($_POST['id']);
    $res = $LOCATION->delete();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
