<?php
      include_once("DBConnector.php");
      include_once("user.php");
      $conn = new DBConnector;//DB connection
   
   if (isset($_POST['btn-save'])) {
       $first_name = $_POST['first_name'];
       $last_name = $_POST['last_name'];
       $city = $_POST['city_name'];
   
       //user object created
       $user = new User($first_name, $last_name, $city);
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
</head>
<body>
   <form action="" method="post">
      <table align="center">
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
            <td> <button type="submit" name="btn-save"> <strong>Save</strong> </button></td>
         </tr>      
      </table>
   </form>


</body>
</html>