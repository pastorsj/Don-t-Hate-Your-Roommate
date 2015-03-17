<?php
	session_start();
	$hostname = "sassyladies.csse.rose-hulman.edu";
	$user = "dbuser";
	$pass = "jopeiRe7";
	$conn = mysqli_connect($hostname, $user, $pass) 
	  or die(mysqli_connect_error());
	$base_url = "http://sassyladies.csse.rose-hulman.edu/";
	mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
	$otherUsername = $_GET['user'];//Need a way to get a username depending who I want room with...
	$username = $_SESSION['LoginCheck'];
	$email = mysqli_query($conn, "Call GetEmail('" . $otherUsername . "')") or die(mysqli_error($conn));
	$email = mysqli_fetch_array($email);
	$email = $email[0];
	mysqli_close($conn);
    $conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
	$nameOfUser = mysqli_query($conn, "Call getName('" . $username . "')") or die(mysqli_error($conn));
	$nameOfUser = mysqli_fetch_array($nameOfUser);
	$nameOfUser = $nameOfUser[0];
	$subject = $nameOfUser . " wants to be roommates with you!";
	mysqli_close($conn);
    $conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
	//Get the otherUsername's activation code
	$activation = mysqli_query($conn, "Call getActivationCode('" . $username . "')") or die(mysqli_error($conn));
	$activation = mysqli_fetch_array($activation);
	$activation = $activation[0];
	mysqli_close($conn);
    $conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
	$otherActivation = mysqli_query($conn, "Call getActivationCode('" . $otherUsername . "')") or die(mysqli_error($conn));
	$otherActivation = mysqli_fetch_array($otherActivation);
	$otherActivation = $otherActivation[0];
	$body = 'Click here to view their profile before you Confirm or Deny <br/> <br/> 
						<a href="' . $base_url . 'theirProfile.php/?code=' . $activation . '&otherCode=' . $otherActivation . '">"View Their Profile Here"</a>';
	include 'smtp/Send_Confirmation.php';
	Send_Confirmation($email, $subject, $body);
	echo "Email has been sent, check your profile for updates";
	?> <br/><?php
	echo '<script> location.replace("http://sassyladies.csse.rose-hulman.edu/home.php"); </script>';
?>