<!DOCTYPE html>

<html>
	<nav class="top-bar" data-topbar role="navigation">
		<ul class="title-area">
			<li class="name">
				<h1><a href="#">Don't Hate Your Roommate</a></h1>
			</li>
			<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon">
				<a href="#"><span>Menu</span></a>
			</li>
		</ul>
		<section class="top-bar-section">
			<!-- Right Nav Section -->
			<ul class="right">
				<li>
					<a href="#" data-reveal-id="registerTable" style="display:none">
					<button class="button radius" id = "register">
						Register
					</button></a>
					<div id="registerTable" class="reveal-modal" data-reveal>
						<h2>Register</h2>
						<br/>
						<?php 	define("signup", true);
							include 'signup.php';
						?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				</li>
				<li>
					<a href="#" data-reveal-id="loginTable" style="display:none">
					<button class="button radius" id="login">
						Log in
					</button> </a>
					<div id="loginTable" class="reveal-modal" data-reveal>
						<h2>Login</h2>
						<br/>
						<?php 	define("login", true);
							include 'login.php';
						?>
						<a class="close-reveal-modal">&#215;</a>
					</div>

					<a href="#" data-reveal-id="createUser" style="display"none">
					<button class="button radius" id = "createnewuser">
						Create Your Profile
					</button></a>
					<div id="createUser" class="reveal-modal" data-reveal>
						<?php 	define("create", true);
						include 'createuserprofile.php';
						?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
					<a href="logout.php" style="display:none">
						<button class="button radius" id = "logoutUser">
							Logout
						</button>
					</a>
					<a href="myprofile.php" style="display:none">
						<button class="button radius viewProfile" id = "viewProfile">
							View Your Profile
						</button>
					</a>
				</li>
			</ul>
			<!-- Left Nav Section -->
			<ul class="left">
				<li>
					<a href="#">By Lexi Harris, Addison Zhang, Sam Pastoriza and Noah Miller</a>
				</li>
			</ul>
		</section>
	</nav>
</html>