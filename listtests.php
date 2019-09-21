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
	$query_string = "SELECT sam.id as sid, sam.name as sname from Samples as sam";
	$res = $mysqli->query($query_string);
	
	for($i=0; $i<$res->num_rows; $i++){
		echo "<tr>\r\n";
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		echo "\t<td>".$datarow['sname']."</td>\r\n";
		
		$query_2 = "select tests.sample_id as sid, testmode.id as tmod , count(tests.test_mode_id) as num from Test_modes as testmode inner join Tests as tests on testmode.id=tests.test_mode_id  where tests.sample_id='$datarow[sid]' group by testmode.id";
		$res_2 = $mysqli->query($query_2);
		
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