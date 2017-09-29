<?php
    include('../connect.php');

    switch ($_POST['form']) {

        case 'tblselectshortcutunit':
            $sql = "SELECT a.unitid, a.unitname, a.buildingname, a.classificationname, a.floorunit, b.department, c.category, d.wing, a.ClassID, a.depid, a.catid, a.wingid, a.floorid FROM tblref_unit AS a LEFT JOIN tblref_merchandise_depa AS b ON a.depid = b.departmentID LEFT JOIN tblref_merchandisedep_cat AS c ON a.catid = c.categoryID LEFT JOIN tblref_wing AS d ON a.wingid = d.wingID WHERE a.typeofbusiness = '".$_POST['typeunit']."' AND a.mallid = '".$_POST['txtinq_mallbranch']."' ";
            $res = mysql_query($sql, $connection);
            while ($row = mysql_fetch_array($res)) {
                echo "
                    <tr onclick='slctthisunit(\"".$row[8]."\", \"".$row[9]."\", \"".$row[10]."\", \"".$row[11]."\", \"".$row[12]."\", \"".$row[0]."\");'>
                        <td width='20%'>".$row[1]."</td>
                        <td width='15%'>".$row[4]."</td>
                        <td width='15%'>".$row[7]."</td>
                        <td width='15%'>".$row[3]."</td>
                        <td width='20%'>".$row[5]."</td>
                        <td width='15%'>".$row[6]."</td>
                    </tr>
                ";
            }
        break;

        case 'loadinquiry_department':
			$dep = '<option value="">-- Select Department --</option>';
			$querydep = "SELECT departmentID, department FROM tblref_merchandise_depa WHERE class_ID = '".$_POST['classi']."' ";
            $result_dep = mysql_query($querydep, $connection);
			while($rowdep = mysql_fetch_array($result_dep)){
				$dep .= "<option value='".$rowdep['departmentID']."'>".$rowdep['department']."</option>";
			}

            $cat = '<option value="">-- Select Category --</option>';
            $querycat = "SELECT categoryID, category FROM tblref_merchandisedep_cat WHERE dept_ID = '".$_POST['dep']."' ";
            $result_cat = mysql_query($querycat, $connection);
            while($rowcat = mysql_fetch_array($result_cat)){
                $cat .= "<option value='".$rowcat['categoryID']."'>".$rowcat['category']."</option>";
            }

            $wing = '<option value="">-- Select Wing --</option>';
            $querywing = "SELECT wingID, wing FROM tblref_wing WHERE wingID = '".$_POST['wing']."' ";
            $result_wing = mysql_query($querywing, $connection);
            while($rowwing = mysql_fetch_array($result_wing)){
                $wing .= "<option value='".$rowwing["wingID"]."'>".$rowwing["wing"]."</option>";
            }

            $floor = '<option value="">-- Select Floor --</option>';
            $queryflr = "SELECT floorid, floor FROM tblref_floorsetup WHERE floorid = '".$_POST['floor']."' ";
        	$result_flr = mysql_query($queryflr, $connection);
			while($rowflr = mysql_fetch_array($result_flr)){
				$floor .= "<option value='".$rowflr["floorid"]."'>".$rowflr["floor"]."</option>";
			}

            $unit = '<option value="">-- Select Unit --</option>';
            $queryunit = "SELECT unitid, unitname FROM tblref_unit WHERE unitid = '".$_POST['unit']."' ";
        	$result_unit = mysql_query($queryunit, $connection);
			while($rowunit = mysql_fetch_array($result_unit)){
				$unit .= "<option value='".$rowunit["unitid"]."'>".$rowunit["unitname"]."</option>";
			}

            $lca = '<option value="">-- Select Unit --</option>';
			$queryunitlca = "SELECT unitid, unitname FROM tblref_unit WHERE unitid = '".$_POST['unit']."'";
        	$result_unitlca = mysql_query($queryunitlca, $connection);
			while($rowlca = mysql_fetch_array($result_unitlca)){
				$lca .= "<option value='".$rowlca['unitid']."'>".$rowlca['unitname']."</option>";
			}

            $unitinfo = mysql_fetch_array(mysql_query("SELECT sqmunitsetup, pricepersqmunitsetup, totalamountunitsetup, sqm_width, sqm_height FROM tblref_unit WHERE unitid = '".$_POST['unit']."'"));

            echo $dep."|".$cat."|".$wing."|".$floor."|".$unit."|".$unitinfo[0]."|".number_format($unitinfo[1], '2', '.', ',')."|".number_format($unitinfo[2], '2', '.', ',')
            ."|".$unitinfo[3]."|".$unitinfo[4]."|".$lca;
		break;
    }
?>
