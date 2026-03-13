<?php
include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

if (isset($_POST['update_baddegama'])) {
    $id = $_POST['id'];
    $baddegama = new BaddegamaRegistration($id);
    
    $baddegama->call_status = $_POST['call_status'];
    $baddegama->employee_status = $_POST['employee_status'];
    $baddegama->call_notes = $_POST['call_notes'];
    $baddegama->call_date_time = str_replace('T', ' ', $_POST['call_date_time']); 
    
    $res = $baddegama->update();
    
    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error', "message" => "Update failed"]);
    }
    exit();
}
