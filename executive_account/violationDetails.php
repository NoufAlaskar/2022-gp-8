<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
  		<div class="col-md-3"></div>
  
  		<div class="col-md-6"  style="margin-top: 30px;">
          <?php 
$policy_id = $_GET['policy_id'];
$violation_id = $_GET['violation_id'];
if(isset($_POST['SendBtn']))
{
    // write query to change violation status to solved
    $sql="UPDATE violation SET v_status = 2 WHERE violation_id=$violation_id and policy_id=$policy_id";
// run the query
    $run = mysqli_query($link,$sql);

    if($run){
// if execution is true/done then show ok msg

        echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
        echo "<p>تم حل الابلاغ بنجاح.</p>";
        echo '</div>';
        // redirect to viewViolations to view data
        echo '<META HTTP-EQUIV="Refresh" Content="2; URL=viewViolations.php">';    
        exit;
    } 
}

    $q4 = "SELECT * FROM violation WHERE violation_id=$violation_id and policy_id={$policy_id} ";
    $res4 = mysqli_query($link, $q4);
    $row4 = mysqli_fetch_array($res4);
    $writtenEmpID = $row4['employee_id'];
    $v_status = $row4['v_status'];

    $q5 = "SELECT * FROM policy WHERE policy_id={$policy_id} ";
    $res5 = mysqli_query($link, $q5);
    $row5 = mysqli_fetch_array($res5);

    $q6 = "SELECT * FROM employee WHERE employee_id={$writtenEmpID} ";
    $res6 = mysqli_query($link, $q6);
    $row6 = mysqli_fetch_array($res6);
    $writtenGroupID = $row6['group_id'];

    $q7 = "SELECT * FROM policyGroup WHERE group_id={$writtenGroupID} ";
    $res7 = mysqli_query($link, $q7);
    $row7 = mysqli_fetch_array($res7);
    $GroupName = $row7['group_name'];
?>

  			<form method="post">
  				
  				
  			<div class="panel panel-danger">
				<div class="panel-heading"><h3 align="center"> تفاصيل البلاغ </h3></div>
				<div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="AdminName">عنوان السياسة</label>
                                <input type="text" id="AdminName" disabled class="form-control" value="<?php echo $row5['title'] ?>" >
                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    
                                    <label for="date">تاريخ التبليغ</label>
                                    <input type="text" id="date" disabled class="form-control" value="<?php echo $row4['violation_date'] ?>" >
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dept"> القسم</label>
                                <input type="text" id="dept" disabled class="form-control" value="<?php echo $GroupName ?>" >
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    
                                    <label for="writtenBy">كتبت بواسطة</label>
                                    <input type="text" id="writtenBy" disabled class="form-control" value="<?php echo $row6['fullname'] ?>" >
                                    <input type="hidden" name="violation_id" value="<?php echo $_GET['violation_id'] ?>" >
                                </div>
                        </div>
                    </div>
				
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
                            <label for="desc"> وصف المخالفة</label>
									<textarea id="desc" readonly class="form-control"  name="content" placeholder="وصف المخالفة"
                                     required rows="6"><?php echo $row4['violation_text'] ?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="viewViolations.php" class="btn btn-sm btn-warning pull-right">عودة </a> 
                    <?php if($v_status == 1) { ?>
					    <input type="submit" class="btn btn-sm btn-danger" name="SendBtn" value="تم الحل" >
                    <?php } if($v_status == 2) { ?>
                        <a href="#" class="btn btn-sm btn-danger disabled">تم الحل</a>
                    <?php } ?>
				</div>
			</div>
			</form>
  		</div>
  		<div class="col-md-3"></div>
  	</div>
    
  	</div>
  </div>
  
<?php include("footer.inc.php") ?>