<?php
include "includes/header.php";
include "../Classes/Product.php";

$product = new Product;

$product_list = $product->displayProducts();
?>
<main class="col-md-10">
    <div class="header">
        <div class="header-logo">WELCOME, ADMIN</div>
        <div class="header-logout"><a class="btn btn-outline-danger" href="../Actions/logout.php">Logout</a></div>
    </div>

    <div class="table-container container">
        <div class="col text-end">
            <i class="fa-regular fa-square-plus fa-flip-vertical fa-4x" style="color: #74C0FC;" data-bs-toggle="modal"
                data-bs-target="#add-product" style="cursor: pointer;"></i>
        </div>
        <?php
        if (empty($product_list)) {
            ?>
            <div class="container-fluid bg-dark p-5 text-danger text-center">
                <h1 class="display-6 fw-bold pt-5 pb-3">No Records Found</h1>
                <i class="fa-regular fa-circle-xmark fa-8x pb-5"></i>
            </div>
            <?php
        } else {
            ?>

            <?php
        }
        ?>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($product_list as $product) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $product['id'] ?></td>
                        <td class="text-center"><?= $product['product_name'] ?></td>
                        <td class="text-center"><?= $product['price'] ?></td>
                        <td class="text-center"><img src="<?= $product['image'] ?>" alt="Product Image"
                                style="width: 100px; height: 70px;"></td>
                        <td class="text-center" style="width: 500px;"><?= $product['description'] ?></td>
                        <td class="text-center">
                            <a href="Edit-product.php?product_id=<?= $product['id'] ?>" class="btn  "
                                title="Edit Product"><i class="fa-solid fa-pen-to-square fa-2x"
                                    style="color: #63E6BE; "></i></a>
                            <a href="../Actions/Delete-product.php?product_id=<?= $product['id'] ?>"
                                class="btn btn-danger btn-sm" title="Delete Product"><i
                                    class="fa-sharp-duotone fa-solid fa-trash-can fa-2x"
                                    style="--fa-primary-color: #871c1f; --fa-secondary-color: #ff0000; --fa-secondary-opacity: 1;"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
</div>
</div>
<div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="registration" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <h1 class="display-4 fw-bold text-info text-center"><i class="fa-solid fa-box"></i> Add Product</h1>
            </div>
            <div class="card-body">
                <form action="../Actions/product-actions.php" method="post" enctype="multipart/form-data"
                    class="w-75 mx-auto">

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
                                <input type="number" name="price" id="price" class="form-control" aria-label="Price"
                                    aria-describedby="price-tag" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="description" class="form-label small text-secondary">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3"
                                required></textarea>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>