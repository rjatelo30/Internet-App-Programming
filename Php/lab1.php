<?php
      include_once("DBConnector.php");
      include_once("user.php");
      $conn = new DBConnector;//DB connection
   
   if (isset($_POST['btn-save'])) {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $city = $_POST['city_name'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $error = null;
   
       //user object created
      $user = new User($first_name, $last_name, $city, $username, $password, $error);
      //Check form for any errors
         if(!$user->validateForm()){
            $error = 1;
            $user->createFormErrorSessions($error);
            header("Refresh:0");
            die();
         }else if($user->isUserExist()){ // Check for duplicate usernames in database
            $error = 2;
            $user->createFormErrorSessions($error);
            header("Refresh:0");
            die();
         }
      $res = $user->save();
   
       //check for successful data entry
       if ($res) {
           echo "Save operation was successful";
       } else {
           echo "An error occurred";
       }

      $datas = $user->readAll();
      foreach ($datas as $data) {
         echo $data['id']. "<br>";
         echo $data['first_name']. "<br>";
         echo $data['last_name']. "<br>";
         echo $data['user_city']. "<br>";
      }

   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>DB Form</title>
 <script type="text/javascript" src="../Js/validate.js"></script>
 <link rel="stylesheet" type="text/css" href="../Css/validate.css">
</head>
<body>
   <form action="" method="post" name="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
      <table align="center">
      <tr>
         <td>
            <div id="form-errors">
               <?php
                  session_start();
                  if(!empty($_SESSION['form_errors'])){
                     echo "" . $_SESSION['form_errors'];
                     unset($_SESSION['form_errors']);
                  }
               ?>
            </div>
         </td>
      </tr>
         <tr>
            <td> <input type="text" name="first_name" required placeholder="First Name"/></td>
         </tr>

         <tr>
            <td> <input type="text" name="last_name" required placeholder="Last Name"/></td>
         </tr>

         <tr>
            <td> <input type="text" name="city_name" required placeholder="City"/></td>
         </tr>

         <tr>
            <td> <input type="text" name="username"  placeholder="Username"/></td>
         </tr>
         
         <tr>
            <td> <input type="password" name="password"  placeholder="Password"/></td>
         </tr>

         <tr>
            <td> <button type="submit" name="btn-save"> <strong>Save</strong> </button></td>
         </tr> 

         <tr>
            <td> <a href="login.php">Login</a></td>
         </tr>      
      </table>
   </form>


</body>
</html>