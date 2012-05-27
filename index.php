<!DOCTYPE html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $user ?>'s Christmas List - Giftify</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
		<meta name="description" content=""/>
		<link rel="stylesheet" href="inc/css/style.css" type="text/css" media="screen"/>
		<?php 
			require_once('inc/db/connect.php'); // DB connection details
			
			// Variables
			if ($_GET['order'])
			{
				$order = $_GET['order'];
			} else {
				$order = "id";
			}
			
			// Functions
			function howManyDays()
			{
				// Australia
				$year = date('Y');
				$oz = mktime(0, 0, 0, 12, 25, $year);
				$today = time();
				$difference = ($oz - $today);
				$days = (int) ($difference/86400);
				
				if ($days <= 1)
				{
					print "NOW!";
				} else {
					print "<span id=\"days\">$days</span>";
				}
			}
			
			function totalSpent()
			{
				$query = "SELECT SUM(gift_price) FROM gifts WHERE is_bought = 1";
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
	</head>
	<body>
		<div id="list-container">
			<div id="top-row">
				<div id="logo">
					<img src="img/giftify-logo.png" alt="giftify-logo" width="140" height="30" />
				</div>
				<form name="form1" id="form1" method="get" action="add.php">
					<div class="list-input">
						<input name="name" type="text" id="name" size="15" placeholder="Recipient Name" />
					</div>
					<div class="list-input">
						<input name="gift_name" type="text" id="gift_name" size="14" placeholder="Gift Name" />
					</div>
					<div class="list-input">
						£<input name="price" type="text" id="price" size="2" placeholder="0" />
					</div>
					<div class="list-input" id="is_bought">
						<input type="checkbox" name="is_bought" value="1">
					</div>
					<div class="list-input" id="is_delivered">
						<input type="checkbox" name="is_delivered" value="1">
					</div>
					<div class="list-input" id="is_wrapped">
						<input type="checkbox" name="is_wrapped" value="1">
					</div>
					<div class="list-input" id="is_sent">
						<input type="checkbox" name="is_sent" value="1">
					</div>
					<input type="image" src="img/add.png" name="submit" id="submit" value="submit" />
					
				</form>
				<div class="clear"></div>
		</div>
		<div id="left-content">
			<div id="list">
			<table class = "modern">
			<tr id="heading">
								<td id=\"recipient\"><a href="?order=recipient">Recipient</a></td>
								<td id=\"gift_name\"><a href="?order=gift_name">Gift Name</a></td>
								<td id=\"gift_price\"><a href="?order=gift_price">Price</a></td>
								<td id=\"is_bought\"><a href="?order=is_bought">Bought?</a></td>
								<td id=\"is_delivered\"><a href="?order=is_delivered">Delivered?</a></td>
								<td id=\"is_wrapped\"><a href="?order=is_wrapped">Wrapped?</a></td>
								<td id=\"is_sent\"><a href="?order=is_sent">Sent?</a></td>
								<td id=\"edit\">Edit</td>
								<td id=\"delete\">Delete</td>
							</tr>
				<?php  		
					// Query
					
					$query = "SELECT * FROM gifts ORDER BY $order DESC";
					
					// Run query
					$result = mysql_query($query) or die("Could not run query: " . mysql_error());
					
					
					// While loop to display data
					while($row = mysql_fetch_row($result)) 
					{
						if ($row[4] == 1)
						{
							$img4 = "<img src =\"/img/yes.png\">";
						} else {
							$img4 = "<img src =\"/img/no.png\">";
						}
						
						if ($row[5] == 1)
						{
							$img5 = "<img src =\"/img/yes.png\">";
						} else {
							$img5 = "<img src =\"/img/no.png\">";
						}
						
						if ($row[6] == 1)
						{
							$img6 = "<img src =\"/img/yes.png\">";
						} else {
							$img6 = "<img src =\"/img/no.png\">";
						}
						
						if ($row[7] == 1)
						{
							$img7 = "<img src =\"/img/yes.png\">";
						} else {
							$img7 = "<img src =\"/img/no.png\">";
						}
						
						echo "<tr>
								<td id=\"recipient\" width=\"150px\">" . $row[1] . "</td>
								<td id=\"gift_name\">" . $row[2] . "</td>
								<td id=\"gift_price\">£" . $row[3] . "</td>
								<td id=\"is_bought\"><a href=\"update.php?current=".$row[4]."&action=bought&id=".$row[0]."\">" . $img4 . "</a></td>
								<td id=\"is_delivered\"><a href=\"update.php?current=".$row[5]."&action=delivered&id=".$row[0]."\">" . $img5 . "</a></td>
								<td id=\"is_wrapped\"><a href=\"update.php?current=".$row[6]."&action=wrapped&id=".$row[0]."\">" . $img6 . "</a></td>
								<td id=\"is_sent\"><a href=\"update.php?current=".$row[7]."&action=sent&id=".$row[0]."\">" . $img7 . "</a></td>
								<td id=\"edit\"><a href=\"edit.php?id=".$row[0]."\"><img src=\"/img/edit.png\"></td>
								<td id=\"delete\"><a href=\"delete.php?id=".$row[0]."\"><img src=\"/img/delete.png\"></td>
							</tr>";
					}
				?>
				</table>
			</div>
			</div>
			<div id="right-content">
				<div class="info-box">
				<p>Total Spent: £<?php echo totalSpent(); ?></p>
				<p>You have bought <?php echo totalBought(); ?>/<?php echo totalGifts(); ?> gifts.</p>
				<p>You have wrapped <?php echo totalWrapped(); ?>/<?php echo totalGifts(); ?> gifts.</p>
				<p>Days until Christmas: <!-- <br /> --><?php howManyDays(); ?></p>
			</div>
				
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div id="footer">
			<p>The Giftify App is a free web app allowing you to keep track of things over the Christmas period. If you have any questions or comments, please email <a href="mailto:lewis@hilldesigns.co.uk">lewis@hilldesigns.co.uk</a>.</p>
		</div>
		</div>		
	</body>
</html>