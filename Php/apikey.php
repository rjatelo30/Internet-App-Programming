<?php 

include_once 'DBconnector.php'; 

session_start();
$method = $_SERVER["REQUEST_METHOD"];
$user = $_SESSION['username'];
if ($method != "POST"){
	header('HTTP/1.0 403 Forbidden');
 echo "Page is forbidden";
}else{
	$key = $_POST['apikey'];

	$conn = new DBConnector;
	$state1 = "SELECT * FROM `user` WHERE `username` = '$user' ";
	$myquery = mysqli_query($conn->conn, $state1);
	$user_array = mysqli_fetch_assoc($myquery);
	echo $uid = $user_array['id'];
	$state2 = "INSERT INTO `api_keys`(`user_id`, `api_key`) VALUES ('$uid', '$key' )";
	if(mysqli_query($conn->conn, $state2)){
			$state3 = "API Key stored";
			header("Location: private_page.php");
	}else{
			$state3 = "Sorry, Please try saving the key again";
	}
return $state3;
}


 ?>