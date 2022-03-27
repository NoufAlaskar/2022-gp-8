<?php 
require("assets/connect.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>E-Policy Management System</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="assets/css/myStyle.css" rel="stylesheet" type="text/css">
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
</head>
<body>


<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header text-center" style="background: #FFF;">
      <a class="navbar-brand" href="index.php">
		<img src="assets/imgs/logo.png" style="height: 100px; width: 100px;">
	  </a>
    </div>
    <div class="collapse navbar-collapse" id="nav1">
      <ul class="nav navbar-nav navbar-right">
        <li class="active">
			<a href="index.php"><i class="fa fa-home"></i> Home</a>
		</li>
        <li>
			<a href="createNewAccount.php"><i class="fa fa-user-plus"></i> Create Account</a>
		</li>
        <li><a href="login.php"><i class="fa fa-sign-in"></i> Login</a></li>
        <li><a href="about.php"><i class="fa fa-pencil"></i> About Us</a></li>
        <li><a href="contact.php"><i class="fa fa-phone"></i> Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="clearfix"></div>
  <div class="content">

