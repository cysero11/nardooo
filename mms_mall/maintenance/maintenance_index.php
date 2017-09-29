<?php 
include ("../maintenance/maintenancescript.php");
include ("../maintenance/complaintsscript.php");
include ("../connect.php");
?>
<style>
.parent {
    height: 50vh;
}

.ace-settings-box.open {
    max-width: 800px !important;
}

.popover {
  min-width: 450px ! important;
  width: auto;
}

.popover-content{
    padding-left: 0px; /* Max Width of the popover (depending on the container!) */
    padding-right: 0px;
    }
</style>

<div class="page-header" style="margin-bottom: 10px;padding-top:10px;background-color: #edf4f8;padding-bottom: 10px;">
    <h1><b>MAINTENANCE</b></h1>

    <br>
    <input type="hidden" id="txtmaintenancepages">
        <div id="pangcomplaints" style="display: none;">
            <div class="clearfix pull-right" style="text-align: center;margin-top: -30px;margin-right: 20px;">
               <span style="font-weight: 700;">Priority Status :</span>&nbsp;&nbsp;
                <span class="label label-sm label-danger">High Priority</span>
                <span class="label label-sm label-warning">Medium Priority</span>
                <span class="label label-sm label-yellow" style="background-color:#FEE188;color: #963;">Low Priority</span>
            </div>
        </div>

        <div style="margin-left: 10px;">
            <input type="hidden" class="form-control date-picker" id="automaticsetup" value="<?php echo date('m/d/Y'); ?>">
            <input type="hidden" id="youcantseeme">
            <input type="hidden" id="datengpaggawa">
        </div>
</div>
<div class="ace-settings-container" id="ace-settings-container">
    <div class="btn btn-app btn-xs btn-primary ace-settings-btn" id="ace-settings-btn2">
        <i class="ace-icon fa fa-chevron-circle-left bigger-130" id="interactiveicon2"></i>
    </div>
    <div class="ace-settings-box clearfix" id="ace-settings-box2" style="width:70em !important;border-color: #337ab7;">
        <div class="row form-group">
            <div class="col-xs-12">
                <center><h5 style="font-weight: bold; font-size: 16px;">Building Maintenance Checklist</h5></center>
                <table style="float: left;margin-bottom: 10px;">
                    <tr>
                        <td colspan="4" style="font-weight: bold;padding-bottom: 5px;">LEGEND:</td>
                    </tr>
                    <tr>
                        <td style="width: 20px;background-color: #80ffaa;"></td>
                        <td style="font-style: italic;padding-right: 20px;">&nbsp;&nbsp;Done</td>
                        <td style="width: 20px;background-color: #ff9999;"></td>
                        <td style="font-style: italic;">&nbsp;&nbsp;Pending</td>
                    </tr>
                </table>
                <table id="simple-table-2" class="table table-bordered table-hover" style="margin-bottom:0px;margin-top: 20px;">
                    
                </table>
            </div>
        </div>
    </div>
