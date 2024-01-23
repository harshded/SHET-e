
<?php
if($_SESSION['user_type'] != 'farmer'){
  header("Location: ../index.php");

}
  // Fetch records from cart_items and cart tables based on the relationship
  if (isset($_SESSION['id'])) {
      $userId = $_SESSION['id'];
      // Fetch cartID based on user ID
      $sql = "SELECT full_name,profile_pic,user_name,email,full_name,password,ph_number,created_at,user_type,user_status,profile_pic FROM users WHERE id = $userId";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
  }
  ?>

<div class="sidebar">
      <div class="logo-details">
        <!-- <i class="bx bxl-c-plus-plus icon"></i> -->
        <a href="<?php echo $base_url;?>/index.php" class="logo_name">
        <div  class="logo_name">शेत-e</div></a>
                <i class="bx bx-menu" id="btn"></i>
      </div>
      <ul class="nav-list">
      <li class="profile">
          <div class="profile-details">
            <img src="<?= 'data:image/jpeg;base64,' . base64_encode($row["profile_pic"]) ?>" onError="this.onerror=null;this.src='../images/user.png';" alt="profileImg" />
            <div class="name_job">
              <div class="name"><?php echo $row['full_name']; ?></div>
              <div class="job"><?php echo $_SESSION['user_name'];?></div>
            </div>
          </div>
         
        </li>
        <li>
          <i class="bx bx-search"></i>
          <input type="text" placeholder="Search..." />
          <span class="tooltip">Search</span>
        </li>
        <!-- <li>
          <a href="#">
            <i class="bx bx-menu"></i>
            <span class="links_name">Home</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li> -->
          <li>
          <a href="<?php echo $base_url; ?>/Dash_functions/chart.php">
            <i class="bx bx-grid-alt" ></i>
            <span class="links_name">Dashboard</span>
          </a>
          <span class="tooltip">Dashboard</span>
        </li>
        <li>
        <a href="<?php echo $base_url; ?>/Dash_functions/view_profile.php">
            <i class="bx bx-user"></i>
            <span class="links_name">My Profile</span>
          </a>
          <span class="tooltip">My Profile</span>
        </li>
        <!-- <li>
          <a href="#">
            <i class="bx bx-heart"></i>
            <span class="links_name">Login</span>
          </a>
          <span class="tooltip">Login</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-chat"></i>
            <span class="links_name">Register</span>
          </a>
          <span class="tooltip">Register</span>
        </li> -->
       
        <li>
          <a href="<?php echo $base_url; ?>/Dash_functions/view_farmers.php">
            <i class="bx bx-folder"></i>
            <span class="links_name"> Manage Farmers</span>
          </a>
          <span class="tooltip">Manage Farmers</span>
        </li>
        <li>
          <a href="<?php echo $base_url; ?>/Dash_functions/view_users.php">
            <i class="bx bx-folder"></i>
            <span class="links_name"> Manage Customers</span>
          </a>
          <span class="tooltip">Manage Customers</span>
        </li>
        <li>
          <a href="<?php echo $base_url; ?>/Dash_functions/admin_view_orders.php">
            <i class="bx bx-cart-alt"></i>
            <span class="links_name"> Manage Orders</span>
          </a>
          <span class="tooltip">Manage Orders</span>
        </li>
      
        <li>
          <a href="<?php echo $base_url; ?>/inv-pdf/admin_pdf.php">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">Analytics</span>
          </a>
          <span class="tooltip">Analytics</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="links_name">Setting</span>
          </a>
          <span class="tooltip">Setting</span>
        </li>
        <li>
        <a href="<?php echo $base_url; ?>/logout.php">
          <i class="bx bx-log-out" id="log_out"></i>
            <span class="links_name">Logout</span>
          </a>
          <span class="tooltip">Logout</span>
        </li>

      </ul>
    </div>

    
<link rel="stylesheet" href="<?php echo $base_url; ?>/css/dashboard.css" />

<!-- Boxicons CDN Link -->
<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
<script src="<?php echo $base_url; ?>/js/dashboard_script.js"></script>