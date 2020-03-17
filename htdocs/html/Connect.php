<?php
$dbh = new mysqli("localhost","dbuser","qwe123","forumsida");
if (!$dbh){
	echo "Connection failed";
	exit;
}
?>