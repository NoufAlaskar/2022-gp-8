<?php include("header.php") ?>
<div class="section_top">
	<div class="container ">
		<h1>Login</h1>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
<?php 

if(isset($_POST['login'])){
	$login_type = $_POST['loginType'];
	$username=$_POST['username'];
	$password= $_POST['password'];


	if($login_type == 'Admin') {

		 $sql="SELECT * FROM admin WHERE username='$username' and password='$password'";
		
		$run = mysqli_query($link,$sql);
		
		$row = mysqli_fetch_array($run, MYSQLI_BOTH);
		$count = mysqli_num_rows($run);
		if($count==1)
		{
			$_SESSION['admin_id'] = $row['admin_id'];
			$_SESSION['group_id'] = $row['group_id'];
			$_SESSION['fullname'] = $row['fullname'];
			$_SESSION['username'] = $row['username'];
			
			 echo '<META HTTP-EQUIV="Refresh" Content="2; URL=admin_account/index.php">';    
			 exit;

		} else if($count==0) {
			$err = 'Invalid Username/Password';
			echo "<div class='alert alert-danger text-center' style='max-width:96%; margin: 4px auto'>";
				echo $err;
			echo "</div>";
		}
	} 
	else if($login_type == 'user') {
		$sql="SELECT * FROM user WHERE username='$username' and password='$password' and approved=1";
		$run = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($run, MYSQLI_BOTH);
		$count = mysqli_num_rows($run);
		if($count==1)
		{
			$_SESSION['user_id'] =  $row['user_id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['fullname'] = $row['firstname'] . " " . $row['lastname'];
			
			 echo '<META HTTP-EQUIV="Refresh" Content="1; URL=user_id_account/index.php">';    
			 exit;

		} else if($count==0) {
			$err = 'Invalid Username/Password';
			echo "<div class='alert alert-danger text-center' style='max-width:500px; margin: 4px auto'>";
				echo $err;
			echo "</div>";
		}
	} 
}
	?>
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">Login</h3></div>
				<div class="panel-body">
					<div class="form-group">
						<label for="loginType">Login Type</label>
						<select name="loginType" id="loginType" class="form-control">
							<option value="User">User</option>
							<option value="Admin" selected>Administrator</option>
						</select>
					</div>	
					
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" autofocus placeholder="Enter Username" required>
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
					</div>	
				</div>
				<div class="panel-footer">
					<div class="form-group">
						<button name="login" id="login" type="submit" class="btn btn-danger pull-right">
							Login
						</button><br>
					</div>
				</div>
			</div>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>
<?php include("footer.php") ?>