</div> 
<!-- === TAB PANEL -->
<div class="row">
    <div class="col-sm-12">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active thistab">
                    <a data-toggle="tab" href="#settask" style="color: black; font-weight: bold">
                        <i class="green ace-icon fa fa-pencil bigger-120"></i>
                      Set Task
                    </a>
                </li>

                <li class="thistab" onclick="hidefilterngcomplaints();">
                    <a data-toggle="tab" href="#joborderlist" onclick="tblworkorder()" style="color: black; font-weight: bold">
                        <i class="green ace-icon fa fa-list-alt bigger-120"></i>
                        Work Order List
                    </a>
                </li>

                <li class="thistab" onclick="showfilterngcomplaints();">
                    <a data-toggle="tab" href="#complaints" onclick="displaycomplaints();" style="color: black; font-weight: bold">
                        <i class="green ace-icon fa fa-frown-o bigger-120"></i>
                       Complaints
                    </a>
                </li>

                <li class="thistab" onclick="hidefilterngcomplaints();">
                    <a data-toggle="tab" href="#maintenancebudget" style="color: black; font-weight: bold">
                        <i class="green ace-icon fa fa-dollar bigger-120"></i>
                       Maintenance Budget
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="settask" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-md-12" id="tenanttask">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <center style="color: white; font-size: 16px">Work Order</center>
                                </div>
                                <div class="panel-body">
                                    <div class="row form-group">
                                        <div class="col-xs-3 col-md-3 col-lg-3 btn-group">
                                            <button class="btn btn-md btn-success" onclick="savenewworkorder()"><i class="fa fa-check"></i>&nbsp;&nbsp;Save</button>
                                            <button class="btn btn-md btn-danger" onclick="clearingoftextboxifsuccess()"><i class="fa fa-refresh"></i>&nbsp;&nbsp;Reset</button>
                                        </div>
                                        <div class="col-xs-9 col-md-9 col-lg-9 btn-group">
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-md btn-light" onclick="addwojob()"><i class="green fa fa-plus"></i>&nbsp;&nbsp;Add Job</button>
                                                <button class="btn btn-md btn-light" onclick="addwotask()"><i class="green fa fa-plus"></i>&nbsp;&nbsp;Add Task</button>
                                                <button class="btn btn-md btn-light" onclick="deletechecked()"><i class="red glyphicon glyphicon-minus-sign"></i>&nbsp;&nbsp;Delete</button>
                                                <button class="btn btn-md btn-light" onclick="removechecksacheckbox()"><i class="blue glyphicon glyphicon-refresh"></i>&nbsp;&nbsp;Reset Checks</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <center style="color: white; font-size: 16px;">Work Order Information</center>
                                            </div>
                                                <div class="panel-body">

                                                    <div class="row form-group">
                                                        <div class="col-xs-4 col-md-4 col-lg-4" style="margin-top: 7px;">
                                                            <label class="control-label">Is this billed to a tenant?</label>
                                                        </div>
                                                        <div class="col-xs-7 col-md-7 col-lg-7" style="margin-top: 8px;">
                                                            <div class="col-xs-3 col-md-3 col-lg-3">
                                                                <label>
                                                                    <input name="form-field-radio" type="radio" id="billedyes" onclick="billedyes();" class="billedornot ace">
                                                                    <span class="lbl"> Yes</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-xs-6 col-md-6 col-lg-6">
                                                                <label>
                                                                    <input name="form-field-radio" type="radio" id="billedno" onclick="billedno()" class="billedornot ace">
                                                                    <span class="lbl"> No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-xs-8  col-md-8 col-lg-8">
                                                            <div class="row form-group">
                                                                <div class="col-xs-4 col-md-4 col-lg-4" style="margin-top: 7px;">
                                                                    <label class="control-label" id="Tenantshow">Tenant</label>
                                                                    <label class="control-label" id="Maintenanceshow">Maintenance</label>
                                                                </div>
                                                                <div class="col-xs-8 col-md-8 col-lg-8">
                                                                    <select id="wotenantlist" class="form-control"></select>
                                                                    <select id="womanagementlist" class="form-control"></select>
                                                                </div>
                                                            </div>
                                                             <div class="row form-group">
                                                                <!-- <div class="col-xs-2 col-md-2 col-lg-2"></div> -->
                                                                <div class="col-xs-4 col-md-4 col-lg-4">
                                                                    <label class="control-label">Assigned Department</label>
                                                                </div>
                                                                <div class="col-xs-8 col-md-8 col-lg-8">
                                                                    <select id="woperson" class="form-control"></select>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <!-- <div class="col-xs-2 col-md-2 col-lg-2"></div> -->
                                                                <div class="col-xs-4 col-md-4 col-lg-4" style="margin-top: 7px;">
                                                                    <label class="control-label">Remarks</label>
                                                                </div>
                                                                <div class="col-xs-8 col-md-8 col-lg-8">
                                                                    <textarea class="form-control text_inquiry" id="woremarks" style="height: 90px;resize: none;"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="trindex">
                                        <input type="hidden" id="categorynumber">
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <center style="color: white; font-size: 16px;">Job Information</center>
                                            </div>
                                                <div class="panel-body">
                                                    <div class="row form-group">
                                                        <div class="row form-group">
                                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                                <div style="height: 420px;overflow-y: scroll;" id="jobordercontainer"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- =============== another tab panel // job order list =============== -->
                <div id="joborderlist" class="tab-pane fade">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="row form-group">
                                <div class="col-md-6 col-xs-6 col-lg-6">
                                    <div class="col-md-4 col-xs-4">
                                        <span class="input-icon" style="width: 100%;">
                                            <input type="text" class="form-control" placeholder="Search" title="Search according to filter selected" id="txtsearchmaintenance" onkeyup="tblworkorder();">
                                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-xs-3" style="padding-bottom: 5px;padding-left:0px;">
                                        <h5><a onclick="loadfilters_maintenance('Maintenance')" id="LINK_maintenance_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='

                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                                <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Search by&nbsp;&nbsp;</legend>
                                                    <div class="form-group row" style="margin:0px;">
                                                        <div class="col-md-4">
                                                            <label>
                                                                <input name="form-field-checkboxxxxxxx" class="ace ace-checkbox-2 maintenance_module_filter" type="checkbox" value="workorderid" id="filter_workorderid">
                                                                <span class="lbl"> Task ID</span>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>
                                                                <input name="form-field-checkboxxxxxxx" class="ace ace-checkbox-2 maintenance_module_filter" type="checkbox" value="workername" id="filter_workername">
                                                                <span class="lbl"> Personnel</span>
                                                            </label>                            
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>
                                                                <input name="form-field-checkboxxxxxxx" class="ace ace-checkbox-2 maintenance2_module_filter" type="checkbox" value="ownername" id="filter_ownername">
                                                                <span class="lbl"> Owner Name</span>
                                                            </label>                            
                                                        </div>
                                                    </div>
                                            </fieldset>

                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                                <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:100px;">&nbsp;&nbsp;Filter Status&nbsp;&nbsp;</legend>
                                                  <div class="form-group row" style="margin:0px;">
                                                    <div class="col-md-6">
                                                        <label class="label label-warning" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                          <input name="form-field-checkboxstatussssss" class="ace filter_Pending" type="checkbox" value="Pending" id="filter_Pending">
                                                          <span class="lbl"> Pending</span>
                                                        </label>  
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="label label-success" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                          <input name="form-field-checkboxstatussssss" class="ace filter_Resolved" type="checkbox" value="Resolved" id="filter_Resolved">
                                                          <span class="lbl"> Resolved</span>
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
                                            <button class="btn btn-xs btn-info" onclick="savemaintenancefilter()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                OK
                                            </button>
                                          </div>'>
                                        <i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6 col-lg-6">
                                    <div class="pull-right">
                                       <h5><a onclick="showfilterofmall()" class="popover-info" data-rel="popover" data-placement="bottom" title="Print by" data-content='
                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                                <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:105px;">&nbsp;&nbsp;Filter by Mall&nbsp;&nbsp;</legend>
                                                    <div class="form-group row" style="margin:0px;">
                                                        <select class="form-control malloption" id="printbymewo"></select>
                                                    </div>
                                            </fieldset>

                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
                                              <div class="form-group row" style="margin:0px;">
                                                
                                                <div class="col-md-6">
                                                  <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control date-picker" type="text" id="jodatefrom" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
                                                  </div>                
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control date-picker" type="text" id="jodateto" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
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
                                                    <button class="btn btn-xs btn-success" onclick="printbydaterangeJO()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                    Print
                                                </button>
                                            </div>'>
                                        <i class="glyphicon glyphicon-print bigger-110"></i>&nbsp;&nbsp;Print</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 0px !important;">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="parent">
                                        <table id="simple-table" class="table table-bordered table-striped fixTable">
                                            <thead>
                                                <tr>
                                                    <td>Task ID</td>
                                                    <td>Date Entry</td>
                                                    <td>Trade Name</td>
                                                    <td>Repair Details</td>
                                                    <td>Assigned To</td>
                                                    <td>Status</td>
                                                    <td>Options</td>
                                                </tr>
                                            </thead>
                                            <tbody id="tblworkorder"></tbody>
                                        </table>
                                    </div>
                                    <table class="tabledash_footer table" style="margin: 0px !important;">
                                        <thead>
                                            <tr>
                                                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtjoentries"></label>
                                                        </div>                               
                                                        <div class="col-md-6">
                                                            <input type="hidden" id="txt_userpagejo" class="form-control input-sm" style="width: 5%; text-align: center;">
                                                            <ul id="ulpaginationjo" class="pagination pull-right"></ul>
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

                <div id="complaints" class="tab-pane fade">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="row form-group">
                                <div class="col-md-6 col-xs-6">
                                    <div class="col-md-4 col-xs-4">
                                        <span class="input-icon" style="width: 100%;">
                                            <input type="text" class="form-control" placeholder="Search" title="Search according to filter selected" id="txtsearchcomplaints" onkeyup="displaycomplaints();">
                                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                                        </span>
                                    </div>
                                    <div class="col-md-6 col-xs-6" style="padding-bottom: 5px;padding-left:0px;">
                                        <h5><a onclick="loadfilters_complaint('Complaint')" id="LINK_complaint_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='<fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                            <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:80px;">&nbsp;&nbsp;Select by&nbsp;&nbsp;</legend>
                                                <div class="form-group row" style="margin:0px;">
                                                    <div class="col-md-6">
                                                        <label>
                                                            <input name="form-field-checkboxph" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="TenantID" id="filter_TenantID">
                                                            <span class="lbl"> Tenant ID</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>
                                                            <input name="form-field-checkboxph" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="Complaint_Code" id="filter_Complaint_Code">
                                                            <span class="lbl"> Complaint Code</span>
                                                        </label>                               
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>
                                                            <input name="form-field-checkboxph" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="Company" id="filter_Company">
                                                            <span class="lbl"> Trade Name</span>
                                                        </label>                            
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>
                                                            <input name="form-field-checkboxph" class="ace ace-checkbox-2 complaint_module_filter" type="checkbox" value="Complete_Description" id="filter_Complete_Description">
                                                            <span class="lbl"> Complaint Description</span>
                                                        </label>                            
                                                    </div>
                                                </div>
                                        </fieldset>

                                        <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                            <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:168px;">&nbsp;&nbsp;Filter by Priority Status&nbsp;&nbsp;</legend>
                                                <div class="form-group row" style="margin:0px;">
                                                    <div class="col-md-4" style="padding-right:0px;">
                                                        <label class="label label-danger" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                            <input name="form-field-checkbox-pstat2" class="ace" type="checkbox" value="High" id="filter_High">
                                                            <span class="lbl"> High Priority</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4" style="padding-right:0px;">
                                                        <label class="label label-warning" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                            <input name="form-field-checkbox-pstat2" class="ace" type="checkbox" value="Medium" id="filter_Medium">
                                                            <span class="lbl"> Medium Priority</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="label"style="margin-bottom:0px;height:22px;padding-left:4px;color:#963;background-color:#FEE188;">
                                                            <input name="form-field-checkbox-pstat2" class="ace" type="checkbox" value="Low" id="filter_Low">
                                                            <span class="lbl"> Low Priority</span>
                                                        </label>
                                                    </div>
                                                </div>
                                        </fieldset>

                                        <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                            <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:189px;">&nbsp;&nbsp;Filter by Complaint Status&nbsp;&nbsp;</legend>
                                                <div class="form-group row" style="margin:0px;">
                                                    <div class="col-md-4" style="padding-right:0px;">
                                                        <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                            <input name="form-field-checkbox-fbcs" class="ace" type="checkbox" value="Resolved" id="filter_Resolved">
                                                            <span class="lbl"> Resolved</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4" style="padding-right:0px;">
                                                        <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                                                            <input name="form-field-checkbox-fbcs" class="ace" type="checkbox" value="Ongoing" id="filter_Ongoing">
                                                            <span class="lbl"> Ongoing</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label style="margin-bottom:0px;height:22px;padding-left:4px">
                                                            <input name="form-field-checkbox-fbcs" class="ace" type="checkbox" value="Pending" id="filter_Pending">
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
                                                <input class="form-control date-picker" type="text" name="" id="dateentrystart2" data-provide="datepicker">
                                              </div>                
                                            </div>
                                            <div class="col-md-5">
                                              <div class="input-group">
                                                <span class="input-group-addon">
                                                  <i class="fa fa-calendar bigger-110"></i>
                                                </span>
                                                <input class="form-control date-picker" type="text" name="" id="dateentryend2" data-provide="datepicker">
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
                                                <button class="btn btn-xs btn-info" onclick="savecomplaintfilter()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                OK
                                            </button>
                                        </div>'>
                                            <i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                        <!-- <label class="control-label col-md-2">Date Range</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control date-picker" id="dateFrom2" value="<?php echo date('m/d/Y'); ?>">
                                                <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control date-picker" id="dateTo2" value="<?php echo date('m/d/Y'); ?>">
                                                <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                                            </div>
                                        </div>
                                        <button class="btn btn-info btn-sm" onclick="displaycomplaints();"><span class="glyphicon glyphicon-search"></span> Go</button> -->
                                        <div class="pull-right">
                                           <h5><a onclick="showfilterofmall()" class="popover-info" data-rel="popover" data-placement="bottom" title="Print by" data-content='
                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                                <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:105px;">&nbsp;&nbsp;Filter by Mall&nbsp;&nbsp;</legend>
                                                    <div class="form-group row" style="margin:0px;">
                                                        <select class="form-control malloption" id="printbymecomplaint"></select>
                                                    </div>
                                            </fieldset>

                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
                                              <div class="form-group row" style="margin:0px;">
                                                
                                                <div class="col-md-6">
                                                  <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control date-picker" type="text" id="pdatefrom" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
                                                  </div>                
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control date-picker" type="text" id="pdateto" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
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
                                                <button class="btn btn-xs btn-success" onclick="printbydaterange()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                Print
                                            </button>
                                        </div>'>
                                        <i class="glyphicon glyphicon-print bigger-110"></i>&nbsp;&nbsp;Print</a></h5>
                                        </div>
                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 0px !important;">
                                <div class="col-xs-12">
                                    <div class="parent">
                                        <table id="simple-table" class="table  table-bordered table-hover fixTable">
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
                                                    <td>Options</td>
                                                </tr>
                                            </thead>
                                            <tbody id="displaycomplaints"></tbody>
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

                <div id="calendar" class="tab-pane fade"> 
                    <div id="kalendaryo"></div>
                </div>

                <div id="maintenancebudget" class="tab-pane fade"> 
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="row form-group">
                                <div class="col-xs-3 col-sm-3 col-lg-3">
                                    <div class="row form-group">
                                        <div class="col-xs-12 col-sm-12 col-lg-12">
                                            <div class="search-area well well-sm">
                                                <div class="search-filter-header bg-primary">
                                                    <h5 class="smaller no-margin-bottom">
                                                        <i class="ace-icon fa fa-sliders light-green bigger-130"></i>
                                                    </h5>
                                                </div>
                                                <div class="space-10"></div>
                                                <div>
                                                    <p style="margin-bottom: 4px; margin-left: 2px;font-size: 18px;">Select Year</p>
                                                    <select class="form-control" id="budgetyear" onchange="">
                                                        <option value="">-- Select Year --</option>
                                                        <option value="2010">2010</option>
                                                        <option value="2011">2011</option>
                                                        <option value="2012">2012</option>
                                                        <option value="2013">2013</option>
                                                        <option value="2014">2014</option>
                                                        <option value="2015">2015</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                    </select>
                                                    <div class="space-10"></div>
                                                    <p style="margin-bottom: 4px; margin-left: 2px;font-size: 18px;">Select Utilities</p>
                                                    <select class="form-control" id="typeofbudget">
                                                    </select>
                                                    <div class="space-10"></div>
                                                    <button class="btn btn-primary btn-block" onclick="addbudgetperyear();">Add/Update Budget</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="parent">
                                            <table class="table table-bordered table-hover fixTable">
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Year</th>
                                                    <th>January</th>
                                                    <th>February</th>
                                                    <th>March</th>
                                                    <th>April</th>
                                                    <th>May</th>
                                                    <th>June</th>
                                                    <th>July</th>
                                                    <th>August</th>
                                                    <th>September</th>
                                                    <th>October</th>
                                                    <th>November</th>
                                                    <th>December</th>
                                                </tr>
                                                <tbody id="tblbudget"></tbody>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ADDING OF JOB -->
