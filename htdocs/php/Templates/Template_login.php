<!DOCTYPE html>
<?php

$username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
$password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);

if(!empty($username) || !empty($password)) {
	
	include"Connect.php";
	
}
?>
<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>Sluttprojekt forummmm</title>
		 <link rel="stylesheet" href="../../html/css/stilmall.css">
	</head>
  <body id="index">
    <div id="wrapper">
			
			<main> <!--Huvudinnehåll-->
			
				<?php 
				 require "../php/Meny.php";
				 require "../php/Header.php";
				?>
				
				<main> <!--Huvudinnehåll-->
				<section>
					 <form action="login.php" method="post">
            <p><label for="user">Användarnamn:</label>
            <input type="text" id="user" name="username"></p>
            <p><label for="pwd">Lösenord:</label>
            <input type="password" id="pwd" name="password"></p>
            <p>
            <input type="submit" value="Logga in">
            </p>
          </form>
          <p class="create"><a href="../../html/NewUser.php">Skapa användare</a></p>
				</section>
			</main>
			</main>
		</div>

  </body>
</html>