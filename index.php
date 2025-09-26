<?php
include("header.php");
include_once "db.php";
$services = mysqli_query($conn, "select * from service ORDER BY id DESC LIMIT 4");
$hotels = mysqli_query($conn, "select * from hotels ORDER BY id DESC LIMIT 6");
$restaurant = mysqli_query($conn, "select * from restaurant ORDER BY id DESC LIMIT 3");
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



<!DOCTYPE html>
<html lang="en">

<head>
	<title>Ecoland - A Ticket Booking Site</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

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
		.img {
			background-size: cover;
			background-position: center;
			width: 100%;
			height: 100%;
		}

		.thumb .img {
			height: 100px;
		}

		.room-wrap-thumb .thumb {
			cursor: pointer;
		}

		.main-img {
			height: 400px;
		}

		/* Container */
		.search-container {
			background: #fff;
			padding: 30px 40px;
			border-radius: 15px;
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
			max-width: 1000px;
			width: 100%;
		}

		.search-container h2 {
			text-align: center;
			margin-bottom: 10px;
			color: #333;
		}

		.search-container p {
			text-align: center;
			margin-bottom: 30px;
			color: #666;
		}

		/* Form layout */
		.search-form {
			display: flex;
			flex-wrap: wrap;
			gap: 20px;
		}

		.search-form{
			background-color: #fff;
			border-radius: 15px;
			box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
		}

		.form-field {
			position: relative;
			flex: 1 1 200px;
		}

		.form-field label {
			display: block;
			margin-bottom: 5px;
			font-weight: 600;
			color: #333;
		}

		.form-field input,
		.form-field select {
			width: 100%;
			padding: 12px 40px 12px 15px;
			border: 1px solid #ccc;
			border-radius: 8px;
			outline: none;
			font-size: 16px;
			transition: all 0.3s;
		}

		.form-field input:focus,
		.form-field select:focus {
			border-color: #007bff;
			box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
		}

		.form-field .icon {
			position: absolute;
			top: 50%;
			left: 12px;
			transform: translateY(-50%);
			color: #888;
			font-size: 18px;
		}

		/* Submit button */
		.form-submit {
			flex: 1 1 150px;
			align-self: flex-end;
		}

		.form-submit button {
			width: 100%;
			padding: 12px;
			background: #ffba00;
			color: #0c3b2e;
			font-size: 16px;
			font-weight: 600;
			border: none;
			border-radius: 8px;
			cursor: pointer;
			transition: background 0.3s;
		}

		.form-submit button:hover {
			background: #ffba00;
		}

		/* Responsive */
		@media (max-width: 768px) {
			.search-form {
				flex-direction: column;
			}

			.form-submit {
				align-self: stretch;
			}
		}
	</style>
</head>
<!-- Booking Modal -->
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
						<div class="bg-primary" style="background-color: #0c3b2e;">
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

