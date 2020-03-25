<!DOCTYPE html>
<?php
$str = "";
if (isset ($_GET['value'])){
		$value=$_GET['value'];
		
		if($value==1){
			$str="Användaren finns redan";
		}
}
$status = 1;
	
$usernamenew = filter_input(INPUT_POST,'usernamenew', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
$passwordnew = filter_input(INPUT_POST,'passwordnew', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
$bio = filter_input(INPUT_POST,'bio', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
$picturre = filter_input(INPUT_POST,'picturre', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);

$passwordnew  = password_hash($passwordnew, PASSWORD_DEFAULT);

if(!empty($usernamenew) && !empty($passwordnew) ) {
	//kollar inte efter profilbild eller bio då de kan vara tomma
	include"Connect.php";

	//Finns det användare med detta namn?
	$sql="SELECT * FROM users WHERE username=?";
	$res = $dbh->prepare($sql);
	$res->bind_param("s", $usernamenew);
	$res->execute();
	$result =$res->get_result();
	$row = $result->fetch_assoc();
	
	if(!$row) {
		//Ingen användare med namn skapar en ny
	 $sql="INSERT INTO users(username,password,bio,profilbild,status) VALUE(?,?,?,?,?)";
	 $res = $dbh->prepare($sql);
	 $res->bind_param("ssssi", $usernamenew, $passwordnew, $bio, $picturre, $status);
	 $res->execute();
		
	 header("location:login.php");
	} else {
		header("location:NyAnvändare.php?value=1");
	}
}
?>
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
				
				<main> <!--Huvudinnehåll-->
				<section>
				<?php echo $str ?>
					 <form action="NyAnvändare.php" method="post">
            <p><label for="user">Användarnamn:</label>
            <input type="text" id="user" name="usernamenew"></p>
            <p><label for="pwd">Lösenord:</label>
            <input type="password" id="pwd" name="passwordnew"></p>
			<p><label for="user">Biografi:</label>
            <input type="text" id="bio" name="bio"></p>
			<p><label for="user">Profilbild:</label>
            <input type="text" id="pic" name="picturre"></p>
            <p>
            <input type="submit" value="Skapa användare">
            </p>
          </form>
				</section>
			</main>
			</main>
		</div>

  </body>
</html>