<?php
require_once('./db.php');

$option = $_GET['op'];
     switch ($option) {
         case 'updateQty':
           updateQty($conn);
           break;
       }
function updateQty($conn) {
    $qty = $_GET['qty'];
    $itemId = $_GET['id'];
    var_dump($qty);
    
    $sql_update="UPDATE cart_item SET qty = '$qty',total ='$qty'*sp_price WHERE id = '$itemId'";
    $result = $conn->query($sql_update);

    header("Location: ../cart.php");
  
    
}
