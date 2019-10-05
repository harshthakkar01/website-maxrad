<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />


</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent"><?php
	include('accessdb.php');
	include('accesscontrol.php');
	
	$mid = filter_var($_POST["material_id"], FILTER_SANITIZE_STRING);
	$mname = filter_var($_POST["material_name"], FILTER_SANITIZE_STRING);
	$manufacturerid = filter_var($_POST["manufacturer"], FILTER_SANITIZE_STRING);
	$categoryid = filter_var($_POST["category"], FILTER_SANITIZE_STRING);
	$mdatasheet = filter_var($_POST["material_datasheet"], FILTER_SANITIZE_STRING);
	
	if(empty($mid)){
		
		if($statement->execute()){
			print "Material has been created";		
		} else {
			print $mysqli->error;
		}
	} else {
		if($statement->execute()){
			print "Material has been updated";		
		} else {
			print $mysqli->error;
		}
	}
	
?>
</div>
</body>
	
