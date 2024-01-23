<!DOCTYPE html>
<?php

include dirname(__FILE__) . '/../includes/head.php';
?>
<body class="goto-here">
		
<?php
include dirname(__FILE__) . '/../includes/header.php';
?>

<?php include('./../admin-sidebar.php'); ?>
<div class="container">
 
    <br><br>
     <section class="home-section">
     
  
  
    <!-- <div class="container mt-5"> -->
    <div class="cart-detail cart-total p-3 p-md-4">
       <h2 class="mb-4 billing-heading">Users List</h2> 
       <table class="table table-bordered">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Full Name</th>
            
            <th>Phone Number</th>
          
            <th>User Status</th>
            <th>Action</th>
           
        </tr>
        <?php
        $connection = mysqli_connect("localhost", "root", "", "shete");
        $query = "SELECT * FROM users where user_type = 'user'";
        $result = mysqli_query($connection, $query);
        // Loop through the result to display users' information
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['full_name'] . "</td>";
            
            echo "<td>" . $row['ph_number'] . "</td>";
            echo "<td>" . $row['user_status'] . "</td>";
            echo "<td><a href='toggle_activation.php?id=" . urlencode($row['id']) . "&type=user' class='status-button" . ($row['user_status'] == 'active' ? '' : ' inactive') . "'>" . ($row['user_status'] == 'active' ? 'Deactivate' : 'Activate') . "</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <!-- Other user management elements here -->
</body>
</html>
