<?php
session_start();

if (isset($_POST['register'])) {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $uploadDir = "admin/images/";
    $defaultAvatar = "admin/images/user-profile.jpg";
    $avatarPath = $defaultAvatar;

    // Handle avatar upload
    if (!empty($_FILES['avatar']['name'])) {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $avatarName = time() . "_" . basename($_FILES['avatar']['name']);
        $targetFile = $uploadDir . $avatarName;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
            $avatarPath = $targetFile;
        }
    }

    // Validate
    if ($fullname === '' || $email === '' || $password === '') {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: header.php");
        exit();
    }

    // Check if already in session store (email unique)
    if (isset($_SESSION['users']) && array_search($email, array_column($_SESSION['users'], 'email')) !== false) {
        $_SESSION['error'] = "Email already registered.";
        header("Location: header.php");
        exit();
    }

    // Store new user in session
    $_SESSION['users'][] = [
        'fullname' => $fullname,
        'email' => $email,
        'password' => $password,
        'avatar' => $avatarPath
    ];

    // Set current logged in user
    $_SESSION['user'] = [
        'fullname' => $fullname,
        'email' => $email,
        'avatar' => $avatarPath
    ];

    $_SESSION['success'] = "Registration successful. Welcome, {$fullname}!";
    header("Location: index.php");
    exit();
}
