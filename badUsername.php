<!DOCTYPE html>
<html>
<head><title>reRavem - bad username</title>
<link href="navStyle.css" rel="stylesheet">
<style>
	#relativeWrapper {
		position: relative;
		width: 80%;
		margin: auto;
	}

	img {
		width: 100%;
	}

	#foreheadMessage {
		color: black;
		font-size: 16pt;
		position: absolute;
		text-align: center;
		width: 100%;
		top: 20%;
	}

	div {
		color: gray;
	}
</style>
</head>
<body>
<div id="relativeWrapper">
	<img src="./media/Edgar_Allan_Poe_daguerreotype_crop.png" alt="see below for attribution">
	<div id="foreheadMessage">
		<p><?php session_start(); echo $_SESSION['message']?></p>
		<a href="index.php">(go back)</a>
	</div>
</div>
<div>
By <span lang="en" xml:lang="en">Unknown</span><a href="https://www.wikidata.org/wiki/Q4233718" title="wikidata:Q4233718"></a>; most likely George C. Gilchrest, Samuel P. Howes, James M. Pearson, or Andrew J. Simpson, all of Lowell, MA - <a rel="nofollow" class="external free" href="http://www.daguerre.org/images/2008sympos/consignor4a-medium.jpg">http://www.daguerre.org/images/2008sympos/consignor4a-medium.jpg</a> and <a rel="nofollow" class="external free" href="http://www.getty.edu/art/gettyguide/artObjectDetails?artobj=39406">http://www.getty.edu/art/gettyguide/artObjectDetails?artobj=39406</a>, Public Domain, <a href="https://commons.wikimedia.org/w/index.php?curid=31269051">Link</a>
</div>
</body>
</html>
