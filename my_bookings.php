<?php
ob_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login first.";
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$result = mysqli_query($conn, "
    SELECT b.*, h.location, h.image, h.price 
    FROM hotelBookings b 
    JOIN hotels h ON b.hotel_id = h.id 
    WHERE b.user_id = '$user_id'
    ORDER BY b.created_at DESC
");
?>

<!-- Page Content -->
<div class="container bookings-container" style="margin-top: 120px; margin-bottom: 50px;">
    <h2 class="bookings-title text-center">
        <i class="fas fa-suitcase-rolling"></i> My Hotel Bookings
    </h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="booking-card d-flex align-items-center">
                <!-- Hotel Image -->
                <img src="admin/images/<?php echo $row['image']; ?>" class="booking-image mr-3" alt="Hotel Image">

                <!-- Hotel Info -->
                <div class="flex-grow-1">
                    <h4 class="hotel-name"><?php echo htmlspecialchars($row['location']); ?></h4>
                    <p class="hotel-price">$<?php echo $row['price']; ?> / night</p>

                    <div class="booking-details">
                        <p><i class="fas fa-calendar-check"></i> Check-in: <?php echo $row['checkin_date']; ?></p>
                        <p><i class="fas fa-calendar-times"></i> Check-out: <?php echo $row['checkout_date']; ?></p>
                        <p><i class="fas fa-users"></i> Guests: <?php echo $row['guests']; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="no-bookings text-center">
            <i class="fas fa-info-circle fa-2x mb-3" style="color:#e2c0bb;"></i>
            <p>You haven’t booked any hotels yet.</p>
            <a href="hotel.php" class="back-btn"><i class="fas fa-hotel"></i> Browse Hotels</a>
        </div>
    <?php } ?>
</div>

<?php include 'footer.php'; ?>

<!-- Custom CSS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .bookings-container {
        max-width: 1100px;
        margin: 40px auto;
    }

    .bookings-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 25px;
    }

    .booking-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 25px;
        transition: 0.3s ease-in-out;
    }

    .booking-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .booking-image {
        width: 120px;
        height: 90px;
        border-radius: 10px;
        object-fit: cover;
    }

    .hotel-name {
        font-size: 20px;
        font-weight: 600;
        color: #222;
        margin-bottom: 5px;
    }

    .hotel-price {
        color: #e2c0bb;
        font-size: 16px;
        font-weight: bold;
    }

    .booking-details i {
        color: #e2c0bb;
        margin-right: 6px;
    }

    .no-bookings {
        text-align: center;
        padding: 40px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        font-size: 18px;
        color: #555;
    }

    .back-btn {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        background: #007bff;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .back-btn:hover {
        background: #0056b3;
    }
</style>