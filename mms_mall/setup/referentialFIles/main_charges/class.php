<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayCharge':
			$sql = " SELECT chrgid,chrgname,chrgamount FROM tblref_charges WHERE chrgname LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count3'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[1]; ?></td>
						<td style = 'text-align:right'><?php echo number_format(($row[2]), '2',".",","); ?></td>
					</tr>
				<?php
			}

			echo $sql2;

			$sql2 = " SELECT COUNT(*) FROM tblref_charges WHERE chrgname LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedCharge':
			$sql = " SELECT chrgid,chrgname,chrgamount FROM tblref_charges WHERE chrgid = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]) . "|" . number_format(($row[2]), '2',".",",");

			mysqli_close($connection);
		break;

		case 'saveCharge':
			$check = " SELECT chrgid FROM tblref_charges WHERE chrgid = '". $_POST['chargeCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$sql = " INSERT INTO tblref_charges SET chrgid = '". $_POST['chargeCode'] ."', chrgamount = '". $_POST['chargeAmount'] ."',chrgname = '". utf8_encode($_POST['chargeDesc']) ."' ";
				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

				if ( $res == true ) {
					echo 1;
				}
			}

			else {
				echo "Code already exist.";
			}
		break;

		case 'updateCharge':
			$sql = " UPDATE tblref_charges SET chrgid = '". $_POST['chargeCode'] ."',  chrgamount = '". $_POST['chargeAmount'] ."',chrgname = '". utf8_encode($_POST['chargeDesc']) ."' WHERE chrgid = '". $_POST['hiddenchargeid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteCharge':
			$sql = " DELETE FROM tblref_charges WHERE chrgid = '". $_POST['chargeCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;
	}
?>