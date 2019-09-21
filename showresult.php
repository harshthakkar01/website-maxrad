<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listtests.php");
	}
		
	$tnum = filter_var($_POST["number"], FILTER_SANITIZE_STRING);
	
	
?>

<html>
<head>

<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />

</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">
<?php 
	
	if(empty($tnum)){
		print "No test entry.";
	}
	else{
		$tid = filter_var($_POST["tmod"], FILTER_SANITIZE_STRING);
		$sid = filter_var($_POST["sid"], FILTER_SANITIZE_STRING);
			
		if ($tid==1){
		
		?>
		<table cellpadding="10">
					<tr>
					<td>Test Date</td>	
					<td>Operator Name</td>
					<td>Event Value</td>
					<td>Maximum Force</td>
					<td>Tensile Strength</td>
					<td>Force at break</td>
					<td>Stress at break</td>
					<td>Graph</td>
					</tr>
				<?php
				echo "<tr>\r\n";
				
					$query = "select ten.testdate as tdate, op.name as oname, ten.event_value as ev, ten.maximum_force as mf, ten.tensile_strength as ts, ten.force_at_break as fab, ten.stress_at_break as sab from Test_Tensile as ten inner join Operators as op on ten.operator_id=op.id where ten.sample_id='$sid'";
					$res2 = $mysqli->query($query);	
									
					for($j=0; $j<$res2->num_rows; $j++){
						echo "<tr>\r\n";
						$datarow2 = $res2->fetch_array(MYSQLI_ASSOC);
						echo "\t<td>".$datarow2['tdate']."</td>\r\n";
						echo "\t<td>".$datarow2['oname']."</td>\r\n";
						echo "\t<td>".$datarow2['ev']."</td>\r\n";
						echo "\t<td>".$datarow2['mf']."</td>\r\n";
						echo "\t<td>".$datarow2['ts']."</td>\r\n";
						echo "\t<td>".$datarow2['fab']."</td>\r\n";
						echo "\t<td>".$datarow2['sab']."</td>\r\n";
						echo "\t".'<td><form method="post" action="showgraph.html"><button name="id" value='.$sid.'>Graph</button></form></td>'."\n";						
						echo "</tr>\r\n";								
					}
				
				?>
				</table>
				<?php
										
			}
			else if($tid==2){
				?>
				<table cellpadding="10">
					<tr>
					<td>Test Date</td>
					<td>Operator</td>
					<td>Temperature</td>
					<td>Conductivity</td>
					</tr>
				<?php
				
		
				$query = "select tc.testdate as tdate, op.name as oname, tc.temperature as tmp, tc.conductivity as cnd from Test_Thermal_conductivity as tc inner join Operators as op on tc.operator_id=op.id where tc.sample_id='$sid'";
				$res2 = $mysqli->query($query);
				
				for($j=0; $j<$res2->num_rows; $j++){
					echo "<tr>\r\n";
					$datarow2 = $res2->fetch_array(MYSQLI_ASSOC);
					echo "\t<td>".$datarow2['tdate']."</td>\r\n";
					echo "\t<td>".$datarow2['oname']."</td>\r\n";
					echo "\t<td>".$datarow2['tmp']."</td>\r\n";
					echo "\t<td>".$datarow2['cnd']."</td>\r\n";
					echo "</tr>\r\n";
				}
				
				?>
				</table>
				<?php
			}	
		
	}
?>

</div>
</body>
</html>
