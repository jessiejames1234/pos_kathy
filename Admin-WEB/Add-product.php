
<?php 
    include "/includes/header.php";
?>
    <div class="container mt-5">
        <div class="card border-0 mx-auto w-50">
            <div class="card-header bg-white border-0">
                <h1 class="display-4 fw-bold text-info text-center"><i class="fa-solid fa-box"></i> Add Product</h1>
            </div>
            <div class="card-body">
                <form action="../Actions/product-actions.php" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="product-name" class="form-label small text-secondary">Product Name</label>
                            <input type="text" name="product_name" id="product-name" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="price" class="form-label small text-secondary">Price</label>
                            <div class="inpt-group mb-3">
                                <span class="input-group-text" id="price-tag">₱</span>
                                <input type="number" name="price" id="price" class="form-control" aria-label="Price" aria-describedby="price-tag" required>
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
                            <button type="submit" class="btn btn-info w-100" name="add_product">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
<?php 
    include "/includes/footer.php";
?>