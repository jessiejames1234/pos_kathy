<?php
require_once '../Classes/Connect.php'; // Assuming this handles the DB connection
require_once '../Classes/User.php';    // Make sure User class is included
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Trim input to prevent whitespace issues
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Check if all fields are filled
    if (!empty($first_name) && !empty($last_name) && !empty($username) && !empty($password) && !empty($role)) {
        // Hash the password securely using password_hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Create a new instance of User class
            $user = new User();
            
            // Insert the new user into the database
            if ($user->addUser($first_name, $last_name, $username, $hashed_password, $role)) {
                // Redirect to the user list page with success message
                header("Location: ../Admin-WEB/users?success=1");
                exit();
            } else {
                // Redirect to the user list page with an error message
                header("Location: ../Admin-WEB/users?error=Could not add user");
                exit();
            }
        } catch (Exception $e) {
            // Handle exception and redirect with an error message
            header("Location: ../Admin-WEB/users?error=" . urlencode($e->getMessage()));
            exit();
        }
    } else {
        // Redirect if any field is empty
        header("Location: ../Admin-WEB/users?error=All fields are required");
        exit();
    }
} else {
    // If not a POST request, redirect to user list
    header("Location: ../Admin-WEB/users");
    exit();
}