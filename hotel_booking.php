<?php
session_start();
ob_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login to book a hotel.";
    header("Location: index.php");
    exit();
}

// Validate hotel ID
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

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $checkin = mysqli_real_escape_string($conn, $_POST['checkin_date']);
    $checkout = mysqli_real_escape_string($conn, $_POST['checkout_date']);
    $guests = intval($_POST['guests']);

    $today = date('Y-m-d');

    if ($checkin < $today) {
        $error = "Check-in date cannot be in the past.";
    } elseif ($checkout <= $checkin) {
        $error = "Check-out date must be after the check-in date.";
    } else {
        $insert = mysqli_query($conn, "
            INSERT INTO hotelBookings (user_id, hotel_id, checkin_date, checkout_date, guests)
            VALUES ('$user_id', '$hotel_id', '$checkin', '$checkout', '$guests')
        ");

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
    <title>Ecoland</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Other CSS -->
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .avatar-upload {
            position: relative;
            max-width: 150px;
            margin: 20px auto;
        }

        .avatar-upload input {
            display: none;
        }

        .avatar-upload img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px solid #ddd;
            object-fit: cover;
            cursor: pointer;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .hotel-details {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .hotel-image img {
            border-radius: 15px;
            width: 100%;
            height: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .hotel-title {
            font-size: 28px;
            font-weight: 700;
        }

        .hotel-price {
            font-size: 22px;
            color: #e2c0bb;
            font-weight: bold;
        }

        .star-rating i {
            color: #ffc107;
            font-size: 18px;
        }

        .facilities {
            margin-top: 15px;
        }

        .facilities i {
            color: #e2c0bb;
            margin-right: 8px;
            font-size: 18px;
        }

        .booking-form {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .booking-form button {
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <!-- Success / Error Alerts -->
    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
            <div id="top-alert" class="alert 
            <?php echo isset($_SESSION['success']) ? 'alert-success' : 'alert-danger'; ?> 
            alert-dismissible fade show text-center" 
                role="alert" 
                style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; width: auto; min-width: 300px;">
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">Ecoland</a>
            <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav nav ml-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link"><span>Home</span></a></li>
                    <li class="nav-item"><a href="service.php" class="nav-link"><span>Services</span></a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link"><span>About</span></a></li>
                    <li class="nav-item"><a href="room.php" class="nav-link"><span>Rooms</span></a></li>
                    <li class="nav-item"><a href="hotel.php" class="nav-link"><span>Hotel</span></a></li>
                    <li class="nav-item"><a href="restaurant.php" class="nav-link"><span>Restaurant</span></a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link"><span>Contact</span></a></li>
                </ul>
            </div>

            <!-- Dynamic Login / User Display -->
            <div class="login-btn ml-5">
                <?php if (isset($_SESSION['user'])): ?>
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $_SESSION['user']['avatar'] ?: './admin/images/user-profile.jpg'; ?>" 
                                alt="Avatar" class="rounded-circle mr-2" 
                                style="width:40px; height:40px; object-fit:cover;">
                            <span class="text-black mr-3"><?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></span>
                            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
                        </div>
                <?php else: ?>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                            <i class="bx bx-user"></i> Login
                        </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

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

    <!-- Hotel Details -->
    <div class="container my-5">
        <div class="row">
            <!-- Left Side: Info -->
            <div class="col-md-6">
                <div class="hotel-details">
                    <h2 class="hotel-title"><?php echo htmlspecialchars($hotel['location']); ?></h2>
                    <p class="hotel-price">$<?php echo $hotel['price']; ?> / night</p>

                    <div class="star-rating mb-3">
                        <?php
                        $stars = intval($hotel['star']);
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $stars ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                        }
                        ?>
                    </div>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis nam natus expedita commodi
                        autem voluptates aspernatur non placeat voluptatibus accusantium maxime, esse aut harum quo
                        deserunt nihil, porro odit? Omnis!</p>

                    <!-- Facilities -->
                    <div class="facilities">
                        <p><i class="fas fa-wifi"></i> Free Wi-Fi</p>
                        <p><i class="fas fa-swimmer"></i> Swimming Pool</p>
                        <p><i class="fas fa-utensils"></i> Free Breakfast</p>
                        <p><i class="fas fa-car"></i> Free Parking</p>
                        <p><i class="fas fa-snowflake"></i> Air Conditioning</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Image -->
            <div class="col-md-6 hotel-image">
                <img src="admin/images/<?php echo $hotel['image']; ?>" alt="Hotel Image">
            </div>
        </div>

        <!-- Booking Form -->
        <div class="booking-form mt-5">
            <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <h4 class="mb-3">Book Your Stay</h4>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Check-in Date</label>
                        <input type="date" name="checkin_date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Check-out Date</label>
                        <input type="date" name="checkout_date" class="form-control" required min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Guests</label>
                        <input type="number" name="guests" class="form-control" min="1" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg">Confirm Booking</button>
                <a href="hotel.php" class="btn btn-secondary btn-lg ml-2">Back to Hotels</a>
            </form>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Switch between Login & Register Modals
        $("#showRegisterModal").click(function (e) {
            e.preventDefault();
            $("#loginModal").modal("hide");
            setTimeout(() => {
                $("#registerModal").modal("show");
            }, 500);
        });

        $("#showLoginModal").click(function (e) {
            e.preventDefault();
            $("#registerModal").modal("hide");
            setTimeout(() => {
                $("#loginModal").modal("show");
            }, 500);
        });

        // Avatar Preview
        $("#avatarInput").change(function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $("#avatarPreview").attr("src", e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
