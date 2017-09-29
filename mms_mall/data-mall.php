<?php

include("connect.php");

$query = mysql_query("SELECT mallid, SUM(fnmGTDlySls) FROM db_sales GROUP BY mallid");

$category = array();
$category['name'] = 'Mall';
 
$series1 = array();
$series1['name'] = 'Total';
 

while($r = mysql_fetch_array($query)) {
    $category['data'][] = $r[0];
    $series1['data'][] = $r[1];

}
$result = array();
array_push($result,$category);
array_push($result,$series1);


print json_encode($result, JSON_NUMERIC_CHECK);
?>