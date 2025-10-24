<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');
 

if (!isset($_POST['number']) || !isset($_POST['field'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$number = $_POST['number'];
$field = $_POST['field'];
$current_id = isset($_POST['current_id']) ? intval($_POST['current_id']) : 0;

// Validate field name to prevent SQL injection
$allowed_fields = ['phone_number', 'whatsapp_number', 'other_agent_mobile'];
if (!in_array($field, $allowed_fields)) {
    echo json_encode(['error' => 'Invalid field']);
    exit;
}

try {
    $db = new Database();
    $query = "SELECT id FROM agencystudent WHERE $field = '" . $db->DB_CON->real_escape_string($number) . "'";
    
    if ($current_id > 0) {
        $query .= " AND id != " . $current_id;
    }
    
    $result = $db->readQuery($query);
    
    echo json_encode([
        'exists' => mysqli_num_rows($result) > 0
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}