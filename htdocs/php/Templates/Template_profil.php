<?php
require"Connect.php";
require"functions.php";

if (isset($_GET['value'])){
		$profileuser=$_GET['value'];
		if ($profileuser == "Bortagen användare") {
			header("location:index.php");
		}
	} else {
		header("location:login.php?value=4");
	}
	
	
		
	//om användren uppdaterar lösen eller liknande
	$str="";
	if (isset ($_GET['updateInfo'])){
		$updateInfo=$_GET['updateInfo'];
		
		if($updateInfo==1){
			$str="Användare Uppdaterad";
		}
		else if($updateInfo==2){
			$str="Ett fel vid uppdateringen inträffade";
		}
	}
	
	$ShowMeny = false;
	//kontot är ditt visa menyerna för att byta lösen mm.
	if ($profileuser == $_SESSION['username']){
		$ShowMeny = true;
	}

	$sql= "SELECT * FROM users WHERE username=?"; 
	$res = $dbh->prepare($sql);
	$res->bind_param("s", $profileuser);
	$res->execute();
	$result =$res->get_result();
	$result = $result->fetch_assoc();
	
	
?>
<!DOCTYPE html>
<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>Sluttprojekt forum</title>
		 <link rel="stylesheet" href="../../html/css/stilmall.css">
	</head>
  <body id="index">
    <div id="wrapper">
			
			<main> <!--Huvudinnehåll-->
			
				<?php 
				 require "../php/Meny.php";
				 require "../php/Header.php";
				?>
				<?php

				echo $str;
				echo $html = <<<HTML
		        <h1>Profil för {$result['username']}</h1>
				<img class="profilruta" src = "{$result['profilbild']}" alt = "profilbild">
				
				<h2>Biografi</h2>
				<p>{$result['bio']}</p>
				
				
HTML;


	$html = <<<MENY
	<h2> Uppdatera information </h2>	
		
	<form action="BytPassword.php" method="post">
	<label for="text">Ändra lösen:</label>
	<input type="text" id="Titel" name="newpass">
	<input type="submit" value="Byt Lösenord">
	</form>
	
	<form action="BytBio.php" method="post">
	<label for="text">Ändra Biofrafi:</label>
	<input type="text" id="Titel" name="newbio">
	<input type="submit" value="Byt biografi">
	</form>
	
	<form action="BytProfilBild.php" method="post" enctype="multipart/form-data">
	<label for="text">Ändra profilbild:</label>
	<input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
	</form>
	
MENY;

$userID = getUserId($result['username']);

$admin = <<<admin
	
	<form action="Remove.php" method="post">
	<input id="userID" name="userID" type="hidden" value="{$userID}">
	<input type="submit" value="Ta bort konto">
	</form>
	
admin;


	
	if ($ShowMeny) {echo $html;}
	if (isAdmin($_SESSION['username'])) {echo $admin;}
	?>
		</main>
		</div>

  </body>
</html>
