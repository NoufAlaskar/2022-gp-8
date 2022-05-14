<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
  
  		<div class="col-md-7"  style="margin-top: 30px;">
            
			<div class="well" style="background: #FFF">
			<?php
				$policy_id = $_GET['policy_id'];
				$no_reviews = 0;
				$policy_group_id = 0;
				$query1 = "SELECT * FROM policy WHERE policy_id={$policy_id} ";
				
				$result1 = mysqli_query($link, $query1);
				$count = mysqli_num_rows($result1);
				if($count == 0) {
					echo '<div class="alert alert-danger " role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
						echo "<p>لم يتم العثور على سياسات.</p>";
					echo '</div>';
				} else {
					$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
					$admin_owner_policy =$row1['admin_id'];
					$group_id = $policy_group_id =$row1['group_id'];
					
					if($group_id == 0) {
						$group_name = "عام - جميع الاقسام";
					} else {
						 $sql0 = "SELECT * FROM policyGroup WHERE group_id={$group_id}";
						$run0 = mysqli_query($link, $sql0);
						$row0 = mysqli_fetch_array($run0);
						$group_name = $row0['group_name'];
					}
					
					
					$sql7 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id}";
					$run7 = mysqli_query($link, $sql7);
					$row7 = mysqli_fetch_array($run7);
					$no_reviews = mysqli_num_rows($run7);
					
					$adminWritten = $row1['admin_id'];
			?>	
				
				
				    <h3>تفاصيل السياسة <span class="pull-right" style="font-size: 16px;"><i class="fa fa-calendar"></i>  <?php echo $row1['publish_date'] ?></span></h3>
                
				<hr>
				<h4>عنوان السياسة</h4>
				<p class="text-muted"><?php echo $row1['title'] ?> <span class="label label-success">تم نشرها على الموظفين</span><br/></p>
				<hr>
				
				<?php
					$sql5 = "SELECT * FROM admin WHERE admin_id={$adminWritten}";
					$run5 = mysqli_query($link, $sql5);
					$row5 = mysqli_fetch_array($run5);
				?>
				<div class="row">
					<div class="col-md-6">
						<h4>مجموعة السياسة</h4>
						<p class="text-muted"><?php echo $group_name ?></p>
					</div>
					<div class="col-md-6">
						<h4>كتب بواسطة:</h4>
						<p class="text-muted"><?php echo $row5['fullname'] ?></p>
						
					</div>
				</div>
				
				<hr>
                <form method="post">
                    <input type="hidden" value="<?php echo strip_tags($row1['description']); ?>" class="form-control" name="data">
				<h4>وصف السياسة</h4>
				<p class="text-muted"><?php echo nl2br($row1['description']); ?></p>
                  
				<hr>
				<a href="index.php" class="btn btn-sm btn-warning pull-left" >رجوع</a> 
				
				<?php if($admin_id == $adminWritten) { ?>
				<a href="editPolicy.php?policy_id=<?php echo $row1['policy_id'] ?>" class="btn btn-sm btn-success pull-right">تحديث السياسة</a>  
				<?php } ?>
				<br>
			</div>

 <?php	
		}
	?>
  		</div>
		</div>
        <hr />
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="well">
<?php
if(isset($_POST['addExeReview'])) {
    ///echo "here";
	$review = $_POST['exeReview'];
	$policy_id = $_POST['policy_id'];
	$policy_group_id = $_POST['policy_group_id'];

	 $sql1 = "UPDATE policy SET extuctiveReview='$review', approvedByExtuctive=1 WHERE policy_id=$policy_id and group_id=$policy_group_id";
	$run1 = mysqli_query($link, $sql1);
	if($run1) {
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p>تم إرسال مراجعتك بنجاح.</p>";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1;PolicyDetails.php?policy_id=' . $policy_id . '">';
	}
}
if(is_null($row1['extuctiveReview'])) {
?>
            <form method="post">
                <h5 align="right">Executive Review</h5>
                <div class="form-group">
                    <textarea class="form-control" name="exeReview" rows="5" required placeholder="اضف مراجعة"></textarea>
                </div>
                <input type="hidden" name="policy_id" value="<?php echo $policy_id ?>">
                <input type="hidden" name="policy_group_id" value="<?php echo $policy_group_id ?>">
                <div class="form-group text-center">
                    <button type="submit" name="addExeReview" class="btn btn-sm btn-primary">حفظ المراجعة</button>
                </div>
            </form>
<?php } ?>
    
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
  	</div>
  </div>
<!--<script src="https://code.responsivevoice.org/responsivevoice.js?key=6fHWzLr6"></script>-->
<?php include("footer.inc.php") ?>