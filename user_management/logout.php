<?php
session_start();

if(isset($_SESSION['username'])){
	session_destroy();
	unset($_SESSION['username']);
}
header("Location: /reRaven/index.php");
?>
