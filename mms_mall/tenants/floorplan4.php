<link href="assets/css/ol.css" rel="stylesheet" type="text/css">
<script src="assets/js/ol.js"></script>
<script src="assets/js/filesaver.min.js"></script>
<?php
	include("../connect.php");
	$getpic = "select ext, width, height from tblref_floorsetup where floorid = '" . $_POST["floorid"] . "'";
	$pic = mysql_fetch_array(mysql_query($getpic));
?>
<script>
	var draw;
	var modify;
	var selection;
	var num = 0;
	var featured = "";
	var features = new ol.Collection();
	var source = new ol.source.Vector({features: features});
	var added;
	
	$(function(){
		$(window).keydown(function(event){
			var x = event.keyCode;
			if(x == 27)
			{ addselect(); }
		});
	});
	
	var raster = new ol.layer.Tile({
		source: new ol.source.OSM()
	});
	
	var stroke = new ol.style.Style({
		stroke: new ol.style.Stroke({
			color: '#333',
			width: 1.5,
			lineCap: 'butt',
			lineDash: [5, 5]
		})
	});
		
	function textstyle(myname) {
		var text = new ol.style.Style({
			text: new ol.style.Text({
				font: '9px Roboto',
				fill: new ol.style.Fill({ color: '#000' }),
				offsetY: "10",
				stroke: new ol.style.Stroke({
					color: '#000',
					width: 0.5
				}),
				text: myname
			})
		});
		return text;
	}
	
	function fillstyle(status)
	{
		var fillcolor = "";
		switch(status)
		{
			case "vacant": fillcolor = "rgba(231,231,231, 0.6)"; break;
			case "reserved": fillcolor = "rgba(248,148,6, 0.6)"; break;
			case "occupied": fillcolor = "rgba(254,225,136, 0.6)"; break;
			case "maintenance": fillcolor = "rgba(149,133,191, 0.6)"; break;
			case "renewal": fillcolor = "rgba(58,135,173, 0.6)"; break;
			case "for eviction": fillcolor = "rgba(209,91,71, 0.6)"; break;
			case "late payment": fillcolor = "rgba(160,160,160, 0.6)"; break;
			default: fillcolor = "rgba(231,231,231, 0.6)";
		}
		var mystyle = new ol.style.Style({
			fill: new ol.style.Fill({
				color: fillcolor
			})
		});
		return mystyle;
	}

	var vector = new ol.layer.Vector({
		source: source
	});
	  
	var extent = [0, 0, <?php echo $pic[1]; ?>, <?php echo $pic[2]; ?>];
	var projection = new ol.proj.Projection({
		code: 'xkcd-image',
		units: 'pixels',
		extent: extent
	});

	var map = new ol.Map({
		layers: [
			new ol.layer.Image({
			source: new ol.source.ImageStatic({
				attributions: '',
			  	url: 'server/floorplan/<?php echo $_POST["floorid"]; ?>.<?php echo $pic[0]; ?>',
			  	projection: projection,
			  	imageExtent: extent
			}),
			opacity: 0.8
		  }),
		  vector
		],
		target: 'showcanvas',
		view: new ol.View({
			projection: projection,
		  	center: ol.extent.getCenter(extent),
		  	zoom: 2,
		  	maxZoom: 4
		})
	});
	
	loadpoints();
	
	function loadpoints()
	{
		source.clear(true);
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=<?php echo $_POST["floorid"]; ?>&type=SET&form=loadpoints3',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("#");
				for(var i=1; i<=arr.length-1; i++)
				{
					var arr2 = arr[i].split("|");
					var thing = new ol.geom.Polygon(JSON.parse(arr2[6]));
					var featurething = new ol.Feature({
						geometry: thing
					});
					featurething.setId(arr2[1]);
					featurething.set("name", arr2[2]);
					featurething.setStyle([fillstyle(arr2[3]), stroke, textstyle(arr2[2])]);
					source.addFeature(featurething);
					
					// Sample marker
					var aa = featurething.getGeometry().getExtent();
					var oo = ol.extent.getCenter(aa);
					var iconStyle = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.5, 1],
							size: [150, 150],
							opacity: 1,
							scale: 0.4,
							src: "server/company/" + arr2[4] + "/trades/" + arr2[5] + "/thumb.png"
						}))
					});
					var mfeature = new ol.Feature(new ol.geom.Point([parseFloat(oo[0]), parseFloat(oo[1])]));
					mfeature.setId("M-" + arr2[1]);
					mfeature.set("name", arr2[2]);
					mfeature.setStyle(iconStyle);
					source.addFeature(mfeature);
				}
			}
		}).error(function() {
			alert(data);
		});
	}
	
	vector.setMap(map);
	
	addselect();
	
	function addmodify()
	{
		modify = new ol.interaction.Modify({
			features: features,
			deleteCondition: function(event){
				return ol.events.condition.shiftKeyOnly(event) &&
				ol.events.condition.singleClick(event);
			}
		});
		
		modify.on('modifyend', function(event){
			var features = event.features.getArray();
			for(var i=0; i<features.length; i++)
			{
				var rev = features[i].getRevision();
				var id = features[i].getId();
				var name = features[i].get("name");
				if(rev != 3)
				{
					added = features[i];
					updateunit(id, name);
				}
			}
			map.removeInteraction(modify);
			map.addInteraction(selection);
		});
		
		map.addInteraction(modify);
	}

	function adddraw(){
		draw = new ol.interaction.Draw({
			features: features,
			type: ("Polygon")
		});
		
		draw.on('drawend', function(event){
			var coord = event.feature.getGeometry().getCoordinates();
			added = event.feature;
			$("#txtcoord").val(JSON.stringify(coord));
			$("#assignunit").modal("show");
			addselect();
		});
		
		map.addInteraction(draw);
	}
	
	function addselect()
	{
		map.removeInteraction(draw);
		map.removeInteraction(modify);
		selection = new ol.interaction.Select({
			condition: ol.events.condition.click
		});
		
		selection.on('select', function(evt){
			var selected = evt.selected;
			var deselected = evt.deselected;
			
			if(selected.length)
			{
				selected.forEach(function(feature){
					if(feature.getId().toString() != "undefined")
					{
						selected = feature.getId().replace("M-", "");
						$("#txtselected").html("Selected Unit&nbsp;&nbsp;:&nbsp;&nbsp;<b>" + feature.get("name") + "</b>");
						featured = feature;
						addpointclick(selected);
					}
				});
			}
		});
		$("#txtplace").css("display", "none");
		$("#txtselected").css("display", "block");
		
		map.addInteraction(selection);
	}
	
	function initdraw()
	{
		map.removeInteraction(selection);
		adddraw();
		$("#txtplace").css("display", "block");
		$("#txtselected").css("display", "none");
	}
	
	function initmodify()
	{
		map.removeInteraction(selection);
		addmodify();
		$("#txtplace").css("display", "block");
		$("#txtselected").css("display", "none");
	}
	
	function removeunit()
	{ showmodal("confirm", "Remove unit?", "removeunit1", null, "", null, "0"); }
	
	function removeunit1()
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + featured.getId().replace("M-", "") + '&form=removeunit3',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{
					removeunit3(featured.getId().replace("M-", ""));
					loadunits();
					loadpoints();
					$("#viewunit").modal("hide");
				}
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function removeunit2()
	{ vector.getSource().removeFeature(added); }
	
	function removeunit3(unitid)
	{
		var features = source.getFeatures();
		if(features != null && features.length > 0)
		{
			for(x in features)
			{
				var id = features[x].getId().replace("M-", "");
				if(id == unitid)
				{
					vector.getSource().removeFeature(features[x]);
					break;
				}
			}
		}
		map.removeInteraction(selection);
		addselect();
	}
	
	document.getElementById('export-png').addEventListener('click', function() {
		map.once('postcompose', function(event){
			var canvas = event.context.canvas;
			if(navigator.msSaveBlob)
			{ navigator.msSaveBlob(canvas.msToBlob(), 'map.png'); }
			else
			{
				canvas.toBlob(function(blob){
					saveAs(blob, 'map.png');
				});
		  	}
		});
		map.renderSync();
	});
	
	function addpointclick(unitid)
	{
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
				//$("#max").text(arr[8]);
				//$("#rem").text(arr[9]);
				$("#imgthumb").attr("src", "server/company/" + arr[10] + "/trades/" + arr[11] + "/thumb.png");
				if(arr[10] == "")
				{ $("#imgthumb").css("border", "0px"); }
				else
				{ $("#imgthumb").css("border", "solid 2px #dddddd"); }
				ctenantstat();
				unitstat();
				tenantstat();
				$("#viewunit").modal("show");
			}
		}).error(function() {
			alert(data);
		});
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
</script>
<div class="page-content">
	<div class="row">
    	<div class="col-sm-2" id="div_left">
            <h1 style="font-size: 20px; color: #666; font-weight: 400; margin-top: 0px;">
            	Floor Plan<br>
                <small><?php echo $_POST["floorname"]; ?></small>
            </h1>
            <hr>
        	<div>
            	<h4 class="text-primary">Legend:</h4>
                <span class="label label-lg label-light arrowed-right" style="display: block; margin-bottom: 5px;">Vacant</span>
                <span class="label label-lg label-warning arrowed-right" style="display: block; margin-bottom: 5px;">Reserved</span>
                <span class="label label-lg label-yellow arrowed-right" style="display: block; margin-bottom: 5px;">Occupied</span>
                <span class="label label-lg label-purple arrowed-right" style="display: block; margin-bottom: 5px;">Maintenance</span>
                <span class="label label-lg label-info arrowed-right" style="display: block; margin-bottom: 5px;">Renewal</span>
                <span class="label label-lg label-danger arrowed-right" style="display: block; margin-bottom: 5px;">For Eviction</span>
                <span class="label label-lg label-grey arrowed-right" style="display: block;">Late Payment</span>
            </div>
            <br>
            <button class="btn btn-info btn-sm" id="show" onclick="$('#instructions').modal('show');"><span class="fa fa-navicon"></span>&nbsp;&nbsp;Show Instructions</button>
        </div>
        <div class="col-sm-10" style="text-align: center;" id="div_right">
        	<div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <h5 class="label label-xlg label-grey arrowed-in-right arrowed-in" id="txtplace">Place the unit now.</h5>
                    <h5 class="label label-xlg label-info arrowed-in-right arrowed-in" id="txtselected">Select a Unit</h5>
                </div>
                <div class="col-sm-3"></div>
            </div>
            <div style="border: solid 1px #999; padding: 5px; margin-bottom: 10px;"><div id="showcanvas" style="height: 400px;"></div></div>
            <button class="btn btn-grey btn-sm" onclick="initdraw();"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Add/Place Unit</button>
            <button class="btn btn-info btn-sm" onclick="initmodify();"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Modify Unit</button>
            <button id="export-png" class="btn btn-success btn-sm"><i class="fa fa-download"></i>&nbsp;&nbsp;Download PNG</button>
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="instructions">
	<div class="modal-dialog modal-sm">
    	<div class="modal-content">
        	<div class="modal-header" style="background: #3A87AD !important;">
            	<button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #FFF;">Instructions</h4>
			</div>
            <div class="modal-body">
            	<div class="widget-box transparent">
                    <div class="widget-header">
                        <h4 class="widget-title lighter">
                            Instructions
                        </h4>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main padding-6 no-padding-left no-padding-right">
                            <ul>
                                <li>
                                    To add a unit:
                                    <ol>
                                        <li>Click '<span style="color: #06F;">Add/Place Unit</span>' button.</li>
                                        <li>Draw the unit coordinates.</li>
                                        <li>Select a unit from the list.</li>
                                    </ol>
                                </li>
                                <li>
                                    To modify unit coordinates:
                                    <ol>
                                        <li>Click '<span style="color: #06F;">Modify Unit</span>' button.</li>
                                        <li>Click and drag a part of the unit coordinates to change position or add vertices.</li>
                                        <li>Press '<span style="color: #06F;">Esc</span>' key to finish modifying.</li>
                                    </ol>
                                </li>
                                <li>Press '<span style="color: #06F;">Esc</span>' key to cancel current action.</li>
                                <li>
                                    To remove a unit:
                                    <ol>
                                        <li>Highlight a unit.</li>
                                        <li>Click '<span style="color: #F00;">Remove Unit</span>' button.</li>
                                    </ol>
                                </li>
                                <li>You can download a copy of your floorplan by clicking '<span style="color: #960;">Download</span>' button.</li>
                            </ul>
                        </div>
					</div>
                </div>
            </div>
		</div>
	</div>
