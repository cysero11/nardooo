<?php
	$getgroupname = "select b.groupname, a.groupaccess from tbluser as a LEFT JOIN tblref_groupaccess as b ON a.groupaccess = b.groupid where a.userid = '" . $_COOKIE["userid"] . "'";
	$groupname = mysql_fetch_array(mysql_query($getgroupname));
?>
<script>
	var add = false;
	
	viewaccess("<?php echo $groupname[1]; ?>");
	$(function(){
		$(".cont").niceScroll({ cursorcolor: "#666", width: "8px" });
		loadgroupaccess();
		addtoggle();
	});
	
	function addtoggle()
	{
		$(".accordion-toggle").each(function(){
			var obj = $(this);
			obj.on('click', function(){
				obj.children(".checkbox label").toggle();
			}).on('click', '.checkbox label', function(e) {
				e.stopPropagation();
			});
		});
		$(".panel").each(function(){
			var obj = $(this);
			obj.find(".chkall").change(function(){
				if($(this).is(":checked") == true)
				{ obj.find(".panel-body input:checkbox").prop("checked", true); }
				else
				{ obj.find(".panel-body input:checkbox").prop("checked", false); }
			});
		});
	}
	
	function chkall(obj, list)
	{
		if(obj.is(":checked") == true)
		{ $("#" + list + " input:checkbox").prop("checked", true); }
		else
		{ $("#" + list + " input:checkbox").prop("checked", false); }
	}
	
	function loadgroupaccess()
	{
		$.ajax({
			type: 'POST',
			url: 'setup/user/modal_mainclass.php',
			data: 'form=loadgroupaccess',
			beforeSend:function(){
			},
			success: function(data) {
				$("#groupaccesslist").html(data);
				addgroupaccessclick();
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function addgroupaccessclick()
	{
		$("#groupaccesslist li").each(function(){
			var obj = $(this);
			obj.click(function(){
				$("#selgroupaccess").text(obj.find(".dd2-content").text());
				$("#txtgroupid").val(obj.attr("id"));
				$("#txtgroupname").val(obj.find(".dd2-content").text());
				viewaccess(obj.attr("id"));
				chkall($('#chkall1'), 'accessibles');
			});
		});
	}
	
	function addgroupaccess()
	{
		if(add == false)
		{
			$("#txtgroupaccess2").prop("disabled", false);
			$("#txtgroupaccess2").focus();
			$("#btngaadd").removeClass("glyphicon-plus");
			$("#btngaadd").addClass("glyphicon-ok");
			$("#btngcancel").css("display", "table-cell");
			add = true;
		}
		else
		{
			if($("#txtgroupaccess2").val() == "")
			{ showmodal("alert", "Please input group access name.", "", null, "", null, "1"); }
			else
			{ showmodal("confirm", "Add user group?", "addgroupaccess2", null, "", null, "0"); }
		}
	}
	
	function addgroupaccess2()
	{
		var groupaccess = $("#txtgroupaccess2").val();
		$.ajax({
			type: 'POST',
			url: 'setup/user/modal_mainclass.php',
			data: 'groupname=' + groupaccess + '&form=savegroupaccess',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{
					showmodal("alert", "User group has been added.", "", null, "", null, "0");
					cancelgroupaccess()
					loadgroupaccess();
				}
				else
				{ alert(arr[1]); }
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function cancelgroupaccess()
	{
		$("#txtgroupaccess2").val("");
		$("#txtgroupaccess2").prop("disabled", true);
		$("#btngaadd").removeClass("glyphicon-ok");
		$("#btngaadd").addClass("glyphicon-plus");
		$("#btngcancel").css("display", "none");
		add = false;
	}
	
	function viewaccess(groupid)
	{
		$("#grantedlist").html("");
		$.ajax({
			type: 'POST',
			url: 'setup/user/modal_mainclass.php',
			data: 'groupid=' + groupid + '&form=getaccessibility',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("!");
				var padding = "";
				for(var i=1; i<=arr.length-1; i++)
				{
					var padding2 = "";
					var arr2 = arr[i].split("#");
					var arr3 = arr2[2].split("|");
					for(var x=1; x<=arr3.length-1; x++)
					{
						var arr4 = arr3[x].split(":");
						padding2 += "<div class='checkbox'><label><input name='form-field-checkbox' type='checkbox' class='ace' value='" + arr4[0] + "'><span class='lbl' style='color: #666;'>&nbsp;&nbsp;" + arr4[1] + "</span></label></div>";
					}
					padding += "<div class='panel panel-default'><div class='panel-heading'><h4 class='panel-title'><a class='accordion-toggle' data-toggle='collapse'><i class='ace-icon fa fa-folder-open green' data-icon-hide='ace-icon fa fa-folder' data-icon-show='ace-icon fa fa-folder'></i>&nbsp;&nbsp;<font class='gname'>" + arr2[1] + "</font><div class='checkbox' style='float: right; margin-top: -3px;'><label><input name='form-field-checkbox' type='checkbox' class='ace chkall'><span class='lbl' style='color: #666;'>&nbsp;&nbsp;Check All</span></label></div></a></h4></div><div class='panel-collapse collapse'><div class='panel-body' style='padding: 0px;'>" + padding2 + "</div></div></div>";
					if(i == arr.length-1)
					{
						$("#grantedlist").html(padding);
						idchanger();
					}
				}
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function savechanges()
	{
		var padding = "";
		$("#grantedlist .panel").each(function(){
			var obj = $(this);
			var padding2 = "";
			obj.find(".panel-body .checkbox").each(function(){
				var obj2 = $(this);
				padding2 += "|" + obj2.find("input:checkbox").val() + ":" + obj2.find("span").text().trim();
			});
			padding += "!#" + obj.find(".gname").text() + "#" + padding2;
		});
		if(padding == "")
		{ showmodal("alert", "Please add accessible modules.", "", null, "", null, "1"); }
		else
		{ showmodal("confirm", "Save Changes?", "savechanges2", null, "", null, "0"); }
	}
	
	function savechanges2()
	{
		var padding = "";
		$("#grantedlist .panel").each(function(){
			var obj = $(this);
			var padding2 = "";
			obj.find(".panel-body .checkbox").each(function(){
				var obj2 = $(this);
				padding2 += "|" + obj2.find("input:checkbox").val() + ":" + obj2.find("span").text().trim();
			});
			padding += "!#" + obj.find(".gname").text() + "#" + padding2;
		});
		var groupid = $("#txtgroupid").val();
		var groupname = $("#txtgroupname").val();
		$.ajax({
			type: 'POST',
			url: 'setup/user/modal_mainclass.php',
			data: 'groupid=' + groupid + '&groupname=' + groupname + '&padding=' + padding + '&form=saveaccessibility',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				if(arr[1] == "1")
				{ showmodal("alert", "Changes has been saved.", "", null, "", null, "0"); }
				else
				{ alert(arr[1]); }
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function addselected()
	{
		var padding = "";
		$("#accessibles .panel").each(function(){
			var obj = $(this);
			var num = obj.find(".panel-body input:checked").length;
			if(obj.find(".chkall").is(":checked") == true)
			{ padding += "<div class='panel panel-default'>" + obj.html() + "</div>"; }
			else
			{
				if(num > 0)
				{
					var padding2 = "";
					obj.find(".panel-body .checkbox").each(function(){
						var obj2 = $(this);
						if(obj2.find("input:checkbox").is(":checked") == true)
						{ padding2 += "<div class='checkbox'>" + obj2.html() + "</div>"; }
					});
					padding += "<div class='panel panel-default'><div class='panel-heading'>" + obj.find(".panel-heading").html() + "</div><div class='panel-collapse collapse'><div class='panel-body' style='padding: 0px;'>" + padding2 + "</div>";
				}
			}
		});
		$("#grantedlist").html(padding);
		idchanger();
	}
	
	function removeselected()
	{
		var padding = "";
		$("#grantedlist .panel").each(function(){
			var obj = $(this);
			var num = obj.find(".panel-body input:checked").length;
			if(obj.find(".chkall").is(":checked") == true)
			{ obj.remove(); }
			else
			{
				if(num > 0)
				{
					if(num == obj.find(".panel-body input:checkbox").length)
					{ obj.remove(); }
					else
					{
						obj.find(".panel-body .checkbox").each(function(){
							var obj2 = $(this);
							if(obj2.find("input:checkbox").is(":checked") == true)
							{ obj2.remove(); }
						});
					}
				}
			}
		});
	}
	
	function idchanger()
	{
		var num = 0;
		$("#grantedlist .panel").each(function(){
			num++;
			var obj = $(this);
			obj.find(".accordion-toggle").attr("href", "#gcollapse" + num);
			obj.find(".panel-collapse").attr("id", "gcollapse" + num);
		});
		addtoggle();
	}
</script>
<input type="hidden" id="txtgroupid" value="<?php echo $groupname[1]; ?>">
<input type="hidden" id="txtgroupname" value="<?php echo $groupname[0]; ?>">
<div class="row">
	<div class="col-sm-4">
    	<div class="widget-box widget-color-green">
            <div class="widget-header">
                <h4 class="widget-title lighter smaller">User Group</h4>
                <span class="label label-xlg label-light arrowed-in arrowed-in-right" style="margin: 5px; margin-right: 15px; float: right;" id="selgroupaccess"><?php echo $groupname[0]; ?></span>
            </div>
            <div class="widget-body">
            	<div class="input-group" style="margin: 10px; margin-bottom: 0px;">
                	<input type="text" class="form-control" id="txtgroupaccess2" placeholder="Add Group Access" disabled>
                    <div class="input-group-addon btn-info" onClick="addgroupaccess();" title="Add Group Access">
                    	<span class="glyphicon glyphicon-plus" id="btngaadd" style="color: #FFF;"></span>
                    </div>
                    <div class="input-group-addon btn-danger" onClick="cancelgroupaccess();" title="Cancel" id="btngcancel" style="display: none;">
                    	<span class="glyphicon glyphicon-repeat" style="color: #FFF;"></span>
					</div>
                </div>
            	<div class="dd dd-draghandle cont" style="margin: 10px; height: 300px;">
                	<ol class="dd-list" id="groupaccesslist">
                    </ol>
                </div>
            </div>
        </div>
    </div>
	<div class="col-sm-4">
    	<div class="widget-box widget-color-blue2">
            <div class="widget-header">
                <h4 class="widget-title lighter smaller">List of Permissions</h4>
                <div class="checkbox" style="float: right; margin-right: 10px;">
                    <label>
                        <input name="form-field-checkbox" type="checkbox" class="ace" id="chkall1" onchange="chkall($(this), 'accessibles');">
                        <span class="lbl" style="color: #FFF;">&nbsp;&nbsp;Check All</span>
                    </label>
                </div>
            </div>
            <div class="widget-body">
                <div class="accordion-style1 panel-group cont" id="accessibles" style="margin: 10px; height: 298px;">
                	<!-- Panel 1 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse1">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Inquiry</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse1">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="addnew">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;New Inquiry</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="edit">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Update Inquiry</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 2 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse2">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Leasing Application</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse2">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="addnew">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;New Leasing Application</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="approve">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Approval</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 3 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse3">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Reservation</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse3">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="approve">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Approval</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 4 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse4">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Tenants</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse4">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="eviction">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;For Eviction</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="renewal">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Renewal</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="pdc_clearing">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;PDC Clearing</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 5 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse5">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Calendar</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse5">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="viewing">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;View Tenant Information</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 6 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse6">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Floorplan LCA</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse6">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="addnew">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Assign Tenant</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="delremove">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Remove Tenant</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="viewing">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;View Tenant</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 7 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse7">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Floorplan SET</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse7">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="addnew">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Upload Floorplan</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="edit">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Edit Floorplan</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="delremove">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Remove Floorplan</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="add2">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Assign Unit / Add Marker</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="delete2">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Remove Unit / Marker</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="viewing">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;View Unit Information</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 8 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse8">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Maintenance</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse8">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="addnew">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Set Task</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="edit">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Re-sched Task</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="post">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Posting of Charges</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="add2">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Set Task by Complaints</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="viewing">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;View Maintenance Tenant History</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="cost_of_repair">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Setup Maintenance Cost of Repair</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 9 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse9">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Billing</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse9">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="payment">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Generate Payment</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="soa">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;SOA</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 10 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse10">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">User Accessibility</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse10">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="addnew">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Add User</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="edit">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Edit User</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="delremove">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Remove User</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="user_access">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;User Accessibility</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="audit_trail">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Audit Trail</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Panel 11 -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse11">
                                    <i class="ace-icon fa fa-folder-open green" data-icon-hide="ace-icon fa fa-folder" data-icon-show="ace-icon fa fa-folder"></i>
                                    &nbsp;&nbsp;<font class="gname">Referentials</font>
                                    <div class="checkbox" style="float: right; margin-top: -3px;">
                                        <label>
                                            <input name="form-field-checkbox" type="checkbox" class="ace chkall">
                                            <span class="lbl" style="color: #666;">&nbsp;&nbsp;Check All</span>
                                        </label>
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapse11">
                            <div class="panel-body" style="padding: 0px;">
                            	<div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="addnew">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Add</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="edit">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Edit</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace" value="delremove">
                                        <span class="lbl" style="color: #666;">&nbsp;&nbsp;Remove</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: right;">
                	<button class="btn btn-info btn-sm" style="margin: 10px; margin-top: 0px;" onClick="addselected();"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Selected</button>
                </div>
            </div>
        </div>
    </div>
	<div class="col-sm-4">
    	<div class="widget-box widget-color-orange">
            <div class="widget-header">
                <h4 class="widget-title lighter smaller">Granted Permissions</h4>
                <div class="checkbox" style="float: right; margin-right: 10px;">
                    <label>
                        <input name="form-field-checkbox" type="checkbox" class="ace" id="chkall2" onchange="chkall($(this), 'grantedlist');">
                        <span class="lbl" style="color: #FFF;">&nbsp;&nbsp;Check All</span>
                    </label>
                </div>
            </div>
            <div class="widget-body">
                <div class="accordion-style1 panel-group cont" id="grantedlist" style="margin: 10px; height: 298px;">
                </div>
                <div style="text-align: right;">
                	<button class="btn btn-danger btn-sm" style="margin: 10px; margin-top: 0px; float: left;" onClick="removeselected();"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove Selected</button>
                	<button class="btn btn-success btn-sm" style="margin: 10px; margin-top: 0px;" onClick="savechanges();"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>