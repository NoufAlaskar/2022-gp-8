<?php include("header.inc.php") ?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
<?php
$employee_id = $_GET['employee_id'];
	$sql="Delete From employee WHERE employee_id=$employee_id";

	$run = mysqli_query($link,$sql);

	if($run){
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p>تم حذف الموظف بنجاح</p>";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=viewEmployees.php">';    
		exit;
    }


?>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<?php include("footer.inc.php") ?>