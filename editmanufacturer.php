<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listmanufacturers.php");
	}
	$mid='';
	$mname='';
	$mwebsite='';
	
	$manufacturerid = filter_var($_POST["manufacturer_id"], FILTER_SANITIZE_STRING);

	if(!empty($manufacturerid)){
		$query_string = "SELECT id, name, website FROM Manufacturers WHERE id=$manufacturerid";
		//echo $query_string;
		$res = $mysqli->query($query_string);
		//echo "Query returned ".$res->num_rows." rows";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$mid=$datarow['id'];
		$mname=$datarow['name'];
		$mwebsite=$datarow['website'];
		
	}
?>

<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />


</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">
<form method="post" action="savemanufacturer.php">

Name : <input type="text" name="manufacturer_name" value="<?php echo $mname; ?>"><br />
Website: <input type="text" name="manufacturer_website" value="<?php echo $mwebsite; ?>"><br />
<input type="hidden" name="manufacturer_id" value="<?php echo $mid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</html>
