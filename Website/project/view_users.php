<html>
<head>
    <title>View Users List</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" type="text/css" href="view_css.css">
</head>
<body>
    <h1>Users List</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Full Name</th>
            <th>Password</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Created At</th>
            <th>User Type</th>
            <th>Profile Picture</th>
            <th>User Status</th>
            <th>Action</th>
        </tr>
        <?php
        $connection = mysqli_connect("localhost", "root", "", "shete");
        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);
        // Loop through the result to display users' information
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['ph_number'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>" . $row['user_type'] . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['profile_pic']) . "' alt='Profile Pic'></td>";
            echo "<td>" . $row['user_status'] . "</td>";
            echo "<td><a href='toggle_activation.php?id=" . $row['id'] . "&table=users' class='status-button" . ($row['user_status'] == 'active' ? '' : ' inactive') . "'>" . ($row['user_status'] == 'active' ? 'Deactivate' : 'Activate') . "</a></td>";

            echo "</tr>";
        }
        ?>
    </table>
    <!-- Other user management elements here -->
</body>
</html>
