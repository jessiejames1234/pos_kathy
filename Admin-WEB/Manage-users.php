<?php 
    include "../Classes/Customer.php";

    $user = new User;

    $user_list = $user->displayUsers(); // Fetch user data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar a {
            text-decoration: none;
            display: block;
            padding: 10px;
            font-weight: bold;
        }
        .navbar-brand {
            color: #ff9800;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
        .header {
            border-bottom: 1px solid #ccc;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-logo {
            font-size: 24px;
            font-weight: bold;
        }
        .header-logout {
            font-size: 18px;
        }
        .table-container {
            margin-top: 20px;
        }
        .side{
            text-align: center;
        }

        .logo {
            font-family: 'Pacifico', cursive; /* Make sure you include this if you're using the Pacifico font */
            font-size: 1rem; /* Adjust the size to make it smaller */
            color: #ff9800; /* Change the color as needed */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Optional: add shadow for effect */
            font-weight: bold;
            pointer-events: none; /* Disable all mouse events */
            
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar">
            <div style="text-align: center;">
                <div class="mb-4 text-center header-logo" ><a class="navbar-brand mx-5 logo" href="#">KATHY BAKESHOP</a>                </div>
            </div>
            <a class="side" style="color: black;" href="#">Dashboard</a>
            <a class="side" style="color: black;" href="Manage-product.php">Products</a>
            <a class="side" style="color: black;" href="View-orders.php">View Orders</a>
            <a class="side" style="color: black;" href="Manage-users.php">Manage Users</a>
        </nav>
        <main class="col-md-10">
            <div class="header">
                <div class="header-logo">WELCOME, ADMIN</div>
                <div class="header-logout"><a class="btn btn-outline-danger" href="../Actions/logout.php" >Logout</a></div>
            </div>
            
            <div class="table-container container">
                <div class="col text-end">
                    <i class="fa-regular fa-square-plus fa-flip-vertical fa-4x" style="color: #74C0FC;" data-bs-toggle="modal" data-bs-target="#add-user" style="cursor: pointer;"></i>
                </div>
                <?php
                    if(empty($user_list)){
                ?>
                    <div class="container-fluid bg-dark p-5 text-danger text-center">
                        <h1 class="display-6 fw-bold pt-5 pb-3">No Users Found</h1>
                        <i class="fa-regular fa-circle-xmark fa-8x pb-5"></i>
                    </div>
                <?php
                    } else {
                ?>
                    <table class="table table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Date Created</th>
                                <th>Edit/Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($user_list as $user) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $user['id'] ?></td>
                                <td class="text-center"><?= $user['first_name'] ?></td>
                                <td class="text-center"><?= $user['last_name'] ?></td>
                                <td class="text-center"><?= $user['username'] ?></td>
                                <td class="text-center"><?= $user['gmail'] ?></td>
                                <td class="text-center"><?= $user['phone_num'] ?></td>
                                <td class="text-center"><?= $user['address'] ?></td>
                                <td class="text-center"><?= $user['date_created'] ?></td>
                                <td class="text-center">
                                    <a href="Edit-user.php?user_id=<?= $user['id'] ?>" class="btn" title="Edit User"><i class="fa-solid fa-pen-to-square fa-2x" style="color: #63E6BE;"></i></a>
                                    <a href="../actions/delete-user.php?user_id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" title="Delete User"><i class="fa-sharp-duotone fa-solid fa-trash-can fa-2x" style="--fa-primary-color: #871c1f; --fa-secondary-color: #ff0000;"></i></a>
                                </td>
                            </tr>
                            <?php
                                } 
                            ?>
                        </tbody>
                    </table>
                <?php
                    }
                ?>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>