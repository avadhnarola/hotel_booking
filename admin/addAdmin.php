<?php
include_once '../db.php';
session_start();


if (isset($_SESSION['admin_id'])) {
    header("location:dashboard.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = mysqli_query($conn, "insert into admin(username,email,password) values ('$username','$email','$password')");

    header("location:index.php");
}
?>

<link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="assets/css/demo.css" />

<div class="mt-5">
    <div class="col-xl-4 col-md-8 m-auto">
        <div class="card mb-6">
            <div class="card-header d-flex justify-content-center align-items-center">
                <h3 class="mb-0">Add New Admin</h3>
            </div>
            <div class="card-body">
                <form id="loginForm" method="post">
                    <div class="mb-6">
                        <label class="form-label" for="basic-default-fullname">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="abc" />
                    </div>
                    <div class="mb-6">

                        <label class="form-label" for="basic-default-fullname">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="xyz@gmail.com" />
                    </div>
                    <div class="mb-6">
                        <label class="form-label" for="basic-default-company">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="........" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        // Get form fields
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const username = document.getElementById('username').value.trim();

        // Email regex pattern for validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Validate fields
        if (!email) {
            alert('Email is required.');
            e.preventDefault(); // Prevent form submission
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

        if (!username) {
            alert('username is required.');
            e.preventDefault();
            return;
        }

        // if (password.length < 6) {
        //     alert('Password must be at least 6 characters long.');
        //     e.preventDefault();
        // }
    });
</script>