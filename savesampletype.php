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
	
	$sid = filter_var($_POST["sampletype_id"], FILTER_SANITIZE_STRING);
	$sname = filter_var($_POST["sampletype_name"], FILTER_SANITIZE_STRING);

	if(empty($sid)){
		$statement = $mysqli->prepare("INSERT INTO Sample_types (name) VALUES(?)");
		$statement->bind_param('s', $sname);
	
		if($statement->execute()){
			print "Sample type has been created";		
		} else {
			print $mysqli->error;
		}
	} else {
		$statement = $mysqli->prepare("UPDATE Sample_types SET name = ? WHERE Sample_types.id = ?");
		$statement->bind_param('si', $sname, $sid);
		if($statement->execute()){
			print "Sample type has been updated";		
		} else {
			print $mysqli->error;
		}
	}
	
?>
</div>
</body>
</html>