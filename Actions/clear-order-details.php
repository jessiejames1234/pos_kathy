<?php
require_once '../Classes/Order.php';
session_start();

if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id']; // Get the order ID from the session

    // Create a new instance of the Order class
    $order = new Order();

    // Clear all items from order_details where order_id matches
    if ($order->clearOrderDetails($order_id)) {
        header("location: ../pos/?success=1");
        //echo json_encode(['success' => true]);
    } else {
        //echo json_encode(['success' => false, 'message' => 'Failed to clear order details']);
        header("location: ../pos/?error=Failed to clear order details");
    }
} else {
    //echo json_encode(['success' => false, 'message' => 'Invalid order ID']);
    header("location: ../pos/?error=Invalid order ID");
}
