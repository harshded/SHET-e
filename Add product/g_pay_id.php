
<?php
function generateUniquePaymentID($length = 10) {
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
function isPaymentIDUnique($paymentID) {
    // Replace this with your own logic to check if the payment ID is unique in your database
    // For demonstration purposes, we assume it's always unique
    return true;
}

// Example usage:
$uniquePaymentID = generateUniquePaymentID();
echo $uniquePaymentID;
?>