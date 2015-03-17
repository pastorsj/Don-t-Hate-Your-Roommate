<?php 	
	session_start();
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	if ($_SESSION["LoginCheck"] == null) {
		die("Direct Access Not Permitted");
	}
	$hostname = "sassyladies.csse.rose-hulman.edu";
	$user = "dbuser";
	$pass = "jopeiRe7";
	$conn = mysqli_connect($hostname, $user, $pass) or die(mysqli_connect_error());
	mysqli_select_db($conn, 'RYDH') or die(mysqli_error());
	$username = $_SESSION["LoginCheck"];
	//echo "Username: " . $username . "<br />";
	$userAnswers = '';
	$query = mysqli_query($conn, "Call getAnswers('" . $username . "', '1')") or die("getAnswerUser" . mysqli_error($conn));
	while ($row = mysqli_fetch_array($query)) {
		$userAnswers .= $row[0];
		//echo "User Answers: " . $row[0] . "<br />";
	}
	mysqli_close($conn);
	$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
	$possibleMatches = array();
	$possibleMatchArray = array();
	$query = mysqli_query($conn, "Call getPossibleMatches('" . $username . "')") or die("GetPossibleMatch" . mysqli_error($conn));
	while ($row = mysqli_fetch_array($query)) {
		//echo "Possible Matches: " . $row[0] . "<br />";
		array_push($possibleMatches, $row[0] );
	}
	mysqli_close($conn);
		$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');
	for ($i = 0; $i < count($possibleMatches); $i++) {
		$roomQuery = mysqli_query($conn, "Call getAnswers('" . $possibleMatches[$i] . "', '0')") or die("getAnswersPossible" . mysqli_error($conn));
		if(mysqli_num_rows($roomQuery) != '0') {
			//echo $possibleMatches[$i] . "<br />";
			$answers = '';
			while ($ans = mysqli_fetch_array($roomQuery)) {
				//echo "Answers: " . $ans[0] . "<br />";
				$answers .= $ans[0];
			}
			$sameAnswer = 0;
			for ($j = 0; $j < strlen($answers); $j++) {
				if ($userAnswers{$j} == $answers{$j}) {
					$sameAnswer++;
				}
			}
			//echo "Number of Same Answers: " . $sameAnswer . "<br />";
			if($sameAnswer>0) {
				array_push($possibleMatchArray, Array('Username' => $possibleMatches[$i], 'SimilarCount' => $sameAnswer));
				usort($possibleMatchArray, function($a, $b) {
					return $a['SimilarCount'] - $b['SimilarCount'];
				});
			}
		}
		mysqli_close($conn);
		$conn = mysqli_connect($hostname, $user, $pass, 'RYDH');		
	}
	//$possibleMatchArray should be populated with Usernames and Counts that are ordered by the number of similar answers, desc
	array_reverse($possibleMatchArray);
	$possibleMatchArray = array_slice($possibleMatchArray, 0, 9);
	//Top 20 Matches
	for ($k = 0; $k < count($possibleMatchArray); $k++) {
		if($possibleMatchArray[$k]['Username'] != '') {
		//echo $k . "<br />";
		//echo $username . "<br />";
		//echo $possibleMatchArray[$k]['Username'] . "<br />";
		//echo $possibleMatchArray[$k]['SimilarCount'] . "<br />";
			mysqli_query($conn, "Call newPossibleMatch('" . $username . "', '" . $possibleMatchArray[$k]['Username'] 
															. "', " . $possibleMatchArray[$k]['SimilarCount'] . ")") 
															or die(mysqli_error($conn));
		}														
	}
	echo '<script> location.replace("http://sassyladies.csse.rose-hulman.edu/myprofile.php"); </script>';
?>