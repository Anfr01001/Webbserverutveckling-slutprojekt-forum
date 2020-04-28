<?php
 require "Connect.php";
 
 $newbio = filter_input(INPUT_POST, 'newbio', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
 
 session_start();

$username=$_SESSION['username'];

 
 if(isset($newbio)){
 
 
$sql= "UPDATE users SET bio=? WHERE username=?;"; 
$res = $dbh->prepare($sql);
$res->bind_param("ss", $newbio, $username);
$res->execute();
	 header("location:profil.php?updateInfo=1&value={$username}");
 } else {
	 header("location:profil.php?updateInfo=2&value={$username}");
 }
?>