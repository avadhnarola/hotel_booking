<?php
ob_start();
include 'db.php';
include 'header.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login to book a hotel.";
    header("Location: index.php");
    exit();
}

// Check if hotel ID is provided
if (!isset($_GET['hotel_id']) || empty($_GET['hotel_id'])) {
    $_SESSION['error'] = "Invalid hotel selection.";
    header("Location: hotel.php");
    exit();
}

$hotel_id = intval($_GET['hotel_id']);
$query = mysqli_query($conn, "SELECT * FROM hotels WHERE id = '$hotel_id'");

if (mysqli_num_rows($query) === 0) {
    $_SESSION['error'] = "Hotel not found.";
    header("Location: hotel.php");
    exit();
}

$hotel = mysqli_fetch_assoc($query);

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $checkin = mysqli_real_escape_string($conn, $_POST['checkin_date']);
    $checkout = mysqli_real_escape_string($conn, $_POST['checkout_date']);
    $guests = intval($_POST['guests']);

    $insert = mysqli_query($conn, "INSERT INTO hotelBookings (user_id, hotel_id, checkin_date, checkout_date, guests)
                                   VALUES ('$user_id', '$hotel_id', '$checkin', '$checkout', '$guests')");

    if ($insert) {
        $_SESSION['success'] = "Your booking for {$hotel['location']} is confirmed!";
        header("Location: my_bookings.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to book. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Hotel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .star-rating i {
            font-size: 20px;
            color: #FFD700; /* Gold color for filled stars */
        }
        .star-rating .empty-star {
            color: #ccc; /* Light gray for empty stars */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Book Your Stay at <?php echo htmlspecialchars($hotel['location']); ?></h2>
    <div class="row">
        <div class="col-md-6">
            <img src="admin/images/<?php echo $hotel['image']; ?>" class="img-fluid rounded" alt="Hotel Image">
            <h4 class="mt-3">$<?php echo $hotel['price']; ?> / night</h4>

            <!-- Star Rating Display -->
            <div class="star-rating mb-3">
                <?php
                $stars = intval($hotel['star']);
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $stars) {
                        echo '<i class="fas fa-star"></i>'; // Filled star
                    } else {
                        echo '<i class="far fa-star empty-star"></i>'; // Empty star
                    }
                }
                ?>
            </div>
        </div>

        <div class="col-md-6">
            <form method="POST">
                <div class="form-group">
                    <label>Check-in Date</label>
                    <input type="date" name="checkin_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Check-out Date</label>
                    <input type="date" name="checkout_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Number of Guests</label>
                    <input type="number" name="guests" class="form-control" min="1" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Confirm Booking</button>
                <a href="hotel.php" class="btn btn-secondary btn-block">Back to Hotels</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php 
include 'footer.php';
?>