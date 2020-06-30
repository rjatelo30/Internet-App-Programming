<?php
include_once 'user.php';
include_once 'DBConnector.php';

 session_start();
 if(!isset($_SESSION['username'])){
  header("Location: login.php");
 }

 if($_SERVER('REQUEST_METHOD') !== 'POST'){
   // don't allow users to access site with the url 
   header('HTTP/1.0 403 Forbidden');
   echo 'You are Forebidden';
 }else{
   $api_key = null;
   $api_key = generateApiKey(64); /*Generate a 64 chareacter API Key*/
   header('Content-type: application/json');
   echo generateResponse($api_key);

   // API Key generating function 
   function generateApiKey($str_length){
     // base 62 map 
     $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

     // get random bits for base 64 encoding and prevent '=' padding 
     $bytes = openssl_random_pseudo_bytes(3*str_length/4+1);

     //convert base 64 to base 62 by mapping + and / to something from base 62 map
     // use first 2 random bytes for the new xters 
     $repl = unpack('C2', $bytes);

     $first = $chars[$repl[1]%62];
     $second = $chars[$repl[2]%62];
     return strtr(substr(base64_encode($bytes), 0, $str_length), '+/', "$first$second");
   }

   function saveApiKey($api_key){
     //save the api key code
     $conn = new DBConnector;
     $saved = false;

     $user = $_SESSION['username'];
     $ret = mysqli_query($conn->conn, "SELECT `id` FROM `user` WHERE `username` = `$user` ");

     if($res = mysqli_query($conn->conn, "INSERT INTO `api_keys`(`user_id`, `api_key`) VALUES (`$ret`, `$api_key`)")){
      $saved = true;
     }else{
      $saved = false;
     }

     return saved;
   }

   function generateResponse($api_key){
    if(saveApiKey()){
     $res = ['success' => 1, 'message' => $api_key];
    }else{
     $res = ['failed' => 0, 'message' => 'Oops somethind went wrong. Please try again'];
    }
    return json_encode($res);
   }

   // function fetchUserApiKey($){

   // }
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
 <script type="text/javascript" src="../Js/validate.js"></script>
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
 <p align="right"><a href="logout.php">Logout</a></p>
 <hr>
 <h3>Here, we will create an API that will allow Users/Developers to order items from external systems</h3>
 <hr>
 <h4>We now put this nfeature of allowing users to generate an API Key. Click the button to generate the API key</h4>
 
 <button class="btn btn-primary" id="api-key-btn">Generate API Key</button> <br><br>

 <!-- API Key text area  -->
 <strong>Youur API Key</strong>(Note that if your API Key is already running applications, generating a new key will stop the application from functioning) <br>

 <textarea name="api_key" id="api_key" cols="100" rows="2" readonly><?php echo fetchUserApiKey();?></textarea>

 <h3>Service Description</h3>
 We have a serviceAPI that allows external applications to order food and also pull all order status by using the order id. Let's do it!

 <hr>
</body>

</html>