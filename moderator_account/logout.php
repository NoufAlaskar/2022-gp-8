<?php
	session_start();
	unset($_SESSION['moderator_id']);
	unset($_SESSION['username']);
	session_destroy();
	echo '<META HTTP-EQUIV="Refresh" Content="1;../index.php">';
	exit();
	
?>
