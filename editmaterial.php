

<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listmaterials.php");
	}
	$mid='';
	$manufacturerid='';
	$mname='';
	$mcategory='';
	$mdatasheet='';
	
	$materialid = filter_var($_POST["material_id"], FILTER_SANITIZE_STRING);

	if(!empty($materialid)){
		$query_string = "SELECT id, name, manufacturer_id, category_id, datasheet FROM Materials WHERE id=$materialid";
		//echo $query_string;
		$res = $mysqli->query($query_string);
		//echo "Query returned ".$res->num_rows." rows";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$mid=$datarow['id'];
		$mname=$datarow['name'];
		$manufacturerid=$datarow['manufacturer_id'];
		$mcategory=$datarow['category_id'];
		//echo "category_id is ".$mcategory;

		$mdatasheet=$datarow['datasheet'];
		
	}
?>

<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />


</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">
<form method="post" action="savematerial.php">

<br>
Manufacturer
<select name="manufacturer" id="manufacturer">
<?php
	$query_string = "SELECT id, name FROM Manufacturers";
	$res = $mysqli->query($query_string);
	//echo "There are ".$res->num_rows." records\r\n";
	for($i=0; $i<$res->num_rows; $i++){
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t";
		echo '<option ';
		if(!empty($manufacturerid) && $manufacturerid == $datarow['id']) echo 'selected ';
		echo 'value="'.$datarow['id'].'">'.$datarow['name'].'</option>';
		echo "\r\n";
	}

?>
</select>

<br>
Material category: 
<select name="category" id="category">
<?php
	$query_string = "SELECT id, name FROM Categories";
	$res = $mysqli->query($query_string);
	//echo "There are ".$res->num_rows." records\r\n";
	for($i=0; $i<$res->num_rows; $i++){
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t";
		echo '<option ';
		if(!empty($mcategory) && $mcategory == $datarow['id']) echo 'selected ';
		echo 'value="'.$datarow['id'].'">'.$datarow['name'].'</option>';
		echo "\r\n";
	}

?>
</select>

<br>

Name : <input type="text" name="material_name" value="<?php echo $mname; ?>"><br />
Datasheet: <input type="text" name="material_datasheet" value="<?php echo $mdatasheet; ?>"><br />
<input type="hidden" name="material_id" value="<?php echo $mid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</body>
</html>
