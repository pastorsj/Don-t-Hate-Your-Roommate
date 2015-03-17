<?php 	
		session_start();
		if(!defined("create")) {        echo '<script> location.replace("http://sassyladies.csse.rose-hulman.edu/index.php"); </script>';
		}
?>
<!DOCTYPE html>
<?php
	$hostname = "sassyladies.csse.rose-hulman.edu";
	$user = "dbuser";
	$pass = "jopeiRe7";
	$conn = mysqli_connect($hostname, $user, $pass) 
	  or die(mysqli_connect_error());
	mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
?>
<html>
<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$errors = '';
			$msg = '';
		
			$username = '';
			$username = $_SESSION["LoginCheck"];
			$email = mysqli_query($conn, "Call GetEmail('$username')");
			if($email) {
				$email = mysqli_fetch_array($email);
			} else {
				$error .= "<li>Your email does not exist</li>";
			}
		
			// Make sure the firstname field is filled
		    $firstname = $_POST['FirstName'];
			$firstname = mysqli_real_escape_string($conn, $firstname);
		    if (empty($firstname)) $errors .= '<li>First Name is required</li>';
		
			// Make sure the middleinitial field is filled
		    $middleinitial = $_POST['MiddleInitial'];
			$middleinitial = mysqli_real_escape_string($conn, $middleinitial);
		    if (empty($middleinitial)) $errors .= '<li>Middle initial is required</li>';
		
		    // Make sure the lastname field is filled
		    $lastname = $_POST['LastName'];
			$lastname = mysqli_real_escape_string($conn, $lastname);
		    if (empty($lastname)) $errors .= '<li>Last name is required</li>';
		
		    // Make sure the gender field is filled
		    $gender = $_POST['Gender'];
		    $gender = mysqli_real_escape_string($conn, $gender);
		    if (!isset($gender)) $errors .= '<li>Gender is required to be set to either Male or Female</li>';
			
			// Enter a name for the college
		    $college = $_POST['College'];
		    if (empty($college)) $error .= '<li>College Name is required</li>';
			
			// Make sure the class field is filled
		    $class = $_POST['Class'];
			$class = mysqli_real_escape_string($conn, $class);
		    if (!isset($class)) $error .= '<li>Class is required</li>';
			
			
		    // If we have any errors at this point, stop here and show them
		    if (!empty($errors)) {
		        echo '<ul>' . $errors . '</ul>';
		    } else {				
				
				/*
				 * Insert Student will insert a student into the Student table, no need to check 
				 * parameters
				 */
				mysqli_close($conn);
            	$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
				mysqli_query($conn, "Call StudentInsert('" . $firstname . "', '" . $middleinitial . "'
									, '" . $lastname . "', '" . $gender . "', '" . $username . "', '" .
									$class . "', '" . $college . "')") or die(mysqli_error($conn));
				echo '<script> location.replace("http://sassyladies.csse.rose-hulman.edu/home.php"); </script>';
		    }
		}
		?>
	<head>		<title>Register</title>		<link href="index.css" rel="stylesheet">		<script src="index.js" type="text/javascript"></script>
<meta chartype="utf-8" />
	</head>
	<body>
		<form action = "" method = "post">
			<label for="FirstName">First Name</label><br/>
			<input type = "text" name = "FirstName" maxlength="20"/><br/>
			
			<label for="MiddleInitial">Middle Initial</label><br/>
			<input type = "text" name = "MiddleInitial" maxlength="5"/><br/>
			
			<label for="LastName">Last Name</label><br/>
			<input type = "text" name = "LastName" maxlength="30"/><br/>
			
			<label for "Gender">Gender</label> <br />
			<input type="radio" name="Gender" value="M">Male
			<br />
			<input type="radio" name="Gender" value="F">Female
			<br />
			
			<label for = "College">Select Your College</label><br/>
			<select name = "College">
				<?php
					$colleges = mysqli_query($conn, "Call GetAllColleges()");
					$eachCollege = array();
					if($colleges) {
						while($eachCollege = mysqli_fetch_array($colleges)) {
							print "<option value = " . $eachCollege[1] . ">" . $eachCollege[0] . "</option>";		
						}
					}
					mysqli_close($conn);
            		$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
				?>
			</select>
			<br />
			<label for = "Class">Class</label><br/>
			<input type="radio" name="Class" value="1">Freshman
			<br />
			<input type="radio" name="Class" value="2">Sophmore
			<br />
			<input type="radio" name="Class" value="3">Junior
			<br />
			<input type="radio" name="Class" value="4">Senior
			<br />
			<input type="radio" name="Class" value="5">Graduate Students or 5th Year
			<br />
			
			<button type = "submit">Create</button>
		</form>
	</body>
</html>