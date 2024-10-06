<?php
require_once '../Classes/Order.php';
session_start();

if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id']; // Get the order ID from the session

    // Create a new instance of the Order class
    $order = new Order();

    // Get the number of distinct products in the order
    $product_count = $order->getDistinctProductCount($order_id);

    if ($product_count !== false) {
        echo json_encode(['success' => true, 'product_count' => $product_count]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch product count']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid order ID']);
}
