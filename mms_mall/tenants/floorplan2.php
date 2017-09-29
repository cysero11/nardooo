<link href="assets/css/ol.css" rel="stylesheet" type="text/css">
<script src="assets/js/ol.js"></script>
<script src="assets/js/filesaver.min.js"></script>
<script>
<?php
	include("../connect.php");
	$getgaccess = "select groupaccess from tbluser where userid = '" . $_COOKIE["userid"] . "'";
	$gaccess = mysql_fetch_array(mysql_query($getgaccess));
	$getaccess1 = "select addnew, delremove, viewing from tblref_groupaccess2 where groupid = '" . $gaccess[0] . "' and module = 'Floorplan SET'";
	$access1 = mysql_fetch_array(mysql_query($getaccess1));
	$sql = "select ext, width, height from tblref_floorsetup where floorid = '" . $_POST["floorid"] . "'";
	$row = mysql_fetch_array(mysql_query($sql));
?>	
	var point;

	var extent = [0, 0, <?php echo $row[1]; ?>, <?php echo $row[2]; ?>];
    var projection = new ol.proj.Projection({
        code: 'xkcd-image',
        units: 'pixels',
        extent: extent
    });
	
	var iconFeature = new ol.Feature({
		geometry: new ol.geom.Point([72.5800, 23.0300])
	});
	
	var vectorSource = new ol.source.Vector({
		features: [iconFeature]
	});
	
	var vectorLayer = new ol.layer.Vector({
		source: vectorSource
	});
	
	var map = new ol.Map({
		layers: [
			new ol.layer.Image({
				source: new ol.source.ImageStatic({
					url: 'server/floorplan/<?php echo $_POST["floorid"] . "." . $row[0]; ?>',
					projection: projection,
					imageExtent: extent
				}),
		      	opacity: 0.7
			}),
			vectorLayer
		],
		target: 'cont',
		view: new ol.View({
			projection: projection,
			center: ol.extent.getCenter(extent),
			zoom: 2
		})
	});
	
	function addzero(num)
	{
		var str = "";
		if(num < 10)
		{ str = "0" + num; }
		else
		{ str = num; }
		return str;
	}
	
	function togglepin(type)
	{
		<?php if($access1[0] == "1") { ?>
		if(type == 1)
		{
			point = map.on('click', function(evt) {
				long = evt.coordinate[0];
				lat = evt.coordinate[1];
				$("#xpos").val(long);
				$("#ypos").val(lat);
				$("#assignunit").modal("show");
			});
			$("#btnpinon").css("display", "none");
			$("#btnpinoff").css("display", "block");
			$("#txttoggle1").css("display", "none");
			$("#txttoggle2").css("display", "block");
		}
		else
		{
			ol.Observable.unByKey(point);
			$("#btnpinon").css("display", "block");
			$("#btnpinoff").css("display", "none");
			$("#txttoggle1").css("display", "block");
			$("#txttoggle2").css("display", "none");
		}
		<?php } else { ?>
		showmodal("alert", "You are not allowed to access this feature.", "", null, "", null, "1");
		<?php } ?>
	}
	
	$(function(){
		<?php
			if($_POST["unitid"] == "")
			{ ?> loadpoints("all"); <?php }
			else
			{ ?> loadpoints1("<?php echo $_POST["unitid"]; ?>"); <?php }
		?>
		loadpoints2();
		togglepin(0);
		$(".unitlist").niceScroll({ cursorcolor: "#666", cursorwidth: "8px" });
		
		$("#statlist label").each(function(){
			var obj = $(this);
			obj.find("input:checkbox").change(function(){
				var padding = "";
				$("#statlist input:checked").each(function(){
					padding += "|" + $(this).val();
				});
				loadpoints(padding);
			});
		});
	});
	
	function loadpoints1(unitid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + unitid + '&form=plotoneunit',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				var iconStyle = new ol.style.Style({
					image: new ol.style.Icon(({
						anchor: [0.5, 0.5],
						size: [150, 242],
						opacity: 1,
						scale: 0.16,
						src: "assets/images/pins/" + arr[2].replace(" ", "-") + ".png"
					}))
				});
				
				iconFeature.setStyle(iconStyle);
				
				var feature = new ol.Feature(new ol.geom.Point([parseFloat(arr[3]), parseFloat(arr[4])]));
				feature.setStyle(iconStyle);
				feature.setId(unitid);
				vectorSource.addFeature(feature);
				
				map.on('click', function(evt){
					var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer){
						addpointclick(feature.getId());
					});
				});
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function loadpoints(stats)
	{
		if(stats == "all")
		{
			$("#statlist label").each(function(){
				var obj = $(this);
				obj.find("input:checkbox").prop("checked", true);
			});
		}
		vectorSource.clear()
		var mydate = $("#txtjumpdate").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=<?php echo $_POST["floorid"]; ?>&stats=' + stats + '&mydate=' + mydate + '&form=loadpoints',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("#");
				for(var i=1; i<=arr.length-1; i++)
				{
					var arr2 = arr[i].split("|");
					
					var iconStyle = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.5, 0.5],
							size: [150, 242],
							opacity: 1,
							scale: 0.16,
							src: "assets/images/pins/" + arr2[3].replace(" ", "-") + ".png"
						}))
					});
					
					iconFeature.setStyle(iconStyle);
					
					var feature = new ol.Feature(new ol.geom.Point([parseFloat(arr2[4]), parseFloat(arr2[5])]));
					feature.setStyle(iconStyle);
					feature.setId(arr2[1]);
					vectorSource.addFeature(feature);
					
					if(i == arr.length-1)
					{
						map.on('click', function(evt){
							var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer){
								addpointclick(feature.getId());
							});
						});
					}
				}
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function addpointclick(unitid)
	{
		<?php if($access1[1] == "2") { ?>
		$("#txtunitid").val(unitid);
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + unitid + '&form=unitdetails',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				$("#lunitname").text(arr[1]);
				$("#lmall").text(arr[2]);
				$("#lwing").text(arr[3]);
				$("#lfloor").text(arr[4]);
				if(arr[5] == "1")
				{ $("#txtwater").addClass("btn-info icon-animated-vertical"); }
				else
				{ $("#txtwater").removeClass("btn-info icon-animated-vertical"); }
				if(arr[6] == "1")
				{ $("#txtelectric").addClass("btn-yellow icon-animated-vertical"); }
				else
				{ $("#txtelectric").removeClass("btn-yellow icon-animated-vertical"); }
				if(arr[7] == "1")
				{ $("#txtfile").addClass("btn-grey icon-animated-vertical"); }
				else
				{ $("#txtfile").removeClass("btn-grey icon-animated-vertical"); }
				$("#max").text(arr[8]);
				$("#rem").text(arr[9]);
				ctenantstat();
				unitstat();
				tenantstat();
				$("#viewunit").modal("show");
			}
		}).error(function() {
			alert(data);
		});
		<?php } else { ?>
		showmodal("alert", "You are not allowed to access this feature.", "", null, "", null, "0");
		<?php } ?>
	}
	
	function ctenantstat()
	{
		var unitid = $("#txtunitid").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + unitid + '&form=ctenantstat',
			beforeSend:function(){
			},
			success: function(data) {
				$("#ctenantlist").html(data);
				$("#rem").text(parseInt($("#max").text())-$("#ctenantlist li").length);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function unitstat()
	{
		var unitid = $("#txtunitid").val();
		var startdate = $("#txtstartdate1").val();
		var enddate = $("#txtenddate1").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + unitid + '&startdate=' + startdate + '&enddate=' + enddate + '&form=unitstat',
			beforeSend:function(){
			},
			success: function(data) {
				$("#unitstatlist").html(data);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function tenantstat(unitid)
	{
		var unitid = $("#txtunitid").val();
		var startdate = $("#txtstartdate2").val();
		var enddate = $("#txtenddate2").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + unitid + '&startdate=' + startdate + '&enddate=' + enddate + '&form=tenantstat',
			beforeSend:function(){
			},
			success: function(data) {
				$("#tenantstatlist").html(data);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function loadpoints2()
	{
		var padding = "";
		var padding2 = "";
		$(".ctr1").each(function(){
			padding += "|" + $(this).attr("id");
		});
		$(".ctr2").each(function(){
			padding2 += "|" + $(this).attr("id");
		});
		var mydate = $("#txtjumpdate").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=<?php echo $_POST["floorid"]; ?>&mydate=' + mydate + '&padding=' + padding + '&padding2=' + padding2 + '&form=loadpoints2',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				$("#vacant").text(arr[1]);
				$("#reserved").text(arr[2]);
				$("#occupied").text(arr[3]);
				$("#maintenance").text(arr[4]);
				$("#renewal").text(arr[5]);
				$("#for-eviction").text(arr[6]);
				$("#late-payment").text(arr[7]);
				$("#waterstat").text(arr[8]);
				$("#electricstat").text(arr[9]);
				$("#txtstat").text(arr[10]);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function showbills(type)
	{
		vectorSource.clear();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=<?php echo $_POST["floorid"]; ?>&type=' + type + '&form=getbills',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("#");
				for(var i=1; i<=arr.length-1; i++)
				{
					var arr2 = arr[i].split("|");
					
					var iconStyle = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.5, 0.5],
							size: [150, 242],
							opacity: 1,
							scale: 0.15,
							src: "assets/images/pins/" + type + ".png"
						}))
					});
					
					iconFeature.setStyle(iconStyle);
					
					var feature = new ol.Feature(new ol.geom.Point([parseFloat(arr2[3]), parseFloat(arr2[4])]));
					feature.setStyle(iconStyle);
					feature.setId(arr2[1]);
					vectorSource.addFeature(feature);
					
					if(i == arr.length-1)
					{
						map.on('click', function(evt){
							var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer){
								addpointclick(feature.getId());
							});
						});
					}
				}
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function changedate(type)
	{
		var arr = $("#txtjumpdate").val().split("/");
		var mydate = new Date(arr[2], parseInt(arr[0])-1, arr[1]);
		var adder = 24*60*60*1000;
		if(type == "prev")
		{ mydate = new Date(mydate.getTime() - adder); }
		else if(type == "next")
		{ mydate = new Date(mydate.getTime() + adder); }
		else
		{ mydate = new Date(); }
		$("#txtjumpdate").val(addzero(mydate.getMonth()+1) + "/" + addzero(mydate.getDate()) + "/" + mydate.getFullYear());
		loadpoints("all");
		loadpoints2();
		togglepin(0);
	}
