<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

session_start();
require_once('vendor/autoload.php'); // Include the Stripe PHP library
require_once('./functions/db.php');
\Stripe\Stripe::setApiKey('sk_test_LVdynyRXdFTRtnseMbDIUIno');

// Get the token submitted by the form
$token = $_POST['stripeToken'];
"order id=".$_SESSION['last_inserted_id'];
$grand_total = $_SESSION['Grand_Total'];
// Create a charge
try {
    $charge = \Stripe\Charge::create([
        'amount' =>$grand_total*100, // Amount in cents
        'currency' => 'inr',
        'description' => 'Example charge',
        'source' => $token,
        'metadata' => [
            'order_id' => $_SESSION['last_inserted_id'],  // Replace with your custom data
            'customer_name' => 'John Doe',
            'custom_field' => 'Some custom value',
        ],
    ]);
    // print_r($charge);
    // Payment successful
    $id = $charge['id'];
    $balance_transaction = $charge['balance_transaction'];
    $status = $charge['status'];
    $receipt_url = $charge['receipt_url'];
    $metadata = $charge['metadata'];
    $order_id = $charge['metadata']['order_id'];
    if($order_id)
    {
        $update_query = "UPDATE `orders` SET `payment_id`=?, `payment_status`=? WHERE id=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssi", $balance_transaction, $status,$_SESSION['last_inserted_id']);
        if ($stmt->execute()) {

            ?>
            <div style="display:none">
            <?php
            echo "dggffd";
            ?>
            </div>
            
            <script>
						Swal.fire({
							icon: 'success',
							title: 'Payement',
							text: 'Payment successful',
						}).then(function(){
                            window.location="./Dash_functions/view_orders.php";
                        });
					</script>
            
            
            <?php
        } else {
            echo "Error updating record: " . $stmt->error;
        }

    }

} catch (\Stripe\Exception\CardException $e) {
    // Payment failed
    echo "Payment failed: " . $e->getError()->message;
} catch (Exception $e) {
    // Something else went wrong
    echo "Payment failed: An error occurred.".$e->getMessage();
}
?>
