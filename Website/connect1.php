<?php
$servername = "localhost"; // Change to your MySQL server hostname if needed
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password if set; typically blank for XAMPP
$database = "shete"; // Name of the database you want to connect to

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to the database successfully.";

$city = $_POST['city'];
$town = $_POST['town'];
$code = $_POST['code'];
$add1 = $_POST['line-1'];
$add2 = $_POST['line-2'];
$type = $_POST['type'];
$customer_id = 18;

  $sql = "SELECT ph_number, email FROM users WHERE id = $customer_id";
  $result = $conn->query($sql);

  // Check if the query was successful
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $phno = $row['ph_number'];
      $email = $row['email'];
  }
  $insertSql = "INSERT INTO address_book (user_id, city, pincode, line_1, line_2, address_type, mobile_no, email_id) VALUES ('$customer_id', '$city', '$code', '$add1', '$add2', '$type', '$phno', '$email')";
  
  if ($conn->query($insertSql) === TRUE) {
      echo "Insertion successful.";
    } else {
        echo "Insertion failed: " . $conn->error;
    }
$conn->close();
?>
