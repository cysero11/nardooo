<?php
error_reporting(E_ALL ^ E_DEPRECATED);

$response = array();
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$db ? $response["success"] = 1 : $response["success"] = 0;
echo json_encode($response);
?>