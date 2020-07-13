<?php
include_once 'user.php';
include_once 'DBConnector.php';

session_start();
if(!isset($_SESSION['username'])){
header("Location: login.php");
}

// echo $_SESSION['username']; 
$method = $_SERVER["REQUEST_METHOD"];

function fetchUserApiKey()
{
  $conn = new DBconnector();

  $user = $_SESSION['username'];
  $state1 = "SELECT * FROM `user` WHERE `username` = '$user' ";
  $myquery = mysqli_query($conn->conn, $state1);
  $user_array = mysqli_fetch_assoc($myquery);
  $uid = $user_array['id'];
  $state2 = "SELECT * FROM `api_keys` WHERE `user_id` = '$uid' ";
  $good = mysqli_query($conn->conn, $state2) or die(mysqli_error($conn->conn));
  $key =  mysqli_fetch_assoc($good);
  return $key['api_key'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Private page</title>

 <!-- javascript files -->
 <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 <script type="text/javascript" src="./Js/validate.js"></script>
 <script type="text/javascript" src="../Js/apikey.js"></script>

 <!-- Css -->
 <link rel="stylesheet" type="text/css" href="../Css/validate.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

 <!-- Bootstrap -->
 <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
 <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
 <p align="right"><a href="logout.php">Logout</a></p>
 <hr>
 <h3>Here, we will create an API that will allow Users/Developers to order items from external systems</h3>
 <hr>
 <h4>We now put this nfeature of allowing users to generate an API Key. Click the button to generate the API key</h4>
 
 <button class="btn btn-primary" id="keygen">Generate API Key</button> <br><br>

 <!-- API Key text area  -->
 <strong>Your API Key</strong> (Note that if your API Key is already running applications, generating a new key will stop the application from functioning)<br>

   <textarea name="apikey" id="apikey" cols="100" rows="2" readonly><?php echo fetchUserApiKey();
 ?></textarea>
<br>
<input type="button" value="Save Key" class="btn btn-primary" onclick="Send_Data()" />
 <br>
 <br>
 <h3>Service Description</h3>
 We have a serviceAPI that allows external applications to order food and also pull all order status by using the order id. Let's do it!

 <hr>
</div>

<script>
function generateUUID() {
 var d = new Date().getTime();

 if (window.performance && typeof window.performance.now === "function") {
  d += performance.now();
 }

 var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
  var r = (d + Math.random() * 16) % 16 | 0;
  d = Math.floor(d / 16);
  return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
 });

 return uuid;
}

/**
 * Generate new key and insert into input value
 */

 $('#keygen').on('click', function () {
  $('#apikey').val(generateUUID());
 });

 function Send_Data (){
var key = getElementById("apikey").value

   var httpr = new XMLHttpRequest();
   httpr.open("POST", "apikey.php", true);
   httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   httpr.onreadystatechange = function() {
     if(httpr.readyState == 4 && httpr.status == 200){
      document.getElementById("response").innerHTML = httpr.responseText;
     }
   }
   httpr.send("key="+key);
 }
</script>
</body>

</html>