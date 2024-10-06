<?php

    include "../Classes/User.php";
    include_once('../classes/Connect.php'); 

    // Specify the path to your log file
    $log_file = '../logs/error_log.txt';
    
    // Function to handle user authentication
    function handleUserAuthentication($conn, $log_file) {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Validate required fields
                if (empty($_POST['username']) || empty($_POST['password'])) {
                    throw new Exception("Username and password are required.");
                }
    
                $username = $_POST['username'];
                $password = $_POST['password'];
    
                // Prepare SQL statement to prevent SQL injection
                $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->bind_param("s", $username); // "s" indicates the type is string
                $stmt->execute();
                $result = $stmt->get_result();
    
                // Check if the user exists
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
    
                    // Verify the password
                    if (password_verify($password, $row['password'])) {
                        // Start the session if it's not already started
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
    
                        // Set session variables
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['user_name'] = ucwords($row['first_name']);
    
                        // Check if the user is an admin
                        if ($row['role'] == 'admin') {
                            $_SESSION['admin'] = true;
                            header("Location: ../Admin-WEB/product-list/");
                        } else {
                            $_SESSION['admin'] = false;
                            header("Location: ../pos/");
                        }
                        exit();
                    } else {
                        throw new Exception("Invalid password.");
                    }
                } else {
                    throw new Exception("User not found.");
                }
            }
        } catch (Exception $e) {
            // Log the error to the specified log file
            error_log("Error: " . $e->getMessage() . " | Date: " . date("Y-m-d H:i:s") . "\n", 3, $log_file);
    
            // Redirect to an error page or show an error message
            header("Location: ../?message=" . urlencode($e->getMessage()));
            exit();
        } finally {
            // Close the statement and the database connection
            if (isset($stmt)) {
                $stmt->close();
            }
            if (isset($conn)) {
                $conn->close();
            }
        }
    }
    
    // Main logic to handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Initialize database connection
        $db = new Database();
        $conn = $db->conn;
    
        // Handle user authentication
        handleUserAuthentication($conn, $log_file);
    }
    
    ?>
    