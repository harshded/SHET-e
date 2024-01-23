<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = 'shete';

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user type based on user ID
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    
    $sql = "SELECT user_type FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userType = $row['user_type'];

        // Set the user type in a session variable
        $_SESSION['user_type'] = $userType;
    } else {
        echo "User not found.";
    }
}
?>