</script>
<div class="page-content">
	<div class="row">
    	<div class="col-sm-3">
        	<h1 style="margin-top: 0px; margin-bottom: 15px;">SET - <b style="font-size: 24px;"><?php echo $_POST["floorname"]; ?></b></h1>
            <p style="font-size: 12px; font-weight: 300; color: #666; margin: 0px;" id="txttoggle1">Click here to toggle adding of units</h5>
            <p style="font-size: 12px; font-weight: 300; color: #666; margin: 0px; display: none;" id="txttoggle2">Click here to cancel adding of units</p>
            <button class="btn btn-success btn-sm" id="btnpinon" style="margin-top: 10px; display: block;" onclick="togglepin(1);"><span class="glyphicon glyphicon-road"></span>&nbsp;&nbsp;Add Unit</button>
            <button class="btn btn-light btn-sm" id="btnpinoff" style="margin-top: 10px; display: none;" onclick="togglepin(0);"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Cancel</button>
            <br>
            <div class="input-group">
                <input class="form-control" id="txtjumpdate" data-provide="datepicker" type="text" value="<?php if(isset($_POST["mydate"])) { echo date("m/d/Y", strtotime($_POST["mydate"])); } else { echo date("m/d/Y"); } ?>" readonly="readonly">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
            <div class="btn-group" style="margin: 10px; margin-left: 0px;">
                <button class="btn btn-primary btn-sm" onclick="changedate('prev');"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Prev</button>
                <button class="btn btn-primary btn-sm" onclick="changedate('today');">Current</button>
                <button class="btn btn-primary btn-sm" onclick="changedate('next');">Next&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
            </div>
            <div class="widget-box">
            	<div class="widget-header">
                	<h5>Filters</h5>
                </div>
                <?php
					function getstatnum($stat)
					{
						$sql = "select a.unitid, a.unitname, b.status, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.status = '" . $stat . "' and b.xdate = '" . date("Y-m-d") . "'";
						$num = mysql_num_rows(mysql_query($sql));
						return $num;
					}
				?>
                <div class="widget-body">
                	<div class="widget-main" id="statlist">
                        <label style="margin-left: 10px;">
                            <input name="txtunittype" type="checkbox" class="txtunittype ace" value="vacant" checked="checked">
                            <span class="lbl" style="font-size: 12px; color: #666;">&nbsp;&nbsp;Vacant</span>&nbsp;&nbsp;<span class="badge badge-light ctr1" id="vacant"><?php echo getstatnum('vacant'); ?></span>
                        </label><br>
                        <label style="margin-left: 10px;">
                            <input name="txtunittype" type="checkbox" class="txtunittype ace" value="reserved" checked="checked">
                            <span class="lbl" style="font-size: 12px; color: #666;">&nbsp;&nbsp;Reserved</span>&nbsp;&nbsp;<span class="badge badge-warning ctr1" id="reserved"><?php echo getstatnum('reserved'); ?></span>
                        </label><br>
                        <label style="margin-left: 10px;">
                            <input name="txtunittype" type="checkbox" class="txtunittype ace" value="occupied" checked="checked">
                            <span class="lbl" style="font-size: 12px; color: #666;">&nbsp;&nbsp;Occupied</span>&nbsp;&nbsp;<span class="badge badge-yellow ctr1" id="occupied"><?php echo getstatnum('occupied'); ?></span>
                        </label><br>
                        <label style="margin-left: 10px;">
                            <input name="txtunittype" type="checkbox" class="txtunittype ace" value="maintenance" checked="checked">
                            <span class="lbl" style="font-size: 12px; color: #666;">&nbsp;&nbsp;Maintenance</span>&nbsp;&nbsp;<span class="badge badge-purple ctr1" id="maintenance"><?php echo getstatnum('maintenance'); ?></span>
                        </label><br>
                        <label style="margin-left: 10px;">
                            <input name="txtunittype" type="checkbox" class="txtunittype ace" value="renewal" checked="checked">
                            <span class="lbl" style="font-size: 12px; color: #666;">&nbsp;&nbsp;Renewal</span>&nbsp;&nbsp;<span class="badge badge-info ctr1" id="renewal"><?php echo getstatnum('renewal'); ?></span>
                        </label><br>
                        <label style="margin-left: 10px;">
                            <input name="txtunittype" type="checkbox" class="txtunittype ace" value="for eviction" checked="checked">
                            <span class="lbl" style="font-size: 12px; color: #666;">&nbsp;&nbsp;For Eviction</span>&nbsp;&nbsp;<span class="badge badge-danger ctr1" id="for-eviction"><?php echo getstatnum('for eviction'); ?></span>
                        </label><br>
                        <label style="margin-left: 10px;">
                            <input name="txtunittype" type="checkbox" class="txtunittype ace" value="late payment" checked="checked">
                            <span class="lbl" style="font-size: 12px; color: #666;">&nbsp;&nbsp;Late Payment</span>&nbsp;&nbsp;<span class="badge badge-grey ctr1" id="late-payment"><?php echo getstatnum('late payment'); ?></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <?php
			function getbillsnum($stat)
			{
				$sql = "";
				if($stat == "electric")
				{ $sql = "select a.unitid, a.unitname, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.electricstat = '1' and b.xdate = '" . date("Y-m-d") . "'"; }
				elseif($stat == "water")
				{ $sql = "select a.unitid, a.unitname, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.waterstat = '1' and b.xdate = '" . date("Y-m-d") . "'"; }
				else
				{ $sql = "select a.unitid, a.unitname, a.xpos, a.ypos from tblref_unitplot as a LEFT JOIN tblunit_statuslogs as b ON a.unitid = b.unitid where a.floorid = '" . $_POST["floorid"] . "' and b.txtstat = '1' and b.xdate = '" . date("Y-m-d") . "'"; }
				$num = mysql_num_rows(mysql_query($sql));
				return $num;
			}
		?>
    	<div class="col-sm-9">
        	<div style="text-align: right;">
                <span class="label label-lg label-light arrowed-right" style="cursor: pointer; float: left;" onclick="loadpoints('all');"><span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;Load All Points</span>
                <span class="label label-lg label-info arrowed-right" style="cursor: pointer;" onclick="showbills('water');"><span class="glyphicon glyphicon-tint"></span>&nbsp;&nbsp;Water Bill&nbsp;&nbsp;<span class="badge badge-danger ctr2" id="waterstat"><?php echo getbillsnum('water'); ?></span></span>
                <span class="label label-lg label-yellow arrowed-right" style="cursor: pointer;" onclick="showbills('electric');"><span class="fa fa-bolt"></span>&nbsp;&nbsp;Electric Bill&nbsp;&nbsp;<span class="badge badge-danger ctr2" id="electricstat"><?php echo getbillsnum('electric'); ?></span></span>
                <span class="label label-lg label-grey arrowed-right" style="cursor: pointer;" onclick="showbills('txtfile');"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;txt.file&nbsp;&nbsp;<span class="badge badge-danger ctr2" id="txtstat"><?php echo getbillsnum('txtfile'); ?></span></span>
            </div>
            <div id="cont" style="margin-top: 20px; height: 460px; border: solid 1px #999;"></div>
        </div>
    </div>
