<?php
include "Crud.php";
include_once "DBConnector.php";

class User implements Crud{
 private $user_id;
 private $first_name;
 private $last_name;
 private $city_name;

 function __construct($first_name, $last_name, $city_name){
  $this->first_name = $first_name;
  $this->last_name = $last_name;
  $this->city_name = $city_name;
 }

 public function setUserId($user_id){
  $this->user_id = $user_id;
 }

 public function getUserId(){
  return $this->$user_id;
 }

 public function save(){
  $conn = new DBConnector;
  $fn = $this->first_name;
  $ln = $this->last_name;
  $city = $this->city_name;

  $res = mysqli_query($conn->conn, "INSERT INTO `user`(`first_name`, `last_name`, `user_city`) VALUES ('$fn', '$ln', '$city')")or die ("Error: " .mysqli_error($conn->conn));
     return $res;
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
}




?>