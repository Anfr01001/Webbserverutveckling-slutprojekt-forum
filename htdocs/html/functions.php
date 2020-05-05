<?php



function getUserId($userName) {
	
	include"Connect.php";
	
        $sql= "SELECT UserID FROM users WHERE username=?"; 
		$res = $dbh->prepare($sql);
		$res->bind_param("s", $userName);
		$res->execute();
		$result =$res->get_result();
		$result = $result->fetch_assoc();
		$UserID = $result['UserID'];
		
		return $UserID;
         }
		 
function getUserName($UserID) {
	
	include"Connect.php";
	
        $sql2= "SELECT username FROM users WHERE UserID=?"; 
	$res2 = $dbh->prepare($sql2);
	$res2->bind_param("i", $UserID);
	$res2->execute();
	$result2 =$res2->get_result();
	$name = $result2->fetch_assoc();
	$name = $name['username'];
		
		return $name;
         }
		 
function isAdmin($userName) {
	
	include"Connect.php";
	
    $sql= "SELECT status FROM users WHERE username=?"; 
		$res = $dbh->prepare($sql);
		$res->bind_param("s", $userName);
		$res->execute();
		$result =$res->get_result();
		$result = $result->fetch_assoc();
		$status = $result['status'];
		
		if($status > 1){
			return true;
         } else {
			return false;
		 }
}
?>