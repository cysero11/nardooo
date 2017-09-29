<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayReq':
			$sql = " SELECT requirements, override FROM tblref_applicationrequirements WHERE requirements LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count907'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				if($row[1] == "1"){
					$lol = "Yes";
				}else{
					$lol = "No";
				}
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $lol; ?></td>
					</tr>
				<?php
			}

			echo $sql2;

			$sql2 = " SELECT COUNT(*) FROM tblref_applicationrequirements WHERE requirements LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedReq':
			$sql = " SELECT requirements, override FROM tblref_applicationrequirements WHERE requirements = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[0]) . "|" . $row[1];

			mysqli_close($connection);
		break;

		case 'saveReq':
			$check = " SELECT requirements FROM tblref_applicationrequirements WHERE requirements = '". $_POST['reqDesc'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$sql = " INSERT INTO tblref_applicationrequirements SET requirements = '". utf8_encode($_POST['reqDesc']) ."', override = '". $_POST['override'] ."' ";
				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

				if ( $res == true ) {
					echo 1;
				}
			}

			else {
				echo "Description already exist.";
			}
		break;

		case 'updateReq':
			$sql = " UPDATE tblref_applicationrequirements SET requirements = '". utf8_encode($_POST['reqDesc']) ."', override = '". $_POST['override'] ."' WHERE requirements = '". $_POST['hiddenreqid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteReq':
			$sql = " DELETE FROM tblref_applicationrequirements WHERE requirements = '". $_POST['reqDesc'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;
	}
?>