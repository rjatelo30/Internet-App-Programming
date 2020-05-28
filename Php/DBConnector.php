<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','btc3205');

class DBConnector{
 public $conn;

 function __construct(){
  // $mysqli = new mysqli("localhost", "root", "", "btc3205");
  // if ($mysqli->connect_error) {
  //   exit('Error connecting to database'); //Should be a message a typical user could understand in production
  // }

  $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die ("Error: " .mysqli_error($this->conn));
  // mysqli_select_db(DB_NAME, $this->conn);

 }

 public function closeDatabase(){
  mysqli_close($this->conn);
 }

}



?>