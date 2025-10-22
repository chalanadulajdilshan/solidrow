<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

 
// Create staff
if (isset($_POST['create'])) {
    $AGENT = new Agent(NULL); 

  

    $AGENT->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);    
    $AGENT->contact_no = filter_input(INPUT_POST, 'contact_no', FILTER_SANITIZE_STRING);
    $AGENT->whatsapp_no = filter_input(INPUT_POST, 'whatsapp_no', FILTER_SANITIZE_STRING);
    $AGENT->nic = filter_input(INPUT_POST, 'nic', FILTER_SANITIZE_STRING); 

    if ($AGENT->create()) {
        echo json_encode(['status' => 'success', 'message' => 'Agent created successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create agent.']);
    }
    exit();
}

// Update staff
if (isset($_POST['update'])) {
    if (!isset($_POST['agent_id']) || empty($_POST['agent_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Agent ID is required.']);
        exit();
    }

    $AGENT = new Agent($_POST['agent_id']);
    

    $AGENT->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $AGENT->contact_no = filter_input(INPUT_POST, 'contact_no', FILTER_SANITIZE_STRING);
    $AGENT->whatsapp_no = filter_input(INPUT_POST, 'whatsapp_no', FILTER_SANITIZE_STRING);
    $AGENT->nic = filter_input(INPUT_POST, 'nic', FILTER_SANITIZE_STRING); 

    if ($AGENT->update()) {
        echo json_encode(['status' => 'success', 'message' => 'Agent updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update agent.']);
    }
    exit();
}
 
