<?php
include("connect.php");
$result = mysql_query("SELECT Trade_Name, COUNT(*) FROM tbltrans_inquiry WHERE UnitType = 'SET' AND STATUS='occupied' GROUP BY Trade_Name");
#$result = mysql_query("SELECT name, val FROM web_marketing");
//$rows = array();
$rows['type'] = 'pie';
$rows['name'] = 'Occupied';
//$rows['innerSize'] = '50%';
while ($r = mysql_fetch_array($result)) {
    $rows['data'][] = array($r[0] , $r[1]);    
}
$rslt = array();
array_push($rslt,$rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);
?>