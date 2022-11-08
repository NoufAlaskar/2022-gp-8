<?php include("header.inc.php") ?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php
if(isset($_POST['createBtn'])) {
	$group_id = $_POST['group_id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$current_password = $_POST['password'];
	$password = password_hash($_POST['password'],PASSWORD_DEFAULT);

     $sql1 = "select * from employee where username ='$username' or email='$email'";
    $run1 = mysqli_query($link,$sql1);
    $no = mysqli_num_rows($run1);
    if($no == 0) {
        $sql="INSERT INTO employee VALUES (NULL, '$name','$email', '$username', '$password',$group_id, $moderator_id,0,2)";

        $run = mysqli_query($link,$sql);

        if($run){
		
		$query55 = "SELECT MAX(employee_id) AS employee_id FROM employee";
		///echo $query55;
		$result55 = mysqli_query($link,$query55);
		$row55 = mysqli_fetch_array($result55);
		$employee_id = 0;
		///print_r($row55);
		if(is_null($row55['employee_id'])) {
			$employee_id = 1;
		} else {
			$employee_id = $row55['employee_id'];
		}
		
		//print("New employee_id : " + $employee_id);
		
		
         $to = $email;
         $subject = "Email Activation for Members";
         
         
         $message = "<h1>Just One More Step…</h1>";
         $message .= "<h2 align='center'>Welcome {$fullname}.</h2>";
		 $message .= "<p align='center'>Your Username : {$username}.</b>";
		 $message .= "<p align='center'>Your Password : {$current_password}.</b>";
		 $message .= "<p align='center'>Please Click on the button below to activate your account with us.</b>";
		 $message .= "<p align='center'><a href='http://www.siasatt.com/activateAccount.php?EID=" . $employee_id . "'>Activate Account</a></b>";
		
         $header = "From:info@siasatt.com\r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            
			echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
            echo "<p>تم حفظ حساب الموظف بنجاح.</p>";
            echo '</div>';
            echo '<META HTTP-EQUIV="Refresh" Content="1; URL=viewEmployees.php">';    
            exit;
			
         }else {
            echo '<div class="alert alert-danger text-center" role="alert" style="margin:10px auto;">';
			echo "<span>Something gone error...</span>";
			echo '</div>';
         }
            
        } 
    } else {
        echo '<div class="alert alert-danger" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
        echo "<p>الموظف موجود بالفعل في قاعدة البيانات.</p>";
        echo '</div>';
    }
	
	
}

?>
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">اضافة موظف جديد</h3></div>
				<div class="panel-body">
					<div class="form-group">
                        <label for="name">قسم الموظف</label>
                        <select  id="group_id" class="form-control"  name="group_id">
                        <?php
                            $sql2 = "select * from policyGroup ";
                            $result2 = mysqli_query($link, $sql2);
                            while($row2 = mysqli_fetch_array($result2)) {

                        ?>	
                            <option value="<?php echo $row2['group_id'] ?>">
                                <?php echo $row2['group_name'] ?>
                            </option>
                        <?php } ?>
                        </select>
                    </div>
					<div class="form-group">
						<label for="name">اسم الموظف</label>
						<input type="text" name="name" id="name" class="form-control" autofocus placeholder="اسم الموظف" required  oninvalid="this.setCustomValidity('نسيت ادخال اسم الموظف')" oninput="this.setCustomValidity('')">
					</div>
					<div class="form-group">
						<label for="email">البريد الالكتروني</label>
						<input type="email" name="email" id="email" class="form-control"  placeholder="اسم الموظف" required  oninvalid="this.setCustomValidity('نسيت ادخال البريد الالكتروني')" oninput="this.setCustomValidity('')">
					</div>
					<div class="form-group">
						<label for="username">اسم المستخدم</label>
						<input type="text" name="username" id="username" class="form-control" autofocus placeholder="اسم المستخدم" required  oninvalid="this.setCustomValidity('نسيت ادخال اسم المستخدم')" oninput="this.setCustomValidity('')">
					</div>

					<div class="form-group">
						<label for="password">كلمة المرور</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required  oninvalid="this.setCustomValidity('نسيت ادخال كلمة المرور')" oninput="this.setCustomValidity('')">
					</div>	
				</div>
				<div class="panel-footer">
					<div class="form-group">
						<button name="createBtn" id="createBtn" type="submit" class="btn btn-danger btn-sm pull-right" >
							انشاء حساب 
						</button><br>
					</div>
				</div>
			</div>
			</form>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<?php include("footer.inc.php") ?>