<div class="row">
    <div class="col-xs-12">
        <div class="row form-group" style="margin-bottom: 5px;">
            <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-right: 0px;">
                <!-- <span class="input-icon" style="width: 100%;">
                    <input type="text" class="form-control tooltipyss" placeholder="Search"  data-tooltip-content="#tooltip_content6" id="txtsearchapplication" onkeyup="tbltenantlists(this.value)">
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span> -->
            </div>
            <div class="col-md-4 col-xs-4"></div>
            <div class="col-md-6 col-xs-12">
                <label class="control-label col-md-2">Date Range</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control date-picker" id="pdcdateFrom" value="<?php echo date('m/d/Y'); ?>">
                        <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control date-picker" id="pdcdateTo" value="<?php echo date('m/d/Y'); ?>">
                        <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                    </div>
                </div>
                <button class="btn btn-info btn-sm" onclick="tbllistofpdc()"><span class="glyphicon glyphicon-search"></span> Go</button>
                <!-- <button class="glyphicon glyphicon-print btn btn-sm btn-info" onclick="printcomplaints()" style="margin-bottom: 3px;"></button> -->
            </div>
        </div>
        <div class="row form-group" style="margin-bottom: 0px !important;">
            <div class="col-xs-12">
                <div class="parent">
                    <table id="simple-table" class="table  table-bordered table-striped fixTable">
                        <thead>
                            <tr>
                                <td width="5%">PDC Date</td>
                                <td width="8%"></td>
                                <td width="12%">Tenant ID</td>
                                <td width="13%">Trade Name</td>
                                <td width="10%">Amount</td>
                                <td width="12%">Depository Status</td>
                                <td width="10%">Check Status</td>
                                <td width="5%">Bank</td>
                                <td width="10%">Check No.</td>
                                <td width="10%">Penalty</td>
                            </tr>
                        </thead>
                        <div class="" id="load_billing_table"></div>
                        <tbody id="tbllistofpdc"></tbody>
                    </table>
                </div>
               <table class="tabledash_footer table" style="margin: 0px !important;">
                    <thead>
                        <tr>
                            <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                                <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtbillingentriespdc"><br /></font>
                                <input type="hidden" id="txt_userpagepdc" class="form-control input-sm" style="width: 5%; text-align: center;">
                                <ul id="ulpaginationlistofpdc" class="pagination pull-right"></ul>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> 
    </div>
</div>
<script type="text/javascript">
$(function(){
    $("#txt_userpagepdc").val("1");
})

function tbllistofpdc(){
    var dateFrom = $("#pdcdateFrom").val();
    var dateTo = $("#pdcdateTo").val();
    var page = $("#txt_userpagepdc").val();
    $.ajax({
        type: 'POST',
        url: 'billing/billingmainclass.php',
        data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&page=' + page + '&form=tbllistofpdc',
    success:function(data){
        $("#tbllistofpdc").html(data);
        loadentriespdc();
        loadpagespdc();
    }
    })
}

function loadentriespdc(){
    var dateFrom = $("#pdcdateFrom").val();
    var dateTo = $("#pdcdateTo").val();
    var page = $("#txt_userpagepdc").val();
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&page=' + page + '&form=loadentriespdc',
            success: function(data){
                if(data == ""){
                    $("#txtbillingentriespdc").text("");
                }
                else{
                    $("#txtbillingentriespdc").text(data);
                }
            }
        });
    }

function loadpagespdc(){
    var dateFrom = $("#pdcdateFrom").val();
    var dateTo = $("#pdcdateTo").val();
    var page = $("#txt_userpagepdc").val();
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&page=' + page + '&form=loadpagespdc',
            success: function(data){
                $("#ulpaginationlistofpdc").html(data);
            }
        });
    }

function paginationpdc(page, pagenums){
    $(".pgnumpdc").removeClass("active");
    var value = "#" + pagenums;
    $("#pgpdc" + pagenums).addClass("active");
    $("#txt_userpagepdc").val(page);
    tbllistofpdc();
    loadpagespdc();
    loadentriespdc();
}

function editfield(checkno){
    $("#edit"+checkno).css("display", "none");
    $("#confirm"+checkno).css("display", "block");
    $("#cancel"+checkno).css("display", "block");
    $.ajax({
        type: 'POST',
        url: 'billing/billingmainclass.php',
        data: 'checkno=' + checkno + '&form=editfield',
    success:function(data){
        var arr = data.split("|");
        $("#tdcheckstat"+checkno).html(arr[0]);
        $("#tdamount"+checkno).html(arr[1]);
        $("#tddepositorystat"+checkno).html(arr[3]);
        $("#tdpenalty"+checkno).html(arr[2]);
    }
    })
}

function canceledit(checkno){
    $("#edit"+checkno).css("display", "block");
    $("#confirm"+checkno).css("display", "none");
    $("#cancel"+checkno).css("display", "none");
    $.ajax({
        type: 'POST',
        url: 'billing/billingmainclass.php',
        data: 'checkno=' + checkno + '&form=cancelfield',
    success:function(data){
        var arr = data.split("|");
        $("#tdamount"+checkno).html(arr[0]);
        $("#tddepositorystat"+checkno).html(arr[1]);
        $("#tdcheckstat"+checkno).html(arr[2]);
        $("#tdpenalty"+checkno).html(arr[3]);
    }
    })
}

function saveeditedpdc(checkno){
    $("#edit"+checkno).css("display", "block");
    $("#confirm"+checkno).css("display", "none");
    $("#cancel"+checkno).css("display", "none");
    var amount = $("#amount"+checkno).val();
    var depositorystat = $("#depositorystat"+checkno).val();
    var checkstat = $("#checkstat"+checkno).val();
    var penalty = $("#penalty"+checkno).val();
    $.ajax({
        type: 'POST',
        url: 'billing/billingmainclass.php',
        data: '&checkno=' + checkno + '&amount=' + amount + '&depositorystat=' + depositorystat + '&checkstat=' + checkstat + '&penalty=' + penalty + '&form=saveeditedpdc',
    success:function(data){
        var arr = data.split("|");
        $("#tdamount"+checkno).html(arr[0]);
        $("#tddepositorystat"+checkno).html(arr[1]);
        $("#tdcheckstat"+checkno).html(arr[2]);
        $("#tdpenalty"+checkno).html(arr[3]);
    }
    })
}
</script>