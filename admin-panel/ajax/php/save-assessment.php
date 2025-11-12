<?php
include '../../../class/include.php';
include '../../auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get POST data
        $student_id = isset($_POST['student_id']) ? intval($_POST['student_id']) : null;
        $assessment_type = isset($_POST['assessment_type']) ? $_POST['assessment_type'] : '';
        $assessment_date = isset($_POST['assessment_date']) ? $_POST['assessment_date'] : '';
        $assessment_result = isset($_POST['assessment_result']) ? $_POST['assessment_result'] : '';

        // Validate assessment type

        if (empty($assessment_type) || !in_array($assessment_type, ['interview', 'pretest'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Valid assessment type is required'
            ]);
            exit;
        }

        if (empty($assessment_date)) {
            echo json_encode([
                'success' => false,
                'message' => 'Assessment date is required'
            ]);
            exit;
        }

        if (empty($assessment_result) || !in_array($assessment_result, ['pass', 'fail'])) {
            echo json_encode([
                'success' => false,
                'message' => 'Valid assessment result is required'
            ]);
            exit;
        }

        // Save assessment
        $assessment = new StudentAssessment();
        $result = $assessment->saveOrUpdate($student_id, $assessment_type, $assessment_date, $assessment_result);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => ucfirst($assessment_type) . ' details saved successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to save ' . $assessment_type . ' details'
            ]);
        }

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
