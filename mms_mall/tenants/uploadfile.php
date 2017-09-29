<?php
	include("../connect.php");
	if(isset($_FILES["txtfile"]["name"]))
	{
		$allowedext = array("image/jpg", "image/jpeg", "image/png", "image/bmp");
		$widthstr = "";
		$heightstr = "";
		if($_POST["txttype"] == "set")
		{
			$widthstr = "width";
			$heightstr = "height";
		}
		else
		{
			$widthstr = "width2";
			$heightstr = "height2";
		}
		if(in_array($_FILES["txtfile"]["type"], $allowedext))
		{
			$ext = explode(".", $_FILES["txtfile"]["name"]);
			$sql = "update tblref_floorsetup set photo = '1', ext = '" . end($ext) . "', " . $widthstr . " = '" . $_POST["imgwidth"] . "', " . $heightstr . " = '" . $_POST["imgheight"] . "' where floorid = '" . $_POST["txtfloor2"] . "'";
			$result = mysql_query($sql);
			if($result == "1")
			{
				$_FILES["txtfile"]["name"] = $_POST["txtfloor2"] . "." . end($ext);
				unlink("../server/floorplan/" . $_FILES["txtfile"]["name"]);
				move_uploaded_file($_FILES["txtfile"]["tmp_name"], "../server/floorplan/" . $_FILES["txtfile"]["name"]);
				echo "|1";
			}
			else
			{ echo "|Error: " . mysql_error() . "!"; }
		}
		else
		{ echo "|Error: Invalid File Format!" . $_FILES["txtfile"]["type"]; }
	}
?>