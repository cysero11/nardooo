<?php
	include("connect.php");
	$getgaccess = " SELECT groupaccess FROM tbluser WHERE userid = '" . $_COOKIE["userid"] . "'";
	$gaccess = mysql_fetch_array(mysql_query($getgaccess));

	if($gaccess == ""){
	$getaccess1 = " SELECT  addnew, edit, delremove, user_access, audit_trail FROM tblref_groupaccess2 WHERE module = 'User Accessibility'";
	}
	else{
	$getaccess1 = " SELECT addnew, edit, delremove, user_access, audit_trail FROM tblref_groupaccess2 WHERE groupid = '" . $gaccess[0] . "' and module = 'Floorplan SET'";
	}
	$access1 = mysql_fetch_array(mysql_query($getaccess1));
	$add1 = explode(":", $access1[0]);
	$edit1 = explode(":", $access1[1]);
	$delete1 = explode(":", $access1[2]);
	$uaccess1 = explode(":", $access1[3]);
	$audit1 = explode(":", $access1[4]);
?>
<style>
	.parent {
        height: 45vh;
    }
	.overlay
	{
		background: url(assets/images/spinner.gif) center no-repeat;
		height: 320px;
		width: 100%;
		display: none;
	}
</style>
<script>
	$(function(){
		$(".fixTable").tableHeadFixer();
		loadusers();
		$("#modalheader").text("New User");
		$("#txtfuserkey").keydown(function(e){
			var x = event.keyCode;
			if(x == 13)
			{ loadusers(); }
		});
		 
		$(".txtfgender").each(function(){
			$(this).change(function(){
				loadusers();
			});
		});
		
		$("#txtfusertype").change(function(){
			loadusers();
		});
	});
	
	function newuser()
	{
		<?php if($add1[1] == "1"){ ?>
		$("#modal_newuser").modal("show");
		<?php } else { ?>
		showmodal("alert", "You are not allowed to access this feature.", "", null, "", null, "1");
		<?php } ?>
	}
	
	function clearuser()
	{
		removephoto();
		$("#userfields .form-control").val("");
		$("#modal_newuser").modal("hide");
		$("#txtuserid").val("");
		$("#modalheader").text("New User");
	}
	
	function loadusers()
	{
		var key = $("#txtfuserkey").val();
		var gender = "";
		$(".txtfgender").each(function(){
			if($(this).is(":checked") == true)
			{ gender = $(this).val(); }
		});
		var usertype = $("#txtfusertype").val();
		$.ajax({
			type: 'POST',
			url: 'setup/user/modal_mainclass.php',
			data: 'key=' + key + '&gender=' + gender + '&usertype=' + usertype + '&form=loadusers',
			beforeSend : function() {
                $('#indexloadingscreen').addClass('myspinner');
            },
                success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
				$("#userlist").html(data);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function edituser(userid)
	{
		<?php if($edit1[1] == "1") { ?>
		$("#txtuserid").val(userid);
		$.ajax({
			type: 'POST',
			url: 'setup/user/modal_mainclass.php',
			data: 'userid=' + userid + '&form=edituser',
			beforeSend:function(){
			},
			success: function(data) {
				var arr = data.split("|");
				$("#modalheader").text("Edit User");
				$("#h1").css("display", "none");
				$("#txtusertype").val(arr[1]);
				$("#txtgroupaccess").val(arr[2]);
				$("#txtfirstname").val(arr[3]);
				$("#txtmiddlename").val(arr[4]);
				$("#txtlastname").val(arr[5]);
				$("#txtcontactnumber").val(arr[6]);
				$(".gender").each(function(){
					if($(this).val() == arr[8])
					{ $(this).prop("checked", true); }
				});
				$("#txtemailaddress").val(arr[7]);
				$("#txtusername").val(arr[9]);
				$("#txtpassword").val(arr[11]);
				$("#txtpasswordhint").val(arr[12]);
				if(arr[14] != ""){
					$("#img").css("display", "block");
					$("#txtspan").css("display", "none");
					$("#txtclick").css("display", "none");
					$("#img").attr("src", arr[14]);
			}
				$("#modal_newuser").modal("show");
			}
		}).error(function() {
			alert(data);
		});
		<?php } else { ?>
		showmodal("alert", "You are not allowed to access this feature.", "", null, "", null, "1");
		<?php } ?>
	}
	
	function deleteuser(userid)
	{
		<?php if($delete1[1] == "1") { ?>
		var arr = [];
		arr.push(userid);
		showmodal("confirm", "Delete user?", "deleteuser2", arr, "", null, "1");
		<?php } else { ?>
		showmodal("alert", "You are not allowed to access this feature.", "", null, "", null, "1");
		<?php } ?>
	}
	
	function deleteuser2(userid)
	{
		$.ajax({
			type: 'POST',
			url: 'setup/user/modal_mainclass.php',
			data: 'userid=' + userid + '&form=deleteuser',
			beforeSend : function() {
	            $('#indexloadingscreen').addClass('myspinner');
	        },
	            success: function(data){
	            $('#indexloadingscreen').removeClass('myspinner');
				var arr = data.split("|");
				if(arr[1] == "1")
				{
					$("#modal_newuser").modal("hide");
					showmodal("alert", "User has been removed", "", null, "", null, "0");
					loadusers();
				}
				else
				{ alert(arr[1]); }
			}
		}).error(function() {
			alert(data);
		});
	}
</script>
<div class="page-content">
	<div class="tabbable">
	<div class="pull-right" style="margin-bottom: 10px;">
	</div>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#usercont1">
                    <i class="green ace-icon fa fa-users bigger-120"></i>
                    User List
                </a>
            </li>
            <li>
                <a data-toggle="tab" <?php if($useraccess1[1] != "1"){ ?>href="#usercont2"<?php } else { ?>onclick="showmodal('alert', 'You are not allowed to access this feature.', '', null, '', null, '1');"<?php } ?>>
                    <i class="green ace-icon fa fa-desktop bigger-120"></i>
                    User Accessibilities
                </a>
            </li>
            <li>
                <a data-toggle="tab" <?php if($audit1[1] != "1"){ ?>href="#usercont3"<?php } else { ?>onclick="showmodal('alert', 'You are not allowed to access this feature.', '', null, '', null, '1');"<?php } ?>>
                    <i class="ace-icon fa fa-filter bigger-120"></i>
                    Audit Trail
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="usercont1" class="tab-pane fade in active">
            	<div class="row" style="margin-bottom: 10px;">
                	<div class="col-sm-3">
                    	<div class="input-group">
                        	<input type="text" class="form-control" id="txtfuserkey" title="Search according to filter selected" placeholder="Search user here...">
                        	<span class="input-group-addon">
                            	<i class="glyphicon glyphicon-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    	<div class="radio" style="margin: 8px;">
                        	<span style="font-size: 14px; color: #666; margin-right: 10px;">Gender:</span>
                            <label>
                                <input name="txtfgender" class="ace txtfgender" type="radio" checked="checked" value="">
                                <span class="lbl" style="padding-left: 5px;">All</span>
                            </label>
                            <label>
                                <input name="txtfgender" class="ace txtfgender" type="radio" value="Male">
                                <span class="lbl" style="padding-left: 5px;">Male</span>
                            </label>
                            <label>
                                <input name="txtfgender" class="ace txtfgender" type="radio" value="Female">
                                <span class="lbl" style="padding-left: 5px;">Female</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-3">
                    	<select class="form-control" id="txtfusertype">
                        	<option value="">Select user group</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
	    				<button class="btn btn-sm btn-info pull-right" onclick="newuser();"><span class="fa fa-user-plus"></span>&nbsp;&nbsp;New User</button>
                    </div>
                </div>
                <div id="usertable">
	                <div class="parent">
	                    <table class="table table-bordered table-hover fixTable">
	                        <thead>
	                            <tr>
	                                <td style="width: 6%;"></td>
	                                <td style="width: 24%;">Full name</td>
	                                <td style="width: 10%;">Gender</td>
	                                <td style="width: 20%;">Contact no.</td>
	                                <td style="width: 10%;">User Type</td>
	                                <td style="width: 20%;">Email</td>
	                                <td style="width: 10%; border-right: solid 1px #dddddd; text-align: center;">Options</td>
	                            </tr>
	                        </thead>
	                    	<tbody id="userlist"></tbody>
	                    </table>
	                </div>
                </div>
            </div>
            <div id="usercont2" class="tab-pane fade">
            	<?php include("../setup/user/useraccess.php"); ?>
            </div>
            <div id="usercont3" class="tab-pane fade">
            	<?php include("../setup/user/audittrail.php"); ?>
            </div>
        </div>
    </div>
</div>
<?php include("modal_user.php"); ?>