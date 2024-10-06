<?php
    session_start();
    session_destroy();
    $_SESSION['user_id'] = false; 
    header("location: ../index.php");
    exit;