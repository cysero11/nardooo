<?php
	include "connect.php";

	switch ($_POST['form']) {
		case 'syncbody':
			if ( $_POST['filterStat'] == "1" ) {
				$stats = " AND a.countSync = '5' ";
			} 

			else if ( $_POST['filterStat'] == "2" ) {
				$stats = " AND a.countSync < '5' ";
			} 

			else {
				$stats = "";
			}
			
			$sql = " SELECT a.reportDate, a.tenantID, a.sales, a.discount, a.void_refund, a.salesperhour, a.paymenttype, CONCAT(b.owner_lastname, ', ', b.owner_firstname), a.refno, a.penalty, a.uploaded, b.tradename FROM db_syncfilestat as a INNER JOIN tbltrans_tenants as b ON a.tenantID = b.TenantID WHERE b.tradename LIKE '%". $_POST['tenantName'] ."%' AND a.reportDate BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' ". $stats ." AND b.ustatus = 'occupied' AND b.withPOS != '0' ORDER BY a.reportDate DESC LIMIT ". $_POST['count'] .", 10 ";
			$res = mysqli_query($connection, $sql); // or die(mysqli_error($connection));

			//echo $sql;
			$forstyle = 1;
			while ( $row = mysqli_fetch_array($res) ) {
				if ( $forstyle & 1 ) {
					$kulay = "";
				}

				else {
					$kulay = "background-color: #DBDBDB;";
				}
				// $sql2 = " SELECT CONCAT(owner_lastname, ', ', owner_firstname) FROM tbltrans_tenants WHERE TenantID = '". $row[1] ."' ";
				// $res2 = mysqli_query($connection, $sql2);
				// $row2 = mysqli_fetch_array($res2);

				?>
					<div class="col-md-12 hidden-xs hidden-sm parangtr" style="<?php echo $kulay; ?>">
						<div class="col-md-1">
							<?php
								if ( $row[2] == 0 || $row[3] == 0 || $row[4] == 0 || $row[5] == 0 || $row[6] == 0 ) {
									if ( $row[9] != 1 ) {
										?>
											<center>
												<div class="ace-settings-item">
													<input type="checkbox" class="ace ace-checkbox-2 mgacheckbox" id="<?php echo $row[8]; ?>">
													<label class="lbl" for="ace-settings-navbar"></label>
												</div>
											</center>
										<?php
									} 

									else {
										?>
											<center><label <?php if ( $row[10] == 0 ) { ?> title="Click to sync files" class="fa fa-upload text-danger" onclick="syncfiles2('<?php echo $row[8]; ?>');" <?php } else { ?> class="fa fa-upload text-success" <?php } ?>></label></center>
										<?php
									}
								}

								else {
									if ( $row[10] == 1 ) {
										?>
											<center>
												<label class="fa fa-upload text-success"></label>
											</center>
										<?php
									}
									
									else {
										?>
											<center>
												<label class="fa fa-check-circle text-success"></label>
											</center>
										<?php
									}
								}

							?>
						</div>

						<div class="col-md-2">
							<?php echo date('F d, Y', strtotime($row[0])) ?>
						</div>
						<div class="col-md-3">
							<?php echo $row[11]; ?>
						</div>
						<div class="col-md-1" style="text-align: center;">
							<?php
								if ( $row[2] == 1 ) {
									?>
										<span class="glyphicon glyphicon-ok-sign text-success"></span>
									<?php
								}

								else {
									?>
										<span class="glyphicon glyphicon-remove-sign text-danger"></span>
									<?php
								}
							?>
						</div>
						<div class="col-md-1" style="text-align: center;">
							<?php
								if ( $row[3] == 1 ) {
									?>
										<span class="glyphicon glyphicon-ok-sign text-success"></span>
									<?php
								}

								else {
									?>
										<span class="glyphicon glyphicon-remove-sign text-danger"></span>
									<?php
								}
							?>
						</div>
						<div class="col-md-1" style="text-align: center;">
							<?php
								if ( $row[4] == 1 ) {
									?>
										<span class="glyphicon glyphicon-ok-sign text-success"></span>
									<?php
								}

								else {
									?>
										<span class="glyphicon glyphicon-remove-sign text-danger"></span>
									<?php
								}
							?>
						</div>
						<div class="col-md-1" style="text-align: center;">
							<?php
								if ( $row[5] == 1 ) {
									?>
										<span class="glyphicon glyphicon-ok-sign text-success"></span>
									<?php
								}

								else {
									?>
										<span class="glyphicon glyphicon-remove-sign text-danger"></span>
									<?php
								}
							?>
						</div> 
						<div class="col-md-1" style="text-align: center;">
							<?php
								if ( $row[6] == 1 ) {
									?>
										<span class="glyphicon glyphicon-ok-sign text-success"></span>
									<?php
								}

								else {
									?>
										<span class="glyphicon glyphicon-remove-sign text-danger"></span>
									<?php
								}
							?>
						</div>

						<div class="col-md-1" style="text-align: center;">
							<?php
								if ( $row[9] == 1 ) {
									?>Posted<?php
								}
							?>
						</div>
					</div>

					<div class="hidden-md hidden-lg" style="box-shadow: 0 0 3px #333; padding: 5px;">
						<div class="container-fluid">
							<div class="col-md-12">
								<div class="col-sm-6 col-xs-6">
									<b class="text-primary">Transaction Date: </b>
								</div>
								<div class="col-sm-6 col-xs-6">
									<?php echo date('F d, Y', strtotime($row[0])) ?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-sm-6 col-xs-6">
									<b class="text-primary">Transaction Date: </b>
								</div>
								<div class="col-sm-6 col-xs-6">
									<?php echo $row[7]; ?>
								</div>
							</div>

							<div class="col-md-12">
								<div class="col-sm-6 col-xs-6">
									<b class="text-primary">Sales: </b>
								</div>
								<div class="col-sm-6 col-xs-6">
									<?php
										if ( $row[2] == 1 ) {
											?>
												<span class="glyphicon glyphicon-ok-sign text-success"></span>
											<?php
										}

										else {
											?>
												<span class="glyphicon glyphicon-remove-sign text-danger"></span>
											<?php
										}
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-sm-6 col-xs-6">
									<b class="text-primary">Discount: </b>
								</div>
								<div class="col-sm-6 col-xs-6">
									<?php
										if ( $row[3] == 1 ) {
											?>
												<span class="glyphicon glyphicon-ok-sign text-success"></span>
											<?php
										}

										else {
											?>
												<span class="glyphicon glyphicon-remove-sign text-danger"></span>
											<?php
										}
									?>
								</div>
							</div>

							<div class="col-md-12">
								<div class="col-sm-6 col-xs-6">
									<b class="text-primary">Void: </b>
								</div>
								<div class="col-sm-6 col-xs-6">
									<?php
										if ( $row[4] == 1 ) {
											?>
												<span class="glyphicon glyphicon-ok-sign text-success"></span>
											<?php
										}

										else {
											?>
												<span class="glyphicon glyphicon-remove-sign text-danger"></span>
											<?php
										}
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-sm-6 col-xs-6">
									<b class="text-primary">Sales Per Hour: </b>
								</div>
								<div class="col-sm-6 col-xs-6">
									<?php
										if ( $row[5] == 1 ) {
											?>
												<span class="glyphicon glyphicon-ok-sign text-success"></span>
											<?php
										}

										else {
											?>
												<span class="glyphicon glyphicon-remove-sign text-danger"></span>
											<?php
										}
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="col-sm-6 col-xs-6">
									<b class="text-primary">Type: </b>
								</div>
								<div class="col-sm-6 col-xs-6">
									<?php
										if ( $row[6] == 1 ) {
											?>
												<span class="glyphicon glyphicon-ok-sign text-success"></span>
											<?php
										}

										else {
											?>
												<span class="glyphicon glyphicon-remove-sign text-danger"></span>
											<?php
										}
									?>
								</div>
							</div>
						</div>
					</div>
				<?php
				$forstyle ++;
			}

			
			$count = " SELECT COUNT(a.id) FROM db_syncfilestat as a INNER JOIN tbltrans_tenants as b ON a.tenantID = b.TenantID WHERE CONCAT(b.owner_lastname, ', ', b.owner_firstname) LIKE '%". $_POST['tenantName'] ."%' AND a.reportDate BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' ";

			$rescount = mysqli_query($connection, $count);
			$rowcount = mysqli_fetch_array($rescount);

			echo "|" . floor($rowcount[0]/10);
			echo $sql;
		break;

		case 'saveTime2':
			$daterange = $_POST['daterange'];
			$datetodaysync = $_POST['datetodaysync'];

			if( $daterange == "1" && $datetodaysync == "0" ){
			$sql = " UPDATE db_settimeupload SET timetosave = '". date('H:i', strtotime($_POST['wholeTime'])) ."', hours = '". $_POST['oras'] ."', minuto = '". $_POST['minuto'] ."', ampm = '". $_POST['ewan'] ."' , datefrom = '". date('Y-m-d', strtotime($_POST['dateFromsync'])) ."', dateto = '". date('Y-m-d', strtotime($_POST['dateTosync'])) ."', synctype = '1' ";
			}
			else if( $daterange == "0" && $datetodaysync == "2" ){
			$sql = " UPDATE db_settimeupload SET timetosave = '". date('H:i', strtotime($_POST['wholeTime'])) ."', hours = '". $_POST['oras'] ."', minuto = '". $_POST['minuto'] ."', ampm = '". $_POST['ewan'] ."' , synctype = '2', datefrom = NULL, dateto = NULL ";
			}
			$res = mysqli_query($connection, $sql);
			if ( $res == true ) {
				echo 1;
			}

			// echo $_POST['wholeTime'];
		break;

		case 'getTimeSync':
			$sql = " SELECT hours, minuto, ampm, datefrom, dateto, synctype FROM db_settimeupload ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . $row[1] . "|" .$row[2] . "|" . $row[3] . "|" . $row[4] . "|" . $row[5];
		break;

		case 'syncFiles':
			$sql = " SELECT timetosave FROM db_settimeupload ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			if ( date('H:i', strtotime($row[0])) == date('H:i') ) {
				echo 1;
			}
		break;

		case 'numLayout':
			$amount = str_replace(",", "", $_POST['amount']);

			echo number_format( $amount, "2", ".", ",");
		break;

		case 'mgaKulang':
			$sql = " SELECT a.refno FROM db_syncfilestat as a INNER JOIN tbltrans_tenants as b ON a.tenantID = b.TenantID WHERE CONCAT(b.owner_lastname, ', ', b.owner_firstname) LIKE '%". $_POST['tenantName'] ."%' AND a.reportDate BETWEEN '". date('Y-m-d', strtotime($_POST['dateFrom'])) ."' AND '". date('Y-m-d', strtotime($_POST['dateTo'])) ."' AND a.countSync < 5 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array($res) ) {
				echo "|" . $row[0];
			}
		break;

		case 'applyPenalty':
			$arr = explode("|", $_POST['interference']);
			$bilang = count($arr) - 1;
			$bagongBilang = 0;
			for ( $a = 1; $a <= count($arr) - 1; $a++ ) {
				$search = " SELECT countSync FROM db_syncfilestat WHERE refno = '". $arr[$a] ."' ";
				$resSearch = mysqli_query($connection, $search);
				$rowSearch = mysqli_fetch_array($resSearch);

				$search2 = " SELECT xcode FROM db_settimeupload ";
				$resSearch2 = mysqli_query($connection, $search2);
				$rowSearch2 = mysqli_fetch_array($resSearch2);

				$search3 = " SELECT chrgamount, chrgname FROM tblref_charges WHERE chrgid = '". $rowSearch2[0] ."' ";
				$resSearch3 = mysqli_query($connection, $search3);
				$rowSearch3 = mysqli_fetch_array($resSearch3);

				$toMultiply = 5 - $rowSearch[0];


				$search4 = " SELECT tenantID FROM db_syncfilestat WHERE refno = '". $arr[$a] ."' ";
				$resSearch4 = mysqli_query($connection, $search4);
				$rowSearch4 = mysqli_fetch_array($resSearch4);

				$sqlmallid = " SELECT mallid FROM tbltrans_tenants WHERE TenantID = '". $rowSearch4[0] ."' ";
				$resmallid = mysqli_query($connection, $sqlmallid);
				$rowmallid = mysqli_fetch_array($resmallid);

				$sqlpenalty = " SELECT penalty_amount FROM mall_setup WHERE mall_id = '". $rowmallid[0] ."' ";
				$respenalty = mysqli_query($connection, $sqlpenalty);
				$rowpenalty = mysqli_fetch_array($respenalty);
				
				$product = $toMultiply * $rowpenalty[0];

				$sql = " INSERT INTO 
						`tbltransaction` 
					SET
						`tenantid` = '". $rowSearch4[0] ."',
						`xcode` = '". $rowSearch2[0] ."',
						`description` = '". $rowSearch3[1] ."',
						`amount` = '". $rowpenalty[0] ."',
						`qty` = '1',
						`paymentamount` = '0.00',
						`balance` = '". $rowpenalty[0] ."',
						`xdate` = '". date('Y-m-d') ."',
						`reference` = 'Unsync files',
						`xdatetime` = '". date('Y-m-d H:i:s') ."',
						`xpenalty` = '". $rowpenalty[0] ."',
						`xpenaltystatus` = '0',
						`paymenttype` = '',
						`cardholder` = '',
						`ccno` = '',
						`expdate` = '0000-00-00',
						`checkno` = '',
						`checkdate` = '0000-00-00',
						`checkname` = '',
						`bankname` = '',
						`orno` = '',
						`totalamount` = '". $rowpenalty[0] ."',
						xdescription = 'Penalty' ";
				$res = mysqli_query($connection, $sql);

				if ( $res == true ) {
					$updatePenalty = " UPDATE  db_syncfilestat SET penalty = 1 WHERE refno = '". $arr[$a] ."' ";
					$resUpdate = mysqli_query($connection, $updatePenalty);

					$bagongBilang = $bagongBilang + 1;
					// echo $updatePenalty;
				}
			}

			// echo $bagongBilang;

			if ( $bagongBilang == $bilang ) {
				echo 1;
			}

			
		break;
	}
?>