<?php 
	session_start();
	$hostname = "sassyladies.csse.rose-hulman.edu";
	$user = "dbuser";
	$pass = "jopeiRe7";
	$conn = mysqli_connect($hostname, $user, $pass) or die(mysqli_connect_error());
	mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
	$username = $_SESSION["LoginCheck"];
	$target_file = basename($_FILES["file_upload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["file_upload"]["tmp_name"]);
		if ($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check file size
	if ($_FILES["file_upload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		$imgData = addslashes(file_get_contents($_FILES['file_upload']['tmp_name']));
		mysqli_query($conn, "Call insertImage('" . $username . "', '" . $imgData . "')") or die(mysqli_error());
		
	}
	echo "Upload Complete!";
	echo '<script> location.replace("http://sassyladies.csse.rose-hulman.edu/myprofile.php"); </script>';
?>