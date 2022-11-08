<?php include("header.inc.php") ?>

    <div class="container">

    <?php
    $policy_id = $_GET['policy_id'];
if(isset($_POST['submit'])) {
	$course_id = $_POST['course_id'];
	$question_title = $_POST['question_title'];
	
	$answer1 = $_POST['answer1'];	
	$answer2 = $_POST['answer2'];	
	$answer3 = $_POST['answer3'];	
	$answer4 = $_POST['answer4'];	
	
	$is_correct = $_POST['is_correct'];
	
	$questionNumber = 0;

	/// check before insert 
	$query1 = "SELECT * FROM questions WHERE policy_id=$policy_id and hidden=0 Order BY question_id DESC";
	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		$questionNumber = 1;
	} else {
		$questionNumber = $count + 1;
	}
	// insert data into questions table
	$q = "INSERT INTO questions VALUES(NULL, $questionNumber,'$question_title', 10, $policy_id, '$answer1', '$answer2', '$answer3', '$answer4', '$is_correct',0)";
	// execute insert query
	$res = mysqli_query($link, $q);	

	
	if($res) {
		// if execution is true/done then show ok msg
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>تمت اضافة السؤال على سياستك بنجاح.</p>";
			echo '</div>';
			// redirect to ViewPolicyExam to view questions
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=ViewPolicyExam.php?policy_id='  .$policy_id . '">';    
			exit;
	}

}
?>
<form method="post">
<h4 class="page-header">إضافة سؤال جديد:</h4>
<div class="well" style="margin:0px; padding:5px 10px;">
	<div class="form-group">
   		<input type="hidden" name="course_id" value="<?php echo $_GET['']  ?>" />
    	<label class="control-label">نص السؤال</label>
        <textarea name="question_title" rows="4" class="form-control"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال نص السؤال')" required placeholder="نص السؤال" autofocus></textarea>
    </div>
<table class="table table-bordered" style="max-width:65%; background-color:#FFF; margin:15px auto">
	<tr>
    	<th align="center" style="vertical-align:middle">الجواب الأول</th>
        <td align="center" valign="middle"><input type="text" name="answer1" class="form-control" required placeholder="الجواب الأول"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال الاجابة الاولى')"  /></td>
        <td align="center" style="vertical-align:middle"> <input type="radio" name="is_correct" value="1" required /> هو الجواب الصحيح</td>
    </tr>
	<tr>
    	<th align="center" style="vertical-align:middle">الإجابة الثانية</th>
        <td align="center" valign="middle"><input type="text" name="answer2" class="form-control" required placeholder="الإجابة الثانية"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال الاجابة الثانية')" /></td>
        <td align="center" style="vertical-align:middle"> <input type="radio" name="is_correct" value="2" required /> هو الجواب الصحيح</td>
    </tr>
    <tr>
    	<th align="center" style="vertical-align:middle">الجواب الثالث</th>
        <td align="center" valign="middle"><input type="text" name="answer3" class="form-control" required placeholder="الجواب الثالث"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال الاجابة الثالثة')" /></td>
        <td align="center" style="vertical-align:middle"> <input type="radio" name="is_correct" value="3" required /> هو الجواب الصحيح</td>
    </tr>
    <tr>
    	<th align="center" style="vertical-align:middle">الإجابة الرابعة</th>
        <td align="center" valign="middle"><input type="text" name="answer4" class="form-control" required placeholder="الإجابة الرابعة"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال الاجابة الرابعة')" /></td>
        <td align="center" style="vertical-align:middle"> <input type="radio" name="is_correct" value="4" required /> هو الجواب الصحيح</td>
    </tr>
</table>
<button type="submit" name="submit" class="btn btn-sm btn-primary pull-right">حفظ السؤال </button><br /><br />
</div>
</form>
    </div>
<?php include("footer.inc.php") ?>

