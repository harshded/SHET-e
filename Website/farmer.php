<!DOCTYPE html>
<html lang="en">

<head>

  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>शेत-e</title>
  <!-- Linking Google font link for icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <link rel="stylesheet" href="farm_style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    table {
      border-collapse: collapse;
      width: 70%;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
      border: 1px solid #ddd;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .bar {
      display: block;
    }

    .Farmers_details {
      display: flex;
      align-content: center;
      align-items: center;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">शेत-e</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">

              <a class="dropdown-item" href="shop.php">Shop</a>
              <!-- a class="dropdown-item" href="wishlist.html">Wishlist</a> -->

              <a class="dropdown-item" href="cart.php">Cart</a>
              <a class="dropdown-item" href="checkout.php">Checkout</a>
            </div>
          </li>
          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
          <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link">
              <span class="icon-shopping_cart"></span>[0]</a>
          </li>
          <li class="nav-item"><a href="login_signup/login.php" class="nav-link">Login</a></li>
          <li class="nav-item"><a href="login_signup/signup.php" class="nav-link">Signup</a></li>
          <li>
            <div class="user-icon">
              <!-- Replace 'image_url' with the actual URL fetched from the database -->
              <img src="images/logo.jpg" alt="User Avatar">
              <a href="#">My Profile</a>
            </div>
          </li>
          <li>
            <div class="user-icon">
              <!-- Replace 'image_url' with the actual URL fetched from the database -->
              <img src="images/logo.jpg" alt="User Avatar">
              <a href="#">My Profile</a>
          </li>
          <!-- <li class="nav-item"><a href="login_signup/login.php" class="btn btn-primary" >Login</a></li>
                <li class="nav-item"><a href="login_signup/signup.php" class="btn btn-primary" >Signup</a></li> -->

        </ul>
      </div>
    </div>
  </nav>
  <!-- <header>
    <div class="bar">
      <div class="user-icon">
        Replace 'image_url' with the actual URL fetched from the database
        <img src="images/logo.jpg" alt="User Avatar">
        <a href="#">My Profile</a>
      </div>

      Dropdown options
      <div class="dropdown">
    <ul>
      <li onclick="redirectToHomePage()">Home</li>
      <li onclick="logout()">Logout</li>
    </ul>
  </div>
    </div>

  </header> -->



  <aside class="sidebar">
    <div class="logo">
      <!-- <img src="images/logo.jpg" alt="logo"> -->
      <h1>शेत-e</h1>
    </div>
    <ul class="links">


      <h3>Home</h3>
      <div class="logo">
        <img src="images/logo.jpg" alt=" User Avatar">
        <h2> Hello User,</h2>
      </div>



      <li>
        <span class="material-symbols-outlined">person</span>
        <a href="#">My Profile</a>
      </li>
      <hr>



      <h4>MANAGE</h4>
      <li>
        <span class="material-symbols-outlined">pacemaker</span>
        <a href="#">Products</a>
      </li>
      <li>
        <span class="material-symbols-outlined">bar_chart</span>
        <a href="#">Orders</a>
      </li>
      <li>
        <span class="material-symbols-outlined">flag</span>
        <a href="#">Returns & Exchange</a>
      </li>
      <li>
        <span class="material-symbols-outlined">mail</span>
        <a href="#">Feedbacks</a>
      </li>
      <hr>
      <h4>REPORTS</h4>
      <li>
        <span class="material-symbols-outlined">monitoring</span>
        <a href="#"> Sales Analytic</a>
      </li>
      <li>
        <span class="material-symbols-outlined">show_chart</span>
        <a href="#">Revenue Analytics</a>
      </li>
      <hr>
      <h4>SETTINGS</h4>
      <li>
        <span class="material-symbols-outlined">group</span>
        <a href="#">Edit Profile info </a>
      </li>
      <li>
        <span class="material-symbols-outlined">settings</span>
        <a href="#">Change Password</a>
      </li>
      <li>
        <span class="material-symbols-outlined">flag</span>
        <a href="#">Deactivate Account</a>
      </li>
      <hr>
      <li>
        <span class="material-symbols-outlined">logout</span>
        <a href="#">Logout</a>
      </li>
    </ul>
  </aside>

  <div class="Farmers_details">
    <h1 style="align-self: center;">Farmer Details</h1>
    <table>
      <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Address</th>
        <th>Farmer Certificate ID</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Aadhar Card</th>
        <th>Activate</th>
        <th>Deactivate</th>

      </tr>

      <?php
      // Database connection details
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "shete";


      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Fetch farmer details from the database
      $sql = "SELECT * FROM farmer";
      $result = $conn->query($sql);

      // Display farmer details in the table
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['user_id'] . "</td>";
          echo "<td>" . $row['address'] . "</td>";
          echo "<td>" . $row['farmer_cer_id'] . "</td>";
          echo "<td>" . $row['phone'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['aadhar_number'] . "</td>";
          echo "<td> <button>Activate</button> </td>";
          echo "<td> <button>Deactivate</button> </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
      }

      // Close the connection
      $conn->close();
      ?>

    </table>

  </div>
  </sessiom>








  <script>
    // Function to show/hide the dropdown options
    document.querySelector('.user-icon').addEventListener('click', function() {
      var dropdown = document.querySelector('.dropdown');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    //   // Function to redirect to the home page
    //   function redirectToHomePage() {
    //     window.location.href = 'your_home_page_url'; // Replace with your home page URL
    //   }

    //   // Function to handle logout
    //   function logout() {
    //     // Implement your logout functionality here, e.g., clearing session data, redirecting to the login page, etc.
    //     alert('Logout functionality goes here');
    //   }
  </script>
</body>

</html>