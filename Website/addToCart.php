<?php
session_start();
require 'functions/db.php';
if($_SESSION['user_type'] != 'user'){
    header("Location: ../index.php");
 
}
$id = $_GET['id'];
if (empty($_SESSION['id']) && $_SESSION['id'] == '') {
	header("Location: login_signup/login.php");
}
$user_id = $_SESSION['id'];

$query = "SELECT * FROM product WHERE id=" . $id;
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

$createdDate = date('Y-m-d h:i:s');
if (isset($product)) {
	$productId = $product['id'];
	$productPrice = $product['sp_price'];
	$price=$product['price'];
	$productdiscount= @$product['discount'];


	$query = "SELECT * FROM cart WHERE user_id=" . $user_id;
	$result = mysqli_query($conn, $query);
	$cartItem = mysqli_fetch_assoc($result);

	if (isset($cartItem)) {
		$cart_id = @$cartItem['id'];

		// id session
		$cart_ids = @$_SESSION[$cartItem['id']];
	} else {
		$cartSql = "INSERT INTO cart (user_id, created_at) VALUES('$user_id', '$createdDate')";
		$conn->query($cartSql);
		$cart_id = $conn->insert_id;
	}

	// $result = mysqli_query($conn, $cartSql);
	if ($cart_id) {

		//check product id already exist
		$checkSql = "SELECT * FROM cart_item AS ci JOIN cart AS c ON ci.cart_id = c.id WHERE user_id =$user_id and ci.product_id=$productId";
		$checkResult = $conn->query($checkSql);

		if ($checkResult->num_rows > 0) {
			$updateSql = "UPDATE cart_item SET qty = qty + 1 WHERE product_id = $productId AND cart_id =$cart_id";
			$conn->query($updateSql);
			$_SESSION['status'] = "Item successfully added to cart";

		}
		else{
		// $cart_id = $conn->insert_id;
		$cartItemSql = "INSERT INTO cart_item (cart_id, product_id, qty,price, sp_price,discount,total) VALUES ('$cart_id', '$productId',1,'$price','$productPrice','$productdiscount','$productPrice')";
		$result2 = $conn->query($cartItemSql);
		$_SESSION['status'] = "Item successfully added to cart";
		

		}
		// $sql_cart = "SELECT count(product_id) AS total_items
		// FROM cart_item
		// WHERE cart_id = $user_id";
		$sql_cart = "SELECT count(ci.product_id) AS total_items FROM cart AS c 
		JOIN cart_item AS ci ON ci.cart_id = c.id
		WHERE user_id = $user_id
		GROUP BY ci.cart_id";
		$result = $conn->query($sql_cart);
		$row = $result->fetch_assoc();
		$totalcartItems = $row['total_items'];

		$_SESSION['cart_count'] = $totalcartItems;
		header("Location: shop.php");
		// echo "New record created successfully. Last inserted ID is: " . $last_id;
	} else {
		// echo "Error: " . $sql . "<br>" . $conn->error;
		// header("Location: shop.php");
	}
}
