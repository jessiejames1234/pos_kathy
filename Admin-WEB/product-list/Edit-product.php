<!-- Modal -->
<div class="modal fade" id="editProductModal<?= $product['id'] ?>" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-3">
                    <div class="card border-0 mx-auto w-75"> 
                        <div class="card-header bg-white border-0">
                            <h1 class="display-5 fw-bold text-center"> 
                                <i class="fa-solid fa-pen-to-square"></i> Edit Product
                            </h1>
                        </div>
                        <div class="card-body">
                            <form action="../../Actions/product-actions.php" method="post" enctype="multipart/form-data" class="w-100 mx-auto"> 
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <input type="hidden" name="action" value="edit_product">

                                <div class="mb-3">
                                    <label for="product-name" class="form-label small text-secondary">Product Name</label>
                                    <input type="text" name="product_name" id="product-name" class="form-control" 
                                        value="<?= htmlspecialchars($product['product_name']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label small text-secondary">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="price-tag">$</span>
                                        <input type="number" name="price" id="price" class="form-control" 
                                            aria-label="Price" aria-describedby="price-tag" 
                                            value="<?= htmlspecialchars($product['price']) ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label small text-secondary">Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="2" required> 
                                        <?= htmlspecialchars($product['description']) ?>
                                    </textarea>
                                </div>

                                <div class="mb-3">
                                    <img id="productImagePreview" src="../<?= $product['image'] ?>" 
                                        alt="Product Image" class="img-fluid" style="max-height: 200px;"> 
                                    <div class="clearfix mb-3"></div>
                                    <label for="image" class="form-label small text-secondary">Product Image</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    <small class="text-secondary">Leave empty to keep current image.</small>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-warning w-100" name="edit_product">Save Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>