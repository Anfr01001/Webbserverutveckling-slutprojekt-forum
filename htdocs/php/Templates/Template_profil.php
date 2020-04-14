<?php
include"Connect.php";

if (isset ($_GET['value'])){
		$profileuser=$_GET['value'];
	} else {
		header("location:login.php?value=4");
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
				
				echo $html = <<<HTML
		        <h1>Profil för {$result['username']}</h1>
				<img class="profilruta" src = "{$result['profilbild']}" alt = "profilbild">
				
				<h2>Biografi</h2>
				<p>{$result['bio']}</p>
				
HTML;
				?>
				<h2> Uppdatera information </h2>	
		
				<form action="profil.php" method="post">
				<select id="ToChange">
				<option value="password">Lösenord</option>
				<option value="bio">Biografi</option>
				<option value="Bild">Bild</option>
				</select>
				<input type="submit" value="Ändra">
				</main>
		</div>

  </body>
</html>