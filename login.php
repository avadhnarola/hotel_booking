<?php
session_start();
require './db.php'; // DB connection

if (isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: index.php");
        exit();
    }

    // Prepared statement
    $stmt = $conn->prepare("SELECT id, fullname, email, password, avatar FROM users WHERE email = ?");
    if (!$stmt) {
        $_SESSION['error'] = "Database error.";
        header("Location: index.php");
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Plain text comparison (per your request)
        if ($password === $user['password']) {
            // Store user in session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'fullname' => $user['fullname'],
                'email' => $user['email'],
                'avatar' => $user['avatar']
            ];

            $_SESSION['success'] = "Welcome back, {$user['fullname']}!";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password.";
        }
    } else {
        $_SESSION['error'] = "No account found with that email.";
    }

    header("Location: index.php");
    exit();
}
