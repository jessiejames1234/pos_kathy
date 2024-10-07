<?php

require_once "Connect.php";

class Order extends Database {

    /**
     * Adds a new order to the database
     *
     * @param int $user_id The ID of the user placing the order
     * @param float $total The total price of the order
     * @param string $status The current status of the order
     *
     * @throws Exception If there is an error in adding the order
     *
     * @return int The newly created order ID
     */
    public function addOrder($user_id, $total, $status) {
        $date = date('Y-m-d H:i:s'); // Get the current timestamp
        $sql = "INSERT INTO orders (user_id, total, date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("idss", $user_id, $total, $date, $status);

        if ($stmt->execute()) {
            return $stmt->insert_id; // Return the order ID for the new order
        } else {
            die("Error in adding order: " . $stmt->error);
        }
    }

    /**
     * Adds order details to the database
     *
     * @param int $order_id The ID of the order
     * @param int $product_id The ID of the product
     * @param int $quantity The quantity of the product ordered
     *
     * @throws Exception If there is an error in adding the order details
     *
     * @return void
     */
    public function addOrderDetails($order_id, $product_id, $quantity) {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $order_id, $product_id, $quantity,);

        if ($stmt->execute()) {
            return true; // Return true if the insertion is successful
        } else {
            die("Error in adding order details: " . $stmt->error);
        }
    }

    /**
     * Retrieves all orders for a specific user
     *
     * @param int $user_id The ID of the user whose orders are to be retrieved
     *
     * @throws Exception If there is an error in retrieving the orders
     *
     * @return array The list of orders
     */
    public function getOrdersByUser($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            $orders = [];
            while ($order = $result->fetch_assoc()) {
                $orders[] = $order;
            }
            return $orders;
        } else {
            die("Error in retrieving orders: " . $stmt->error);
        }
    }
    /**
     * Get order details based on order ID
     *
     * @param int $order_id The ID of the order to retrieve
     * @return array The order details including products and total amount
     * @throws Exception If the order is not found
     */
    public function getOrderDetails($order_id) {
        // SQL query to get the order and associated product details
        $sql = "
            SELECT 
                od.id, 
                od.product_id, 
                p.product_name, 
                p.price, 
                od.quantity, 
                (od.quantity * p.price) AS total_price
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $order_details = [];
            while ($row = $result->fetch_assoc()) {
                $order_details[] = $row;
            }
            return $order_details;
        } else {
            throw new Exception("");
        }
    }

    /**
     * Get the total amount of the order based on order ID
     *
     * @param int $order_id The ID of the order
     * @return float The total amount of the order
     */
    public function getOrderTotal($order_id) {
        $sql = "
            SELECT SUM(od.quantity * p.price) AS total
            FROM order_details od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Return total or 0 if no rows found (for safety)
            return $row['total'] !== null ? (float) $row['total'] : 0.0;
        } else {
            return 0.0; // No total found, return 0
        }
    }
    
    

    public function updateOrderQuantity($order_id, $product_id, $quantity) {
        $sql = "UPDATE order_details SET quantity = ? WHERE order_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iii', $quantity, $order_id, $product_id);
        return $stmt->execute();
    }

    public function removeProductFromOrder($id) {
        $sql = "DELETE FROM order_details WHERE  id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function clearOrderDetails($order_id) {
        // Prepare SQL query to delete all items from order_details for the given order_id
        $sql = "DELETE FROM order_details WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $order_id);
    
        if ($stmt->execute()) {
            return true; // Success
        } else {
            return false; // Failure
        }
    }

    public function getDistinctProductCount($order_id) {
        // SQL query to get the number of distinct products in the order_details table for the given order_id
        $sql = "SELECT COUNT(DISTINCT product_id) AS product_count FROM order_details WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $order_id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row['product_count'];
        } else {
            return false; // Return false if there's an error
        }
    }
    
    public function updateOrderStatus($order_id, $status) {
        // SQL query to update the order status
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $status, $order_id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateProductQuantityInOrder($order_id, $status, $product_id, $new_qty) {
        // SQL to update the quantity for this product in the specific order
        $query = "UPDATE order_details SET quantity = ? WHERE order_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('si', $status, $order_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    
}
