<?php

include ("connect.php");

$result = mysql_query("SELECT Complaint_Code, COUNT(*) FROM tblcomplaints GROUP BY Complaint_Code");

if (!$result){
 die ("Query not allowed: " .mysql_error());
}

$category = array();
$category['name'] = 'Code';
$rows['name'] = 'Total Complaints';
while ($r = mysql_fetch_array($result)) {
    $category['data'][] = $r[0];
    $rows['data'][] = $r[1];
}
$rslt = array();
array_push($rslt, $category);
array_push($rslt, $rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);
mysql_close($conn);

?>