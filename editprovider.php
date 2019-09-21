<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listproviders.php");
	}
	$pid='';
	$pname='';
	$pcontact='';
	$pemail='';
	$paddress='';
	$ptelephone='';
	
	
	$providerid = filter_var($_POST["provider_id"], FILTER_SANITIZE_STRING);
	

	if(!empty($providerid)){
		$query_string = "SELECT id, name, contact, email, address, telephone FROM Providers WHERE id=$providerid";
		//echo $query_string;
		$res = $mysqli->query($query_string);
		//echo "Query returned ".$res->num_rows." rows";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$pid=$datarow['id'];
		$pname=$datarow['name'];
		$pcontact=$datarow['contact'];
		$pemail=$datarow['email'];
		$paddress=$datarow['address'];
		$ptelephone=$datarow['telephone'];
		echo $pcontact;
		//echo "pname is ".$pname;
		
	}
?>

<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />


</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">
<form method="post" action="saveprovider.php">

Name : <input type="text" name="provider_name" value="<?php echo $pname; ?>"><br />
Contact person: <input type="text" name="provider_contact" value="<?php echo $pcontact; ?>"><br />
Email : <input type="text" name="provider_email" value="<?php echo $pemail; ?>"><br />
Address : <input type="text" name="provider_address" value="<?php echo $paddress; ?>"><br />
Telephone : <input type="text" name="provider_telephone" value="<?php echo $ptelephone; ?>"><br />
<input type="hidden" name="provider_id" value="<?php echo $pid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</html>
