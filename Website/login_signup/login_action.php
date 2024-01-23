<?php
session_start();
include "db_conn.php";


//dashboard urls array
$dashboardUrls = [
	'admin' => '../Dash_functions/view_farmers.php',
	'user' => '../index.php',
	'farmer' => '../Dash_functions/view_products.php',
];


if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
		exit();
	} else if (empty($pass)) {
		header("Location: index.php?error=Password is required");
		exit();
	} else {
		// hashing the password
		$pass = md5($pass);


		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['user_name'] === $uname && $row['password'] === $pass) {
				$_SESSION['user_name'] = $row['user_name'];

				$_SESSION['name'] = $row['name'];
				$_SESSION['id'] = $row['id'];
				$_SESSION['user_type']=$user_type;

				$usertype = $row['user_type'];
				
				
				// Check if the user_type is valid and has a corresponding dashboard URL
				if (isset($usertype) && array_key_exists($usertype, $dashboardUrls)) {
					// Redirect the user to their dashboard
					$dashboardUrl = $dashboardUrls[$usertype];
					header("Location: $dashboardUrl");
					exit();
				} else {
					// Handle invalid user_type (optional)
					echo "Invalid user_type";
				}
				//header("Location: ../index.php");
				
			}
		
			else {
				header("Location: login.php?error=Incorect User name or password");
				exit();
			}
		} else {
			header("Location: login.php?error=Incorect User name or password");
			exit();
		}
	}
} else {
	header("Location: index.php");
	exit();
}
