<?php
	// Functions
	function totalSpent()
	{
		$query = "SELECT SUM(gift_price) FROM gifts"; // Add WHERE is_bought = 1 to make it only the items bought.
		$sum = mysql_query($query);
		$totalSpent = mysql_result($sum, 0);
		$totalSpent = round($totalSpent, 2);
		return $totalSpent;
	}
	
	function totalGifts()
	{
		$query = "SELECT * FROM gifts";
		$result = mysql_query($query);
		$total = mysql_num_rows($result);
		return $total;
	}
	
	function totalBought()
	{
		$query = "SELECT * FROM gifts WHERE is_bought = 1";
		$result = mysql_query($query);
		$totalBought = mysql_num_rows($result);
		return $totalBought;
	}
	
	function totalWrapped()
	{
		$query = "SELECT * FROM gifts WHERE is_Wrapped = 1";
		$result = mysql_query($query);
		$total = mysql_num_rows($result);
		return $total;
	}
	
?>