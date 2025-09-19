<?php

include __DIR__ . '/../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new Visa Consultancy Application
if (isset($_POST['create'])) {

    $VCA = new VisaConsultancyApplication(null); // New object

    $VCA->full_name = $_POST['full_name'];
    $VCA->staff_id = $_POST['staff_id'] ?? 0;
    $VCA->nic = $_POST['nic'];
    $VCA->passport_number = $_POST['passport_number'];
    $VCA->birthday = $_POST['birthday'];
    $VCA->age = $_POST['age'];
    $VCA->gender = $_POST['gender'];
    $VCA->marital_status = $_POST['marital_status'];
    $VCA->mobile_number = $_POST['mobile_number'];
    $VCA->whatsapp_number = $_POST['whatsapp_number'];
    $VCA->province_id = $_POST['province_id'];
    $VCA->type = 'EXTERNAL';
    $VCA->current_job = $_POST['current_job'];
    $VCA->job_abroad = $_POST['job_abroad'];
    $VCA->created_at = date('Y-m-d H:i:s');
    $VCA->call_date_time = $_POST['call_date_time'] ?? NULL;
    $VCA->call_status = $_POST['call_status'] ?? NULL;
    $VCA->employee_status = $_POST['employee_status'] ?? NULL;
    $VCA->call_notes = $_POST['call_notes'] ?? NULL;
    $VCA->country_id = $_POST['country_id'];
    $VCA->visa_category = $_POST['visa_category'];

    $res = $VCA->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
