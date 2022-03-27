<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
			<div class="col-md-6">
<?php 
	$policy_id = $_GET['policy_id'];
	if(isset($_GET['policy_id']))
	{
		$sql="UPDATE policy SET approved=1 WHERE policy_id={$policy_id}";
		$run = mysqli_query($link,$sql);
		if($run){
			echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>Your Policy Approved Successfully.</p>";
			echo '</div>';
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=PolicyDetails.php?policy_id='  .$policy_id . '">';    
			exit;
		} 
	}
?>
			</div>
		</div>
	</div>
  </div>