<style>  
.parent {
    height: 50vh;
}
</style>

<div class="page-content" style="padding: 0px;">
  <div class="tabbable">
      <div class="pull-right" style="margin-right: 10px;margin-top: -7px;"><button id="buttonpangaddsched" style="display: none;" class="btn btn-sm btn-primary" onclick="createnewschedule()">New Schedule</button></div>
    <ul class="nav nav-tabs" id="myTaba2">

        <li class="active">
            <a data-toggle="tab" href="#salesaudittab1" onclick="hidebutton();">
                <i class="green menu-icon fa fa-dollar  bigger-120"></i>
                Sales Audit
            </a>
        </li>

        <li>
            <a data-toggle="tab" href="#salesaudittab2" onclick="showbutton();">
                <i class="green fa fa-desktop bigger-120"></i>
                Accrediation
            </a>
        </li> 
        <!-- <button id="schedulebtn" class="btn btn-sm btn-info pull-right" style="margin-right: 5px;margin-bottom: 5px;display: none;" onclick="showaccreditationschedulemodal()">Add Schedule</button> -->
    </ul>
    <div class="tab-content">
        <div id="salesaudittab1" class="tab-pane fade in active">
          <div class="row">
            <div class="col-xs-12">
              <div class="row form-group">
                <div class="col-md-1" style="padding-top: 3px;">
                  <h3 style="color:#2679B5;margin-top: 10px;display: inline;">&nbsp;<i style="display: inline;" class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Filter</h3>
                </div>
                <div class="col-md-2">
                  <select class="form-control input-sm" id="sayear">
                    <option value="">Choose Year</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select class="form-control input-sm" id="samonth" onchange="saday();">
                    <option value="">Choose Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
                <div class="col-md-1" style="padding-right: 0px;">
                  <select class="form-control input-sm" id="saday">
                    <option value="">Choose Day</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <button class="btn btn-sm btn-info" style="height: 30px;" onclick="company();">&nbsp;Go</button>
                </div>
              </div>
            </div>
              <div class="col-xs-12" style="margin-bottom: 10px;">
                 <ul class="breadcrumb" id="navdir">
                 <li id="companyname" onclick="company();" style="display: none;" ><label id="companynamelabel" style="padding: 5px;"></label></li>
                 <li id="mallname" onclick="mallsales();" style="display: none;" ><label id="mallenamelabel" style="padding: 5px;">Mall</label></li>
                 <li id="wingname" onclick="wingsales2();" style="display: none;" ><label id="wingnamelabel" style="padding: 5px;"> Wing </label></li>
                 <li id="floorname" onclick="floorsales2();" style="display: none;" ><label id="floornamelabel" style="padding: 5px;"> Floor </label></li>
                 <li id="unittypename" onclick="unittypesales2();" style="display: none;" ><label id="unittypenamelabel" style="padding: 5px;"> Unit Type </label></li>
                 <li id="unitname" onclick="unitsales2();" style="display: none;" ><label id="unitnamelabel" style="padding: 5px;"> Unit </label></li>
                 <li id="tenantname" onclick="tenantsales2();" style="display: none;" ><label id="yearlysaleslabel" style="padding: 5px;"> Tenant Sales by Year </label></li>
                 <li id="monthname" onclick="tenantsales2bymonth();" style="display: none;" ><label id="monthlysaleslabel" style="padding: 5px;"> Tenant Sales by Month </label></li>
                 <li id="dayname" style="display: none;"><label id="dailysaleslabel" style="padding: 5px;"></label></li>
                 </ul>
              </div>
              <div class="container-fluid" style="margin-left: -24px;margin-right: -24px;">
                <div class="col-xs-12">
                  <div class="parent">
                    <table class="table table-bordered fixTable" style="width: 100%;">
                      <thead>
                        <tr>
                          <td style="width:1%;white-space:nowrap;">Label</th>
                          <td style="width:1%;white-space:nowrap;">Transaction Date</th>
                          <td style="width:1%;white-space:nowrap;">Grand Total of Sales</th>
                          <td style="width:1%;white-space:nowrap;">Grand Total of Discount</th>
                          <td style="width:1%;white-space:nowrap;">Total Discount - Seniors</th>
                          <td style="width:1%;white-space:nowrap;">Total Discount - PWD</th>
                          <td style="width:1%;white-space:nowrap;">Total Discount - GPC</th>
                          <td style="width:1%;white-space:nowrap;">Total Discount - VIP</th>
                          <td style="width:1%;white-space:nowrap;">Total Discount - EMP</th>
                          <td style="width:1%;white-space:nowrap;">Total Discount - REG</th>
                          <td style="width:1%;white-space:nowrap;">Total Discount - Others</th>
                          <td style="width:1%;white-space:nowrap;">Total Refund</th>
                          <td style="width:1%;white-space:nowrap;">Total Canceled</th>
                          <td style="width:1%;white-space:nowrap;">Total VAT </th>
                          <td style="width:1%;white-space:nowrap;">Total VAT Inclusive Sales</th>
                          <td style="width:1%;white-space:nowrap;">Total VAT Exclusive Sales</th>
                          <td style="width:1%;white-space:nowrap;">Beginning O.R.</th>
                          <td style="width:1%;white-space:nowrap;">Ending O.R.</th>
                          <td style="width:1%;white-space:nowrap;">Document Count</th>
                          <td style="width:1%;white-space:nowrap;">Customer Count</th>
                          <td style="width:1%;white-space:nowrap;">Senior Citizen Count</th>
                          <td style="width:1%;white-space:nowrap;">Local Tax</th>
                          <td style="width:1%;white-space:nowrap;">Service Charge</th>
                          <td style="width:1%;white-space:nowrap;">Total Non-VAT Sale</th>
                          <td style="width:1%;white-space:nowrap;">Raw Gross</th>
                          <td style="width:1%;white-space:nowrap;">Daily Local Tax </th>
                          <td style="width:1%;white-space:nowrap;">Total Payment - CASH</th>
                          <td style="width:1%;white-space:nowrap;">Total Payment - CARD</th>
                          <td style="width:1%;white-space:nowrap;">Total Payment - OTHERS</th>
                        </tr>
                      </thead>
                      <tbody id="dbsalesnanagaappend"></tbody>
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

      <div id="salesaudittab2" class="tab-pane fade">                    
        <div class="row">
          <div class="col-xs-12">
            <div class="row form-group"> 
              <div class="col-md-6 col-xs-6">
                <div class="col-md-4 col-xs-4">
                  <span class="input-icon" style="width: 100%;">
                      <input type="text" class="form-control" placeholder="Search" title="Search according to filter selected" id="txtsearchcomplaints">
                      <i class="ace-icon fa fa-search nav-search-icon"></i>
                  </span>
                </div>
                <div class="col-md-3 col-xs-3" style="padding-bottom: 5px;padding-left:0px;">
                  <h5><a onclick="loadfilters_complaints('Complaints')" id="LINK_complaints_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='<label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 complaints_module_filter" type="checkbox" value="TenantID" id="filter_TenantID">
                      <span class="lbl"> Tenant ID</span>
                  </label><br /><label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 complaints_module_filter" type="checkbox" value="Complaint_Code" id="filter_Complaint_Code">
                      <span class="lbl"> Complaint Code</span>
                  </label><br /><label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 complaints_module_filter" type="checkbox" value="Customer_Name" id="filter_Customer_Name">
                      <span class="lbl"> Customer Name</span>
                  </label><br />
                  <button class="btn btn-xs btn-info" onclick="savecomplaintsfilter()" title="Save Filter" style="float:right;margin-bottom:10px;">
                      OK
                      </button>'>
                      <i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <label class="control-label col-md-2">Date Range</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control date-picker" id="dateFrom10" value="<?php echo date('m/d/Y'); ?>">
                        <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control date-picker" id="dateTo10" value="<?php echo date('m/d/Y'); ?>">
                        <label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
                    </div>
                </div>
                <button class="btn btn-info btn-sm" onclick="showtblaccreditationlist()"><span class="glyphicon glyphicon-search"></span> Go</button>
                <button class="glyphicon glyphicon-print btn btn-sm btn-info" onclick="printaccreditation()" style="margin-bottom: 3px;"></button>
              </div>
            </div>
          </div>

            <div class="container-fluid" style="margin-left: -24px;margin-right: -24px;">
              <div class="col-xs-12">
                <div class="parent">
                  <table class="table table-bordered fixTable">
                    <thead>
                      <tr>
                        <td width="8%" >Accreditation ID</td>
                        <td width="9%" >Tenant ID</td>
                        <td width="9%" >Date of Accreditation</td>
                        <td width="8%" >Date of Certification</td>
                        <td width="8%" >Date of Expiration</td>
                        <td width="8%" >Start Date of Sending Files</td>
                        <td width="8%" >Operating System</td>
                        <td width="8%" >Software Version</td>
                        <td width="8%" >File Generation</td>
                        <td width="8%" >Status</td>
                        <td width="8%" >Option</td>
                      </tr>
                    </thead>
                    <tbody id="tblaccreditationlist"></tbody>
                  </table>
                </div>
                <table class="tabledash_footer table" style="margin: 0px !important;">
                  <thead>
                    <tr>
                      <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                        <div class="row">
                          <div class="col-md-6">
                              <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtaccreditationentries"></label>
                          </div>                               
                          <div class="col-md-6">
                              <input type="hidden" id="txt_userpageaccreditation" class="form-control input-sm" style="width: 5%; text-align: center;">
                              <ul id="ulpaginationaccreditation" class="pagination pull-right"></ul>
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



