<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new staff member
if (isset($_POST['create'])) {

    $STAFF = new Staff(NULL); // New staff object

    $STAFF->name = $_POST['name'];
    $STAFF->position = $_POST['position'];
    $STAFF->contact_no = $_POST['contact_no'];
    $STAFF->whatsapp_no = $_POST['whatsapp_no'];
    $STAFF->nic = $_POST['nic'];
    $STAFF->education_qualification = $_POST['education_qualification'];
    $STAFF->position_qualification = $_POST['position_qualification'];
    $STAFF->service_experience = $_POST['service_experience'];
    $STAFF->id_copy = $_POST['id_copy'];
    $STAFF->epf_no = $_POST['epf_no'];
    $STAFF->salary = $_POST['salary'];
    $STAFF->district = $_POST['district'];
    $STAFF->province = $_POST['province'];
    $STAFF->company = $_POST['company'];

    $res = $STAFF->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Update staff member
if (isset($_POST['update'])) {

    $STAFF = new Staff($_POST['staff_id']); // Load staff by ID

    $STAFF->name = $_POST['name'];
    $STAFF->position = $_POST['position'];
    $STAFF->contact_no = $_POST['contact_no'];
    $STAFF->whatsapp_no = $_POST['whatsapp_no'];
    $STAFF->nic = $_POST['nic'];
    $STAFF->education_qualification = $_POST['education_qualification'];
    $STAFF->position_qualification = $_POST['position_qualification'];
    $STAFF->service_experience = $_POST['service_experience'];
    $STAFF->id_copy = $_POST['id_copy'];
    $STAFF->epf_no = $_POST['epf_no'];
    $STAFF->salary = $_POST['salary'];
    $STAFF->district = $_POST['district'];
    $STAFF->province = $_POST['province'];
    $STAFF->company = $_POST['company'];

    $res = $STAFF->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Delete staff member
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $STAFF = new Staff($_POST['id']);
    $res = $STAFF->delete();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