<section class="ftco-section ftco-no-pb ftco-no-pt">
	<div class="container text-center mt-5">
		<div class="row justify-content-center pb-0 pb-mb-5 pt-5 pt-md-0">
			<div class="col-md-12 heading-section ftco-animate">

				<h2 class="mb-4">Where do you want to go?</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="search-wrap">
					<form class="search-form" action="#">
						<!-- Destination -->
						<div class="form-field">
							<label for="destination">Destination</label>
							
							<input type="text" id="destination" placeholder="Search place">
						</div>

						<!-- Check-in -->
						<div class="form-field">
							<label for="checkin">Check-in</label>
							
							<input type="date" id="checkin">
						</div>

						<!-- Check-out -->
						<div class="form-field">
						
							<label for="checkout">Check-out</label>
							<input type="date" id="checkout">
						</div>

						<!-- Price Limit -->
						<div class="form-field">
							<label for="price">Price Limit</label>
							
							<select id="price">
								<option value="">$5,000</option>
								<option value="">$10,000</option>
								<option value="">$50,000</option>
								<option value="">$100,000</option>
								<option value="">$200,000</option>
								<option value="">$500,000</option>
								<option value="">$1,000,000</option>
							</select>
						</div>

						<!-- Submit -->
						<div class="form-submit">
							<button type="submit">Search</button>
						</div>
					</form>
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
			<?php while ($row = mysqli_fetch_assoc($services)) { ?>
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

<section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
	<div class="container">
		<div class="row no-gutters d-flex">
			<div class="col-md-6 col-lg-5 d-flex">
				<div class="img d-flex align-self-stretch align-items-center"
					style="background-image:url(images/about.jpg);">
				</div>
			</div>
			<div class="col-md-6 col-lg-7 px-lg-5 py-md-5" style="background-color: #6d9773;">
				<div class="py-md-5">
					<div class="row justify-content-start pb-3">
						<div class="col-md-12 heading-section22 heading-section ftco-animate p-5 p-lg-0">
							<span class="subheading">Get in touch with us</span>
							<h2 class="mb-4">Get Best Travel Deals</h2>
							<p>A small river named Duden flows by their place and supplies it with the necessary
								regelialia. It is a paradisematic country, in which roasted parts of sentences fly
								into
								your mouth.</p>
							<p>Even the all-powerful Pointing has no control about the blind texts it is an almost
								unorthographic life One day however a small line of blind text by the name of Lorem
								Ipsum decided to leave for the far World of Grammar.</p>
							<p>A small river named Duden flows by their place and supplies it with the necessary
								regelialia. It is a paradisematic country, in which roasted parts of sentences fly
								into
								your mouth.</p>
							<p><a href="#" class="btn btn-primary py-3 px-4">Book now</a> <a href="#"
									class="btn btn-white py-3 px-4">Contact us</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-intro img mt-3" id="destination-section" style="background-image: url(images/bg_3.jpg);">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 text-center">
				<h2>Choose the Perfect Destination</h2>
				<p>We can manage your dream building A small river named Duden flows by their place</p>
				<p class="mb-0"><a href="#" class="btn btn-white px-4 py-3">Search Places</a></p>
			</div>
		</div>
	</div>
</section>
<section class="ftco-section">
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
										class="price">$<?php echo $latestRoom['price']; ?></span>/night
								</p>
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
							<a href="#" class="d-flex thumb" onclick="loadRoom(<?php echo $room['id']; ?>); return false;">
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
</section>

<section class="ftco-intro img" id="hotel-section" style="background-image: url(images/bg_4.jpg);">
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
		<div class="row justify-content-center pb-5">
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
							<a href="hotel_booking.php?hotel_id=<?php echo $row['id']; ?>"><img
									src="admin/images/<?php echo $row['image']; ?>" class="img-fluid"
									alt="<?php echo $row['location']; ?> Image" style="height:350px;  width: 450px;"></a>
						</div>
						<div class="text">
							<h4 class="price">$<?php echo $row['price']; ?></h4>
							<h3><a href="#"><?php echo $row['name']; ?></a></h3>
							<h6 class="location"><i class="fas fa-map-marker-alt"
									style="margin-right:8px;"></i><?php echo $row['location']; ?></h6>
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
						<a href="hotel_booking.php?hotel_id=<?php echo $row['id']; ?>" class="btn btn-primary book-now-btn">
							Book Now
						</a>
					</div>
				</div>
			<?php } ?>
		</div>

	</div>
</section>

