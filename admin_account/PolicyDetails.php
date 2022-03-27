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
						echo "<p>No Policies Found.</p>";
					echo '</div>';
				} else {
					$row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
					$admin_owner_policy =$row1['admin_id'];
					$group_id = $policy_group_id =$row1['group_id'];
					
					if($group_id == 0) {
						$group_name = "General - All Departments";
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
				
				
				<h3>Policy Details <span class="pull-right" style="font-size: 16px;"><i class="fa fa-calendar"></i>  <?php echo $row1['publish_date'] ?></span></h3>
				<hr>
				<h4>Policy Title</h4>
				<p class="text-muted"><?php echo $row1['title'] ?></p>
				<hr>
				
				<?php
					$sql5 = "SELECT * FROM admin WHERE admin_id={$adminWritten}";
					$run5 = mysqli_query($link, $sql5);
					$row5 = mysqli_fetch_array($run5);
				?>
				<div class="row">
					<div class="col-md-6">
						<h4>Policy Group</h4>
						<p class="text-muted"><?php echo $group_name ?></p>
					</div>
					<div class="col-md-6">
						<h4>Written By:</h4>
						<p class="text-muted"><?php echo $row5['fullname'] ?></p>
						
					</div>
				</div>
				
				<hr>
				<h4>Policy Description</h4>
				<p class="text-muted"><?php echo nl2br($row1['description']); ?></p>
				<hr>
				<a href="index.php" class="btn btn-sm btn-warning pull-left" >Back</a> 
				
				<?php if($admin_id == $adminWritten) { ?>
				<a href="editPolicy.php?policy_id=<?php echo $row1['policy_id'] ?>" class="btn btn-sm btn-success pull-right">Edit Policy</a>  
				<?php } ?>
				<br>
			</div>

 <?php	
		}
	?>
  		</div>
		<div class="col-md-5"  style="margin-top: 30px;">
			<div class="well" style="background: #FFF;">
				<h3 style="border-bottom: 2px solid #DDD">Policy Reviews -  <span class="label label-primary pull-right" ><?php echo $no_reviews; ?> Reviews</span></h3></div>
			<div class="well" style="background: #FFF; max-height: 300px; overflow-y: scroll">
			<?php
				
			$sql3 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id} and admin_id={$admin_id} and group_id={$group_id}";
			$run3 = mysqli_query($link, $sql3);
			$count3 = mysqli_num_rows($run3);
			?>
			
			<?php if(($admin_id <> $adminWritten) and $count3 == 0) { ?>
				<div class="well">
					<form method="post" action="saveReview.php">
						<div class="form-group" style="margin-bottom: 0px;">
							<textarea class="form-control" name="review" id="review" required autofocus rows="2"></textarea>
							<input type="hidden" name="policy_id" value="<?php echo $policy_id ?>">
							<input type="hidden" name="policy_group_id" value="<?php echo $policy_group_id ?>">
							<button name="saveReview" type="submit" class="btn btn-default btn-block">
								Save Review
							</button>
						</div>
					</form>
				</div>
			<?php } ?>
				<?php
					$query4 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id}";
					$result4 = mysqli_query($link, $query4);
					$count4 = mysqli_num_rows($result4);
					if($count4 == 0) {
						echo '<div class="alert alert-danger" style="margin:10px auto;text-align:center">';
							echo "<p>There Is No Policy Reviews Found.</p>";
						echo '</div>';

					} else {
						while($row4 = mysqli_fetch_array($result4, MYSQLI_BOTH)) {
							$adminWritten = $row4['admin_id'];
								$sql6="SELECT * FROM admin WHERE admin_id=$adminWritten";
								$run6 = mysqli_query($link,$sql6);
								$row6 = mysqli_fetch_array($run6);
							?>
								<div class="media">
								  <div class="media-left">
									<i class="fa fa-user-circle fa-2x"></i>
								  </div>
								  <div class="media-body">
									<h4 class="media-heading"><?php echo $row6['fullname'] ?></h4>
									<p class="text-muted small text-justify"><?php echo $row4['comment'] ?></p>
								  </div>
								</div>
							<?php
						}
					}
				?>
			</div>
			
			<?php
				 $query4 = "SELECT * FROM policyReviews WHERE policy_id={$policy_id} AND group_id=$group_id";
				$result4 = mysqli_query($link, $query4);
				 $count4 = mysqli_num_rows($result4);	
				if ($count4 < 3) {
		?>
			
			<a href="ApprovePolicy.php?policy_id=<?php echo $row1['policy_id'] ?>" class="btn btn-sm btn-info  pull-right disabled"  style="margin-right: 10px;">Send Policy</a>
		
			<?php }else if ($row1['approved'] == 0 AND $count4 >=3 AND $loggedIn_admin_id==$admin_owner_policy) {?>
				<a href="ApprovePolicy.php?policy_id=<?php echo $row1['policy_id'] ?>" class="btn btn-sm btn-info  pull-right "  style="margin-right: 10px;">Send Policy</a>
			<?php } elseif ($row1['approved'] == 1 and $count4 >=3) { ?>
				<div class="alert alert-info clearfix"><span>Approved/Sent</span></div>
			<?php } ?>
		</div>
  	</div>
  	</div>
  </div>
  
<?php include("footer.inc.php") ?>