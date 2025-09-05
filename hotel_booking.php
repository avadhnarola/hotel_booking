<?php
// session_start();
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
$error = "";

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $checkin = mysqli_real_escape_string($conn, $_POST['checkin_date']);
    $checkout = mysqli_real_escape_string($conn, $_POST['checkout_date']);
    $guests = intval($_POST['guests']);

    // Date Validation
    $today = date('Y-m-d');

    if ($checkin < $today) {
        $error = "Check-in date cannot be in the past.";
    } elseif ($checkout <= $checkin) {
        $error = "Check-out date must be after the check-in date.";
    } else {
        // Insert booking if dates are valid
        $insert = mysqli_query($conn, "INSERT INTO hotelBookings (user_id, hotel_id, checkin_date, checkout_date, guests)
                                       VALUES ('$user_id', '$hotel_id', '$checkin', '$checkout', '$guests')");

        if ($insert) {
            $_SESSION['success'] = "Your booking for {$hotel['location']} is confirmed!";
            header("Location: my_bookings.php");
            exit();
        } else {
            $error = "Failed to book. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ecoland - Hotel Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Existing Styles -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Luxury Room Section */
        .luxury-room {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .luxury-room img {
            border-radius: 12px;
            width: 100%;
            height: auto;
        }

        .luxury-room h3 {
            margin-top: 15px;
            font-weight: bold;
        }

        .room-highlights {
            margin-top: 20px;
        }

        .room-highlights li {
            list-style: none;
            padding: 5px 0;
            font-size: 15px;
        }

        .take-tour {
            position: relative;
            display: inline-block;
            margin-top: 15px;
        }

        .take-tour img {
            width: 100%;
            border-radius: 10px;
        }

        .take-tour .play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
        <div id="top-alert" class="alert <?php echo isset($_SESSION['success']) ? 'alert-success' : 'alert-danger'; ?> 
            alert-dismissible fade show text-center" role="alert" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999;">
            <?php
            echo isset($_SESSION['success']) ? htmlspecialchars($_SESSION['success']) : htmlspecialchars($_SESSION['error']);
            unset($_SESSION['success'], $_SESSION['error']);
            ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>

        <script>
            setTimeout(function () {
                $("#top-alert").alert('close');
            }, 3000);
        </script>
    <?php endif; ?>

    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-4">
                    <h1 class="mb-3 bread">Book Your Hotel</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
                        <span class="mr-2"><a href="hotel.php">Hotel <i class="ion-ios-arrow-forward"></i></a></span>
                        <span><?php echo htmlspecialchars($hotel['location']); ?></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <div class="container my-5">
        <div class="row">
            <!-- Hotel Info -->
            <div class="col-md-6">
                <img src="admin/images/<?php echo $hotel['image']; ?>" class="img-fluid rounded" alt="Hotel Image">
                <h3 class="mt-3">$<?php echo $hotel['price']; ?> / night</h3>
                <div class="star-rating mb-3">
                    <?php
                    $stars = intval($hotel['star']);
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $stars ? '<i class="fas fa-star text-warning"></i>' : '<i class="far fa-star"></i>';
                    }
                    ?>
                </div>
                <ul class="room-highlights">
                    <li><strong>Size:</strong> 45 m²</li>
                    <li><strong>View:</strong> Sea View</li>
                    <li><strong>Bed:</strong> 1 King Bed</li>
                    <li><strong>Guests:</strong> Max 3 Persons</li>
                </ul>
            </div>

            <!-- Booking Form -->
            <div class="col-md-6">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" class="shadow p-4 rounded bg-light">
                    <h4 class="mb-3">Book Your Stay</h4>
                    <div class="form-group">
                        <label>Check-in Date</label>
                        <input type="date" name="checkin_date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Check-out Date</label>
                        <input type="date" name="checkout_date" class="form-control" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
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

        <!-- Luxury Room Section -->
        <div class="luxury-room mt-5">
            <h3>Luxury Room - <span class="text-success">(4 Available rooms)</span></h3>
            <p>Experience the perfect blend of comfort and elegance in our luxury rooms. Enjoy a breathtaking sea view, modern amenities, and cozy interiors designed for relaxation.</p>
            <div class="take-tour">
                <img src="admin/images/<?php echo $hotel['image']; ?>" alt="Luxury Room">
                <div class="play-btn">
                    <i class="fas fa-play fa-2x text-success"></i>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>