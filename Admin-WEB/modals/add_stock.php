<!-- stock_modal.php -->
<div class="modal fade" id="stockProductModal" tabindex="-1" aria-labelledby="stockProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockProductModalLabel">Add Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStockForm" method="POST" action="../../Actions/add_stock.php">
                    <div class="mb-3">
                        <label for="productSelect" class="form-label">Select Product</label>
                        <select class="form-select" id="productSelect" name="product_id" required>
                            <!-- Options will be populated here -->
                            <?php
                            // Include the Database class
                            require_once '../../Classes/Connect.php'; // Adjust the path as necessary

                            // Create a new instance of the Database class
                            $database = new Database();
                            $conn = $database->conn;

                            // Fetching products from the database
                            $sql = "SELECT id, product_name FROM products";
                            $result = $conn->query($sql);

                            // Check if there are products and populate the dropdown
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['product_name']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>No products available</option>";
                            }

                            // Close the database connection (optional as it will close when script ends)
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Stock</button>
                </form>
            </div>
        </div>
    </div>
</div>