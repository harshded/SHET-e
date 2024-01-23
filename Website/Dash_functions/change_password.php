<?php
// Start a session (if not already started)
session_start();

// Include your database connection code here
// Example: include 'db_connection.php';

// Check if the user is logged in (you can implement your own authentication logic)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get input from the form
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate input (e.g., check if new and confirm passwords match)
    if ($newPassword != $confirmPassword) {
        $error = "New password and confirmation do not match.";
    } else {
        // Hash the new password for security
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Check if the old password matches the one in the database
        // You should query the current password for the logged-in user from your database
        // and compare it with the $oldPassword.
        // Replace 'your_query_here' with the appropriate SQL query.
        $userId = $_SESSION['user_id'];
        $query = "SELECT password FROM users WHERE id = $userId";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if (password_verify($oldPassword, $row['password'])) {
            // Update the password in the database
            $updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE id = $userId";
            mysqli_query($conn, $updateQuery);
            $success = "Password changed successfully.";
        } else {
            $error = "Incorrect old password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
</head>
<body>
    <h2>Change Password</h2>
    
    <?php
    // Display success or error messages
    if (isset($success)) {
        echo "<p style='color: green;'>$success</p>";
    }
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form method="POST" action="changepassword.php">
        <label for="old_password">Old Password:</label>
        <input type="password" name="old_password" required><br>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>

        <input type="submit" value="Change Password">
    </form>
</body>
</html>