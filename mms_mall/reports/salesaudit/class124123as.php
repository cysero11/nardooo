<?php
include "../../connect.php";
	switch ($_POST['form']) {
		case 'loadsetup':
		$sql = "SELECT corporatename FROM tblsys_setup2"; 
		$res = mysql_query($sql, $connection);
		while ( $row = mysql_fetch_array($res)){
		echo "<i style='position: absolute; left: 0;' id='corporatenameicon' class='fa fa-plus' onclick='corporatesales()'></i><input type='hidden' value='1' id='youcantseeme'> ";
		echo "<b>"."<li class='list_mall'>&nbsp;&nbsp;".$row["corporatename"]."</b>";

			$sqlmall = "SELECT mallid, mallname FROM tblref_mall";
			$resmall = mysql_query($sqlmall, $connection);
			$countngmall = 1;
			while ($rowmall = mysql_fetch_array($resmall)) {
			echo "<ul>";
			echo "<i style='position: absolute; left: 0;' class='fa fa-plus' id='mallsalesicon-". $countngmall ."' onclick='mallsales(\"".$rowmall["mallid"]."\")'></i><input type='hidden' value='1' id='mallcount'>";
			echo "<b>"."<li class='list_mall clickme'><i class='fa fa-building-o'></i>&nbsp;&nbsp;".$rowmall["mallname"]."</b>";
					
				$sqlwing = " SELECT wing, wingID FROM tblref_wing WHERE mallID = '". $rowmall["mallid"] ."' ";
				$reswing = mysql_query($sqlwing, $connection);
				$countngwing = 1;
				while ($rowwing = mysql_fetch_array($reswing)) {
				echo "<ul>";
				echo "<i style='position: absolute; left: 0;' class='fa fa-plus' id='wingsalesicon-". $countngwing ."' onclick='wingsales(\"".$rowmall["mallid"]."\")'></i><input type='hidden' value='1' id='wingcount'>";
				echo "<b>"."<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$rowwing["wing"]."</b>";

					$sqlfloor = " SELECT floorid, floor FROM tblref_floorsetup WHERE mallid = '". $rowmall["mallid"] ."' AND wingid = '". $rowwing["wingID"] ."' ";
					$resfloor = mysql_query($sqlfloor, $connection);
					while ( $rowfloor = mysql_fetch_array($resfloor) ){
					echo "<ul>";
					echo "<b>"."<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$rowfloor["floor"]."</b>";

						$sqlunittype = " SELECT DISTINCT(typeofbusiness) FROM tblref_unit WHERE mallid = '". $rowmall["mallid"] ."' AND wingid = '". $rowwing["wingID"] ."' AND floorid = '". $rowfloor["floorid"] ."' ";
						$resunittype = mysql_query($sqlunittype, $connection);
						while ( $rowunittype = mysql_fetch_array($resunittype) ){
						echo "<ul>";
						echo "<b>"."<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$rowunittype["typeofbusiness"]."</b>";

							$sqlunit = " SELECT unitid, unitname FROM tblref_unit WHERE mallid = '". $rowmall["mallid"] ."' AND wingid = '". $rowwing["wingID"] ."' AND floorid = '". $rowfloor["floorid"] ."' AND typeofbusiness = '". $rowunittype["typeofbusiness"] ."' ";
							$resunit = mysql_query($sqlunit, $connection);
							while ( $rowunit = mysql_fetch_array($resunit) ){
							echo "<ul>";
							echo "<b>"."<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$rowunit["unitname"]."</b>";

								$sqltenant = " SELECT tenantid, tradename FROM tbltrans_tenants WHERE mallid = '". $rowmall["mallid"] ."' AND  unitid = '". $rowunit["unitid"] ."' ";
								$restenant = mysql_query($sqltenant, $connection);
								while ( $rowtenant = mysql_fetch_array($restenant) ){
								echo "<ul>";
								echo "<b>"."<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$rowtenant["tradename"]."</b>";

									$sqlmachinenumber = " SELECT DISTINCT(fvcWrksttnNmbr) FROM db_sales WHERE tenantid = '". $rowtenant["tenantid"] ."' ";
									$resmachinenumber = mysql_query($sqlmachinenumber, $connection);
									while ( $rowmachinenumber = mysql_fetch_array($resmachinenumber) ){
									echo "<ul>";
									echo "<b>"."<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;".$rowmachinenumber["fvcWrksttnNmbr"]."</b>";

										echo "<ul>";
										echo "<b>"."<li class='tenant'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;"."Sales Breakdown"."</b>";
											$sqlsalesbyyear = " SELECT SUM(fnmGTDlySls), fdtTrnsctn, tenantid, YEAR(fdtTrnsctn) FROM db_sales WHERE tenantid = '". $rowtenant["tenantid"] ."' AND fvcWrksttnNmbr = '". $rowmachinenumber["fvcWrksttnNmbr"] ."' GROUP BY YEAR(fdtTrnsctn) ";
											$ressalesbyyear = mysql_query($sqlsalesbyyear, $connection);
											while($rowsalesbyyear = mysql_fetch_array($ressalesbyyear)){
											echo "<ul>";
											echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;"; 
											echo "<b>" . date('Y', strtotime($rowsalesbyyear["fdtTrnsctn"]))."</b>";
												
												for ( $a = 1; $a<= 12; $a++ ) {
												$sqlsalesbymonth = " SELECT SUM(fnmGTDlySls),fdtTrnsctn  FROM db_sales WHERE tenantid = '". $rowtenant["tenantid"] ."' AND fvcWrksttnNmbr = '". $rowmachinenumber["fvcWrksttnNmbr"] ."' AND YEAR(fdtTrnsctn) = '". $rowsalesbyyear[3] ."' AND MONTH(fdtTrnsctn) = '". $a ."' GROUP BY MONTH(fdtTrnsctn)";
												$ressalesbymonth = mysql_query($sqlsalesbymonth, $connection);
												while($rowsalesbymonth = mysql_fetch_array($ressalesbymonth)){
												echo "<ul>";
												echo "<li class='list_mall clickme'><i class='fa fa-folder-open' style='color: #ffcc66;'></i>&nbsp;&nbsp;";
												echo "<b>" . date('F', strtotime($rowsalesbymonth["fdtTrnsctn"]))."</b>";
															
													$hulingarawngbuwan = date('t', strtotime($rowsalesbyyear[3] . "-" . $a . "-01"));
													for ( $b = 1; $b <= $hulingarawngbuwan; $b++ ) {
													$sqlsalesbyday = " SELECT fnmGTDlySls,fdtTrnsctn  FROM db_sales WHERE tenantid = '". $rowtenant["tenantid"] ."' AND fvcWrksttnNmbr = '". $rowmachinenumber["fvcWrksttnNmbr"] ."' AND YEAR(fdtTrnsctn) = '". $rowsalesbyyear[3] ."' AND MONTH(fdtTrnsctn) = '". $a ."' AND DAY(fdtTrnsctn) = '". str_pad($b, 2, 0, STR_PAD_LEFT) ."' GROUP BY DAY(fdtTrnsctn) ";
													$ressalesbyday = mysql_query($sqlsalesbyday, $connection);
													while ($rowsalesbyday = mysql_fetch_array($ressalesbyday)) {
													echo "<ul>";
													echo "<i style='position: absolute; right: 0;' class='showdatasatable fa fa-eye' onclick='mallsales(\"".$rowmall["mallid"]."\")' class='fa fa-eye'></i>";
													echo "<li class='list_mall clickme'>&nbsp;&nbsp;";
													echo "<b>" . date('d', strtotime($rowsalesbyday["fdtTrnsctn"]))."</b>";
																
													echo "</li>";
													echo "</ul>";
													}
													}

												echo "</li>";
												echo "</ul>";
												}
												}

											echo "</li>";
											echo "</ul>";
											}

										echo "</li>";
										echo "</ul>";

									echo "</li>";
									echo "</ul>";
									}

								echo "</li>";
								echo "</ul>";
								}

							echo "</li>";
							echo "</ul>";
							}

						echo "</li>";
						echo "</ul>";
						}


					echo "</li>";
					echo "</ul>";
					}

				echo "</li>";
				echo "</ul>";
				$countngwing ++;
				}

			echo "</li>";
			echo "</ul>";
			$countngmall ++;
			}

		echo "</li>";
		}
		break;

		case 'corporatesales':
			$sql = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

					$sqlcorp = "SELECT corporatename FROM tblsys_setup2"; 
					$rescorp = mysql_query($sqlcorp, $connection);
					$rowcorp = mysql_fetch_array($rescorp);

				?>
					<tr id="corporatesalesrow" style="width: 100%;background-color: #4169E1; color: #FFFFFF;">
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo $rowcorp[0]; ?></td>
						<td><?php echo ""; ?></td>
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
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[29], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[30], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[31], 2, ".", ","); ?></td>
					</tr>
				<?php
		break;

		case 'mallsales':
			$sql = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE mallid = '". $_POST['mallID'] ."' ";
			$res = mysql_query($sql, $connection);
			$row = mysql_fetch_array($res);

				$sqlmall = " SELECT mallid, mallname FROM tblref_mall WHERE mallid = '". $_POST['mallID'] ."' ";
				$resmall = mysql_query($sqlmall, $connection);
				$rowmall = mysql_fetch_array($resmall);
				?>
					<tr id="mallsalesrow" style="width: 100%;background-color: #1E90FF; color: #FFFFFF;">
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo "<i class='fa fa-building-o'></i>&nbsp;".$rowmall[1]; ?></td>
						<td><?php echo ""; ?></td>
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
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[29], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[30], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[31], 2, ".", ","); ?></td>
					</tr>
				<?php
		break;

		case 'wingsales':
			$sqlwing = " SELECT wing, wingID FROM tblref_wing WHERE mallID = '". $_POST["mallID"] ."' ";
			$reswing = mysql_query($sqlwing, $connection);
			$rowwing = mysql_fetch_array($reswing);

				$sqlunit = " SELECT count(tenantid) FROM tblref_unit WHERE wingid = '". $rowwing[1] ."' ";
				$resunit = mysql_query($sqlunit, $connection);
				$rowunit = mysql_fetch_array($resunit);

					$sql = " SELECT tenantid, fdtTrnsctn, SUM(fnmGrndTtlOld), SUM(fnmGrndTtlNew), SUM(fnmGTDlySls), SUM(fnmGTDscnt), SUM(fnmGTDscntSNR), SUM(fnmGTDscntPWD), SUM(fnmGTDscntGPC), SUM(fnmGTDscntVIP), SUM(fnmGTDscntEMP), SUM(fnmGTDscntREG), SUM(fnmGTDscntOTH), SUM(fnmGTRfnd), SUM(fnmGTCncld), SUM(fnmGTSlsVAT), SUM(fnmGTVATSlsInclsv), SUM(fnmGTVATSlsExclsv), SUM(fnmOffclRcptBeg), SUM(fnmOffclRcptEnd), SUM(fnmGTCntDcmnt), SUM(fnmGTCntCstmr), SUM(fnmGTCntSnrCtzn), SUM(fnmGTLclTax), SUM(fnmGTSrvcChrg), SUM(fnmGTSlsNonVat), SUM(fnmGTRwGrss), SUM(fnmGTLclTaxDly), fvcWrksttnNmbr, SUM(fnmGTPymntCSH), SUM(fnmGTPymntCRD), SUM(fnmGTPymntOTH) FROM db_sales WHERE tenantid = '". $rowunit[0] ."' ";
					$res = mysql_query($sql, $connection);
					$row = mysql_fetch_array($res);

				?>
					<tr id="wingsalesrow" style="width: 100%;background-color: #00BFFF; color: #FFFFFF;">
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo "<i class='fa fa-folder'></i>&nbsp;".$rowwing[0]; ?></td>
						<td><?php echo ""; ?></td>
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
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[29], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[30], 2, ".", ","); ?></td>
						<td style="text-align: right; width:1%; white-space:nowrap;"><?php echo number_format($row[31], 2, ".", ","); ?></td>
					</tr>
				<?php
		break;

		$sqlfloor = " SELECT floor, floorid FROM tblref_floorsetup WHERE mallid = '". $rowmall[0] ."' AND wingid = '". $rowwing[1] ."' ";
						$resfloor = mysql_query($sqlfloor, $connection);
						while ($rowfloor = mysql_fetch_array($resfloor)){
						?>
						<tr data-id="<?php echo $countngid2; ?>" data-parent="<?php echo $countngid3; ?>" style="width: 100%;background-color: #cccccc; color: #FFFFFF;">
					    <td style="text-align: left; width:1%; white-space:nowrap;"><?php echo $rowfloor[0]; ?></td>
					    <td style="text-align: left; width:1%; white-space:nowrap;"><?php echo ""; ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo date("F d, Y", strtotime($rowmallbenta[1])); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[2], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[3], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[4], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[5], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[6], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[7], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[8], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[9], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[10], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[11], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[12], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[13], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[14], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[15], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[16], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[17], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[18], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[19], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[20], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[21], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[22], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[23], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[24], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[25], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[26], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[27], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[29], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[30], 2, ".", ","); ?></td>
						<td style="text-align: left; width:1%; white-space:nowrap;"><?php echo number_format($rowmallbenta[31], 2, ".", ","); ?></td>
					 </tr>
					 <?php
						}

	}
?>