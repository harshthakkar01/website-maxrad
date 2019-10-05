<?php
	include('accessdb.php');
	include('accesscontrol.php');
	$tid='';
	$tdate='';
	$toperator='';
	$tmode='';
	$tsample='';
		
	$tid = filter_var($_POST["test_id"], FILTER_SANITIZE_STRING);

	if(!empty($oid)){
		//echo $query_string;
		$res = $mysqli->query($query_string);
		//echo "Query returned ".$res->num_rows." rows";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$tid=$datarow['id'];
		$tdate=$datarow['testdate'];
		$toperator=$datarow['operator_id'];
		$tmode=$datarow['test_mode_id'];
		$tsample=$datarow['sample_id'];
	}
?>

<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />

</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">

<form method="post" action="savetest.php">
<input type="hidden" name="test_id" value="<?php echo $tid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</body>
</html>
