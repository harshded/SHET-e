<!DOCTYPE html>
 <?php
include  dirname(__FILE__) .'/../includes/head.php';
?>
  <body class="goto-here">
		
  <?php
	include dirname(__FILE__) .'/../includes/header.php';
	?> 
  
  <?php


include '../functions/user_type.php';

// Determine the dashboard file based on the user type
if (isset($_SESSION['user_type'])) {
  $userType = $_SESSION['user_type'];
  
  switch ($userType) {
      case "farmer":
        include('./../farmer-sidebar.php'); // Include the customer dashboard
          break;
      case "user":
        include('./../user-sidebar.php'); // Include the admin dashboard
          break;
      case "admin":
        include('./../admin-sidebar.php'); // Include the farmer dashboard
          break;
      default:
          echo "Invalid user type.";
          // Handle the case when the user type is not recognized
          break;
  }
} else {
  echo "User type not set.";
}
?>





<section class="home-section">

    <div class="card1">
      <div class="card1-body">
        <div class="d-flex flex-column align-items-center text-center">

          <img src="<?= 'data:image/jpeg;base64,' . base64_encode(@$row["profile_pic"]) ?>" onError="this.onerror=null;this.src='../images/user.png';" alt="Admin" class="rounded-circle" width="100">
          <div class="mt-5">
          <!-- <div class="name"><?php echo $row['full_name']; ?></div> -->

            <h4><?php echo $row['full_name']; ?></h4>
            <p class="text-secondary mb-1"><?php echo @$row['user_name']; ?></p>
            <!-- <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
            <button class="btn btn-primary">Follow</button>
            <button class="btn btn-outline-primary">Message</button> -->
          </div>  
        </div>
      </div>
    </div>

    </div>
    <div class="card2">
      <div class="card2-body">
        <div class="row  text-center">
          <div class="col-sm-3">
            <h6 class="mb-0">Full Name</h6>
          </div>
          <div class="col-sm-6 text-secondary">
          <?php echo $row['full_name']; ?>
          </div>
        </div>
        <hr>
        <div class="row  text-center">
          <div class="col-sm-3">
            <h6 class="mb-0">Email</h6>
          </div>
          <div class="col-sm-6 text-secondary">
            <div><?php echo $row['email']; ?></div>
          </div>
        </div>
        <hr>
        <div class="row  text-center">
          <div class="col-sm-3">
            <h6 class="mb-0">Phone</h6>
          </div>
          <div class="col-sm-6 text-secondary">
          <?php echo $row['ph_number']; ?>
          </div>
        </div>
        <hr>
        <div class="row  text-center">
          <div class="col-sm-3">
            <h6 class="mb-0">User Type</h6>
          </div>
          <div class="col-sm-6 text-secondary">
          <?php echo $row['user_type']; ?>
          </div>
        </div>
        <hr>
        <div class="row  text-center">
          <div class="col-sm-3">
            <h6 class="mb-0">Address</h6>
          </div>
          <div class="col-sm-6 text-secondary">
          <?php echo @$row['address']; ?>
          <?php echo $_SESSION['id']; ?>
          </div>
        </div>
        <hr>
        <div class="row  text-center">
          <div class="col-sm-3">
            <h6 class="mb-0">Account Created</h6>
          </div>
          <div class="col-sm-6 text-secondary">
          <?php echo @$row['created_at']; ?>
         
          </div>
        </div>
      </div>
    </div>
  </section>

  </body>

</html>