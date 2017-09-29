<?php 
	include "../../../reports/tenantsalesreport/connect.php";
	switch ($_POST['form']) {
		case 'showfloor':
			echo "<option value=''>-- Select Floor --</option>";
			$sql = "SELECT floor FROM tblref_flr";
			$res = mysqli_query($connection, $sql);
			while($row = mysqli_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[0]."</option>";
			}
		break;

		case 'showunit':
			echo "<option value=''>-- Select Unit --</option>";
			$sql = "SELECT mallid, mallname FROM tblref_mall";
			$res = mysqli_query($connection, $sql);
			while($row = mysqli_fetch_array($res)){
				echo "<option value=".$row[0].">".$row[1]."</option>";
			}
		break;

		case 'saveequipCat':
			$check = " SELECT code FROM tblmaintenance_equip WHERE code = '". $_POST['equipCatCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT description FROM tblmaintenance_equip WHERE description = '". $_POST['equipCatDesc'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblmaintenance_equip SET xcategory = 'Equipment', Code = '". $_POST['equipCatCode'] ."', description = '". $_POST['equipCatDesc'] ."', floor = '". $_POST['eqfloor'] ."', unit = '". $_POST['equnit'] ."', status = '". $_POST['equipCatstatus'] ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Equipment Description already exist.";
				}
			}
			else {
				echo "Equipment Code already exist.";
			}
		break;

		case 'updateequipCat':
			$sql = " UPDATE tblmaintenance_equip SET description = '". $_POST['equipCatDesc'] ."', floor = '". $_POST['eqfloor'] ."', unit = '". $_POST['equnit'] ."', status = '". $_POST['equipCatstatus'] ."' WHERE code = '". $_POST['equipCatCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'showmainequip':
			$sql = " SELECT code, description, floor, unit, status FROM tblmaintenance_equip WHERE description LIKE '%". $_POST['key'] ."%' AND xcategory = 'Equipment' LIMIT ". $_POST['count54'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				$mallname = mysqli_fetch_array(mysqli_query($connection, "SELECT mallname FROM tblref_mall WHERE mallid = '". $row[3] ."' "))
				?>
					<tr id="<?php echo $row[0]; ?>">
						<td><?php echo $row[0]; ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo $mallname[0]; ?></td>
						<td><?php echo $row[4]; ?></td>
					</tr>
				<?php
			}

			$sql2 = " SELECT COUNT(*) FROM tblmaintenance_equip WHERE description LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedequipCat':
			$sql = " SELECT code, description, floor, unit, status FROM tblmaintenance_equip WHERE Code = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);
			echo $row[0] . "|" . $row[1] . "|" . $row[2] . "|" . $row[3] . "|" . $row[4];
		break;

		case 'clickDeleteequipCat':
			$sql = " DELETE FROM tblmaintenance_equip WHERE code = '". $_POST['equipCatCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'clickUpdateequipCat':
			$res = mysqli_query($connection, " SELECT COUNT(equipmentid) FROM tblmaintenance_tasklist WHERE equipmentid = '". $_POST['equipCatCode'] ."' ");
			$row = mysqli_fetch_array($res);
			if($row[0] >= 1){
				echo 1;
			}else{
				echo 0;
			}
		break;
	}
 ?>