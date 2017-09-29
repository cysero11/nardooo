<?php
	set_time_limit(0);
	date_default_timezone_set("Asia/Manila");
	$mydate = date("Y-m-d");

	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
 /* The following 4 code lines contains the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection.   */

    /*$hostdb = "192.168.3.211";  // MySQl host
   $userdb = "gates";  // MySQL username
   $passdb = "g@tes2009";  // MySQL password
   $namedb = "cms";  // MySQL database name
   
   */
   $hostdb = "172.16.1.174";  // MySQl host
   $userdb = "gates";  // MySQL username
   $passdb = "g@tes2009";  // MySQL password
   $namedb = "acctgdata";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

  /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }





?>