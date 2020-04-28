<?php
 require "Connect.php";
 
 $newpass = filter_input(INPUT_POST, 'newpass', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
 
 session_start();

$username=$_SESSION['username'];

 
 if(isset($newpass)){
 
 $newpass = password_hash($newpass, PASSWORD_DEFAULT);
 
$sql= "UPDATE users SET password=? WHERE username=?;"; 
$res = $dbh->prepare($sql);
$res->bind_param("ss", $newpass, $username);
$res->execute();
	 header("location:profil.php?updateInfo=1&value={$username}");
 } else {
	 header("location:profil.php?updateInfo=2&value={$username}");
 }
?>