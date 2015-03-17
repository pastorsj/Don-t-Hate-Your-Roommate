<?php session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<?php $hostname = "sassyladies.csse.rose-hulman.edu";
$user = "dbuser";
//connecting to secure FX, csse
$password = "jopeiRe7";
$conn = mysqli_connect($hostname, $user, $password) or die(mysqli_connect_error());
mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
include "head.php";
       ?>
       <head>
             <title>Survey About Your Other Half</title>
             <!--<link href = "survey.css" type = "text/css" rel = "stylesheet" />-->
       </head>
       <body>
                  <nav class="top-bar" data-topbar role="navigation">
            <ul class="title-area">
                <li class="name">
                    <?php $username = $_SESSION["LoginCheck"]; ?>
                    <h1><a href="#">Welcome User: <?php echo $username; ?>
                    </a></h1>
                    <!--<h1><a href="#">Don't Hate Your Roommate</a></h1>-->
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
                        <a href="logout.php">
                        <button id = "logoutUser">
                            Logout
                        </button></a>
                        </div>
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
    <h1>Tell us what you want in a roommate!</h1>
    <div id="overallContent">
             <?php mysqli_close($conn);
			$conn = mysqli_connect($hostname, $user, $password, 'RYDH');
			$questions = array();
			$choices = array();
			$getQuestions = mysqli_query($conn, "Call getQuestions()") or die(mysqli_error($conn));
			while ($QuestionRow = mysqli_fetch_array($getQuestions)) {
				array_push($questions, $QuestionRow[1]);
			};
			mysqli_close($conn);
			$conn = mysqli_connect($hostname, $user, $password, 'RYDH');
			$getChoices = mysqli_query($conn, "Call getChoices()");
			while ($ChoiceRow = mysqli_fetch_array($getChoices)) {
				array_push($choices, Array($ChoiceRow[0], $ChoiceRow[1], $ChoiceRow[2]));
			};
			?>
		<form action = "" method = "post">
			<?php
            $countQuestions = count($questions);
        	for ($i = 0; $i < $countQuestions; $i++) {
        		$a = $i+1;
	        ?> 
	        <label for "question<?=$a?>"><?=$a . " " . $questions[$i]?></label>
	        <?php
	            $count = count($choices);
	            for ($j = 0; $j < $count; $j++) {
	            	$num = $i+1;
	                if ($choices[$j][0] == $num) {
	        ?> 
	        <input type="radio" name="question<?=$num?>" value="<?=$choices[$j][1]?>" ><?=$choices[$j][2]?></input><br />
	        <?php 	}
				}
				print "<br />";
			}
            ?>
            <button type = "submit">Find Your Match</button>
            </form>
         <?php
		//Gets all the answers from the survey and insert it into the database
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = '';
			$answers = '';
			$username = $_SESSION["LoginCheck"];
			for ($i = 0; $i < $countQuestions; $i++) {
				$questionID = $i + 1;
				$userAnswer = $_POST["question" . ($questionID)];
				if (!isset($userAnswer)) {
					$errors .= "Question " . $i . " was not answered <br />";
				} else {
					$answers .= $userAnswer;
				}
			}
			if (!empty($errors)) {
				echo $errors;
			} else {
				//$self = $_GET["self"];
				for ($i = 0; $i < strlen($answers); $i++) {
					mysqli_close($conn);
					$j = $i + 1;
					$conn = mysqli_connect($hostname, $user, $password, 'RYDH');
					mysqli_query($conn, "Call insertAnswer('" . $username . "', '" . $j . "', '" . $answers{$i} . "', '" . 1 . "')") or die(mysqli_error($conn));
				}
			}
			include 'match.php';
		}
		include "footer.php";
        ?>
             </div>
             <script>$(document).foundation();</script>
       </body>

</html>

