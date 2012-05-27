<!DOCTYPE html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $user ?>'s Christmas List - Giftify</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
		<meta name="description" content=""/>
		<link rel="stylesheet" href="../inc/css/style.css" type="text/css" media="screen"/>
		<?php 
			$host = "localhost";
			$user = "root";
			$pass = "root";
			$db = "giftify";
		
			// Create connection
			$connection = mysql_connect($host, $user, $pass) or die("Could not connect to Database");
			mysql_select_db($db) or die("Could not select Database: " .$db);
			
			/*
if ($connection)
			{
				echo "Connected to " . $db;
			}
*/

			// Functions
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
			
			function totalSpent()
			{
				$query = "SELECT SUM(gift_price) FROM gifts WHERE is_bought = 1";
				$sum = mysql_query($query);
				$totalSpent = mysql_result($sum, 0);
				$totalSpent = round($totalSpent, 2);
				return $totalSpent;
			}
		?>
	</head>
	<body>
		<div id="list-container">
			<div id="top-row">
				<form name="form1" id="form1" method="insert_file_name_here">
					<div class="list-input">
						<input name="name" type="text" id="name" size="15" value="Recipient Name" />
					</div>
					<div class="list-input">
						<input name="gift_name" type="text" id="gift_name" size="10" value="Gift Name" />
					</div>
					<div class="list-input">
						£<input name="price" type="text" id="price" size="5" value="Price" />
					</div>
					<div class="list-input">
						<input type="checkbox" name="is_bought" value="1">
					</div>
					<div class="list-input">
						<input type="checkbox" name="is_delivered" value="1">
					</div>
					<div class="list-input">
						<input type="checkbox" name="is_wrapped" value="1">
					</div>
					<div class="list-input">
						<input type="checkbox" name="is_sent" value="1">
					</div>
					<input type="image" src="../img/add.png" name="submit" id="submit" value="submit" />
				</form>
				<div class="clear"></div>
		</div>
		<div id="left-content">
			<div id="list">
			<table class = "modern">
				<?php  
					// Db variables
				/*
	$host = "localhost";
					$user = "root";
					$pass = "root";
					$db = "giftify";
*/

			
					// Create connection
					$connection = mysql_connect($host, $user, $pass) or die(mysql_error());
					mysql_select_db($db) or die("Could not select Database: " . mysql_error());
					
					// Query
					$query = "SELECT * FROM gifts";
					
					// Run query
					$result = mysql_query($query) or die("Could not run query: " . mysql_error());
					
					
					// While loop to display data
					while($row = mysql_fetch_row($result)) 
					{
						if ($row[4] == 1)
						{
							$row[4] = "<img src =\"/img/yes.png\">";
						} else {
							$row[4] = "<img src =\"/img/no.png\">";
						}
						
						if ($row[5] == 1)
						{
							$row[5] = "<img src =\"/img/yes.png\">";
						} else {
							$row[5] = "<img src =\"/img/no.png\">";
						}
						
						if ($row[6] == 1)
						{
							$row[6] = "<img src =\"/img/yes.png\">";
						} else {
							$row[6] = "<img src =\"/img/no.png\">";
						}
						
						if ($row[7] == 1)
						{
							$row[7] = "<img src =\"/img/yes.png\">";
						} else {
							$row[7] = "<img src =\"/img/no.png\">";
						}
						echo "<tr>
								<td id=\"recipient\">" . $row[1] . "</td>
								<td id=\"gift_name\">" . $row[2] . "</td>
								<td id=\"gift_price\">" . $row[3] . "</td>
								<td id=\"is_bought\">" . $row[4] . "</td>
								<td id=\"is_delivered\">" . $row[5] . "</td>
								<td id=\"is_wrapped\">" . $row[6] . "</td>
								<td id=\"is_sent\">" . $row[7] . "</td>
								<td id=\"edit\"><a href=\"edit.php?id=".$row[0]."\"><img src=\"/img/edit.png\"></td>
								<td id=\"delete\"><a href=\"delete.php?id=".$row[0]."\"><img src=\"/img/delete.png\"></td>
							</tr>";
					}
				?>
				</table>
			</div>
			</div>
			<div id="right-content">
				<div class="info-box">This Christmas you have spent a total of £<?php echo totalSpent(); ?></div>
				<div class="clear"></div>
			</div>
		</div>		
	</body>
</html>
<?php addGift(); ?>
