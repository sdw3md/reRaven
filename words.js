var thesaurus = [];
var wordObjects = [];
var objectsWithSynonyms = [];
var selectedWord;
var cycle;


$(document).ready(function(){
/*	getThes();
	initWordObjects();	
	initSynonyms();
*/
	updateMyLibrary();

	console.log("page showed!");
	var fixedH = $("#navBar").outerHeight(true);
	$("#buttonWrapper").css("margin-top", fixedH + "px");
	fixedH += $("buttonWrapper").outerHeight(true);
	$("#mainWrapper").css("margin-top", fixedH + "px");

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

	$(".ui-dialog-buttonpane").addClass("hbox");
	$(".ui-widget-header").addClass("hbox");
	$(".ui-dialog-content").addClass("hbox");

	$("#synonymDialog").resize( function(){
		console.log($(this).width());
		$("#newSynonym").css("width", $("#synonymDialog").width());
	});
	
	$("#getThesButton").click(function(){
		console.log("clicking getThesButton");
		getThes();
	});
	
	$("#scrambleButton").click(function(){
		//wordObjects.forEach(function(obj){
		objectsWithSynonyms.forEach(function(obj){
			var wordText = obj.text().toLowerCase();
			//console.log('current this is: ' + this);
			//$(this).text(getWord(word));
			//getWordForObject($(this));
			var newWord = getWord(wordText);
			obj.text(newWord);

		});
		console.log("scramble complete");
	});

	//checkbox!
//	$("#cycleBox").checkboxradio(); 
/*		refresh: function(){
			$("#cycleBox").is(":checked") ?
			cycle = setInterval(cycleRandom, 200) : clearInterval(cycle);
		}
	});
*/
	

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

	//load about page
	$("#aboutLink").click(function(){
		$("#poemWrapper").load("about.html");
	});

	//cycle = setInterval(cycleRandom, 100);
//});


function updateMyLibrary(){
	getThes();
	//initWordObjects();
	//initSynonyms();
}

function initSynonyms(){
	objectsWithSynonyms = wordObjects.filter(function(obj){
		//var group = getWordGroup(obj.text().toLowerCase());
		return getSynonymsFromGroup( getWordGroup(obj.text().toLowerCase())).length > 1;
	});
}

function cycleRandom(){
	if(objectsWithSynonyms.length > 0){
		var wordObject = objectsWithSynonyms[Math.floor(Math.random() * objectsWithSynonyms.length)];
		var oldWord = wordObject.text().toLowerCase();
		var newWord = getWord(oldWord, true);
		wordObject.text(newWord);
	}
}

function initWordObjects(callBack){
	$(".word").each(function(){
		wordObjects.push($(this));
	});
	wordsLoaded = true;
	callBack();
}

function getThes(){
	console.log("calling getThes()");
	$.ajax({
		type: "POST",
		url: "word_management/getThesaurus.php",
	//	data: "",
		success: function(result){
		//	console.log(result)
			var something = JSON.parse(result);
		//	console.log(something);
			setThes(JSON.parse(result));
		//	printThes();
			initWordObjects(initSynonyms);
		}
	});
	//thes = true;
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

function getSynonymsFromGroup(wordGroup){
	return thesaurus.filter(function(obj){
		return obj["WordGroup"] == wordGroup;
	});
}

//takes a word object and a boolean as to wether it can be the same word
function getWord(wordText, different){
	var newWord = "word";

	var wordGroup = getWordGroup(wordText);	
//	var wordGroup = word["WordGroup"];
	
/*	var optionList = thesaurus.filter(function(obj){
		return obj["WordGroup"] == wordGroup;
	});
*/
	var optionList = getSynonymsFromGroup(wordGroup);

	if(different && optionList.length > 1){
		optionList = optionList.filter(function(obj){
			return obj["Word"].localeCompare(newWord) != 0;
		});
	}


	newWord = optionList[Math.floor(Math.random() * optionList.length)]["Word"];

	if(wordGroup){
		return newWord;
	} else {
		return wordText;
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
});	
