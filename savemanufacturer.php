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
	
	$mid = filter_var($_POST["manufacturer_id"], FILTER_SANITIZE_STRING);
	$mname = filter_var($_POST["manufacturer_name"], FILTER_SANITIZE_STRING);
	$mwebsite = filter_var($_POST["manufacturer_website"], FILTER_SANITIZE_URL);

	
	if(empty($mid)){
		$statement = $mysqli->prepare("INSERT INTO Manufacturers (name, website) VALUES(?, ?)");
		$statement->bind_param('ss', $mname, $mwebsite);
	
		if($statement->execute()){
			print "Manufacturer has been created";		
		} else {
			print $mysqli->error;
		}
	} else {
		$statement = $mysqli->prepare("UPDATE Manufacturers SET name = ?, website = ? WHERE Manufacturers.id = ?");
		$statement->bind_param('ssi', $mname, $mwebsite, $mid);
		if($statement->execute()){
			print "Manufacturer has been updated";		
		} else {
			print $mysqli->error;
		}
	}
	
?>

</div>


</body>
</html>
	