<div class="modal fade" id="displaypenaltypertenant" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Penalty</h4>
        <input type="hidden" id="ptenantid">
      </div>

       <!-- Modal body-->
        <div class="modal-body"  id="modal-body-group">
          <div class="parent2">
            <table class="table table-bordered table-striped fixTable no-margin-bottom no-border-top">
                <thead>
                    <tr>
                      <td width="20%">Trade Name</td>
                      <td width="20%">Charges</td>
                      <td width="20%">Date</td>
                      <td width="20%">Balance</td>
                      <td width="20%">Penalty</td>
                    </tr>
                </thead>
                <tbody id="tbldisplaypenaltypertenant"></tbody>
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

<div class="modal fade" id="accreditationschedulemodal" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header btn-primary">
          <button type="button" class="close" onclick="closeandclear()">&times;</button>
          <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Accreditation Schedule</h4>
      </div>
      <div class="modal-body" style="display: block;">

      <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="well">
              <div class="row form-group">
                <div class="col-md-12 col-xs-12">
                  <h4 class="green smaller lighter">Accreditation Information<i id="pangedit3" class="fa fa-pencil-square-o pull-right" onclick="ibahinmoko()" style="color: green;"></i></h4>
                  
                </div>
              </div> 
              <div class="row form-group" style="display: block; height: 270px;overflow-y: scroll;">
                <div class="col-xs-12">
                  <div class="row form-group">
                    <div class="col-md-2 col-xs-12">
                    Accreditation Date
                    </div>
                    <div class="col-md-4 col-xs-12">
                      <input type="text" class="form-control date-picker AccreditationInformation" value="<?php echo date('Y-m-d'); ?>" id="accreditationdate">
                    </div>
                    <div class="col-md-2 col-xs-12">
                    Software Version
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control AccreditationInformation" placeholder="Software Version" id="softwareversion">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-2 col-xs-12">
                    Retail Partner Name
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control text_reqcompany AccreditationInformation" placeholder="Retail Partner Name" id="retailpartnername">
                    </div>
                    <div class="col-md-2 col-xs-12">
                    Operating System
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control AccreditationInformation" placeholder="Operating System" id="operatingsystem">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-2 col-xs-12">
                    Name of Pos Provider
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control text_reqcompany AccreditationInformation" placeholder="Name of Pos Provider" id="nameofposprovider">
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="input-group">
                          Mobile No
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="input-group" id="company_contact_mobile" style="width: 100%;">
                          <input type="text" id="mobilenumber" class="spinbox-input form-control input-mask-phone AccreditationInformation" maxlength="11" placeholder="(999)-999-9999">
                        </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-2 col-xs-12">
                    Number of POS Terminal/s
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control AccreditationInformation" placeholder="NUmber of POS Terminal/s" id="numberofpos">
                    </div>
                    <div class="col-xs-2 col-md-2">
                      Status
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <select id="accredtationstatus" class="AccreditationInformation" onchange="enabledatepicker();">
                        <option value="Not Accredited"> Not Accredited </option>
                        <option value="Accredited"> Accredited </option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-6 col-xs-6">
                      <div class="col-md-8 col-xs-8">
                    <h6 style="font-size:10px; font-style: italic;color: red;margin-top: 15px;margin-left: -15px;">For multiple MAC Address separate it with comma ( , )</h6>
                      </div>
                    </div>
                    <div class="col-md-2 col-xs-2">
                      Start Date of Sending Files
                    </div>
                    <div class="col-md-4 col-xs-4">
                      <input type="text" class="form-control date-picker" disabled id="startdateofsendingfiles">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-xs-2 col-md-2">
                      MAC Address <h6 style="font-size:12px; font-style: italic;">(Optional)</h6>                      
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <textarea class="form-control AccreditationInformation" id="MACAddress" style="resize: none;height: 77px;"></textarea>
                    </div>
                    
                    <div class="col-md-2 col-xs-12">
                      Remarks
                    </div>
                    <div class="col-md-4 col-xs-12">
                      <textarea class="form-control AccreditationInformation" id="remarks" style="resize: none;height: 77px;"></textarea>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="col-md-6 col-xs-6">
              <div class="well">
                <div class="row form-group">
                  <div class="col-md-12 col-xs-12">
                      <h4 class="green smaller lighter">POS Information<i id="pangedit2" class="fa fa-pencil-square-o pull-right" onclick="ibahinmoko2()" style="color: green;"></i></h4>
                  </div>
                </div> 
              <div class="row form-group"  style="display: block; height: 300px;overflow-y: scroll;">
                <div class="col-xs-12 col-md-12">
                  <label style="font-weight: bold;">Nature of POS</label>
                    <div class="checkbox">
                      <label>
                        <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos POSInformation" id="Food" value="Food" type="checkbox" />
                        <span class="lbl"> Food </span>
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos POSInformation" id="Grocery" value="Grocery" type="checkbox" />
                        <span class="lbl"> Grocery </span>
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos POSInformation" id="Retail" value="Retail" type="checkbox" />
                        <span class="lbl"> Retail </span>
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos POSInformation" id="Service" value="Service" type="checkbox" />
                        <span class="lbl"> Service </span>
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos POSInformation" id="Pharmaceutical" value="Pharmaceutical" type="checkbox" />
                        <span class="lbl"> Pharmaceutical </span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                  <label style="font-weight: bold;">Text File Generator Requirements</label>
                    <div class="radio">
                      <label>
                        <input name="form-field-radio" class="ace ace-radio-2 textfilegenerator POSInformation" value="Automatic" type="radio" />
                        <span class="lbl"> Auto Generation of textfile upon end of day/Z-reading report </span>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input name="form-field-radio" class="ace ace-radio-2 textfilegenerator POSInformation" value="Manual" type="radio" />
                        <span class="lbl"> Manual generation of textfile with data back track capability </span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>   
            </div>
            <div class="col-md-6 col-xs-6">
              <div class="well">
                <h4 class="green smaller lighter">Requirements</h4>
                <form name='postingpicture' class='form_lease_application_req' id='postingpicture'> 
                  <div class="row">
                    <div class="col-xs-6">Network</div>
                    <div class="col-xs-6">
                      <input type="file" class="upload_acc_req id-input-file-2" id="bruno" name="bruno"/>
                      <input type="hidden" name="clint" id="clint">
                    </div>
                    <div class="col-xs-6">Accuracy of Data</div>
                    <div class="col-xs-6">
                      <input type="file" class="upload_acc_req id-input-file-2" id="bruno2" name="bruno2"/>
                    </div>
                  </div>
                </form>
              </div>     
            </div>
          </div>
        </div>



      </div>

      <div class="modal-footer" style="margin-top: -25px;">
        <button class="btn btn-sm btn-primary" onclick="saveaccreditationschedule()">
            <label id="anogagawin"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Save</label>
        </button>
      </div>
    </div>  
  </div>
