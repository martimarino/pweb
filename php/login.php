<?php
	session_start(); // Starting Session
	include('../js/home.js');
	$error = ''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {
		if (empty($_POST['email']) || empty($_POST['password'])) 
		{
			$error = "Username or Password is invalid";
		}
		else{
		// Define $username and $password
			$username = $_POST['email'];
			$password = $_POST['password'];
			// mysqli_connect() function opens a new connection to the MySQL server.
			$conn = mysqli_connect("localhost", "root", "", "supernova");
			// SQL query to fetch information of registerd users and finds user match.
			$query = "SELECT username, password from users where username=? AND password=? LIMIT 1";

			$result=mysqli_query($conn,$query);
			if($result== true){

				// To protect MySQL injection for Security purpose
				$stmt = $conn->prepare($query);
				$stmt->bind_param("ss", $username, $password);
				$stmt->execute();
				$stmt->bind_result($username, $password);
				$stmt->store_result();
				if($stmt->fetch())  {
					$_SESSION['login_user'] = $username; // Initializing Session
					header("location: profile.php"); // Redirecting To Profile Page
				}
			}else{
				$error ="Username o password errati";
				echo "<script></script>";
			}
		}
		mysqli_close($conn); // Closing Connection
	}
?>