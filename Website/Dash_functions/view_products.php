<!DOCTYPE html>
<html>

<head>
    <title>View Products List</title>
    <?php
   
    include  dirname(__FILE__) . '/../includes/head.php';
    ?>
</head>

<body class="goto-here">

    <?php
    include dirname(__FILE__) . '/../includes/header.php';
    ?>

    <?php include('./../farmer-sidebar.php'); ?>

    <section class="home-section">
        <?php
        session_start();


        if (isset($_SESSION['edit_prod_status'])) {
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
                    title: 'Product',
                    text: 'Product Edited',
                })
            </script>
        <?php
            unset($_SESSION['edit_prod_status']);
        }
        ?>
        <div class="container mt-5">
            <div class="container">
                <h2 class="mb-4 billing-heading">Products List</h2>
                <a href="<?php echo $base_url?>/Dash_functions/new_product.php">
                <button class="btn btn-success">Add Product</button>
                <a>
                    <br><br>

                <table class="table table-bordered">
                    <tr>
                        <!-- <th>Product ID</th> -->
                        <th>Product Name</th>
                        <th>Image</th>
                        <!-- <th>Description</th> -->
                        <th>Cost Price /</th>
                        <th>Selling Price</th>
                        <th>Weight Type</th>
                        <th>Quantity</th>
                        <th>Expiry Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    $connection = mysqli_connect("localhost", "root", "", "shete");

                    if (!$connection) {
                        die("Database connection failed: " . mysqli_connect_error());
                    }

                    

                    $query = "SELECT id,name,image_name,price,sp_price,weight_type,qty,expire_date FROM product WHERE deleted = 0 AND user_id =?";

                    // Prepare the Statement
                    $stmt = $connection->prepare($query);

                    // Bind Parameters
                    mysqli_stmt_bind_param($stmt, 'i', $_SESSION["id"]);

                    // Execute the Statement
                    $stmt->execute();
                    
                    // $result = mysqli_query($connection, $query);
                    mysqli_stmt_bind_result($stmt, $id, $name, $image_name, $price, $sp_price, $weight_type, $qty, $expire_date);

                    if (!$stmt) {
                        die("Database query failed: " . mysqli_error($connection));
                    }
                    
                    
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "<tr>";
                            // echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($name) . "</td>";
                            echo "<td class='table-responsive-sm'><img src='../images/" . htmlspecialchars($image_name). "' alt='Product Image' width='70px'></td>";
                            // echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>₹" . htmlspecialchars($price) . "</td>";
                            echo "<td>₹" . htmlspecialchars($sp_price) . "</td>";
                            echo "<td>" . htmlspecialchars($weight_type) . "</td>";
                            echo "<td>" . htmlspecialchars($qty) . "</td>";
                            echo "<td>" . htmlspecialchars($expire_date) . "</td>";
                            echo "<td><p><a href=edit_product.php?id=" . htmlspecialchars($id) . ">Edit</a></p></td>";
                            echo "<td><p><a href=delete_product.php?id=" . htmlspecialchars($id) . ">Delete</a></p></td>";
                            echo "</tr>";
                        }
                    

                    mysqli_close($connection);
                    ?>
                </table>
            </div>

        </div>
    </section>
</body>

</html>