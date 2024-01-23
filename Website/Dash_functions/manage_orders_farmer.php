<!DOCTYPE html>
<?php

include dirname(__FILE__) . '/../includes/head.php';
?>
<body class="goto-here">
		
<?php
include dirname(__FILE__) . '/../includes/header.php';
if($_SESSION['user_type'] === 'farmer'){
   // echo "You are not authorized to acces this page.";

}
?>

<?php include('./../farmer-sidebar.php'); ?>

<section class="home-section">
    <div class="container mt-5">
        <h2>Orders Received</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Product</th>
                    <th>Qty</th>
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
               
                $sql_product = "SELECT * FROM order_items WHERE supplier_id = $userId";
                $res = $conn->query($sql_product);

                

                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $or_id=$row['order_id'];
                        //order details
                        $sql = "SELECT * FROM orders WHERE id = $or_id";
                        $result = $conn->query($sql);
                        $row_or = $result->fetch_assoc();
                        $prod_id=$row['product_id'];
                        //product name fetch
                        $sql_pname ="SELECT name,weight_type FROM product where id=$prod_id";
                        $res_name= $conn->query($sql_pname);
                        $row_pname = $res_name->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row_or['order_date']; ?></td>
                            <td><?php echo $row_pname['name']; ?></td>
                            <td><?php echo $row['quantity'],"-",$row_pname['weight_type']; ?></td>
                            <td><?php echo $row_or['status']; ?></td>
                           
                            <td>
                            Shipping Name: <?php echo $row_or['fullname']; ?><br>
                                Shipping Email: <?php echo $row_or['shipping_email_id']; ?><br>
                                Shipping Address: <?php echo $row_or['shipping_line_1'] . ', ' . $row_or['shipping_line_2'] . ', ' . $row_or['shipping_town'] . ', ' . $row_or['shipping_city'] . ', ' . $row_or['shipping_pincode']; ?><br>
                                Shipping Phone: <?php echo $row_or['shipping_mobile_no']; ?>
                            </td>
                            <td><?php echo '₹' . number_format($row_or['total_amount'], 2); ?></td>
                            <td>
                                <?php
                                if ($row['status'] != 'Cancelled') {
                                    echo '<button class="btn btn-danger" onclick="cancelOrder(' . $row['id'] . ')">Cancel Order</button>';
                                } else {
                                    echo 'Order Cancelled';
                                }
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
