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
		<td>Manufacturer</td>
		<td>Name</td>
		<td>Category</td>
		<td>Datasheet</td>
		<td></td>
	</tr>
	

<?php

	$query_string = "SELECT mat.id AS mid, mat.name AS mname, mat.datasheet AS mdatasheet, cat.name AS mcategory, man.name AS mmanufacturer FROM Materials AS mat INNER JOIN Manufacturers AS man ON mat.manufacturer_id = man.id INNER JOIN Categories AS cat ON mat.category_id = cat.id";

	$res = $mysqli->query($query_string);

	for($i=0; $i<$res->num_rows; $i++){
		echo "<tr>\r\n";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t<td>".$datarow['mid']."</td>\r\n";
		echo "\t<td>".$datarow['mmanufacturer']."</td>\r\n";
		echo "\t<td>".$datarow['mname']."</td>\r\n";
		echo "\t<td>".$datarow['mcategory']."</td>\r\n";
		echo "\t<td>".$datarow['mdatasheet']."</td>\r\n";
		echo "\t".'<td><form method="post" action="editmaterial.php"><button name="material_id" value='.$datarow['mid'].'><img src="images/edit-icon.png"></button></form>';
		echo "</tr>\r\n";
	
	}
?>
</table>
</div>
</body>
</html>