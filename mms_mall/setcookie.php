<?php
	include("connect.php");
	switch($_REQUEST["type"])
	{
		case "in":
			$sqlmn = " SELECT Machine_No FROM tblsys_setup2 ";
			$resmn = mysql_query($sqlmn, $connection);
			$rowmn = mysql_fetch_array($resmn);

			$sqllmn = " UPDATE tblloggedmachine SET userid = '". $_REQUEST['userid'] ."', Onprocess = '1', xdatein = '". date('Y-m-d H:i:s') ."',  xdateout = '' WHERE Machine_No = '". $rowmn[0] ."' ";
			$reslmn = mysql_query($sqllmn, $connection);
			$rowlmn = mysql_fetch_array($reslmn);

			$sqlmnu = " UPDATE tblmachine SET Onprocess = '1' WHERE Machine_No = '". $rowmn[0] ."' ";
			$resmnu = mysql_query($sqlmnu, $connection);
			$rowmnu = mysql_fetch_array($resmnu);

			$logID = createidno("LOG", "tbllog_sheet", "logID");
			$sqlusertype = " SELECT usertype FROM tbluser WHERE userid = '". $_REQUEST['userid'] ."' ";
			$resusertype = mysql_query($sqlusertype, $connection);
			$rowusertype = mysql_fetch_array($resusertype);

			$sqllogs = " INSERT INTO tbllog_sheet SET logID = '". $logID ."', userid = '". $_REQUEST['userid'] ."', usertype = '". $rowusertype[0] ."', xdatetime = '". date('Y-m-d H:i:s') ."', action = 'Log in', Machine_No = '". $rowmn[0] ."' ";
			$reslogs = mysql_query($sqllogs, $connection);
			$rowlogs = mysql_fetch_array($reslogs);

			$sqlloginstat2 = " UPDATE tbluser SET loginstat = '1' WHERE userid = '". $_REQUEST['userid'] ."' ";
			$resloginstat2 = mysql_query($sqlloginstat2, $connection);
			$rowloginstat2 = mysql_fetch_array($resloginstat2);

			setcookie("userid", $_REQUEST["userid"], time()+60*60*24);
			echo "<script>window.location='index.php';</script>";
		break;
		case "out":
			$sqlmn2 = " SELECT Machine_No FROM tblsys_setup2 ";
			$resmn2 = mysql_query($sqlmn2, $connection);
			$rowmn2 = mysql_fetch_array($resmn2);

			$sqllmn2 = " UPDATE tblloggedmachine SET Onprocess = '0', xdateout = '". date('Y-m-d H:i:s') ."' WHERE Machine_No = '". $rowmn2[0] ."' ";
			$reslmn2 = mysql_query($sqllmn2, $connection);
			$rowlmn2 = mysql_fetch_array($reslmn2);

			$sqlmnu2 = " UPDATE tblmachine SET Onprocess = '0' WHERE Machine_No = '". $rowmn2[0] ."' ";
			$resmnu2 = mysql_query($sqlmnu2, $connection);
			$rowmnu2 = mysql_fetch_array($resmnu2);

			$logID2 = createidno("LOG", "tbllog_sheet", "logID");
			$sqlusertype2 = " SELECT usertype FROM tbluser WHERE userid = '". $_COOKIE['userid'] ."' ";
			$resusertype2 = mysql_query($sqlusertype2, $connection);
			$rowusertype2 = mysql_fetch_array($resusertype2);

			$sqllogs2 = " INSERT INTO tbllog_sheet SET logID = '". $logID2 ."', userid = '". $_COOKIE['userid'] ."', usertype = '". $rowusertype2[0] ."', xdatetime = '". date('Y-m-d H:i:s') ."', action = 'Log out', Machine_No = '". $rowmn2[0] ."' ";
			$reslogs2 = mysql_query($sqllogs2, $connection);
			$rowlogs2 = mysql_fetch_array($reslogs2);

			$sqlloginstat = " UPDATE tbluser SET loginstat = '0' WHERE userid = '". $_COOKIE['userid'] ."' ";
			$resloginstat = mysql_query($sqlloginstat, $connection);
			$rowloginstat = mysql_fetch_array($resloginstat);

			setcookie("userid", "", time()-60*60*24);
			echo "<script>window.location='loginpage.php';</script>";
		break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
</body>
</html>