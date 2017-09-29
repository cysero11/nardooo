<div id="loadingscreenforlogout"></div>
<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="grey dropdown-modal"  onclick="showmallpermits()">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-tasks"></i>
								<span class="badge badge-grey" id="spn_overall_exp"></span>
							</a>

							<!-- <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									
								</li>

								<li class="dropdown-content">
									<div class="row">
										<div class="col-xs-12">
											<table class="table table-bordered table-striped">
												<thead>
													<tr>
														<td>asgas</td>
														<td>;oausdkhgbjl</td>
														<td>;oausdkhgbjl</td>
														<td>;oausdkhgbjl</td>
														<td>;oausdkhgbjl</td>
														<td>asdgasdg</td>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</li>
							</ul> -->
						</li>

						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell" id="i_bell_stat"></i>
								<span class="badge badge-important" id="spn_overall_not"></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
										<li>
											<a href="javascript:void(0)" onclick="penalizetenants();">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-pink fa fa-ticket"></i>
														Tenants to be penalized<h6 style="color: #CCC;margin: 0px;font-size: 10px !important;margin-left: 40px;">Click to post penalties</h6>

													</span>

													<span class="pull-right badge badge-info" id="spn_penalize"></span>
												</div>
											</a>
										</li>

										<li>
											<a href="javascript:void(0)" onclick="endofcontract()">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-yellow fa fa-file-text-o"></i>
														End of contract<h6 style="color: #CCC;margin: 0px;font-size: 10px !important;margin-left: 40px;">Click to apply status</h6>
													</span>
													<span class="pull-right badge badge-info" id="spn_endo"></span>
												</div>
											</a>
										</li>

<!-- 										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												Bob just signed up as an editor ...
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li> -->
									</ul>
								</li>
<!-- 
								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li> -->
							</ul>
						</li>

<!-- 						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									5 Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>a moment ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Susan:</span>
														Vestibulum id ligula porta felis euismod ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>20 minutes ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Bob:</span>
														Nullam quis risus eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>3:15 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Kate:</span>
														Ciao sociis natoque eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>1:33 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="assets/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Fred:</span>
														Vestibulum id penatibus et auctor  ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>10:09 am</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="inbox.html">
										See all messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li> -->

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="" style="height:40px;width:50px;" id="imguser" alt="" />
								<span class="user-info">
									<small>Welcome,</small>
									<label id="lbluser"></label>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<!-- <li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li> -->

								<li>
									<a href="javascript:void(0)" onclick="logoutuser()">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>

				<div class="modal fade" id="showtableofmalls">
				    <div class="modal-dialog modal-lg" style="width: 1300px;">
				        <div class="modal-content" style="padding:20px;">
				            <div class="modal-body">
				            	<div class="row">
				            		<div class="col-md-12">
				            			<table style="margin-bottom: 10px;">
				            				<tr><td colspan="2" style="font-weight: bold;padding-bottom: 5px;">LEGEND:</td></tr>
				            				<tr><td style="width: 20px;background-color: #ff6666;"></td><td style="font-style: italic;">&nbsp;&nbsp;Expired</td></tr>
				            				<tr><td style="width: 20px;background-color: #8fbcd6;"></td><td style="font-style: italic;">&nbsp;&nbsp;Valid</td></tr>
				            				<tr><td style="width: 20px;background-color: #ffff66;"></td><td style="font-style: italic;">&nbsp;&nbsp;Will Expire on 30 days or less</td></tr>
				            			</table>
				            		</div>
				            	</div>
				                <div class="row">
				                	<div id="nilalaman">
					                
									</div>
								</div>
				            </div>
				        </div>
				    </div>
				</div>

				<div class="modal fade" id="showtableofmallsinputfield">
				    <div class="modal-dialog modal-md">
				        <div class="modal-content">

				        	<div class="modal-header">
				        		<h4 class="modal-title" id="mallnamehere" style="color:white; font-weight: bold;"></h4>
				        	</div>

				            <div class="modal-body">
				                <div class="row">
									<div class="col-xs-12">
										<div class="well">
											<div class="row form-group">
												<div class="col-xs-2">
													Building Insurance
												</div>
												<div class="col-xs-4">
													<input type="text" id="Bldng_Insurance" class="date-picker">
												</div>
												<div class="col-xs-2">
													Business Permit
												</div>
												<div class="col-xs-4">
													<input type="text" id="Business_Permit" class="date-picker">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-xs-2">
													Sanitary Permit
												</div>
												<div class="col-xs-4">
													<input type="text" id="Sanitary_Permit" class="date-picker">
												</div>
												<div class="col-xs-2">
													Mechanical Certificate
												</div>
												<div class="col-xs-4">
													<input type="text" id="Mech_Cert" class="date-picker">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-xs-2">
													Electrical Certificate
												</div>
												<div class="col-xs-4">
													<input type="text" id="Elec_Cert" class="date-picker">
												</div>
												<div class="col-xs-2">
													Discharge Permit
												</div>
												<div class="col-xs-4">
													<input type="text" id="Discharge_Permit" class="date-picker">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-xs-2">
													FSIC
												</div>
												<div class="col-xs-4">
													<input type="text" id="FSIC" class="date-picker">
												</div>
												<div class="col-xs-2">
													Permit To Operate Elevator
												</div>
												<div class="col-xs-4">
													<input type="text" id="Permit_To_Op_Elev" class="date-picker">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-xs-2">
													Combustible Clearance
												</div>
												<div class="col-xs-4">
													<input type="text" id="Combustible_Clearance" class="date-picker">
												</div>
												<div class="col-xs-2">
													Permit To Operate Gen Set
												</div>
												<div class="col-xs-4">
													<input type="text" id="Permit_To_Op_GenSet" class="date-picker">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-xs-2">
													DENR Permit
												</div>
												<div class="col-xs-4">
													<input type="text" id="DENR_Permit" class="date-picker">
												</div>
												<div class="col-xs-2">
													Water Test
												</div>
												<div class="col-xs-4">
													<input type="text" id="Water_Test" class="date-picker">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-xs-2">
													RPT
												</div>
												<div class="col-xs-4">
													<input type="text" id="RPT" class="date-picker">
												</div>
												<div class="col-xs-2">
												</div>
												<div class="col-xs-4">
												</div>
											</div>
										</div>
									</div>
								</div>
				            </div>

				            <div class="modal-footer" style="margin-top: -20px;">
								<button class="btn btn-primary" onclick="sendconfirm();">Save</button>
								<button class="btn btn-danger" onclick='$("#showtableofmallsinputfield").modal("hide")'>Cancel</button>
							</div>

				        </div>
				    </div>
				</div>

