<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listcategories.php");
	}
	$cid='';
	$cname='';
		
	$categoryid = filter_var($_POST["category_id"], FILTER_SANITIZE_STRING);

	if(!empty($categoryid)){
		$query_string = "SELECT id, name FROM Categories WHERE id=$categoryid";
		echo $query_string;
		$res = $mysqli->query($query_string);
		//echo "Query returned ".$res->num_rows." rows";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$cid=$datarow['id'];
		$cname=$datarow['name'];		
	}
?>

<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />

</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">

<form method="post" action="savecategory.php">
Name : <input type="text" name="category_name" value="<?php echo $cname; ?>"><br />
<input type="hidden" name="category_id" value="<?php echo $cid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</body>
</html>
