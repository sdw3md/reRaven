<?php
	session_start();
	$_SESSION['location'] = "index.php";
/*	if(!isset($_SESSION['username'])){
		header('Location: user_management/login.php');
}*/
	//include "user_management/login.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>reRaven</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link href="jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet">
		<link href="navStyle.css" rel="stylesheet">
		<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
		<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
		<script src="words.js"></script>
		<style>
		/*	p {
				padding: 0px;
				margin: 0px;
			}
	
			div {
				margin: 20px;
			}
			
			span:first-child {
				text-transform: capitalize;
			}

			#firstWord {
				text-transform: uppercase;
			}

			#synonymDialog {
				display: none;
			}
		*/
		</style>
	</head>
	<body>
		<?php include 'nav.php' ?> 
		<?php if(isset($_SESSION['username'])){ 
			include 'userTools.php'; 
		} ?>
		<div id="mainWrapper">
		<?php
		include "the_raven.html";
		?>
		</div>
	</body>
</html>
