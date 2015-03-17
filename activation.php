<?php
session_start();
$hostname = "sassyladies.csse.rose-hulman.edu";
$user = "dbuser";
$pass = "jopeiRe7";
$connection = mysqli_connect($hostname, $user, $pass) or die(mysqli_connect_error());
mysqli_select_db($connection, 'RYDH') or die(mysqli_error());
$base_url='http://sassyladies.csse.rose-hulman.edu/';
$msg='';
if(!empty($_GET['code']) && isset($_GET['code'])) {
	$code=mysqli_real_escape_string($connection,$_GET['code' ]);
	$c=mysqli_query($connection,"Call UsernameFromActivationCode('" . $code . "')") or die("Failed");
	$row = mysqli_fetch_row($c);
	$username = $row[0];
	if(mysqli_num_rows($c) > 0) {
		mysqli_close($connection);
		$connection = mysqli_connect($hostname, $user, $pass, 'RYDH');
		$count=mysqli_query($connection,"Call UsernameStatusZero('" . $code . "')") or die(mysqli_error($connection));
		if(mysqli_num_rows($count) == 1) {
			mysqli_close($connection);
			$connection = mysqli_connect($hostname, $user, $pass, 'RYDH');
			mysqli_query($connection,"Call StatusUpdate('" . $code . "')") or die(mysqli_error($connection));
			$msg="Your account is activated";
			$_SESSION["LoginCheck"] = $username;
			echo '<script> location.replace("http://sassyladies.csse.rose-hulman.edu/home.php"); </script>';
		} else {
			$msg ="Your account is already active, no need to activate again";
			echo '<script> location.replace("http://sassyladies.csse.rose-hulman.edu/index.php"); </script>';
		}
	} else {
		$msg ="Wrong activation code.";
		echo '<script> location.replace("http://sassyladies.csse.rose-hulman.edu/index.php"); </script>';
	}
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>PHP Email Verification Script</title>
<link rel="stylesheet" href="<?php echo $base_url; ?>style.css"/>
</head>
<body>
	<div id="main">
	<h2><?php echo $msg; ?></h2>
	</div>
</body>
</html>
