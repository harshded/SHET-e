<?php
session_start();

// $servername = "your_servername";
// $username = "your_username";
// $password = "your_password";
// $database = "your_database";
include("../functions/db.php");
session_start();
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to delete a row from the product table where id is 12
$idToDelete = $_GET["id"];
// echo $idToDelete;die;
$sql = "update product set deleted=1 WHERE id = $idToDelete";

if ($conn->query($sql) === TRUE) {
    echo "Record with id $idToDelete deleted successfully";
    $_SESSION['edit_prod_status'] = "Product edited succesfully";
    header("location:./view_products.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close connection
$conn->close();
?>
