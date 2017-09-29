<?php
	date_default_timezone_set("Asia/Manila");
	$mydate = date("Y-m-d");

	// mygeps connection
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	$connection = mysqlI_connect('localhost', 'gates', 'g@tes2009', 'gates_smm');
	if (!$connection)
	{ die('Could not connect: ' . mysqli_connect_error()); }
?>