<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width" />
    <!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- bootstrap css and js -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        body, html {
            height: 100%;
        }
        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $orderid=$_GET['buttonValue'];
    $_SESSION['download_orderid']=$orderid;
    // echo $orderid;die;
    
    ?>
    <div class="container">
        <div class="text-center">
            <a href="pdfmaker.php?ACTION=VIEW" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> View PDF</a> &nbsp;&nbsp;
            <a href="pdfmaker.php?ACTION=DOWNLOAD" class="btn btn-danger"><i class="fa fa-download"></i> Download PDF</a>
        </div>
    </div>
</body>

</html>
