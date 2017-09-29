<?php
    if(!isset($_COOKIE["userid"]))
    { echo "<script>window.location = 'setcookie.php?type=out&userid=';</script>"; }
    include("dashboard/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title id="titletext"></title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
		<link rel="shortcut icon" type="images/x-icon" href="assets/images/ai1logo.png" />
		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="reports/tenantsalesreport/style.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-colorpicker.min.css" />
		<link href="assets/css/tablenav.css" rel="stylesheet" type="text/css">
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script src="assets/js/ace-extra.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/fusioncharts.js"></script>
		<script type="text/javascript" src="assets/js/fusioncharts.theme.ocean.js"></script>
		<script type="text/javascript" src="assets/js/fusioncharts.theme.carbon.js"></script>
		<script type="text/javascript" src="assets/js/fusioncharts.theme.zune.js"></script>
		<script type="text/javascript" src="assets/js/fusioncharts.theme.fint.js"></script>
		<script src="assets/js/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<style>
.modal-backdrop.in { z-index: auto;}
/* Handle */
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #cccccc;
    -webkit-box-shadow: inset 0 0 6px #cccccc;
}
::-webkit-scrollbar-thumb:window-inactive {
    background: #cccccc;
}

@media only screen and (max-width: 900px) {
    .hide_mobile{
    display: none;
}
}

td{
    word-wrap:break-word
}

