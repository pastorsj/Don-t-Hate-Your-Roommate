<?php
session_start();
$check = $_SESSION['LoginCheck'];
$redirect = "";
if ($check == null) {
    $redirect = "index.php";
} else {
    $redirect = "home.php";
}?>
<!DOCTYPE html>
<html>
	<head>		<?php include 'head.php';		?>		<link href = "profile.css" type = "text/css" rel = "stylesheet" />		<script src="profile.js" type="text/javascript"></script>	</head>
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
					<table width="50%"  style="margin:0 auto">				<thead>					<tr>						<td><img src="img/sam.jpg" alt="sam" width=100 height=100 /></td>					</tr>				</thead>
				<tbody>					<tr>						<td> Sam Pastoriza (Backend and Frontend Developer) </td>					</tr>					<tr>						<td>Sam Pastoriza is a double major in Software Engineering and Computer Science at 
						Rose-Hulman Institute of Technology. He was raised outside of Washington DC and graduated 
						from Walt Whitman High School in 2013. Sam was the captain of his high school varisty golf 
						team and currently plays on the varsity golf team at Rose-Hulman. He is enjoys web development 
						and spending quality time with family and friends. He is proud to call this website the first successful
						web development project.  
						 </td>					</tr>					<tr>						<td>Contact Sam: <a href = "mailto:pastorsj@rose-hulman.edu">pastorsj@rose-hulman.edu</td>					</tr>				</tbody>
			</table>		</div>
		<div class = "lexi">			<table width="50%" style="margin:0 auto">				<thead>					<tr>						<td><img src="img/lexi.jpg" alt="lexi" width=100 height=100/></td>					</tr>				</thead>				<tbody>					<tr>						<td> Lexi Harris (Backend Developer)</td>					</tr>					<tr>						<td>Lexi is a sophomore Software Engineer and Computer Science major. 
						She is the Panhellenic Delegate for Chi Omega Fraternity and is a member 
						of the Rose-Hulman Dance Company. She also attends Chi Omega Bible Study 
						and enjoys playing intramural volleyball. She loves musical theater, pizza, 
						and FaceTiming her best friend and sister, Tali.  Lexi is very proud of 
						Addison Zhang for developing the roommate matcher idea on their walk to the 
						restroom between classes. </td>					</tr>					<tr>						<td>Contact Lexi: <a href = "mailto:harrislb@rose-hulman.edu">harrislb@rose-hulman.edu</a></td>					</tr>				</tbody>			</table>		</div>
		<div class="addy">						<table width="50%" style="margin:0 auto">				<thead>					<tr>					    <td><img src="img/addy.jpg" alt="addy" width=100 height=100/></td>											</tr>				</thead>				<tbody>				    <tr>				        <td>Addison Zhang (Frontend and Backend Developer)</td>				    </tr>					<tr>						<td>Addison is a Computer Science and Software Engineering major at 
						Rose-Hulman Institute of Technology. She is the webmaster/secretary 
						for Circle K International and is a member of the Chi Omega Fraternity. 
						Addison is also a member of the ACM Programming Team at Rose, and she 
						attended the ACM-ICPC regionals at the University of Illinois at Springfield 
						last year (Team 007). She loves eating spicy food and putting jalapenos/spicy 
						sauce in her dishes. And her fun for life is to make fun of Lexi for everything.</td>					</tr>					<tr>						<td>Contact Addison: <a href = "mailto:zhangl3@rose-hulman.edu">zhangl3@rose-hulman.edu</td>					</tr>				</tbody>			</table>

		</div>
		<div class="noah">			<table width="50%" style="margin:0 auto">				<thead>					<tr>					    <td><img src="img/noah.jpg" alt="noah" width=100 height=100/></td>											</tr>				</thead>				<tbody>				    <tr>				        <td>Noah Miller (Frontend Developer)</td>				    </tr>					<tr>						<td>Noah is a junior Software Engineer at Rose-Hulman Institute of Technology. 
						He transferred from Richland Community College as an honor studend with an Associates 
						in Science. In 2014, he became engaged to his beautiful fiancee with whom he spends most 
						of his time. Also, he likes to play guitar, listen to music, and work on programming projects.</td>					</tr>					<tr>						<td>Contact Noah: <a href = "mailto:millerna@rose-hulman.edu">millerna@rose-hulman.edu</td>					</tr>				</tbody>			</table>
		</div>		<br /><br />		<br />        <div class="footer">            <?php include "footer.php"?>        </div>                <script>            $(document).foundation();        </script>
	</body>	
</html>