<?php
session_start();
$check = $_SESSION['LoginCheck'];
$redirect = "";
if ($check == null) {
    $redirect = "index.php";
} else {
    $redirect = "home.php";
}
<!DOCTYPE html>
<html>
	<head>
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
				<!-- Left Nav Section -->
			</section>
		</nav>
		<br />
		<br />
		<div class="sam">
		

						Rose-Hulman Institute of Technology. He was raised outside of Washington DC and graduated 
						from Walt Whitman High School in 2013. Sam was the captain of his high school varisty golf 
						team and currently plays on the varsity golf team at Rose-Hulman. He is enjoys web development 
						and spending quality time with family and friends. He is proud to call this website the first successful
						web development project.  
						 </td>

		<div class = "lexi">
						She is the Panhellenic Delegate for Chi Omega Fraternity and is a member 
						of the Rose-Hulman Dance Company. She also attends Chi Omega Bible Study 
						and enjoys playing intramural volleyball. She loves musical theater, pizza, 
						and FaceTiming her best friend and sister, Tali.  Lexi is very proud of 
						Addison Zhang for developing the roommate matcher idea on their walk to the 
						restroom between classes. </td>
		<div class="addy">
						Rose-Hulman Institute of Technology. She is the webmaster/secretary 
						for Circle K International and is a member of the Chi Omega Fraternity. 
						Addison is also a member of the ACM Programming Team at Rose, and she 
						attended the ACM-ICPC regionals at the University of Illinois at Springfield 
						last year (Team 007). She loves eating spicy food and putting jalapenos/spicy 
						sauce in her dishes. And her fun for life is to make fun of Lexi for everything.</td>

		</div>
		<div class="noah">
						He transferred from Richland Community College as an honor studend with an Associates 
						in Science. In 2014, he became engaged to his beautiful fiancee with whom he spends most 
						of his time. Also, he likes to play guitar, listen to music, and work on programming projects.</td>

	</body>
</html>