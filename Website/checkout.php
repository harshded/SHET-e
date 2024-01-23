<!DOCTYPE html>
<html lang="en">

<head>
	<style>
		.highlight {
			background-color: yellow;
			font-weight: bold;
		}
	</style>
</head>
<?php

include './includes/head.php';
?>

<body class="goto-here">

	<?php
	include './includes/header.php';
	//require_once('./functions/db.php');
	?>
	<!-- <script type="text/javascript" src="./functions/deliverycharges.js"></script> -->

	<!-- END nav -->

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
					<h1 class="mb-0 bread">Checkout</h1>
				</div>
			</div>
		</div>
	</div>

	<?php
	$userId = $_SESSION['id'];

	//cart id
	$sql_cartid = "SELECT id FROM cart WHERE user_id =$userId";
	$res = $conn->query($sql_cartid);
	$cart = $res->fetch_assoc();
	$cartid = $cart['id'];
	//Total amount
	$sql_total = "SELECT SUM(ci.total) AS total_sum FROM cart AS c 
		JOIN cart_item AS ci ON ci.cart_id = c.id
		WHERE user_id = $userId";
	$total = $conn->query($sql_total);
	$total_amt = $total->fetch_assoc();
	$_SESSION['sub_total'] = $total_amt['total_sum'];

	//Total discount
	$sql_discount = "SELECT SUM(ci.discount) AS total_discount FROM cart AS c 
		JOIN cart_item AS ci ON ci.cart_id = c.id
		WHERE user_id = $userId";
	$discount_total = $conn->query($sql_discount);
	$discount_amt = $discount_total->fetch_assoc();

	//Total price
	$sql_price = "SELECT SUM(price * qty) AS total_amount FROM cart_item where cart_id=$cartid";
	$price_total = $conn->query($sql_price);
	$price_amt = $price_total->fetch_assoc();


	?>



	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">

									<th>Image</th>
									<th>Product name</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$grandtotal = 0;

								// Fetch records from cart_items and cart tables based on the relationship


								if (isset($_SESSION['id'])) {

									// Fetch cartID based on user ID
									$sql = "SELECT id FROM cart WHERE user_id = $userId";
									$result = $conn->query($sql);
									//delevery charges
									$delivery_charges = 50;
									if ($result->num_rows > 0) {
										$row = $result->fetch_assoc();
										$cartId = $row['id'];


										$sql_pi = "SELECT p.*, ci.id as itemId,total,ci.qty,cart_id,product_id
										FROM product p
										JOIN cart_item ci ON p.id = ci.product_id
										JOIN cart c ON ci.cart_id = c.id
										WHERE c.id = $cartId";

										$products = $conn->query($sql_pi);

										if (isset($products) && $products->num_rows > 0) {
											while ($row = $products->fetch_assoc()) {


								?>
												<tr class="text-center">


													<td class="image-prod">
														<div class="img">
															<a href="product_single.php?id=<?= $row["id"]; ?>">
																<img src="./images/<?php echo $row["image_name"]; ?>" width="100" height="auto" alt="">
															</a>
														</div>
													</td>

													<td class="product-name">

														<a href="product_single.php?id=<?= $row["id"]; ?>">
															<h3><?php echo $row["name"]; ?></h3>
														</a>
													</td>



													<td class="quantity">
														<?php echo $row['qty'] ?>
													</td>

													<td class="total">₹<?php echo $row['total'] ?></td>
												</tr>
								<?php
											}
										} else {
											echo "<p>No recordsttttt found.</p>";
										}
									} else {
										//echo "No cart found for this user.";
									}
								}

								?>


							</tbody>
						</table>
					</div>
				</div>
			</div>
			<form action="./functions/payment_mode.php" method="POST" class="billing-form">
				<div class="row justify-content-center">

					<div class="col-xl-7 ftco-animate">

						<div class="col-md-12">

							<script>
								function showRadioButtons() {

									var radio = document.getElementById("radioButton");
									var radio1 = document.getElementById("radio-div");
									var radio2 = document.getElementById("new-address");

									if (radio.checked) {
										radio1.style.display = "block";
										radio2.style.display = "none";
									} else {
										radio1.style.display = "none";
										// radio2.style.display = "none";
									}
								}
							</script>
							<div class="radio-toolbar">
								<label for="radioButton">Select Existing Address</label>
								<input type="radio" id="radioButton" name="addressGroup" value="existing" required onclick="showRadioButtons()">

								<label for="add-new">New Address</label>
								<input type="radio" id="add-new" name="addressGroup" value="new" required onclick="showadd()">
							</div>

							<br>
							<div id="radio-div" style="display:none">
								<!-- //fetch address form address_book for current user -->
								<?php


								$sql = "SELECT `id` as address_id,`town`,`address_type` FROM `address_book` WHERE `user_id` = ?";
								// Prepare the statement
								$stmt = $conn->prepare($sql);

								if (!$stmt) {
									die("Error in preparing the SQL statement: " . $conn->error);
								}

								$stmt->bind_param("i", $userId);
								// Execute the query
								$stmt->execute();
								$stmt->bind_result($address_id, $town, $address_type);
								?>
								<div class="radio-toolbar">
									<?php
									$found="";
									while ($stmt->fetch()) {
										$found = true; // Records were found

									?>
										<label for="radio<?php echo $address_id; ?>"><?php echo $address_type; ?></label>
										<input type="radio" id="radio<?php echo $address_id; ?>" name="addressType" value="<?php echo $address_id; ?>" onclick="getAddressDetail(this.value)" />
										<br>
									<?php
									}
									if (!$found) {
										echo "No Address Found";
									}
									?>
								</div>
								<?php

								$stmt->close();
								?>

							</div>
							<script>
								function showadd() {
									var radio = document.getElementById("add-new");
									var radio1 = document.getElementById("new-address");
									var radio2 = document.getElementById("radio-div");

									if (radio.checked) {
										radio1.style.display = "block";
										radio2.style.display = "none";
									} else {
										radio1.style.display = "none";
										// radio2.style.display = "none";
									}
								}
							</script>
							<div class="select-address">
								<div class="card card-body" id="new-address" style="display:none">
									<h3 class="mb-4 billing-heading">Billing Details</h3>
									<div class="row align-items-end">
										<div class="col-md-12">
											<div class="form-group">
												<label for="firstname">Full Name</label>
												<input type="text" name="name" class="form-control" placeholder="Full Name">
											</div>
										</div>

										<div class="w-100"></div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="country">City </label>
												<div class="select-wrap">
													<div class="icon"><span class="ion-ios-arrow-down"></span></div>
													<select name="city" id="city" class="form-control">
														<option value="Pune">Pune</option>

													</select>
												</div>
											</div>
										</div>
										<div class="w-100"></div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="country">Town </label>
												<div class="select-wrap">
													<div class="icon"><span class="ion-ios-arrow-down"></span></div>
													<select name="town" id="town" class="form-control">
														<option value="">Select Town</option>

														<?php
														$sql = "SELECT id, town_name,charges FROM shipping_address LIMIT 15";
														$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
														while ($rows = mysqli_fetch_assoc($resultset)) {
														?>
															<option value="<?php echo $rows["id"]; ?>" <?php if ($rows["id"] == $_SESSION['selected_town']) {
																											echo 'selected="selected"';
																										} ?>><?php echo $rows["town_name"]; ?></option>
														<?php }	?>

													</select>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="pincode">Pincode</label>
												<input type="text" class="form-control" name="pincode" placeholder="Pincode">
											</div>
										</div>
										<div class="w-100"></div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="streetaddress">Flat No</label>
												<input type="text" name="line_1" id="line_1" class="form-control" placeholder="Flat No , Building name ">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="streetaddress">Street Address</label>
												<input type="text" class="form-control" name="line_2" id="line_2" placeholder="Street Address,Appartment, suite, unit etc.">
											</div>
										</div>

										<div class="w-100"></div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="mobile">Phone</label>
												<input type="text" name="mobile" id="mobile" maxlength="10" class="form-control" placeholder="Mobile Number">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="emailaddress">Email Address</label>
												<input type="text" name="email" id="email" class="form-control" placeholder="Email Address">
											</div>
										</div>
										<div class="w-100"></div>

									</div>
								</div>
							</div>


						</div>
					</div>
					<div class="col-xl-5">
						<div class="row mt-5 pt-3">
							<div class="col-md-12 d-flex mb-5">
								<div class="cart-detail cart-total p-3 p-md-4">
									<h3 class="billing-heading mb-4">Cart Total</h3>
									<!-- <p class="d-flex">
		    						<span>Subtotal</span>
		    						<span>$20.60</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Delivery</span>
		    						<span>$0.00</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Discount</span>
		    						<span>$3.00</span>
		    					</p>
		    					<hr>
		    					<p class="d-flex total-price">
		    						<span>Total</span>
		    						<span>$17.60</span>
		    					</p> -->
									<p class="d-flex">
										<span>Subtotal</span>
										<span>₹<?php echo $price_amt['total_amount']; ?></span>
									</p>
									<p class="d-flex">
										<span>Discount</span>
										<span>₹ <?php echo $price_amt['total_amount'] - $total_amt['total_sum']; ?></span>
									</p>
									<hr>
									<p class="d-flex ">
										<span>Selling Price</span>
										<span>₹ <?php echo $total_amt['total_sum']; ?></span>
									</p>
									<p class="d-flex">
										<span>Delivery Charges</span>
										₹&nbsp;<span id="delivery_charges"><?php echo $_SESSION['delivery_charge']; ?></span>

										</span>
									</p>


									<hr>
									<p class="d-flex total-price">

										<span class="highlight"><b>Grand Total</b></span>
										<span class="highlight" id="grand_total_div">₹<?php echo $total_amt['total_sum'] + $_SESSION['delivery_charge']; ?></span>

									</p>

								</div>
							</div>
							<div class="col-md-12">
								<div class="cart-detail p-3 p-md-4">
									<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
												<label><input type="radio" name="paymentmode" value="cod" class="mr-2" required>Cash On Delivery</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
												<label><input type="radio" name="paymentmode" value="Net Banking" class="mr-2" disabled>Net Banking</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
												<label><input type="radio" name="paymentmode" value="Card" class="mr-2"> Card</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
												<label><input type="checkbox" value="" class="mr-2" required> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
									<button type="submit" name="placeorderbtn" class="btn btn-primary py-3 px-4">Place an order</button>
								</div>
							</div>
						</div>
					</div> <!-- .col-md-8 -->
				</div>
			</form>
		</div>
	</section> <!-- .section -->

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

	<script>
		$(document).ready(function() {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>

	<script>
		function getAddressDetail(id) {
			jQuery.ajax({
				method: 'post',
				url: './functions/getcharges.php',
				dataType: "json",
				data: {
					deliveryid: id
				},
				cache: false,
				success: function(deliveryData) {
					if (deliveryData) {
						console.log(deliveryData)
						jQuery("#heading").show();
						jQuery("#no_records").hide();
						jQuery("#delivery_charges").html(deliveryData.delivery_changes.charges);
						jQuery("#grand_total_div").html(deliveryData.grand_total);
						jQuery("#records").show();
					} else {
						jQuery("#heading").hide();
						jQuery("#records").hide();
						jQuery("#no_records").show();
						jQuery("#delivery_charges").html(0);
					}
				}
			});
		}

		jQuery(document).ready(function() {
			// code to get delivery charges  from table via select box
			jQuery("#town").change(function() {
				var id = jQuery(this).find(":selected").val();
				var dataString = 'deliveryid=' + id;
				jQuery.ajax({
					method: 'post',
					url: './functions/getcharges.php',
					dataType: "json",
					data: {
						deliveryid: id,
						address_type: 'new_address'
					},
					cache: false,
					success: function(deliveryData) {
						if (deliveryData) {
							console.log(deliveryData)
							jQuery("#heading").show();
							jQuery("#no_records").hide();
							jQuery("#delivery_charges").html(deliveryData.delivery_changes.charges);
							jQuery("#grand_total_div").html(deliveryData.grand_total);
							jQuery("#records").show();
						} else {
							jQuery("#heading").hide();
							jQuery("#records").hide();
							jQuery("#no_records").show();
							jQuery("#delivery_charges").html(0);
						}
					}
				});
			})
		});
	</script>
</body>

</html>