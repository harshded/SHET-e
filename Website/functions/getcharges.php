<?php
session_start();
ob_start();
include_once('./db.php');
if ($_REQUEST['deliveryid']) {
	if (isset($_REQUEST['address_type']) && $_REQUEST['address_type'] === 'new_address') {
		$charge_id = $_REQUEST['deliveryid'];
	} else {
		$sql22 = "SELECT id, town FROM address_book 
		WHERE id='" . $_REQUEST['deliveryid'] . "'";

		$resultset22 = mysqli_query($conn, $sql22) or die("database error:" . mysqli_error($conn));
		$deliveryData = array();
		$deliveryData22 = mysqli_fetch_assoc($resultset22);

		$charge_id = @$deliveryData22['town'];
	}

	$sql = "SELECT id, town_name,charges FROM shipping_address 
WHERE id='" . $charge_id . "'";
	$resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
	$deliveryData = array();
	$deliveryData = mysqli_fetch_assoc($resultset);
	$_SESSION['delivery_charge'] = $deliveryData['charges'];
	$grand_total = $_SESSION['sub_total'] + $deliveryData['charges'];
	$_SESSION['Grand_Total'] = $grand_total;

	$result = [];
	$result['delivery_changes'] = $deliveryData;
	$result['grand_total'] = $grand_total;
	// $_SESSION['grand_Totals'] = $grand_total;
	echo json_encode($result);
	// $_SESSION['empData'] = json_encode($empData);
	// header("Location: ../checkout.php?data=" . urlencode($encodedData));

	exit();
} else {
	echo 0;
}
