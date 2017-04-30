<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('Location: user_management/login.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>reRaven</title>
	</head>
	<body>
		<div>
		<?php echo "logged in as " . $_SESSION['username']; ?>
		</div> 
		<div><a href="user_management/logout.php">log out</a></div>
		This is where the body will go
<?php
?>
	</body>
</html>
