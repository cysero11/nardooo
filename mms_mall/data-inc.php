<?php

include ("connect.php");


$query = mysql_query("SELECT applicationDate, COUNT(*) FROM tbltrans_inquiry WHERE req_status ='Incomplete' GROUP BY applicationDate");

$category = array();
$category['name'] = 'Date';
 
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