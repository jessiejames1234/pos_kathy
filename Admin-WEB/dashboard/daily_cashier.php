<?php
include_once '../../Classes/Connect.php';
include_once '../../Actions/daily_sale_per_cashier.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Daily Cashier Orders</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Orders for Cashier ID: <?php echo htmlspecialchars($cashier_id); ?> (<?php echo $cashier_name; ?>)</h2>

        <!-- HTML form for date selection -->
        <form method="POST" action="">
            <input type="date" name="selected_date" value="<?php echo $selected_date; ?>" required>
            <input type="submit" value="Show Orders" class="btn btn-primary">
        </form>

        <!-- HTML code to display orders for the selected date -->
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['total']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>"; // Ensure this is the correct date column
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No completed orders found for this date</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>