<div class="modal fade" tabindex="-1" id="addingofwojobmodal" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-info ">
        <div class="modal-content">
            <div class="modal-header">Select Category
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group col-xs-12 col-md-12 col-lg-12">
                    <input type="text" class="form-control" id="txtsearchwojob" onkeyup="showtblwojob()" placeholder="Search Job">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-success" onclick='$("#wocatmodal").modal("show");'>
                            <span class="fa fa-plus" style="font-size: 15px;margin-top: 2px;"></span>
                        </button>
                    </span>
                </div>
                <div class="row">
                    <div class=" col-xs-12 col-md-12 col-lg-12">
                        <div class="parent" style="margin-top: 20px;">
                            <table class="table table-bordered table-striped fixTable">
                                <thead>
                                    <tr>
                                        <th width="5%">Icon</th>
                                        <th>Category ID</th>
                                        <th>Category Name</th>                   
                                    </tr>
                                </thead>
                                <tbody id="tblwojob"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button class="btn btn-md btn-danger" id="wojobmodalclose" onclick='$("#addingofwojobmodal").modal("hide");'>Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ADDING OF TASK -->
<div class="modal fade" tabindex="-1" id="addingofwotaskmodal" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-info ">
        <div class="modal-content">
            <div class="modal-header">Select Task
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group col-xs-12 col-md-12 col-lg-12">
                    <input type="text" class="form-control" id="txtsearchwotask" onkeyup="showtblwojob()" placeholder="Search Job">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-sm btn-success" onclick='$("#wotaskmodal").modal("show");'>
                            <span class="fa fa-plus" style="font-size: 15px;margin-top: 2px;"></span>
                        </button>
                    </span>
                </div>
                <div class="row">
                    <div class=" col-xs-12 col-md-12 col-lg-12">
                        <div class="parent" style="margin-top: 20px;">
                            <table class="table table-bordered table-striped fixTable">
                                <thead>
                                    <tr>
                                        <th>Task ID</th>
                                        <th>Task Name</th>       
                                        <th>Equipment</th>            
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tblwotask"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group">
                    <button class="btn btn-md btn-danger" id="wotaskmodalclose" onclick='$("#addingofwotaskmodal").modal("hide");'>Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR VIEWING DETAILS -->
