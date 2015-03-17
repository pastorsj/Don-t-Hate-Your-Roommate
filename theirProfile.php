<!DOCTYPE html>
<html>
	<head>
		<?php include "head.php"; ?>
		<link href = "profile.css" type = "text/css" rel = "stylesheet" />
		<title>Profile Page</title>
	</head>

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
			$studentResult = mysqli_query($conn, "Call getStudent('" . $username . "')") or die(mysqli_error($conn));
			$student = mysqli_fetch_array($studentResult);
			$name = $student[0];
			$class = $student[1];
			$college = $student[2];
		} else {
			echo "The verification link is incorrect";
		}
	} else {
		echo "There is an error on the page.";	
	}
?>
	<body>			
		<div>Name: <?=$name?></div>
		<div>Class: <?=$class?></div>
		<div>College: <?=$college?></div>
		<div>View their answers to the Survey</div>
		<!--Need to send the activation code-->
		<a href="http://sassyladies.csse.rose-hulman.edu/sendConfirmationEmail.php?code=<?php echo $code . "&otherCode=" . $otherCode;?>">
		<button>
			Confirm
		</button>
		</a>
		<!--Need to send the activation code-->
		<a href="http://sassyladies.csse.rose-hulman.edu/sendDeniedEmail.php?code=<?php echo $code . "&otherCode=" . $otherCode;?>">
		<button>
			Deny
		</button>
		</a>
		
		<div class="footer"><?php include 'footer.php'; ?></div>
	</body>
</html>