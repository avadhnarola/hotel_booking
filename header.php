<?php
session_start();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Your existing styles -->
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
    </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <?php if (isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
        <div id="top-alert" class="alert 
        <?php echo isset($_SESSION['success']) ? 'alert-success' : 'alert-danger'; ?> 
        alert-dismissible fade show text-center" role="alert" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); 
               z-index: 9999; width: auto; min-width: 300px;">
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


    <!-- Registration Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title"><i class="bx bx-user-plus"></i> Register</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="register.php" method="POST" enctype="multipart/form-data">
                        <!-- Avatar Upload -->
                        <div class="avatar-upload text-center">
                            <label for="avatarInput">
                                <img id="avatarPreview" src="./admin/images/user-profile.jpg" alt="Avatar Preview">
                            </label>
                            <input type="file" id="avatarInput" name="avatar" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Your name" required>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
                    </form>

                    <p class="mt-3 text-center">
                        Already have an account?
                        <a href="#" id="showLoginModal">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bx bx-user"></i> Login</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-success btn-block">Login</button>
                    </form>

                    <p class="mt-3 text-center">
                        Don't have an account?
                        <a href="#" id="showRegisterModal">Create an account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
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
                    <li class="nav-item"><a href="hotel.php" class="nav-link"><span>Hotel</span></a></li>
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

    <script>
        // Logout confirmation
        function confirmLogout() {
            return confirm("Are you sure you want to logout?");
        }
    </script>
    <!-- Modal switching & avatar preview -->
    <script>
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