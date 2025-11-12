<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

// Create Group
if (isset($_POST['create'])) {
    $GROUP = new Group(NULL);

    $GROUP->group_name = filter_input(INPUT_POST, 'group_name', FILTER_SANITIZE_STRING);
    $GROUP->group_payment = filter_input(INPUT_POST, 'group_payment', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $GROUP->document_charge = filter_input(INPUT_POST, 'document_charge', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $GROUP->country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);

    if ($GROUP->create()) {
        echo json_encode(['status' => 'success', 'message' => 'Group created successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create group.']);
    }
    exit();
}

// Update Group
if (isset($_POST['update'])) {
    if (!isset($_POST['group_id']) || empty($_POST['group_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Group ID is required.']);
        exit();
    }

    $GROUP = new Group($_POST['group_id']);

    if (!$GROUP->id) {
        echo json_encode(['status' => 'error', 'message' => 'Group not found.']);
        exit();
    }

    $GROUP->group_name = filter_input(INPUT_POST, 'group_name', FILTER_SANITIZE_STRING);
    $GROUP->group_payment = filter_input(INPUT_POST, 'group_payment', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $GROUP->document_charge = filter_input(INPUT_POST, 'document_charge', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $GROUP->country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);

    if ($GROUP->update()) {
        echo json_encode(['status' => 'success', 'message' => 'Group updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update group.']);
    }
    exit();
}

// Delete Group
if (isset($_POST['delete']) && !empty($_POST['id'])) {
    try {
        $GROUP = new Group($_POST['id']);
        
        if (!$GROUP->id) {
            throw new Exception('Group not found.');
        }
        
        if ($GROUP->delete()) {
            echo json_encode([
                'status' => 'success', 
                'message' => 'Group deleted successfully.'
            ]);
        } else {
            throw new Exception('Failed to delete group from database.');
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error', 
            'message' => $e->getMessage()
        ]);
    }
    exit();
}

// If no recognized action
echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
exit();
