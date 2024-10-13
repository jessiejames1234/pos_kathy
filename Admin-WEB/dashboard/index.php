<?php 
    include "../includes/header.php"; 
    include_once '../../Classes/Connect.php';

    // Initialize the database connection
    $database = new Database();
    $conn = $database->conn;
    
    // Initialize $dailySalesTotal to prevent the warning
    $SalesTotal = 0;
    
    // Query to get the total sales for orders
    $dailyQuery = "SELECT COUNT(*) as daily_total FROM orders WHERE status = 'completed'";
    $result = $conn->query($dailyQuery);
    
    // If a result is found, update $dailySalesTotal
    if ($result && $row = $result->fetch_assoc()) {
        $SalesTotal = $row['daily_total'] ?? 0;
    }

    $sql = "SELECT COUNT(*) AS total_users FROM users";
    $result = $conn->query($sql);
    
    $totalUsers = 0; // Initialize variable for total users
    
    if ($result) {
        $row = $result->fetch_assoc();
        $totalUsers = $row['total_users']; // Get the count of users
    }
    
    // Close the connection
    $countQuery = "SELECT COUNT(*) AS total_products FROM products";
    $countResult = $conn->query($countQuery);
    
    // Initialize variable for total products
    $totalProducts = 0; 
    
    if ($countResult) {
        $row = $countResult->fetch_assoc();
        $totalProducts = $row['total_products']; // Get the count of products
    }
    
    // Close the connection
    $conn->close();
    ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Dashboard</h2>
    <div class="row d-flex justify-content-center">
        <!-- Total Sales -->
        <div class="col-md-3 mb-4">
            <div class="p-4 bg-info text-center box" onclick="window.location.href='Total_sales/'">
                <h3 class="text-dark">Total Sales</h3>
                <p class="text-dark font-weight-bold" style="font-size: 1.5em;"><?php echo $SalesTotal; ?></p>
            </div>
        </div>

        <!-- Total Cashier -->
        <div class="col-md-3 mb-4">
            <div class="p-4 bg-success text-center box" onclick="window.location.href='Total_cashier/'">
                <h3 class="text-dark">Total Cashier</h3>
                <p class="text-dark font-weight-bold" style="font-size: 1.5em;"><?php echo $totalUsers; ?></p>
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-3 mb-4">
            <div class="p-4 bg-warning text-center box" onclick="window.location.href='Products_history/'">
                <h3 class="text-dark">Total Products</h3>
                <p class="text-dark font-weight-bold" style="font-size: 1.5em;"><?php echo $totalProducts; ?></p> <!-- Dynamic product count -->
            </div>
        </div>
    </div>
</div>


<style>
    .box {
        cursor: pointer;
        border-radius: 10px;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        height: 200px; /* Fixed height for uniformity */
    }

    .box:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    h2 {
        font-family: Arial, sans-serif;
        font-weight: bold;
        color: #333;
    }

    .text-dark {
        color: #212529 !important;
    }

    .container {
        background-color: #f8f9fa; /* Light background for the container */
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
