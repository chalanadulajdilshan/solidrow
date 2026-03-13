<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$baddegama_registration = new BaddegamaRegistration(NULL);

$baddegama_registration->full_name = $_POST['full_name'];
$baddegama_registration->nic = $_POST['nic'];
$baddegama_registration->passport_number = $_POST['passport_number'];
$baddegama_registration->birthday = $_POST['birthday'];
$baddegama_registration->age = $_POST['age'];
$baddegama_registration->gender = $_POST['gender'];
$baddegama_registration->marital_status = $_POST['marital_status'];
$baddegama_registration->mobile_number = $_POST['mobile_number'];
$baddegama_registration->whatsapp_number = $_POST['whatsapp_number'];
$baddegama_registration->province_id = $_POST['province_id'];
$baddegama_registration->current_job = $_POST['current_job'];
$baddegama_registration->experience = $_POST['experience'];
$baddegama_registration->destination_country = $_POST['destination_country'];
$baddegama_registration->type = 'BADDEGAMA';
$baddegama_registration->created_at = date('Y-m-d H:i:s');


$duplicate_error = $baddegama_registration->isDuplicate();
if ($duplicate_error) {
    echo json_encode([
        "status" => 'error',
        "message" => $duplicate_error
    ]);
    exit();
}

$res = $baddegama_registration->create();

if ($res) {
    // Reload object to get the generated registration code
    $reg_obj = new BaddegamaRegistration($res);
    $reg_code = $reg_obj->registration_code;

    // Send SMS Notification
    $sms = new SMS();
    $recipient = $_POST['mobile_number'];
    $message = "Welcome!\nYou are now registered with Solidrow FESTI (Pvt) Ltd, Foreign Employment Agency. Your Reg No: " . $reg_code;
    $sms_res = $sms->sendSMS($recipient, $message);

    $sms_status_msg = "";
    if (isset($sms_res['status_code']) && $sms_res['status_code'] == 204) {
        $sms_status_msg = "SMS sent successfully.";
    } else {
        $sms_status_msg = "SMS sending failed. (Status: " . ($sms_res['status_code'] ?? 'Error') . ")";
    }

    echo json_encode([
        "status" => 'success',
        "id" => $res,
        "registration_code" => $reg_code,
        "sms_status" => $sms_status_msg,
        "sms_raw" => $sms_res
    ]);
    exit();
} else {
    $db = new Database();
    $mysql_error = mysqli_error($db->DB_CON);
    echo json_encode(["status" => 'error', "message" => "Database error: " . $mysql_error]);
    exit();
}
