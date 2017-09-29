<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayBank':
			$sql = " SELECT xCODE,description FROM tblrefbank WHERE Description LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count905'] .", 10 ";
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

			$sql2 = " SELECT COUNT(*) FROM tblrefbank WHERE Description LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedBank':
			$sql = " SELECT xCODE,description FROM tblrefbank WHERE xCODE = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]);

			mysqli_close($connection);
		break;

		case 'saveBank':
			$check = " SELECT xCODE FROM tblrefbank WHERE xCode = '". $_POST['bankCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT description FROM tblrefbank WHERE description = '". $_POST['bankDesc'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblrefbank SET xCODE = '". $_POST['bankCode'] ."', description = '". utf8_encode($_POST['bankDesc']) ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Bank Description already exist.";
				}
			}

			else {
				echo "Bank Code already exist.";
			}
		break;

		case 'updateBank':
			$sql = " UPDATE tblrefbank SET xCODE = '". $_POST['bankCode'] ."', description = '". utf8_encode($_POST['bankDesc']) ."' WHERE xCODE = '". $_POST['hiddenbankid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteBank':
			$sql = " DELETE FROM tblrefbank WHERE xCODE = '". $_POST['bankCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;
	}
?>