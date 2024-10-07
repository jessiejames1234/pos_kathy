<?php
include_once '../../../Classes/Connect.php';
include_once '../../../Actions/cashier_total_sales.php';
include "../includes/header.php"; 
?>





<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Cashier Sales Details</h2>
            <a href=".." style=" text-decoration: none; color: black; background-color: red; padding: 0px 10px; font-size: 1.5em; font-weight: bold; border-radius: 5px; display: inline-block; cursor: pointer;">&times;</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Total Sales</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['total_completed_orders']) . "</td>";
                        echo "<td><a href='daily_cashier.php?cashier_id=" . htmlspecialchars($row['id']) . "' class='btn btn-info'>Details</a></td>";
                        echo "</tr>";
                        
                    }
                } else {
                    echo "<tr><td colspan='3'>No cashiers or admins found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
// Close the connection
$conn->close();
?>