<?php
// update_product.php
session_start();

$connection = mysqli_connect("localhost", "root", "", "shete");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    
    // Retrieve the edited product details from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $sp_price = $_POST['sp_price'];
    $qty = $_POST['qty'];
    $expire_date = $_POST['expire_date'];
    $weight_type = $_POST['weight_type'];

    // Handle image based on user's choice
    if ($_POST["image_choice"] === "existing_image") {
        // Use the existing image
        $query = "UPDATE product SET name=?, description=?, price=?, sp_price=?, qty=?, expire_date=?, weight_type=? WHERE id=?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ssddissi', $name, $description, $price, $sp_price, $qty, $expire_date, $weight_type, $id);
        if ($stmt->execute()) {
            echo "Record inserted successfully.";
            $_SESSION['edit_prod_status'] = "Product edited succesfully";
            header("location:./view_products.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Upload a new image
        // $newImage = $_FILES['new_image'];
        $image = $_FILES['new_image'];
        
        if ($image && $image['error'] == 0) {
            $imagefilename = $image['name'];
            $imagefileerror = $image['error'];
            $imagefiletemp = $image['tmp_name'];
        
            $filename_separate = explode('.', $imagefilename);
            $file_extension = strtolower(end($filename_separate));
        
            $allowed_extensions = array('jpeg', 'jpg', 'png');
            $max_image_size = 2 * 1024 * 1024; // 2MB in bytes
        
            $final_img_name = $filename_separate[0] . '_' . strtotime(date('Y-m-d h:i:s')) . '.' . $file_extension;

            $upload_image = dirname(__DIR__).'/images/' . $final_img_name;
            @move_uploaded_file($imagefiletemp, $upload_image);
            
            $query = "UPDATE product SET name=?, description=?, price=?, sp_price=?, qty=?, expire_date=?, weight_type=?, image_name=? WHERE id=?";
            $stmt = mysqli_prepare($connection, $query);
            $stmt->bind_param('ssiiisssi', $name, $description, $price, $sp_price, $qty, $expire_date, $weight_type, $final_img_name, $id);
            if ($stmt->execute()) {
                echo "Record inserted successfully.";
                $_SESSION['edit_prod_status'] = "Product edited succesfully";
            header("location:./view_products.php");
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            
        } else {
            echo "Failed to upload a new image.";
            exit;
        }
    }

    
}
mysqli_close($connection);
?>

