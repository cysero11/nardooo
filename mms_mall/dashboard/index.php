<?php
	include("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
</head>
<body>
<?php
	$active = "1";
	if(isset($_REQUEST["report"]))
	{ $active = $_REQUEST["report"]; }
?>
<script>
	function add_date()
	{ $("#changedate").modal("show"); }
</script>
<div class="container-fluid">
    <!-- <div class="nav navbar-light navbar-fixed-top btn-success">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <a class="navbar-brand" href="index.php">Genesis Reports Dashboard</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav" class="items">
                    <li<?php if($active == "1"){ ?> class="active"<?php } ?>><a href="index.php?report=1">Quick House Status</a></li>
                    <li<?php if($active == "2"){ ?> class="active"<?php } ?>><a href="index.php?report=2">Housekeeping Room Status</a></li>
                    <li<?php if($active == "3"){ ?> class="active"<?php } ?>><a href="index.php?report=3">Rate Amount Reconciliation</a></li>
                    <li<?php if($active == "4"){ ?> class="active"<?php } ?>><a href="index.php?report=4">Reservation Update</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                	<hr class="hidden-lg" style="border-top: solid 1px #FFF; opacity: 0.1;">
                    <li onclick="add_date();" style="cursor: pointer;"><a><?php echo date("F d, Y", strtotime($mydate)); ?></a></li>
                    <li><a href="#" onclick="logoutuser();">Logout</a></li>
                </ul>
            </div>
        </div>
    </div> -->
    <br><br><br>
    <?php
    	if(isset($_REQUEST["report"]))
		{ include("report" . $_REQUEST["report"] . ".php"); }
		else
		{ include("report1.php"); }
	?>
</div>
<script>
	function select_date()
	{
		var mydate = $("#txtmydate").val();
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'mydate=' + mydate + '&form=changedate',
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{ window.location = "index.php"; }
				else
				{ alert("Date not changed."); }
			}
		}).error(function() {
			alert(data);
		});
	}
</script>
<div class="modal fade" id="changedate" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Date</h4>
            </div>
            <div class="modal-body surveyform"><br />
				<div class="input-group" style="margin-top: -10px;">
                	<input type="text" class="form-control" id="txtmydate" onchange="select_date();" data-provide="datepicker" placeholder="mm/dd/yyyy">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                </div>
                <br><br>
            </div>
		</div>
	</div>
</div>
</body>
<!-- <script src="js/highcharts.js"></script>
<script src="js/drilldown.js"></script>
<script src="js/exporting.js"></script> -->
<script>
	Highcharts.setOptions({
		lang: {
			decimalPoint: '.',
			thousandsSep: ','
		}
	});
</script>
</html>