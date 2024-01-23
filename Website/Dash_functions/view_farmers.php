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
                <h2 class="mb-4 billing-heading">Farmers List</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Farmer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                   
                        <th>Status</th>
                        <th>Change Status</th>
                        <th>Cer Id</th>
                        <th>Aadhar</th>
                        <th>Return</th>
                    </tr>
                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "shete");

                    if (!$connection) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }

                    $query = "SELECT * FROM users WHERE user_type = 'farmer'";
                    $result = mysqli_query($connection, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['ph_number'] . "</td>";
                        echo "<td>" . $row['user_status'] . "</td>";
                        echo "<td><a href='toggle_activation.php?id=" . urlencode($row['id']) . "&type=farmer' class='status-button" . ($row['user_status'] == 'active' ? ' active' : ' inactive') . "'>" . ($row['user_status'] == 'active' ? 'Deactivate' : 'Activate') . "</a></td>";

                        // Retrieve data from the 'farmer' table for this user
                        $sql2 = "SELECT * FROM `farmer` WHERE user_id = " . $row['id'];
                        $result2 = mysqli_query($connection, $sql2);

                        if ($result2 && mysqli_num_rows($result2) > 0) {
                            $farmerData = mysqli_fetch_assoc($result2);
                            echo "<td>" . $farmerData["farmer_cer_id"] . "</td>";
                            echo "<td>" . $farmerData["aadhar_number"] . "</td>";
                            echo "<td>" . $farmerData["return"] . "</td>";
                        } else {
                            // Output empty cells if no data found in 'farmer' table
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                        }

                        echo "</tr>";
                    }

                    mysqli_close($connection);
                    ?>
            </div>
            </table>
        </section>
    </div>
</body>

</html>