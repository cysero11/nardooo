<style>
.div_inquiry_wells {
   float: left;
   margin: 10px;
   padding: 10px;
   width: 250px;
   max-width: 250px;
   min-height: 350px;
   height: auto;
   border: 1px solid #ddd;
   background-image: url("images/background.png");
   background-repeat: repeat;
   text-align: center;
   vertical-align: middle;
}

</style>
<!-- ============ MODAL INQUIRY ============= -->
<div class="modal fade" id="modal_addnewinquiry" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" id="modal_div_inquiry" style="width:85%;">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" onclick="closeinquirymodal()">&times;</button>
        <h4 class="modal-title" id="div_modal_title_inquiry" style="color:white; font-weight: bold;">New Inquiry</h4>
        <input type="hidden" id="statinquiryyy" name="">
        <input type="hidden" class="text_inquiry" id="txtinq_inquiryid" name="">
        <input type="hidden" id="status_filled" name="">
      </div>

       <!-- Modal body-->
      <div class="" id="statussavingreservation"></div>
      <div class="modal-body" style="display: block; height: 35em;" id="div_view_inquiry_modal">
            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                  <div class="col-sm-12">
                    <div class="tabbable">
                      <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                          <a data-toggle="tab" href="#home" id="div_businessinfo">
                            <i class="green ace-icon fa fa-info bigger-120"></i>
                            Tenant Information
                          </a>
                        </li>

                        <li>
                          <a data-toggle="tab" href="#unitinfo" id="div_unitinfo">
                          <i class="yellow ace-icon fa fa-key bigger-120"></i>
                            Unit Information
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#contactperson">
                          <i class="blue ace-icon fa fa-user bigger-120"></i>
                            Contact Persons
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#remarks" id="div_remarks_n_req">
                          <i class="orange ace-icon fa fa-pencil bigger-120"></i>
                            <text id="txtremakrstext">Remarks</text>
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#termsandcon" id="div_termsandcon">
                          <i class="green ace-icon fa fa-check-square-o bigger-120"></i>
                            Terms and Conditions
                          </a>
                        </li>
                      </ul>

                      <div class="tab-content" style="display: block; height: 28em;overflow-y: scroll;padding-bottom:0px;padding-top: 10px;">
                        <div id="home" class="tab-pane fade in active">
                          <div class="row form-group" style="margin-bottom: 0px;">
                            <div class="col-md-6 col-xs-12">
                                <div class="well" style="padding-bottom: 0px;padding-top: 20px;">
                                  <div class="row form-group" style="margin-bottom: 15px !important;">
                                    <div class="col-xs-12">
                                        <div class="row form-group" style="margin-bottom: 15px !important;">
                                          <div class="col-md-3 col-xs-12">
                                                Mall Branch
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                            <!-- <input list="list_mallbranch" id="txtinq_mallbranch" class="form-control text_inquiry required_inq div_businessinfo" type="text" li="txtbuss" placeholder="-- Select Mall Branch --" oninput="changemallselected()"/>
                                                <datalist id="list_mallbranch">

                                                </datalist> -->
                                            <select id="txtinq_mallbranch" class="form-control text_inquiry required_inq div_businessinfo">

                                            </select>
                                          </div>
                                        </div>

                                        <div class="row form-group" style="margin-bottom: 15px !important;">
                                          <div class="col-md-3 col-xs-12">
                                                Store Name
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                              <input type="text" id="txtinq_tradename" name="" class="form-control text_inquiry required_inq div_businessinfo" placeholder="Click to search store name ..." onclick="loadtradefunction()" onfocus="loadtradefunction()" style="background-color: white !important;" readonly>
                                          </div>
                                        </div>

                                        <div class="row form-group" style="margin-bottom: 15px !important;">
                                          <div class="col-md-3 col-xs-12">
                                                Company
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                              <input type="text"  style="" id="txtinq_companyname" name="" class="form-control text_inquiry required_inq div_businessinfo" placeholder="Company Name" disabled>
                                          </div>
                                        </div>

                                        <div class="row form-group" style="margin-bottom: 15px !important;">
                                          <div class="col-md-3 col-xs-12">
                                                Industry
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                              <input type="text"  style="" id="txtinq_industryname" name="" class="form-control text_inquiry required_inq div_businessinfo" placeholder="Select Industry" disabled>
                                          </div>
                                        </div>

                                        <div class="row form-group" style="margin-bottom: 15px !important;">
                                          <div class="col-md-3 col-xs-12">
                                                Address
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                              <textarea style="height: 70px;" id="txtinq_address" class="form-control text_inquiry required_inq div_businessinfo" placeholder="Address" disabled></textarea>
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                              <div class="well" style="padding-bottom: 0px;padding-top: 20px;">
                                  <div class="row form-group" style="margin-bottom: 15px !important;">
                                    <div class="col-xs-12">
                                    </div>
                                  </div>
                                  <div class="row form-group" style="margin-bottom: 15px !important;">
                                    <div class="col-xs-12" style="display: inline-block; height: 265px;overflow-y: scroll;" id="div_inquiry_contact_numbers">

                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="unitinfo" class="tab-pane fade">
                          <div class="row form-group" style="margin-bottom: 15px !important;">
                            <div class="col-md-12 col-xs-12">
                              <div class="well">
                                  <div class="row form-group" style="margin-bottom: 15px !important;">
                                    <div class="col-xs-12 col-md-5">
                                          <div class="row form-group" style="margin-bottom: 15px !important;">
                                            <div class="col-xs-12">
                                              <h4 class="green smaller lighter">Unit Information</h4>
                                            </div>
                                          </div>
                                          <div class="row form-group" style="margin-bottom: 15px !important;">
                                            <div class="col-xs-12">

                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;">
                                                <div class="col-md-4">
                                                  <div class="radio">
                                                    <label>
                                                      <input name="form-field-radio" type="radio" class="ace" id="radio_set" onclick="clickset()" />
                                                      <span class="lbl">&nbsp;&nbsp;&nbsp;SET</span>
                                                    </label>
                                                  </div>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="radio">
                                                    <label>
                                                      <input name="form-field-radio" type="radio" class="ace" id="radio_lca" onclick="clicklca()"/>
                                                      <span class="lbl">&nbsp;&nbsp;&nbsp;Leasable Common Area</span>
                                                    </label>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 15px;">
                                                <div class="col-xs-12">
                                                    <div class="row form-group">
                                                        <label class="col-md-4">Select Unit</label>
                                                        <div class="col-md-8">
                                                            <button class="btn btn-primary btn-sm col-md-12" onclick="tblselectshortcutunit(); $('#modalshortcutunit').modal('show');"><i class="ace-icon fa fa-level-up"></i>&nbsp;Shortcut</button>
                                                        </div>
                                                    </div>
                                                  <div class="row form-group" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      Classification
                                                    </div>
                                                  <div class="col-md-8">
                                                  <select id="txtinq_unitclass" class="form-control text_inquiry required_inq" onchange="changeclassification()">
                                                    <option value="">-- Select Classification --</option>
                                                    <?php
                                                        $queryind = "SELECT classificationID, classification FROM tblref_merchandise_class";
                                                        $rsss = mysql_query($queryind, $connection);
                                                        while($row = mysql_fetch_array($rsss)){
                                                          $industry = "<option value='".$row['classificationID']."'> ";
                                                          $industry .= $row['classification']."</option>";

                                                          echo $industry;
                                                        }
                                                    ?>
                                                    </select>
                                                  </div>
                                                </div>

                                                <!-- department -->
                                                <div class="row form-group" style="margin-bottom: 15px !important;">
                                                  <div class="col-md-4">
                                                    Department
                                                  </div>
                                                  <div class="col-md-8">
                                                    <select id="txtinq_unitdepartment" class="form-control text_inquiry required_inq div_unitinfo" onchange="loadinquiry_category()">
                                                    <option value="">-- Select Department --</option>
                                                    </select>
                                                  </div>
                                                </div>
                                                <!-- category -->
                                                <div class="row form-group" style="margin-bottom: 15px !important;">
                                                  <div class="col-md-4">
                                                    Category
                                                  </div>
                                                  <div class="col-md-8">
                                                   <select id="txtinq_unitcategory" class="form-control text_inquiry required_inq div_unitinfo" onchange="loadinquiry_wing_lca()">
                                                    <option value="">-- Select Category --</option>
                                                   </select>
                                                  </div>
                                                </div>
                                                </div>
                                              </div>
                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 15px;">
                                                <div class="col-xs-12">
                                                  <!-- wing -->
                                                  <div class="row form-group" id="div_wing" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      Wing/Bldg
                                                    </div>
                                                    <div class="col-md-8">
                                                      <select id="txtinq_unitwing" class="form-control required_inq text_inquiry" onchange="loadinquiry_flr()">
                                                        <option value="">-- Select Wing --</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <!-- floor -->
                                                  <div class="row form-group" id="div_floor" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      Floor
                                                    </div>
                                                    <div class="col-md-8">
                                                      <select id="txtinq_unitfloor" class="form-control required_inq text_inquiry" onchange="loadinquiry_unit_lca()" >
                                                        <option value="">-- Select Floor --</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <!-- unit -->
                                                  <div class="row form-group" id="div_unit_set">
                                                    <div class="col-md-4">
                                                      Unit
                                                    </div>
                                                    <div class="col-md-8">
                                                      <select id="txtinq_unitunit" class="form-control text_inquiry" onchange="selected_unit();" >
                                                        <option value="">-- Select Unit --</option>
                                                      </select>
                                                    </div>
                                                  </div>

                                                  <div class="row form-group" id="div_unit_lca">
                                                    <div class="col-md-4">
                                                      Unit
                                                    </div>
                                                    <div class="col-md-8">
                                                      <select class="form-control" name="" id="txtinq_lca_unitname" placeholder="Enter Unit Name" onchange="txtchklcaunitval();selected_lca_unit()">
                                                        <option value="">-- Select Unit --</option>
                                                      </select>
                                                      <!-- <input type="text" class="form-control" name="" id="txtinq_lca_unitname" placeholder="Enter Unit Name" onkeyup="txtchklcaunitval()"> -->
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 15px;margin-bottom: 15px !important;">
                                                <div class="col-xs-12">
                                                  <div class="row form-group" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      Occupancy Date
                                                    </div>
                                                    <div class="col-md-4">
                                                      <input class="form-control kev-date-picker required_inq" id="txtinq_datefrom" type="text" onchange="loaddatetofunction();"/>
                                                      <script type="text/javascript">

                                                      </script>
                                                    </div>
                                                    <div class="col-md-4">
                                                      <input type="text" name="" id="txtinq_dateto" class="form-control date-picker required_inq" data-date-format="dd-mm-yyyy" onchange="loaddatetofunction8()" disabled>

                                                    </div>
                                                  </div>

                                                  <div class="row form-group" id="div_nomonths" style="display: block;margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      No of Months
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input type="text" class="form-control numonly required_inq text_inquiry" placeholder="0" name="" id="txtnoofmonths_inq" onkeyup="loaddatetofunction();" maxlength="2" onchange="">

                                                    </div>
                                                    <div class="col-md-6"></div>
                                                  </div>

                                                  <div class="row form-group" id="div_advance_set" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      Advance<br />
                                                      <h6 style="font-size:10px; font-style: italic;">(No of Months)</h6>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input class="form-control text_inquiry numonly" id="txtinq_monthlyadvamt" type="text" placeholder="0" onkeyup="loaddatefunction4()"  maxlength="2"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <input type="text" id="txtinq_advancepayment" style="text-align: right;background-color: white;" class="numonly form-control text_inquiry amount" placeholder="0.00" disabled="true" />
                                                    </div>
                                                  </div>

                                                  <div class="row form-group" id="div_deposit_set" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      Deposit<br />
                                                      <h6 style="font-size:10px; font-style: italic;">(No of Months)</h6>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input class="form-control text_inquiry numonly" id="txtinq_monthlydepamt" type="text" placeholder="0" onkeyup="loaddatefunction4()"  maxlength="2"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <input type="text" id="txtinq_depositpayment" style="text-align: right;background-color: white;" class="numonly form-control amount text_inquiry" placeholder="0.00" disabled="true" />
                                                    </div>
                                                  </div>

                                                  <div class="row form-group" id="div_nodays" style="display: none;margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      No of Days
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input type="text" class="form-control numonly text_inquiry" placeholder="0" name="" id="txtnoofdays_inq" onkeyup="loaddatetofunction()">
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                  </div>

                                                  <div class="row form-group" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4" id="txtlabel_payment">
                                                      Monthly Payment
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input type="text" id="txtinq_monthlyrate2" style="text-align: right;" class="form-control text_inquiry numonly amount" placeholder="0.00" disabled/>
                                                    </div>
                                                  </div>
                                                  <div class="row form-group" id="div_advance_set_amt" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      Advance
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input type="text" id="txtinq_advancepayment2" style="text-align: right;" class="numonly amount form-control text_inquiry" placeholder="0.00" />
                                                    </div>
                                                  </div>
                                                  <div class="row form-group" id="div_deposit_set_amt" style="margin-bottom: 15px !important;">
                                                    <div class="col-md-4">
                                                      Deposit
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input type="text" id="txtinq_depositpayment2" style="text-align: right;" class="numonly amount form-control text_inquiry" placeholder="0.00" />
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;padding-top:15px;padding-bottom:13px;margin-left: 3px;">
                                                <div class="col-xs-12">
                                                  <div class="row form-group">
                                                    <div class="col-md-4">
                                                      Billing Type
                                                    </div>
                                                    <div class="col-md-6">
                                                      <select id="txttenanttype" class="form-control text_inquiry required_inq text_inquiry" style="font-size: 12px; margin-bottom: 5px;" onchange="chkbilltype()">
                                                        <option value="">Select Billing Type</option>
                                                        <option value="Rent">Rent</option>
                                                        <option value="Rent | Rev">Rent + Rev</option>
                                                        <option value="Rent or Share">Rent or Share</option>
                                                        <option value="Share Olny">Share Only</option>
                                                      </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <span class="input-icon icon-on-right" style="width: 100%;display: none;" id="txttenanttypepercent2">
                                                          <input id="txttenanttypepercent" class="form-control cardgroup numonly text_inquiry" style="margin-bottom: 5px;">
                                                          <span class="ace-icon fa fa-percent" style="font-weight: normal; font-size: 12px;"></span>
                                                      </span>
                                                    </div>
                                                  </div>
                                                  <div class="row form-group">
                                                    <div class="col-md-4">
                                                      Merchant Code
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input type="text" class="form-control text_inquiry required_inq" name="" maxlength="3" id="txtmerchantcode">
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-md-7">
                                      <div class="row form-group" style="margin-bottom: 15px !important;">
                                        <div class="col-xs-12">
                                          <h4 class="green smaller lighter">Unit Area</h4>
                                        </div>
                                      </div>
                                      <div class="row form-group" style="margin-bottom: 15px !important;">
                                        <div class="col-xs-12">
                                          <div class="row form-group" id="div_unit_area_set" style="margin-bottom: 15px !important;">
                                            <div class="col-md-4">
                                              Unit Area
                                            </div>
                                            <div class="col-md-8">
                                              <input type="text" class="form-control text_inquiry" name="" id="txtinq_sqm" style="text-align: right;" disabled="" placeholder="square meter">
                                            </div>
                                          </div>
                                          <div class="row form-group" id="div_unit_area_lca" style="margin-bottom: 15px !important;">
                                            <div class="col-md-4">
                                              Unit Area
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control text_inquiry numonly" name="" id="txtinq_sqm_width" style="text-align: right;" disabled=""  placeholder="Width">
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control text_inquiry numonly" name="" id="txtinq_sqm_length" style="text-align: right;" disabled="" onkeyup="unitareachk()" placeholder="Length">
                                            </div>
                                          </div>
                                          <div class="row form-group" style="margin-bottom: 15px !important;">
                                            <div class="col-md-4">
                                              price per Sq M
                                            </div>
                                            <div class="col-md-8">
                                              <input type="text" class="form-control amount numonly text_inquiry" onkeyup="unitareachk()" style="text-align: right;" name="" placeholder="0.00" id="txtinq_persqm" disabled="">
                                            </div>
                                          </div>
                                          <div class="row form-group" style="margin-bottom: 15px !important;">
                                            <div class="col-md-4">
                                              Total Price
                                            </div>
                                            <div class="col-md-8">
                                              <input type="text" class="form-control amount numonly text_inquiry" style="text-align: right;" name="" placeholder="0.00" id="txtinq_totalsqm" disabled="">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group" style="margin-bottom: 15px !important;">
                                        <div class="col-md-12 col-xs-12">
                                          <div class="row form-group" style="margin-bottom: 15px !important;">
                                          <div class="col-xs-12">
                                            <h4 class="green smaller lighter">Post Dated Cheque</h4>
                                          </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="" id="statussavingreservation"></div>
                                            <div class="parent">
                                            <table class="table table-striped table-bordered fixTable" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
                                              <thead style="flex: 0 0 auto;width: calc(100%);">
                                                <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                                                  <th style="width:15%;" class="center">#</th>
                                                  <th>PDC Date</th>
                                                  <th style="text-align: right;">Monthly Rent</th>
                                                  <th style="text-align: center;">Check No</th>
                                                  <th style="text-align: center;">Bank</th>
                                                </tr>
                                              </thead>

                                              <tbody id="tbodypdc_inquiry" style="">

                                              </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                          <div class="hr hr8 hr-double hr-dotted"></div>

                                          <div class="row">
                                            <div class="col-sm-12 pull-right">
                                              <h4 class="pull-right">
                                                Total Amount :
                                                <span class="red" id="lbltotalamountofpayment">Php 0.00</span>
                                              </h4>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12" id="div_amenities_inquiry" style="margin-top: 20px;">
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="contactperson" class="tab-pane fade">
                          <div class="row form-group" style="margin-bottom: 15px !important;">
                            <div class="col-md-12 col-xs-12">
                                <div class="well">
                                  <div class="row form-group" style="margin-bottom: 15px !important;">
                                    <div class="col-xs-12" style="display: inline-block; height: 380px; overflow-y: scroll;" id="div_inquiry_contact_person">
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div id="remarks" class="tab-pane fade">
                          <div class="row form-group" id="div_last_row" style="margin-bottom: 15px !important;">
                            <div class="col-md-6 col-xs-12" id="div_modal_inquiry_remarks">
                                  <div class="well">
                                    <div class="row form-group" style="margin-bottom: 15px !important;">
                                      <div class="col-xs-12">
                                        <h4 class="green smaller lighter">Remarks</h4>
                                      </div>
                                    </div>
                                    <div class="row form-group" style="margin-bottom: 15px !important;">
                                      <div class="col-xs-12">
                                        <textarea class="form-control text_inquiry" id="txtinq_remarks" style="height: 60px;"></textarea>
                                      </div>
                                    </div>
                                  </div>
                            </div>

                            <div class="col-md-6 col-xs-12" id="div_modal_inquiry_requirements">
                                  <div class="well" id="brdrwell_req">
                                    <div class="row form-group" style="margin-bottom: 15px !important;" >
                                      <div class="col-xs-12">
                                        <h4 class="green smaller lighter">Requirements</h4>
                                      </div>
                                    </div>
                                    <div class="row form-group" style="margin-bottom: 15px !important;">
                                      <div class="col-xs-12">

                                            <div class="form-group" id="div_req_passed" style="overflow-y: scroll;overflow-x: hidden;margin-bottom: 15px !important;">

                                            </div>

                                      </div>
                                    </div>
                                  </div>
                            </div>
                          </div>
                        </div>

                        <div id="termsandcon" class="tab-pane fade">
                          <div class="row form-group" style="margin-bottom: 0px;">
                            <div class="col-md-12 col-xs-12">
                              <div class="well">
                                <div class="row form-group">
                                  <div class="col-xs-12">
                                    <h4 class="green smaller lighter" align="center">TERMS AND CONDITIONS</h4>
                                    <button class='btn btn-xs btn-primary' onclick='modal_tncdirect()' id="btn_addtermsandcondition" title='Add Terms and Conditions'>Add Terms and Conditions</button>
                                  </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col-xs-12">
                                  <div class="parent">
                                    <table id="simple-table" class="table  table-striped table-hover fixTable">
                                        <thead>
                                            <tr>
                                              <td width="15%">Group Name</td>
                                              <td width="20%">Term Name</td>
                                              <td width="35%">Condition</td>
                                            </tr>
                                        </thead>
                                        <tbody id="displayselected"></tbody>
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
                  </div><!-- /.col -->

                  <div class="vspace-6-sm"></div>
                </div><!-- /.row -->

                <div class="space"></div>
              </div>
            </div>
      </div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <div class="row form-group" style="margin-bottom: 0px;">
          <div class="col-md-4" style="padding-top: 5px;">
            <label class="updatedby_texts">
              <small class="text-success pull-left">
                <b>Created by:</b>&nbsp;<i id="txtinq_createdby"></i>
              </small>
              <small class="text-success pull-left">
                <b>Date Created:</b>&nbsp;<i id="txtinq_datecreated"></i>
              </small>
            </label>
          </div>
          <div class="col-md-4 pull-left" style="padding-top: 5px;">
            <label class="modified_info">
              <small class="text-success pull-left">
                <b>Modified by:</b>&nbsp;<i id="txtinq_modifby"></i>
              </small>
              <small class="text-success pull-left">
                <b>Date Modified:</b>&nbsp;<i id="txtinq_modifdate"></i>
              </small>
            </label>
          </div>
          <div class="col-md-4">
            <button type="button" class="btn btn-primary" id="btn_savenewtenant" onclick="saveinquiry()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script>

