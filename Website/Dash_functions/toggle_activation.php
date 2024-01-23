<?php
if (isset($_GET['id'], $_GET['type'])) {
    $userId = $_GET['id'];
    $userType = $_GET['type'];

    if (!empty($userType) && ($userType === 'farmer' || $userType === 'user')) {
        $connection = mysqli_connect("localhost", "root", "", "shete");

        // Determine the correct table based on the user type
        $tableName = "users";

        // Check if the user_status column exists in the table
        $checkColumnQuery = "SHOW COLUMNS FROM $tableName LIKE 'user_status'";
        $columnResult = mysqli_query($connection, $checkColumnQuery);

        if (mysqli_num_rows($columnResult) > 0) {
            // Query to toggle the activation status based on the table and user ID
            $query = "UPDATE $tableName SET user_status = IF(user_status = 'active', 'inactive', 'active') WHERE id = $userId";

            if (mysqli_query($connection, $query)) {
                // Determine the redirection page based on the user type
                $redirectPage = ($userType === 'farmer') ? 'view_farmers.php' : 'view_users.php';

                // Redirect back to the respective page after toggling the activation status
                header("Location: $redirectPage");
                exit;
            } else {
                // Handle error if there's an issue with the query
                echo "Error in query: " . mysqli_error($connection);
            }
        } else {
            // Handle error if the user_status column does not exist
            echo "Error: 'user_status' column does not exist in the table.";
        }
    } else {
        // Handle error for an unknown user type
        echo "Invalid user type.";
    }
} else {
    // Handle error or invalid request
    echo "Invalid request.";
}
?>
