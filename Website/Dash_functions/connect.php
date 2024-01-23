<?php

require_once('../functions/db.php');
session_start();
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = 'shete';

// $conn = new mysqli($servername, $username, $password, $database);
$userId = $_SESSION['id'];
// // var_dump($user_id); die;
// // echo $user_id;
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// echo "sdfgdsgs";die;
if (isset($_POST['submit'])) {
    $product_name = $_POST['product'];
    $des = $_POST['des'];
    $cp = $_POST['cp'];
    $sp = $_POST['sp'];
    $unit = $_POST['unit'];
    $qty = $_POST['qty'];
    $exp = $_POST['exp'];
    $image = $_FILES['image'];

    $imagefilename = $image['name'];
    $imagefileerror = $image['error'];
    $imagefiletemp = $image['tmp_name'];

    $filename_separate = explode('.', $imagefilename);
    $file_extension = strtolower(end($filename_separate));

    $allowed_extensions = array('jpeg', 'jpg', 'png');
    $max_image_size = 2 * 1024 * 1024; // 2MB in bytes

    $final_img_name = $filename_separate[0] . '_' . strtotime(date('Y-m-d h:i:s')) . '.' . $file_extension;
    
    // Check file extension
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Invalid file type.";
    }
    // Check file size
    elseif ($image['size'] > $max_image_size) {
        echo "File size exceeds the limit (2MB).";
    } else {
        $upload_image = dirname(__DIR__).'/images/' . $final_img_name;
        @move_uploaded_file($imagefiletemp, $upload_image);
       
        // Assuming you have a database connection object named $conn
        $sql = "INSERT INTO product (user_id, name, description, price, sp_price, Weight_type, qty, expire_date, image_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issiisiss", $userId, $product_name, $des, $cp, $sp, $unit, $qty, $exp, $final_img_name);

        if ($stmt->execute()) {
            echo "Record inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        


        $sql = "SELECT id, user_id, name, description, price, sp_price, Weight_type, qty, expire_date, image_name FROM product";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product_id = $row["id"];
                $user_id = $row["user_id"];
                $product_name = $row["name"];
                $description = $row["description"];
                $price = $row["price"];
                $sp_price = $row["sp_price"];
                $unit = $row["Weight_type"];
                $qty = $row["qty"];
                $exp = $row["expire_date"];
                $image = $row["image_name"];

                echo "Unit: $unit<br>";
                echo "Quantity: $qty<br>";
                echo "Expiration Date: $exp<br>";
                echo "Expiration Date: $image<br>";
?>
                <img src="../images/4957136_4957136.jpg" alt='Product Image' width='200' height='200'><br>;

                <img src="../images/<?php echo $image; ?>" alt='Product Image' width='200' height='200'><br>;

                
<?php
            $_SESSION['product_added']="added";

            header("location:../Dash_functions/new_product.php");
                echo "<hr>";
            }
        }
    }
}



// Close the database connection
$conn->close();

?>