</div>
<script>
	$(function(){
		$(".unitlist").niceScroll({ cursorcolor: "#666", cursorwidth: "8px" });
		loadunits();
	});
	
	function loadunits()
	{
		var key = $("#txtsearchunit").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=<?php echo $_POST["floorid"]; ?>&key=' + key + '&type=SET&form=loadunits2',
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
		var coord = $("#txtcoord").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=<?php echo $_POST["floorid"]; ?>&unitid=' + unitid + '&unitname=' + unitname + '&status=' + status + '&coord=' + coord + '&type=SET&form=saveplot3',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{
					showmodal("alert", "Unit has been plotted.", "", null, "", null, "0");
					loadunits();
					loadpoints();
					$("#assignunit").modal("hide");
				}
				else
				{ alert(arr[1]); }
				
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function updateunit(unitid)
	{
		var coord = JSON.stringify(added.getGeometry().getCoordinates());
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + unitid + '&coord=' + coord + '&form=saveplot3',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{
					showmodal("alert", "Unit has been modified.", "", null, "", null, "0");
					loadunits();
					loadpoints();
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
        	<div class="modal-header" style="background: #3A87AD !important;">
            	<button type="button" class="close" data-dismiss="modal" onclick="removeunit2();">&times;</button>
                <h4 class="modal-title" style="color: #FFF;">Assign Unit</h4>
			</div>
            <div class="modal-body">
            	<input type="hidden" id="txtcoord">
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
                        	<div class="row">
                            	<div class="col-sm-8">
                                	<p style="font-size: 30px; font-weight: 400; color: #666; margin-left: 50px;" id="lunitname"></p>
                                    <div class="row" style="margin-left: 40px;">
                                        <div class="col-sm-2"><p style="color: #666;">Property</p></div>
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
                                </div>
                            	<div class="col-sm-4"><img src="#" id="imgthumb"></div>
                            </div>
                            <hr>
                            <div class="row">
                            	<div class="col-sm-6">
                                	<p style="font-size: 20px; font-weight: 400; color: #333; margin-left: 50px; margin-bottom: 0px;">Current Tenants</p>
                                    <p style="font-size: 13px; font-weight: 400; color: #666; margin-left: 50px; margin-top: 0px;"><?php echo date("F d, Y"); ?></p>
                                </div>
                            	<!--<div class="col-sm-3">
                                	<p style="font-size: 13px; font-weight: 400; color: #666; margin-top: 5px; margin-bottom: 5px;">Maximum:</p>
                                    <p style="font-size: 20px; font-weight: 800; color: #333; margin-top: -10px;" id="max">0</p>
                                </div>
                            	<div class="col-sm-3">
                                	<p style="font-size: 13px; font-weight: 400; color: #666; margin-top: 5px; margin-bottom: 5px;">Remaining:</p>
                                    <p style="font-size: 20px; font-weight: 800; color: #333; margin-top: -10px;" id="rem">0</p>
                                </div>-->
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
                                    	<th style="width: 15%;">Date</th>
                                        <th style="width: 40%;">Unit Name</th>
                                        <th style="width: 15%;">Status</th>
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
                                    	<th style="width: 15%;">Date</th>
                                        <th style="width: 40%;">Tenant Name</th>
                                        <th style="width: 15%;">Status</th>
                                        <th style="width: 30%; border-right: solid 1px #dddddd;">Bills/Sales</th>
                                    </tr>
                                </thead>
                            </table>
                            <div style="height: 300px; margin-top: -20px; overflow-x: hidden; overflow-y: hidden;">
                                <table class="table table-bordered table-hover">
                                    <tbody id="tenantstatlist"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
            <div class="modal-footer">
            	<button class="btn btn-info" onclick="viewcalendar();"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Calendar View</button>
                <button class="btn btn-danger" onclick="removeunit();"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove Unit</button>
            </div>
		</div>
	</div>
</div>