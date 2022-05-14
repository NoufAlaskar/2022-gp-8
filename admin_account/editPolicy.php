<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
  		<div class="col-md-3"></div>
  
  		<div class="col-md-6"  style="margin-top: 30px;">
<?php 
	$policy_id = $_GET['policy_id'];
if(isset($_POST['SendBtn']))
{
	$subject = $_POST['subject'];
	$content = $_POST['content'];
	$admin_id = $_SESSION['admin_id'];
	$group_id = $_POST['group_id'];

	 $sql="UPDATE policy SET title='$subject', description='$content', publish_date=NOW(),group_id=$group_id WHERE policy_id={$policy_id}";

	$run = mysqli_query($link,$sql);

	if($run){
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p>تم تحديث سياستك بنجاح.</p>";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1; URL=PolicyDetails.php?policy_id='  .$policy_id . '">';    
		exit;
	} 
}

?>
  			<form method="post">
  				
 <?php
	$query1 = "SELECT * FROM policy WHERE admin_id={$admin_id} AND policy_id={$policy_id}";
	#echo $query1;
	$result1 = mysqli_query($link, $query1);
	$count = mysqli_num_rows($result1);
	if($count == 0) {
		echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
			echo "<p>لم يتم العثور على سياسات.</p>";
		echo '</div>';
	} else {
		$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
?> 				
  			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">تحديث السياسة</h3></div>
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
								<input type="text" id="date" disabled class="form-control" value="<?php echo $row1['publish_date'] ?>" >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="group_id">اسم المجموعة</label>
								<select name="group_id"  class="form-control">
									<option value="0" <?php if($row1['group_id'] == 0) echo " selected "?>>General - All Departments</option>
									<?php
										$sql2 = "select * from policyGroup where  group_id=$group_id";
										$result2 = mysqli_query($link, $sql2);
										while($row2 = mysqli_fetch_array($result2)) {

									?>	
										<option value="<?php echo $row2['group_id'] ?>" <?php if($row1['group_id'] == $row2['group_id']) echo " selected "?>>
											<?php echo $row2['group_name'] ?>
										</option>
									<?php } ?>
									</select>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" id="subject" class="form-control" autofocus name="subject" placeholder="عنوان السياسة" required value="<?php echo $row1['title'] ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<textarea id="content" class="form-control"  name="content" placeholder="وصف السياسة" required rows="6"><?php echo $row1['description'] ?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="PolicyDetails.php?policy_id=<?php echo $policy_id ?>" class="btn btn-sm btn-warning">رجوع </a> 
					<input type="submit" class="btn btn-sm btn-danger pull-right" name="SendBtn" value="تحديث السياسة" >
				</div>
			</div>
 <?php	
		}
	?>
			</form>
  		</div>
  		<div class="col-md-3"></div>
  	</div>
  	</div>
  </div>
  
<?php include("footer.inc.php") ?>