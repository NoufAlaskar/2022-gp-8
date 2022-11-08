<?php include("header.inc.php") ?>

    <div class="container">

    <?php
	/// check before update & pass the policy_id, question id

    $policy_id = $_GET['policy_id'];
	$number = $_GET['q_id'];
if(isset($_POST['submit'])) {
	// get entered data from Form
	$q_id = $_POST['q_id'];
	$question_title = $_POST['question_title'];
	$answer1 = $_POST['answer1'];	
	$answer2 = $_POST['answer2'];	
	$answer3 = $_POST['answer3'];	
	$answer4 = $_POST['answer4'];	
	$is_correct = $_POST['is_correct'];
	// write update query 
	$q = "UPDATE questions SET title='$question_title', answer1='$answer1', answer2='$answer2', answer3='$answer3', answer4='$answer4', correct_answer='$is_correct' WHERE policy_id=$policy_id AND number=$number";
	$res = mysqli_query($link, $q);	
	if($res) {
	// if execution is true/done then show ok msg
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>تمت تعديل السؤال على سياستك بنجاح.</p>";
			echo '</div>';
			// redirect to ViewPolicyExam page to view questions
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=ViewPolicyExam.php?policy_id='  .$policy_id . '">';    
			exit;
	}
}
?>
<?php
	$query1 = "SELECT * FROM questions WHERE policy_id=$policy_id and number=$number";
	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على اسئلة لهذه السياسة.</p>";
		echo '</div>';
		
	} else {
        $row1 = mysqli_fetch_array($result1);
?>
<!-- read data from table then bind data for form inputs -->
<form method="post">
<h4 class="page-header">تعديل سؤال جديد:</h4>
<div class="well" style="margin:0px; padding:5px 10px;">
	<div class="form-group">
   		<input type="hidden" name="policy_id" value="<?php echo $_GET['policy_id']  ?>" />
           <input type="hidden" name="q_id" value="<?php echo $_GET['q_id']  ?>" />
    	<label class="control-label">نص السؤال</label>
        <textarea name="question_title" rows="4" class="form-control"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال نص السؤال')" required placeholder="نص السؤال" autofocus><?php echo $row1['title'] ?></textarea>
    </div>
<table class="table table-bordered" style="max-width:65%; background-color:#FFF; margin:15px auto">
	<tr>
    	<th align="center" style="vertical-align:middle">الجواب الأول</th>
        <td align="center" valign="middle"><input type="text" name="answer1" class="form-control" required placeholder="الجواب الأول"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال الاجابة الاولى')" value="<?php echo $row1['answer1'] ?>" /></td>
        <td align="center" style="vertical-align:middle"> <input type="radio" name="is_correct" value="1" required /> هو الجواب الصحيح</td>
    </tr>
	<tr>
    	<th align="center" style="vertical-align:middle">الإجابة الثانية</th>
        <td align="center" valign="middle"><input type="text" name="answer2" class="form-control" required placeholder="الإجابة الثانية"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال الاجابة الثانية')" value="<?php echo $row1['answer2'] ?>" /></td>
        <td align="center" style="vertical-align:middle"> <input type="radio" name="is_correct" value="2" required /> هو الجواب الصحيح</td>
    </tr>
    <tr>
    	<th align="center" style="vertical-align:middle">الجواب الثالث</th>
        <td align="center" valign="middle"><input type="text" name="answer3" class="form-control" required placeholder="الجواب الثالث"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال الاجابة الثالثة')"  value="<?php echo $row1['answer3'] ?>" /></td>
        <td align="center" style="vertical-align:middle"> <input type="radio" name="is_correct" value="3" required /> هو الجواب الصحيح</td>
    </tr>
    <tr>
    	<th align="center" style="vertical-align:middle">الإجابة الرابعة</th>
        <td align="center" valign="middle"><input type="text" name="answer4" class="form-control" required placeholder="الإجابة الرابعة"  oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال الاجابة الرابعة')"  value="<?php echo $row1['answer4'] ?>" /></td>
        <td align="center" style="vertical-align:middle"> <input type="radio" name="is_correct" value="4" required /> هو الجواب الصحيح</td>
    </tr>
</table>
<button type="submit" name="submit" class="btn btn-sm btn-primary pull-right">حفظ السؤال </button><br /><br />
</div>
</form>
    </div>
<?php } include("footer.inc.php") ?>

