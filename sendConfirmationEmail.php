<?php
	$hostname = "sassyladies.csse.rose-hulman.edu";
	$user = "dbuser";
	$pass = "jopeiRe7";
	$conn = mysqli_connect($hostname, $user, $pass) or die(mysqli_connect_error());
	mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
	$base_url='http://sassyladies.csse.rose-hulman.edu/';
	
	if((!empty($_GET['code']) && isset($_GET['code'])) || (($_GET['otherCode']) && isset($_GET['otherCode']))) {
		$code = mysqli_real_escape_string($conn,$_GET['code']);
		$otherCode = mysqli_real_escape_string($conn,$_GET['otherCode']);
		$result = mysqli_query($conn,"Call UsernameFromActivationCode('" . $code . "')") or die(mysqli_error($conn));
		if(mysqli_num_rows($result) > 0) {
			$username = mysqli_fetch_array($result);
			$username = $username[0];
			mysqli_close($conn);
			$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
			$otherResult = mysqli_query($conn,"Call UsernameFromActivationCode('" . $otherCode . "')") or die(mysqli_error($conn));
			if(mysqli_num_rows($result) > 0) {
				$otherUsername = mysqli_fetch_array($otherResult);
				$otherUsername = $otherUsername[0];
				mysqli_close($conn);
				$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
				$check = mysqli_query($conn, "Call checkForTwoMatch('" . $username . "', '" . $otherUsername . "')") or die(mysqli_error($conn));
				mysqli_close($conn);
				$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
				if(mysqli_num_rows($check)<1) {
					mysqli_query($conn, "Call deletePossibleMatches('" . $username . "', '" . $otherUsername . "')") or die(mysqli_error($conn));
					mysqli_query($conn, "Call insertNewMatch('" . $username . "', '" . $otherUsername . "')") or die(mysqli_error($conn));
					mysqli_query($conn, "Call updateMatchStatus('" . $username . "', '" . $otherUsername . "')") or die(mysqli_error($conn));
					echo "Match has been made!";
					//Send the email here ($otherUsername is confirming $username's request to be their roommate
					mysqli_close($conn);
				    $conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
					$email = mysqli_query($conn, "Call GetEmail('" . $username . "')") or die(mysqli_error($conn));
					$email = mysqli_fetch_array($email);
					$email = $email[0];
					mysqli_close($conn);
				    $conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
					$name = mysqli_query($conn, "Call getName('" . $otherUsername . "')");
					$name = mysqli_fetch_array($name);
					$name = $name[0];
					$subject = $name . " has confirmed to be your roommate!";
					$body = "You have been matched with " . $name . "
							<br /><a href = " . $base_url . " >Click here to go to the homepage</a>";
					include 'smtp/Send_Mail.php';
					$to = $email;
					Send_Mail($to, $subject, $body);
					echo "Email has been sent <br />";
				} else {
					echo "There is already a match for one of the users";	
				}
			} else {
				echo "The verification link is incorrect";	
			}
		} else {
			echo "The verification link is incorrect";
		}
	} else {
		echo "There is an error on the page.";
	}
?>