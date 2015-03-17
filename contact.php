<?php

session_start();

$check = $_SESSION['LoginCheck'];
$redirect = "";

if($check == null) {
	$redirect = "index.php";
} else {
	$redirect = "home.php";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];
	$email = htmlspecialchars($email);

	$subject = $_POST['subject'];
	$subject = htmlspecialchars($subject);

	$message = $_POST['message'];
	$message = htmlspecialchars($message);

	include 'smtp/Send_Contact.php';
	$to = 'samuelpastoriza@gmail.com';
	$from = $email;
	$body = $message;
	Send_Contact($to, $from, $subject, $body);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include 'head.php'
		?>
		<title>Contact Page</title>
	</head>
	<body>
		
		<nav class="top-bar" data-topbar role="navigation">
			<ul class="title-area">
				<li class="name">
					<h1><a href="http://sassyladies.csse.rose-hulman.edu/<?=$redirect ?>"> Don't Hate Your Roommate</a></h1>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon">
					<a href="#"><span>Menu</span></a>
				</li>
			</ul>
			<section class="top-bar-section">
				<!-- Right Nav Section -->
				<ul class="right">
				</ul>
			</section>
		</nav>
		
		<br />
		<div class="row">
			<div class="large-6 columns">
				<form method = 'post' action = '' >
					<h3>Problems or Questions? Email us here </h3>
					<br />
					<label class="email" for="email">Enter Your Email (so we can reply to you)</label>
					<br/>
					<input id = "contactEmail" type = "text" maxlength="50" name = "email" value = ""/>
					<br/>

					<label class="subject" for="username">Enter the subject for your email</label>
					<br/>
					<input id = "subjectForEmail" type = "text" maxlength="40" name = "subject" value = ""/>
					<br/>

					<label class="message" for="message">Enter your message (max 500 characters)</label>
					<br/>
					<textarea rows="7" cols="50" id="messageForEmail" type = "text" maxlength="500" name = "message" value = ""></textarea>
					<br/>
					<button type="submit" value="sendEmail">
						Send Email
					</button>
				</form>
			</div>
		</div>
		
		<div class="footer"><?php include 'footer.php'; ?></div>
		
		<script>
			$(document).foundation();
		</script>
	</body>
</html>