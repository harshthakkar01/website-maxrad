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
	
	$tid = filter_var($_POST["test_id"]);
	$tmode = filter_var($_POST["test_mode_id"], FILTER_SANITIZE_STRING);
	
	if($tmode==2){
		$sid = filter_var($_POST["sample"], FILTER_SANITIZE_STRING);
		$operatorid = filter_var($_POST["operator_name"], FILTER_SANITIZE_STRING);
		$temperature = filter_var($_POST["temperature"], FILTER_SANITIZE_STRING);
		$conductivity = filter_var($_POST["conductivity"], FILTER_SANITIZE_STRING);
		$date = filter_var($_POST["date"], FILTER_SANITIZE_STRING);
		
		if(empty($tid)){
			$statement = $mysqli->prepare("INSERT INTO Tests (testdate, operator_id, test_mode_id, sample_id) VALUES(?, ?, ?, ?)");
			$statement->bind_param('siii', $date, $operatorid, $tmode, $sid);
			
			if($statement->execute()){
				print "Test has been created.";
			}
			else{
				print $mysqli->error;
			}
			
			$statement2 = $mysqli->prepare("INSERT INTO Test_Thermal_conductivity (sample_id, temperature, conductivity, operator_id, testdate) VALUES (?, ?, ?, ?, ?)");
			$statement2->bind_param('iddis', $sid, $temperature, $conductivity, $operatorid, $date);
		
			if($statement2->execute()){
				print "Thermal test has been added.";
			}	
			else{
				print $mysqli->error;	
			}
		}
		else{
			
		}
	}
	else if($tmode==1){
		$sid = filter_var($_POST["sample"], FILTER_SANITIZE_STRING);
		$operatorid = filter_var($_POST["operator_name"], FILTER_SANITIZE_STRING);
		$eventvalue = filter_var($_POST["event_value"], FILTER_SANITIZE_STRING);
		$maximumforce = filter_var($_POST["maximum_force"], FILTER_SANITIZE_STRING);
		$tensilestrength = filter_var($_POST["tensile_strength"], FILTER_SANITIZE_STRING);
		$forceatbreak = filter_var($_POST["force_at_break"], FILTER_SANITIZE_STRING);
		$stressatbreak = filter_var($_POST["stress_at_break"], FILTER_SANITIZE_STRING);
		$date = filter_var($_POST["date"], FILTER_SANITIZE_STRING);
		$gpoints = filter_var($_POST["graph_points"], FILTER_SANITIZE_STRING);
		if(empty($tid)){
			$statement = $mysqli->prepare("INSERT INTO Tests (testdate, operator_id, test_mode_id, sample_id) VALUES(?, ?, ?, ?)");
			$statement->bind_param('siii', $date, $operatorid, $tmode, $sid);
			echo $tid;
			echo "After tid";
			if($statement->execute()){
				print "Test has been created.";
			}
			else{
				print $mysqli->error;
			}
			
			$statement2 = $mysqli->prepare("INSERT INTO Test_Tensile (sample_id, event_value, maximum_force, tensile_strength, force_at_break, stress_at_break, operator_id, testdate) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
			$statement2->bind_param('idddddis', $sid, $eventvalue, $maximumforce, $tensilestrength, $forceatbreak, $stressatbreak, $operatorid, $date);
			
			if($statement2->execute()){
				print "Tensile test has been added."; 
			}
			else{
				print $mysqli->error;
			}
			$point = (explode("\n", $gpoints));
			foreach($point as $p){
				$cor = (explode("\t", $p));
				$x = floatval($cor[0]);
				$y = floatval($cor[1]);
				echo $y;
				$state = $mysqli->prepare("INSERT INTO Graph_Points (sample_id, x, y) VALUES (?, ?, ?)");
				$state->bind_param('idd',$sid, $x, $y);
				$state->execute();			
			}
			
		}
		else{

		}
		
	}
		
/*		
		$statement = $mysqli->prepare("INSERT INTO Tests (testdate, operator_id, test_mode_id, sample_id) VALUES(?, ?, ?, ?)");
		$statement->bind_param('siii', $date, $operatorid, $tmode, $sid);
	
		$statement2 = $mysqli->prepare("INSERT INTO Test_Thermal_conductivity (id_tc, id_test, temperature, conductivity) VALUES(NULL, ?, ?, ?)");
		$statement2->bind_param('idd', $tid, $temperature, $conductivity);

		if($statement->execute() && $statement2->execute()){
			print "Thermal conductivity test has been created";		
		} else {
			print $mysqli->error;
		}
		
*/	/*
		$statement = $mysqli->prepare("INSERT INTO Tests (testdate, operator_id, test_mode_id, sample_id) VALUES(?, ?, ?, ?)");
		$statement->bind_param('siii', $date, $operatorid, $tmode, $sid);
		$statement2 = $mysqli->prepare("INSERT INTO Test_Thermal_conductivity (id_tc, id_test, temperature, conductivity) VALUES(NULL, ?, ?, ?)");
		$statement2->bind_param('idd', $tid, $temperature, $conductivity);
		if($statement->execute() && $statement2->execute()){
			print "Thermal conductivity test has been created";		
		} 
		else {
			print $mysqli->error;
		}
		
	}
	else{
		$statement = $mysqli->prepare("UPDATE Tests SET testdate = ?, operator_id = ?, test_mode_id = ?, sample_id = ? WHERE Tests.id = ?");
		$statement->bind_param('siiii', $date, $operatorid, $tmode, $sid, $tid);
					
		$statement2 = $mysqli->prepare("UPDATE Test_Thermal_conductivity SET temperature = ?, conductivity = ? WHERE Test_Thermal_conductivity.id_test = ?");
		$statement2->bind_param('ddi', $temperature, $conductivity, $tid);
	
		if($statement->execute() && $statement2->execute()){
			print "Thermal conductivity test has been updated";		
		} 
		else {
			print $mysqli->error;
		}
	}	
	'''
		
	'''if($tmode==1){
		$tid = filter_var($_POST["test_id"]);
		$sid = filter_var($_POST["sample_id"], FILTER_SANITIZE_STRING);
		$operatorid = filter_var($_POST["operator_id"], FILTER_SANITIZE_STRING);
		$eventvalue = filter_var($_POST["event_value"], FILTER_SANITIZE_STRING);
		$maximumforce = filter_var($_POST["maximum_force"], FILTER_SANITIZE_STRING);
		$tensilestrength = filter_var($_POST["tensile_strength"], FILTER_SANITIZE_STRING);
		$forceatbreak = filter_var($_POST["force_at_break"], FILTER_SANITIZE_STRING);
		$stressatbreak = filter_var($_POST["stress_at_break"], FILTER_SANITIZE_STRING);
		$date = filter_var($_POST["date"], FILTER_SANITIZE_STRING);
		if(empty($tid)){
			$statement = $mysqli->prepare("INSERT INTO Tests (testdate, operator_id, test_mode_id, sample_id) VALUES(?, ?, ?, ?)");
			$statement->bind_param('siii', $date, $operatorid, $tmode, $sid);
			
			$statement2 = $mysqli->prepare("INSERT INTO Test_Tensile (sample_id, event_value, maximum_force, tensile_strength, force_at_break, stress_at_break) VALUES(?, ?, ?, ?, ?, ?)");
			$statement2->bind_param('iddddd', $sid, $eventvalue, $maximumforce, $tensilestrength, $forceatbreak, $stressatbreak);

			if($statement->execute()){
				print "Tensile test has been created";		
			} else {
				print $mysqli->error;
			}
			sleep(0.1)
	 		if($statement2->execute()){
				print "Tensile test has been created";		
			} else {
				print $mysqli->error;
			}		
		} else {
			$statement = $mysqli->prepare("UPDATE Tests SET testdate = ?, operator_id = ?, test_mode_id = ?, sample_id = ? WHERE Tests.id = ?");
			$statement->bind_param('siiii', $date, $operatorid, $tmode, $sid, $tid);
					
			$statement2 = $mysqli->prepare("UPDATE Test_Tensile SET force_at_break = ?, event_value = ?, maximum_force = ?, tensile_strength = ?, stress_at_break = ? WHERE Test_Tensile.id_test = ?");
			$statement2->bind_param('dddddi', $forceatbreak, $eventvalue, $maximumforce, $tensilestrength, $stressatbreak, $tid);
			

			if($statement->execute()){
				print "Tensile test  has been updated";		
			} else {
				print $mysqli->error;
			}
			if($statement2->execute()){
				print "Tensile test  has been updated";		
			} else {
				print $mysqli->error;
			}

		}
	}
	else if($tmode==2){
		$tid = filter_var($_POST["test_id"]);
		$sid = filter_var($_POST["sample_id"], FILTER_SANITIZE_STRING);
		$operatorid = filter_var($_POST["operator_id"], FILTER_SANITIZE_STRING);
		$temperature = filter_var($_POST["temperature"], FILTER_SANITIZE_STRING);
		$conductivity = filter_var($_POST["conductivity"], FILTER_SANITIZE_STRING);
		$date = filter_var($_POST["date"], FILTER_SANITIZE_STRING);
		if(empty($tid)){
			$statement = $mysqli->prepare("INSERT INTO Tests (testdate, operator_id, test_mode_id, sample_id) VALUES(?, ?, ?, ?)");
			$statement->bind_param('siii', $date, $operatorid, $tmode, $sid);
			
			$statement2 = $mysqli->prepare("INSERT INTO Test_Thermal_conductivity (id_tc, id_test, temperature, conductivity) VALUES(NULL, ?, ?, ?)");
			$statement2->bind_param('idd', $tid, $temperature, $conductivity);

			if($statement->execute() && $statement2->execute()){
				print "Thermal conductivity test has been created";		
			} else {
				print $mysqli->error;
			}
		} else {
			$statement = $mysqli->prepare("UPDATE Tests SET testdate = ?, operator_id = ?, test_mode_id = ?, sample_id = ? WHERE Tests.id = ?");
			$statement->bind_param('siiii', $date, $operatorid, $tmode, $sid, $tid);
					
			$statement2 = $mysqli->prepare("UPDATE Test_Thermal_conductivity SET temperature = ?, conductivity = ? WHERE Test_Thermal_conductivity.id_test = ?");
			$statement2->bind_param('ddi', $temperature, $conductivity, $tid);
			

			if($statement->execute() && $statement2->execute()){
				print "Thermal conductivity test has been updated";		
			} else {
				print $mysqli->error;
			}
		}		
	}
	*/	

?>
</div>
</body>
</html>