</div>
<script>
	$(function(){
		loadunits();
		$("#txtsearchunit").keydown(function(event){
			var x = event.keyCode;
		    if (x == 13)
			{ loadunits(); }
		});
	});
	
	function loadunits()
	{
		var key = $("#txtsearchunit").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=<?php echo $_POST["floorid"]; ?>&key=' + key + '&form=loadunits',
			beforeSend:function(){
			},
			success: function(data) {
				$("#unitlist").html(data);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function addunit(unitid, unitname, status)
	{
		var xpos = $("#xpos").val();
		var ypos = $("#ypos").val();
		var mydate = $("#txtjumpdate").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + unitid + '&unitname=' + unitname + '&status=' + status + '&xpos=' + xpos + '&ypos=' + ypos + '&mydate=' + mydate + '&floorid=<?php echo $_POST["floorid"]; ?>&form=saveunitplot',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{
					var iconStyle = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.5, 0.5],
							size: [150, 242],
							opacity: 1,
							scale: 0.15,
							src: "assets/images/pins/" + status.replace(" ", "-") + ".png"
						}))
					});
					
					iconFeature.setStyle(iconStyle);
					
					var feature = new ol.Feature(new ol.geom.Point([xpos, ypos]));
					feature.setStyle(iconStyle);
					vectorSource.addFeature(feature);
					
					loadpoints("all");
					loadpoints2();
					togglepin(0);
					
					$("#unitlist").find("#" + unitid).remove();
					$("#assignunit").modal("hide");
				}
				else
				{ alert(arr[1]); }
			}
		}).error(function() {
			alert(data);
		});
	}
