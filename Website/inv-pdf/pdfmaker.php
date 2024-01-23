<?php 
session_start();
require ("fpdf/fpdf.php");
// require ("num_word.php");

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shete";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user details based on user_id
$order_id = $_SESSION['download_orderid'];
// echo $order_id;die;
$user_id = $_SESSION['id'];
// echo htmlspecialchars($order_id);die;
$sql = "SELECT * FROM orders WHERE id=$order_id and user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Generate PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Add green border
    $pdf->SetDrawColor(0, 128, 0); // Green border color
    $pdf->SetLineWidth(1); // Border width
    

    // Add Logo
    $pdf->Image('shetelogo.jpg', 10, 10, 30);

    // Add Sales Invoice Section with green color
    $pdf->SetFont('Arial','B',30); // Change font size to 20 for big heading
    $pdf->SetTextColor(0, 128, 0); // Green color
    $pdf->SetXY(10, 40);
    $pdf->Cell(0, 10, 'Sales Invoice', 0, 1, 'L');




    // Add "Ship To" Address
 
    $pdf->SetFillColor(0, 128, 0); // Green background color
    $pdf->SetTextColor(255, 255, 255); // White text color
    $pdf->SetFont('Arial','B',20);
    $pdf->SetXY(10, 60);
    $pdf->Cell(0, 10, '  '.'Ship To :', 0, 1, 'L',true);
    $pdf->SetFont('Arial','',12);
    $pdf->SetXY(10, 70);
    $pdf->Cell(0, 8, '  '.$row['fullname'], 0, 1, 'L',true);
    $pdf->SetXY(10, 77);
    $pdf->Cell(0, 8, '  '.$row['email'], 0, 1, 'L',true);
    $pdf->SetXY(10, 84);
    $pdf->Cell(0, 8, '  '.$row['shipping_town'] . ', ' . $row['shipping_line_1'] . ', ' . $row['shipping_line_2'].', '.$row['shipping_pincode'], 0, 1, 'L',true);
    $pdf->SetXY(10, 91);
    $pdf->Cell(0, 8, '  '.$row['shipping_mobile_no'], 0, 1, 'L',true);
  

    // Add Invoice Section
    $pdf->SetFillColor(0, 128, 0); // Green background color
    $pdf->SetTextColor(255, 255, 255); // White text color
    $pdf->SetFont('Arial','B',20);

    $pdf->SetXY(20, 60);
    $pdf->Cell(0, 10, 'Invoice'.'  ', 0, 1, 'R');
    $pdf->SetFont('Arial','',12);
    $pdf->SetXY(20, 70);
    $pdf->Cell(0, 10, ' Invoice #: CB-123'.'  ' , 0, 1, 'R');
    $pdf->SetXY(20, 77);
    $pdf->Cell(0, 10, ' P.O #: CB-485'.'  ' , 0, 1, 'R');
    $pdf->SetXY(20, 84);
    $pdf->Cell(0, 10, ' Date: ' . $row['order_date'].'  ', 0, 1, 'R');

     // Add table header
     $pdf->SetFillColor(0, 128, 0);
     $pdf->SetTextColor(255, 255, 255);
     $pdf->SetFont('Arial','B',12);
     $pdf->SetXY(10, 113);
     $pdf->Cell(50, 10, 'Item', 1, 0, 'C', true);
     $pdf->Cell(43, 10, 'Quantity', 1, 0, 'C', true);
     $pdf->Cell(50, 10, 'Unit Price', 1, 0, 'C', true);
     $pdf->Cell(43, 10, 'Total', 1, 1, 'C', true);
 
// Fetch order items from the database
 // Change this to the appropriate order ID
echo $sql_items = "SELECT order_items.quantity, product.name, product.sp_price 
              FROM order_items 
              INNER JOIN product ON order_items.product_id = product.id 
              WHERE order_items.order_id = $order_id";
$result_items = $conn->query($sql_items);

if ($result_items->num_rows > 0) {
    while ($item = $result_items->fetch_assoc()) {
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(50, 10, $item['name'], 1, 0, 'C'); // Display product name
        $pdf->Cell(43, 10, $item['quantity'], 1, 0, 'C'); // Display quantity
        $pdf->Cell(50, 10, $item['sp_price'], 1, 0, 'C'); // Display special price
        $pdf->Cell(43, 10, $item['sp_price'] * $item['quantity'], 1, 1, 'C'); // Display total

        $grand_total += $item['sp_price'] * $item['quantity']; // Add to grand total
    }
} else {
    echo "No results found for order ID $order_id.";
}

$pdf->SetFont('Arial', 'B', 12);
// Add Grand Total
$pdf->Cell(143, 10, 'Grand Total              ', 1, 0, 'R');
$pdf->Cell(43, 10, $grand_total, 1, 1, 'C');
$pdf->Ln();
// Add Grand Total in words
    // Add Grand Total in words
$pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(143, 10, 'Amount in Words: ' . numberToWords($grand_total).' Rupees Only', 0, 0, 'L');
$pdf->Ln(); // Move to the next line

    $pdf->SetFillColor(0, 128, 0); // Green background color

$pdf->SetFont('Arial','B',20);

$pdf->SetXY(10, 240); // Adjust the Y position as needed
$pdf->Cell(0, 10, 'Payment Details', 0, 1, 'L'); // Heading

$pdf->SetFont('Arial','',12);
$pdf->SetXY(10, 250); // Adjust the Y position as needed
$pdf->Cell(0, 10, 'Payment Mode: ' . $row['payment_mode'], 0, 1, 'L'); // Payment Mode

$pdf->SetXY(10, 260); // Adjust the Y position as needed
$pdf->Cell(0, 10, 'Transaction ID: ' . $row['payment_id'], 0, 1, 'L'); // Payment ID
    // Add "From" Address
    $pdf->SetXY(140, 10);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetTextColor(0, 0, 0); // Black color
    $pdf->Cell(0, 10, ' Company Name: Shet- e', 0, 1, 'R');
    $pdf->SetXY(140, 15);
    $pdf->Cell(0, 10, ' 845, Shivajinagar, Pune, Maharashtra 411004', 0, 1, 'R');
    $pdf->SetXY(140, 20);
    $pdf->Cell(0, 10, ' shete@gmail.com  | +91-7854123697', 0, 1, 'R');
    $pdf->SetXY(140, 25);
    $pdf->Cell(0, 10, ' http://localhost/shete/', 0, 1, 'R');

    // Add footer message
    $pdf->SetY(266); // Adjust the Y position as needed to place the footer at the bottom
    $pdf->SetTextColor(0, 128, 0); // Green color
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Invoice PDF is generated dynamically', 0, 0, 'C');


    $datetime=date('dmY');
    $file_name = "shete_inv_".$datetime.".pdf";
    ob_end_clean();

    // Output the PDF
    //$pdf->Output('D', 'shete_invoice.pdf');
    //$pdf->Output();
    
if($_GET['ACTION']=='VIEW') 
{
	$pdf->Output($file_name, 'I'); // I means Inline view
} 
else if($_GET['ACTION']=='DOWNLOAD')
{
	$pdf->Output($file_name, 'D'); // D means download
    unset($_SESSION['download_orderid']);
    header("location: ../index.php");
}

} else {
    echo "No results found for user ID $user_id.";
}

$conn->close();
?>
