<?php
    include('../connect.php');

    switch ($_POST['form']) 
	{
		case 'tbltenantlists':
			$page = $_POST['page'];
			$limit = ($page-1) * 20;

			$search = "tbltrans_tenants.ustatus = 'occupied' AND tbltrans_tenants.Status = 'actived' AND ( tbltrans_tenants.tradename LIKE '%" . $_POST['txtsearchapplication'] . "%' OR  tbltrans_tenants.TenantID LIKE '%" . $_POST['txtsearchapplication'] . "%' OR  tbltrans_tenants.companyname LIKE '%" . $_POST['txtsearchapplication'] . "%') ";
			 
			$sql = "SELECT tbltrans_tenants.TenantID, tbltrans_tenants.tradename, tbltrans_tenants.companyname, tbltrans_tenants.datefrom, tbltrans_tenants.dateto, tbltrans_tenants.tenanttype, tbltrans_tenants.revpercent, tbltrans_tenants.merchant_code, tblref_mall.mallname, tbltrans_tenants.tenanttype, tbltrans_tradename.filename, tbltrans_tradename.companyID, tbltrans_tenants.tradeID FROM tbltrans_tenants INNER JOIN tblref_mall ON tbltrans_tenants.mallID = tblref_mall.mallid INNER JOIN tbltrans_tradename ON tbltrans_tradename.tradeID = tbltrans_tenants.tradeID WHERE ".$search." LIMIT ".$limit.",20 ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result))
			{
				if($row[5] === "Rent | Rev")
				{	$row[5] = "Rent + Rev";	}
				if($row[6] != "")
				{ $plus = "+ "; $percent = "% Revenue"; }
				else{ $plus = ""; $percent = ""; }
				
				if($row[5] == "Rent | Rev" || $row[5] == "Rent + Rev")
				{ $status = '<span class="label label-sm label-success arrowed-in-right arrowed"><i class="ace-icon fa fa-tag bigger-80"></i>&nbsp;&nbsp;Rent + Revenue&nbsp;</span>'; }
				elseif($row[5] == "Rent")
				{ $status = '<span class="label label-sm label-info arrowed-in-right arrowed"><i class="ace-icon fa fa-tag bigger-80"></i>&nbsp;&nbsp;Rent Only&nbsp;</span>'; }
				elseif($row[5] == "Rent or Share")
				{ $status = '<span class="label label-sm label-yellow arrowed-in-right arrloadpagebillingwed"><i class="ace-icon fa fa-tag bigger-80"></i>&nbsp;&nbsp;Rent or Share&nbsp;</span>'; }
				elseif($row[5] == "Share Only")
				{ $status = '<span class="label label-sm label-light arrowed-in-right arrowed"><i class="ace-icon fa fa-tag bigger-80"></i>&nbsp;&nbsp;Share Only&nbsp;</span>'; }
				$getbalance = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '".$row['TenantID']."'", $connection));
				echo "
					<tr>
						<td width='15%' class='hide_mobile'>" . $row[0] . "</td>
						<td width='20%' class='hide_mobile'>" . $row[1] . "</td>
						<td width='20%' class='hide_mobile'>" . $row[2] . "</td>
						<td width='15%' class='hide_mobile' align='left'>" . $status . "</td>
						<td width='10%' class='hide_mobile' align='center'>".$plus."" . $row[6] . " ".$percent."</td>
						<td width='15%' class='hide_mobile' align='right'>" . number_format($getbalance[0], "2", ".", ",") . "</td>
						<td width='5%' class='hide_mobile' align='center'>
							<button class='btn btn-xs btn-grey' onclick='openbilling(\"".$row["TenantID"]."\", \"".$row["tradename"]."\", \"".$row["companyname"]."\",\"".$row["mallname"]."\",\"".$row["merchant_code"]."\",\"".$row[5]."\", \"server/company/".$row["companyID"]."/trades/".$row["tradeID"]."/".$row["filename"]."\");'>
								<img src='assets/images/invoice.png' style='width: 100%; height: auto;' />
							</button>
						</td>
					</tr>
				";
			}

		break;

		case 'loadtransaction':
			$totalamount = 0;
			$translist = "";
			//QUERY FOR LOADING TRANSACTION LIST FOR CURRENT MONTH
			$ressoa = mysql_query("SELECT soaNo, month_period, year_period FROM tbltrans_processedsoa", $connection);
			while ($row = mysql_fetch_array($ressoa))
			{
				$billingperiod = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '". $row[1] ."' AND year_period = '". $row[2] ."' ", $connection));

				$collection = mysql_fetch_array(mysql_query("SELECT xdate, description, SUM(amount), SUM(qty), SUM(balance), reference, SUM(vatamount), xdescription FROM tbltransaction WHERE tenantid = '". $_POST['transid'] ."' AND xdate = '". date('Y-m-d', strtotime($row[2]."-".$row[1]."-01")) ."' AND paymenttype = '' ", $connection));

				$ttl = floatval($collection[2]) + floatval($collection[6]);
				echo "
					<tr onclick='showdrilldown(\"".$collection[0]."\", \"".$_POST['transid']."\")'>
						<td>". $row[0] ."</td>
						<td>". date('M Y', strtotime($billingperiod[0])) ." - ". date('M Y', strtotime($billingperiod[1])) ."</td>
						<td style='text-align: right;'>".number_format($collection[2], "2", ".", ",")."</td>
						<td style='text-align: right;'>".number_format($collection[6], "2", ".", ",")."</td>
						<td style='text-align: right;'>".number_format(floatval($ttl), "2", ".", ",")."</td>
						<td style='text-align: right;'>".number_format($collection[4], "2", ".", ",")."</td>
					</tr>
				";
			}
			$currbal = mysql_fetch_array(mysql_query("SELECT pleft FROM dunn_tblsoaheader WHERE Tenantid = '". $_POST['transid'] ."' ORDER BY id DESC", $connection));
			if($currbal[0] == "0.00" || $currbal[0] == 0){
				$runningbalance = "0.00";
			}else{
				$runningbalance = "-".$currbal[0];
			}
			echo "|".number_format($runningbalance, "2", ".", ",");
		break;

		case 'savepayment':

			if($_POST["checkdate"] != "")
			{
				$chkdate = date("Y-m-d", strtotime($_POST['checkdate']));
			}
			else
			{
				$chkdate = "";
			}
			$datenow = getsysdate();

			$Machine_No = mysql_fetch_array(mysql_query("SELECT Machine_No FROM tblsys_setup2"));
			$year = date('Y', strtotime($datenow));
			$month = date('m', strtotime($datenow));
			$xdate = date('Y-m-d', strtotime($year."-".$month."-1"));

			if($_POST['itemamount2'] <= $_POST['amount']){
				$arr = explode("|", $_POST['itemamount']);
				for ($j=1; $j <= count($arr)-1 ; $j++) { 
				$sql = "INSERT INTO tbltransaction SET tenantid = '" . $_POST["tenantid"] . "', description = '" . $_POST["paymenttype"] . "', amount = '-" . $arr[$j] . "', qty = '1', xdate = '" . $xdate . "', reference = '" . $_POST["remarks"] . "', xdatetime = '" . date("Y-m-d H:i:s") . "', paymenttype = '" . $_POST["paymenttype"] . "', cardholder = '" . $_POST["ccholder"] . "', ccno = '" . $_POST["ccno"] . "', expdate = '" . $_POST["expdate"] . "', checkno = '". $_POST['checknno'] ."', checkdate = '". $chkdate ."', bankname = '". $_POST['checkname'] ."', orno = '". $_POST['bankname'] ."', totalamount = '". $arr[$j] ."', authno = '". $_POST['authno'] ."', secno = '". $_POST['secno'] ."', cardtype = '". $_POST["cardtype"] ."', bnkfrom = '". $_POST["namefrom"] ."', bnkto = '". $_POST["nameto"] ."', accnofrom = '". $_POST["accfrom"] ."', accnoto = '". $_POST["accto"] ."', userid = '". $_COOKIE['userid'] ."', Machine_No = '". $Machine_No[0] ."' ";
				$result = mysql_query($sql, $connection);
				}
			}

			if($_POST["balreamount"] != '0.00' || $_POST["balreamount"] != '0' || $_POST["balreamount"] != ''){
				$forwaringbalance = mysql_query("INSERT INTO tbltransaction SET tenantid = '". $_POST['tenantid'] ."', description = '". $_POST['paymenttype'] ."', amount = '-". $_POST['balreamount'] ."', totalamount = '". $_POST['balreamount'] ."', xdate = '". $xdate ."', paymenttype = '". $_POST['paymenttype'] ."', userid = '". $_COOKIE['userid'] ."', Machine_No = '". $Machine_No[0] ."', balance = '-". $_POST['balreamount'] ."', qty = '1' ", $connection);
			}
			
			$list = explode("|", $_POST['itemid']);
			$amountlist = explode("|", $_POST['itemamount']);
			$balancelist = explode("|", $_POST['itembalance']);
			for($x=1;$x<=count($list);$x++)
			{
				$updatebalance = "UPDATE tbltransaction SET paymentamount = '" . $amountlist[$x] . "', balance = '" . $balancelist[$x] . "' WHERE tenantid = '" . $_POST['tenantid'] . "' AND id = '" . $list[$x] . "'";
				$updateresult = mysql_query($updatebalance, $connection);
			}
			
			if($_POST['paymenttype'] === "Check")
			{
				$sql = mysql_query("UPDATE tbltrans_pdc SET paymentstat = '1' WHERE checkno = '" . $_POST['checkno'] . "' AND customerid = '" . $_POST['tenantid'] . "' AND paymentstat = '0'");
			}

		break;

		case 'savedeposit':
		
			if($_POST["checkdate"] != "")
			{
				$chkdate = date("Y-m-d", strtotime($_POST['checkdate']));
			}
			else
			{
				$chkdate = "";
			}
			$datenow = getsysdate();
			$year = date('Y', strtotime($datenow));
			$month = date('m', strtotime($datenow));
			$xdate = date('Y-m-d', strtotime($year."-".$month."-1"));
			$Machine_No = mysql_fetch_array(mysql_query("SELECT Machine_No FROM tblsys_setup2"));

			$sql = "INSERT INTO tbltransaction SET tenantid = '" . $_POST["tenantid"] . "', description = '" . $_POST["remarks"] . "', amount = '-" . $_POST["amount"] . "', qty = '1', xdate = '" . $xdate . "', xdatetime = '" . date("Y-m-d H:i:s") . "', paymenttype = '" . $_POST["paymenttype"] . "', cardholder = '" . $_POST["ccholder"] . "', ccno = '" . $_POST["ccno"] . "', expdate = '" . $_POST["expdate"] . "', checkno = '". $_POST['checknno'] ."', checkdate = '". $chkdate ."', bankname = '". $_POST['bankname'] ."', orno = '". $_POST['orno'] ."', totalamount = '". $_POST['amount'] ."', authno = '". $_POST['authno'] ."', secno = '". $_POST['secno'] ."', cardtype = '". $_POST["cardtype"] ."', bnkfrom = '". $_POST["namefrom"] ."', bnkto = '". $_POST["nameto"] ."', accnofrom = '". $_POST["accfrom"] ."', accnoto = '". $_POST["accto"] ."', userid = '". $_COOKIE['userid'] ."', Machine_No = '". $Machine_No[0] ."', isdeposit = '1', checkname = '". $_POST['checkname'] ."', paymentamount = '". $_POST['amount'] ."', balance = '-". $_POST['amount'] ."' ";
			$result = mysql_query($sql, $connection);
			
			// $list = explode("|", $_POST['itemid']);
			// $amountlist = explode("|", $_POST['itemamount']);
			// $balancelist = explode("|", $_POST['itembalance']);
			// for($x=1;$x<=count($list);$x++)
			// {
			// 	$updatebalance = "UPDATE tbltransaction SET paymentamount = '" . $amountlist[$x] . "', balance = '" . $balancelist[$x] . "' WHERE tenantid = '" . $_POST['tenantid'] . "' AND id = '" . $list[$x] . "'";
			// 	$updateresult = mysql_query($updatebalance, $connection);
			// }
			
			// if($_POST['paymenttype'] === "Check")
			// {
			// 	$sql = mysql_query("UPDATE tbltrans_pdc SET paymentstat = '1' WHERE checkno = '" . $_POST['checkno'] . "' AND customerid = '" . $_POST['tenantid'] . "' AND paymentstat = '0'");
			// }

		break;

		case 'savettenantslist':
			if($_POST['tenantid'] == ""){
				$tenantid = "";
			}else{
				$tenantid = "AND tenantid = '". $_POST['tenantid'] ."'";
			}

			$month = date('m', strtotime($_POST['xdate']));
			$year = date('Y', strtotime($_POST['xdate']));
			$xdatemustbe = date('Y-m-d', strtotime($year."-".$month."-1"));

			$slct = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '".date("m", strtotime($_POST["xdate"]))."' AND year_period = '".date("Y", strtotime($_POST["xdate"]))."'"));

			// UPDATE PROCESSED PERIOD
			$period = mysql_query("UPDATE tbltrans_processedbill SET gen_xstat = '1' WHERE month_period = '".date('n', strtotime($_POST['xdate']))."' AND year_period = '".date("Y", strtotime($_POST["xdate"]))."'");

			$getperiod = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '".date("n", strtotime($_POST["xdate"]))."' AND year_period = '".date("Y", strtotime($_POST["xdate"]))."'"));
			// GENERATING OF BILLS
			$sql = "SELECT TenantID, companyname, costpermonths, assoc_dues FROM tbltrans_tenants WHERE ustatus = 'occupied' AND Status = 'actived' ". $tenantid ." AND ((datefrom = '".date("Y/m/d", strtotime($slct["datefrom"]))."' AND dateto = '".date("Y/m/d", strtotime($slct["dateto"]))."') OR(datefrom < '".date("Y/m/d", strtotime($slct["datefrom"]))."' AND dateto > '".date("Y/m/d", strtotime($slct["dateto"]))."') OR(datefrom < '".date("Y/m/d", strtotime($slct["datefrom"]))."' AND dateto < '".date("Y/m/d", strtotime($slct["dateto"]))."' AND dateto > '".date("Y/m/d", strtotime($slct["datefrom"]))."') OR(datefrom > '".date("Y/m/d", strtotime($slct["datefrom"]))."' AND dateto > '".date("Y/m/d", strtotime($slct["dateto"]))."' AND datefrom < '".date("Y/m/d", strtotime($slct["dateto"]))."') OR(datefrom = '".date("Y/m/d", strtotime($slct["datefrom"]))."' AND dateto > '".date("Y/m/d", strtotime($slct["dateto"]))."') OR(datefrom < '".date("Y/m/d", strtotime($slct["datefrom"]))."' AND dateto = '".date("Y/m/d", strtotime($slct["dateto"]))."') OR(datefrom < '".date("Y/m/d", strtotime($slct["datefrom"]))."' AND dateto < '".date("Y/m/d", strtotime($slct["dateto"]))."') ) ORDER BY companyname ASC";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result))
			{ 
				$rent = 0;
				$revamount = 0;
				$gettype = mysql_fetch_array(mysql_query("SELECT tenanttype, revpercent FROM tbltrans_tenants WHERE TenantID = '".$row['TenantID']."' AND ustatus = 'occupied' AND Status = 'actived'"));
				
				$gettotalsales = mysql_fetch_array(mysql_query("SELECT SUM(fnmGTDlySls) FROM db_sales WHERE tenantid = '".$row['TenantID']."' AND (YEAR(fdtTrnsctn) = '".date("Y", strtotime($_POST["xdate"]))."' AND MONTH(fdtTrnsctn)='".date("n", strtotime($_POST["xdate"]))."') AND (fdtTrnsctn >= '".date("Y-m-d", strtotime($getperiod["datefrom"]))."' AND fdtTrnsctn <= '".date("Y-m-d", strtotime($getperiod["dateto"]))."')"));

				//
				$header = explode("|", getrentvattype());
				$vatpercent = floatval($header[0]) / 100;
				$revamount_share = floatval($gettotalsales[0]) * (floatval($gettype["revpercent"])/100);
				// echo $gettotalsales[0];

				if($gettype['tenanttype'] === "Rent")
				{						
					if($header[1] == "yes")
                    {
                        if($header[2] == "inc") //inclusive vat
                        {
                            $amountvat = floatval($row['costpermonths']) * $vatpercent;
                            $rentbeforevat = floatval($row['costpermonths']) - $amountvat;

                            $rent = $rentbeforevat; //less vat
                            $vat = $amountvat;
                            $revenue = 0;

                            $ttl = $amountvat + $rentbeforevat;
                        }
                        else //exclusive vat
                        {
                            $amountvat = floatval($row['costpermonths']) * $vatpercent;
                            $rentplusvat = floatval($row['costpermonths']);

                            $rent = floatval($row['costpermonths']); //orig rate of rent
                            $vat = $amountvat;
                            $revenue = 0;

                            $ttl = floatval($row['costpermonths']) + $amountvat;
                        }
                    }
                    else
                    {
                        $rent = $row['costpermonths'];
                        $vat = "0.00";
                        $revenue = 0;

                        $ttl = floatval($row['costpermonths']);
                    }
				}
				else if($gettype['tenanttype'] === "Rent | Rev")
				{	
					$share = $revamount_share;
					if($header[1] == "yes")
                    {
                        if($header[2] == "inc") //inclusive vat
                        {
                            $amountvat = floatval($row['costpermonths']) * $vatpercent; //rent
                            $rentbeforevat = floatval($row['costpermonths']) - $amountvat; //rent   

                            $amountvat_share = floatval($revamount_share) * $vatpercent; //rent
                            $rentbeforevat_share = $revamount_share - $amountvat_share; //rent                      

                            $rent = $rentbeforevat; //less vat
                            $vat = $amountvat;
                            $ttl = $rentbeforevat + $amountvat;

                            $revenue = $rentbeforevat_share;
                            $vat_share = $amountvat_share;
                            $ttl_share = $amountvat_share + $rentbeforevat_share;
                        }
                        else //exclusive vat
                        {
                            $amountvat = floatval($row['costpermonths']) * $vatpercent; //rent
                            $rentplusvat = floatval($row['costpermonths']); //rent

                            $amountvat_share = floatval($revamount_share) * $vatpercent; //rent
                            $rentbeforevat_share = $revamount_share + $amountvat_share; //rent  

                            $rent = floatval($row['costpermonths']); //orig rate of rent
                            $vat = $amountvat;
                            $ttl = floatval($row['costpermonths']) + $amountvat;

                            $revenue = $rentbeforevat_share; //less vat
                            $vat_share = $amountvat_share;
                            $ttl_share = $rentbeforevat_share + $amountvat_share;
                        }
                    }
                    else
                    {
                        $rent = floatval($row['costpermonths']);
                        $vat = "0.00";
                        $ttl = floatval($row['costpermonths']);

                        $revenue = $revamount_share;
                        $vat_share = "0.00";
                        $ttl_share = $revamount_share;
                    }
				}
				else if($gettype['tenanttype'] === "Rent or Share")
				{
					if(floatval($row['costpermonths']) > $revamount_share)
					{	
						if($header[1] == "yes")
	                    {
	                        if($header[2] == "inc") //inclusive vat
	                        {
	                            $amountvat = floatval($row['costpermonths']) * $vatpercent; //rent
	                            $rentbeforevat = floatval($row['costpermonths']) - $amountvat; //rent   

	                            $rent = $rentbeforevat; //less vat
	                            $vat = $amountvat;
	                            $ttl = $rentbeforevat + $amountvat;
	                            $revenue = 0;
	                        }
	                        else //exclusive vat
	                        {
	                            $amountvat = floatval($row['costpermonths']) * $vatpercent; //rent
	                            $rentplusvat = floatval($row['costpermonths']); //rent

	                            $rent = floatval($row['costpermonths']); //orig rate of rent
	                            $vat = $amountvat;
	                            $ttl = floatval($row['costpermonths']) + $amountvat;
	                            $revenue = 0;
	                        }
	                    }
	                    else
	                    {
	                        $rent = floatval($row['costpermonths']);
	                        $vat = "0.00";
	                        $ttl = floatval($row['costpermonths']);
	                        $revenue = 0;
	                    }
					}
					else
					{	
						$share = $revamount_share;
						if($header[1] == "yes")
	                    {
	                        if($header[2] == "inc") //inclusive vat
	                        {
	                            $amountvat_share = floatval($revamount_share) * $vatpercent; //rent
                            	$rentbeforevat_share = $revamount_share - $amountvat_share; //rent                         

	                            $revenue = $rentbeforevat_share;
	                            $vat_share = $amountvat_share;
	                            $ttl_share = $amountvat_share + $rentbeforevat_share;
	                            $rent = 0; 
	                        }
	                        else //exclusive vat
	                        {
	                            $amountvat_share = floatval($revamount_share) * $vatpercent; //rent
                            	$rentbeforevat_share = $revamount_share + $amountvat_share; //rent    

	                            $revenue = $rentbeforevat_share; //less vat
	                            $vat_share = $amountvat_share;
	                            $ttl_share = $rentbeforevat_share + $amountvat_share;
	                            $rent = 0; 
	                        }
	                    }
	                    else
	                    {
	                        $revenue = $revamount_share;
	                        $vat_share = "0.00";
	                        $ttl_share = $revamount_share;
	                        $rent = 0; 
	                    }
					}
				}
				else
				{	
						$share = $revamount_share;
						if($header[1] == "yes")
	                    {
	                        if($header[2] == "inc") //inclusive vat
	                        {
	                            $amountvat_share = floatval($revamount_share) * $vatpercent; //rent
                            	$rentbeforevat_share = $revamount_share - $amountvat_share; //rent                       

	                            $revenue = $rentbeforevat_share;
	                            $vat_share = $amountvat_share;
	                            $ttl_share = $amountvat_share + $rentbeforevat_share;
	                            $rent = 0; 
	                        }
	                        else //exclusive vat
	                        {
	                            $amountvat_share = floatval($revamount_share) * $vatpercent; //rent
                            	$rentbeforevat_share = $revamount_share + $amountvat_share; //rent  

	                            $revenue = $rentbeforevat_share; //less vat
	                            $vat_share = $amountvat_share;
	                            $ttl_share = $rentbeforevat_share + $amountvat_share;
	                            $rent = 0; 
	                        }
	                    }
	                    else
	                    {
	                        $revenue = $revamount_share;
	                        $vat_share = "0.00";
	                        $ttl_share = $revamount_share;
	                        $rent = 0; 
	                    }
				}				

				if($row[3] != ""){
					$association_dues = mysql_query("INSERT INTO tbltransaction SET tenantid = '". $row["TenantID"] ."', description = 'Association Dues', amount = '". $row[3] ."', balance = '". $row[3] ."', totalamount = '". $row[3] ."', qty = '1', xdate = '". date("Y-m-d", strtotime($xdatemustbe)) ."' ", $connection);
				}

				$year = date("Y", strtotime($_POST["xdate"]));
 				$monthlyrental = mysql_fetch_array(mysql_query("SELECT chrgid, chrgname FROM tblref_charges WHERE xcat = 'Rent'"));
				$checkdate = "SELECT tenantid from tbltransaction where tenantid = '".$row['TenantID']."' AND (MONTH(xdate) = '" . date('n', strtotime($_POST['xdate'])) . "' AND YEAR(xdate) = '" . date('Y', strtotime($_POST['xdate'])) . "') AND paymenttype = '' AND xdescription != 'Penalty' AND xcode = 'CHRG-0000001' ";
				$resulttransno = mysql_query($checkdate, $connection);
				$counttransno = mysql_num_rows($resulttransno);
				if($counttransno === 0)
				{
					if($gettype['tenanttype'] === "Rent")
					{	
						$savetrans = mysql_query("INSERT INTO tbltransaction SET tenantid = '".$row["TenantID"]."',xcode =  '".$monthlyrental["chrgid"]."',description = '".$monthlyrental["chrgname"]."', amount = '".$rent."', vatamount = '".$vat."', balance = '".$ttl."', xpenaltystatus = '1', qty = 1, xdate = '".date("Y-m-d", strtotime($xdatemustbe))."', tenanttype = '" . $gettype["tenanttype"] . "', revpercent = '" . $vatpercent . "', revamount = '" . $revamount . "', xdescription = 'Rent Fee'") or die(mysql_error());
					}
					else if($gettype['tenanttype'] === "Rent | Rev")
					{	
						$savetrans = mysql_query("INSERT INTO tbltransaction SET tenantid = '".$row["TenantID"]."',xcode =  '".$monthlyrental["chrgid"]."',description = '".$monthlyrental["chrgname"]."',amount = '".$rent."', vatamount = '".$vat."', balance = '".$ttl."', xpenaltystatus = '1', qty = 1,xdate = '".date("Y-m-d", strtotime($xdatemustbe))."', tenanttype = '" . $gettype["tenanttype"] . "', revpercent = '" . $vatpercent . "', revamount = '" . $revamount . "', xdescription = 'Rent Fee'") or die(mysql_error());

						$savetrans_rev = mysql_query("INSERT INTO tbltransaction SET tenantid = '".$row["TenantID"]."',xcode =  '".$monthlyrental["chrgid"]."',description = '".$monthlyrental["chrgname"]."',amount = '".$revenue."', vatamount = '".$vat_share."', balance = '".$ttl_share."', xpenaltystatus = '1', qty = 1,xdate = '".date("Y-m-d", strtotime($xdatemustbe))."', tenanttype = '" . $gettype["tenanttype"] . "', revpercent = '" . $vatpercent . "', revamount = '" . $revamount . "', xdescription = '" . $gettype['revpercent'] . "% Revenue'") or die(mysql_error());
					}
					else if($gettype['tenanttype'] === "Rent or Share")
					{
						if($rent > $revenue)
						{	

							$savetrans = mysql_query("INSERT INTO tbltransaction SET tenantid = '".$row["TenantID"]."',xcode =  '".$monthlyrental["chrgid"]."',description = '".$monthlyrental["chrgname"]."', amount = '".$rent."', vatamount = '".$vat."', balance = '".$ttl."', xpenaltystatus = '1', qty = 1, xdate = '".date("Y-m-d", strtotime($xdatemustbe))."', tenanttype = '" . $gettype["tenanttype"] . "', revpercent = '" . $vatpercent . "', revamount = '" . $revamount . "', xdescription = 'Rent Fee'") or die(mysql_error());
						}
						else
						{
					
							$savetrans_rev = mysql_query("INSERT INTO tbltransaction SET tenantid = '".$row["TenantID"]."',xcode =  '".$monthlyrental["chrgid"]."',description = '".$monthlyrental["chrgname"]."',amount = '".$revenue."', vatamount = '".$vat_share."', balance = '".$ttl_share."', xpenaltystatus = '1', qty = 1,xdate = '".date("Y-m-d", strtotime($xdatemustbe))."', tenanttype = '" . $gettype["tenanttype"] . "', revpercent = '" . $vatpercent . "', revamount = '" . $revamount . "', xdescription = '" . $gettype['revpercent'] . "% Revenue'") or die(mysql_error());
						}
					}
					else
					{

						$savetrans_rev = mysql_query("INSERT INTO tbltransaction SET tenantid = '".$row["TenantID"]."',xcode =  '".$monthlyrental["chrgid"]."',description = '".$monthlyrental["chrgname"]."',amount = '".$revenue."', vatamount = '".$vat_share."', balance = '".$ttl_share."', xpenaltystatus = '1', qty = 1,xdate = '".date("Y-m-d", strtotime($xdatemustbe))."', tenanttype = '" . $gettype["tenanttype"] . "', revpercent = '" . $vatpercent . "', revamount = '" . $revamount . "', xdescription = '" . $gettype['revpercent'] . "% Revenue'") or die(mysql_error());
					}
					
				}
			}

			if($savetrans_rev == true || $savetrans == true)
			{
				echo "1";
			}
			else
			{
				echo "2";
			}

		break;
		// coppy this
		case 'getsoadetails':
			$table = "";
			echo "
				<tbody>
				
			";
			$totalamount = 0;
			$translist = "";
			//QUERY FOR GETTING THE BALANCE FOR THE LAST MONTH
			$month2 = date("n") - 1;
			$monthprev = $month2 - 1;
			$monthprevs = mysql_fetch_array(mysql_query("SELECT sum(balance) FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND MONTH(xdate) = '" . $monthprev. "'"));
			$sql2 = "SELECT sum(balance) FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND MONTH(xdate) = '" . $month2 . "'";
			$result2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($result2);
			
			$newstot = $row2[0] + $monthprevs[0];
			echo "
				<tr>
					<td colspan='3' style='font-size: 13px;'>Previous Balances</td>
					<td align='right' style='padding-right: 10px;font-size: 13px;'>" . number_format($newstot, "2", ".", ",") ."</td>
				</tr>
			";
			
			
			$totalbalance = $newstot + $penaltyamount;
			echo "
				<tr style='font-weight: bold; border-top: 1px solid #000;'>
					<td colspan='3' style='font-size: 13px;'>TOTAL PREVIOUS BALANCES</td>
					<td align='right' style='padding-right: 10px;font-size: 13px;'>" . number_format($totalbalance, "2", ".", ",") ."</td>
				</tr>
			";
			
			echo "
						<tr style='font-weight: bold;'>
							<td colspan='4' style='border-bottom: 2px solid #000;'>&nbsp;</td>
						</tr>
						<tr style='font-weight: bold;'>
							<td colspan='4' style='padding-top: 20px;'>CURRENT CHARGES</td>
						</tr>
			";

			echo "<tr>
				  	<th style='width: 15%; height: 30px; text-align: center;border-top: 1px solid #000;border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;font-size: 14px;background-color: #000000 !important;-webkit-print-color-adjust: exact;color:#ffffff !important;'>DATE</th>
				  	<th style='width: 25%; text-align: left;border-top: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;padding-left: 15px;font-size: 14px;background-color: #000000 !important;-webkit-print-color-adjust: exact;color:#ffffff !important;'>REFERENCE</th>
				  	<th style='width: 40%;border-bottom: 1px solid #000; text-align: left;border-top: 1px solid #000;border-right: 1px solid #000;padding-left: 15px;font-size: 14px;background-color: #000000 !important;-webkit-print-color-adjust: exact;color:#ffffff !important;'>TRANSACTION DETAILS</th>
				  	<th style='width: 20%; text-align: right;padding-right: 10px;border-top: 1px solid #000;border-bottom: 1px solid #000;border-right: 1px solid #000;font-size: 14px;background-color: #000000 !important;-webkit-print-color-adjust: exact;color:#ffffff !important;'>AMOUNT</th>
				  </tr>";
			$subtotal = 0;
			//QUERY FOR LOADING TRANSACTION LIST FOR CURRENT MONTH
			$sql = "SELECT xcode, description, amount, qty, balance, xdate, reference FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND MONTH(xdate) > '" . $month2 . "' AND paymenttype = ''";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result))
			{
				echo "
					<tr>
						<td align='left' style='text-align: center;border-left: 1px solid #000;border-right: 1px solid #000;padding-top:3px;padding-bottom: 3px;font-size: 13px;'>" . date("d-M-Y", strtotime($row[5])) . "</td>
						<td align='left' style='text-align: left;padding-left: 15px;border-right: 1px solid #000;padding-top:3px;padding-bottom: 3px;font-size: 13px;'>" . $row[6] ."</td>
						<td style='text-align: left;padding-left: 15px;border-right: 1px solid #000;padding-top:3px;padding-bottom: 3px;font-size: 13px;'>" . $row[1] ."</td>
						<td align='right' style='text-align: right;padding-right: 10px;border-right: 1px solid #000;padding-top:3px;padding-bottom: 3px;font-size: 13px;'>" . number_format($row[4], "2", ".", ",") ."</td>
					</tr>
				";
				$subtotal += $row[4];
			}
			echo "
				<tr>
					<td align='center' style='border-top: 1px solid #000;'></td>
					<td align='left' style='border-top: 1px solid #000;'></td>
					<td align='right' style='padding-left: 30px; font-weight: bold;border-top: 1px solid #000;font-size: 13px;padding-top:10px;'>Subtotal</td>
					<td align='right' style='font-weight: bold; padding-right: 10px;border-top: 1px solid #000;font-size: 13px;padding-top:10px;'>" . number_format($subtotal, "2", ".", ",") ."</td>
				</tr>
			";
			
			$getpayments = mysql_fetch_array(mysql_query("SELECT SUM(totalamount) FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND paymenttype != ''"));
			
			echo "
				<tr>
					<td align='left'></td>
					<td align='center'></td>
					<td align='right' style='font-size: 13px;padding-top:3px;'>TOTAL PREVIOUS BALANCES</td>
					<td align='right' style='padding-right: 10px;font-size: 13px;padding-top:3px;'>" . number_format($totalbalance, "2", ".", ",") ."</td>
				</tr>
				<tr>
					<td align='left'></td>
					<td align='right'></td>
					<td align='right' style='font-size: 13px;padding-top:3px;'>ADD: TOTAL CURRENT CHARGES</td>
					<td align='right' style='padding-right: 10px;font-size: 13px;padding-top:3px;'>" . number_format($subtotal, "2", ".", ",") ."</td>
				</tr>
				<tr>
					<td align='left'></td>
					<td align='right'></td>
					<td align='right' style='font-size: 13px;padding-top:3px;'>LESS: TOTAL PAYMENTS</td>
					<td align='right' style='padding-right: 10px;font-size: 13px;padding-top:3px;'>" . str_replace("-", "", number_format($getpayments[0], "2", ".", ",")) ."</td>
				</tr>
			";
			
			$finaltotal = $totalbalance + $subtotal - str_replace("-", "", $getpayments[0]);
			echo "
				<tr>
					<td align='left' style='background-color: #cccccc !important;-webkit-print-color-adjust: exact; '></td>
					<td align='right' style='background-color: #cccccc !important;-webkit-print-color-adjust: exact; '></td>
					<td align='right' style='font-size: 15px;padding-top:3px;background-color: #cccccc !important;-webkit-print-color-adjust: exact; font-weight:bold;'>AMOUNT DUE</td>
					<td align='right' style='padding-right: 10px;font-size: 15px;padding-top:3px;background-color: #cccccc !important;-webkit-print-color-adjust: exact; font-weight:bold;'>" . str_replace("-", "", number_format($finaltotal, "2", ".", ",")) ."</td>
				</tr>
			";
			
			echo "
			</tbody>";
		break;

		case 'loadbalancelist':
			$sql = "SELECT id, xcode, description, xdate, balance, id, amount, xdescription, vatamount FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)) 
			{
				$oldestbalance = mysql_fetch_array(mysql_query("SELECT xdate FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' ORDER BY xdate ASC LIMIT 0,1 ", $connection));

				if( date('Y-m-d', strtotime($row[3])) == date('Y-m-d', strtotime($oldestbalance[0])) ){
					$bayarin = "1";
				}else{
					$bayarin = "0";
				}

				if($row["description"] == "Monthly Rental")
				{
					$details = "monthly_rent";
				}
				else
				{
					$details = "other_charges";
				}
				echo "
					<tr id='" . $row['id'] . "'>
						<td style='border-left: 0px !important;display: none;'><input name='form-field-checkbox2[1][]' class='ace ace-checkbox-2 chk_inquiry_unittype' type='checkbox' id='".$details."' value='". $bayarin ."'><span class='lbl'></span></label></td>
						<td class='date_added'>" . date("M d, Y", strtotime($row['xdate'])) . "</td>
						<td class='date_desc'><input type='hidden' class='hiddenamount bal_".$row["id"]."' value='" . $row['balance'] . "'>" . $row['xdescription'] . "</td>
						<td align='right'>" . number_format($row['amount'], 2, '.', ',') ."</td>
						<td align='right'>" . number_format($row['vatamount'], 2, '.', ',') . "</td>
						<td align='right'>" . number_format((floatval($row['vatamount'])+floatval($row['amount'])), 2, '.', ',') . "</td>
						<td align='right' class='tdbalance'>" . number_format($row['balance'], 2, '.', ',') . "</td>
						<td style='border-right: 0px !important;'><input type='text' value='' style='text-align: right;' disabled onkeyup='computebalance(this.id);' onchange='computebalance(this.id);' id='bal_".$row["id"]."' class='inputbal form-control amount numonly' placeholder='0.00'></td>
					</tr>
				";
			}
		break;

		case 'updatepdc':
			$sql = mysql_fetch_array(mysql_query("SELECT amount, checkstat, checkno, pdcdate, bank FROM tbltrans_pdc WHERE MONTH(pdcdate) = '" . date("m") . "' AND checkstat IN ('Cleared', 'Insufficient Fund') AND customerid = '" . $_POST['tenantid'] . "' AND paymentstat = '0'"));

			$sql2 = "SELECT owner_card_number, owner_lastname, owner_firstname, owner_midname, tradename FROM tbltrans_tenants WHERE TenantID = '" . $_POST['tenantid'] . "' AND ustatus = 'occupied' AND Status = 'actived'";
			$result2 = mysql_query($sql2, $connection);
			$row2 = mysql_fetch_array($result2);
			
			if($sql['checkstat'] === "Cleared")
			{	echo "|" . $sql['amount'] . "|" . $sql['checkno'] . "|" . $sql['pdcdate'] . "|" . $sql['bank'] . "|" . $row2["owner_card_number"] . "|" . $row2["owner_lastname"] . ", " . $row2["owner_firstname"] . " " . $row2["owner_midname"] ."|" . $row2[4];	}
			else
			{	echo "|" . "0.00" . "|" . $sql['checkno'] . "|" . $sql['pdcdate'] . "|" . $sql['bank'] . "|" . $row2["owner_card_number"] . "|" . $row2["owner_lastname"] . ", " . $row2["owner_firstname"] . " " . $row2["owner_midname"] ."|" . $row2[4];	}
			
		break;

		// coppy this
		case 'gettenantsoadetails':
			$datenow = getsysdate();
			$sql = mysql_fetch_array(mysql_query("SELECT tradeID from tbltrans_tenants where tenantid = '" . $_POST['tenantid'] . "' AND ustatus = 'occupied' AND Status = 'actived'"));
			
			$sql2 = mysql_fetch_array(mysql_query("SELECT companyID, tradename, filename FROM tbltrans_tradename WHERE tradeID = '" . $sql['tradeID'] . "'"));
			
			$sql3 = mysql_fetch_array(mysql_query("select businessAddress from tbltrans_company where CompanyID = '" . $sql2['companyID'] . "'"));
			
			$sql_get_due = mysql_fetch_array(mysql_query("SELECT dateto, DueDate FROM tbltrans_processedbill WHERE NOT (dateto > '".$datenow."' OR DueDate < '".$datenow."') OR NOT (datefrom > '".$datenow."' OR dateto < '".$datenow."')"));

			$src = "server/company/" . $sql2["companyID"] . "/trades/" . $sql['tradeID'] . "/" . $sql2['filename'];
			
			echo "|" . $sql2['companyID'] . "|" . strtoupper($sql2['tradename']) . "|" . $src . "|" . strtoupper($sql3['businessAddress']) . "|" . date("F d, Y", strtotime($sql_get_due["DueDate"])) . "|Printed by: ". getusername() ." - " . date("F d, Y h:i:s A") . "|" . date('F Y', strtotime($sql_get_due["dateto"]));
			//echo $sql;
		break;

		case 'tbltenanttypelists':
			if($_POST['val'] != "")
			{
				$sql = "SELECT TenantID, tradename, companyname, tenanttype, revpercent FROM tbltrans_tenants WHERE ustatus = 'occupied' AND Status = 'actived' AND tradename LIKE '%" . $_POST['val'] . "%'";
			}
			else
			{
				$sql = "SELECT TenantID, tradename, companyname, tenanttype, revpercent FROM tbltrans_tenants WHERE ustatus = 'occupied' AND Status = 'actived'";
			}
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)) {
				echo "
					<tr id='" . $row[0] . "'>
						<td class='hide_mobile'><label><input type='checkbox' value='" . $row[0] . "'></label></td>
						<td class='hide_mobile'>" . $row[0] . "</td>
						<td class='hide_mobile'>" . $row[1] . "</td>
						<td class='hide_mobile'>" . $row[2] . "</td>
						<td class='hide_mobile'>" . str_replace("|", "+", $row[3]) . "</td>
						<td class='hide_mobile'>" . $row[4] . "</td>
					</tr>
				";
			}
		break;
		
		case 'updatetenanttype':
			$tenantlist = explode("|", $_POST['tenantid']);
			for($x=1;$x<=count($tenantlist)-1;$x++)
			{
				$sql = "UPDATE tbltrans_tenants SET tenanttype = '" . $_POST['type'] . "', revpercent = '" . $_POST['percent'] . "' WHERE tenantid = '" . $tenantlist[$x] . "' AND ustatus = 'occupied' AND Status = 'actived'";
				$result = mysql_query($sql, $connection);
			}
		break;

		case 'getchecklist':
			$sql = "SELECT pdcdate, checkstat, depositorystat, bank, checkno, amount FROM tbltrans_pdc WHERE customerid = '" . $_POST['tenantid'] . "' AND paymentstat = '0' AND checkstat = 'Cleared'";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)) {
				echo "
					<tr id='" . $row[4] . "' onclick='selectcheck(\"".$row[0]."\", \"".$row[3]."\", \"".$row[4]."\", \"".$row[5]."\");'>
						<td class='hide_mobile'>" . $row[4] . "</td>
						<td class='hide_mobile'>" . $row[3] . "</td>
						<td class='hide_mobile'>" . $row[2] . "</td>
						<td class='hide_mobile'>" . $row[1] . "</td>
						<td class='hide_mobile'>" . $row[0] . "</td>
						<td class='hide_mobile'>" . number_format($row[5], 2, '.', ',') . "</td>
					</tr>
				";
			}
		break;

		case 'loadentriesbilling':
        	$search = "ustatus = 'occupied' AND status = 'actived' AND ( tradename LIKE '%" . $_POST['txtsearchapplication'] . "%' OR  TenantID LIKE '%" . $_POST['txtsearchapplication'] . "%' OR  companyname LIKE '%" . $_POST['txtsearchapplication'] . "%')";

           if($_POST["page"] == ""){
               $page = 1;
           }else{
               $page = $_POST["page"];
           }

           $limit = ($page-1) * 20;

            $sql = "SELECT COUNT(*) FROM tbltrans_tenants  WHERE ".$search." ";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            $rowsperpage = 20;
            $totalpages = ceil($row[0] / $rowsperpage);
            $upto = $limit + 20;
            $from = $limit + 1;
            if($page == $totalpages && $row[0] != 0){
                 echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
            }
            else
            {
                if($row[0] == 0){
                  	echo "no data";
                }
                else if($row[0] <= 19 && $row[0] != 0){
                  	echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
                }
                else if($row[0] >= 20 && $row[0] != 0){
                  	echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
                }

            }
        break;

		case "loadpagebilling":
	        $search = "ustatus = 'occupied' AND status = 'actived' AND ( tradename LIKE '%" . $_POST['txtsearchapplication'] . "%' OR  TenantID LIKE '%" . $_POST['txtsearchapplication'] . "%' OR  companyname LIKE '%" . $_POST['txtsearchapplication'] . "%')";

		    $page = $_POST["page"];

	    	$sqlb = "SELECT COUNT(*) FROM tbltrans_tenants WHERE ".$search." ";
			$aa = mysql_query($sqlb, $connection);
			$nums = mysql_fetch_row($aa);
			$num = $nums[0];
			// if($num <= 20)
			// {
			// 	$page = 1
			// }
			$rowsperpage = 20;
			$range = 19;
			$totalpages = ceil($num / $rowsperpage);
			$prevpage;
			$nextpage;
			// if not on page 1, don't show back links
			if($page > 1 ){
			   echo "<li style='width:50px !important;' onclick='pagination(1)'><< First</li>";
			   $prevpage = $page - 1;
			   echo "<li style='width:70px !important;' onclick='pagination(". $prevpage .")'>< Previous</li>";
			}

			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
			{
			   if (($x > 0) && ($x <= $totalpages)){
				    if ($x == $page){
	                    echo "<li id='pg" . $x . "' class='pgnum active' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>";
	                  }
				    else{
				        echo "<li id='pg" . $x . "' class='pgnum' onclick='pagination(" . $x . ",". $x .")'>" . $x . "</li>";
	                }
		       }
		    }
		    if($page < ($totalpages - $range)){
	            echo "<li>...</li>";
	        }

		    if ($page != $totalpages && $num != 0){
		       $nextpage = $page + 1;
		       echo "<li style='width:50px !important;' onclick='pagination(". $nextpage .", ". $nextpage .")'>Next ></li>";
		       echo "<li style='width:50px !important;' onclick='pagination(". $totalpages .", ". $totalpages .")'>Last >></li>";
		    }
		break;
		// for getting other information of pdc check for rent payment with check payment type
		case 'getcheckinfo':
			$sql = "SELECT bank, checkno FROM tbltrans_pdc WHERE customerid = '".$_POST["transid"]."' AND DATE_FORMAT(pdcdate, 'Y/m') = '".date("Y/m", strtotime($_POST["dateadded"]))."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["bank"] . "|" . $row["checkno"] . "|";
			echo $sql;
		break;
    		// coppy this
		case 'getsoabalance':
			$month = date("n") - 1;
		// 	$sql = "SELECT xcode, description, amount, qty, balance, xdate, reference, xdescription FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND MONTH(xdate) <= '" . $month. "' AND balance != '0.00'";
		// 	$result = mysql_query($sql, $connection);
		// 	while($row = mysql_fetch_array($result))
		// 	{
		// 		if($row[1] == "Monthly Rental")
		// 		{
		// 			$desc = " - ". $row[7] ."";
		// 		}
		// 		else
		// 		{
		// 			$desc = "";
		// 		}

		// 		echo "<tr>
					// 	<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-left: 10px;' align='left'>" . date("M d, Y", strtotime($row[5])) . "</td>
					// 	<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[6] ."</td>
					// 	<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[1] ."".$desc."</td>
					// 	<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-right: 5px;' align='right'>" . number_format($row[4], "2", ".", ",") ."</td>
					// </tr>";
		// 	}
		break;

    		// coppy this
		case 'getsoacurrent':
			$datenow = getsysdate();
			$sql_select = mysql_fetch_array(mysql_query("SELECT month_period, year_period FROM tbltrans_processedbill WHERE NOT (dateto > '".$datenow."' OR DueDate < '".$datenow."') OR NOT (datefrom > '".$datenow."' OR dateto < '".$datenow."')"));
			// SELECT * FROM tbltrans_processedbill WHERE NOT (datefrom > '2017-04-29' OR dateto < '2017-04-29')
			$sql = "SELECT xcode, description, amount, qty, SUM(vatamount + amount), xdate, reference, xdescription FROM tbltransaction WHERE xdate = '".$sql_select[1]."-".$sql_select[0]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND paymenttype = '' AND GROUP BY id";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				if($row[1] == "Monthly Rental")
				{
					$desc = " - ". $row[7] ."";
				}
				else
				{
					$desc = "";
				}

				echo "<tr>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-left: 10px;' align='left'>" . date("M Y", strtotime($row[5])) . "</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[6] ."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[1] ."".$desc."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-right: 5px;' align='right'>" . number_format($row[4], "2", ".", ",") ."</td>
					</tr>";
			}
		break;
    		// coppy this
		case 'getsoapayment':
			$datenow = getsysdate();
			$sql_select = mysql_fetch_array(mysql_query("SELECT month_period, year_period, datefrom, dateto, DueDate FROM tbltrans_processedbill WHERE NOT (dateto > '".$datenow."' OR DueDate < '".$datenow."') OR NOT (datefrom > '".$datenow."' OR dateto < '".$datenow."')"));

			$sql = "SELECT xcode, description, amount, qty, balance, xdate, reference, xdescription FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND paymenttype != '' AND (xdate BETWEEN '".date("Y-m-d", strtotime($sql_select["dateto"]))."' AND '".date("Y-m-d", strtotime($sql_select["DueDate"]))."') AND paymenttype != ''";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				if($row[1] == "Monthly Rental")
				{
					$desc = " - ". $row[7] ."";
				}
				else
				{
					$desc = "";
				}

				$amnt = explode("-", $row[2]);
				echo "<tr>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-left: 10px;' align='left'>" . date("M Y", strtotime($row[5])) . "</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[6] ."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[1] ."".$desc."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-right: 5px;' align='right'>" . number_format($amnt[1], "2", ".", ",") ."</td>
					</tr>";
			}
		break;
    		// coppy this
		case 'getsoabreakdowns':
			$datenow = getsysdate();
			$sql_select = mysql_fetch_array(mysql_query("SELECT month_period, year_period, datefrom, dateto, DueDate FROM tbltrans_processedbill WHERE NOT (dateto > '".$datenow."' OR DueDate < '".$datenow."') OR NOT (datefrom > '".$datenow."' OR dateto < '".$datenow."')"));

			$sql_select_month = mysql_fetch_array(mysql_query("SELECT DISTINCT(MONTH(xdate)) FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND xdescription != 'Penalty' AND paymenttype = '' ORDER BY xdate DESC LIMIT 0,1 "));

			$sql_select_year = mysql_fetch_array(mysql_query("SELECT DISTINCT(YEAR(xdate)) FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND xdescription != 'Penalty' AND paymenttype = '' ORDER BY xdate DESC LIMIT 0,1 "));
						
			$sql_get_due = mysql_fetch_array(mysql_query("SELECT dateto, DueDate FROM tbltrans_processedbill WHERE month_period = '".$sql_select_month[0]."' AND year_period = '".$sql_select_year[0]."' "));

			$sql = mysql_fetch_array(mysql_query("SELECT SUM(balance), SUM(vatamount) FROM tbltransaction WHERE xdate < '".$sql_select[1]."-".$sql_select[0]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND paymenttype = ''"));
		
			$sql2 = mysql_fetch_array(mysql_query("SELECT SUM(balance), SUM(vatamount), SUM(amount) FROM tbltransaction WHERE xdate = '".$sql_select[1]."-".$sql_select[0]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND paymenttype = ''"));

			$penalty_sql = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM tbltransaction WHERE xdate <= '".$sql_select_year[0]."-".$sql_select_month[0]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND xdescription = 'Penalty'"));

			$netsales_sql = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM tbltransaction WHERE xdate <= '".$sql_select_year[0]."-".$sql_select_month[0]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND xdescription != 'Penalty' AND paymenttype = ''"));
			
			$ttlpyment = 0;
			$sql3 = "SELECT amount FROM tbltransaction WHERE tenantid = '" . $_POST['tenantid'] . "' AND paymenttype != '' AND (xdate BETWEEN '".date("Y-m-d", strtotime($sql_select["dateto"]))."' AND '".date("Y-m-d", strtotime($sql_select["DueDate"]))."')";
			$res = mysql_query($sql3, $connection);
			while($row = mysql_fetch_array($res))
			{
				$thisval = explode("-", $row["amount"]);
				$ttlpyment += floatval($thisval[1]);
			}
			$vatnamount = floatval($sql2[1]) + floatval($sql2[2]);
			$overall = (floatval($sql[0]) + floatval($vatnamount)) - floatval($ttlpyment);
			$vat = floatval($sql[1]) + floatval($sql2[1]);
			$penalty = floatval($penalty_sql[0]);
			$netsales = floatval($netsales_sql[0]); //no vat and penalty
			$ttlcurrchargs = $vat + $penalty + $netsales;
			echo number_format($sql[0], "2", ".", ",") . "|";  // PREVIOUS BALANCES
			echo number_format($vatnamount, "2", ".", ",") . "|"; // CURRENT CHARGES
			echo number_format($ttlpyment, "2", ".", ",") . "|";     // PAYMENTS
			echo number_format($overall, "2", ".", ",") . "|";     // PREV + CURRENT (-PAYMENT)
			echo number_format($vat, "2", ".", ",") . "|";     // TOTAL VAT
			echo number_format($penalty, "2", ".", ",") . "|";     // TOTAL PENALTY
			echo number_format($netsales, "2", ".", ",") . "|";     // TOTAL NET SALES
			echo number_format($ttlcurrchargs, "2", ".", ",");     // TOTAL CURRENT CHARGES
		break;

		case 'processsoa':
			if($_POST['tenantid'] == ""){
				$wtenantid = "";
			}else{
				$wtenantid = "AND tenantid = '". $_POST['tenantid'] ."'";
			}
			$posteddate = date('Y-m-d', strtotime($_POST["yrprd"]."-".$_POST["monthprd"]."-"."1"));
			$sql_prefix = "SELECT mallprefix FROM tblsys_setup2";
			$result_prefix = mysql_query($sql_prefix, $connection);
			$row_prefix = mysql_fetch_array($result_prefix);

			$processedsoa = mysql_fetch_array(mysql_query("SELECT soaid FROM dunn_tblsoaheader WHERE soayear = '". date("Y", strtotime($posteddate)) ."' AND soaMonth = '". date('n', strtotime($posteddate)) ."' ", $connection));

			$soano = createctrlno("", "tbltrans_processedsoa", "soaNo");
/* <==================================	P	R	O	C	E	S	S	I	N	G		O	F		S	O	A	========================================> */
			if($processedsoa[0] == ""){
					$soanum = $row_prefix["mallprefix"] . "-" . $_POST["yrprd"] . "-" . $_POST["monthprd"] . "-" . $soano;

					$period = mysql_query("UPDATE tbltrans_processedbill SET gen_xstat = '2' WHERE month_period = '".date('n', strtotime($_POST['monthprd']))."' AND year_period = '".date("Y", strtotime($_POST["yrprd"]))."'");

					$sql = "SELECT COUNT(soaNo) FROM tbltrans_processedsoa WHERE month_period = '".$_POST["monthprd"]."' AND year_period = '".$_POST["yrprd"]."'";
	    			$result = mysql_query($sql, $connection);
	    			$row = mysql_fetch_array($result);

	    			// ********************************* current balance *************************************
	    			$gtdata = mysql_query("SELECT tenantid, xcode, description, amount, qty, paymentamount, vatamount, balance, xdate, reference, xdatetime, xpenalty, xpenaltystatus, paymenttype, cardholder, ccno, expdate, checkno, checkdate, checkname, bankname, cardtype, authno, secno, orno, totalamount, charges_status, tenanttype, revpercent, revamount, bnkfrom, bnkto, accnofrom, accnoto, xdescription FROM tbltransaction WHERE xdate = '".date("Y-m-d", strtotime($_POST["yrprd"] . "-" . $_POST["monthprd"]. "-1"))."' AND paymenttype = '' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0' ".$wtenantid." ");
	    			while($gt = mysql_fetch_array($gtdata))
	    			{
	    				$insert_details = mysql_query("INSERT INTO dunn_tblsoadetails ( tenantid, xcode, description, amount, qty, paymentamount, vatamount, balance, xdate, reference, xdatetime, xpenalty, xpenaltystatus, paymenttype, cardholder, ccno, expdate, checkno, checkdate, checkname, bankname, cardtype, authno, secno, orno, totalamount, charges_status, tenanttype, revpercent, revamount, bnkfrom, bnkto, accnofrom, accnoto, xdescription, soaNo)VALUES('".$gt["tenantid"]."', '".$gt["xcode"]."', '".$gt["description"]."', '".$gt["amount"]."', '".$gt["qty"]."', '".$gt["paymentamount"]."', '".$gt["vatamount"]."', '".$gt["balance"]."', '".$gt["xdate"]."', '".$gt["reference"]."', '".$gt["xdatetime"]."', '".$gt["xpenalty"]."', '".$gt["xpenaltystatus"]."', '".$gt["paymenttype"]."', '".$gt["cardholder"]."', '".$gt["ccno"]."', '".$gt["expdate"]."', '".$gt["checkno"]."', '".$gt["checkdate"]."', '".$gt["checkname"]."', '".$gt["bankname"]."', '".$gt["cardtype"]."', '".$gt["authno"]."', '".$gt["secno"]."', '".$gt["orno"]."', '".$gt["totalamount"]."', '".$gt["charges_status"]."', '".$gt["tenanttype"]."', '".$gt["revpercent"]."', '".$gt["revamount"]."', '".$gt["bnkfrom"]."', '".$gt["bnkto"]."', '".$gt["accnofrom"]."', '".$gt["accnoto"]."', '".$gt["xdescription"]."', '". $soanum ."')");
	    			}
	    			// ***************************************************************************************

	    			$sql_get_due = mysql_fetch_array(mysql_query("SELECT month_period, year_period, datefrom, dateto, DueDate FROM tbltrans_processedbill WHERE month_period = '".date('n', strtotime($_POST['monthprd']))."' AND year_period = '".$_POST["yrprd"]."' "));

	    			// ********************************* payment posted **************************************
	    			$gtdata2 = mysql_query("SELECT tenantid, xcode, description, amount, qty, paymentamount, vatamount, balance, xdate, reference, xdatetime, xpenalty, xpenaltystatus, paymenttype, cardholder, ccno, expdate, checkno, checkdate, checkname, bankname, cardtype, authno, secno, orno, totalamount, charges_status, tenanttype, revpercent, revamount, bnkfrom, bnkto, accnofrom, accnoto, xdescription FROM tbltransaction WHERE paymenttype != '' AND (xdate BETWEEN '".date("Y-m-d", strtotime($sql_get_due["dateto"]))."' AND '".date("Y-m-d", strtotime($sql_get_due["DueDate"]))."') AND balance LIKE '%-%' AND Post_Stat = '0' ".$wtenantid." ");
	    			while($gt2 = mysql_fetch_array($gtdata2))
	    			{
	    				$insert_details2 = mysql_query("INSERT INTO dunn_tblsoadetails ( tenantid, xcode, description, amount, qty, paymentamount, vatamount, balance, xdate, reference, xdatetime, xpenalty, xpenaltystatus, paymenttype, cardholder, ccno, expdate, checkno, checkdate, checkname, bankname, cardtype, authno, secno, orno, totalamount, charges_status, tenanttype, revpercent, revamount, bnkfrom, bnkto, accnofrom, accnoto, xdescription, soaNo)VALUES('".$gt2["tenantid"]."', '".$gt2["xcode"]."', '".$gt2["description"]."', '".$gt2["amount"]."', '".$gt2["qty"]."', '".$gt2["paymentamount"]."', '".$gt2["vatamount"]."', '".$gt2["balance"]."', '".$gt2["xdate"]."', '".$gt2["reference"]."', '".$gt2["xdatetime"]."', '".$gt2["xpenalty"]."', '".$gt2["xpenaltystatus"]."', '".$gt2["paymenttype"]."', '".$gt2["cardholder"]."', '".$gt2["ccno"]."', '".$gt2["expdate"]."', '".$gt2["checkno"]."', '".$gt2["checkdate"]."', '".$gt2["checkname"]."', '".$gt2["bankname"]."', '".$gt2["cardtype"]."', '".$gt2["authno"]."', '".$gt2["secno"]."', '".$gt2["orno"]."', '".$gt2["totalamount"]."', '".$gt2["charges_status"]."', '".$gt2["tenanttype"]."', '".$gt2["revpercent"]."', '".$gt2["revamount"]."', '".$gt2["bnkfrom"]."', '".$gt2["bnkto"]."', '".$gt2["accnofrom"]."', '".$gt2["accnoto"]."', '".$gt2["xdescription"]."', '". $soanum ."')");
	    			}
	    			// ***************************************************************************************

		    		if($row[0] == 0 || $row[0] == "0"){
						$getduedate = mysql_fetch_array(mysql_query("SELECT DueDate, datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '".$_POST["monthprd"]."' AND year_period = '".$_POST["yrprd"]."'"));

						$insert = "INSERT INTO tbltrans_processedsoa (soaNo, month_period, year_period, DueDate, dateadded) VALUES ('".$soanum."', '".$_POST["monthprd"]."', '".$_POST["yrprd"]."', '".date("Y-m-d", strtotime($getduedate["DueDate"]))."', '".date("Y-m-d H:i:s")."')";
						$result_insert = mysql_query($insert);


						$sql_all = "SELECT TenantID, companyname, costpermonths, tenanttype, revpercent, tradename FROM tbltrans_tenants WHERE Status = 'actived' AND ustatus = 'occupied' ".$wtenantid." ORDER BY companyname ASC ";
						$result_all = mysql_query($sql_all, $connection);
						while ($row_all = mysql_fetch_array($result_all)){
							$ttlrevenues = "SELECT SUM(fnmGTDlySls) FROM db_sales WHERE tenantid = '".$row_all["TenantID"]."' AND (YEAR(fdtTrnsctn) = '".date("Y", strtotime($_POST["yrprd"]))."' AND MONTH(fdtTrnsctn)='".$_POST["monthprd"]."')";
							$reusltrevenues = mysql_query($ttlrevenues, $connection);
							$row_rev = mysql_fetch_array($reusltrevenues);

							$month = date("n") - 1;
							$month2 = date("n");
							$pleft = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance LIKE '%-%' "));
							$sql_prev_bal = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate < '".date("Y-m-d", strtotime($_POST["yrprd"]."-".$_POST["monthprd"]."-01"))."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0' "));
							$sql_prev_bal_00 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($posteddate) )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_prev_bal_30 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($posteddate . '-1 month') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_prev_bal_60 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($posteddate . '-2 months') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_prev_bal_90 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($posteddate . '-3 months') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_prev_bal_120 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate <= '".date( 'Y-m-d', strtotime($posteddate . '-4 months') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_penalty = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND xdescription = 'Penalty' AND xdate <= '".date( 'Y-m-d', strtotime($posteddate) )."' AND balance != '0.00'"));

							$b99 = $sql_prev_bal_120[0];
							$b69 = $sql_prev_bal_90[0];
							$b36 = $sql_prev_bal_60[0];
							$b13 = $sql_prev_bal_30[0];
							$b00 = $sql_prev_bal_00[0];
							$paymentleft = 0;
							$penalty = 0;
							if($pleft > 0){
								if($pleft[0] != "0"){ //REDUCE PLEFT FROM BALANCE 4 MONTHS AND ABOVE
									$paymentleft = (($pleft[0])*-1) - $sql_prev_bal_120[0];
									$b99 = 0;
									$penalty = 0;
								}else{
									$paymentleft = ($pleft[0])*-1;
									$b99 = $sql_prev_bal_120[0];
								}
								if($paymentleft != "0"){ //REDUCE PLEFT FROM BALANCE 3 MONTHS
									$paymentleft = $paymentleft - $sql_prev_bal_90[0];
									$b69 = 0;
									$penalty = 0;
								}else{
									$paymentleft = $paymentleft;
									$b69 = $sql_prev_bal_90[0];
								}

								if($paymentleft != "0"){ //REDUCE PLEFT FROM BALANCE 2 MONTHS
									$paymentleft = $paymentleft - $sql_prev_bal_60[0];
									$b36 = 0;
									$penalty = 0;
								}else{
									$paymentleft = $paymentleft;
									$b36 = $sql_prev_bal_60[0];
								}

								if($paymentleft != "0"){ //REDUCE PLEFT FROM BALANCE 1 MONTH
									$paymentleft = $paymentleft - $sql_prev_bal_30[0];
									$b13 = 0;
									$penalty = 0;
								}else{
									$paymentleft = $paymentleft;
									$b13 = $sql_prev_bal_30[0];
								}

								if($paymentleft != "0"){ //REDUCE PLEFT FROM CURRENT BALANCE
									$paymentleft = $paymentleft - $sql_prev_bal_00[0];
									$b00 = 0;
									$penalty = 0;
								}else{
									$paymentleft = $paymentleft;
									$b00 = $sql_prev_bal_00[0];
								}
							}
							$ttlpyment = 0;
							$sql_payment = "SELECT amount FROM tbltransaction WHERE tenantid = '" . $row_all["TenantID"] . "' AND paymenttype != '' AND (xdate BETWEEN '".date("Y-m-d", strtotime($sql_get_due["dateto"]))."' AND '".date("Y-m-d", strtotime($sql_get_due["DueDate"]))."')";
							$payment = mysql_query($sql_payment, $connection);
							while($row_payment = mysql_fetch_array($payment))
							{
								$thisval = explode("-", $row_payment["amount"]);
								$ttlpyment += floatval($thisval[1]);
							}
							$datenow = getsysdate();
							$rent = $row_all['costpermonths'];
							$share = (floatval($row_all["revpercent"])/100)*floatval($row_rev[0]);
							$ttl = floatval($sql_prev_bal[0]) + floatval($sql2_curr_bal[0]);
							$lesspayment = (floatval($sql_prev_bal[0]) + floatval($sql2_curr_bal[0])) - floatval($ttlpyment);
							$username = getusername();
							$ctrlno = createctrlno("", "dunn_tblsoaheader", "ctrlno");

							$soaid = $soanum;
							$tenantid = $row_all["TenantID"];
							$tenantname = $row_all["tradename"];
							$soayear = $_POST["yrprd"];
							$soaMonth = $_POST["monthprd"];
							$totalamount = $ttl;
							$createdby = $username;
							$datecreated = $datenow;
							$duedate = date("Y-m-d", strtotime($getduedate["DueDate"]));
							$tenantdues = $rent;
							$revenue = $share;
							$Forwbal = $sql_prev_bal[0]; //* last cut off balances
							$payment = $ttlpyment; //* payment ngayon
							$currcharg = 0; // electric / water / maintenance bill ****wala pa****
							$hperiod = 'not posted';
							$billno = $soanum."-".$ctrlno;
							$ctrlno = $ctrlno;
							$isedit = '0';
							$b13 = $b13; //30 days
							$b36 = $b36; //60 days
							$b69 = $b69; //90 days
							$b99 = $b99; //120 days
							$b00 = $b00; // current
							$pleft = $paymentleft; //pag lampas ng 120 days
							$penchrg = $sql_penalty[0]; // penalty
							$soaperiod = date("Y-m-d", strtotime($getduedate[1]));
							$soaperiod2 = date("Y-m-d", strtotime($getduedate[2]));
							$Currbal = (floatval($b00) + floatval($b13) + floatval($b36) + floatval($b69) + floatval($b99)) - $paymentleft; // (mem dues + curr charges + revenue + penalty) - payment

							if($Currbal <= 0){
								$Currbal = 0;
							}else{
								$Currbal = $Currbal;
							}

							if($pleft <= 0){
								$pleft = 0;
							}else{
								$pleft = $pleft;
							}

							$insert_header_soa = mysql_query("INSERT INTO dunn_tblsoaheader (soaid, tenantid, tenantname, soayear, soaMonth, totalamount, createdby, datecreated, duedate, tenantdues, revenue, Forwbal, Currbal, payment, currcharg, hperiod, billno, ctrlno, isedit, b13, b36, b69, b99, b00, pleft, penchrg, soaperiod, soaperiod2)VALUES('".$soaid."', '".$tenantid."', '".$tenantname."', '".$soayear."', '".$soaMonth."', '".$totalamount."', '".$createdby."', '".$datecreated."', '".$duedate."', '".$tenantdues."', '".$revenue."', '".$Forwbal."', '".$Currbal."', '".$payment."', '".$currcharg."', '".$hperiod."', '".$billno."', '".$ctrlno."', '".$isedit."', '".$b13."', '".$b36."', '".$b69."', '".$b99."', '".$b00."', '".$pleft."', '".$penchrg."', '".$soaperiod."', '".$soaperiod2."')");

						}
						if($insert_header_soa == true){
		    				echo "1|".date("F", strtotime($posteddate));    					
						}
					}
					else{
						echo "2|".date("F", strtotime($posteddate));
					}
			}else{
/* <=================================R	E	P	R	O	C	E	S	S	I	N	G		O	F		S	O	A========================================> */
				$soanum = $processedsoa[0];
				
				if($_POST['tenantid'] != ""){
					$deletefirst = mysql_query("DELETE FROM dunn_tblsoadetails WHERE soaNo = '". $soanum ."' ".$wtenantid." " , $connection); //DELETE SOA DETAILS
					$deletesecond = mysql_query("DELETE FROM dunn_tblsoaheader WHERE soaid = '". $soanum ."' ".$wtenantid." " , $connection); //DELETE SOA HEADER
				}else{
					$deletefirst = mysql_query("DELETE FROM dunn_tblsoadetails WHERE soaNo = '". $soanum ."' " , $connection); //DELETE SOA DETAILS
					$deletesecond = mysql_query("DELETE FROM dunn_tblsoaheader WHERE soaid = '". $soanum ."' " , $connection); //DELETE SOA HEADER
				}

				if($deletefirst == true && $deletesecond == true){
					$period = mysql_query("UPDATE tbltrans_processedbill SET gen_xstat = '2' WHERE month_period = '".date('n', strtotime($_POST['monthprd']))."' AND year_period = '".date("Y", strtotime($_POST["yrprd"]))."'");

					$sql = "SELECT COUNT(soaNo) FROM tbltrans_processedsoa WHERE month_period = '".$_POST["monthprd"]."' AND year_period = '".$_POST["yrprd"]."'";
	    			$result = mysql_query($sql, $connection);
	    			$row = mysql_fetch_array($result);

	    			// ********************************* current balance *************************************
	    			$gtdata = mysql_query("SELECT tenantid, xcode, description, amount, qty, paymentamount, vatamount, balance, xdate, reference, xdatetime, xpenalty, xpenaltystatus, paymenttype, cardholder, ccno, expdate, checkno, checkdate, checkname, bankname, cardtype, authno, secno, orno, totalamount, charges_status, tenanttype, revpercent, revamount, bnkfrom, bnkto, accnofrom, accnoto, xdescription FROM tbltransaction WHERE xdate = '".date("Y-m-d", strtotime($_POST["yrprd"] . "-" . $_POST["monthprd"]. "-1"))."' AND paymenttype = '' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0' ".$wtenantid." ");
	    			while($gt = mysql_fetch_array($gtdata))
	    			{
	    				$insert_details = mysql_query("INSERT INTO dunn_tblsoadetails ( tenantid, xcode, description, amount, qty, paymentamount, vatamount, balance, xdate, reference, xdatetime, xpenalty, xpenaltystatus, paymenttype, cardholder, ccno, expdate, checkno, checkdate, checkname, bankname, cardtype, authno, secno, orno, totalamount, charges_status, tenanttype, revpercent, revamount, bnkfrom, bnkto, accnofrom, accnoto, xdescription, soaNo)VALUES('".$gt["tenantid"]."', '".$gt["xcode"]."', '".$gt["description"]."', '".$gt["amount"]."', '".$gt["qty"]."', '".$gt["paymentamount"]."', '".$gt["vatamount"]."', '".$gt["balance"]."', '".$gt["xdate"]."', '".$gt["reference"]."', '".$gt["xdatetime"]."', '".$gt["xpenalty"]."', '".$gt["xpenaltystatus"]."', '".$gt["paymenttype"]."', '".$gt["cardholder"]."', '".$gt["ccno"]."', '".$gt["expdate"]."', '".$gt["checkno"]."', '".$gt["checkdate"]."', '".$gt["checkname"]."', '".$gt["bankname"]."', '".$gt["cardtype"]."', '".$gt["authno"]."', '".$gt["secno"]."', '".$gt["orno"]."', '".$gt["totalamount"]."', '".$gt["charges_status"]."', '".$gt["tenanttype"]."', '".$gt["revpercent"]."', '".$gt["revamount"]."', '".$gt["bnkfrom"]."', '".$gt["bnkto"]."', '".$gt["accnofrom"]."', '".$gt["accnoto"]."', '".$gt["xdescription"]."', '". $soanum ."')");
	    			}
	    			// ***************************************************************************************

	    			$sql_get_due = mysql_fetch_array(mysql_query("SELECT month_period, year_period, datefrom, dateto, DueDate FROM tbltrans_processedbill WHERE month_period = '".date('n', strtotime($_POST['monthprd']))."' AND year_period = '".$_POST["yrprd"]."' "));

	    			// ********************************* payment posted **************************************
	    			$gtdata2 = mysql_query("SELECT tenantid, xcode, description, amount, qty, paymentamount, vatamount, balance, xdate, reference, xdatetime, xpenalty, xpenaltystatus, paymenttype, cardholder, ccno, expdate, checkno, checkdate, checkname, bankname, cardtype, authno, secno, orno, totalamount, charges_status, tenanttype, revpercent, revamount, bnkfrom, bnkto, accnofrom, accnoto, xdescription FROM tbltransaction WHERE paymenttype != '' AND (xdate BETWEEN '".date("Y-m-d", strtotime($sql_get_due["dateto"]))."' AND '".date("Y-m-d", strtotime($sql_get_due["DueDate"]))."') AND balance LIKE '%-%' AND Post_Stat = '0' ".$wtenantid." ");
	    			while($gt2 = mysql_fetch_array($gtdata2))
	    			{
	    				$insert_details2 = mysql_query("INSERT INTO dunn_tblsoadetails ( tenantid, xcode, description, amount, qty, paymentamount, vatamount, balance, xdate, reference, xdatetime, xpenalty, xpenaltystatus, paymenttype, cardholder, ccno, expdate, checkno, checkdate, checkname, bankname, cardtype, authno, secno, orno, totalamount, charges_status, tenanttype, revpercent, revamount, bnkfrom, bnkto, accnofrom, accnoto, xdescription, soaNo)VALUES('".$gt2["tenantid"]."', '".$gt2["xcode"]."', '".$gt2["description"]."', '".$gt2["amount"]."', '".$gt2["qty"]."', '".$gt2["paymentamount"]."', '".$gt2["vatamount"]."', '".$gt2["balance"]."', '".$gt2["xdate"]."', '".$gt2["reference"]."', '".$gt2["xdatetime"]."', '".$gt2["xpenalty"]."', '".$gt2["xpenaltystatus"]."', '".$gt2["paymenttype"]."', '".$gt2["cardholder"]."', '".$gt2["ccno"]."', '".$gt2["expdate"]."', '".$gt2["checkno"]."', '".$gt2["checkdate"]."', '".$gt2["checkname"]."', '".$gt2["bankname"]."', '".$gt2["cardtype"]."', '".$gt2["authno"]."', '".$gt2["secno"]."', '".$gt2["orno"]."', '".$gt2["totalamount"]."', '".$gt2["charges_status"]."', '".$gt2["tenanttype"]."', '".$gt2["revpercent"]."', '".$gt2["revamount"]."', '".$gt2["bnkfrom"]."', '".$gt2["bnkto"]."', '".$gt2["accnofrom"]."', '".$gt2["accnoto"]."', '".$gt2["xdescription"]."', '". $soanum ."')");
	    			}
	    			// ***************************************************************************************
		    		if($row[0] != 0 || $row[0] != "0"){
						$getduedate = mysql_fetch_array(mysql_query("SELECT DueDate, datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '".$_POST["monthprd"]."' AND year_period = '".$_POST["yrprd"]."'"));

						$sql_all = "SELECT TenantID, companyname, costpermonths, tenanttype, revpercent, tradename FROM tbltrans_tenants WHERE Status = 'actived' AND ustatus = 'occupied' ".$wtenantid." ORDER BY companyname ASC ";
						$result_all = mysql_query($sql_all, $connection);
						while ($row_all = mysql_fetch_array($result_all))
						{
							$ttlrevenues = "SELECT SUM(fnmGTDlySls) FROM db_sales WHERE tenantid = '".$row_all["TenantID"]."' AND (YEAR(fdtTrnsctn) = '".date("Y", strtotime($_POST["yrprd"]))."' AND MONTH(fdtTrnsctn)='".$_POST["monthprd"]."')";
							$reusltrevenues = mysql_query($ttlrevenues, $connection);
							$row_rev = mysql_fetch_array($reusltrevenues);

							$month = date("n") - 1;
							$month2 = date("n");
							$pleft = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance LIKE '%-%' "));
							$sql_prev_bal = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate < '".date("Y-m-d", strtotime($_POST["yrprd"]."-".$_POST["monthprd"]."-01"))."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0' "));
							$sql_prev_bal_00 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($posteddate) )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_prev_bal_30 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($posteddate . '-1 month') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_prev_bal_60 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($posteddate . '-2 months') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_prev_bal_90 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($posteddate . '-3 months') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_prev_bal_120 = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate <= '".date( 'Y-m-d', strtotime($posteddate . '-4 months') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0'"));
							$sql_penalty = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND xdescription = 'Penalty' AND xdate <= '".date( 'Y-m-d', strtotime($posteddate) )."' AND balance != '0.00'"));
							// $sql_prev_bal_120up = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE xdate <= '".date( 'Y-m-d', strtotime($posteddate . '-5 months') )."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' "));  UNDECIDED ABOUT THIS
							$b99 = $sql_prev_bal_120[0];
							$b69 = $sql_prev_bal_90[0];
							$b36 = $sql_prev_bal_60[0];
							$b13 = $sql_prev_bal_30[0];
							$b00 = $sql_prev_bal_00[0];
							$paymentleft = 0;
							// $penalty = 0;
							// echo $paymentleft."START";
							if($pleft[0] != "0"){ //REDUCE PLEFT FROM BALANCE 4 MONTHS AND ABOVE
								$paymentleft = (($pleft[0])*-1) - $sql_prev_bal_120[0];
								$b99 = 0;
								// $penalty = 0;
							}else{
								$paymentleft = ($pleft[0])*-1;
								$b99 = $sql_prev_bal_120[0];
							}
							// echo $paymentleft."|".$b99."|120days|";
							if($paymentleft != "0"){ //REDUCE PLEFT FROM BALANCE 3 MONTHS
								$paymentleft = $paymentleft - $sql_prev_bal_90[0];
								$b69 = 0;
								// $penalty = 0;
							}else{
								$paymentleft = $paymentleft;
								$b69 = $sql_prev_bal_90[0];
							}
							// echo $paymentleft."|".$b69."|90days|";

							if($paymentleft != "0"){ //REDUCE PLEFT FROM BALANCE 2 MONTHS
								$paymentleft = $paymentleft - $sql_prev_bal_60[0];
								$b36 = 0;
								// $penalty = 0;
							}else{
								$paymentleft = $paymentleft;
								$b36 = $sql_prev_bal_60[0];
							}
							// echo $paymentleft."|".$b36."|60days|";

							if($paymentleft != "0"){ //REDUCE PLEFT FROM BALANCE 1 MONTH
								$paymentleft = $paymentleft - $sql_prev_bal_30[0];
								$b13 = 0;
								// $penalty = 0;
							}else{
								$paymentleft = $paymentleft;
								$b13 = $sql_prev_bal_30[0];
							}
							// echo $paymentleft."|".$b13."|30days|";

							if($paymentleft != "0"){ //REDUCE PLEFT FROM CURRENT BALANCE
								$paymentleft = $paymentleft - $sql_prev_bal_00[0];
								$b00 = 0;
								// $penalty = 0;
							}else{
								$paymentleft = $paymentleft;
								$b00 = $sql_prev_bal_00[0];
							}
							// echo $paymentleft."|".$b00."|0days|";

							// if($paymentleft < "0"){
							// 	$b00  = ($paymentleft)* -1;
							// 	$paymentleft = "0";
							// }
							// $sql_curr_bal = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND xdescription != 'Penalty' AND MONTH(xdate) >= '" . $month2. "' AND balance != '0.00'"));

							$sql2_curr_bal = mysql_fetch_array(mysql_query("SELECT SUM(balance), SUM(vatamount), SUM(amount) FROM tbltransaction WHERE xdate = '".date( 'Y-m-d', strtotime($_POST["yrprd"]."-".$_POST["monthprd"]."-01"))."' AND tenantid = '" . $row_all['TenantID'] . "' AND balance != '0.00' AND balance NOT LIKE '%-%' AND Post_Stat = '0' "));

							$othercharges = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '". $row_all['TenantID'] ."' AND xdate = '". date( 'Y-m-d', strtotime($posteddate) ) ."' AND xcode  != 'CHRG-0000001' AND xcode != ''", $connection));

							$ttlpyment = 0;
							$sql_payment = "SELECT SUM(amount) FROM tbltransaction WHERE tenantid = '" . $row_all["TenantID"] . "' AND paymenttype != '' AND (xdate BETWEEN '".date("Y-m-d", strtotime($sql_get_due["dateto"]))."' AND '".date("Y-m-d", strtotime($sql_get_due["DueDate"]))."')";

							$payment = mysql_query($sql_payment, $connection);
							while($row_payment = mysql_fetch_array($payment))
							{
								$thisval = explode("-", $row_payment["amount"]);
								$ttlpyment += floatval($thisval[1]);
							}
							$datenow = getsysdate();
							$rent = $row_all['costpermonths'];
							$share = (floatval($row_all["revpercent"])/100)*floatval($row_rev[0]);
							$ttl = floatval($sql_prev_bal[0]) + floatval($sql2_curr_bal[0]);
							$lesspayment = (floatval($sql_prev_bal[0]) + floatval($sql2_curr_bal[0])) - floatval($ttlpyment);
							$username = getusername();
							$ctrlno = createctrlno("", "dunn_tblsoaheader", "ctrlno");

							$soaid = $soanum;
							$tenantid = $row_all["TenantID"];
							$tenantname = $row_all["tradename"];
							$soayear = $_POST["yrprd"];
							$soaMonth = $_POST["monthprd"];
							$totalamount = $ttl;
							$createdby = $username;
							$datecreated = $datenow;
							$duedate = date("Y-m-d", strtotime($getduedate["DueDate"]));
							$tenantdues = $rent;
							$revenue = $share;
							$Forwbal = $sql_prev_bal[0]; //* last cut off balances
							$payment = $ttlpyment; //* payment ngayon
							$currcharg = $othercharges[0]; // electric / water / maintenance bill 
							$hperiod = 'not posted';
							$billno = $soanum."-".$ctrlno;
							$ctrlno = $ctrlno;
							$isedit = '0';
							$b13 = $b13; //30 days
							$b36 = $b36; //60 days
							$b69 = $b69; //90 days
							$b99 = $b99; //120 days
							$b00 = $b00; // current
							$pleft = $paymentleft; //SUKLI
							$penchrg = $sql_penalty[0]; // penalty
							$soaperiod = date("Y-m-d", strtotime($getduedate[1]));
							$soaperiod2 = date("Y-m-d", strtotime($getduedate[2]));
							$Currbal = (floatval($b00) + floatval($b13) + floatval($b36) + floatval($b69) + floatval($b99)) - $paymentleft; // (mem dues + curr charges + revenue + penalty) - payment

							if($Currbal <= 0){
								$Currbal = 0;
							}else{
								$Currbal = $Currbal;
							}

							if($pleft <= 0){
								$pleft = 0;
							}else{
								$pleft = $pleft;
							}
							$insert_header_soa = mysql_query("INSERT INTO dunn_tblsoaheader (soaid, tenantid, tenantname, soayear, soaMonth, totalamount, createdby, datecreated, duedate, tenantdues, revenue, Forwbal, Currbal, payment, currcharg, hperiod, billno, ctrlno, isedit, b13, b36, b69, b99, b00, pleft, penchrg, soaperiod, soaperiod2)VALUES('".$soaid."', '".$tenantid."', '".$tenantname."', '".$soayear."', '".$soaMonth."', '".$totalamount."', '".$createdby."', '".$datecreated."', '".$duedate."', '".$tenantdues."', '".$revenue."', '".$Forwbal."', '".$Currbal."', '".$payment."', '".$currcharg."', '".$hperiod."', '".$billno."', '".$ctrlno."', '".$isedit."', '".$b13."', '".$b36."', '".$b69."', '".$b99."', '".$b00."', '".$pleft."', '".$penchrg."', '".$soaperiod."', '".$soaperiod2."')");

						}
						// =================================================================================================================
						if($insert_header_soa == true){
		    				echo "1|".date("F", strtotime($posteddate));    					
						}
					}
					else{
						echo "2|".date("F", strtotime($posteddate));
					}
				}
			}
		break;

		case 'reprocesssoa':
			$sql_prefix = "SELECT mallprefix FROM tblsys_setup2";
			$result_prefix = mysql_query($sql_prefix, $connection);
			$row_prefix = mysql_fetch_array($result_prefix);

				// =================================================================================================================
				$sql_all = "SELECT TenantID, companyname, costpermonths, tenanttype, revpercent, tradename FROM tbltrans_tenants WHERE Status = 'actived' AND ustatus = 'occupied' ORDER BY companyname ASC ";
				$result_all = mysql_query($sql_all, $connection);
				while ($row_all = mysql_fetch_array($result_all))
				{
					$ttlrevenues = "SELECT SUM(fnmGTDlySls) FROM db_sales WHERE tenantid = '".$row_all["TenantID"]."' AND (YEAR(fdtTrnsctn) = '".date("Y", strtotime($_POST["year"]))."' AND MONTH(fdtTrnsctn)='".date("m", strtotime($_POST["month"]))."')";
					$reusltrevenues = mysql_query($ttlrevenues, $connection);
					$row_rev = mysql_fetch_array($reusltrevenues);

					$month = date("n") - 1;
					$month2 = date("n");
					
					$sql_prev_bal = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND xdescription != 'Penalty' AND MONTH(xdate) <= '" . $month. "' AND balance != '0.00'"));

					$sql_curr_bal = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND xdescription != 'Penalty' AND MONTH(xdate) >= '" . $month2. "' AND balance != '0.00'"));
			
					$sql_penalty = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND xdescription == 'Penalty' AND MONTH(xdate) >= '" . $month2. "' AND balance != '0.00'"));

					$ttlpyment = 0;
					$sql_payment = "SELECT amount FROM tbltransaction WHERE tenantid = '" . $row_all['TenantID'] . "' AND MONTH(xdate) >= '" . $month2. "' AND paymenttype != '' ";
					$payment = mysql_query($sql_payment, $connection);
					while($row_payment = mysql_fetch_array($payment))
					{
						$thisval = explode("-", $row_payment["amount"]);
						$ttlpyment += floatval($thisval[1]);
					}

					$rent = $row_all['costpermonths'];
					$share = (floatval($row_all["revpercent"])/100)*floatval($row_rev[0]);
					$ttl = floatval($share) + floatval($rent) + floatval($sql_prev_bal[0]);
					$lesspayment = (floatval($sql_prev_bal[0]) + floatval($sql_curr_bal[0])) - floatval($ttlpyment);
					$username = getusername();
					$ctrlno = createctrlno("", "dunn_tblsoaheader", "ctrlno");

					$insert_header_soa = mysql_query("UPDATE dunn_tblsoaheader SET totalamount = '".$ttl."', tenantdues = '".$rent."', revenue = '".$share."', Forwbal = '".$sql_prev_bal[0]."', Currbal = '".$lesspayment."', payment = '".$ttlpyment."', currcharg = '".$row_[currcharg]."', hperiod = 'not posted' , isedit = '0' , b13 = '".$row_[b13]."', b36 = '".$row_[b36]."', b69 = '".$row_[b69]."', b99 = '".$row_[b99]."', b00 = '".$row_[b00]."', pleft = '".$row_[pleft]."', penchrg = '".$sql_penalty[0]."' WHERE tenantid = '".$row_all["TenantID"]."' AND soayear = '". date("Y", strtotime($_POST["year"])) ."' AND soamonth = '". date("n", strtotime($_POST["month"])) ."' ");

				}
				// =================================================================================================================

				if($insert_header_soa == true)
				{
    				echo "1|";
    				if($_POST['month'] == "1"){
		        		echo "January";
		        	}else if($_POST['month'] == "2"){
						echo "February";
		        	}else if($_POST['month'] == "3"){
						echo "March";
		        	}else if($_POST['month'] == "4"){
						echo "April";
		        	}else if($_POST['month'] == "5"){
						echo "May";
		        	}else if($_POST['month'] == "6"){
						echo "June";
		        	}else if($_POST['month'] == "7"){
						echo "July";
		        	}else if($_POST['month'] == "8"){
						echo "August";
		        	}else if($_POST['month'] == "9"){
						echo "September";
		        	}else if($_POST['month'] == "10"){
						echo "Oct";
		        	}else if($_POST['month'] == "11"){
						echo "November";
		        	}else if($_POST['month'] == "12"){
						echo "December";
		        	}    					
				} 			
		break;

		case 'loadallprocessedsoa':
			$sql = "SELECT soaNo, month_period, year_period, DueDate, dateadded, xstat FROM tbltrans_processedsoa";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				echo $row[0];
				$period = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '". $row[1] ."' AND year_period = '". $row[2] ."' ", $connection));
				if($row["xstat"] == "1")
				{
					$stat = "<span class='label label-sm label-success arrowed-in'>Posted</span>";
				}
				else if($row["xstat"] == "0")
				{
					$stat = "<span class='label label-sm label-warning arrowed-right'>Not Posted</span>";
				}

				echo "<tr onclick='showallbills(\"".$row["soaNo"]."\");loadallbills(\"".$row["month_period"]."\", \"".$row["year_period"]."\", \"".$row["xstat"]."\", \"".date('m/d/Y', strtotime($period["datefrom"]))."\", \"".date('m/d/Y', strtotime($period["dateto"]))."\", \"".date('m/d/Y', strtotime($row["DueDate"]))."\", \"".$_POST['tenantid']."\")'>
                          <td>".date('m/d/Y', strtotime($period[0]))." - ".date('m/d/Y', strtotime($period[1]))."</td>
                          <td>".date('m/d/Y', strtotime($row["DueDate"]))."</td>
                          <td>".$stat."</td>
                      </tr>";
			}
		break;

		case 'showallbills':
			$sql = "SELECT soaNo, month_period, year_period, DueDate, xstat FROM tbltrans_processedsoa WHERE soaNo = '".$_POST["id"]."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);

			echo $row["soaNo"] . "|".date('F', mktime(0, 0, 0, $row["month_period"], 10))." ".$row["year_period"]."|" . $row["DueDate"] . "|" . $row["xstat"];
		break;

		case 'loadallbills':
		if($_POST['tenantid'] == ""){
    		$sql = "SELECT tenantid, tenantname, Currbal, ctrlno, soayear, soaMonth FROM dunn_tblsoaheader WHERE soayear = '".$_POST["year"]."' AND soaMonth = '".$_POST["month"]."'";
		}else{
    		$sql = "SELECT tenantid, tenantname, Currbal, ctrlno, soayear, soaMonth FROM dunn_tblsoaheader WHERE soayear = '".$_POST["year"]."' AND soaMonth = '".$_POST["month"]."' AND tenantid = '". $_POST['tenantid'] ."' ";
		}
    		$result = mysql_query($sql, $connection);
    		while($row = mysql_fetch_array($result))
    		{
    			$maxid = "";
				$str = strlen($row["ctrlno"]);
				if($str == 1)
				{ $maxid = "000" . $row["ctrlno"]; }
				elseif($str == 2)
				{ $maxid = "00" . $row["ctrlno"]; }
				elseif($str == 3)
				{ $maxid = "0" . $row["ctrlno"]; }
				else
				{ $maxid = $row["ctrlno"]; }
				// <td><input name='' class='ace ace-checkbox-2 chkprocessedsoa' type='checkbox' value='".$row["tenantid"]."'><span class='lbl'></span></label></td>
    			echo "<tr onclick='opensoa_separate(\"".$row["tenantid"]."\", \"".$row["soayear"]."\", \"".$row["soaMonth"]."\")'>
                          <td style='width:25%;'>".$row["tenantid"]."</td>
                          <td style='width:25%;'>".$row["tenantname"]."</td>
                          <td style='width:25%;'>".number_format($row["Currbal"], 2, '.', ',')."</td>
                          <td style='width:25%;'>".$maxid."</td>
                      </tr>";
    		}
		break;

		case 'postloadbill':
		 	$sql = mysql_query("UPDATE tbltrans_processedsoa SET xstat = '1' WHERE year_period = '".$_POST["year"]."' AND month_period = '".$_POST["month"]."'");
		 	$sql2 = mysql_query("UPDATE dunn_tblsoaheader SET xstat = '1', hperiod = 'posted' WHERE soayear = '".$_POST["year"]."' AND soaMonth = '".$_POST["month"]."'");

		 	if($sql == true && $sql2 == true)
		 	{
		 		echo "1|".date('M', strtotime($row["month"]));
				$date = date('Y-m-d', strtotime($_POST['year']."-0".$_POST['month']."-01"));
		 		$updatetbltransaction = mysql_query(" UPDATE tbltransaction SET Post_Stat = '1' WHERE xdate = '". $date ."' ", $connection);
		 	}
		 	else
		 	{
		 		echo "2|".date('M', strtotime($row["month"]));
		 	}
		break;

		case 'loadperiodlist':
			$datenow = getsysdate();
    		$sql = "SELECT month_period, year_period FROM tbltrans_processedbill WHERE gen_xstat = '0' AND dateto < '".$datenow."'";
    		$result = mysql_query($sql, $connection);
    		while($row = mysql_fetch_array($result))
    		{
    			echo "<tr style='width: 100%;display: table;table-layout: fixed;' onclick='selectedperiodsel(\"".$row["month_period"]."/1/".$row["year_period"]."\", \"".date("F", mktime(0, 0, 0, $row["month_period"], 10))." ".$row["year_period"]."\")'>
                          <td>".date("F", mktime(0, 0, 0, $row["month_period"], 10))." ".$row["year_period"]."</td>
                      </tr>";
    		}
		break;

		case 'loadrefperiodlist':
    		$sql = "SELECT month_period, year_period, DueDate, datefrom, dateto FROM tbltrans_processedbill";
    		$result = mysql_query($sql, $connection);
    		while($row = mysql_fetch_array($result))
    		{
    			echo "<tr>
                          <td style='width:25%;'>".date('F', mktime(0, 0, 0, $row["month_period"], 10))." ".$row["year_period"]."</td>
                          <td style='width:25%;'>".date("F d, Y", strtotime($row["datefrom"]))."</td>
                          <td style='width:25%;'>".date("F d, Y", strtotime($row["dateto"]))."</td>
                          <td style='width:25%;'>".date("F d, Y", strtotime($row["DueDate"]))."</td>
                      </tr>";
    		}
		break;

		case 'savenewperiodref':
			$sql = "SELECT COUNT(DueDate) FROM tbltrans_processedbill WHERE month_period = '".date("m", strtotime($_POST["datefrom"]))."' AND year_period = '".date("Y", strtotime($_POST["datefrom"]))."'";
			$result = mysql_query($sql, $connection);
			$row = mysql_fetch_array($result);
			if($row[0] == 0 || $row[0] == "0")
			{
				$sql_insert = mysql_query("INSERT INTO tbltrans_processedbill (month_period, year_period, DueDate, dateadded, datefrom, dateto) VALUES ('".date("m", strtotime($_POST["datefrom"]))."', '".date("Y", strtotime($_POST["datefrom"]))."', '".date("Y-m-d", strtotime($_POST["duedate"]))."', '".date("y-m-d H:i:s")."', '".date("Y-m-d", strtotime($_POST["datefrom"]))."', '".date("Y-m-d", strtotime($_POST["dateto"]))."')");
				if($sql_insert == true)
				{
					echo "1";
				}
			}
			else
			{
				echo "2";
			}
		break;

		// case 'savenewperiodref':
		// 	$getexisting = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '".date("m", strtotime($_POST["datefrom"]))."' AND year_period = '".date("Y", strtotime($_POST["datefrom"]))."' ", $connection));
		// 	$sql2 = "SELECT COUNT(datefrom) FROM tbltrans_processedbill WHERE datefrom BETWEEN '". date('Y-m-d', strtotime($getexisting[0])) ."' AND '". date('Y-m-d', strtotime($getexisting[1])) ."' ";
		// 	$result = mysql_query($sql, $connection);
			
		// 	// $row = mysql_fetch_array($result);
		// 	// if($row[0] == 0 || $row[0] == "0")
		// 	// {
		// 	// 	$sql_insert = mysql_query("INSERT INTO tbltrans_processedbill (month_period, year_period, DueDate, dateadded, datefrom, dateto) VALUES ('".date("m", strtotime($_POST["datefrom"]))."', '".date("Y", strtotime($_POST["datefrom"]))."', '".date("Y-m-d", strtotime($_POST["duedate"]))."', '".date("y-m-d H:i:s")."', '".date("Y-m-d", strtotime($_POST["datefrom"]))."', '".date("Y-m-d", strtotime($_POST["dateto"]))."')");
		// 	// 	if($sql_insert == true)
		// 	// 	{
		// 	// 		echo "1";
		// 	// 	}
		// 	// }
		// 	// else
		// 	// {
		// 	// 	echo "2";
		// 	// }
		// break;

		case 'loaddalladdedref':
    		echo "<option value=''>-- Select Period --</option>";
    		$sql = "SELECT month_period, year_period FROM tbltrans_processedbill WHERE gen_xstat = '1'";
    		$result = mysql_query($sql, $connection);
    		while($row = mysql_fetch_array($result))
    		{
    			echo "<option value='".date('F', mktime(0, 0, 0, $row["month_period"], 10))."|".$row["year_period"]."'>".date('F', mktime(0, 0, 0, $row["month_period"], 10))." ".$row["year_period"]."</option>";
    		}
		break;

		case 'penalizetenants':
		$tenant = explode("#", $_POST["val"]);
		for($i=0;$i<count($tenant)-1;$i++)
		{
			$posted = explode("|", $tenant[$i]);
			$sql = "SELECT DueDate FROM tbltrans_processedbill WHERE gen_xstat = '1' OR gen_xstat = '2' WHERE month_period = '".$posted[0]."' AND year_period = '".$posted[1]."'";
			$result = mysql_query($sql, $connection);
			$duedate = mysql_fetch_array($result);
			$datenow = getsysdate();
			if(date("Y-m-d", strtotime($duedate[0])) < $datenow)
    		{
    			$alltenants = "SELECT TenantID, costpermonths, tradename FROM tbltrans_tenants WHERE Status = 'actived' AND ustatus = 'occupied' AND TenantID = '".$posted[2]."'";
	    		$resulttenants = mysql_query($alltenants, $connection);
	    		while($tenantss = mysql_fetch_array($resulttenants))
	    		{
	    			$percentpenalty = mysql_fetch_array(mysql_query("SELECT chrgpenalpercent FROM tblref_charges WHERE chrgpenaltytype = 'Monthly'"));
					
					$month = $posted[0];
					$year = $posted[1];

					// **************************************************************************************
					$getbalance = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '".$tenantss['TenantID']."' AND balance != '0.00' AND description = 'Monthly Rental' AND (MONTH(xdate) = '".$month."' AND YEAR(xdate) = '".$year."')"));

					$getperiod = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '".$month."' AND year_period = '".$year."'"));
					$header = explode("|", getrentvattype());
					$vatpercent = floatval($header[5]) / 100;

					if($header[6] == "yes")
					{
						if($header[4] == "percent")
						{
							if($header[7] == "inc")
							{
								$penalty_percentage = floatval($header[9]) / 100;
								$penalty = $penalty_percentage * floatval($getbalance[0]);
								$vat_pen = $penalty * (floatval($header[5]) / 100);
								$bef_vat_pen = $penalty - $vat_pen;
								$ttll = $vat_pen + $bef_vat_pen;
							}
							else
							{
								$penalty_percentage = floatval($header[5]) / 100;
								$penalty = $penalty_percentage * floatval($getbalance[0]);
								$vat_pen = $penalty * (floatval($header[5]) / 100);
								$bef_vat_pen = $penalty + $vat_pen;
								$ttll = $vat_pen + $bef_vat_pen;
							}
						}
						else
						{
							if($header[7] == "inc")
							{
								$penalty = floatval($header[8]);
								$vat_pen = $penalty * (floatval($header[5]) / 100);
								$bef_vat_pen = $penalty - $vat_pen;
								$ttll = $vat_pen + $bef_vat_pen;
							}
							else
							{
								$penalty = floatval($header[8]);
								$vat_pen = $penalty * (floatval($header[5]) / 100);
								$bef_vat_pen = $penalty + $vat_pen;
								$ttll = $vat_pen + $bef_vat_pen;
							}
						}									
					}
					else
					{
							$penalty_percentage = floatval($percentpenalty["chrgpenalpercent"])/100;
							$ttll = floatval($getbalance[0]);
							$penalty = $penalty_percentage * $ttll;
					}

					// **************************************************************************************
					$chargetomonth = date( 'Y-m-d', strtotime($year . "-" . $month . "-1" . '+1 month') );
					

					$sql_cnt = mysql_fetch_array(mysql_query("SELECT COUNT(tenantid) FROM tbltransaction WHERE tenanttype = '".$posted[0]."|".$posted[1]."' AND tenantid = '".$posted[2]."'"));
		    		if($sql_cnt[0] == 0)
		    		{
						if($getbalance[0] != 0)
						{
							$savepenalty = mysql_query("INSERT INTO tbltransaction SET tenantid = '".$posted[2]."', description = 'Penalty for the month of " . date("F", mktime(0, 0, 0, $posted[0], 10)) ."',amount = '".$bef_vat_pen."', vatamount = '".$vat_pen."', balance = '".$ttll."',xpenalty = '".$ttll."', qty = 1, xdate = '".$chargetomonth."', xdescription = 'Penalty', tenanttype = '".$posted[0]."|".$posted[1]."'");								
						} 			    					
					}
	    		}
    		}
		}    		
		break;

		case 'penalizetenants_2':
			$allduedate = "";
			$sql = "SELECT month_period, year_period, DueDate FROM tbltrans_processedbill WHERE gen_xstat = '1' OR gen_xstat = '2'";
			$result = mysql_query($sql, $connection);
			while($row = mysql_fetch_array($result))
			{
				$allduedate .= $row["month_period"] . "|" . $row["year_period"] . "|" . $row["DueDate"] . "#";
			}

			echo $allduedate;
			$dates = explode("#", $allduedate);
			for($x=0; $x<=count($dates)-2; $x++)
			{
				$arr = explode("|", $dates[$x]);
				$datenow = getsysdate();
    			if(date("Y-m-d", strtotime($arr[2])) < $datenow)
    			{
	    			$alltenants = "SELECT TenantID, costpermonths, tradename FROM tbltrans_tenants WHERE Status = 'actived' AND ustatus = 'occupied'";
	    			$resulttenants = mysql_query($alltenants, $connection);
	    			while($tenantss = mysql_fetch_array($resulttenants))
	    			{
						$percentpenalty = mysql_fetch_array(mysql_query("SELECT chrgpenalpercent FROM tblref_charges WHERE chrgpenaltytype = 'Monthly'"));
						
						$month = $arr[0];
						$year = $arr[1];

						// **************************************************************************************
						$getbalance = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '".$tenantss['TenantID']."' AND balance != '0.00' AND description = 'Monthly Rental' AND (MONTH(xdate) = '".$month."' AND YEAR(xdate) = '".$year."')"));

						$getperiod = mysql_fetch_array(mysql_query("SELECT datefrom, dateto FROM tbltrans_processedbill WHERE month_period = '".$month."' AND year_period = '".$year."'"));
						$header = explode("|", getrentvattype());
						$vatpercent = floatval($header[5]) / 100;

						if($header[6] == "yes")
						{
							if($header[4] == "percent")
							{
								if($header[7] == "inc")
								{
									$penalty_percentage = floatval($header[9]) / 100;
									$penalty = $penalty_percentage * floatval($getbalance[0]);
									$vat_pen = $penalty * (floatval($header[5]) / 100);
									$bef_vat_pen = $penalty - $vat_pen;
									$ttll = $vat_pen + $bef_vat_pen;
								}
								else
								{
									$penalty_percentage = floatval($header[5]) / 100;
									$penalty = $penalty_percentage * floatval($getbalance[0]);
									$vat_pen = $penalty * (floatval($header[5]) / 100);
									$bef_vat_pen = $penalty + $vat_pen;
									$ttll = $vat_pen + $bef_vat_pen;
								}
							}
							else
							{
								if($header[7] == "inc")
								{
									$penalty = floatval($header[8]);
									$vat_pen = $penalty * (floatval($header[5]) / 100);
									$bef_vat_pen = $penalty - $vat_pen;
									$ttll = $vat_pen + $bef_vat_pen;
								}
								else
								{
									$penalty = floatval($header[8]);
									$vat_pen = $penalty * (floatval($header[5]) / 100);
									$bef_vat_pen = $penalty + $vat_pen;
									$ttll = $vat_pen + $bef_vat_pen;
								}
							}									
						}
						else
						{
								$penalty_percentage = floatval($percentpenalty["chrgpenalpercent"])/100;
								$ttll = floatval($getbalance[0]);
								$penalty = $penalty_percentage * $ttll;
						}

						// **************************************************************************************
						$chargetomonth = date( 'Y-m-d', strtotime($year . "-" . $month . "-1" . '+1 month') );
						

						$sql_cnt = mysql_fetch_array(mysql_query("SELECT COUNT(tenantid) FROM tbltransaction WHERE tenanttype = '".$arr[0]."|".$arr[1]."' AND tenantid = '".$tenantss['TenantID']."'"));
		    			if($sql_cnt[0] == 0)
		    			{
							if($getbalance[0] != 0)
							{
								

								$savepenalty = mysql_query("INSERT INTO tbltransaction SET tenantid = '".$tenantss["TenantID"]."', description = 'Penalty for the month of " . date("F", mktime(0, 0, 0, $arr[0], 10)) ."',amount = '".$bef_vat_pen."', vatamount = '".$vat_pen."', balance = '".$ttll."',xpenalty = '".$ttll."', qty = 1, xdate = '".$chargetomonth."', xdescription = 'Penalty', tenanttype = '".$arr[0]."|".$arr[1]."'");								
							} 			    					
						}

	    			}	
    			}    					
			
			}
		break;

		case 'loadheader':
			$header = explode("|", getrentvattype()); 
			echo $header[3];
		break;

		// SEPARATE VIEWING OF STATEMENT OF ACCOUNT
		case 'gettenantsoadetails2':
			$sql = mysql_fetch_array(mysql_query("SELECT tradeID from tbltrans_tenants where tenantid = '" . $_POST['tenantid'] . "' AND ustatus = 'occupied' AND Status = 'actived'"));
			
			$sql2 = mysql_fetch_array(mysql_query("SELECT companyID, tradename, filename FROM tbltrans_tradename WHERE tradeID = '" . $sql['tradeID'] . "'"));
			
			$sql3 = mysql_fetch_array(mysql_query("SELECT businessAddress from tbltrans_company where CompanyID = '" . $sql2['companyID'] . "'"));

			$sql_get_due = mysql_fetch_array(mysql_query("SELECT dateto, DueDate FROM tbltrans_processedbill WHERE month_period = '".$_POST["month"]."' AND year_period = '".$_POST["year"]."' "));

			$src = "server/company/" . $sql2["companyID"] . "/trades/" . $sql['tradeID'] . "/" . $sql2['filename'];
			
			echo "|" . $sql2['companyID'] . "|" . strtoupper($sql2['tradename']) . "|" . $src . "|" . strtoupper($sql3['businessAddress']) . "|" . date("F d, Y", strtotime($sql_get_due["DueDate"])) . "|Printed by: ". getusername() ." - " . date("F d, Y h:i:s A") . "|" . date('F Y', strtotime($sql_get_due["dateto"]));
			//echo $sql;
		break;

    	case 'getsoacurrent2':
    		$sql = "SELECT xcode, description, amount, qty, SUM(vatamount + amount), xdate, reference, xdescription FROM dunn_tblsoadetails WHERE xdate = '".$_POST["year"]."-".$_POST["month"]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND paymenttype = '' AND description LIKE '%Rent%' GROUP BY id";
    		$result = mysql_query($sql, $connection);
    		while($row = mysql_fetch_array($result))
    		{
    			if($row[1] == "Monthly Rental")
    			{
    				$desc = " - ". $row[7] ."";
    			}
    			else
    			{
    				$desc = "";
    			}

    			echo "<tr>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-left: 10px;' align='left'>" . date("M Y", strtotime($row[5])) . "</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[6] ."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[1] ."".$desc."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-right: 5px;' align='right'>" . number_format($row[4], "2", ".", ",") ."</td>
					</tr>";
    		}
    	break;

    	case 'getothercharges2':
    		$sql = "SELECT xcode, description, amount, qty, SUM(vatamount + amount), xdate, reference, xdescription FROM dunn_tblsoadetails WHERE xdate = '".$_POST["year"]."-".$_POST["month"]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND paymenttype = '' AND description NOT LIKE '%Rent%' GROUP BY id";
    		$result = mysql_query($sql, $connection);
    		while($row = mysql_fetch_array($result))
    		{
    			if($row[1] == "Monthly Rental")
    			{
    				$desc = " - ". $row[7] ."";
    			}
    			else
    			{
    				$desc = "";
    			}

    			echo "<tr>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-left: 10px;' align='left'>" . date("M Y", strtotime($row[5])) . "</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[6] ."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[1] ."".$desc."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-right: 5px;' align='right'>" . number_format($row[4], "2", ".", ",") ."</td>
					</tr>";
    		}
    	break;

    	case 'getsoapayment2':
    		$sql_get_due = mysql_fetch_array(mysql_query("SELECT month_period, year_period, datefrom, dateto, DueDate FROM tbltrans_processedbill WHERE month_period = '".$_POST["month"]."' AND year_period = '".$_POST["year"]."' "));

    		$sql = "SELECT xcode, description, amount, qty, balance, xdate, reference, xdescription FROM dunn_tblsoadetails WHERE tenantid = '" . $_POST['tenantid'] . "' AND paymenttype != '' AND (xdate BETWEEN '".date("Y-m-d", strtotime($sql_get_due["dateto"]))."' AND '".date("Y-m-d", strtotime($sql_get_due["DueDate"]))."')";
    		$result = mysql_query($sql, $connection);
    		while($row = mysql_fetch_array($result))
    		{
    			if($row[1] == "Monthly Rental")
    			{
    				$desc = " - ". $row[7] ."";
    			}
    			else
    			{
    				$desc = "";
    			}

    			$amnt = explode("-", $row[2]);
    			echo "<tr>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-left: 10px;' align='left'>" . date("M Y", strtotime($row[5])) . "</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[6] ."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;' align='left'>" . $row[1] ."".$desc."</td>
						<td style='font-weight: normal;margin: 3px;font-size: 11px;padding-right: 5px;' align='right'>" . number_format($amnt[1], "2", ".", ",") ."</td>
					</tr>";
    		}
    	break;

    	case 'getsoabreakdowns2':		
			$sql_get_due = mysql_fetch_array(mysql_query("SELECT month_period, year_period, datefrom, dateto, DueDate FROM tbltrans_processedbill WHERE month_period = '".$_POST["month"]."' AND year_period = '".$_POST["year"]."' "));

    		$sql = mysql_fetch_array(mysql_query("SELECT SUM(balance), SUM(vatamount) FROM dunn_tblsoadetails WHERE xdate < '".$_POST["year"]."-".$_POST["month"]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND paymenttype = ''"));
		
			$sql2 = mysql_fetch_array(mysql_query("SELECT SUM(balance), SUM(vatamount), SUM(amount) FROM dunn_tblsoadetails WHERE xdate = '".$_POST["year"]."-".$_POST["month"]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND paymenttype = ''"));

			$penalty_sql = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM dunn_tblsoadetails WHERE xdate <= '".$_POST["year"]."-".$_POST["month"]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND xdescription = 'Penalty'"));

			$netsales_sql = mysql_fetch_array(mysql_query("SELECT SUM(amount) FROM dunn_tblsoadetails WHERE xdate <= '".$_POST["year"]."-".$_POST["month"]."-01' AND tenantid = '" . $_POST['tenantid'] . "' AND xdescription != 'Penalty' AND paymenttype = ''"));
			
			$ttlpyment = 0;
			$sql3 = "SELECT amount FROM dunn_tblsoadetails WHERE tenantid = '" . $_POST['tenantid'] . "' AND paymenttype != '' AND (xdate BETWEEN '".date("Y-m-d", strtotime($sql_get_due["dateto"]))."' AND '".date("Y-m-d", strtotime($sql_get_due["DueDate"]))."')";
			$res = mysql_query($sql3, $connection);
			while($row = mysql_fetch_array($res))
			{
				$thisval = explode("-", $row["amount"]);
				$ttlpyment += floatval($thisval[1]);
			}
			$vatnamount = floatval($sql2[1]) + floatval($sql2[2]);
			$overall = (floatval($sql[0]) + floatval($vatnamount)) - floatval($ttlpyment);
			$vat = floatval($sql[1]) + floatval($sql2[1]);
			$penalty = floatval($penalty_sql[0]);
			$netsales = floatval($netsales_sql[0]); //no vat and penalty
			$ttlcurrchargs = $vat + $penalty + $netsales;
			echo number_format($sql[0], "2", ".", ",") . "|";  // PREVIOUS BALANCES
			echo number_format($vatnamount, "2", ".", ",") . "|"; // CURRENT CHARGES
			echo number_format($ttlpyment, "2", ".", ",") . "|";     // PAYMENTS
			echo number_format($overall, "2", ".", ",") . "|";     // PREV + CURRENT (-PAYMENT)
			echo number_format($vat, "2", ".", ",") . "|";     // TOTAL VAT
			echo number_format($penalty, "2", ".", ",") . "|";     // TOTAL PENALTY
			echo number_format($netsales, "2", ".", ",") . "|";     // TOTAL NET SALES
			echo number_format($ttlcurrchargs, "2", ".", ",") . "|";     // TOTAL CURRENT CHARGES
    	break;    

    	case 'getsoaaging2':
    		$res = mysql_query("SELECT b00, b13, b36, b69, b99 FROM dunn_tblsoaheader WHERE tenantid = '". $_POST['tenantid'] ."' AND soaMonth = '". $_POST['month'] ."' AND soayear = '". $_POST['year'] ."' ", $connection);
    		$row = mysql_fetch_array($res);
    			echo number_format($row[0], "2", ".", ",")."|".number_format($row[1], "2", ".", ",")."|".number_format($row[2], "2", ".", ",")."|".number_format($row[3], "2", ".", ",");
   		break;
    	//  END OF SEPARATE VIEWING OF STATEMENT OF ACCOUNT

    	case 'displaylistofpenalty':
    		$page = $_POST['page'];
			$limit = ($page-1) * 20;

    		$sql = " SELECT tenantid, description, amount, vatamount, balance FROM tbltransaction WHERE xdescription = 'Penalty' LIMIT ".$limit.",20 ";
    		$res = mysql_query($sql, $connection);
    		while( $row = mysql_fetch_array($res) ){
    			$table .= "	<tr>
    							<td width='20%'>".$row[0]."</td>
					   				<td width='20%'>".$row[1]."</td>
					   				<td width='20%'>".number_format($row[2], "2", ".", ",")."</td>
					   				<td width='20%'>".number_format($row[3], "2", ".", ",")."</td>
					   				<td width='20%'>".number_format($row[4], "2", ".", ",")."</td>
    						</tr>";
    		}
    		echo $table;
    	break;

    	case 'loadentriespenalties':
            if($_POST["page"] == ""){
                $page = 1;
            }else{
                $page = $_POST["page"];
            }

            $limit = ($page-1) * 20;

            $sql = " SELECT COUNT(*) FROM tbltransaction WHERE xdescription = 'Penalty' ";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            $rowsperpage = 20;
            $totalpages = ceil($row[0] / $rowsperpage);
            $upto = $limit + 20;
            $from = $limit + 1;
            if($page == $totalpages && $row[0] != 0){
                 echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
            }
            else
            {
                 if($row[0] == 0){
                   echo "";
                  }
                 else if($row[0] <= 19 && $row[0] != 0){
                   echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
                  }
                 else if($row[0] >= 20 && $row[0] != 0){
                   echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
                  }

             }
        break;

		case "loadpagelistofpenalties":
		    $page = $_POST["page"];

        	$sqlb = "SELECT COUNT(*) FROM tbltransaction WHERE xdescription = 'Penalty' ";
			$aa = mysql_query($sqlb, $connection);
			$nums = mysql_fetch_row($aa);
			$num = $nums[0];
			// if($num <= 20)
			// {
			// 	$page = 1
			// }
			$rowsperpage = 20;
			$range = 19;
			$totalpages = ceil($num / $rowsperpage);
			$prevpage;
			$nextpage;
			// if not on page 1, don't show back links
			if($page > 1 ){
			   echo "<li style='width:50px !important;' onclick='paginationpenalties(1)'><< First</li>";
			   $prevpage = $page - 1;
			   echo "<li style='width:70px !important;' onclick='paginationpenalties(". $prevpage .")'>< Previous</li>";
			}

			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
			{
			   if (($x > 0) && ($x <= $totalpages)){
    			    if ($x == $page){
                        echo "<li id='pgpenalties" . $x . "' class='pgnumpenalties active' onclick='paginationpenalties(" . $x . ",". $x .")'>" . $x . "</li>";
                      }
    			    else{
    			        echo "<li id='pgpenalties" . $x . "' class='pgnumppenalties' onclick='paginationpenalties(" . $x . ",". $x .")'>" . $x . "</li>";
                    }
		       }
		    }
		    if($page < ($totalpages - $range)){
                echo "<li>...</li>";
            }

		    if ($page != $totalpages && $num != 0){
		       $nextpage = $page + 1;
		       echo "<li style='width:50px !important;' onclick='paginationpenalties(". $nextpage .", ". $nextpage .")'>Next ></li>";
		       echo "<li style='width:50px !important;' onclick='paginationpenalties(". $totalpages .", ". $totalpages .")'>Last >></li>";
		    }
		break;

		case 'tbllistofpdc':
			$page = $_POST['page'];
			$limit = ($page-1) * 20;
			$sql = " SELECT customerid, pdcdate, amount, depositorystat, checkstat, bank, checkno, penalty FROM tbltrans_pdc WHERE pdcdate BETWEEN '".date("Y/m/d", strtotime($_POST['dateFrom']))."' AND '".date("Y/m/d", strtotime($_POST['dateTo']))."' ORDER BY pdcdate desc LIMIT ".$limit.",20 ";
			$res = mysql_query($sql, $connection);
			while( $row = mysql_fetch_array($res) ){
				$sqltradename = " SELECT tradename FROM tbltrans_tenants WHERE TenantID = '". $row[0] ."' ";
				$restradename = mysql_query($sqltradename, $connection);
				$rowtradename = mysql_fetch_array($restradename);

					?>
						<tr>
							<td width='5%'><?php echo $row[1]; ?></td> <?php
							echo "<td width='8%'>
								<div class='btn-group'>
									<button class='btn btn-xs btn-info' id='"."edit".$row[6]."' onclick='editfield(\"".$row[6]."\");' title='Edit'>
                                			<i class='ace-icon fa fa-pencil bigger-120' style='padding:1px;' ></i>
                                	</button>

                                	<button class='btn btn-xs btn-success' id='"."confirm".$row[6]."' style='display:none;' onclick='saveeditedpdc(\"".$row[6]."\");' title='Confirm'>
                                			<i class='ace-icon fa fa-check bigger-120' style='padding:1px;'></i>
                                	</button>

                                	<button class='btn btn-xs btn-danger' id='"."cancel".$row[6]."' style='display:none;' onclick='canceledit(\"".$row[6]."\");' title='Cancel'>
                                			<i class='ace-icon fa fa-times bigger-120' style='padding:1px;'></i>
                                	</button>
								</div>
							</td>";
					?>
							<td width='10%'><?php echo $row[0]; ?></td>
							<td width='13%'><?php echo $rowtradename[0]; ?></td>
							<td width='10%' id="<?php echo "tdamount".$row[6]; ?>">
								<?php echo number_format($row[2], "2", ".", ","); ?>
							</td>

							<td width='12%' id="<?php echo "tddepositorystat".$row[6]; ?>">
								<?php echo $row[3]; ?>
							</td>

							<td width='10%' id="<?php echo "tdcheckstat".$row[6]; ?>">
							<?php echo $row[4]; ?>
							</td>

							<td width='5%'><?php echo $row[5]; ?></td>
							<td width='10%'><?php echo $row[6]; ?></td>

							<td width='10%' id="<?php echo "tdpenalty".$row[6]; ?>">
								<?php echo number_format($row[7], "2", ".", ","); ?>
							</td>
						</tr>
						<?php
			}
		break;

		case 'loadentriespdc':
            if($_POST["page"] == ""){
                $page = 1;
            }else{
                $page = $_POST["page"];
            }

            $limit = ($page-1) * 20;

            $sql = " SELECT COUNT(*) FROM tbltrans_pdc WHERE pdcdate BETWEEN '".date("Y/m/d", strtotime($_POST['dateFrom']))."' AND '".date("Y/m/d", strtotime($_POST['dateTo']))."' ";
            $result = mysql_query($sql, $connection);
            $row = mysql_fetch_array($result);

            $rowsperpage = 20;
            $totalpages = ceil($row[0] / $rowsperpage);
            $upto = $limit + 20;
            $from = $limit + 1;
            if($page == $totalpages && $row[0] != 0){
                 echo "Showing " . $from . " to " . $row[0] . " of " . $row[0] . " entries";
            }
            else
            {
                 if($row[0] == 0){
                   echo "";
                  }
                 else if($row[0] <= 19 && $row[0] != 0){
                   echo "Showing 1 to " . $row[0] . " of " . $row[0] . " entries";
                  }
                 else if($row[0] >= 20 && $row[0] != 0){
                   echo "Showing " . $from . " to " . $upto . " of " . $row[0] . " entries";
                  }

             }
        break;

		case "loadpagespdc":
		    $page = $_POST["page"];

        	$sqlb = "SELECT COUNT(*) FROM tbltrans_pdc WHERE pdcdate BETWEEN '".date("Y/m/d", strtotime($_POST['dateFrom']))."' AND '".date("Y/m/d", strtotime($_POST['dateTo']))."' ";
			$aa = mysql_query($sqlb, $connection);
			$nums = mysql_fetch_row($aa);
			$num = $nums[0];
			// if($num <= 20)
			// {
			// 	$page = 1
			// }
			$rowsperpage = 20;
			$range = 19;
			$totalpages = ceil($num / $rowsperpage);
			$prevpage;
			$nextpage;
			// if not on page 1, don't show back links
			if($page > 1 ){
			   echo "<li style='width:50px !important;' onclick='paginationpdc(1)'><< First</li>";
			   $prevpage = $page - 1;
			   echo "<li style='width:70px !important;' onclick='paginationpdc(". $prevpage .")'>< Previous</li>";
			}

			for($x = ($page - $range); $x < (($page + $range) + 1); $x++)
			{
			   if (($x > 0) && ($x <= $totalpages)){
    			    if ($x == $page){
                        echo "<li id='pgpdc" . $x . "' class='pgnumpdc active' onclick='paginationpdc(" . $x . ",". $x .")'>" . $x . "</li>";
                      }
    			    else{
    			        echo "<li id='pgpdc" . $x . "' class='pgnumppdc' onclick='paginationpdc(" . $x . ",". $x .")'>" . $x . "</li>";
                    }
		       }
		    }
		    if($page < ($totalpages - $range)){
                echo "<li>...</li>";
            }

		    if ($page != $totalpages && $num != 0){
		       $nextpage = $page + 1;
		       echo "<li style='width:50px !important;' onclick='paginationpdc(". $nextpage .", ". $nextpage .")'>Next ></li>";
		       echo "<li style='width:50px !important;' onclick='paginationpdc(". $totalpages .", ". $totalpages .")'>Last >></li>";
		    }
		break;

		case 'pdctable':
			$return_arr = array();
			$ctr = 1;
			$sql = " SELECT pdcdate, customerid, amount, depositorystat, checkstat, bank, checkno, penalty FROM tbltrans_pdc ";
			$res = mysql_query($sql, $connection);
			while( $row = mysql_fetch_array($res) ){
				$sqltradename = " SELECT tradename FROM tbltrans_tenants WHERE TenantID = '". $row[1] ."' ";
				$restradename = mysql_query($sqltradename, $connection);
				$rowtradename = mysql_fetch_array($restradename);

				array_push($num_arr[$ctr],$row[1]);

				$row_array['editicon'] = $row[0] . "|" . $row[1];
				$row_array['pdcdate'] = $row[0];
				$row_array['tenantid'] = $row[1];
				$row_array['tradename'] = $rowtradename[0];
				$row_array['amount'] = $row[2];
				$row_array['depositorystatus'] = $row[3];
				$row_array['checkstatus'] = $row[4];
				$row_array['bank'] = $row[5];
				$row_array['checkno'] = $row[6];
				$row_array['penalty'] = $row[7];

				array_push($return_arr,$row_array);
				$ctr ++;
			}
			echo json_encode($return_arr);
		break;

		case 'editfield':
			$sql = " SELECT amount, depositorystat, checkstat, penalty, checkno FROM tbltrans_pdc WHERE checkno = '".$_POST['checkno']."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			$asd .= "<select id='"."checkstat".$row[4]."'>";
						echo $asd; ?>
							<?php if($row[2] == "Pending") {?>
                                <option value='Pending'>Pending</option>
                                <option value='Close Account'>Close Account</option>
                                <option value='Check Replace'>Check Replace</option>
                                <option value='Cleared'>Cleared</option>
                            <?php } else if($row[2] == "Cleared") { ?>
                            	<option value='Cleared'>Cleared</option>
                                <option value='Close Account'>Close Account</option>
                                <option value='Check Replace'>Check Replace</option>
                                <option value='Pending'>Pending</option>
                            <?php } else if($row[2] == "Check Replace") { ?>
                                <option value='Check Replace'>Check Replace</option>
                                <option value='Close Account'>Close Account</option>
                            	<option value='Cleared'>Cleared</option>
                                <option value='Pending'>Pending</option>
                            <?php } else if($row[2] == "Close Account") {?>
                                <option value='Close Account'>Close Account</option>
                            	<option value='Check Replace'>Check Replace</option>
                            	<option value='Cleared'>Cleared</option>
                                <option value='Pending'>Pending</option>
                            <?php } ?>
                        </select>
                       	<?php

			echo  "|";

			echo "<input type='text' size='11' id='"."amount".$row[4]."' value='".$row[0]."'>". "|" . "<input type='text' size='11' id='"."penalty".$row[4]."' value='".$row[3]."'>" . "|";


			$zxc .= "<select id='"."depositorystat".$row[4]."'>";
				echo $zxc; ?>
				<?php if($row[1] == "For Deposit"){ ?>
					<option value='For Deposit'>For Deposit</option>
                    <option value='Deposited'>Deposited</option>
				<?php }else{ ?>
                    <option value='Deposited'>Deposited</option>
					<option value='For Deposit'>For Deposit</option>
				<?php } ?>
				</select>
				<?php 

		break;

		case 'cancelfield':
			$sql = " SELECT amount, depositorystat, checkstat, penalty, checkno FROM tbltrans_pdc WHERE checkno = '".$_POST['checkno']."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

			echo number_format($row[0], "2", ".", ",") . "|" . $row[1] . "|" . $row[2] . "|" . $row[3];
		break;

		case 'saveeditedpdc':
			$sql = " UPDATE tbltrans_pdc SET amount = '". $_POST['amount'] ."', depositorystat = '". $_POST['depositorystat'] ."', checkstat = '". $_POST['checkstat'] ."', penalty = '". $_POST['penalty'] ."' WHERE checkno = '". $_POST['checkno'] ."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);


			echo $_POST['amount'] . "|" . $_POST['depositorystat'] . "|" . $_POST['checkstat'] . "|" . $_POST['penalty'];
		break;

		case 'proceed_endofday':
			$select = mysql_fetch_array(mysql_query("SELECT eoddate FROM tbltrans_eod ORDER BY eoddate DESC LIMIT 0,1"));
			$date = date("Y-m-d", strtotime($select["eoddate"] .'+1 day'));
			$update = mysql_query("INSERT INTO tbltrans_eod (eoddate, processby, computerdate, xtime)VALUES('".$date."', '".$_POST["name"]."', '".date("Y-m-d")."', '".date("H:i:s")."')");

			echo date("F d, Y", strtotime($date)) . "|" . date("F d, Y") . "|" . $_POST["name"];

			$sqlzreading = " UPDATE tblforzreading SET Zreadingstat = '0' ";
			$reszreading = mysql_query($sqlzreading, $connection);
			$rowzreading = mysql_fetch_array($reszreading);
		break;

		case 'endofdayconfirm':
			$sql = "SELECT firstname, middlename, lastname from tbluser where password = '" . $_POST["username"] . "' and password2 = '" . md5($_POST["password"]) . "'";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            $num = mysql_num_rows($result);
                if($num > 0){ 
                    echo $row["lastname"].", ".$row["firstname"]." ".$row["middlename"];
                }else{ 
                    echo "";
                }
		break;

		case 'soasignatories':
			$mallid = mysql_fetch_array(mysql_query("SELECT mallid FROM tbltrans_tenants WHERE tenantid = '". $_POST['tenantid'] ."' ", $connection));
			$signatories = mysql_fetch_array(mysql_query("SELECT prepby, chkdby, apprby, rcvdby FROM mall_setup WHERE mall_id = '". $mallid[0] ."' ", $connection));
			$arr = explode("|", $signatories[0]);
				$prep = $arr[1]. " " .substr($arr[2], 0, 1). ". " .$arr[0]; 
			$arr2 = explode("|", $signatories[1]);
				$chkdby = $arr2[1]. " " .substr($arr2[2], 0, 1). ". " .$arr2[0];
			$arr3 = explode("|", $signatories[2]);
				$apprby = $arr3[1]. " " .substr($arr3[2], 0, 1). ". " .$arr3[0];
			$arr4 = explode("|", $signatories[3]);
				$rcvdby = $arr4[1]. " " .substr($arr4[2], 0, 1). ". " .$arr4[0];

			echo $prep . "#" . $chkdby . "#" . $apprby . "#" . $rcvdby;	
		break;

		case 'mallprinttemplate':
	        $sql = " SELECT template from tblsys_setup2 ";
	        $res = mysql_query($sql, $connection) or die(mysql_error());
	        $row = mysql_fetch_array($res);

	        $selectmallid = mysql_fetch_array(mysql_query("SELECT mallid FROM tbltrans_tenants WHERE tenantid = '". $_POST['tenantid'] ."' ", $connection));

	            $sqlmall = "SELECT mallid, mallname, malladdress,telephone_number, email, mall_image FROM tblref_mall WHERE mallid = '". $selectmallid[0] ."' ";
	            $resmall = mysql_query($sqlmall, $connection);
	            while($rowmall = mysql_fetch_array($resmall)){
	                if($rowmall[5] == "")
	                    {
	                        $image = "assets/images/avatars/noimage.png";
	                    }
	                    else
	                    {
	                        $image = "server/mall_image/".$rowmall[5];
	                    }

	                $template1 .= "
	                        <tr>
	                            <td align='center'><img src='".$image."' style='height: 130px; width: 120px;'></td>
	                            <td>
	                                <p style='padding: 0px; display: block;margin:0px;'><h2>".$rowmall[1]."</h2></p>
	                                <p style='padding: 0px; display: block;margin:0px;'>".$rowmall[2]."</p>
	                                <p style='padding: 0px; display: block;margin:0px;'>".$rowmall[3]."</p>
	                                <p style='padding: 0px; display: block;margin:0px;'>".$rowmall[4]."</p>
	                            </td>
	                        </tr>
	                        ";
	                $template2 .= "
	                        <tr>
	                            <td align='center'><img src='".$image."' style='height: 130px; width: 120px;'></td>
	                        </tr>
	                        <tr>
	                            <td align='center'>
	                                <p style='padding: 0px; display: block;margin:0px;'><h2>".$rowmall[1]."</h2></p>
	                                <p style='padding: 0px; display: block;margin:0px;'>".$rowmall[2]."</p>
	                                <p style='padding: 0px; display: block;margin:0px;'>".$rowmall[3]."</p>
	                                <p style='padding: 0px; display: block;margin:0px;'>".$rowmall[4]."</p>
	                            </td>
	                        </tr>
	                        ";
	            }
	            if ($row[0] == "1"){
	                echo $template1;
	                }
	            else{
	                echo $template2;
	            }
	                echo $row[5];
	    break;

        case 'convertlang':
        	if($_POST['month'] == "1"){
        		echo "January";
        	}else if($_POST['month'] == "2"){
				echo "February";
        	}else if($_POST['month'] == "3"){
				echo "March";
        	}else if($_POST['month'] == "4"){
				echo "April";
        	}else if($_POST['month'] == "5"){
				echo "May";
        	}else if($_POST['month'] == "6"){
				echo "June";
        	}else if($_POST['month'] == "7"){
				echo "July";
        	}else if($_POST['month'] == "8"){
				echo "August";
        	}else if($_POST['month'] == "9"){
				echo "September";
        	}else if($_POST['month'] == "10"){
				echo "Oct";
        	}else if($_POST['month'] == "11"){
				echo "November";
        	}else if($_POST['month'] == "12"){
				echo "December";
        	}
       	break;

       	case 'showtxtinfostorename':
       		echo "<option value=''>-- Select Store --</option>";
       		$res = mysql_query("SELECT tenantid, tradename FROM tbltrans_tenants WHERE status = 'actived' AND ustatus = 'Occupied' ", $connection);
       		while($row = mysql_fetch_array($res)){
       			echo "<option value=".$row[0].">".$row[1]."</option>";
       		}
   		break;

   		case 'loadtblorlist':
   			$res = mysql_query("SELECT id, description, xdate, balance, orno, paymenttype FROM tbltransaction WHERE isdeposit = '1' AND balance != '0.00'  AND balance LIKE '%-%' ", $connection);
   			while($row = mysql_fetch_array($res)){
   				$arr = explode("-", $row[3]);
   				echo "
   					<tr>
   						<td>".date('F d, Y', strtotime($row[2]))."</td>
   						<td>".$row[1]."</td>
   						<td>".$row[5]."</td>
   						<td>".$row[4]."</td>
   						<td>".number_format($arr[1], 2, ".", ",")."</td>
   					</tr>";
   			}
		break;

		case 'showdrilldowncharges':
			?>
                <div class="panel panel-primary" style="margin: 5px;margin-top: -10px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
	                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#divcharges" aria-expanded="false">
	                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
	                                &nbsp;Charges
	                            </a>
                        </h4>
                        <h4 class="panel-title pull-right" style="margin-top: -20px;">
                        	Balance:&nbsp;&nbsp;&nbsp;<?php $totalbalance = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '". $_POST['tenantid'] ."' AND xdate = '". $_POST['xdate'] ."' AND xcode  = 'CHRG-0000001'", $connection)); echo number_format($totalbalance[0], "2",".",","); ?>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="divcharges" aria-expanded="false">
                        <div class="panel-body" style="height: 200px;overflow-y: scroll;">
                            <div class="row">
                                <table class="table table-bordered table-striped fixTable" style="margin-top: -14px;">
                                    <thead>
                                        <tr>
                                            <td>Date</td>
                                            <td>Charges</td>
                                            <td>Reference</td>
                                            <td align="right">Amount ( before vat )</td>
                                            <td align="right">Vat 12% (Inc)</td>
                                            <td align="right">Total Amount</td>
                                            <td align="right">Balance</td>
                                        </tr>
                                    </thead>
                <?php
                $sql = " SELECT xdate, description, amount, balance, vatamount, reference FROM tbltransaction WHERE tenantid = '". $_POST['tenantid'] ."' AND xdate = '". $_POST['xdate'] ."' AND xcode  = 'CHRG-0000001' ";
                $res = mysql_query($sql, $connection);
                while( $row = mysql_fetch_array($res) ){
                	$totalcharges = $row[2]+$row[4];
                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo date('F Y', strtotime($row[0])); ?></td>
                                            <td><?php echo $row[1]; ?></td>
                                            <td><?php echo $row[7]; ?></td>
                                            <td align="right"><?php echo number_format($row[2], "2",".",","); ?></td>
                                            <td align="right"><?php echo number_format($row[4], "2",".",","); ?></td>
                                            <td align="right"><?php echo number_format($totalcharges, "2",".",","); ?></td>
                                            <td align="right"><?php echo number_format($row[3], "2",".",","); ?></td>
                                        </tr>
                                    </tbody>
                <?php
                }
                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
		break;

		case 'showdrilldownothercharges':
			?>
                <div class="panel panel-danger" style="margin: 5px;margin-top: -10px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#divothercharges" aria-expanded="false">
                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;Other Charges
                            </a>
                        </h4>
                        <h4 class="panel-title pull-right" style="margin-top: -20px;">
                        	Balance:&nbsp;&nbsp;&nbsp;<?php $totalbalance = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '". $_POST['tenantid'] ."' AND xdate = '". $_POST['xdate'] ."' AND xcode  != 'CHRG-0000001' AND xcode != ''", $connection)); echo number_format($totalbalance[0], "2",".",","); ?>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="divothercharges" aria-expanded="false">
                        <div class="panel-body" style="overflow-y: scroll;height: 200px;">
                            <div class="row">
                                <table class="table table-bordered table-striped fixTable" style="margin-top: -14px;">
                                    <thead>
                                        <tr>
                                            <td>Date</td>
                                            <td>Charges</td>
                                            <td>Reference</td>
                                            <td>Quantity</td>
                                            <td align="right">Amount ( before vat )</td>
                                            <td align="right">Vat 12% (Inc)</td>
                                            <td align="right">Total Amount</td>
                                            <td align="right">Balance</td>
                                        </tr>
                                    </thead>
                <?php
                	$balance = 0;
                $sql = " SELECT xdate, description, amount, balance, vatamount, xcode, qty FROM tbltransaction WHERE tenantid = '". $_POST['tenantid'] ."' AND xdate = '". $_POST['xdate'] ."' AND xcode  != 'CHRG-0000001' AND xcode != '' ";
                $res = mysql_query($sql, $connection);
                while( $row = mysql_fetch_array($res) ){
                	$totalcharges = $row[2]+$row[4];
                	$balance += $row[4];
                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo date('F Y', strtotime($row[0])); ?></td>
                                            <td><?php echo $row[1]; ?></td>
                                            <td><?php echo $row[5]; ?></td>
                                            <td><?php echo $balance[6]; ?></td>
                                            <td align="right"><?php echo number_format($row[2], "2",".",",");; ?></td>
                                            <td align="right"><?php echo number_format($row[4], "2",".",",");; ?></td>
                                            <td align="right"><?php echo number_format($totalcharges, "2",".",","); ?></td>
                                            <td align="right"><?php echo number_format($row[3], "2",".",",");; ?></td>
                                        </tr>
                                    </tbody>
                <?php
                }
                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
		break;

		case 'showdrilldownpayment':
			?>
                <div class="panel panel-success" style="margin: 5px;margin-top: -10px;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#divpayment" aria-expanded="false">
                                <i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;Payments
                            </a>
                        </h4>
                        <h4 class="panel-title pull-right" style="margin-top: -20px;">
                        	Running Balance:&nbsp;&nbsp;&nbsp;<?php $totalbalance = mysql_fetch_array(mysql_query("SELECT SUM(balance) FROM tbltransaction WHERE tenantid = '". $_POST['tenantid'] ."' AND xdate = '". $_POST['xdate'] ."' AND balance LIKE '%-%'", $connection)); echo number_format($totalbalance[0], "2",".",","); ?>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="divpayment" aria-expanded="false">
                        <div class="panel-body" style="overflow-y: scroll;height: 200px;">
                            <div class="row">
                                <table class="table table-bordered table-striped fixTable" style="margin-top: -14px;">
                                    <thead>
                                        <tr>
                                            <td>Date</td>
                                            <td>Charges</td>
                                            <td>Reference</td>
                                            <td align="right">Amount ( before vat )</td>
                                            <td align="right">Vat 12% (Inc)</td>
                                            <td align="right">Total Amount</td>
                                            <td align="right">Balance</td>
                                        </tr>
                                    </thead>
                <?php
                $sql = " SELECT xdate, description, amount, balance, vatamount, reference FROM tbltransaction WHERE tenantid = '". $_POST['tenantid'] ."' AND xdate = '". $_POST['xdate'] ."' AND amount LIKE '%-%' ";
                $res = mysql_query($sql, $connection);
                while( $row = mysql_fetch_array($res) ){
                	$totalcharges = $row[2]+$row[4];
                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo date('F Y', strtotime($row[0])); ?></td>
                                            <td><?php echo $row[1]; ?></td>
                                            <td><?php echo $row[7]; ?></td>
                                            <td align="right"><?php echo number_format($row[2], "2",".",",");; ?></td>
                                            <td align="right"><?php echo number_format($row[4], "2",".",",");; ?></td>
                                            <td align="right"><?php echo number_format($totalcharges, "2",".",","); ?></td>
                                            <td align="right"><?php echo number_format($row[3], "2",".",",");; ?></td>
                                        </tr>
                                    </tbody>
                <?php
                }
                ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
		break;


    }
?>
