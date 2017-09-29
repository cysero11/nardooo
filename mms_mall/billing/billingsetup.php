<div class="row form-group" style="margin-bottom: 7px;">
    <div class="col-md-4" style="padding-right: 0px;">
       <div class="search-area well well-sm" style="padding-bottom: 0px;">
            <div class="search-filter-header bg-primary">
                <h5 class="smaller no-margin-bottom">
                    <i class="ace-icon fa fa-sliders light-green bigger-130"></i>&nbsp;&nbsp; Billing Period
                </h5>
            </div>
            <div class="space-10"></div>
            <div class="row form-group widget-box" style="padding-top: 10px;padding-bottom: 10px;">
                <div class="col-md-2"><h6 style="margin-top:8px;margin-left: 8px;">Month</h6></div>
                <div class="col-md-4">
                    <select class="form-control txtrefsoa" id="txtref_monthprd">
                        <option value="">-- Month --</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="col-md-2"><h6 style="margin-top:8px;margin-left: 8px;">Year</h6></div>
                <div class="col-md-4">
                    <select class="form-control txtrefsoa" id="txtref_yrprd" onchange="">
                        <option value="">-- Year --</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option> 
                        <option value="2021">2021</option>    
                        <option value="2022">2022</option>    
                        <option value="2023">2023</option>    
                        <option value="2024">2024</option>    
                        <option value="2025">2025</option>    
                        <option value="2026">2026</option>    
                        <option value="2027">2027</option> 
                        <option value="2028">2028</option> 
                        <option value="2029">2029</option> 
                        <option value="2030">2030</option>                                        
                    </select>
                </div>
            </div>
            <div class="widget-box" style="padding:10px;margin-top: 10px;">
                <div class="row form-group">
                    <div class="col-md-3"><h6 style="margin-top:8px;margin-left: 8px;">Start Date</h6>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group date" data-provide="datepicker">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar bigger-110"></span>
                            </div>
                            <input type="text" class="form-control numonly input-mask-date txtrefsoa" id="txtref_strtdate" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3"><h6 style="margin-top:8px;margin-left: 8px;">End Date</h6>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group date" data-provide="datepicker">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar bigger-110"></span>
                            </div>
                            <input type="text" class="form-control numonly input-mask-date txtrefsoa" id="txtref_enddate" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3"><h6 style="margin-top:8px;margin-left: 8px;">Due Date</h6>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group date" data-provide="datepicker">
                            <div class="input-group-addon">
                                <span class="fa fa-calendar bigger-110"></span>
                            </div>
                            <input type="text" class="form-control numonly input-mask-date txtrefsoa" id="txtref_duedate" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <button class="btn btn-success" style="margin-top: 8px;float: right;" onclick="savenewperiodref()"><i class="ace-icon fa fa-check bigger-110"></i>&nbsp;Save Period</button>
                </div>
            </div>
       </div>                    
    </div>
    <div class="col-md-8">
        <div class="widget-box widget-color-green">
            <div class="widget-header">
                <h4 class="widget-title lighter smaller">Billing Periods</h4>
            </div>
            <div class="widget-body" style="height: 317px;display: block;">
                <div class="parent3">
                    <table class="table  table-bordered table-hover fixTable">
                        <thead>
                            <tr>
                                <th style="background-color: #f2f2f2 !important;color:#707070;width:25%;">Period</th>
                                <th style="background-color: #f2f2f2 !important;color:#707070;width:25%;">Start Date</th>
                                <th style="background-color: #f2f2f2 !important;color:#707070;width:25%;">End Date</th>
                                <th style="background-color: #f2f2f2 !important;color:#707070;width:25%;">Due Date</th>
                            </tr>
                        </thead>
                        <tbody id="tblperiodreflist">                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                            
    </div>
</div>

<script>
$(function(){
    loadrefperiodlist();
})

function loadrefperiodlist() {
    $.ajax({
        type: 'POST',
        url: 'billing/billingmainclass.php',
        data: 'form=loadrefperiodlist',
        success: function(data)
        {
            $("#tblperiodreflist").html(data);
        }
    })
}

function savenewperiodref()
{
    var i = 0;
    $(".txtrefsoa").each(function(){
        var thisval = $(this).val();
        if(thisval == "")
        {
            i++;
            $(this).css("border-color","#f2a696");
        }
    });

    if(i == 0)
    {
        var monthprd = $("#txtref_monthprd").val();
        var yrprd = $("#txtref_yrprd").val();
        var strtdate = $("#txtref_strtdate").val();
        var enddate = $("#txtref_enddate").val();
        var duedate = $("#txtref_duedate").val();

        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'monthprd='+monthprd+'&yrprd='+yrprd+'&strtdate='+strtdate+'&enddate='+enddate+'&duedate='+duedate+'&form=savenewperiodref',
            success: function(data)
            {
                if(data == "1")
                {
                    $(".txtrefsoa").css("border-color", "#CCC");
                    $(".txtrefsoa").val("");
                    loadrefperiodlist();
                    loaddalladdedref();
                    showmodal("alert", "Billing period for "+monthprd+" "+yrprd+" has been setup.", "", null, "", null, "0");
                }
                else if(data == "2")
                {
                    $(".txtrefsoa").css("border-color","#f2a696");
                    showmodal("alert", "Sorry, but period for "+monthprd+" "+yrprd+" are already done with setup.", "", null, "", null, "1");
                }
                else
                {
                    showmodal("alert", "An error occured.", "", null, "", null, "1");
                }
            }
        })        
    }
    else
    {
       showmodal("alert", "Fill all required fields to proceed.", "", null, "", null, "1");
    }    
}
</script>