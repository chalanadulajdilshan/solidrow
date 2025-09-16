<?php

include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new country
if (isset($_POST['create'])) {

    $COUNTRY = new Country(NULL); // New country object

    $COUNTRY->name = $_POST['name'];
    $COUNTRY->is_active = isset($_POST['activeStatus']) ? 1 : 0;
    $COUNTRY->commission_rate = isset($_POST['commission_rate']) ? floatval($_POST['commission_rate']) : 0.00;

    $res = $COUNTRY->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Update country
if (isset($_POST['update'])) {

    $COUNTRY = new Country($_POST['country_id']); // Load country by ID

    $COUNTRY->name = $_POST['name'];
    $COUNTRY->is_active = isset($_POST['activeStatus']) ? 1 : 0;
    $COUNTRY->commission_rate = isset($_POST['commission_rate']) ? floatval($_POST['commission_rate']) : 0.00;

    $res = $COUNTRY->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Delete country
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $COUNTRY = new Country($_POST['id']);
    $res = $COUNTRY->delete();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