var date = new Date();
date.setDate(date.getDate() - 0);
$('.kev-date-picker').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy',
    startDate: date
});

$(function(){
  $("#status_filled").val("0");
  $('#modal_addnewinquiry').on('shown.bs.modal', function() {
    $('#txtinq_mallbranch').focus();
  })

  $('#modal_newtradename').on('shown.bs.modal', function() {
    $('#txttrade_tradename').focus();
  })

  $('#modal_loadtradename').on('shown.bs.modal', function() {
    $('#txtsearchtradename').focus();
  })

  $('#modal_loadcompany').on('shown.bs.modal', function() {
    $('#txtsearchcompany').focus();
  })

  $('#modal_new_company').on('shown.bs.modal', function() {
    // $('#txtcomp_name').val("");
    $('#txtcomp_name').focus();
    loadcompanylist();
  })

  $('#modal_loadtradename').on('hidden.bs.modal', function() {
    $('#txtinq_mallbranch').focus();
  })

  $('#modal_newtradename').on('hidden.bs.modal', function() {
    $('#txtsearchtradename').focus();
  })

  $('#modal_loadcompany').on('hidden.bs.modal', function() {
    $('#txttrade_tradename').focus();
  })

  $('#modal_new_company').on('hidden.bs.modal', function() {
    $('#txtsearchcompany').focus();
  })

  $(".required_inq").keyup(function(){
    $("#status_filled").val("1");
  })

  $(".required_inq").change(function(){
    $("#status_filled").val("1");
  })
})

// for elements that only accepts numbers
  function numonly()
    {
       $(".numonly").keydown(function(event) {

           // Allow only backspace and delete
           if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190 || event.keyCode == 9) {
               // let it happen, don't do anything
           }
           else {
               // Ensure that it is a number and stop the keypress
               if (event.keyCode < 48 || event.keyCode > 57 ) {
                   event.preventDefault();
               }
           }
       });

       $(".amount").change(function(){
            var v = parseFloat($(this).val());
            $(this).val((isNaN(v)) ? '' : v.toFixed(2));
       });
     }

$(function(){
  $("#txtinq_unitdepartment").prop("disabled", true);
  $(".updatedby_texts").css("display", "none");
  $(".modified_info").css("display", "none");
  $("#statinquiryyy").val("valid");
  numonly()
});

function chkbilltype()
{
  var type = $("#txttenanttype").val();
  var stat = $("#reservation_stat_select").val();
  if(type == "Rent")
  {
    $("#txttenanttypepercent2").css("display", "none");
    $("#txttenanttypepercent").removeClass("required_inq");
  }
  else
  {
    $("#txttenanttypepercent2").css("display", "block");
    $("#txttenanttypepercent").removeClass("required_inq");
    $("#txttenanttypepercent").addClass("required_inq");
  }
}

function removethiscontactperson(idnum)
{
  showmodal("confirm", "Are you sure you want to remove this contact person? Click \"OK\" to proceed.", "removecontactper(\""+idnum+"\")", null, "$(\"#alertmodal\").modal(\"hide\")", null, "1");
}

function load_mall_select()
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'form=load_mall_select',
    success: function(data)
    {
      $("#txtinq_mallbranch").html(data);
    }
  })
}

function load_mall_select_class()
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'form=list_classification',
    success: function(data)
    {
      $("#txtinq_unitclass").html(data);
    }
  })
}

function loadrequirements_tenants()
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'form=loadrequirements_tenants',
    success: function(data)
    {
      $("#div_req_passed").html(data);
      uploadrequirementscss();
    }
  });
}


function changemallselected()
{
  var mallid = $("#txtinq_mallbranch").val();
  if(mallid != "" && mallid != undefined)
  {
    $("#txtinq_unitclass").prop("disabled", false);
  }
  else
  {
    $("#txtinq_unitclass").prop("disabled", true);
    $("#txtinq_unitclass").val("");
    changeclassification();
  }
}

function removecontactper(idnum)
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'id=' + idnum + '&form=removecontactper',
    success: function(data)
    {
      if(data == 1)
      {
        showmodal("alert", "Contact person permanently deleted.", "", null, "", null, "0");
        $("div").remove("#contact_"+idnum+"");
      }
    }
  })
}

