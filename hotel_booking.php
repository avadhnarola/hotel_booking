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

// Process room images (comma separated)
$room_images = [];
if (!empty($hotel['room_images'])) {
    $room_images = explode(",", $hotel['room_images']);
}

// Process services (comma separated)
$services = [];
if (!empty($hotel['services'])) {
    $services = explode(",", $hotel['services']);
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
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
        .hotel-details {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .hotel-title {
            font-size: 28px;
            font-weight: 700;
        }

        .hotel-price {
            font-size: 22px;
            color: #FF6F61;
            font-weight: bold;
        }

        .star-rating i {
            color: #ffc107;
            font-size: 18px;
        }

        .hotel-image img {
            border-radius: 15px;
            width: 100%;
            height: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        /* Room images grid */
        .room-images {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }

        .room-images img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .room-images img:hover {
            transform: scale(1.05);
        }

        /* Services */
        .hotel-services {
            margin-top: 20px;
        }

        .hotel-services h5 {
            margin-bottom: 10px;
            font-weight: 600;
        }

        .hotel-services span {
            display: inline-block;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 25px;
            padding: 6px 15px;
            margin: 5px 8px 5px 0;
            font-size: 14px;
            font-weight: 500;
        }

        .hotel-services i {
            margin-right: 6px;
            color: #17a2b8;
        }

        /* Premium Button Styling */
        .premium-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 5px 25px;
            background-color: transparent;
            color: #FF6F61;
            /* Gold text */
            font-size: 16px;
            margin-top: 5px;
            border: 2px solid #FF6F61;
            /* Gold border */
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        .premium-btn i {
            font-size: 14px;
            color: #FF6F61;
        }

        /* Hover Effects */
        .premium-btn:hover {
            background-color: #FF6F61;
            color: #fff;
            /* Purple text */
            transform: scale(1.08);
            text-decoration: none;
        }

        .premium-btn:hover i {
            color: #fff;
        }

        .logout-icon {
            color: #dc3545;
            font-size: 22px;
            margin-left: 10px;
            transition: all 0.3s ease-in-out;
        }

        .logout-icon:hover {
            color: #b02a37;
            transform: scale(1.3) rotate(-15deg);
            text-decoration: none;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <!-- Alerts -->
    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
        <div id="top-alert"
            class="alert <?php echo isset($_SESSION['success']) ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show text-center"
            role="alert"
            style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; min-width: 300px;">
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

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target"
        id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">Ecoland</a>
            <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse"
                data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav nav ml-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link"><span>Home</span></a></li>
                    <li class="nav-item"><a href="service.php" class="nav-link"><span>Services</span></a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link"><span>About</span></a></li>
                    <!-- <li class="nav-item"><a href="room.php" class="nav-link"><span>Rooms</span></a></li> -->
                    <li class="nav-item active"><a href="hotel.php" class="nav-link"><span>Hotel</span></a></li>
                    <li class="nav-item"><a href="restaurant.php" class="nav-link"><span>Restaurant</span></a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link"><span>Contact</span></a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item"><a href="my_bookings.php" class="premium-btn">
                                <i class="fas fa-hotel"></i> My Booking
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Dynamic Login / User Display -->
            <div class="login-btn ml-5">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="d-flex align-items-center">
                        <img src="<?php echo $_SESSION['user']['avatar'] ?: './admin/images/user-profile.jpg'; ?>"
                            alt="Avatar" class="rounded-circle mr-2" style="width:40px; height:40px; object-fit:cover; ">
                        <span class="text-black mr-3"
                            style="color:#000;"><?php echo htmlspecialchars($_SESSION['user']['fullname']); ?></span>

                        <a href="logout.php" class="logout-icon" title="Logout" onclick="return confirmLogout();">
                            <i class="fas fa-door-open"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                        <i class="bx bx-user"></i> Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-4">
                    <h1 class="mb-3 bread">Book Your Hotel</h1>
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
                        <span class="mr-2"><a href="hotel.php">Hotel <i class="ion-ios-arrow-forward"></i></a></span>
                        <span><?php echo htmlspecialchars($hotel['name']); ?></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hotel Details -->
    <div class="container my-5">
        <div class="row">
            <!-- Left: Info -->
            <div class="col-md-6">
                <div class="hotel-details">
                    <h2 class="hotel-title"><?php echo htmlspecialchars($hotel['name']); ?></h2>
                    <h6><i class="fa fa-map-marker-alt"></i> <?php echo $hotel['location']; ?></h6>
                    <p class="hotel-price">$<?php echo $hotel['price']; ?> / night</p>

                    <div class="star-rating mb-3">
                        <?php
                        $stars = intval($hotel['star']);
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $stars ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                        }
                        ?>
                    </div>

                    <p><?php echo $hotel['description']; ?></p>

                    <!-- ✅ Services Section -->
                    <?php if (!empty($services)): ?>
                        <div class="hotel-services">
                            <h5>Services & Amenities</h5>
                            <?php foreach ($services as $service): ?>
                                <?php
                                $service = strtolower(trim($service));
                                switch ($service) {
                                    case 'wifi':
                                        $icon = 'fa-wifi';
                                        break;
                                    case 'pool':
                                    case 'swimming':
                                        $icon = 'fa-swimming-pool';
                                        break;
                                    case 'parking':
                                        $icon = 'fa-parking';
                                        break;
                                    case 'gym':
                                        $icon = 'fa-dumbbell';
                                        break;
                                    case 'spa':
                                        $icon = 'fa-spa';
                                        break;
                                    case 'restaurant':
                                        $icon = 'fa-utensils';
                                        break;
                                    case 'ac':
                                    case 'air conditioning':
                                        $icon = 'fa-wind';
                                        break;
                                    default:
                                        $icon = 'fa-check-circle';
                                }
                                ?>
                                <span><i class="fas <?php echo $icon; ?>"></i> <?php echo ucfirst($service); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <!-- ✅ End Services -->
                </div>
            </div>

            <!-- Right: Main + Room Images -->
            <div class="col-md-6 hotel-image">
                <img src="admin/images/<?php echo $hotel['image']; ?>" alt="Hotel Image">

                <?php if (!empty($room_images)): ?>
                    <div class="room-images">
                        <?php foreach ($room_images as $img): ?>
                            <img src="admin/images/<?php echo trim($img); ?>" alt="Room Image">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
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
                        <input type="date" name="checkin_date" class="form-control" required
                            min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Check-out Date</label>
                        <input type="date" name="checkout_date" class="form-control" required
                            min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Guests</label>
                        <input type="number" name="guests" class="form-control" min="1" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Book Now</button>
                <a href="hotel.php" class="btn btn-secondary">Back to Hotels</a>
            </form>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to logout?");
        }
    </script>
</body>

</html>