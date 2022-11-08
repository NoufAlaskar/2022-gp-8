<?php include("header.php") ?>
<?php
if(!isset($_GET['EID'])) {
	echo '<META HTTP-EQUIV="Refresh" Content="0;index.php">';
	exit();
}  else {
?>
<div class="container">
	<h1 class="text-center">فعل حسابك</h1>
        <?php 

	$EID = $_GET['EID'];
	$sql="SELECT * FROM employee WHERE employee_id='$EID' LIMIT 1";
	//echo $sql;
	$result= mysqli_query($link,$sql);
	$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	$count=mysqli_num_rows($result);
	if($count==1 and $row['active'] == 0)
	{
		//session_start();
		$sql="UPDATE employee SET active=1 WHERE employee_id='$EID' LIMIT 1";
		
		$result= mysqli_query($link,$sql);
		if($result) {
			echo '<div class="alert alert-success" role="alert" style="margin:10px auto;text-align:center">';
			echo "<span>Your account is activiting Now....";
			echo '</div>';
			echo '<META HTTP-EQUIV="Refresh" Content="2; URL=login.php">'; 
		}
		   

	} else if($count==0) {
		echo '<div class="alert alert-danger" role="alert" style="margin:10px auto;text-align:center">';
		echo "<span><b></b>Operation Failed</b> System Error... Please Contact With Website Moderator";
		echo '</div>';
		echo '<META HTTP-EQUIV="Refresh" Content="4; URL=index.php">';    
	} 

?>

    
</div>
<?php } include("footer.php") ?>
