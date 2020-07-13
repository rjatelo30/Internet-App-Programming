<?php
include_once "fileUploader.php";
include_once "user.php";
include_once "DBConnector.php";

$conn = new DBConnector;

if(isset($_POST['btn-login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $first_name = null;
  $last_name = null;
  $city = null;
  $error = null;
  $utc_timestamp = null;
  $offset = null;

  $instance = new User($first_name, $last_name, $city, $username, $password, $error, $offset, $utc_timestamp);

  if($instance->isPasswordCorrect()){
    $instance->createSession();
    $instance->login();
    die();
   //Create a new session for the logged in user
  }
  else{
    $error = 3; 
    $instance->createFormErrorSessions($error);
    header("Refresh:0");
    die();
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
 <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="login" name="login" enctypr="application/x-www-form-urlencoded">
  <table align="center">
  <tr>
         <td>
            <div id="form-errors">
               <?php
                  session_start();
                  if (!empty($_SESSION['form_errors'])) {
                     echo "" . $_SESSION['form_errors'];
                     unset($_SESSION['form_errors']);
                  }
               ?>
            </div>
         </td>
      </tr>
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

 <p>No account? Sign up <a href="lab1.php">here</a></p>
</body>

</html>