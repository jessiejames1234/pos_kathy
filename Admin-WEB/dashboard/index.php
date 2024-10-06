<?php 
    include "../includes/header.php"; 
    include_once '../../Classes/Connect.php';

    // Initialize the database connection
    $database = new Database();
    $conn = $database->conn;
    
    // Initialize $dailySalesTotal to prevent the warning
    $dailySalesTotal = 0;
    
    // Query to get the total sales for today
    $dailyQuery = "SELECT SUM(total) as daily_total FROM orders WHERE DATE(date) = CURDATE()";
    $result = $conn->query($dailyQuery);
    
    // If a result is found, update $dailySalesTotal
    if ($result && $row = $result->fetch_assoc()) {
        $dailySalesTotal = $row['daily_total'] ?? 0;
    }

    $sql = "SELECT COUNT(*) AS total_users FROM users";
    $result = $conn->query($sql);
    
    $totalUsers = 0; // Initialize variable for total users
    
    if ($result) {
        $row = $result->fetch_assoc();
        $totalUsers = $row['total_users']; // Get the count of users
    }
    
    // Close the connection
    $conn->close();
    ?>
<div class="container mt-5">
    <div class="row d-flex justify-content-around">
        <!-- Total Sales -->
        <div class="col-md-3 p-3 bg-info text-center box " onclick="window.location.href='total_sales.php'" style="height: 200px; border-radius: 8px;">
            <h3 style="color: black;">Total Sales</h3>
            <p class="card-text f" style="color: black; font-weight: bold; font-size: 1.5em;">₱ <?php echo number_format($dailySalesTotal, 2); ?></p>
        </div>
        
        <!-- Total Cashier -->
        <div class="col-md-3 p-3 bg-success text-center box" onclick="window.location.href='cashier_details.php'" style="height: 200px; border-radius: 8px;">
            <h3 style="color: black;">Total Cashier</h3>
            <p style="color: black; font-weight: bold; font-size: 1.5em;"><?php echo $totalUsers; ?></p>
        </div>
        
        <!-- Products -->
        <div class="col-md-3 p-3 bg-warning text-center box" style="height: 200px; border-radius: 8px;">
            <h3 style="color: black;">Products</h3>
            <p style="color: black;  font-weight: bold; font-size: 1.5em;">0</p> <!-- Replace 0 with dynamic data -->
        </div>
    </div>
</div>

<style>
    .box {
        cursor: pointer;
        border-radius: 10px;
        transition: transform 0.2s;
    }

    .box:hover {
        transform: scale(1.05);
    }
</style>