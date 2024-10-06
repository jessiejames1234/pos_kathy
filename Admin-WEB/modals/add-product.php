<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
 
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header align-text-center border-0">
                    <h5 class="modal-title fw-bold text-info" id="addProductModalLabel"><i class="fa-solid fa-box"></i> Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> 
            <div class="card-body pb-5">
                <form action="../../Actions/product-actions.php" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
                    <input type="hidden" name="action" value="add_product">
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="product-name" class="form-label small text-secondary">Product Name</label>
                            <input type="text" name="product_name" id="product-name" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="price" class="form-label small text-secondary">Price</label>
                            <div class="input-group mb-3"> <!-- Corrected from "inpt-group" to "input-group" -->
                                <span class="input-group-text" id="price-tag">₱</span>
                                <input type="number" name="price" id="price" class="form-control" aria-label="Price" aria-describedby="price-tag" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="price" class="form-label small text-secondary">Total QTY</label>
                            <div class="input-group mb-3"> <!-- Corrected from "inpt-group" to "input-group" --> 
                                <input type="number" name="quantity" id="quantity" class="form-control" aria-label="Quantity" aria-describedby="product-quantity" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="description" class="form-label small text-secondary">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="image" class="form-label small text-secondary">Product Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md">
                            <button type="submit" class="btn btn-success w-100 py-3 " name="add_product">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>