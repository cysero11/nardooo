<style>
    .parent {
        height: 40vh;
    }

    .popover {
      min-width: 500px ! important;
      width: auto;
    }

    .popover-content{
        padding-left: 0px; /* Max Width of the popover (depending on the container!) */
        padding-right: 0px;
    }
</style>
<?php
    include("../setup/systemsetup/script.php");
    include("tenantscripts.php");
    include("direct_tenant/kevinMscript.php");
    include("direct_tenant/modal_application.php"); // modal for adding of new tenant
    include("direct_tenant/modal_load_tenants.php"); // modal for adding of new tenant
    include("direct_tenant/modal_new_tenant.php"); // modal for adding of new tenant
    include("direct_tenant/modal_load_companies.php"); // modal for adding of new tenant
    include("direct_tenant/modal_new_company.php"); // modal for adding of new tenant
    include("direct_tenant/modal_new_address.php"); // modal for adding of new tenant
    include("direct_tenant/modal_new_referential.php"); // modal for adding of new tenant
    include("direct_tenant/modal_edit_contact_person.php"); // modal for adding of new tenant
    include("direct_tenant/modal_termsandcondition.php");
    include("modaltenantinfos.php");
    include("modalcontacts.php");
    include("addcomplaintsmodal.php");
    include("modal_addendum.php");
    include("direct_tenant/modal_shortcut_unit.php");
?>

<div class="page-header row" style="padding-bottom: 0px;">
    <div class="row form-group" style="margin-bottom: 0px;padding-top:10px;background-color: #edf4f8;">
        <div class="col-md-2 col-xs-12">
            <h1 style="font-weight: bold;" onclick="activateaddendum()">TENANTS</h1>
            <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;List of Tenants</h6>
        </div>
        <div class="col-md-10" style="margin-top: 10px !important;padding-bottom: 10px;">
            <div class="clearfix divstat pull-right" style="font-size: 14px;">
                <span>All Tenants :</span>&nbsp;&nbsp;
                <span style="font-weight: 700;"><span class='fa fa-flag' style='font-weight: 700; color: #DFE21A;'></span> Active</span>&nbsp;|&nbsp;&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: DarkGray;'></span> Inactive</span>&nbsp;|&nbsp;&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: #428BCA;'></span> For Renewal</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: red;'></span> For Eviction</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: grey;'></span> Evicted</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: #D6487E;'></span> Contract Ended</span>
                <input type="hidden" id="txtcompid" />
            </div><br><br>
            <div class="col-md-2 col-xs-12 pull-right" style="margin-left: 0px;">
                <a href="#" id="btn_inquiry pull-right" class="btn btn-white btn-success btn-sm" style="width: 100% !important;" onclick="selectnav(7)"><i class="ace-icon fa fa-calendar-o"></i>&nbsp;&nbsp;View Calendar</a>
            </div>
            <div class="col-md-2 col-xs-12 pull-right" style="margin-left: 0px;">
                <a href="#" id="btn_inquiry" class="btn btn-white btn-info btn-sm" style="width: 100% !important;" onclick="selectnav(13)"><i class="ace-icon fa fa-map-o"></i>&nbsp;&nbsp;View LCA Units</a>
            </div>
            <div class="col-md-2 col-xs-12 pull-right">
                <a href="#" id="btn_inquiry" class="btn btn-white btn-info btn-sm" style="width: 100% !important;" onclick="selectnav(14)"><i class="ace-icon fa fa-map-o"></i>&nbsp;&nbsp;View SET Units</a>
            </div>
        </div>
    </div>
