<?php
	session_start();
	$hostname = "sassyladies.csse.rose-hulman.edu";
	$username = "dbuser";
	//connecting to secure FX, csse
	$password = "jopeiRe7";
	$conn = mysqli_connect($hostname, $username, $password) or die(mysqli_connect_error());
	mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
		$errors = '';
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = $_POST['Username'];
			$username = mysqli_real_escape_string($conn, $username);
			$username = htmlspecialchars($username);

			//The Username and password will be inserted into the Login Table using a stored procedure created by Lexi

			// Enter a password

			$password = $_POST['Password'];
			$password = mysqli_real_escape_string($conn, $password);
			$password = htmlspecialchars($password);

			if (!empty($errors)) {

				echo '<ul>' . $errors . '</ul>';

			} else {

				$check = mysqli_query($conn, "Call LoginVerify('" . $username . "', '" . $password . "')");

				$array = mysqli_fetch_array($check);
				$res;
				if ($array[0] == '1') {
					// header("Location: index.php");
					$_SESSION["LoginCheck"] = $username;
					$res = array("code" => 0, "message" => "login success");
					echo json_encode($res);
				} else {
					$_SESSION["LoginCheck"] = "failed";
					$res = array("code" => 1, "message" => "error");
					echo json_encode($res);
				}
				//Will return either Success or 'Username or Password Incorrect'
			}

		}
	?>