<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');


//create course type
// Get user details
if (isset($_POST['get_user']) && !empty($_POST['id'])) {
    $user = new User($_POST['id']);
    if ($user) {
        $response = [
            'status' => 'success',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'type' => $user->type,
                'staff_user_id' => $user->staff_user_id,
                'agent_user_id' => $user->agent_user_id,
                'isActive' => $user->isActive
            ]
        ];
    } else {
        $response = ['status' => 'error', 'message' => 'User not found'];
    }
    echo json_encode($response);
    exit();
}

// Create new user
if (isset($_POST['create'])) {
    $staff_id = null;
    $agent_id = null;
    
    // Set the appropriate ID based on user type
    if ($_POST['type'] == 2) {
        $staff_id = $_POST['staff_id'];
    } elseif ($_POST['type'] == 3) {
        $agent_id = $_POST['agent_id'];
    }

    $USER = new User(NULL);
    $result = $USER->create(
        $_POST['type'], 
        $staff_id,  
        $agent_id, 
        $_POST['username'], 
        $_POST['password']
    );

    if ($result) {
        $response = ["status" => 'success', 'message' => 'User created successfully'];
    } else {
        $response = ["status" => 'error', 'message' => 'Failed to create user'];
    }
    
    echo json_encode($response);
    exit();
}

// Update existing user
if (isset($_POST['update']) && !empty($_POST['id'])) {
    $user = new User($_POST['id']);
    
    if ($user) {
        // Update user properties
        $user->username = $_POST['username'];
        $user->type = $_POST['type'];
        $user->isActive = $_POST['isActive'];
        
        // Handle staff/agent IDs based on user type
        if ($_POST['type'] == 2) {
            $user->staff_user_id = !empty($_POST['staff_user_id']) ? $_POST['staff_user_id'] : null;
            $user->agent_user_id = null;
        } elseif ($_POST['type'] == 3) {
            $user->agent_user_id = !empty($_POST['agent_user_id']) ? $_POST['agent_user_id'] : null;
            $user->staff_user_id = null;
        } else {
            $user->staff_user_id = null;
            $user->agent_user_id = null;
        }
        
        // Save changes
        $result = $user->update();
        
        if ($result) {
            $response = ['status' => 'success', 'message' => 'User updated successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to update user'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'User not found'];
    }
    
    echo json_encode($response);
    exit();
}

// Delete user
if (isset($_POST['delete']) && !empty($_POST['id'])) {
    $user = new User($_POST['id']);
    
    if ($user) {
        // You might want to add additional checks here, e.g., prevent deleting the currently logged-in user
        
        // Delete the user
        $query = "DELETE FROM `user` WHERE `id` = " . $user->id;
        $db = new Database();
        $result = $db->readQuery($query);
        
        if ($result) {
            $response = ['status' => 'success', 'message' => 'User deleted successfully'];
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to delete user'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'User not found'];
    }
    
    echo json_encode($response);
    exit();
}

//update course type
if (isset($_POST['update'])) {

    $USER = new User($_POST['id']);
 
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//update password

if (isset($_POST['change_password'])) {
    $USER = new User(NULL);
    $id = $_POST["id"];
    $password = $_POST["password"];


    if ($password != NULL) {

        $USER->updatePasswordAdmin($password, $id);
        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }
}
