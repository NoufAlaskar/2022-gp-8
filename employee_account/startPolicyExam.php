<?php include("header.inc.php") ?>

<h3 >السؤال رقم <?php echo $q_id = $_GET['n']; $policy_id=$_GET['policy_id']; ?></h3>
<?php
// make total mark to zero
	if(!isset($_SESSION['total'])) {
		$_SESSION['total'] = 0;
	}
	
	// write a query to get question for policy depending on policy_id
	$q = "select * from questions WHERE policy_id={$policy_id} AND number={$q_id}";
    
	$res = mysqli_query($link, $q);
	$no = mysqli_num_rows($res);
	if($no == 0) {
		// show no data found msg
		echo "<div class='alert alert-warning'>";
		echo "No Question";
		echo "</div>";
	} else {
		// convert returned data to be array
		$row = mysqli_fetch_array($res);
?>
<div class="container2">
	<div class="col-md-10 well">
    	<h4><?php echo $row['title'] ?></h4>
      
        <hr />
		<!-- create form question template and bind data to inputs -->
		<form action="processQuestion.php" method="post">
        	<ul class="list-unstyled">
            	<input type="hidden" name="correct_answer" value="<?php echo $row['correct_answer'] ?>"  /> 
                <input type="hidden" name="n" value="<?php echo $q_id ?>"  /> 
                <input type="hidden" name="policy_id" value="<?php echo $policy_id ?>"  /> 
            	<div class="form-group">
                	<input type="radio" name="answer1" value="1"  required /> <?php echo $row['answer1'] ?>
                </div>
                <div class="form-group">
                	<input type="radio" name="answer1" value="2"  required /> <?php echo $row['answer2'] ?>
                </div>
                <div class="form-group">
                	<input type="radio" name="answer1" value="3"  required /> <?php echo $row['answer3'] ?>
                </div>
                <div class="form-group">
                	<input type="radio" name="answer1" value="4"  required /> <?php echo $row['answer4'] ?>
                </div>
            </ul>
            <button type="submit" name="submit" class="btn btn-danger pull-left">السؤال التالي</button>
        </form>
    </div>
    <div class="col-md-2">
         <img src="../assets/imgs/exam.png" class="pull-right img-rounded img-thumbnail" style="width: 200px; height: 200px;">

    </div>
</div>
<?php
	}
?>
<?php include("footer.inc.php"); ?>