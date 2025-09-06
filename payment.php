<?php
include 'db.php';
include 'header.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login first.";
    header("Location: index.php");
    exit();
}

if (!isset($_GET['booking_id'])) {
    echo "<p>Invalid request.</p>";
    exit();
}

$booking_id = intval($_GET['booking_id']);
$query = mysqli_query($conn, "
    SELECT b.*, h.name, h.price, h.location 
    FROM hotelBookings b
    JOIN hotels h ON b.hotel_id = h.id
    WHERE b.id = '$booking_id'
");
$booking = mysqli_fetch_assoc($query);
?>

<div class="container" style="margin-top: 120px; margin-bottom: 50px; max-width:600px;">
    <div class="payment-card">
        <h2 class="text-center"><i class="fas fa-credit-card"></i> Payment</h2>
        <p><strong>Hotel:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($booking['location']); ?></p>
        <p><strong>Total Price:</strong> $<?php echo $booking['price']; ?></p>

        <form method="post" action="process_payment.php">
            <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
            <div class="form-group">
                <label>Card Number</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Expiry Date</label>
                <input type="text" class="form-control" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label>CVV</label>
                <input type="text" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Pay Now</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<style>
    .payment-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }
</style>