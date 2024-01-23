<?php
session_start();

if ($_SESSION['user_type'] == 'user') {

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

    // Get the user ID from the URL
    $user_id = $_SESSION["id"];
    // echo $user_id;

    // Fetch addresses related to the user ID
    $address_sql = "SELECT * FROM address_book WHERE user_id=$user_id";
    // echo $address_sql;die;
    $add_result = $conn->query($address_sql);
    // var_dump($add_result);die;
?>

   
    <html lang="en">

   
        <?php
        include  dirname(__FILE__) . '/../includes/head.php';
        ?>
        
    <?php include('./../user-sidebar.php'); ?>

    <?php
                include dirname(__FILE__) . '/../includes/header.php';
                ?>
    <body>
        <div class="container">

<br><br>
            <section class="home-section">
                
                <!-- <div class="container mt-5"> -->
                    
                <div class="cart-detail cart-total p-3 p-md-4">
                                        <p><a href="add_address.php"><input type="submit" value="Add New Address" class="btn btn-primary py-3 px-4"> </a></p>

                    <h2 class="mb-4 billing-heading">All Addresses</h2>

                    
                    <table class="table table-bordered">
                        <tr>
                            <th>City</th>
                            <th>Town</th>
                            <th>Pincode</th>
                            <th>Line 1</th>
                            <th>Line 2</th>
                            <th>Address Type</th>
                            <th>Mobile Number</th>
                            <th>Email ID</th>
                            <th>Edit</th>
                        </tr>
                        <?php
                        if (isset($_SESSION['address_add'])) {
                        ?>
                            <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Hey</strong><?php echo $_SESSION['edit_prod_status']; ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div> -->
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Address',
                                    text: 'Inserted Successfully',
                                })
                            </script>
                        <?php
                            unset($_SESSION['address_add']);
                        }
                        ?>
                        <?php

                        if ($add_result->num_rows > 0) {
                            while ($row = $add_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["city"] . "</td>";
                                echo "<td>" . $row["town"] . "</td>";
                                echo "<td>" . $row["pincode"] . "</td>";
                                echo "<td>" . $row["line_1"] . "</td>";
                                echo "<td>" . $row["line_2"] . "</td>";
                                echo "<td>" . $row["address_type"] . "</td>";
                                echo "<td>" . $row["mobile_no"] . "</td>";
                                echo "<td>" . $row["email_id"] . "</td>";
                                echo '<td><a href="edit_address.php?address_id=' . $row["id"] . '&user_id=' . $row["user_id"] . '">Edit</a></td>';



                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>No addresses found for User ID $user_id</td></tr>";
                        }
                        ?>
                    </table>
                </div>
        </div>
        </section>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
}
?>