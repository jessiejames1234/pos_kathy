<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['admin'])) {
    echo "<h1>Already Logged In</h1>";
    if ($_SESSION['admin']) {
        header("Location: Admin-WEB/dashboard");
    } else {
        $_SESSION['admin'] = false;
        header("Location: pos");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="CSS/Log.css">
</head>
<body>

    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row ">
            <div class="col mw-100" style="width: 400px;">
                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Invalid username or password.
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form action="Actions/user-actions.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
