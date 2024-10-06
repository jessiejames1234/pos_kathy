<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}   
if (isset($_SESSION["admin"])) {
    if (!$_SESSION["admin"]) {
        header("Location: ../../pos/");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"   />

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
                <div class="mb-4 text-center header-logo" ><a class="navbar-brand mx-5 logo" href="#">KATHY BAKESHOP</a>  </div>
            </div>
            <a class="side" style="color: black;" href="../dashboard/">Dashboard</a>
            <a class="side" style="color: black;" href="../product-list/">Products</a>
            <a class="side" style="color: black;" href="../view-orders/">View Sales</a>
            <a class="side" style="color: black;" href="../users/">Manage Users</a>
            <a class="side" style="color: black;" href="../../pos/">POS</a>
        </nav>
        <main class="col-md-10">
            <div class="header">
                <div class="header-logo">WELCOME, <?php echo $_SESSION['user_name']; ?></div>
                <div class="header-logout"><a class="btn btn-outline-danger" href="../../Actions/logout.php" >Logout</a></div>
            </div>

