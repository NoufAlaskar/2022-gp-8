<?php include("header.inc.php"); ?>

<h3><i class="fa fa-user-circle-o"></i> Administrator Profile</h3>
<div class="row">
	<div class="col-md-2">
		<div class="well text-center">
			<a href="writePolicy.php">
				<h2><i class="fa fa-plus-circle"></i></h2>
				<h5>Write New Policy</h5>
			</a>
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="well text-center">
			<a href="MyPolicies.php">
				<h2><i class="fa fa-edit"></i></h2>
				<h5>Policy Under Review</h5>
			</a>
		</div>
	</div>
	<div class="col-md-2">
		<div class="well text-center">
			<a href="PolicyToBeReviewed.php">
				<h2><i class="fa fa-eye-slash"></i></h2>
				<h5>To Be Reviewed</h5>
			</a>
		</div>
	</div>
	<div class="col-md-2">
		<div class="well text-center">
			<a href="PolicyHistory.php">
				<h2><i class="fa fa-check-circle"></i></h2>
				<h5>Policy History</h5>
			</a>
		</div>
	</div>
	<div class="col-md-2">
		<div class="well text-center">
			<a href="changePassword.php">
				<h2><i class="fa fa-lock"></i></h2>
				<h5>Change Password</h5>
			</a>
		</div>
	</div>
	<div class="col-md-2">
		<div class="well text-center">
			<a href="logout.php">
				<h2><i class="fa fa-sign-out"></i></h2>
				<h5>Logout</h5>
			</a>
		</div>
	</div>

</div>

<?php include("footer.inc.php"); ?>