function txtchklcaunitval()
{
  var lca = $("#txtinq_lca_unitname").val();
  if(lca != "")
  {
    $("#txtinq_datefrom").prop("disabled", false);
    $("#txtnoofmonths_inq").prop("disabled", false);
    $("#txtinq_monthlyadvamt").prop("disabled", false);
    $("#txtinq_advancepayment").prop("disabled", false);
    $("#txtinq_monthlydepamt").prop("disabled", false);
    $("#txtinq_depositpayment").prop("disabled", false);
    $("#txtinq_monthlyrate2").prop("disabled", true); //autofill

    $("#txtinq_dateto").prop("disabled", true); //autofill
    $("#txtnoofdays_inq").prop("disabled", false);
    $("#txtinq_advancepayment2").prop("disabled", false);
    $("#txtinq_depositpayment2").prop("disabled", false);
    $("#txtinq_sqm_width").prop("disabled", true); //autofill
    $("#txtinq_sqm_length").prop("disabled", true); //autofill
    $("#txtinq_persqm").prop("disabled", true); //autofill
    $("#txtinq_totalsqm").prop("disabled", true); //autofill

    //require lca unit information if LCA UNIT is NOT empty
    $("#txtinq_datefrom").addClass("required_inq");
    $("#txtinq_dateto").addClass("required_inq");
    $("#txtnoofmonths_inq").addClass("required_inq");
    $("#txtnoofdays_inq").addClass("required_inq");
    $("#txtinq_monthlyrate2").addClass("required_inq");
    $("#txtinq_advancepayment2").addClass("required_inq");
    $("#txtinq_depositpayment2").addClass("required_inq");
    $("#txtinq_sqm_width").addClass("required_inq");
    $("#txtinq_sqm_length").addClass("required_inq");
    $("#txtinq_persqm").addClass("required_inq");
    $("#txtinq_totalsqm").addClass("required_inq");
  }
  else
  {
    $("#txtinq_datefrom").css("border-color", "#CCC"); //remove red border
    $("#txtinq_dateto").css("border-color", "#CCC"); //remove red border
    $("#txtnoofmonths_inq").css("border-color", "#CCC"); //remove red border
    $("#txtnoofdays_inq").css("border-color", "#CCC"); //remove red border
    $("#txtinq_monthlyrate2").css("border-color", "#CCC"); //remove red border
    $("#txtinq_advancepayment2").css("border-color", "#CCC"); //remove red border
    $("#txtinq_depositpayment2").css("border-color", "#CCC"); //remove red border
    $("#txtinq_sqm_width").css("border-color", "#CCC"); //remove red border
    $("#txtinq_sqm_length").css("border-color", "#CCC"); //remove red border
    $("#txtinq_persqm").css("border-color", "#CCC"); //remove red border
    $("#txtinq_totalsqm").css("border-color", "#CCC"); //remove red border

    // ALL UNIT INFORMATION FIELDS
    $("#txtinq_datefrom").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_dateto").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtnoofmonths_inq").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_monthlyadvamt").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_advancepayment").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_monthlydepamt").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_depositpayment").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_monthlyrate2").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_sqm").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_persqm").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_totalsqm").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtnoofdays_inq").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_sqm_width").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_sqm_length").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_advancepayment2").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_depositpayment2").removeClass("required_inq"); //remove trap. empty naman yung unit

    $("#txtinq_datefrom").prop("disabled", true);
    $("#txtnoofmonths_inq").prop("disabled", true);
    $("#txtinq_monthlyadvamt").prop("disabled", true);
    $("#txtinq_advancepayment").prop("disabled", true);
    $("#txtinq_monthlydepamt").prop("disabled", true);
    $("#txtinq_depositpayment").prop("disabled", true);
    $("#txtinq_monthlyrate2").prop("disabled", true);

    $("#txtinq_dateto").prop("disabled", true);
    $("#txtnoofdays_inq").prop("disabled", true);
    $("#txtinq_advancepayment2").prop("disabled", true);
    $("#txtinq_depositpayment2").prop("disabled", true);
    $("#txtinq_sqm_width").prop("disabled", true);
    $("#txtinq_sqm_length").prop("disabled", true);
    $("#txtinq_persqm").prop("disabled", true);
    $("#txtinq_totalsqm").prop("disabled", true);
  }

  reqmonORday()
}

function reqmonORday()
{
    if($("#radio_set").is(":checked"))
    {
      var type = "SET";
      var unit = $("#txtinq_unitunit").val();
    }
    else if($("#radio_lca").is(":checked"))
    {
      var type = "LCA";
      var unit = $("#txtinq_lca_unitname").val();
    }

    if(unit == "")
    {
      $("#txtnoofdays_inq").removeClass("required_inq");
      $("#txtnoofmonths_inq").removeClass("required_inq");
    }
    else
    {
      if(type == "SET")
      {
        $("#txtnoofdays_inq").removeClass("required_inq");
        $("#txtnoofmonths_inq").removeClass("required_inq");
        $("#txtnoofmonths_inq").addClass("required_inq");
      }
      else
      {
        var months = parseInt($("#txtnoofmonths_inq").val()||0);
        var days = parseInt($("#txtnoofdays_inq").val()||0);
        if(months == 0 && days == 0)
        {
          $("#txtnoofdays_inq").removeClass("required_inq");
          $("#txtnoofdays_inq").addClass("required_inq");
          $("#txtnoofmonths_inq").removeClass("required_inq");
          $("#txtnoofmonths_inq").addClass("required_inq");
        }
        else
        {
          if(months > 0 && days == 0)
          {
            $("#txtnoofdays_inq").removeClass("required_inq");
            $("#txtnoofmonths_inq").addClass("required_inq");
          }
          else if(months == 0 && days > 0)
          {
            $("#txtnoofmonths_inq").removeClass("required_inq");
            $("#txtnoofdays_inq").addClass("required_inq");
          }
          else
          {
            $("#txtnoofdays_inq").addClass("required_inq");
            $("#txtnoofdays_inq").addClass("required_inq");
          }
        }
      }
    }
}

function chkunitfrst()
{
  var unit = $("#txtinq_unitunit").val();
  var datefrom = $("#txtinq_datefrom").val();
  var dateto = $("#txtinq_dateto").val();
  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }

  if(type == "SET" && unit != "")
  {
    $.ajax({
      type: 'POST',
      async: false,
      url: 'mainclass.php',
      data: 'unit=' + unit + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=chkunitfrst',
      success: function(data)
      {
        var cont = "";
        if(data != "")
        {
          $("#statinquiryyy").val("invalid");
          alert(data);
          $("#txtinq_unitunit").css("border-color", "#f2a696");
          $("#txtnoofmonths_inq").css("border-color", "#f2a696");
          $("#txtinq_datefrom").css("border-color", "#f2a696");
        }
        else
        {
          $("#statinquiryyy").val("valid");
          $("#txtinq_unitunit").css("border-color", "#CCC");
          $("#txtnoofmonths_inq").css("border-color", "#CCC");
          $("#txtinq_datefrom").css("border-color", "#CCC");
        }
      }
    })
  }

}

function chkclippeddocx(thisfile)
{
  var sel = "";
  $(".form_lease_application_req").each(function(){
    var form_id = $(this).attr("id");
    var inputfile = $(this).find(".upload_app_req");
    var empty = $(this).find("a[class='remove']");
    var thisicon = $(this).find(".icon-status-req");
    var files  = inputfile.prop("files");

    var names = $.map(files, function(val) { return val.name; });
    if(names != "")
    {
        $("#"+form_id+"_icon").removeClass("fa-remove");
        $("#"+form_id+"_icon").addClass("fa-check");
        $("#"+form_id+"_icon").css("color", "green");
        sel += names + "|";
    }
    else
    {

    }
  });

    var files2  = thisfile.prop("files");
    var aso = $.map(files2, function(val) { return val.name; });
    // alert(sel)
    var arr = sel.split("|");
    var i = 0;
    var c = 0;
    for(i=0; i<=arr.length-1; i++)
    {
      if(aso == arr[i])
      {
        c++;
      }
    }

    if(c >= 2)
    {
      alert("Sorry, but you already attached the same file.");
      thisfile.click();
    }
}

$(function(){
  datenow();
  numonly();

  $("#txtinq_mallbranch").focusout(function(){
    var mallid = $(this).val();
    if(mallid == undefined)
    {
      $(this).val("");
    }
  });

  $("#txtinq_unitclass").focusout(function(){
    if($(this).val() == "")
    {
      $("#txtinq_unitclass").val("");
      $("#txtinq_unitdepartment").val("");
      $("#txtinq_unitcategory").val("");
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_depositpayment").val("");
      $("#txtnoofdays_inq").val("");
      $("#txtinq_dateto").val("");
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_advancepayment2").val("");
      $("#txtinq_depositpayment2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#tbodypdc_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#div_amenities_inquiry").html("");
    }
  });

  $("#txtinq_unitdepartment").focusout(function(){
    if($(this).val() == "")
    {
      $("#txtinq_unitdepartment").val("");
      $("#txtinq_unitcategory").val("");
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_depositpayment").val("");
      $("#txtnoofdays_inq").val("");
      $("#txtinq_dateto").val("");
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_advancepayment2").val("");
      $("#txtinq_depositpayment2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#tbodypdc_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#div_amenities_inquiry").html("");

    }
  });

  $("#txtinq_unitcategory").focusout(function(){
    if($(this).val() == "")
    {
      $("#txtinq_unitcategory").val("");
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_depositpayment").val("");
      $("#txtnoofdays_inq").val("");
      $("#txtinq_dateto").val("");
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_advancepayment2").val("");
      $("#txtinq_depositpayment2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#tbodypdc_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#div_amenities_inquiry").html("");
    }
  });

  $("#txtinq_unitwing").focusout(function(){
    if($(this).val() == "")
    {
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_depositpayment").val("");
      $("#txtnoofdays_inq").val("");
      $("#txtinq_dateto").val("");
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_advancepayment2").val("");
      $("#txtinq_depositpayment2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#tbodypdc_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#div_amenities_inquiry").html("");
    }
  });

  $("#txtinq_unitfloor").focusout(function(){
    if($(this).val() == "")
    {
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_depositpayment").val("");
      $("#txtnoofdays_inq").val("");
      $("#txtinq_dateto").val("");
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_advancepayment2").val("");
      $("#txtinq_depositpayment2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#tbodypdc_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#div_amenities_inquiry").html("");
    }
  });

  $("#txtinq_unitunit").focusout(function(){
    if($(this).val() == "")
    {
      $("#txtinq_unitunit").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_depositpayment").val("");
      $("#txtnoofdays_inq").val("");
      $("#txtinq_dateto").val("");
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_advancepayment2").val("");
      $("#txtinq_depositpayment2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#tbodypdc_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#div_amenities_inquiry").html("");
    }
  });

  $('#radio_set').prop('checked', true);

});

function closeinquirymodal()
{
  var stat = $("#status_filled").val();
  if(stat == "1")
  {
    showmodal("confirm", "Are you sure you want to discard changes?", "executefunc(\"continue\")", null, "executefunc(\"cancel\")", null, "0");
  }
  else
  {
    $("#modal_addnewinquiry").modal("hide");
  }
}

function executefunc(stat)
{
  if(stat == "cancel")
  {
    $("#alertmodal").modal("hide");
    $("#txtinq_mallbranch").focus();
  }
  else if(stat == "continue")
  {
    $("#alertmodal").modal("hide");
    $("#modal_addnewinquiry").modal("hide");
  }
}

