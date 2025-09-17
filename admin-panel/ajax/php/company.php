<?php

include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Function to handle file upload
function handleFileUpload($file, $companyId = null) {
    $upload_dir = __DIR__ . '/../../../upload/company/';
    
    // Create upload directory if it doesn't exist
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // If no file was uploaded or there was an error, return null
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = 'company_' . ($companyId ?: time()) . '.' . $file_extension;
    $file_path = $upload_dir . $file_name;
    
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return $file_name;
    }
    
    return null;
}

// Create a new company
if (isset($_POST['create'])) {
    $response = ["status" => "error", "message" => ""];
    
    try {
        $COMPANY = new Company(NULL);
        $COMPANY->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $COMPANY->short_desc = filter_input(INPUT_POST, 'short_desc', FILTER_SANITIZE_STRING);
        $COMPANY->page_url = filter_input(INPUT_POST, 'page_url', FILTER_SANITIZE_URL);
        
        // Handle file upload if a file was sent
        if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
            $COMPANY->image_name = handleFileUpload($_FILES['image_name']);
        }
        
        $res = $COMPANY->create();
        
        if ($res) {
            $response = ["status" => "success", "id" => $res];
        }
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

// Update company
if (isset($_POST['update'])) {
    $response = ["status" => "error", "message" => ""];
    
    try {
        $COMPANY = new Company($_POST['company_id']);
        
        if ($COMPANY->id) {
            $COMPANY->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $COMPANY->short_desc = filter_input(INPUT_POST, 'short_desc', FILTER_SANITIZE_STRING);
            $COMPANY->page_url = filter_input(INPUT_POST, 'page_url', FILTER_SANITIZE_URL);
            
            // Handle file upload if a new file was sent
            if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
                // Delete old image if exists
                if ($COMPANY->image_name) {
                    $old_file = __DIR__ . '/../../../upload/company/' . $COMPANY->image_name;
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
                $COMPANY->image_name = handleFileUpload($_FILES['image_name'], $COMPANY->id);
            }
            
            $res = $COMPANY->update();
            $response = ["status" => $res ? "success" : "error"];
        } else {
            $response["message"] = "Company not found";
        }
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

// Handle delete request
if (isset($_POST['delete'])) {
    $response = ["status" => "error", "message" => ""];
    
    try {
        // Check for both 'id' and 'company_id' parameters for backward compatibility
        $company_id = $_POST['company_id'] ?? $_POST['id'] ?? null;
        
        if (!$company_id) {
            throw new Exception("Company ID is required");
        }
        
        $COMPANY = new Company($company_id);
        
        if ($COMPANY->id) {
            // Delete the company image if it exists
            if ($COMPANY->image_name) {
                $image_path = __DIR__ . '/../../../upload/company/' . $COMPANY->image_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            
            $res = $COMPANY->delete();
            $response = ["status" => $res ? "success" : "error"];
        } else {
            $response["message"] = "Company not found";
        }
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}

