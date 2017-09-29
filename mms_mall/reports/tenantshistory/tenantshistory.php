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

    .big-one {
        font-weight: 700;
    }
    
    .divinfo input {
        color: black !important;
    }
</style>

<?php 
    include("../../setup/systemsetup/script.php");
    include('../tenantshistory/historyscript.php');
    include('../tenantshistory/printhistory.php');
?>
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
                <span><span class="fa fa-flag" style="font-weight: 700; color: red;"></span> For Eviction</span>&nbsp;|&nbsp;
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
                $('input[name=date-range-picker]').daterangepicker({
                    'applyClass' : 'btn-sm btn-success',
                    'cancelClass' : 'btn-sm btn-default',
                    locale: {
                        applyLabel: 'Apply',
                        cancelLabel: 'Cancel',
                    }
                })
                .prev().on(ace.click_event, function(){
                    $(this).next().focus();
                });
</script>