<input type="hidden" id="alucard">
<script type="text/javascript">
function logoutuser(){
    showmodal("confirm", "Logout User?", "logoutuser2", null, "", null, 1);
}

function logoutuser2(){
	$.ajax({
		beforeSend : function() {
	       $('#indexloadingscreen').addClass('myspinner');
	    },
		success: function(data){
	        $('#indexloadingscreen').removeClass('myspinner');
			window.location = "setcookie.php?type=out&userid=";
		}
	})
}

function showmallpermits(){
	$("#showtableofmalls").modal("show");
	$.ajax({
		type: 'POST',
		url: 'mainclass.php',
		data: 'form=showmallpermits',
		beforeSend : function() {
	       $('#indexloadingscreen').addClass('myspinner');
	    },
		success: function(data){
	        $('#indexloadingscreen').removeClass('myspinner');
			$("#nilalaman").html(data);
		}
	})

	$.ajax({
		type: 'POST',
		url: 'mainclass.php',
		data: 'form=showmallpermitsnoti',
		success: function(data)
		{
			$("#spn_overall_exp").text(data)
		}
	})
}

function enableedit123(mallid){
	$("#showtableofmallsinputfield").modal("show");
	$("#alucard").val(mallid);
	$.ajax({
		type: 'POST',
		url: 'mainclass.php',
		data: 'mallid=' + mallid + '&form=enableedit',
	success:function(data){
			var arr = data.split("|");
			$("#Bldng_Insurance").val(arr[0]);
			$("#Business_Permit").val(arr[1]);
			$("#Sanitary_Permit").val(arr[2]);
			$("#Mech_Cert").val(arr[3]);
			$("#Elec_Cert").val(arr[4]);
			$("#Discharge_Permit").val(arr[5]);
			$("#FSIC").val(arr[6]);
			$("#Permit_To_Op_Elev").val(arr[7]);
			$("#Combustible_Clearance").val(arr[8]);
			$("#Permit_To_Op_GenSet").val(arr[9]);
			$("#DENR_Permit").val(arr[10]);
			$("#Water_Test").val(arr[11]);
			$("#RPT").val(arr[12]);
			$("#mallnamehere").text(arr[13]);
			
			$(".date-picker").datepicker({
			    autoHide: true,
			    format: 'yyyy-mm-dd',
			    todayHighlight: true
			});
		}
	})
}

function sendconfirm(){
	var mallid = $("#alucard").val();
	var Bldng_Insurance = $("#Bldng_Insurance").val();
	var Business_Permit = $("#Business_Permit").val();
	var Sanitary_Permit = $("#Sanitary_Permit").val();
	var Mech_Cert = $("#Mech_Cert").val();
	var Elec_Cert = $("#Elec_Cert").val();
	var Discharge_Permit = $("#Discharge_Permit").val();
	var FSIC = $("#FSIC").val();
	var Permit_To_Op_Elev = $("#Permit_To_Op_Elev").val();
	var Combustible_Clearance = $("#Combustible_Clearance").val();
	var Permit_To_Op_GenSet = $("#Permit_To_Op_GenSet").val();
	var DENR_Permit = $("#DENR_Permit").val();
	var Water_Test = $("#Water_Test").val();
	var RPT = $("#RPT").val();
	$.ajax({
		type: 'POST',
		url: 'mainclass.php',
		data: 'Bldng_Insurance=' + Bldng_Insurance + '&Business_Permit=' + Business_Permit + '&Sanitary_Permit=' + Sanitary_Permit + '&Mech_Cert=' + Mech_Cert + '&Elec_Cert=' + Elec_Cert + '&Discharge_Permit=' + Discharge_Permit + '&FSIC=' + FSIC + '&Permit_To_Op_Elev=' + Permit_To_Op_Elev + '&Combustible_Clearance=' + Combustible_Clearance + '&Permit_To_Op_GenSet=' + Permit_To_Op_GenSet + '&DENR_Permit=' + DENR_Permit + '&Water_Test=' + Water_Test + '&RPT=' + RPT + '&mallid=' + mallid + '&form=sendconfirm',
		beforeSend : function() {
	       $('#indexloadingscreen').addClass('myspinner');
	    },
		success: function(data){
	        $('#indexloadingscreen').removeClass('myspinner');
			$("#showtableofmallsinputfield").modal("hide");
			showmallpermits();
        	showmodal("alert", "Successfully Saved.", "", null, "", null, "0");
		}
	})
}

</script>