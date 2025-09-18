<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

if (isset($_POST['create'])) {

    $foreign_employment_application = new ForeignEmploymentApplication(NULL);

    $foreign_employment_application->full_name = $_POST['full_name'];
    $foreign_employment_application->nic = $_POST['nic'];
    $foreign_employment_application->staff_id = $_POST['staff_id'];
    $foreign_employment_application->passport_number = $_POST['passport_number'];
    $foreign_employment_application->birthday = $_POST['birthday'];
    $foreign_employment_application->age = $_POST['age'];
    $foreign_employment_application->gender = $_POST['gender'];
    $foreign_employment_application->marital_status = $_POST['marital_status'];
    $foreign_employment_application->mobile_number = $_POST['mobile_number'];
    $foreign_employment_application->whatsapp_number = $_POST['whatsapp_number'];
    $foreign_employment_application->province_id = $_POST['province_id'];
    $foreign_employment_application->current_job = $_POST['current_job'];
    $foreign_employment_application->job_abroad = $_POST['job_abroad'];
    $foreign_employment_application->type = 'WEB';
    $foreign_employment_application->created_at = date('Y-m-d H:i:s');



    $res = $foreign_employment_application->create();

    if ($res) {
        echo json_encode(["status" => 'success', "id" => $res]);
        exit();
    } else {
        echo json_encode(["status" => 'error']);
        exit();
    } 
}

if (isset($_POST['update'])) {
 
    $foreign_employment_application = new ForeignEmploymentApplication($_POST['id']); // Load staff by ID

    $foreign_employment_application->full_name = $_POST['full_name'];
    $foreign_employment_application->nic = $_POST['nic'];
    $foreign_employment_application->staff_id = $_POST['staff_id'];
    $foreign_employment_application->passport_number = $_POST['passport_number'];
    $foreign_employment_application->birthday = $_POST['birthday'];
    $foreign_employment_application->age = $_POST['age'];
    $foreign_employment_application->gender = $_POST['gender'];
    $foreign_employment_application->marital_status = $_POST['marital_status'];
    $foreign_employment_application->mobile_number = $_POST['mobile_number'];
    $foreign_employment_application->whatsapp_number = $_POST['whatsapp_number'];
    $foreign_employment_application->province_id = $_POST['province_id'];
    $foreign_employment_application->current_job = $_POST['current_job'];
    $foreign_employment_application->job_abroad = $_POST['job_abroad'];
    $foreign_employment_application->type = 'INTERNAL';
    $foreign_employment_application->created_at = date('Y-m-d H:i:s');

    $foreign_employment_application->call_date_time = $_POST['call_date_time'];
    $foreign_employment_application->call_status = $_POST['call_status'];
    $foreign_employment_application->employee_status = $_POST['employee_status'];
    $foreign_employment_application->call_notes = $_POST['call_notes'];

   

    $res = $foreign_employment_application->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
