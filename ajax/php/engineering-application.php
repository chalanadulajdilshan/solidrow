<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
 

    $ENGINEERING_APPLICATION = new EngineeringApplication(NULL);

    $ENGINEERING_APPLICATION->full_name = $_POST['full_name'];
    $ENGINEERING_APPLICATION->nic = $_POST['nic']; 
    $ENGINEERING_APPLICATION->passport_number = $_POST['passport_number'];
    $ENGINEERING_APPLICATION->birthday = $_POST['birthday'];
    $ENGINEERING_APPLICATION->age = $_POST['age'];
    $ENGINEERING_APPLICATION->gender = $_POST['gender'];
    $ENGINEERING_APPLICATION->marital_status = $_POST['marital_status'];
    $ENGINEERING_APPLICATION->mobile_number = $_POST['mobile_number'];
    $ENGINEERING_APPLICATION->whatsapp_number = $_POST['whatsapp_number'];
    $ENGINEERING_APPLICATION->province_id = $_POST['province_id'];
    $ENGINEERING_APPLICATION->current_job = $_POST['current_job'];
    $ENGINEERING_APPLICATION->job_abroad = $_POST['job_abroad'];
    $ENGINEERING_APPLICATION->type = 'EXTERNAL';
    $ENGINEERING_APPLICATION->created_at = date('Y-m-d H:i:s');



    $res = $ENGINEERING_APPLICATION->create();

    if ($res) {
        echo json_encode(["status" => 'success', "id" => $res]);
        exit();
    } else {
        echo json_encode(["status" => 'error']);
        exit();
    } 
 

 
