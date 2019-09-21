<?php

	$mysql_host="localhost";
	$mysql_username = "runningscrat";
	$mysql_password = "carpathia";
	$mysql_database = "testdb";

	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

	if($mysqli->connect_error){
		die('Error : ('. $mysqli->connect_errno .') ' . $mysqli->connect_error);		
	}