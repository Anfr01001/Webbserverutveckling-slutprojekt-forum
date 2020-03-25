<!DOCTYPE html>
<?php

$str="";
	if (isset ($_GET['value'])){
		$value=$_GET['value'];
		
		if($value==1){
			$str="Felaktig användare";
		}
		elseif($value==2){
			$str="Felaktigt Lösenord";
		}
		elseif($value==3){
			$str="Du har loggat ut";
		}
	}

$username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
$password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);

if(!empty($username) || !empty($password)) {
	
	include"Connect.php";

	$sql= "SELECT password FROM users WHERE username=?"; 
	$res = $dbh->prepare($sql);
	$res->bind_param("s", $username);
	$res->execute();
	$result =$res->get_result();
	$row = $result->fetch_assoc();
	
	if (!$row) { //inget tillbaks
		header("location:login.php?value=1");
	} else {
		var_dump(password_verify($password, $row['password']));
		echo $password;
		echo $row['password'];
		if(password_verify($password, $row['password'])){
			$_SESSION['username'] = $username; 
			echo "Inloggad";
			header("location:profil.php");
		} else {
		header("location:login.php?value=2");
		}
	}
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
				<?php echo $str ?>
					 <form action="login.php" method="post">
            <p><label for="user">Användarnamn:</label>
            <input type="text" id="user" name="username"></p>
            <p><label for="pwd">Lösenord:</label>
            <input type="password" id="pwd" name="password"></p>
            <p>
            <input type="submit" value="Logga in">
            </p>
          </form>
          <a href="../../html/NyAnvändare.php">Skapa användare</a>
				</section>
			</main>
			</main>
		</div>

  </body>
</html>