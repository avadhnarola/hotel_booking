<?php
session_start();
include 'db.php'; // Include database connection file
$hotels = mysqli_query($conn, "select * from hotels ORDER BY id DESC LIMIT 6");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


	<!-- Boxicons -->
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

	</div>

	<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_4.jpg');"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-start">
				<div class="col-md-9 ftco-animate pb-4">
					<h1 class="mb-3 bread">Find Your Hotel</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i
									class="ion-ios-arrow-forward"></i></a></span> <span>Hotel <i
								class="ion-ios-arrow-forward"></i></span></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 pr-lg-4">
					<div class="row">
						<?php while ($row = mysqli_fetch_assoc($hotels)) { ?>
							<div class="col-md-6 col-lg-4 ftco-animate">
								<div class="project">
									<div class="img">
										<!-- <div class="vr"><span>Sale</span></div> -->
										<a href="hotel_booking.php?hotel_id=<?php echo $row['id']; ?>"><img
												src="admin/images/<?php echo $row['image']; ?>" class="img-fluid"
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
									<a href="hotel_booking.php?hotel_id=<?php echo $row['id']; ?>"
										class="btn btn-primary book-now-btn">
										Book Now
									</a>

								</div>
							</div>
						<?php } ?>
					</div>
					<div class="row mt-5">
						<div class="col text-center">
							<div class="block-27">
								<ul>
									<li><a href="#">&lt;</a></li>
									<li class="active"><span>1</span></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">&gt;</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div> <!-- end -->
				<div class="col-lg-3 p-4 bg-light">
					<div class="search-wrap-1 ftco-animate">
						<h2 class="mb-3">Find Hotel</h2>
						<form action="#" class="search-property-1">
							<div class="row">
								<div class="col-lg-12 align-items-end mb-3">
									<div class="form-group">
										<label for="#">Places</label>
										<div class="form-field">
											<div class="icon"><span class="ion-ios-search"></span></div>
											<input type="text" class="form-control" placeholder="Search place">
										</div>
									</div>
								</div>
								<div class="col-lg-12 align-items-end mb-3">
									<div class="form-group">
										<label for="#">Check-in date</label>
										<div class="form-field">
											<div class="icon"><span class="ion-ios-calendar"></span></div>
											<input type="text" class="form-control checkin_date"
												placeholder="Check In Date">
										</div>
									</div>
								</div>
								<div class="col-lg-12 align-items-end mb-3">
									<div class="form-group">
										<label for="#">Check-out date</label>
										<div class="form-field">
											<div class="icon"><span class="ion-ios-calendar"></span></div>
											<input type="text" class="form-control checkout_date"
												placeholder="Check Out Date">
										</div>
									</div>
								</div>
								<div class="col-lg-12 align-items-end mb-3">
									<div class="form-group">
										<label for="#">Price Limit</label>
										<div class="form-field">
											<div class="select-wrap">
												<div class="icon"><span class="ion-ios-arrow-down"></span></div>
												<select name="" id="" class="form-control">
													<option value="">$5,000</option>
													<option value="">$10,000</option>
													<option value="">$50,000</option>
													<option value="">$100,000</option>
													<option value="">$200,000</option>
													<option value="">$300,000</option>
													<option value="">$400,000</option>
													<option value="">$500,000</option>
													<option value="">$600,000</option>
													<option value="">$700,000</option>
													<option value="">$800,000</option>
													<option value="">$900,000</option>
													<option value="">$1,000,000</option>
													<option value="">$2,000,000</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 align-self-end">
									<div class="form-group">
										<div class="form-field">
											<input type="submit" value="Search" class="form-control btn btn-primary">
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div> <!-- end -->
			</div>
		</div>
	</section>


	<footer class="ftco-footer ftco-section">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">About <span><a href="index.html">Ecoland</a></span></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
							there live the blind texts.</p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
							<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-4">
						<h2 class="ftco-heading-2">Information</h2>
						<ul class="list-unstyled">
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Online Enquiry</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>General Enquiry</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Booking</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Privacy</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Refund Policy</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Call Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Experience</h2>
						<ul class="list-unstyled">
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Adventure</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Hotel and Restaurant</a>
							</li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Beach</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Nature</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Camping</a></li>
							<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Party</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain
										View, San Francisco, California, USA</span></li>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929
											210</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span
											class="text">info@yourdomain.com</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">

					<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;
						<script>document.write(new Date().getFullYear());</script> All rights reserved | This template
						is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a
							href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</div>
	</footer>



	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00" />
		</svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>

	<script src="js/main.js"></script>
	<script>
		// Logout confirmation
		function confirmLogout() {
			return confirm("Are you sure you want to logout?");
		}
	</script>

</body>

</html>