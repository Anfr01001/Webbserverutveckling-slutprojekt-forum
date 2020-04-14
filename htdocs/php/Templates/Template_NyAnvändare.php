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

$target_dir = "bilder/"; 
/*
* Delen för att man ska kunna ladda upp bilder har jag INTE skrivit själv hittade på W3 schools
*/
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	
/*
* Allt härifrån är skrivtet av mig då det inte handlar om att importa bilden
*/

	
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
	 $res->bind_param("ssssi", $usernamenew, $passwordnew, $bio, $target_file, $status);
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
			<form action="NyAnvändare.php" method="post" enctype="multipart/form-data">
            <p><label for="user">Användarnamn:</label>
            <input type="text" id="user" name="usernamenew"></p>
            <p><label for="pwd">Lösenord:</label>
            <input type="password" id="pwd" name="passwordnew"></p>
			<p><label for="user">Biografi:</label>
            <input type="text" id="bio" name="bio"></p>
			<p><label for="Bild">Bild:</label>
            <input type="file" name="fileToUpload" id="fileToUpload"></p>
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