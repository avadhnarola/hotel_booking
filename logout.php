<?php
session_start();
unset($_SESSION['user']);
$_SESSION['success'] = "You have been logged out.";
header("Location: index.php");
exit();
