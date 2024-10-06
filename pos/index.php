<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

}
if (!isset($_SESSION['admin'])) {
    //redirect to login page
    header("location: ../");

}
include "../Classes/Product.php";

$product = new Product;

$product_list = $product->displayProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css">

<body>
    <div class="header" bis_skin_checked="1">
        <div class="header-left active" bis_skin_checked="1">
            <span class="fw-bold fs-5">Kathy Bakeshop</span>
        </div>

        <a id="mobile_btn" class="mobile_btn d-none" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <ul class="nav user-menu">
            <li class="nav-item nav-searchinputs">
            </li>

            <li class="nav-item dropdown has-arrow main-drop select-store-dropdown">

            </li>

            <li class="nav-item dropdown has-arrow flag-nav nav-item-box">

            </li>

            <li class="nav-item nav-item-box">
            </li>
            <li class="nav-item nav-item-box">

            </li>

            <li class="nav-item dropdown nav-item-box">

            </li>

            <li class="nav-item nav-item-box">

            </li>
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-info">
                        <span class="user-detail">
                            <span class="user-name">
                                <?php if (isset($_SESSION['user_name'])): ?>

                                    <?php echo $_SESSION['user_name']; ?>
                                <?php endif; ?>
                            </span>
                        </span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user" bis_skin_checked="1">
                    <div class="profilename" bis_skin_checked="1">
                        <?php if ($_SESSION['admin']): ?>
                            <a class="dropdown-item" href="../Admin-WEB/product-list/"> <svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user me-2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg> Admin</a>
                            <hr class="mb-0" />
                        <?php endif; ?>
                        <a class="dropdown-item logout pb-0" href="../Actions/logout.php">

                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 9.5L5.25 12.5V10.25H12V8.75H5.25V6.5L1.5 9.5Z" fill="#EA5455" />
                                <path
                                    d="M9.75054 2.74923C8.86368 2.74677 7.98516 2.92032 7.16585 3.25981C6.34654 3.59929 5.60274 4.09798 4.97754 4.72698L6.03804 5.78748C7.02954 4.79598 8.34804 4.24923 9.75054 4.24923C11.153 4.24923 12.4715 4.79598 13.463 5.78748C14.4545 6.77898 15.0013 8.09748 15.0013 9.49998C15.0013 10.9025 14.4545 12.221 13.463 13.2125C12.4715 14.204 11.153 14.7507 9.75054 14.7507C8.34804 14.7507 7.02954 14.204 6.03804 13.2125L4.97754 14.273C6.25179 15.548 7.94679 16.2507 9.75054 16.2507C11.5543 16.2507 13.2493 15.548 14.5235 14.273C15.7985 12.9987 16.5013 11.3037 16.5013 9.49998C16.5013 7.69623 15.7985 6.00123 14.5235 4.72698C13.8983 4.09798 13.1545 3.59929 12.3352 3.25981C11.5159 2.92032 10.6374 2.74677 9.75054 2.74923Z"
                                    fill="#EA5455" />
                            </svg>

                            Logout</a>
                    </div>
                </div>
            </li>
        </ul>

        <div class="dropdown mobile-user-menu" bis_skin_checked="1">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right" bis_skin_checked="1">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="general-settings.html">Settings</a>
                <a class="dropdown-item" href="signin.html">Logout</a>
            </div>
        </div>
    </div>

    <div class="page-wrapper pos-pg-wrapper ms-0" bis_skin_checked="1" style="min-height: 920px;">
        <div class="content pos-design p-0" bis_skin_checked="1">
            <div class="row align-items-start pos-wrapper" bis_skin_checked="1">
                <div class="col-md-12 col-lg-8" bis_skin_checked="1">
                    <div class="pos-categories tabs_wrapper" bis_skin_checked="1">
                        <div class="pos-products" bis_skin_checked="1">
                            <div class="d-flex align-items-center justify-content-between" bis_skin_checked="1">
                                <h5 class="mb-3">Products</h5>
                            </div>
                            <div class="tabs_container" bis_skin_checked="1">
                                <div class="tab_content active" data-tab="all" bis_skin_checked="1">
                                    <div class="row" bis_skin_checked="1">
                                        <?php foreach ($product_list as $product): ?>
                                            <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 mb-3" bis_skin_checked="1">
                                                <div class="product-info default-cover card" bis_skin_checked="1">
                                                    <?php if ($product['quantity'] > 0): ?>
                                                        <a href="../Actions/add-to-cart.php?id=<?= $product['id'] ?>"
                                                            class="img-bg">
                                                        <?php else: ?>
                                                            <a href="javascript:void(0);" class="img-bg">
                                                            <?php endif; ?>
                                                            <img src="<?= $product['image'] ?>" alt="Products" />
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-check feather-16">
                                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        <h6 class="product-name"><a
                                                                href="../Actions/add-to-cart.php?id=<?= $product['id'] ?>"><?= $product['product_name'] ?></a>
                                                        </h6>
                                                        <div class="d-flex align-items-center justify-content-between price"
                                                            bis_skin_checked="1">
                                                            <span><?= ($product['quantity'] > 0) ? $product['quantity'] . ' Pcs' : 'Out of Stock' ?></span>
                                                            <p>₱<?= $product['price'] ?></p>
                                                        </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 ps-0" bis_skin_checked="1">
                    <aside class="product-order-list">
                        <div class="product-added block-section" bis_skin_checked="1">
                            <div class="head-text d-flex align-items-center justify-content-between"
                                bis_skin_checked="1">
                                <h6 class="d-flex align-items-center mb-0"> </h6>
                                <a href="../Actions/clear-order-details.php"
                                    class="d-flex align-items-center text-danger">
                                    <span class="me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-x feather-16">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </span>
                                    Clear all
                                </a>
                            </div>

                            <?php include "../Actions/get-order.php"; ?>

                            <div class="btn-row d-sm-flex align-items-center justify-content-between"
                                bis_skin_checked="1">

                                <a href="javascript:void(0);" class="btn btn-success btn-icon flex-fill"
                                    data-bs-toggle="modal" data-bs-target="#paymentModal">

                                    Payment
                                </a>
                            </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-default" id="payment-completed" aria-labelledby="payment-completed">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <form action="/pos/">
                        <div class="icon-head">
                            <a href="javascript:void(0);">
                                <i data-feather="check-circle" class="feather-40"></i>
                            </a>
                        </div>
                        <h4>Payment Completed</h4>
                        <p class="mb-0">Do you want to Print Receipt for the Completed Order</p>
                        <div class="modal-footer d-sm-flex justify-content-between">
                            <button type="button" class="btn btn-primary flex-fill" data-bs-toggle="modal"
                                data-bs-target="#print-receipt">Print Receipt<i
                                    class="feather-arrow-right-circle icon-me-5"></i></button>
                            <button type="submit" class="btn btn-secondary flex-fill">Next Order<i
                                    class="feather-arrow-right-circle icon-me-5"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/modal.js"></script>
</body>

</html>