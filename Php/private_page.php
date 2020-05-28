<?php
include_once 'user.php';

 session_start();
 if(!isset($_SESSION['username'])){
  header("Location: login.php");
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Private page</title>
 <script type="text/javascript" src="../Js/validate.js"></script>
 <link rel="stylesheet" type="text/css" href="../Css/validate.css">
</head>

<body>
 <p>This is a private page</p>
 <p>We want it protected</p>
</body>

</html>