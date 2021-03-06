<?php
//Hämta posts
require"Connect.php";
require"functions.php";
$sql= "SELECT * FROM posts"; 
	$respost = $dbh->prepare($sql);
	$respost->execute();
	$resultpost =$respost->get_result();

//Kolla om användaren skrivit nytt inlägg	
$Titel = filter_input(INPUT_POST,'Titel', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
$Text = filter_input(INPUT_POST,'Text', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
if (isset($Titel) && isset($Text) && (strlen($Text) > 1) && isset($_SESSION['username']))	{
	
	//Få användarens UserID med hjälp av funktion
	$UserID = getUserId($_SESSION['username']);
	
	//Användaren har skrivit nytt inlägg lägg in det i databasen
	$sql="INSERT INTO posts(skapare,titel,text) VALUE(?,?,?)";
	$res = $dbh->prepare($sql);
	$res->bind_param("iss", $UserID, $Titel, $Text);
	$res->execute();
}

//Nästa check Kolla om användaren har skrivit en kommentar
$sql= "SELECT PostID FROM posts"; 
	$res = $dbh->prepare($sql);
	$res->execute();
	$result =$res->get_result();

//Vi måste gå igenom värje post som har en egen form.
// För värje post skapas också en form som heter Kommentar och sen ID för den posten för att hålla reda på vart posten ska.
while ($idRow = $result->fetch_assoc()){
$Kommentar = filter_input(INPUT_POST,'Kommentar' . $idRow['PostID'] , FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
if (isset($Kommentar) && (strlen($Kommentar) > 1)){

	//Få UserID med hjälp av funktion
	$UserID = getUserId($_SESSION['username']);
	
	//lägg till kommentaren i databasen
	$sql="INSERT INTO kommentarer(PostID,UserID,text) VALUE(?,?,?)";
	$res = $dbh->prepare($sql);
	$res->bind_param("iis", $idRow['PostID'], $UserID, $Kommentar);
	$res->execute();
}
}

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
	
	<!--Alla inlägg kommentarer med mera är i denna tabellen-->
<table>
  <tr>
    <th>Inlägg</th>
    <th>Skapare</th>
  </tr>
  
  <?php
  //echo in alla inlägg från databsen
  while($row = $resultpost->fetch_assoc()) {
	  
	//tar eda på vem som postat (med userID från databasen) med hjälp av funktion
	$name = getUserName($row['skapare']);
	
	if ($name == null) {
		$name = "Bortagen användare";
	}
	
echo <<<Nyttinlagg
	<tr> <td>
	{$row['titel']}
	</td></tr>
	<tr><td>
    {$row['text']}
	</td><td>
	<a href="profil.php?value={$name}">{$name}</a>
	</td></tr>
Nyttinlagg;

  /* Eftersom detta är en loop som kör igenom alla inägg
  * Kollar jag här om det finns kommentarer som ska in pga vi har post id
  * och det är enklast att här implementera in det i tabellen*/
  
	$sql= "SELECT * FROM kommentarer WHERE PostID=?"; 
	$reskommentar = $dbh->prepare($sql);
	$reskommentar->bind_param("i", $row['PostID']);
	$reskommentar->execute();
	$resultkommentar =$reskommentar->get_result();

	echo "<tr><td>";

	while($rowkommentar = $resultkommentar->fetch_assoc()) {
		
		//tar eda på vem som postat (med userID) med hjälp av funktion

	$name = getUserName($rowkommentar['UserID']);
		
	
		echo $name; echo": "; echo $rowkommentar['text'];
		echo "<br>";
	}
  //Om användaren är inloggad visa ny kommentar fält
	if(isset($_SESSION['username'])) {
		echo <<<Nykommentar
	<form action="index.php" method="post">
	<p><label for="text">Kommentar:</label>
	<input type="text" id="Kommentar" name="Kommentar{$row['PostID']}">
	<input type="hidden" id="PostID" name="PostID" value={$row['PostID']}>
	<input type="submit" value="Kommentera">
Nykommentar;
	}
  echo "</td></tr>";
	}
//Om användaren är inloggad visa fält för att skapa nytt inlägg
if(isset($_SESSION['username'])) {
	echo <<<NyPost
	<form action="index.php" method="post">
	<tr> <td>
	<p>Skapa nytt inlägg</p>
	<p><label for="text">Titel:</label>
	<input type="text" id="Titel" name="Titel">
    <p><label for="text">Text:</label>
	<input type="text" id="Text" name="Text">
	</td>
    <td>
	<input type="submit" value="Skapa inlägg">
	</td>
NyPost;
}
 ?>
</table>
			
			</main>
		</div>

  </body>
</html>