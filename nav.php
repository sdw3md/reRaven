<nav id="navBar" class="navElement">
	<div class="navWrapper">
		<div id="aboutBlock" class="navLink" > 
			<a href="about.php">about</a>
		</div>
			<a class="navLink" href="index.php">home</a>
<!--		</div> -->
		<div id="loginBlock" class="navLink" >
			<?php echo "logged in as " . $_SESSION['username']; ?>
			<a href="user_management/logout.php">log out</a>
		</div>
	</div>
</nav>

