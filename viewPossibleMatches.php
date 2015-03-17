<!DOCTYPE html>

<html>
	<table width="100%">
		<thead>
			<tr>
				<th>Name</th>
				<th>Number of Matches</th>
				<th>Info</th>
			</tr>
		</thead>
		<tbody>
			<?php
			session_start();
			$hostname = "sassyladies.csse.rose-hulman.edu";
			$username = "dbuser";
			$password = "jopeiRe7";
			$otherUsername = "";
			$conn = mysqli_connect($hostname, $username, $password) or die(mysqli_connect_error());
			mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
			$username = $_SESSION["LoginCheck"];
			$possibleRoommates = mysqli_query($conn, "Call getPossibleRoommates('" . $username . "')") or die("GetPossibleRoommates: " . mysqli_error());
			while ($row = mysqli_fetch_array($possibleRoommates)) {
				echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" ?><a href="confirmationEmail.php?user=<?=$row[2]?>">Send Request</a><?php $row[2] . "</td></tr>";
			}
		?>
		</tbody>
	</table>
</html>

