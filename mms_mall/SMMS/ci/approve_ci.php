<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

$salesid = $_POST["id"];

$quer = mysql_query("update refsalesinquiry set status = 'Approved' where salesinquiryid like '".$salesid."'");


?>