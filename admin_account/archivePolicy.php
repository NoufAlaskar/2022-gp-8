<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
			<div class="col-md-6">
<?php 
	/// check before update and pass the ID if policy 
	$policy_id = $_GET['policy_id'];

	if(isset($_GET['policy_id']))
	{
		/// make update for policy to be published
		$sql="UPDATE policy SET published=-1 WHERE policy_id={$policy_id}";
		$run = mysqli_query($link,$sql);
		if($run){
			// if execution is true/done then show ok msg
			echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>تمت ارشفة سياستك بنجاح.</p>";
			echo '</div>';
			// redirect to index page to view questions
			echo '<META HTTP-EQUIV="Refresh" Content="1; URL=index.php">';    
			exit;
		} 
	}
?>
			</div>
		</div>
	</div>
  </div>
  <?php include("footer.inc.php") ?>