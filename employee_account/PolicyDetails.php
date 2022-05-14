<?php include("header.inc.php") ?>

  <div class="container">
  	<div class="main ">
  		<div class="row">
            <div class="col-md-2"></div>
  		    <div class="col-md-8"  style="margin-top: 30px;">
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
				<p class="text-muted"><?php echo $row1['title'] ?></p>
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
				<?php
                        $sql6 = "SELECT * FROM policyReaded WHERE policy_id={$policy_id} and employee_id=$employee_id";
						$run6 = mysqli_query($link, $sql6);
                        $no6 = mysqli_num_rows($run6);
                        $row6 = mysqli_fetch_array($run6);
                        if($row6['acknowledge'] == 0) {
                            ?>
                            <a href="acknowledgePolicy.php?policy_id=<?php echo $policy_id ?>" class="btn btn-sm btn-primary pull-right" >أوافق</a> 
                            <?php
                        } else { ?>
                            <span class="label label-info pull-right"><i class="fa fa-check"></i> تم الموافقة  </span>
                        <?php } ?>
				<br>
			</div>

 <?php	
		}
	?>
  		</div>
             <div class="col-md-2"></div>
		</div>
  	</div>
  </div>
<!--<script src="https://code.responsivevoice.org/responsivevoice.js?key=6fHWzLr6"></script>-->
<?php include("footer.inc.php") ?>