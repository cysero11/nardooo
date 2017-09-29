<style>
    .parent {
        height: 45vh;
    }

    tbody tr td { cursor: hand !important; cursor: pointer !important; }

/* Let's get this party started */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px #eee;
    -webkit-border-radius: 10px;
    border-radius: 10px;
}

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
        ul.pagination {
        display: inline-block;
        padding: 0;
        margin: 0;
    }

    ul.pagination li {
        cursor: pointer;
        display: inline;
        color: white;
        font-weight: 600;
        padding: 4px 8px;
        border: 1px solid #CCC;
    }

    .pagination li:first-child{
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }

    .pagination li:last-child{
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
    }

    ul.pagination li:hover{
        background-color: #FFFFFF;
        color: #3c8dbc;
    }

    .pagination .active{
        background-color: #FFFFFF;
        color: #3c8dbc;
    }

    .myspinner2
    {
      width: 100%;
      height: 25em;
      background: url(assets/images/spinner2.gif) center no-repeat, #eeeeee;
      position: absolute;
      /*margin-left: -15px;*/
      opacity: 0.5;
      z-index: 1000;
    }
    /* Pagination END */
</style>
<script>

	function tbltenantlists(val){
        var txtsearchapplication = $("#txtsearchapplication").val();
        var page = $("#txt_userpage").val();
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'txtsearchapplication=' + txtsearchapplication + '&page=' + page + '&val=' + val + '&form=tbltenantlists',
            beforeSend : function() {
             $('#load_billing_table').addClass('myspinner2');
            },
              success: function(data) 
              {
            $('#load_billing_table').removeClass('myspinner2');
                $("#tbltenantlists").html(data);
                    loadentriesbilling();
                    loadpagebilling();

            }
        });
    }
	
	function openbilling(transid, trade, company, mallbranch, storecode, billtype)
	{
		$("#txtbillingtenantid").text(transid);
		$("#txtbillingcompanyname").text(company);
		$("#txtbillingtradename").text(trade);
        $("#txtbillingmallbranch").text(mallbranch);
        $("#txtbillingstorecode").text(storecode);
        $("#txtbillingtype").text(billtype);
		showbilling();
	}
	
	function showbilling()
	{
		$("#billingmodal").modal("show");
		var transid = $("#txtbillingtenantid").text();
		var month = $("#txtfiltermonth").val();
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'transid=' + transid + '&month=' + month +'&form=loadtransaction',
			success: function(data) 
			{
				var arr = data.split("|");
				$("#tbltranstenantdetails").html(arr[1]);
				$("#windowtotal").text("Balance:   " + arr[2]);
			}
		});
	}

	function opensetup()
	{
		$("#tenanttypesetupmodal").modal("show");
		loadtenanttype("");
	}

</script>
<div class="page-header row" style="padding-bottom: 0px;">
 <div class="row form-group" style="margin-bottom: 0px;padding-top:10px;background-color: #edf4f8;">
    <div class="col-md-2">
        <h1 style="font-weight: bold;">BILLING</h1>
        <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;Billing Transactions</h6>
        <input type="hidden" id="txtapplicationpages" name="">    
    </div>
    <div class="col-md-10">
    </div>
 </div>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12" style="padding: 0px;">
		<div class="row form-group" style="margin-bottom: 5px;">
			<div class="col-md-3 col-xs-12" style="padding-bottom: 5px;padding-right: 0px;">
				<span class="input-icon" style="width: 100%;">
           		    <input type="text" class="form-control" placeholder="Search" title="Search according to filter selected" id="txtsearchapplication" onkeyup="tbltenantlists(this.value)">
           		    <i class="ace-icon fa fa-search nav-search-icon"></i>
            	</span>
            </div>
            <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-right: 0px;">
                <div class="input-group date" data-provide="datepicker">
                    <div class="input-group-addon">
                        <span class="fa fa-calendar bigger-110"></span>
                    </div>
                    <input type="text" class="form-control" id="txtidxdate" placeholder="mm/yyyy" onclick="loadperiodlist()">
                </div>
            </div>
            <div class="col-md-2" style="padding-bottom: 5px;">
                <a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="lmodal_listoftents()">Generate Monthly Rent
				</a>
            </div>
			<!--<div class="col-md-2" style="padding-bottom: 5px;">
                <a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="opensetup()">Tenant Type Setup
				</a>
            </div>
			<div class="col-md-2" style="padding-bottom: 5px;">
                <a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="opentenantreport()">Tenant Type Report
				</a>
            </div>-->
            <div class="col-md-3 col-xs-12" style="padding-bottom: 5px;">
				<!-- <a href="#" id="btn_inquiry" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_inquiry()">New Application</a> -->
            </div>
		</div>
		<div class="row form-group" style="margin-bottom: 0px !important;">
			<div class="col-xs-12">
                <div class="parent">
				<table id="simple-table" class="table  table-bordered table-striped fixTable">
                    <thead>
                        <tr>
                            <td width="5%" class="hide_mobile"></td>
                            <td width="15%" class="hide_mobile">Tenant ID</td>
							<td width="20%" class="hide_mobile">Trade Name</td>
                            <td width="20%" class="hide_mobile">Company</td>
                            <td width="15%" class="scroll">Total Balance</td>
                            <td width="15%" class="scroll">Billing Type</td>
                            <td width="10%" class="scroll">Rev Percentage</td>
                        </tr>
                    </thead>
                    <div class="" id="load_billing_table"></div>
                    <tbody id="tbltenantlists"></tbody>
                </table>
            </div>
               <table class="tabledash_footer table" style="margin: 0px !important;">
                    <thead>
                        <tr>
                            <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                                <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtbillingentries"><br /></font>
                                <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                                <ul id="ulpaginationbilling" class="pagination pull-right"></ul>
                            </th>
                        </tr>
                    </thead>
            </table>
       
    </div>
