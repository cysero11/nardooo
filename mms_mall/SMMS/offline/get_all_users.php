<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response = array();

$response["users"] = array();

$query = mysql_query("select userid, username, password, firstname, middlename, lastname, groupaccess from tbluser");
if(mysql_num_rows($query) <> 0){
	while($row = mysql_fetch_array($query)){
		$vals = array();
		$vals["usesrid"] = $row["userid"];
		$vals["username"] = $row["username"];
		$vals["password"] = $row["password"];
		$vals["name"] = $row["firstname"]." ".$row["middlename"]." ".$row["lastname"];
		$vals["type"] = $row["groupaccess"];
		array_push($response["users"], $vals);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>