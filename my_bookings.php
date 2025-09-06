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
    SELECT b.*, 
           h.name, h.location, h.star, h.rate, h.description, h.services, 
           h.image, h.price 
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
            <div class="booking-card d-flex">

                <!-- Left Side: Image -->
                <div class="left-side">
                    <img src="admin/images/<?php echo $row['image']; ?>" class="booking-image" alt="Hotel Image">
                </div>

                <!-- Middle Side: Hotel Info -->
                <div class="middle-side px-3">
                    <h4 class="hotel-name"><?php echo htmlspecialchars($row['name']); ?></h4>
                    <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['location']); ?></p>

                    <!-- Services with icons -->
                    <div class="hotel-services">
                        <?php 
                        $services = explode(",", $row['services']); 
                        foreach ($services as $service) {
                            $service = trim($service);
                            $icon = "fas fa-concierge-bell"; // default

                            if (stripos($service, "wifi") !== false) $icon = "fas fa-wifi";
                            if (stripos($service, "pool") !== false) $icon = "fas fa-swimming-pool";
                            if (stripos($service, "parking") !== false) $icon = "fas fa-parking";
                            if (stripos($service, "braekfast") !== false) $icon = "fas fa-mug-hot";
                            if (stripos($service, "air conditioning") !== false) $icon = "fas fa-wind";

                            echo "<p><i class='$icon'></i> $service</p>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Right Side: Booking Details -->
                <div class="right-side text-right">
                    <p class="hotel-price">$<?php echo $row['price']; ?> / night</p>
                    <p><i class="fas fa-calendar-check"></i> Check-in: <?php echo $row['checkin_date']; ?></p>
                    <p><i class="fas fa-calendar-times"></i> Check-out: <?php echo $row['checkout_date']; ?></p>
                    <p><i class="fas fa-users"></i> Guests: <?php echo $row['guests']; ?></p>

                    <a href="payment.php?booking_id=<?php echo $row['id']; ?>" class="pay-btn">Pay Now</a>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="no-bookings text-center">
            <i class="fas fa-info-circle fa-2x mb-3" style="color:#FF6F61;"></i>
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
        display: flex;
        justify-content: space-between;
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

    .left-side {
        flex: 0 0 180px;
    }

    .booking-image {
        width: 280px;
        height: 240px;
        border-radius: 10px;
        object-fit: cover;
    }

    .middle-side {
        flex: 1;
    }

    .hotel-name {
        font-size: 20px;
        font-weight: 600;
        color: #222;
    }

    .hotel-location {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
    }

    .hotel-services p {
        font-size: 14px;
        margin: 3px 0;
        color: #333;
    }

    .hotel-services i {
        color: #FF6F61;
        margin-right: 6px;
    }

    .right-side {
        flex: 0 0 220px;
    }

    .hotel-price {
        color: #FF6F61;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .booking-details i {
        color: #FF6F61;
        margin-right: 6px;
    }

    .pay-btn {
        display: inline-block;
        margin-top: 12px;
        padding: 10px 20px;
        background: #28a745;
        color: #fff;
        font-size: 14px;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .pay-btn:hover {
        background: #218838;
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
