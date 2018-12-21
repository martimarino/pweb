<?php
	
	include("db_con.php");
	include("home.js");
	session_start();
      
	$myemail = mysqli_real_escape_string($db,$_POST['email']);
	$mypassword = mysqli_real_escape_string($db,$_POST['password']); 

	$sql = "SELECT * FROM user WHERE E-mail = '$myemail' and Password = '$mypassword'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$active = $row['active'];

	$count = mysqli_num_rows($result);

	// If result matched $myemail and $mypassword, table row must be 1 row

	if($count == 1) {
	 session_register("myemail");
	 $_SESSION['login_user'] = $myemail;
	 
	 header("location: profile.php");
	}else {
		echo = "Your Login Name or Password is invalid";
	}
?>