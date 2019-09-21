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
	
	$cid = filter_var($_POST["category_id"], FILTER_SANITIZE_STRING);
	$cname = filter_var($_POST["category_name"], FILTER_SANITIZE_STRING);

	if(empty($cid)){
		$statement = $mysqli->prepare("INSERT INTO Categories (name) VALUES(?)");
		$statement->bind_param('s', $cname);
	
		if($statement->execute()){
			print "Category has been created";		
		} else {
			print $mysqli->error;
		}
	} else {
		$statement = $mysqli->prepare("UPDATE Categories SET name = ? WHERE Categories.id = ?");
		$statement->bind_param('si', $cname, $cid);
		if($statement->execute()){
			print "Category has been updated";		
		} else {
			print $mysqli->error;
		}
	}
	
?>
</div>


</body>
</html>

	