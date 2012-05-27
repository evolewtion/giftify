<?php  
	require_once('../inc/db/connect.php'); // DB connection details
	
	// Functions
	function deleteGift() {
		// Variables
		$id = $_GET[id];
			
		// Query
		$query = "DELETE FROM gifts WHERE id=$id";		
		// Run the query
		mysql_query($query) or die(mysql_error());
	}
	
	deleteGift();
	
	header('Location:index.php');	
?>