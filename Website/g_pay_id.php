
<?php
include "./functions/db.php";
function generateUniquePaymentID($length = 10, $conn) {
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
        $isUnique = isPaymentIDUnique($randomString, $conn);

    } while (!$isUnique);

    return $randomString;
}

// Function to check if a payment ID is unique in the database
function isPaymentIDUnique($paymentID, $conn) {
    // Prepare a SQL query to check if the payment ID exists

    $sql = "SELECT COUNT(*) FROM orders WHERE payment_id = :payment_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('s', $paymentID);
    $stmt->execute();

    // Fetch the result
    $count = $stmt->fetchColumn();

    // If the count is 0, the payment ID is unique
    return $count === 0;
}


$uniquePaymentID = generateUniquePaymentID(10, $conn);
echo "Unique Payment ID: " . $uniquePaymentID;

?>