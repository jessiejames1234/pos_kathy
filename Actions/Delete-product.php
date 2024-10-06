<?php
    include "../Classes/Product.php";

    $product = new Product;

    $product->deleteProduct($_GET['product_id']);