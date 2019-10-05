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
		
		if($statement->execute()){
			print "Category has been created";		
		} else {
			print $mysqli->error;
		}
	} else {
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

	
