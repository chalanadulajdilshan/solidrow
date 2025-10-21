<?php

include '../../../class/include.php';

 

if ($_POST['action'] == 'GET_DIVISIONAL_BY_DISTRICT') {

    $DSDIVISION = new Dsdivision(NULL);
  
    $result = $DSDIVISION->GetDistrictByDsdivision($_POST["district"]);
    echo json_encode($result);
     
    exit();
}

