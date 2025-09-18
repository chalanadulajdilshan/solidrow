<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Get visa types by IDs
if (isset($_GET['action']) && $_GET['action'] === 'get_visa_types' && !empty($_GET['ids'])) {
    $ids = explode(',', $_GET['ids']);
    $ids = array_map('intval', $ids); // Sanitize input
    $ids = array_filter($ids); // Remove empty values
    
    if (empty($ids)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'No valid IDs provided'
        ]);
        exit();
    }
    
    $visaType = new VisaType();
    
    echo json_encode([
        'status' => 'success',
        'data' => $visaType->all()
    ]);
    exit();
}

echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request'
]);
