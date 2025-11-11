<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

// ==========================
// CREATE Application
// ==========================
if (isset($_POST['create'])) {
    $APPLICATION = new Application(NULL);

    // Sanitize and assign fields
    $APPLICATION->fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $APPLICATION->NIC = filter_input(INPUT_POST, 'NIC', FILTER_SANITIZE_STRING);
    $APPLICATION->passportnumber = filter_input(INPUT_POST, 'passportnumber', FILTER_SANITIZE_STRING);
    $APPLICATION->married_status = filter_input(INPUT_POST, 'married_status', FILTER_SANITIZE_STRING);
    $APPLICATION->mobile_number = filter_input(INPUT_POST, 'mobile_number', FILTER_SANITIZE_STRING);
    $APPLICATION->whatsapp_number = filter_input(INPUT_POST, 'whatsapp_number', FILTER_SANITIZE_STRING);
    $APPLICATION->country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);

    $result = $APPLICATION->create();

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Application created successfully.', 'id' => $result]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create application.']);
    }
    exit();
}

// ==========================
// UPDATE Application
// ==========================
if (isset($_POST['update'])) {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Application ID is required.']);
        exit();
    }

    $APPLICATION = new Application($_POST['id']);

    $APPLICATION->fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $APPLICATION->NIC = filter_input(INPUT_POST, 'NIC', FILTER_SANITIZE_STRING);
    $APPLICATION->passportnumber = filter_input(INPUT_POST, 'passportnumber', FILTER_SANITIZE_STRING);
    $APPLICATION->married_status = filter_input(INPUT_POST, 'married_status', FILTER_SANITIZE_STRING);
    $APPLICATION->mobile_number = filter_input(INPUT_POST, 'mobile_number', FILTER_SANITIZE_STRING);
    $APPLICATION->whatsapp_number = filter_input(INPUT_POST, 'whatsapp_number', FILTER_SANITIZE_STRING);
    $APPLICATION->country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);

    if ($APPLICATION->update()) {
        echo json_encode(['status' => 'success', 'message' => 'Application updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update application.']);
    }
    exit();
}

// ==========================
// DELETE Application
// ==========================
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $APPLICATION = new Application($_POST['id']);
    if ($APPLICATION->id && $APPLICATION->delete()) {
        echo json_encode(['status' => 'success', 'message' => 'Application deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete application.']);
    }
    exit();
}

// ==========================
// GET ALL Applications
// ==========================
if (isset($_GET['all'])) {
    $APPLICATION = new Application(NULL);
    $applications = $APPLICATION->all();

    echo json_encode(['status' => 'success', 'data' => $applications]);
    exit();
}
?>