</div><!-- /.page-header -->
<div class="row form-group">
	<div class="col-xs-12" style="padding-left: 0px;">
        <div class="row form-group" style="margin-bottom: 0px;">
            <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;">
                <span class="input-icon" style="width: 100%;">
                    <input type="text" class="form-control push-left" placeholder="Search" title="Search according to filter selected" id="txtsearchtenantlist" onkeyup="tbltenantlists();" style="color: black !important;">
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
            </div>
            <div class="col-md-2 col-xs-2" style="padding-bottom: 5px;padding-left:0px;">
                <h5><a onclick="loadfilters_tenant('Tenant')" id="LINK_tenant_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='

                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Select by&nbsp;&nbsp;</legend>
                        <div class="form-group row" style="margin:0px;">
                            <div class="col-md-6">
                                <label>
                                    <input name="form-field-checkboxtttttttt" class="ace ace-checkbox-2 tenant_module_filter" type="checkbox" value="TenantID" id="filter_TenantID">
                                    <span class="lbl"> Tenant ID</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    <input name="form-field-checkboxtttttttt" class="ace ace-checkbox-2 tenant_module_filter" type="checkbox" value="companyname" id="filter_companyname">
                                    <span class="lbl"> Store Name</span>
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:120px;">&nbsp;&nbsp;Tenant Status&nbsp;&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-6">
                          <label style="margin-bottom: 0px;margin-top: 5px;margin-right: 30px;margin-left: 10px;margin-top: 0px;">
                            <input name="form-field-checkbox-tstatus" class="ace ace-checkbox-2 chk_tenant_tstatus" type="checkbox" value="occupied" id="filter_occupied">
                            <span class="lbl"> Occupying Tenants </span>
                          </label>
                        </div>
                        <div class="col-md-6">
                          <label style="margin-bottom: 0px;margin-top: 0px;margin-right: 20px;">
                            <input name="form-field-checkbox-tstatus" class="ace ace-checkbox-2 chk_tenant_tstatus" type="checkbox" value="incoming" id="filter_incoming">
                            <span class="lbl"> Incoming Tenants </span>
                          </label>
                        </div>
                      </div>
                    </fieldset>

                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Filter Status&nbsp;&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="actived" id="filter_actived">
                            <span class="lbl">&nbsp;Active&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: #DFE21A;"></span></span>
                          </label>
                        </div>
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="inactive" id="filter_inactive">
                            <span class="lbl">&nbsp;Inactive&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: DarkGray;"></span></span></span>
                          </label>
                        </div>
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="forrenewal" id="filter_forrenewal">
                            <span class="lbl">&nbsp;For Rewewal&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: #428BCA;"></span></span></span>
                          </label>
                        </div>
                      </div>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="foreviction" id="filter_foreviction">
                            <span class="lbl">&nbsp;For Eviction&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: red;"></span></span></span>
                          </label>
                        </div>
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="evicted" id="filter_evicted">
                            <span class="lbl">&nbsp;Evicted&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: grey;"></span></span></span>
                          </label>
                        </div>
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="endofcon" id="filter_endofcon">
                            <span class="lbl">&nbsp;Contract Ended&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: #D6487E;"></span></span></span>
                          </label>
                        </div>
                      </div>
                    </fieldset>

                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:110px;">&nbsp;&nbsp;Contract Date&nbsp;&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-5">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar bigger-110"></i>
                            </span>
                            <input class="form-control div_app date-picker" type="text" name="" id="contractstart" data-provide="datepicker">
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar bigger-110"></i>
                            </span>
                            <input class="form-control div_app date-picker" type="text" name="" id="contractend" data-provide="datepicker">
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
                        <button class="btn btn-xs btn-info" onclick="savetenantfilter()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                            OK
                        </button>
                      </div>'>
                    <i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
            </div>

            <div class="col-md-2 col-xs-12 pull-right" style="padding-bottom: 5px;padding-right: 0px;">
                <a href="javascript:void(0)" id="btn_inquiry_add_new" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="loadmodal_tenant_new();">New Tenant</a>
            </div>
        </div>
    </div>
    <div class="row form-group" style="margin-bottom: 10px !important;">
        <div class="col-xs-12">
            <div class="parent">
                <table class="table table-striped table-bordered table-hover fixTable">
                    <thead>
                        <tr>
                            <td width="3%"></td>
                            <td width="10%">Tenant ID</td>
                            <td width="3%">Store Code</td>
                            <td width="11%">Store Name</td>
                            <td width="11%">Trade Name</td>
                            <td width="10%">Owner's Name</td>
                            <td width="25%">Wing/ Floor/ Unit</td>
                            <td width="8%">Start Date</td>
                            <td width="8%">End Date</td>
                            <td width="11%">Options</td>
                        </tr>
                    </thead>
                    <div id="div_tenants_table"></div>
                    <tbody id="tbltenantlists">

                    </tbody>
                </table>
            </div>
            <table class="tabledash_footer table" style="margin: 0px !important;">
                <thead>
                    <tr>
                        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                            <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;"/>
                            <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtitemlistentries"><br /></font>
                            <ul id="ulpaginationitemlist" class="pagination pull-right"></ul>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modaleviction">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remarks</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea id="remarksasdgas" class="form-control" rows="3"></textarea>
                            <input type="text" id="evictid" hidden="true">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" id="eviction" onclick="eviction();"><span class="fa fa-edit"></span> Evict</button>
                <button class="btn btn-sm btn-primary" id="warning" onclick="warning();"><span class="fa fa-edit"></span> Send Warning</button>
                <button class="btn btn-sm btn-danger" onclick="$('#modaleviction').modal('hide'); $('#remarksasdgas').val('');"><span class="fa fa-remove"></span> Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" id="modalnotify">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label style="font-weight: bold;" class="control-lablel pull-right" data-dismiss="modal">x</label><br>
                        <label class="control-label" style="font-weight: 700;">You have <span id="cntnotify" style="font-weight: 900; color: red;"></span> Tenant(s) <span class="fa fa-flag" style="font-weight: 700; color: red;"></span> For Eviction status.</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewhistorytenant" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" style="width: 1200px;">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Transaction Logs</h4>
        <input type="hidden" id="tenantidnglogs">
      </div>

       <!-- Modal body-->
       <div class="modal-body"  id="modal-body-group">
          <div class="parent2">
              <table class="table table-bordered table-striped fixTable">
                  <thead>
                      <tr>
                        <td width="20%">User Name</td>
                        <td width="20%">Date</td>
                        <td width="20%">Time</td>
                        <td width="20%">Module</td>
                        <td width="20%">Action</td>
                      </tr>
                  </thead>
                  <tbody id="viewhistorytenantdisplay"></tbody>
              </table>
          </div>

        <table class="tabledash_footer table" style="margin: 0px !important;">
          <thead>
              <tr>
                  <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                      <div class="row">
                          <div class="col-md-6">
                              <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtcomplaintsentriespertenant"></label>
                          </div>
                          <div class="col-md-6">
                              <input type="hidden" id="txt_userpagepertenant" class="form-control input-sm" style="width: 5%; text-align: center;">
                              <ul id="ulpaginationcomplaintpertenant" class="pagination pull-right"></ul>
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

<input type="hidden" id="tidforwarning">
<input type="hidden" id="iidforwarning">
<input type="hidden" id="aidforwarning">

    <link href="assets/css/tablenav.css" rel="stylesheet" type="text/css">
    <script src="assets/js/tablenav.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <!-- <script src="assets/js/daterangepicker.min.js"></script> -->
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
