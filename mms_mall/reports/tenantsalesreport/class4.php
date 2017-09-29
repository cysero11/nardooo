<?php
	include "connect.php";

	switch ($_POST['form']) {
		case 'dbSales':
			if ( $_POST['id'] == "" ) {
				$sql = " SELECT 
						`tenantid`, `fdtTrnsctn`, `fnmGrndTtlOld`, `fnmGrndTtlNew`, `fnmGTDlySls`, `fnmGTDscnt`, `fnmGTDscntSNR`, `fnmGTDscntPWD`, `fnmGTDscntGPC`,
						`fnmGTDscntVIP`, `fnmGTDscntEMP`, `fnmGTDscntREG`, `fnmGTDscntOTH`, `fnmGTRfnd`, `fnmGTCncld`, `fnmGTSlsVAT`, `fnmGTVATSlsInclsv`, `fnmGTVATSlsExclsv`, `fnmOffclRcptBeg`,
						`fnmOffclRcptEnd`, `fnmGTCntDcmnt`, `fnmGTCntCstmr`, `fnmGTCntSnrCtzn`, `fnmGTLclTax`, `fnmGTSrvcChrg`, `fnmGTSlsNonVat`, `fnmGTRwGrss`, `fnmGTLclTaxDly`, `fvcWrksttnNmbr`, 
						`fnmGTPymntCSH`, `fnmGTPymntCRD`, `fnmGTPymntOTH` 
					FROM
						db_sales
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn LIMIT ". $_POST['countsales'] .", 10 ";

				$count = " SELECT  COUNT(`tenantid`)
					FROM
						db_sales
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."' ";
			}

			else {
				$sql = " SELECT 
						`tenantid`, `fdtTrnsctn`, `fnmGrndTtlOld`, `fnmGrndTtlNew`, `fnmGTDlySls`, `fnmGTDscnt`, `fnmGTDscntSNR`, `fnmGTDscntPWD`, `fnmGTDscntGPC`,
						`fnmGTDscntVIP`, `fnmGTDscntEMP`, `fnmGTDscntREG`, `fnmGTDscntOTH`, `fnmGTRfnd`, `fnmGTCncld`, `fnmGTSlsVAT`, `fnmGTVATSlsInclsv`, `fnmGTVATSlsExclsv`, `fnmOffclRcptBeg`,
						`fnmOffclRcptEnd`, `fnmGTCntDcmnt`, `fnmGTCntCstmr`, `fnmGTCntSnrCtzn`, `fnmGTLclTax`, `fnmGTSrvcChrg`, `fnmGTSlsNonVat`, `fnmGTRwGrss`, `fnmGTLclTaxDly`, `fvcWrksttnNmbr`, 
						`fnmGTPymntCSH`, `fnmGTPymntCRD`, `fnmGTPymntOTH` 
					FROM
						db_sales
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn LIMIT ". $_POST['countsales'] .", 10 ";

				$count = " SELECT  COUNT(`tenantid`)
					FROM
						db_sales
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."' ";
			}

			// echo $sql;

			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				$name = " SELECT tradename FROM tbltrans_tenants WHERE tenantid = '". $row[0] ."' ";
				$resname = mysqli_query($connection, $name);
				$rowname = mysqli_fetch_array($resname);

				?>
					<tr style="width: 100%;">
						<td><?php echo $rowname[0]; ?></td>
						<td><?php echo date("F d, Y", strtotime($row[1])); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[2], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[3], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[4], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[5], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[6], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[7], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[8], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[9], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[10], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[11], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[12], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[13], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[14], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[15], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[16], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[17], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[18], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[19], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[20], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[21], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[22], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[23], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[24], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[25], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[26], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[27], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo $row[28]; ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[29], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[30], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[31], 2, ".", ","); ?></td>
					</tr>
				<?php
			}

			$rescount = mysqli_query($connection, $count);
			$rowcount = mysqli_fetch_array($rescount);

			echo "|" . floor($rowcount[0]/10);
		break;

		case 'dbHour':
			if ( $_POST['id'] == "" ) {
				$sql = " SELECT `tenantID`, `fdtTrnsctn`, `fvcHRLCd`, `fnmDlySls`, `fnmCntDcmnt`, `fnmCntCstmr`, `fnmCntSnrCtzn` 
					FROM
						`db_perhour`
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )   AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn, fvcHRLCd
					LIMIT ". $_POST['counthour'] .", 10 ";

				$count = " SELECT COUNT(`tenantID`)
					FROM
						`db_perhour`
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )   AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn, fvcHRLCd ";
			}

			else {
				$sql = " SELECT `tenantID`, `fdtTrnsctn`, `fvcHRLCd`, `fnmDlySls`, `fnmCntDcmnt`, `fnmCntCstmr`, `fnmCntSnrCtzn` 
					FROM
						`db_perhour`
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn, fvcHRLCd
					LIMIT ". $_POST['counthour'] .", 10 ";

				$count = " SELECT COUNT(`tenantID`)
					FROM
						`db_perhour`
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn, fvcHRLCd ";
			}

			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				$name = " SELECT tradename FROM tbltrans_tenants WHERE tenantid = '". $row[0] ."' ";
				$resname = mysqli_query($connection, $name);
				$rowname = mysqli_fetch_array($resname);
				?>
					<tr>
						<td  style="width:1%; white-space:nowrap;"><?php echo $rowname[0]; ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo date('F d, Y', strtotime($row[1])); ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo date("h:i a", strtotime($row[2])); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[3], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[4], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[5], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[6], 2, ".", ","); ?></td>
					</tr>
				<?php
			}

			$rescount = mysqli_query($connection, $count);
			$rowcount = mysqli_fetch_array($rescount);

			echo "|" . floor($rowcount[0]/10);
		break;

		case 'dbPayment':
			if ( $_POST['id'] == "" ) {
				$sql = " SELECT `tenantID`, `fdtTrnsctn`, `fvcPymntCd`, `fvcPymntDsc`, `fvcPymntCdCLSCd`, `fvcPymntCdCLSDsc`, `fnmPymnt` 
					FROM
						`db_paymenttypes` 
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )   AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn 
					LIMIT ". $_POST['countpayment'] .", 10 ";

				$count = " SELECT COUNT(`tenantID`)
					FROM
						`db_paymenttypes`
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )   AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn ";
			}

			else {
				$sql = " SELECT `tenantID`, `fdtTrnsctn`, `fvcPymntCd`, `fvcPymntDsc`, `fvcPymntCdCLSCd`, `fvcPymntCdCLSDsc`, `fnmPymnt` 
					FROM
						`db_paymenttypes` 
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn 
					LIMIT ". $_POST['countpayment'] .", 10 ";

				$count = " SELECT COUNT(`tenantID`)
					FROM
						`db_paymenttypes`
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn ";
			}

			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				$name = " SELECT tradename FROM tbltrans_tenants WHERE tenantid = '". $row[0] ."' ";
				$resname = mysqli_query($connection, $name);
				$rowname = mysqli_fetch_array($resname);
				?>
					<tr>
						<td  style="width:1%; white-space:nowrap;"><?php echo $rowname[0]; ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo date('F d, Y', strtotime($row[1])); ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo $row[2]; ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo $row[3]; ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format( $row[4], 2, ".", ","); ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo $row[5]; ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[6], 2, ".", ","); ?></td>
					</tr>
				<?php
			}

			$rescount = mysqli_query($connection, $count);
			$rowcount = mysqli_fetch_array($rescount);

			echo "|" . floor($rowcount[0]/10);
		break;

		

		case 'dbDiscount':
			if ( $_POST['id'] == "" ) {
				$sql = " SELECT `tenantID`, `fdtTrnsctn`, `fvcDscntCd`, `fvcDscntPrcntg`, `fnmDscnt`, `fnmCntDcmnt`, `fnmCntCstmr`, `fnmCntSnrCtzn`
					FROM
						`db_discount`
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )   AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn 
					LIMIT ". $_POST['countdiscount'] .", 10 ";

				$count = " SELECT COUNT(`tenantID`)
					FROM
						`db_discount`
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )   AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn ";
			}

			else {
				$sql = " SELECT `tenantID`, `fdtTrnsctn`, `fvcDscntCd`, `fvcDscntPrcntg`, `fnmDscnt`, `fnmCntDcmnt`, `fnmCntCstmr`, `fnmCntSnrCtzn`
					FROM
						`db_discount`
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn 
					LIMIT ". $_POST['countdiscount'] .", 10 ";

				$count = " SELECT COUNT(`tenantID`)
					FROM
						`db_discount`
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn ";
			}

			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				$name = " SELECT tradename FROM tbltrans_tenants WHERE tenantid = '". $row[0] ."' ";
				$resname = mysqli_query($connection, $name);
				$rowname = mysqli_fetch_array($resname);
				?>
					<tr>
						<td  style="width:1%; white-space:nowrap;"><?php echo $rowname[0]; ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo date('F d, Y', strtotime($row[1])); ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo $row[2]; ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[3], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format( $row[4], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format( $row[5], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[6], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[7], 2, ".", ","); ?></td>
					</tr>
				<?php
			}

			$rescount = mysqli_query($connection, $count);
			$rowcount = mysqli_fetch_array($rescount);

			echo "|" . floor($rowcount[0]/10);
		break;

		case 'dbVoid':
			if ( $_POST['id'] == "" ) {
				$sql = " SELECT `tenantID`, `fdtTrnsctn`, `fvcRfndCncldCd`, `fvcRfndCncldRsn`, `fnmAmt`, `fnmCntDcmnt`, `fnmCntCstmr`, `fnmCntSnrCtzn`
					FROM
						`db_void` 
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )   AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn 
					LIMIT ". $_POST['countvoid'] .", 10 ";

				$count = " SELECT COUNT(`tenantID`)
					FROM
						`db_void`
					WHERE ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )   AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn ";
			}

			else {
				$sql = " SELECT `tenantID`, `fdtTrnsctn`, `fvcRfndCncldCd`, `fvcRfndCncldRsn`, `fnmAmt`, `fnmCntDcmnt`, `fnmCntCstmr`, `fnmCntSnrCtzn`
					FROM
						`db_void` 
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn 
					LIMIT ". $_POST['countvoid'] .", 10 ";

				$count = " SELECT COUNT(`tenantID`)
					FROM
						`db_void`
					WHERE tenantid = '". $_POST['id'] ."' AND ( fdtTrnsctn BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' )  AND mallid = '". $_POST['mallid'] ."'
					ORDER BY fdtTrnsctn ";
			}

			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				$name = " SELECT tradename FROM tbltrans_tenants WHERE tenantid = '". $row[0] ."' ";
				$resname = mysqli_query($connection, $name);
				$rowname = mysqli_fetch_array($resname);
				?>
					<tr>
						<td  style="width:1%; white-space:nowrap;"><?php echo $rowname[0]; ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo date('F d, Y', strtotime($row[1])); ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo $row[2]; ?></td>
						<td  style="width:1%; white-space:nowrap;"><?php echo $row[3]; ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format( $row[4], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format( $row[5], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[6], 2, ".", ","); ?></td>
						<td  style="text-align: right; width:1%; white-space:nowrap;" align="right"><?php echo number_format( $row[7], 2, ".", ","); ?></td>
					</tr>
				<?php
			}

			$rescount = mysqli_query($connection, $count);
			$rowcount = mysqli_fetch_array($rescount);

			echo "|" . floor($rowcount[0]/10);
		break;

		case 'mallsid':
			$sql = " SELECT mallid, mallname FROM tblref_mall ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				?>
					<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
				<?php
			}
		break;

		case 'customerPie':
			$return_arr = array();

			$sql1 = " SELECT mallid, mallname FROM tblref_mall ";
			$res1 = mysqli_query($connection, $sql1);
			while ( $row1 = mysqli_fetch_array($res1) ) {
				$sql2 = " SELECT SUM(fnmGTCntCstmr) FROM db_sales WHERE mallid = '". $row1[0] ."' GROUP BY mallid ";
				$res2 = mysqli_query($connection, $sql2);
				while ( $row2 = mysqli_fetch_array($res2) ) {
					array_push($num_arr[$ctr],floatval($row2[0]));

					$row_array['name'] = $row1[1];
					$row_array['y'] = floatval($row2[0]);
					$row_array['id'] = $row1[0];

					array_push($return_arr,$row_array);					
				}
			}


			echo json_encode($return_arr);
		break;	

		case 'totalRev':
			$sql1 = " SELECT SUM(amount) FROM tbltransaction WHERE description = 'Monthly Rental' ";
			$res1 = mysqli_query($connection, $sql1);
			$row1 = mysqli_fetch_array($res1);

			$sql2 = " SELECT SUM(fnmGTCntCstmr) FROM db_sales ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$totalrev = $row1[0] / $row2[0];

			?>
				<tr>
					<td align="right"><?php echo number_format($row1[0], 2, ".", ","); ?></td>
					<td align="right"><?php echo number_format($row2[0], 2, ".", ","); ?></td>
					<td align="right"><?php echo number_format($totalrev, 2, ".", ","); ?></td>
				</tr>
			<?php

		break;
	}
?>