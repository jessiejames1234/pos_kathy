<?php
require_once '../Classes/Order.php';
require_once '../Classes/Product.php';
session_start();

header('Content-Type: application/json');  // Ensure the response is JSON

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_SESSION['order_id']) && isset($_POST['total']) && isset($_POST['payment'])) {
            $order_id = $_SESSION['order_id'];
            $total = floatval($_POST['total']);
            $payment = floatval($_POST['payment']);

            if ($payment < $total) {
                throw new Exception("Payment amount is less than the total order amount.");
            }

            // Create instances of Order and Product classes
            $order = new Order();
            $product = new Product(); 
            // Loop through each product in the order and deduct its quantity from the form data
            if (isset($_POST['qty']) && is_array($_POST['qty'])) {
                foreach ($_POST['qty'] as $product_id => $new_quantity) {
                    // Make sure the quantity is an integer and valid 
                    $new_quantity = intval($new_quantity);
                    if ($new_quantity < 1) {
                        throw new Exception("Invalid quantity for product ID $product_id.");
                    }

                    // Get current product details from the database
                    $product_details = $product->displaySpecificProduct($product_id);
                    if (!$product_details) {
                        throw new Exception("Product with ID $product_id not found.");
                    }

                    $current_stock = $product_details['quantity'];
                    $new_stock = $current_stock - $new_quantity;

                    if ($new_stock < 0) {
                        throw new Exception("Insufficient stock for product ID $product_id.");
                    } 
                    // Update the product stock in the database
                    if (!$product->updateProductQuantity($product_id, $new_stock)) {
                        throw new Exception("Failed to update product stock for product ID $product_id.");
                    }

                    // Optionally update the quantity of the product in the order itself, if needed
                    //$order->updateProductQuantity($product_id, $new_quantity);
                }
            } else {
                throw new Exception("No product quantities were submitted.");
            }

            // If all stock updates are successful, update the order status
            if ($order->updateOrderStatus($order_id, 'completed')) {
                // Clear the session order_id after success
                unset($_SESSION['order_id']);

                // Redirect to success page
                header("location: ../pos/?success=1");
                exit;
            } else {
                throw new Exception("Failed to update order status.");
            }
        } else {
            throw new Exception("Invalid request. Missing order or payment data.");
        }
    } else {
        throw new Exception("Invalid request method.");
    }
} catch (Exception $e) {
    // Redirect to error page with the error message
    header("location: ../pos/?error=" . urlencode($e->getMessage()));
    exit();
}
