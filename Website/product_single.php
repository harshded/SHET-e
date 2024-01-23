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

	<?php
	require_once('./functions/db.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$sql = "SELECT id, name,description,price,qty,sp_price,image_name,weight_type  FROM product where id=$id";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
	} else {
		echo "No ID parameter found in GET request.";
	}

	?>

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span class="mr-2"><a href="index.php">Product</a></span> <span>Product Single</span></p>
					<h1 class="mb-0 bread">Product Single</h1>
				</div>
			</div>
		</div>
	</div>


	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="images/product-1.jpg" class="image-popup"><img src="./images/<?php echo $row["image_name"]; ?>" class="img-fluid" alt="Colorlib Template"></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3><?php echo $row['name'] ?></h3>
					<div class="rating d-flex">
						<p class="text-left mr-4">
							<a href="#" class="mr-2">5.0</a>
							<a href="#"><span class="ion-ios-star-outline"></span></a>
							<a href="#"><span class="ion-ios-star-outline"></span></a>
							<a href="#"><span class="ion-ios-star-outline"></span></a>
							<a href="#"><span class="ion-ios-star-outline"></span></a>
							<a href="#"><span class="ion-ios-star-outline"></span></a>
						</p>
						<p class="text-left mr-4">
							<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
						</p>
						<p class="text-left">
							<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
						</p>
					</div>
					<p class="price"><span>₹<?php echo $row['sp_price']. " /" . $row["weight_type"];?></span></p>
					<p><?php echo $row['description'] ?>
					</p>
					<div class="row mt-4">
						<div class="col-md-6">
							<div class="form-group d-flex">
								<div class="select-wrap">
									<!-- <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select name="" id="" class="form-control">
	                  	<option value="">Small</option>
	                    <option value="">Medium</option>
	                    <option value="">Large</option>
	                    <option value="">Extra Large</option>
	                  </select> -->
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
									<i class="ion-ios-remove"></i>
								</button>
							</span>
							<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
							<span class="input-group-btn ml-2">
								<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
									<i class="ion-ios-add"></i>
								</button>
							</span>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;"><?php echo $row['qty'] . " " . $row["weight_type"] . " Available" ?></p>
						</div>
					</div>
					<p><a href="addToCart.php?id=<?php echo $row["id"] ?>" class="btn btn-black py-3 px-5">Add to Cart</a></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Products</span>
					<h2 class="mb-4">Similar Products</h2>
					<!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> -->
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


$sql = "SELECT id, name, description, price, qty, sp_price, image_name FROM product ORDER BY RAND() LIMIT 4";

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
	<!-- <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Vegefoods</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Shop</a></li>
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Journal</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
	                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
	              </ul>
	              <ul class="list-unstyled">
	                <li><a href="#" class="py-2 d-block">FAQs</a></li>
	                <li><a href="#" class="py-2 d-block">Contact</a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --
						</p>
          </div>
        </div>
      </div>
    </footer>
     -->
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

	<script>
		$(document).ready(function() {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseFloat($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


				// Increment

			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseFloat($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>

</body>

</html>