</script>
<div class="modal fade" role="dialog" id="assignunit">
	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assign Unit</h4>
			</div>
            <div class="modal-body">
            	<input type="hidden" id="xpos">
            	<input type="hidden" id="ypos">
                <span class="input-icon input-icon-right" style="margin: 10px;">
                    <input type="text" id="txtsearchunit" class="form-control input-large" onkeydown="searchunit(this.value);" placeholder="Search unit here...">
                    <i class="ace-icon glyphicon glyphicon-search" style="margin-top: 3px;"></i>
                </span>
                <br>
                <div style="height: 322px; margin-right: 10px;" class="unitlist">
                    <ul class="list-group" id="unitlist">
                    </ul>
                </div>
                <br>
            </div>
		</div>
	</div>
</div>
<script>
	function viewcalendar()
	{
		var unitid = $("#txtunitid").val();
		$("#viewunit").modal("hide");
		$("#div_main_cont").load("tenants/mcp.php", {"unitid": unitid});
		$("#links li").removeClass("active");
		$("#links li").eq(1).click(function(){
			$("#div_main_cont").load("tenants/floorplan2.php");
			$("#links li").eq(2).remove();
			$(this).addClass("active");
		});
		$("#links").append("<li class='active'><a href='#'>Calendar Schedules</a></li>");
	}
	
	function removemarker()
	{
		var conf = confirm("Remove marker for this unit?");
		if(conf == true)
		{
			var unitid = $("#txtunitid").val();
			$.ajax({
				type: 'POST',
				url: 'tenants/mcp_mainclass.php',
				data: 'unitid=' + unitid + '&form=deletepoint',
				beforeSend:function(){
				},
				success: function(data) {
					var arr = data.split("|");
					if(arr[1] == "1")
					{
						$("#viewunit").modal("hide");
						loadpoints("all");
						loadpoints2();
					}
				}
			}).error(function() {
				alert(data);
			});
		}
	}
