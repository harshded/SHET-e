<!DOCTYPE html>
<html lang="en">
<?php
include './includes/head.php';
?>

<body class="goto-here">
	<?php
	include './includes/header.php';

	?>
	<!-- END nav -->

	<section id="home-section" class="hero">
		<div class="home-slider owl-carousel">
			<div class="slider-item" style="background-image: url(images/bg_1.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

						<div class="col-md-12 ftco-animate text-center">
							<h1 class="mb-2">We serve Fresh Vegetables &amp; Fruits</h1>
							<h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
							<p><a href="aboutus.php" class="btn btn-primary">View Details</a></p>
						</div>

					</div>
				</div>
			</div>

			<div class="slider-item" style="background-image: url(images/bg_2.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

						<div class="col-sm-12 ftco-animate text-center">
							<h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
							<h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
							<p><a href="#" class="btn btn-primary">View Details</a></p>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row no-gutters ftco-services">
				<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services mb-md-0 mb-4">
						<div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
							<span class="flaticon-shipped"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Early Shipping</h3>
							<span>On order over ₹500 </span>
						</div>
					</div>
				</div>
				<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services mb-md-0 mb-4">
						<div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
							<span class="flaticon-diet"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Always Fresh</h3>
							<span>Product well package</span>
						</div>
					</div>
				</div>
				<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services mb-md-0 mb-4">
						<div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
							<span class="flaticon-award"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Superior Quality</h3>
							<span>Quality Products</span>
						</div>
					</div>
				</div>
				<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services mb-md-0 mb-4">
						<div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
							<span class="flaticon-customer-service"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Support</h3>
							<span>24/7 Support</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Featured Products</span>
					<h2 class="mb-4">Our Products</h2>
					<p>Celebrate Life with Fresh Fruits and Veggies.</p>
				
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row justify-content-center">
				<?php
				if (isset($_SESSION['status'])) {
				?>
					<!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Hey</strong><?php echo $_SESSION['status']; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div> -->
					<script>
						Swal.fire({
							icon: 'success',
							title: 'Cart',
							text: 'Added to cart',
						})
					</script>
				<?php
					unset($_SESSION['status']);
				}
				?>
				<div class="col-md-10 mb-5 text-center">
					<ul class="product-category">
						<li><a href="shop.php" class="active">All</a></li>
						<!-- <li><a href="#">Vegetables</a></li>
    					<li><a href="#">Fruits</a></li> -->

					</ul>
				</div>
			</div>
			<div class="row">
				<?php
				

				// Fetch all records from the product table

				// Assuming you have an active database connection named $conn

// SQL query with placeholders


