<?php
require_once '../Classes/Order.php';
session_start();

if (isset($_SESSION['order_id']) && isset($_GET['item_id'])) {
    $order_id = $_SESSION['order_id'];
    $item_id = intval($_GET['item_id']);

    // Create a new instance of the Order class
    $order = new Order();

    // Remove the product from the order
    if ($order->removeProductFromOrder($item_id)) {
        // Recalculate the total after the product is removed
        //$new_total = $order->getOrderTotal($order_id);
        //echo json_encode(['success' => true, 'new_total' => $new_total]);
        header("location: ../pos/?success=1");
    } else {
        //echo json_encode(['success' => false, 'message' => 'Failed to remove product']);
        header("location: ../pos/?error=Failed to remove product");
    }
} else {
    //echo json_encode(['success' => false, 'message' => 'Invalid request']);
    header("location: ../pos/?error=Invalid request");
}
