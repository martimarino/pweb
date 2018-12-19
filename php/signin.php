
mysqli::__construct() 
([string $host = ini_get("mysqli.default_host")
 [, string $email = ini_get("mysqli.default_username")
 [, string $passwd = ini_get("mysqli.default_pw")
 [, string $dbname = ""
 [, int $port = ini_get("mysqli.default_port")
 [, string $socket = ini_get("mysqli.default_socket")]]]]]])



<?php
	print $_POST['username'];
	print $_REQUEST['username'];
	?>

<?php
	if($_GET['formTo-validate'] == "ok")
	{
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$password = $_POST['password'];

		if($firstname == TRUE && $lastname == TRUE && $email == TRUE && $gender == TRUE && $password == TRUE)
		{
			$sql = mysql_query("SELECT * FROM user WHERE E-mail = '$email'") or die ("Mail già occupata");
			$num_rows = mysql_num_rows($sql);
			if($num_rows == 0)
			{
				mysql_query("INSERT INTO user (Fisrtname, Lastname, E-mail, Password, Gender, Newsletter, DateOfRegistration)")
				VALUES ('$firstname', '$lastname', '$email', '$password', '$gender', '', CURRENT_DATE)
				OR DIE(mysql_error());
				echo "Congratulations, successful registration.";
			}
			else
			{
				echo "Email address already used.";
			}
		}
		else 
		{
			echo "Fill in all the fields.";
		}
	}
?>