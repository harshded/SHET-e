    <?php
    include  dirname(__FILE__) . '/../includes/head.php';
    if ($_SESSION['user_type'] == 'user') {
    ?>
        <body>
            <?php include dirname(__FILE__) . '/../includes/header.php'; ?>
            <div class="container">
                <?php include('./../user-sidebar.php'); ?>

                <section class="home-section">

                    <?php
                    // Get the user ID from the URL
                    $user_id = $_SESSION["id"];
                    // echo $user_id;

                    $add_id = $_GET['address_id'];

                    // Fetch addresses related to the user ID
                    $address_sql = "SELECT * FROM address_book WHERE user_id=$user_id  and id=$add_id";
                    // echo $address_sql;die;
                    $add_result = $conn->query($address_sql);
                    $row = $add_result->fetch_assoc();
                    ?>
                    <div class="cart-detail cart-total p-3 p-md-4">
                        <form method="POST" action="update_address.php" class="billing-form">
                            <h3 class="mb-4 billing-heading">Edit Address</h3>
                            <div class="row align-items-end">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="edit_id" value="<?php echo $row["id"]; ?>">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_city">City</label>
                                        <input type="text" class="form-control" id="edit_city" class="form-control" name="edit_city" value="Pune" readonly />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_town">Town</label>
                                        <select name="edit_town" id="edit_town" class="form-control">
                                            <option value="">Select Town</option>
                                            <?php
                                            $sql = "SELECT id, town_name,charges FROM shipping_address LIMIT 15";
                                            $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                            while ($rows = mysqli_fetch_assoc($resultset)) {
                                            ?>
                                                <option value="<?php echo $row["town"] ?>" <?php if ($rows["id"] == $_SESSION['selected_town']) {
                                                                                                echo 'selected="selected"';
                                                                                            } ?>><?php echo $rows["town_name"]; ?></option>
                                            <?php }    ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_pincode">Pincode:</label>
                                        <input type="text" class="form-control" id="edit_pincode" name="edit_pincode" value="<?php echo $row["pincode"]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_line_1">Address Line 1:</label>
                                        <input type="text" class="form-control" id="edit_line_1" name="edit_line_1" value="<?php echo $row["line_1"]; ?>">
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_line_2">Address Line 2:</label>
                                        <input type="text" class="form-control" id="edit_line_2" name="edit_line_2" value="<?php echo $row["line_2"]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_address_type">Address Type:</label>
                                        <input type="text" class="form-control" id="edit_address_type" name="edit_address_type" value="<?php echo $row["address_type"]; ?>">
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_mobile_no">Mobile Number:</label>
                                        <input type="text" class="form-control" id="edit_mobile_no" name="edit_mobile_no" value="<?php echo $row["mobile_no"]; ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_email_id">Email ID:</label>
                                        <input type="text" class="form-control" id="edit_email_id" name="edit_email_id" value="<?php echo $row["email_id"]; ?>">
                                    </div>
                                </div>

                                <p><input type="submit" value="Save Changes" class="btn btn-primary py-3 px-4"></p>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </body>
    <?php } else {
        header("Location: ../index.php");
    } ?>