<?php

include 'connect.php';

        $sql = mysql_query("SELECT datepayment, COUNT(*) FROM tbltrans_tenants GROUP BY datepayment");
    
#$result = mysql_query("SELECT name, val FROM web_marketing");
//$rows = array();
$rows['type'] = 'pie';
$rows['name'] = 'Tenants';
//$rows['innerSize'] = '50%';
}
while ($r = mysql_fetch_array($sql)) {
    $rows['data'][] = array($r[0] , $r[1]);    
}
$rslt = array();
array_push($rslt,$rows);
print json_encode($rslt, JSON_NUMERIC_CHECK);
mysql_close($conn);

?>