function clicklca()
{
      $("#txtinq_unitunit").removeClass("required_inq");
      $("#txtinq_lca_unitname").addClass("required_inq");
      $("#txtlabel_payment").text("Daily Payment");
      $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction();");
      $("#txtinq_unitclass").val("");
      $("#div_wing").css("display","block");
      $("#div_floor").css("display","block");
      $("#div_unit").css("display","block");
      $("#txtinq_unitcategory").attr("onchange", "loadinquiry_wing_lca()");
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#div_nomonths").css("display", "block");
      $("#div_nodays").css("display", "block");
      $("#txtinq_sqm").prop("disabled", true);
      $("#txtinq_persqm").prop("disabled", false);
      $("#txtinq_totalsqm").prop("disabled", true);
      loadinquiry_unit_lca();
      loadinquiry_wing_lca();
      $("#txtinq_unitdepartment").val("");
      $("#txtinq_unitcategory").val("");
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtnoofdays_inq").val("");
      $("#div_advance_set").css("display", "none");
      $("#div_deposit_set").css("display", "none");
      $("#div_advance_set_amt").css("display", "block");
      $("#div_deposit_set_amt").css("display", "block");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_depositpayment").val("");
      $("#tbodypdc_inquiry").html("");
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#div_amenities_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_depositpayment").val("");
      $("#div_unit_area_set").css("display", "none");
      $("#div_unit_area_lca").css("display", "block");
      $("#div_unit_set").css("display", "none");
      $("#div_unit_lca").css("display", "block");
      $("#txtinq_dateto").prop("disabled", false);
      $("#txtnoofdays_inq").val("0");
      $("#txtnoofmonths_inq").val("0");
      $("#txtinq_lca_unitname").prop("disabled", tru);
      $("#div_advance_set").css("display", "none");
      $("#div_deposit_set").css("display", "none");
      $("#div_advance_set_amt").css("display", "block");
      $("#div_deposit_set_amt").css("display", "block");

      $("#txtinq_datefrom").prop("disabled", true);
      $("#txtnoofmonths_inq").prop("disabled", true);
      $("#txtinq_monthlyadvamt").prop("disabled", true);
      $("#txtinq_advancepayment").prop("disabled", true);
      $("#txtinq_monthlydepamt").prop("disabled", true);
      $("#txtinq_depositpayment").prop("disabled", true);
      $("#txtinq_monthlyrate2").prop("disabled", true);

      $("#txtinq_dateto").prop("disabled", true);
      $("#txtnoofdays_inq").prop("disabled", true);
      $("#txtinq_advancepayment2").prop("disabled", true);
      $("#txtinq_depositpayment2").prop("disabled", true);
      $("#txtinq_sqm_width").prop("disabled", true);
      $("#txtinq_sqm_length").prop("disabled", true);
      $("#txtinq_persqm").prop("disabled", true);
      $("#txtinq_totalsqm").prop("disabled", true);
      $("#txtinq_sqm").prop("disabled", true);
      $("#txtinq_unitdepartment").prop("disabled", true);
      $("#txtinq_unitcategory").prop("disabled", true);
      $("#txtinq_unitwing").prop("disabled", true);
      $("#txtinq_unitfloor").prop("disabled", true);
      $("#txtinq_unitunit").prop("disabled", true);
      $("#txtinq_lca_unitname").prop("disabled", true);
    //   $("#txtinq_unitunit").removeClass("required_inq");
      $("#txtinq_lca_unitname").removeClass("required_inq");
    //   $("#txtinq_lca_unitname").addClass("required_inq");

      $("#txtinq_unitwing").removeClass("required_inq");
      $("#txtinq_unitfloor").removeClass("required_inq");
}

function clickset()
{
      $("#txtlabel_payment").text("Monthly Payment");
      $("#txtinq_unitclass").val("");
      $("#div_wing").css("display","block");
      $("#div_floor").css("display","block");
      $("#div_unit").css("display","block");
      $("#txtinq_unitcategory").attr("onchange", "loadinquiry_wing_lca()");
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#div_nomonths").css("display", "block");
      $("#div_nodays").css("display", "none");
      $("#txtinq_sqm").prop("disabled", true);
      $("#txtinq_persqm").prop("disabled", true);
      $("#txtinq_totalsqm").prop("disabled", true);
      loadinquiry_wing_set();
      loadinquiry_unit_lca();
      $("#txtinq_unitdepartment").val("");
      $("#txtinq_unitcategory").val("");
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtnoofdays_inq").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_depositpayment").val("");
      $("#tbodypdc_inquiry").html("");
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#div_amenities_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_depositpayment").val("");
      $("#div_unit_area_set").css("display", "block");
      $("#div_unit_area_lca").css("display", "none");
      $("#div_unit_set").css("display", "block");
      $("#div_unit_lca").css("display", "none");
      $("#txtinq_dateto").prop("disabled", true);
      $("#txtnoofdays_inq").val("");
      $("#txtnoofmonths_inq").val("0");
      $("#txtinq_monthlyadvamt").val("0");
      $("#txtinq_monthlydepamt").val("0");
      $("#txtinq_sqm_width").val("0");
      $("#txtinq_sqm_length").val("0");
      $("#div_advance_set").css("display", "block");
      $("#div_deposit_set").css("display", "block");
      $("#div_advance_set_amt").css("display", "none");
      $("#div_deposit_set_amt").css("display", "none");

      $("#txtinq_datefrom").prop("disabled", true);
      $("#txtnoofmonths_inq").prop("disabled", true);
      $("#txtinq_monthlyadvamt").prop("disabled", true);
      $("#txtinq_advancepayment").prop("disabled", true);
      $("#txtinq_monthlydepamt").prop("disabled", true);
      $("#txtinq_depositpayment").prop("disabled", true);
      $("#txtinq_monthlyrate2").prop("disabled", true);

      $("#txtinq_dateto").prop("disabled", true);
      $("#txtnoofdays_inq").prop("disabled", true);
      $("#txtinq_advancepayment2").prop("disabled", true);
      $("#txtinq_depositpayment2").prop("disabled", true);
      $("#txtinq_sqm_width").prop("disabled", true);
      $("#txtinq_sqm_length").prop("disabled", true);
      $("#txtinq_persqm").prop("disabled", true);
      $("#txtinq_totalsqm").prop("disabled", true);
      $("#txtinq_sqm").prop("disabled", true);
      $("#txtinq_unitdepartment").prop("disabled", true);
      $("#txtinq_unitcategory").prop("disabled", true);
      $("#txtinq_unitwing").prop("disabled", true);
      $("#txtinq_unitfloor").prop("disabled", true);
      $("#txtinq_unitunit").prop("disabled", true);
      $("#txtinq_lca_unitname").prop("disabled", true);
    //   $("#txtinq_unitunit").removeClass("required_inq");
      $("#txtinq_lca_unitname").removeClass("required_inq");
      $("#txtinq_unitunit").addClass("required_inq");

      $("#txtinq_unitwing").removeClass("required_inq");
      $("#txtinq_unitfloor").removeClass("required_inq");
      $("#txtinq_unitwing").addClass("required_inq");
      $("#txtinq_unitfloor").addClass("required_inq");
}

function changeclassification()
{
  $("#txtinq_unitwing").html("<option value=''>-- Select Wing --</option>");
  $("#txtinq_unitfloor").html("<option value=''>-- Select Floor --</option>");
  $("#txtinq_unitunit").html("<option value=''>-- Select Unit --</option>");
  $("#txtinq_unitcategory").html("<option value=''>-- Select Category --</option>");
  loadinquiry_department();
  $("#txtinq_unitdepartment").val("");
  $("#txtinq_unitcategory").val("");
  $("#txtinq_unitwing").val("");
  $("#txtinq_unitfloor").val("");
  $("#txtinq_unitunit").val("");
  $("#txtnoofmonths_inq").val("");
  $("#txtnoofdays_inq").val("");
  $("#tbodypdc_inquiry").html("");
  $("#txtinq_monthlyrate2").val("");
  $("#txtinq_sqm").val("");
  $("#txtinq_persqm").val("");
  $("#txtinq_totalsqm").val("");
  $("#div_amenities_inquiry").html("");
  $("#lbltotalamountofpayment").text("Php 0.00");
  $("#txtinq_monthlyadvamt").val("");
  $("#txtinq_monthlyadvamt").val("");
  $("#txtinq_monthlydepamt").val("");
  $("#txtinq_advancepayment").val("");
  $("#txtinq_depositpayment").val("");

  $("#txtinq_datefrom").prop("disabled", true);
  $("#txtnoofmonths_inq").prop("disabled", true);
  $("#txtinq_monthlyadvamt").prop("disabled", true);
  $("#txtinq_advancepayment").prop("disabled", true);
  $("#txtinq_monthlydepamt").prop("disabled", true);
  $("#txtinq_depositpayment").prop("disabled", true);
  $("#txtinq_monthlyrate2").prop("disabled", true);

  $("#txtinq_dateto").prop("disabled", true);
  $("#txtnoofdays_inq").prop("disabled", true);
  $("#txtinq_advancepayment2").prop("disabled", true);
  $("#txtinq_depositpayment2").prop("disabled", true);
  $("#txtinq_sqm_width").prop("disabled", true);
  $("#txtinq_sqm_length").prop("disabled", true);
  $("#txtinq_persqm").prop("disabled", true);
  $("#txtinq_totalsqm").prop("disabled", true);
  $("#txtinq_sqm").prop("disabled", true);
  var classid = $("#txtinq_unitclass").val();
  if(classid != "")
  {
    $("#txtinq_unitdepartment").prop("disabled", false);
  }
  else
  {
    $("#txtinq_unitdepartment").prop("disabled", true);
  }
  $("#txtinq_unitcategory").prop("disabled", true);
  $("#txtinq_unitwing").prop("disabled", true);
  $("#txtinq_unitfloor").prop("disabled", true);
  $("#txtinq_unitunit").prop("disabled", true);
}

function datenow()
{
  var d = new Date();

  var month = d.getMonth()+1;
  var day = d.getDate();

  var output = (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day + '/' + d.getFullYear();
  $("#txtinq_datefrom").val(output);
  // $("#txtinq_dateto").val(output);
}

function loaddatetofunction8()
{
  var from = $("#txtinq_datefrom").val();
  var to = $("#txtinq_dateto").val();
}

function unitareachk()
{
  var wid = $("#txtinq_sqm_width").val();
  var len = $("#txtinq_sqm_length").val();
  var amount = $("#txtinq_persqm").val();
  var ttl = (parseInt(wid || 0) * parseInt(len || 0)) * parseInt(amount || 0);

  $("#txtinq_monthlyrate2").val((ttl).toFixed(2));
  $("#txtinq_totalsqm").val((ttl).toFixed(2));
  loaddatetofunction();
}

function loaddatetofunction()
{
    var months = $("#txtnoofmonths_inq").val();
    var days = $("#txtnoofdays_inq").val();
    var datefrom = $("#txtinq_datefrom").val();
    var unit_id = $("#txtinq_unitunit").val();
    if($("#radio_set").is(":checked"))
    {
      var type = "SET";
    }
    else if($("#radio_lca").is(":checked"))
    {
      var type = "LCA";
    }
    if(datefrom != "")
    {
        $.ajax({
          type: 'POST',
          url: 'mainclass.php',
          data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&type=' + type + '&form=loaddatetofunction',
          success: function(data)
          {
            var arr = data.split("|");
            $("#txtinq_dateto").val(arr[1]);
            loaddatetofunction3(arr[1]);
            // if(unit_id == undefined && months != "")
            // {
            //   alert("Specify unit first.");
            //   $("#txtinq_unitunit").focus();
            //   $("#txtnoofmonths_inq").val("");
            // }
          }
        })
    }
}

function loaddatetofunction2(dateto)
{
  var months = $("#txtnoofmonths_inq").val();
  var days = $("#txtnoofdays_inq").val();
  var datefrom = $("#txtinq_datefrom").val();
  var ttlamnt = $("#txtinq_totalsqm").val();
  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }

  var unit_id = $("#txtinq_unitunit").val();
  if(datefrom != "")
  {
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&ttlamnt=' + ttlamnt + '&form=loadtbodypdc_inquiry5',
      beforeSend : function() {
       $('#statussavingreservation').addClass('myspinner');
      },
      success: function(data)
      {
        // alert(data)
        $('#statussavingreservation').removeClass('myspinner');
        if(unit_id != undefined)
        {
             $("#tbodypdc_inquiry").html(data);
             numonly();
        }

      }
    })
  }
}

function chkduplicatedchknum()
{
     var e = 0;
     var chk = "";
     var bankname = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        chk +=  "|"+num;
        bankname +=  "|"+bnk;

      });

     var dup = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        thischk.css("border-color", "#CCC");

        var arrchk = chk.split("|");
        var arrbnk = bankname.split("|");

        var b = 0;
        for(var a = 0; a<=arrchk.length; a++)
        {

          if(arrchk[a] == num && num != "" && arrbnk[a] == bnk)
          {
            // alert(arrbnk[a] +"|"+ bnk)
            b++;
          }
        }

        if(b >= 2)
        {
          dup += num + "#" + bnk + "|";
        }
      });


  if(dup != "")
  {

    showmodal("alert", "Duplicated check number.", "focuskemseee(\""+dup+"\")", null, "", null, "0");
  }

}

function loaddatetofunction3(dateto)
{
  var months = $("#txtnoofmonths_inq").val();
  var days = $("#txtnoofdays_inq").val();
  var datefrom = $("#txtinq_datefrom").val();
  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }

  var unit_id = $("#txtinq_unitunit").val();
  var amt = $("#txtinq_totalsqm").val();
  if(datefrom != "")
  {
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&ttlamnt=' + amt + '&form=loadtbodypdc_inquiry2',
      success: function(data)
      {

        var arr = data.split("|");
        $("#lbltotalamountofpayment").text("Php " + arr[0]);
        loaddatetofunction2(dateto)
      }
    })
  }
}

