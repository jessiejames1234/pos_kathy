<?php
// Fetch order details by order ID
function getOrderDetails($conn, $orderID) {
    $orderQuery = "
        SELECT orders.id AS order_id, users.first_name, users.last_name, orders.total, orders.date
        FROM orders
        JOIN users ON orders.user_id = users.id
        WHERE orders.id = $orderID
    ";
    $orderResult = $conn->query($orderQuery);

    if ($orderResult->num_rows > 0) {
        return $orderResult->fetch_assoc(); // Fetch and return the order details
    } else {
        return null; // No order found
    }
}

// Fetch the items associated with a particular order ID
function getOrderItems($conn, $orderID) {
    $itemsQuery = "
        SELECT products.product_name, products.price, order_details.quantity
        FROM order_details
        JOIN products ON order_details.product_id = products.id
        WHERE order_details.order_id = $orderID
    ";
    return $conn->query($itemsQuery); // Return the result set of items
}
?>