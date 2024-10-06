<?php
// edit-user.php

// Include database connection file
require_once '../Classes/Connect.php';
session_start();
$db = new Database();
$conn = $db->conn;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user data from the form
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Prepare SQL update statement
    $sql = "UPDATE users SET first_name = ?, last_name = ?, username = ?, role = ? WHERE id = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ssssi", $first_name, $last_name, $username, $role, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to a success page or show a success message
            header("Location: ../Admin-WEB/users?success=1");
            exit();
        } else {
            // Handle error (e.g., log it, show an error message)
            echo "Error: Could not execute the query. Please try again later.";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle error (e.g., log it, show an error message)
        echo "Error: Could not prepare the query. Please try again later.";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the request method is not POST, redirect or show an error
    header("Location: ../../error.php?message=Invalid request.");
    exit();
}
?>