<?php
	session_start();
	unset($_SESSION['access_mode']);
?>

<html>
<form method="post" action="checklogin.php">
User Name : <input type="text" name="user_name" placeholder="User name" /><br />
Password : <input type="password" name="user_pwd" placeholder="Password" /><br />
<input type="submit" value="Submit" />
</form>
</html>