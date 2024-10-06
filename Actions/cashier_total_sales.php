<?php
$database = new Database();
$conn = $database->conn;

// SQL query to get cashier and admin names and their total completed orders
$sql = "
    SELECT u.id, CONCAT(u.first_name, ' ', u.last_name) AS full_name, 
           COUNT(CASE WHEN o.status = 'completed' THEN o.id END) AS total_completed_orders
    FROM users u
    LEFT JOIN orders o ON u.id = o.user_id  -- Ensure this matches your foreign key
    WHERE u.role IN ('staff', 'admin')  -- Include both 'staff' and 'admin' roles
    GROUP BY u.id
";

$result = $conn->query($sql);