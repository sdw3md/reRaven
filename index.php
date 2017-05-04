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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link href="jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet">
		<link href="navStyle.css" rel="stylesheet">
		<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
		<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
		<script src="words.js"></script>
		<style>
			p {
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
		</style>
	</head>
	<body>
		<?php include 'nav.php' ?> 
		<div id="buttonWrapper" class="navElement">
		<button type="button" id="scrambleButton"> scramble</button>
		<button type="button" id="getThesButton"> getThes </button>
		<button type="button" id="scanButton">scan</button>
		<input type="checkbox" id="cycleBox" value="cycle">cycle<br>
		</div>
		<div id="synonymDialog" class="myDialog" title="Enter a synonym">
			<input id="newSynonym" class="myInputField" type="text">
		<!--	<button id="submitSynonym" class="button">Submit</button>
			<button id="cancelSynonym" class="button">Cancel</button>
		-->	<script>
				$(".button").button();
			</script>
		</div>
		<div id="poemWrapper">
		<?php
		include "the_raven.html";
		?>
		</div>
	</body>
</html>
