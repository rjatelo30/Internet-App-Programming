<?php
include_once '../../../DBConector.php';
include_once 'apiHandler.php';

$api = new ApiHandler();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
 //check api key from header
 $api_key_correct = false;
 $headers = apache_request_headers();
 $header_api_key = $headers['Authorization'];
 $api->setUser_api_key($header_api_key);
 $api_key_correct = $api->checkApiKey();

 if($api_key_correct){
   //creating an order
   $name_of_food = $_POST['name_of_food'];
   $number_of_units = $_POST['number_of_units'];
   $unit_price = $_POST['unit_price'];
   $order_status = $_POST['order_status'];

   $conn = new DBConnector();

   $api->setMeal_name($name_of_food);
   $api->setMeal_units($number_of_units);
   $api->setUnit_price($unit_price);
   $api->setStatus($order_status);
   $res = $api->creatOrder();

   if($res){
    //create json response
    $response_array = ['success' => 1, 'message' => 'Order has been placed'];
    header('Content-type: application/json');
    echo json_encode($response_array);
   }else{
    $response_array = ['failed' => 0, 'messaage' => 'Wrong API Key'];
   }
 }else if($_SERVER['REQUEST_METHOD'] === 'GET'){
   //
 }else{
  //
 }
}
?>