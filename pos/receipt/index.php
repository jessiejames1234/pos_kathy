<?php
// Include necessary files
include_once '../../Classes/Connect.php';
include_once '../../Classes/receipt-detail.php';

// Initialize the database connection
$database = new Database();
$conn = $database->conn;

$orderID = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 1;

// Fetch order details
$order = getOrderDetails($conn, $orderID);

if ($order === null) {
    die("Order not found.");
}

// Fetch the order items
$itemsResult = getOrderItems($conn, $orderID);

// Initialize subtotal
$subtotal = 0;
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <!-- Bootstrap 5.1.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Receipt.css" rel="stylesheet">

    <style>

    </style>
</head>
<body>

<div class="main container bordered-container">
    <!-- Logo -->
    <div class="text-center mb-3">
        <img src="../../image/LOGO.PNG" alt="Logo" class="img-fluid" style="max-height: 80px;">
    </div>

    <!-- Bill details -->
    <table class="table table-borderless table-sm">
        <tbody>
            <tr>
                <td>Cashier: <span><?php echo $order['first_name'] ; ?></span></td>
                <td class="text-end">Order ID: <span><?php echo $order['order_id']; ?></span></td>
            </tr>
            <tr>
                <td>Date: <span><?php echo date("Y-m-d", strtotime($order['date'])); ?></span></td>
                <td class="text-end">Time: <span><?php echo date("H:i:s", strtotime($order['date'])); ?></span></td>
            </tr>
        </tbody>
    </table>

    <!-- Items list -->
    <table class="table table-borderless table-sm items">
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-center">Qty</th>
                <th class="text-end">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $itemsResult->fetch_assoc()) { 
                $itemTotal = $item['price'] * $item['quantity'];
                $subtotal += $itemTotal;
            ?>
            <tr>
                <td><?php echo $item['product_name']; ?></td>
                <td class="text-center"><?php echo $item['quantity']; ?></td>
                <td class="text-end"><?php echo number_format($itemTotal, 2); ?></td>
            </tr>
            <?php } ?>
            <tr class="total-row">
                <td colspan="2" class="text-end">Subtotal</td>
                <td class="text-end"><?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="text-end">Paid</td>
                <td class="text-end"><?php echo number_format($order['total'], 2); ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="2" class="text-end">Change</td>
                <td class="text-end"><?php echo number_format($order['total'] - $subtotal, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Payment method and thank you note -->
    <div class="text-center mt-4">
        <p>Thank you for your visit!</p>
    </div>

    <!-- Footer -->
    <div class="text-center footer-text">
        <p>Kathy Bakeshop</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>