<?php 
	include("../assets/connect.php");
 	if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
	if(!isset($_SESSION['username'])) {
		echo '<meta http-equiv="refresh" content="0;url=../index.php" />';	
		exit();
	}
	
	$admin_id = $_SESSION['admin_id'];
	$loggedIn_admin_id = $_SESSION['admin_id'];
	$group_id = $_SESSION['group_id'];
	$fullname = $_SESSION['fullname'];
	$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin Account - <?php echo $fullname ?></title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="assets/css/myStyle.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><i class="fa fa-dashboard"></i> Admin Account - <?php echo $fullname ?></a>
    </div>
    <div>
      <ul class="nav navbar-nav ">
        <li><a href="writePolicy.php">Write New Policy</a></li>
        <li><a href="MyPolicies.php">Policy Under Review</a></li>
        <li><a href="PolicyToBeReviewed.php">To Be Reviewed</a></li>
        <li><a href="PolicyHistory.php">Policy History</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
		  <li><a href="changePassword.php">Change Password</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      
    </div>
  </div>
</nav>
    <div class="clearfix"></div>
    
   <div class="container">