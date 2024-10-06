<?php

// Include your database class
$database = new Database();
$conn = $database->conn;

// Get cashier ID from URL
$cashier_id = isset($_GET['cashier_id']) ? (int)$_GET['cashier_id'] : 0;

// Initialize variables for date selection
$selected_date = isset($_POST['selected_date']) ? $_POST['selected_date'] : date('Y-m-d');

// SQL query to get the cashier's name
$cashier_name = "";
if ($cashier_id > 0) {
    $cashier_sql = "SELECT first_name, last_name FROM users WHERE id = ?";
    $stmt = $conn->prepare($cashier_sql);
    $stmt->bind_param("i", $cashier_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name);
    $stmt->fetch();
    $stmt->close();
    $cashier_name = htmlspecialchars($first_name . ' ' . $last_name);
}

// SQL query to get completed orders for the selected date
$sql = "
    SELECT * FROM orders 
    WHERE user_id = ? AND DATE(date) = ? AND status = 'completed'
"; // Adjust 'date' to your actual date column in the orders table

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $cashier_id, $selected_date);
$stmt->execute();
$result = $stmt->get_result();
