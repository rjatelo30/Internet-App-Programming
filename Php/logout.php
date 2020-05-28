<?php
include_once 'user.php';

$username = null;
$password = null;
$first_name = null;
$last_name = null;
$city = null;
$error = null;

$instance = new User($first_name, $last_name, $city, $username, $password, $error);
$instance->logout();

?>