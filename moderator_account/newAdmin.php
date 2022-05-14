<?php include("header.inc.php") ?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php
if(isset($_POST['createBtn'])) {
	$grade = $_POST['grade'];
	$group_id = $_POST['group_id'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];

    $sql1 = "select * from admin where username ='$username'";
    $run1 = mysqli_query($link,$sql1);
    $no = mysqli_num_rows($run1);
    if($no== 0) {
    
        $sql="INSERT INTO  admin VALUES (NULL, '$grade','$name', '$username', '$password',$group_id,'$email', $moderator_id)";

        $run = mysqli_query($link,$sql);

        if($run){
            echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
            echo "<p>تم اضافة رئيس جديد</p>";
            echo '</div>';
            echo '<META HTTP-EQUIV="Refresh" Content="1; URL=viewAdmins.php">';    
            exit;
        } 
    } else {
        echo '<div class="alert alert-danger" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
        echo "<p>الرئيس موجود بالفعل</p>";
        echo '</div>';
    }
	
}

?>
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">اضافة رئيس جديد</h3></div>
                
				<div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">الفئة</label>
                            <select id="grade" class="form-control"  name="grade">
                                <option value="Admin" selected>رئيس مباشر</option>
                                <option value="Head">رئيس قسم</option>
                                <option value="Executive">رئيس تنفيذي</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">قسم الرئيس</label>
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
                        </div>
                    </div>
					
					<div class="form-group">
						<label for="name">اسم الرئيس</label>
						<input type="text" name="name" id="name" class="form-control" autofocus placeholder="اسم الرئيس" required>
					</div>
                    <div class="form-group">
						<label for="email">البريد الالكتروني</label>
						<input type="email" name="email" id="email" class="form-control" autofocus placeholder="البريد الالكتروني" required>
					</div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">اسم المستخدم</label>
                                <input type="text" name="username" id="username" class="form-control" autofocus placeholder="اسم المستخدم" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">كلمة المرور</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required>
                            </div>	
                        </div>
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