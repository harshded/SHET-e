<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";


$conn = new mysqli($servername, $username, $password,);



// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all records from the product table
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
    <h1>Product List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Special Price</th>
            <th>Quantity</th>
            <th>Expiration Date</th>
            <th>Image</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["sp_price"] . "</td>";
                echo "<td>" . $row["qty"] . "</td>";
                echo "<td>" . $row["expire_date"] . "</td>";
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["image"]) . "' width='100' height='100' /></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No products found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
