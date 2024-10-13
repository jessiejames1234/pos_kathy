<?php
include "../../../Classes/display_product_info.php";
include "../includes/header.php"; 
?>

<style> 
    .table-out-of-stock {
        background-color: #ff8161;
        color: #410e13;
        font-weight: bold;
        font-size: 15px;
    }
    .table-low-of-stock {
        background-color: #fff673;
        color: #410e13;
        font-weight: bold;
        font-size: 15px;
    }

</style>


<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-4">Product Inventory</h2>        
        <a href=".." style=" text-decoration: none; color: black; background-color: red; padding: 0px 10px; font-size: 1.5em; font-weight: bold; border-radius: 5px; display: inline-block; cursor: pointer;">&times;</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Displaying Products
            if ($productResult->num_rows > 0) {
                while ($row = $productResult->fetch_assoc()) {
                    $status = 'On Stock';
                    if ($row['quantity'] == 0) {
                        $status = 'Out of Stock';
                    } elseif ($row['quantity'] < 10) { // Assuming less than 10 is low stock
                        $status = 'Low of Stock';
                    }

                    // Apply red background if out of stock
                    $rowClass = ($status == 'Out of Stock') ? 'table-out-of-stock' : (($status == 'Low of Stock') ? 'table-low-of-stock' : '');

                    echo "<tr class='$rowClass'>
                            <td>{$row['product_name']}</td>
                            <td>{$row['quantity']}</td>
                            <td>{$status}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No products found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2 class="mt-5 mb-4">Best Selling Products</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Total Items Sold</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Displaying Best Selling Products
            if ($bestProductResult->num_rows > 0) {
                while ($row = $bestProductResult->fetch_assoc()) {
                    // Display total items sold, ensuring it shows 0 if no items sold
                    echo "<tr>
                            <td>{$row['product_name']}</td>
                            <td>{$row['total_sold']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No best-selling products found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>