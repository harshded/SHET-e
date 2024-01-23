<?php
// Replace these with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shete";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from farmer table
$sqlFarmer = "SELECT * FROM farmer";
$resultFarmer = $conn->query($sqlFarmer);
$farmerData = $resultFarmer->fetch_assoc();

// Fetch data from users table
$sqlUser = "SELECT * FROM users";
$resultUser = $conn->query($sqlUser);
$userData = $resultUser->fetch_assoc();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Farmer Profile</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="header__wrapper">
    <header></header>
        <!-- Header content -->
        <div class="cols__container">
            <div class="left__col">
                <div class="img__container">
                    <img src="<?= 'data:image/jpeg;base64,' . base64_encode($userData["image"]) ?>" />
                    <span></span>
                </div>
                <h2><?php echo $userData['full name']; ?></h2>
                <p><?php echo $userData['user_name']; ?></p>
                <p><?php echo $userData['user_type']; ?></p>
               
            </div>
            <div class="right__col">
                
                    <h2>About Me</h2>
                    
                    <p>Full Name:<br> <?php echo $userData['full name']; ?></p><br>
                    <p>Farmer Certificate Id: <br><?php echo $farmerData['farmer_cer_id']; ?></p> <br>
                    <p>Aadharcard Number:<br> <?php echo $farmerData['aadhar_number']; ?></p><br>
                    <p>Email:<br> <?php echo $farmerData['email']; ?></p><br>
                    <p>Address:<br> <?php echo $farmerData['address']; ?></p><br>
                    <p>Phone Number: <br><?php echo $farmerData['phone']; ?></p><br>
                    <p>User Status: <br><?php echo $userData['user_status']; ?></p><br>
                    <p>Account Created At: <br><?php echo $userData['created_at']; ?></p><br>
                     
                
            </div>
        </div>
    </div>
</body>
</html>
