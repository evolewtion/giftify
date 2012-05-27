<!DOCTYPE html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $user ?>'s Christmas List - Giftify</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
		<meta name="description" content=""/>
		<link rel="stylesheet" href="../inc/css/style.css" type="text/css" media="screen"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="../inc/js/script.js"></script>
		<script src="../inc/js/jquery.inlineedit.js"></script>
		<?php 
			require_once('../inc/db/connect.php'); // DB connection details
			require_once('../inc/db/functions.php'); // All my lovely functions
		?>
	</head>
	<body>
		<div id="list-container">
			<div id="top-row">
				<div id="logo">
					<img src="../img/giftify-logo.png" alt="giftify-logo" width="140" height="30" />
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
					<input type="image" src="../img/add.png" name="submit" id="submit" value="submit" />
					
				</form>
				<div class="clear"></div>
		</div>
		<div id="left-content">
			<div id="list">
			<table class = "modern">
				<?php 
					if (totalGifts() == 0){
						echo "<p><span class=\"error\">You have not added any items. Get started above!</span></p>";
					}
				?>
				<?php  		
					// Query
					$query = "SELECT * FROM gifts";
					
					// Run query
					$result = mysql_query($query) or die("Could not run query: " . mysql_error());
					
					
					// While loop to display data
					while($row = mysql_fetch_row($result)) 
					{
						if ($row[4] == 1)
						{
							$img4 = "<img src =\"/giftify/img/yes.png\">";
						} else {
							$img4 = "<img src =\"/giftify/img/no.png\">";
						}
						
						if ($row[5] == 1)
						{
							$img5 = "<img src =\"/giftify/img/yes.png\">";
						} else {
							$img5 = "<img src =\"/giftify/img/no.png\">";
						}
						
						if ($row[6] == 1)
						{
							$img6 = "<img src =\"/giftify/img/yes.png\">";
						} else {
							$img6 = "<img src =\"/giftify/img/no.png\">";
						}
						
						if ($row[7] == 1)
						{
							$img7 = "<img src =\"/giftify/img/yes.png\">";
						} else {
							$img7 = "<img src =\"/giftify/img/no.png\">";
						}
						
						// Do the tickboxes add up to four? If so, the item is complete.
						$checkboxes = $row[4] + $row[5] + $row[6] + $row[7];
						
						// Set the CSS class to indicate the level of completion visually.
						switch($checkboxes) {
							case 4:
								$border = "green";
								break;
							case 3:
								$border = "orange";
								break;
							case 2:
								$border = "orange";
								break;
							case 1:
								$border = "orange";
								break;
							case 0:
								$border = "red";
								break;
						}

						echo "<tr id=\"gift\" class=\"$border\">
								<td width=\"110\" id=\"recipient\"><p>" . $row[1] . "</p></td>
								<td width=\"100\" id=\"gift_name\">" . $row[2] . "</td>
								<td width=\"10\" id=\"gift_price\">£" . $row[3] . "</td>
								<td width=\"20\" id=\"is_bought\"><a href=\"update.php?action=bought&id=$row[0]&current=$row[4]\">" . $img4 . "</a></td>
								<td width=\"20\" id=\"is_delivered\"><a href=\"update.php?action=delivered&id=$row[0]&current=$row[5]\">" . $img5 . "</a></td>
								<td width=\"20\" id=\"is_wrapped\"><a href=\"update.php?action=wrapped&id=$row[0]&current=$row[6]\">" . $img6 . "</a></td>
								<td width=\"20\" id=\"is_sent\"><a href=\"update.php?action=sent&id=$row[0]&current=$row[7]\">" . $img7 . "</a></td>
								<td width=\"20\" id=\"edit\"><a href=\"edit.php?id=".$row[0]."\"><img src=\"/giftify/img/edit.png\"></td>
								<td width=\"20\" id=\"delete\"><a href=\"delete.php?id=".$row[0]."\"><!-- <img src=\"/giftify/img/delete.png\"> --><div class=\"delete\"></div></td>
							</tr>";
					}
				?>
				</table>
			</div>
			</div>
			<div id="right-content">
				<div class="info-box">
				<p>Budget: £<span class="editable">600</span></p>
				<p>Total Spent: £<?php echo totalSpent(); ?></p>
				<p>You have bought <?php echo totalBought(); ?>/<?php echo totalGifts(); ?> gifts.</p>
				<p>You have wrapped <?php echo totalWrapped(); ?>/<?php echo totalGifts(); ?> gifts.</p>
			</div>
				
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div id="footer">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		</div>		
	</body>
</html>