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
<table>
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td></td>
	</tr>
	

<?php

	
	for($i=0; $i<$res->num_rows; $i++){
		echo "<tr>\r\n";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t<td>".$datarow['id']."</td>\r\n";
		echo "\t<td>".$datarow['name']."</td>\r\n";
		echo "\t".'<td><form method="post" action="editsampletype.php"><button name="sampletype_id" value='.$datarow['id'].'><img src="images/edit-icon.png"></button></form>';
		echo "</tr>\r\n";
	
	}
?>
</table>
</div>
</body>
</html>
