<?php
include(dirname(__DIR__) . '/functions/db.php');
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <span><img src="<?php echo $base_url;?>/shete1.png" alt="image" height="58px"></span>
        <a class="navbar-brand" href="<?php echo $base_url;?>/index.php">शेत-e</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="<?php echo $base_url;?>/index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="<?php echo $base_url;?>/shop.php" class="nav-link">Shop</a></li>

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">

                        <a class="dropdown-item" href="shop.php">Shop</a>
                        

                        <a class="dropdown-item" href="cart.php">Cart</a>
                        <a class="dropdown-item" href="checkout.php">Checkout</a>
                    </div>
                </li> -->
                <!-- a class="dropdown-item" href="wishlist.html">Wishlist</a> -->
                <li class="nav-item"><a href="<?php echo $base_url;?>/aboutus.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="<?php echo $base_url;?>/articles.php" class="nav-link">Articles</a></li>
                <li class="nav-item"><a href="<?php echo $base_url;?>/contact.php" class="nav-link">Contact</a></li>

                <?php
                            if($_SESSION['user_type'] == 'user')
                            {
                                ?>
                <li class="nav-item cta cta-colored"><a href="<?php echo $base_url;?>/cart.php" class="nav-link">
                        <span class="icon-shopping_cart"></span>[<?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?>]</a>
                </li>
                <?php
                            }
                            ?>
                <?php
                
                if (isset($_SESSION['id'])) {
                ?>
                    <ul class="hrd-prof">
                        <?php 
                        // Fetch records from cart_items and cart tables based on the relationship
                        if (isset($_SESSION['id'])) {
                           $userId = $_SESSION['id'];
                            // Fetch cartID based on user ID
                            // echo $sql22 = "SELECT full_name,profile_pic FROM users WHERE id =". $_SESSION['id'];
                            // $result = $conn->query($sql22);
                            // var_dump($result);die;
                            // $row = $result->fetch_assoc();
                            $sql = "SELECT user_type,full_name, profile_pic FROM users WHERE id = ?";

                            // Prepare the statement
                            $stmt = $conn->prepare($sql);

                            // Bind the 'id' session variable as an integer parameter
                            $stmt->bind_param("i", $_SESSION['id']);

                            // Execute the statement
                            $stmt->execute();

                            // Bind the result variables
                            $stmt->bind_result($user_type,$full_name, $profile_pic);
                            // Fetch the result
                            $stmt->fetch();

                            $_SESSION['user_type']=$user_type;
                            
                            $stmt->close();
                            $_SESSION["path"]="";

                            if(isset($_SESSION['user_type']))
                            {
                                if($_SESSION['user_type']=='admin')
                                {
                                    $_SESSION["path"]=$base_url."/admin_dashboard.php";
                                }
                                elseif($_SESSION['user_type']=='farmer')
                                {
                                    $_SESSION["path"]="$base_url./farmer_dashboard.php";
                                }
                                elseif($_SESSION['user_type']=='user')
                                {
                                    $_SESSION["path"]="$base_url./customer_dashboard.php";
                                }
                                else
                                {
                                    echo "error";
                                }
                                
                            }
                            
                        }
                        ?>
                        <p>Hello <?php echo $_SESSION['user_name']; ?> &nbsp; <a href="#" class="display-picture"><img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($profile_pic); ?>" onError="this.onerror=null;this.src='<?php echo $base_url;?>/images/user.png';" alt="User"></a>
                    </ul>

                    <div class="card hidden hrd-prof-menu">
                        <ul>
                            <li><a href="<?php echo $base_url;?>/Dash_functions/view_profile.php">Profile</li></a>
                            <?php
                            if($_SESSION['user_type'] === 'farmer')
                            {
                                ?>
                                <li><a href="<?php echo $base_url;?>/Dash_functions/view_products.php">MyProducts</li></a>
                            <?php
                            }
                            else if ($_SESSION['user_type'] === 'admin') {
                                ?>
                                <li><a href="<?php echo $base_url;?>/Dash_functions/view_farmers.php">ManageUsers</li></a>
                            <?php
                            } else {
                                ?>
                                <li><a href="<?php echo $base_url;?>/Dash_functions/view_orders.php">MyOrders</li></a>
                            <?php
                            }
                            
                            ?>
                            
                            <!-- <li><a href="<?php echo $base_url;?>">Account</li></a> -->
                            <li><a href="<?php echo $_SESSION["path"];?>">Settings</li></a>
                            <li><a href="<?php echo $base_url;?>/logout.php">Logout</li></a>
                        </ul>
                    </div>
                <?php
                } else {
                ?>
                    <li class="nav-item"><a href="<?php echo $base_url;?>/login_signup/login.php" class="nav-link"><b>Login</b></a></li>
                    <li class="nav-item"><a href="<?php echo $base_url;?>/login_signup/signup.php" class="nav-link"><b>Signup</b></a></li>
                <?php
                }
                ?>

                <!-- <li class="nav-item"><a href="login_signup/login.php" class="btn btn-primary" >Login</a></li>
                <li class="nav-item"><a href="login_signup/signup.php" class="btn btn-primary" >Signup</a></li> -->

            </ul>

        </div>
        

    </div>
</nav>

<script src="<?php echo $base_url;?>/js/profile_pic_dd.js"></script>