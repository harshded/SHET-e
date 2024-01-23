<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphs</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .conn {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        .column {
            width: 45%;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>

<!DOCTYPE html>
<?php

include dirname(__FILE__) . '/../includes/head.php';
?>

<body class="goto-here">

    <?php
    include dirname(__FILE__) . '/../includes/header.php';
    ?>

    <?php include('./../admin-sidebar.php'); ?>
    <div class="conn">
    <style>
        .conn {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .charts-conn {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-bottom: 20px;
        }

        .chart {
            width: 45%;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .info-conn {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .info {
        width: 20%;
        padding: 20px;
        border: 1px solid #ccc;
        text-align: center;
        background-color: #f3f3f3; /* Light gray background color */
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Shadow effect */
    }

    .info:nth-child(2) {
        background-color: #ffe0b2; /* Orange background for the second .info div */
    }

    .info:nth-child(3) {
        background-color: #b2dfdb; /* Light blue background for the third .info div */
    }

    .info:nth-child(4) {
        background-color: #ffcc80; /* Light orange background for the fourth .info div */
    }

    </style>
</head>

<body>
    <div class="conn">
        <div class="charts-conn">
            <div class="chart">
                <h2>Graph</h2>
                <canvas id="lineChart" width="400" height="200"></canvas>
            </div>
            <div class="chart">
                <h2>Pie Chart</h2>
                <canvas id="pieChart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="info-conn">
            <div class="info">
                <h3>Sales (in Lakh)</h3>
                <p>2.5 Lakh</p>
            </div>
            <div class="info">
                <h3>Total Customers</h3>
                <p>150</p>
            </div>
            <div class="info">
                <h3>Total Farmers</h3>
                <p>50</p>
            </div>
            <div class="info">
                <h3>Revenue</h3>
                <p>₹250,000</p>
            </div>
        </div>
    

    <script>
        // Data for the graph
        var lineChartData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
    datasets: [{
        label: 'Monthly Sales (in Lakh)',
        data: [2.5, 3.8, 4.2, 3.9, 4.7], // Sales data in lakh for each month
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
    }]
};

        // Data for the pie chart
        var pieChartData = {
            labels: ['Vegetables', 'Fruits', 'Ads-Revenue'],
            datasets: [{
                data: [55.5,34.5,10],
                backgroundColor: ['#FF5C77', '#FFA23A', '#4DD091']
            }]
        };

        // Get the graph canvas and create the line chart
        var lineChartCanvas = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData
        });

        // Get the pie chart canvas and create the pie chart
        var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieChartData
        });
    </script>
</body>

</html>


