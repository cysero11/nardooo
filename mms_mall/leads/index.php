<?php include('script.php') ?>

<style type="text/css">
  
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

    .parent{
      height: 41vh;
    }


</style>

<div class="page-header" style="padding-bottom: 0px;">
    <div class="row form-group" style="margin-bottom: 0px;padding-top:10px;background-color: #edf4f8;">
        <div class="col-md-2 col-xs-12">
            <h1 style="font-weight: bold;">LEADS</h1>
            <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;List of Leads</h6>
        </div>
    <div class="col-md-6 col-xs-6" id="statnginqr">
    <div class="row form-group" style="margin-bottom: -8px;">
          <div class="col-xs-12" style="margin-left: 400px;">
            <span>All Status:</span>&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: green;'></span> Application on process</span>&nbsp;|&nbsp;&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: #428BCA;'></span> Approved</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: red;'></span> Blocked</span>
        </div>
     </div>

     <!-- Progress Bar Status -->
      <div class="row form-group" style="margin-bottom: -8px;">
          <div class="col-xs-12" style="margin-left: 400px;">
            <span>Leads Progress:</span>&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: green;'></span> Letter of intent - 70% to Complete</span>&nbsp;|&nbsp;&nbsp;
                <span><span class='fa fa-flag' style='font-weight: 700; color: yellow;'></span> Statement of accounts - 40% to 60%</span>
                <span><span class='fa fa-flag' style='font-weight: 700; color: red; margin-left: 100px;'></span>BIR Permit & Company Profile - 10% to 30% </span>
        </div>
     </div>
    
    </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="row form-group">
      <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-left: 0px;">
        <span class="input-icon" style="width: 100%;">
                  <input type="text" class="form-control" id="txtlead" title="Search according to filter selected" placeholder="Search" onkeyup="tblLeads();">
                  <i class="ace-icon fa fa-search nav-search-icon"></i>
              </span>
            </div>
          
           <div class="col-md-2 col-xs-2" style="padding-bottom: 5px;padding-left:0px;">
                <h5><a onclick="loadfilters_leads('Leads')" id="LINK_leads_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='

                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px; ">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Select by&nbsp;&nbsp;</legend>
                        <div class="form-group row" style="margin:0px;">
                            <div class="col-md-6">
                                <label>
                                    <input name="form-field-checkboxtttttttt" class="ace ace-checkbox-2 tenant_module_filter" type="checkbox" value="TenantID" id="filter_TenantID">
                                    <span class="lbl"> Leads ID</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    <input name="form-field-checkboxtttttttt" class="ace ace-checkbox-2 tenant_module_filter" type="checkbox" value="companyname" id="filter_companyname">
                                    <span class="lbl"> Leads Fullname</span>
                                </label>                            
                            </div>
                        </div>
                    </fieldset>

                    <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:120px;">&nbsp;&nbsp;Leads Status&nbsp;&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-6">
                          <label style="margin-bottom: 0px;margin-top: 5px;margin-right: 30px;margin-left: 10px;margin-top: 0px;">
                            <input name="form-field-checkbox-tstatus" class="ace ace-checkbox-2 chk_tenant_tstatus" type="checkbox" value="occupied" id="filter_occupied">
                            <span class="lbl"> Complete</span>
                          </label>
                        </div>
                        <div class="col-md-6">
                          <label style="margin-bottom: 0px;margin-top: 0px;margin-right: 20px;">
                            <input name="form-field-checkbox-tstatus" class="ace ace-checkbox-2 chk_tenant_tstatus" type="checkbox" value="incoming" id="filter_incoming">
                            <span class="lbl"> Pending </span>
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
                            <span class="lbl">&nbsp;Application on process&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: #DFE21A;"></span></span>
                          </label>
                        </div>
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="inactive" id="filter_inactive">
                            <span class="lbl">&nbsp;Approved&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: DarkGray;"></span></span></span>
                          </label>
                        </div>
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="forrenewal" id="filter_forrenewal">
                            <span class="lbl">&nbsp;Blocked&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: #428BCA;"></span></span></span>
                          </label>
                        </div>                     
                      </div>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="foreviction" id="filter_foreviction">
                            <span class="lbl">&nbsp;BIR Permit&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: red;"></span></span></span>
                          </label>
                        </div>  
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="evicted" id="filter_evicted">
                            <span class="lbl">&nbsp;Company Profile&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: grey;"></span></span></span>
                          </label>
                        </div>  
                        <div class="col-md-4" style="padding-right:0px;">
                          <label style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stado" class="ace" type="checkbox" value="endofcon" id="filter_endofcon">
                            <span class="lbl">&nbsp;Statement of Accounts&nbsp;<span class="fa fa-flag" style="font-weight: 700; color: #D6487E;"></span></span></span>
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
                        <button class="btn btn-xs btn-info" onclick="saveleadsfilter()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                            OK
                        </button>
                      </div>'>
                    <i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
            </div>

            <div>
            <div class="col-md-2" style="padding-bottom: 5px;text-align: right;"></div>
            <div class="col-md-2" style="padding-bottom: 5px;text-align: right;"></div>
            <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-right: 0px;">
              <button id="btn_inquiry_add_new" class="btn btn-info btn-sm" style="width: 100% !important; margin-left: 200px;" onclick="loadmodal_leads();">New Lead</button>
            </div>
            <!-- <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-right: 0px;">
              <button id="" class="btn btn-sm" style="width: 100% !important;" onclick="loadmodal_leads();">New Leads</button>
            </div> -->
    </div>

 <div class="row form-group" style="margin-bottom: 10px !important;">
        <div class="col-xs-12">
            <div class="parent">
 <!--            <input type="text" name="" id="leadsID"> -->
                <table class="table table-striped table-bordered table-hover fixTable">
                    <thead>
                       <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                          <td width="10%">LEADS ID</td>
                          <td width="15%">Leads Progress</td>
                          <td width="20%">Full Name</td>
                          <td width="15%">Mobile Number</td>
                          <td width="15%">Email</td>
                          <td width="15%">Status</td>
                          <td width="10%">Action</td> 
                        </tr>
                    </thead>
                    <div id="div_tenants_table"></div>
                    <tbody id="tblLeads">

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

<!--     <div class="row form-group" style="margin-bottom: 0px !important;">
      <div class="col-xs-12 parent" >
        <table id="simple-table" class="table  table-bordered table-hover fixTable" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
              <thead class="table-thead" style="flex: 0 0 auto;width: calc(100%);">
                <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                  <td width="10%">LEADS ID</td>
                  <td width="20%">Full Name</td>
                  <td width="15%">Mobile Number</td>
                  <td width="15%">Telephone Number</td>
                  <td width="15%">Email</td>
                  <td width="15%">Status</td>
                  <td width="10%">Action</td>                                                    
                </tr>
              </thead>
              <div class="" id="statussavingreservation"></div>
              <tbody id="tblLeads" style="flex: 1 1 auto;display: block;height: 19em;overflow: hidden;"></tbody>
          </table>
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
    </div> -->
  </div>
</div>
