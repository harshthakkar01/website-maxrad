<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listoperators.php");
	}
	$oid='';
	$oname='';
		
	$oid = filter_var($_POST["operator_id"], FILTER_SANITIZE_STRING);

	if(!empty($oid)){
		echo "Query returned ".$res->num_rows." rows";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$oid=$datarow['id'];
		$oname=$datarow['name'];		
	}
?>

<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />

</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">

<form method="post" action="saveoperator.php">
Name : <input type="text" name="operator_name" value="<?php echo $oname; ?>"><br />
<input type="hidden" name="operator_id" value="<?php echo $oid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</body>
</html>
