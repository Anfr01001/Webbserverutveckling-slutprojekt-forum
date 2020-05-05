<?php 


if (isset($_SESSION['username'])) {
	echo $Meny2 = <<<HTML
		<nav>
	<ul>
		<li><a href="index.php">Frågor</a></li>
		<li><a href="logout.php">Logga ut</a></li>
		<li>
		<a href="profil.php?value={$_SESSION['username']}">Profil</a>
			
		</li>
		
	</ul>
</nav>           
HTML;
} else {
	echo $Meny1 = <<<HTML
		<nav>
	<ul>
		<li><a href="index.php">Frågor</a></li>
		<li><a href="login.php">Logga in</a></li>
		<li>
		<a href="profil.php">Profil</a>
		</li>
		
	</ul>
</nav>           
HTML;
}
		

?>