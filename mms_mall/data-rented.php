

<?php

include ("connect.php");

$result = mysql_query("SELECT dateadded,
COUNT(status= 'occupied'),
COUNT(STATUS = 'vacant')
FROM tblref_unit
GROUP BY dateadded");

$category = array();
$category['name'] = 'Date';

$series1 = array();
$series1['name'] = 'Rented';

$series2 = array();
$series2['name'] = 'Vacant';


while ($r = mysql_fetch_array($result)) {
    $category['data'][] = $r[0];
    $series1['data'][] = $r[1];
    $series2['data'][] = $r[2];
}
$rslt = array();
array_push($rslt, $category);
array_push($rslt, $series1);
array_push($rslt, $series2);


print json_encode($rslt, JSON_NUMERIC_CHECK);
mysql_close($conn);

?>