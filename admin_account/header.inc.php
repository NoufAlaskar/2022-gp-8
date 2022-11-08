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
    <title>حساب الرئيس - <?php echo $fullname ?></title>
    <link href="../assets/css/bootstrap-arabic.min.css" rel="stylesheet" type="text/css">
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
      <a class="navbar-brand" href="index.php"><i class="fa fa-dashboard"></i> حساب الرئيس - <?php echo $fullname ?></a>
    </div>
    <div>
      <ul class="nav navbar-nav ">
        <li><a href="writePolicy.php">كتابة سياسة جديدة</a></li>
        <li><a href="PublishedPolicies.php">سياساتي</a></li>
        <li><a href="MyPolicies.php">السياسات المرسلة للمراجعة</a></li>
        <li><a href="PolicyToBeReviewed.php">السياسات الواردة للمراجعة</a></li>
        <li><a href="PoliciesArchive.php">الارشيف</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		  <li><a href="changePassword.php">تغيير كلمة المرور</a></li>
        <li><a href="logout.php">تسجيل خروج</a></li>
      </ul>
      
    </div>
  </div>
</nav>
    <div class="clearfix"></div>
    
   <div class="container">