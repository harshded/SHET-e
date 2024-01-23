<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        /* Reset some default styles for cross-browser consistency */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Apply some basic styles to the body */
body {
    font-family: Arial, sans-serif;
    background-image:url("./images/green.jpg") ;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Style the payment form container */
.payment-form-container {
    
    width: 400px;
    height: auto;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Style form elements */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
input[type="email"],
#card-element {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

/* Style the submit button */
button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Style error messages */
#error-message {
    color: #ff0000;
    margin-top: 10px;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .payment-form-container {
        width: 90%;
    }
}
.amount {
    text-align: center; /* Center-align the content */
    margin-bottom: 20px; /* Add spacing between the label and the rest of the form */
}

.amount label {
    display: block;
    font-size: 16px;
    font-weight: bold;
    color: #333; /* Text color */
}
    </style>
</head>
<body>

<div class="payment-form-container">
    <!-- Your payment form goes here -->

<?php
session_start();
$grand_total = $_SESSION['Grand_Total'];
?>
<div class="amount">
<label for="card-element">
You are making payment of amount ₹<?php echo @$grand_total?> /-
            </label>
            </div>
            
            <?php

?>

    <form action="charge.php" method="post" id="payment-form">
        <div class="form-group">
            <label for="card-element">
                Credit or debit card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <button type="submit">Submit Payment</button>
    </form>
    </div>
    <script src="./js/stripe.js"></script>
</body>
</html>


