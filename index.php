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
			
			span:first-child {
				text-transform: capitalize;
			}

			#firstWord {
				text-transform: uppercase;
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
		<?php
		//$poem = file_get_contents("bodytest.html");
		
		//echo $poem;
		//include "bodytest.html";
		include "the_raven.html";
		?>
		</div>
		<script>

		var thesaurus;
		var wordObjects = [];

		$(document).ready(function(){
			getThes();	
			initWordObjects();	
			$("#getThesButton").click(function(){
				console.log("clicking getThesButton");
				getThes();
			});
			$("#scrambleButton").click(function(){
				/*$(".word").each(function(){
					var word = $(this).text().toLowerCase();
					console.log('current this is: ' + this);
					//$(this).text(getWord(word));
					//getWordForObject($(this));
					var newWord = getWord(word);
					$(this).text(newWord);

				});*/
				wordObjects.forEach(function(){
					var word = $(this).text().toLowerCase();
					console.log('current this is: ' + this);
					//$(this).text(getWord(word));
					//getWordForObject($(this));
					var newWord = getWord(word);
					$(this).text(newWord);

				});
				console.log("scramble complete");
			});

			$(".word").click(function(){
				var word = $(this).text().toLowerCase();
				//var newWord = getWord(word);
				var newWord = "clicked";
				$(this).text(newWord);
			});
			
			$("#scanButton").click(function(){
				var wordList = [];
				$(".word").each(function(){
					var word = $(this).text().toLowerCase();
					if($.inArray(word, wordList) == -1){
					//addWord(word);
						addWord($(this));
						wordList.push(word);
					}
				});
				console.log("finished scan");
			});
		});

		function initWordObjects(){
			$(".word").each(function(){
				wordObjects.push($(this));
			});
		}

		function getThes(){
			console.log("calling getThes()");
			$.ajax({
				type: "POST",
				url: "word_management/getThesaurus.php",
				data: "",
				success: function(result){
					//console.log(result);
					//var parsed = JSON.parse(result);
					//console.log(parsed);
					setThes(JSON.parse(result));
					//setThes(result);
					printThes();
				}
			});
		}

		function setThes(thes){
			thesaurus = thes;
		}
		
		function printThes(){
			console.log(thesaurus);
		}
/*
		function getWordForObject(wordObject){
			var newWord;
			var oldWord = wordObject.text();
			newWord = "word";
			
			$.ajax({
				type: "POST",
				url: "word_management/getWord.php",
				data: "getWord=" + oldWord,
				success: function(result){
					console.log(result);
					//newWord = result;
					wordObject.text(result);
				}
			});
			//return newWord;
		}
*/
		function getWord(word){
			var newWord = "word";
		
			var wordGroup = getWordGroup(word);	
			
			var optionList = thesaurus.filter(function(obj){
				return obj["WordGroup"] == wordGroup;
			});


			newWord = optionList[Math.floor(Math.random() * optionList.length)]["Word"];

			if(wordGroup){
				return newWord;
			} else {
				return word;
			}
		}

		function getWordGroup(word){
			var wordEntries = thesaurus.filter(function(obj){
				return obj["Word"].localeCompare(word) == 0;
			});
			var wordEntry = wordEntries[0];
			var wordGroup;
			if(wordEntry){
				wordGroup = wordEntry["WordGroup"];
			} else {
				wordGroup = 0;
				console.log("wordEntries: " + wordEntries + ", word: " + word);
			}
			//console.log("word group: " + wordGroup);
			return wordGroup;
		}

		function addWord(wordObject){
			var word = wordObject.text().toLowerCase();
			
			$.ajax({
				type: "POST",
				url: "word_management/addWord.php",
				data: "word=" + word,
				success: function(result){
					console.log("Word Object: " + wordObject.text() + ", word group: " + result);
					//wordObject.addClass(result);
					console.log(wordObject);
				}
			});
		}


		
		</script>
	</body>
</html>
