<?php include("../connect.php"); ?>
<style>
	.overlay
	{
		position: absolute;
		background: #333;
		opacity: 0.3;
		z-index: 800;
		cursor: pointer;
		display: none;
	}
	
	.overlaytxt
	{
		font-size: 30px;
		font-weight: 400;
		color: #FFF;
		text-align: center;
		width: 100%;
		position: absolute;
		margin-top: 20px;
		z-index: 900;
		cursor: pointer;
		display: none;
	}
	
	.overlaybtn
	{
		font-size: 16px;
		font-weight: 400;
		color: #eeeeee;
		text-align: center;
		width: 100%;
		position: absolute;
		margin-top: 65px;
		z-index: 900;
		cursor: pointer;
		display: none;
	}
</style>
<script>
	var stat = false;
	var point;
	var totarea = 0;
	var areamin = 0;
	
	$(function(){
		<?php if(isset($_POST["mallid"])) { ?>
		$("#txtmall").val("<?php echo $_POST["mallid"]; ?>");
		loadwing("<?php echo $_POST["mallid"]; ?>")
		<?php } ?>
		$(".cont").niceScroll({ cursorcolor: "#666", cursorwidth: "8px" });
		$(".overlay").css("width", $(".cont").width());
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
	
	function loadwing(mallid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'mallid=' + mallid + '&form=loadwing',
			beforeSend:function(){
			},
			success: function(data) {
				$("#txtwing").html(data);
				<?php if(isset($_POST["wingid"])) { ?>
				$("#txtwing").val("<?php echo $_POST["wingid"]; ?>");
				loadfloor("<?php echo $_POST["wingid"]; ?>");
				<?php } ?>
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function loadfloor(wingid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'wingid=' + wingid + '&form=loadfloor',
			beforeSend:function(){
			},
			success: function(data) {
				$("#txtfloor").html(data);
				<?php if(isset($_POST["floorid"])) { ?>
				$("#txtfloor").val("<?php echo $_POST["floorid"]; ?>");
				getarea();
				<?php } ?>
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function getarea()
	{
		var floorid = $("#txtfloor").val();
		if(floorid == "")
		{
			$("#totarea").text("0");
			$("#totarea2").text("0");
			$("#txtminarea").text("0");
			$("#minarea").text("0");
		}
		else
		{
			$.ajax({
				type: 'POST',
				url: 'tenants/mcp_mainclass.php',
				data: 'floorid=' + floorid + '&form=getarea',
				beforeSend:function(){
				},
				success: function(data) {
					var arr = data.split("|");
					totarea = parseFloat(arr[1]) * parseFloat(arr[2]);
					$("#totarea").text(Number(totarea).toLocaleString());
					$("#totarea2").text(Number(totarea).toLocaleString());
					$("#cont").width(parseFloat(arr[1])*Math.sqrt(parseFloat(arr[3])));
					$("#cont").height(parseFloat(arr[2])*Math.sqrt(parseFloat(arr[3])));
					areamin = parseFloat(arr[3]);
					$("#txtminarea").text(areamin);
					$("#minarea").text(Number(arr[3]).toLocaleString());
					creategrid(parseFloat(arr[1]), parseFloat(arr[2]), parseFloat(arr[3]));
				}
			}).error(function() {
				alert(data);
			});
		}
	}
	
	function creategrid(width, height, minarea)
	{
		$("#cont").html("");
		var sec1 = width / Math.sqrt(minarea);
		var sec2 = height / Math.sqrt(minarea);
		var floorid = $("#txtfloor").val();
		var num = 0;
		var area = Math.sqrt(minarea) * 10; 
		for(var i=1; i<=Math.round(sec2); i++)
		{
			for(var j=1; j<=Math.round(sec1); j++)
			{ $("#cont").append("<div style='width: " + area + "px; height: " + area + "px; float: left; vertical-align: top; border: dashed 1px #CCC;' class='cell' id='" + j + "_" + i + "'></div>"); }
		}
		<?php if(!isset($_POST["unitid"])) { ?>
		getarea2();
		<?php } else { ?>
		getarea1("<?php echo $_POST["unitid"]; ?>");
		<?php } ?>
	}
	
	function addtenant()
	{
		if($("#cont").html() == "")
		{ showmodal("alert", "Please select a floor first.", "", null, "", null, "1"); }
		else
		{ $("#addtenant").modal("show"); }
	}
	
	function getcolor(stat)
	{
		var myclass = "";
		switch(stat)
		{
			case "vacant": myclass = "label-light"; break;
			case "reserved": myclass = "label-warning"; break;
			case "occupied": myclass = "label-yellow"; break;
			case "maintenance": myclass = "label-purple"; break;
			case "renewal": myclass = "label-info"; break;
			case "for eviction": myclass = "label-danger"; break;
			case "late payment": myclass = "label-grey"; break;
			default: myclass = "label-light";
		}
		return myclass;
	}
	
	function getarea1(unitid)
	{
		var mydate = $("#txtjumpdate").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'mydate=' + mydate + '&unitid=' + unitid + '&form=getarea1',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("!");
				var myclass = getcolor(arr[5]);
				var num = 0;
				var arr2 = arr[6].split("#");
				for(var x=1; x<=arr2.length-1; x++)
				{
					num++;
					$("#cont #" + arr2[x]).removeClass("cell");
					$("#cont #" + arr2[x]).addClass(myclass);
					$("#cont #" + arr2[x]).attr("onclick", "addpointclick('" + arr[1] + "')");
					if(x == 1)
					{
						$("#cont #" + arr2[x]).append("<div style='width: 100%; position: relative; color: #333; font-weight: 800; padding: 8px; font-size: 12px; cursor: pointer;' onclick='addpointclick(\"" + arr[1] + "\");'>" + arr[3] + "<p style='font-weight: 400; color: #666;'>" + arr[4] + " sqm.</p></div>");
					}
				}
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function getarea2()
	{
		var floorid = $("#txtfloor").val();
		var mydate = $("#txtjumpdate").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'floorid=' + floorid + '&mydate=' + mydate + '&form=getarea2',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("@");
				var totarea2 = 0;
				for(var i=1; i<=arr.length-1; i++)
				{
					var arr2 = arr[i].split("!");
					var myclass = getcolor(arr2[5]);
					var num = 0;
					var arr3 = arr2[6].split("#");
					for(var x=1; x<=arr3.length-1; x++)
					{
						num++;
						$("#cont #" + arr3[x]).removeClass("cell");
						$("#cont #" + arr3[x]).addClass(myclass);
						$("#cont #" + arr3[x]).attr("onclick", "addpointclick('" + arr2[1] + "')");
						if(x == 1)
						{
							$("#cont #" + arr3[x]).append("<div style='width: 100%; position: relative; color: #333; font-weight: 800; padding: 8px; font-size: 12px; cursor: pointer;' onclick='addpointclick(\"" + arr2[1] + "\");'>" + arr2[3] + "<p style='font-weight: 400; color: #666;'>" + arr2[4] + " sqm.</p></div>");
						}
					}
					totarea2 += parseFloat(arr2[4].replace(",", ""));
					if(i == arr.length-1)
					{ $("#totarea2").text(Number(totarea-totarea2).toLocaleString()); }
				}
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function addpointclick(unitid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + unitid + '&form=unitdetails2',
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
				$("#txtunitid").val(arr[8]);
				unitstat();
				tenantstat();
				$("#viewunit").modal("show");
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
	
	function cancelplot()
	{
		hideoverlay();
		$("#addtenantcont").css("display", "block");
		$("#tenantinfo").css("display", "none");
		$("#txtinquiryid").val("");
		$("#txttenantid").val("");
		$("#txttenantname").val("");
		$("#txttotarea").val("");
		$("#txtminarea").text("0 sqm.");
		$("#cont .cell").removeClass("btn-grey");
	}
	
	function checksaveplot()
	{
		var numchk = $("#cont .btn-grey").length;
		if(numchk == 0)
		{ showmodal("alert", "Please plot your occupancy first.", "", null, "", null, "1"); }
		else
		{
			var tot = parseFloat($("#selectbox2").text());
			if(tot > 0)
			{ showmodal("alert", "Please finish plotting your occupancy.", "", null, "", null, "1"); }
			else
			{ showmodal("confirm", "Finish plotting of occupancy?", "saveplot", null, "", null, "0"); }
		}
	}
	
	function saveplot()
	{
		var inquiryid = $("#txtinquiryid").val();
		var tenantid = $("#txttenantid").val();
		var tenantname = $("#txttenantname").val();
		var floorid = $("#txtfloor").val();
		var totalarea = $("#selectbox").text();
		var padding = "";
		$("#cont .btn-grey").each(function(){
			padding += "#" + $(this).attr("id");
		});
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'inquiryid=' + inquiryid + '&tenantid=' + tenantid + '&tenantname=' + tenantname + '&floorid=' + floorid + '&totalarea=' + totalarea + '&padding=' + padding + '&form=saveplot',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{
					showmodal("alert", arr[2], "", null, "", null, "0");
					getarea(floorid);
					cancelplot();
				}
				else
				{ showmodal("alert", arr[1], "", null, "", null, "1"); }
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
		getarea2();
	}
</script>
<div class="page-content">
    <div class="row">
    	<div class="col-sm-3">
        	<h1 style="margin-top: 0px; margin-bottom: 5px;">LCA</h1>
            <p style="margin-top: 0px; color: #666;">Leasable Common Area</p>
        	<div class="search-area well well-sm">
                <div class="search-filter-header bg-primary">
                    <h5 class="smaller no-margin-bottom">
                        <i class="ace-icon fa fa-sliders light-green bigger-130"></i>&nbsp; Select a floor to Setup LCA
                    </h5>
                </div>
                <div class="space-10"></div>
                <div>
                    <p style="margin-bottom: 4px; margin-left: 2px;">Choose Mall</p>
                    <select class="form-control" id="txtmall" onchange="loadwing(this.value);">
                    <?php
                        $getmall = "select mallid, mallname from tblref_mall";
                        $mallresult = mysql_query($getmall);
                        echo "<option value=''>Choose Mall</option>";
                        while($mall = mysql_fetch_array($mallresult))
                        { echo "<option value='" . $mall[0] . "'>" . $mall[1] . "</option>"; }
                    ?>
                    </select>
                    <div class="space-10"></div>
                    <p style="margin-bottom: 4px; margin-left: 2px;">Choose Building/Wing</p>
                    <select class="form-control" id="txtwing" onchange="loadfloor(this.value);">
                        <option value="">Choose Wing</option>
                    </select>
                    <div class="space-10"></div>
                    <p style="margin-bottom: 4px; margin-left: 2px;">Choose Floor</p>
                    <select class="form-control" id="txtfloor" onChange="getarea();">
                        <option value="">Choose Floor</option>
                    </select>
                </div>
            </div>
            <div class="row" style="border: solid 1px #dddddd; margin: 5px;">
            	<div class="col-sm-6"><h6>Total Area<br>(sqm.)</h6></div>
            	<div class="col-sm-6"><h5 style="font-size: 24px; font-weight: 800; text-align: right;" id="totarea">0</h5></div>
            </div>
            <div class="row" style="border: solid 1px #dddddd; margin: 5px;">
            	<div class="col-sm-6"><h6>Remaining Area<br>(sqm.)</h6></div>
            	<div class="col-sm-6"><h5 style="font-size: 24px; font-weight: 800; text-align: right;" id="totarea2">0</h5></div>
            </div>
            <div class="row" style="border: solid 1px #dddddd; margin: 5px;">
            	<div class="col-sm-6"><h6>Minimum Area<br>(sqm.)</h6></div>
            	<div class="col-sm-6"><h5 style="font-size: 24px; font-weight: 800; text-align: right;" id="minarea">0</h5></div>
            </div>
        </div>
    	<div class="col-sm-9">
        	<div style="margin: 5px; margin-top: 0px;">
                <div class="row">
                    <div class="col-sm-9">
                        <b class="text-primary">Legend:</b>&nbsp;&nbsp;
                        <span class="label label-lg label-light arrowed-right">Vacant</span>
                        <span class="label label-lg label-warning arrowed-right">Reserved</span>
                        <span class="label label-lg label-yellow arrowed-right">Occupied</span>
                        <span class="label label-lg label-purple arrowed-right">Maintenance</span>
                        <span class="label label-lg label-info arrowed-right">Renewal</span>
                        <span class="label label-lg label-danger arrowed-right">For Eviction</span>
                        <span class="label label-lg label-grey arrowed-right">Late Payment</span>
                    </div>
                    <div class="col-sm-3" style="text-align: right;">
                        <h6 style="color: #F00;">Click a cell to view details</h6>
                    </div>
                </div>
            </div>
            <div class="well well-sm">
            	<div class="row" id="addtenantcont">
                	<div class="col-sm-4">
            			<button class="btn btn-success btn-sm" onclick="addtenant();"><span class="glyphicon glyphicon-road"></span>&nbsp;&nbsp;Reservation List</button>
                    </div>
                	<div class="col-sm-4" style="text-align: center;">
                    	<div class="btn-group" style="margin-top: 3px;">
                        	<button class="btn btn-primary btn-sm" onclick="changedate('prev');"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Prev</button>
                        	<button class="btn btn-primary btn-sm" onclick="changedate('today');">Current</button>
                        	<button class="btn btn-primary btn-sm" onclick="changedate('next');">Next&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>
                    </div>
                	<div class="col-sm-4" style="text-align: right;">
                    	<div class="input-group">
                            <input class="form-control" id="txtjumpdate" data-provide="datepicker" type="text" value="<?php if(isset($_POST["mydate"])) { echo date("m/d/Y", strtotime($_POST["mydate"])); } else { echo date("m/d/Y"); } ?>" readonly="readonly">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row" id="tenantinfo" style="display: none;">
                	<div class="col-sm-4">
                    	<p style="margin: 0px; margin-left: 5px;">Tenant:</p>
                    	<h4 style="margin: 0px; margin-top: 5px; margin-left: 5px;" id="selecttenant"></h4>
					</div>
                	<div class="col-sm-4">
                    	<h6 style="margin: 0px; margin-top: 5px;">Total Area: <b id="selectbox">0</b> sqm.</h6>
                        <h6 style="margin: 0px; margin-top: 5px;">Remaining: <b id="selectbox2">0</b> sqm.</h6>
					</div>
                	<div class="col-sm-4" style="text-align: right;">
                    	<button class="btn btn-info btn-sm" style="margin-top: 3px;" onclick="checksaveplot();"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Submit</button>
                    	<button class="btn btn-light btn-sm" style="margin-top: 3px;" onclick="cancelplot();"><span class="fa fa-undo"></span>&nbsp;&nbsp;Cancel</button>
                    </div>
                </div>
            </div>
            <div class="cont" style="height: 420px; margin-top: -10px; overflow-x: auto; border: solid 1px #999;">
            	<div class="overlay" style="height: 420px;" onclick="hideoverlay();"></div>
                <h2 class="overlaytxt" onclick="hideoverlay();">Select your desired area</h2>
                <h2 class="overlaybtn" onclick="hideoverlay();"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Click here to start selecting boxes</h2>
        		<div id="cont"></div>
            </div>
        </div>
    </div>
</div>
<script>
	function selectbox()
	{
		$("#addtenantcont").css("display", "none");
		$("#tenantinfo").css("display", "block");
		$("#addtenant").modal("hide");
		$(".overlay").css("display", "block");
		$(".overlaytxt").css("display", "block");
		$(".overlaybtn").css("display", "block");
	}
	
	function hideoverlay()
	{
		$(".overlay").css("display", "none");
		$(".overlaytxt").css("display", "none");
		$(".overlaybtn").css("display", "none");
	}
</script>
<div class="modal fade" role="dialog" id="addtenant">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select from Reservation List</h4>
			</div>
            <div class="modal-body">
            	<div class="row">
                	<div class="col-sm-3"><p>Tenant:</p></div>
                    <div class="col-sm-8">
                    	<input type="hidden" id="txtinquiryid">
                    	<input type="hidden" id="txttenantid">
                    	<input type="text" class="form-control" id="txttenantname" onclick="$('#searchtenant').modal('show');">
					</div>
                </div>
                <div class="row" style="margin-top: 10px;">
                	<div class="col-sm-3"><p>Total Area:</p></div>
                	<div class="col-sm-4">
                    	<div class="input-group">
                    		<input type="text" class="form-control" id="txttotarea">
                            <span class="input-group-addon">sqm.</span>
                        </div>
					</div>
                </div>
                <div class="row" style="margin-top: 10px;	">
                	<div class="col-sm-3"><p>Minimum Area:</p></div>
                	<div class="col-sm-4"><p style="font-weight: 800;" id="txtminarea">0 sqm.</p></div>
				</div>
                <hr>
                <div class="row">
                	<div class="col-sm-8"><button class="btn btn-info" onclick="selectbox();"><span class="glyphicon glyphicon-road"></span>&nbsp;&nbsp;Setup LCA now</button></div>
                </div>
            </div>
		</div>
	</div>
</div>
<script>
	$(function(){
		loadtenants();
		$(".unitlist").niceScroll({ cursorcolor: "#666", cursorwidth: "8px" });
		$("#txttenantkey").keydown(function(e){
			var x = e.keyCode;
			if(x == 13)
			{ loadtenants(); }
		});
	});
	
	function loadtenants()
	{
		var key = $("#txttenantkey").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'key=' + key + '&form=loadtenants',
			beforeSend:function(){
			},
			success: function(data) {
				$("#tenantlist").html(data);
				addtenantclick();
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function addtenantclick()
	{
		$("#tenantlist tr").each(function(){
			var obj = $(this);
			obj.click(function(){
				$("#tenantlist tr").removeClass("active");
				obj.addClass("active");
				$("#txttenantid").val(obj.attr("id"));
				$("#txtinquiryid").val(obj.find("td").eq(0).text());
				$("#txttenantname").val(obj.find("td").eq(1).text());
				$("#selecttenant").text(obj.find("td").eq(1).text());
				$("#searchtenant").modal("hide");
				var width = obj.find("td").eq(2).text().replace(" sqm.", "");
				var length = obj.find("td").eq(3).text().replace(" sqm.", "");
				var tot = parseFloat(width) * parseFloat(length)
				$("#txttotarea").val(tot);
				$("#selectbox").text(tot);
				$("#selectbox2").text(tot);
				togglepin(1);
			});
		});
	}
	
	function togglepin(type)
	{
		if(type == 1)
		{
			point = $("#cont .cell").each(function(){
				var obj = $(this);
				obj.click(function(){
					var remain = parseFloat($("#selectbox2").text());
					if(obj.hasClass("btn-grey"))
					{
						obj.removeClass("btn-grey");
						var remained = remain + areamin;
						if(remained > parseInt($("#selectbox").text()))
						{ $("#selectbox2").text($("#selectbox").text()); }
						else
						{ $("#selectbox2").text(remained); }
					}
					else
					{
						if(remain > 0)
						{
							obj.addClass("btn-grey");
							var remained = remain - areamin;
							if(remained < 0)
							{ $("#selectbox2").text("0"); }
							else
							{ $("#selectbox2").text(remained); }
						}
						else if(remain == 0)
						{ showmodal("alert", "You have placed your total area to be plotted.", "", null, "", null, "0"); }
					}
				});
			});
		}
		else
		{ point = null; }
	}
</script>
<div class="modal fade" role="dialog" id="searchtenant">
	<div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Occupant</h4>
			</div>
            <div class="modal-body">
            	<div class="row">
                	<div class="col-sm-3"><p style="margin: 8px;">Search Here</p></div>
                    <div class="col-sm-8">
                    	<div class="input-group">
                            <input class="form-control input-mask-product" type="text" id="txttenantkey">
                            <span class="input-group-addon">
                                <i class="ace-icon glyphicon glyphicon-search" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <br>
            	<table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Inquiry ID</th>
                            <th style="width: 40%;">Trade Name</th>
                            <th style="width: 20%;">Width</th>
                            <th style="width: 20%; border-right: solid 1px #dddddd;">Length</th>
                        </tr>
                    </thead>
                </table>
                <div style="height: 316px; margin-top: -20px; overflow-x: hidden; overflow-y: hidden;" class="unitlist">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody id="tenantlist">
                        </tbody>
                    </table>
                </div>
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
			$("#div_main_cont").load("tenants/floorplan3.php");
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
                            <br>
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
                            <table class="table table-bordered table-striped table-hover">
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
                                <table class="table table-bordered table-striped table-hover">
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
            <!--<div class="modal-footer">
            	<button class="btn btn-info" onclick="viewcalendar();"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Calendar View</button>
                <button class="btn btn-danger" onclick="removemarker();"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove Marker</button>
            </div>-->
		</div>
	</div>
</div>