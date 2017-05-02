
<?php

/* this script opens the db connection, gets an assoc_array of the thesaurus, 
   closes the connection, and then returns it back to the ajax call so that
   it can be accessed locally
 */

include_once '../config/db.php';
//connect
$con = connect();

$qry = "SELECT * FROM synonym";
$result = $con->query($qry);
$words = [];

$row = $result->fetch_assoc();

while($row){
	$words[] = $row;
	$row = $result->fetch_assoc();
}
//close connection
mysqli_close($con);

//echo to pass this back to ajax
echo json_encode($words);
/*
if($result){
	echo json_encode($result);
} else {
	echo "no result!";
}
*/
?>
