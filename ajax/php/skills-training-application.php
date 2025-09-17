<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');
 

    $SkillTrainingApplication = new SkillTrainingApplication(NULL);

    $SkillTrainingApplication->full_name = $_POST['full_name'];
    $SkillTrainingApplication->nic = $_POST['nic']; 
    $SkillTrainingApplication->passport_number = $_POST['passport_number'];
    $SkillTrainingApplication->birthday = $_POST['birthday'];
    $SkillTrainingApplication->age = $_POST['age'];
    $SkillTrainingApplication->gender = $_POST['gender'];
    $SkillTrainingApplication->marital_status = $_POST['marital_status'];
    $SkillTrainingApplication->mobile_number = $_POST['mobile_number'];
    $SkillTrainingApplication->whatsapp_number = $_POST['whatsapp_number'];
    $SkillTrainingApplication->province_id = $_POST['province_id'];
    $SkillTrainingApplication->current_job = $_POST['current_job'];
    $SkillTrainingApplication->job_abroad = $_POST['job_abroad'];
    $SkillTrainingApplication->type = 'EXTERNAL';
    $SkillTrainingApplication->created_at = date('Y-m-d H:i:s');



    $res = $SkillTrainingApplication->create();

    if ($res) {
        echo json_encode(["status" => 'success', "id" => $res]);
        exit();
    } else {
        echo json_encode(["status" => 'error']);
        exit();
    } 
 

 
