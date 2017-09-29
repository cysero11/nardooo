<?php
	include "../../../reports/tenantsalesreport/connect.php";

	switch ($_POST['form']) {
		case 'displayMainCat':
			$sql = " SELECT category_id, category, icon FROM tblmaintenance_category WHERE Category LIKE '%". $_POST['key'] ."%' LIMIT ". $_POST['count103'] .", 10 ";
			$res = mysqli_query($connection, $sql);
			while ( $row = mysqli_fetch_array( $res ) ) {
				echo "	<tr id=".$row[0].">
						<td><img style='margin-right: 5px;' src='assets/images/maintenance/".$row[2]."' width='20px' height='20px' /></td>
						<td>".$row[0]."</td>
						<td>".utf8_encode($row[1])."</td>
					</tr>";
			}

			$sql2 = " SELECT COUNT(*) FROM tblmaintenance_category WHERE Category LIKE '%". $_POST['key'] ."%' ";
			$res2 = mysqli_query($connection, $sql2);
			$row2 = mysqli_fetch_array($res2);

			$refcount = explode(".", $row2[0] / 10);

			echo "|" . $refcount[0];

			mysqli_close($connection);
		break;

		case 'selectedMainCat':
			$sql = " SELECT category_id, category, icon FROM tblmaintenance_category WHERE category_id = '". $_POST['id'] ."' ";
			$res = mysqli_query($connection, $sql);
			$row = mysqli_fetch_array($res);

			if($row[2] == ""){
				$image = "1";
			}else{
				$image = "assets/images/maintenance/".$row[2]."";
			}

			echo $row[0] . "|" . utf8_encode($row[1]) . "|" . $image;

			mysqli_close($connection);
		break;

		case 'saveMainCat':
			$check = " SELECT category_id FROM tblmaintenance_category WHERE category_id = '". $_POST['MainCatCode'] ."' ";
			$rescheck = mysqli_query($connection, $check) or die(mysqli_error($connection));
			$rowcheck = mysqli_fetch_array($rescheck);
			if ( $rowcheck[0] == "" ) {	
				$rowdesc = mysqli_fetch_array(mysqli_query($connection, "SELECT category FROM tblmaintenance_category WHERE category = '". $_POST['MainCatDesc'] ."' "));
				if($rowdesc[0] == ""){
					$sql = " INSERT INTO tblmaintenance_category SET category_id = '". $_POST['MainCatCode'] ."', category = '". utf8_encode($_POST['MainCatDesc']) ."' ";
					$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

					if ( $res == true ) {
						$id = mysqli_fetch_array(mysqli_query($connection, "SELECT id FROM tblmaintenance_category WHERE category_id = '". $_POST['MainCatCode'] ."' "));
						echo "1"."|".$id[0];
					}
				}else{
					echo "Category description already exist.";
				}
			}

			else {
				echo "Category Code already exist.";
			}
		break;

		case 'updateMainCat':
			$sql = " UPDATE tblmaintenance_category SET category_id = '". $_POST['MainCatCode'] ."', category = '". utf8_encode($_POST['MainCatDesc']) ."' WHERE category_id = '". $_POST['hiddenmaincatid'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));

			if ( $res == true ) {
				$id = mysqli_fetch_array(mysqli_query($connection, "SELECT id FROM tblmaintenance_category WHERE category_id = '". $_POST['MainCatCode'] ."' "));
				echo "1"."|".$id[0];
			}
		break;

		case 'deleteMainCat':
			$sql = " DELETE FROM tblmaintenance_category WHERE category_id = '". $_POST['MainCatCode'] ."' ";
			$res = mysqli_query($connection, $sql) or die(mysqli_error($connection));
			if ( $res == true ) {
				echo 1;
			}
		break;

		case 'clickUpdateMainCat':
			$res = mysqli_query($connection, " SELECT COUNT(xcategory) FROM tblmaintenance_tasklist WHERE xcategory = '". $_POST['MainCatCode'] ."' ");
			$row = mysqli_fetch_array($res);
			if($row[0] >= 1){
				echo 1;
			}else{
				echo 0;
			}
		break;
	}
?>