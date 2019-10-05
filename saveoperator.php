<html>

<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />


</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">

<?php
	include('accessdb.php');
	include('accesscontrol.php');
	
	$oid = filter_var($_POST["operator_id"], FILTER_SANITIZE_STRING);
	$oname = filter_var($_POST["operator_name"], FILTER_SANITIZE_STRING);

	if(empty($oid)){
		
		if($statement->execute()){
			print "Operator has been created";		
		} else {
			print $mysqli->error;
		}
	} else {
		if($statement->execute()){
			print "Operator has been updated";		
		} else {
			print $mysqli->error;
		}
	}
	
?>
</div>


</body>
</html>

	
