<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayUnitClass':
			$sql = " SELECT classificationID,classification FROM tblref_merchandise_class WHERE classification LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count900'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $row[0]; ?></td>
						<td><?php echo utf8_encode($row[1]); ?></td>
					</tr>
				<?php
			}

			echo $sql2;

			$sql2 = " SELECT COUNT(*) FROM tblref_merchandise_class WHERE classification LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedClass':
			$sql = " SELECT classificationID,classification FROM tblref_merchandise_class WHERE classificationID = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]);

			mysqli_close($connection);
		break;

		case 'saveClass':
			$check = " SELECT classificationID FROM tblref_merchandise_class WHERE classificationID = '". $_POST['classCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT classification FROM tblref_merchandise_class WHERE classification = '". $_POST['classDesc'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblref_merchandise_class SET classificationID = '". $_POST['classCode'] ."', classification = '". utf8_encode($_POST['classDesc']) ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Classification description already exist.";
				}
			}

			else {
				echo "Classification code already exist.";
			}
		break;

		case 'updateClass':
			$sql = " UPDATE tblref_merchandise_class SET classificationID = '". $_POST['classCode'] ."', classification = '". utf8_encode($_POST['classDesc']) ."' WHERE classificationID = '". $_POST['hiddenclassid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteClass':
			$sql = " DELETE FROM tblref_merchandise_class WHERE classificationID = '". $_POST['classCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'clickUpdateClass':
			$res = mysqli_query($connection, " SELECT COUNT(classid) FROM tblref_unit WHERE classid = '". $_POST['classCode'] ."' ");
			$row = mysqli_fetch_array($res);
			if($row[0] >= 1){
				echo 1;
			}else{
				echo 0;
			}
		break;
	}
?>