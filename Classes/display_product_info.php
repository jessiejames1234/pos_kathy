<?php
include_once 'Connect.php';
$database = new Database();
$conn = $database->conn;

// Query to get all products
$productQuery = "SELECT * FROM products";
$productResult = $conn->query($productQuery);

// Query to get best-selling products including those with 0 sales
$bestProductQuery = "SELECT p.product_name, IFNULL(SUM(od.quantity), 0) AS total_sold 
                      FROM products p 
                      LEFT JOIN order_details od ON od.product_id = p.id 
                      GROUP BY p.product_name 
                      ORDER BY total_sold DESC"; // Remove LIMIT to show all products
$bestProductResult = $conn->query($bestProductQuery);

// Close the connection
$conn->close();

