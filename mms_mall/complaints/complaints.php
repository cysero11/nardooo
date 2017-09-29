<?php
include("../connect.php");
include("printcomplaints.php");
include("script.php");
?>
<style>
    tbody tr td { cursor: hand !important; cursor: pointer !important; }

.parent {
    height: 50vh;
}

.parent2 {
    height: 30vh;
}

.parent3 {
    height: 20vh;
}

.divstat span:hover{
    border-bottom: 1px solid #438EB9;
    color: #438EB9;
    cursor: pointer;
    font-weight: bold;
}
    
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
        background: gray;
        -webkit-box-shadow: inset 0 0 6px gray;
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: rgba(255,0,0,0.4);
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

    .popover {
      min-width: 500px ! important;
      width: auto;
    }

    .popover-content{
        padding-left: 0px; /* Max Width of the popover (depending on the container!) */
        padding-right: 0px;
    }
    
    .myspinner2{
    width: 100%;
    height: 65em;
    background: url(assets/images/spinner2.gif) center no-repeat, #eeeeee;
    position: absolute;
    /*margin-left: -15px;*/
    opacity: 0.5;
    z-index: 1000;
    }
    
</style>

<div class="page-header" style="margin-bottom: 10px;padding-top:10px;background-color: #edf4f8;padding-bottom: 10px;">
    <h1><b>COMPLAINTS</b></h1>
        <div id="legendsofcomplaints" class="pull-right" style="text-align: center; margin-top: -20px;margin-right: 40px;">
            <span style="font-weight: 700;">Priority Status :</span>&nbsp;&nbsp;
            <span class="label label-sm label-danger">High Priority</span>
            <span class="label label-sm label-warning">Medium Priority</span>
            <span class="label label-sm label-yellow" style="background-color:rgba(255, 255, 0, 0.62);">Low Priority</span>
        </div>
        <div id="legendsofhouserules" class="pull-right" style="text-align: center; margin-top: -20px;margin-right: 40px;display: none;">
            <span style="font-weight: 700;">Violation Level :</span>&nbsp;&nbsp;
            <i class="fa fa-circle" style="color: #F89406;"></i> 1st Offense&nbsp;&nbsp;
            <i class="fa fa-circle" style="color: #D6487E;"></i> 2nd Offense&nbsp;&nbsp;
            <i class="fa fa-circle" style="color: #D15B47;"></i> 3rd Offense&nbsp;&nbsp;
            <i class="fa fa-circle" style="color: #333;"></i> More than 3 Offense
        </div>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active thistab" onclick="displaycomplaints2();showlegendsofcomplaints();">
                    <a data-toggle="tab" href="#COMPLAINTS" style="color: black; font-weight: bold">
                        <i class="green ace-icon fa fa-frown-o bigger-120"></i>
                      Complaints
                    </a>
                </li>

                <li class="thistab" onclick="tblviolation();hidelegendsofcomplaints();">
                    <a data-toggle="tab" href="#HOUSERULES" style="color: black; font-weight: bold">
                        <i class="green ace-icon fa fa-gavel bigger-120"></i>
                        Incident Reports
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="COMPLAINTS" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="row form-group"> 
                                <div class="col-md-6 col-xs-6">

                                    <div class="col-md-4 col-xs-4" style="margin-left: -24px;">
                                        <span class="input-icon" style="width: 100%;">
                                            <input type="text" class="form-control" placeholder="Search" title="Search according to filter selected" id="txtsearchcomplaints" onkeyup="displaycomplaints2();">
                                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                                        </span>
                                    </div>

                                    <div class="col-md-3 col-xs-3" style="padding-bottom: 5px;padding-left:0px;">
                                    <h5><a onclick="loadfilters_complaints('Complaints')" id="LINK_complaints_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='

                                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:80px;">&nbsp;&nbsp;Select by&nbsp;&nbsp;</legend>
                                            <div class="form-group row" style="margin:0px;">
                                                <div class="col-md-6">
                                                    <label>
                                                        <input name="form-field-checkbox" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="TenantID" id="filter_TenantID">
                                                        <span class="lbl"> Tenant ID</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        <input name="form-field-checkbox" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="Complaint_Code" id="filter_Complaint_Code">
                                                        <span class="lbl"> Complaint Code</span>
                                                    </label>                               
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        <input name="form-field-checkbox" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="Company" id="filter_Company">
                                                        <span class="lbl"> Trade Name</span>
                                                    </label>                            
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        <input name="form-field-checkbox" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="Complete_Description" id="filter_Complete_Description">
                                                        <span class="lbl"> Complaint Description</span>
                                                    </label>                            
                                                </div>
                                            </div>
                                    </fieldset>

                                      <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:100px;">&nbsp;&nbsp;Filter Status&nbsp;&nbsp;</legend>
                                          <div class="form-group row" style="margin:0px;">
                                            <div class="col-md-4" style="padding-right:0px;">
                                              <label class="label label-danger" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                <input name="form-field-checkbox-pstat" class="ace" type="checkbox" value="High" id="filter_High">
                                                <span class="lbl"> High Priority</span>
                                              </label>
                                            </div>
                                            <div class="col-md-4" style="padding-right:0px;">
                                              <label class="label label-warning" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                <input name="form-field-checkbox-pstat" class="ace" type="checkbox" value="Medium" id="filter_Medium">
                                                <span class="lbl"> Medium Priority</span>
                                              </label>
                                            </div>
                                            <div class="col-md-4">
                                              <label class="label" style="margin-bottom: 0px;height:22px;padding-left:4px;background-color:rgba(255, 255, 0, 0.62);">
                                                <input name="form-field-checkbox-pstat" class="ace" type="checkbox" value="Low" id="filter_Low">
                                                <span class="lbl" style"color:#333;"> Low Priority</span>
                                              </label>
                                            </div>
                                          </div>
                                      </fieldset>

                                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:189px;">&nbsp;&nbsp;Filter by Complaint Status&nbsp;&nbsp;</legend>
                                            <div class="form-group row" style="margin:0px;">
                                                <div class="col-md-4" style="padding-right:0px;">
                                                    <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                        <input name="form-field-checkbox-angbawatisaaymaykarapatangmamili" class="ace" type="checkbox" value="Resolved" id="filter_Resolved">
                                                        <span class="lbl"> Resolved</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4" style="padding-right:0px;">
                                                    <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                        <input name="form-field-checkbox-angbawatisaaymaykarapatangmamili" class="ace" type="checkbox" value="Ongoing" id="filter_Ongoing">
                                                        <span class="lbl"> Ongoing</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label style="margin-bottom:0px;height:22px;padding-left:4px">
                                                        <input name="form-field-checkbox-angbawatisaaymaykarapatangmamili" class="ace" type="checkbox" value="Pending" id="filter_Pending">
                                                        <span class="lbl"> Pending</span>
                                                    </label>
                                                </div>
                                            </div>
                                    </fieldset>

                                      <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
                                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:90px;">&nbsp;&nbsp;Date Entry&nbsp;&nbsp;</legend>
                                          <div class="form-group row" style="margin:0px;">
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-5">
                                              <div class="input-group">
                                                <span class="input-group-addon">
                                                  <i class="fa fa-calendar bigger-110"></i>
                                                </span>
                                                <input class="form-control date-picker" type="text" name="" id="dateentrystart" data-provide="datepicker">
                                              </div>                
                                            </div>
                                            <div class="col-md-5">
                                              <div class="input-group">
                                                <span class="input-group-addon">
                                                  <i class="fa fa-calendar bigger-110"></i>
                                                </span>
                                                <input class="form-control date-picker" type="text" name="" id="dateentryend" data-provide="datepicker">
                                              </div>                
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                          </div>
                                        </fieldset>

                                    <div class="form-group row" style="padding-left:8px;margin-bottom:0px;">
                                          <div class="col-md-9" style="padding-right:0px;">
                                            <div class="alert alert-info" style="padding-top:10px;padding-bottom:10px;">
                                              <button class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                              </button>
                                              Click "<b>OK</b>" to filter data and permanently save the filter selected.
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <button class="btn btn-xs btn-info" onclick="savecomplaintsfilter()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                OK
                                            </button>
                                          </div>'>
                                        <i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
                                </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="pull-right">
                                       <h5><a onclick="showprintbyme();" class="popover-info" data-rel="popover" data-placement="bottom" title="Print by" data-content='
                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                                <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:105px;">&nbsp;&nbsp;Filter by Mall&nbsp;&nbsp;</legend>
                                                    <div class="form-group row" style="margin:0px;">
                                                        <select class="form-control malloption" id="printbymec"></select>
                                                    </div>
                                            </fieldset>

                                          <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
                                              <div class="form-group row" style="margin:0px;">
                                                
                                                <div class="col-md-6">
                                                  <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control date-picker" type="text" id="dateFrom" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
                                                  </div>                
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control date-picker" type="text" id="dateTo" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
                                                  </div>                
                                                </div>
                                               
                                              </div>
                                            </fieldset>

                                            <div class="form-group row" style="padding-left:8px;margin-bottom:0px;">
                                                <div class="col-md-9" style="padding-right:0px;">
                                                    <div class="alert alert-info" style="padding-top:10px;padding-bottom:10px;">
                                                        <button class="close" data-dismiss="alert">
                                                            <i class="ace-icon fa fa-times"></i>
                                                        </button>
                                                  Select the range of date you want to print.
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-xs btn-success" onclick="printcomplaints()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                    Print
                                                </button>
                                            </div>'>
                                        <i class="glyphicon glyphicon-print bigger-110"></i>&nbsp;&nbsp;Print</a></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group" style="margin-bottom: 0px !important;margin-left: -24px;margin-right: -25px;margin-top: -20px;">
                                <div class="col-xs-12">

                                    <div class="parent">
                                        <table class="table table-bordered table-striped fixTable">
                                            <thead>
                                                <tr>
                                                    <td>Tenant ID</td>
                                                    <td>Date Entry</td>
                                                    <td>Complaint Code</td>
                                                    <td>Complaint Description</td>
                                                    <td>Trade Name</td>
                                                    <td>Date & Time Received</td>
                                                    <td>Date & Time Resolved</td>
                                                    <td>Assigned Person</td>
                                                    <td>Complaint Status</td>
                                                    <td>Priority Status</td>
                                                    <td>User Name</td>
                                                    <td>Options</td>
                                                </tr>
                                            </thead>
                                            <tbody id="displaycomplaints2" ></tbody>
                                        </table>
                                    </div>
                                    <table class="tabledash_footer table" style="margin: 0px !important;">
                                        <thead>
                                            <tr>
                                                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtcomplaintsentries"></label>
                                                        </div>                               
                                                        <div class="col-md-6">
                                                            <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                                                            <ul id="ulpaginationcomplaint" class="pagination pull-right"></ul>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="HOUSERULES" class="tab-pane fade">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="row form-group">
                                <div class="col-md-6 col-xs-6">

                                    <div class="col-md-4 col-xs-4" style="margin-left: -24px;">
                                        <span class="input-icon" style="width: 100%;">
                                            <input type="text" class="form-control" placeholder="Search" title="Search according to filter selected" id="txtsearchhr" onkeyup="tblviolation();">
                                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                                        </span>
                                    </div>

                                    <div class="col-md-3 col-xs-3" style="padding-bottom: 5px;padding-left:0px;">
                                    <h5><a onclick="loadfilters_HouseRules('HouseRules')" id="LINK_HouseRules_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='

                                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:80px;">&nbsp;&nbsp;Select by&nbsp;&nbsp;</legend>
                                            <div class="form-group row" style="margin:0px;">
                                                <div class="col-md-6">
                                                    <label>
                                                        <input name="form-field-checkbox-hrfilter" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="VSeriesNumber" id="filter_VSeriesNumber">
                                                        <span class="lbl"> Violation Series Number</span>
                                                    </label>                               
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        <input name="form-field-checkbox-hrfilter" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="ViolatorName" id="filter_ViolatorName">
                                                        <span class="lbl"> Tenant/Employee Name</span>
                                                    </label>
                                                </div>
                                            </div>
                                    </fieldset>

                                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:189px;">&nbsp;&nbsp;Filter by Violation Status&nbsp;&nbsp;</legend>
                                            <div class="form-group row" style="margin:0px;">
                                                <div class="col-md-6" style="padding-right:0px;">
                                                    <label class="label label-success" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                        <input name="form-field-checkbox-hrstat" class="ace" type="checkbox" value="Resolved" id="filter_Resolved">
                                                        <span class="lbl"> Resolved</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="label label-warning" style="margin-bottom:0px;height:22px;padding-left:4px">
                                                        <input name="form-field-checkbox-hrstat" class="ace" type="checkbox" value="Pending" id="filter_Pending">
                                                        <span class="lbl"> Pending</span>
                                                    </label>
                                                </div>
                                            </div>
                                    </fieldset>

                                      <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
                                        <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:90px;">&nbsp;&nbsp;Date Entry&nbsp;&nbsp;</legend>
                                          <div class="form-group row" style="margin:0px;">
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-5">
                                              <div class="input-group">
                                                <span class="input-group-addon">
                                                  <i class="fa fa-calendar bigger-110"></i>
                                                </span>
                                                <input class="form-control date-picker" type="text" name="" id="hrstart" data-provide="datepicker">
                                              </div>                
                                            </div>
                                            <div class="col-md-5">
                                              <div class="input-group">
                                                <span class="input-group-addon">
                                                  <i class="fa fa-calendar bigger-110"></i>
                                                </span>
                                                <input class="form-control date-picker" type="text" name="" id="hrend" data-provide="datepicker">
                                              </div>                
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                          </div>
                                        </fieldset>

                                    <div class="form-group row" style="padding-left:8px;margin-bottom:0px;">
                                          <div class="col-md-9" style="padding-right:0px;">
                                            <div class="alert alert-info" style="padding-top:10px;padding-bottom:10px;">
                                              <button class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                              </button>
                                              Click "<b>OK</b>" to filter data and permanently save the filter selected.
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <button class="btn btn-xs btn-info" onclick="saveHouseRulesfilter()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                OK
                                            </button>
                                          </div>'>
                                        <i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
                                </div>
                                </div>
                               <div class="col-md-4 col-xs-12">
                                    <div class="pull-right">
                                        <h5><a onclick="showprintbyme()" class="popover-info" data-rel="popover" data-placement="bottom" title="Print by" data-content='
                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                                <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:105px;">&nbsp;&nbsp;Filter by Mall&nbsp;&nbsp;</legend>
                                                    <div class="form-group row" style="margin:0px;">
                                                        <select class="form-control malloption" id="printbymehr"></select>
                                                    </div>
                                            </fieldset>

                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;">
                                            <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:100px;">&nbsp;&nbsp;Date Range&nbsp;&nbsp;</legend>
                                                <div class="form-group row" style="margin:0px;">
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar bigger-110"></i>
                                                            </span>
                                                            <input class="form-control date-picker" type="text" id="dateFromhr" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
                                                        </div>                
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                            <i class="fa fa-calendar bigger-110"></i>
                                                            </span>
                                                            <input class="form-control date-picker" type="text" id="dateTohr" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
                                                        </div>                
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="form-group row" style="padding-left:8px;margin-bottom:0px;">
                                                <div class="col-md-9" style="padding-right:0px;">
                                                    <div class="alert alert-info" style="padding-top:10px;padding-bottom:10px;">
                                                        <button class="close" data-dismiss="alert">
                                                            <i class="ace-icon fa fa-times"></i>
                                                        </button>
                                                  Select the range of date you want to print.
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-xs btn-success" onclick="printcomplaintshr()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                    Print
                                                </button>
                                            </div>'>
                                        <i class="glyphicon glyphicon-print bigger-110"></i>&nbsp;&nbsp;Print</a></h5>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <button class="btn btn-sm btn-info btn-block" onclick="createviolation()">Create A Violation Ticket</button>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 0px !important;margin-left: -24px;margin-right: -25px;margin-top: -20px;">
                                <div class="col-xs-12">

                                    <div class="parent">
                                        <table class="table table-bordered table-striped fixTable">
                                            <thead>
                                                <tr>
                                                    <td>Violation Series No.</td>
                                                    <td>Tenant/Employee Name</td>
                                                    <td>Violation/s</td>
                                                    <td>Date</td>
                                                    <td>Time</td>
                                                    <td>Status</td>
                                                    <td>Options</td>
                                                </tr>
                                            </thead>
                                            <tbody id="tblviolation" ></tbody>
                                        </table>
                                    </div>
                                    <table class="tabledash_footer table" style="margin: 0px !important;">
                                        <thead>
                                            <tr>
                                                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txthrentries"></label>
                                                        </div>                               
                                                        <div class="col-md-6">
                                                            <input type="hidden" id="txt_userpagehr" class="form-control input-sm" style="width: 5%; text-align: center;">
                                                            <ul id="ulpaginationhr" class="pagination pull-right"></ul>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR CREATING A VIOLATION -->
