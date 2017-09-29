<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$staff_task_id = $_POST["id"];
//$staff_task_id = "ST-0000033";

$response = array();

$quer = mysql_query("update pmls_android_worker_task set startt = NOW() where staff_task_id like '".$staff_task_id."'");

$response["rows"] = mysql_affected_rows();

echo json_encode($response);

?>