<?php 

$Meny1 = <<<HTML
		<nav>
	<ul>
		<li><a href="index.php">Frågor</a></li>
		<li><a href="yttranden.php">Yttranden</a></li>
		<li><a href="login.php">Logga in</a></li>
		<li>
		<a href="profil.php"><img class="profilruta" src = "../html/bilder/teknikum.jpg" alt = "profilbild">Profil</a>
			
		</li>
		
	</ul>
</nav>           
HTML;

$Meny2 = <<<HTML
		<nav>
	<ul>
		<li><a href="index.php">Frågor</a></li>
		<li><a href="yttranden.php">Yttranden</a></li>
		<li><a href="logout.php">Logga ut</a></li>
		<li>
		<a href="profil.php"><img class="profilruta" src = "../html/bilder/teknikum.jpg" alt = "profilbild">Profil</a>
			
		</li>
		
	</ul>
</nav>           
HTML;

if (isset($_SESSION['username'])) {
	echo $Meny2;
} else {
	echo $Meny1;
}
		

?>