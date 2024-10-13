<?php
ob_start();  // Start output buffering
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Require the Order class
require_once '../Classes/Order.php'; 
$product = new Product;


// Check if the order ID exists in the session
if (!isset($_SESSION['order_id'])) {
    // No active order: gracefully handle the case
    echo "<div class='alert alert-warning'>No active order found.</div>";
    ob_end_flush();  // Flush the buffer and end output buffering
    return;  // Exit the script early if no order exists
}

$order_id = $_SESSION['order_id']; // Get the order ID from the session

try {
    // Create a new instance of the Order class
    $order = new Order();

    // Get the order details and total
    $order_details = $order->getOrderDetails($order_id);
    $order_total = $order->getOrderTotal($order_id);
    ?>
    <form action="../Actions/process-payment.php" method="POST" id="payment-form">
    <div class="product-wrap">
    <?php
    // Loop through each item in the order and render it
    foreach ($order_details as $item) {
       $SelectedProduct = $product->displaySpecificProduct($item['product_id']);

        ?>
        <div class="product-list d-flex align-items-center justify-content-between" id="product-<?= $item['product_id'] ?>">
            <!-- Hidden price input for each product -->
            <input type="hidden" name="price" id="hidden_price_<?= $item['product_id'] ?>" value="<?= $item['price'] ?>" />
            <input type="hidden" name="hidden_qty" id="hidden_qty_<?= $item['product_id'] ?>" value="<?= $SelectedProduct['quantity'] ?>" />
            <div class="d-flex align-items-center product-info">
                <div class="info">
                    <h6><a href="javascript:void(0);"><?= $item['product_name'] ?></a></h6>
                    <p>₱<?= number_format($item['price'], 2) ?></p>
                </div>
            </div>

            <!-- Quantity controls -->
            <div class="qty-item text-center"> 
                <input type="number" id="qty-<?= $item['product_id'] ?>" class="form-control text-center qty-input" name="qty[<?= $item['product_id'] ?>]" value="<?= $item['quantity'] ?>" data-product-id="<?= $item['product_id'] ?>" min="1" />
            </div>

            <div class="d-flex align-items-center action">
                <a class="btn-icon delete-icon" href="../Actions/remove-cart-product.php?item_id=<?= $item['id'] ?>" data-product-id="<?= $item['product_id'] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-14">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </a>
            </div>
        </div>
        <?php
    }
    ?>
    </div>
    
    <!-- Display the total order amount separately -->
   
    <?php include "modal/proccess-payment.php"; ?>
    <script>
        document.getElementById('total-order-amount-modal').value =  <?= $order_total; ?>
    </script>
    </form>
     <div class="d-grid btn-block">
        <div class="btn btn-secondary" id="total-order-amount">
            Total Order Amount: ₱<?= number_format($order_total, 2); ?>
        </div>
    </div>
    <?php

} catch (Exception $e) {
    // Handle any errors related to fetching the order
    ?>
        <?php echo $e->getMessage(); ?>
    <?php
}
ob_end_flush();  // Flush the output buffer at the end
?>
