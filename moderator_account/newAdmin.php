<?php include("header.inc.php") ?>

<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php
if(isset($_POST['createBtn'])) {
	$grade = $_POST['grade'];
    if($grade=="Executive") {
        $group_id = 0;
    } else {
       $group_id = $_POST['group_id'];
    }
	
   
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
	$email = $_POST['email'];

    $check1 = 0;
    $check2 = 0;
    $sql1 = "select * from admin where (username ='$username' Or email='$email')";
    $run1 = mysqli_query($link,$sql1);
    $check1 = mysqli_num_rows($run1);
    if($check1== 0) {
    
        $sql="INSERT INTO  admin VALUES (NULL, '$grade','$name', '$username', '$password',$group_id,'$email', $moderator_id,2)";

        $run = mysqli_query($link,$sql);

        if($run){
            echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
            echo "<p>تم حفظ حساب المسؤول بنجاح.</p>";
            echo '</div>';
            echo '<META HTTP-EQUIV="Refresh" Content="1; URL=viewAdmins.php">';    
            exit;
        } 
    } else {
        echo '<div class="alert alert-danger" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
        echo "<p>اسم المستخدم او البريد الالكتروني مستخدم مسبقا ً</p>";
        echo '</div>';
    }
	
}

?>
			<form method="post">
			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">اضافة رئيس جديد</h3></div>
<script>
    
function toggleGroupId() {
    var group_id = document.getElementById("group_id").value;
    var grade = document.getElementById("grade").value;
    var dept = document.getElementById("dept");
    if(grade == "Executive") {
       dept.style.display = "none";
    } else {
        dept.style.display = "block";
    }
}            
</script>            
				<div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">فئة</label>
                            <select id="grade" class="form-control"  name="grade" onchange = "toggleGroupId()">
                                <option value="Admin" selected>رئيس</option>
                                <option value="Head">رئيس قسم</option>
                <?php
                    $sql5 = "select * from admin where grade ='Executive'";
                    $run5 = mysqli_query($link,$sql5);
                    $no5 = mysqli_num_rows($run5);
                    if($no5 == 1) {
                        echo '<option value="Executive" disabled>Executive</option>';
                    } else {
                        echo '<option value="Executive">Executive</option>';
                    }
                ?>
                                
                            </select>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="dept">
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
						<label for="name">اسم الادمن</label>
						<input type="text" name="name" id="name" class="form-control" autofocus placeholder="اسم الادمن" required  oninvalid="this.setCustomValidity('نسيت ادخال اسم الادمن')" oninput="this.setCustomValidity('')">
					</div>
                    <div class="form-group">
						<label for="email">البريد الالكتروني</label>
						<input type="email" name="email" id="email" class="form-control" autofocus placeholder="البريد الالكتروني" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال البريد الالكتروني')">
					</div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">اسم المستخدم</label>
                            <input type="text" name="username" id="username" class="form-control" autofocus placeholder="اسم المستخدم" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال اسم المستخدم')">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">كلمة المرور</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="كلمة المرور" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('نسيت ادخال كلمة المرور')">
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