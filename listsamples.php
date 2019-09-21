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

	$query_string = "SELECT sam.id AS sid, sam.name AS sname, typ.name AS tname, mat.name AS mname, pro.name AS pname, man.name AS mfname FROM Samples AS sam INNER JOIN Sample_types AS typ ON sam.sampletype_id=typ.id INNER JOIN Materials AS mat ON sam.material_id = mat.id INNER JOIN Providers AS pro ON sam.provider_id=pro.id INNER JOIN Manufacturers AS man ON mat.manufacturer_id=man.id ";

	$res = $mysqli->query($query_string);

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