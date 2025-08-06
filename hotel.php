<?php
include_once "db.php";
$hotels = mysqli_query($conn, "select * from hotels ORDER BY id DESC LIMIT 6");
$latestRoom = $conn->query("select * from Room ORDER BY id DESC LIMIT 1")->fetch_assoc();
$allRooms = $conn->query("select * from Room ORDER BY id DESC LIMIT 4");
if (isset($_POST['bookingSubmit'])) {
    $name = $_POST['userNameBook'];
    $email = $_POST['emailBook'];
    $checkin = $_POST['check-inBook'];
    $checkout = $_POST['check-outBook'];
    $location = $_POST['roomLocation']; // from hidden input
    $price = $_POST['roomPrice'];       // from hidden input
    $hotelType = $_POST['roomHotelType']; // from hidden input
    $status = 'Approved'; // Default status

    $query = mysqli_query($conn, "INSERT INTO booking (name, email, check_in, check_out, location, price,HotelType, status) VALUES ('$name', '$email', '$checkin', '$checkout', '$location', '$price','$hotelType' , '$status')");
    if ($query) {
        $bookingSuccess = true; // set success flag
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<?php if (@$bookingSuccess): ?>
	<div class="alert alert-success alert-dismissible fade show top-center-alert" role="alert">
		<strong><i class="bi bi-check-circle-fill"></i> Booking successfully !</strong>
		
	</div>
<?php endif; ?>




<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 4000); // hide after 5 seconds
</script>

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
    <style>
        .top-center-alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1055;
            /* higher than modal backdrop */
            width: auto;
            max-width: 90%;
        }
    </style>