<div class="modal fade" tabindex="-1" id="detailedWO" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-info ">
        <div class="modal-content">
            <div class="modal-header">Work Order Details
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cleartable();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <center style="color: white; font-size: 16px;" id="WODheader"></center>
                    </div>
                        <div class="panel-body" style="background-color: #d9edf7;">
                            <div class="row form-group">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="row form-group">
                                        <div id="div_pagtenant">
                                            <div class="col-xs-6 col-md-6 col-lg-6">
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">J.O Series</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modaljoseries"></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Trade Name</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalcompanyname"></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Branch Name</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalbranchname"></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Wing Name</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalwingname"></label>
                                                    </div>
                                                </div>
                                                    <button class="btn btn-sm btn-success btnforscheduling" onclick="showwomodalscheduling();"><i class="fa fa-plus"></i> Schedule Work Order</button>
                                            </div>
                                            <div class="col-xs-6 col-md-6 col-lg-6">
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Tenant ID</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modaltenantid"></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Worker Name</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalworkername"></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Floor</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalfloor"></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Unit No.</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalunitnumber"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="div_pagmanagement">
                                            <div class="col-xs-6 col-md-6 col-lg-6">
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">J.O Series</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modaljoseries2"></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Branch Name</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalbranchname2"></label>
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-success btnforscheduling" onclick="showwomodalscheduling();"><i class="fa fa-plus"></i> Schedule Work Order</button>
                                            </div>
                                            <div class="col-xs-6 col-md-6 col-lg-6">
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Worker Name</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalworkername2"></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 col-lg-4">
                                                        <label style="font-weight: bold;">Floor</label>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                                        <label id="modalfloor2"></label>
                                                    </div>
                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <center style="color: white; font-size: 16px;">Work Order Information</center>
                    </div>
                    <div class="panel-body" style="overflow-y: scroll;">
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div style="height: 300px;" id="wodetailedwoicontainer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-md btn-primary" id="buttonforpostingtobilling" onclick="confirmposting()"></button>
                <button class="btn btn-md btn-success" id="detailedWOResolve" onclick='settaskasresolve();'>Resolve</button>
                <button class="btn btn-md btn-danger" onclick='cleartable();'>Close</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL INSIDE MODAL FOR VIEWING DETAILS A.K.A SCHEDULING -->
