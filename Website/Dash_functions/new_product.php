<!DOCTYPE html>
<?php

include  dirname(__FILE__) . '/../includes/head.php';
?>

<body class="goto-here">

  <?php
  
  include dirname(__FILE__) . '/../includes/header.php';
  ?>

  <?php include('./../farmer-sidebar.php'); ?>

  <?php
  if (isset($_SESSION['product_added'])) {
      ?>
      <script>
						Swal.fire({
							icon: 'success',
							title: 'Product',
							text: 'Product Added Successfully',
						})
					</script>
          
      <?php
  }
  
  unset($_SESSION['product_added']);
  ?>

<section class="home-section">
  <div class="container">
    <div class="row mt-5 pt-3">
      <div class="col-md-12 d-flex mb-5">
        <div class="cart-detail cart-total p-3 p-md-4">
          <form action="connect.php" method="post" enctype="multipart/form-data" class="billing-form">
            <h2 class="mb-4 billing-heading">Add Product</h2>
            <div class="row align-items-end">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="category" class=" form-control-label">Select Category</label>
                    <select name="Category" class="form-control" id="Category" style="width: 250px; height: 40px; font-size: 17px;" required>
                      <option value="">Category</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="fname" class=" form-control-label"> Product Name</label>
                    <select name="product" class="form-control" id="product" style="width: 250px; height: 40px; font-size: 17px;" required>
                      <option value="">Select Product</option>
                    </select>
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="des" class=" form-control-label">Short Description </label>
                    <!-- <input id="des" type="text" maxlength="100" name="des" style="width: 300px; height: 100px;"required/> -->
                    <textarea class="form-control" name="des" rows="2" cols="10" required></textarea>
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class=" form-control-label">Quantity</label><br>
                    <select class="form-control" name="unit" id="unit" required>
                      <option value="kg">Kgs</option>
                      <option value="dozen">Dozen</option>
                      <option value="piece">Piece</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <input class="form-control" id="qty" type="number" min="1" name="qty" placeholder="units" required />
                  </div>
                </div>

                <div class="w-100"></div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class=" form-control-label" for="cost price">Cost price</label>
                    <input class="form-control" id="cp" type="number" min="1" name="cp" required />
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label class=" form-control-label" for="sp">Selling Price</label>
                    <input class="form-control" id="sp" type="number" min="1" name="sp" required />
                  </div>
                </div>

                <div class="w-100"></div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class=" form-control-label">Expiry Date</label><br>
                    <input class="form-control" type="date" name="exp" required />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="img" class="form-control-label">Upload Image </label>
                    <input class="form-control" type="file" id="image" style="font-size: 17px;" name="image" accept=".jpg, .jpeg, .png" required />
                  </div>
                </div>
              </div>

              <p><input type="submit" name="submit" value="Submit" class="btn btn-primary py-3 px-4"></p>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>
  <script type="text/javascript">
    $(document).ready(function() {

      function loadData(type ="", category_id) {
        $.ajax({
          url: "load_product.php",
          type: "POST",
          data: {
            type: type,
            id: category_id
          },
          success: function(data) {
            if (type == "stateData") {
              $("#product").html(data);
            } else {
              $("#Category").append(data);
            }

          }
        });
      }

      loadData();

      $("#Category").on("change", function() {
        var Category = $("#Category").val();

        if (Category != "") {
          loadData("stateData", Category);
        } else {
          $("#product").html("");
        }

      })
    });
  </script>
</body>

</html>