<!DOCTYPE html>
<html lang="en">
<?php
include './includes/head.php';
?>

<body class="goto-here">

	<?php
	include './includes/header.php';
	?>


	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
					<h1 class="mb-0 bread">Products</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
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
						<li><a href="#" class="active">All</a></li>
						<!-- <li><a href="#">Vegetables</a></li>
    					<li><a href="#">Fruits</a></li> -->

					</ul>
				</div>
			</div>
			<div class="row">
				<?php
				require_once('./functions/db.php');

				$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page number
				$itemsPerPage = 8; // Number of items to display per page

				$offset = ($page - 1) * $itemsPerPage; // Offset for database query

				// Fetch all records from the product table

				$sql = "SELECT id, name,description,price,qty,sp_price,image_name,weight_type  FROM product where deleted=0 LIMIT $itemsPerPage OFFSET $offset";
				//print_r($sql);

				$result = $conn->query($sql);
				// print_r($);
				if (isset($result) && $result->num_rows > 0) {
					// $totalItems = $result->num_rows; // Total number of items in the database
					// Get the total count of items from the database
					$queryCount = "SELECT COUNT(*) AS total FROM product";
					$resultCount = mysqli_query($conn, $queryCount);
					$rowCount = mysqli_fetch_assoc($resultCount);

					$totalItems = $rowCount['total'];
					$totalPages = ceil($totalItems / $itemsPerPage); // Calculate total pages
					while ($row = $result->fetch_assoc()) {

				?><div class="col-md-6 col-lg-3 ftco-animate">
							<div class="product">
								<a href="product_single.php?id=<?php echo $row["id"] ?>" class="img-prod" target="_blank">
									<img class="img-fluid" style="
										width: 253px;
										height: 203px;
										object-fit: fill;
									" src="./images/<?php echo $row["image_name"];?>" alt="Colorlib Template">
									<span class="status"><?php
															//$originalPrice = $row["price"]; // Original price
															//$discountedPrice = $row["sp_price"]; // Discounted price

															// Calculate the discount percentage
															$discountPercentage = (($row["price"] - $row["sp_price"]) / $row["price"]) * 100;

															// Print the discount percentage
															echo intval($discountPercentage) . "%";
															?></span>
									<div class="overlay"></div>
								</a>
								<div class="text py-3 pb-4 px-3 text-center">
									<h3><a href="#"><?= $row["name"] ?></a></h3>
									<div class="d-flex">
										<div class="pricing">
											<p class="price"><span class="mr-2 price-dc">₹<?= $row["price"] ?></span><span class="price-sale">₹<?= $row["sp_price"]."/".$row["weight_type"] ?></span></p>
										</div>
									</div>
									<div class="bottom-area d-flex px-3">
										<div class="m-auto d-flex">
											<a href="product_single.php?id=<?php echo $row["id"] ?>" class="add-to-cart d-flex justify-content-center align-items-center text-center" target="_blank">
												<span><i class="ion-ios-menu"></i></span>
											</a>
											<a href="addToCart.php?id=<?php echo $row["id"] ?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
												<span><i class="ion-ios-cart"></i></span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php
					}
				} else {
					echo "<p>No products found.</p>";
				}

				// Close the database connection
				$conn->close();
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
						<?php
						// Generate pagination links
						for ($i = 1; $i <= $totalPages; $i++) {
							// Add "active" class to the current page's link
							$activeClass = $i === $page ? "active" : "";
							echo "<li class='$activeClass' ><a href='?page=$i' >$i</a> </li>";
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		</div>
	</section>

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


	<!-- include footer path -->
	<?php
	include './includes/footer.php'
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