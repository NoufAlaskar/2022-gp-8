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
	$password = $_POST['password'];

     $sql1 = "select * from employee where username ='$username'";
    $run1 = mysqli_query($link,$sql1);
    $no = mysqli_num_rows($run1);
    if($no == 0) {
        $sql="INSERT INTO employee VALUES (NULL, '$name','$email', '$username', '$password',$group_id, $moderator_id)";

        $run = mysqli_query($link,$sql);

        if($run){
            echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
            echo "<p>تم اضافة الموظف بنجاح</p>";
            echo '</div>';
            echo '<META HTTP-EQUIV="Refresh" Content="1; URL=viewEmployees.php">';    
            exit;
        } 
    } else {
        echo '<div class="alert alert-danger" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
        echo "<p>الموظف موجود بالفعل</p>";
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
						<input type="text" name="name" id="name" class="form-control" autofocus placeholder="اسم الموظف" required>
					</div>
					<div class="form-group">
						<label for="email">البريد الالكتروني</label>
						<input type="email" name="email" id="email" class="form-control"  placeholder="ايميل الموظف" required>
					</div>
					<div class="form-group">
						<label for="username">اسم المستخدم</label>
						<input type="text" name="username" id="username" class="form-control" autofocus placeholder="اسم المستخدم" required>
					</div>

					<div class="form-group">
						<label for="password">كلمة المرور</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required>
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