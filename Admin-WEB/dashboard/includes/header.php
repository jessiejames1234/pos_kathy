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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <style>
    body {
        overflow-x: hidden;
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0; /* Remove default margin */
    }
    .sidebar {
        width: 250px; /* Set a fixed width for the sidebar */
        height: 100vh; /* Full height of the viewport */
        background-color: #343a40; /* Darker sidebar */
        padding-top: 20px;
        position: fixed; /* Fix the sidebar position */
        overflow-y: auto; /* Enable scrolling if needed */
    }
    .sidebar a {
        text-decoration: none;
        display: block;
        padding: 10px 15px;
        color: #fff; /* White text color */
        transition: background-color 0.3s;
    }
    .sidebar a:hover {
        background-color: #495057; /* Slightly lighter on hover */
    }
    .navbar-brand {
        color: #ff9800;
    }
    .main-content {
        margin-left: 250px; /* Space for the sidebar */
    }
    .header {
        border-bottom: 2px solid #ccc;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff; /* White background for header */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .header-logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333; /* Darker color for better contrast */
    }
    .header-logout a {
        font-size: 1rem;
        font-weight: bold;
    }
    .table-container {
        margin-top: 20px;
        background-color: #fff; /* White background for main content */
        padding: 20px;
        border-radius: 5px; /* Slightly rounded corners */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .logo {
        font-family: 'Pacifico', cursive; /* Pacifico font */
        font-size: 1.25rem; /* Slightly larger size */
        color: orange; /* Change color */
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Optional shadow */
        font-weight: bold;
        pointer-events: none; /* Disable mouse events */
    }
</style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar">
            <div class="text-center mb-4">
                <a style="color: orange;" class="navbar-brand logo" href="#">KATHY BAKESHOP</a>
            </div>
            <div class="text-center">
                <a class="side" href="../../dashboard/">Dashboard</a>
                <a class="side" href="../../product-list/">Products</a>
                <a class="side" href="../../users/">Manage Users</a>
                <a class="side" href="../../../pos/">POS</a>
            </div>
        </nav>
        <main class="col-md-10 main-content"> <!-- Added 'main-content' class here -->
            <div class="header">
                <div class="header-logo">WELCOME ADMIN, <?php echo $_SESSION['user_name']; ?></div>
                <div class="header-logout">
                    <a class="btn btn-outline-danger" href="../../../Actions/logout.php">Logout</a>
                </div>
            </div>