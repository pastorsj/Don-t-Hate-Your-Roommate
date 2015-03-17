<?php
// if (!defined("signup")) {
// die("Direct access not permitted");
// }

$hostname = "sassyladies.csse.rose-hulman.edu";
$user = "dbuser";
$pass = "jopeiRe7";
$conn = mysqli_connect($hostname, $user, $pass) or die(mysqli_connect_error());
mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
$base_url = 'http://sassyladies.csse.rose-hulman.edu/';

$errors = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$email = $_POST['email'];
	$email = mysqli_real_escape_string($conn, $email);
	$email = htmlspecialchars($email);

	$username = $_POST['username'];
	$username = mysqli_real_escape_string($conn, $username);
	$username = htmlspecialchars($username);

	$password = $_POST['password'];
	$password = mysqli_real_escape_string($conn, $password);
	$password = htmlspecialchars($password);

	$confirmpassword = $_POST['confirmpassword'];
	$confirmpassword = mysqli_real_escape_string($conn, $confirmpassword);
	$confirmpassword = htmlspecialchars($confirmpassword);

	if (!empty($errors)) {
		echo '<ul>' . $errors . '</ul>';
	} else {
		$activation = md5($email . time());
		// Encrypted email + timestamp

		//Needs to be a unique email as well (Use Stored Procedure)
		$count = mysqli_query($conn, "Call EmailUnique('" . $email . "')") or die(mysqli_error());
		$res;
		if (mysqli_num_rows($count) < 1) {
			mysqli_close($conn);
			$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
			$userCheck = mysqli_query($conn, "Call UsernameUnique('" . $username . "')");
			if (mysqli_num_rows($userCheck) < 1) {
				mysqli_close($conn);
				$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
				$test = mysqli_query($conn, "Call SignUpInsert('" . $email . "','" . $username . "','" . $password . "', '" . $activation . "')") or die("Query Failed");
				$res = array("code" => 0, "message" => "success");
				echo json_encode($res);

				//Stored Procedure...
				include 'smtp/Send_Mail.php';
				$to = $email;
				$subject = "Email Verification";
				$body = 'Hello, <br/> <br/> Welcome to Roommates You Dont Hate. Please verify your email and get started using your account. <br/> <br/> 
						<a href="' . $base_url . 'activation.php/?code=' . $activation . '">"Verify Here"</a>';
				Send_Mail($to, $subject, $body);

				$msg = "Registration successful, please activate email.";
			} else {
				$res = array("code" => 2, "message" => "username taken");
				echo json_encode($res);
			}
		} else {
			$res = array("code" => 1, "message" => "email taken");
			echo json_encode($res);
		}
	}
}
?>