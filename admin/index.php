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
        $login_error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Custom Styles -->
    <style>
        body {
            background-color: "#fff" ;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-card .card-header {
            background-color: #0c3b2e;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            padding: 1.5rem;
        }

        .login-card .card-body {
            padding: 2rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0c3b2e;
        }

        .btn-primary {
            background-color: #0c3b2e;
            border-color: #0c3b2e;
        }

        .btn-primary:hover {
            background-color: #6d9773;
            border-color: #6d9773;
        }

        .input-group-text {
            background-color: #0c3b2e;
            color: #fff;
            border: none;
        }

        .error-msg {
            color: red;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .login-card {
                width: 90%;
            }
        }
        .text-center a{
            color: #0c3b2e;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-card card col-xl-4 col-lg-5 col-md-7 col-sm-10">
        <div class="card-header">
            <i class="fas fa-user-shield me-2"></i> Admin Login
        </div>
        <div class="card-body">
            <?php if (isset($login_error)): ?>
                <div class="alert alert-danger text-center"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form id="loginForm" method="post" novalidate>
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
                <button type="submit" class="btn btn-primary w-100 mt-3" name="submit">Login</button>
                <div class="text-center mt-3">
                    <p>Register New Admin? <a href="addAdmin.php " style="text-decoration: underline;" >Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validation Script -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            let valid = true;

            emailError.textContent = '';
            passwordError.textContent = '';

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