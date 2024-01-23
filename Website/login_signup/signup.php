<!DOCTYPE html>
<html>

<head>

     <title>REGISTER</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link rel="stylesheet" href="reg_design.css">

</head>

<body>

     <div class="login">
          <img src="side.jpg" alt="login image" class="login__img">
          <form action="signup_check.php" class="login__form" method="post">
               <h1 class="login__title">Register</h1>

               <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
               <?php } ?>

               <div class="login__content">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="login__box">
                                   <i class="fas fa-user"></i>
                                   <div class="login__box-input">
                                        <input type="text" name="name" required class="login__input" placeholder=" ">
                                        <label for="" class="login__label">Full Name</label>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="login__box">
                                   <i class="fas fa-user"></i>
                                   <div class="login__box-input">
                                        <input type="text" name="uname" required class="login__input" placeholder=" ">
                                        <label for="" class="login__label">User Name</label>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                              <div class="login__box">
                                   <i class="fas fa-phone"></i>
                                   <div class="login__box-input">
                                        <input type="text" name="phone" required class="login__input" placeholder=" ">
                                        <label for="" class="login__label">Phone No.</label>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="login__box">
                                   <i class="fas fa-envelope"></i>
                                   <div class="login__box-input">
                                        <input type="email" name="email" required class="login__input" placeholder=" ">
                                        <label for="" class="login__label">Email</label>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                              <div class="login__box">
                                   <i class="fas fa-lock"></i>
                                   <div class="login__box-input">
                                        <input type="password" name="password" required class="login__input" id="login-pass" placeholder=" ">
                                        <label for="" class="login__label">Password</label>
                                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="login__box">
                                   <i class="fas fa-lock"></i>
                                   <div class="login__box-input">
                                        <input type="password" name="re_password" required class="login__input" id="login-pass" placeholder=" ">
                                        <label for="" class="login__label">Confirm Password</label>
                                        <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

              <div class="row">
     <div class="col-md-6">
          <div class="btn-group btn-group-toggle">
          <i class="fas fa-users"></i>
          &nbsp;&nbsp;<label for="usertype">User Type:</label>
               <div class="btn-group" role="group">
               &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="usertype" value="user" class="custom-radio" required>&nbsp;User
               </div>
          </div>
     </div>
     <div class="col-md-6">
          <div class="btn-group btn-group-toggle">
               <div class="btn-group" role="group">
                    <input type="radio" name="usertype" value="farmer" class="custom-radio" required>&nbsp;Farmer
               </div>
          </div>
     </div>
</div>


               <button type="submit" class="login__button">Register</button>

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
                    Already have an account? <a href="login.php">Login</a>
               </p>
          </form>
     </div>

     <script src="main.js"></script>
</body>

</html>
