<?php
include "../includes/header.php";
include "../../Classes/Product.php";

$product = new Product;

$product_list = $product->displayProducts();
?>
<main class="col-12">
    <div class="table-container container">
        <div class="col text-end mb-3">
            <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#stockProductModal">
                <i class="fa-regular fa-square-plus fa-flip-vertical fa-1x"></i> Add Stock
            </a>
            <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fa-regular fa-square-plus fa-flip-vertical fa-1x"></i> Add New Product
            </a>
        </div>
        <?php if (empty($product_list)): ?>
            <div class="container-fluid bg-dark p-5 text-danger text-center">
                <h1 class="display-6 fw-bold pt-5 pb-3">No Records Found</h1>
                <i class="fa-regular fa-circle-xmark fa-8x pb-5"></i>
            </div>
        <?php endif; ?>

        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product_list as $product): ?>
                    <tr>
                        <td class="text-center" valign="middle"><?= $product['id'] ?></td>
                        <td class="text-center" valign="middle"><img src="../<?= $product['image'] ?>" alt="Product Image"
                                style="width: 100px; height: 70px;"></td>
                        <td class="text-center" valign="middle"><?= $product['product_name'] ?></td>
                        <td class="text-center" valign="middle"><?= $product['description'] ?></td>

                        <td class="text-center" valign="middle"><?= $product['price'] ?></td>
                        <td class="text-center" valign="middle"><?= $product['quantity'] ?></td>
                        <td class="text-center" valign="middle">
                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal<?= $product['id'] ?>" title="Edit Product">
                                <i class="fa-solid fa-pen-to-square fa-1x"></i>
                            </a>
                            <a href="../../Actions/Delete-product.php?product_id=<?= $product['id'] ?>"
                                class="btn btn-danger btn-sm" title="Delete Product"><i
                                    class="fa-sharp-duotone fa-solid fa-trash-can fa-1x"
                                    style="--fa-primary-color: #871c1f; --fa-secondary-color: #ff0000; --fa-secondary-opacity: 1;"></i></a>
                        </td>
                    </tr>
                    <?php include "../product-list/Edit-product.php"; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
</div>
</div>
<?php include '../modals/add_stock.php'; ?>
<?php include "../modals/add-product.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>