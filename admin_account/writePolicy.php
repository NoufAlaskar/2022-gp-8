<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
  		<div class="col-md-3"></div>
  
  		<div class="col-md-6"  style="margin-top: 30px;">
<?php 
if(isset($_POST['SendBtn']))
{
	$group_id = $_POST['group_id'];
	$subject = $_POST['subject'];
	$content = $_POST['content'];
	$admin_id = $_SESSION['admin_id'];

	$sql="INSERT INTO policy VALUES (NULL, '$subject', '$content', NOW(), $admin_id,$group_id,0,0,NULL,0,0,NULL,0)";

	$run = mysqli_query($link,$sql);

	if($run){
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p>تم إرسال سياستك بنجاح</p>";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=MyPolicies.php">';    
		exit;
	} 
}

?>
  			<form method="post">
  				
  				
  			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">كتابة سياسة جديدة</h3></div>
				<div class="panel-body">
					<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="AdminName">الاسم الكامل للمدير</label>
							<input type="text" id="AdminName" disabled class="form-control" value="<?php echo $username ?>" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							
							<label for="date">تاريخ كتابة السياسة</label>
							<input type="text" id="date" disabled class="form-control" value="<?php echo date('d/m/Y') ?>" >
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<select  id="group_id" class="form-control"  name="group_id">
									<option value="0">عام - جميع الاقسام</option>
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
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" id="subject" class="form-control" autofocus name="subject" placeholder="عنوان السياسة" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								
									<textarea id="content" class="form-control"  name="content" placeholder="وصف السياسة" required rows="6"></textarea>
							
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="index.php" class="btn btn-sm btn-warning">رجوع </a> 
					<input type="submit" class="btn btn-sm btn-danger pull-right" name="SendBtn" value="ارسل الان" >
				</div>
			</div>
			</form>
  		</div>
  		<div class="col-md-3"></div>
  	</div>
  	</div>
  </div>
  
<?php include("footer.inc.php") ?>