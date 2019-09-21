<?php



	function CreateOptionList($OptionCaption, $OptionName, $QueryString, $SelectId, $IdxId, $DescName){
		
		include('accessdb.php');
		include('accesscontrol.php');
		
		echo $OptionCaption."\r\n";
		
		//echo $QueryString."\r\n";
		
		$res = $mysqli->query($QueryString) or die($mysqli->error);

		//echo "There are ".$res->num_rows." records\r\n";
		echo '<select name="'.$OptionName.'" id="'.OptionName.'">';
		for($i=0; $i<$res->num_rows; $i++){
			$datarow = $res->fetch_array(MYSQLI_ASSOC);
			
		echo "\t";
			echo '<option ';
			if(!empty($SelectId) && $SelectId == $datarow[$IdxId]) echo 'selected ';
			echo 'value="'.$datarow[$IdxId].'">'.$datarow[$DescName].'</option>';
			echo "\r\n";
		}
		
		echo "</select>\r\n<br>";
	}

?>