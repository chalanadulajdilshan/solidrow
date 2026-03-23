<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

$action = $_POST['action'] ?? '';

if ($action === 'send_otp') {
    $mobile = $_POST['mobile'] ?? '';

    if (empty($mobile)) {
        echo json_encode(["status" => 'error', "message" => "Mobile number is required."]);
        exit();
    }

    // Generate 6-digit OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp_code'] = $otp;
    $_SESSION['otp_mobile'] = $mobile;
    $_SESSION['otp_expiry'] = time() + (5 * 60); // 5 minutes expiry

    $sms = new SMS();
    $message = "Your Solidrow verification code is: " . $otp . ". Valid for 5 minutes.";
    $res = $sms->sendSMS($mobile, $message);

    if ($res && isset($res['status']) && $res['status'] == 'success') {
         echo json_encode(["status" => 'success', "message" => "OTP sent successfully."]);
    } else if (isset($res['status_code']) && $res['status_code'] == 204) {
         echo json_encode(["status" => 'success', "message" => "OTP sent successfully."]);
    } else {
        echo json_encode(["status" => 'error', "message" => "Failed to send SMS. Please try again later."]);
    }
    exit();
}

if ($action === 'verify_otp') {
    $code = $_POST['otp'] ?? '';
    $mobile = $_POST['mobile'] ?? '';

    if (!isset($_SESSION['otp_code']) || !isset($_SESSION['otp_mobile'])) {
        echo json_encode(["status" => 'error', "message" => "OTP expired or not sent."]);
        exit();
    }

    if ($_SESSION['otp_expiry'] < time()) {
        unset($_SESSION['otp_code']);
        unset($_SESSION['otp_mobile']);
        unset($_SESSION['otp_expiry']);
        echo json_encode(["status" => 'error', "message" => "OTP expired. Please send a new one."]);
        exit();
    }

    if ($_SESSION['otp_code'] == $code && $_SESSION['otp_mobile'] == $mobile) {
        $_SESSION['mobile_verified'] = $mobile;
        unset($_SESSION['otp_code']);
        unset($_SESSION['otp_mobile']);
        unset($_SESSION['otp_expiry']);
        echo json_encode(["status" => 'success', "message" => "Mobile number verified successfully."]);
    } else {
        echo json_encode(["status" => 'error', "message" => "Invalid OTP code."]);
    }
    exit();
}

echo json_encode(["status" => 'error', "message" => "Invalid request action."]);
