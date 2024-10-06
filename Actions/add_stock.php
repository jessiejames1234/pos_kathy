<?php
// add_stock.php
include_once '../Classes/Connect.php';
// Create a new instance of the Database class

// Create a new instance of the Database class
$database = new Database();
$conn = $database->conn;

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if user_id is set in session
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
    } else {
        die("User not logged in.");
    }

    // Prepare the SQL statement to update the product quantity
    $sqlUpdate = "UPDATE products SET quantity = quantity + ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ii", $quantity, $product_id); // Bind parameters

    if ($stmtUpdate->execute()) {
        // If the quantity update was successful, insert the record into stocks_quantity
        $sqlInsert = "INSERT INTO stocks_quantity (product_id, user_id, quantity_added	, date) VALUES (?, ?, ?, NOW())";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("iii", $product_id, $user_id, $quantity); // Bind parameters

        if ($stmtInsert->execute()) {
            // Success message or redirect
            header("Location: ../Admin-WEB/product-list?success=1");
            exit();
        } else {
            // Error handling for insert
            echo "Error recording stock change: " . $conn->error;
        }

        $stmtInsert->close();
    } else {
        // Error handling for update
        echo "Error updating stock: " . $conn->error;
    }

    $stmtUpdate->close();
}

$conn->close();
?>


