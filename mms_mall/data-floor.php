<?php

require ("connect.php");

$result = mysql_query("SELECT floor, COUNT(floorid) as 'total' FROM tblref_floorsetup GROUP BY FLOOR");

$rows['type'] = 'pie';
$rows['name'] = 'Floor';
//$rows['innerSize'] = '50%';
while ($r = mysql_fetch_array($result)) {
    $rows['data'][] = array($r['floor'] , $r['total']);    
}
$rslt = array();
array_push($rslt,$rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);
mysql_close($conn);

?>