<div class="modal fade" tabindex="-1" id="modalviolation" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-info ">
        <div class="modal-content">
            <div class="modal-header"><label id="womodalmetereadingheader">Create A Violation Ticket</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="removeinputs()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Select type of violator
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <div class="col-xs-6 col-md-6 col-lg-6">
                                    <label>
                                        <input name="form-field-radio" type="radio" id="chktenant" value="Tenant" onclick="iftenantischecked();" class="ace typeofviolator">
                                        <span class="lbl"> Tenant</span>
                                    </label>
                                </div>
                                <div class="col-xs-6 col-md-6 col-lg-6">
                                    <label>
                                        <input name="form-field-radio" type="radio" id="chkemployee" value="Employee" onclick="ifemployeeischecked();" class="ace typeofviolator">
                                        <span class="lbl"> Employee</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Select Person
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <select id="selectwhoeveritis" class="form-control"></select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Select Violation
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <button class="btn btn-sm btn-primary btn-block" onclick="modalviolationselection();"><i class="ace-icon fa fa-level-up"></i>&nbsp;Shortcut</button>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="parent3">
                                <table class="table table-bordered table-striped fixTable">
                                    <thead>
                                        <tr>
                                            <td width="20%">Code</td>
                                            <td width="80%">Violation</td>
                                        </tr>
                                    </thead>
                                    <tbody id="tblviolistmini"></tbody>
                                </table>
                            </div>
                            <table class="tabledash_footer table" style="margin: 0px !important;">
                                <thead>
                                    <tr>
                                        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtcomplaintsentries"></label>
                                                </div>                               
                                                <div class="col-md-6">
                                                    <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                                                    <ul id="ulpaginationcomplaint" class="pagination pull-right"></ul>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-md btn-primary" onclick='saveviolationticket();'>Save</button>
                <button class="btn btn-md btn-danger" onclick='closeandclearviolationcreationmodal();'>Close</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR SELECTING A VIOLATION -->
