<?php
require_once '../Classes/Order.php';
session_start();

if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];

    try {
        // Create a new instance of the Order class
        $order = new Order();

        // Fetch the total order amount from the database
        $order_total = $order->getOrderTotal($order_id);

        // Return the total as a JSON response
        echo json_encode(['success' => true, 'total' => $order_total]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No active order found.']);
}
?>
