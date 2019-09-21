<?php

	include('accessdb.php');

	session_start();

	$uname = $_POST['user_name'];
	$upwd = $_POST['user_pwd'];

	if(empty($uname) || empty($upwd)){
		die('Empty user name or password');
	}

	$query_string = "SELECT al.login, al.password, atp.access_type FROM access_list AS al INNER JOIN access_types AS atp ON al.access_type=atp.id WHERE al.login = '$uname' AND al.password = '$upwd' ";

	$res = $mysqli->query($query_string);
	
	if(!$res){
		die('Internal execution error');
	}
	
	if($res->num_rows>0){
		echo "Login successful";
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$_SESSION['access_mode'] = $datarow['access_type'];			
		header("Location: home.php");
			
	} else {
		echo "Login failure";
	}
	

	
