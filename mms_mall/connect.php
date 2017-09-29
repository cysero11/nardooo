<?php
	set_time_limit(0);
	date_default_timezone_set("Asia/Manila");
	$mydate = date("Y-m-d");
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
	//$connection = mysql_connect('192.168.3.211', 'gates', 'g@tes2009');
	$connection = mysql_connect('localhost', 'gates', 'g@tes2009');
	//$connection = mysql_connect('gllorente.netfirmsmysql.com', 'gates', 'g@tes2009');
	if (!$connection) { 
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("gates_smm", $connection) or die("Error on database: " . mysql_error());
	//mysql_select_db("gateshms_test", $connection) or die("Error on database: " . mysql_error());
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
	function timeDiff($t1, $t2)
{
   if($t1 > $t2)
   {
      $time1 = $t2;
      $time2 = $t1;
   }
   else
   {
      $time1 = $t1;
      $time2 = $t2;
   }
   $diff = array(
      'years' => 0,
      'months' => 0,
      'weeks' => 0,
      'days' => 0,
      'hours' => 0,
      'minutes' => 0,
      'seconds' =>0
   );
   foreach(array('years','months','weeks','days','hours','minutes','seconds')
         as $unit)
   {
      while(TRUE)
      {
         $next = strtotime("+1 $unit", $time1);
         if($next < $time2)
         {
            $time1 = $next;
            $diff[$unit]++;
         }
         else
         {
            break;
         }
      }
   }
   return($diff);
}

	function addleadingzero($num)
	{
		$maxid = "";
		$str = strlen($num);
		if($str == 1)
		{ $maxid = "000000" . $num; }
		elseif($str == 2)
		{ $maxid = "00000" . $num; }
		elseif($str == 3)
		{ $maxid = "0000" . $num; }
		elseif($str == 4)
		{ $maxid = "000" . $num; }
		elseif($str == 5)
		{ $maxid = "00" . $num; }
		elseif($str == 6)
		{ $maxid = "0" . $num; }
		else
		{ $maxid = $num; }
		
		return $maxid;
	}
	
	function createidno($tagname, $table, $tblid)
	{
		$myid = "";
		$getmaxno = "SELECT lastid FROM refrecordid WHERE tablename = '" . $table . "'";
		$maxno = mysql_fetch_array(mysql_query($getmaxno));
		$gettblid = "select " . $tblid . " from " . $table . " ORDER BY ID DESC LIMIT 0, 1";
		$tblid = mysql_fetch_array(mysql_query($gettblid));
		if($tagname == "")
		{
			if($maxno[0] == "")
			{
				if($tblid[0] == "")
				{ $myid = addleadingzero("1"); }
				else
				{ $myid = addleadingzero($tblid[0]); }
				$sql = "INSERT INTO refrecordid(tablename, lastid, dateadded) VALUES('" . $table . "', '" . $myid . "', '" . date("Y-m-d") . "')";
				$result = mysql_query($sql);
			}
			else
			{
				if(is_numeric($maxno[0]))
				{
					$myid = addleadingzero($maxno[0]+1);
					$sql = "UPDATE refrecordid SET lastid = '" . $myid . "', dateadded = '" . date("Y-m-d") . "' where tablename = '" . $table . "'";
					$result = mysql_query($sql);
				}
				else
				{
					$myid = addleadingzero("1");
					$sql = "INSERT INTO refrecordid(tablename, lastid, dateadded) VALUES('" . $table . "', '" . $myid . "', '" . date("Y-m-d") . "')";
					$result = mysql_query($sql);
				}
			}
		}
		else
		{
			if($maxno[0] == "")
			{
				if($tblid[0] == "")
				{ $myid = $tagname . "-" . addleadingzero("1"); }
				else
				{
					if(is_numeric($tblid[0]))
					{
						$myarr = explode("-", $tblid[0]);
						$myid = $tagname . "-" . addleadingzero($myarr[1]);
					}
					else
					{ $myid = $tagname . "-" . addleadingzero("1"); }
				}
				$sql = "INSERT INTO refrecordid(tablename, lastid, dateadded) VALUES('" . $table . "', '" . $myid . "', '" . date("Y-m-d") . "')";
				$result = mysql_query($sql);
			}
			else
			{
				$arr = explode("-", $maxno[0]);
				if(is_numeric(end($arr)))
				{
					$myid = $tagname . "-" . addleadingzero(end($arr)+1);
					$sql = "UPDATE refrecordid SET lastid = '" . $myid . "', dateadded = '" . date("Y-m-d") . "' where tablename = '" . $table . "'";
					$result = mysql_query($sql);
				}
				else
				{
					$myid = $tagname . "-" . addleadingzero("1");
					$sql = "INSERT INTO refrecordid(tablename, lastid, dateadded) VALUES('" . $table . "', '" . $myid . "', '" . date("Y-m-d") . "')";
					$result = mysql_query($sql);
				}
			}
		}
		return $myid;
	}

	function create_logs($remarks, $module, $xinfo, $action)
	{
		$sql = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
       	$res = mysql_query($sql);
       	$name = mysql_fetch_array($res);

		$logID = createidno("LOG", "tbllogs_trans", "logID");
		$sql_logs = "INSERT INTO tbllogs_trans (logID, userid, username, mydate, mytime, remarks, module, xinfo, xaction)VALUES('".$logID."', '".$_COOKIE["userid"]."', '".$name["lastname"].", ".$name["firstname"]." ".$name["middlename"]."', '".date("Y-m-d")."', '".date("H:i:s")."', '".$name["lastname"].", ".$name["firstname"]." ".$name["middlename"]." ".$remarks."', '".$module."', '".$xinfo."', '".$action."')";
		$result_logs = mysql_query($sql_logs);
		return 1;
	}

	function createctrlno($tagname, $table, $tblid)
	{
		$myid = "";
		$getmaxno = "SELECT lastid FROM refrecordid WHERE tablename = '" . $table . "'";
		$maxno = mysql_fetch_array(mysql_query($getmaxno));
		$gettblid = "select " . $tblid . " from " . $table . " ORDER BY ID DESC LIMIT 0, 1";
		$tblid = mysql_fetch_array(mysql_query($gettblid));
		if($tagname == "")
		{
			if($maxno[0] == "")
			{
				if($tblid[0] == "")
				{ $myid = addleadingzeroctrl("1"); }
				else
				{ $myid = addleadingzeroctrl($tblid[0]); }
				$sql = "INSERT INTO refrecordid(tablename, lastid, dateadded) VALUES('" . $table . "', '" . $myid . "', '" . date("Y-m-d") . "')";
				$result = mysql_query($sql);
			}
			else
			{
				if(is_numeric($maxno[0]))
				{
					$myid = addleadingzeroctrl($maxno[0]+1);
					$sql = "UPDATE refrecordid SET lastid = '" . $myid . "', dateadded = '" . date("Y-m-d") . "' where tablename = '" . $table . "'";
					$result = mysql_query($sql);
				}
				else
				{
					$myid = addleadingzeroctrl("1");
					$sql = "INSERT INTO refrecordid(tablename, lastid, dateadded) VALUES('" . $table . "', '" . $myid . "', '" . date("Y-m-d") . "')";
					$result = mysql_query($sql);
				}
			}
		}
		else
		{
			if($maxno[0] == "")
			{
				if($tblid[0] == "")
				{ $myid = $tagname . "-" . addleadingzeroctrl("1"); }
				else
				{
					if(is_numeric($tblid[0]))
					{
						$myarr = explode("-", $tblid[0]);
						$myid = $tagname . "-" . addleadingzeroctrl($myarr[1]);
					}
					else
					{ $myid = $tagname . "-" . addleadingzeroctrl("1"); }
				}
				$sql = "INSERT INTO refrecordid(tablename, lastid, dateadded) VALUES('" . $table . "', '" . $myid . "', '" . date("Y-m-d") . "')";
				$result = mysql_query($sql);
			}
			else
			{
				$arr = explode("-", $maxno[0]);
				if(is_numeric(end($arr)))
				{
					$myid = $tagname . "-" . addleadingzeroctrl(end($arr)+1);
					$sql = "UPDATE refrecordid SET lastid = '" . $myid . "', dateadded = '" . date("Y-m-d") . "' where tablename = '" . $table . "'";
					$result = mysql_query($sql);
				}
				else
				{
					$myid = $tagname . "-" . addleadingzeroctrl("1");
					$sql = "INSERT INTO refrecordid(tablename, lastid, dateadded) VALUES('" . $table . "', '" . $myid . "', '" . date("Y-m-d") . "')";
					$result = mysql_query($sql);
				}
			}
		}
		return $myid;
	}

	function addleadingzeroctrl($num)
	{
		$maxid = "";
		$str = strlen($num);
		if($str == 1)
		{ $maxid = "000" . $num; }
		elseif($str == 2)
		{ $maxid = "00" . $num; }
		elseif($str == 3)
		{ $maxid = "0" . $num; }
		else
		{ $maxid = $num; }
		
		return $maxid;
	}

	function getusername()
	{
		$sql = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
       	$res = mysql_query($sql);
       	$name = mysql_fetch_array($res);

       	return $name["lastname"].", ".$name["firstname"]." ".$name["middlename"];
	}

	function create_logs_per_transaction($remarks, $module, $xinfo, $action, $inqID, $appID, $tenID)
	{
		$sql = "SELECT firstname, middlename, lastname FROM tbluser WHERE userid = '".$_COOKIE["userid"]."'";
       	$res = mysql_query($sql);
       	$name = mysql_fetch_array($res);

		$logID = createidno("LOG", "tbllogs_per_trans", "logID");
		$sql_logs = "INSERT INTO tbllogs_per_trans (logID, userid, username, mydate, mytime, remarks, module, xinfo, xaction, inqID, appID, tenID)VALUES('".$logID."', '".$_COOKIE["userid"]."', '".$name["lastname"].", ".$name["firstname"]." ".$name["middlename"]."', '".date("Y-m-d")."', '".date("H:i:s")."', '".$name["lastname"].", ".$name["firstname"]." ".$name["middlename"]." ".$remarks."', '".$module."', '".$xinfo."', '".$action."', '".$inqID."', '".$appID."', '".$tenID."')";
		$result_logs = mysql_query($sql_logs);
		return 1;
	}

	function strchk($val)
	{
		$str = "";
		if($val == "")
		{ $str = "N/A"; }
		else
		{ $str = $val; }
		return $str;
	}

	function getrentvattype()
	{
		$sql = "SELECT chrgvatpercent, vatable, vattype, chrgpenaltytype, chrgpenalvatper, chrgpenalvatable, chrgpenalvattype, chrgpealamount, chrgpenalpercent FROM tblref_charges WHERE chrgname = 'Monthly Rental'";
       	$res = mysql_query($sql);
       	$charge = mysql_fetch_array($res);

       	if($charge["vatable"] == "yes")
       	{
       		if($charge["vattype"] == "inc")
       		{
       			$theader = "Vat ".$charge["chrgvatpercent"]."% (Inc)";
       		}
       		else
       		{
       			$theader = "Vat ".$charge["chrgvatpercent"]."% (Exc)";
       		}
       	}
       	else
       	{
       		$theader = "Vat";
       	}
       	
       	return $charge["chrgvatpercent"]."|".$charge["vatable"]."|".$charge["vattype"] . "|" . $theader . "|" . $charge["chrgpenaltytype"]. "|" .$charge["chrgpenalvatper"]. "|" .$charge["chrgpenalvatable"]. "|" .$charge["chrgpenalvattype"] . "|" . $charge["chrgpealamount"] . "|" . $charge["chrgpenalpercent"];
	}

	function getsysdate()
	{
		$sql = mysql_fetch_array(mysql_query("SELECT eoddate FROM tbltrans_eod ORDER BY eoddate DESC LIMIT 0,1"));
		if($sql[0] == "")
		{
			return date("Y-m-d"); //if eod table is empty
		}
		else
		{
			return date("Y-m-d", strtotime($sql[0]));
		}
	}

?>
