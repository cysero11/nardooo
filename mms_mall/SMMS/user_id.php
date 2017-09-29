<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$user = $_GET['user'];
$pass = $_GET['pass'];
/*
$user = "jun";
$pass = "jun";
*/
$response = array();

$select1 = mysql_query("select userid, usertype, firstname, middlename, lastname from tbluser where username like '".$user."' and password like '".$pass."' and groupaccess like '0000003'");
if(mysql_num_rows($select1) <> 0){
	$row = mysql_fetch_array($select1);
	$response["userid"] = $row["userid"];
	$response["name"] = $row["firstname"]." ".$row["middlename"]." ".$row["lastname"];
	$response["success"] = 1;
}

echo json_encode($response);

?>