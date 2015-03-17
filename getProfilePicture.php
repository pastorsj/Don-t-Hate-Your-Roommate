<?php
	session_start();
	$hostname = "sassyladies.csse.rose-hulman.edu";
	$user = "dbuser";
	$pass = "jopeiRe7";
	$conn = mysqli_connect($hostname, $user, $pass) or die(mysqli_connect_error());
	mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
	$username = $_SESSION["LoginCheck"];
	$photo = mysqli_query($conn, "Call checkForImage('" . $username . "')") or die(mysqli_error($conn));
	$photo = mysqli_fetch_array($photo);
	header("Content-type: image/jpeg");
	echo $photo[0];
?>