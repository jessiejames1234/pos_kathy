<?php

require_once '../Classes/Order.php';
require_once '../Classes/Product.php';
session_start();

/**
 * Function to handle adding a product to the cart.
 *
 * @param int $user_id The ID of the logged-in user.
 * @param int $product_id The ID of the product to add to the cart.
 *
 * @throws Exception If there is any error during the process.
 */
function addToCart($user_id, $product_id) {
    // Create instances of Order and Product classes
    $order = new Order();
    $product = new Product();
    
    try {
        // Step 1: Retrieve product details (including price)
        $product_details = $product->displaySpecificProduct($product_id);
        if (!$product_details) {
            throw new Exception("Product not found.");
        }
        $product_price = $product_details['price'];

        // Step 2: Check if there is an existing order in the session
        if (isset($_SESSION['order_id'])) {
            $order_id = $_SESSION['order_id']; // Use the existing order ID
        } else {
            // If no order in session, create a new order with an initial total of 0
            $status = 'Pending';
            $total = 0.0; // The total will be updated after the product is added
            $order_id = $order->addOrder($user_id, $total, $status);

            if (!$order_id) {
                throw new Exception("Failed to create a new order.");
            }

            // Save the new order ID in the session
            $_SESSION['order_id'] = $order_id;
        }

        // Step 3: Check if the product is already in the order details
        $sql_check_product = "SELECT * FROM order_details WHERE order_id = ? AND product_id = ?";
        $stmt_check_product = $order->conn->prepare($sql_check_product);
        $stmt_check_product->bind_param('ii', $order_id, $product_id);
        $stmt_check_product->execute();
        $result_check_product = $stmt_check_product->get_result();

        if ($result_check_product->num_rows > 0) {
            // Step 4: If the product exists in the order, update the quantity
            $order_detail = $result_check_product->fetch_assoc();
            $new_quantity = $order_detail['quantity'] + 1; // Increment the quantity by 1

            $sql_update_quantity = "UPDATE order_details SET quantity = ? WHERE order_id = ? AND product_id = ?";
            $stmt_update_quantity = $order->conn->prepare($sql_update_quantity);
            $stmt_update_quantity->bind_param('iii', $new_quantity, $order_id, $product_id);
            if (!$stmt_update_quantity->execute()) {
                throw new Exception("Error updating product quantity: " . $stmt_update_quantity->error);
            }
        } else {
            // Step 5: If the product is not in the order, add it to the order details
            $quantity = 1; // Default quantity
            $order->addOrderDetails($order_id, $product_id, $quantity);
        }

        // Step 6: Calculate the total for the order based on product prices and quantities
        $sql_total = "SELECT SUM(od.quantity * p.price) AS total
                      FROM order_details od
                      JOIN products p ON od.product_id = p.id
                      WHERE od.order_id = ?";
        $stmt_total = $order->conn->prepare($sql_total);
        $stmt_total->bind_param('i', $order_id);
        $stmt_total->execute();
        $result_total = $stmt_total->get_result();
        $order_total = $result_total->fetch_assoc()['total'];

        // Step 7: Update the total in the orders table
        $sql_update_order = "UPDATE orders SET total = ? WHERE id = ?";
        $stmt_update_order = $order->conn->prepare($sql_update_order);
        $stmt_update_order->bind_param('di', $order_total, $order_id);
        if (!$stmt_update_order->execute()) {
            throw new Exception("Error updating order total: " . $stmt_update_order->error);
        }

        // Redirect to the cart or success page after adding the product
        header("Location: ../pos/?success=1");
        exit;
    } catch (Exception $e) {
        // Log the error message for debugging purposes
        error_log("Error adding to cart: " . $e->getMessage());

        // Redirect to error page or show an error message
        header("Location: ../pos/?error=" . urlencode($e->getMessage()));
        exit;
    }
}

// Main logic to handle the cart addition
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Get the product ID from the URL
    if ($product_id > 0 && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Get user ID from the session
        addToCart($user_id, $product_id); // Call the addToCart function
    } else {
        // Redirect to an error page or handle invalid access
        header("Location: ../pos/?error=Invalid product or user.");
        exit;
    }
} else {
    // Redirect to the cart or home page if no product ID is provided
    header("Location: ../pos/?error=No product specified.");
    exit;
}
