<?php
      include_once("DBConnector.php");
      include_once("user.php");
      include_once("fileUploader.php");

      $conn = new DBConnector;//DB connection
   
   if (isset($_POST['btn-save'])) {
      // user parameters
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $city = $_POST['city_name'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      //file upload parameters
      $file_original_name = $_FILES["fileToUpload"]["name"];
      $file_size = $_FILES["fileToUpload"]["size"];
      $file_type = strtolower(pathinfo($file_original_name, PATHINFO_EXTENSION));
      $file_final =$_FILES["fileToUpload"]["tmp_name"];
      $error = null;

      //timezone parameters
      $utc_timestamp = $_POST['utc_timestamp'];
      $offset = $_POST['time_zone_offset'];

      //user object created
      $user = new User($first_name, $last_name, $city, $username, $password, $error);

      // set the time for upload 
      $user->setUtcTimestamp($utc_timestamp);
      $user->setTimezoneOffset($offset);

      // create a file object
      $upload = new FileUploader();
      $upload->setOriginalName($file_original_name);
      $upload->setType($file_type);
      $upload->setSize($file_size);
      $upload->setFinalName($file_final);
      $upload->setUsername($username);

       //Check form for any errors
      if (!$user->validateForm()) {
         $error = 1;
         $user->createFormErrorSessions($error);
         header("Refresh:0");
         die();
      } elseif ($user->isUserExist()) { // Check for duplicate usernames in database
         $error = 2;
         $user->createFormErrorSessions($error);
         header("Refresh:0");
         die();
      }

      if ($upload->fileWasSelected()) {
         if ($upload->fileTypeisCorrect()) {
            if ($upload->fileSizeIsCorrect()) {
                  if (!($upload->fileAlreadyExists())) {
                     $user->save();
                     $upload->uploadFile() ;
                  } else {
                     echo "This image already exists"."<br>";
                  }
            } else {
                  echo "The image selected is too big"."<br>";
            }
         } else {
            echo "Please upload either a jpg, png or jpeg"."<br>";
         }
      } else {
         echo "You haven't slected an image file"."<br>";
      }

      $res = $user->save();

      //check for successful data entry
      if ($res) {
         echo "Save operation was successful";
      } else {
         echo "An error occurred";
      }

      // $datas = $user->readAll();
      // foreach ($datas as $data) {
      //    echo $data['id']. "<br>";
      //    echo $data['first_name']. "<br>";
      //    echo $data['last_name']. "<br>";
      //    echo $data['user_city']. "<br>";
      // }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>DB Form</title>
 <script type="text/javascript" src="../Js/validate.js"></script>
 <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
       <script type="text/javascript" src="../Js/timezone.js"></script>
 <link rel="stylesheet" type="text/css" href="../Css/validate.css">
</head>
<body>
   <form action="" method="post" name="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
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
            <td>Profile Image: <input type="file" name="fileToUpload" id="fileToUpload" /></td>
         </tr>

         <tr>
            <td> <button type="submit" name="btn-save" id="submit"> <strong>Save</strong> </button></td>

         </tr> 
         <!-- hidden inputs -->
         <tr>
            <td> <input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""> </td> 
         </tr>

         <tr>
            <td> <input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""> </td>
         </tr>

         <tr>
            <td> <a href="login.php">Login</a></td>
         </tr>      
      </table>
   </form>


</body>
</html>