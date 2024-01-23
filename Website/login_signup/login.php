<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['id'] != '') {
   header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== ICONS ===============-->
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
      

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="design.css">
	<title>LOGIN</title>
</head>
<body>
<div class="login">
         <img src="side.jpg" alt="login image" class="login__img">
     <form action="login_action.php" class="login__form" method="post">
	 <form action="" class="login__form">
            <h1 class="login__title">Login</h1>


			<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

            <div class="login__content">
               <div class="login__box">
               <i class="fas fa-user"></i>

                  <div class="login__box-input">
     	<input type="text" name="uname" required  class="login__input" placeholder=" ">
		 <label for="" class="login__label">Username</label>
                  </div>
               </div>
     	
			   <div class="login__box">
            <i class="fas fa-lock"></i>

                  <div class="login__box-input">
                     <input type="password" name="password" required class="login__input" id="login-pass" placeholder=" ">
                     <label for="" class="login__label">Password</label>
                     <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                  </div>
               </div>
            </div>
			<div class="login__check">
               <div class="login__check-group">
                  <input type="checkbox" class="login__check-input">
                  <label for="" class="login__check-label">Remember me</label>
               </div>

               <a href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <!-- <div class="btn-group btn-group-toggle">
            <label for="usertype">User Type :</label>
            &nbsp;&nbsp;<input type="radio" name="usertype" value="user"
            class="custom-radio">&nbsp;User&nbsp;&nbsp;
            &nbsp;&nbsp;<input type="radio" name="usertype" value="farmer"
            class="custom-radio">&nbsp;Farmer&nbsp;&nbsp;
          </div> -->
          <br>

            <button type="submit" class="login__button">Login</button>
          
            <p class="social-text">Or Sign in with social platform</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    
                </div>
            <p class="login__register">
               Don't have an account? <a href="signup.php">Register</a>
            </p>
         </form>
      </div>
      
      <!--=============== MAIN JS ===============-->
      <script src="main.js"></script>
   </body>
</html>
     