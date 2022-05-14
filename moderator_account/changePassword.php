<?php include("header.inc.php") ?>

<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php
if(isset($_POST['changeBtn'])) {
	$missing = array();
	$current = $_POST['current'];
	$new = $_POST['new'];
	$confirm = $_POST['confirm'];
	
	$sql="SELECT * FROM moderator WHERE password='$current' and moderator_id = {$moderator_id}";
	$run = mysqli_query($link,$sql);
	$count = mysqli_num_rows($run);
	
	if($count == 0) {
		$missing[] = "كلمة المرور الحالية غير متطابقة";
 	}
	
	if($new <> $confirm) {
		$missing[] = "كلمة المرور الجديدة لا تتطابق مع تأكيد كلمة المرور";
	}
	
	if(empty($missing)) {
		$update_sql = "UPDATE moderator SET password='$new' WHERE moderator_id={$moderator_id}";
		$update_run = mysqli_query($link,$update_sql);
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>تم تغيير كلمة السر الخاصة بك</p>";
			echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=index.php">';    
		exit(); 
	} else {
		echo '<div class="alert alert-warning " role="alert" style="margin:10px auto;text-align:left">';
		echo '<ul class="text-left " style="font-size:13px; padding-left:0px;">';
		foreach($missing as $err) {
			echo "<li>" . ucwords($err) ."</li>";
		}
		echo '</ul>';
		echo '</div>';
	}
	
}

?>
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">تغيير كلمة المرور</h3></div>
				<div class="panel-body">
					
					<div class="form-group">
						<label for="current">كلمة المرور الحالية</label>
						<input type="password" name="current" id="current" class="form-control" autofocus placeholder="كلمة المرور الحالية" required>
					</div>
					
					<div class="form-group">
						<label for="new">كلمة المرور الجديدة</label>
						<input type="password" name="new" id="new" class="form-control"  placeholder="كلمة المرور الجديدة" required>
					</div>

					<div class="form-group">
						<label for="confirm">تأكيد كلمة المرور</label>
						<input type="password" name="confirm" id="confirm" class="form-control" placeholder="تأكيد كلمة المرور" required>
					</div>	
				</div>
				<div class="panel-footer">
					<div class="form-group">
						<button name="changeBtn" id="changeBtn" type="submit" class="btn btn-danger btn-sm pull-right" >
							حفظ كلمة المرور
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