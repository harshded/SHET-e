<?php
// Include your database connection code here
$servername = "localhost"; // Change this to your database server name if it's not on localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "shete"; // Change this to your MySQL database name

// Create a connection to the database
$conn = new mysqli("localhost", "root", ""  ,"shete");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["orderId"])) {
    $orderId = $_POST["orderId"];

    // Update the order status to "Cancelled" in the database
    $updateSql = "UPDATE orders SET status = 'Cancelled' WHERE id = $orderId";

    if ($conn->query($updateSql) === TRUE) {
        echo "Order successfully canceled!";
    } else {
        echo "Error updating order status: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
