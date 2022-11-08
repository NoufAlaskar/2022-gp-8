<?php include("header.inc.php"); $policy_id = $_GET['policy_id'];?>
<div class="alert alert-info">
    <p>الرجاء اضافة ١٠ اسئلة لكل الاختبار الخاص بالسياسة</p>
</div>
<div class="col-md-8">
<h3>عرض اسئلة الاختبار 
    

<?php
	
	$query1 = "SELECT * FROM questions WHERE policy_id=$policy_id and hidden=0 Order BY question_id DESC";

	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
        ?>
            <a href="addQuestion.php?policy_id=<?php echo  $policy_id; ?>" class="btn btn-sm btn-info" style="margin-right: 10px;">كتابة سؤال</a></h3>
            
        <?php
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على اسئلة لهذه السياسة.</p>";
		echo '</div>';
		
	} else {
        $i = 1;
        if($count < 10){
            ?>
            <a href="addQuestion.php?policy_id=<?php echo  $policy_id; ?>" class="btn btn-sm btn-info" style="margin-right: 10px;">كتابة سؤال</a></h3>
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
    <div class="">
        <a href="editQuestion.php?q_id=<?php echo  $row1['number']; ?>&policy_id=<?php echo  $row1['policy_id']; ?>" class="btn btn-sm btn-success">تعديل</a>
        <a href="deleteQuestion.php?q_id=<?php echo  $row1['number']; ?>&policy_id=<?php echo  $row1['policy_id']; ?>" class="btn btn-sm btn-danger">حذف السؤال</a>
    </div>
</div>
<?php
	endwhile;
}
?>

</div>

<div class="col-md-4">
    <h4>&nbsp;</h4>
    <?php
                $query6 = "SELECT * FROM policy WHERE policy_id={$policy_id} ";
				
				$result6 = mysqli_query($link, $query6);
				$count6 = mysqli_num_rows($result6);
				if($count6 == 0) {
					echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
						echo "<p>لم يتم العثور على سياسات.</p>";
					echo '</div>';
				} else {
					$row6 = mysqli_fetch_array($result6, MYSQLI_BOTH);
                }
                ?>
    <div class="one_question">
        <h4>مراجعة رئيس القسم</h4>
        <blockquote>
            <?php echo $row6['examHeadReview']; ?>
        </blockquote>
    </div>
</div>
<?php include("footer.inc.php") ?>