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
            <!-- <div class="col-md-6 col-xs-12">
                <label class="control-label col-md-2">Date Range</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control date-picker" id="dateFrom" value="<?php echo date('m/d/Y'); ?>">
                        <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control date-picker" id="dateTo" value="<?php echo date('m/d/Y'); ?>">
                        <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                    </div>
                </div>
                <button class="btn btn-info btn-sm" onclick="displaycomplaints2()"><span class="glyphicon glyphicon-search"></span> Go</button>
                <button class="glyphicon glyphicon-print btn btn-sm btn-info" onclick="printcomplaints()" style="margin-bottom: 3px;"></button>
            </div> -->
        </div>
        <div class="row form-group" style="margin-bottom: 0px !important;">
            <div class="col-xs-12">
                <div class="parent">
                    <table id="simple-table" class="table  table-bordered table-striped fixTable">
                        <thead>
                            <tr>
                                <td width="20%">Tenant ID</td>
                                <td width="20%">Description</td>
                                <td width="20%">Amount</td>
                                <td width="20%">VAT Amount</td>
                                <td width="20%">Total Amount</td>
                            </tr>
                        </thead>
                        <div class="" id="load_billing_table"></div>
                        <tbody id="tbllistofpenalties"></tbody>
                    </table>
                </div>
               <table class="tabledash_footer table" style="margin: 0px !important;">
                    <thead>
                        <tr>
                            <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                                <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtbillingentries123"><br /></font>
                                <input type="hidden" id="txt_userpage10" class="form-control input-sm" style="width: 5%; text-align: center;">
                                <ul id="ulpaginationlistofpenalties" class="pagination pull-right"></ul>
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
    $("#txt_userpage10").val("1");
})

function displaylistofpenalty(){
    var page = $("#txt_userpage10").val();
    $.ajax({
        type: 'POST',
        url: 'billing/billingmainclass.php',
        data: 'page=' + page + '&form=displaylistofpenalty',
    success:function(data){
        $("#tbllistofpenalties").html(data);
        loadentriespenalties();
        loadpagespenalties();
    }
    })
}

function loadentriespenalties(){
    var page = $("#txt_userpage10").val();
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'page=' + page + '&form=loadentriespenalties',
            success: function(data){
                if(data == ""){
                    $("#txtbillingentries123").text("");
                }
                else{
                    $("#txtbillingentries123").text(data);
                }
            }
        });
    }

function loadpagespenalties(){
    var page = $("#txt_userpage10").val();
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'page=' + page + '&form=loadpagelistofpenalties',
            success: function(data){
                $("#ulpaginationlistofpenalties").html(data);
            }
        });
    }

 function paginationpenalties(page, pagenums){
    $(".pgnumpenalties").removeClass("active");
    var value = "#" + pagenums;
    $("#pgpenalties" + pagenums).addClass("active");
    $("#txt_userpage10").val(page);
    displaylistofpenalty();
    loadpagespenalties();
    loadentriespenalties();
}
</script>