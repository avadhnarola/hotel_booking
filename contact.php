<?php
include "db.php";

if (isset($_POST['sendMessage'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $query = "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    $result = $conn->query($query);

}

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
                    <li class="nav-item"><a href="service.php" class="nav-link"><span>Services</span></a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link"><span>About</span></a></li>
                    <li class="nav-item"><a href="destination.php" class="nav-link"><span>Destination</span></a>
                    </li>
                    <li class="nav-item"><a href="hotel.php" class="nav-link"><span>Hotel</span></a></li>
                    <li class="nav-item"><a href="restaurant.php" class="nav-link"><span>Restaurant</span></a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link active"><span>Contact</span></a></li>
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

    <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Contact</span>
                    <h2 class="mb-4">Contact Me</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>

            <div class="row block-9">
                <div class="col-md-7 order-md-last d-flex">
                    <form method="POST" class="bg-light p-4 p-md-5 contact-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name" name="name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Subject" name="subject">
                        </div>
                        <div class="form-group">
                            <textarea id="" cols="30" rows="7" class="form-control" placeholder="Message"
                                name="message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="sendMessage" value="Send Message"
                                class="btn btn-primary py-3 px-5">
                        </div>
                    </form>

                </div>

                <div class="col-md-5 d-flex">
                    <div class="row d-flex contact-info mb-5">
                        <div class="col-md-12 ftco-animate">
                            <div class="box p-2 px-3 bg-light d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-map-signs"></span>
                                </div>
                                <div>
                                    <h3 class="mb-3">Address</h3>
                                    <p>198 West 21th Street, Suite 721 New York NY 10016</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ftco-animate">
                            <div class="box p-2 px-3 bg-light d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-phone2"></span>
                                </div>
                                <div>
                                    <h3 class="mb-3">Contact Number</h3>
                                    <p><a href="tel://1234567920">+ 1235 2355 98</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ftco-animate">
                            <div class="box p-2 px-3 bg-light d-flex">
                                <div class="icon mr-3">
                                    <span class="icon-paper-plane"></span>
                                </div>
                                <div>
                                    <h3 class="mb-3">Email Address</h3>
                                    <p><a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ftco-animate">
                            <div class="box p-2 px-3 bg-light d-flex">

                                <div class="icon mr-3">
                                    <span class="icon-globe"></span>
                                </div>
                                <div>
                                    <h3 class="mb-3">Website</h3>
                                    <p><a href="#">yoursite.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb mt-3" style="display: flex; justify-content: center;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30766863.45380839!2d60.963977322087494!3d19.72451447390969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1754400840000!5m2!1sen!2sin"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" style=" width: 1000px;"></iframe>
    </section>


    <?php include_once("footer.php"); ?>