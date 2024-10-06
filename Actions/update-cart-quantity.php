<?php
require_once '../Classes/Order.php';
session_start();

if (isset($_SESSION['order_id']) && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $order_id = $_SESSION['order_id'];
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Create a new instance of the Order class
    $order = new Order();

    // Update the product quantity in the order
    if ($order->updateOrderQuantity($order_id, $product_id, $quantity)) {
        // Recalculate the total after the update
        $new_total = $order->getOrderTotal($order_id);
        echo json_encode(['success' => true, 'new_total' => $new_total]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