function loaddatefunction4()
{
  var advance = $("#txtinq_monthlyadvamt").val();
  var deposit = $("#txtinq_monthlydepamt").val();
  var unit_id = $("#txtinq_unitunit").val();

  var noofmonths = $("#txtnoofmonths_inq").val();
  if(unit_id == undefined)
  {
    alert("Add unit first.");
    $("#txtinq_unitunit").focus();
    $("#txtinq_monthlyadvamt").val("");
    $("#txtinq_monthlydepamt").val("");
  }
  else
  {
    if(noofmonths == "" || noofmonths == "0")
    {
      alert("Specify how many months first.");
      $("#txtnoofmonths_inq").focus();
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_monthlydepamt").val("");
    }
    else
    {
      // alert(advance+"|"+deposit)
        $.ajax({
          type: 'POST',
          url: 'mainclass.php',
          data: 'unit_id=' + unit_id + '&advance=' + advance + '&deposit=' + deposit + '&form=loaddatefunction4',
          success: function(data)
          {
              var ttl = parseInt(advance || 0) + parseInt(deposit || 0);
              if(ttl > parseInt(noofmonths))
              {
                alert("You already exceeded the number of months you entered.");
                $("#txtinq_monthlyadvamt").val("");
                $("#txtinq_monthlydepamt").val("");
                $("#txtinq_advancepayment").val("");
                $("#txtinq_depositpayment").val("");
                $("#txtinq_monthlyadvamt").focus();
              }
              else
              {
                var arr = data.split("|");
                $("#txtinq_advancepayment").val(arr[0]);
                $("#txtinq_depositpayment").val(arr[1]);
                $("#txtinq_advancepayment").prop("disabled", true);
                $("#txtinq_depositpayment").prop("disabled", true);
              }
          }
        })
    }

  }
}

function chkunitfrst2()
{
  var unit = $("#txtinq_unitunit").val();
  var datefrom = $("#txtinq_datefrom").val();
  var dateto = $("#txtinq_dateto").val();
  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }
  var conttt = "";
  if(type == "SET" && unit != "")
  {
    $.ajax({
      type: 'POST',
      async: false,
      url: 'mainclass.php',
      data: 'unit=' + unit + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=chkunitfrst',
      success: function(data)
      {
        if(data != "")
        {
          $("#statinquiryyy").val("invalid");
          conttt = "invalid";
          $("#txtinq_unitunit").css("border-color", "red");
          $("#txtnoofmonths_inq").css("border-color", "red");
          $("#txtinq_datefrom").css("border-color", "red");
        }
        else
        {
          conttt = "valid";
          $("#statinquiryyy").val("valid");
          $("#txtinq_unitunit").css("border-color", "#CCC");
          $("#txtnoofmonths_inq").css("border-color", "#CCC");
          $("#txtinq_datefrom").css("border-color", "#CCC");
        }
      }
    })
  }
  else
  {
    conttt = "valid";
  }
  return conttt;
}

function selected_lca_unit()
{
  var unit_id =  $("#txtinq_lca_unitname").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unit_id=' + unit_id + '&form=selected_unit_lca',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_sqm_width").val(arr[0])
      $("#txtinq_sqm_length").val(arr[1])
      $("#txtinq_persqm").val(arr[2])
      $("#txtinq_totalsqm").val(arr[3]);
      $("#txtinq_monthlyrate2").val(arr[3]);
    }
  });

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unit_id=' + unit_id + '&form=selected_unit_amenities',
    success: function(data)
    {
      $("#div_amenities_inquiry").html(data);
        $('.amenities_chk').click(function() {
          if($('.amenities_chk').is(':checked'))
          {
            $(this).prop("checked", true);
          }
          else
          {
            $(this).prop("checked", true);
          }
        });

    }
  })
}

// saving of inquiry
function saveinquiry()
{
  var dup_count = checkpdcinput();
  var stathappened = chkunitfrst2();
  var statst = $("#statinquiryyy").val();
  var mrcntstat = chkmerchntcode();
  var termsandcon = $("#displayselected").html();
  if(stathappened == "valid")
  {
    var e = 0;
    $(".required_inq").each(function(){
      if($(this).val() == "" || $(this).val() == "0.00")
      {
        e++;
        var eto = $(this).attr("id");
        var lmn = this.value;
        alert(eto +" == "+ lmn);
        $(this).css("border-color","#f2a696");
      }
      else
        {
          $(this).css("border-color","#D5D5D5");
        }
    });

    var y = 0;
    var z = 0;
    $(".form_lease_application_req .upload_app_req").each(function(){
        z++;
        if($(this).get(0).files.length === 0)
        {
          // alert("no file selected")
        }
        else
        {
          y++;
        }
    });

    if(dup_count == "")
    {

        if(e == 0 && z == y && mrcntstat == "not_existing" && termsandcon != "")
        {
          var mallname = $("#txtinq_mallbranch option:selected").text();
          var mallid = $("#txtinq_mallbranch").val();

          var tradename = encodeURIComponent($("#txtinq_tradename").val());
          var tradeid = $("#txtinq_tradename").attr("value");
          var companyname = encodeURIComponent($("#txtinq_companyname").val());
          var companyid = $("#txtinq_companyname").attr("value");
          var industryname = $("#txtinq_industryname").val();
          var address = $("#txtinq_address").val();
          var remarks = $("#txtinq_remarks").val();

          var unit_id = $("#txtinq_unitunit").val();
          var dep_id = $("#txtinq_unitdepartment").val();
          var cat_id = $("#txtinq_unitcategory").val();

          var datefrom = $("#txtinq_datefrom").val();
          var dateto = $("#txtinq_dateto").val();

          var monthlyadvamt2 = $("#txtinq_monthlyadvamt").val();
          var monthlydepamt2 = $("#txtinq_monthlydepamt").val();
          var advancepayment2 = $("#txtinq_advancepayment").val();
          var depositpayment2 = $("#txtinq_depositpayment").val();
          var advancepayment3 = $("#txtinq_advancepayment2").val();
          var depositpayment3 = $("#txtinq_depositpayment2").val();
          var monthnum = $("#txtnoofmonths_inq").val();
          var daynum = $("#txtnoofdays_inq").val();
          if($("#radio_set").is(":checked"))
          {
            var unittype = "SET";
            var monthlyadvamt = monthlyadvamt2;
            var monthlydepamt = monthlydepamt2;

            // var advancepayment = advancepayment2.replace(",", "");
            var cnt = advancepayment2.split(",");
            for(var i = 0; i<=cnt.length; i++)
            {
              advancepayment2 = advancepayment2.replace(",", "");
            }
            var advancepayment = advancepayment2;
            // var depositpayment = depositpayment2.replace(",", "");
            var cnt = depositpayment2.split(",");
            for(var i = 0; i<=cnt.length; i++)
            {
              depositpayment2 = depositpayment2.replace(",", "");
            }
            var depositpayment = depositpayment2;
          }
          else if($("#radio_lca").is(":checked"))
          {
            var unittype = "LCA";
            var monthlyadvamt = "";
            var monthlydepamt = "";

            // var advancepayment = advancepayment3.replace(",", "");
            var cnt = advancepayment3.split(",");
            for(var i = 0; i<=cnt.length; i++)
            {
              advancepayment3 = advancepayment3.replace(",", "");
            }
            var advancepayment = advancepayment3;
            // var depositpayment = depositpayment3.replace(",", "");
            var cnt = depositpayment3.split(",");
            for(var i = 0; i<=cnt.length; i++)
            {
              depositpayment3 = depositpayment3.replace(",", "");
            }
            var depositpayment = depositpayment3;
          }
          var lca_unitname = $("#txtinq_lca_unitname").val();
          var sqm_width = $("#txtinq_sqm_width").val();
          var sqm_length = $("#txtinq_sqm_length").val();
          var persqm = $("#txtinq_persqm").val();
          var totalsqm = $("#txtinq_totalsqm").val();
          var unitwing = $("#txtinq_unitwing").val();
          var unitfloor = $("#txtinq_unitfloor").val();
          var classid = $("#txtinq_unitclass").val();
          var tenanttype = $("#txttenanttype").val();
          var tenanttypepercent = $("#txttenanttypepercent").val();
          var merchantcode = $("#txtmerchantcode").val();
          var chknum = "";
          $("#tbodypdc_inquiry tr td [type='text']").each(function(){
            var value = $(this).val();
            chknum +=  "|"+value;
          });

          var bankname = "";
          $("#tbodypdc_inquiry tr td .bnk").each(function(){
            var value = $(this).val();
            bankname +=  "|"+value;
          });

          $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'mallname=' + mallname +
                  '&mallid=' + mallid +
                  '&tradeid=' + tradeid +
                  '&tradename=' + tradename +
                  '&companyname=' + companyname +
                  '&companyid=' + companyid +
                  '&industryname=' + industryname +
                  '&address=' + address +
                  '&remarks=' + remarks +
                  '&unitid=' + unit_id +
                  '&dep_id=' + dep_id +
                  '&cat_id=' + cat_id +
                  '&datefrom=' + datefrom +
                  '&dateto=' + dateto +
                  '&monthlyadvamt=' + monthlyadvamt +
                  '&monthlydepamt=' + monthlydepamt +
                  '&advancepayment=' + advancepayment +
                  '&depositpayment=' + depositpayment +
                  '&unittype=' + unittype +
                  '&lca_unitname=' + lca_unitname +
                  '&sqm_width=' + sqm_width +
                  '&sqm_length=' + sqm_length +
                  '&persqm=' + persqm +
                  '&totalsqm=' + totalsqm +
                  '&unitwing=' + unitwing +
                  '&unitfloor=' + unitfloor +
                  '&classid=' + classid +
                  '&monthnum=' + monthnum +
                  '&daynum=' + daynum +
                  '&billtype=' + tenanttype +
                  '&perc=' + tenanttypepercent +
                  '&merchcode=' + merchantcode +
                  '&chknum=' + chknum +
                  '&bankname=' + bankname +
                  '&form=savenewtenant',
            beforeSend : function() {
             $('#statussavingreservation').addClass('myspinner');
             $("#btn_savenewtenant").prop("disabled", true);
            },
            success: function(data)
            {
              $('#statussavingreservation').removeClass('myspinner');
              $("#btn_savenewtenant").prop("disabled", false);
              var arr = data.split("|");
              if(arr[0] == 1)
              {
                $("#brdrwell_req").attr("style", "border: 1px solid #CCC !important");
                showmodal("alert", "New tenant successfully added.", "existingmrcnt()", null, "", null, "1");
                sendData(arr[1], arr[2])
                $("#txtinq_unitunit").css("border-color", "#CCC");
                $("#txtnoofmonths_inq").css("border-color", "#CCC");
                $("#txtinq_datefrom").css("border-color", "#CCC");
                $(".required_inq").modal("hide");
                $(this).css("border-color","#D5D5D5");
                $("#div_amenities_inquiry").html("");
                $("#div_inquiry_contact_person").html("");
                $(".modal").modal("hide");
                tbltenantlists();
              }
            }
          });
          // alert("success")
        }
        else
        {
          showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
          $('.required_inq').each(function() {
          if ( this.value === '' ) {
              var sjdjs = $(this).attr("id");
              this.focus();
              return false;
          }
          });

          var a = 0;
          $('.div_businessinfo').each(function() {
          if ( this.value === '' ) {
              a++;
              $("#div_businessinfo").click();
              return false;
          }
          });

          if(a == 0)
          {
            $('.div_unitinfo').each(function() {
            if ( this.value === '' || this.value === '0' || this.value === '0.00') {
                $("#div_unitinfo").click();
                return false;
            }
            });
          }

          if(e == 0 && mrcntstat == "not_existing" && z != y)
          {
            $("#div_remarks_n_req").click();
            $("#brdrwell_req").attr("style", "border: 1px solid #f2a696 !important");
          }

          if(e == 0 && mrcntstat == "existing")
          {
             $("#div_unitinfo").click();
             showmodal("alert", "The merchant code you entered is already existing.", "existingmrcnt()", null, "", null, "1");
          }

          if(e == 0 && z == y && mrcntstat == "not_existing" && termsandcon == "")
          {
            $("#div_termsandcon").click();
             showmodal("alert", "Add Terms and Conditions first.", "existingmrcnt()", null, "", null, "1");
          }
        }
    }
    else
    {
      checkpdcinput2();
      var arr = dup_count.split("|");
        $('#tbodypdc_inquiry tr td [type="text"]').each(function(){
          for(var i=0; i<=arr.length-2; i++)
          {
            var thisval = $(this).val();
            if(thisval == arr[i])
            {
              $(this).attr("style", "border: 1px solid #f2a696 !important");
            }
          }
        })

         $('#tbodypdc_inquiry tr td [type="text"]').each(function(){
          for(var i=0; i<=arr.length-2; i++)
          {
            var thisval = $(this).val();
            if(thisval == arr[i])
            {
              $(this).focus();
              return false;
            }
          }
        })
    }

  }
  else
  {
    chkunitfrst();
    $("#div_unitinfo").click();
  }
}

function existingmrcnt()
{
  $("#alertmodal").modal("hide");
  $("#txtmerchantcode").css("border-color", "#f2a696");
  $("#txtmerchantcode").focus();
}

function chkmerchntcode()
{
    var code = $("#txtmerchantcode").val()
    $.ajax({
      type: 'POST',
      async: false,
      url: 'mainclass.php',
      data: 'code=' + code + '&form=chkmerchntcode2',
      success: function(data)
      {
          conttt = data;
      }
    })
    return conttt;
}

