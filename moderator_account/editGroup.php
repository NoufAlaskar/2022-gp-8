<?php include("header.inc.php") ?>

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php
    $group_id = $_GET['group_id'];
if(isset($_POST['createBtn'])) {
	$name = $_POST['name'];

	$sql="UPDATE policyGroup SET group_name='$name' WHERE group_id=$group_id";

	$run = mysqli_query($link,$sql);

	if($run){
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p>تم تحديث المجموعة بنجاح.</p>";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=viewGroups.php">';    
		exit;
	} 
	
}

?>
<?php
	
	$query1 = "SELECT * FROM policyGroup WHERE group_id=$group_id";
	$result1 = mysqli_query($link, $query1);
    $row1 = mysqli_fetch_array($result1);
            
?>s
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">تعديل بيانات القسم</h3></div>
                
				<div class="panel-body">
					<div class="form-group">
						<label for="name">اسم القروب</label>
				<input type="text" name="name" id="name" class="form-control" autofocus placeholder="ادخال اسم القسم" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال اسم القسم')" value="<?php echo $row1['group_name'] ?>">
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