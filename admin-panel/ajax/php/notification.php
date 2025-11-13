<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

// Create Notification
if (isset($_POST['create'])) {
    $NOTIF = new Notification();
    $NOTIF->title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $NOTIF->description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    if ($NOTIF->create()) {
        echo json_encode(['status' => 'success', 'message' => 'Notification created successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create notification.']);
    }
    exit();
}

// Update Notification
if (isset($_POST['update'])) {
    if (empty($_POST['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Notification ID required.']);
        exit();
    }

    $NOTIF = new Notification($_POST['id']);
    $NOTIF->title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $NOTIF->description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    if ($NOTIF->update()) {
        echo json_encode(['status' => 'success', 'message' => 'Notification updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update notification.']);
    }
    exit();
}

// Delete Notification
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $NOTIF = new Notification($_POST['id']);
    if ($NOTIF->delete()) {
        echo json_encode(['status' => 'success', 'message' => 'Notification deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete notification.']);
    }
    exit();
}
