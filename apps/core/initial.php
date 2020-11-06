<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include_once 'App.php';
include_once 'Controller.php';
include_once 'config/Database.php';
include_once 'config/config.php';
include_once 'config/Authorize.php';
