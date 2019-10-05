<?php
	include('accessdb.php');
	include('accesscontrol.php');
	if ($_SESSION['access_mode']=="read_only"){
		//$message="Authentication failure.";
		//echo "<script type='text/javascript'>alert('$message');</script>";		
		sleep(2);
		header("Location: listtests.php");
	}
	$tid='';
	$tdate='';
	$toperator='';
	$tmode='';
	$tsample='';
		
	$tid = filter_var($_POST["test_id"], FILTER_SANITIZE_STRING);

	if(!empty($tid)){
		
		$datarow = $res->fetch_array(MYSQLI_ASSOC);
		$tid=$datarow['id'];
		$tdate=$datarow['testdate'];
		$toperator=$datarow['operator_id'];
		$tmode=$datarow['test_mode_id'];
		$tsample=$datarow['sample_id'];
	}
?>

<html>
<head>

<script type="text/javascript" src="//code.jquery.com/jquery-1.4.2.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />



<script type="text/javascript">
	$(function(){
		$('#testselector').change(function(){
			$('.testclass').hide();
			$('#'+$(this).val()).show();
		});	
	});
</script>
</head>
<body>

<?php require($DOCUMENT_ROOT . "sidepanel.php");?> 
<div class="maincontent">

<form method="post" action="savetest.php">


<br>


Test Mode
<select id="testselector" name="test_mode_id">
	<option value="1">Tensile Test</option>
	<option value="2">Thermal conductivity Test</option>
</select>
<div id="1" class="testclass" style="display: block;">
<label>Event Value</label>
<input type="number" step="0.001" name="event_value"><br />

<label>Maximum Force</label>
<input type="number" step="0.001" name="maximum_force"><br />

<label>Tensile strength</label>
<input type="number" step="0.001" name="tensile_strength"><br />

<label>Force at Break</label>
<input type="number" step="0.001" name="force_at_break"><br />

<label>Stress at break</label>
<input type="number" step="0.001" name="stress_at_break"><br />

<label>Graph Points</label>
<textarea name="graph_points" rows="10" cols="10"></textarea><br />


</div>

<div id="2" class="testclass" style="display: none;">
<label>Temperature</label>
<input type="number" step="0.001" name="temperature"><br />

<label>Conductivity</label>
<input type="number" step="0.001" name="conductivity"><br />


</div>
<label>Date</label>
<input name="date" type="date"><br />

<!--<input type="hidden" name="test_mode_id" value="<?php echo $tmode; ?>" ><br /> -->
<input type="hidden" name="test_id" value="<?php echo $tid; ?>" ><br />
<input type="submit" value="Submit" />
</form>
</div>
</body>
</html>
