<?php
	include("../connect.php");
	$weeks = array("", "MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN");
	$months = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
?>
<style>
	
	.ellipsis
	{
		width: 90%;
		text-overflow: ellipsis;
		overflow: hidden;
		white-space: nowrap;
		display: block;
		margin-bottom: 10px;
	}
</style>
<script>
	var unitnum = $("#unitlist td").length;
	var active = "week";
	var units = "";
	var loopcells;
	var totalcells = 0;
	var num = 0;
	
	$(function(){
		$("#unitlist tr").each(function(){
			units += "|" + $(this).attr("id");
		});
		weeknav("today");
		$(".unitlist").niceScroll({ cursorcolor: "#666", cursorwidth: "8px" });
		$(".tenants").niceScroll({ cursorcolor: "#666", cursorwidth: "8px" });
		$("#unitlist0").on('scroll', function () {
			$("#unitlist1").scrollTop($(this).scrollTop());
			$("#unitlist2").scrollTop($(this).scrollTop());
			$("#unitlist3").scrollTop($(this).scrollTop());
		});
		$("#viewlist label").each(function(){
			var obj = $(this);
			obj.click(function(){
				$("#viewlist label").removeClass("btn-success");
				$("#viewlist label").addClass("btn-grey");
				obj.removeClass("btn-grey");
				obj.addClass("btn-success");
				$("#viewlist label").removeClass("active");
				obj.addClass("active");
				$(".views").css("display", "none");
				$("#" + obj.attr("id") + "view").css("display", "block");
				$(".pull-right .btn-group").css("display", "none");
				$("#btn-" + obj.attr("id")).css("display", "block");
				clearInterval(loopcells);
				if(obj.attr("id") == "week")
				{
					active = "week";
					weeknav("today");
				}
				else if(obj.attr("id") == "month")
				{
					active = "month";
					monthnav("today");
				}
				else
				{
					active = "year";
					yearnav("today");
				}
			});
		});
	});
	
	function addzero(n)
	{
		var str = "";
		if(n < 10)
		{ str = "0" + n; }
		else
		{ str = n; }
		return str;
	}
	
	function weeknav(str)
	{
		var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		var weeks = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
		var datelist = "";
		var datelist1 = "";
		var datelist2 = "";
		var mydate = new Date();
		var dpadding1 = "";
		var dpadding2 = "";
		var adder = 24*60*60*1000;
		var multiplier = parseInt($("#txtcnt").val());
		if(str == "prev")
		{
			multiplier = multiplier - 1;
			mydate = new Date(mydate.getTime() + (7*multiplier) * adder);
		}
		else if(str == "next")
		{
			multiplier = multiplier + 1;
			mydate = new Date(mydate.getTime() + (7*multiplier) * adder);
		}
		else
		{ mydate = new Date(); }
		var dayofweek = mydate.getDay()
		for(var i=1; i<=6-dayofweek; i++)
		{
			var mydate2 = new Date(mydate.getTime() + i * adder);
			datelist2 += "|" + mydate2.getFullYear() + "-" + addzero(mydate2.getMonth()+1) + "-" + addzero(mydate2.getDate());
			dpadding1 += "<th width='140px' valign='top' style='height: 60px;'><h3 style='margin: 0px;'>" + weeks[mydate2.getDay()] + " <small style='display: block; font-size: 13px; margin-top: 5px;'>" + months[mydate2.getMonth()] + " " + mydate2.getDate() + "</small></h3></th>";
		}
		for(var j=dayofweek; j>=1; j--)
		{
			var mydate2 = new Date(mydate.getTime() - j * adder);
			datelist1 += "|" + mydate2.getFullYear() + "-" + addzero(mydate2.getMonth()+1) + "-" + addzero(mydate2.getDate());
			dpadding2 += "<th width='140px' valign='top' style='height: 60px;'><h3 style='margin: 0px;'>" + weeks[mydate2.getDay()] + " <small style='display: block; font-size: 13px; margin-top: 5px;'>" + months[mydate2.getMonth()] + " " + mydate2.getDate() + "</small></h3></th>";
		}
		datelist = datelist1 + "|" + mydate.getFullYear() + "-" + addzero(mydate.getMonth()+1) + "-" + addzero(mydate.getDate()) + datelist2;
		$("#weekcont1").html("<tr>" + dpadding2 + "<th width='140px' valign='top' style='height: 60px;'><h3 style='margin: 0px;'>" + weeks[mydate.getDay()] + " <small style='display: block; font-size: 13px; margin-top: 5px;'>" + months[mydate.getMonth()] + " " + mydate.getDate() + "</small></h3></th>" + dpadding1 + "</tr>");
		$("#weekcont2").html("");
		
		var arr = units.split("|");
		for(var x=1; x<=unitnum; x++)
		{
			var arr2 = datelist.split("|");
			var padding2 = "";
			for(var y=1; y<=7; y++)
			{ padding2 += "<td width='140px' style='height: 100px;' id='" + arr[x] + "_" + arr2[y] + "'><div class='bills'></div></td>"; }
			$("#weekcont2").append("<tr>" + padding2 + "</tr>");
		}
		$("#txtcnt").val(multiplier);
		//addcellclick("#weekcont2");
		loaddetails("#weekcont2", "1");
	}
	
	function monthnav(str)
	{
		var month = parseInt($("#txtmonth").val());
		var year = parseInt($("#txtyear").val());
		var datelist = "";
		if(str == "prev")
		{
			month = month - 1;
			if(month == -1)
			{
				year = year - 1;
				month = 11;
			}
		}
		else if(str == "next")
		{
			month = month + 1;
			if(month == 12)
			{
				year = year + 1;
				month = 0;
			}
		}
		else
		{
			month = <?php echo date("m")-1; ?>;
			year = <?php echo date("Y"); ?>;
		}
		$("#txtmonth").val(month);
		$("#txtyear").val(year);
		var totalfeb;
		if(month == 1)
		{  
			if((year%100!=0) && (year%4==0) || (year%400==0))
			{ totalfeb = 29; }
			else
			{ totalfeb = 28; }
		}
		var totaldays = [31, totalfeb, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var weeks = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
		var padding = "";
		for(var i=1; i<=totaldays[month]; i++)
		{
			var mydate = new Date(year, month, i);
			datelist += "|" + mydate.getFullYear() + "-" + addzero(mydate.getMonth()+1) + "-" + addzero(mydate.getDate());
			padding += "<th width='160px' valign='top' style='height: 60px;'><h3 style='margin: 0px;'>" + weeks[mydate.getDay()] + " <small style='display: block; font-size: 13px; margin-top: 5px;'>" + months[month] + " " + i + ", " + year + "</small></h3></th>";
		}
		$("#monthcont1").html("<tr>" + padding + "</tr>");
		$("#monthcont2").html("");
		$("#unitlist2").width(totaldays[month]*160);
		$("#monthcont0_1").width(totaldays[month]*160);
		$("#monthcont0_2").width(totaldays[month]*160);
		var arr = units.split("|");
		for(var x=1; x<=unitnum; x++)
		{
			var padding2 = "";
			var arr2 = datelist.split("|");
			for(var y=1; y<=totaldays[month]; y++)
			{ padding2 += "<td width='160px' valign='top' style='height: 100px;' id='" + arr[x] + "_" + arr2[y] + "'><div class='bills'></div></td>"; }
			$("#monthcont2").append("<tr>" + padding2 + "</tr>");
		}
		//addcellclick("#monthcont2");
		loaddetails("#monthcont2", "1");
	}
	
	function yearnav(str)
	{
		var months = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		var year = parseInt($("#txtyear2").val());
		if(str == "prev")
		{ year = year - 1; }
		else if(str == "next")
		{ year = year + 1; }
		else
		{ year = <?php echo date("Y"); ?>; }
		$("#txtyear2").val(year);
		$("#yearcont1").html("");
		var padding = "";
		for(var i=1; i<=12; i++)
		{ padding += "<th width='200px' valign='top' style='height: 60px;'><h3 style='margin: 0px;'>" + months[i] + " <small style='display: block; font-size: 12px; margin-top: 5px;'>" + year + "</small></h3></th>"; }
		$("#yearcont1").html("<tr>" + padding + "</tr>");
		$("#yearcont2").html("");
		var arr = units.split("|");
		for(var x=1; x<=unitnum; x++)
		{
			var padding2 = "";
			for(var y=1; y<=12; y++)
			{ padding2 += "<td width='160px' valign='top' style='height: 100px;' id='" + arr[x] + "_" + y + "-" + year + "'><div class='tenants' style='height: 80px;'></div></td>"; }
			$("#yearcont2").append("<tr>" + padding2 + "</tr>");
		}
		//addcellclick("#yearcont2");
		loaddetails("#yearcont2", "0");
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
	
	function loaddetails(cont, type)
	{
		num = 0;
		totalcells = $(cont).find("td").length;
		loopcells = setInterval(function(){
			if(type == "1")
			{ loaddetails2($(cont).find("td").eq(num).attr("id"), cont); }
			else
			{ loaddetails3($(cont).find("td").eq(num).attr("id"), cont); }
			if(num == totalcells)
			{ clearInterval(loopcells); }
			else
			{ num++; }
		}, 500);
	}
	
	function loaddetails2(id, cont)
	{
		var obj = $(cont).find("#" + id);
		var arrc = id.split("_");
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + arrc[0] + '&mydate=' + arrc[1] + '&form=getdetails',
			beforeSend:function(){
				obj.find(".bills").html("<img class='myspinner' src='assets/images/spinner.gif'>");
			},
			success: function(data) {
				obj.find(".bills").find(".myspinner").remove();
				var arr = data.split("|");
				obj.addClass(getcolor(arr[6]));
				if(arr[1] != "")
				{ obj.find(".bills").append("<a class='ellipsis' href='#' onclick='viewtenantdetails(\"" + arr[1] + "\", \"" + arrc[0] + "\");'>" + arr[2] + "</a>"); }
				if(arr[3] == "1")
				{ obj.find(".bills").append("<span class='btn btn-yellow btn-xs' style='margin: 2px;'>&nbsp;<i class='ace-icon fa fa-bolt bigger-110 icon-only'></i>&nbsp;</span>"); }
				if(arr[4] == "1")
				{ obj.find(".bills").append("<span class='btn btn-info btn-xs' style='margin: 2px;'><i class='ace-icon glyphicon glyphicon-tint bigger-110 icon-only'></i></span>"); }
				if(arr[5] == "1")
				{ obj.find(".bills").append("<span class='btn btn-grey btn-xs' style='margin: 2px;'><i class='ace-icon glyphicon glyphicon-file bigger-110 icon-only'></i></span>"); }
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function loaddetails3(id, cont)
	{
		var obj = $(cont).find("#" + id);
		var arrc = id.split("_");
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'unitid=' + arrc[0] + '&mydate=' + arrc[1] + '&form=getdetails2',
			beforeSend:function(){
				obj.find(".tenants").html("<img class='myspinner' src='assets/images/spinner.gif'>");
			},
			success: function(data) {
				obj.find(".tenants").find(".myspinner").remove();
				var arr = data.split("#");
				for(var i=1; i<=arr.length-1; i++)
				{
					var arr2 = arr[i].split("|");
					if(arr2[1] != "")
					{ obj.find(".tenants").append("<button class='btn btn-xs btn-primary'>" + arr2[2] + "&nbsp;&nbsp;<span class='glyphicon glyphicon-menu-hamburger' onclick='viewtenantdetails(\"" + arr2[1] + "\", \"" + arrc[0] + "\");' style='cursor: pointer;'></span></button>"); }
				}
			}
		}).error(function() {
			alert(data);
		});
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
				loadfloor($("#txtwing option:first-child").val());
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
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function filterunit()
	{
		var mallid = $("#txtmall").val();
		var wingid = $("#txtwing").val();
		var floorid = $("#txtfloor").val();
		var type = "";
		$(".txtunittype").each(function(){
			if($(this).is(":checked") == true)
			{ type = $(this).val(); }
		});
		var key = $("#txtsearchunit").val();
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'mallid=' + mallid + '&wingid=' + wingid + '&floorid=' + floorid + '&type=' + type + '&key=' + key + '&form=filterunit',
			beforeSend:function(){
			},
			success: function(data) {
				$("#unitlist").html(data);
				unitnum = $("#unitlist td").length;
				units = "";
				$("#unitlist tr").each(function(){
					units += "|" + $(this).attr("id");
				});
				clearInterval(loopcells);
				if(active == "week")
				{ weeknav("today"); }
				else if(active == "week")
				{ monthnav("today"); }
				else
				{ yearnav("today"); }
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function viewtenantdetails(tenantid, unitid)
	{
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			data: 'tenantid=' + tenantid + '&unitid=' + unitid + '&form=tenantdetails',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				$("#ltenantname").text(arr[1]);
				$("#lindustry").text(arr[2]);
				$("#lunitname").text(arr[3]);
				$("#lmall").text(arr[4]);
				$("#lwing").text(arr[5]);
				$("#lfloor").text(arr[6]);
				$("#lstartdate").text(arr[7]);
				$("#lenddate").text(arr[8]);
				$("#viewtenant").modal("show");
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function addcellclick(cont)
	{
		$(cont).find("td").each(function(){
			var obj = $(this);
			var id = obj.attr("id");
			var arr = id.split("_");
			obj.click(function(){
				if(getunittype(arr[0])[3] == "SET")
				{
					$("#div_main_cont").load("tenants/floorplan2.php", { "mallid": getunittype(arr[0])[0], "wingid": getunittype(arr[0])[1], "floorid": getunittype(arr[0])[2], "unitid": arr[0], "mydate": arr[1] });
					$("#li_header_header a").text("SET");
				}
				else
				{
					$("#div_main_cont").load("tenants/floorplan3.php", { "mallid": getunittype(arr[0])[0], "wingid": getunittype(arr[0])[1], "floorid": getunittype(arr[0])[2], "unitid": arr[0], "mydate": arr[1] });
					$("#li_header_header a").text("LCA - Leasable Common Area");
				}
			});
		});
	}
	
	function getunittype(unitid)
	{
		var mytype = [];
		$.ajax({
			type: 'POST',
			url: 'tenants/mcp_mainclass.php',
			async: false,
			data: 'unitid=' + unitid + '&form=getunittype',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				mytype.push(arr[1]);
				mytype.push(arr[2]);
				mytype.push(arr[3]);
				mytype.push(arr[4]);
			}
		}).error(function() {
			alert(data);
		});
		return mytype;
	}
</script>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<div>
				<div class="row search-page">
					<div class="col-xs-12">
						<div class="row">
							<div class="col-xs-12 col-sm-3">
								<div class="search-area well well-sm">
									<div class="search-filter-header bg-primary">
										<h5 class="smaller no-margin-bottom">
											<i class="ace-icon fa fa-sliders light-green bigger-130"></i>&nbsp; Refine your Search
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
										<select class="form-control" id="txtfloor">
											<option value="">Choose Floor</option>
										</select>
										<div class="space-10"></div>
										<div>
											<p style="display: inline-block; margin-left: 2px;">Unit Type:</p>
											<label style="margin-left: 10px;">
												<input name="txtunittype" type="radio" class="txtunittype ace" value="SET">
												<span class="lbl">&nbsp;&nbsp;SET</span>
											</label>
											<label style="margin-left: 10px;">
												<input name="txtunittype" type="radio" class="txtunittype ace" value="LCA" checked>
												<span class="lbl">&nbsp;&nbsp;LCA</span>
											</label>
										</div>
										<div class="space-10"></div>
										<p style="margin-bottom: 4px; margin-left: 2px;">Search Unit</p>
										<span class="input-icon input-icon-right">
											<input type="text" id="txtsearchunit" class="form-control">
											<i class="ace-icon glyphicon glyphicon-search" style="margin-top: 3px;"></i>
										</span>
										<div class="space-10"></div>
										<button class="btn btn-success" onClick="filterunit();"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Submit Search</button>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-9">
								<div class="row">
									<div class="search-area well col-xs-12">
										<div class="pull-left">
											<b class="text-primary">Display</b>&nbsp;&nbsp;
											<div id="viewlist" class="btn-group btn-overlap" data-toggle="buttons">
												<label id="week" title="Weekly" class="btn btn-sm btn-white btn-success active">
													<i class="icon-only ace-icon fa fa-calendar"></i>&nbsp;
													<p style="font-size: 13px; margin-bottom: 5px; display: inline-block;">Week</p>
												</label>
												<label id="month" title="Monthly" class="btn btn-sm btn-white btn-grey">
													<i class="icon-only ace-icon fa fa-calendar"></i>&nbsp;
													<p style="font-size: 13px; margin-bottom: 5px; display: inline-block;">Month</p>
												</label>
												<label id="year" title="Yearly" class="btn btn-sm btn-white btn-grey">
													<i class="icon-only ace-icon fa fa-calendar"></i>&nbsp;
													<p style="font-size: 13px; margin-bottom: 5px; display: inline-block;">Year</p>
												</label>
											</div>
										</div>
										<div class="pull-right">
											<div id="btn-week" class="btn-group">
												<input type="hidden" id="txtcnt" value="0">
												<button class="btn btn-purple btn-sm" onClick="weeknav('prev');"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Prev</button>
												<button class="btn btn-purple btn-sm" onClick="weeknav('today');">Current</button>
												<button class="btn btn-purple btn-sm" onClick="weeknav('next');">Next&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
											</div>
											<div id="btn-month" class="btn-group" style="display: none;">
												<input type="hidden" id="txtmonth" value="<?php echo date("m")-1; ?>">
												<input type="hidden" id="txtyear" value="<?php echo date("Y"); ?>">
												<button class="btn btn-purple btn-sm" onClick="monthnav('prev');"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Prev</button>
												<button class="btn btn-purple btn-sm" onClick="monthnav('today');">Current</button>
												<button class="btn btn-purple btn-sm" onClick="monthnav('next');">Next&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
											</div>
											<div id="btn-year" class="btn-group" style="display: none;">
												<input type="hidden" id="txtyear2" value="<?php echo date("Y"); ?>">
												<button class="btn btn-purple btn-sm" onClick="yearnav('prev');"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Prev</button>
												<button class="btn btn-purple btn-sm" onClick="yearnav('today');">Current</button>
												<button class="btn btn-purple btn-sm" onClick="yearnav('next');">Next&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
											</div>
										</div>
									</div>
								</div>
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
								<div class="row">
									<div class="col-xs-6 col-sm-3" style="padding: 0px; padding-left: 15px;">
										<table class="table table-bordered table-hover">
											<thead>
												<tr><th style="height: 60px; border-right: solid 1px #dddddd;">Unit Name</th></tr>
											</thead>
										</table>
										<div id="unitlist0" class="unitlist" style="height: 340px; margin-top: -20px; overflow-y: auto; border-bottom: solid 1px #dddddd; border-left: solid 1px #dddddd;">
											<table class="table table-bordered table-hover">
												<tbody id="unitlist">
												<?php
													//$getunit = "select a.unitid, a.unitname, a.typeofbusiness, a.buildingname, b.floor from tblref_unit as a LEFT JOIN tblref_floorsetup as b ON a.floorid = b.floorid where a.floorid = '" . $floorid . "'";
													$getunit = "";
													if(!isset($_POST["unitid"]))
													{ $getunit = "select a.unitid, a.unitname, a.typeofbusiness, a.buildingname, b.floor, a.status from tblref_unit as a LEFT JOIN tblref_floorsetup as b ON a.floorid = b.floorid"; }
													else
													{
														if($_POST["unitid"] == "")
														{ $getunit = "select a.unitid, a.unitname, a.typeofbusiness, a.buildingname, b.floor, a.status from tblref_unit as a LEFT JOIN tblref_floorsetup as b ON a.floorid = b.floorid"; }
														else
														{ $getunit = "select a.unitid, a.unitname, a.typeofbusiness, a.buildingname, b.floor, a.status from tblref_unit as a LEFT JOIN tblref_floorsetup as b ON a.floorid = b.floorid where a.unitid = '" . $_POST["unitid"] . "'"; }
													}
													$unitresult = mysql_query($getunit);
													while($unit = mysql_fetch_array($unitresult))
													{
														echo "
														<tr id='" . $unit[0] . "'>
															<td style='height: 100px;'>
																<h5 style='margin: 5px;'><a href='#'><span class='glyphicon glyphicon-home'></span>&nbsp;&nbsp;" . $unit[1] . "</a></h5>
																<b style='margin: 0px; margin-left: 25px; margin-top: 0px; font-size: 12px; color: #333;'>&nbsp;" . $unit[2] . "</b>
																<p style='margin: 0px; margin-left: 25px; margin-top: 0px; font-size: 12px; color: #666;'>&nbsp;" . $unit[3] . "</p>
																<p style='margin: 0px; margin-left: 25px; margin-top: 0px; font-size: 12px; color: #666;'>&nbsp;" . $unit[4] . "</p>
															</td>
														</tr>
														";
													}
												?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- Start Weekly -->
									<div class="col-xs-6 col-sm-9 views" id="weekview" style="padding: 0px; padding-right: 15px;">
										<div class="unitlist" style="overflow-y: hidden; border-right: solid 1px #dddddd;">
											<table class="table table-bordered table-hover" style="width: 980px;">
												<thead id="weekcont1">
												</thead>
											</table>
											<div id="unitlist1" style="height: 340px; width: 980px; margin-top: -20px; overflow-y: hidden; overflow-x: hidden; border-bottom: solid 1px #dddddd;">
												<table class="table table-bordered table-hover" style="width: 980px;">
													<tbody id="weekcont2">
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Weekly -->
									<!-- Start Monthly -->
									<div class="col-sm-9 views" id="monthview" style="padding: 0px; padding-right: 15px; display: none;">
										<div class="unitlist" style="overflow-y: hidden; border-right: solid 1px #dddddd;">
											<table class="table table-bordered table-hover" id="monthcont0_1">
												<thead id="monthcont1">
												</thead>
											</table>
											<div id="unitlist2" style="height: 340px; margin-top: -20px; overflow-x: hidden; overflow-y: hidden; border-bottom: solid 1px #dddddd;">
												<table class="table table-bordered table-hover" id="monthcont0_2">
													<tbody id="monthcont2">
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Monthly -->
									<!-- Start Yearly -->
									<div class="col-sm-9 views" id="yearview" style="padding: 0px; padding-right: 15px; display: none;">
										<div class="unitlist" style="overflow-y: hidden; border-right: solid 1px #dddddd;">
											<table class="table table-bordered table-hover" style="width: 2400px;">
												<thead id="yearcont1">
												</thead>
											</table>
											<div id="unitlist3" style="height: 340px; width: 2400px; margin-top: -20px; overflow-x: hidden;  overflow-y: hidden; border-bottom: solid 1px #dddddd;">
												<table class="table table-bordered table-hover" style="width: 2400px;">
													<tbody id="yearcont2">
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- End Yearly -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" role="dialog" id="viewtenant">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tenant Information</h4>
			</div>
			<div class="modal-body">
				<div id="accordion" class="accordion-style1 panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"><i class="bigger-110 ace-icon fa fa-angle-down" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>&nbsp;Tenant Information</a>
							</h4>
						</div>
						<div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4"><p><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Tenant Name</p></div>
									<div class="col-sm-8"><p style="font-weight: 400; color: #666;" id="ltenantname"></p></div>
								</div>
								<div class="row">
									<div class="col-sm-4"><p><span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Industry</p></div>
									<div class="col-sm-8"><p style="font-weight: 400; color: #666;" id="lindustry"></p></div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false"><i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>&nbsp;Residential Unit</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseTwo" aria-expanded="false" style="height: 0px;">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4"><p><span class="glyphicon glyphicon-tag"></span>&nbsp;&nbsp;Unit Name</p></div>
									<div class="col-sm-8"><p style="font-weight: 400; color: #666;" id="lunitname"></p></div>
								</div>
								<div class="row">
									<div class="col-sm-4"><p><span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Mall</p></div>
									<div class="col-sm-8"><p style="font-weight: 400; color: #666;" id="lmall"></p></div>
								</div>
								<div class="row">
									<div class="col-sm-4"><p><span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Bldg./Wing</p></div>
									<div class="col-sm-8"><p style="font-weight: 400; color: #666;" id="lwing"></p></div>
								</div>
								<div class="row">
									<div class="col-sm-4"><p><span class="glyphicon glyphicon-bookmark"></span>&nbsp;&nbsp;Floor</p></div>
									<div class="col-sm-8"><p style="font-weight: 400; color: #666;" id="lfloor"></p></div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false"><i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>&nbsp;Term</a>
							</h4>
						</div>
						<div class="panel-collapse collapse" id="collapseThree" aria-expanded="false" style="height: 0px;">
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-4"><p><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Start Date</p></div>
									<div class="col-sm-8"><p style="font-weight: 400; color: #666;" id="lstartdate"></p></div>
								</div>
								<div class="row">
									<div class="col-sm-4"><p><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;End Date</p></div>
									<div class="col-sm-8"><p style="font-weight: 400; color: #666;" id="lenddate"></p></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="pull-right">
					<button class="btn btn-light">Close&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span></button>
				</div>
				<br><br>
			</div>
		</div>
	</div>
</div>