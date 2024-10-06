<?php
include_once '../../Classes/Connect.php';
include_once '../../Actions/cashier_total_sales.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cashier and Admin Details</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Cashier and Admin sales Details</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Total sales</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>" . $row['total_completed_orders'] . "</td>";
                        echo "<td><a href='daily_cashier.php?cashier_id=" . $row['id'] . "' class='btn btn-info'>Details</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No cashiers or admins found</td></tr>";
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