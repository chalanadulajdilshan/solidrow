<?php

include '../../../class/Include.php';
header('Content-Type: application/json; charset=UTF8');

if (isset($_POST['create'])) {

    $SKILLS_TRAINING_APPLICATION = new SkillsTrainingApplication(NULL);

    $SKILLS_TRAINING_APPLICATION->full_name = $_POST['full_name'];
    $SKILLS_TRAINING_APPLICATION->nic = $_POST['nic'];
    $SKILLS_TRAINING_APPLICATION->staff_id = $_POST['staff_id'];
    $SKILLS_TRAINING_APPLICATION->passport_number = $_POST['passport_number'];
    $SKILLS_TRAINING_APPLICATION->birthday = $_POST['birthday'];
    $SKILLS_TRAINING_APPLICATION->age = $_POST['age'];
    $SKILLS_TRAINING_APPLICATION->gender = $_POST['gender'];
    $SKILLS_TRAINING_APPLICATION->marital_status = $_POST['marital_status'];
    $SKILLS_TRAINING_APPLICATION->mobile_number = $_POST['mobile_number'];
    $SKILLS_TRAINING_APPLICATION->whatsapp_number = $_POST['whatsapp_number'];
    $SKILLS_TRAINING_APPLICATION->province_id = $_POST['province_id'];
    $SKILLS_TRAINING_APPLICATION->current_job = $_POST['current_job'];
    $SKILLS_TRAINING_APPLICATION->job_abroad = $_POST['job_abroad'];
    $SKILLS_TRAINING_APPLICATION->type = 'WEB';
    $SKILLS_TRAINING_APPLICATION->created_at = date('Y-m-d H:i:s');



    $res = $SKILLS_TRAINING_APPLICATION->create();

    if ($res) {
        echo json_encode(["status" => 'success', "id" => $res]);
        exit();
    } else {
        echo json_encode(["status" => 'error']);
        exit();
    } 
}

if (isset($_POST['update'])) {
 
    $SKILLS_TRAINING_APPLICATION = new SkillsTrainingApplication($_POST['id']); // Load staff by ID

    $SKILLS_TRAINING_APPLICATION->full_name = $_POST['full_name'];
    $SKILLS_TRAINING_APPLICATION->nic = $_POST['nic'];
    $SKILLS_TRAINING_APPLICATION->staff_id = $_POST['staff_id'];
    $SKILLS_TRAINING_APPLICATION->passport_number = $_POST['passport_number'];
    $SKILLS_TRAINING_APPLICATION->birthday = $_POST['birthday'];
    $SKILLS_TRAINING_APPLICATION->age = $_POST['age'];
    $SKILLS_TRAINING_APPLICATION->gender = $_POST['gender'];
    $SKILLS_TRAINING_APPLICATION->marital_status = $_POST['marital_status'];
    $SKILLS_TRAINING_APPLICATION->mobile_number = $_POST['mobile_number'];
    $SKILLS_TRAINING_APPLICATION->whatsapp_number = $_POST['whatsapp_number'];
    $SKILLS_TRAINING_APPLICATION->province_id = $_POST['province_id'];
    $SKILLS_TRAINING_APPLICATION->current_job = $_POST['current_job'];
    $SKILLS_TRAINING_APPLICATION->job_abroad = $_POST['job_abroad'];
    $SKILLS_TRAINING_APPLICATION->type = 'INTERNAL';
    $SKILLS_TRAINING_APPLICATION->created_at = date('Y-m-d H:i:s');

    $SKILLS_TRAINING_APPLICATION->call_date_time = $_POST['call_date_time'];
    $SKILLS_TRAINING_APPLICATION->call_status = $_POST['call_status'];
    $SKILLS_TRAINING_APPLICATION->employee_status = $_POST['employee_status'];
    $SKILLS_TRAINING_APPLICATION->call_notes = $_POST['call_notes'];

   

    $res = $SKILLS_TRAINING_APPLICATION->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}
