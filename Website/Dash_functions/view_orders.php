<!DOCTYPE html>
<?php
include dirname(__FILE__) . '/../includes/head.php';
?>
<body class="goto-here">
		
<?php
include dirname(__FILE__) . '/../includes/header.php';
?>

<?php include('./../user-sidebar.php'); ?>

<section class="home-section">
    <div class="container mt-5">
        <h2>My Orders</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                  
                    <th>Status</th>
                    <!-- <th>Billing Details</th> -->
                    <th>Shipping Details</th>
                    <th>Total Amount</th>
                    <th>Action</th> <!-- New column for Cancel Order button -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch user's orders with billing and shipping details from the database
                $sql = "SELECT * FROM orders WHERE user_id = $userId";
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
                                Shipping Phone: <?php echo $row['shipping_mobile_no']; ?>
                            </td>
                            <td><?php echo '₹' . number_format($row['total_amount'], 2); ?></td>
                            <td>
                                <?php
                                if ($row['status'] != 'Cancelled') {
                                    echo '<button class="btn btn-danger" onclick="cancelOrder(' . $row['id'] . ')">Cancel Order</button>';
                                } else {
                                    echo 'Order Cancelled';
                                }
                                echo '<br><br><button class="btn btn-primary" id="redirectButton" onclick="downloadInvoice(' . $row['id'] . ')">Download Invoice</button>';
                                ?>
                            </td>
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

<!-- JavaScript to handle canceling orders -->
<script>
    function cancelOrder(orderId) {
        // Confirm with the user before canceling the order
        if (confirm("Are you sure you want to cancel this order?")) {
            // Send an AJAX request to cancel the order
            $.ajax({
                type: "POST",
                url: "cancel_order.php",
                data: { orderId: orderId },
                success: function (response) {
                    // Reload the page or update the order status dynamically
                    location.reload();
                },
                error: function (xhr, status, error) {
                    alert("An error occurred while canceling the order.");
                }
            });
        }
        
    }

    function downloadInvoice(orderId){
        // window.open('../inv-pdf/pdf.php?buttonValue='+orderId+'_blank');
        window.location.href = "../inv-pdf/pdf.php?buttonValue="+orderId;
    }
    
    // Get the button element by its id
    //const redirectButton = document.getElementById('redirectButton');

// Add a click event listener to the button
// redirectButton.addEventListener('click', function() {
//     // Get the button value
//     const buttonValue = this.value;


//     // Redirect the user to another page with the id as a query parameter
//     window.location.href = "../inv-pdf/pdfmaker.php?buttonValue="+buttonValue;
// });
   
</script>

</body>
</html>
