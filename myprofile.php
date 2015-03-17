<?php
session_start();
if ($_SESSION["LoginCheck"] == null) {
	die("Direct Access Not Permitted");
}
?>
<!DOCTYPE html>

<html>
	<head>
		<?php
		include "head.php, matches.php";
		?>
		<link href = "profile.css" type = "text/css" rel = "stylesheet" />
		<script src="profile.js" type="text/javascript"></script>
	</head>
	<?php
	$hostname = "sassyladies.csse.rose-hulman.edu";
	$user = "dbuser";
	$pass = "jopeiRe7";
	$conn = mysqli_connect($hostname, $user, $pass) or die(mysqli_connect_error());
	mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
	?>
	<body>
		<script></script>
		<nav class="top-bar" data-topbar role="navigation">
			<ul class="title-area">
				<li class="name">
					<h1><a href="home.php">Don't Hate Your Roommate</a></h1>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon">
					<a href="#"><span>Menu</span></a>
				</li>
			</ul>
			<section class="top-bar-section">
				<!-- Right Nav Section -->
				<ul class="right home-right">
					<li><a href="home.php">Home</a></li>
					<li class="has-dropdown active">
						<a href="#">Me</a>
						<ul class="dropdown">
					<li>
							<a href="myprofile.php">My Profile</a>
					</li>
					<li>
						<a href="logout.php">Sign Out</a>
					</li>
						</ul>
					</li>
				</ul>
				<!-- Left Nav Section -->
				
			</section>
		</nav>
		<br/>
		<div class="customRow" id="viewPhoto">
			<div class="large-12 large-centered columns text-center clip-circle">
				<div class="clip-circle">
					<!--Gets the picture and displays the picture if it exists -->
						<img id="profilePic" src = "getProfilePicture.php" />
					</div>
			</div>
		</div>
		<div class="customRow" id="pictureHeading">
			<div class="large-6 large-centered columns text-center">
				<?php
				$username = $_SESSION["LoginCheck"];
				$profile = mysqli_query($conn, "Call getStudent('" . $username . "')") or die(mysqli_error($conn));
				$row = mysqli_fetch_array($profile, MYSQLI_NUM);
				$name = $row[0];
				mysqli_close($conn);
				$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
				?>
				<h3 class="subheader" id="userName"><?=$name?></h3>
			</div>
		</div>
		<hr>
		<div class="customRow">
			<div class="large-12 large-centered columns text-center">
				<ul class="button-group radius even-4">
					<li>
						<a href="#" class="button active" id="profileInfo">Info</a>
					</li>
					<li>
						<a href="#" class="button" id="profileMatches">Matches</a>
					</li>
					<li>
						<a href="#" class="button" id="profileSurvey">Survey</a>
					</li>
					<li>
						<a href="#" class="button" id="profilePhoto">Picture</a>
					</li>
				</ul>
			</div>
		</div>
		<div id ="userInfo">
			<?php
			$username = $_SESSION["LoginCheck"];
			$profile = mysqli_query($conn, "Call getStudent('" . $username . "')") or die(mysqli_error($conn));
			$row = mysqli_fetch_array($profile, MYSQLI_NUM);
			$name = $row[0];
			$class = $row[1] . "";
			$college = $row[2];
			$className = array("Freshman", "Sophomore", "Junior", "Senior", "5th Year or Graduate Student");
			$class = $className[$class - 1];
			mysqli_close($conn);
			$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
			$checkUser = mysqli_query($conn, "Call checkSurvey('" . $username . "', 0)") or die(mysqli_error($conn));
			$dispUser = "";
			$firstRow = mysqli_fetch_array($checkUser);
			$matches = '';
			if ($firstRow[0] == '0') {
				$dispUser = "initial";
				$matches = "none";
			} else {
				$dispUser = "none";
				$matches = "initial";
			}
			?>
			
			<div id="profileTable" >
			<div class="customRow" id="infoTab">
				<div class="large-12 large-centered columns">
					<table id="profileInfo" width="100%">
						<thead>
							<tr>
								<th width="30%">Profile Information</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><h5>Name</h5></td>
								<td><?=$name ?></td>
							</tr>
							<tr>
								<td><h5>Class</h5></td>
								<td><?=$class ?></td>
							</tr>
							<tr>
								<td><h5>College</h5></td>
								<td><?=$college ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="customRow" id="matchTab">
				<div class="large-12 large-centered columns">

					<div style = "display: <?=$dispUser ?>">
						You need to complete the survey
						<br />
					</div>
					<br />

					<a href="#" id="profileSurvey2">
					<button style = "display: <?=$dispUser ?>">
						Start Survey
						<br />
					</button></a>
					<div style="display:<?=$matches ?>">
						<?php
							include 'viewPossibleMatches.php';
						?>
					</div>
					<a href = "match.php">
					<button class = "button-radius" style = "display:<?=$matches ?>">
						Update Matches
					</button> </a>
					<select>
						<?php
							mysqli_close($conn);
							$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
							$arrayOfNames = mysqli_query($conn, "Call getListOfPossibleMatches('" . $username . "')");
							$name = array();
							if($arrayOfNames) {
								while($name = mysqli_fetch_array($arrayOfNames)) {
									print "<option>" . $name[0] . "</option>";
								}
							} else {
								print "<option>None</option>";	
							}
						?>
					</select>
				</div>
			</div>

			<div class="customRow" id="surveyTab">
				<!-- <dl class="sub-nav">
  					<dt>QUESTIONS:</dt>
  					<dd class="active"><a href="#">Yourself</a></dd>
  					<dd><a href="#">Roommate</a></dd>
				</dl> -->
				<div class="large-12 large-centered columns" style = "display: <?=$dispUser ?>">
					<?php include 'survey.php'?>
				</div>
				<div data-alert class="alert-box success radius" style = "display: <?=$matches ?>">
					Survey Completed Successfully
				</div>
			</div>

			<div class="customRow" id="photoTab">
				<div class="large-12 large-centered columns">
					<form method='post' enctype='multipart/form-data' action='uploadPhoto.php'>
						<h3>File:</h3>
						<input type='file' name='file_upload'>
						<input class="button tiny" type='submit'>
					</form>
				</div>
			</div>
		</div>
		</div>

		<div class="footer">
			<?php
			include 'footer.php';
			?>
		</div>

	</body>
</html>