</script>
<div class="modal fade" role="dialog" id="viewunit">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Unit Information</h4>
			</div>
            <div class="modal-body">
            	<input type="hidden" id="txtunitid">
                <div class="tabbable tabs-left">
                    <ul class="nav nav-tabs" id="myTab3">
                        <li class="active">
                            <a data-toggle="tab" href="#info1">
                                <i class="pink ace-icon fa fa-exclamation-circle bigger-110"></i>
                                Unit Information
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#info2">
                                <i class="ace-icon fa fa-home bigger-110"></i>
                                Unit History
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#info3">
                                <i class="blue ace-icon fa fa-users bigger-110"></i>
                                Tenant History
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="info1" class="tab-pane in active">
                        	<p style="font-size: 30px; font-weight: 400; color: #666; margin-left: 50px;" id="lunitname"></p>
                            <div class="row" style="margin-left: 40px;">
                                <div class="col-sm-2"><p style="color: #666;">Mall</p></div>
                                <div class="col-sm-8"><p style="font-weight: 400; color: #333;" id="lmall"></p></div>
                            </div>
                            <div class="row" style="margin-left: 40px;">
                                <div class="col-sm-2"><p style="color: #666;">Bldg./Wing</p></div>
                                <div class="col-sm-8"><p style="font-weight: 400; color: #333;" id="lwing"></p></div>
                            </div>
                            <div class="row" style="margin-left: 40px;">
                                <div class="col-sm-2"><p style="color: #666;">Floor</p></div>
                                <div class="col-sm-8"><p style="font-weight: 400; color: #333;" id="lfloor"></p></div>
                            </div>
                            <hr>
                            <div class="row">
                            	<div class="col-sm-6">
                                	<p style="font-size: 20px; font-weight: 400; color: #333; margin-left: 50px; margin-bottom: 0px;">Current Tenants</p>
                                    <p style="font-size: 13px; font-weight: 400; color: #666; margin-left: 50px; margin-top: 0px;"><?php echo date("F d, Y"); ?></p>
                                </div>
                            	<div class="col-sm-3">
                                	<p style="font-size: 13px; font-weight: 400; color: #666; margin-top: 5px; margin-bottom: 5px;">Maximum:</p>
                                    <p style="font-size: 20px; font-weight: 800; color: #333; margin-top: -10px;" id="max">0</p>
                                </div>
                            	<div class="col-sm-3">
                                	<p style="font-size: 13px; font-weight: 400; color: #666; margin-top: 5px; margin-bottom: 5px;">Remaining:</p>
                                    <p style="font-size: 20px; font-weight: 800; color: #333; margin-top: -10px;" id="rem">0</p>
                                </div>
                            </div>
                            <ul class="list-group" style="margin-left: 50px; margin-right: 20px;" id="ctenantlist">
                            </ul>
                            <hr>
                            <div class="row" style="margin-left: 40px;">
                                <div class="col-sm-3"><div class="btn btn-white" id="txtwater"><span class="glyphicon glyphicon-tint"></span>&nbsp;&nbsp;Water Bill</div></div>
                                <div class="col-sm-3"><div class="btn btn-white" id="txtelectric"><span class="fa fa-bolt bigger-110"></span>&nbsp;&nbsp;Electric Bill</div></div>
                                <div class="col-sm-3"><div class="btn btn-white" id="txtfile"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;Sales File</div></div>
							</div>
                            <br>
                        </div>
                        <div id="info2" class="tab-pane">
                        	<div class="row" style="margin-bottom: 5px;">
                            	<div class="col-sm-1" style="text-align: right;"><p style="margin-top: 6px;">From: </p></div>
                            	<div class="col-sm-3">
                                    <div class="input-group">
                                        <input class="form-control" type="text" data-provide="datepicker" id="txtstartdate1" placeholder="mm/dd/YYYY" onchange="unitstat();">
                                        <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                                    </div>
                                </div>
                            	<div class="col-sm-1" style="text-align: right;"><p style="margin-top: 6px;">To: </p></div>
                            	<div class="col-sm-3">
                                    <div class="input-group">
                                        <input class="form-control" type="text" data-provide="datepicker" id="txtenddate1" placeholder="mm/dd/YYYY" onchange="unitstat();">
                                        <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                	<tr>
                                    	<th style="width: 20%;">Date</th>
                                        <th style="width: 50%;">Unit Name</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 30%; border-right: solid 1px #dddddd;">Bills/Sales</th>
                                    </tr>
                                </thead>
                            </table>
                            <div style="height: 300px; margin-top: -20px; overflow-x: hidden; overflow-y: hidden;">
                                <table class="table table-bordered table-hover">
                                    <tbody id="unitstatlist">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="info3" class="tab-pane">
                        	<div class="row" style="margin-bottom: 5px;">
                            	<div class="col-sm-1" style="text-align: right;"><p style="margin-top: 6px;">From: </p></div>
                            	<div class="col-sm-3">
                                    <div class="input-group">
                                        <input class="form-control" type="text" data-provide="datepicker" id="txtstartdate2" placeholder="mm/dd/YYYY" onchange="tenantstat();">
                                        <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                                    </div>
                                </div>
                            	<div class="col-sm-1" style="text-align: right;"><p style="margin-top: 6px;">To: </p></div>
                            	<div class="col-sm-3">
                                    <div class="input-group">
                                        <input class="form-control" type="text" data-provide="datepicker" id="txtenddate2" placeholder="mm/dd/YYYY" onchange="tenantstat();">
                                        <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                	<tr>
                                    	<th style="width: 20%;">Date</th>
                                        <th style="width: 50%;">Tenant Name</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 30%; border-right: solid 1px #dddddd;">Bills/Sales</th>
                                    </tr>
                                </thead>
                            </table>
                            <div style="height: 300px; margin-top: -20px; overflow-x: hidden; overflow-y: hidden;">
                                <table class="table table-bordered table-hover">
                                    <tbody id="tenantstatlist">
                                        <tr>
                                            <td style="width: 20%;">Date</td>
                                            <td style="width: 50%;">Tenant Name</td>
                                            <td style="width: 20%;">Status</td>
                                            <td style="width: 30%;">Bills/Sales</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-info" onclick="viewcalendar();"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Calendar View</button>
                <?php if($access1[1] == "1") { ?>
                <button class="btn btn-danger" onclick="removemarker();"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove Marker</button>
                <?php } else { ?>
                <button class="btn btn-danger" onclick="showmodal('alert', 'You are not allowed to use this feature.', '', null, '', null, '1');"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove Marker</button>
                <?php } ?>
            </div>
		</div>
	</div>
</div>