<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayPosition':
			$sql = " SELECT xPOSITION FROM tblref_companyposition WHERE xPOSITION LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count906'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $row[0]; ?></td>
					</tr>
				<?php
			}

			echo $sql2;

			$sql2 = " SELECT COUNT(*) FROM tblref_companyposition WHERE xPOSITION LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedPosition':
			$sql = " SELECT xPOSITION FROM tblref_companyposition WHERE xPOSITION = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]);

			mysqli_close($connection);
		break;

		case 'savePosition':
			$check = " SELECT xPOSITION FROM tblref_companyposition WHERE xPOSITION = '". $_POST['positionDesc'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$sql = " INSERT INTO tblref_companyposition SET xPosition = '". utf8_encode($_POST['positionDesc']) ."' ";
				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

				if ( $res == true ) {
					echo 1;
				}
			}

			else {
				echo "Description already exist.";
			}
		break;

		case 'updatePosition':
			$sql = " UPDATE tblref_companyposition SET xPosition = '". utf8_encode($_POST['positionDesc']) ."' WHERE xPosition = '". $_POST['hiddenpositionid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deletePosition':
			$sql = " DELETE FROM tblref_companyposition WHERE xPosition = '". $_POST['positionDesc'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;
	}
?>