<?php
include_once '../db.php';
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header("location:dashboard.php");
    exit();
}

// Login logic
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password'");
    $cnt = mysqli_num_rows($data);
    $row = mysqli_fetch_assoc($data);

    if ($cnt == 1) {
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_email'] = $row['email'];
        $_SESSION['admin_name'] = $row['username'];
        header("location:dashboard.php");
        exit();
    } else {
        header("location:index.php");
        exit();
    }
}
?>

<!-- HTML + Bootstrap -->
<link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="assets/css/demo.css" />

<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

<link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="assets/css/demo.css" />

<div class="mt-5">
    <div class="col-xl-4 col-md-8 m-auto">
        <div class="card mb-6">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h3 class="mb-0">Admin Login</h3>
            </div>
            <div class="card-body">
                <form id="loginForm" method="post">

                    <div class="mb-6">

                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="xyz@gmail.com" required />
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="basic-default-company">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="........" required />
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <p>Register New Admin? <a href="addAdmin.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
