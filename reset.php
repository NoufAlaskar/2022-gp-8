<?php include("header.php") ?>
<div class="section_top">
	<div class="container ">
		<h1>تغيير كلمة المرور</h1>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
<?php 

if(isset($_POST['login'])){
	$group = $_POST['group'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $username=$_SESSION['username'];
    if($group==1){
		$sql="UPDATE admin SET password='$password', reset=1 WHERE username='$username' and grade='Admin' limit 1";
		$run = mysqli_query($link,$sql);
        echo '<META HTTP-EQUIV="Refresh" Content="2; URL=admin_account/index.php">';   
    }
    if($group==2){
		$sql="UPDATE admin SET password='$password', reset=1  WHERE username='$username' and grade='Head' limit 1";
		$run = mysqli_query($link,$sql);
        echo '<META HTTP-EQUIV="Refresh" Content="2; URL=head_account/index.php">'; 
    }
    if($group==3){
		$sql="UPDATE admin SET password='$password', reset=1  WHERE username='$username' and grade='Executive' limit 1";
		$run = mysqli_query($link,$sql);
        echo '<META HTTP-EQUIV="Refresh" Content="2; URL=executive_account/index.php">';
    }
    if($group==4){
		$sql="UPDATE employee SET password='$password', reset=1  WHERE username='$username' limit 1";
		$run = mysqli_query($link,$sql);
        echo '<META HTTP-EQUIV="Refresh" Content="2; URL=employee_account/index.php">';   
    }

}
	?>
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">تغيير كلمة المرور</h3></div>
				<div class="panel-body">
					
					<div class="form-group">
						<label for="password">كلمة المرور</label>
                        <input type="hidden" name="group" value="<?php echo $_GET['group']; ?>" />
						<input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال كلمة المرور')">
					</div>	
				</div>
				<div class="panel-footer">
					<div class="form-group">
						<button name="login" id="login" type="submit" class="btn btn-danger pull-right">
							تغيير 
						</button><br>
					</div>
				</div>
			</div>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div><hr/>
</div>
<br/><br/>
<?php include("footer.php") ?>