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
		<td>Sample Name</td>
		<td>Test Results</td>
	</tr>
	

<?php
	
	for($i=0; $i<$res->num_rows; $i++){
		echo "<tr>\r\n";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t<td>".$datarow['sname']."</td>\r\n";
		
		
		for($j=0; $j<$res_2->num_rows; $j++){						
			$datarow2 = $res_2->fetch_array(MYSQLI_ASSOC);
			$temp="";
			if($datarow2['tmod']==1){$temp="Tensile";}else if($datarow2['tmod']==2){$temp="Thermal";}
			echo "\t".'<td><form method="post" action="showresult.php"><button name="number" value='.$datarow2['num'].'>'. $temp.'<input type="hidden" name="sid" value='.$datarow2['sid'].'><input type="hidden" name="tmod" value='.$datarow2['tmod'].'></button></form></td>'."\n";	
		}		
		echo "</tr>\r\n";	
	}


?>
</table>
</div>
</body>
</html>