<div class="modal fade" tabindex="-1" id="womodalscheduling" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-info ">
        <div class="modal-content">
            <div class="modal-header">Schedule Work Order
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-6 col-md-6 col-lg-6">
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Assigned Department
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <select class="form-control" id="wodep" onchange="showwopersonnel(this.value)"></select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Start Date
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="form-control date-picker" value="<?php echo date('m/d/Y'); ?>" id="woschedstartdate">
                                    <label class="input-group-addon"><i class="fa fa-calendar"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                End Date
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <div class="input-group">
                                    <input type="text" class="form-control date-picker"  id="woschedenddate">
                                    <label class="input-group-addon"><i class="fa fa-calendar"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 col-lg-6">
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Assigned Personnel
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <select class="form-control" id="wopersonnel"></select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Start Time
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <div class="input-group">
                                    <input type="time" class="form-control" value="<?php echo date('H:i'); ?>" id="woschedstarttime">
                                    <label class="input-group-addon"><i class="fa fa-clock-o"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                End Time
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <div class="input-group">
                                    <input type="time" class="form-control" id="woschedendtime">
                                    <label class="input-group-addon"><i class="fa fa-clock-o"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: -35px;">
                <button class="btn btn-md btn-primary" onclick='$("#womodalscheduling").modal("hide");savewomodalscheduling();'>Save</button>
                <button class="btn btn-md btn-danger" onclick='$("#womodalscheduling").modal("hide");'>Close</button>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- MODAL FOR SHOWING PROGRESS PER TASK -->
<div class="modal fade" tabindex="-1" id="taskscheduler" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-info ">
        <div class="modal-content">
            <div class="modal-header"><label id="taskschedulertext"></label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="parent">
                <input type="hidden" id="schedlineids">
                    <table id="tblschedline" class="table table-bordered table-striped fixTable tblschedline">
                        <thead>
                            <th width="3%"></th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Duration</th>
                        </thead>
                        <tbody id="tbodyschedline">
                            <tr>
                                <td width="3%"><input type="checkbox" class="cbschedline" style="margin-top: 10px;"></td>
                                <td><input type="text" class="date-picker schedline slstartdate" value="<?php echo date('m/d/Y'); ?>" id="slstartdate"></td>
                                <td><input type="text" class="date-picker schedline slenddate" value="<?php echo date('m/d/Y'); ?>" id="slenddate"></td>
                                <td><input type="time" class="schedline slstarttime" id="slstarttime"></td>
                                <td><input type="time" class="schedline slendtime" id="slendtime"></td>
                                <td><input type="text" size="4" class="schedline slduration numberlang" id="slduration"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-md-12">
                    <div class="col-xs-5 col-md-5"  style="margin-left: -60px;">
                        <button class="btn btn-md btn-success taskschedulerbtn" onclick="appendschedline();"><i class="fa fa-plus"></i> Add another schedule</button>
                        <button class="btn btn-md btn-danger taskschedulerbtn" onclick="deletecheckedschedline();"><i class="fa fa-trash-o"></i> Delete</button>
                    </div>
                    <div class="col-xs-5 col-md-5" style="margin-top: 11px;margin-left: -70px;">
                        <div class="col-xs-6 col-md-6">
                            <label>
                                <input name="form-field-radioschedlinestat" type="radio" id="Resolved" value="Resolved" class="schedlinestat ace">
                                <span class="lbl"> Resolved</span>
                            </label>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <label>
                                <input name="form-field-radioschedlinestat" type="radio" checked id="Pending" value="Pending" class="schedlinestat ace">
                                <span class="lbl"> Pending</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-2 col-md-2 pull-right" style="margin-right: -25px;">
                        <button class="btn btn-md btn-primary taskschedulerbtn" onclick="saveschedline()" ;'>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR ADDING NEW CATEGORY -->
