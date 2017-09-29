<?php

include("connect.php");

$query = mysql_query("SELECT xdate, SUM(amount), SUM(paymentamount) FROM tbltransaction GROUP BY xdate");

$category = array();
$category['name'] = 'Month';
 
$series1 = array();
$series1['name'] = 'Revenue';
 
$series2 = array();
$series2['name'] = 'Expenses';

while($r = mysql_fetch_array($query)) {
    $category['data'][] = $r[0];
    $series1['data'][] = $r[1];
    $series2['data'][] = $r[2];
}
$result = array();
array_push($result,$category);
array_push($result,$series1);
array_push($result,$series2);

print json_encode($result, JSON_NUMERIC_CHECK);
?>