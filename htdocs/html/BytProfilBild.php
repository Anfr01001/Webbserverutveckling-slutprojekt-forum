<?php
 require "Connect.php";

var_dump($_POST["submit"]);
 
 session_start();

$username=$_SESSION['username'];

 
$target_dir = "bilder/"; 
/*
* Delen för att man ska kunna ladda upp bilder har jag INTE skrivit själv hittade på W3 schools
*/
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
var_dump($target_file);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
echo "kVARFÖR ÄR JAG BARA HÄR!";
if(isset($_POST["submit"])) {
	echo "KOM HIIIIIT";
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

$sql= "UPDATE users SET profilbild=? WHERE username=?;"; 
$res = $dbh->prepare($sql);
$res->bind_param("ss", $target_file, $username);
$res->execute();

var_dump($target_file);
	 //header("location:profil.php?updateInfo=1&value={$username}");
 

?>