$sql = "SELECT id, name, description, price, qty, sp_price, image_name FROM product ORDER BY RAND() LIMIT 8";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt) {
    // Execute the statement
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($id, $name, $description, $price, $qty, $sp_price, $image);

    // Fetch the results in a loop
    while ($stmt->fetch()) {
        // Use the fetched data as needed

				?><div class="col-md-6 col-lg-3 ftco-animate">
							<div class="product">
								<a href="product_single.php?id=<?php echo $id ?>" class="img-prod" target="_blank">
									<img class="img-fluid" style="
										width: 253px;
										height: 203px;
										object-fit: fill;
									" src="./images/<?php echo $image;?>" alt="Colorlib Template">
									<span class="status"><?php
															//$originalPrice = $row["price"]; // Original price
															//$discountedPrice = $row["sp_price"]; // Discounted price

															// Calculate the discount percentage
															$discountPercentage = (($price - $sp_price) / $price) * 100;

															// Print the discount percentage
															echo intval($discountPercentage) . "%";
															?></span>
									<div class="overlay"></div>
								</a>
								<div class="text py-3 pb-4 px-3 text-center">
									<h3><a href="#"><?php echo $name; ?></a></h3>
									<div class="d-flex">
										<div class="pricing">
											<p class="price"><span class="mr-2 price-dc">₹<?php echo $price ;?></span><span class="price-sale">₹<?php echo $sp_price; ?></span></p>
										</div>
									</div>
									<div class="bottom-area d-flex px-3">
										<div class="m-auto d-flex">
											<a href="product_single.php?id=<?php echo $id; ?>" class="add-to-cart d-flex justify-content-center align-items-center text-center" target="_blank">
												<span><i class="ion-ios-menu"></i></span>
											</a>
											<a href="addToCart.php?id=<?php echo $id; ?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
												<span><i class="ion-ios-cart"></i></span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php
				 // Close the statement
				 
					}
					$stmt->close();
				} else {
					echo "<p>No products found.</p>";
				}

				// Close the database connection
				
				?>
			</div>
		</div>
		
		<!-- <a href="#" class="heart d-flex justify-content-center align-items-center ">
	    								<span><i class="ion-ios-heart"></i></span>
	    							</a> -->
		<div class="row mt-5">
			<div class="col text-center">
				<div class="block-27">
					<!-- <ul>
							<li><a href="#">&lt;</a></li>
							<li class="active"><span>1</span></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">&gt;</a></li>
						</ul> -->
					<ul>
						
					</ul>
				</div>
			</div>
		</div>
		</div>
	</section>

	<section class="ftco-section img" style="background-image: url(images/bg_3.jpg);">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
					<span class="subheading">Best Price For You</span>
					<h2 class="mb-4">All Deals are Deals of the day</h2>
					<p>Celebrate Life with Fresh Fruits and Veggies.</p>
					
					<!-- <div id="timer" class="d-flex mt-5">
						<div class="time" id="days"></div>
						<div class="time pl-3" id="hours"></div>
						<div class="time pl-3" id="minutes"></div>
						<div class="time pl-3" id="seconds"></div>
					</div> -->
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section testimony-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<span class="subheading">Testimony</span>
					<h2 class="mb-4">Our satisfied customer says</h2>
					<p>Far far away, behind the word mountains, far from the  States and Localities, there
						live the blind texts. Separated they live in</p>
				</div>
			</div>
			<div class="row ftco-animate">
				<div class="col-md-12">
					<div class="carousel-testimony owl-carousel">
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/person_1.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">I absolutely love the freshness and taste of the fruits
										and vegetables I order from Shet-e.
										They arrive quickly and are always in top-notch condition. Highly recommended!"
										</p>
									<p class="name">-Abhimeet Singh</p>
									<!-- <span class="position">Marketing Manager</span> -->
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/person_2.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">
										 "I am so impressed with the quality of the produce I
										received from Shet-e.
										The strawberries were sweet and juicy, and the veggies were fresh and crisp. I
										will definitely be ordering from them again!" </p>
									<p class="name">-Pranav Golande</p>
									<!-- <span class="position">Interface Designer</span> -->
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/person_3.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line"> "The variety of fruits and vegetables available at
										Shet-e is outstanding!
										I love that they offer organic options, and the produce always tastes so fresh.
										Best online produce shopping experience ever!" </p>
									<p class="name">-Harshad Malgonde</p>
									<!-- <span class="position">UI Designer</span> -->
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/person_4.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">"I'm health-conscious and always looking for the
										freshest organic produce.
										Shet-e not only meets but exceeds my expectations every time. Their dedication
										to quality and sustainability is commendable. So glad I found this gem!" </p>
									<p class="name">-Pranav Dinkar</p>
									<!-- <span class="position">Web Developer</span> -->
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/person_5.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">"Living in a rural area, it's challenging to find
										fresh produce locally.
										Shet-e has been a game-changer for me. The packaging is excellent, and the
										fruits and veggies arrive in perfect condition every time. I'm a happy, repeat
										customer!"</p>
									<p class="name">-Athrva bankar</p>
									<!-- <span class="position">System Analyst</span> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<hr>
<!-- 
	<section class="ftco-section ftco-partner">
		<div class="container">
			<div class="row">
				<div class="col-sm ftco-animate">
					<a href="#" class="partner"><img src="images/partner-1.png" class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-sm ftco-animate">
					<a href="#" class="partner"><img src="images/partner-2.png" class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-sm ftco-animate">
					<a href="#" class="partner"><img src="images/partner-3.png" class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-sm ftco-animate">
					<a href="#" class="partner"><img src="images/partner-4.png" class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-sm ftco-animate">
					<a href="#" class="partner"><img src="images/partner-5.png" class="img-fluid" alt="Colorlib Template"></a>
				</div>
			</div>
		</div>
	</section> -->

	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">
			<div class="row d-flex justify-content-center py-5">
				<div class="col-md-6">
					<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
					<span>Get e-mail updates about our latest shops and special offers</span>
				</div>
				<div class="col-md-6 d-flex align-items-center">
					<form action="#" class="subscribe-form">
						<div class="form-group d-flex">
							<input type="text" class="form-control" placeholder="Enter email address">
							<input type="submit" value="Subscribe" class="submit px-3">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	

	<!-- footer php include -->
	<?php
	include './includes/footer.php';
	?>




	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
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
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>
	

</body>

</html>