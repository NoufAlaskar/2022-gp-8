<?php include("header.inc.php") ?>

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php
if(isset($_POST['createBtn'])) {
	$name = $_POST['name'];

	$sql="INSERT INTO  policyGroup VALUES (NULL,'$name')";

	$run = mysqli_query($link,$sql);

	if($run){
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p>تم اضافة المجموعة بنجاح</p>";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=viewGroups.php">';    
		exit;
	} 
	
}

?>
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">اضافة مجموعة جديد</h3></div>
                
				<div class="panel-body">
					<div class="form-group">
						<label for="name">اسم المجموعة</label>
						<input type="text" name="name" id="name" class="form-control" autofocus placeholder="اسم المجموعة" required>
					</div>
				</div>
				<div class="panel-footer">
					<div class="form-group">
						<button name="createBtn" id="createBtn" type="submit" class="btn btn-danger btn-sm pull-right" >
				            حفظ
						</button><br>
					</div>
				</div>
			</div>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
<?php include("footer.inc.php") ?>