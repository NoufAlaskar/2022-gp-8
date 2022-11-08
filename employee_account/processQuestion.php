<?php include("header.inc.php"); ?>
<?php
if(isset($_POST['submit'])) {
	$q_id = $_POST['n'];
	$policy_id = $_POST['policy_id']; 
	$employee_id = $_SESSION['employee_id']; 
	$correct_answer = $_POST['correct_answer'];
	$answer1 = @$_POST['answer1'];
	$answer2 = @$_POST['answer2'];
	$answer3 = @$_POST['answer3'];
	$answer4 = @$_POST['answer4'];
	
	$selected_answer = 0;
	
	if(isset($_POST['answer1'])) {
		$selected_answer = $_POST['answer1'];
	} else if(isset($_POST['answer2'])) {
		$selected_answer = $_POST['answer2'];
	} else if(isset($_POST['answer3'])) {
		$selected_answer = $_POST['answer3'];
	} else if(isset($_POST['answer4'])) {
		$selected_answer = $_POST['answer4'];
	}
	if($correct_answer == $selected_answer) {
		$_SESSION['total'] += 10;
	}
	if($q_id >= 10) {
		$msg = "لقد أنهيت هذا الاختبار. انتظر لعرض النتيجة الخاصة بك.";
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
        echo "<p>$msg</p>";
        echo '</div>';

		
	 	echo '<META HTTP-EQUIV="Refresh" Content="2;showResult.php?policy_id=' . $policy_id . '">';
	} else {
		$q_id = $q_id + 1;
		echo '<META HTTP-EQUIV="Refresh" Content="1;startPolicyExam.php?n=' . $q_id . '&policy_id=' . $policy_id . '">';
	}
}
?>

<?php include("footer.inc.php"); ?>