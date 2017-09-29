<?php
	include "connect.php";

	switch ($_POST['form']) {
		case 'tenant':
			$sql = " SELECT COUNT(TenantID) FROM tbltrans_tenants ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			$row = mysqli_fetch_array($res);

			echo $row[0];
		break;

		case 'notupdated':
			$sql = " SELECT COUNT(txtStat) FROM tblref_unit WHERE txtStat = 0 ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			$sql2 = " SELECT COUNT(txtStat) FROM tblref_unit ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);


			echo $row[0] . "|";
			echo floor($percent = ( $row[0] / $row2[0] ) * 100);

			// echo $row[0];
		break;

		case 'yearlypie':
			$return_arr = array();

			$color[1] = "#FF0000";
			$color[2 ] = "#007ED9";
			$color[3] = "#AA00D9";
			$color[4] = "#D9B800";
			$color[5] = "#00D921";
			$color[6] = "#87FF8F";
			$color[7] = "#FA61FA";
			$color[8] = "#282829";
			$color[9] = "#D60059";
			$color[10] = "#1B5A87";
			$color[11] = "#852056";
			$color[12] = "#C4C4C2";

			$ctr = 1;
			$sql = " SELECT tenantID, CONCAT(owner_lastname, ', ', owner_firstname), tradename FROM tbltrans_tenants WHERE ustatus = 'occupied' AND mallid = '". $_POST['mall'] ."' ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {

				$sql2 = " SELECT SUM(fnmGTDlySls) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". date('Y') ." AND tenantID = '". $row[0] ."' ";
				$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
				$row2 = mysqli_fetch_array($res2);

				array_push($num_arr[$ctr],floatval($row2[0]));

				$row_array['name'] = $row[2];
				$row_array['y'] = floatval($row2[0]);
				$row_array['id'] = $row[0];
				$row_array['color'] = $color[$ctr];

				array_push($return_arr,$row_array);
				$ctr ++;
			}

			echo json_encode($return_arr);
		break;

		case 'selectedSales':
			$return_arr = array();

			for ( $a = 1; $a<= 12; $a++ ) {
				$sql = " SELECT SUM(fnmGTDlySls), tenantid FROM db_sales WHERE YEAR(fdtTrnsctn) = ". date('Y') ." AND MONTH(fdtTrnsctn) = ". $a ." AND tenantID = '". $_POST['id'] ."' ";
				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
				$row = mysqli_fetch_array($res);

				$sql2 = " SELECT CONCAT(owner_lastname, ', ', owner_firstname) FROM tbltrans_tenants WHERE tenantID = '". $row[1] ."' ";
				$res2 = mysqli_query($connection, $sql2);
				$row2 = mysqli_fetch_array($res2);

				if ( $row[0] == 0 ) {
					$row_array = floatval(0);
				}

				else {
					$row_array = floatval($row[0]);
				}

				
				array_push($return_arr,$row_array);	
			}

				
			echo json_encode($return_arr);
		break;

		case 'selectedDiscount':
			$return_arr = array();

			for ( $a = 1; $a<= 12; $a++ ) {
				$sql = " SELECT SUM(fnmGTDscnt), tenantid FROM db_sales WHERE YEAR(fdtTrnsctn) = ". date('Y') ." AND MONTH(fdtTrnsctn) = ". $a ." AND tenantID = '". $_POST['id'] ."' ";
				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
				$row = mysqli_fetch_array($res);

				$sql2 = " SELECT CONCAT(owner_lastname, ', ', owner_firstname) FROM tbltrans_tenants WHERE tenantID = '". $row[1] ."' ";
				$res2 = mysqli_query($connection, $sql2);
				$row2 = mysqli_fetch_array($res2);

				if ( $row[0] == 0 ) {
					$row_array = floatval(0);
				}

				else {
					$row_array = floatval($row[0]);
				}

				
				array_push($return_arr,$row_array);	
			}

				
			echo json_encode($return_arr);
		break;

		case 'selectedTenantVoid':
			$return_arr = array();

			for ( $a = 1; $a<= 12; $a++ ) {
				$sql = " SELECT SUM(fnmAmt), tenantID FROM db_void WHERE YEAR(fdtTrnsctn) = ". date('Y') ." AND MONTH(fdtTrnsctn) = ". $a ." AND tenantID = '". $_POST['id'] ."' ";
				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
				$row = mysqli_fetch_array($res);

				$sql2 = " SELECT CONCAT(owner_lastname, ', ', owner_firstname) FROM tbltrans_tenants WHERE tenantID = '". $row[1] ."' ";
				$res2 = mysqli_query($connection, $sql2);
				$row2 = mysqli_fetch_array($res2);

				if ( $row[0] == 0 ) {
					$row_array = floatval(0);
				}

				else {
					$row_array = floatval($row[0]);
				}

				
				array_push($return_arr,$row_array);	
			}

				
			echo json_encode($return_arr);
		break;

		case 'stackedTenant':
			$return_arr = array();
			
			$ctr = 1;
			$sql = " SELECT tenantID, CONCAT(owner_lastname, ', ', owner_firstname) FROM tbltrans_tenants ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				$num_arr[$ctr] = array();
				for ( $a = 1; $a <= 12; $a++ ) {
					$sql2 = " SELECT SUM(fnmGTDlySls) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". date('Y') ." AND MONTH(fdtTrnsctn) = ". $a ." AND tenantID = '". $row[0] ."' ";
					$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
					$row2 = mysqli_fetch_array($res2);

					array_push($num_arr[$ctr],floatval($row2[0]));
				}

					

				$row_array['name'] = $row[1];
				$row_array['data'] = $num_arr[$ctr];
				// echo $sql2;


				array_push($return_arr,$row_array);
				$ctr++;
			}


			echo json_encode($return_arr);
		break;

		case 'getMonthDetails':
			$return_arr = array();

			$sql = " SELECT tenantID, CONCAT(owner_lastname, ', ', owner_firstname) FROM tbltrans_tenants ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				$num_arr[$ctr] = array();
				for ( $a = 1; $a <= 12; $a++ ) {
					$sql2 = " SELECT SUM(fnmGTDlySls) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". date('Y') ." AND MONTH(fdtTrnsctn) = ". $a ." AND tenantID = '". $row[0] ."' ";
					$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
					$row2 = mysqli_fetch_array($res2);

					array_push($num_arr[$ctr],floatval($row2[0]));
				}

					

				$row_array['name'] = $row[1];
				$row_array['data'] = $num_arr[$ctr];
				// echo $sql2;


				array_push($return_arr,$row_array);
				$ctr++;
			}


			echo json_encode($return_arr);
		break;

		case 'monthpie':
			$return_arr = array();
			$return_arr2 = array();

			$color[1] = "#FF0000";
			$color[2 ] = "#007ED9";
			$color[3] = "#AA00D9";
			$color[4] = "#D9B800";
			$color[5] = "#00D921";
			$color[6] = "#87FF8F";
			$color[7] = "#FA61FA";
			$color[8] = "#282829";
			$color[9] = "#D60059";
			$color[10] = "#1B5A87";
			$color[11] = "#852056";
			$color[12] = "#C4C4C2";

			$ctr = 1;

			if ( $_POST['id'] == "" ) {
				$sql2 = " SELECT SUM(fnmGTDlySls), SUM(fnmGTDscnt) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND mallid = '". $_POST['mallid'] ."' ";
				$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
				$row2 = mysqli_fetch_array($res2);

				$sql3 = " SELECT SUM(fnmAmt) FROM db_void WHERE MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND mallid = '". $_POST['mallid'] ."' ";
				$res3 = mysqli_query($connection, $sql3);
				$row3 = mysqli_fetch_array($res3);

				array_push($num_arr[$ctr],floatval($row2[0]));

				$row_array['name'] = "Sales";
				$row_array['y'] = floatval($row2[0]);
				$row_array['id'] = "";
				$row_array['color'] = "#00D40E";

				$row_array2['name'] = "Discount";
				$row_array2['y'] = floatval($row2[1]);
				$row_array2['id'] = "";
				$row_array2['color'] = "#006AD4";

				$row_array3['name'] = "Void";
				$row_array3['y'] = floatval($row3[0]);
				$row_array3['id'] = "";
				$row_array3['color'] = "#D40000";

				array_push($return_arr,$row_array);
				array_push($return_arr, $row_array2);
				array_push($return_arr, $row_array3);

				echo json_encode($return_arr);
			}

			else {
				$sql = " SELECT tenantID, CONCAT(owner_lastname, ', ', owner_firstname) FROM tbltrans_tenants WHERE tenantID = '". $_POST['id'] ."' AND mallid = '". $_POST['mallid'] ."' ";
				$res = mysqli_query($connection, $sql);
				while ( $row = mysqli_fetch_array($res) ) {

					$sql2 = " SELECT SUM(fnmGTDlySls), SUM(fnmGTDscnt) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND tenantID = '". $row[0] ."' ";
					$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
					$row2 = mysqli_fetch_array($res2);

					$sql3 = " SELECT SUM(fnmAmt) FROM db_void WHERE MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND tenantID = '". $_POST['id'] ."'  AND mallid = '". $_POST['mallid'] ."' ";
					$res3 = mysqli_query($connection, $sql3);
					$row3 = mysqli_fetch_array($res3);

					array_push($num_arr[$ctr],floatval($row2[0]));

					$row_array['name'] = "Sales";
					$row_array['y'] = floatval($row2[0]);
					$row_array['id'] = $row[0];
					$row_array['color'] = "#00D40E";

					$row_array2['name'] = "Discount";
					$row_array2['y'] = floatval($row2[1]);
					$row_array2['id'] = $row[0];
					$row_array2['color'] = "#006AD4";

					$row_array3['name'] = "Void";
					$row_array3['y'] = floatval($row3[0]);
					$row_array3['id'] = $row[0];
					$row_array3['color'] = "#D40000";
					// $row_array['color'] = $color[$ctr];

					array_push($return_arr,$row_array);
					array_push($return_arr, $row_array2);
					array_push($return_arr, $row_array3);
					$ctr ++;
				}

				echo json_encode($return_arr);
			}

			
				
		break;

		case 'monthdays':
			$numday = array();

			$number = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);

			for ( $a = 1; $a<= $number; $a++ ) {
				array_push($numday, floatval($a));
			}

			echo json_encode($numday);
		break;

		case 'getMonthSales':
			$return_arr = array();

			$color[1] = "#FF0000";
			$color[2 ] = "#007ED9";
			$color[3] = "#AA00D9";
			$color[4] = "#D9B800";
			$color[5] = "#00D921";
			$color[6] = "#87FF8F";
			$color[7] = "#FA61FA";
			$color[8] = "#282829";
			$color[9] = "#D60059";
			$color[10] = "#1B5A87";
			$color[11] = "#852056";
			$color[12] = "#C4C4C2";

			$ctr = 1;

			if ( $_POST['id'] == "" ) {
				$number = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
				
				for ( $a =1; $a <= $number; $a++ ) {
					$sql2 = " SELECT SUM(fnmGTDlySls) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND DAY(fdtTrnsctn) = ". $a ." AND mallid = '". $_POST['mallid'] ."' ";
					$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection)) or die(mysqli_error($connection));
					$row2 = mysqli_fetch_array($res2);

					$row_array = floatval($row2[0]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}

			else {
				$number = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
				for ( $a =1; $a <= $number; $a++ ) {
					$sql2 = " SELECT SUM(fnmGTDlySls), SUM(fnmGTDscnt) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND tenantID = '". $_POST['id'] ."' AND DAY(fdtTrnsctn) = ". $a ." AND mallid = '". $_POST['mallid'] ."' ";
					$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
					$row2 = mysqli_fetch_array($res2);

					$sql3 = " SELECT SUM(fnmAmt) FROM db_void WHERE MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND tenantID = '". $_POST['id'] ."' ";
					$res3 = mysqli_query($connection, $sql3);
					$row3 = mysqli_fetch_array($res3);

					$row_array = floatval($row2[0]);

					array_push($return_arr,$row_array);
					
				}

				echo json_encode($return_arr);
			}
		break;

		case 'getMonthDiscount':
			$return_arr = array();

			$color[1] = "#FF0000";
			$color[2 ] = "#007ED9";
			$color[3] = "#AA00D9";
			$color[4] = "#D9B800";
			$color[5] = "#00D921";
			$color[6] = "#87FF8F";
			$color[7] = "#FA61FA";
			$color[8] = "#282829";
			$color[9] = "#D60059";
			$color[10] = "#1B5A87";
			$color[11] = "#852056";
			$color[12] = "#C4C4C2";

			$ctr = 1;

			if ( $_POST['id'] == "" ) {
				$number = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
				
				for ( $a =1; $a <= $number; $a++ ) {
					$sql2 = " SELECT SUM(fnmGTDscnt) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND DAY(fdtTrnsctn) = ". $a ." AND mallid = '". $_POST['mallid'] ."' ";
					$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection)) or die(mysqli_error($connection));
					$row2 = mysqli_fetch_array($res2);

					$row_array = floatval($row2[0]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}

			else {
				$number = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
				for ( $a =1; $a <= $number; $a++ ) {
					$sql2 = " SELECT SUM(fnmGTDlySls), SUM(fnmGTDscnt) FROM db_sales WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND tenantID = '". $_POST['id'] ."' AND DAY(fdtTrnsctn) = ". $a ." AND mallid = '". $_POST['mallid'] ."' ";
					$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
					$row2 = mysqli_fetch_array($res2);

					$sql3 = " SELECT SUM(fnmAmt) FROM db_void WHERE MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND tenantID = '". $row[0] ."' ";
					$res3 = mysqli_query($connection, $sql3);
					$row3 = mysqli_fetch_array($res3);

					$row_array = floatval($row2[1]);

					array_push($return_arr,$row_array);
					
				}

				echo json_encode($return_arr);
			}
		break;

		case 'getMonthVoid':
			$return_arr = array();

			$color[1] = "#FF0000";
			$color[2 ] = "#007ED9";
			$color[3] = "#AA00D9";
			$color[4] = "#D9B800";
			$color[5] = "#00D921";
			$color[6] = "#87FF8F";
			$color[7] = "#FA61FA";
			$color[8] = "#282829";
			$color[9] = "#D60059";
			$color[10] = "#1B5A87";
			$color[11] = "#852056";
			$color[12] = "#C4C4C2";

			$ctr = 1;

			if ( $_POST['id'] == "" ) {
				$number = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
				
				for ( $a =1; $a <= $number; $a++ ) {
					$sql3 = " SELECT SUM(fnmAmt) FROM db_void WHERE MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND DAY(fdtTrnsctn) = ". $a ." AND mallid = '". $_POST['mallid'] ."' ";
					$res3 = mysqli_query($connection, $sql3);
					$row3 = mysqli_fetch_array($res3);

					$row_array = floatval($row3[0]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}

			else {
				$number = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
				for ( $a =1; $a <= $number; $a++ ) {

					$sql3 = " SELECT SUM(fnmAmt) FROM db_void WHERE MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND tenantID = '". $_POST['id'] ."'AND DAY(fdtTrnsctn) = ". $a ." AND mallid = '". $_POST['mallid'] ."' ";
					$res3 = mysqli_query($connection, $sql3);
					$row3 = mysqli_fetch_array($res3);

					$row_array = floatval($row3[0]);

					array_push($return_arr,$row_array);
					
				}

				echo json_encode($return_arr);
			}
		break;

		case 'paymenttypeMonth':
			$return_arr = array();
			if ( $_POST['id'] == "" ) {
				$sql = " SELECT fvcPymntCdCLSDsc, SUM(fnmPymnt) FROM db_paymenttypes WHERE YEAR(fdtTrnsctn) = " . $_POST['year'] ." AND MONTH(fdtTrnsctn) = " . $_POST['month'] ." GROUP BY fvcPymntCdCLSDsc ";
				$res = mysqli_query($connection, $sql);
				while ( $row = mysqli_fetch_array( $res ) ) {
					$row_array['name'] = $row[0];
					$row_array['y'] = floatval($row[1]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}

			else {
				$sql = " SELECT fvcPymntCdCLSDsc, SUM(fnmPymnt) FROM db_paymenttypes WHERE YEAR(fdtTrnsctn) = " . $_POST['year'] ." AND MONTH(fdtTrnsctn) = " . $_POST['month'] ." AND tenantID = '". $_POST['id'] ."' GROUP BY fvcPymntCdCLSDsc ";
				$res = mysqli_query($connection, $sql);
				while ( $row = mysqli_fetch_array( $res ) ) {
					$row_array['name'] = $row[0];
					$row_array['y'] = floatval($row[1]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}
		break;

		case 'voidMonth':
			$return_arr = array();

			if ( $_POST['id'] == "" ) {
				$sql = " SELECT fvcRfndCncldRsn, SUM(fnmAmt) FROM db_void WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." GROUP BY fvcRfndCncldRsn ";
				$res = mysqli_query($connection, $sql);
				while ( $row = mysqli_fetch_array( $res ) ) {
					$row_array['name'] = $row[0];
					$row_array['y'] = floatval($row[1]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}

			else {
				$sql = " SELECT fvcRfndCncldRsn, SUM(fnmAmt) FROM db_void WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND tenantID = '". $_POST['id'] ."' GROUP BY fvcRfndCncldRsn ";
				$res = mysqli_query($connection, $sql);
				while ( $row = mysqli_fetch_array( $res ) ) {
					$row_array['name'] = $row[0];
					$row_array['y'] = floatval($row[1]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}
		break;

		case 'monthDiscount':
			$return_arr = array();

			if ( $_POST['id'] == "" ) {
				$sql = " SELECT fvcDscntCd, SUM(fnmDscnt) FROM db_discount WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." GROUP BY fvcDscntCd ";
				$res = mysqli_query($connection, $sql);
				while ( $row = mysqli_fetch_array( $res ) ) {
					$row_array['name'] = $row[0];
					$row_array['y'] = floatval($row[1]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}

			else {
				$sql = " SELECT fvcDscntCd, SUM(fnmDscnt) FROM db_discount WHERE YEAR(fdtTrnsctn) = ". $_POST['year'] ." AND MONTH(fdtTrnsctn) = ". $_POST['month'] ." AND tenantID = '". $_POST['id'] ."' GROUP BY fvcDscntCd ";
				$res = mysqli_query($connection, $sql);
				while ( $row = mysqli_fetch_array( $res ) ) {
					$row_array['name'] = $row[0];
					$row_array['y'] = floatval($row[1]);

					array_push($return_arr,$row_array);
				}

				echo json_encode($return_arr);
			}
		break;

		

		case 'perhourtbl':
			if ( $_POST['id'] == "" ) {
				$sql = " SELECT fdtTrnsctn, fvcHRLCd, SUM(fnmDlySls) FROM db_perhour WHERE YEAR(fdtTrnsctn) = '". $_POST['year'] ."' AND MONTH(fdtTrnsctn) = '". $_POST['month'] ."' AND DAY(fdtTrnsctn) = '". $_POST['dayNum'] ."' GROUP BY fvcHRLCd ";
			}

			else {
				$sql = " SELECT fdtTrnsctn, fvcHRLCd, fnmDlySls FROM db_perhour WHERE YEAR(fdtTrnsctn) = '". $_POST['year'] ."' AND MONTH(fdtTrnsctn) = '". $_POST['month'] ."' AND DAY(fdtTrnsctn) = '". $_POST['dayNum'] ."' AND tenantID = '". $_POST['id'] ."' ";
			}

			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				?>
					<tr>
						<td><?php echo date('F d, Y', strtotime($row[0])); ?></td>
						<td><?php echo date('h:i a', strtotime($row[1])); ?></td>
						<td align="right" style="text-align: right;"><?php echo number_format($row[2], 2, '.', ',') ?></td>
					</tr>

				<?php
			}
		break;

		case 'tenantsName':
			$sql = " SELECT TenantID, CONCAT(owner_lastname, ', ', owner_firstname) FROM tbltrans_tenants WHERE TenantID = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[1];
		break;

		case 'getHourlySales':
			$return_arr = array();

			if ( $_POST['id'] == "" ) {
				$sql = " SELECT fdtTrnsctn, fvcHRLCd, SUM(fnmDlySls) FROM db_perhour WHERE YEAR(fdtTrnsctn) = '". $_POST['year'] ."' AND MONTH(fdtTrnsctn) = '". $_POST['month'] ."' AND DAY(fdtTrnsctn) = '". $_POST['dayNum'] ."' GROUP BY fvcHRLCd ";
			}

			else {
				$sql = " SELECT fdtTrnsctn, fvcHRLCd, SUM(fnmDlySls) FROM db_perhour WHERE YEAR(fdtTrnsctn) = '". $_POST['year'] ."' AND MONTH(fdtTrnsctn) = '". $_POST['month'] ."' AND DAY(fdtTrnsctn) = '". $_POST['dayNum'] ."' AND tenantID = '". $_POST['id'] ."' GROUP BY fvcHRLCd ";
			}

			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				$row_array['name'] = $row[0];
				$row_array['y'] = floatval($row[2]);
				array_push($return_arr,$row_array);
			}
			echo json_encode($return_arr);
		break;

		case 'displayTenants':
			$sql = " SELECT TenantID, CONCAT(owner_lastname, ', ', owner_firstname), tradename FROM tbltrans_tenants WHERE tradename LIKE '%". $_POST['key'] ."%' AND mallid = '". $_POST['mallsid'] ."' AND ustatus = 'occupied' LIMIT " . $_POST['countTenants'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				?>
					<tr onclick="kuhaInfo('<?php echo $row[0]; ?>', '<?php echo $row[2]; ?>')">
						<td><?php echo $row[2]; ?></td>
					</tr>
				<?php
			}

			$sql2 = " SELECT COUNT(tenantID) FROM tbltrans_tenants  WHERE tradename LIKE '%". $_POST['tenansName'] . "%' AND ustatus = 'occupied' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			echo "|" . floor($row2[0] / 10);
		break;

		case '':
			for ( $a = 1; $a<= 12; $a++ ) {
				if ( $_POST['id'] == "" ) {
					$sql = " SELECT tenantID, tradename, CompanyID FROM tbltrans_tenants ";
				}

				else {
					$sql = " SELECT tenantID, tradename, CompanyID FROM tbltrans_tenants WHERE tenantID = '". $_POST['id'] ."' ";
				}

				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
				while ( $row = mysqli_fetch_array($res) ) {
				
					$sql2 = " SELECT tbltrans_tenants.tradename, db_sales.tenantid, MONTH(db_sales.fdtTrnsctn), db_sales.fdtTrnsctn, SUM(db_sales.fnmGTDlySls), SUM(db_sales.fnmGTDscnt), SUM(db_void.fnmAmt), tbltrans_company.filename
						FROM db_sales
						LEFT JOIN tbltrans_tenants ON tbltrans_tenants.TenantID = db_sales.tenantid 
						LEFT JOIN db_void ON db_sales.tenantid = db_void.tenantID
						LEFT JOIN tbltrans_company ON tbltrans_tenants.CompanyID = tbltrans_company.CompanyID
						WHERE db_sales.tenantid = '". $row[0] ."' AND MONTH(db_sales.fdtTrnsctn) = ". $a ."
						GROUP BY db_sales.tenantid ";
					$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
					$row2 = mysqli_fetch_array($res2);

					$getpic = " SELECT filename FROM tbltrans_company WHERE CompanyID = '". $row[2] ."' ";
					$respic = mysqli_query($connection, $getpic);
					$rowpic = mysqli_fetch_array($respic);

					if ( $rowpic[0] != "" ) {
						$img = "server/company/" . $row[2]. "/profile/" .$rowpic[0];
					}

					else {
						$img = "reports/no-image.png";
					}

					?>
						
						<tr>
							<td class='text-right'><img src="<?php echo $img; ?>" style="width: 20px;">   </td>
						
							<td> <?php echo $row[1]; ?> </td>
						
							<td><?php echo date('F', strtotime('2017-'. $a . '-01')); ?> </td>
						
							<td class='text-right'> <?php echo number_format($row2[4], 2, ".", ","); ?> </td>
						
							<td class='text-right'><?php echo number_format($row2[5], 2, ".", ","); ?></td>
						
							<td class='text-right'><?php echo number_format($row2[6], 2, ".", ","); ?></td>
						</tr>
						
					<?php
				}

			}


		break;

		case 'wholeYearList':
			for ( $a = 1; $a<= 12; $a++ ) {
				
				
				// if ( $_POST['id'] == "" ) {
				// 	$sql2 = " SELECT tbltrans_tenants.tradename, db_sales.tenantid, MONTH(db_sales.fdtTrnsctn), db_sales.fdtTrnsctn, SUM(db_sales.fnmGTDlySls), SUM(db_sales.fnmGTDscnt), tbltrans_company.filename
				// 	FROM db_sales
				// 	INNER JOIN tbltrans_tenants ON tbltrans_tenants.TenantID = db_sales.tenantid 
				// 	inner JOIN db_void ON db_sales.tenantid = db_void.tenantID
				// 	INNER JOIN tbltrans_company ON tbltrans_tenants.CompanyID = tbltrans_company.CompanyID
				// 	WHERE MONTH(db_sales.fdtTrnsctn) = 1
				// 	GROUP BY db_sales.tenantid; ";
				// }

				// else {
					// $sql2 = " SELECT tbltrans_tenants.tradename, db_sales.tenantid, MONTH(db_sales.fdtTrnsctn), db_sales.fdtTrnsctn, SUM(db_sales.fnmGTDlySls), SUM(db_sales.fnmGTDscnt) ,

					// -- SUM(db_void.fnmAmt)
					// (SELECT SUM(fnmAmt) FROM db_void WHERE tenantID = db_sales.tenantid) AAA

					// , tbltrans_company.filename
					// FROM db_sales
					// INNER JOIN tbltrans_tenants ON tbltrans_tenants.TenantID = db_sales.tenantid 
					// -- inner JOIN db_void ON db_sales.tenantid = db_void.tenantID
					// INNER JOIN tbltrans_company ON tbltrans_tenants.CompanyID = tbltrans_company.CompanyID
					// WHERE db_sales.tenantid = '". $_POST['id'] ."' AND tbltrans_tenants.tenantid = '". $_POST['id'] ."' AND MONTH(db_sales.fdtTrnsctn) = ". $a ."
					// GROUP BY db_sales.tenantid ";
				// }

				if ( $_POST['id'] == "" ) {
					$sql2 = " SELECT tbltrans_tenants.tradename, db_sales.tenantid, MONTH(db_sales.fdtTrnsctn), db_sales.fdtTrnsctn, SUM(db_sales.fnmGTDlySls), SUM(db_sales.fnmGTDscnt) ,

					-- SUM(db_void.fnmAmt)
					(SELECT SUM(fnmAmt) FROM db_void WHERE tenantID = db_sales.tenantid) AAA

					, tbltrans_company.filename
					FROM db_sales
					INNER JOIN tbltrans_tenants ON tbltrans_tenants.TenantID = db_sales.tenantid 
					-- inner JOIN db_void ON db_sales.tenantid = db_void.tenantID
					INNER JOIN tbltrans_company ON tbltrans_tenants.CompanyID = tbltrans_company.CompanyID
					WHERE db_sales.mallid = '". $_POST['mallid'] ."' AND MONTH(db_sales.fdtTrnsctn) = ". $a ."
					GROUP BY db_sales.mallid ";
				}

				else {
					$sql2 = " SELECT tbltrans_tenants.tradename, db_sales.tenantid, MONTH(db_sales.fdtTrnsctn), db_sales.fdtTrnsctn, SUM(db_sales.fnmGTDlySls), SUM(db_sales.fnmGTDscnt) ,

					-- SUM(db_void.fnmAmt)
					(SELECT SUM(fnmAmt) FROM db_void WHERE tenantID = db_sales.tenantid) AAA

					, tbltrans_company.filename
					FROM db_sales
					INNER JOIN tbltrans_tenants ON tbltrans_tenants.TenantID = db_sales.tenantid 
					-- inner JOIN db_void ON db_sales.tenantid = db_void.tenantID
					INNER JOIN tbltrans_company ON tbltrans_tenants.CompanyID = tbltrans_company.CompanyID
					WHERE db_sales.tenantid = '". $_POST['id'] ."' AND tbltrans_tenants.tenantid = '". $_POST['id'] ."' AND MONTH(db_sales.fdtTrnsctn) = ". $a ."
					GROUP BY db_sales.tenantid ";
				}
				

				$res2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
				$row2 = mysqli_fetch_array($res2);

				$getpic = " SELECT filename FROM tbltrans_company WHERE CompanyID = '". $row[2] ."' ";
				$respic = mysqli_query($connection, $getpic);
				$rowpic = mysqli_fetch_array($respic);

				if ( $rowpic[0] != "" ) {
					$img = "server/company/" . $row[2]. "/profile/" .$rowpic[0];
				}

				else {
					$img = "reports/no-image.png";
				}

				?>
					
					<div  class="container-fluid hidden-xs hidden-sm parangtr"  style="border-bottom: 1px solid #999;">
						
					
						<div class='col-md-2 col-md-offset-2'><?php echo date('F', strtotime('2017-'. $a . '-01')); ?> </div>
					
						<div class='col-md-2 text-right'> <?php echo number_format($row2[4], 2, ".", ","); ?> </div>
					
						<div class='col-md-2 text-right'><?php echo number_format($row2[5], 2, ".", ","); ?></div>
					
						<div class='col-md-2 text-right'><?php echo number_format($row2[6], 2, ".", ","); ?></div>
					</div>

					<div  class="container-fluid hidden-lg hidden-md parangtr" style="border-bottom: 1px solid #999;">
						
					
						<div class="col-sm-9">
					
							<div class='col-sm-12 col-xs-12'><b class="text-primary">Month: </b> <?php echo date('F', strtotime('2017-'. $a . '-01')); ?> </div>
						
							<div class='col-sm-12 col-xs-12'><b class="text-primary">Sales:</b> <?php echo number_format($row2[4], 2, ".", ","); ?> </div>
						
							<div class='col-sm-12 col-xs-12'><b class="text-primary">Discount: </b> <?php echo number_format($row2[5], 2, ".", ","); ?></div>
						
							<div class='col-sm-12 col-xs-12'><b class="text-primary">Void:</b> <?php echo number_format($row2[6], 2, ".", ","); ?></div>
						</div>
					</div>
					
				<?php
			}
		break;
	}
?>