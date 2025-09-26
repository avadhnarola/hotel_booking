<?php
include_once '../db.php';
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = mysqli_query($conn, "INSERT INTO admin(username,email,password) VALUES ('$username','$email','$password')");

    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Custom Styles -->
    <style>
        body {

            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-card {
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .register-card .card-header {
            background-color: #0c3b3e;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            padding: 1.5rem;
        }

        .register-card .card-body {
            padding: 2rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0c3b3e;
        }

        .btn-primary {
            background-color: #0c3b3e;
            border-color: #0c3b3e;
        }

        .btn-primary:hover {
            background-color: #6d9773;
            border-color: #6d9773;
        }

        .input-group-text {
            background-color: #0c3b3e;
            color: #fff;
            border: none;
        }

        .error-msg {
            color: red;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .register-card {
                width: 90%;
            }
        }

        .text-center a {
            color: #0c3b2e;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="register-card card col-xl-4 col-lg-5 col-md-7 col-sm-10">
        <div class="card-header">
            <i class="fas fa-user-plus me-2"></i> Register New Admin
        </div>
        <div class="card-body">
            <form id="registerForm" method="post" novalidate>
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="abc" />
                    </div>
                    <div id="usernameError" class="error-msg"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" id="email" name="email" placeholder="xyz@gmail.com" />
                    </div>
                    <div id="emailError" class="error-msg"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="........" />
                    </div>
                    <div id="passwordError" class="error-msg"></div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3" name="submit">Register</button>
                <div class="text-center mt-3">
                    <p>Already have an account? <a href="index.php" class="text-decoration-underline">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validation Script -->
    <script>
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            const usernameError = document.getElementById('usernameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            let valid = true;
            usernameError.textContent = '';
            emailError.textContent = '';
            passwordError.textContent = '';

            if (!username) {
                usernameError.textContent = 'Username is required.';
                valid = false;
            }

            if (!email) {
                emailError.textContent = 'Email is required.';
                valid = false;
            } else if (!emailPattern.test(email)) {
                emailError.textContent = 'Enter a valid email address.';
                valid = false;
            }

            if (!password) {
                passwordError.textContent = 'Password is required.';
                valid = false;
            }

            if (!valid) e.preventDefault();
        });
    </script>

</body>

</html>