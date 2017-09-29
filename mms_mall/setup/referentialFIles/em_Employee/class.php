<?php 
	include "../../../reports/tenantsalesreport/connect.php";
	switch ($_POST['form']) {
		case 'showtxtmall':
			echo "<option value=''>-- Select Building --</option>";
			$res = mysqli_query($connection, "SELECT mallid, mallname FROM tblref_mall");
			while($row = mysqli_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;

		case 'displayEmployee':
			$sql = " SELECT id, mallid, Code, Position, First_Name, Middle_Name, Last_Name, Department FROM tblref_employee WHERE Code LIKE '%". $_POST['key'] ."%' OR Position LIKE '%". $_POST['key'] ."%' OR First_Name LIKE '%". $_POST['key'] ."%' OR Middle_Name LIKE '%". $_POST['key'] ."%' OR Last_Name LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count999'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				$mallname = mysqli_fetch_array(mysqli_query($connection, "SELECT mallname FROM tblref_mall WHERE mallid = '". $row[1] ."' "));
				$depname = mysqli_fetch_array(mysqli_query($connection, "SELECT description FROM tblmaintenance_department WHERE code = '". $row[7] ."' "));
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $mallname[0]; ?></td>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo $depname[0]; ?></td>
						<td><?php echo $row[3]; ?></td>
						<td><?php echo $row[4]; ?></td>
						<td><?php echo $row[5]; ?></td>
						<td><?php echo $row[6]; ?></td>
					</tr>
				<?php
			}

			echo $sql2;

			$sql2 = " SELECT COUNT(*) FROM tblref_employee WHERE Category LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedEmployee':
			$sql = " SELECT mallid, Code, Position, First_Name, Middle_Name, Last_Name FROM tblref_employee WHERE id = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3] . "|" . $row[4] . "|" . $row[5];

			mysqli_close($connection);
		break;

		case 'saveEmployee':
			$check = " SELECT Code FROM tblref_employee WHERE Code = '". $_POST['Code'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$sql = " INSERT INTO tblref_employee SET mallid = '". $_POST['mallid'] ."', Code = '". $_POST['Code'] ."', Position = '". $_POST['Position'] ."', First_Name = '". $_POST['firstname'] ."', Middle_Name = '". $_POST['middlename'] ."', Last_Name = '". $_POST['lastname'] ."', Department = '". $_POST['department'] ."' ";
				$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

				if ( $res == true ) {
					echo 1;
				}
			}
			else {
				echo "Code already exist.";
			}
		break;

		case 'updateEmployee':
			$sql = " UPDATE tblref_employee SET mallid = '". $_POST['mallid'] ."', Code = '". $_POST['Code'] ."', Position = '". $_POST['Position'] ."', First_Name = '". $_POST['firstname'] ."', Middle_Name = '". $_POST['middlename'] ."', Last_Name = '". $_POST['lastname'] ."', Department = '". $_POST['department'] ."' WHERE id = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteEmployee':
			$sql = " DELETE FROM tblref_employee WHERE id = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'clickUpdateEmployee':
			$res = mysqli_query($connection, " SELECT COUNT(ViolatorID) FROM tblmaintenance_hrviolators WHERE ViolatorID = '". $_POST['Code'] ."' ");
			$row = mysqli_fetch_array($res);
			if($row[0] >= 1){
				echo 1;
			}else{
				echo 0;
			}
		break;

		case 'showEmpDepartment':
			echo "<option value=''>-- Select Department --</option>";
			$res = mysqli_query($connection, "SELECT code, description FROM tblmaintenance_department");
			while($row = mysqli_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;

		case 'showEmpPosition':
			echo "<option value=''>-- Select Department --</option>";
			$res = mysqli_query($connection, "SELECT xposition FROM tblref_companyposition");
			while($row = mysqli_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[0]."</option>";
			}
		break;
	}
?>