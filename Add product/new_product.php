<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>product</title>
      <meta http-equiv="content-type" content="text/html;charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
      
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <meta name="viewport" content="width=device-width,
      initial-scale=1.0"/>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <h1 class="form-title">Add Product</h1>
      <form action="connect.php"  method="post" enctype="multipart/form-data">

		  <div class="main-user-info">
		  <div class="row">
									  <div class="col-lg-6">
                      <label for="category" class=" form-control-label">Select Category</label>
                      <select name="Category" class="form-control" id="Category" style="width: 250px; height: 40px; font-size: 17px;" required>
                      <option value="">Category</option>
                      </select>
									  </div>
									   <div class="col-lg-6">
                      <label for="fname" class=" form-control-label"> Product Name</label>
                      <select name="product" class="form-control" id="product" style="width: 250px; height: 40px; font-size: 17px;"required>
                        <option value="">Select Product</option>
                      </select>
									  </div>
									</div>

		  <div class="row">
		<div class="col-lg-12">
            <label for="des" class=" form-control-label">Short Description </label>
          <!-- <input id="des" type="text" maxlength="100" name="des" style="width: 300px; height: 100px;"required/> -->
          <textarea class="form-control" name="des" rows="2" cols="10"style="width: 600px;" required></textarea>
          </div></div>
		  
		  
          <div class="row">
		 <div class="col-lg-7">
            <label class=" form-control-label">Quantity</label><br>
            <select class="form-control" name="unit" id="unit" required >
              <option value="kg">Kgs</option>
              <option value="dozen">Dozen</option>
              <option value="piece">Piece</option>
            </select>
            <input class="form-control"  id="qty" type="number" min="1" name="qty" required />
          </div>
		  <div class="col-lg-5">
		  <label class=" form-control-label">Expiry Date</label><br>
          <input class="form-control" type="date"   name="exp" required/>
        </div></div>
		
		
          <div class="row">
		 <div class="col-lg-6">
            <label class=" form-control-label" for="cost price">Cost price</label>
          <input class="form-control" style="width: 270px; height: 40px; font-size: 17px;" id="cp" type="number" min="1" name="cp" required />
          </div>
		  <div class="col-lg-6">
		  <label class=" form-control-label" for="sp">Selling Price</label>
          <input class="form-control" id="sp"style="width: 280px; height: 40px; font-size: 17px;" type="number" min="1" name="sp" required />
        </div></div>
		
		<div class="row">
		 <div class="col-lg-12">
		  <label for="img" class=" form-control-label">Upload Image </label>
          <input class="form-control" type="file" id="image" style="width: 580px; height: 40px; font-size: 17px;" name="image" accept=".jpg, .jpeg, .png" required/>
        </div></div></div>
		
        
        <div class="form-submit-btn">
          <input type="submit" name="Submit" value="Submit">
        </div>
      </form>
    </div>
	</div>
	</div>
  <script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  	function loadData(type, category_id){
  		$.ajax({
  			url : "load_product.php",
  			type : "POST",
  			data: {type : type, id : category_id},
  			success : function(data){
  				if(type == "stateData"){
  					$("#product").html(data);
  				}else{
  					$("#Category").append(data);
  				}
  				
  			}
  		});
  	}

  	loadData();

  	$("#Category").on("change",function(){
  		var Category = $("#Category").val();

  		if(Category != ""){
  			loadData("stateData", Category);
  		}else{
  			$("#product").html("");
  		}
      
  	})
  });
</script>
  </body>
</html>