<?php  
	require_once('inc/db/connect.php'); // DB connection details
			
	function addGift() {
		// Variables
		$recipient = $_GET['name'];
		$gift_name = $_GET['gift_name'];
		$price = $_GET['price'];
		$is_bought = $_GET['is_bought']; 
		$is_delivered = $_GET['is_delivered'];
		$is_wrapped = $_GET['is_wrapped'];
		$is_sent = $_GET['is_sent'];
		
		// Query
		$query = "INSERT INTO gifts (recipient, gift_name, gift_price, is_bought, is_delivered, is_wrapped, is_sent) VALUES ('" . $recipient . "', '" . $gift_name . "', '" . $price . "', '" . $is_bought . "', '" . $is_delivered . "', '" . $is_wrapped . "', '" . $is_sent . "')";		
		// Run the query
		mysql_query($query) or die(mysql_error());
	}
	
	addGift();
	
	header('Location:index.php');

?>