<div class="modal fade" tabindex="-1" id="wocatmodal" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">Add New Category
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row container-fluid">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row form-group" style="text-align: center;">
                            <form method="post" name="frmIcon" id="frmIcon">
                                <input type="hidden" id="frmIconID" name="frmIconID">
                                <label class="myupload" style="border: none;">
                                    <img class="img-responsive" id="imgIcon" style="display: none;" src="">
                                    <input type="file" name="fileIcon" id="fileIcon" onchange="showpic();" style="display: none;">
                                    <span class="fa fa-cloud-upload" style="font-size: 60px; color: rgb(153, 153, 153); display: block;text-align: center;" id="iconLogoUpload"></span>
                                <h6 id="iconTextUpload">Click here to upload picture</h6>
                                </label>
                                <center><div class="btn btn-light btn-xs" id="iconRemoveButton" onclick="removephoto();" style="width: auto; display: none;"><i class="glyphicon glyphicon-remove"></i>&nbsp;&nbsp;Remove Photo</div></center>
                            </form>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Category ID
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="txtwocatmodalcatid">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Description
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="txtwocatmodalcatdes">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-6" style="margin-left: -58px;"><button class="btn btn-md btn-primary" onclick="savewocatmodal()">Save</button></div>
                    <div class="col-xs-6 pull-right"><button class="btn btn-md btn-danger" id="wotaskmodalclose" onclick="closewocatmodal()">Cancel</button></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR ADDING NEW TASK -->
