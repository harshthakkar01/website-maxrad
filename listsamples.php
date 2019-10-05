<?php
	include('accessdb.php');
	include('accesscontrol.php');
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />
</head>
<body>
<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">
<table cellpadding="10">
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Type</td>
		<td>Material</td>
		<td>Provider</td>
		<td></td>
	</tr>
	

<?php

	
	for($i=0; $i<$res->num_rows; $i++){
		echo "<tr>\r\n";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t<td>".$datarow['sid']."</td>\r\n";
		echo "\t<td>".$datarow['sname']."</td>\r\n";
		echo "\t<td>".$datarow['tname']."</td>\r\n";
		echo "\t<td>".$datarow['mfname']." ".$datarow['mname']."</td>\r\n";
		echo "\t<td>".$datarow['pname']."</td>\r\n";
		echo "\t".'<td><form method="post" action="editsample.php"><button name="sample_id" value='.$datarow['sid'].'><img src="images/edit-icon.png"></button></form></td>';
		echo "</tr>\r\n";
	
	}
?>
</table>
</div>
</body>
</html>
