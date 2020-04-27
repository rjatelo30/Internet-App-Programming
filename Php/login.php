<?php
include_once "user.php";
include_once "DBConnector.php";

$conn = new DBConnector;

if(isset($_POST['btn-logn'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $instance = User::create();
  $instance->setUsername($username);
  $instance->setPassword($password);

  if($instance->isPasswordCorrect()){
   $instance->login();
   mysqli_close($conn);

   //Create a new session for the logged in user
   $instance->createSession();
  }else{
   mysqli_close($conn);
   header("Loaction: login.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login</title>
 <script type="text/javascript" src="../Js/validate.js"></script>
 <link rel="stylesheet" type="text/css" href="../Css/validate.css">
</head>

<body>
 <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="login" name="login">
  <table align="center">
   <tr>
    <td><input type="text" name="username" placeholder="Username" required /></td>
   </tr>
   <tr>
    <td><input type="password" name="password" placeholder="Password" required /></td>
   </tr>
   <tr>
    <td><button type="submit" name="btn-login"> <strong>Login</strong> </button></td>
   </tr>
  </table>
 </form>
</body>

</html>