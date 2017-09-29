<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displaySetTask':
			$sql = " SELECT xcategory, taskid, description, amount, equipmentname FROM tblmaintenance_tasklist WHERE description LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count57'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				$resname = mysqli_query($connection, "SELECT category FROM tblmaintenance_category WHERE category_id = '". $row[0] ."' ");
				$catname = mysqli_fetch_array($resname);
				?>
					<tr id="<?php echo $row[1]; ?>">
						<td><?php echo $catname[0]; ?></td>
						<td><?php echo $row[1]; ?></td>
						<td><?php echo $row[2]; ?></td>
						<td><?php echo utf8_encode($row[3]); ?></td>
						<td><?php echo utf8_encode($row[4]); ?></td>
					</tr>
				<?php
			}

			$sql2 = " SELECT COUNT(*) FROM tblmaintenance_tasklist WHERE description LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedSetTask':
			$sql = " SELECT xcategory, taskid, description, amount, equipmentid FROM tblmaintenance_tasklist WHERE taskid = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			echo $row[0] . "|" . utf8_encode($row[1]) . "|" . utf8_encode($row[2]) . "|" . utf8_encode($row[3]) . "|" . utf8_encode($row[4]);

			mysqli_close($connection);
		break;

		case 'saveSetTask':
			$check = " SELECT taskid FROM tblmaintenance_tasklist WHERE taskid = '". $_POST['setTaskCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT description FROM tblmaintenance_tasklist WHERE description = '". $_POST['setTaskDesc'] ."' "));
				if($rowdesc[0] == ""){
					$resequip = mysqli_query($connection, "SELECT description FROM tblmaintenance_equip WHERE code = '". $_POST['setEquip'] ."' ");
					$rowequip = mysqli_fetch_array($resequip);
					$sql = " INSERT INTO tblmaintenance_tasklist SET taskid = '". $_POST['setTaskCode'] ."', description = '". utf8_encode($_POST['setTaskDesc']) ."', xcategory = '". $_POST['taskcat'] ."', amount = '". $_POST['setTaskAmount'] ."', equipmentid = '". $_POST['setEquip'] ."', equipmentname = '". $rowequip[0] ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						echo 1;
					}
				}else{
					echo "Task Description already exist.";
				}
			}

			else {
				echo "Task Code already exist";
			}
		break;

		case 'updateSetTask':
			$resequip = mysqli_query($connection, "SELECT description FROM tblmaintenance_equip WHERE code = '". $_POST['setEquip'] ."' ");
			$rowequip = mysqli_fetch_array($resequip);

			$sql = " UPDATE tblmaintenance_tasklist SET taskid = '". $_POST['setTaskCode'] ."', description = '". utf8_encode($_POST['setTaskDesc']) ."', xcategory = '". $_POST['taskcat'] ."', amount = '". $_POST['setTaskAmount'] ."', xcategory = '". $_POST['taskcat'] ."', equipmentid = '". $_POST['setEquip'] ."', equipmentname = '". $rowequip[0] ."' WHERE taskid = '". $_POST['hiddensettaskid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'deleteSetTask':
			$sql = " DELETE FROM tblmaintenance_tasklist WHERE taskid = '". $_POST['setTaskCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'showtaskcats':
			echo "<option value=''>-- Select Category --</option>";
			$sql = " SELECT category_id, category FROM tblmaintenance_category ";
			$res = mysqli_query($connection, $sql);
			while( $row = mysqli_fetch_array($res) ){
				echo "<option value='".$row[0]."'>".$row[1]."</option>";
			}
		break;

		case 'showsetEquip':
			echo "<option value=''>-- Select Equipment --</option>";
			$sql = " SELECT code, description FROM tblmaintenance_equip WHERE status = 'Operational' AND xcategory = 'Equipment' ";
			$res = mysqli_query($connection, $sql);
			while($row=mysqli_fetch_array($res)){
				echo "<option value='".$row[0]."'>".$row[1]."</option>";	
			}
		break;

		case 'clickUpdateSetTask':
			$res = mysqli_query($connection, " SELECT COUNT(taskid) FROM tblmaintenance_tasklist WHERE taskid = '". $_POST['setTaskCode'] ."' ");
			$row = mysqli_fetch_array($res);
			if($row[0] >= 1){
				echo 1;
			}else{
				echo 0;
			}
		break;
	}
?>