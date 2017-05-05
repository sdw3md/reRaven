<?php
session_start();

/*
if(isset($_SESSION['username'])){
	header("Location: /reRaven/index.php");
}*/
include_once '../config/db.php';



if(isset($_POST['login'])){
	$connection = connect();
	$rawUsername = $_POST['username'];
	$rawPassword = $_POST['password'];
	$username = mysqli_real_escape_string($connection, $rawUsername);
	$password = mysqli_real_escape_string($connection, $rawPassword);

	$valid = true;

	if(strcmp($rawUsername, $username) != 0 || strcmp($username, "") == 0) {
		echo "bad username. try better";
		$_SESSION['message'] = "bad username! Please try again.";
		header("Location: /reRaven/badUsername.php");
		//echo "rawusername: " . $rawUsername . ", clean username: " . $username;
		$valid = false;
	}
	if(strcmp($rawPassword, $password) != 0){
		$_SESSION['message'] = "bad password! Please try again.";
		header("Location: /reRaven/badUsername.php");
		echo "bad password, do a good job!";
		$valid = false;
	}



	if($valid){
		$newUser = true;
		
		$qry = "SELECT * FROM user WHERE username='$username'";
		
		$result = $connection->query($qry);
		
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();
			if(password_verify($password, $row['PasswordHash'])){
				$_SESSION['username'] = $username;
				header("Location: /reRaven/" . $_SESSION['location']);	
			} else {
				$_SESSION['message'] = "incorrect password! Please try again.";
				header("Location: /reRaven/badUsername.php");
			}
		}/*
		while($row = $result->fetch_assoc()){
			//echo "\nthere is a row";
			echo $row['UserName'];
		}*/

		$qry = "INSERT INTO user(UserName, passwordHash) VALUES ('" . $username . "', '" . password_hash($password, PASSWORD_DEFAULT) . "')";
		//echo $qry;
		if(mysqli_query($connection, $qry)){
			$_SESSION['message'] = "New User Created! (good job!)";
			header("Location: /reRaven/badUsername.php");
			echo "u win";
			header("Location: /reRaven/" . $_SESSION['location']);	
		//	header("Location: /reRaven/index.php");	
		} else {
			echo "u fail. ur db fails.";
		} 
	} else {
		echo "ur dum";
	}
mysqli_close($connection);
}


?>
<!--
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<div>
			<form action="index.php" method="post" role="form">
				<label for="username">username</label>
				<input id="username" type="text" name="username">
				<label for="password">password</label>
				<input id="password" type="text" name="password">
				<input id="loginButton" type="submit" name="login" value="login">
			</form>
		</div>
	</body>
</html>-->
