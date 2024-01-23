<?php
session_start();

include_once('./db.php');
$user_id = $_SESSION['id'];
// echo $user_id;
//Generate Payment Id 
function generateUniquePaymentID($length = 10)
{
    // Define characters to use for generating the random string
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charLength = strlen($characters);

    do {
        // Generate a random string of the specified length
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }

        // Check if the generated string is unique
        $isUnique = isPaymentIDUnique($randomString);
    } while (!$isUnique);

    return $randomString;
}

// Function to check if a payment ID is unique
function isPaymentIDUnique($paymentID)
{
    // Replace this with your own logic to check if the payment ID is unique in your database
    // For demonstration purposes, we assume it's always unique
    return true;
}


use Stripe\Terminal\Location;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected payment method from the form
    // $paymentmode = $_POST['paymentMethod'];
    $paymentmode = mysqli_real_escape_string($conn, $_POST['paymentmode']);
    echo "ASDFGHJ". $paymentmode;
    // Other form processing logic

    if ($paymentmode === 'cod') {

        if (isset($_POST['placeorderbtn'])) {

            $paymentmode = mysqli_real_escape_string($conn, $_POST['paymentmode']);

            $address_choice = mysqli_real_escape_string($conn, $_POST['addressGroup']);
            if ($address_choice == "existing") {
                $add_type = mysqli_real_escape_string($conn, $_POST['addressType']);



                $sql = "SELECT `id`, `city`, `town`, `pincode`, `line_1`, `line_2`, `address_type`, `mobile_no`, `email_id` FROM `address_book` WHERE `user_id` = ? AND `id` = ?";

                // Prepare the statement
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is", $user_id, $add_type);
                // Execute the query
                $stmt->execute();
                $stmt->bind_result($id, $city, $town, $pincode, $line_1, $line_2, $address_type, $mobile_no, $email_id);

                while ($stmt->fetch()) {
                    echo "ID: $id, City: $city, Town: $town, Pincode: $pincode, Line 1: $line_1, Line 2: $line_2, Address Type: $address_type, Mobile No: $mobile_no, Email: $email_id<br>";
                }
                $stmt->close();
                //get fullname

                $get_name = "SELECT `full_name`,`email`,`ph_number` FROM `users` WHERE `id` = $user_id";
                $result = $conn->query($get_name);
                $row = $result->fetch_assoc();
                $name = $row['full_name'];
                $email = $row['email'];
                $mobile = $row['ph_number'];

                $town_id = mysqli_real_escape_string($conn, $_POST['addressType']);







                //if address already exist
            } elseif ($address_choice == "new") {

                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $city = mysqli_real_escape_string($conn, $_POST['city']);
                $town_id = mysqli_real_escape_string($conn, $_POST['town']);
                $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
                $line_1 = mysqli_real_escape_string($conn, $_POST['line_1']);
                $line_2 = mysqli_real_escape_string($conn, $_POST['line_2']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
                // $paymentmode = mysqli_real_escape_string($conn, $_POST['paymentmode']);

                // $add_type = mysqli_real_escape_string($conn, $_POST['add_type']);
            } else {
                echo "error occured";
            }
            $town_name="";
            $grand_total = $_SESSION['Grand_Total'];

            // echo "<br>dfghjk".$town;die;
            $delivery_charge_sql = "SELECT town_name,charges FROM shipping_address WHERE id = $town";
            $delivery = $conn->query($delivery_charge_sql);
            if ($delivery->num_rows > 0) {
                $d_charge = $delivery->fetch_assoc();
                $delivery_charge = $d_charge['charges'];
                $town_name = $d_charge['town_name'];
            }
            
            // Fetch cartID based on user ID
            $sql = "SELECT id FROM cart WHERE user_id = $user_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $cartId = $row['id'];
            }

            if (isset($add_type)) {
                $sql = "SELECT `id`, `city`, `town`, `pincode`, `line_1`, `line_2`, `address_type`, `mobile_no`, `email_id` FROM `address_book` WHERE `user_id` = ? AND `address_type` = ?";

                // Prepare the statement
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is", $user_id, $add_type);

                // Execute the query
                $stmt->execute();

                // Get the result
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $city = $row['city'];
                    $town_id = $row['town'];
                    $pincode = $row['pincode'];
                    $line_1 = $row['line_1'];
                    $line_2 = $row['line_2'];
                    $mobile = $row['mobile_no'];
                    $email = $row['email_id'];

                    // Display the address information
                    // echo "City: " . $row['city'] . ", Town: " . $row['town'] . ", Pincode: " . $row['pincode'] . ", Line 1: " . $row['line_1'] . ", Line 2: " . $row['line_2'] . ", Address Type: " . $row['address_type'] . ", Mobile No: " . $row['mobile_no'] . ", Email ID: " . $row['email_id'];
                } else {
                    echo "no record found";
                }
            } else {
                $sql_address = "INSERT INTO address_book (user_id, city, town, pincode, line_1, line_2,mobile_no,email_id)
        VALUES ('$user_id', '$city', '$town_name', '$pincode', '$line_1', '$line_2','$mobile','$email')";

                if ($conn->query($sql_address) === TRUE) {
                    $address_id = $conn->insert_id;
                }
            }






            $createdDate = date("Y-m-d");

            //generate Payment Id
            $payment_id = generateUniquePaymentID();


            $order_query = "INSERT INTO orders(user_id,order_date,fullname, email, phone, payment_mode, payment_id, total_amount,status,billing_city,billing_town,billing_pincode,billing_line_1,billing_line_2,billing_email_id,shipping_city,shipping_town,shipping_pincode,shipping_line_1,shipping_line_2,shipping_mobile_no,shipping_email_id,payment_status) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($order_query);

            if ($stmt === false) {
                die("Error in preparing the SQL statement: " . $conn->error);
            }
           
            $payment_status = "unpaid";
            $delivery_charge_sql = "SELECT town_name,charges FROM shipping_address WHERE id = $town_id";
            $delivery = $conn->query($delivery_charge_sql);
            if ($delivery->num_rows > 0) {
                $d_charge = $delivery->fetch_assoc();
                $delivery_charge = $d_charge['charges'];
                $town_name = $d_charge['town_name'];
            }
            // echo $town_name;die;
            // Bind the parameters to the statement
            $stmt->bind_param("isssississsisssssississ", $user_id, $createdDate, $name, $email, $mobile, $paymentmode, $payment_id, $grand_total, $status, $city, $town_name, $pincode, $line_1, $line_2, $email, $city, $town_name, $pincode, $line_1, $line_2, $mobile, $email, $payment_status);

            echo "hmshdgvfs", $city, $line_1, $line_2, $pincode;

            $status = "in progress"; // Set the status

            // Execute the statement
            if ($stmt->execute()) {
                echo "Order successfully!";

                $order_id = $stmt->insert_id;

                $query = "select * from cart_item where cart_id='$cartId'";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $productId = $row['product_id'];
                    $productqty = $row['qty'];
                    $price = $row['sp_price'];
                    $sql = "SELECT user_id FROM product WHERE id = '$productId'";

                    // Execute the query
                    $result_id = mysqli_query($conn, $sql);
                    $row_id = mysqli_fetch_assoc($result_id);
        
            // Get the user_id
                    $product_userid = $row_id['user_id'];
                    // echo $product_userid;die;
        
                    $insert_order_item = "INSERT INTO order_items(order_id,product_id, quantity,unit_price,supplier_id)values(?,?,?,?,?)";
                    $insert_order_item = $conn->prepare($insert_order_item);
                    $insert_order_item->bind_param("iiiii", $order_id, $productId, $productqty, $price,$product_userid);
                    $insert_order_item->execute();
                }
                echo $deletecart = "DELETE from cart_item where cart_id ='$cartId'";
                $deletecart_run = mysqli_query($conn, $deletecart);

                $_SESSION['cart_count'] = 0;


                header("location: ../Dash_functions/view_orders.php");
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement and the database connection
            $stmt->close();
            $conn->close();
        }
    } elseif ($paymentmode === 'Card') {
        // Handle online payment (e.g., using Stripe, PayPal, etc.)

       

        $address_choice = mysqli_real_escape_string($conn, $_POST['addressGroup']);
        if ($address_choice == "existing") {
            $add_type = mysqli_real_escape_string($conn, $_POST['addressType']);



            $sql = "SELECT `id`, `city`, `town`, `pincode`, `line_1`, `line_2`, `address_type`, `mobile_no`, `email_id` FROM `address_book` WHERE `user_id` = ? AND `id` = ?";

            // Prepare the statement
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $user_id, $add_type);
            // Execute the query
            $stmt->execute();
            $stmt->bind_result($id, $city, $town, $pincode, $line_1, $line_2, $address_type, $mobile_no, $email_id);

            while ($stmt->fetch()) {
                // echo "ID: $id, City: $city, Town: $town, Pincode: $pincode, Line 1: $line_1, Line 2: $line_2, Address Type: $address_type, Mobile No: $mobile_no, Email: $email_id<br>";
            }
            $stmt->close();
            //get fullname

            $get_name = "SELECT `full_name`,`email`,`ph_number` FROM `users` WHERE `id` = $user_id";
            $result = $conn->query($get_name);
            $row = $result->fetch_assoc();
            $name = $row['full_name'];
            $email = $row['email'];
            $mobile = $row['ph_number'];

            $town_id = mysqli_real_escape_string($conn, $_POST['addressType']);


            


            // echo "asa".$paymentmode;die;

            //if address already exist
        } elseif ($address_choice == "new") {

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $town_id = mysqli_real_escape_string($conn, $_POST['town']);
            $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
            $line_1 = mysqli_real_escape_string($conn, $_POST['line_1']);
            $line_2 = mysqli_real_escape_string($conn, $_POST['line_2']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
            // $paymentmode = mysqli_real_escape_string($conn, $_POST['paymentmode']);

            // $add_type = mysqli_real_escape_string($conn, $_POST['add_type']);
            
        } else {
            echo "error occured";
        }


        $grand_total = $_SESSION['Grand_Total'];
        $town_name="";
        $delivery_charge_sql = "SELECT town_name,charges FROM shipping_address WHERE id = $town_id";
        $delivery = $conn->query($delivery_charge_sql);
        if ($delivery->num_rows > 0) {
            $d_charge = $delivery->fetch_assoc();
            $delivery_charge = $d_charge['charges'];
            $town_name = $d_charge['town_name'];
        }



        // Fetch cartID based on user ID
        $sql = "SELECT id FROM cart WHERE user_id = $user_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cartId = $row['id'];
        }
        

        if (isset($add_type)) {
            $sql = "SELECT `id`, `city`, `town`, `pincode`, `line_1`, `line_2`, `address_type`, `mobile_no`, `email_id` FROM `address_book` WHERE `user_id` = ? AND `address_type` = ?";

            // Prepare the statement
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $user_id, $add_type);

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $city = $row['city'];
                $town_id = $row['town'];
                $pincode = $row['pincode'];
                $line_1 = $row['line_1'];
                $line_2 = $row['line_2'];
                $mobile = $row['mobile_no'];
                $email = $row['email_id'];

                // Display the address information
                // echo "City: " . $row['city'] . ", Town: " . $row['town'] . ", Pincode: " . $row['pincode'] . ", Line 1: " . $row['line_1'] . ", Line 2: " . $row['line_2'] . ", Address Type: " . $row['address_type'] . ", Mobile No: " . $row['mobile_no'] . ", Email ID: " . $row['email_id'];
            } else {
                echo "no record found";
            }
        } else {
            $sql_address = "INSERT INTO address_book (user_id, city, town, pincode, line_1, line_2, address_type,mobile_no,email_id)
    VALUES ('$user_id', '$city', '$town_name', '$pincode', '$line_1', '$line_2', '$address_type','$mobile','$email')";

            if ($conn->query($sql_address) === TRUE) {
                $address_id = $conn->insert_id;
            }
        }
      

        $createdDate = date("Y-m-d");

        //generate Payment Id
        $payment_id = generateUniquePaymentID();
        
        $order_query = "INSERT INTO orders(user_id,order_date,fullname, email, phone, payment_mode, payment_id, total_amount,status,billing_city,billing_town,billing_pincode,billing_line_1,billing_line_2,billing_email_id,shipping_city,shipping_town,shipping_pincode,shipping_line_1,shipping_line_2,shipping_mobile_no,shipping_email_id,payment_status) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($order_query);

            if ($stmt === false) {
                die("Error in preparing the SQL statement: " . $conn->error);
            }
            $payment_status = "unpaid";
            $delivery_charge_sql = "SELECT town_name,charges FROM shipping_address WHERE id = $town";
            $delivery = $conn->query($delivery_charge_sql);
            if ($delivery->num_rows > 0) {
                $d_charge = $delivery->fetch_assoc();
                $delivery_charge = $d_charge['charges'];
                $town_name = $d_charge['town_name'];
            }
            // Bind the parameters to the statement
            $stmt->bind_param("isssississsisssssississ", $user_id, $createdDate, $name, $email, $mobile, $paymentmode, $payment_id, $grand_total, $status, $city, $town_name, $pincode, $line_1, $line_2, $email, $city, $town_name, $pincode, $line_1, $line_2, $mobile, $email, $payment_status);

        // echo "<br>hmshdgvfs", $city, $line_1, $line_2, $pincode;

        $status = "in progress"; // Set the status

        // Execute the statement
        if ($stmt->execute()) {
            echo "Order successfully!";
            $_SESSION['last_inserted_id'] = $conn->insert_id;

            $order_id = $stmt->insert_id;

            $query = "select * from cart_item where cart_id='$cartId'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $productId = $row['product_id'];
                $productqty = $row['qty'];
                $price = $row['sp_price'];

                $sql = "SELECT user_id FROM product WHERE id = '$productId'";

            // Execute the query
            $result_id = mysqli_query($conn, $sql);
            $row_id = mysqli_fetch_assoc($result_id);

    // Get the user_id
            $product_userid = $row_id['user_id'];
            // echo $product_userid;die;

            $insert_order_item = "INSERT INTO order_items(order_id,product_id, quantity,unit_price,supplier_id)values(?,?,?,?,?)";
            $insert_order_item = $conn->prepare($insert_order_item);
            $insert_order_item->bind_param("iiiii", $order_id, $productId, $productqty, $price,$product_userid);
                $insert_order_item->execute();
            }
            echo $deletecart = "DELETE from cart_item where cart_id ='$cartId'";
            $deletecart_run = mysqli_query($conn, $deletecart);

            $_SESSION['cart_count'] = 0;
            header("Location: ../payment.php");
            // header("location: ../cart.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // header("Location: ../payment.php");
        // Redirect the user to the payment gateway as shown in the Stripe example
    }

    // Rest of your form processing logic
}
