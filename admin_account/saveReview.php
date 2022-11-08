<?php include("header.inc.php") ?>
<h3>Save Your Review</h3>
<?php
if(isset($_POST['saveReview'])) {
	$admin_id = $admin_id;
	$review = $_POST['review'];
	$policy_id = $_POST['policy_id'];
	$policy_group_id = $_POST['policy_group_id'];

	$sql1 = "INSERT INTO policyReviews VALUES(NULL, '$review',1,NOW(),$policy_id, $admin_id, $policy_group_id)";
	$run1 = mysqli_query($link, $sql1);
	if($run1) {
		echo '<div class="alert alert-success" role="alert" style="max-width:500px;margin:10px auto;text-align:center">';
		echo "<p>تم إرسال مراجعتك بنجاح.</p>";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="1;PolicyDetails.php?policy_id=' . $policy_id . '">';
	}
}
?>
<?php include("footer.inc.php") ?>