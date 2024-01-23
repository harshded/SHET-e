<!DOCTYPE html>
<html>
<head>
    <title>View Farmers List</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" type="text/css" href="view_css.css">
</head>
<body>
    <h1>Farmers List</h1>
    <table>
        <tr>
            <th>Farmer ID</th>
            <th>User ID</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Farmer Certificate ID</th>
            <th>Aadhar Number</th>
            <th>Return</th>
           
 
      
       
            
        </tr>
        <?php
        $connection = mysqli_connect("localhost", "root", "", "shete");
        $query = "SELECT * FROM farmer";
        $result = mysqli_query($connection, $query);
        // Loop through the result to display farmers' information
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
 
            echo "<td>" . $row['ph_number'] . "</td>";
         
          

            
            echo "<td>" . $row['farmer_cer_id'] . "</td>";
            echo "<td>" . $row['aadhar_number'] . "</td>";
            echo "<td>" . $row['return'] . "</td>";



            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