</style>
	</head>
	<body class="no-skin" id="sys_body">
		<div id="indexloadingscreen"></div>
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<?php
				include("header/main_header.php");
				include("header/notification.php");
				?>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<div class="ace-settings-container" id="ace-settings-container">
			    <div class="btn btn-app btn-xs btn-success ace-settings-btn" id="ace-settings-btn">
			        <i class="ace-icon fa fa-chevron-circle-left bigger-130" id="interactiveicon"></i>
			    </div>

			    <div class="ace-settings-box clearfix" id="ace-settings-box" style="border-color: #85b558;">
			        <button class="btn btn-lg btn-white btn-default form-control" style="margin-bottom: 5px;margin-top: 10px;" onclick="eod()">
			            End of Day
			        </button><br />
			        <button onclick="showoption()" class="btn btn-lg btn-white btn-default form-control" style="margin-bottom: 5px;">
			            X & Z-Reading
			        </button><br />
			        <!-- <button class="btn btn-lg btn-white btn-default form-control" style="margin-bottom: 10px;">
			            Cashier's Audit
			        </button><br /> -->
			    </div><!-- /.ace-settings-box -->
			</div>   
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

		

				<?php 
				include("sidenav/sidenav_shortcuts.php"); 
				include("sidenav/sidenav2.php"); 
				?>

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
			
				<div class="main-content-inner">
				<?php
				include("header/page_header.php");
				?>
					<input type="hidden" id="txt_syssetup" name="">
					<div class="page-content" id="div_main_cont" style="margin-bottom: 0px !important;padding-bottom: 0px;">
						<?php
						include("dashboard/dashboard.php");
						?>					
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer" style="padding-top: 100px !important;">
				<div class="footer-inner">
					<div class="footer-content">
						<div class="form-group row" style="margin-bottom: 0px;"> 
							<div class="col-md-4 col-xs-12">
								<table style="padding:0px;">
									<tr style="padding:0px;"><td style="padding:0px;"><h6 class="smaller lighter black" style="text-align: left;display: inline-block;float: left;font-weight: bold;margin-bottom: 0px;" id="computerdatetime"></h6></td></tr>
									<tr style="padding:0px;"><td style="padding:0px;"><h6 class="smaller lighter black" style="text-align: left;display: inline-block;float: left;font-weight: bold;" id="sysdatetime"></h6></td></tr>
								</table>								
							</div>
							<div class="col-md-4 col-xs-12">
								<span class="bigger-120" style="display: inline-block;">
								<img src="assets/images/ai1logo.png" height="35" width="30">
									Powered by 
									<span class="blue bolder">Gatessoft Corporation</span>
									<!-- Application &copy; 2013-2014 -->
								</span>
							</div>
							<div class="col-md-4 col-xs-12">
							</div>
						</div>
						
						

						&nbsp; &nbsp;
						<!-- <span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span> -->
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<div class="modal fade" id="modal_login_eod" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
		    <div class="modal-dialog modal-sm">   
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-body">
		          <button type="button" class="close" onclick="closemodalref2()">×</button>
		           <h4 class="modal-title" id="txtref_name">Login</h4><br>
		            <div class="row form-group">
		                <div class="col-xs-12 col-md-3">
		                   Username
		                </div>
		                <div class="col-xs-12 col-md-9">
		                	<span class="input-icon">
								<input type="text" class="form-control" name="" id="txtlogin_username">
								<i class="ace-icon fa fa-user blue"></i>
							</span>
		                </div>
		            </div>
		            <div class="row form-group">
		                <div class="col-xs-12 col-md-3">
		                   Password
		                </div>
		                <div class="col-xs-12 col-md-9">
		                	<span class="input-icon">
								<input type="password" class="form-control" name="" id="txtlogin_password">
								<i class="ace-icon fa fa-lock blue"></i>
							</span>
		                   
		                </div>
		            </div>
		            <div class="row form-group" style="margin-bottom: 0px;">
		                <div class="col-xs-12 col-md-6">
		                   <a href="#" id="btn_inquiry" class="btn btn-danger btn-sm" style="width: 100% !important;" onclick="closemodalref2()">Cancel
		                    </a>
		                </div>
		                <div class="col-xs-12 col-md-6">
		                   <a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="endofdayconfirm()">Login
		                    </a>
		                </div>
		            </div>
		        </div>
		      </div>
		      
		    </div>
		</div>

		<div class="modal fade" id="modal_currdate" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
		    <div class="modal-dialog modal-sm">   
		      <!-- Modal content-->
		      	<div class="modal-content">
			        <div class="modal-body">
						<br> 
						<br>            
			            <div class="row form-group" style="margin-bottom: 5px;">
			                <div class="col-xs-12 col-md-5" style="text-align: right;">
			                	System Date:
			                </div>
			                <div class="col-xs-12 col-md-7" style="text-align: left;">
			                    <label id="txtcurrdate" style="font-weight: bold;"></label>
			                </div>
			            </div>
			            <div class="row form-group" style="margin-bottom: 5px;">
			                <div class="col-xs-12 col-md-5" style="text-align: right;">
			                	Computer Date:
			                </div>
			                <div class="col-xs-12 col-md-7" style="text-align: left;">
			                    <label id="txtcompdate"></label>
			                </div>
			            </div>
						<div class="row form-group">
			                <div class="col-xs-12 col-md-5" style="text-align: right;">
			                	Processed by:
			                </div>
			                <div class="col-xs-12 col-md-7" style="text-align: left;">
			                    <label id="txtprocessdby"></label>
			                </div>
			            </div>
			        </div>
		      	</div>
		    </div>
		</div>

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<?php include "reports/time.php"; ?>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/jquery.sparkline.index.min.js"></script>
		<script src="assets/js/jquery.flot.min.js"></script>
		<script src="assets/js/jquery.flot.pie.min.js"></script>
		<script src="assets/js/jquery.flot.resize.min.js"></script>
		<script src="jquery.nicescroll.min.js"></script>
		<script src="assets/js/bootstrap-tag.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script>
		<script src="assets/js/bootstrap-editable.min.js"></script>
		<script src="assets/js/ace-editable.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>
		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
		
		<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    	<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>

		<!--<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script> -->
		<script src="highcharts/code/highcharts.js" type="text/javascript"></script>
		<script src="highcharts/code/exporting.js" type="text/javascript"></script>
		<script src="highcharts/code/themes/grid-light.js" type="text/javascript"></script>
		<script src="highcharts/code/modules/drilldown.js" type="text/javascript"></script>
		<script src="assets/js/tableHeadFixer.js"></script>
		<script src="assets/js/tablenav.js"></script>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
    window.onbeforeunload = function(e) {
      return 'pogibako?';
    };
