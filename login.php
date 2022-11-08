<?php include("header.php") ?>
<div class="section_top">
	<div class="container ">
		<h1>تسجيل الدخول</h1>
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

		$sql="SELECT * FROM admin WHERE username='$username' and grade='Admin'";
		
		$run = mysqli_query($link,$sql);
		
		$row = mysqli_fetch_array($run, MYSQLI_BOTH);
		$count = mysqli_num_rows($run);
		if($count==1)
		{
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['group_id'] = $row['group_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['username'] = $row['username'];
				if($row['reset']==2){
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=reset.php?group=1">';   
				}else{
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=admin_account/index.php">';   
				}
                 
                 exit;
            } else {
                $err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
                echo "<div class='alert alert-danger text-center' style='max-width:96%; margin: 4px auto'>";
                    echo $err;
                echo "</div>";
            }
		} else {
			$err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
			echo "<div class='alert alert-danger text-center' style='max-width:96%; margin: 4px auto'>";
				echo $err;
			echo "</div>";
		}
	} 
	else if($login_type == 'Moderator') {
		$sql="SELECT * FROM moderator WHERE username='$username' ";
		$run = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($run, MYSQLI_BOTH);
		$count = mysqli_num_rows($run);
		if($count==1)
		{
            if (password_verify($password, $row['password'])) {
                $_SESSION['moderator_id'] =  $row['moderator_id'];
                $_SESSION['username'] = $row['username'];

                 echo '<META HTTP-EQUIV="Refresh" Content="1; URL=moderator_account/index.php">';    
                 exit;
            } else {
                $err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
                echo "<div class='alert alert-danger text-center' style='max-width:500px; margin: 4px auto'>";
                    echo $err;
                echo "</div>";
            }
		}else {
			$err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
			echo "<div class='alert alert-danger text-center' style='max-width:96%; margin: 4px auto'>";
				echo $err;
			echo "</div>";
		}
	} else if($login_type == 'Head') {
		$sql="SELECT * FROM admin WHERE username='$username' and grade='Head'";
		$run = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($run, MYSQLI_BOTH);
		$count = mysqli_num_rows($run);
		if($count==1)
		{
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] =  $row['admin_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['group_id'] = $row['group_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['grade'] = $row['grade'];

				if($row['reset']==2){
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=reset.php?group=2">';   
				}else{
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=head_account/index.php">';   
				}
                 exit;
            } else {
                $err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
			echo "<div class='alert alert-danger text-center' style='max-width:500px; margin: 4px auto'>";
				echo $err;
			echo "</div>";
            }

		} else {
			$err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
			echo "<div class='alert alert-danger text-center' style='max-width:96%; margin: 4px auto'>";
				echo $err;
			echo "</div>";
		}
	} else if($login_type == 'Executive') {
		$sql="SELECT * FROM admin WHERE username='$username' and grade='Executive'";
		$run = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($run, MYSQLI_BOTH);
		$count = mysqli_num_rows($run);
		if($count==1)
		{
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] =  $row['admin_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['group_id'] = $row['group_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['grade'] = $row['grade'];
				if($row['reset']==2){
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=reset.php?group=3">';   
				}else{
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=executive_account/index.php">';   
				}
                 exit;
            } else {
                $err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
                echo "<div class='alert alert-danger text-center' style='max-width:500px; margin: 4px auto'>";
                    echo $err;
                echo "</div>";
            }
		}else {
			$err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
			echo "<div class='alert alert-danger text-center' style='max-width:96%; margin: 4px auto'>";
				echo $err;
			echo "</div>";
		}
	} else if($login_type == 'Employee') {
		$sql="SELECT * FROM employee WHERE username='$username'";
		$run = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($run, MYSQLI_BOTH);
		$count = mysqli_num_rows($run);
		if($count==1)
		{
            if (password_verify($password, $row['password'])) {
                $_SESSION['employee_id'] =  $row['employee_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['group_id'] = $row['group_id'];
                $_SESSION['fullname'] = $row['fullname'];
				if($row['reset']==2){
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=reset.php?group=4">';   
				}else{
					echo '<META HTTP-EQUIV="Refresh" Content="2; URL=employee_account/index.php">';   
				}
                 exit;
            } else {
                $err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
                echo "<div class='alert alert-danger text-center' style='max-width:500px; margin: 4px auto'>";
                    echo $err;
                echo "</div>";
            }

		} else {
			$err = 'اسم المتسخدم / كلمة المرور غير صحيحة';
			echo "<div class='alert alert-danger text-center' style='max-width:96%; margin: 4px auto'>";
				echo $err;
			echo "</div>";
		}
	} 
}
	?>
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">تسجيل الدخول</h3></div>
				<div class="panel-body">
					<div class="form-group">
						<label for="loginType">نوع التسجيل</label>
						<select name="loginType" id="loginType" class="form-control" style="    padding: 4px 12px;">
							
							<option value="Admin" selected>رئيس</option>
                            <option value="Head">رئيس قسم</option>
							<option value="Executive">رئيس تنفيذي</option>
							<option value="Moderator">مشرف</option>
							<option value="Employee">موظف</option>
						</select>
					</div>	
					
					<div class="form-group">
						<label for="username">اسم المستخدم</label>
						<input type="text" name="username" id="username" class="form-control" autofocus placeholder="اسم المستخدم" oninput="this.setCustomValidity('')" required oninvalid="this.setCustomValidity('نسيت ادخال اسم المستخدم')">
					</div>

					<div class="form-group">
						<label for="password">كلمة المرور</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال كلمة المرور')">
					</div>	
				</div>
				<div class="panel-footer">
					<div class="form-group">
						<button name="login" id="login" type="submit" class="btn btn-danger pull-right">
							تسجيل الدخول
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