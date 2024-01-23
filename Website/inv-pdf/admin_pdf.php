<?php 
require ("fpdf/fpdf.php");

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shete";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Calculate sales, count_id, and total_revenue
$sql = "SELECT SUM(unit_price) AS sales, COUNT(product_id) AS count_id, SUM(unit_price-(unit_price * 0.97)) AS total_revenue FROM order_items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $sales = $row["sales"];
    $count_id = $row["count_id"];
    $total_revenue = $row["total_revenue"];
} else {
    $sales = 0;
    $count_id = 0;
    $total_revenue = 0;
}
$pdf = new FPDF();

// Add a page
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Logo
$pdf->Image('shetelogo.jpg', 12, 5, 50); // Adjusted position and size

// Calculate page width
$pageWidth = $pdf->GetPageWidth();

// Draw a line below the logo
$pdf->SetLineWidth(0.5);
$pdf->Line(12, 55, $pageWidth - 12, 55); // Stretches to the end

// Title in green
$pdf->SetTextColor(0, 128, 0); // RGB values for dark green
$pdf->SetFont('Times', 'B', 36);

// Decorative element
$pdf->Cell(0, 20, 's h e t - e', 0, 1, 'C'); // Adjusted text

// Add "Sales Report"
$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(0, 35, 'SALES REPORT', 0, 1, 'C'); // Centered text


// Add "From" Address
$pdf->SetXY(12, 60); // Adjusted position below the logo
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(34,139,34); // Black color
$pdf->Cell(0, 10, ' Company Name: Shet- e', 40, 1, 'C');
$pdf->SetXY(12, 70);
$pdf->Cell(0, 10, ' 845, Shivajinagar, Pune, Maharashtra 411004', 40, 1, 'C');
$pdf->SetXY(12, 80);
$pdf->Cell(0, 10, ' shete@gmail.com  | +91-7854123697', 40, 1, 'C');
$pdf->SetXY(12, 90);
$pdf->Cell(0, 10, ' http://localhost/shete/', 40, 1, 'C');

// Reset text color to black
$pdf->SetTextColor(0, 0, 0); // Reset to black

// Add a table
$pdf->SetXY(10, 110); // Adjusted position for the table
$pdf->SetFont('Arial','B',12);

// Table headers
$pdf->Cell(45, 15, 'Total Sales', 1, 0, 'C');
$pdf->Cell(45, 15, 'Total Orders', 1, 0, 'C');
$pdf->Cell(45, 15, 'Total Amount', 1, 0, 'C');
$pdf->Cell(45, 15, 'Revenue', 1, 1, 'C'); // Move to the next line after this cell

// Table data
$pdf->SetFont('Arial','',12);
$pdf->Cell(45, 25,$sales, 1, 0, 'C');
$pdf->Cell(45, 25,$count_id, 1, 0, 'C');
$pdf->Cell(45, 25, $sales, 1, 0, 'C');
$pdf->Cell(45, 25, $total_revenue, 1, 1, 'C'); // Move to the next line after this cell

////////////////////////////////////////////////////////////////////

/// from here this a bar graph code 

// Set up the chart coordinates
$yStart = 160; // Y-coordinate to start drawing
$yEnd = 240;   // Y-coordinate to end drawing
$xStart = 10;  // X-coordinate to start drawing
$xEnd = 190;   // X-coordinate to end drawing
$xValues = [$xStart + 20, $xStart + 60, $xStart + 100, $xStart + 140]; // X-coordinates for data points
$dataValues = [$sales, $count_id, $sales, $total_revenue]; // Data values

// Draw axes and labels
$pdf->Line($xStart, $yStart, $xStart, $yEnd); // Vertical axis
$pdf->Line($xStart, $yEnd, $xEnd, $yEnd);    // Horizontal axis

$pdf->SetXY($xStart - 7, $yEnd + 2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(72, 10, 'Total Sales', 0, 0, 'C');
$pdf->Cell(10, 10, 'Total Orders', 0, 0, 'C');
$pdf->Cell(60, 10, 'Total Amount', 0, 0, 'C');
$pdf->Cell(30, 10, 'Revenue', 0, 0, 'C');

// Draw the bars
$barWidth = 20; // Width of each bar
$barSpacing = 10; // Spacing between bars
$pdf->SetFillColor(0, 128, 0); // Set fill color to green

// Set the maximum value (adjust as needed)
$maxValue = max($dataValues);

for ($i = 0; $i < count($xValues); $i++) {
    // Calculate the height of the bar
    $height = ($dataValues[$i] / $maxValue) * ($yEnd - $yStart);
    
    // Draw a filled rectangle representing the bar
    $pdf->Rect($xValues[$i], $yEnd - $height, $barWidth, $height, 'F');
}
////date 
$currentDate = date('m-d-Y');

$pdf->SetXY(10, 260);
$pdf->SetFont('Arial', '', 15);
$pdf->Cell($xEnd - $xStart, 10, "Date: $currentDate", 0, 0, 'R');
// Output PDF
$pdf->Output();
$conn->close();
?>