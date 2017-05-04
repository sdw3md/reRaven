<?php
session_start();

include_once '../config/db.php';

if(!isset($_SESSION['username'])){
	
	header("Location: ../user_management/login.php");
}


$connection = connect();


$username = mysqli_real_escape_string($connection, $_SESSION['username']);

if(isset($_POST['Synonym']) && isset($_POST['WordGroup'])){
	$word = mysqli_real_escape_string($connection, $_POST['Synonym']);
	$wordGroup = mysqli_real_escape_string($connection, $_POST['WordGroup']);
	
	$qry = "INSERT INTO synonym(Word, WordGroup, UserName) VALUES (\"" . $word . "\", '" . $wordGroup . "', '" . $username . "')";
 
	$result = $connection->query($qry);
	
	if($result){
		echo "Synonym successfully added";
	} else {
		echo "failed, word already exists in the table!";
	}
} else {
	echo "post variables not set";
}


?>
