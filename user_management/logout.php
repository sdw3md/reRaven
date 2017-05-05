<?php
session_start();
$location = $_SESSION['location'];
if(isset($_SESSION['username'])){
	session_destroy();
	unset($_SESSION['username']);
}
//header("Location: login.php");
header("Location: /reRaven/$location");
?>
