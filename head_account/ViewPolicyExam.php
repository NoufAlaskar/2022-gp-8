<?php include("header.inc.php"); $policy_id = $_GET['policy_id'];?>

<div class="col-md-8">
<h3>مراجعة اسئلة الاختبار 
    
<?php
	$noOfQuestions = 0;
	$query1 = "SELECT * FROM questions WHERE policy_id=$policy_id  Order BY question_id DESC";

	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على اسئلة لهذه السياسة.</p>";
		echo '</div>';
		
	} else {
        $noOfQuestions = $count;
        $i = 1;
        if($count < 10){
            ?>
            <?php
        }
        while($row1 = mysqli_fetch_array($result1)) :
?>
<div class="one_question">
    <h4 style="direction:rtl"><i class="fa fa-question-circle-o" ></i>
          السؤال رقم <?php echo $i++ ?>  :  
            <?php echo $row1['title'] ?>
</h4>
    <?php
        echo "<ul class='list-unstyled quesion_list'>";
        if($row1['correct_answer'] == 1) {
            echo "<li><i class='fa fa-check '></i>"  . $row1['answer1'] .  "</span></li>";
        } else {
            echo "<li><i class='fa fa-circle-o'></i> " . $row1['answer1'] . "</li>";
        }
        
        if($row1['correct_answer'] == 2) {
            echo "<li><li><i class='fa fa-check'></i>" . $row1['answer2'] .  "</li>";
        } else {
            echo "<li><i class='fa fa-circle-o'></i> " . $row1['answer2'] . "</li>";
        }
        
        if($row1['correct_answer'] == 3) {
            echo "<li><li><i class='fa fa-check'></i>" . $row1['answer3'] . "</li>";
        } else {
            echo "<li><i class='fa fa-circle-o'></i> " . $row1['answer3'] . "</li>";
        }
        
        if($row1['correct_answer'] == 4) {
            echo "<li><li><i class='fa fa-check'></i>" . $row1['answer4'] ."</li>";
        } else {
            echo "<li><i class='fa fa-circle-o'></i> " . $row1['answer4'] . "</li>";
        }
        echo "</ul>";
?>
</div>
<?php
	endwhile;
}
?>

</div>

<div class="col-md-4">
    <h4>&nbsp;</h4>
    <div class="one_question">
        <h4>مراجعة Head of Department</h4>
<?php
    $policy_id = $_GET['policy_id'];

    $query3 = "SELECT * FROM policy WHERE policy_id={$policy_id} ";
    
    $result3 = mysqli_query($link, $query3);
    $count3 = mysqli_num_rows($result3);
    if($count3 == 0) {
        echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
            echo "<p>لم يتم العثور على سياسات.</p>";
        echo '</div>';
    } else {
        $row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);

    }
    $policy_id = $row3['policy_id'];
    $policy_group_id = $row3['group_id'];
    ?>
<?php
if(isset($_POST['addHeadReview'])) {
    ///echo "here";
	$review = $_POST['headReview'];
	$policy_id = $_POST['policy_id'];
	$policy_group_id = $_POST['policy_group_id'];

	 $sql4 = "UPDATE policy SET examHeadReview='$review' WHERE policy_id=$policy_id and group_id=$policy_group_id";
	$run4 = mysqli_query($link, $sql4);
	if($run4) {
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p>تم إرسال مراجعتك بنجاح.</p>";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1;ViewPolicyExam.php?policy_id=' . $policy_id . '">';
	}
}
if(is_null($row3['examHeadReview']) and $noOfQuestions <> 0) {
?>
            <form method="post">
                <div class="form-group">
                    <textarea class="form-control" name="headReview" rows="5" required placeholder="اضف مراجعة"></textarea>
                </div>
                <input type="hidden" name="policy_id" value="<?php echo $policy_id ?>">
                <input type="hidden" name="policy_group_id" value="<?php echo $policy_group_id ?>">
                <div class="form-group text-center">
                    <button type="submit" name="addHeadReview" class="btn btn-sm btn-primary">حفظ المراجعة</button>
                </div>
            </form>
<?php } else if(is_null($row3['examHeadReview']) and $noOfQuestions == 0) { ?>
    <p class="text-danger">لا يمكنك اضافة مراجعة الا بعد اضافة الاسئلة للاختبار</p>
<?php } else { ?>
    <blockquote><?php echo $row3['examHeadReview']; ?></blockquote>       
<?php } ?>
    </div>
</div>
<?php include("footer.inc.php") ?>