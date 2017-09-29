<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayFloor':
			$sql = " SELECT floor FROM tblref_flr WHERE floor LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count908'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $row[0]; ?></td>
					</tr>
				<?php
			}

			echo $sql2;

			$sql2 = " SELECT COUNT(*) FROM tblref_flr WHERE floor LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedFloor':
			$sql = " SELECT floor FROM tblref_flr WHERE floor = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]);

			mysqli_close($connection);
		break;

		case 'saveFloor':
			$check = " SELECT floor FROM tblref_flr WHERE floor = '". $_POST['FloorDesc'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$sql = " INSERT INTO tblref_flr SET floor = '". utf8_encode($_POST['FloorDesc']) ."' ";
				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

				if ( $res == true ) {
					echo 1;
				}
			}

			else {
				echo "Description already exist.";
			}
		break;

		case 'updateFloor':
			$sql = " UPDATE tblref_flr SET floor = '". utf8_encode($_POST['FloorDesc']) ."' WHERE floor = '". $_POST['hiddenfloorid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteFloor':
			$sql = " DELETE FROM tblref_flr WHERE floor = '". $_POST['FloorDesc'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;
	}
?>