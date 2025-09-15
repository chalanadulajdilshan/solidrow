<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

if (isset($_POST['display'])) {

    $PROVINCE = new Province();
    $res = $PROVINCE->all();

    if ($res) {
        echo json_encode(["status" => 'success', "data" => $res]);
    } else {
        echo json_encode(["status" => 'error', "data" => []]);
    }
    exit();
}
