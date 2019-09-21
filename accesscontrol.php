<?php
	session_start();

	if(!isset($_SESSION['access_mode'])){
		header("Location: login.php");
	}
