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
	
	$sid = filter_var($_POST["sample_id"], FILTER_SANITIZE_STRING);
	$sname = filter_var($_POST["sample_name"], FILTER_SANITIZE_STRING);
	$materialid = filter_var($_POST["material"], FILTER_SANITIZE_STRING);
	$providerid = filter_var($_POST["provider"], FILTER_SANITIZE_STRING);
	$sampletypeid = filter_var($_POST["sample_type"], FILTER_SANITIZE_STRING);
	
	if(empty($sid)){
		$statement = $mysqli->prepare("INSERT INTO Samples (name, material_id, provider_id, sampletype_id) VALUES(?, ?, ?, ?)");
		$statement->bind_param('siii', $sname, $materialid, $providerid, $sampletypeid);
	
		if($statement->execute()){
			print "Sample has been created";		
		} else {
			print $mysqli->error;
		}
	} else {
		$statement = $mysqli->prepare("UPDATE Samples SET name = ?, material_id = ?, provider_id = ?, sampletype_id = ? WHERE Samples.id = ?");
		$statement->bind_param('siiii', $sname, $materialid, $providerid, $sampletypeid, $sid);
		if($statement->execute()){
			print "Sample has been updated";		
		} else {
			print $mysqli->error;
		}
	}
	
?>
</div>
</body>
</html>
