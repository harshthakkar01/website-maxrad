<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listsampletypes.php");
	}
	$sid='';
	$sname='';
		
	$stypeid = filter_var($_POST["sampletype_id"], FILTER_SANITIZE_STRING);

	if(!empty($stypeid)){
		$query_string = "SELECT id, name FROM Sample_types WHERE id=$stypeid";
		//echo $query_string;
		$res = $mysqli->query($query_string);
		//echo "Query returned ".$res->num_rows." rows";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$sid=$datarow['id'];
		$sname=$datarow['name'];		
	}
?>

<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />


</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">


<form method="post" action="savesampletype.php">

Name : <input type="text" name="sampletype_name" value="<?php echo $sname; ?>"><br />
<input type="hidden" name="sampletype_id" value="<?php echo $sid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</body>
</html>
