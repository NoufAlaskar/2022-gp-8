<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
  		<div class="col-md-3"></div>
  
  		<div class="col-md-6"  style="margin-top: 30px;">
<?php 
// pass data of policy
$policy_id = $_GET['policy_id'];
if(isset($_POST['SendBtn']))
{
	// get data from form input
	$content = $_POST['content'];
	// add new violation data into table
	$sql="INSERT INTO violation VALUES (NULL,$policy_id ,$loggedIn_employee_id, '$content', NOW(), 1)";

	$run = mysqli_query($link,$sql);

	if($run){
// if execution is true/done then show ok msg
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p dir='rtl'>تم إرسال بلاغك الى الرئيس التنفيذي بنجاح.</p>";
		echo '</div>';
// redirect to index page to view policy
		echo '<META HTTP-EQUIV="Refresh" Content="2; URL=index.php">';    
		exit;
	} 
}

// write query to get policy data
$q4 = "SELECT * FROM policy WHERE policy_id={$policy_id} ";
$res4 = mysqli_query($link, $q4);
$row4 = mysqli_fetch_array($res4);
?>
  			<form method="post">
  				
  				
  			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center">التبليغ عن انتهاك السياسة</h3></div>
				<div class="panel-body">
					<div class="row">
					<div class="col-md-9">
						<div class="form-group">
							<label for="AdminName">عنوان السياسة</label>
							<input type="text" id="AdminName" disabled class="form-control" value="<?php echo $row4['title'] ?>" >
						</div>
					</div>
					<div class="col-md-3">
                            <div class="form-group">
                                
                                <label for="date">تاريخ التبليغ</label>
                                <input type="text" id="date" disabled class="form-control" value="<?php echo date('d/m/Y') ?>" >
                            </div>
                        </div>
					</div>
				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
                            <label for="date"> وصف المخالفة</label>
									<textarea id="content" autofocus class="form-control"  name="content" placeholder="وصف المخالفة" required rows="6"  oninput="this.setCustomValidity('')"  oninvalid="this.setCustomValidity('نسيت ادخال وصف التبيلغ')"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="myPolices.php" class="btn btn-sm btn-warning">عودة </a> 
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