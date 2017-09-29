<?php
	include "connect.php";

	switch ($_POST['form']) {
		case 'importcsv':
			$checkdate = "  SELECT reportDate FROM db_syncfilestat WHERE reportDate = '". date('Y-m-d') ."' LIMIT 1 ";
			$rescheck = mysqli_query($connection, $checkdate);
			$rowcheck = mysqli_fetch_array($rescheck);

			if ( $rowcheck[0] == "" ) {
				$getmalls = " SELECT mallid FROM tblref_mall ";
				$resmall = mysqli_query($connection, $getmalls);
				while ( $rowmall = mysqli_fetch_array($resmall) ) {
					$getcomp = " SELECT TenantID FROM tbltrans_tenants WHERE mallid = '". $rowmall[0] ."' AND ustatus = 'occupied' AND uploadingoffiles = '1' ";
					$rescomp = mysqli_query($connection, $getcomp);
					while ( $rowcomp = mysqli_fetch_array($rescomp) ) {

						
						
						// for ( $a = 1; $a<=31; $a++ ) {
							$sales = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/". date('Y-m-d') ."/sales.csv' INTO TABLE db_sales
								FIELDS TERMINATED BY ','
								LINES TERMINATED BY '\r\n'
								IGNORE 1 LINES
								(fdtTrnsctn, fvcMrchntCd, fvcMrcntDsc, fnmGrndTtlOld, fnmGrndTtlNew, fnmGTDlySls, fnmGTDscnt, fnmGTDscntSNR, fnmGTDscntPWD, fnmGTDscntGPC, fnmGTDscntVIP, fnmGTDscntEMP, fnmGTDscntREG, fnmGTDscntOTH, fnmGTRfnd, fnmGTCncld, fnmGTSlsVAT, fnmGTVATSlsInclsv, fnmGTVATSlsExclsv, fnmOffclRcptBeg, fnmOffclRcptEnd, fnmGTCntDcmnt, fnmGTCntCstmr, fnmGTCntSnrCtzn, fnmGTLclTax, fnmGTSrvcChrg, fnmGTSlsNonVat, fnmGTRwGrss, fnmGTLclTaxDly, fvcWrksttnNmbr, fnmGTPymntCSH, fnmGTPymntCRD, fnmGTPymntOTH) ";
							$query = mysqli_query($connection, $sales); // or die(mysqli_error($connection));
							if ( $query == true ) {
								$varsales = 1;

								$successSales = " UPDATE db_sales SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd  WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
								$resSales = mysqli_query($connection, $successSales);
							}

							else {
								$varsales = 0;
							}

							$discount = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/". date('Y-m-d') ."/discount.csv' INTO TABLE db_discount
								FIELDS TERMINATED BY ','
								LINES TERMINATED BY '\r\n' 
								IGNORE 1 LINES 
								(fdtTrnsctn, fvcMrchntCd, fvcDscntCd, fvcDscntPrcntg, fnmDscnt, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn)";
							$query2 = mysqli_query($connection, $discount); // or die(mysqli_error($connection));
							if ( $query2 == true ) {
								$vardiscount = 1;

								$successDiscount = " UPDATE db_discount SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd  WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
								$resDiscount = mysqli_query($connection, $successDiscount);
							}

							else {
								$vardiscount = 0;
							}

							$paymenttypes = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/". date('Y-m-d') ."/paymenttypes.csv' INTO TABLE db_paymenttypes
								FIELDS TERMINATED BY ','
								LINES TERMINATED BY '\r\n' 
								IGNORE 1 LINES 
								(fdtTrnsctn, fvcMrchntCd, fvcPymntCd, fvcPymntDsc, fvcPymntCdCLSCd, fvcPymntCdCLSDsc, fnmPymnt) ";
							$query3 = mysqli_query($connection, $paymenttypes); // or die(mysqli_error($connection));
							if ( $query3 == true ) {
								$varpaymenttypes = 1;
								$successPaymenttypes = " UPDATE db_paymenttypes SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd  WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
								$resPaymenttypes = mysqli_query($connection, $successPaymenttypes);
							}

							else {
								$varpaymenttypes = 0;
							}

							$perhour = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/". date('Y-m-d') ."/perhour.csv' INTO TABLE db_perhour
								FIELDS TERMINATED BY ','
								LINES TERMINATED BY '\r\n' 
								IGNORE 1 LINES
								(fdtTrnsctn, fvcMrchntCd, fvcHRLCd, fnmDlySls, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn) ";
							$query4 = mysqli_query($connection, $perhour); // or die(mysqli_error($connection));
							if ( $query4 == true ) {
								$varperhour = 1;
								$successPerhour = " UPDATE db_perhour SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd  WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
								$resPerhour = mysqli_query($connection, $successPerhour);
							}

							else {
								$varperhour = 0;
							}

							$void = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowcomp[0] ."/". date('Y-m-d') ."/void.csv' INTO TABLE db_void
								FIELDS TERMINATED BY ','
								LINES TERMINATED BY '\r\n' 
								IGNORE 1 LINES 
								(fdtTrnsctn, fvcMrchntCd, fvcRfndCncldCd, fvcRfndCncldRsn, fnmAmt, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn ) ";
							$query5 = mysqli_query($connection, $void); // or die(mysqli_error($connection));
							if ( $query5 == true ) {
								$varvoid = 1;
								$successVoid = " UPDATE db_void SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd  WHERE fvcMrchntCd = '". $rowcomp[0] ."' ";
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

							$sync = " INSERT INTO `db_syncfilestat` SET `tenantID` = '". $rowcomp[0] ."', `sales` = '". $varsales ."', `discount` = '". $vardiscount ."', `void_refund` = '". $varvoid ."', `salesperhour` = '". $varperhour ."', `paymenttype` = '". $varpaymenttypes ."', reportDate = '".date('Y-m-d') ."', countSync = '". $alltotal ."', refno = '". $newid ."' ";
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
						// }	
						
					}
				}
			}

			else {
				echo "8888";
			}
		break;

		case 'importcsv2':
			$getRefNo = " SELECT refno, tenantID, sales, discount, void_refund, salesperhour, paymenttype, reportDate, countSync FROM db_syncfilestat where refno = '". $_POST['refno'] ."' ";
			$resRefNo = mysqli_query($connection, $getRefNo);
			$rowRefNo = mysqli_fetch_array($resRefNo);

			$getmalls = " SELECT mallID FROM tbltrans_tenants WHERE TenantID = '". $rowRefNo[1] ."' ";
			$resmall = mysqli_query($connection, $getmalls);
			$rowmall = mysqli_fetch_array($resmall);

			if ( $rowRefNo[2] == 0 ) {
				$sales = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowRefNo[1] ."/". date('Y-m-d', strtotime($rowRefNo[7])) ."/sales.csv' INTO TABLE db_sales
					FIELDS TERMINATED BY ','
					LINES TERMINATED BY '\r\n'
					IGNORE 1 LINES
					(fdtTrnsctn, fvcMrchntCd, fvcMrcntDsc, fnmGrndTtlOld, fnmGrndTtlNew, fnmGTDlySls, fnmGTDscnt, fnmGTDscntSNR, fnmGTDscntPWD, fnmGTDscntGPC, fnmGTDscntVIP, fnmGTDscntEMP, fnmGTDscntREG, fnmGTDscntOTH, fnmGTRfnd, fnmGTCncld, fnmGTSlsVAT, fnmGTVATSlsInclsv, fnmGTVATSlsExclsv, fnmOffclRcptBeg, fnmOffclRcptEnd, fnmGTCntDcmnt, fnmGTCntCstmr, fnmGTCntSnrCtzn, fnmGTLclTax, fnmGTSrvcChrg, fnmGTSlsNonVat, fnmGTRwGrss, fnmGTLclTaxDly, fvcWrksttnNmbr, fnmGTPymntCSH, fnmGTPymntCRD, fnmGTPymntOTH) ";
				$query = mysqli_query($connection, $sales); // or die(mysqli_error($connection));
				if ( $query == true ) {
					$varsales = 1;

					$successSales = " UPDATE db_sales SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd ";
					$resSales = mysqli_query($connection, $successSales);

					$update1 = " UPDATE db_syncfilestat SET sales = '1' WHERE refno = '". $_POST['refno'] ."' ";
					$resupdate1 = mysqli_query($connection, $update1);
				}

				else {
					$varsales = 0;
				}
			}

			if ( $rowRefNo[3] == 0 ) {
				$discount = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowRefNo[1] ."/". date('Y-m-d', strtotime($rowRefNo[7])) ."/discount.csv' INTO TABLE db_discount
					FIELDS TERMINATED BY ','
					LINES TERMINATED BY '\r\n' 
					IGNORE 1 LINES 
					(fdtTrnsctn, fvcMrchntCd, fvcDscntCd, fvcDscntPrcntg, fnmDscnt, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn)";
				$query2 = mysqli_query($connection, $discount); // or die(mysqli_error($connection));
				if ( $query2 == true ) {
					$vardiscount = 1;

					$successDiscount = " UPDATE db_discount SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd ";
					$resDiscount = mysqli_query($connection, $successDiscount);

					$update2 = " UPDATE db_syncfilestat SET discount = '1' WHERE refno = '". $_POST['refno'] ."' ";
					$resupdate2 = mysqli_query($connection, $update2);
				}

				else {
					$vardiscount = 0;
				}
			}

			if ( $rowRefNo[4] == 0 ) {
				$paymenttypes = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowRefNo[1] ."/". date('Y-m-d', strtotime($rowRefNo[7])) ."/paymenttypes.csv' INTO TABLE db_paymenttypes
					FIELDS TERMINATED BY ','
					LINES TERMINATED BY '\r\n' 
					IGNORE 1 LINES 
					(fdtTrnsctn, fvcMrchntCd, fvcPymntCd, fvcPymntDsc, fvcPymntCdCLSCd, fvcPymntCdCLSDsc, fnmPymnt) ";
				$query3 = mysqli_query($connection, $paymenttypes); // or die(mysqli_error($connection));
				if ( $query3 == true ) {
					$varpaymenttypes = 1;
					$successPaymenttypes = " UPDATE db_paymenttypes SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd ";
					$resPaymenttypes = mysqli_query($connection, $successPaymenttypes);

					$update3 = " UPDATE db_syncfilestat SET paymenttype = '1' WHERE refno = '". $_POST['refno'] ."' ";
					$resupdate3 = mysqli_query($connection, $update3);
				}

				else {
					$varpaymenttypes = 0;
				}
			}

			if ( $rowRefNo[5] == 0 ) {
				$perhour = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowRefNo[1] ."/". date('Y-m-d', strtotime($rowRefNo[7])) ."/perhour.csv' INTO TABLE db_perhour
					FIELDS TERMINATED BY ','
					LINES TERMINATED BY '\r\n' 
					IGNORE 1 LINES
					(fdtTrnsctn, fvcMrchntCd, fvcHRLCd, fnmDlySls, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn) ";
				$query4 = mysqli_query($connection, $perhour); // or die(mysqli_error($connection));
				if ( $query4 == true ) {
					$varperhour = 1;
					$successPerhour = " UPDATE db_perhour SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd ";
					$resPerhour = mysqli_query($connection, $successPerhour);

					$update4 = " UPDATE db_syncfilestat SET salesperhour = '1' WHERE refno = '". $_POST['refno'] ."' ";
					$resupdate4 = mysqli_query($connection, $update4);
				}

				else {
					$varperhour = 0;
				}
			}

			if ( $rowRefNo[6] == 0 ) {
				$void = " LOAD DATA INFILE 'C:/wamp/www/csv/". $rowmall[0] ."/". $rowRefNo[1] ."/". date('Y-m-d', strtotime($rowRefNo[7])) ."/void.csv' INTO TABLE db_void
					FIELDS TERMINATED BY ','
					LINES TERMINATED BY '\r\n' 
					IGNORE 1 LINES 
					(fdtTrnsctn, fvcMrchntCd, fvcRfndCncldCd, fvcRfndCncldRsn, fnmAmt, fnmCntDcmnt, fnmCntCstmr, fnmCntSnrCtzn ) ";
				$query5 = mysqli_query($connection, $void); // or die(mysqli_error($connection));
				if ( $query5 == true ) {
					$varvoid = 1;
					$successVoid = " UPDATE db_void SET mallid = '". $rowmall[0] ."',TenantID = fvcMrchntCd ";
					$resVoid = mysqli_query($connection, $successVoid);

					$update5 = " UPDATE db_syncfilestat SET void_refund = '1' WHERE refno = '". $_POST['refno'] ."' ";
					$resupdate5 = mysqli_query($connection, $update5);
				}

				else {
					$varvoid = 0;
				}
			}

			$alltotal = $varsales + $vardiscount + $varvoid + $varperhour + $varpaymenttypes;

			$sync = " UPDATE `db_syncfilestat` SET `sales` = '". $varsales ."', `discount` = '". $vardiscount ."', `void_refund` = '". $varvoid ."', `salesperhour` = '". $varperhour ."', `paymenttype` = '". $varpaymenttypes ."', countSync = '". $alltotal ."' WHERE refno = '". $_POST['refno'] ."' ";
			$resSync = mysqli_query($connection, $sync); // or die(mysqli_error($connection));

			if ( $resSync == true ) {
				$newTotal = $rowRefNo[8] + $alltotal;

				if ( $newTotal == 5 ) {
					$uploads = " UPDATE db_syncfilestat SET uploaded = '1' WHERE refno = '". $_POST['refno'] ."' ";
					$resuploads = mysqli_query($connection, $uploads);
				}
			}

			
		break;
	}




	// function generateid($tblname, $field) {
		

	// 	return $newid;
	// }
				
?>