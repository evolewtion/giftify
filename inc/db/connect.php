<?php 
	$host = "localhost";
	$user = "root";
	$pass = "root";
	$db = "giftify";
	
/*
	$host = "mysql.appisode.co.uk";
	$user = "giftify_user";
	$pass = "giftify_password";
	$db = "giftify";
*/

	// Create connection
	$connection = mysql_connect($host, $user, $pass) or die("Could not connect to Database");
	mysql_select_db($db) or die("Could not select Database: " .$db);
?>