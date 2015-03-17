<?php 
       session_start();
?>
<!DOCTYPE html>
<html>
<?php
    $hostname = "sassyladies.csse.rose-hulman.edu";
    $user = "dbuser";
    //connecting to secure FX, csse
    $password = "jopeiRe7";
    $conn = mysqli_connect($hostname, $user, $password) or die(mysqli_connect_error());
    mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
    include "head.php";
    ?>
    
    <head>
    	<link href = "survey.css" type = "text/css" rel = "stylesheet" />
    </head>
    <body>
                
    <h1>Fill out the survey</h1>
    <div id="overallContent">
             <?php
             mysqli_close($conn);
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
?><form action = "" method = "post"><?php
             $countQuestions = count($questions);
        for ($i = 0; $i < $countQuestions; $i++) {
            
           ?> <label for "question<?=$i+1?>"><?= ($i + 1) . " " . $questions[$i]; ?></label>
                    <?php
                    $count = count($choices);
            for ($j = 0; $j < $count; $j++) {
                if ($choices[$j][0] == $i + 1) {
                    ?> 

            <input type="radio" name="question<?=$i+1?>" value= <?=$choices[$j][1] ?>><?=$choices[$j][2]; ?></input><br /><?php
            };
            };
            print "<br />";
            };
            ?>
            <button type = "submit">Submit Survey</button>
            </form>
         <?php
             //Gets all the answers from the survey and insert it into the database
             if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $errors = '';
                    $answers = '';
                    $username = $_SESSION["LoginCheck"];
                    for($i = 0; $i < $countQuestions; $i++) {
                           $questionID = $i+1;
                           $userAnswer = $_POST["question" . ($questionID)];
                           if(!isset($userAnswer)) {
                                 $error .= "Question " . $i . " was not answered <br />";
                           } else {
                                 $answers .= $userAnswer;   
                           }
                    }
                    if(!empty($errors)) {
                           echo $errors;
                    } else {
                           //$self = $_GET["self"];
                         mysqli_close($conn);
                   		 $conn = mysqli_connect($hostname, $user, $password, 'RYDH');
	                       for($i = 0; $i < strlen($answers); $i++) {
	                             $j = $i+1;
	                             if($i<20) {
	                             	mysqli_query($conn, "Call insertAnswer('" . $username . "', '" . $j . "', '" . 
	                                                                     $answers{$i} . "', '" . 0 . "')") or die(mysqli_error($conn));
								 } else {
								 	mysqli_query($conn, "Call insertAnswer('" . $username . "', '" . $j . "', '" . 
	                                                                     $answers{$i} . "', '" . 1 . "')") or die(mysqli_error($conn));
								 }
	                       } 
                    }
					include 'match.php';
             	}
             ?>
             
             <br/>
             </div>
             <script>$(document).foundation();</script>
       </body>
</html>

