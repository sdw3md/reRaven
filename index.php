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
	<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
		<link href="jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet">
		<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
		<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
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
		<div>
		<?php echo "logged in as " . $_SESSION['username']; ?>
		</div> 
		<div><a href="user_management/logout.php">log out</a></div>
		This is where the body will go
		<div>
		<button type="button" id="scrambleButton"> scramble</button>
		<button type="button" id="getThesButton"> getThes </button>
		<button type="button" id="scanButton">scan</button>
		<div id="synonymDialog" title="Enter a synonym">
			<input id="newSynonym" type="text">
			<button id="submitSynonym" class="button">Submit</button>
			<button id="cancelSynonym" class="button">Cancel</button>
			<script>
				$(".button").button():
			</script>
		</div>
		<?php
		//$poem = file_get_contents("bodytest.html");
		
		//echo $poem;
		//include "bodytest.html";
		include "the_raven.html";
		?>
		</div>
		<script src="words.js"></script>
	</body>
</html>
