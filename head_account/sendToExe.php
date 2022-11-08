<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
			<div class="col-md-6">
<?php 
// pass policy ID to send the policy to Executive 
	$policy_id = $_GET['policy_id'];
	if(isset($_GET['policy_id']))
	{
		// write the query to update status
		$sql="UPDATE policy SET sendToExec=1 WHERE policy_id={$policy_id}";
		$run = mysqli_query($link,$sql);
		if($run){
// if execution is true/done then show ok msg

			echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>تم ارسال السياسة الى Executive بنجاح.</p>";
			echo '</div>';
			// redirect to policy details page 
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=PolicyDetails.php?policy_id='  .$policy_id . '">';    
			exit;
		} 
	}
?>
			</div>
		</div>
	</div>
  </div>