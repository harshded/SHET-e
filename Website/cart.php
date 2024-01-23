<!DOCTYPE html>
<html lang="en">
<?php
include './includes/head.php';
@$userId = $_SESSION['id'];
?>

<body class="goto-here">

	<?php
	include './includes/header.php';

	?>

	<!-- END nav -->

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
					<h1 class="mb-0 bread">My Cart</h1>
				</div>
			</div>
		</div>
	</div>
	<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors',1);
	//Total amount
	$sql_total = "SELECT SUM(ci.total) AS total_sum FROM cart AS c 
		JOIN cart_item AS ci ON ci.cart_id = c.id
		WHERE user_id = $userId
		";
	$total = $conn->query($sql_total);
	$total_amt = ($total) ? $total->fetch_assoc() : 0;
	?>

	<?php
	//Total discount
	$sql_discount = "SELECT SUM(ci.discount) AS total_discount FROM cart AS c 
		JOIN cart_item AS ci ON ci.cart_id = c.id
		WHERE user_id = $userId
		";
	$discount_total = $conn->query($sql_discount);
	$discount_amt = ($discount_total) ? $discount_total->fetch_assoc() : 0;

	?>

	<?php
	//Total price
	$sql_price = "SELECT SUM(ci.price) AS total_price FROM cart AS c 
		JOIN cart_item AS ci ON ci.cart_id = c.id
		WHERE user_id = $userId
		";
	$price_total = $conn->query($sql_price);
	$price_amt = ($price_total) ? $price_total->fetch_assoc() : 0;
	?>


	<section class="ftco-section ftco-cart">
		<div class="container">
			<?php


			// Fetch cartID based on user ID
			$sql = "SELECT id FROM cart WHERE user_id = $userId";
			$result = $conn->query($sql);


			if (isset($_SESSION["id"]) && $result->num_rows > 0) { ?>
				<div class="row">
					<div class="col-md-12 ftco-animate">
						<div class="cart-list">
							<?php
							require_once('./functions/db.php');
							// Fetch records from cart_items and cart tables based on the relationship


							?>
							<table class="table">

								<tbody>
									<?php


									$row = $result->fetch_assoc();
									$cartId = $row['id'];


									$sql_pi = "SELECT p.*, ci.id as itemId,total,ci.qty,cart_id,product_id
										FROM product p
										JOIN cart_item ci ON p.id = ci.product_id
										JOIN cart c ON ci.cart_id = c.id
										WHERE c.id = $cartId";

									$products = $conn->query($sql_pi);


									//discount
									// $sql_dis = "SELECT ci.id,
									// 	ci.qty,
									// 	ci.sp_price,
									// 	p.price,
									// 	((p.price - ci.sp_price) / p.price) * 100 AS total_discount_sum
									// FROM cart_item ci
									// JOIN product p ON ci.product_id = p.id
									// WHERE ci.cart_id = $cartId";
									// $result_dis = $conn->query($sql);
									// $dis= $result->fetch_assoc();
									// $totalDiscount = $row['total_discount_sum'];


									if (isset($products) && $products->num_rows > 0) 
									{
										?>
										<thead class="thead-primary">
										<tr class="text-center">
											<th>Remove</th>
											<th>Image</th>
											<th>Product name</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
										</tr>
									</thead>
									<?php
										while ($row = $products->fetch_assoc()) {
									?>



											<?php


											?>
											<tr class="text-center">
												<td class="product-remove"><a href="./remove_item.php?cart_id=<?= $row['cart_id'] ?> & p_id=<?= $row['product_id'] ?>"><span class="ion-ios-close"></span></a></td>

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

												<td class="price">₹
													<?php
													//$totalprice=0;
													//$totalprice += $row["price"] * $row['qty'];
													//echo $totalprice;
													echo $row['sp_price']
													?>
												</td>



												<td class="quantity">
													<div class="input-group mb-3">
														<input type="number" name="quantity" onchange="return changeQty(this, '<?= $row['itemId'] ?>');" class="quantity form-control input-number" value="<?php echo $row['qty'] ?>" min="1" max="100">
													</div>
												</td>

												<td class="total">₹<?php echo $row['total'] ?></td>
											</tr>
									<?php
										}
									}
									else {
										?>

							<div class="cart_empty">
								<span class="c">
									<p>Your Basket is empty now!</p>
								</span>
								<span class="c"><img src="./images/shopping-basket.gif" alt="cart" class="cart_responsive" width="400" height="400"></span>
								<span class="c">
									<p><a href="shop.php" class="btn btn-primary py-3 px-4">Continue Shopping</a></p>
								</span>
							</div>

						<?php

									}
									?>



								</tbody>
							</table>
						<?php

					} 
									



						?>
						</div>
					</div>
				</div>

				<div class="row justify-content-end">
					<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
						<div class="cart-total mb-3">
							<h3>Coupon Code</h3>
							<p>Enter your coupon code if you have one</p>
							<form action="#" class="info">
								<div class="form-group">
									<label for="">Coupon code</label>
									<input type="text" class="form-control text-left px-3" placeholder="">
								</div>
							</form>
						</div>
						<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
					</div>
					<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
						<div class="cart-total mb-3">
							<h3>Estimate shipping and tax</h3>
							<p>Enter your destination to get a shipping estimate</p>
							<form action="#" class="info">
								<div class="form-group">
									<label for="">Country</label>
									<input type="text" class="form-control text-left px-3" placeholder="">
								</div>
								<div class="form-group">
									<label for="country">State/Province</label>
									<input type="text" class="form-control text-left px-3" placeholder="">
								</div>
								<div class="form-group">
									<label for="country">Zip/Postal Code</label>
									<input type="text" class="form-control text-left px-3" placeholder="">
								</div>
							</form>
						</div>
						<p><a href="checkout.php" class="btn btn-primary py-3 px-4">Estimate</a></p>
					</div>
					<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
						<div class="cart-total mb-3">
							<h3>Total Amount</h3>
							<p class="d-flex">
								<span>Subtotal</span>
								<span>₹<?php echo $total_amt['total_sum'] ?></span>
							</p>
							<!-- <p class="d-flex">
							<span>Discount</span>
							<span>₹<?php echo $discount_amt['total_discount']; ?></span>
						</p> -->
							<p class="d-flex">
								<span>Discount</span>
								<span><?php echo 'Shown in Checkout'; ?></span>
							</p>
							<hr>
							<p class="d-flex total-price">
								<span>Net Total</span>
								<span>₹<?php echo $total_amt['total_sum']; ?></span>
							</p>
						</div>
						<p><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
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
							<input type="submit" value="Subscribe" class="submit btn btn-primary px-3">
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
		function changeQty(e, id) {
			let qty = e.value;
			// console.log(e.value);
			window.location.href = './functions/functions.php?op=updateQty&id=' + id + '&qty=' + qty;
		}

		$(document).ready(function() {
			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


				// Increment

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

</body>

</html>