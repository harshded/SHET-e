<?php
// Get the user or farmer ID and table name from the URL parameters
if (isset($_GET['id'], $_GET['table'])) {
    $userId = $_GET['id'];
    $tableName = $_GET['table'];

    if (!empty($tableName)) {
        // Query to toggle the activation status based on the table and user ID
        $connection = mysqli_connect("localhost", "root", "", "shete");
        $query = "UPDATE $tableName SET user_status = IF(user_status = 'active', 'inactive', 'active') WHERE id = $userId";

        if (mysqli_query($connection, $query)) {
            // Determine the redirection page based on the table
            $redirectPage = "";
            if ($tableName === "users") {
                $redirectPage = "view_users.php";
            } elseif ($tableName === "farmer") {
                $redirectPage = "view_farmers.php";
            }

            // Redirect back to the respective page after toggling the activation status
            header("Location: $redirectPage");
            exit;
        } else {
            // Handle error if there's an issue with the query
            echo "Error in query: " . mysqli_error($connection);
        }
    } else {
        // Handle error for an unknown table
        echo "Invalid table.";
    }
} else {
    // Handle error or invalid request
    echo "Invalid request.";
}
?>
