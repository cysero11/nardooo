<style>
.parent {
    height: 47vh;
}
.parent2 {
    height: 28vh;
}
.parent3 {
    height: 39vh;
}
.parent4 {
    height: 24vh;
}
.parent5 {
    height: 44vh;
}
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
                $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
                $("#tbltenantlists").html(data);
                    loadentriesbilling();
                    loadpagebilling();
            }
        });
    }
    
    function openbilling(transid, trade, company, mallbranch, storecode, billtype, filename)
    {
        $("#imglogo").attr("src", filename);
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
                $("#tbltranstenantdetails").html(arr[0]);
                $("#windowtotal").text("Running Balance:   " + arr[1]);
            }
        });
    }

    function showdrilldown(xdate, tenantid){
        $("#modaldrilldown").modal("show");
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'xdate=' + xdate + '&tenantid=' + tenantid + '&form=showdrilldowncharges',
            success:function(data){
                $("#div_charges").html(data);
            }
        })
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'xdate=' + xdate + '&tenantid=' + tenantid + '&form=showdrilldownothercharges',
            success:function(data){
                $("#div_othercharges").html(data);
            }
        })
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'xdate=' + xdate + '&tenantid=' + tenantid + '&form=showdrilldownpayment',
            success:function(data){
                $("#div_payment").html(data);
            }
        })
    }

    function opensetup()
    {
        $("#tenanttypesetupmodal").modal("show");
        loadtenanttype("");
    }
</script>
<div class="page-header row" style="padding-bottom: 0px;">
 <div class="row form-group" style="margin-bottom: 0px;padding-top:10px;background-color: #edf4f8;">
    <div class="col-md-3">
        <h1 style="font-weight: bold;">BILLING</h1>
        <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;Tenants Bill and Statement of Account</h6>
        <input type="hidden" id="txtapplicationpages" name="">    
    </div>
    <div class="col-md-4">
        
    </div>
    <div class="col-md-5 col-xs-12" style="margin-top: 15px;">
        <span>All Status:</span>&nbsp;
        <span class="label label-success arrowed-in-right arrowed"><i class="ace-icon fa fa-tag bigger-80"></i>&nbsp;&nbsp;Rent + Revenue&nbsp;</span>
        <span class="label label-info arrowed-in-right arrowed"><i class="ace-icon fa fa-tag bigger-80"></i>&nbsp;&nbsp;Rent Only&nbsp;</span>
        <span class="label label-yellow arrowed-in-right arrowed"><i class="ace-icon fa fa-tag bigger-80"></i>&nbsp;&nbsp;Rent or Share&nbsp;</span>
        <span class="label label-light arrowed-in-right arrowed"><i class="ace-icon fa fa-tag bigger-80"></i>&nbsp;&nbsp;Share Only&nbsp;</span>
    </div>
 </div>
</div>

<div class="row">
	<div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#usercont1">
                    <i class="green ace-icon fa fa-dollar bigger-120"></i>
                    Billing
                </a>
            </li>
            <li onclick="displaylistofpenalty();">
                <a data-toggle="tab" href="#usercont4">
                    <i class="green ace-icon fa fa-exclamation bigger-120"></i>
                    List of Penalty
                </a>
            </li>
            <li onclick="tbllistofpdc();">
                <a data-toggle="tab" href="#usercont5">
                    <i class="green ace-icon fa fa-credit-card bigger-120"></i>
                    List of PDC
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="usercont1" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row form-group" style="margin-bottom: 5px;">
                            <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-right: 0px;">
                                <span class="input-icon" style="width: 100%;">
                                    <input type="text" class="form-control" placeholder="Search"  title="Search according to filter selected" id="txtsearchapplication" onkeyup="tbltenantlists(this.value)">
                                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </div>
                            <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-right: 0px;"></div>
                            <div class="col-md-2" style="padding-bottom: 5px;"></div>
                            <div class="col-md-2" style="padding-bottom: 5px;">
                                <a href="#" class="btn btn-purple btn-sm" style="width: 100% !important;" onclick='opensoamodal();loadpreviousperiods();'><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;SOA
                                </a>
                            </div>
                            <div class="col-md-2" style="padding-bottom: 5px;">
                                <a href="#" class="btn btn-success btn-sm" style="width: 100% !important;" onclick='$("#modal_orlist").modal("show");loadtblorlist();'><i class="ace-icon fa fa-tasks"></i>&nbsp;View O.R
                                </a>
                            </div>
                            <div class="col-md-2" style="padding-bottom: 5px;">
                                <a href="#" class="btn btn-warning btn-sm" style="width: 100% !important;" onclick="openpaymentmodule()"><i class="ace-icon fa fa-money"></i>&nbsp;Payment
                                </a>
                            </div>
                        </div>
                        <div class="row form-group" style="margin-bottom: 0px !important;">
                            <div class="col-xs-12">
                                <div class="parent">
                                    <table id="simple-table" class="table  table-bordered table-striped fixTable">
                                        <thead>
                                            <tr>
                                                <td width="15%" class="hide_mobile">Tenant ID</td>
                                                <td width="20%" class="hide_mobile">Store Name</td>
                                                <td width="20%" class="hide_mobile">Company</td>
                                                <td width="15%" class="scroll">Billing Type</td>
                                                <td width="10%" class="scroll">Rev Percentage</td>
                                                <td width="15%" class="scroll">Total Balance</td>
                                                <td width="5%" class="hide_mobile"></td>
                                            </tr>
                                        </thead>
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
                    </div>
                </div>             
            </div>
            <div id="usercont4" class="tab-pane fade">
                <?php include("listofpenalty.php"); ?>
            </div>
            <div id="usercont5" class="tab-pane fade">
                <?php include("listofpdc.php"); ?>
            </div>
        </div>
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
    $(".numonly").keydown(function(event) {

       // Allow only backspace and delete
       if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190 || event.keyCode == 9 || event.keyCode == 188) {
           // let it happen, don't do anything
       }
       else {
           // Ensure that it is a number and stop the keypress
           if (event.keyCode < 48 || event.keyCode > 57 || event.keyCode == 17) {
               event.preventDefault(); 
           }   
       }
    });

    $(".amount").change(function(){
        var x = ($(this).val()).replace(/,/g,"");
        var v = parseFloat(x||0);
        $(this).val(v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    });
    $(".date-picker").datepicker({
            autoHide: true,
            format: 'mm/dd/yyyy',
            todayHighlight: true
        });

    $(function(){
       $("#tblperiodlist").niceScroll({cursorcolor:"#999"});
       tbltenantlists();
       loadentriesbilling();
       $("#txt_userpage").val("1");
    });

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


    function loadperiodlist(){
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'form=loadperiodlist',
            success: function(data)
            {
                $("#tblperiodlist_choices").html(data);
                $("#modal_select_period").modal("show");            
            }
        })
    }

$.mask.definitions['~']='[+-]';
$('.input-mask-date').mask('99/99/9999', {placeholder:" "});
</script>