// uploading of documents
function sendData(inq, app){
  var t = 0;
  var u = 0;
  $(".form_lease_application_req").each(function(){
    var this_id = $(this).attr("id");
    var txtaapid = $(this).find(".txtaapid");
    var txtaapid2 = txtaapid.attr("id");
    var txtinqqid = $(this).find(".txtinqqid");
    var txtinqqid2 = txtinqqid.attr("id");
    t++;
    $("#"+txtaapid2).val(app);
    $("#"+txtinqqid2).val(inq);
    var data = new FormData($('#'+this_id)[0]);
    $.ajax({
      type:"POST",
      url:"inquiry/uploadappreq.php",
      data: data,
      mimeType: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
      }
    });
  })
}

// check if mall is entered correctlr before proceeding on adding a tenant
function loadtradefunction()
{
  var mallid = $("#txtinq_mallbranch").val();

  if(mallid == undefined)
  {
    alert("Select Mall First");
    $("#txtinq_mallbranch").focus();
    $("#txtinq_mallbranch").css("border-color","#f2a696");
  }
  else
  {
    modal_loadtradename();
    $("#txtinq_mallbranch").css("border-color","rgb(213, 213, 213)");
  }
}

// function for checking of duplicate check number
function checkpdcinput()
{
     var e = 0;
     var chk = "";
     var bankname = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        chk +=  "|"+num;
        bankname +=  "|"+bnk;

      });

     var dup = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        thischk.css("border-color", "#CCC");

        var arrchk = chk.split("|");
        var arrbnk = bankname.split("|");

        var b = 0;
        for(var a = 0; a<=arrchk.length; a++)
        {

          if(arrchk[a] == num && num != "" && arrbnk[a] == bnk)
          {
            // alert(arrbnk[a] +"|"+ bnk)
            b++;
          }
        }

        if(b >= 2)
        {
          dup += num + "#" + bnk + "|";
        }
      });
  return dup;
}

function checkpdcinput2()
{

     var e = 0;
     var chk = "";
     var bankname = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        chk +=  "|"+num;
        bankname +=  "|"+bnk;

      });

     var dup = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        thischk.css("border-color", "#CCC");

        var arrchk = chk.split("|");
        var arrbnk = bankname.split("|");

        var b = 0;
        for(var a = 0; a<=arrchk.length; a++)
        {

          if(arrchk[a] == num && num != "" && arrbnk[a] == bnk)
          {
            // alert(arrbnk[a] +"|"+ bnk)
            b++;
          }
        }

        if(b >= 2)
        {
          dup += num + "#" + bnk + "|";
        }
      });


  if(dup != "")
  {
    showmodal("alert", "Duplicated check number.", "focuskemseee(\""+dup+"\")", null, "", null, "0");
  }

}

function focuskemseee(dup)
{
  var arr = dup.split("|");
  for(i=0; i<=arr.length-2; i++)
  {
    var arr2 = arr[i].split("#");
    if(i == 1)
    {
      $("#tbodypdc_inquiry tr").each(function(){
        var num = $(this).find("td [type='text']").val();
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var bnk = $(this).find("td .bnk").val();

        if(num == arr2[0] && bnk == arr2[1])
        {
          thischk.css("border-color", "#f2a696");
          thischk.focus();
          return false;
        }
      })
    }
    else
    {
      $("#tbodypdc_inquiry tr").each(function(){
        var num = $(this).find("td [type='text']").val();
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var bnk = $(this).find("td .bnk").val();

        if(num == arr2[0] && bnk == arr2[1])
        {
          thischk.css("border-color", "#f2a696");
        }
      })
    }
  }

  $("#alertmodal").modal("hide");
}

// viewing of inquiry
function viewinquiry(TradeID, Company_ID, Inquiry_ID, UnitID, action)
{
  $("#txtremakrstext").text("Requirements and Remarks");
  $(".text_inquiry").prop("disabled", true);
  $("#txtinq_datefrom").prop("disabled", true);
  $("#radio_set").prop("disabled", true);
  $("#radio_lca").prop("disabled", true);
  $("#txtinq_mallbranch").focus();
  $("#div_businessinfo").click();
  $("#txtnoofmonths_inq").val("");
  $("#txtnoofdays_inq").val("");
  $("#statinquiryyy").val("valid");
  $("#txtinq_unitunit").css("border-color", "#CCC");
  $("#txtnoofmonths_inq").css("border-color", "#CCC");
  $("#txtinq_datefrom").css("border-color", "#CCC");
  if(action == "view")
  {
    $("#div_view_inquiry_modal :input").attr("disabled", true);
    $("#btn_savenewtenant").attr("disabled", true);
  }
  else
  {
    $("#div_view_inquiry_modal :input").attr("disabled", false);
    $("#btn_savenewtenant").attr("disabled", false);
  }
  changeclassification();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'TradeID=' + TradeID + '&Company_ID=' + Company_ID + '&Inquiry_ID=' + Inquiry_ID + '&form=viewinquiry',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_mallbranch").val(arr[1]);
      if(arr[1] != "")
      {
        $("#txtinq_unitclass").prop("disabled", false);
      }
      else
      {
        $("#txtinq_unitclass").prop("disabled", true);
      }
      $("#txtinq_remarks").val(arr[2]);
      $("#txtinq_mallbranch").prop("disabled", true);
      $("#txtinq_tradename").prop("disabled", true);
      $("#btn_savenewtenant").prop("disabled", false);
      selecttenant(Company_ID, TradeID);
      $("#div_modal_inquiry_remarks").prop("class", "col-md-6 col-xs-12");
      $("#div_modal_inquiry_requirements").css("display", "block");
      $("#div_modal_title_inquiry").text("Leasing Application");

      $("#txtnoofmonths_inq").val(arr[28]);
      $("#txtnoofdays_inq").val(arr[29]);
      $("#txtinq_datefrom").val(arr[11]);
      $("#txtinq_dateto").val(arr[12]);

      $("#txtinq_monthlyadvamt").val(arr[18]);
      $("#txtinq_monthlydepamt").val(arr[17]);
      $("#txtinq_advancepayment").val(arr[16]);
      $("#txtinq_depositpayment").val(arr[15]);
      $("#txtinq_advancepayment2").val(arr[16]);
      $("#txtinq_depositpayment2").val(arr[15]);
      $("#txtinq_unitclass").val(arr[26]);

      $("#txtinq_createdby").text(arr[32]);
      $("#txtinq_datecreated").text(arr[35]);
      $("#txtinq_modifby").text(arr[34]);
      $("#txtinq_modifdate").text(arr[38]);

      if(arr[23] != "")
      {
        loadrequirements_passed(arr[23], Inquiry_ID, 'with');
      }
      else
      {
        loadrequirements_passed(arr[23], Inquiry_ID, 'without');
      }

      uploadrequirementscss();
      $("#modal_addnewinquiry").modal("show");
      $("#status_filled").val("0");

      if(arr[27] == "SET")
      {
        $("#txtlabel_payment").text("Monthly Payment");
        selectunit2(Company_ID, TradeID, UnitID, Inquiry_ID, action);
        $("#div_unit_set").css("display", "block");
        $("#div_unit_lca").css("display", "none");
      }
      else if(arr[27] == "LCA")
      {
        $("#txtlabel_payment").text("Daily Payment");
        selectunit3(Company_ID, TradeID, UnitID, Inquiry_ID, action);
        $("#div_unit_set").css("display", "none");
        $("#div_unit_lca").css("display", "block");
      }

      if(action == "view")
      {
        $("#div_modal_title_inquiry").text("Inquiry");
        $(".updatedby_texts").css("display", "block");
        $(".modified_info").css("display", "none");
      }
      else if(action == "apply")
      {
        $("#div_modal_title_inquiry").text("Leasing Application");
        $(".updatedby_texts").css("display", "none");
        $(".modified_info").css("display", "none");
      }
      else
      {
        $("#div_modal_title_inquiry").text("Inquiry");
        $(".updatedby_texts").css("display", "none");
        $(".modified_info").css("display", "none");
      }
    }
  });
}
function loadrequirements_passed(Application_ID, Inquiry_ID, type)
{
  if(type == "without")
  {
    var inputt = "";
  }
  else if(type == "with")
  {
    var inputt = "disabled";
  }
    $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: '&appid=' + Application_ID + '&inqid=' + Inquiry_ID + '&inputt=' + inputt + '&form=loadrequirements_application2',
    success: function(data)
    {
      $("#div_req_passed").html(data);
      uploadrequirementscss();
    }
  });
}

function selectunit2(Company_ID, TradeID, UnitID, Inquiry_ID, action)
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'Company_ID=' +Company_ID+ '&TradeID=' +TradeID+ '&UnitID=' +UnitID+ '&Inquiry_ID='+Inquiry_ID+ '&form=selectunit',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_sqm").val(arr[2]);
      $("#txtinq_persqm").val(arr[3]);
      $("#txtinq_totalsqm").val(arr[4]);
      $("#txtinq_datefrom").val(arr[11]);
      $("#txtinq_dateto").val(arr[12]);
      $("#txtinq_monthlyrate2").val(arr[4]);

      $("#btn_savenewtenant").attr("onclick", "saveleasingapplication(\""+Inquiry_ID+"\")");
      $("#radio_set").prop("checked", true);
      $("#radio_lca").prop("checked", false);
      $("#div_nomonths").css("display", "block");
      $("#div_nodays").css("display", "none");

      $("#div_advance_set").css("display", "block");
      $("#div_deposit_set").css("display", "block");
      $("#div_advance_set_amt").css("display", "none");
      $("#div_deposit_set_amt").css("display", "none");

      // ALL UNIT INFORMATION FIELDS
      $("#txtinq_datefrom").removeClass("required_inq");
      $("#txtinq_dateto").removeClass("required_inq");
      $("#txtnoofmonths_inq").removeClass("required_inq");
      $("#txtinq_monthlyadvamt").removeClass("required_inq");
      $("#txtinq_advancepayment").removeClass("required_inq");
      $("#txtinq_monthlydepamt").removeClass("required_inq");
      $("#txtinq_depositpayment").removeClass("required_inq");
      $("#txtinq_monthlyrate2").removeClass("required_inq");
      $("#txtinq_sqm").removeClass("required_inq");
      $("#txtinq_persqm").removeClass("required_inq");
      $("#txtinq_totalsqm").removeClass("required_inq");
      $("#txtnoofdays_inq").removeClass("required_inq");
      $("#txtinq_sqm_width").removeClass("required_inq");
      $("#txtinq_sqm_length").removeClass("required_inq");
      $("#txtinq_advancepayment2").removeClass("required_inq");
      $("#txtinq_depositpayment2").removeClass("required_inq");

      if(arr[0] != "") //require set unit information if SET UNIT is NOT empty
      {
        $("#txtinq_datefrom").addClass("required_inq");
        $("#txtinq_dateto").addClass("required_inq");
        $("#txtnoofmonths_inq").addClass("required_inq");
        $("#txtinq_monthlyadvamt").addClass("required_inq");
        $("#txtinq_advancepayment").addClass("required_inq");
        $("#txtinq_monthlydepamt").addClass("required_inq");
        $("#txtinq_depositpayment").addClass("required_inq");
        $("#txtinq_monthlyrate2").addClass("required_inq");
        $("#txtinq_sqm").addClass("required_inq");
        $("#txtinq_persqm").addClass("required_inq");
        $("#txtinq_totalsqm").addClass("required_inq");
      }

      $("#txtinq_advancepayment2").val("");
      $("#txtinq_depositpayment2").val("");
      $("#div_unit_area_set").css("display", "block");
      $("#div_unit_area_lca").css("display", "none");
      if(arr[13] != "") //enable wing if merchandise category is not empty
      {
        $("#txtinq_unitwing").prop("disabled", false);
      }
      else
      {
        $("#txtinq_unitwing").prop("disabled", true);
      }
      if(arr[8] != "") //enable floor if wing is not empty
      {
        $("#txtinq_unitfloor").prop("disabled", false);
      }
      else
      {
        $("#txtinq_unitfloor").prop("disabled", true);
      }
      if(arr[7] != "") //enable unit if floor is not empty
      {
        $("#txtinq_unitunit").prop("disabled", false);
      }
      else
      {
        $("#txtinq_unitunit").prop("disabled", true);
      }

      loadinquiry_department2(arr[14]);
      loadinquiry_category2(arr[13], arr[14]);
      loadinquiry_wing2(arr[8]);
      loadinquiry_flr2(arr[7], action);
      loadinquiry_unit2(arr[0]);
      loaddatetofunction();
    }
  })
}