<div class="modal fade" tabindex="-1" id="wotaskmodal" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">Add New Task
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row container-fluid">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Task ID
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="wotaskmodaltaskid">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Task Name
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="wotaskmodaltaskname">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Amount
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="wotaskmodalamount">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-4 col-md-4 col-lg-4">
                                Equipment
                            </div>
                            <div class="col-xs-8 col-md-8 col-lg-8">
                                <!-- <input type="text" > -->
                                <select class="form-control" id="wotaskmodalequipment">
                                    <?php
                                        echo "<option value=''>-- Select Equipment --</option>";
                                        $sql = " SELECT code, description FROM tblmaintenance_equip WHERE status = 'Operational' AND xcategory = 'Equipment' ";
                                        $res = mysql_query($sql, $connection);
                                        while($row=mysql_fetch_array($res)){
                                            echo "<option value='".$row[0]."'>".$row[1]."</option>";    
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-6" style="margin-left: -58px;"><button class="btn btn-md btn-primary" onclick="savewowotaskmodal()">Save</button></div>
                    <div class="col-xs-6 pull-right"><button class="btn btn-md btn-danger" id="wotaskmodalclose" onclick="closewotaskmodal()">Cancel</button></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR CONVERTING COMPLAINTS INTO WORK ORDER  -->
<div class="modal fade" tabindex="-1" id="complaintsmodal" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">Complaints
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="nakatagodahilhindikayangipagsigawan">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <center style="color: white; font-size: 16px;">Complaints Details</center>
                    </div>
                    <div class="panel-body" style="background-color: #d9edf7;height: 150px;">
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <div class="row form-group">
                                    <div class="row">
                                        <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <strong>Tenant ID</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label id="complaints_tenantsid"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <strong>Complaint Code</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label id="complaints_ccode"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <strong>Complaint Description</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label id="complaints_cdescription"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <strong>Customer Name</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label id="complaints_ccname"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <strong>Unit</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label id="complaints_unit"></label>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <strong>Time Started</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label id="complaints_timestarted"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <strong>Time Resolved</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label id="complaints_timeresolved"></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-1 col-md-1 col-lg-1"></div>
                                        <div class="col-xs-4 col-md-4 col-lg-4">
                                            <strong>Duration</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-6 col-lg-6">
                                            <label id="complaints_duration"></label>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="row form-group">
                            <div class="col-xs-1 col-md-1 col-lg-1"></div>
                            <div class="col-xs-3 col-md-3 col-lg-3">
                                <label>Set Date</label> 
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <div class="input-group">
                                    <input type="text" data-provide="datepicker" class="form-control" id="complaints_newsched"  value="<?php echo date('m/d/Y') ?>">  
                                    <label class="input-group-addon"><i class="fa fa-calendar"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-1 col-md-1 col-lg-1"></div>
                            <div class="col-xs-3 col-md-3 col-lg-3">
                                <label> Set Time</label>
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <div class="input-group">
                                <input type="time" class="form-control" id="complaints_newtime" value="<?php echo date('H:i') ?>">
                                    <label class="input-group-addon"><i class="fa fa-clock-o"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-1 col-md-1 col-lg-1"></div>
                            <div class="col-xs-3 col-md-3 col-lg-3">
                                <label>Assigned Department</label>
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <select id="complaints_newperson" class="form-control">
                                 <?php 
                                    echo "<option value''>-- Select Department --</option>";
                                    $sql = "SELECT code, description FROM tblmaintenance_department";
                                    $result = mysql_query($sql, $connection);
                                    while( $row = mysql_fetch_array ($result)){
                                        echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                                    }
                                ?>
                                </select>   
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-1 col-md-1 col-lg-1"></div>
                            <div class="col-xs-3 col-md-3 col-lg-3">
                                <label>Details</label>
                            </div>
                            <div class="col-xs-6 col-md-6 col-lg-6">
                                <textarea id="complaints_details" class="form-control" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-md btn-primary" onclick="savecomplaintsmodal()">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR RESOLVING WORK ORDER SENT FROM COMPLAINTS -->
<div class="modal fade" tabindex="-1" id="modalresolvingofcomplaint" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-info ">
        <div class="modal-content">
            <div class="modal-header">Complaint
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div id="nilalamanngpuso">
                        
                    </div>
                </div>
            </div>
            <input type="hidden" id="rikimaru">
            <div class="modal-footer">
                <button class="btn btn-md btn-primary" id="nilalamanngpusobtn" onclick='$("#modalresolvingofcomplaint").modal("hide");saveresolvingofcomplaint();'>Save</button>
                <button class="btn btn-md btn-danger" onclick='$("#modalresolvingofcomplaint").modal("hide");'>Close</button>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- MODAL FOR INPUT OF METER READING -->
<div class="modal fade" tabindex="-1" id="womodalmetereading" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-info ">
        <div class="modal-content">
            <div class="modal-header"><label id="womodalmetereadingheader">asfas</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="removeinputs()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" name="posting_meter_image" id="posting_meter_image">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <center style="color: white; font-size: 16px;">Reading Information</center>
                        </div>
                        <div class="panel-body">
                        <input type="hidden" id="hiddenpangupload" name="hiddenpangupload">
                            <div class="row form-group">
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="col-xs-2 col-md-2 col-lg-2">
                                        
                                    </div>
                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                        <input type="text" class="form-control" style="text-align: center;" id="metervalue" name="metervalue">
                                    </div>
                                    <div class="col-xs-2 col-md-2 col-lg-2">
                                        
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    <div class="col-xs-2 col-md-2 col-lg-2">
                                        
                                    </div>
                                    <div class="col-xs-8 col-md-8 col-lg-8">
                                        <center><b>Meter Reading</b></center>
                                    </div>
                                    <div class="col-xs-2 col-md-2 col-lg-2">
                                        
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 col-lg-12" style="margin-top: 20px;">
                                    <center>
                                        <label class="myupload well">
                                            <img class="img-responsive" id="imahengmetro" style="display: none;">
                                            <input type="file" name="meter_image" id="meter_image" onChange="showimahe();" style="display: none;">
                                            <span class="fa fa-cloud-upload" style="font-size: 60px; color: #999;" id="logongupload"></span>
                                            <h1 id="textngupload">Click here to upload picture</h1>
                                        </label>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-md btn-primary" id="btnforuploadinghidden" onclick='hiddenpangupload();'>Save</button>
                <button class="btn btn-md btn-danger" onclick='removeinputs();'>Close</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR ADDING BUDGET PER YEAR -->
<div class="modal fade" tabindex="-1" id="modalforaddingbudget" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-info ">
        <div class="modal-content">
            <div class="modal-header"> <label id="labelformodalofaddingbudget">Budget</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <div class="col-xs-6 col-md-6 col-lg-6">
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    January
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xjan">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    February
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xfeb">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    March
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xmar">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    April
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xapr">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    May
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xmay">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    June
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xjun">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6 col-lg-6">
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    July
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xjul">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    August
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xaug">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    September
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xsep">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    October
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xoct">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    November
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xnov">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-4 col-md-4 col-lg-4">
                                    December
                                </div>
                                <div class="col-xs-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="xdec">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: -30px;">
                <button class="btn btn-md btn-primary" id="nilalamanngpusobtn" onclick='savebudgetperyear()'>Save</button>
                <button class="btn btn-md btn-danger" onclick='$("#modalforaddingbudget").modal("hide");'>Close</button>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- MULTIPLE PRINTING OF COMPLAINTS BASED ON DATE RANGE CHOSEN -->
<div id="mpocbodrc" style="display: none;">
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tbody id="template"></tbody>
    </table>
    <p style="font-size: 12px;text-align: right;">From:&nbsp;&nbsp;<label id="dateFrommpocbodrcprint"></label>&nbsp;&nbsp;To&nbsp;&nbsp;<label id="dateTompocbodrcprint"></label></p>
    <center style="font-weight: bold;background-color: #666;color: white;width: 100%;margin-top: -10px;">Complaint List</center>
    <table style="width: 100%;">
        <thead>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Tenant ID</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Date Entry</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Complaint Code</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Complaint Description</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Customer Name</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Company</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Unit Name</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Date Received</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Date Resolved</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Duration</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Resolved by</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Complaint Status</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;">Priority Status</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;border-right: 1px solid;">User Name</th>
        </thead>
        <tbody id="tblmpocbodrc"></tbody>
    </table>
</div>
<!-- MULTIPLE PRINTING OF WORK ORDERS BASED ON DATE RANGER CHOSEN -->
<div id="mpowobodrc" style="display: none;">
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tbody id="template2"></tbody>
    </table>
    <p style="text-align: right;">
        <span style="font-weight: 700;">Repair Details Status :</span>&nbsp;&nbsp;
        <span class="fa fa-circle" style="color: #F89406;"></span> Pending&nbsp;&nbsp;
        <span class="fa fa-circle" style="color: #69AA46;"></span> Resolved&nbsp;&nbsp;
        <span class="fa fa-circle" style="color: #428BCA;"></span> Ongoing&nbsp;&nbsp;
    </p>
    <p style="font-size:; 12px; margin-top: -15px;text-align: right;">From:&nbsp;&nbsp;<label id="dateFromwoprint"></label>&nbsp;&nbsp;To&nbsp;&nbsp;<label id="dateTowoprint"></label></p>
    <center style="font-weight: bold;background-color: #666;color: white;width: 100%;margin-top: -15px;">Work Order List</center>
    <table style="width: 100%;border: 1px solid;">
        <thead>
            <td style="border-right: 1px solid;">Work Order ID</td>
            <td style="border-right: 1px solid;">Date Entry</td>
            <td style="border-right: 1px solid;">Trade Name</td>
            <td style="border-right: 1px solid;">Repair Details</td>
            <td style="border-right: 1px solid;">Assigned To</td>
            <td>Status</td>
        </thead>
        <tbody id="tblmpowobodrc"></tbody>
    </table>
</div>
<!-- MODAL FOR PRINTING SINGLE JOB ORDER -->
<div id="joprintpreview" style="display: none;">
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tbody id="template3"></tbody>
    </table>
    <table cellspacing="0" style="border: none; width: 100%;white-space: nowrap;margin-top: 20px;">
        <tr>
            <td colspan="4"><center style="font-weight: bold;background-color: #666;color: white;width: 100%;margin-top: -15px;">JOB ORDER REPORT</center></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Tenant Information</strong></td>
            <td colspan="6"><label>J.O. Series : </label> &nbsp;<strong id="printjonumber" style="color: red;"></strong></td>
        </tr>
        <tr>
            <td width="50">Tenant ID : </td>
            <td width="200" id="printtenantid"></td>
              <td width="100">Branch Name : </td>
            <td width="100" id="printbranchname"></td>
        </tr>
        <tr>
            <td width="50">Company Name : </td>
            <td width="100" id="printcompanyname"></td>
              <td width="100">Wing Name : </td>
            <td width="100" id="printwingname"></td>
        </tr>
        <tr>
            <td width="50">Contact Person : </td>
            <td width="100" id="printcontactpersion"></td>
              <td width="100">Floor : </td>
            <td width="200" id="printfloor"></td>
        </tr>
        <tr>
            <td width="50">Contact Number : </td>
            <td width="100" id="printcontactnumber"></td>
              <td width="100">Unit No. : </td>
            <td width="200" id="printunitno"></td>
        </tr>
    </table>
    <div id="jotasklistcontainer"></div>
</div>
<!-- SINGLE PRINT OF COMPLAINT -->
<div id="printcomplaint" style="display: none;">
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tbody id="template4"></tbody>
    </table>
    <center style="font-size: 32px;font-weight: bold;border-bottom: 3px solid black;width: 100%;">Tenant Complaint Form</center>
    <center style="width: 100%;background-color: #666;color: white;margin-top: 10px;">Tenant Information</center>
    <table style="width: 100%;border: 1px solid;">
        <tbody>
            <tr>
                <td style="width: 50%;"><b>Trade Name: </b><label id="printcomplainttradename"></label></td>
                <td style="border-left: 1px solid;width: 50%;"><b>Tenant ID: </b><label id="printcomplainttenantid"></label></td>
            </tr>
            <tr>
                <td style="width: 50%;border-top: 1px solid;"><b>Mall Name: </b><label id="printcomplaintmallname"></label></td>
                <td style="border-left: 1px solid;width: 50%;border-top: 1px solid;"><b>Wing Name: </b><label id="printcomplaintwingname"></label></td>
            </tr>
            <tr>
                <td style="width: 50%;border-top: 1px solid;"><b>Floor Name: </b><label id="printcomplaintfloorname"></label></td>
                <td style="border-left: 1px solid;width: 50%;border-top: 1px solid;"><b>Unit Name: </b><label id="printcomplaintunitname"></label></td>
            </tr>
        </tbody>
    </table>

    <center style="width: 100%;background-color: #666;color: white;margin-top: 10px;">Complaint Information</center>
    <table style="width: 100%;border: 1px solid;">
        <tbody>
            <tr>
                <td style="width: 50%;"><b>Complaint Date: </b><label id="printcomplaintcomplaintdate"></label></td>
                <td style="border-left: 1px solid;width: 50%;"><b>Complaint Taken By: </b><label id="printcomplaintusername"></label></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 50%;border-top: 1px solid;"><b>Complaint Code: </b><label id="printcomplaintcomplaintcode"</label></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 50%;border-top: 1px solid;height: 100px;vertical-align: top;"><b>First Response Corrective Action: </b><label></label></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 50%;border-top: 1px solid;height: 100px;vertical-align: top;"><b>Suspected Cause: </b><label id="printcomplaintdescription"></label></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 50%;border-top: 1px solid;height: 40px;vertical-align: top;"><b>Corrective Action Person(s): </b><label id="printcomplaintassignedperson"></label></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 50%;border-top: 1px solid;height: 40px;vertical-align: top;"><b>Corrective Action Follow-up: </b><label></label></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 50%;border-top: 1px solid;height: 100px;vertical-align: top;"><b>What steps should be considered to avoid a repeat of the problem: </b><label></label></td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top: 30px;">
        <tr>
            <td>
                <label style="border-top: 1px solid;">Name of person completing this form</label>
            </td>
            <td align="right">
                <label style="border-top: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            </td>
        </tr>
    </table>
</div>