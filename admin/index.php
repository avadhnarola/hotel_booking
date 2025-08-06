<?php
include_once '../db.php';
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header("location:dashboard.php");
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
    } else {
        header("location:index.php?error=1"); 
        exit();
    }
}
?>

<!-- HTML + Bootstrap -->
<link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="assets/css/demo.css" />

<!-- Optional: Add Bootstrap via CDN if not already included -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

<!-- <div class="container d-flex mt-5">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <div style="display:flex;justify-content:end;height:40px;">
            <a class="btn btn-primary" href="addAdmin.php">
                <b style="font-size:18px;margin-right:5px;margin-bottom:4px;">+</b> Admin
            </a>
        </div>
    </div>
</div> -->

<div class="mt-5">
    <div class="col-xl-4 col-md-8 m-auto">
        <div class="card mb-6">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h3 class="mb-0">Admin Login</h3>
            </div>
            <div class="card-body">
                <!-- Error Alert -->
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" id="loginError"
                    style="display:none;">
                    <strong>Wrong username and Password</strong><br>Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <form id="loginForm" method="post" class="mt-3">
                    <div class="mb-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="xyz@gmail.com" />
                    </div>
                    <div class="mb-6 mt-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="........" />
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <p>Register New Admin ? <a href="addAdmin.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Front-end validation
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) {
            alert('Email is required.');
            e.preventDefault();
            return;
        }

        if (!emailPattern.test(email)) {
            alert('Please enter a valid email address.');
            e.preventDefault();
            return;
        }

        if (!password) {
            alert('Password is required.');
            e.preventDefault();
            return;
        }
    });

    // Show error alert if redirected with ?error=1
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('error') === '1') {
        document.getElementById('loginError').style.display = 'block';
    }
</script>