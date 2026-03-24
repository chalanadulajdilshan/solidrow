<?php

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id = $_POST['id'] ?? NULL;
$action = $_POST['action'] ?? NULL;

// Verify mobile number from session for new registrations
if (!$id && $action !== 'delete') {
    if (!isset($_SESSION['mobile_verified']) || $_SESSION['mobile_verified'] !== ($_POST['mobile_number'] ?? '')) {
        echo json_encode(["status" => 'error', "message" => "Mobile number verification failed. Please verify your number."]);
        exit();
    }
}

// Handle Delete Action
if ($action == 'delete' && $id) {
    $baddegama = new BaddegamaRegistration($id);
    $res = $baddegama->delete();
    if ($res) {
        echo json_encode(["status" => 'success', "message" => "Registration deleted successfully."]);
    } else {
        echo json_encode(["status" => 'error', "message" => "Deletion failed."]);
    }
    exit();
}

// Server-side Validation (Required for Create/Update)
$required_fields = [
    'full_name' => 'Full Name',
    'nic' => 'NIC',
    'birthday' => 'Birthday',
    'age' => 'Age',
    'gender' => 'Gender',
    'marital_status' => 'Marital Status',
    'mobile_number' => 'Mobile Number',
    'province_id' => 'Province',
    'current_job' => 'Current Job',
    'experience' => 'Experience', 
    'destination_country' => 'Destination Country'
];

foreach ($required_fields as $field => $label) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        echo json_encode(["status" => 'error', "message" => "$label is required."]);
        exit();
    }
}

// Mobile Number Validation
$mobile = $_POST['mobile_number'];
$mobile_regx = '/^07[01245678][0-9]{7}$/';
if (!preg_match($mobile_regx, $mobile)) {
    echo json_encode(["status" => 'error', "message" => "Invalid mobile number format. Must be 10 digits starting with 07."]);
    exit();
}

// NIC Validation
$nic = $_POST['nic'];
$old_nic_regx = '/^[0-9]{9}[vVxX]$/';
$new_nic_regx = '/^[0-9]{12}$/';

if (strlen($nic) === 10) {
    if (!preg_match($old_nic_regx, $nic)) {
        echo json_encode(["status" => 'error', "message" => "Invalid Old NIC format. (e.g., 123456789V)"]);
        exit();
    }
} elseif (strlen($nic) === 12) {
    if (!preg_match($new_nic_regx, $nic)) {
        echo json_encode(["status" => 'error', "message" => "Invalid New NIC format. (e.g., 123456789012)"]);
        exit();
    }
} else {
    echo json_encode(["status" => 'error', "message" => "Invalid NIC number length. Must be 10 or 12 characters."]);
    exit();
}

if ($id) {
    $baddegama_registration = new BaddegamaRegistration($id);
} else {
    $baddegama_registration = new BaddegamaRegistration(NULL);
    $baddegama_registration->created_at = date('Y-m-d H:i:s');
}

$baddegama_registration->type = $_POST['type'] ?? '2'; // Default to ID 2 as per user request

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
$baddegama_registration->current_job = $_POST['current_job'] ?? '';
$baddegama_registration->experience = $_POST['experience'] ?? 0;
$baddegama_registration->job_abroad = $_POST['job_abroad'] ?? '';
$baddegama_registration->destination_country = $_POST['destination_country'] ?? 0;

// Admin only fields
if (isset($_POST['call_status'])) {
    $baddegama_registration->call_status = $_POST['call_status'];
}
if (isset($_POST['employee_status'])) {
    $baddegama_registration->employee_status = $_POST['employee_status'];
}
if (isset($_POST['call_notes'])) {
    $baddegama_registration->call_notes = $_POST['call_notes'];
}
if (isset($_POST['call_date_time'])) {
    $baddegama_registration->call_date_time = str_replace('T', ' ', $_POST['call_date_time']);
}
if (isset($_POST['result'])) {
    $baddegama_registration->result = $_POST['result'];
}

if (!$id) {
    $duplicate_error = $baddegama_registration->isDuplicate();
    if ($duplicate_error) {
        echo json_encode([
            "status" => 'error',
            "message" => $duplicate_error
        ]);
        exit();
    }
    $res = $baddegama_registration->create();
} else {
    $res = $baddegama_registration->update();
    
    
        $sms = new SMS();
        $recipient = $_POST['mobile_number'];
        $name = $_POST['full_name'];
        
        if ($_POST['gender'] == "male") {
            $title = "Mr.";
        } else {
            $title = "Ms.";
        }

       $result = $_POST['result']; // PASS or FAIL

if ($result == "Pass") {
    $message = "Congratulations!\n" . $title . " " . $name . 
               ", You have PASSED your exam successfully.\nResult: " . $result;
} else {
    $message = "Dear " . $title . " " . $name . ",\n" . 
               "Unfortunately, you have FAILED the exam.\nResult: " . $result . 
               ". Please try again.";
}
        
        $sms_res = $sms->sendSMS($recipient, $message);

        if (isset($sms_res['status_code']) && $sms_res['status_code'] == 204) {
            $sms_status_msg = "SMS sent successfully.";
        } else {
            $sms_status_msg = "SMS sending failed. (Status: " . ($sms_res['status_code'] ?? 'Error') . ")";
        }
        
        
}

if ($res) {
    $reg_id = $id ? $id : $res;
    // Reload object to get the generated registration code
    $reg_obj = new BaddegamaRegistration($reg_id);
    $reg_code = $reg_obj->registration_code;

    $sms_status_msg = "";
    
    // Only send SMS on creation
    if (!$id) {
        // Send SMS Notification
        $sms = new SMS();
        $recipient = $_POST['mobile_number'];
        $name = $_POST['full_name'];
        
        if ($_POST['gender'] == "male") {
            $title = "Mr.";
        } else {
            $title = "Ms.";
        }

        $message = "Welcome!\n " . $title . " " . $name . 
                   " You are now registered with Solidrow FESTI (Pvt) Ltd, Foreign Employment Agency. Your Reg No: " . $reg_code;
        
        $sms_res = $sms->sendSMS($recipient, $message);

        if (isset($sms_res['status_code']) && $sms_res['status_code'] == 204) {
            $sms_status_msg = "SMS sent successfully.";
        } else {
            $sms_status_msg = "SMS sending failed. (Status: " . ($sms_res['status_code'] ?? 'Error') . ")";
        }
    }

    echo json_encode([
        "status" => 'success',
        "id" => $reg_id,
        "registration_code" => $reg_code,
        "sms_status" => $sms_status_msg
    ]);
    exit();
} else {
    echo json_encode(["status" => 'error', "message" => "Operation failed"]);
    exit();
}
