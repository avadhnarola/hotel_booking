<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login first.";
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = intval($_POST['booking_id']);
    $amount = floatval($_POST['amount']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);

    // Insert payment record
    $insert = mysqli_query($conn, "INSERT INTO payments (user_id, booking_id, amount, method, status) 
                                   VALUES ('$user_id', '$booking_id', '$amount', '$method', 'Success')");

    if ($insert) {
        // Update booking status
        mysqli_query($conn, "UPDATE hotelBookings SET payment_status='Paid Successfully' 
                             WHERE id='$booking_id' AND user_id='$user_id'");

        $_SESSION['success'] = "✅ Payment of ₹$amount via $method completed successfully!";
        header("Location: my_bookings.php");
        exit();
    } else {
        $_SESSION['error'] = "❌ Payment failed. Please try again.";
        header("Location: payment.php?booking_id=$booking_id");
        exit();
    }
}
?>