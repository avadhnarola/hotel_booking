<?php
include 'db.php'; // Include the database connection file
session_start();

if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $uploadDir = "admin/images/";
    $defaultAvatar = "admin/images/user-profile.jpg";
    $avatarPath = $defaultAvatar;

    // Avatar upload
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

    // Validation
    if ($fullname === '' || $email === '' || $password === '') {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: register.php");
        exit();
    }

    // Check if email already exists in DB
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $_SESSION['error'] = "Email already registered.";
        header("Location: register.php");
        exit();
    }
    $checkStmt->close();

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, avatar) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $password, $avatarPath);

    if ($stmt->execute()) {
        // Set logged-in user session
        $_SESSION['user'] = [
            'id' => $stmt->insert_id,
            'fullname' => $fullname,
            'email' => $email,
            'avatar' => $avatarPath
        ];

        $_SESSION['success'] = "Registration successful. Welcome, {$fullname}!";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: register.php");
        exit();
    }


}

?>