</script>
		<script>		
			setInterval(function(){
				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'form=getnum_not',
					success: function(data)
					{
						var arr = data.split("|");
						if(arr[0] != "0"){$("#i_bell_stat").removeClass("icon-animated-bell");$("#i_bell_stat").addClass("icon-animated-bell");}else{$("#i_bell_stat").removeClass("icon-animated-bell");}
						if(arr[0] != "0"){$("#spn_overall_not").text(arr[0])}else{$("#spn_overall_not").text("")}
						if(arr[1] != "0"){$("#spn_penalize").text(arr[1])}else{$("#spn_penalize").text("")}
						if(arr[2] != "0"){$("#spn_endo").text(arr[2])}else{$("#spn_endo").text("")}
					}
				})
			},1000);
			//LIVE DATE AND TIME
			tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
			tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

			function GetClock()
			{
				var d=new Date();
				var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
				if(nyear<1000) nyear+=1900;
				var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

				if(nhour==0){ap=" AM";nhour=12;}
				else if(nhour<12){ap=" AM";}
				else if(nhour==12){ap=" PM";}
				else if(nhour>12){ap=" PM";nhour-=12;}

				if(nmin<=9) nmin="0"+nmin;
				if(nsec<=9) nsec="0"+nsec;

				$('computerdatetime').text("Computer Date: "+""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"");
				document.getElementById('computerdatetime').innerHTML="Computer Date: "+""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
				}

				window.onload=function(){
				GetClock();
				checkingofdate();
				loadnotifications();
				setInterval(GetClock,1000);
				setInterval(checkingofdate,300000);
				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'form=getsysdate',
					success: function(data)
					{
						$("#sysdatetime").text(data)
					}
				})
						
			}

			function loadnotifications(){
			    $.ajax({
			      type: 'POST',
			      url: 'mainclass.php',
			      data: 'form=loadnotifications',
			      success: function(data)
			      {
			        var arr = data.split("|");
			        $("#span_id_notif").attr("title", arr[0]);
			        $("#span_id_notif").html(arr[1]);
			        $('[data-rel=tooltip]').tooltip();
			        $('[data-rel=popover]').popover({html:true});
			      }
			    });
			}

			function checkingofdate(){
				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'form=checkeod',
					success:function(data){
						if(data == "PROCEED EOD"){
							showmodal("confirm", "Current system date is not up to date do you want to proceed to End of Day?", "eod", null, "", null, "1");
						}
					}
				})	
			}

			$(function(){
				GetClock()
				selectpage(1)
				$("#select_all_penalty").click(function(){
					if($(this).is(":checked"))
					{
						$("#tblpenallist .chk_pena").each(function(){$(this).prop("checked", true)});
					}
					else
					{
						$("#tblpenallist .chk_pena").each(function(){$(this).prop("checked", false)});	
					}
				})

				$("#select_all_endo").click(function(){
					if($(this).is(":checked"))
					{
						$("#tblendolist .chk_endo").each(function(){$(this).prop("checked", true)});
					}
					else
					{
						$("#tblendolist .chk_endo").each(function(){$(this).prop("checked", false)});	
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
			})
			var clicknav = 0;
		    $(function(){
		        $("#ace-settings-btn").click(function(){
		            
		            if(clicknav == 0)
		            {
		                $(this).addClass("open");
		                $("#ace-settings-box").addClass("open");
		                $("#interactiveicon").removeClass("fa fa-chevron-circle-left");
		                $("#interactiveicon").addClass("fa fa-chevron-circle-right");
		                clicknav = 1;
		            }
		            else
		            {
		                $(this).removeClass("open");
		                $("#ace-settings-box").removeClass("open");
		                $("#interactiveicon").removeClass("fa fa-chevron-circle-right");
		                $("#interactiveicon").addClass("fa fa-chevron-circle-left");
		                clicknav = 0;
		            }
		        })

		          $('#modal_login_eod').on('shown.bs.modal', function() {
		            $('#txtlogin_username').focus();
		          })
		    })

			$(document).on('show.bs.modal', '.modal', function () {
			    var zIndex = 1040 + (10 * $('.modal:visible').length);
			    $(this).css('z-index', zIndex);
			    setTimeout(function() {
			        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
			    }, 0);
			});

			var zIndex = Math.max.apply(null, Array.prototype.map.call(document.querySelectorAll('*'), function(el) {
			  return +el.style.zIndex;
			})) + 10;

			$(document).on('hidden.bs.modal', '.modal', function () {
			    $('.modal:visible').length && $(document.body).addClass('modal-open');
			});

			$(function(){
				loadprintinfo();
			});

			function endofcontract()
			{
				if($("#spn_endo").text() != "")
				{
					$("#select_all_endo").prop("checked", false);
					loadendolist();
					$("#modal_endo").modal("show");
				}
			}

			function loadendolist()
			{
				if($("#select_all_endo").is(":checked"))
				{
					var chk = "checked";
				}
				else
				{
					var chk = "unchecked";
				}
				var key = $("#txtsearchendo").val();
				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'key='+key+'&form=tblendofcontract',
					beforeSend : function() {
			         $('#spinner_endo').addClass('fa-spin');
			        },
					success: function(data)
					{
						$('#spinner_endo').removeClass('fa-spin');
						$("#tblendolist").html(data);
						if(chk == "checked")
						{
							$("#tblendolist .chk_endo").each(function(){$(this).prop("checked", true)});
						}
						else
						{
							$("#tblendolist .chk_endo").each(function(){$(this).prop("checked", false)});	
						}						
					}
				})
			}

			function endofcontract_proceed()
			{
				var value = "";
				$("#tblendolist .chk_endo").each(function(){
					if($(this).is(":checked"))
					{
						
						value += $(this).attr("value") + "#";
					}
				});

				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'val='+value+'&form=endofcontract',
					success: function(data)
					{
						loadendolist()
						showmodal("alert", "Successfully changed status.", "", null, "", null, "0");
					}
				})
			}

			function endoclick()
			{
				
					var pen = 0;
					$("#tblendolist .chk_endo").each(function(){if($(this).is(":checked")){pen++}});
					if(pen > 0)
					{
							showmodal("alert", "Are you sure you want to change status of selected tenant(s). Click \"OK\" to proceed.", "endofcontract_proceed()", null, "", null, "0");					
					}
					else
					{
						showmodal("alert", "Select tenant first.", "", null, "", null, "1");
					}
			}

			function penalizetenants()
			{
				if($("#spn_penalize").text() != "")
				{
					$("#select_all_penalty").prop("checked", false);
					loadpenallist()
					$("#modal_penalize").modal("show");
				}
			}

			function clickpenalty()
			{
				var pen = 0;
				$("#tblpenallist .chk_pena").each(function(){if($(this).is(":checked")){pen++}});
				if(pen > 0)
				{
						showmodal("alert", "You are about to post penalties of unpaid Tenants. Click \"OK\" to proceed.", "penalizetenants_proceed()", null, "", null, "0");					
				}
				else
				{
					showmodal("alert", "Select penalty first.", "", null, "", null, "1");
				}	
			}

			function loadpenallist()
			{
				var key = $("#txtsearchpenal").val();
				if($("#select_all_penalty").is(":checked"))
				{
					var chk = "checked";
				}
				else
				{
					var chk = "unchecked";
				}

				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'key='+key+'&form=tblpenalizeten',
					beforeSend : function() {
			         $('#spinner_penal').addClass('fa-spin');
			        },
					success: function(data)
					{
						$('#spinner_penal').removeClass('fa-spin');
						$("#tblpenallist").html(data);
						if(chk == "checked")
						{
							$("#tblpenallist .chk_pena").each(function(){$(this).prop("checked", true)});
						}
						else
						{
							$("#tblpenallist .chk_pena").each(function(){$(this).prop("checked", false)});	
						}
					}
				})
			}

			function penalizetenants_proceed()
			{
				var value = "";
				$("#tblpenallist .chk_pena").each(function(){
					if($(this).is(":checked"))
					{
						
						value += $(this).attr("value") + "#";
					}
				});

				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'val='+value+'&form=penalizetenants',
					beforeSend : function() {
			         $('#spinner_penal').addClass('fa-spin');
			        },
					success: function(data)
					{
						$('#spinner_penal').removeClass('fa-spin');
						loadpenallist()
						showmodal("alert", "Successfully posted penalties.", "", null, "", null, "0");
					}
				})
			}



			function loadprintinfo(){
				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'TradeID=' + 'TRADE-0000022' + '&Company_ID=' + 'COM-0000062' + '&Inquiry_ID=' + 'INQ-0000112' + '&form=viewinquiry',
					success: function(data)
					{
						var arr = data.split("|");
						
						if(arr[18] == "0")
						{
							var gitling1 = "";
						}
						else
						{
							var gitling1 = arr[18] + " - ";
						}

						if(arr[17] == "0")
						{
							var gitling2 = "";
						}
						else
						{
							var gitling2 = arr[17] + " - ";
						}
						$("#txtinqprint_dateinquired").text(arr[19]);
						$("#txtinqprint_occupancydate").text(arr[11] + " - " + arr[12]);
						
						$("#txtinqprint_noofmonths").text();
						$("#txtinqprint_advance").text(gitling1 + "Php " + arr[16]);
						$("#txtinqprint_deposit").text(gitling2 + "Php " + arr[15]);
						$("#txtinqprint_ttlamountpdc").text();

					}
				});

				$.ajax({
				  type: 'POST',
				  url: 'mainclass.php',
				  data: 'companyID=' + 'COM-0000062' + '&tradeID=' + 'TRADE-0000022' +'&form=selecttenant',
				  success: function(data)
				  {
				  	// alert(data)
				    var arr = data.split("|");
				    $("#txtinqprint_storename").text(arr[13]);
				    $("#txtinqprint_companyname").text(arr[1]);
				    $("#txtinqprint_industry").text(arr[3]);
				    $("#txtinqprint_busadd").text(arr[4]);
				  }
				});

				$.ajax({
				  type: 'POST',
				  url: 'mainclass.php',
				  data: 'companyID=' + 'COM-0000062' + '&tradeID=' + 'TRADE-0000022' +'&form=selectcontactnumbers',
				  success: function(data)
				  {
				    $("#div_inquiry_contact_numbers").html(data);
				  }
				});

				// $.ajax({
				//   type: 'POST',
				//   url: 'mainclass.php',
				//   data: 'companyID=' + 'COM-0000062' + '&tradeID=' + 'TRADE-0000022' +'&form=selectcontactpersons',
				//   success: function(data)
				//   {
				//     $("#div_inquiry_contact_person").html(data);
				//   }
				// });

				$.ajax({
				  type: 'POST',
				  url: 'mainclass.php',
				  data: 'Company_ID=' +'COM-0000062'+ '&TradeID=' +'TRADE-0000022'+ '&UnitID=' +'U-0000040'+ '&Inquiry_ID='+'INQ-0000112'+ '&form=selectunit',
				  success: function(data)
				  {
				  	// alert(data)
				    var arr = data.split("|");
				    $("#txtinqprint_unit").text(arr[1]);
					$("#txtinqprint_flrname").text(arr[17]);
					$("#txtinqprint_wingname").text(arr[18]);
					$("#txtinqprint_unittype").text(arr[10]);
					$("#txtinqprint_area").text(arr[15] +" x "+arr[16]);
					$("#txtinqprint_class").text(arr[19]);
					$("#txtinqprint_priceperarea").text(arr[3]);
					$("#txtinqprint_depa").text(arr[20]);
					$("#txtinqprint_ttlprice").text(arr[4]);
					$("#txtinqprint_monthlypayment").text(arr[4]);
					$("#txtinqprint_unitcategory").text(arr[21]);

					if(arr[10] == "SET")
	     			{

					}
	    			else if(arr[10] == "LCA")
	    			{

	    			}
				  }
				})

				$.ajax({
				  type: 'POST',
				  url: 'mainclass.php',
				  data: 'unit_id=' + 'U-0000040' + '&form=selected_unit_amenities2',
				  success: function(data)
				  {
				    $("#amenities_list").html(data);
				  }
				})
			}

 			$(function(){
				$("#sys_body").niceScroll({cursorcolor:"#999"});
				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'form=getuserdata',
					success: function(data)
					{
						// alert(data)
						var arr = data.split("|");
						$("#lbluser").text(arr[0]);
						$("#imguser").attr("alt", arr[0] +"'s Photo");
						$("#imguser").attr("src",arr[3])
						$("#txt_syssetup").val(arr[2]);
					}
				});
				$.ajax({
					type: 'POST',
					url: 'mainclass.php',
					data: 'form=titletext',
					success:function(data){
						$("#titletext").text(data);
					}
				})
			});

			function eod(){
		        $("#modal_login_eod").modal("show");
		    }

		    function closemodalref2(){
		  		$("#modal_login_eod").modal("hide");
		  	}  

		  	function endofdayconfirm(){
		  		var username = $("#txtlogin_username").val();
		  		var password = $("#txtlogin_password").val();
		  		if(username != "" && password != ""){
			  		$.ajax({
			  			type: 'POST',
			  			url: 'billing/billingmainclass.php',
			  			data: '&username=' + username +
							  '&password=' + password +
							  '&form=endofdayconfirm',
			  			success: function(data)
			  			{
			  				if(data == ""){
			  					alert("User not found.");
			  					$("#txtlogin_username").css("border-color", "#f2a696");
								$("#txtlogin_password").css("border-color", "#f2a696");
			  				}
			  				else{
			  					$("#txtlogin_username").css("border-color", "#D5D5D5");
								$("#txtlogin_password").css("border-color", "#D5D5D5");
								$("#txtlogin_username").val("");
								$("#txtlogin_password").val("");
						  		$("#modal_login_eod").modal("hide");
						  		showmodal("confirm", "You are about to EOD, this will automatically log you out are you sure about this action?", "executefunc(\"continue\", \""+data+"\")", null, "executefunc(\"cancel\", \""+data+"\")", null, "0");  					
			  				}
			  			}
			  		})  			
		  		}
		  		else{
		  			if(username == "" && password == ""){
		  				$("#txtlogin_username").css("border-color", "#f2a696");
						$("#txtlogin_password").css("border-color", "#f2a696");
						showmodal("alert", "Please enter username and password.", "focusto(\"txtlogin_username\")", null, "", null, "1");
		  			}
		  			else if(username == "" && password != ""){
		  				$("#txtlogin_username").css("border-color", "#f2a696");
		  				$("#txtlogin_password").css("border-color", "#D5D5D5");
		  				$("#txtlogin_username").focus();
		  				showmodal("alert", "Please enter username.", "focusto(\"txtlogin_username\")", null, "", null, "1");
		  			}
		  			else if(username != "" && password == ""){
		  				$("#txtlogin_password").css("border-color", "#f2a696");
		  				$("#txtlogin_username").css("border-color", "#D5D5D5");
		  				$("#txtlogin_password").focus();
		  				showmodal("alert", "Please enter password.", "focusto(\"txtlogin_password\")", null, "", null, "1");
		  			}
		  		}
		  	}

		  	function executefunc(action, name){
		  		if(action == "continue"){
					$.ajax({
						type: 'POST',
						url: 'billing/billingmainclass.php',
						data: 'name='+name+'&form=proceed_endofday',
						success: function(data){
							var arr = data.split("|");
							$("#txtcurrdate").text(arr[0]);
							$("#txtcompdate").text(arr[1]);
							$("#txtprocessdby").text(arr[2]);
							$("#alertmodal").modal("hide");
							$("#modal_currdate").modal("show");
							setTimeout(function(){
								window.location = "setcookie.php?type=out&userid=";
							}, 5000)
						}
					})
		  		}
		  		else if(action == "cancel"){
					$("#alertmodal").modal("hide");
		  		}
		  	}
			

/* End by  Mike */

/* End */
</script>
		<?php 
		include("alert_modal/modal.php"); 
		include("test.php"); 
		include("header/modal_notification.php");
		include("setup/script.php");
    	include("zxreading/index.php");
		?>
		<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyC2AilVLipxetunhcxHM4U1Pc-hm7Fy-U8&libraries=places&callback=myMap"></script> -->
	</body>
</html>
