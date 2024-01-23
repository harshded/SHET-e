<!DOCTYPE html>

<?php
if($_SESSION['user_type'] != 'user'){
    header("Location: ./index.php");
 
}
include dirname(__FILE__).'/includes/head.php';
?>
	<body class="goto-here">
  <?php
	include dirname(__FILE__) .'/includes/header.php';
	?>

<?php include('./user-sidebar.php');?>


  </body>
</html>