<div class="modal fade" tabindex="-1" id="modalviolationselection" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" style="width:85% !important;">
        <div class="modal-content" style="width:100% !important;">
            <div class="modal-header"><label id="womodalmetereadingheader">List of Violations</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="removeinputs()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="parent">
                            <table class="table table-bordered table-striped fixTable">
                                <thead>
                                    <tr>
                                        <td style="display: none;"></td>
                                        <td width="10%">Code</td>
                                        <td width="40%">Violation</td>
                                        <td width="10%">1st Offense</td>
                                        <td width="10%">2nd Offense</td>
                                        <td width="10%">3rd Offense</td>
                                        <td width="10%">Succeeding</td>
                                    </tr>
                                </thead>
                                <tbody id="tblviolationlist" ></tbody>
                            </table>
                        </div>
                        <table class="tabledash_footer table">
                            <thead>
                                <tr>
                                    <th id="th_tabledash_footer" colspan="7" style="width: 911px;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtcomplaintsentries"></label>
                                            </div>                               
                                            <div class="col-md-6">
                                                <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                                                <ul id="ulpaginationcomplaint" class="pagination pull-right"></ul>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: -40px;">
                <button class="btn btn-md btn-primary" id="btnforuploadinghidden" onclick="savecheckedviolations();">Save</button>
                <button class="btn btn-md btn-danger" onclick='$("#modalviolationselection").modal("hide")'>Close</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR RESOLVING VIOLATION -->
