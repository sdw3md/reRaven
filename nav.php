<nav id="navBar" class="navElement">
	<div id="titleWrapper"><h1>reRaven</h1></div>
	<div class="navWrapper">
		<div id="aboutBlock" class="navLink" > 
			<a href="about.php">about</a>
		</div>
			<a class="navLink" href="index.php">home</a>
		
		<?php 
		session_start();
		if(isset($_SESSION['username'])){
		
			echo "<div id='loginBlock' class='navLink'>";
			echo "<label>logged in as " . $_SESSION['username'] . "</label>";
			echo "<a href='user_management/logout.php'>log out</a>";
		} else {
			include "loginForm.php";
		}
		?>
		</div>
	</div>
</nav>

