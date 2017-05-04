var thesaurus;
var wordObjects = [];
var selectedWord;

$(document).ready(function(){
	getThes();
	initWordObjects();	


	console.log("page showed!");
	var fixedH = $("#navBar").outerHeight(true);
	$("#buttonWrapper").css("margin-top", fixedH + "px");
	fixedH += $("buttonWrapper").outerHeight(true);
	$("#poemWrapper").css("margin-top", fixedH + "px");

	//init dialog
	$("#synonymDialog").dialog({ 
		dialogClass: "myDialog",
		autoOpen: false,
		resizable: false,
		draggable: false,
		height: 'auto',
		width: 400,
		buttons: [
			{
				text: "submit",
				click: function(){
					var synonym = $("#newSynonym").val();
					var wordGroup = getWordGroup(selectedWord);	
					addSynonym(synonym, wordGroup);
					$(this).dialog("close");
					$("#newSynonym").val("");
					getThes();
				}
			},
			{
				text: "cancel",
				click: function(){
					$(this).dialog("close");
				}
			}
		]
	 });

	$("#synonymDialog").resize( function(){
		console.log($(this).width());
		$("#newSynonym").css("width", $("#synonymDialog").width());
	});
	
	$("#getThesButton").click(function(){
		console.log("clicking getThesButton");
		getThes();
	});
	
	$("#scrambleButton").click(function(){
		wordObjects.forEach(function(obj){
			//var word = obj.text().toLowerCase();
			//console.log('current this is: ' + this);
			//$(this).text(getWord(word));
			//getWordForObject($(this));
			var newWord = getWord(obj);
			obj.text(newWord);

		});
		console.log("scramble complete");
	});

	$(".word").click(function(){
		var word = $(this).text();
		selectedWord = word;
		var sd = $("#synonymDialog");
		sd.dialog("option", "title", "Enter a synonym for " + word);
		//var titleWidth = $("#ui-id-1").text().outerWidth();
		//sd.dialog("option", "width", titleWidth);
		sd.dialog("open");
	});
	
	$("#scanButton").click(function(){
		var wordList = [];
		$(".word").each(function(){
			var word = $(this).text().toLowerCase();
			if($.inArray(word, wordList) == -1){
				addWord($(this));
				wordList.push(word);
			}
		});
		console.log("finished scan");
	});
	
	//adding a new synonym
	$("#submitSynonym").click(function(){
		var synonym = $("#newSynonym").val();
		var wordGroup = getWordGroup(selectedWord);	
		addSynonym(synonym, wordGroup);
		$("#synonymDialog").dialog("close");
		$("#newSynonym").val("");
		getThes();
	});

	//setInterval(cycleRandom(), 1000);
});

function cycleRandom(){
	var wordObject = wordObjects[Math.floor(Math.random() * wordObjects.length)];
	//var oldWord = wordObject.text().toLowerCase();
	var newWord = getWord(wordObject, true);
	wordObject.text(newWord);
}

function initWordObjects(){
	$(".word").each(function(){
		wordObjects.push($(this));
	});
	wordsLoaded = true;
}

function getThes(){
	console.log("calling getThes()");
	$.ajax({
		type: "POST",
		url: "word_management/getThesaurus.php",
		data: "",
		success: function(result){
			setThes(JSON.parse(result));
			printThes();
		}
	});
	thes = true;
}

function setThes(thes){
	thesaurus = thes;
}

function printThes(){
	console.log(thesaurus);
}

//takes a word object
function getWord(word){
	return getWord(word, false);
}


//takes a word object and a boolean as to wether it can be the same word
function getWord(word, different){
//	var newWord = "word";

	var wordGroup = getWordGroup(word.text().toLowerCase());	
//	var wordGroup = word["WordGroup"];
	
	var optionList = thesaurus.filter(function(obj){
		return obj["WordGroup"] == wordGroup;
	});

	if(different && optionList.length > 1){
		optionList = optionList.filter(function(obj){
			return obj["Word"].localeCompare(newWord) != 0;
		});
	}


	newWord = optionList[Math.floor(Math.random() * optionList.length)]["Word"];

	if(wordGroup){
		return newWord;
	} else {
		return word;
	}
}

function getWordGroup(wordText){
	var wordEntries = thesaurus.filter(function(obj){
		return obj["Word"].localeCompare(wordText) == 0;
	});
	var wordEntry = wordEntries[0];
	var wordGroup;
	if(wordEntry){
		wordGroup = wordEntry["WordGroup"];
	} else {
		wordGroup = 0;
		console.log("wordEntries: " + wordEntries + ", word: " + wordText);
	}
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
			console.log(wordObject);
		}
	});
}


function addSynonym(synonym, wordGroup){
	console.log(wordGroup);
	$.ajax({
		type: "POST",
		url:  "word_management/addSynonym.php",
		data: "WordGroup=" + wordGroup + "&Synonym=" + synonym,
		success: function(result){
			console.log(result);
			console.log("Synonym '" + synonym + "' added for word '" + selectedWord + "'");
		}
	});
}
	
