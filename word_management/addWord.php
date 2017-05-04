<?php
session_start();

include_once '../config/db.php';

if(!isset($_SESSION['username'])){
	
	header("Location: ../user_management/login.php");
}


$connection = connect();

$username = mysqli_real_escape_string($connection, $_POST['username']);

if(isset($_POST['word'])){
	$word = mysqli_real_escape_string($connection, $_POST['word']);
	//$global = $_POST['global'];
	
	$qry = "SELECT MAX(WordGroup) AS max_group FROM synonym";
	$result = $connection->query($qry);
	if($result){
		//echo $result;
		$row = $result->fetch_assoc();
		//echo $row;
		if($row){
			$oldId = $row['max_group'];
			//echo $oldId;
			if(!is_null($oldId)){
				$newId = $oldId+1;
			} else {
				$newId = 0;
			}
		} else {
			$newId = 0;
		}
	} else {
		$newId = 0;
	}
	//$result->close();
	//echo $newId;
	//$result = $connection->query($qry);
	//$newId = 0;
	$qry = "INSERT INTO synonym(Word, WordGroup, UserName) VALUES (\"" . $word . "\", '" . $newId . "', '" . $username . "')";
	//$qry = "INSERT INTO synonym(Word) VALUES ('" . $word . "')";
	
	//echo $qry;
 
	$result = $connection->query($qry);

	//$result->close();
	//return word group
	echo $newId;	
	//echo $qry;
		

	//return $result;
}


?>
