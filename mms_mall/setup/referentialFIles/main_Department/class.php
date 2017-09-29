<?php 
	include "../../../reports/tenantsalesreport/connect.php";
	switch ($_POST['form']) {
		case 'saveDepartmentCat':
			$check = " SELECT code FROM tblmaintenance_department WHERE code = '". $_POST['DepartmentCatCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT description FROM tblmaintenance_department WHERE description = '". $_POST['DepartmentCatDesc'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblmaintenance_department SET Code = '". $_POST['DepartmentCatCode'] ."', description = '". $_POST['DepartmentCatDesc'] ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Description already exist.";
				}
			}
			else {
				echo "Code already exist.";
			}
		break;

		case 'updateDepartmentCat':
			$sql = " UPDATE tblmaintenance_department SET description = '". $_POST['DepartmentCatDesc'] ."', code = '". $_POST['DepartmentCatCode'] ."' WHERE id = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'showmainDepartment':
			$sql = " SELECT id, code, description FROM tblmaintenance_department WHERE description LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count552'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				$mallname = mysqli_fetch_array(mysqli_query($connection, "SELECT mallname FROM tblref_mall WHERE mallid = '". $row[3] ."' "))
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[2]; ?></td>
					</tr>
				<?php
			}

			$sql2 = " SELECT COUNT(*) FROM tblmaintenance_department WHERE description LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedDepartmentCat':
			$sql = " SELECT code, description FROM tblmaintenance_department WHERE id = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);
			echo $row[0] . "|" . $row[1];
		break;

		case 'clickDeleteDepartmentCat':
			$sql = " DELETE FROM tblmaintenance_department WHERE Code = '". $_POST['DepartmentCatCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'clickUpdateMainDepartment':
			$res = mysqli_query($connection, " SELECT COUNT(Department) FROM tblref_employee WHERE Department = '". $_POST['DepartmentCatCode'] ."' ");
			$row = mysqli_fetch_array($res);
			if($row[0] >= 1){
				echo 1;
			}else{
				echo 0;
			}
		break;
	}
 ?>