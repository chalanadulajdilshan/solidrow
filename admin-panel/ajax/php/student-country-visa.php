<?php

include __DIR__ . '/../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

// Handle GET request for visa types by country
if (isset($_GET['get_visa_types']) && isset($_GET['country_id'])) {
    $countryId = (int)$_GET['country_id'];
    $db = new Database();
    
    // Get all visa types for the country with their names
    $query = "SELECT 
                svc.visa_category as visa_type_id, 
                vt.name as visa_type_name,
                svc.id as id
              FROM student_visa_country svc
              LEFT JOIN visa_type vt ON svc.visa_category = vt.id
              WHERE svc.country_id = $countryId
              ORDER BY vt.name ASC";
    
    $result = $db->readQuery($query);
    
    $visaTypes = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $visaTypes[] = [
                'id' => $row['id'],
                'visa_type_id' => $row['visa_type_id'],
                'visa_type_name' => $row['visa_type_name'] ?: 'Unknown Visa Type',
                'visa_category' => $row['visa_type_id'] // For backward compatibility
            ];
        }
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $visaTypes
    ]);
    exit();
}

// Create a new Student Visa Country
if (isset($_POST['create'])) {
    $SVC = new StudentCountryVisa();
    $SVC->country_id = $_POST['country_id'];
    $SVC->visa_category = $_POST['visa_category'];

    $res = $SVC->create();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Update Student Visa Country
if (isset($_POST['update'])) {

    $SVC = new StudentCountryVisa($_POST['id']); // Load by ID

    $SVC->country_id = $_POST['country_id'];
    $SVC->visa_category = $_POST['visa_category'];

    $res = $SVC->update();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}

// Delete Student Visa Country
if (isset($_POST['delete']) && isset($_POST['id'])) {

    $SVC = new StudentCountryVisa($_POST['id']);
    $res = $SVC->delete();

    if ($res) {
        echo json_encode(["status" => 'success']);
    } else {
        echo json_encode(["status" => 'error']);
    }
    exit();
}


if (isset($_GET['country_id']) && !empty($_GET['country_id'])) {
    $countryId = (int)$_GET['country_id'];
    $visaCategories = new StudentCountryVisa(NULL);
    $categories = $visaCategories->getByCountry($countryId);

    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'data' => $categories]);
    exit();
}
