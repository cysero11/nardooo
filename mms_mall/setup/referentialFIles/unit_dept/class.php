<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayDept':
			$sql = " SELECT class_ID,departmentID,department FROM tblref_merchandise_depa WHERE department LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count102'] .", 10 ";
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

			$sql2 = " SELECT COUNT(*) FROM tblref_merchandise_depa WHERE department LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedDept':
			$sql = " SELECT class_ID,departmentID,department FROM tblref_merchandise_depa WHERE departmentID = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]) . "|" . utf8_encode($row[2]);

			mysqli_close($connection);
		break;

		case 'saveDept':
			$check = " SELECT departmentID FROM tblref_merchandise_depa WHERE departmentID = '". $_POST['deptCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT department FROM tblref_merchandise_depa WHERE department = '". $_POST['deptDesc'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblref_merchandise_depa SET class_ID = '". $_POST['classId'] ."', departmentID = '". $_POST['deptCode'] ."', department = '". utf8_encode($_POST['deptDesc']) ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Department Description already exist.";
				}
			}

			else {
				echo "Department Code already exist.";
			}
		break;

		case 'updateDept':
			$sql = " UPDATE tblref_merchandise_depa SET class_ID = '". $_POST['classId'] ."', departmentID = '". $_POST['deptCode'] ."', department = '". utf8_encode($_POST['deptDesc']) ."' WHERE departmentID = '". $_POST['hiddendeptid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteClass':
			$sql = " DELETE FROM tblref_merchandise_depa WHERE departmentID = '". $_POST['deptCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'listClassification':
			$sql = " SELECT
						`classificationID`,
						`classification` 
					FROM
						tblref_merchandise_class ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			while ( $row = mysqli_fetch_array($res) ) {
				echo "<option value='". $row[0] ."'>".$row[1]."</option>";
			}
		break;

		case 'clickUpdateDept':
			$res = mysqli_query($connection, " SELECT COUNT(depid) FROM tblref_unit WHERE depid = '". $_POST['deptCode'] ."' ");
			$row = mysqli_fetch_array($res);
			if($row[0] >= 1){
				echo 1;
			}else{
				echo 0;
			}
		break;
	}
?>