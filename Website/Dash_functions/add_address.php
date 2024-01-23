<?php
include  dirname(__FILE__) . '/../includes/head.php';
if ($_SESSION['user_type'] == 'user') {
?>


	<body class="goto-here">
		<?php include dirname(__FILE__) . '/../includes/header.php'; ?>
		<div class="container">
			<?php include('./../user-sidebar.php'); ?>

			<section class="home-section">


				<!-- <div class="row justify-content-center"> -->
				<!-- <div class="row mt-5 pt-3"> -->
				<!-- <div class="col-md-12 d-flex mb-5"> -->
				<div class="cart-detail cart-total p-3 p-md-4">
					<form action="insert_address.php" method="post" class="billing-form">
						<h3 class="mb-4 billing-heading">Add Address</h3>
						<div class="row align-items-end">
							<div class="col-md-6">
								<div class="form-group">
									<label for="city">City<span>*</span></label>
									<input type="text" class="form-control" name="city" value="Pune" readonly />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="city">Address Name<span>*</span></label>
									<input type="text" class="form-control" name="type" placeholder="Home,Office,Work,etc" required />
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="city">Town/Area<span>*</span></label>
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
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Postcode / ZIP*</label>
									<input type="text" class="form-control" name="code">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="streetaddress">Street Address</label>
									<input type="text" class="form-control" placeholder="House number and street name" name="line-1" required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Appartment, suite, unit etc: (optional)" name="line-2">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" class="form-control" name="phone">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="emailaddress">Email Address</label>
									<input type="text" class="form-control" name="mail-id">
								</div>
							</div>
						</div>
						<p><input type="submit" name="submit" value="Submit" class="btn btn-primary py-3 px-4"></p>
					</form><!-- END -->
				</div>
		</div>
		</div>
		</div> <!-- .col-md-8 -->
		</div>
		</div>
		</section>
	</body>

<?php } else {
	header("Location: ../index.php");
} ?>