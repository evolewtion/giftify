<?php  
	require_once('inc/db/connect.php'); // DB connection details
	// Variables
	$action = $_GET['action'];
	$id = $_GET['id'];
	$current = $_GET['current'];
	
	if ($current == 1){
		$new = 0;
	} else {
		$new = 1;
	}
		
	switch($action) {
		case "bought":
			$query = "UPDATE gifts SET is_bought = $new WHERE id = $id";
			break;
		case "delivered":
			$query = "UPDATE gifts SET is_delivered = $new WHERE id = $id";
			break;
		case "wrapped":
			$query = "UPDATE gifts SET is_wrapped = $new WHERE id = $id";
			break;
		case "sent":
			$query = "UPDATE gifts SET is_sent = $new WHERE id = $id";
			break;
	}
		
		
	// Query
	mysql_query($query) or die(mysql_error());
	
	
	header('Location:index.php');

?>