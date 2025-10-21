<?php

include '../../../class/include.php';

if ($_POST['action'] == 'GET_GRAMANILADARI_BY_DSDIVISION') {

    $DNDIVISION = new Gndivision(NULL);
  
    $result = $DNDIVISION->GetGnByDsdivision($_POST["division_id"]);
    echo json_encode($result);
     
    exit();
}

