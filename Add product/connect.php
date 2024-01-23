
<?php
//require_once('../functions/db.php');

$servername = "localhost";
$username = "root";
$password = "";
$database = 'shete';

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['Submit'])){
    $product = $_POST['product'];
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

    $extention = array('jpeg', 'jpg', 'png');

    if(in_array($file_extension, $extention)){
        $upload_image = '../images/' . $imagefilename;
        move_uploaded_file($imagefiletemp, $upload_image);
        $sql = "INSERT INTO product (name,description,price, sp_price,Weight_type, qty, expire_date, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss",$product, $des, $cp, $sp, $unit, $qty, $exp,$upload_image);
        echo $stmt->execute();
        if ($stmt->execute()) {
            echo "String inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Invalid file type.";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();

?>


