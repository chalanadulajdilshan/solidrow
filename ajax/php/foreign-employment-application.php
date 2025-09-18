<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
 

    $foreign_employment_application = new ForeignEmploymentApplication(NULL);

    $foreign_employment_application->full_name = $_POST['full_name'];
    $foreign_employment_application->nic = $_POST['nic']; 
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
    $foreign_employment_application->type = 'EXTERNAL';
    $foreign_employment_application->created_at = date('Y-m-d H:i:s');



    $res = $foreign_employment_application->create();

    if ($res) {
        echo json_encode(["status" => 'success', "id" => $res]);
        exit();
    } else {
        echo json_encode(["status" => 'error']);
        exit();
    } 
 

 
