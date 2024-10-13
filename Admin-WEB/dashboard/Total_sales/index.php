<?php
include "../includes/header.php"; 
include "../../../Classes/Connect.php"; // Assuming you have a database connection here

// Instantiate the database connection
$database = new Database();
$db = $database->conn;  // Access the 'conn' property directly

// Function to get sales data based on date range
function getSalesData($startDate, $endDate, $db) {
    $query = "SELECT COUNT(*) as sales_count, SUM(total) as net_revenue 
              FROM orders 
              WHERE status = 'completed' AND date BETWEEN ? AND ?";

    $stmt = $db->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ss", $startDate, $endDate);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Get today's date and yesterday's date
$today_start = date('Y-m-d 00:00:00');
$today_end = date('Y-m-d 23:59:59');
$yesterday_start = date('Y-m-d 00:00:00', strtotime('-1 day'));
$yesterday_end = date('Y-m-d 23:59:59', strtotime('-1 day'));
$startOfWeek = date('Y-m-d 00:00:00', strtotime('monday this week'));
$endOfWeek = date('Y-m-d 23:59:59', strtotime('sunday this week'));
$startOfLastWeek = date('Y-m-d 00:00:00', strtotime('monday last week'));
$endOfLastWeek = date('Y-m-d 23:59:59', strtotime('sunday last week'));
$startOfMonth = date('Y-m-01 00:00:00');
$endOfMonth = date('Y-m-t 23:59:59');
$startOfLastMonth = date('Y-m-01 00:00:00', strtotime('first day of last month'));
$endOfLastMonth = date('Y-m-t 23:59:59', strtotime('last day of last month'));

// Get sales data for various periods
$today_sales = getSalesData($today_start, $today_end, $db);
$yesterday_sales = getSalesData($yesterday_start, $yesterday_end, $db);
$this_week_sales = getSalesData($startOfWeek, $endOfWeek, $db);
$last_week_sales = getSalesData($startOfLastWeek, $endOfLastWeek, $db);
$this_month_sales = getSalesData($startOfMonth, $endOfMonth, $db);
$last_month_sales = getSalesData($startOfLastMonth, $endOfLastMonth, $db);

// Function to calculate percentage change
function calculatePercentageChange($current, $previous) {
    if ($previous == 0) return 0; // avoid division by zero
    $change = (($current - $previous) / $previous) * 100;
    return $change; // return the actual percentage change
}

// Calculate percentage changes
$today_vs_yesterday_change = calculatePercentageChange($today_sales['net_revenue'], $yesterday_sales['net_revenue']);
$this_week_vs_last_week_change = calculatePercentageChange($this_week_sales['net_revenue'], $last_week_sales['net_revenue']);
$this_month_vs_last_month_change = calculatePercentageChange($this_month_sales['net_revenue'], $last_month_sales['net_revenue']);

$today_change_color = $today_vs_yesterday_change == 0 ? 'gray' : ($today_vs_yesterday_change < 0 ? 'red' : 'green');
$week_change_color = $this_week_vs_last_week_change == 0 ? 'gray' : ($this_week_vs_last_week_change < 0 ? 'red' : 'green');
$month_change_color = $this_month_vs_last_month_change == 0 ? 'gray' : ($this_month_vs_last_month_change < 0 ? 'red' : 'green');
?>

<style>
    canvas {
        max-height: 200px; /* Set a max height for the chart */
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-center">Sales Report</h2>
        <a href=".." style=" text-decoration: none; color: black; background-color: red; padding: 0px 10px; font-size: 1.5em; font-weight: bold; border-radius: 5px; display: inline-block; cursor: pointer;">&times;</a>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="border p-3 mb-4">
                <h3>Today's Sales</h3>
                <div class="mb-2">
                    <p>Number of Sales: <strong><?php echo $today_sales['sales_count'] ?? 0; ?></strong></p>
                </div>
                <div class="mb-2 row">
                    <div class="col-6">
                        <p>Net Revenue: <strong>₱<?php echo number_format($today_sales['net_revenue'] ??  0.00, 2); ?></strong></p>
                    </div>
                    <div class="col-6">
                        <p>Change from Yesterday: <strong style="color: <?php echo $today_change_color; ?>;">
                            <?php 
                            $yesterday_revenue = $yesterday_sales['net_revenue'] ?? 0;
                            $today_revenue = $today_sales['net_revenue'] ?? 0;
                            $change_today = $yesterday_revenue ? (($today_revenue - $yesterday_revenue) / $yesterday_revenue) * 100 : 0;
                            echo number_format($change_today, 2) . '%';
                            ?>
                        </strong></p>
                    </div>
                </div>
                <canvas id="todaySalesChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="border p-3 mb-4">
                <h3>Yesterday's Sales</h3>
                <div class="mb-2">
                    <p>Number of Sales: <strong><?php echo $yesterday_sales['sales_count'] ?? 0; ?></strong></p>
                </div>
                <div class="mb-2">
                    <p>Net Revenue: <strong>₱<?php echo number_format($yesterday_sales['net_revenue'] ?? 0.00, 2); ?></strong></p>
                </div>
                <canvas id="yesterdaySalesChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="border p-3 mb-4">
                <h3>This Week's Sales</h3>
                <div class="mb-2">
                    <p>Number of Sales: <strong><?php echo $this_week_sales['sales_count'] ?? 0; ?></strong></p>
                </div>
                <div class="mb-2 row">
                    <div class="col-6">
                        <p>Net Revenue: <strong>₱<?php echo number_format($this_week_sales['net_revenue'] ?? 0.00, 2); ?></strong></p>
                    </div>
                    <div class="col-6">
                        <p>Change from Last Week: <strong style="color: <?php echo $week_change_color; ?>;">
                            <?php 
                            $last_week_revenue = $last_week_sales['net_revenue'] ?? 0;
                            $this_week_revenue = $this_week_sales['net_revenue'] ?? 0;
                            $change_week = $last_week_revenue ? (($this_week_revenue - $last_week_revenue) / $last_week_revenue) * 100 : 0;
                            echo number_format($change_week, 2) . '%';
                            ?>
                        </strong></p>
                    </div>
                </div>
                <canvas id="thisWeekSalesChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="border p-3 mb-4">
                <h3>Last Week's Sales</h3>
                <div class="mb-2">
                    <p>Number of Sales: <strong><?php echo $last_week_sales['sales_count'] ?? 0; ?></strong></p>
                </div>
                <div class="mb-2">
                    <p>Net Revenue: <strong>₱<?php echo number_format($last_week_sales['net_revenue'] ?? 0.00, 2); ?></strong></p>
                </div>
                <canvas id="lastWeekSalesChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="border p-3 mb-4">
                <h3>This Month's Sales</h3>
                <div class="mb-2">
                    <p>Number of Sales: <strong><?php echo $this_month_sales['sales_count'] ?? 0; ?></strong></p>
                </div>
                <div class="mb-2 row">
                    <div class="col-6">
                        <p>Net Revenue: <strong>₱<?php echo number_format($this_month_sales['net_revenue'] ?? 0.00, 2); ?></strong></p>
                    </div>
                    <div class="col-6">
                        <p>Change from Last Month: <strong style="color: <?php echo $month_change_color; ?>;">
                            <?php 
                            $last_month_revenue = $last_month_sales['net_revenue'] ?? 0;
                            $this_month_revenue = $this_month_sales['net_revenue'] ?? 0;
                            $change_month = $last_month_revenue ? (($this_month_revenue - $last_month_revenue) / $last_month_revenue) * 100 : 0;
                            echo number_format($change_month, 2) . '%';
                            ?>
                        </strong></p>
                    </div>
                </div>
                <canvas id="thisMonthSalesChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="border p-3 mb-4">
                <h3>Last Month's Sales</h3>
                <div class="mb-2">
                    <p>Number of Sales: <strong><?php echo $last_month_sales['sales_count'] ?? 0; ?></strong></p>
                </div>
                <div class="mb-2">
                    <p>Net Revenue: <strong>₱<?php echo number_format($last_month_sales['net_revenue'] ?? 0.00, 2); ?></strong></p>
                </div>
                <canvas id="lastMonthSalesChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const todaySalesData = {
        labels: ['Sales', 'Revenue'],
        datasets: [{
            label: 'Today\'s Sales',
            data: [<?php echo $today_sales['sales_count'] ?? 0; ?>, <?php echo $today_sales['net_revenue'] ?? 0; ?>],
            backgroundColor: ['#007bff', '#28a745']
        }]
    };

    const ctxToday = document.getElementById('todaySalesChart').getContext('2d');
    new Chart(ctxToday, {
        type: 'bar',
        data: todaySalesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const yesterdaySalesData = {
        labels: ['Sales', 'Revenue'],
        datasets: [{
            label: 'Yesterday\'s Sales',
            data: [<?php echo $yesterday_sales['sales_count'] ?? 0; ?>, <?php echo $yesterday_sales['net_revenue'] ?? 0; ?>],
            backgroundColor: ['#007bff', '#28a745']
        }]
    };

    const ctxYesterday = document.getElementById('yesterdaySalesChart').getContext('2d');
    new Chart(ctxYesterday, {
        type: 'bar',
        data: yesterdaySalesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const thisWeekSalesData = {
        labels: ['Sales', 'Revenue'],
        datasets: [{
            label: 'This Week\'s Sales',
            data: [<?php echo $this_week_sales['sales_count'] ?? 0; ?>, <?php echo $this_week_sales['net_revenue'] ?? 0; ?>],
            backgroundColor: ['#007bff', '#28a745']
        }]
    };

    const ctxThisWeek = document.getElementById('thisWeekSalesChart').getContext('2d');
    new Chart(ctxThisWeek, {
        type: 'bar',
        data: thisWeekSalesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const lastWeekSalesData = {
        labels: ['Sales', 'Revenue'],
        datasets: [{
            label: 'Last Week\'s Sales',
            data: [<?php echo $last_week_sales['sales_count'] ?? 0; ?>, <?php echo $last_week_sales['net_revenue'] ?? 0; ?>],
            backgroundColor: ['#007bff', '#28a745']
        }]
    };

    const ctxLastWeek = document.getElementById('lastWeekSalesChart').getContext('2d');
    new Chart(ctxLastWeek, {
        type: 'bar',
        data: lastWeekSalesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const thisMonthSalesData = {
        labels: ['Sales', 'Revenue'],
        datasets: [{
            label: 'This Month\'s Sales',
            data: [<?php echo $this_month_sales['sales_count'] ?? 0; ?>, <?php echo $this_month_sales['net_revenue'] ?? 0; ?>],
            backgroundColor: ['#007bff', '#28a745']
        }]
    };

    const ctxThisMonth = document.getElementById('thisMonthSalesChart').getContext('2d');
    new Chart(ctxThisMonth, {
        type: 'bar',
data: thisMonthSalesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const lastMonthSalesData = {
        labels: ['Sales', 'Revenue'],
        datasets: [{
            label: 'Last Month\'s Sales',
            data: [<?php echo $last_month_sales['sales_count'] ?? 0; ?>, <?php echo $last_month_sales['net_revenue'] ?? 0; ?>],
            backgroundColor: ['#007bff', '#28a745']
        }]
    };

    const ctxLastMonth = document.getElementById('lastMonthSalesChart').getContext('2d');
    new Chart(ctxLastMonth, {
        type: 'bar',
        data: lastMonthSalesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>