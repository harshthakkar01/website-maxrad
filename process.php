<html>
<?php

	$mysql_host="localhost";
	$mysql_username = "runningscrat";
	$mysql_password = "carpathia";
	$mysql_database = "testdb";



	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$u_name = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING);
		$u_email = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
		$u_text = filter_var($_POST["user_text"], FILTER_SANITIZE_STRING);

		if(empty($u_name)){
			die("Please enter your name");		
		}
		if(empty($u_email)){
			die("Please enter your email");		
		}
		if(empty($u_text)){
			die("Please enter your message");		
		}

		$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

		if($mysqli->connect_error){
			die('Error : ('. $mysqli->connect_errno .') ' . $mysqli->connect_error);		
		}

		$statement = $mysqli->prepare("INSERT INTO users_data (user_name, user_email, user_message) VALUES(?, ?, ?)");

		$statement->bind_param('sss', $u_name, $u_email, $u_text);

		if($statement->execute()){
			print "Hello " . $u_name . "! Your message has been saved!";		
		} else {
			print $mysqli->error;
		}


	}
	
?>
</html>