function selectunit3(Company_ID, TradeID, UnitID, Inquiry_ID, action)
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'Company_ID=' +Company_ID+ '&TradeID=' +TradeID+ '&UnitID=' +UnitID+ '&Inquiry_ID='+Inquiry_ID+ '&form=selectunit2',
    success: function(data)
    {
        var arr = data.split("|");

        $("#btn_savenewtenant").attr("onclick", "saveleasingapplication(\""+Inquiry_ID+"\")");

          $("#radio_set").prop("checked", false);
          $("#radio_lca").prop("checked", true);
          $("#div_nomonths").css("display", "block");
          $("#div_nodays").css("display", "block");

          $("#div_advance_set").css("display", "none");
          $("#div_deposit_set").css("display", "none");
          $("#div_advance_set_amt").css("display", "block");
          $("#div_deposit_set_amt").css("display", "block");
          $("#txtinq_advancepayment").val("");
          $("#txtinq_depositpayment").val("");
          $("#div_unit_area_set").css("display", "none");
          $("#div_unit_area_lca").css("display", "block");

          // ALL UNIT INFORMATION FIELDS
          $("#txtinq_datefrom").removeClass("required_inq");
          $("#txtinq_dateto").removeClass("required_inq");
          $("#txtnoofmonths_inq").removeClass("required_inq");
          $("#txtinq_monthlyadvamt").removeClass("required_inq");
          $("#txtinq_advancepayment").removeClass("required_inq");
          $("#txtinq_monthlydepamt").removeClass("required_inq");
          $("#txtinq_depositpayment").removeClass("required_inq");
          $("#txtinq_monthlyrate2").removeClass("required_inq");
          $("#txtinq_sqm").removeClass("required_inq");
          $("#txtinq_persqm").removeClass("required_inq");
          $("#txtinq_totalsqm").removeClass("required_inq");
          $("#txtnoofdays_inq").removeClass("required_inq");
          $("#txtinq_sqm_width").removeClass("required_inq");
          $("#txtinq_sqm_length").removeClass("required_inq");
          $("#txtinq_advancepayment2").removeClass("required_inq");
          $("#txtinq_depositpayment2").removeClass("required_inq");

          if(arr[0] != "") //require lca unit information if LCA UNIT is NOT empty
          {
            $("#txtinq_datefrom").addClass("required_inq");
            $("#txtinq_dateto").addClass("required_inq");
            $("#txtnoofmonths_inq").addClass("required_inq");
            $("#txtnoofdays_inq").addClass("required_inq");
            $("#txtinq_monthlyrate2").addClass("required_inq");
            $("#txtinq_advancepayment2").addClass("required_inq");
            $("#txtinq_depositpayment2").addClass("required_inq");
            $("#txtinq_sqm_width").addClass("required_inq");
            $("#txtinq_sqm_length").addClass("required_inq");
            $("#txtinq_persqm").addClass("required_inq");
            $("#txtinq_totalsqm").addClass("required_inq");
          }

          $("#txtinq_lca_unitname").val(arr[0]);
          $("#txtinq_datefrom").val();
          $("#txtinq_advancepayment2").val(arr[11]);
          $("#txtinq_depositpayment2").val(arr[10]);
          $("#txtinq_sqm_width").val(arr[1]);
          $("#txtinq_sqm_length").val(arr[2]);
          $("#txtinq_persqm").val(arr[3]);
          $("#txtinq_totalsqm").val(arr[4]);
          $("#txtinq_monthlyrate2").val(arr[4]);
          if(arr[9] != "") //enable wing if merchandise category is not empty
          {
            $("#txtinq_unitwing").prop("disabled", false);
          }
          else
          {
            $("#txtinq_unitwing").prop("disabled", true);
          }
          if(arr[6] != "") //enable floor if wing is not empty
          {
            $("#txtinq_unitfloor").prop("disabled", false);
          }
          else
          {
            $("#txtinq_unitfloor").prop("disabled", true);
          }
          if(arr[5] != "") //enable unit if floor is not empty
          {
            $("#txtinq_lca_unitname").prop("disabled", false);
          }
          else
          {
            $("#txtinq_lca_unitname").prop("disabled", true);
          }
          loadinquiry_department2(arr[8]);
          loadinquiry_category2(arr[9], arr[8]);
          loadinquiry_wing2(arr[6]);
          loadinquiry_flr2(arr[5], action);
          loaddatetofunction();
    }
  })
}

function loadinquiry_category2(selected, depid)
{
  var department_id = depid;
  if(department_id != "")
  {
    $("#txtinq_unitcategory").prop("disabled", false);
  }
  else
  {
    $("#txtinq_unitcategory").prop("disabled", true);
  }

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'department_id=' + department_id + '&form=loadinquiry_category2',
    success: function(data)
    {
      $("#txtinq_unitcategory").html(data)
      $("#txtinq_unitcategory").val(selected);
    }
  })
}

function loadinquiry_wing2(selected)
{
  var classification_id = $("#txtinq_unitclass").val();


  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }

  // var category_id = $("#txtinq_unitcategory").val();
  // if(category_id != "")
  // {
  //   $("#txtinq_unitwing").prop("disabled", false);
  // }
  // else
  // {
  //   $("#txtinq_unitwing").prop("disabled", true);
  // }

  var mallid = $("#txtinq_mallbranch").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id='+classification_id +'&mallid='+mallid+'&type='+type+'&form=loadinquiry_wing2',
    success: function(data)
    {
      $("#txtinq_unitwing").html(data);
      $("#txtinq_unitwing").val(selected);

    }
  })
}

function loadinquiry_flr2(selected, action)
{
  var classification_id = $("#txtinq_unitclass").val();
  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }
  var mallid = $("#txtinq_mallbranch").val();
  var wingid = $("#txtinq_unitwing").val();


  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id='+classification_id +'&mallid='+mallid+'&type='+type+'&form=loadinquiry_flr2',
    success: function(data)
    {
      $("#txtinq_unitfloor").html(data);
      $("#txtinq_unitfloor").val(selected);

      if(action != "view")
      {
        if(selected != "")
        {
          $("#txtinq_datefrom").prop("disabled", false);
          $("#txtnoofmonths_inq").prop("disabled", false);
          $("#txtinq_monthlyadvamt").prop("disabled", false);
          $("#txtinq_advancepayment").prop("disabled", false);
          $("#txtinq_monthlydepamt").prop("disabled", false);
          $("#txtinq_depositpayment").prop("disabled", false);
          $("#txtinq_monthlyrate2").prop("disabled", false);

          $("#txtinq_dateto").prop("disabled", true);
          $("#txtnoofdays_inq").prop("disabled", false);
          $("#txtinq_advancepayment2").prop("disabled", false);
          $("#txtinq_depositpayment2").prop("disabled", false);
          $("#txtinq_sqm_width").prop("disabled", false);
          $("#txtinq_sqm_length").prop("disabled", false);
          $("#txtinq_totalsqm").prop("disabled", true);
          $("#txtinq_sqm").prop("disabled", true);

          if($("#radio_set").is(":checked"))
          {
            $("#txtinq_persqm").prop("disabled", true);
          }
          else if($("#radio_lca").is(":checked"))
          {
            $("#txtinq_persqm").prop("disabled", false);
          }
        }
        else
        {
          $("#txtinq_datefrom").prop("disabled", true);
          $("#txtnoofmonths_inq").prop("disabled", true);
          $("#txtinq_monthlyadvamt").prop("disabled", true);
          $("#txtinq_advancepayment").prop("disabled", true);
          $("#txtinq_monthlydepamt").prop("disabled", true);
          $("#txtinq_depositpayment").prop("disabled", true);
          $("#txtinq_monthlyrate2").prop("disabled", true);

          $("#txtinq_dateto").prop("disabled", true);
          $("#txtnoofdays_inq").prop("disabled", true);
          $("#txtinq_advancepayment2").prop("disabled", true);
          $("#txtinq_depositpayment2").prop("disabled", true);
          $("#txtinq_sqm_width").prop("disabled", true);
          $("#txtinq_sqm_length").prop("disabled", true);
          $("#txtinq_persqm").prop("disabled", true);
          $("#txtinq_totalsqm").prop("disabled", true);
          $("#txtinq_sqm").prop("disabled", true);
        }
      }
      else
      {
          $("#txtinq_datefrom").prop("disabled", true);
          $("#txtnoofmonths_inq").prop("disabled", true);
          $("#txtinq_monthlyadvamt").prop("disabled", true);
          $("#txtinq_advancepayment").prop("disabled", true);
          $("#txtinq_monthlydepamt").prop("disabled", true);
          $("#txtinq_depositpayment").prop("disabled", true);
          $("#txtinq_monthlyrate2").prop("disabled", true);

          $("#txtinq_dateto").prop("disabled", true);
          $("#txtnoofdays_inq").prop("disabled", true);
          $("#txtinq_advancepayment2").prop("disabled", true);
          $("#txtinq_depositpayment2").prop("disabled", true);
          $("#txtinq_sqm_width").prop("disabled", true);
          $("#txtinq_sqm_length").prop("disabled", true);
          $("#txtinq_persqm").prop("disabled", true);
          $("#txtinq_totalsqm").prop("disabled", true);
          $("#txtinq_sqm").prop("disabled", true);
          $("#txtinq_unitdepartment").prop("disabled", true);
          $("#txtinq_unitcategory").prop("disabled", true);
          $("#txtinq_unitwing").prop("disabled", true);
          $("#txtinq_unitfloor").prop("disabled", true);
          $("#txtinq_unitunit").prop("disabled", true);
      }
    }
  })
}

function loadinquiry_unit2(selected)
{
  var classification_id = $("#txtinq_unitclass").val();
  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }
  var mallid = $("#txtinq_mallbranch").val();

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id='+classification_id +'&mallid='+mallid+'&type='+type+'&form=loadinquiry_unit2',
    success: function(data)
    {
      $("#txtinq_unitunit").html(data);
      $("#txtinq_unitunit").val(selected);
    }
  });

    $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unit_id=' + selected + '&form=selected_unit_amenities',
    success: function(data)
    {
      $("#div_amenities_inquiry").html(data);
    }
  })
}

function loadinquiry_department()
{
  var classification_id = $("#txtinq_unitclass").val();
  if(classification_id != "")
  {
    $("#txtinq_unitdepartment").prop("disabled", false);
  }
  else
  {
    $("#txtinq_unitdepartment").prop("disabled", true);
  }

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&form=loadinquiry_department',
    success: function(data)
    {
      $("#txtinq_unitdepartment").html(data)
    }
  })
}

function loadinquiry_department2(selected)
{
  var classification_id = $("#txtinq_unitclass").val();
  if(classification_id != "")
  {
    $("#txtinq_unitdepartment").prop("disabled", false);
  }
  else
  {
    $("#txtinq_unitdepartment").prop("disabled", true);
  }

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&form=loadinquiry_department2',
    success: function(data)
    {
        $("#txtinq_unitdepartment").html(data);
        $("#txtinq_unitdepartment").val(selected);
    }
  })
}

function loadinquiry_category()
{
  var department_id = $("#txtinq_unitdepartment").val();
  if(department_id != "")
  {
    $("#txtinq_unitcategory").prop("disabled", false);
    $("#txtinq_unitwing").prop("disabled", true);
    $("#txtinq_unitfloor").prop("disabled", true);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_unitwing").val("");
    $("#txtinq_unitfloor").val("");
    $("#txtinq_unitunit").val("");
    // checking unit type to require unit information
    if($("#radio_set").is(":checked"))
    {
      selected_unit()
    }
    else if($("#radio_lca").is(":checked"))
    {
      txtchklcaunitval()
    }
  }
  else
  {
    $("#txtinq_unitcategory").prop("disabled", true);
    $("#txtinq_unitwing").prop("disabled", true);
    $("#txtinq_unitfloor").prop("disabled", true);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_unitwing").val("");
    $("#txtinq_unitfloor").val("");
    $("#txtinq_unitunit").val("");
    // checking unit type to require unit information
    if($("#radio_set").is(":checked"))
    {
      selected_unit()
    }
    else if($("#radio_lca").is(":checked"))
    {
      txtchklcaunitval()
    }
  }
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'department_id=' + department_id + '&form=loadinquiry_category',
    success: function(data)
    {
      $("#txtinq_unitcategory").html(data)
    }
  })
}

function loadinquiry_wing_set()
{
  var classification_id = $("#txtinq_unitclass").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&form=loadwingflr2',
    success: function(data)
    {
      $("#txtinq_unitwing").html(data);
      $("#txtinq_unitunit").val("");
      $("#txtinq_unitfloor").val("");
    }
  })
}

function loadinquiry_wing_lca()
{
  var classification_id = $("#txtinq_unitclass").val();

  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }
  var mallid = $("#txtinq_mallbranch").val();
  var catid = $("#txtinq_unitcategory").val();
  if(catid != "")
  {
    $("#txtinq_unitwing").prop("disabled", false);
    $("#txtinq_unitfloor").prop("disabled", true);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_unitwing").val("");
    $("#txtinq_unitfloor").val("");
    $("#txtinq_unitunit").val("");
  }
  else
  {
    $("#txtinq_unitwing").prop("disabled", true);
    $("#txtinq_unitfloor").prop("disabled", true);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_unitwing").val("");
    $("#txtinq_unitfloor").val("");
    $("#txtinq_unitunit").val("");
  }

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&type=' + type + '&mallid=' + mallid + '&form=loadinquiry_wing_lca',
    success: function(data)
    {
      $("#txtinq_unitwing").html(data);
      $("#txtinq_unitunit").val("");
      $("#txtinq_unitfloor").val("");

      // checking unit type to require unit information
      if($("#radio_set").is(":checked"))
      {
        selected_unit()
      }
      else if($("#radio_lca").is(":checked"))
      {
        txtchklcaunitval()
      }

      reqmonORday()
    }
  })
}

