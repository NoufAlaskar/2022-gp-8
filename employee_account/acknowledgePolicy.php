<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
			<div class="col-md-6">
<?php 
	// pass data to acknowledge that employee the policy
	$policy_id = $_GET['policy_id'];
	if(isset($_GET['policy_id']))
	{
		// write update query to update policy table
		$sql="UPDATE policyReaded SET acknowledge=1 WHERE policy_id={$policy_id} and employee_id=$employee_id";
		$run = mysqli_query($link,$sql);
		if($run){
// if execution is true/done then show ok msg
			echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>تمت الموافقة السياسة بنجاح.</p>";
			echo '</div>';
			// redirect to PolicyDetails page to view policy
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=PolicyDetails.php?policy_id=' . $policy_id .'">';    
			exit;
		} 
	}
?>
			</div>
		</div>
	</div>
  </div>