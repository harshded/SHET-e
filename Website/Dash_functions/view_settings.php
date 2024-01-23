<!DOCTYPE html>
<?php
include  dirname(__FILE__) . '/../includes/head.php';
?>

<body class="goto-here">

  <?php
  include dirname(__FILE__) . '/../includes/header.php';
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
      <!-- <div class="card1-body"> -->
      <div class="card1-body">

        <!-- <div class="d-flex flex-column align-items-center text-center"> -->
        <!-- 

  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row"> -->
        <!-- <div class="col-12 col-sm-auto mb-3"> -->

        <div class="mx-auto" style="width: 150px;">
          <!-- <h3>Edit Profile</h3> -->
          <!-- <h1 class="mb-4 billing-heading">Edit Profile</h1> -->

          <!-- <div class="card1"> -->

          <!-- <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);"> -->
          <img src="<?= 'data:image/jpeg;base64,' . base64_encode(@$row["profile_pic"]) ?>" onError="this.onerror=null;this.src='../images/user.png';" class="rounded-square" width="140" alt="Admin">

          <div class="col d-flex flex-column flex-sm-row align-items-center justify-content-between mb-3 ">
            <div class="text-center text-sm-left mb-2 mb-sm-0">
              <br>

              <h4><?php echo $row['user_name']; ?></h4>
            </div>
          </div>
          <div class="mt-2">
            <!-- <a href="./editor.html">  -->
            <button class="btn btn-primary" type="button">
              <div class="file btn btn-lg btn-primary">
                Upload
                <input type="file" id="image" name="new_image" accept=".jpg, .jpeg, .png" class="form-control" style="
                            
  position: absolute;
  font-size: 50px;
  opacity: 0;
  right: 0;
  top: 0;
" />
              </div>
              <!-- <input type="file" id="image" name="new_image" accept=".jpg, .jpeg, .png" class="form-control" style="font-size: 17px;"> -->

              <i class="fa fa-fw fa-camera"></i>
              <!-- <span>Change Photo</span>  -->
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="card1">
      <div class="card1-body">

        <div class="card1-body">
        <p><a href="<?php echo $base_url; ?>/Dash_functions/add_address.php"><input type="submit" value="Add New Address" class="btn btn-primary py-3 px-4"> </a></p>

          <h1 class="mb-4 billing-heading">Edit Profile</h1>
          <!-- <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">administrator</span>
                    <div class="text-muted"><small>Joined 09 Dec 2017</small></div>
                  </div> -->

          <!-- <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul> -->

          <div class="tab-content pt-3">
            <div class="tab-pane active">
              <form class="form" novalidate="">
                <div class="row">
                  <div class="col">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Full Name</label>
                          <input type="text" id="name" name="name" class="form-control" required value="<?php echo htmlspecialchars($row['full_name']); ?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Phone Number</label>
                          <input type="tel" id="phone" name="phone" class="form-control" required value="<?php echo htmlspecialchars($row['ph_number']); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" id="email" name="email" class="form-control" required value="<?php echo htmlspecialchars($row['email']); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col mb-3">
                        <div class="form-group">

                          <label>Address:</label>
                          <!-- <div class="row"> -->
                          <!-- <div class="col d-flex justify-content-center"> -->
                        </div>
                      </div>
                      <!-- <textarea class="form-control" rows="5" placeholder="My Bio"></textarea> -->
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col d-flex justify-content-center">
            <button class="btn btn-primary" type="submit">Save Changes</button>
          </div>
        </div>
        
      </div>
    </div>
    </form>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <!-- <div class="col-12 col-md-3 mb-3">
        <div class="card mb-3">
          <div class="card-body">
            <div class="px-xl-3">
              <button class="btn btn-block btn-secondary">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
              </button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h6 class="card-title font-weight-bold">Support</h6>
            <p class="card-text">Get fast, free help from our friendly assistants.</p>
            <button type="button" class="btn btn-primary">Contact Us</button>
          </div>
        </div>
      </div> -->
    </div>

    </div>
    </div>
  </section>