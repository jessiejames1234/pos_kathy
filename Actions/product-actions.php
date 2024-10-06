<?php

include_once "../Classes/Product.php"; 

$product = new Product();

// Specify the path to your log file
$log_file = '../logs/error_log.txt';
print_r($_REQUEST);

// Function to handle adding or editing a product
function handleProductRequest($action, $product, $log_file) {
    try {
        // Validate required fields
        if (empty($_POST['product_name']) || empty($_POST['price']) || empty($_POST['description'])) {
            throw new Exception("All fields are required.");
        }

        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];


        // Validate price
        if (!is_numeric($price) || $price < 0) {
            throw new Exception("Invalid price. It must be a positive number.");
        }

        if ($action == 'add_product') {
            // Check if the file was uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $image = $_FILES['image'];

                // Validate image file type
                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                    throw new Exception("Invalid image format. Allowed formats are: jpg, jpeg, png, gif.");
                }

                // Handle file upload
                $target_dir = "../Image/"; // Directory to save uploaded images
                
                $target_file = $target_dir . basename($image["name"]);

                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    $product->addProduct($product_name, $price, $target_file, $description, $quantity);
                    header("Location: success.php?message=Product added successfully"); // Redirect to success page
                    exit();
                } else {
                    throw new Exception("Error uploading the image.");
                }
            } else {
                throw new Exception("No image uploaded or an error occurred during upload.");
            }
        } elseif ($action == 'edit_product') {
            $product_id = $_POST['product_id'];

            // Retrieve existing image path before checking for a new upload
            $existing_image = $product->getExistingImage($product_id);

            // Check if a new file was uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $image = $_FILES['image'];
                $target_dir = "../Image/"; // Directory to save uploaded images
                $target_file = $target_dir . basename($image["name"]);

                if (move_uploaded_file($image["tmp_name"], $target_file)) {
                    // Use the new image path if the upload is successful
                    $product->editProduct($product_id, $product_name, $price, $target_file, $description);
                } else {
                    throw new Exception("Error uploading the image.");
                }
            } else {
                // Use the existing image path if no new image is uploaded
                $product->editProduct($product_id, $product_name, $price, $existing_image, $description);
            }

            header("Location: success.php?message=Product updated successfully"); // Redirect to success page
            exit();
        }
    } catch (Exception $e) {
        // Log the error to the specified log file
        error_log($e->getMessage() . "\n", 3, $log_file);

        // Redirect to an error page or show an error message
        header("Location: error.php?message=" . urlencode($e->getMessage()));
        exit();
    }
}

// Main logic to handle form submission
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    handleProductRequest($action, $product, $log_file);
}

?>
