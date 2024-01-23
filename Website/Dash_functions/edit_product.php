<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <?php
   
include  dirname(__FILE__) . '/../includes/head.php';
?>
</head>
<body class="goto-here">
<?php
	include dirname(__FILE__) . '/../includes/header.php';

	include('./../user-sidebar.php');
    $connection = mysqli_connect("localhost", "root", "", "shete");

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $id = $_GET["id"];
        
        $query = "SELECT * FROM product WHERE id = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $useExistingImage = true; // Initialize to use the existing image by default
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["image_choice"])) {
                // Check which option the user selected
                $useExistingImage = ($_POST["image_choice"] === "existing_image");
            }
            
            ?>

<section class="home-section">
  <div class="container">
    <div class="row mt-5 pt-3">
      <div class="col-md-12 d-flex mb-5">
        <div class="cart-detail cart-total p-3 p-md-4">
          <form action="update_product.php" method="POST" enctype="multipart/form-data" class="billing-form">
            <h2 class="mb-4 billing-heading">Edit Product</h2>
            <div class="row align-items-end">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <div class="w-100"></div>
                <div class="col-md-4">
                <div class="form-group">
                    <label class=" form-control-label" for="name">Product Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required value="<?php echo htmlspecialchars($row['name']); ?>">
                </div>
               </div>
               <div class="col-md-8">
                   <div class="form-group">
                      <label class="form-control-label" for="description">Description:</label>
                       <textarea id="description" name="description" rows="2" cols="10" class="form-control" required><?php echo htmlspecialchars($row['description']); ?></textarea>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                    <div class="form-group">
                       <label class="form-control-label" for="price">Price:</label>
                       <input type="number" id="price" name="price" step="0.01" class="form-control" required value="<?php echo htmlspecialchars($row['price']); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">                       
                    <label class="form-control-label" for="sp_price">Special Price:</label>
                    <input type="number" id="sp_price" name="sp_price" step="0.01" class="form-control" required value="<?php echo htmlspecialchars($row['sp_price']); ?>">
                </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-4">
                    <div class="form-group">                    
                    <label class="form-control-label" for="qty">Quantity:</label>
                    <input type="number" id="qty" name="qty" class="form-control" required value="<?php echo htmlspecialchars($row['qty']); ?>">
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"> 
                    <label class="form-control-label" for="expire_date">Expiry Date:</label>
                    <input type="date" id="expire_date" name="expire_date" class="form-control" required value="<?php echo htmlspecialchars($row['expire_date']); ?>">
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group"> 
                      <label class="form-control-label" for="weight_type">Weight Type:</label>
                      <select id="weight_type" name="weight_type" class="form-control">
                        <option value="dozen" <?php if ($row['weight_type'] == 'dozen') echo 'selected'; ?>>Dozen</option>
                        <option value="kg" <?php if ($row['weight_type'] == 'kg') echo 'selected'; ?>>Kilogram</option>
                        <option value="pieces" <?php if ($row['weight_type'] == 'pieces') echo 'selected'; ?>>Pieces</option>
                      </select>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="w-100"></div>
                <div class="col-md-8">
                    <div class="form-group"> 
                      <label class="form-control-label">Choose Image:</label>
                        <input type="radio" id="existing_image" name="image_choice" value="existing_image" <?php echo $useExistingImage ? 'checked' : ''; ?>>
                        <label class="form-control-label" for="existing_image">Existing Image</label>
                        <input type="radio" id="new_image" name="image_choice" value="new_image" <?php echo !$useExistingImage ? 'checked' : ''; ?>>
                        <label for="new_image">Upload New Image</label>
                      <!-- File input for new image -->
                      <div class="form-group" id="new_image_upload" style="<?php echo !$useExistingImage ? 'display:block;' : 'display:none;'; ?>">
                        <label class="form-control-label" for="image">New Image:</label>
                        <input type="file" id="image" name="new_image" accept=".jpg, .jpeg, .png" class="form-control" style="font-size: 17px;">
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group"> 
                    <div id="default_image_container">
                    <label class="form-control-label" for="default_image">Current Image:</label>
                    <img class="img-fluid" style="
										width: 253px;
										height: 203px;
										object-fit: fill;
									" src="../images/<?php echo $row["image_name"];?>" alt="Image">
                    </div>
                    </div>
                </div>
                    <p><input type="submit" value="Save Changes" class="btn btn-primary py-3 px-4"></p>
            </div>
         </form>
          </div>
        </div>
     </div>
  </div>
</section>
            <?php
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid request.";
    }

    mysqli_close($connection);
    ?>
    
    <script>
        // JavaScript to toggle the display of the new image upload field
        const existingImageRadio = document.getElementById("existing_image");
        const newImageRadio = document.getElementById("new_image");
        const newImageUpload = document.getElementById("new_image_upload");
        
        existingImageRadio.addEventListener("change", () => {
            newImageUpload.style.display = "none";
        });
        
        newImageRadio.addEventListener("change", () => {
            newImageUpload.style.display = "block";
        });
    </script>
</body>
</html>