<?php
session_start();

include_once '../config/db.php';

$connection = connect();

if(isset($_POST['getWord'])){
	//get the wordGroup posted by ajax
	$word = $_POST['getWord'];
	
	$qry = "SELECT WordGroup FROM synonym WHERE Word='$word'";
	//query the db for the wordgroup of the given word
	$result = $connection->query($qry);
	if($result){
		//echo $result;
		$row = $result->fetch_assoc();
		//echo $row;
		if($row){
			$wordGroup = $row['WordGroup'];
			//echo "wordGroup: " . $wordGroup;
		} else {
			$wordGroup = 0;
		}
	} else {
		$wordGroup = 0;
	}

	///*
	//query the db for the list of words in the wordgroup
	$qry = "SELECT Word FROM synonym WHERE WordGroup='$wordGroup'";
	
	$words = [];	
 
	$result = $connection->query($qry);
	$row = $result->fetch_assoc();
	while($row){
		$words[] = $row['Word'];	
		$row = $result->fetch_assoc();
	}
	//echo $words;
	if(count($words) > 1){
		//echo count($words);
	}

	//echo $qry;
	//*/	

	echo count($words);
}


?>
