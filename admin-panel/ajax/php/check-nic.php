<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF-8');
  

if (!isset($_POST['nic'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$nic = $_POST['nic'];
$current_id = isset($_POST['current_id']) ? intval($_POST['current_id']) : 0;

try {
    $db = new Database();
    $query = "SELECT id FROM agencystudent WHERE nic = '" . $db->DB_CON->real_escape_string($nic) . "'";
    
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
