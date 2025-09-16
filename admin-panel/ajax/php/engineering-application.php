<?php

include './class/include.php';
header('Content-Type: application/json; charset=UTF8');

if (isset($_POST['create'])) {

    $APPLICANT = new Applicant1(NULL);

    $APPLICANT->full_name = $_POST['full_name'];
    $APPLICANT->nic = $_POST['nic'];
    $APPLICANT->passport_number = $_POST['passport_number'];
    $APPLICANT->birthday = $_POST['birthday'];
    $APPLICANT->age = $_POST['age'];
    $APPLICANT->gender = $_POST['gender'];
    $APPLICANT->marital_status = $_POST['marital_status'];
    $APPLICANT->mobile_number = $_POST['mobile_number'];
    $APPLICANT->whatsapp_number = $_POST['whatsapp_number'];
    $APPLICANT->province_id = $_POST['province_id'];
    $APPLICANT->current_job = $_POST['current_job'];
    $APPLICANT->job_abroad = $_POST['job_abroad'];
    $APPLICANT->created_at = date('Y-m-d H:i:s');

    $res = $APPLICANT->create();

    if ($res) {
        echo json_encode(["status" => 'success', "id" => $res]);
        exit();
    } else {
        echo json_encode(["status" => 'error']);
        exit();
    }
}


if (isset($_POST['create2'])) {

    $APPLICANT = new Applicant2(NULL);

    $APPLICANT->full_name = $_POST['full_name'];
    $APPLICANT->nic = $_POST['nic'];
    $APPLICANT->passport_number = $_POST['passport_number'];
    $APPLICANT->birthday = $_POST['birthday'];
    $APPLICANT->age = $_POST['age'];
    $APPLICANT->gender = $_POST['gender'];
    $APPLICANT->marital_status = $_POST['marital_status'];
    $APPLICANT->mobile_number = $_POST['mobile_number'];
    $APPLICANT->whatsapp_number = $_POST['whatsapp_number'];
    $APPLICANT->province_id = $_POST['province_id'];
    $APPLICANT->current_job = $_POST['current_job'];
    $APPLICANT->job_abroad = $_POST['job_abroad'];
    $APPLICANT->created_at = date('Y-m-d H:i:s');

    $res = $APPLICANT->create();

    if ($res) {
        echo json_encode(["status" => 'success', "id" => $res]);
        exit();
    } else {
        echo json_encode(["status" => 'error']);
        exit();
    }
}

?>