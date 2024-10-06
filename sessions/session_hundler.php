<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION['admin'])) {
        if($_SESSION['admin']) {
            header("Location: ../Admin-WEB/Manage-product.php");
            exit;
        } else {
            $_SESSION['admin'] = false;
            header("Location: ../Customer-WEB/index.php");
        }
    }
}?> 