<div class="modal fade" tabindex="-1" id="viewticketmodal" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">House Rules
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="removeinputs()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="well" style="height: 105px;">
                            <div class="row form-group">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="row form-group">
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="row">
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <label style="font-weight: bold;">Violation Series Number</label>
                                                </div>
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <label id="vtmvseriesnumber"></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <label style="font-weight: bold;" id="viewticketmodaldestino">Tenant Name</label>
                                                </div>
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <label id="vtmpangalan"></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <label style="font-weight: bold;" id="viewticketmodalkinabibilangan">Unit No.</label>
                                                </div>
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <label id="vtmlokasyon"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="row">
                                                <div class="col-xs-4 col-md-4 col-lg-4">
                                                    <label style="font-weight: bold;"></label>
                                                </div>
                                                <div class="col-xs-8 col-md-8 col-lg-8">
                                                    <label></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4 col-md-4 col-lg-4">
                                                    <label style="font-weight: bold;">Date</label>
                                                </div>
                                                <div class="col-xs-8 col-md-8 col-lg-8">
                                                    <label id="vtmpetsa"></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4 col-md-4 col-lg-4">
                                                    <label style="font-weight: bold;">Time</label>
                                                </div>
                                                <div class="col-xs-8 col-md-8 col-lg-8">
                                                    <label id="vtmoras"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="parent2" style="margin-top: -25px;">
                            <table class="table table-bordered table-striped fixTable">
                                <thead>
                                    <tr>
                                        <td>Violation</td>
                                        <td>Resolution</td>
                                        <td>Violation Level</td>
                                        <td>Status</td>
                                        <td>Fine</td>
                                    </tr>
                                </thead>
                                <tbody id="tblticketinformation"></tbody>
                            </table>
                        </div>
                        <table class="tabledash_footer table">
                            <thead>
                                <tr>
                                    <th id="th_tabledash_footer" colspan="7" style="width: 911px;">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtcomplaintsentries"></label>
                                            </div>                               
                                            <div class="col-md-6">
                                                <ul id="ulpaginationcomplaint" class="pagination pull-right"></ul>
                                                <label class="pull-right" id="modaltxttamount"></label>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: -40px;">
                <button class="btn btn-md btn-warning" id="btnpostingsabilling" onclick="checkmunabagopost();" disabled>Post To Billing</button>
                <button class="btn btn-md btn-danger" onclick='$("#viewticketmodal").modal("hide")'>Close</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR ADDING RESOLUTION -->
<div class="modal fade" tabindex="-1" id="modalAddReso" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"><label id="modalAddResoheader">List of Violations</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="removeinputs()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        Resolution: 
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <textarea class="form-control" style="height: 200px;resize: none;" id="modaltxtReso"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-2 col-md-2 col-lg-2" style="margin-top: 10px;">
                        Charges: 
                    </div>
                    <div class="col-xs-5 col-md-5 col-lg-5" style="margin-left: -40px;">
                        <input type="text" class="form-group" id="txtchargeamount">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-md btn-primary" id="btnAddReso" onclick="savemodalAddReso();">Save</button>
                <button class="btn btn-md btn-danger" onclick='$("#modalAddReso").modal("hide")'>Close</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="modalAddResoids">
<input type="hidden" id="checkedviolation">
<input type="hidden" id="hiddenid">

<div class="modal fade" id="modalAlert">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                System Alert
            </div>

            <div class="modal-body">
                <center><h3 id="alertStat"></h3></center>
            </div>

            <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span> OK</button>
            </div>
        </div>
    </div>
</div>