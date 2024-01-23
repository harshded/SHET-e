<?php
// Database connection parameters
$servername = "localhost"; // Change to your MySQL server
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$database = "shete"; // Change to your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Rest of your code for editing an address goes here

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["address_id"]) && isset($_GET["user_id"])) {
    $edit_id = $_GET["address_id"];
    $user_id = $_GET["user_id"];

    // Fetch the address details from the database
    $query = "SELECT * FROM `address_book` WHERE `id`='$edit_id'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        // Address not found, handle accordingly (e.g., redirect to an error page)
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit_id"])) {
    // Handle form submission for editing an address
    $edit_id = $_POST["edit_id"];
    $edit_city = $_POST["edit_city"];
    $edit_town = $_POST["edit_town"];
    $edit_pincode = $_POST["edit_pincode"];
    $edit_line_1 = $_POST["edit_line_1"];
    $edit_line_2 = $_POST["edit_line_2"];
    $edit_address_type = $_POST["edit_address_type"];
    $edit_mobile_no = $_POST["edit_mobile_no"];
    $edit_email_id = $_POST["edit_email_id"];

    $num = $_POST["user_id"];

    // Update the address in the database
    $update_query = "UPDATE `address_book` 
                     SET `city`='$edit_city', 
                         `town`='$edit_town', 
                         `pincode`='$edit_pincode', 
                         `line_1`='$edit_line_1', 
                         `line_2`='$edit_line_2', 
                         `address_type`='$edit_address_type', 
                         `mobile_no`='$edit_mobile_no', 
                         `email_id`='$edit_email_id' 
                     WHERE `id`='$edit_id'";

    if ($conn->query($update_query) === TRUE) {
        // Address updated successfully
        header("Location: show_addresses.php?user_id=" . $num ); // Redirect back to the address list page
        exit();
    } else {
        echo "Error updating address: " . $conn->error;
    }
}
?>