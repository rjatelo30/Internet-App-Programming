<?php
include "Crud.php";
include "authenticator.php";
include_once "DBConnector.php";

class User implements Crud, Authenticator{
 private $user_id;
 private $first_name;
 private $last_name;
 private $city_name;
 private $username;
 private $password;
 private $error;
 private $timezone_offset;
 private $utc_timestamp;

 function __construct($first_name, $last_name, $city_name, $username, $password, $error, $timezone_offset, $utc_timestamp){
  $this->first_name = $first_name;
  $this->last_name = $last_name;
  $this->city_name = $city_name;
  $this->username = $username;
  $this->password = $password;
  $this->error = $error;
  $this->utc_timestamp = $utc_timestamp;
  $this->timezone_offset = $timezone_offset;
 }

//  We can't create multiple constructors
//  SO we fake one in form of a function 
//  since we don't have all details during login

public static function create(){
  $instance = new Self();
  return $instance;
}

  public function setUsername($username){
    $this->username = $username;
  }

  public function getUsername(){
    return $this->username;
  }
  
  public function setPassword($password){
    $this->password = $password;
  }
  
  public function getPassword(){
    return $this->password;
  }
  
  Public function setUserId($user_id){
    $this->user_id = $user_id;
  }

  public function getUserId(){
    return $this->$user_id;
  }

  Public function setTzo($timezone_offset){
    $this->timezone_offset = $timezone_offset;
  }

  public function getTzo(){
    return $this->$timezone_offset;
  }

  Public function setUtcStamp($utc_timestamp){
    $this->utc_timestamp = $utc_timestamp;
  }

  public function getUtcStamp(){
    return $this->$utc_timestamp;
  }

  //Insert new user to database
  public function save(){
  $conn = new DBConnector;

  $fn = $this->first_name;
  $ln = $this->last_name;
  $city = $this->city_name;
  $uname = $this->username;
  $this->hashpassword();
  $pass = $this->password;
  $tzo = $this->timezone_offset;
  $utc = $this->utc_timestamp;

  $res = mysqli_query($conn->conn, "INSERT INTO `user`(`first_name`, `last_name`, `user_city`, `username`, `password`, `timestamp`, `timezone_offset`) VALUES ('$fn', '$ln', '$city', '$uname', '$pass', '$utc', '$tzo')")or die ("Error: " .mysqli_error($conn->conn));

      mysqli_close($conn->conn);
    return $res;
  }

  public function isUserExist(){
    $conn = new DBConnector;

    $duplicate = false;
    $username = $this->username;
    $state = "SELECT * FROM `user` WHERE `username` = '$username'";
    $res = mysqli_query($conn->conn, $state)
    or die("Error: " .mysqli_error($conn->conn));

    $numRows = $res->num_rows;
    if ($numRows > 0) {
    $duplicate = true;
    }

    mysqli_close($conn->conn);
  return $duplicate;
}

  public function search(){
    return null;
  }

  public function readAll(){
    $conn = new DBConnector;

    $state = "SELECT * FROM `user` WHERE 1";
    $res = mysqli_query($conn->conn, $state)
    or die ("Error: " .mysqli_error($conn->conn));
    $numRows = $res->num_rows;

      if($numRows > 0){
        while($row = $res->fetch_assoc()){
        $data[] =$row;
        }
      }
      mysqli_close($conn->conn);
    return $data;

  }

  public function readUnique(){
    return null;
  }

  public function removeAll(){
    return null;
  }

  public function removeOne(){
    return null;
  }

  public function update(){
    return null;
  }

  public function validateForm(){
    $fn = $this->first_name;
    $ln = $this->last_name;
    $city = $this->city_name;
    $use = $this->username;
    $pass = $this->password;

    if($fn == "" || $ln == "" || $city == "" || $use == "" || $pass == ""){
      return false;
    }
  return true;
  }

  public function createFormErrorSessions($error){
    session_start();
    if($error == 1){
      $_SESSION['form_errors'] = "All fields are required";
    }else if($error == 2){
      $_SESSION['form_errors'] = "This Username is taken";
    }else if($error == 3){
      $_SESSION['form_errors'] = "Your password is incorrect";
    }
  }

  //Password Encryption
  public function hashPassword(){
    //in-built method hashes the password
    $this->password = password_hash($this->password,PASSWORD_DEFAULT);  
  }

  //Check if password is correct
  public function isPasswordCorrect(){
    $conn = new DBConnector;

    $found = false;
    $state = "SELECT `username`, `password` FROM `user`";
    $res = mysqli_query($conn->conn, $state);

    //fetch data from db, loop through it and confirm entries are correct
    while($row = $res->fetch_array()){
      if(password_verify($this->getPassword(), $row['password']) && $this->getUsername() == $row['username']){
        $found = true;
      }
    }
    mysqli_close($conn->conn);
    return $found;
  }

  //Correct password allows us to load the next page "private page"
  public function login(){
    header("Location: private_page.php");
  }

  //Create a session for the user
  public function createSession(){
    session_start();
    return $_SESSION['username'] = $this->getUsername();
  }

  //Log out of website
  public function logout(){
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    header("Location: lab1.php");
  }
}




?>