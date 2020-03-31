<?php

include"Connect.php";
$sql= "SELECT * FROM posts"; 
	$res = $dbh->prepare($sql);
	$res->execute();
	$result =$res->get_result();
	
	

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
			
				<table>
  <tr>
    <th>Inlägg</th>
    <th>Skapare</th>
  </tr>
  
  <?php
  while($row = $result->fetch_assoc()) {
	  //tar eda på vem som postat (med userID)
	$sql2= "SELECT username FROM users WHERE UserID=?"; 
	$res2 = $dbh->prepare($sql2);
	$res2->bind_param("i", $row['skapare']);
	$res2->execute();
	$result2 =$res2->get_result();
	$name = $result2->fetch_assoc();
	$name = $name['username'];
	
	
	echo "<tr> <td>";
	echo $row['titel'];
	echo "</td></tr>";
	echo "<tr>";
	echo "<td>";
    echo $row['text'];
	echo "</td>";
    echo "<td>";
	echo $name;
	echo "</td>";
  echo"
  </tr>
  <tr>
  <td>Kommentarsfält</td>
  </tr>";
	}
	
	echo "<tr> <td>";
	echo "Skapa nytt inlägg";
	echo "</td></tr>";
	
	echo <<<NyPost
<form action="index.php" method="post">
	<tr> <td>
	<p><label for="text">Titel:</label>
	<input type="text" id="Titel" name="Titel">
	</td></tr>
	<tr> <td>
    <p><label for="text">Text:</label>
	<input type="text" id="Text" name="Text">
	</td>
    <td>
	<input type="submit" value="Skapa inlägg">
	</td>
NyPost;
 
 
 
 ?>
</table>
			
			</main>
		</div>

  </body>
</html>