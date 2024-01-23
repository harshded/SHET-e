<!DOCTYPE html>
<html>
<head>
    <title>View Products List</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" type="text/css" href="view_css.css">
   
</head>
<body>
    <h1>Products List</h1>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>SP Price</th>
            <th>Quantity</th>
            <th>Expiry Date</th>
            <th>Weight Type</th>
            <th>Image</th>

        </tr>
        <?php
        $connection = mysqli_connect("localhost", "root", "", "shete");


        // Assuming you have a database connection here
        if ($connection) {
          
            $query = "SELECT * FROM product";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Database query failed: " . mysqli_error($connection));
            }

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                   
                    
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>$" . $row['price'] . "</td>";
                        echo "<td>" . $row['sp_price'] . "</td>";
                        echo "<td>" . $row['qty'] . "</td>";
                        echo "<td>" . $row['expire_date'] . "</td>";
                        echo "<td>" . $row['weight_type'] . "</td>";

                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Product Image'></td>";
                      
                        echo "</tr>";
                    

                }
            } else {
                echo "No products found in the database.";
            }

         
            mysqli_close($connection);
        } else {
            die("Database connection failed.");
        }



      

        

     
     
        ?>
    </table>

</body>
</html>