</div>

<div class="modal fade" id="createnewschedule" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header btn-primary">
          <button type="button" class="close" onclick='showschedulingmodal();'>&times;</button>
          <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Accreditation Schedule</h4>
      </div>
      <div class="modal-body" style="display: block;">

      <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="well">
              <div class="row form-group">
                <div class="col-md-12 col-xs-12">
                  <h4 class="green smaller lighter">Accreditation Information</h4>
                  
                </div>
              </div> 
              <div class="row form-group" style="display: block; height: 150px;overflow-y: scroll;">
                <div class="col-xs-12">
                  <div class="row form-group">
                    <div class="col-md-2 col-xs-12">
                      Tenant ID
                    </div>
                    <div class="col-md-4 col-xs-12">
                      <select class="form-control" id="tenantidwithnoaccreditation">
                        <option>-- Select Tenant --</option>
                      </select>
                    </div>
                     <div class="col-md-2 col-xs-12">
                    Accreditation Date
                    </div>
                    <div class="col-md-4 col-xs-12">
                      <input type="text" class="form-control date-picker" value="<?php echo date('m/d/Y'); ?>" id="accreditationdate2">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-2 col-xs-12">
                    Software Version
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control" placeholder="Software Version" id="softwareversion2">
                    </div>
                     <div class="col-md-2 col-xs-12">
                    Operating System
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control" placeholder="Operating System" id="operatingsystem2">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-2 col-xs-12">
                    Retail Partner Name
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control text_reqcompany" placeholder="Retail Partner Name" id="retailpartnername2">
                    </div>
                    <div class="col-md-2 col-xs-12">
                    Name of Pos Provider
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control text_reqcompany" placeholder="Name of Pos Provider" id="nameofposprovider2">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-2 col-xs-12">
                    Number of POS Terminal/s
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <input type="text" class="form-control" placeholder="NUmber of POS Terminal/s" id="numberofpos2">
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="input-group">
                          Mobile No
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="input-group" id="company_contact_mobile" style="width: 100%;">
                          <input type="text" id="mobilenumber2" class="spinbox-input form-control input-mask-phone" maxlength="11" placeholder="(999)-999-9999">
                        </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-6 col-xs-6">
                      <div class="col-md-8 col-xs-8">
                    <h6 style="font-size:10px; font-style: italic;color: red;margin-top: 15px;margin-left: -15px;">For multiple MAC Address separate it with comma ( , )</h6>
                      </div>
                    </div>
                    
                  </div>
                  <div class="row form-group">
                    <div class="col-xs-2 col-md-2">
                      MAC Address <h6 style="font-size:12px; font-style: italic;">(Optional)</h6>                      
                    </div>
                    <div class="col-xs-4 col-md-4">
                      <textarea class="form-control" id="MACAddress2" style="resize: none;height: 77px;"></textarea>
                    </div>
                    
                    <div class="col-md-2 col-xs-12">
                      Remarks
                    </div>
                    <div class="col-md-4 col-xs-12">
                      <textarea class="form-control" id="remarks2" style="resize: none;height: 77px;"></textarea>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="well">
              <div class="row form-group">
                <div class="col-md-12 col-xs-12">
                    <h4 class="green smaller lighter">POS Information</h4>
                </div>
              </div> 
            <div class="row form-group"  style="display: block; height: 135;overflow-y: scroll;">
              <div class="col-xs-6 col-md-6" style="border-right: 1px dotted #CCC;">
                <label style="font-weight: bold;">Nature of POS</label>

                <div class="col-xs-12 col-md-12">
                  <div class="col-xs-6 col-md-6">
                    <label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos2" id="Food" value="Food" type="checkbox" />
                      <span class="lbl"> Food </span>
                    </label>
                  </div>
                  <div class="col-xs-6 col-md-6">
                    <label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos2" id="Grocery" value="Grocery" type="checkbox" />
                      <span class="lbl"> Grocery </span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12 col-md-12">
                  <div class="col-xs-6 col-md-6">
                    <label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos2" id="Retail" value="Retail" type="checkbox" />
                      <span class="lbl"> Retail </span>
                    </label>
                  </div>
                  <div class="col-xs-6 col-md-6">
                    <label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos2" id="Service" value="Service" type="checkbox" />
                      <span class="lbl"> Service </span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12 col-md-12">
                  <div class="col-xs-6 col-md-6">
                    <label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 natureofpos2" id="Pharmaceutical" value="Pharmaceutical" type="checkbox" />
                      <span class="lbl"> Pharmaceutical </span>
                    </label>
                  </div>
                </div>
              </div>
                <div class="col-xs-6 col-md-6">
                <label style="font-weight: bold;">Text File Generator Requirements</label>
                  <div class="radio">
                    <label>
                      <input name="form-field-radio" class="ace ace-radio-2 textfilegenerator2" value="Automatic" type="radio" />
                      <span class="lbl"> Auto Generation of textfile upon end of day/Z-reading report </span>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input name="form-field-radio" class="ace ace-radio-2 textfilegenerator2" value="Manual" type="radio" />
                      <span class="lbl"> Manual generation of textfile with data back track capability </span>
                    </label>
                  </div>
                </div>
              </div>
            </div>   
          </div>
        </div>
      </div>

      <div class="modal-footer" style="margin-top: -25px;">
        <button class="btn btn-sm btn-primary" onclick="saveschedule()">
            <label id="anogagawin"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Save</label>
        </button>
      </div>
    </div>  
  </div>
