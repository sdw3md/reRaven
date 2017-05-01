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
		<style>
			p {
				padding: 0px;
				margin: 0px;
			}
	
			div {
				margin: 20px;
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
		<?php
		//$poem = file_get_contents("bodytest.html");
		
		//echo $poem;
		//include "bodytest.html";
		include "the_raven.html";
		?>
		</div>
		<script>

		$(document).ready(function(){
			$("#scrambleButton").click(function(){
				$(".word").each(function(){
					var word = $(this).text();
				//	console.log('current this is: ' + this);
					$(this).text(getWord(word));
					//$(this).text("word");

				});
			});

			$(".word").click(function(){
				$(this).text("click");
			});
		});

		function getWord(word){
			return "word";
		}
		</script>
	</body>
</html>
