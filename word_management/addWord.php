<?php
session_start();

include_once '../config/db.php';


if(isset($_POST['word'])){
	$word = $_POST['word'];
	//$global = $_POST['global'];
		
	$qry = "INSERT INTO synonym(word) VALUES ('" . $word . "')";
	//echo $qry;
		
	$result = $connection->query($qry);
	if(mysqli_query($connection, $qry)){
		echo "added";
		header("Location: /reRaven/index.php");	
	} else {
		echo "not added";
	} 
} else {
	echo "ur dum";
}


?>
