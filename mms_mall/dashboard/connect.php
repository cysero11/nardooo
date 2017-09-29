<?php
	set_time_limit(0);
	date_default_timezone_set("Asia/Manila");
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	$connection = mysql_connect("localhost", "gates", "g@tes2009");
	//$connection = mysql_connect("192.168.3.130", "gates", "g@tes2009");
	mysql_select_db("gates_smm", $connection);
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
	
	$file = "mydate.txt";
	$open = fopen($file, 'r');
	$size = filesize($file);	
	$str = str_replace("\n", "", fread($open, $size));
	fclose($open);
	$mydate = date("Y-m-d", strtotime($str));
	$mydate2 = date("Y-m-d", strtotime("-7 days", strtotime($mydate)));
	$dayofweek = date("w", strtotime($mydate)) + 1;
	
	$todayweek = "";
	$prevweek = "";
	
	$dpadding1 = "";
	$dpadding2 = "";
	for($i=1; $i<=7-$dayofweek; $i++)
	{ $dpadding1 .= "|" . date("Y-m-d", strtotime("+" . $i . " days", strtotime($mydate))); }
	for($j=$dayofweek-1; $j>=1; $j--)
	{ $dpadding2 .= "|" . date("Y-m-d", strtotime("-" . $j . " days", strtotime($mydate))); }
	$todayweek = $dpadding2 . "|" . $mydate . $dpadding1;
	
	$dpadding3 = "";
	$dpadding4 = "";
	for($x=1; $x<=7-$dayofweek; $x++)
	{ $dpadding3 .= "|" . date("Y-m-d", strtotime("+" . $x . " days", strtotime($mydate2))); }
	for($y=$dayofweek-1; $y>=1; $y--)
	{ $dpadding4 .= "|" . date("Y-m-d", strtotime("-" . $y . " days", strtotime($mydate2))); }
	$prevweek = $dpadding4 . "|" . $mydate2 . $dpadding3;
	
	
?>