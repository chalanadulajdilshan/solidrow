<?php

include '../../../class/include.php';
  
$USER = new User(NULL);

$user_name = $_POST['user_name'];
$password = $_POST['password'];
 

if ($USER->login($user_name, $password)) {
    $result = [
        "status" => 'success'
    ];
    echo json_encode($result);
    exit();
} else {
    $result = [
        "status" => 'error'
    ];
    echo json_encode($result);
    exit();
} 
