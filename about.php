<?php
	session_start();
	$_SESSION['location'] = "about.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>reRaven - About</title>
	<link href="navStyle.css" rel="stylesheet">
	<style>
		.aboutHeader {
			float: left;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet">
	<link href="navStyle.css" rel="stylesheet">
	<script src="jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
	<script src="jquery-ui-1.12.1.custom/jquery-ui.js"></script>
	<script src="words.js"></script>
</head>
<body>
<?php include 'nav.php' ?>
	<div id="mainWrapper">
		<div id="aboutHeaderWrapper">
			<img class="birdPicture aboutHeader" src="./media/crow-2025900_640.png">
			<h1 class="aboutHeader">About 'The Raven'</h1>
			<img class="birdPicture aboutHeader" src="./media/animal-2025562_640.png">
		</div>
		<div id="videoWrapper">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/WcqPQXqQXzI" frameborder="0" allowfullscreen></iframe>
		</div>
		<p>'The Raven' is a poem by famous American poet Edgar Allan Poe. It's pretty good. But this site crowdsources making it worse. </P>
		<p>reRaven substitutes words in The Raven with synonyms. Or whatever you tell it is a synonym. Once you log in, you can click on words in the poem to submit a synonym to the database. </p>
	</div>
</body>
</html>
