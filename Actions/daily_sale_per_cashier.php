<?php

// Include your database class
$database = new Database();
$conn = $database->conn;

// Get cashier ID from URL
$cashier_id = isset($_GET['cashier_id']) ? (int)$_GET['cashier_id'] : 0;

// Initialize variables for date selection or range
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

// Initialize the date range for filtering orders
$date_start = $date_end = "";

// Check if a range button was clicked
if (isset($_POST['range'])) {
    switch ($_POST['range']) {
        case 'today':
            $date_start = $date_end = date('Y-m-d');
            break;
        case 'last_day':
            $date_start = $date_end = date('Y-m-d', strtotime('-1 day'));
            break;
        case 'this_week':
            $date_start = date('Y-m-d', strtotime('monday this week'));
            $date_end = date('Y-m-d', strtotime('sunday this week'));
            break;
        case 'last_week':
            $date_start = date('Y-m-d', strtotime('monday last week'));
            $date_end = date('Y-m-d', strtotime('sunday last week'));
            break;
        case 'this_month':
            $date_start = date('Y-m-01');
            $date_end = date('Y-m-t');
            break;
        case 'last_month':
            $date_start = date('Y-m-01', strtotime('first day of last month'));
            $date_end = date('Y-m-t', strtotime('last day of last month'));
            break;
    }
} else {
    // Use selected date if no range is chosen
    $date_start = $selected_date;
    $date_end = $selected_date;
}

// SQL query to get completed orders for the selected range or date
$sql = "
    SELECT * FROM orders 
    WHERE user_id = ? AND DATE(date) BETWEEN ? AND ? AND status = 'completed'
"; // Adjust 'date' to your actual date column in the orders table

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $cashier_id, $date_start, $date_end);
$stmt->execute();
$result = $stmt->get_result();

// Close the connection when done
$stmt->close();