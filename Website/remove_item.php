<?php
require_once('./functions/db.php');
$cartid = $_GET['cart_id'];

$product_id = $_GET['p_id'];



// Delete the row from cart_items
$deleteSql = "DELETE FROM cart_item WHERE cart_id = $cartid AND product_id = $product_id";
$conn->query($deleteSql);

// Close the database connection
$conn->close();

// Redirect back to the cart page or wherever you want
header("Location: cart.php");

?>