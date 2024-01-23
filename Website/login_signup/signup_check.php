<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
include "db_conn.php";

if (
	isset($_POST['uname']) && isset($_POST['password'])
	&& isset($_POST['name']) && isset($_POST['re_password'])
	&& isset($_POST['email']) && isset($_POST['phone'])
) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	$re_pass = validate($_POST['re_password']);
	$name = validate($_POST['name']);
	$email = validate($_POST['email']);
	$phone = validate($_POST['phone']);
	$usertype = ($_POST['usertype']);
	//$otp = ($_POST['otp']);
	// $status = ($_POST['status']);
	// var_dump($_POST); die;

	$user_data = 'uname=' . $uname . '&name=' . $name;


	if (!preg_match("/^[0-9]{10}$/", ($phone))) {
		header("Location: signup.php?error=Please enter a 10-digit phone number&$user_data");
		exit();
	}
	else if(!preg_match("/[a-z]/i", $uname) || !preg_match("/^[a-zA-Z0-9_]+$/", $uname) || strpos($uname, '@') !== false || strpos($uname, '#') !== false || strpos($uname, '$') !== false || strpos($uname, '*') !== false) {
		header("Location: signup.php?error=Enter a valid username special character are not allowed&$user_data");
		exit();
	} else if (!preg_match("/[a-z]/i", ($pass))) {
		header("Location: signup.php?error=Password must contain at least one letter&$user_data");
		exit();
	} else if (!preg_match("/[0-9]/", ($pass))) {
		header("Location: signup.php?error=Password must contain at least one number&$user_data");
		exit();
	} else if (strlen($pass) < 6) {
		header("Location: signup.php?error=Password must be at least 6 characters&$user_data");
		exit();
	}
	/*else if(empty($usertype)){
		   header("Location: signup.php?error=User Type  is required&$user_data");
		   exit();
	   }*/ else if ($pass !== $re_pass) {
		header("Location: signup.php?error=The confirmation password  does not match&$user_data");
		exit();
	} else {

		// hashing the password
		$pass = md5($pass);

		$sql = "SELECT * FROM users WHERE user_name='$uname' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			$selectrow = mysqli_fetch_assoc($result);
			$status = $selectrow['id'];
			header("Location: signup.php?error=The username is taken try another username&$user_data");
			exit();
		} else {

			$sql2 = "INSERT INTO users(user_name, password, full_name,email,ph_number,user_type,user_status) VALUES('$uname', '$pass', '$name','$email','$phone','$usertype','Active')";
			$result2 = mysqli_query($conn, $sql2);
			// var_dump($result2); die;
			if ($result2) {
				header("Location: signup.php?success=Your account has been created successfully"); {
					header("Location:success.html");

					exit();
				}
			} else {
				header("Location: signup.php?error=unknown error occurred&$user_data");
				exit();
			}
		}
	}
} else {
	header("Location: signup.php");
	exit();
}
