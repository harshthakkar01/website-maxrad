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
			
			if($statement->execute()){
				print "Test has been created.";
			}
			else{
				print $mysqli->error;
			}
			
			
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
			echo $tid;
			echo "After tid";
			if($statement->execute()){
				print "Test has been created.";
			}
			else{
				print $mysqli->error;
			}
			
			
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
		