</div>


<?php
    include("../setup/systemsetup/script.php");
    include("billing_modal.php");
?>
<script type="text/javascript">
    setTimeout(function(){
        tbltenantlists();
        loadentriesbilling();
    $(".fixTable").tableHeadFixer(); 
     $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
        });
    }, 500)

    $(function(){
       tbltenantlists();
        loadentriesbilling();
        $("#txt_userpage").val("1");
    });

    function lmodal_listoftents(){
        $("#txtxdatepass").val("");
        var xdate = $("#txtidxdate").val();
        if(xdate!==""){
            $.ajax({
                type:'POST',
                url:'billing/billingmainclass.php',
                data: 'xdate=' + xdate + '&form=lmodal_listoftents',
                success:function(data){
                    $("#txtxdatepass").val(xdate);
                    $("#tbltenantlistrent").html(data);
                    $("#billingmodallistoftenatsrents").modal('show');
                }
            });    
        }else{
            showmodal("alert", "Please Select Date First.", "", null, "", null, "0");
            $("#txtidxdate").focus();
        }
        
    }

    function closelisttenst(){
        $("#txtxdatepass").val("");
        $("#tbltenantlistrent").html("");
        $("#billingmodallistoftenatsrents").modal('hide');
    }

    function savettenantslist(){
        var xdate = $("#txtxdatepass").val();
        $.ajax({
            type:'POST',
            url:  'billing/billingmainclass.php',
            data: 'xdate=' + xdate +'&form=savettenantslist',
            success:function(data){
                if(data=='1'){
					showmodal("alert", "Date has been generated.", "", null, "", null, "0");
                    closelisttenst();
					tbltenantlists("");
                }else{
                    showmodal("alert", "Selected month have existing record already.", "", null, "", null, "0");
                    // showmodal("alert", "Something went wrong!.", "", null, "", null, "0");
                }
            }
        });
    }

    function loadentriesbilling(){
        var page = $("#txt_userpage").val();
        var txtsearchapplication = $("#txtsearchapplication").val();

        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'txtsearchapplication=' + txtsearchapplication + '&page=' + page  + '&form=loadentriesbilling',
            success: function(data){
                if(data == "no data"){
                    $("#txtbillingentries").html("<br />");
                }
                else{
                    $("#txtbillingentries").text(data);
                }
            }
        });
    }

function loadpagebilling(){
        var page = $("#txt_userpage").val();
        var txtsearchapplication = $("#txtsearchapplication").val();

        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'page=' + page + '&txtsearchapplication=' + txtsearchapplication + '&form=loadpagebilling',
            success: function(data){
                $("#ulpaginationbilling").html(data);
            }
        });
    }

function pagination(page, pagenums){
    $(".pgnum").removeClass("active");
    var value = "#" + pagenums;
    $("#pg" + pagenums).addClass("active");
    $("#txt_userpage").val(page);
    tbltenantlists();
    loadpagebilling();
    loadentriesbilling();
}

function loadperiodlist()
{
    $.ajax({
        type: 'POST',
        url: 'billing/billingmainclass.php',
        data: 'form=loadperiodlist',
        success: function(data)
        {
            alert(data)
            $("#tblperiodlist").html(data);
            $("#modal_select_period").modal("show");            
        }
    })

}

$.mask.definitions['~']='[+-]';
$('.input-mask-date').mask('99/99/9999', {placeholder:" "});
</script>