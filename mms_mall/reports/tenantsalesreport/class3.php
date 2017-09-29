<?php
	include "connect.php";

	switch ($_POST['form']) {
		case 'importcsv':
			$getmalls = " SELECT mallid FROM tblref_mall ";
			$resmall = mysqli_query($connection, $getmalls);
			while ( $rowmall = mysqli_fetch_array($resmall) ) {
				$getcomp = " SELECT TenantID FROM tbltrans_tenants WHERE mallid = '". $rowmall[0] ."' AND uploadingoffiles = '1' ";
				$rescomp = mysqli_query($connection, $getcomp);
				while ( $rowcomp = mysqli_fetch_array($rescomp) ) {
					for ( $a = 1; $a<=12; $a++ ) {
						$month = date('t', strtotime("2017-" . $a . "-01"));
						for( $b = 1; $b<=$month; $b++ ) {
							$sales = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/2017-".str_pad($a, 2, 0, STR_PAD_LEFT)."-". str_pad($b, 2, 0, STR_PAD_LEFT)."/sales.csv' INTO TABLE db_sales
							FIELDS TERMINATED BY ','
							LINES TERMINATED BY '\r\n'
							IGNORE 1 LINES
							(fdtTrnsctn, fvcMrchntCd, fvcMrcntDsc, fnmGrndTtlOld, fnmGrndTtlNew, fnmGTDlySls, fnmGTDscnt, fnmGTDscntSNR, fnmGTDscntPWD, fnmGTDscntGPC, fnmGTDscntVIP, fnmGTDscntEMP, fnmGTDscntREG, fnmGTDscntOTH, fnmGTRfnd, fnmGTCncld, fnmGTSlsVAT, fnmGTVATSlsInclsv, fnmGTVATSlsExclsv, fnmOffclRcptBeg, fnmOffclRcptEnd, fnmGTCntDcmnt, fnmGTCntCstmr, fnmGTCntSnrCtzn, fnmGTLclTax, fnmGTSrvcChrg, fnmGTSlsNonVat, fnmGTRwGrss, fnmGTLclTaxDly, fvcWrksttnNmbr, fnmGTPymntCSH, fnmGTPymntCRD, fnmGTPymntOTH) ";
						$query = mysqli_query($connection, $sales); // or die(mysqli_error($connection));
						if ( $query == true ) {
							$varsales = 1;

							$successSales = " UPDATE db_sales SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
							$resSales = mysqli_query($connection, $successSales);
						}

						else {
							$varsales = 0;
						}

						$discount = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/2017-".str_pad($a, 2, 0, STR_PAD_LEFT)."-". str_pad($b, 2, 0, STR_PAD_LEFT)."/discount.csv' INTO TABLE db_discount
							FIELDS TERMINATED BY ','
							LINES TERMINATED BY '\r\n' 
							IGNORE 1 LINES 
							(fdtTrnsctn, fvcMrchntCd, fvcDscntCd, fvcDscntPrcntg, fnmDscnt, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn)";
						$query2 = mysqli_query($connection, $discount); // or die(mysqli_error($connection));
						if ( $query2 == true ) {
							$vardiscount = 1;

							$successDiscount = " UPDATE db_discount SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
							$resDiscount = mysqli_query($connection, $successDiscount);
						}

						else {
							$vardiscount = 0;
						}

						$paymenttypes = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/2017-".str_pad($a, 2, 0, STR_PAD_LEFT)."-". str_pad($b, 2, 0, STR_PAD_LEFT)."/paymenttypes.csv' INTO TABLE db_paymenttypes
							FIELDS TERMINATED BY ','
							LINES TERMINATED BY '\r\n' 
							IGNORE 1 LINES 
							(fdtTrnsctn, fvcMrchntCd, fvcPymntCd, fvcPymntDsc, fvcPymntCdCLSCd, fvcPymntCdCLSDsc, fnmPymnt) ";
						$query3 = mysqli_query($connection, $paymenttypes); // or die(mysqli_error($connection));
						if ( $query3 == true ) {
							$varpaymenttypes = 1;
							$successPaymenttypes = " UPDATE db_paymenttypes SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
							$resPaymenttypes = mysqli_query($connection, $successPaymenttypes);
						}

						else {
							$varpaymenttypes = 0;
						}

						$perhour = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/2017-".str_pad($a, 2, 0, STR_PAD_LEFT)."-". str_pad($b, 2, 0, STR_PAD_LEFT)."/perhour.csv' INTO TABLE db_perhour
							FIELDS TERMINATED BY ','
							LINES TERMINATED BY '\r\n' 
							IGNORE 1 LINES
							(fdtTrnsctn, fvcMrchntCd, fvcHRLCd, fnmDlySls, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn) ";
						$query4 = mysqli_query($connection, $perhour); // or die(mysqli_error($connection));
						if ( $query4 == true ) {
							$varperhour = 1;
							$successPerhour = " UPDATE db_perhour SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
							$resPerhour = mysqli_query($connection, $successPerhour);
						}

						else {
							$varperhour = 0;
						}

						$void = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/2017-".str_pad($a, 2, 0, STR_PAD_LEFT)."-". str_pad($b, 2, 0, STR_PAD_LEFT)."/void.csv' INTO TABLE db_void
							FIELDS TERMINATED BY ','
							LINES TERMINATED BY '\r\n' 
							IGNORE 1 LINES 
							(fdtTrnsctn, fvcMrchntCd, fvcRfndCncldCd, fvcRfndCncldRsn, fnmAmt, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn ) ";
						$query5 = mysqli_query($connection, $void); // or die(mysqli_error($connection));
						if ( $query5 == true ) {
							$varvoid = 1;
							$successVoid = " UPDATE db_void SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
							$resVoid = mysqli_query($connection, $successVoid);
						}

						else {
							$varvoid = 0;
						}

						$alltotal = $varsales + $vardiscount + $varvoid + $varperhour + $varpaymenttypes;

						$getID = " SELECT refno FROM db_syncfilestat ORDER BY id DESC LIMIT 1 ";
						$resID = mysqli_query($connection, $getID);
						$rowID = mysqli_fetch_array($resID);

						if ( $rowID[0] == "" ) {
							$newid = str_pad(1, 10, 0, STR_PAD_LEFT);
						}

						else {
							$newid = str_pad( $rowID[0] + 1, 10, 0, STR_PAD_LEFT);
						}

						$sync = " INSERT INTO `db_syncfilestat` SET `tenantID` = '". $rowcomp[0] ."', `sales` = '". $varsales ."', `discount` = '". $vardiscount ."', `void_refund` = '". $varvoid ."', `salesperhour` = '". $varperhour ."', `paymenttype` = '". $varpaymenttypes ."', reportDate = '2017-".str_pad($a, 2, 0, STR_PAD_LEFT)."-". str_pad($b, 2, 0, STR_PAD_LEFT)."', countSync = '". $alltotal ."', refno = '". $newid ."' ";
						$resSync = mysqli_query($connection, $sync); // or die(mysqli_error($connection));

						if ( $resSync == 1 ) {
							if ( $alltotal == 5 ) {
								$updatereport = 1;
							}

							else {
								$updatereport = 0;
							}

							$selectUnit = " SELECT unitID FROM tbltrans_tenants WHERE TenantID = '". $rowcomp[0] ."' ";
							$resUnit = mysqli_query($connection, $selectUnit);
							$rowUnit = mysqli_fetch_array($resUnit);


							$updateStats = " UPDATE tblunit_statuslogs SET txtStat = '". $updatereport ."' WHERE tenantID = '". $rowUnit[0] ."' ";
							$resupdate = mysqli_query($connection, $updateStats); // or die(mysqli_error($connection));

							if ( $resupdate == true ) {
								echo 1;
							}
						}
						}
					}	
					
				}
			}
		
			mysqli_close($connection);
		break;
	}




	// function generateid($tblname, $field) {
		

	// 	return $newid;
	// }
				
?>