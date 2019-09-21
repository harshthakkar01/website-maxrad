<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listsamples.php");
	}
	$sid='';
	$sname='';
	$smaterialid='';
	$ssampletype='';
	$sprovider='';
	
	$sid = filter_var($_POST["sample_id"], FILTER_SANITIZE_STRING);

	if(!empty($sid)){
		$query_string = "SELECT id, name, provider_id, material_id, sampletype_id FROM Samples WHERE id=$sid";
		//echo $query_string;
		$res = $mysqli->query($query_string);
		//echo "Query returned ".$res->num_rows." rows";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$sid=$datarow['id'];
		$sname=$datarow['name'];
		$smaterialid=$datarow['material_id'];
		$sprovider=$datarow['provider_id'];
		$ssampletype=$datarow['sampletype_id'];
	}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />
</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">
<form method="post" action="savesample.php">
Name : <input type="text" name="sample_name" value="<?php echo $sname; ?>"><br />
<br>
Sample type:
<select name="sample_type" id="sample_type">
<?php
	$query_string = "SELECT id, name FROM Sample_types";
	$res = $mysqli->query($query_string);
	//echo "There are ".$res->num_rows." records\r\n";
	for($i=0; $i<$res->num_rows; $i++){
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t";
		echo '<option ';
		if(!empty($ssampletype) && $ssampletype == $datarow['id']) echo 'selected ';
		echo 'value="'.$datarow['id'].'">'.$datarow['name'].'</option>';
		echo "\r\n";
	}

?>
</select>

<br>
Material: 
<select name="material" id="material">
<?php
	$query_string = "SELECT mat.id AS mid, mat.name AS mname, man.name AS mfname FROM Materials AS mat INNER JOIN Manufacturers AS man ON mat.manufacturer_id=man.id";
	$res = $mysqli->query($query_string);
	for($i=0; $i<$res->num_rows; $i++){
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t";
		echo '<option ';
		if(!empty($smaterialid) && $smaterialid == $datarow['mid']) echo 'selected ';
		echo 'value="'.$datarow['mid'].'">'.$datarow['mfname'].' '.$datarow['mname'].'</option>';
		echo "\r\n";
	}

?>
</select>

<br>

Provider: 
<select name="provider" id="provider">
<?php
	$query_string = "SELECT id, name FROM Providers";
	$res = $mysqli->query($query_string);
	for($i=0; $i<$res->num_rows; $i++){
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t";
		echo '<option ';
		if(!empty($sprovider) && $sprovider == $datarow['id']) echo 'selected ';
		echo 'value="'.$datarow['id'].'">'.$datarow['name'].'</option>';
		echo "\r\n";
	}

?>
</select>

<br>

<input type="hidden" name="sample_id" value="<?php echo $mid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</body>
</html>
