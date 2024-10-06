<?php
include_once '../../Classes/Connect.php';

$database = new Database();
$conn = $database->conn;

// Get daily sales
$dailyQuery = "SELECT SUM(total) as daily_total FROM orders WHERE DATE(date) = CURDATE() AND status = 'completed'";
$dailyResult = $conn->query($dailyQuery);
$dailySales = $dailyResult->fetch_assoc()['daily_total'];

// Get weekly sales
$weeklyQuery = "SELECT SUM(total) as weekly_total FROM orders 
WHERE date >= CURDATE() - INTERVAL WEEKDAY(CURDATE()) DAY 
AND date < CURDATE() + INTERVAL 1 DAY 
AND status = 'completed'";
$weeklyResult = $conn->query($weeklyQuery);
$weeklySales = $weeklyResult->fetch_assoc()['weekly_total'];

// Get monthly sales
$monthlyQuery = "SELECT SUM(total) as monthly_total FROM orders WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())";
$monthlyResult = $conn->query($monthlyQuery);
$monthlySales = $monthlyResult->fetch_assoc()['monthly_total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Sales</title>
    <!-- Bootstrap 5.1.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Sales Summary</h2>
    <div class="row justify-content-center">
        <!-- Daily Sales -->
        <div class="col-md-4 mb-3">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h4 class="card-title">Today's Sales</h4>
                    <p class="card-text">₱ <?php echo number_format($dailySales, 2); ?></p>
                </div>
            </div>
        </div>

        <!-- Weekly Sales -->
        <div class="col-md-4 mb-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h4 class="card-title">This Week's Sales</h4>
                    <p class="card-text">₱ <?php echo number_format($weeklySales, 2); ?></p>
                </div>
            </div>
        </div>

        <!-- Monthly Sales -->
        <div class="col-md-4 mb-3">
            <div class="card text-center bg-warning text-white">
                <div class="card-body">
                    <h4 class="card-title">This Month's Sales</h4>
                    <p class="card-text">₱ <?php echo number_format($monthlySales, 2); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="../dashboard/" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>