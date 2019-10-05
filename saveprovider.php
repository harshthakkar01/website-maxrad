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
	
	$pid = filter_var($_POST["provider_id"], FILTER_SANITIZE_STRING);
	$pname = filter_var($_POST["provider_name"], FILTER_SANITIZE_STRING);
	$pcontact = filter_var($_POST["provider_contact"], FILTER_SANITIZE_STRING);
	$pemail = filter_var($_POST["provider_email"], FILTER_SANITIZE_STRING);
	$paddress = filter_var($_POST["provider_address"], FILTER_SANITIZE_STRING);
	$ptelephone = filter_var($_POST["provider_telephone"], FILTER_SANITIZE_STRING);
	
	if(empty($pid)){
		
		if($statement->execute()){
			print "Provider has been created";		
		} else {
			print $mysqli->error;
		}
	} else {
		if($statement->execute()){
			print "Provider has been updated";		
		} else {
			print $mysqli->error;
		}
	}
	
?>

</div>


</body>
</html>

	
