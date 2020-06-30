<?php
include_once '../../../DBConnector.php';

Class ApiHandler{
 private $meal_name;
 private $meal_units;
 private $unit_price;
 private $status;
 private $user_api_key;

	public  function getMeal_name() {
		return this.$meal_name;
	}

	public function setMeal_name($meal_name) {
		this.$meal_name = $meal_name;
	}

	public function getMeal_units() {
		return this.$meal_units;
	}

	public function setMeal_units( $meal_units) {
		this.$meal_units = $meal_units;
	}

	public  function getUnit_price() {
		return this.$unit_price;
	}

	public function setUnit_price( $unit_price) {
		this.$unit_price = $unit_price;
	}

	public  function getStatus() {
		return this.$status;
	}

	public function setStatus( $status) {
		this.$status = $status;
	}

	public  function getUser_api_key() {
		return this.$user_api_key;
	}

	public function setUser_api_key( $user_api_key) {
		this.$user_api_key = $user_api_key;
	}

 public function createOrder(){
  $conn = new DBConnector;

  $res = mysqli_query($conn->conn, "INSERT INTO `orders`( `order_name`, `units`, `unit_price`, `orer_status`) VALUES (`$this->$meal_name`, `$this->$meal_units`, `$this->$unit_price`, `$this->$status`)");

  return $res;
 }

 public function checkOrderStatus(){

 }

 public function fetchAllOrders(){

 }

 public function checkApiKey(){

 }

 public function checkContentType(){
  
 }

}
?>