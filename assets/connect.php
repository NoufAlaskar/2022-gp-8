<?php
	session_start();
	error_reporting(E_ALL);
	global $link;
	$link = mysqli_connect("localhost","root","root","policyDB") or die('Failed Connecting Database Server');
	//$link = mysqli_connect("localhost","siasatt_user","Kg#6DqHj@~}O","siasatt_db") or die('Failed Connecting Database Server');
	mysqli_query($link,"SET character_set_results = 'utf8',SET character_set_client = 'utf8',SET character_set_connection = 'utf8',SET character_set_database = 'utf8',SET character_set_server = 'utf8'");

?>