</div>

<div class="modal fade" id="penaltymodal" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-xs" style="width: 300px;">

    <div class="modal-content">

      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Penalty</h4>
      </div>

      <div class="modal-body" id="modal-body-group" style="margin-top:-20px;margin-left:-10px;margin-right:-10px;">
      <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="well">
              <div class="row form-group" style="margin-left: -20px;">
                <div class="col-xs-12 col-md-12">
              <div class="row form-group">
                <div class="col-xs-12 col-md-12">
                  <div class="col-xs-3 col-md-3">
                    Reason
                  </div>
                  <div class="col-xs-9 col-md-9">
                    <input type="text" id="reasonforpenalty" class=" settingofpenalty">
                  </div>
                </div>
              </div>
              <div class="row form-group" style="margin-bottom: -15px;">
                <div class="col-xs-12 col-md-12">
                  <div class="col-xs-3 col-md-3">
                    Amount
                  </div>
                  <div class="col-xs-9 col-md-9">
                    <input type="text" class="goblin settingofpenalty" id="amountforpenalty">
                  </div>
                </div>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="margin-top: -30px;">
        <button class="btn btn-minier btn-primary" onclick="sendpenalty()">
            <label id="anogagawin"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Save&nbsp;</label>
        </button>
      </div>
    </div>
  </div>
