<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

//create course type
if (isset($_POST['create'])) {

    $USER = new User(NULL);
    $USER->create($_POST['name'], $_POST['type'], $_POST['center_id'],$_POST['division'],$_POST['position'], $_POST['email'], $_POST['phone'], $_POST['username'], $_POST['password']);


    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//update course type
if (isset($_POST['update'])) {

    $USER = new User($_POST['id']);

    $USER->name = $_POST['name'];
    $USER->type = $_POST['type'];
    if ($_POST['type'] == 3) {
        $USER->center_id = $_POST['center_id'];
    } else {
        $USER->center_id = '';
    }
    $USER->email = $_POST['email'];
    $USER->phone = $_POST['phone'];
    $USER->username = $_POST['username'];

    $USER->update();
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//update password

if (isset($_POST['change_password'])) {
    $USER = new User(NULL);
    $id = $_POST["id"];
    $password = $_POST["password"];


    if ($password != NULL) {

        $USER->updatePasswordAdmin($password, $id);
        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }
}