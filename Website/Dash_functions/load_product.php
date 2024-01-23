<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = 'shete';


// if($_SESSION['user_type'] != 'farmer'){
//     header("Location: ../index.php");
// }

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	if($_POST['type'] == ""){
		$sql = "SELECT * FROM categories";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['id']}'>{$row['name']}</option>";
		}
	}else if($_POST['type'] == "stateData"){

		$sql = "SELECT * FROM sub_categories WHERE fruit_vegies = {$_POST['id']}";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['name']}'>{$row['name']}</option>";
		  $prod=$row['name'];
		}
	}
   
	echo $str;
 ?>
