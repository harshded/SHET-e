<!DOCTYPE html>
<html>

<head>
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .card img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
        }

        h2 {
            margin-top: 0;
        }

        .img-fluid {
            width: 253px;
            height: 203px;
            object-fit: fill;
        }
    </style>
</head>

<body>
    <?php
    require_once('./functions/db.php');

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page number
    $itemsPerPage = 4; // Number of items to display per page

    $offset = ($page - 1) * $itemsPerPage; // Offset for database query

    // Fetch all records from the product table

    $sql = "SELECT id, name,description,price,qty,sp_price,image  FROM product LIMIT $itemsPerPage OFFSET $offset";
    //print_r($sql);

    $result = $conn->query($sql);
    // print_r($);
    if (isset($result) && $result->num_rows >= 0) {
        // $totalItems = $result->num_rows; // Total number of items in the database
        // Get the total count of items from the database
        $queryCount = "SELECT COUNT(*) AS total FROM product";
        $resultCount = mysqli_query($conn, $queryCount);
        $rowCount = mysqli_fetch_assoc($resultCount);

        $totalItems = $rowCount['total'];
        $totalPages = ceil($totalItems / $itemsPerPage); // Calculate total pages
        while ($row = $result->fetch_assoc()) {

    ?><div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="#" class="img-prod">
                        <img class="img-fluid" src="<?= 'data:image/jpeg;base64,' . base64_encode($row["image"]) ?>" alt="Colorlib Template">
                        <span class="status"><?php
                                                //$originalPrice = $row["price"]; // Original price
                                                //$discountedPrice = $row["sp_price"]; // Discounted price

                                                // Calculate the discount percentage
                                                $discountPercentage = (($row["price"] - $row["sp_price"]) / $row["price"]) * 100;

                                                // Print the discount percentage
                                                echo intval($discountPercentage) . "%";
                                                ?></span>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#"><?= $row["name"] ?></a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="mr-2 price-dc">₹<?= $row["price"] ?></span><span class="price-sale">₹<?= $row["sp_price"] ?></span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="product_single.php?id=<?php echo $row["id"] ?>" class="add-to-cart d-flex justify-content-center align-items-center text-center" target="_blank">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <button type="" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<p>No products found.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>

</html>