<?php
 require "Connect.php";
 
 $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
 
 session_start();

$sql= "DELETE FROM users WHERE userID=?"; 
$res = $dbh->prepare($sql);
$res->bind_param("s", $userID);
$res->execute();

header("location:login.php");
	
?>