</head>
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="roomTitle">Room Booking</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6">
                    <img id="roomImage" src="" alt="Room" class="img-fluid rounded">
                    <p>Please fill in the details below to book your room.</p>
                    <p class="mt-3"><strong>Location:</strong> <span id="roomLocation"></span></p>
                    <p><strong>Price:</strong> <span id="roomPrice"></span></p>
                </div>


                <div class="col-md-6">
                    <form id="bookingForm" method="POST">
                        <input type="hidden" id="roomLocationInput" name="roomLocation">
                        <input type="hidden" id="roomPriceInput" name="roomPrice">
                        <input type="hidden" id="roomHotelTypeInput" name="roomHotelType">
                        <div class="form-group">
                            <label for="guestName">Name</label>
                            <input type="text" class="form-control" id="guestName" name="userNameBook" required>
                        </div>
                        <div class="form-group">
                            <label for="guestEmail">Email</label>
                            <input type="email" class="form-control" id="guestEmail" name="emailBook" required>
                        </div>
                        <div class="form-group">
                            <label for="checkin">Check-in</label>
                            <input type="date" class="form-control" id="checkin" name="check-inBook" required>
                        </div>
                        <div class="form-group">
                            <label for="checkout">Check-out</label>
                            <input type="date" class="form-control" id="checkout" name="check-outBook" required>
                        </div>
                        <input type="submit" name="bookingSubmit" class="btn btn-primary" value="Confirm Booking">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <li class="nav-item"><a href="hotel.php" class="nav-link active"><span>Hotel</span></a></li>
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

    <section class="ftco-intro mt-5 img" id="hotel-section" style="background-image: url(images/bg_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 text-center">
                    <h2>Choose at $99 Per Night Only</h2>
                    <p>We can manage your dream building A small river named Duden flows by their place</p>
                    <p class="mb-0"><a href="#" class="btn btn-white px-4 py-3">Book a room now</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5 ">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Suggested Hotel</span>
                    <h2 class="mb-4">Find Nearest Hotel</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($hotels)) { ?>
                    <div class="col-md-6 col-lg-4 ftco-animate">
                        <div class="project">
                            <div class="img">
                                <!-- <div class="vr"><span>Sale</span></div> -->
                                <a href="#"><img src="admin/images/<?php echo $row['image']; ?>" class="img-fluid"
                                        alt="<?php echo $row['location']; ?> Image"
                                        style="height:350px;  width: 450px;"></a>
                            </div>
                            <div class="text">
                                <h4 class="price">$<?php echo $row['price']; ?></h4>
                                <h3><a href="#"><?php echo $row['location']; ?></a></h3>
                                <div class="star d-flex clearfix">
                                    <div class="mr-auto float-left">
                                        <?php
                                        for ($i = 0; $i < $row['star']; $i++) {
                                            echo '★';
                                        }
                                        for ($j = $row['star']; $j < 5; $j++) {
                                            echo '☆';
                                        }
                                        ?>
                                    </div>
                                    <div class="float-right">
                                        <span class="rate"><a href="#">( <?php echo $row['rate']; ?> )</a></span>
                                    </div>
                                </div>
                            </div>
                            <a href="admin/images/<?php echo $row['image']; ?>"
                                class="icon image-popup d-flex justify-content-center align-items-center">
                                <span class="icon-expand"></span>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row justify-content-center pb-5 pt-5">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Rooms &amp; Suites</span>
                    <h2 class="mb-4">Greece Best Rooms Offer</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
            <div class="row">
                <div class="container py-5">
                    <div class="row" id="room-content">
                        <!-- Room details loaded dynamically -->
                        <div class="col-md-12 room-wrap">
                            <div class="row">
                                <div class="col-md-7 d-flex">
                                    <div class="img align-self-stretch main-img"
                                        style="background-image: url('admin/images/<?php echo $latestRoom['image']; ?>');height:400px;">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="text pb-5">
                                        <h3><?php echo $latestRoom['title']; ?></h3>
                                        <p class="pos">from <span
                                                class="price">$<?php echo $latestRoom['price']; ?></span>/night</p>
                                        <p><?php echo $latestRoom['description']; ?></p>
                                        <p>
                                            <a href="#" class="btn btn-primary book-now-btn"
                                                data-title="<?php echo $latestRoom['title']; ?>"
                                                data-image="admin/images/<?php echo $latestRoom['image']; ?>">
                                                Book now
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thumbnail Images -->
                    <div class="col-md-12 room-wrap room-wrap-thumb mt-4">
                        <div class="row">
                            <?php while ($room = $allRooms->fetch_assoc()) { ?>
                                <div class="col-md-3">
                                    <a href="#" class="d-flex thumb"
                                        onclick="loadRoom(<?php echo $room['id']; ?>); return false;">
                                        <div class="img align-self-stretch"
                                            style="background-image: url('admin/images/<?php echo $room['image']; ?>');">
                                        </div>
                                        <div class="text pl-3 py-3">
                                            <h3><?php echo $room['title']; ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <?php include_once("footer.php"); ?>

    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                $('.book-now-btn').click(function (e) {
                    e.preventDefault();
                    var title = $(this).data('title');
                    var image = $(this).data('image');

                    $('#roomTitle').text(title);
                    $('#roomImage').attr('src', image);
                    $('#bookingModal').modal('show');
                });
            });
        });

        document.body.addEventListener('click', function (e) {
            if (e.target.classList.contains('book-now-btn')) {
                e.preventDefault();
                const title = e.target.getAttribute('data-title');
                const image = e.target.getAttribute('data-image');
                const location = e.target.getAttribute('data-location');
                const price = e.target.getAttribute('data-price');

                // Set modal values
                document.getElementById('roomTitle').textContent = title;
                document.getElementById('roomImage').src = image;
                document.getElementById('roomLocation').textContent = location;
                document.getElementById('roomPrice').textContent = "$" + price + "/night";

                // 🔽 Also set hidden input values for form submission
                document.getElementById('roomLocationInput').value = location;
                document.getElementById('roomPriceInput').value = price;
                document.getElementById('roomHotelTypeInput').value = title;

                $('#bookingModal').modal('show');
            }
        });


        function loadRoom(id) {
            fetch('get-room.php?id=' + id)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('room-content').innerHTML = html;
                })
                .catch(err => console.error('Error loading room:', err));
        }

    </script>