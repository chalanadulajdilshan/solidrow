<?php
include '../../../class/include.php';
include '../../auth.php';

header('Content-Type: application/json');

// Function to send JSON response
function sendResponse($success, $message = '', $data = []) {
    $response = ['success' => $success];
    if ($message) $response['message'] = $message;
    if (!empty($data)) $response['data'] = $data;
    
    echo json_encode($response);
    exit;
}

try {
    // Check if this is a POST request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        error_log('Invalid request method. Only POST is allowed.');
        sendResponse(false, 'Invalid request method. Only POST is allowed.');
    }

    // Get and validate POST data
    $agancy_student_id = isset($_POST['agancy_student_id']) ? intval($_POST['agancy_student_id']) : null;
    $assessment_type = isset($_POST['assessment_type']) ? trim($_POST['assessment_type']) : '';
    $assessment_date = isset($_POST['assessment_date']) ? trim($_POST['assessment_date']) : '';
    $assessment_result = isset($_POST['assessment_result']) ? trim($_POST['assessment_result']) : '';

    // Validate required fields
    if (empty($agancy_student_id)) {
        error_log('Agency student ID is required');
        sendResponse(false, 'Agency student ID is required');
    }

    // Validate assessment type
    $valid_types = ['interview', 'pretest'];
    if (empty($assessment_type) || !in_array($assessment_type, $valid_types)) {
        error_log('Valid assessment type is required. Must be one of: ' . implode(', ', $valid_types));
        sendResponse(false, 'Valid assessment type is required. Must be one of: ' . implode(', ', $valid_types));
    }

    // Validate date format (YYYY-MM-DD)
    if (empty($assessment_date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $assessment_date)) {
        error_log('Valid assessment date is required (YYYY-MM-DD)');
        sendResponse(false, 'Valid assessment date is required (YYYY-MM-DD)');
    }

    // Validate result
    $valid_results = ['pass', 'fail'];
    if (empty($assessment_result) || !in_array($assessment_result, $valid_results)) {
        error_log('Valid assessment result is required. Must be one of: ' . implode(', ', $valid_results));
        sendResponse(false, 'Valid assessment result is required. Must be one of: ' . implode(', ', $valid_results));
    }

    // Validate that the agency student exists
    $db = new Database();
    $query = "SELECT id FROM agencystudent WHERE id = " . intval($agancy_student_id) . " LIMIT 1";
    $result = $db->readQuery($query);
    
    if (!mysqli_fetch_assoc($result)) {
        error_log('Agency student not found with ID: ' . $agancy_student_id);
        sendResponse(false, 'Agency student not found');
    }

    // Save the assessment (only interview and pretest are now handled)
    try {
        $assessment = new StudentAssessment();
        $result = $assessment->saveOrUpdate($agancy_student_id, $assessment_type, $assessment_date, $assessment_result);

        if ($result) {
            error_log(ucfirst($assessment_type) . ' assessment saved successfully');
            sendResponse(true, 
                ucfirst($assessment_type) . ' assessment saved successfully',
                ['assessment_id' => $result]
            );
        } else {
            error_log('Failed to save ' . $assessment_type . ' assessment');
            sendResponse(false, 'Failed to save ' . $assessment_type . ' assessment. Please try again.');
        }
    } catch (Exception $e) {
        error_log('Error saving assessment: ' . $e->getMessage());
        sendResponse(false, 'An error occurred while saving the assessment.');
    }

} catch (Exception $e) {
    error_log('Assessment save error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
    sendResponse(false, 'An error occurred while saving the assessment. Please try again.');
}
