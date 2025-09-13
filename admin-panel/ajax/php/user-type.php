<?php
include '../../../class/include.php'; 
header('Content-Type: application/json; charset=UTF8');

//create course type
if (isset($_POST['create'])) {

    $USER_TYPE = new UserType(NULL);

    $USER_TYPE->name = $_POST['name'];
    $USER_TYPE->create();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} 

//update course type
if (isset($_POST['update'])) { 
    
    $USER_TYPE = new UserType($_POST['id']);

    $USER_TYPE->name = $_POST['name']; 

    $USER_TYPE->update();

    $result = ["id" => $_POST['id']];
    echo json_encode($result);
    exit();
}

  