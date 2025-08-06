<?php
include_once "db.php";
$services = mysqli_query($conn, "select * from service ORDER BY id DESC LIMIT 4");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ecoland - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
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
                    <li class="nav-item"><a href="service.php" class="nav-link active"><span>Services</span></a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link"><span>About</span></a></li>
                    <li class="nav-item"><a href="destination.php" class="nav-link"><span>Destination</span></a>
                    </li>
                    <li class="nav-item"><a href="hotel.php" class="nav-link"><span>Hotel</span></a></li>
                    <li class="nav-item"><a href="restaurant.php" class="nav-link"><span>Restaurant</span></a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link"><span>Contact</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="home-section" class="hero">
        <img src="images/blob-shape-3.svg" class="svg-blob" alt="Colorlib Free Template">
        <div class="home-slider owl-carousel">
            <div class="slider-item">
                <div class="overlay"></div>
                <div class="container-fluid p-0">
                    <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end"
                        data-scrollax-parent="true">
                        <div class="one-third order-md-last">
                            <div class="img" style="background-image:url(images/bg_1.jpg);">
                                <div class="overlay"></div>
                            </div>
                            <div class="bg-primary">
                                <div class="vr"><span class="pl-3 py-4"
                                        style="background-image: url(images/bg_1-1.jpg);">Greece</span></div>
                            </div>
                        </div>
                        <div class="one-forth d-flex align-items-center ftco-animate"
                            data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading pl-5">Discover Greece</span>
                                <h1 class="mb-4 mt-3">Explore Your Travel Destinations like never before</h1>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country.</p>

                                <p><a href="#" class="btn btn-primary px-5 py-3 mt-3">Discover <span
                                            class="ion-ios-arrow-forward"></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item">
                <div class="overlay"></div>
                <div class="container-fluid p-0">
                    <div class="row d-flex no-gutters slider-text align-items-center justify-content-end"
                        data-scrollax-parent="true">
                        <div class="one-third order-md-last">
                            <div class="img" style="background-image:url(images/bg_2.jpg);">
                                <div class="overlay"></div>
                            </div>
                            <div class="vr"><span class="pl-3 py-4"
                                    style="background-image: url(images/bg_2-2.jpg);">Africa</span></div>
                        </div>
                        <div class="one-forth d-flex align-items-center ftco-animate"
                            data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading pl-5">Discover Africa</span>
                                <h1 class="mb-4 mt-3">Never Stop Exploring</span></h1>
                                <p>A small river named Duden flows by their place and supplies it with the necessary
                                    regelialia. It is a paradisematic country.</p>

                                <p><a href="#" class="btn btn-primary px-5 py-3 mt-3">Discover <span
                                            class="ion-ios-arrow-forward"></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-services-2" id="services-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Unique &amp; Healthy</span>
                    <h2 class="mb-4">Our Services</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
            <div class="row">
                <?php while($row=mysqli_fetch_assoc($services)){ ?>
                <div class="col-md d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services text-center d-block">
                        <div class="icon justify-content-center align-items-center d-flex"><span
                                class="<?php echo $row['icon']; ?>"></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3"><?php echo $row['title']; ?></h3>
                            <p><?php echo $row['content']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>