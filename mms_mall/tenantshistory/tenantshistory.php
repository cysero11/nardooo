<!-- <link rel="stylesheet" href="../assets/bootstrap-3.3.2/css/bootstrap.css"> -->
<style>
    .parent {
        height: 40vh;
    }

    .parent-tenant{
        height: 30vh;
        border: 2px solid #ccc;
    }

    .activated  td{
        color: #FFF !important;
        background-color: #777 !important;
    }

    tbody tr td { cursor: hand !important; cursor: pointer !important; }

    /* Let's get this party started */
    ::-webkit-scrollbar {
        width: 5px;
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
        background: gray;
        -webkit-box-shadow: inset 0 0 6px gray;
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: rgba(255,0,0,0.4);
    }

    .modal-header{
        background-color: #428BCA;
        color: #FFF;
    }

    .modal-title{
        font-style: Roboto !important;
        font-size: 18px !important;
        /*font-weight: bold;*/
    }

    .table thead td{
        font-size: 13px;
        font-weight: bold;
        color: black !important;
    }

    .table tbody tr{
        color: black;
    }

    .big-one {
        font-weight: 700;
    }

    .row{
        margin-bottom: 4px;
    }

    .divinfo input {
        color: black !important;
    }

    .myspinner
    {
      width: 100%;
      height: 21em;
      background: url(assets/images/spinner2.gif) center no-repeat, #eeeeee;
      position: absolute;
      /*margin-left: -15px;*/
      opacity: 0.5;
      z-index: 1000;
    }

    .myspinner2
    {
      width: 90%;
      height: 15em;
      background: url(assets/images/spinner2.gif) center no-repeat, #eeeeee;
      position: absolute;
      /*margin-left: -15px;*/
      opacity: 0.5;
      z-index: 1000;
    }    
</style>

<?php 
    include("../setup/systemsetup/script.php");
    include('historyscript.php');
    include('printhistory.php');
?>

<div class="page-header row" style="margin-bottom: 10px;padding-top:10px;background-color: #edf4f8;padding-bottom: 10px;">
	<div class="col-md-3 col-xs-12" style="padding-left: 0px!important;">
		<h1 style="font-weight: bold;">TENANT HISTORY</h1>
            <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;List of History</h6>
	</div>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-md-3">
        <span class="input-icon" style="width: 100%; margin-bottom: 4px;">
            <input type="text" class="form-control input-sm" placeholder="Search" title="Search according to filter selected" id="srchhistory" onkeyup="tblstorename();" style="color: black !important;">
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
        <div class="parent-tenant">
            <table class="table table-striped table-bordered table-hover fixTable">
                <thead>
                    <tr>
                        <td>Trade Name</td>
                    </tr>
                </thead>
                <div class="" id="tenant_history_list"></div>
                <tbody id="tblstorename">

                </tbody>
            </table>
        </div>
	</div>
    <div class="col-md-9">
        <br>
        <div class="row form-group divinfo">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label class="big-one">Mall Name</label>
                        <input type="text" class="form-control input-sm" id="mallname" style="text-align: center;"/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-sm-5">Company ID</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" id="compid" />
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5">Company Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" id="compname" />
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5">Store Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" id="storename" />
                    </div>
                </div>

            </div>

            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label class="big-one">Tenant ID</label>
                        <input type="text" class="form-control input-sm" id="tenantid" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <label class="col-sm-5">First Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" id="fname" />
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5">Middle Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" id="lname" />
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5">Last Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" id="mname" />
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div id="imgledgerhere">
                    <center>
                        <img id="historylogo" class="img-responsive img-thumbnail" style="height: 180px; width: 180px;" onerror="imgerror($(this));">
                    </center>
                </div>
            </div>

        </div>

	</div>
</div>
<br>
<div class="row">
    <div class="col-md-12" id="historyreport">
        <div class="row stat" style="font-size: 14px;">
            <div class="col-md-6">
                <span style="font-weight: 700;">Status :</span>&nbsp;&nbsp;
                <span><span class="fa fa-flag" style="font-weight: 700; color: #DFE21A;"></span> Active</span>&nbsp;|&nbsp;
                <span><span class="fa fa-flag" style="font-weight: 700; color: DarkGray;"></span> In-active</span>&nbsp;|&nbsp;
                <span><span class="fa fa-flag" style="font-weight: 700; color: #428BCA;"></span> For Renewal</span>&nbsp;|&nbsp;
                <spa><span class="fa fa-flag" style="font-weight: 700; color: red;"></span> For Eviction</span>&nbsp;|&nbsp;
                <span><span class="fa fa-flag" style="font-weight: 700; color: grey;"></span> Evicted</span>
                <!-- <input type="hidden" id="txtstatus" value="actived">
                <input type="hidden" id="txtcompid" value="COM-0000005"> -->
            </div>
            <div class="col-md-6">
                <button class="btn btn-xs btn-flat btn-primary pull-right" name="button" onclick="printhistory();"><span class="fa fa-print"></span> Print</button>
            </div>
        </div>
        <div id="forhistory" class="parent">
            <table id="storeinfotable" class="table table-striped table-bordered table-hover fixTable">
                <thead>
                    <tr>
                        <td width = '7%'></td>
                        <td width = '14%'>Trade Name</td>
                        <td width = '8%'>Unit ID</td>
                        <td width = '10%'>Unit Name</td>
                        <td width = '10%'>Floor Location</td>
                        <td width = '15%'>Contract Date</td>
                        <td width = '14%'>No. of Months & Days</td>
                        <td width = '10%'>Cost per Month</td>
                        <td width = '4%'>Status</td>
                    </tr>
                </thead>
                <div class="" id="tenant_history_div"></div>
                <tbody id="tblstoreunit">

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
//show datepicker when clicking on the icon

                $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format:"mm/dd/yyyy"
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });

                //or change it into a date range picker
                $('.input-daterange').datepicker({autoclose:true});


                //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
                // $('input[name=date-range-picker]').daterangepicker({
                //     'applyClass' : 'btn-sm btn-success',
                //     'cancelClass' : 'btn-sm btn-default',
                //     locale: {
                //         applyLabel: 'Apply',
                //         cancelLabel: 'Cancel',
                //     }
                // })
                // .prev().on(ace.click_event, function(){
                //     $(this).next().focus();
                // });
</script>
