<?php

include '../../../class/include.php';

if ($_POST['option'] == 'delete') {

    $SLIDER = new Slider($_POST['id']);

    $result = $SLIDER->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}