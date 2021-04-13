<?php
	//logout.php
	session_start();
	if (isset($_SESSION['id'])) {
		# code...
		session_destroy();
		header("location: login.php");
		exit();
	}
?>