
<?php
	date_default_timezone_set("Asia/Manila");
	$mydate = date("Y-m-d");

	//<=====Mall=====>
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	$connection = mysql_connect('localhost', 'gates', 'g@tes2009', 'gates_smm');
	if (!$connection)
	{ die('Could not connect: ' . mysql_error()); }
	mysql_select_db("gates_smm", $connection) or die("Error on database: " . mysql_error());
	//mysql_select_db("gateshms_test", $connection) or die("Error on database: " . mysql_error());
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
?>