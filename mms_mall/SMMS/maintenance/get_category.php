<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response = array();
$response["category"] = array();

$query = mysql_query("select chrgid, chrgname, chrgamount from tblref_charges where xcat like 'Maintenance'");
if(mysql_num_rows($query) <> 0){
	while($row = mysql_fetch_array($query)){
		$list = array();
		$list["chrgid"] = $row["chrgid"];
		$list["chrgname"] = $row["chrgname"];
		$list["chrgamount"] = $row["chrgamount"];
		array_push($response["category"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>