<section class="ftco-section testimony-section">
	<img src="images/blob-shape-2-yellow.svg" class="svg-blob" alt="Colorlib Free Template">
	<img src="images/blob-shape-2-yellow.svg" class="svg-blob-2" alt="Colorlib Free Template">
	<div class="container">
		<div class="row justify-content-center pb-3">
			<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
				<span class="subheading">Read testimonials</span>
				<h2 class="mb-4">What Client Says</h2>
			</div>
		</div>
		<div class="row ftco-animate justify-content-center">
			<div class="col-md-12">
				<div class="carousel-testimony owl-carousel ftco-owl">
					<div class="item">
						<div class="testimony-wrap text-center py-4 pb-5">
							<div class="user-img" style="background-image: url(images/person_1.jpg)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text px-4 pb-5">
								<p class="mb-4" style="height:130px;">Quick booking, great deals, and smooth
									experience. Got instant confirmation. Very satisfied and will book future stays
									here again!</p>
								<p class="name">Sarah Mitchell</p>
								<span class="position">Travel Blogger</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap text-center py-4 pb-5">
							<div class="user-img" style="background-image: url(images/person_2.jpg)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text px-4 pb-5">
								<p class="mb-4" style="height:130px;">Hotel options were diverse and affordable. The
									booking was seamless, and check-in went smoothly. Fantastic experience overall,
									thank you!</p>
								<p class="name">James Tan</p>
								<span class="position">Operations Manager</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap text-center py-4 pb-5">
							<div class="user-img" style="background-image: url(images/person_3.jpg)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text px-4 pb-5">
								<p class="mb-4" style="height:130px;">Efficient booking system with amazing
									discounts. I appreciated the clear details and fast confirmation. Everything was
									perfectly organized and reliable</p>
								<p class="name">Priya Sharma</p>
								<span class="position">HR Executive</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap text-center py-4 pb-5">
							<div class="user-img" style="background-image: url(images/person_4.jpg)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text px-4 pb-5">
								<p class="mb-4" style="height:130px;">User-friendly website with excellent hotel
									choices. Customer support was responsive and helpful. Will use this service
									again for sure!</p>
								<p class="name">Daniel Ruiz</p>
								<span class="position">Freelance Photographer</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap text-center py-4 pb-5">
							<div class="user-img" style="background-image: url(images/person_5.jpg)">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="icon-quote-left"></i>
								</span>
							</div>
							<div class="text px-4 pb-5">
								<p class="mb-4" style="height:130px;">The booking process was fast and easy. Found
									the perfect hotel at a great price. Highly recommended for travelers!</p>
								<p class="name">Linia Chings</p>
								<span class="position">Event Coordinator</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section" id="restaurant-section">
	<div class="container">
		<div class="row justify-content-center pb-5">
			<div class="col-md-12 heading-section text-center ftco-animate">
				<span class="subheading">Restaurant</span>
				<h2 class="mb-4">Near Resturant</h2>
				<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
			</div>
		</div>
		<div class="row">

			<?php while ($row = mysqli_fetch_assoc($restaurant)) { ?>

				<div class="col-md-6 col-lg-4 ftco-animate">
					<div class="project">
						<div class="img">
							<img src="admin/images/<?php echo $row['image']; ?>" class="img-fluid"
								alt="<?php echo $row['location']; ?> Image" style="height:350px;  width: 450px;">
						</div>
						<div class="text">
							<h4 class="price"><span class="mr-2">menu start at</span>$<?php echo $row['price']; ?>.00
							</h4>
							<span><?php echo $row['shopName']; ?></span>
							<h3><a href="project.html"><?php echo $row['location']; ?></a></h3>
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
									<span class="rate"><a href="#">(<?php echo $row['rate']; ?>)</a></span>
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
				<form action="#" class="bg-light p-4 p-md-5 contact-form">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Your Name">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Your Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Subject">
					</div>
					<div class="form-group">
						<textarea name="" id="" cols="30" rows="7" class="form-control"
							placeholder="Message"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
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

<section class="ftco-section ftco-no-pt ftco-no-pb">
	<div id="map" class="bg-white"></div>
</section>

<section class="ftco-gallery">
	<div class="container-fluid px-0">
		<div class="row no-gutters">
			<div class="col-md-4 col-lg-2 ftco-animate">
				<a href="images/gallery-1.jpg" class="gallery image-popup img d-flex align-items-center"
					style="background-image: url(images/gallery-1.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-lg-2 ftco-animate">
				<a href="images/gallery-2.jpg" class="gallery image-popup img d-flex align-items-center"
					style="background-image: url(images/gallery-2.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-lg-2 ftco-animate">
				<a href="images/gallery-3.jpg" class="gallery image-popup img d-flex align-items-center"
					style="background-image: url(images/gallery-3.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-lg-2 ftco-animate">
				<a href="images/gallery-4.jpg" class="gallery image-popup img d-flex align-items-center"
					style="background-image: url(images/gallery-4.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-lg-2 ftco-animate">
				<a href="images/gallery-5.jpg" class="gallery image-popup img d-flex align-items-center"
					style="background-image: url(images/gallery-5.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-lg-2 ftco-animate">
				<a href="images/gallery-6.jpg" class="gallery image-popup img d-flex align-items-center"
					style="background-image: url(images/gallery-6.jpg);">
					<div class="icon mb-4 d-flex align-items-center justify-content-center">
						<span class="icon-instagram"></span>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>
<?php include("footer.php"); ?>
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

	document.getElementById('bookingForm').addEventListener('submit', function (e) {
		const checkin = new Date(document.getElementById('checkin').value);
		const checkout = new Date(document.getElementById('checkout').value);

		if (checkin >= checkout) {
			e.preventDefault();
			alert("Check-out date must be after check-in date.");
		}
	});
</script>