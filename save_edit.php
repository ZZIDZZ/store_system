<?php
include("connection.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$updateField='';
	if(isset($input['product_name'])) {
		$updateField.= "product_name='".$input['product_name']."'";
	} else if(isset($input['product_price'])) {
		$updateField.= "product_price=".$input['product_price']."";
	} else if(isset($input['product_discount'])) {
		$updateField.= "product_discount=".$input['product_discount']."";
	}
	if($updateField && $input['id']) {
		$sqlQuery = "UPDATE products SET $updateField WHERE id='" . $input['id'] . "'";	
		mysqli_query($con, $sqlQuery) or die("database error:". mysqli_error($con));		
	}
}
?>