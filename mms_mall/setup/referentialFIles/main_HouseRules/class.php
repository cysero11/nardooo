<?php 
	include "../../../reports/tenantsalesreport/connect.php";
	switch ($_POST['form']) {
		case 'showmainHouseRules':
			$sql = " SELECT id, code, violation, 1st_offense, 2nd_offense, 3rd_offense, xsucceeding FROM tblmaintenance_houserules WHERE violation LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count542'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo $row[3]; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[5]; ?></td>
						<td><?php echo $row[6]; ?></td>
						<td><?php echo $row[7]; ?></td>
					</tr>
				<?php
			}

			$sql2 = " SELECT COUNT(*) FROM tblmaintenance_houserules WHERE violation LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'saveHouseRules':
			$rowcheck = mysqli_fetch_array(mysqli_query($connection, " SELECT code FROM tblmaintenance_houserules WHERE code = '". $_POST['Code'] ."' "));
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT Violation FROM tblmaintenance_houserules WHERE Violation = '". $_POST['Violation'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblmaintenance_houserules SET Code = '". $_POST['Code'] ."', Violation = '". $_POST['Violation'] ."', 1st_offense = '". $_POST['offense1'] ."', 2nd_offense = '". $_POST['offense2'] ."', 3rd_offense = '". $_POST['offense3'] ."', xsucceeding = '". $_POST['Succeeding'] ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Violation already exist.";
				}
			}
			else {
				echo "Code already exist.";
			}
		break;

		case 'selectedHouseRules':
			$HouseRules = mysqli_fetch_array(mysqli_query($connection, "SELECT code, violation, 1st_offense, 2nd_offense, 3rd_offense, xsucceeding FROM tblmaintenance_houserules WHERE id = '". $_POST['id'] ."' "));
			echo $HouseRules[0] . "|" . $HouseRules[1] . "|" . $HouseRules[2] . "|" . $HouseRules[3] . "|" . $HouseRules[4] . "|" . $HouseRules[5];
		break;

		case 'clickDeleteHouseRulesCat':
			$sql = " DELETE FROM tblmaintenance_houserules WHERE Code = '". $_POST['Code'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'updateHouseRulesCat':
			$sql = " UPDATE tblmaintenance_houserules SET Code = '". $_POST['Code'] ."', Violation = '". $_POST['Violation'] ."', 1st_offense = '". $_POST['offense1'] ."', 2nd_offense = '". $_POST['offense2'] ."', 3rd_offense = '". $_POST['offense3'] ."', xsucceeding = '". $_POST['Succeeding'] ."' WHERE id = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;
}
?>