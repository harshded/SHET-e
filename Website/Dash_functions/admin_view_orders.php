<!DOCTYPE html>
<?php

include dirname(__FILE__) . '/../includes/head.php';
?>
<body class="goto-here">
		
<?php
include dirname(__FILE__) . '/../includes/header.php';

 
?>

<?php include('./../admin-sidebar.php'); ?>

<section class="home-section">
    <div class="container mt-5">
        <h2>Orders Received</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                  
                    <th>Status</th>
                    <!-- <th>Billing Details</th> -->
                    <th>Shipping Details</th>
                    <th>Payment Status</th>
                    <th>Total Amount</th>
                    <!-- <th>Action</th> New column for Cancel Order button -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch user's orders with billing and shipping details from the database
                $sql = "SELECT * FROM orders";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            
                            <td><?php echo $row['status']; ?></td>
                            <!-- <td>
                            Billing Name: <?php echo $row['fullname']; ?><br>
                                Billing Email: <?php echo $row['billing_email_id']; ?><br>
                                Billing Address: <?php echo $row['billing_line_1'] . ', ' . $row['billing_line_2'] . ', ' . $row['billing_town'] . ', ' . $row['billing_city'] . ', ' . $row['billing_pincode']; ?><br>
                            </td> -->
                           
                            <td>
                            Shipping Name: <?php echo $row['fullname']; ?><br>
                                Shipping Email: <?php echo $row['shipping_email_id']; ?><br>
                                Shipping Address: <?php echo $row['shipping_line_1'] . ', ' . $row['shipping_line_2'] . ', ' . $row['shipping_town'] . ', ' . $row['shipping_city'] . ', ' . $row['shipping_pincode']; ?><br>
                                
                            </td>
                            <td><?php echo $row['payment_status']; ?></td>
                            <td><?php echo '₹' . number_format($row['total_amount'], 2); ?></td>
                            
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7">No orders found.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

   
</script>

</body>
</html>
