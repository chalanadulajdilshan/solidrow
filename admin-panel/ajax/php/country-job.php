<?php
include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Create a new country job
if (isset($_POST['create'])) {
    $response = [];
    
    try {
        $COUNTRY_JOB = new CountryJob();
        $COUNTRY_JOB->country_id = $_POST['country_id'];
        $COUNTRY_JOB->name = $_POST['name'];
        
        $result = $COUNTRY_JOB->create();
        
        if ($result) {
            $response = [
                'status' => 'success',
                'id' => $result,
                'message' => 'Job position created successfully'
            ];
        } else {
            throw new Exception('Failed to create job position');
        }
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
    
    echo json_encode($response);
    exit();
}

// Update country job
if (isset($_POST['update'])) {
    $response = [];
    
    try {
        $COUNTRY_JOB = new CountryJob($_POST['job_id']);
        
        if ($COUNTRY_JOB->id) {
            $COUNTRY_JOB->name = $_POST['name'];
            
            $result = $COUNTRY_JOB->update();
            
            if ($result) {
                $response = [
                    'status' => 'success',
                    'message' => 'Job position updated successfully'
                ];
            } else {
                throw new Exception('Failed to update job position');
            }
        } else {
            throw new Exception('Job position not found');
        }
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
    
    echo json_encode($response);
    exit();
}

// Delete country job
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $response = [];
    
    try {
        $COUNTRY_JOB = new CountryJob($_POST['id']);
        
        if ($COUNTRY_JOB->id) {
            $result = $COUNTRY_JOB->delete();
            
            if ($result) {
                $response = [
                    'status' => 'success',
                    'message' => 'Job position deleted successfully'
                ];
            } else {
                throw new Exception('Failed to delete job position');
            }
        } else {
            throw new Exception('Job position not found');
        }
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
    
    echo json_encode($response);
    exit();
}

// Get job by ID
if (isset($_GET['get_job']) && isset($_GET['id'])) {
    $response = [];
    
    try {
        $COUNTRY_JOB = new CountryJob($_GET['id']);
        
        if ($COUNTRY_JOB->id) {
            $response = [
                'status' => 'success',
                'data' => [
                    'id' => $COUNTRY_JOB->id,
                    'name' => $COUNTRY_JOB->name,
                    'country_id' => $COUNTRY_JOB->country_id
                ]
            ];
        } else {
            throw new Exception('Job position not found');
        }
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
    
    echo json_encode($response);
    exit();
}

// Get jobs by country
if (isset($_GET['get_by_country']) && isset($_GET['country_id'])) {
    $response = [];
    
    try {
        $COUNTRY_JOB = new CountryJob();
        $jobs = $COUNTRY_JOB->getByCountry($_GET['country_id']);
        
        $response = [
            'status' => 'success',
            'data' => $jobs
        ];
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
    
    echo json_encode($response);
    exit();
}