function loadinquiry_flr()
{
  var wing_id = $("#txtinq_unitwing").val();
  var classification_id = $("#txtinq_unitclass").val();
  var mallid = $("#txtinq_mallbranch").val();
  if(wing_id != "")
  {
    $("#txtinq_unitfloor").prop("disabled", false);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_lca_unitname").prop("disabled", true);
    $("#txtinq_unitfloor").val("");
    $("#txtinq_lca_unitname").val("");
    $("#txtinq_unitunit").val("");
  }
  else
  {
    $("#txtinq_unitfloor").prop("disabled", true);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_lca_unitname").prop("disabled", true);
    $("#txtinq_unitfloor").val("");
    $("#txtinq_lca_unitname").val("");
    $("#txtinq_unitunit").val("");
  }
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'wing_id=' + wing_id + '&classification_id='+classification_id+'&mallid='+mallid+'&form=loadinquiry_flr',
    success: function(data)
    {
      $("#txtinq_unitfloor").html(data);
      $("#txtinq_unitunit").val("");
      $("#txtinq_unitfloor").val("");
      // checking unit type to require unit information
      if($("#radio_set").is(":checked"))
      {
        selected_unit()
      }
      else if($("#radio_lca").is(":checked"))
      {
        txtchklcaunitval()
      }
    }
  })
}

function loadinquiry_unit_set()
{

  var flr_id = $("#txtinq_unitfloor").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'flr_id=' + flr_id + '&form=loadinquiry_unit_set',
    success: function(data)
    {
      $("#txtinq_unitunit").html(data)
    }
  })
}

function loadinquiry_unit_lca()
{
  var classification_id = $("#txtinq_unitclass").val();
  var catid = $("#txtinq_unitcategory").val();
  if($("#radio_set").is(":checked"))
  {
    var type = "SET"
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA"
  }

  var flr = $("#txtinq_unitfloor").val();
  if(flr != "")
  {
    $("#txtinq_unitunit").prop("disabled", false);
    $("#txtinq_lca_unitname").prop("disabled", false);
    $("#txtinq_unitunit").val("");
    $("#txtinq_lca_unitname").val("");
  }
  else
  {
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_lca_unitname").prop("disabled", true);
    $("#txtinq_unitunit").val("");
    $("#txtinq_lca_unitname").val("");
  }

  if(catid != "")
  {
    $("#txtinq_lca_unitname").prop("disabled", false);
  }
  else
  {
    $("#txtinq_lca_unitname").prop("disabled", true);
  }
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&type=' + type + '&flr=' + flr + '&form=loadinquiry_unit_lca',
    success: function(data)
    {

      if(data == 1)
      {
        if(classification_id != undefined)
        {
          showmodal("alert", "No available "+type+ " units under "+classification+" classification.", "", null, "", null, "1");
        }
      }
      else
      {
        if(type == "SET")
        {
          $("#txtinq_unitunit").html(data);
        }
        else
        {
          $("#txtinq_lca_unitname").html(data);
        }
      }

      // checking unit type to require unit information
      if($("#radio_set").is(":checked"))
      {
        selected_unit()
      }
      else if($("#radio_lca").is(":checked"))
      {
        txtchklcaunitval()
      }
    }
  })
}

function selected_unit()
{
  $("#txtnoofmonths_inq").val("");
  $("#txtinq_monthlyadvamt").val("");
  $("#txtinq_advancepayment").val("");
  $("#txtinq_monthlydepamt").val("");
  $("#txtinq_depositpayment").val("");
  $("#txtnoofdays_inq").val("");
  $("#txtinq_dateto").val("");
  $("#txtinq_advancepayment2").val("");
  $("#txtinq_depositpayment2").val("");
  $("#tbodypdc_inquiry").html("");
  $("#lbltotalamountofpayment").text("Php 0.00");
  var unit_id =  $("#txtinq_unitunit").val();

  if(unit_id != "")
  {
    $("#txtinq_datefrom").prop("disabled", false);
    $("#txtnoofmonths_inq").prop("disabled", false);
    $("#txtinq_monthlyadvamt").prop("disabled", false);
    $("#txtinq_advancepayment").prop("disabled", false);
    $("#txtinq_monthlydepamt").prop("disabled", false);
    $("#txtinq_depositpayment").prop("disabled", false);
    $("#txtinq_monthlyrate2").prop("disabled", false);
    $("#txtinq_persqm").prop("disabled", true);

    //require set unit information if SET UNIT is NOT empty
    $("#txtinq_datefrom").addClass("required_inq");
    $("#txtinq_dateto").addClass("required_inq");
    $("#txtnoofmonths_inq").addClass("required_inq");
    $("#txtinq_monthlyadvamt").addClass("required_inq");
    $("#txtinq_advancepayment").addClass("required_inq");
    $("#txtinq_monthlydepamt").addClass("required_inq");
    $("#txtinq_depositpayment").addClass("required_inq");
    $("#txtinq_monthlyrate2").addClass("required_inq");
    $("#txtinq_sqm").addClass("required_inq");
    $("#txtinq_persqm").addClass("required_inq");
    $("#txtinq_totalsqm").addClass("required_inq");

  }
  else
  {

    $("#txtinq_datefrom").css("border-color", "#CCC");  //remove red border
    $("#txtinq_dateto").css("border-color", "#CCC");  //remove red border
    $("#txtnoofmonths_inq").css("border-color", "#CCC");  //remove red border
    $("#txtinq_monthlyadvamt").css("border-color", "#CCC");  //remove red border
    $("#txtinq_advancepayment").css("border-color", "#CCC");  //remove red border
    $("#txtinq_monthlydepamt").css("border-color", "#CCC");  //remove red border
    $("#txtinq_depositpayment").css("border-color", "#CCC");  //remove red border
    $("#txtinq_monthlyrate2").css("border-color", "#CCC");  //remove red border
    $("#txtinq_sqm").css("border-color", "#CCC");  //remove red border
    $("#txtinq_persqm").css("border-color", "#CCC");  //remove red border
    $("#txtinq_totalsqm").css("border-color", "#CCC"); //remove red border


    // ALL UNIT INFORMATION FIELDS
    $("#txtinq_datefrom").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_dateto").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtnoofmonths_inq").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_monthlyadvamt").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_advancepayment").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_monthlydepamt").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_depositpayment").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_monthlyrate2").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_sqm").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_persqm").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_totalsqm").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtnoofdays_inq").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_sqm_width").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_sqm_length").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_advancepayment2").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_depositpayment2").removeClass("required_inq"); //remove required. empty naman yung unit

    $("#txtinq_datefrom").prop("disabled", true);
    $("#txtnoofmonths_inq").prop("disabled", true);
    $("#txtinq_monthlyadvamt").prop("disabled", true);
    $("#txtinq_advancepayment").prop("disabled", true);
    $("#txtinq_monthlydepamt").prop("disabled", true);
    $("#txtinq_depositpayment").prop("disabled", true);
    $("#txtinq_monthlyrate2").prop("disabled", true);
    $("#txtinq_persqm").prop("disabled", true);
  }

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unit_id=' + unit_id + '&form=selected_unit',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_sqm").val(arr[0])
      $("#txtinq_persqm").val(arr[1])
      $("#txtinq_totalsqm").val(arr[2]);
      $("#txtinq_monthlyrate2").val(arr[2]);
    }
  });

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unit_id=' + unit_id + '&form=selected_unit_amenities',
    success: function(data)
    {
      $("#div_amenities_inquiry").html(data);
        $('.amenities_chk').click(function() {
          if($('.amenities_chk').is(':checked'))
          {
            $(this).prop("checked", true);
          }
          else
          {
            $(this).prop("checked", true);
          }
        });

    }
  })
}

function uploadrequirementscss()
{
    var tag_input = $('#form-field-tags');
      try{
        tag_input.tag(
          {
          placeholder:tag_input.attr('placeholder'),
          //enable typeahead by specifying the source array
          source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
          /**
          //or fetch data from database, fetch those that match "query"
          source: function(query, process) {
            $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
            .done(function(result_items){
            process(result_items);
            });
          }
          */
          }
        )

        //programmatically add/remove a tag
        var $tag_obj = $('#form-field-tags').data('tag');
        // $tag_obj.add('Programmatically Added');

        var index = $tag_obj.inValues('some tag');
        $tag_obj.remove(index);
      }
      catch(e) {
        //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
        tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
        //autosize($('#form-field-tags'));
      }

      $('.upload_app_req').ace_file_input({
        no_file:'No File ...',
        btn_choose:'Choose',
        btn_change:'Change',
        droppable:false,
        onchange:null,
        thumbnail:false //| true | large
        //whitelist:'gif|png|jpg|jpeg'
        //blacklist:'exe|php'
        //onchange:''
        //
      });

        $(".form_lease_application_req").each(function(){
          var form_id = $(this).attr("id");
          var inputfile = $(this).find(".upload_app_req");
          var empty = $(this).find("a[class='remove']");
          inputfile.click(function(){
            empty.click();
            $("#"+form_id+"_icon").removeClass("fa-check");
            $("#"+form_id+"_icon").addClass("fa-remove");
            $("#"+form_id+"_icon").css("color", "red");
          })
        });
}

        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true,
          format:"mm/dd/yyyy"
        })

        $(function(){
displaytnc();
selectfilterdisplay();

})

  function displaytnc(){
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'form=displaytnc',
      success: function(data){
        $("#displaytnc").html(data);
        clickReservation();
      }
    })
  }

  function modal_tnccheckbox(){
    $("#modal_tnccheckbox").modal("show")
    // var id = $("#invi").val();
    // $.ajax ({
    //   type: 'POST',
    //   url: 'mainclass.php',
    //   data: 'id=' + id + '&form=searchChecked',
    //   success:function(data) {
    //     $("#nakacheck").val(data.trim());
    //     // checkSelected3();
    //   }
    // })
  }

  function unloadmodal_tnccheckbox(){
    $("#modal_tnccheckbox").modal("hide")
  }

  function selectfilter(id) {

    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'id=' + id + '&form=selectfilter',
        success: function(data) {
            $("#displaytnc").html(data);
            clickReservation();
            checkSelected();
          }
      })
  }

  function selectfilterdisplay(){
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=selectfilterdisplay',
        success: function(data){
            $("#selectfilterdisplay").html(data);
        }
    })
}

  function addselectedtnc() {
     var nakacheck = $("#nakacheck").val();
    var terms = "";
    $("#displaytnc tr").each(function(){
      var obj = $(this);

      if ( obj.find(".checkbox").prop("checked") ) {
        terms += "|" + obj.find(".checkbox").val();
      }
      $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'nakacheck=' + nakacheck + '&form=addselectedtnc',
        success: function(data){
          if(data == 1){

          }
          else{
            alert(data);
          }
        }
      })
    })
    showmodal("alert", "Selected Terms and Conditions Successfully added.", "", null, "", null, "0");
    unloadmodal_tnccheckbox();
    displayselected();
  }

  function selectfilter(id) {
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'id=' + id + '&form=selectfilter',
        success: function(data) {
            $("#displaytnc").html(data);
            clickReservation();
            checkSelected();
          }
      })
  }

  function selectfilterdisplay(){
      $.ajax({
          type: 'POST',
          url: 'mainclass.php',
          data: 'form=selectfilterdisplay',
          success: function(data){
              $("#selectfilterdisplay").html(data);
          }
      })
  }

  function displayselected(){
    var invi = $("#invi").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: "invi=" + invi + '&form=displayselected',
      success: function(data){
        $("#displayselected").html(data);
      }
    })
  }

  function clickReservation() {


    $("#displaytnc tr").each(function(){
      $(this).click(function(){
        eto = $(this).find(".checkbox");

        if ( eto.is(":checked") ) {
          var ids = $("#nakacheck").val();
          eto.prop("checked", false);

          $("#nakacheck").val(ids.replace($(this).find(".checkbox").val() + "|", ""));
        }

        else {
          var ids = $("#nakacheck").val();
          eto.prop("checked", true);
          ids += $(this).find(".checkbox").val() + "|";

          $("#nakacheck").val(ids);
        }

      })
    })

  }

  function checkSelected() {
    var allselected = $("#nakacheck").val();
    var arr = allselected.split("|");

    for ( var a = 0; a <= arr.length; a++ ) {
      $("." + arr[a]).prop("checked", true);
    }
  }

function checkselected2(){
    var invi = $("#invi").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'invi=' + invi + '&form=checkselected2',
      success: function(data){
        $("#nakacheck").val(data);
      }
    })
  }


  function checkSelected3() {
    var allselected = $("#nakacheck").val();
    var arr = allselected.split("|");

    for ( var a = 0; a <= arr.length; a++ ) {
      $("." + arr[a]).attr("checked", true);
    }
  }
</script>
