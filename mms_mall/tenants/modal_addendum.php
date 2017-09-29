<?php include("../connect.php"); ?>

<div class="modal fade" id="modal_tenantinformation" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" id="modal_div_inquiry" style="width:85%;">

    <!-- Modal content-->
    <div class="modal-content ">
       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" id="pangclosewindow" class="close" onclick="cloasemodalandclear()">&times;</button>
        <h4 class="modal-title" id="div_modal_title_inquiry" style="color:white; font-weight: bold;">Tenant Information</h4>
        <input type="hidden" id="addstat">
        <input type="hidden" id="alucard">
        <input type="hidden" id="yisunshin">
        <input type="hidden" id="yunzhao">
        <input type="hidden" id="clint">
        <input type="hidden" id="eudora">
        <input type="hidden" id="tigreal">
        <input type="hidden" id="estes">
        <input type="hidden" id="hilda">
        <input type="hidden" id="saber">
        <input type="hidden" id="moskov">
        <input type="hidden" id="fanny">
      </div>

       <!-- Modal body-->
      <div class="" id="statussavingreservation"></div>
      <div class="modal-body" style="display: block; height: 35em;overflow-y: scroll;">
            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                  <div class="col-sm-12">
                    <div class="tabbable">
                      <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                          <a data-toggle="tab" href="#businessinfotenants" id="div_businfoadd">
                            <i class="ace-icon fa fa-briefcase bigger-120" style="color: #993300;"></i>
                            Business Information
                          </a>
                        </li>

                        <li>
                          <a data-toggle="tab" href="#otherinfotenants" id="">
                            <i class="green ace-icon fa fa-info bigger-120"></i>
                            Other Information
                          </a>
                        </li>

                        <li>
                          <a data-toggle="tab" href="#unitinfotenants" id="unitinfo_div">
                          <i class="ace-icon fa fa-key bigger-120" style="color: #e6b800;"></i>
                            Unit Information
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#contactpersontenants">
                          <i class="blue ace-icon fa fa-user bigger-120"></i>
                            Contact Persons
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#remarkstenants">
                          <i class="orange ace-icon fa fa-folder-open bigger-120"></i>
                            Requirements and Remarks
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#termsandcontenants" id="terms_and_con_btn">
                          <i class="green ace-icon fa fa-check-square-o bigger-120"></i>
                            Terms and Conditions
                          </a>
                        </li>
                      </ul>

                      <div class="tab-content" style="display: block; height: 28em;overflow-y: scroll;padding-bottom:0px;padding-top: 10px;" id="tabcont">
                        <div id="businessinfotenants" class="tab-pane fade in active">
                          <div class="row form-group" style="margin-bottom: 0px;" id="div_res_0">
                            <div class="col-md-12 col-xs-12">
                                <div class="well" style="padding-bottom: 10px;">
                                  <div class="row form-group" style="margin-bottom: 0px !important;">
                                    <div class="col-xs-12">
                                      <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;padding-top:15px;padding-bottom:13px;margin-left: 3px;">
                                        <div class="col-md-3 col-xs-12">
                                          <div class="image">
                                            <img class="img-thumbnail imageName form-control" src="assets/images/avatars/noimage.png" id="tenantimgtradeaccount" style="border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;height: 160px;">
                                          </div>
                                        </div>
                                        <div class="col-md-9 col-xs-12">
                                          <div class="row form-group">
                                            <div class="col-md-2 col-xs-12">
                                                  Mall Branch
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                                <input type="text" placeholder="Mall Name" class="tenantadd" disabled id="tenantmall">
                                            </div>
                                            <div class="col-md-2 col-xs-12">
                                                  Company
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                              <input type="text" id="tenantcompany" name="" class="form-control tenantadd" placeholder="Company Name" disabled>
                                            </div>
                                          </div>

                                          <div class="row form-group">
                                            <div class="col-md-2 col-xs-12">
                                                  Store Name
                                            </div>
                                            <div class="col-md-4 col-xs-12">

                                                <input type="text" id="tenantstore" name="" class="form-control tenantadd" placeholder="Trade Name" disabled>
                                            </div>
                                             <div class="col-md-2 col-xs-12">
                                                  Industry
                                            </div>
                                            <div class="col-md-4 col-xs-12">
                                                <input type="text" id="tenantindustry" name="" class="form-control tenantadd" placeholder="Select Industry" disabled>
                                            </div>
                                          </div>

                                          <div class="row form-group" style="margin-bottom: 0px !important;">
                                            <div class="col-md-2 col-xs-12">
                                                  Address
                                            </div>
                                            <div class="col-md-10 col-xs-12">
                                                <textarea style="height: 70px;" id="tenantaddress" class="form-control tenantadd" placeholder="Address" disabled></textarea>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-md-6 col-xs-12">
                                      <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;padding-top:15px;padding-bottom:13px;margin-left: 3px;">
                                              <div class="col-xs-12">
                                                <div class="row form-group">
                                                  <div class="col-md-4">
                                                    Billing Type
                                                  </div>
                                                  <div class="col-md-6">
                                                    <input type="text" disabled class="tenantadd" id="tenantbillingtype">
                                                  </div>
                                                  <div class="col-md-2">
                                                    <span class="input-icon icon-on-right" style="width: 100%;display: none;" id="txttenanttypepercent2">
                                                        <input id="tenanttypepercent" class="tenantadd" class="form-control cardgroup numonly" style="margin-bottom: 5px;">
                                                        <span class="ace-icon fa fa-percent" style="font-weight: normal; font-size: 12px;"></span>
                                                    </span>

                                                  </div>
                                                </div>
                                                <div class="row form-group" style="margin-bottom: 0px !important;">
                                                  <div class="col-md-4">
                                                    Merchant Code
                                                  </div>
                                                  <div class="col-md-2">
                                                    <input disabled type="text" class="form-control tenantadd" name="" maxlength="3" id="tenantmerchantcode">
                                                  </div>
                                                  <div class="col-md-6">
                                                  </div>
                                                </div>
                                              </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                      <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;padding-top:15px;padding-bottom:13px;margin-left: 3px;">
                                        <div class="col-xs-12">
                                          <div class="row form-group">
                                            <div class="col-md-4">
                                              Owner Credit Card Number
                                            </div>
                                            <div class="col-md-2">
                                              <input disabled type="text" class="form-control numonly tenantadd" id="tenantownercardnum_01" name="" maxlength="4">
                                            </div>
                                            <div class="col-md-2">
                                              <input disabled type="text" class="form-control numonly tenantadd" id="tenantownercardnum_02" name="" maxlength="4">
                                            </div>
                                            <div class="col-md-2">
                                              <input disabled type="text" class="form-control numonly tenantadd" id="tenantownercardnum_03" name="" maxlength="4">
                                            </div>
                                            <div class="col-md-2">
                                              <input disabled type="text" class="form-control numonly tenantadd" id="tenantownercardnum_04" name="" maxlength="4">
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

                        <div id="otherinfotenants" class="tab-pane fade">
                          <div class="row form-group" style="margin-bottom: 0px;" id="div_res_1">
                            <div class="col-md-6 col-xs-12">
                                <div class="well">
                                  <div class="row form-group">
                                    <div class="col-xs-12">
                                      <h4 class="green smaller lighter">Other Information</h4>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                                <div class="col-xs-12">
                                                <div class="row form-group">
                                                    <div class="col-md-4 col-xs-12">
                                                    Owner's Name
                                                    </div>
                                                    <div class="col-md-8 col-xs-12">
                                                        <input disabled type="text" class="form-control tenantadd" name="" placeholder="First Name" id="tenants_fname">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-4 col-xs-12">
                                                    </div>
                                                    <div class="col-md-8 col-xs-12">
                                                        <input disabled type="text" class="form-control tenantadd" name="" placeholder="Middle Name" id="tenants_mname">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-4 col-xs-12">
                                                    </div>
                                                    <div class="col-md-8 col-xs-12">
                                                        <input disabled type="text" class="form-control tenantadd" name="" placeholder="Last Name" id="tenants_lname">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-4 col-xs-12">
                                                    Permanent Address
                                                    </div>
                                                    <div class="col-md-8 col-xs-12">
                                                    <textarea disabled class="form-control tenantadd" style="height: 50px;" id="tenants_perm_add"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-4 col-xs-12">
                                                    Current Address
                                                    </div>
                                                    <div class="col-md-8 col-xs-12">
                                                    <textarea disabled class="form-control tenantadd" style="height: 50px;" id="tenants_curr_add"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-4 col-xs-12">
                                                    Billing Address
                                                    </div>
                                                    <div class="col-md-8 col-xs-12">
                                                    <textarea disabled class="form-control tenantadd" style="height: 50px;" id="tenants_bill_add"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-4 col-xs-12">
                                                        <div class="input-group">
                                                          Telephone No
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-xs-12" id="add_tel_no_owner">

                                                    </div>
                                                </div>

                                                </div>
                                  </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                              <div class="well">
                                  <div class="row form-group">
                                    <div class="col-xs-12">
                                      <h4 class="green smaller lighter">Company Contacts</h4>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-xs-12" style="display: inline-block; height: 390px;overflow-y: scroll;" id="div_tenantsadd_contact_numbers">
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="unitinfotenants" class="tab-pane fade">
                          <div class="row form-group" id="div_res_2">
                            <div class="col-md-12 col-xs-12">
                              <div class="well">
                                  <div class="row form-group">
                                    <div class="col-xs-12 col-md-6" id="gustokolang">
                                          <div class="row form-group">
                                            <div class="col-xs-12">
                                              <h4 class="green smaller lighter">Unit Information</h4>
                                              <i id="pangenable" class="fa fa-pencil-square-o pull-right" style="margin-top: -25px;margin-right: 10px;color: green;" onclick="changeunitinformation();"></i>
                                            </div>
                                          </div>
                                        <!-- <div> -->
                                          <div class="row form-group">
                                            <div class="col-xs-12">

                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;">
                                                <div class="col-md-4">
                                                  <div class="radio">
                                                    <label>
                                                      <input name="form-field-radio" type="radio" class="unittype123" id="unittype123" value="SET" onclick="" />
                                                      <span class="lbl">&nbsp;&nbsp;&nbsp;SET</span>
                                                    </label>
                                                  </div>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="radio">
                                                    <label>
                                                      <input name="form-field-radio" type="radio" class="unittype123" id="unittype123" value="LCA" onclick="" />
                                                      <span class="lbl">&nbsp;&nbsp;&nbsp;Leasable Common Area</span>
                                                    </label>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 15px;">
                                                <div class="col-xs-12">
                                                  <div class="row form-group">
                                                    <div class="col-md-4">
                                                      Classification
                                                    </div>
                                                  <div class="col-md-8">
                                                  <select id="tenant_unitclass" class="form-control tenantdisabled required_addendum" disabled onchange="selectdepartment(this.value)">
                                                    </select>
                                                  </div>
                                                </div>

                                                <!-- department -->
                                                <div class="row form-group">
                                                  <div class="col-md-4">
                                                    Department
                                                  </div>
                                                  <div class="col-md-8">
                                                    <select id="tenant_unitdepartment" disabled class="form-control required_addendum" onchange="selectcategory(this.value)">
                                                    </select>
                                                  </div>
                                                </div>
                                                <!-- category -->
                                                <div class="row form-group">
                                                  <div class="col-md-4">
                                                    Category
                                                  </div>
                                                  <div class="col-md-8">
                                                   <select id="tenant_unitcategory" disabled class="form-control required_addendum" onchange="selectwing();">
                                                   </select>
                                                  </div>
                                                </div>
                                                </div>
                                              </div>
                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 15px;">
                                                <div class="col-xs-12">
                                                  <!-- wing -->
                                                  <div class="row form-group" id="div_wing">
                                                    <div class="col-md-4">
                                                      Wing/Bldg
                                                    </div>
                                                    <div class="col-md-8">
                                                      <select id="tenant_unitwing" disabled class="form-control required_addendum" onchange="selectfloor()">
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <!-- floor -->
                                                  <div class="row form-group" id="div_floor">
                                                    <div class="col-md-4">
                                                      Floor
                                                    </div>
                                                    <div class="col-md-8">
                                                      <select id="tenant_unitfloor" disabled class="form-control required_addendum" onchange="selectunit54()">
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <!-- unit -->
                                                  <div class="row form-group" id="div_unit_set2">
                                                    <div class="col-md-4">
                                                      Unit
                                                    </div>
                                                    <div class="col-md-8">
                                                      <select id="tenant_unitunit" disabled class="form-control required_addendum">
                                                      </select>
                                                    </div>
                                                  </div>

                                                  <div class="row form-group" id="div_unit_lca2">
                                                    <div class="col-md-4">
                                                      Unit
                                                    </div>
                                                    <div class="col-md-8">
                                                      <select class="form-control required_addendum" disabled name="" id="tenant_lca_unitname" placeholder="Enter Unit Name">
                                                      </select>
                                                      <!-- <input type="text" class="form-control required_reservation" name="" id="tenant_lca_unitname" placeholder="Enter Unit Name" onkeyup="txtchklcaunitval()"> -->
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 15px;">
                                                <div class="col-xs-12">
                                                  <div class="row form-group">
                                                    <div class="col-md-4">
                                                      Occupancy Date
                                                    </div>
                                                    <div class="col-md-4">
                                                      <input class="form-control date-picker tenantadd " id="tenant_datefrom" disabled type="text" onchange="" onkeyup="" data-date-format="dd-mm-yyyy"/>

                                                    </div>
                                                    <div class="col-md-4">
                                                      <input type="text" name="" id="tenant_dateto" disabled class="form-control date-picker tenantadd " data-date-format="dd-mm-yyyy" >

                                                    </div>
                                                  </div>

                                                  <div class="row form-group">
                                                    <div class="col-md-4">
                                                      Preffered Occupancy Date
                                                    </div>
                                                    <div class="col-md-4">
                                                      <input class="form-control date-picker tenantadd required_addendum" disabled id="ptenant_datefrom" type="text"  data-date-format="dd-mm-yyyy"/>

                                                    </div>
                                                    <div class="col-md-4">
                                                      <input type="text" name="" id="ptenant_dateto" disabled class="form-control date-picker tenantadd required_addendum" data-date-format="dd-mm-yyyy" >

                                                    </div>
                                                  </div>


                                                  <div class="row form-group" id="div_nomonths" style="display: block;">
                                                    <div class="col-md-4">
                                                      No of Months
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input type="text" class="form-control numonly tenantadd required_addendum" disabled placeholder="0" name="" id="txtnoofmonths_tenants" onkeyup="loaddatetofunction54()" maxlength="2">

                                                    </div>
                                                    <div class="col-md-6"></div>
                                                  </div>

                                                  <div class="row form-group" id="div_advance_set2">
                                                    <div class="col-md-4">
                                                      Advance<br />
                                                      <h6 style="font-size:10px; font-style: italic;">(No of Months)</h6>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input class="form-control numonly tenantadd " disabled id="tenants_monthlyadvamt" type="text" placeholder="0" maxlength="2"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <input type="text" id="tenants_advancepayment" style="text-align: right;background-color: white;" class="numonly form-control amount tenantadd" placeholder="0.00" disabled="true" />
                                                    </div>
                                                  </div>

                                                  <div class="row form-group" id="div_deposit_set2">
                                                    <div class="col-md-4">
                                                      Deposit<br />
                                                      <h6 style="font-size:10px; font-style: italic;">(No of Months)</h6>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input class="form-control numonly tenantadd" disabled id="tenants_monthlydepamt" type="text" placeholder="0" maxlength="2"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <input type="text" id="tenants_depositpayment" style="text-align: right;background-color: white;" class="numonly form-control amount tenantadd" placeholder="0.00" disabled="true" />
                                                    </div>
                                                  </div>

                                                  <div class="row form-group" id="div_nodays2">
                                                    <div class="col-md-4">
                                                      No of Days
                                                    </div>
                                                    <div class="col-md-2">
                                                      <input type="text" class="form-control numonly tenantadd" disabled placeholder="0" onkeyup="loaddatetofunction54()" name="" id="txtnoofdays_tenants">
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                  </div>

                                                  <div class="row form-group">
                                                    <div class="col-md-4" id="txtlabel_payment2">
                                                      Monthly Payment
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input type="text" id="tenants_monthlyrate2" style="text-align: right;" class="form-control numonly amount tenantadd" placeholder="0.00" disabled/>
                                                    </div>
                                                  </div>
                                                  <div class="row form-group" id="div_advance_set_amt2">
                                                    <div class="col-md-4">
                                                      Advance
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input type="text" id="tenants_advancepayment2" disabled style="text-align: right;" class="numonly amount form-control tenantadd" placeholder="0.00" />
                                                    </div>
                                                  </div>
                                                  <div class="row form-group" id="div_deposit_set_amt2">
                                                    <div class="col-md-4">
                                                      Deposit
                                                    </div>
                                                    <div class="col-md-8">
                                                      <input type="text" id="tenants_depositpayment2" disabled style="text-align: right;" class="numonly amount form-control tenantadd"  placeholder="0.00" />
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                      <div class="row form-group">
                                        <div class="col-xs-12">
                                          <h4 class="green smaller lighter">Unit Area</h4>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                        <div class="col-xs-12">
                                          <div class="row form-group" id="div_unit_area_set2">
                                            <div class="col-md-4">
                                              Unit Area
                                            </div>
                                            <div class="col-md-8">
                                              <input type="text" class="form-control tenantadd" name="" id="tenant_sqm" style="text-align: right;" disabled="" placeholder="square meter">
                                            </div>
                                          </div>
                                          <div class="row form-group" id="div_unit_area_lca2">
                                            <div class="col-md-4">
                                              Unit Area
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control numonly tenantadd" name="" id="tenant_sqm_width" style="text-align: right;" disabled=""  placeholder="Width">
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control numonly tenantadd" name="" id="tenant_sqm_length" style="text-align: right;" disabled="" placeholder="Length">
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <div class="col-md-4">
                                              price per Sq M
                                            </div>
                                            <div class="col-md-8">
                                              <input type="text" class="form-control amount numonly tenantadd" style="text-align: right;" name="" placeholder="0.00" id="tenant_persqm" disabled="">
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <div class="col-md-4">
                                              Total Price
                                            </div>
                                            <div class="col-md-8">
                                              <input type="text" class="form-control amount numonly tenantadd" style="text-align: right;" name="" placeholder="0.00" id="tenant_totalsqm" disabled="">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                        <div class="col-md-12 col-xs-12">
                                          <div class="row form-group">
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
                                                  <th style="text-align: right;">Monthly Rent Fee</th>
                                                  <th style="text-align: right;">Check Number</th>
                                                  <th style="text-align: center;">Bank</th>
                                                </tr>
                                              </thead>

                                              <tbody id="tbodypdc_inquiry2" style="">

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
                                                <span class="red tenantadd" id="lbltotalamountofpayment2">Php 0.00</span>
                                              </h4>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12" id="div_amenities_inquiry2" style="margin-top: 20px;">
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="contactpersontenants" class="tab-pane fade">
                          <div class="row form-group" id="div_res_3">
                            <div class="col-md-12 col-xs-12">
                                <div class="well">
                                  <div class="row form-group">
                                    <div class="col-xs-12">
                                      <h4 class="green smaller lighter">Contact Persons</h4>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-xs-12" style="display: inline-block; height: 380px;overflow-y: scroll;" id="div_tenantsadd_contact_person">
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>

                        <div id="remarkstenants" class="tab-pane fade">
                          <div class="row form-group" id="div_res_4">
                            <div class="col-md-6 col-xs-12" >
                                  <div class="well">
                                    <div class="row form-group">
                                      <div class="col-xs-12">
                                        <h4 class="green smaller lighter">Requirements</h4>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <div class="col-xs-12" style="display: block;height: 300px;" id="div_modal_tenants_requirements">
                                        <form name="posting_comment" id="posting_comment">
                                            <input type="hidden" name="txtaapid" id="txtappid_form">
                                            <input type="hidden" name="txtinqqid" id="txtinqid_form">
                                            <div class="form-group" id="div_req_passed">
                                              <?php
                                                $queryind = "Select id, requirements FROM tblref_applicationrequirements";
                                                $rsss = mysql_query($queryind, $connection);
                                                 while($row = mysql_fetch_array($rsss)){
                                                      echo'<div class="row"><div class="col-xs-6">'.$row["requirements"].'</div><div class="col-xs-6"><input type="file" class="upload_app_req id-input-file-2" name="attachment_file[]"/><input type="hidden" name="hiddenid[]" value="'.$row["id"].'"/></div></div>';
                                                }
                                            ?>
                                            </div>
                                      </form>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-md-6 col-xs-12" id="div_modal_inquiry_remarks">
                              <div class="well">
                                <div class="row form-group" style="margin-bottom: 0px;">
                                      <div class="col-md-8 col-xs-12">
                                        <h4 class="green smaller lighter">Remarks</h4>
                                      </div>
                                      <div class="col-md-4 col-xs-12" style="padding-right: 17px;">
                                        <button class="btn btn-xs btn-info" style="float: right;" id="btnaddnewreeeeem" ><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;Add New Remarks</button>
                                      </div>
                                    </div>
                                    <div class="row form-group" style="padding-top: 0px;height:215px;overflow-y:scroll;">
                                      <div class="col-xs-12">
                                          <ol class="dd-list" id="remarkslist_ol"></ol>
                                      </div>
                                    </div>
                                <div class="row form-group" style="margin-bottom: 3px;margin-top: 34px;">
                                  <div class="col-xs-12">
                                    <h4 class="green smaller lighter">Reservation Status</h4>
                                  </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col-xs-12">
                                    <select class="form-control required_reservation" id="reservation_stat_select" disabled>
                                      <option value="Confirmed">Confirmed</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="termsandcontenants" class="tab-pane fade">
                          <div class="row form-group" style="margin-bottom: 0px;">
                            <div class="col-md-12 col-xs-12">
                                <div class="well">
                                  <div class="row form-group">
                                    <div class="col-xs-12">
                                      <h4 class="green smaller lighter" align="center">TERMS AND CONDITIONS</h4>
                                      <button class='btn btn-xs btn-primary' onclick='modal_tnccheckbox2()' id="pangaddngtnc" title='Add Terms and Conditions'>Add Terms and Conditions</button>
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
                                            <tbody id="displayselected2"></tbody>
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
        <button class="btn btn-primary" id="pangsavengadd" onclick="savedesiredaddendum()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
        <button class="btn btn-danger" id="pangcancelngadd" onclick='cloasemodalandclear()'><i class="fa fa-times"></i>&nbsp;Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_tenantstncadd" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal" onclick='$("#modal_tenantstncadd").modal("hide");''>&times;</button>
        <h4 class="modal-title" style="color:white; font-weight: bold;">Terms and Conditions</h4>
        <input type="hidden" class="tncmodal" id="tncmodal" name="">
      </div>

        <div class="container-fluid">
            <div class="row form-group">
              <div class="col-md-3 col-xs-12 col-lg-3" style="padding-top: 5px;">
                        <b >Filter by Group Name:</b>
              </div>
              <div class="col-md-4 col-xs-12 col-lg-4" style="padding-top: 5px;">
                          <select id="selectfilterdisplay"  onchange="selectfilter2(this.value);" class="form-control required">
                            <option onclick="displaytnc54()">Display all</option>
                          </select>

              </div>
            </div>
            <div class="row">
              <div class="col-xs-12">
                <div class="row form-group" style="margin-bottom: 0px !important;">
                  <div class="col-xs-12">
                    <div class="parent">
                    <table id="simple-table" class="table  table-bordered table-hover fixTable" style="display:  block;">
                                <thead>
                                    <tr>
                                        <!-- <td width="3%">&nbsp;</td> -->
                                        <td width="15%">Group Name</td>
                                        <td width="20%">Term Name</td>
                                        <td width="35%">Condition</td>
                                        <td width="10%">Status</td>
                                    </tr>
                                </thead>
                          <tbody id="displaytnc2"></tbody>
                      </table>
                <input id="nakacheck" type="hidden">
                <input type="hidden" id="chineckan">
                      </div>
                    <table class="tabledash_footer table" style="margin: 0px !important;">
                        <thead>
                            <tr>
                                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txttnc"></font>
                                    <div class="pagination">
                                        <ul id=""></ul>
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

       <!-- Modal footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addselectedtnc2()"><i class="ace-icon fa fa-check"></i>&nbsp;Add Selected</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewcontractpapel" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
      <button type="button" class="close" onclick='$("#viewcontractpapel").modal("hide")'>&times;</button>
          <div id="viewcontract">
            <div class="container-fluid">
              <table style="width: 100%;margin-top: 10px;" cellspacing="0" cellpadding="0">
                <tbody id="template"></tbody>
              <tr><td style="padding:10px;"></td></tr>
              <tr>
                <td colspan="5" align="center" style="background-color: #333333 !important;-webkit-print-color-adjust: exact;"><h6 style="font-weight: bold;margin: 3px;font-size: 20px;color: #ffffff !important;">LEASE CONTRACT</h6></td>
              </tr>
              </table>
              <div class="row" id="showinfo" style="margin-left: 5px;margin-top:5px;">
                <table>
                  <tr style="font-size: 18px;"><b>Unit Information</b></tr>
                  <tr><td>Unit Address</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="unitaddress8"></label></td></tr>
                  <tr><td>Tenant ID</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="tenant_ID8"></label></td></tr>
                  <tr><td>Store Name</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="storename8" style="font-weight: bold !important;"></label></td></tr>
                  <tr><td>Address</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="address8"></label></td></tr>
                  <tr><td>Authorized Signatory</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="authorizedsignatory8"></label></td></tr>
                  <tr><td>Contact Numbers</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="contactnumbers8"></label></td></tr>
                  <tr><td>Nature of Business</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="natureofbusiness8"></label></td></tr>
                  <tr><td>Classification</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="classification8"></label></td></tr>
                  <tr><td>Lease Unit/Floor</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="leaseunitfloor8"></label></td></tr>
                  <tr><td>Monthly Rent</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="monthlyrent8"></label></td></tr>
                  <tr><td>Start Date</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="startdate8"></label></td></tr>
                  <tr><td>End Date</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="enddate8"></label></td></tr>
                  <tr><td>Lease Period</td> <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td> <td><label id="leaseperiod8"></label></td></tr>
                </table>
              </div>

              <div id="termsandcondition" style="text-align: center; font-size: 20px;"><b>TERMS AND CONDITIONS</b></div>
              <hr style="border: 1px solid #333333;width: 100%;margin-top:7px;margin-bottom: 3px;">
              <table cellspacing="10">
                <th width="200" style="font-size: 18px;">Terms</th>
                <th width="400" style="font-size: 18px;">Conditions</th>
                <tbody id="termsandcondition54"></tbody>
              </table>
              <table style="margin-top: 50px;margin-left: 50px;">
                <tr>
                    <td></td>
                    <td width="200" style="border-bottom: 1px solid #333;""></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="200" style="border-bottom: 1px solid #333"></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: center;margin-left: 50px;"><strong>Lessee Signature</strong></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td style="text-align: center;"><strong>Lessor Signature</strong></td>
                </tr>
            </table>
            <button type="button" class="btn btn-primary" style="float: right;margin-top: 10px;" onclick="printsoa()">&nbsp;Print</button>
          </div>
        </div>
      </div>
       <!-- Modal footer-->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addselectedtnc2()"><i class="ace-icon fa fa-check"></i>&nbsp;Add Selected</button>
      </div> -->
    </div>
  </div>
</div>