</div>

<div style="display: none;">
  <center>
    <div class="checklist" id="div_form_accreditation" style="margin-top: 20px; width: 99%;margin-bottom: 0;">
      <center>
        <table cellspacing="0" style="padding: 5px; width: 95%">
          <tr>
            <td colspan="2" align="center">
              <div style="width: 100%; text-align: left;">
                <table style="width: 100%;" cellspacing="0" cellpadding="0">
                  <tbody id="template3"></tbody>
                </table>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <center>
                <p style="font-size: 16px; font-weight: bold; margin-top: 25px;">Accreditation List</p>
              </center>
            </td>
          </tr>
          <tr>
          <td colspan="2">
              <center>
                <p style="font-size:; 12px; margin-top: 5px;">From:&nbsp;&nbsp;<label id="dateFrom11"></label>&nbsp;&nbsp;To&nbsp;&nbsp;<label id="dateTo11"></label></p>
              </center>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <center>
                <table class="table table-bordered table-hover" cellpadding="5px" align="center"> 
                  <thead>
                    <tr style="border-left:1px solid #111109;border-right:1px solid #111109;">
                      
                      <td width="20%" style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Tenant ID</h6>
                      </td>
                      <td width="15%" style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Date of Accreditation</h6>
                      </td>
                      <td width="15%" style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Operating System</h6>
                      </td>
                      <td width="20%" style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Software Version</h6>
                      </td>
                      <td width="15%" style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">File Generation</h6>
                      </td>
                      <td width="15%" style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">Statu</h6>
                      </td>
                    </tr>
                  </thead>
                  <tbody id="displayaccreditationtbl"></tbody>
                </table>
              </center>
            </td>
          </tr>
        </table>
      </center>
    </div>
  </center>
</div>

<input type="hidden" id="weaken">
<input type="hidden" id="execute">
<input type="hidden" id="execute2">
<input type="hidden" id="flicker">
<input type="hidden" id="mallid">
<input type="hidden" id="wingid">
<input type="hidden" id="floorid">
<input type="hidden" id="unittype">
<input type="hidden" id="unitid">
<input type="hidden" id="tenantid">
<input type="hidden" id="tenantmonth">
<?php 
// include("../../setup/systemsetup/script.php");
include ("connect.php");
include ("../salesaudit/script.php");
?>