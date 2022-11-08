<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
			<div class="col-md-6">
<?php 
	$q_id = $_GET['q_id'];
    $policy_id = $_GET['policy_id'];
	/// check before update and pass the ID if policy and question ID
	if(isset($_GET['q_id']))
	{
		// write update query
		$sql="UPDATE questions SET hidden=1 WHERE question_id={$q_id} AND policy_id=$policy_id";
		$run = mysqli_query($link,$sql);
		if($run){
			// if execution is true/done then show ok msg
			echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>تمت حذف السؤال على سياستك بنجاح.</p>";
			echo '</div>';
			// redirect to ViewPolicyExam page to view questions
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=ViewPolicyExam.php?policy_id=' . $policy_id . '">';    
			exit;
		} 
	}
?>
			</div>
		</div>
	</div>
  </div>
  <?php include("footer.inc.php") ?>