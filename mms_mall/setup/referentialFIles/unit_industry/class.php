<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayIndustry':
			$sql = " SELECT Industry_ID,Industry FROM tblref_industry WHERE Industry LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count3'] .", 10 ";
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

			$sql2 = " SELECT COUNT(*) FROM tblref_industry WHERE Industry LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedIndustry':
			$sql = " SELECT Industry_ID,Industry FROM tblref_industry WHERE Industry_ID = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]);

			mysqli_close($connection);
		break;

		case 'saveIndustry':
			$check = " SELECT Industry_ID FROM tblref_industry WHERE Industry_ID = '". $_POST['industryCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT Industry FROM tblref_industry WHERE Industry = '". $_POST['industryDesc'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblref_industry SET Industry_ID = '". $_POST['industryCode'] ."', Industry = '". utf8_encode($_POST['industryDesc']) ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Industry Description already exist.";
				}
			}

			else {
				echo "Industry Code already exist.";
			}
		break;

		case 'updateIndustry':
			$sql = " UPDATE tblref_industry SET Industry_ID = '". $_POST['industryCode'] ."', Industry = '". utf8_encode($_POST['industryDesc']) ."' WHERE Industry_ID = '". $_POST['hiddenindustryid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteIndustry':
			$sql = " DELETE FROM tblref_industry WHERE Industry_ID = '". $_POST['industryCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;
	}
?>