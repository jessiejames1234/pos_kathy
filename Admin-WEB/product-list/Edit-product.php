<?php
include "../includes/header.php";

include "../../Classes/Product.php";
$product = new Product;

$product_details = $product->displaySpecificProduct($_GET['product_id']);
?>
<div class="container mt-3">
    <div class="card border-0 mx-auto w-50"> <!-- Changed width to w-50 -->
        <div class="card-header bg-white border-0">
            <h1 class="display-5 fw-bold text-warning text-center"> <!-- Changed display size -->
                <i class="fa-solid fa-pen-to-square"></i> Edit Product
            </h1>
        </div>
        <div class="card-body">
            <form action="../../Actions/product-actions.php" method="post" enctype="multipart/form-data" class="w-100 mx-auto"> <!-- Changed to w-100 -->
                <input type="hidden" name="product_id" value="<?= $product_details['id'] ?>">
                <input type="hidden" name="action" value="edit_product">

                <div class="mb-3">
                    <label for="product-name" class="form-label small text-secondary">Product Name</label>
                    <input type="text" name="product_name" id="product-name" class="form-control" 
                        value="<?= htmlspecialchars($product_details['product_name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label small text-secondary">Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="price-tag">$</span>
                        <input type="number" name="price" id="price" class="form-control" 
                            aria-label="Price" aria-describedby="price-tag" 
                            value="<?= htmlspecialchars($product_details['price']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label small text-secondary">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="2" required> <!-- Reduced rows -->
                        <?= htmlspecialchars($product_details['description']) ?>
                    </textarea>
                </div>

                <div class="mb-3">
                    <img id="productImagePreview" src="../../image/<?= $product_details['image'] ?>" 
                        alt="Product Image" class="img-fluid" style="max-height: 200px;"> <!-- Set a max height -->
                    <div class="clearfix mb-3"></div>
                    <label for="image" class="form-label small text-secondary">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    <small class="text-secondary">Leave empty to keep current image.</small>
                </div>

                <script>
                    document.getElementById('image').addEventListener('change', function (event) {
                        const [file] = event.target.files;
                        if (file) {
                            document.getElementById('productImagePreview').src = URL.createObjectURL(file);
                        }
                    });
                </script>

                <div class="mb-3">
                    <button type="submit" class="btn btn-warning w-100" name="edit_product">Save Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "../includes/footer.php";
?>