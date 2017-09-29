<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayCat':
			$sql = " SELECT dept_ID,categoryID,category FROM tblref_merchandisedep_cat WHERE category LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count101'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				?>
					<tr id="<?php echo $row[1]; ?>">
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo utf8_encode($row[2]); ?></td>
					</tr>
				<?php
			}

			echo $sql2;

			$sql2 = " SELECT COUNT(*) FROM tblref_merchandisedep_cat WHERE category LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedCat':
			$sql = " SELECT dept_ID,categoryID,category FROM tblref_merchandisedep_cat WHERE categoryID = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]) . "|" . utf8_encode($row[2]);

			mysqli_close($connection);
		break;

		case 'saveCat':
			$check = " SELECT categoryID FROM tblref_merchandisedep_cat WHERE categoryID = '". $_POST['catCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT category FROM tblref_merchandisedep_cat WHERE category = '". $_POST['catDesc'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblref_merchandisedep_cat SET dept_ID = '". $_POST['deptId'] ."', categoryID = '". $_POST['catCode'] ."', category = '". utf8_encode($_POST['catDesc']) ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Category Description already exist.";
				}
			}

			else {
				echo "Category Code already exist.";
			}
		break;

		case 'updateCat':
			$sql = " UPDATE tblref_merchandisedep_cat SET dept_ID = '". $_POST['deptId'] ."', categoryID = '". $_POST['catCode'] ."', category = '". utf8_encode($_POST['catDesc']) ."' WHERE categoryID = '". $_POST['hiddencatid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteCat':
			$sql = " DELETE FROM tblref_merchandisedep_cat WHERE categoryID = '". $_POST['catCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'listUnitDept':
			$sql = " SELECT
						`departmentID`,
						`department` 
					FROM
						tblref_merchandise_depa ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			while ( $row = mysqli_fetch_array($res) ) {
				echo "<option value='". $row[0] ."'>".$row[1]."</option>";
			}
		break;

		case 'clickUpdateCat':
			$res = mysqli_query($connection, " SELECT COUNT(catid) FROM tblref_unit WHERE catid = '". $_POST['catCode'] ."' ");
			$row = mysqli_fetch_array($res);
			if($row[0] >= 1){
				echo 1;
			}else{
				echo 0;
			}
		break;
	}
?>