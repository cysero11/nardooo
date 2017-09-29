<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$response = array();
$response["charges"] = array();

$query = mysql_query("select chargetypeid, description from tblref_charges_type");
if(mysql_num_rows($query) <> 0){
	while($row = mysql_fetch_array($query)){
		$list = array();
		$list["chargetypeid"] = $row["chargetypeid"];
		$list["description"] = $row["description"];
		array_push($response["charges"], $list);
	}
	$response["success"] = 1;
}else{
	$response["success"] = 0;
}

echo json_encode($response);

?>