<style>
.parent {
    height: 50vh;
}

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
<div class="modal fade" id="modal_previewleasingapplication" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" id="modal_div_inquiry" style="width:85%;">

    <!-- Modal content-->
    <div class="modal-content ">
    <div id="reservationloadingscreen"></div>
       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <input type="hidden" id="statinquiryyy" name="">
        <input type="hidden" id="txtresidreq" name="">
        <button type="button" class="close" onclick="closeinquirymodal()">&times;</button>
        <h4 class="modal-title" id="div_modal_title_inquiry" style="color:white; font-weight: bold;">Reservation</h4>
        <input type="hidden" class="text_inquiry" id="txtinq_inquiryid" name="">
        <input type="hidden" id="status_filled" name="">
        <input type="hidden" id="status_todo" name="">
        <input id="nakacheck" type="hidden">
      </div>

       <!-- Modal body-->
        <div class="modal-body">
            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                  <div class="col-sm-12">
                    <input type="hidden" id="txtselected_month" name="">
                    <div class="tabbable">
                      <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                          <a data-toggle="tab" href="#home" id="div_businf">
                            <i class="ace-icon fa fa-briefcase bigger-120" style="color: #993300;"></i>
                            Business Information
                          </a>
                        </li>

                        <li>
                          <a data-toggle="tab" href="#unitinfo" id="unitinfo_div">
                          <i class="ace-icon fa fa-key bigger-120" style="color: #e6b800;"></i>
                            Unit Information
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#contactperson">
                          <i class="blue ace-icon fa fa-user bigger-120"></i>
                            Contact Persons and Remarks
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#remarks">
                          <i class="orange ace-icon fa fa-folder-open bigger-120"></i>
                            Requirements and Payment Status
                          </a>
                        </li>

                        <li class="dropdown">
                          <a data-toggle="tab" href="#termsandcon" id="terms_and_con_btn">
                          <i class="green ace-icon fa fa-check-square-o bigger-120"></i>
                            Terms and Conditions
                          </a>
                        </li>
                      </ul>

                      <div class="tab-content" style="display: block;height: 50em;overflow-y: scroll;padding-bottom:0px;padding-top: 10px;" id="tabcont">
                        <div id="home" class="tab-pane fade in active">
                          <div class="row form-group" style="margin-bottom: 0px;" id="div_res_0">
                            <div class="col-md-12 col-xs-12">
                              <div class="well" style="padding-bottom: 10px;">
                                <div class="row form-group" style="margin-bottom: 0px !important;">
                                  <div class="col-xs-12">
                                    <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;padding-top:15px;padding-bottom:13px;margin-left: 3px;">
                                      <div class="col-md-3 col-xs-12">
                                        <div class="image">
                                          <img class="img-thumbnail imageName form-control" src="assets/images/avatars/noimage.png" id="imgtradeaccount" style="border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;height: 160px;">
                                        </div>
                                      </div>
                                      <div class="col-md-9 col-xs-12">
                                        <div class="row form-group">
                                          <div class="col-md-2 col-xs-12">
                                                Mall Branch
                                          </div>
                                          <div class="col-md-4 col-xs-12">
                                            <!-- <input list="list_mallbranch" id="txtinq_mallbranch" class="form-control text_inquiry required_inq occ_dis" type="text" li="txtbuss" placeholder=" Select Mall Branch" oninput="changemallselected()"/>
                                                <datalist id="list_mallbranch">
                                                  <?php
                                                    $queryind = "Select mallid, mallname FROM tblref_mall";
                                                    $rsss = mysql_query($queryind, $connection);
                                                  while($row = mysql_fetch_array($rsss)){
                                                    $industry = "<option id='".$row['mallid']."' ";
                                                    $industry .= "value='".$row['mallname']."'/>";

                                                    echo $industry;
                                                  }
                                                ?>
                                                </datalist> -->
                                              <select id="txtinq_mallbranch" class="form-control text_inquiry required_inq occ_dis">
                                                  <?php
                                                    echo "<option value=''>-- Select Mall --</option>";
                                                    $queryind = "Select mallid, mallname FROM tblref_mall";
                                                    $rsss = mysql_query($queryind, $connection);
                                                  while($row = mysql_fetch_array($rsss)){
                                                    $industry = "<option value='".$row['mallid']."'> ";
                                                    $industry .= $row['mallname']."</option>";

                                                    echo $industry;
                                                  }
                                                ?>
                                              </select>
                                          </div>
                                          <div class="col-md-2 col-xs-12">
                                                Company
                                          </div>
                                          <div class="col-md-4 col-xs-12">
                                            <input type="text" id="txtinq_companyname" name="" class="form-control text_inquiry required_inq" placeholder="Company Name" disabled>
                                          </div>
                                        </div>

                                        <div class="row form-group">
                                          <div class="col-md-2 col-xs-12">
                                                Store Name
                                          </div>
                                          <div class="col-md-4 col-xs-12">

                                              <input type="text" id="txtinq_tradename" name="" class="form-control text_inquiry required_inq" placeholder="Trade Name" onclick="loadtradefunction()" disabled>
                                          </div>
                                           <div class="col-md-2 col-xs-12">
                                                Industry
                                          </div>
                                          <div class="col-md-4 col-xs-12">
                                              <input type="text" id="txtinq_industryname" name="" class="form-control text_inquiry required_inq" placeholder="Select Industry" disabled>
                                          </div>
                                        </div>

                                        <div class="row form-group">
                                          <div class="col-md-2 col-xs-12">
                                                Address
                                          </div>
                                          <div class="col-md-10 col-xs-12">
                                              <textarea style="height: 70px;" id="txtinq_address" class="form-control text_inquiry required_inq" placeholder="Address" disabled></textarea>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                          <div class="col-xs-6 col-md-6">
                                            <div class="col-md-4">
                                              Billing Type
                                            </div>
                                            <div class="col-md-6">
                                              <select id="txttenanttype" class="form-control text_inquiry required_inq" style="font-size: 12px; margin-bottom: 5px;" onchange="chkbilltype()">
                                                <option value="Rent">Rent</option>
                                                <option value="Rent | Rev">Rent + Rev</option>
                                                <option value="Rent or Share">Rent or Share</option>
                                                <option value="Share Only">Share Only</option>
                                              </select>
                                            </div>
                                            <div class="col-md-2">
                                              <span class="input-icon icon-on-right" style="width: 100%;display: none;" id="txttenanttypepercent2">
                                                  <input id="txttenanttypepercent" class="form-control cardgroup numonly" style="margin-bottom: 5px;">
                                                  <span class="ace-icon fa fa-percent" style="font-weight: normal; font-size: 12px;"></span>
                                              </span>
                                            </div>
                                          </div>
                                          <div class="col-xs-6 col-md-6">
                                            <div class="col-md-4">
                                              Merchant Code
                                            </div>
                                            <div class="col-md-6">
                                              <input type="text" class="form-control" id="txtmerchantcode">
                                            </div>
                                            <div class="col-md-2"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
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
                                                    <input type="text" class="form-control text_reqcompany" name="" placeholder="First Name" id="txtcomp_fname">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4 col-xs-12">
                                                </div>
                                                <div class="col-md-8 col-xs-12">
                                                    <input type="text" class="form-control" name="" placeholder="Middle Name" id="txtcomp_mname">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4 col-xs-12">
                                                </div>
                                                <div class="col-md-8 col-xs-12">
                                                    <input type="text" class="form-control text_reqcompany" name="" placeholder="Last Name" id="txtcomp_lname">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4 col-xs-12">
                                                Permanent Address
                                                </div>
                                                <div class="col-md-8 col-xs-12">
                                                <textarea class="form-control" style="height: 50px;" id="txtcomp_perm_add"></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4 col-xs-12">
                                                Current Address
                                                </div>
                                                <div class="col-md-8 col-xs-12">
                                                <textarea class="form-control text_reqcompany" style="height: 50px;" id="txtcomp_curr_add"></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-4 col-xs-12">
                                                Billing Address
                                                </div>
                                                <div class="col-md-8 col-xs-12">
                                                <textarea class="form-control text_reqcompany" style="height: 50px;" id="txtcomp_bill_add"></textarea>
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
                                          <div class="col-xs-12" style="display: inline-block; height: 390px;overflow-y: scroll;" id="div_inquiry_contact_numbers">
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="unitinfo" class="tab-pane fade">
                          <div class="row form-group" id="div_res_2">
                            <div class="col-md-12 col-xs-12">
                              <div class="well">
                                <div class="row form-group">

                                  <div class="row form-group">
                                    <div class="col-md-8">
                                      <h4 class="green smaller lighter">Unit Information</h4>
                                    </div>
                                    <div class="col-md-4">
                                      <h4 class="green smaller lighter">Payment Information & Amenities</h4>
                                    </div>
                                  </div>

                                  <div class="row form-group">
                                    <div class="col-xs-12 col-md-4">
                                      <div class="row form-group">
                                        <div class="col-xs-12">
                                          <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;">
                                            <div class="col-md-12">
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
                                                    <input name="form-field-radio" type="radio" class="ace" id="radio_lca" onclick="clicklca()" />
                                                    <span class="lbl">&nbsp;&nbsp;&nbsp;Leasable Common Area</span>
                                                  </label>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 15px;">
                                            <div class="col-xs-12">
                                              <div class="row form-group">
                                                <label class="col-md-4">Select Unit</label>
                                                <div class="col-md-8">
                                                    <button class="btn btn-primary btn-sm col-md-12" id="btnshortucutunit" onclick="tblselectshortcutunit(); $('#modalshortcutunit').modal('show');"><i class="ace-icon fa fa-level-up"></i>&nbsp;Shortcut</button>
                                                </div>
                                              </div>
                                              <div class="row form-group">
                                                <div class="col-md-4">
                                                  Classification
                                                </div>
                                                <div class="col-md-8">
                                                <select id="txtinq_unitclass" class="form-control text_inquiry required_inq required_reservation" onchange="changeclassification()">
                                                  <option value="">-- Select Classification --</option>
                                                  <?php
                                                      $queryind = "Select classificationID, classification FROM tblref_merchandise_class";
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
                                              <div class="row form-group">
                                                <div class="col-md-4">
                                                  Department
                                                </div>
                                                <div class="col-md-8">
                                                  <select id="txtinq_unitdepartment" class="form-control text_inquiry required_inq required_reservation" onchange="loadinquiry_category()">
                                                  <option value="">-- Select Department --</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="row form-group">
                                                <div class="col-md-4">
                                                  Category
                                                </div>
                                                <div class="col-md-8">
                                                 <select id="txtinq_unitcategory" class="form-control text_inquiry required_inq required_reservation" onchange="loadinquiry_wing_lca()">
                                                  <option value="">-- Select Category --</option>
                                                 </select>
                                                </div>
                                              </div>
                                              <div class="row form-group" id="div_wing">
                                                <div class="col-md-4">
                                                  Wing/Bldg
                                                </div>
                                                <div class="col-md-8">
                                                  <select id="txtinq_unitwing" class="form-control text_inquiry" onchange="loadinquiry_flr()">
                                                    <option value="">-- Select Wing --</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="row form-group" id="div_floor">
                                                <div class="col-md-4">
                                                  Floor
                                                </div>
                                                <div class="col-md-8">
                                                  <select id="txtinq_unitfloor" class="form-control text_inquiry" onchange="loadinquiry_unit_lca()" >
                                                    <option value="">-- Select Floor --</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="row form-group" id="div_unit_set">
                                                <div class="col-md-4">
                                                  Unit
                                                </div>
                                                <div class="col-md-8">
                                                  <select id="txtinq_unitunit" class="form-control text_inquiry required_reservation" onchange="selected_unit();chkunitfrst();" >
                                                    <option value="">-- Select Unit --</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="row form-group" id="div_unit_lca">
                                                <div class="col-md-4">
                                                  Unit
                                                </div>
                                                <div class="col-md-8">
                                                  <select class="form-control required_reservation" name="" id="txtinq_lca_unitname" placeholder="Enter Unit Name" onchange="txtchklcaunitval();selected_lca_unit()">
                                                    <option value="">-- Select Unit --</option>
                                                  </select>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;">
                                            <div class="col-md-12">
                                              <div class="form-group row" style="padding-top: 10px;">
                                                <div class="col-md-4 col-xs-12">
                                                  Payment Terms
                                                </div>
                                                <div class="col-md-8 col-xs-12">
                                                <select class="form-control text_inquiry" id="txtinq_pymentterms" onchange="loaddatetofunction();">
                                                  <option value="">-- Select Payment Terms --</option>
                                                  <option value="daily">Daily</option>
                                                  <option value="monthly">Monthly</option>
                                                  <option value="1time">1 Time Payment</option>
                                                </select>
                                                </div>
                                              </div>
                                              <div class="form-group row">
                                                <div class="col-md-4 col-xs-12">
                                                  Payment Type
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                  <select id="txtinq_pymenttype" class="form-control text_inquiry disable_this" style="margin-bottom: 5px;" onchange="forinputofdetails(this.value)">
                                                    <option value="">-- Select Payment Type --</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Check">Check</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Debit Card">Debit Card</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                  </select>
                                                </div>
                                                <div class="col-md-2 col-xs-2">
                                                  <button class="btn spinbox-up btn-sm btn-success" id="btnforinputofdetails" onclick='showmodalforinputofdetails();$("#modalforinputofdetails").modal("show");' disabled><i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i></button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-xs-12 col-md-4">
                                      <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 10px;">
                                        <div class="col-xs-12">
                                          <div class="row form-group" id="div_unit_area_set">
                                            <div class="col-md-4">
                                              Unit Area
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-7">
                                              <input type="text" class="form-control text_inquiry required_reservation" name="" id="txtinq_sqm" style="text-align: right;" disabled="" placeholder="Square Meter">
                                            </div>
                                          </div>
                                          <div class="row form-group" id="div_unit_area_lca">
                                            <div class="col-md-4">
                                              Unit Area (L x W)
                                            </div>
                                            <div class="col-md-3 pull-right">
                                              <input type="text" class="form-control text_inquiry numonly" name="" id="txtinq_sqm_width" style="text-align: right;" disabled=""  placeholder="Width">
                                            </div>
                                            <div class="col-md-3 pull-right">
                                              <input type="text" class="form-control text_inquiry numonly" name="" id="txtinq_sqm_length" style="text-align: right;" disabled="" onkeyup="unitareachk()" placeholder="Length">
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <div class="col-md-4">
                                              price per Sq M
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-7">
                                              <input type="text" class="form-control amount numonly text_inquiry required_reservation" onkeyup="unitareachk()" style="text-align: right;" name="" placeholder="0.00" id="txtinq_persqm" disabled="">
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <div class="col-md-4">
                                              Monthly Dues
                                            </div>
                                            <div class="col-md-1">
                                              <label>
                                                <input name="form-field-checkbox" class="ace ace-checkbox-2 chkrentbox disable_this" type="checkbox" id="chkclearrent" onclick="clearrent();" checked>
                                                <span class="lbl"></span>
                                              </label>
                                            </div>
                                            <div class="col-md-4">
                                              <input type="text" class="form-control amount numonly text_inquiry required_reservation" style="text-align: right;" name="" placeholder="0.00" id="txtinq_totalsqm" disabled="" onkeyup="loaddatetofunction();foreditingofamount();">
                                            </div>
                                            <div class="col-md-3">
                                              <div class="col-md-6">
                                                <button id="monthlyduesiconforedit" class="btn btn-sm spinbox-up btn-success fa fa-pencil-square-o disable_this" onclick="clickone()"></button>
                                                <button id="monthlyduesiconforsave" class="btn btn-sm spinbox-up btn-primary fa fa-floppy-o disable_this" style="display: none;" onclick="clicktwo()"></button>
                                              </div>
                                              <div class="col-md-6">
                                                <button id="monthlyduesiconforclose" class="btn btn-sm spinbox-up btn-danger fa fa-times disable_this" style="display: none;" onclick="clickthree()"></button>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <div class="col-md-4">
                                              Association Dues
                                            </div>
                                            <div class="col-md-1">
                                              <label>
                                                <input name="form-field-checkbox" class="ace ace-checkbox-2 radassocdues disable_this" value="1" type="checkbox" id="chkassocdues" onclick="removeassocdues();" checked>
                                                <span class="lbl"></span>
                                              </label>
                                            </div>
                                            <div class="col-md-7">
                                              <input type="text" class="form-control amount numonly " style="text-align: right;" placeholder="0.00" id="txtinq_assocdues" disabled="">
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <div class="col-md-4">
                                              Total Monthly Dues
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-7">
                                              <input type="text" class="form-control amount numonly" style="text-align: right;" placeholder="0.00" id="txtinq_totalmonthlydues" disabled>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 15px;">
                                        <div class="row form-group" style="margin-right: 3px;margin-left: 3px;">
                                          <div class="col-xs-12">
                                            <div class="row form-group">
                                              <div class="col-md-4">
                                                Occupancy Date
                                              </div>
                                              <div class="col-md-4">
                                                <input class="form-control kevin-date-picker required_reservation" id="txtinq_datefrom" type="text" onchange="" onkeyup="" data-date-format="m/d/Y"/>
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" name="" id="txtinq_dateto" class="form-control date-picker required_reservation" data-date-format="m/d/Y" disabled>
                                              </div>
                                            </div>
                                            <div class="row form-group" id="div_nomonths" style="display: block;">
                                              <div class="col-md-4">
                                                No of Months
                                              </div>
                                              <div class="col-md-2">
                                                <input type="text" class="form-control numonly text_inquiry required_reservation" placeholder="0" name="" id="txtnoofmonths_inq" onkeyup="" maxlength="2">
                                              </div>
                                              <div class="col-md-1" style="margin-top: 5px;">
                                                <span style="font-weight: bold;">x</span>
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" class="form-control" id="txtmonthlymath" placeholder="0.00" style="text-align: right;" disabled>
                                              </div>
                                            </div>
                                            <div class="row form-group" id="div_nodays" style="display: none;">
                                              <div class="col-md-4">
                                                No of Days
                                              </div>
                                              <div class="col-md-2">
                                                <input type="text" class="form-control numonly text_inquiry" placeholder="0" name="" id="txtnoofdays_inq">
                                              </div>
                                              <div class="col-md-1" style="margin-top: 5px;">
                                                <span style="font-weight: bold;">x</span>
                                              </div>
                                              <div class="col-md-4">
                                                <input type="text" class="form-control" id="txtmonthlymathdays" placeholder="0.00" style="text-align: right;" disabled>
                                              </div>
                                            </div>
                                            <div class="row form-group" style="margin-bottom: -3px;">
                                                <div class="col-md-4">Total Amount</div>
                                                <div class="col-md-8" style="text-align: right;">
                                                    <span id="totalpayment" style="font-size: 14px; font-weight:700; color: #DD5A43!important;">Php 0.00</span>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group" style="margin-right: 3px;margin-left: 3px;">
                                          <div class="col-xs-12">
                                            <div class="row form-group" id="div_deposit_set" style="margin-bottom: -3px;">
                                              <div class="col-md-4">
                                                Deposit<br />
                                                <h6 style="font-size:10px; font-style: italic;">(Deposit must be <label id="depositpercentage" style="color: red;font-size:10px; font-style: italic;"></label> of total monthly dues.)</h6>
                                              </div>
                                              <div class="">
                                                <input class="form-control text_inquiry numonly " id="txtinq_monthlydepamt" type="text" placeholder="0" onkeyup="loaddatefunction4()" style="display: none;" maxlength="2"/>
                                              </div>
                                              <div class="col-md-8">
                                                <input type="text" id="txtinq_depositpayment" style="text-align: right;background-color: white;" class="numonly form-control amount text_inquiry " placeholder="0.00" disabled="true" />
                                                <h6 style="font-size:10px; font-style: italic;">(Deposit is not deducted from the total amount. but can be applied for refund or credit memo.)</h6>
                                              </div>
                                            </div>
                                            <div class="row form-group" id="div_advance_set" style="margin-bottom: -3px;">
                                              <div class="col-md-4">
                                                Advance<br />
                                                <h6 style="font-size:10px; font-style: italic;">(No of Months)</h6>
                                              </div>
                                              <div class="col-md-2">
                                                <input class="form-control text_inquiry numonly " id="txtinq_monthlyadvamt" type="text" placeholder="0" onkeyup="loaddatefunction4()"  maxleng  th="2"/>
                                              </div>
                                              <div class="col-md-6">
                                                <input type="text" id="txtinq_advancepayment" style="text-align: right;background-color: white;" class="numonly form-control text_inquiry amount " placeholder="0.00" disabled="true" />
                                              <h6 style="font-size:10px; font-style: italic;">(Please settle the amount in the cashiering)</h6>
                                              </div>
                                            </div>

                                            <div class="row form-group" id="div_deposit_set_amt" style="margin-bottom: -3px;">
                                              <div class="col-md-4">
                                                Deposit
                                              </div>
                                              <div class="col-md-8">
                                                <input type="text" id="txtinq_depositpayment2" style="text-align: right;" class="numonly amount form-control text_inquiry" placeholder="0.00" /><h6 style="font-size:10px; font-style: italic;">(Deposit is not deducted from the total amount. but can be applied for refund or credit memo.)</h6>
                                              </div>
                                            </div>
                                            <div class="row form-group" id="div_advance_set_amt" style="margin-bottom: -3px;">
                                              <div class="col-md-4">
                                                Advance<br />
                                              <h6 style="font-size:10px; font-style: italic;">(No of Months)</h6>
                                              </div>
                                              <div class="col-md-8">
                                                <input type="text" id="txtinq_advancepayment2" style="text-align: right;" class="numonly amount form-control text_inquiry " placeholder="0.00" />
                                              <h6 style="font-size:10px; font-style: italic;">(Please settle the amount in the cashiering)</h6>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-xs-12 col-md-4">
                                      <div class="row form-group" id="paymenttypeinformation" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 10px;display: none;">
                                        <div class="row form-group paymenttypeinformationcord" style="display: none;">
                                          <div class="col-md-12">
                                            <div class="col-xs-4 col-md-4">
                                              Card Type
                                            </div>
                                            <div class="col-xs-8 col-md-8">
                                              <input type="text" class="form-control" placeholder="Card Type" readonly id="viewinquirycardtype">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group paymenttypeinformationcord" style="display: none;">
                                          <div class="col-xs-12 col-md-12">
                                            <div class="col-xs-4 col-md-4">
                                              CC No.
                                            </div>
                                            <div class="col-xs-2 col-md-2">
                                              <input type="password" class="form-control numonly" maxlength="4" placeholder="****" readonly id="viewinquirycc1">
                                            </div>
                                            <div class="col-xs-2 col-md-2">
                                              <input type="password" class="form-control numonly" maxlength="4" placeholder="****" readonly id="viewinquirycc2">
                                            </div>
                                            <div class="col-xs-2 col-md-2">
                                              <input type="password" class="form-control numonly" maxlength="4" placeholder="****" readonly id="viewinquirycc3">
                                            </div>
                                            <div class="col-xs-2 col-md-2">
                                              <input type="text" class="form-control numonly" maxlength="4" placeholder="0000" readonly id="viewinquirycc4">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group paymenttypeinformationcord" style="display: none;">
                                          <div class="col-md-12">
                                            <div class="col-xs-4 col-md-4">
                                              Expiry Date
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                              <input type="text" class="form-control" placeholder="MM" readonly id="viewinquirymm">
                                            </div>
                                            <div class="col-xs-4 col-md-4">
                                              <input type="text" class="form-control" placeholder="YY" readonly id="viewinquiryyy">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group paymenttypeinformationbtob" style="display: none;">
                                          <div class="col-xs-6 col-md-6">
                                            <div class="col-xs-4 col-md-4">
                                              Bank From
                                            </div>
                                            <div class="col-xs-8 col-md-8">
                                              <input type="text" class="form-control" id="viewinquirybf" placeholder="Bank From" readonly>
                                            </div>
                                          </div>
                                          <div class="col-xs-6 col-md-6">
                                            <div class="col-xs-4 col-md-4">
                                              Acc No.
                                            </div>
                                            <div class="col-xs-8 col-md-8">
                                              <input type="text" class="form-control" id="viewinquirybf_acc" placeholder="Account Number" readonly>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group paymenttypeinformationbtob" style="display: none;">
                                          <div class="col-xs-6 col-md-6">
                                            <div class="col-xs-4 col-md-4">
                                              Bank To
                                            </div>
                                            <div class="col-xs-8 col-md-8">
                                              <input type="text" class="form-control" id="viewinquirybt" placeholder="Bank To" readonly>
                                            </div>
                                          </div>
                                          <div class="col-xs-6 col-md-6">
                                            <div class="col-xs-4 col-md-4">
                                              Acc No.
                                            </div>
                                            <div class="col-xs-8 col-md-8">
                                              <input type="text" class="form-control" id="viewinquirybt_acc" placeholder="Account Number" readonly>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                      <div class="col-md-12 col-xs-12" id="div_amenities_inquiry"></div>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-md-12">
                                      <div class="row form-group">
                                        <div class="col-xs-12 col-md-8">
                                          <h4 class="green smaller lighter">Payment Schedule</h4>
                                          <h6 class="blue smaller lighter" id="txtclick2"><i class="fa fa-check orange"></i> Select months that will have advance payment</h6>
                                        </div>
                                      </div>
                                      <div class="row form-group">
                                        <div class="col-md-12 col-xs-12">
                                          <div class="parent3">
                                            <table class="table table-striped table-bordered fixTable">
                                              <thead>
                                                <tr style="display: none;" id="checkheaderto">
                                                  <th width="10%" class="center"><span class="fa fa-money" style="font-size: 18px;"></span></th>
                                                  <th>Date of Payment</th>
                                                  <th style="text-align: right;">Amount Due</th>
                                                  <th style="text-align: right;">Association Due</th>
                                                  <th style="text-align: right;">Total Due</th>
                                                  <th style="text-align: right;">Advance Payment</th>
                                                  <th style="text-align: center;">Bank</th>
                                                  <th style="text-align: right;">Check Number</th>
                                                  <th>PDC Date</th>
                                                </tr>
                                                <tr style="display: none;" id="cashheaderto">
                                                  <td width="10%" class="center"><span class="fa fa-money" style="font-size: 18px;"></span></td>
                                                  <td>Date of Payment</td>
                                                  <th style="text-align: right;">Amount Due</th>
                                                  <th style="text-align: right;">Association Due</th>
                                                  <th style="text-align: right;">Total Due</th>
                                                  <td style="text-align: right;">Advance Payment</td>
                                                </tr>
                                              </thead>
                                              <tbody id="tbodypdc_inquiry"></tbody>
                                              <script type="text/javascript">
                                                $(function(){
                                                    var date = new Date();
                                                    date.setDate(date.getDate() - 0);
                                                    $('.kevin-date-picker').datepicker({
                                                        autoclose: true,
                                                        todayHighlight: true,
                                                        format: 'mm/dd/yyyy',
                                                        startDate: date
                                                    });
                                                });
                                            </script>
                                            </table>
                                          </div>
                                          <div class="col-md-12 col-xs-12">
                                            <div class="hr hr8 hr-double hr-dotted"></div>
                                            <div class="row">
                                              <div class="col-sm-12 pull-right">
                                                <h4 class="pull-right">
                                                  Total Amount:
                                                  <span class="red" id="lbltotalamountofpayment">Php 0.00</span>
                                                </h4>
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

                        <div id="contactperson" class="tab-pane fade">
                          <div class="row form-group" id="div_res_3">
                            <div class="col-md-6 col-xs-6">
                              <div class="well">
                                <div class="row form-group">
                                  <div class="col-xs-12 col-md-12">
                                    <div class="row form-group">
                                      <h4 class="green smaller lighter">Contact Persons</h4>
                                    </div>
                                    <div class="row form-group">
                                      <div class="col-xs-12 col-md-12" style="display: inline-block; height: 475px;overflow-y: scroll;" id="div_inquiry_contact_person"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-xs-6" id="div_modal_inquiry_remarks">
                              <div class="well">
                                <div class="row form-group" style="margin-bottom: 0px;">
                                  <div class="col-md-8 col-xs-12">
                                    <h4 class="green smaller lighter">Remarks</h4>
                                  </div>
                                  <div class="col-md-4 col-xs-12" style="padding-right: 17px;">
                                    <button class="btn btn-xs btn-info" style="float: right;" id="btnaddnewreeeeem" onclick="addnewremarks()"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;Add New Remarks</button>
                                  </div>
                                </div>
                                <div class="row form-group" style="display:block; height:500px;overflow-y:scroll;">
                                  <div class="col-md-12 col-xs-12">
                                      <ol class="dd-list" id="remarkslist_ol"></ol>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div id="remarks" class="tab-pane fade">
                          <div class="row form-group" id="div_res_4">
                            <div class="col-md-6 col-xs-12" >
                              <div class="well">
                                <div class="row form-group">
                                  <div class="col-xs-12">
                                    <h4 class="green smaller lighter">Requirements</h4>
                                  </div>
                                </div>
                                <div class="row form-group">
                                  <div class="col-xs-12" style="display: block;height: 500px;" id="div_modal_inquiry_requirements">
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
                            <div class="col-md-6 col-xs-12">
                              <div class="well">
                                <div class="row form-group">
                                  <div class="col-xs-9 col-md-9">
                                    <h4 class="green smaller lighter">Payment Status</h4>
                                  </div>
                                  <div class="col-xs-3 col-md-3">
                                    <button class="btn btn-xs btn-primary btn-block" onclick="showpaymentlist();">Browse Payment</button>
                                  </div>
                                </div>
                                <div class="row form-group" style="display: block;height: 500px;">
                                  <div class="row form-group">
                                    <div class="col-xs-4 col-md-4"></div>
                                    <div class="col-xs-4 col-md-4" style="text-align: right;margin-top: 10px;">
                                      Reservation Status :
                                    </div>
                                    <div class="col-xs-4 col-md-4">
                                      <input type="text" class="form-control required_reservation" readonly id="reservation_stat_select">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-xs-12 col-md-12">
                                      <h4 class="green smaller lighter">Payment List</h4>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                      <div class="parent2">
                                        <table class="table table-striped table-bordered fixTable">
                                          <thead>
                                            <tr>
                                              <td>Date of Payment</td>
                                              <td>Description</td>
                                              <td>O.R No.</td>
                                              <td>Payment Type</td>
                                              <td>Total Amount</td>
                                            </tr>
                                          </thead>
                                          <tbody id="tblreservationpaymentlist"></tbody>
                                        </table>
                                      </div>
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
                                      <button class='btn btn-xs btn-primary pull-right' onclick='modal_tnccheckbox()' title='Add Terms and Conditions'>Browse Terms and Conditions</button>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col-xs-12">
                                    <div class="parent">
                                      <table id="simple-table" class="table  table-striped table-hover fixTable">
                                        <thead>
                                            <tr>
                                                <td width="15%">Term Name</td>
                                                <td>Condition</td>
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
         <input type="hidden" id="invi">
        <div class="row form-group" style="margin-bottom: 0px;">
          <div class="col-md-3">
            <label class="updatedby_texts" style="float: left;">
              <small class="text-info pull-left">
                <b>Approved by:</b>&nbsp;<i id="txtapp_createdby"></i>
              </small><br />
              <small class="text-info pull-left">
                <b>Date Approved:</b>&nbsp;<i id="txtapp_datecreated"></i>
              </small>
            </label>
          </div>
          <div class="col-md-3" style="padding-top: 5px;">
            <label class="updatedby_texts" style="float: left;">
              <small class="text-success pull-left">
                <b>Created by:</b>&nbsp;<i id="txtapp_createdby2"></i>
              </small><br />
              <small class="text-success pull-left">
                <b>Date Created:</b>&nbsp;<i id="txtapp_datecreated2"></i>
              </small>
            </label>
          </div>
          <div class="col-md-3 pull-left" style="padding-top: 5px;">
            <label class="updatedby_texts">
              <small class="text-success pull-left">
                <b>Modified by:</b>&nbsp;<i id="txtapp_modifby"></i>
              </small><br />
              <small class="text-success pull-left">
                <b>Last Modified:</b>&nbsp;<i id="txtapp_modifdate"></i>
              </small>
            </label>
          </div>
          <div class="col-md-3">
            <button type="button" style="display: none;" class="btn btn-info" id="btn_savereservation_print" onclick="printcontract()"><i class="ace-icon fa fa-check" ></i>&nbsp;<label id="">Print Contract</label></button>
            <button type="button" class="btn btn-primary" id="btn_savereservation" onclick="savereservationform()"><i class="ace-icon fa fa-check"></i>&nbsp;<label id="">Update</label></button>
            <button type="button" class="btn btn-yellow" id="btn_savereservation_occupy" onclick="occupyunit()"><i class="ace-icon fa fa-check"></i>&nbsp;<label id="">Occupy Unit</label></button>
            <button type="button" class="btn btn-yellow" id="btn_savereservation_reinstate" onclick=""><i class="ace-icon fa fa-refresh"></i>&nbsp;<label id="">Reinstate</label></button>
            <button type="button" class="btn btn-danger" id="btn_savereservation_cancel" onclick=""><i class="ace-icon fa fa-calendar-times-o"></i>&nbsp;<label id="">Cancel Reservation</label></button>
            <!-- <button type="button" class="btn btn-primary" id="btn_saveinquiry" onclick=""><i class="ace-icon fa fa-check"></i>&nbsp;<label id="btntext_inq">For Approval</label></button>
            <button type="button" class="btn btn-danger" id="btn_disapprove" style="display: none;" onclick=""><i class="ace-icon fa fa-times"></i>&nbsp;<label id="">Disapprove</label></button> -->
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

<input type="hidden" id="paymenttypeinfo">
<div class="modal fade" tabindex="-1" id="modalforinputofdetails" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-info ">
        <div class="modal-content">
            <div class="modal-header"><label id="modalforinputofdetailsheader"></label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearcardinfomodal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div class="row form-group ptinfocheck" style="display: none;">
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Check No.
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <input type="text" class="form-control" id="ptinfocheckno">
                  </div>
                </div>
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Check Date
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <input type="text" class="form-control kev-date-picker" id="ptinfocheckdate">
                  </div>
                </div>
              </div>
              <div class="row form-group ptinfocheck" style="display: none;">
                <div class="col-xs-6 col-md-6">
                    <div class="col-xs-4 col-md-4">
                      Check Name
                    </div>
                    <div class="col-xs-8 col-md-8">
                      <input type="text" class="form-control" id="ptinfocheckname">
                    </div>
                </div>
                <div class="col-xs-6 col-md-6">
                    <div class="col-xs-4 col-md-4">
                      Bank Name
                    </div>
                    <div class="col-xs-8 col-md-8">
                      <input type="text" class="form-control" id="ptinfobankname">
                    </div>
                </div>
              </div>

              <div class="row form-group ptinfocordcard">
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Card Type
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <select class="form-control" id="ptinfocardtype">
                      <?php 
                        echo "<option value=''>-- Select Card --</option>";
                        $res = mysql_query("SELECT CardType FROM tblref_cardtype", $connection);
                        while($row = mysql_fetch_array($res)){
                          echo "<option value=".$row[0].">".$row[0]."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Card Holder
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <input type="text" class="form-control" id="ptinfocardholder">
                  </div>
                </div>
              </div>
              <div class="row form-group ptinfocordcard">
                <div class="col-xs-6 col-md-t6">
                  <div class="col-xs-4 col-md-4">
                    Authorization No.
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <input type="text" class="form-control" id="ptinfoauthno">
                  </div>
                </div>
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Security Code
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <input type="text" class="form-control" id="ptinfosecuritycode">
                  </div>
                </div>
              </div>
              <div class="row form-group ptinfocordcard">
                <div class="col-xs-12 col-md-12">
                  <div class="col-xs-2 col-md-2">
                    CC No.
                  </div>
                  <div class="col-xs-2 col-md-2">
                    <input type="password" class="form-control numonly" maxlength="4" id="ptinfoccno1">
                  </div>
                  <div class="col-xs-2 col-md-2">
                    <input type="password" class="form-control numonly" maxlength="4" id="ptinfoccno2">
                  </div>
                  <div class="col-xs-2 col-md-2">
                    <input type="password" class="form-control numonly" maxlength="4" id="ptinfoccno3">
                  </div>
                  <div class="col-xs-2 col-md-2">
                    <input type="text" class="form-control numonly" maxlength="4" id="ptinfoccno4">
                  </div>
                </div>
              </div>
              <div class="row form-group ptinfocordcard">
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Expiry Date
                  </div>
                  <div class="col-xs-4 col-md-4">
                    <select class="form-control" id="ptinfoexpirymonth">
                      <option selected disabled value="">MM</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                  </div>
                  <div class="col-xs-4 col-md-4">
                    <select class="form-control" id="ptinfoexpiryyear">
                      <option selected disabled value="">YY</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row form-group ptinfobanktransfer">
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Bank From
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <select class="form-control bankref" id="ptinfobankfrom">
                      <?php 
                        echo "<option value=''>-- Select Bank --</option>";
                        $res = mysql_query("SELECT description FROM tblrefbank", $connection);
                        while($row = mysql_fetch_array($res)){
                          echo "<option value=".$row[0].">".$row[0]."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Acc No.
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <input type="text" class="form-control" id="ptinfobf_accno">
                  </div>
                </div>
              </div>
              <div class="row form-group ptinfobanktransfer">
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Bank To
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <select class="form-control bankref" id="ptinfobankto">
                      <?php 
                        echo "<option value=''>-- Select Bank --</option>";
                        $res = mysql_query("SELECT description FROM tblrefbank", $connection);
                        while($row = mysql_fetch_array($res)){
                          echo "<option value=".$row[0].">".$row[0]."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-xs-6 col-md-6">
                  <div class="col-xs-4 col-md-4">
                    Acc No.
                  </div>
                  <div class="col-xs-8 col-md-8">
                    <input type="text" class="form-control" id="ptinfobt_accno">
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-md btn-primary" id="btnsavepaymenttypeinfo" onclick="savepaymenttypeinfo()">Save</button>
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
         format: 'mm/dd/yyyy',
          startDate: date
});

$(function(){
  $("#status_filled").val("0");
  loadnotifications();

  $("#txtinq_mallbranch").focusout(function(){
    var mallid = $(this).val();
    if(mallid == undefined)
    {
      $(this).val("");
    }
  });

  $(".required_reservation").keyup(function(){
    $("#status_filled").val("1");
  })

  $(".required_reservation").change(function(){
    $("#status_filled").val("1");
  });
});

function chkduplicatedchknum()
{
     var e = 0;
     var chk = "";
     var bankname = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td .txtchnummmm");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td .txtchnummmm").val();
        var bnk = $(this).find("td .bnk").val();
        chk +=  "|"+num;
        bankname +=  "|"+bnk;

      });

     var dup = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td .txtchnummmm");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td .txtchnummmm").val();
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
        var num = $(this).find("td .txtchnummmm").val();
        var thischk = $(this).find("td .txtchnummmm");
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
        var num = $(this).find("td .txtchnummmm").val();
        var thischk = $(this).find("td .txtchnummmm");
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

function closeinquirymodal()
{
  var stat = $("#status_filled").val();
  if(stat == "1")
  {
    showmodal("confirm", "Are you sure you want to discard changes?", "executefunc(\"continue\")", null, "executefunc(\"cancel\")", null, "0");
  }
  else
  {
    $("#modal_previewleasingapplication").modal("hide");
    $("#nakacheck").val("");
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
    $("#modal_previewleasingapplication").modal("hide");
  }
}

function txtchklcaunitval()
{
  var lca = $("#txtinq_lca_unitname").val();
  if(lca != "")
  {
    $("#txtinq_datefrom").prop("disabled", false);
    $("#txtnoofmonths_inq").prop("disabled", false);
    $("#txtinq_monthlyadvamt").prop("disabled", true); //autofill
    $("#txtinq_advancepayment").prop("disabled", true); //autofill
    $("#txtinq_monthlydepamt").prop("disabled", false);
    $("#txtinq_depositpayment").prop("disabled", true); //autofill
    // $("#txtinq_monthlyrate2").prop("disabled", true); //autofill
    $("#txtinq_pymentterms").prop("disabled", false);
    $("#txtinq_pymenttype").prop("disabled", false);

    $("#txtinq_dateto").prop("disabled", true); //autofill
    $("#txtnoofdays_inq").prop("disabled", false);
    $("#txtinq_advancepayment2").prop("disabled", false);
    $("#txtinq_depositpayment2").prop("disabled", false);
    $("#txtinq_sqm_width").prop("disabled", true); //autofill
    $("#txtinq_sqm_length").prop("disabled", true); //autofill
    $("#txtinq_persqm").prop("disabled", true); //autofill
    $("#txtinq_totalsqm").prop("disabled", true); //autofill
  }
  else
  {
    $("#txtinq_datefrom").prop("disabled", true);
    $("#txtnoofmonths_inq").prop("disabled", true);
    $("#txtinq_monthlyadvamt").prop("disabled", true);
    $("#txtinq_advancepayment").prop("disabled", true);
    $("#txtinq_monthlydepamt").prop("disabled", true);
    $("#txtinq_depositpayment").prop("disabled", true);
    // $("#txtinq_monthlyrate2").prop("disabled", true);

    $("#txtinq_dateto").prop("disabled", true);
    $("#txtnoofdays_inq").prop("disabled", true);
    $("#txtinq_advancepayment2").prop("disabled", true);
    $("#txtinq_depositpayment2").prop("disabled", true);
    $("#txtinq_sqm_width").prop("disabled", true);
    $("#txtinq_sqm_length").prop("disabled", true);
    $("#txtinq_persqm").prop("disabled", true);
    $("#txtinq_totalsqm").prop("disabled", true);
    $("#txtinq_pymentterms").prop("disabled", true);
    $("#txtinq_pymenttype").prop("disabled", true);

    $("#txtinq_dateto").val("");
    $("#txtnoofmonths_inq").val("");
    $("#txtinq_monthlyadvamt").val("");
    $("#txtinq_advancepayment").val("");
    $("#txtinq_monthlydepamt").val("");
    $("#txtinq_depositpayment").val("");
    // $("#txtinq_monthlyrate2").val("");
    $("#txtinq_sqm").val("");
    $("#txtinq_persqm").val("");
    $("#txtinq_totalsqm").val("");
    $("#txtnoofdays_inq").val("");
    $("#txtinq_sqm_width").val("");
    $("#txtinq_sqm_length").val("");
    $("#txtinq_advancepayment2").val("");
    $("#txtinq_depositpayment2").val("");
    $("#txtinq_pymentterms").val("");
    $("#txtinq_pymenttype").val("");
  }
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
  // $("#txtinq_monthlyrate2").val("");
  $("#txtinq_sqm").val("");
  $("#txtinq_persqm").val("");
  $("#txtinq_totalsqm").val("");
  $("#div_amenities_inquiry").html("");
  $("#lbltotalamountofpayment").text("Php 0.00");
  // $("#totalpayment").text("Php 0.00");
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
  // $("#txtinq_monthlyrate2").prop("disabled", true);

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

function chkunitfrst()
{
  // var unit = $("#txtinq_unitunit").val();
  // var datefrom = $("#txtinq_datefrom").val();
  // var dateto = $("#txtinq_dateto").val();
  // if($("#radio_set").is(":checked"))
  // {
  //   var type = "SET";
  // }
  // else if($("#radio_lca").is(":checked"))
  // {
  //   var type = "LCA";
  // }

  // if(type == "SET")
  // {
  //   $.ajax({
  //     type: 'POST',
  //     url: 'mainclass.php',
  //     data: 'unit=' + unit + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=chkunitfrst',
  //     success: function(data)
  //     {
  //       if(data != "")
  //       {
  //         $("#statinquiryyy").val("invalid");
  //         alert(data);
  //         showmodal("alert", data, "", null, "", null, "1");
  //         $("#txtinq_unitunit").css("border-color", "red");
  //         $("#txtnoofmonths_inq").css("border-color", "red");
  //         $("#txtinq_datefrom").css("border-color", "red");
  //       }
  //       else
  //       {
  //         $("#statinquiryyy").val("valid");
  //         $("#txtinq_unitunit").css("border-color", "#CCC");
  //         $("#txtnoofmonths_inq").css("border-color", "#CCC");
  //         $("#txtinq_datefrom").css("border-color", "#CCC");
  //       }
  //       return false;
  //     }
  //   })
  // }
}

function chkbilltype()
{
  var type = $("#txttenanttype").val();
  var stat = $("#reservation_stat_select").val();
  if(type == "Rent")
  {
    $("#txttenanttypepercent2").css("display", "none");
    $("#txttenanttypepercent").removeClass("required_reservation");
  }
  else
  {
    $("#txttenanttypepercent2").css("display", "block");
    $("#txttenanttypepercent").removeClass("required_reservation");
    if(stat == "Confirmed")
    {
      $("#txttenanttypepercent").addClass("required_reservation");
    }

  }
}


function unitareachk()
{
  var wid = $("#txtinq_sqm_width").val();
  var len = $("#txtinq_sqm_length").val();
  var amount = $("#txtinq_persqm").val();
  var ttl = (parseInt(wid || 0) * parseInt(len || 0)) * parseInt(amount || 0);

  // $("#txtinq_monthlyrate2").val((ttl).toFixed(2));
  $("#txtinq_totalsqm").val((ttl).toFixed(2));
  loaddatetofunction();
}

function clicklca()
{
      var sstat = $("#status_todo").val();
      $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction(\""+sstat+"\");");
      $("#txtinq_unitclass").val("");
      $("#div_wing").css("display","block");
      $("#div_floor").css("display","block");
      $("#div_unit").css("display","block");
      $("#txtinq_unitcategory").attr("onchange", "loadinquiry_unit_lca()");
      $("#txtinq_unitwing").val("");
      $("#txtinq_unitfloor").val("");
      $("#txtinq_unitunit").val("");
      $("#div_nomonths").css("display", "block");
      $("#div_nodays").css("display", "block");
      $("#txtinq_sqm").prop("disabled", false);
      $("#txtinq_persqm").prop("disabled", false);
      $("#txtinq_totalsqm").prop("disabled", false);
      loadinquiry_unit_lca();
      loadinquiry_wing_lca();
      $("#txtinq_unitcategory").attr("onclick", "loadinquiry_wing_lca()");
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
      $("#txtinq_totalmonthlydues").val("");
      // $("#txtinq_monthlyrate2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#div_amenities_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      // $("#totalpayment").text("Php 0.00");
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
      $("#txtinq_lca_unitname").prop("disabled", false);
      $("#txtinq_sqm_width").prop("disabled", false);
      $("#txtinq_sqm_length").prop("disabled", false);
      $("#div_advance_set").css("display", "none");
      $("#div_deposit_set").css("display", "none");
      $("#div_advance_set_amt").css("display", "block");
      $("#div_deposit_set_amt").css("display", "block");
      $("#txtinq_unitdepartment").val("");
      $("#txtinq_unitcategory").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtinq_monthlyadvamt").val("");
      // $("#txtinq_monthlyrate2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#txtinq_lca_unitname").removeClass("required_reservation");
      $("#txtnoofdays_inq").removeClass("required_reservation");
      $("#txtinq_sqm_width").removeClass("required_reservation");
      $("#txtinq_sqm_length").removeClass("required_reservation");
      $("#txtinq_persqm").removeClass("required_reservation");
      $("#txtinq_totalsqm").removeClass("required_reservation");
      $("#txtinq_lca_unitname").addClass("required_reservation");
      $("#txtnoofdays_inq").addClass("required_reservation");
      $("#txtinq_sqm_width").addClass("required_reservation");
      $("#txtinq_sqm_length").addClass("required_reservation");
      $("#txtinq_persqm").addClass("required_reservation");
      $("#txtinq_totalsqm").addClass("required_reservation");
      $("#txtinq_unitunit").removeClass("required_reservation");
      $("#txtinq_sqm").removeClass("required_reservation");

      $("#txtinq_datefrom").prop("disabled", true);
      $("#txtnoofmonths_inq").prop("disabled", true);
      $("#txtinq_monthlyadvamt").prop("disabled", true);
      $("#txtinq_advancepayment").prop("disabled", true);
      $("#txtinq_monthlydepamt").prop("disabled", true);
      $("#txtinq_depositpayment").prop("disabled", true);
      // $("#txtinq_monthlyrate2").prop("disabled", true);

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
      $("#totalpayment").text("Php 0.00");
      $("#txtinq_assocdues").val("");
      $("#txtmonthlymath").val("");
      $("#txtmonthlymathdays").val("");
      $("#txtmonthlymathdays").prop("disabled", true);
      paymentterms_LCA();
}

function clickset()
{
      var sstat = $("#status_todo").val();
      $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction(\""+sstat+"\");");
      $("#txtinq_unitclass").val("");
      $("#div_wing").css("display","block");
      $("#div_floor").css("display","block");
      $("#div_unit").css("display","block");
      $("#txtinq_unitcategory").attr("onchange", "loadinquiry_wing();loadinquiry_wing_lca();");
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
      // $("#txtinq_monthlyrate2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#div_amenities_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#totalpayment").text("Php 0.00");
      // $("#totalpayment").text("Php 0.00");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_monthlydepamt").val("");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_depositpayment").val("");
      $("#txtmonthlymath").val("");
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
      $("#txtinq_unitunit").removeClass("required_reservation");
      $("#txtnoofmonths_inq").removeClass("required_reservation");
      $("#txtinq_sqm").removeClass("required_reservation");
      $("#txtinq_persqm").removeClass("required_reservation");
      $("#txtinq_totalsqm").removeClass("required_reservation");
      $("#txtinq_unitunit").addClass("required_reservation");
      $("#txtnoofmonths_inq").addClass("required_reservation");
      $("#txtinq_sqm").addClass("required_reservation");
      $("#txtinq_persqm").addClass("required_reservation");
      $("#txtinq_totalsqm").addClass("required_reservation");
      $("#txtinq_lca_unitname").removeClass("required_reservation");
      $("#txtnoofdays_inq").removeClass("required_reservation");
      $("#txtinq_sqm_width").removeClass("required_reservation");
      $("#txtinq_sqm_length").removeClass("required_reservation");

      $("#txtinq_datefrom").prop("disabled", true);
      $("#txtnoofmonths_inq").prop("disabled", true);
      $("#txtinq_monthlyadvamt").prop("disabled", true);
      $("#txtinq_advancepayment").prop("disabled", true);
      $("#txtinq_monthlydepamt").prop("disabled", true);
      $("#txtinq_depositpayment").prop("disabled", true);
      // $("#txtinq_monthlyrate2").prop("disabled", true);

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
      paymentterms_SET();
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

function loaddatetofunction(stat)
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
            loaddatetofunction3(arr[1])
            loaddatetofunction2(arr[1], stat);

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
      txtchklcaunitval()
    }
  })
}

function selected_lca_unit()
{
  var txtinq_mallbranch = $("#txtinq_mallbranch").val();
  var unit_id =  $("#txtinq_lca_unitname").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unit_id=' + unit_id + '&mallid=' + txtinq_mallbranch + '&form=selected_unit_lca',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_sqm_width").val(arr[0])
      $("#txtinq_sqm_length").val(arr[1])
      $("#txtinq_persqm").val(arr[2])
      $("#txtinq_totalsqm").val(arr[3]);
      $("#txtinq_assocdues").val(arr[4]);
      $("#txtinq_totalmonthlydues").val(arr[5]);
      $("#txtmonthlymath").val(arr[3]);
      // $("#txtinq_monthlyrate2").val(arr[3]);
      if(arr[4] == "0.00"){
        $("#chkassocdues").prop("checked", false);
      }else{
        $("#chkassocdues").prop("checked", true);
      }
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

function checkvalueofstat(Application_ID, Inquiry_ID, stat)
{
    if(stat == "Confirmed"){
      $("#tbodypdc_inquiry tr td .txtchnummmm").each(function(){
        $(this).prop("disabled", false);
        $(this).addClass("required_reservation");
        $(this).closest('td').attr('onclick','');
      });
      $("#tbodypdc_inquiry tr td .bnk").each(function(){
        $(this).prop("disabled", false);
        $(this).addClass("required_reservation");
        $(this).closest('td').attr('onclick','');
      });

      $("#btn_savereservation").attr("onclick", "loadcontractagreement()");
      $("#btn_savereservation").attr("onclick", "savereservationform(\""+Application_ID+"\", \""+Inquiry_ID+"\")");
      $("#txttenanttype").addClass("required_reservation");
      $("#txtmerchantcode").addClass("required_reservation");
    }else{
      $("#tbodypdc_inquiry tr td .txtchnummmm").each(function(){
        $(this).prop("disabled", true);
        $(this).removeClass("required_reservation");
        $("#txttenanttype").removeClass("required_reservation");
        $("#txtmerchantcode").removeClass("required_reservation");
        $(this).closest('td').attr('onclick', 'chkadvpaymnt($(this))');
      });

      $("#tbodypdc_inquiry tr td .bnk").each(function(){
        $(this).prop("disabled", true);
        $(this).removeClass("required_reservation");
        $(this).closest('td').attr('onclick', 'chkadvpaymnt($(this))');
      });
    }
    chkbilltype();
}

function occupyunit(Application_ID, Inquiry_ID){
  showmodal("confirm", "This action cannot be undone, do you want to proceed?", "occupyunit2(\""+Application_ID+"\",\""+Inquiry_ID+"\")", null, "", null, "1");
}

function occupyunit2(Application_ID, Inquiry_ID){
  $("#alertmodal").modal("hide");
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'Application_ID=' + Application_ID + '&Inquiry_ID=' + Inquiry_ID + '&form=occupyunitrightnow',
    beforeSend : function() {
      $('#reservationloadingscreen').addClass('myspinner');
    },
    success: function(data)
    {
      $('#reservationloadingscreen').removeClass('myspinner');
      loadreservationlist();
      loadnotifications();
      $("#modal_previewleasingapplication").modal("hide");
    }
  })
}


function loaddatetofunction2(dateto, stat)
{
  var months = $("#txtnoofmonths_inq").val();
  var days = $("#txtnoofdays_inq").val();
  var datefrom = $("#txtinq_datefrom").val();
  var ttlamnt = ($("#txtinq_totalsqm").val()).replace(",", "");
  var status = $("#reservation_stat_select").val();
  var datesel = $("#txtselected_month").val();
  var typeaction = $("#status_todo").val();
  var pymntterms = $("#txtinq_pymentterms").val();
  var paymenttype = $("#txtinq_pymenttype").val();
  if($("#radio_set").is(":checked"))
  {
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var type = "LCA";
  }
  var inqid = $("#txtresidreq").val();
  var unit_id = $("#txtinq_unitunit").val();
  var radassocdues = "";
  $(".radassocdues").each(function(){
    if ( $(this).is(":checked") == true ) {
      radassocdues = this.value;
    }
  });
  if(datefrom != "")
  {
    // if(stat == "change_status")
    // {
      $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&amt=' + ttlamnt + '&ttlamnt=' + ttlamnt + '&inqid=' + inqid + '&pymntterms=' + pymntterms + '&paymenttype=' + paymenttype + '&radassocdues=' + radassocdues + '&form=loadtbodypdc_inquiry4',
        beforeSend : function() {
         $('#reservationloadingscreen').addClass('myspinner');
        },
        success: function(data)
        {
          $('#reservationloadingscreen').removeClass('myspinner');
          var arr = data.split("|");
          $("#tbodypdc_inquiry").html(arr[0]);
          // $("#txtclick2").text("Click the selected month/day to apply advance payment");
          if(arr[2] != ""){
            $("#tbodypdc_inquiry tr td .txtchnummmm").each(function(){
              $(this).prop("disabled", false);
              $(this).addClass("required_reservation");
              $(this).closest('td').attr('onclick','');
            });
            $("#tbodypdc_inquiry tr td .bnk").each(function(){
              $(this).prop("disabled", false);
              $(this).addClass("required_reservation");
              $(this).closest('td').attr('onclick','');
            });

            $("#btn_savereservation").attr("onclick", "loadcontractagreement()");
            $("#btn_savereservation").attr("onclick", "savereservationform(\""+arr[1]+"\", \""+inqid+"\")");
            $("#txttenanttype").addClass("required_reservation");
            $("#txtmerchantcode").addClass("required_reservation");
          }else{
            $("#tbodypdc_inquiry tr td .txtchnummmm").each(function(){
              $(this).prop("disabled", true);
              $(this).removeClass("required_reservation");
              $("#txttenanttype").removeClass("required_reservation");
              $("#txtmerchantcode").removeClass("required_reservation");
              $(this).closest('td').attr('onclick', 'chkadvpaymnt($(this))');
            });

            $("#tbodypdc_inquiry tr td .bnk").each(function(){
              $(this).prop("disabled", true);
              $(this).removeClass("required_reservation");
              $(this).closest('td').attr('onclick', 'chkadvpaymnt($(this))');
            });
          }
          // $(".chk_advpyment").each(function(){
          //     $(this).change(function(){
          //         var chkid = this.value;
          //         if($(this).is(":checked")){
          //             $("#"+chkid+"pdc").prop("disabled", false);
          //         }else{
          //             $("#"+chkid+"pdc").prop("disabled", true);
          //         }

          //         var date = new Date();
          //         date.setDate(date.getDate());
          //         $('.kevin-date-picker').each(function(){
          //             $(this).datepicker({
          //                 autoclose: true,
          //                 todayHighlight: true,
          //                 format: 'mm/dd/yyyy',
          //                 startDate: date
          //             });
          //         });
          //     });
          // });

          $("#tbodypdc_inquiry tr").each(function(){
             $(this).click(function(){
                 var chkbox = $(this).find(".chk_advpyment");
                 var amnt = $(this).find(".lblamntsetup");
                 var txtadvc = $(this).find(".txtadvpyment");
                 var lbladvc = $(this).find(".lbladvpyment");
                 if(chkbox.is(":checked"))
                 {
                   txtadvc.css("display", "block");
                   if(pymntterms == "monthly"  || pymntterms == "daily")
                   {
                     txtadvc.val(amnt.text());
                     lbladvc.text(amnt.text());
                     txtadvc.prop("disabled", true);
                     lbladvc.css("display", "none");
                     $(this).removeClass("unselected");
                     $(this).addClass("selected");
                     txtadvc.attr("onkeyup", "");
                   }
                   else
                   {
                     txtadvc.val("");
                     txtadvc.attr("onkeyup", "countallselectedmonth()");
                     lbladvc.text("0.00");
                     txtadvc.prop("disabled", false);
                     lbladvc.css("display", "none");
                     txtadvc.focus();
                     $(this).removeClass("unselected");
                     $(this).addClass("selected");
                   }
                   countallselectedmonth();
                 }
                 else
                 {
                   txtadvc.attr("onkeyup", "");
                   txtadvc.css("display", "none");
                   txtadvc.prop("disabled", true);
                   lbladvc.text("0.00");
                   lbladvc.css("display", "block");
                   txtadvc.val("");
                   countallselectedmonth();
                   $(this).removeClass("selected");
                   $(this).addClass("unselected");
                 }
             });
          });

          numonly();
          var getdate = datesel.split("#");
          for(var i = 0; i<=getdate.length-2; i++)
          {
              var getdate2 = getdate[i].split("P");
              $("#tbodypdc_inquiry").find("tr[id='"+getdate2[0]+"']").removeClass('unselected');
              $("#tbodypdc_inquiry").find("tr[id='"+getdate2[0]+"']").addClass('selected');
              var thistr = $("#tbodypdc_inquiry").find("tr[id=\""+getdate2[0]+"\"]");
              thistr.find(".chk_advpyment").prop("checked", true);
              var chkbox = thistr.find(".chk_advpyment");
              var amnt = thistr.find(".lblamntsetup");
              var txtadvc = thistr.find(".txtadvpyment");
              var lbladvc = thistr.find(".lbladvpyment");
              if(chkbox.is(":checked"))
              {
                txtadvc.css("display", "block");
                if(pymntterms == "monthly")
                {
                  txtadvc.val(getdate2[1]);
                  lbladvc.text(getdate2[1]);
                  txtadvc.prop("disabled", true);
                  lbladvc.css("display", "none");
                  thistr.removeClass("unselected");
                  thistr.addClass("selected");
                  txtadvc.attr("onkeyup", "");
                }
                else
                {
                  txtadvc.val(getdate2[1]);
                  txtadvc.attr("onkeyup", "countallselectedmonth()");
                  lbladvc.text("0.00");
                  txtadvc.prop("disabled", true);
                  lbladvc.css("display", "none");
                  txtadvc.focus();
                  thistr.removeClass("unselected");
                  thistr.addClass("selected");
                }
                countallselectedmonth();
              }
              else
              {
                txtadvc.attr("onkeyup", "");
                txtadvc.css("display", "none");
                txtadvc.prop("disabled", true);
                lbladvc.text("0.00");
                lbladvc.css("display", "block");
                txtadvc.val("");
                countallselectedmonth();
                thistr.removeClass("selected");
                thistr.addClass("unselected");
              }
          }

          $("#tdcolumnpdscheckd").show();
          numonly();
          chkduplicatedchknum();
        }
      })

  }
}

function chkadvpaymnt(eto)
{
   var i = 0;
   var num = parseInt($("#txtinq_monthlyadvamt").val());
   $("#tbodypdc_inquiry .selected").each(function(){
     i++;
   });

     var rem = num - i;
     var date = eto.closest('tr').attr("id");
     if (eto.closest('tr').hasClass('selected'))
     {
       eto.closest('tr').removeClass('selected').addClass('unselected');
       eto.closest('tr').find('td').css("background-color", "");
       eto.closest('tr').find('td').css("color", "");
     }
     else
     {
       if(rem > 0)
       {
         eto.closest('tr').removeClass('unselected').addClass('selected');
         eto.closest('tr').find('td').css("background-color", "#b4d2e4");
         eto.closest('tr').find('td').css("color", "#31708f");
       }
     }
}

function loaddatetofunction3(dateto)
{
  // alert(dateto)
  var months = $("#txtnoofmonths_inq").val();
  var days = $("#txtnoofdays_inq").val();
  var datefrom = $("#txtinq_datefrom").val();
  var ttlamnt = $("#txtinq_totalsqm").val().replace(",", "");
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
      data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&ttlamnt=' + ttlamnt + '&form=loadtbodypdc_inquiry2',
      success: function(data)
      {
        var arr = data.split("|");
        $("#lbltotalamountofpayment").text("Php " + arr[0]);
        $("#totalpayment").text("Php " + arr[0]);
        $("#txtmonthlymathdays").val(arr[3]);
        // $("#totalpayment").text("Php "+ arr[0]);
      }
    })
    loaddatefunction4()
  }
}

function loaddatefunction4()
{
  var advance = $("#txtinq_monthlyadvamt").val();
  var deposit = $("#txtinq_monthlydepamt").val();

  var unit_id = $("#txtinq_unitunit").val();

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unit_id=' + unit_id + '&advance=' + advance + '&deposit=' + deposit + '&form=loaddatefunction4',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_advancepayment").val(arr[0]);
      // $("#txtinq_depositpayment").val(arr[1]);
    }
  });
}

function chkunitfrst5(appid, inqid)
{

  var datefrom = $("#txtinq_datefrom").val();
  var dateto = $("#txtinq_dateto").val();
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
  var conttt = "";
  // if(type == "SET" && unit != "")
  // {
    $.ajax({
      type: 'POST',
      async: false,
      url: 'mainclass.php',
      data: 'unit=' + unit + '&datefrom=' + datefrom + '&dateto=' + dateto + '&appid=' + appid + '&inqid=' + inqid + '&form=chkunitfrst2',
      success: function(data)
      {
        if(data != "")
        {
          conttt = "invalid";
          $("#statinquiryyy").val("invalid");
          showmodal("alert", data, "", null, "", null, "1");

          $("#txtinq_unitunit").css("border-color", "red");
          $("#txtinq_datefrom").css("border-color", "red");

          if(parseInt($("#txtnoofmonths_inq").val()||0) != 0)
          {
            $("#txtnoofmonths_inq").css("border-color", "red");
          }
          else
          {
            $("#txtnoofmonths_inq").css("border-color", "#CCC");
          }

          if(parseInt($("#txtnoofdays_inq").val()||0) != 0)
          {
            $("#txtnoofdays_inq").css("border-color", "red");
          }
          else
          {
            $("#txtnoofdays_inq").css("border-color", "#CCC");
          }
        }
        else
        {
          conttt = "valid";
          $("#statinquiryyy").val("valid");
          $("#txtinq_unitunit").css("border-color", "#CCC");
          $("#txtnoofmonths_inq").css("border-color", "#CCC");
          $("#txtnoofdays_inq").css("border-color", "#CCC");
          $("#txtinq_datefrom").css("border-color", "#CCC");
        }
      }
    })
  return conttt;
}

function chkunitfrst6(appid, inqid)
{
  var conttt = "";
    $.ajax({
      type: 'POST',
      async: false,
      url: 'mainclass.php',
      data: 'unit=' + UnitID + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=chkunitfrst',
      success: function(data)
      {
          conttt = data;
      }
    })
  return conttt;
}

function savereservationform(Application_ID, Inquiry_ID)
{
  var stat_2 = $("#reservation_stat_select").val();
  var dup_count = checkpdcinput();
  var setunit = $("#txtinq_unitunit").val();
  var lcaunit = $("#txtinq_lca_unitname").val();
  var conttt = chkunitfrst5(Application_ID, Inquiry_ID);
  var contractterms  = $("#nakacheck").val();
  var mrcntstat = chkmerchntcode(Application_ID);
  var pymenttype = $("#txtinq_pymenttype").val();
  var pymentterms = $("#txtinq_pymentterms").val();
  var assocdues = $("#txtinq_assocdues").val().replace(",", "");
  if(pymenttype == "Credit Card" || pymenttype == "Debit Card"){
    var cardtype = $("#ptinfocardtype").val();
    var cardholder  = $("#ptinfocardholder").val();
    var authno = $("#ptinfoauthno").val();
    var securitycode = $("#ptinfosecuritycode").val();
    var ccno  = $("#ptinfoccno1").val()+"-"+$("#ptinfoccno2").val()+"-"+$("#ptinfoccno3").val()+"-"+$("#ptinfoccno4").val();
    var expirydate = $("#ptinfoexpirymonth").val()+"-"+$("#ptinfoexpiryyear").val();
    var bankfrom = "";
    var bf_accno = "";
    var bankto = "";
    var bt_accno = "";
  }else{
    var cardtype = "";
    var cardholder  = "";
    var authno = "";
    var securitycode = "";
    var ccno  = "";
    var expirydate = "";
    var bankfrom = $("#ptinfobankfrom").val();
    var bf_accno = $("#ptinfobf_accno").val();
    var bankto = $("#ptinfobankto").val();
    var bt_accno = $("#ptinfobt_accno").val();
  }
  if(setunit != "" || lcaunit != "")
  {
    if(conttt == "valid")
    {
      var e = 0;
      $(".required_reservation").each(function(){
        if($(this).val() == "" || $(this).val() == "0.00" || $(this).val() == "0")
        {
          e++;
          var eto = $(this).attr("id");
          // alert(eto)
          $(this).css("border-color","#f2a696");
        }
        else
          {
            $(this).css("border-color","#D5D5D5");
          }
      });

      var k = 0;
      var termsandconb = $("#displayselected").html();
      if(termsandconb == "")
      {
        k++;
      }
        if(e == 0 && mrcntstat == "not_existing")
        {
          if(stat_2 == "Confirmed")
          {
            if(k == 0)
            {
              if(dup_count == "")
              {
                      var stat = $("#reservation_stat_select").val();
                      var chknum = "";
                      $("#tbodypdc_inquiry tr td .txtchnummmm").each(function(){
                        var value = $(this).val();
                        var trval = $(this).closest('tr').attr("class");
                        chknum +=  "#"+value+"|"+trval;
                      });
                      var bankname = "";
                      $("#tbodypdc_inquiry tr td .bnk").each(function(){
                        var value = $(this).val();
                        bankname +=  "|"+value;
                      });

                      var mallid = $("#txtinq_mallbranch").val();

                      var tradename = $("#txtinq_tradename").val();
                      var tradeid = $("#txtinq_tradename").attr("value");
                      var companyname = $("#txtinq_companyname").val();
                      var companyid = $("#txtinq_companyname").attr("value");
                      var industryname = $("#txtinq_industryname").val();
                      var address = $("#txtinq_address").val();
                      var remarks = $("#txtinq_remarks").val();

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
                      if($("#radio_set").is(":checked"))
                      {
                        var unittype = "SET";
                        var unit_id = $("#txtinq_unitunit").val();
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
                        var unit_id = $("#txtinq_lca_unitname").val();
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

                        if(e == i)
                        {
                            var req = "Completed";
                        }
                        else
                        {
                            var req = "Incomplete";
                        }

                            var sqm_width = $("#txtinq_sqm_width").val();
                            var sqm_length = $("#txtinq_sqm_length").val();
                            var persqm = $("#txtinq_persqm").val();
                            var totalsqm = $("#txtinq_totalsqm").val().replace(",", "");
                            var unitwing = $("#txtinq_unitwing").val();
                            var unitfloor = $("#txtinq_unitfloor").val();
                            var classid = $("#txtinq_unitclass").val();
                            var monthnum = $("#txtnoofmonths_inq").val();
                            var daynum = $("#txtnoofdays_inq").val();
                            var billtype = $("#txttenanttype").val();
                            var perc = $("#txttenanttypepercent").val();
                            var merchcode = $("#txtmerchantcode").val();
                            var selectedmonth = "";
                            $("#tbodypdc_inquiry .selected").each(function(){
                              selectedmonth += $(this).attr("id") + "P" + $(this).find(".txtadvpyment").val() +"#";
                            })

                        $.ajax({
                          type: 'POST',
                          url: 'mainclass.php',
                          data: 'Application_ID=' + Application_ID + '&Inquiry_ID=' + Inquiry_ID + '&stat=' + stat + '&chknum=' + chknum + '&dep_id=' + dep_id + '&cat_id=' + cat_id + '&unit_id=' + unit_id + '&datefrom=' + datefrom + '&dateto=' + dateto + '&req=' + req + '&sqm_width=' + sqm_width + '&sqm_length=' + sqm_length + '&persqm=' + persqm + '&totalsqm=' + totalsqm + '&unitwing=' + unitwing + '&unitfloor=' + unitfloor + '&classid=' + classid + '&unittype=' + unittype + '&mallid=' + mallid + '&tradeid=' + tradeid + '&tradename=' + tradename + '&companyname=' + companyname + '&companyid=' + companyid + '&industryname=' + industryname + '&address=' + address + '&remarks=' + remarks + '&unitid=' + unit_id + '&dep_id=' + dep_id + '&cat_id=' + cat_id + '&datefrom=' + datefrom + '&dateto=' + dateto + '&monthlyadvamt=' + monthlyadvamt + '&monthlydepamt=' + monthlydepamt + '&advancepayment=' + advancepayment + '&depositpayment=' + depositpayment + '&monthnum=' + monthnum + '&daynum=' + daynum + '&billtype=' + billtype + '&perc=' + perc + '&merchcode=' + merchcode + '&bankname=' + bankname + '&contractterms=' + contractterms + '&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&assocdues=' + assocdues + '&cardtype=' + cardtype + '&cardholder=' + cardholder + '&authno=' + authno + '&securitycode=' + securitycode + '&ccno=' + ccno + '&expirydate=' + expirydate + '&bankfrom=' + bankfrom + '&bf_accno=' + bf_accno + '&bankto=' + bankto + '&bt_accno=' + bt_accno + '&form=savereservationform',
                          beforeSend : function() {
                            $('#reservationloadingscreen').addClass('myspinner');
                          },
                          success: function(data){
                            $('#reservationloadingscreen').removeClass('myspinner');
                            var arr = data.split("|");
                            if(arr[0] == "1")
                            {
                              if(stat == "Confirmed")
                              {
                                showmodal("alert", "Status successfully changed.", "", null, "", null, "0");
                                $("#contracttenantIDgen_modal").modal("show");
                                $("#txt_tenant_code").text(arr[1]);
                                $("#modal_previewleasingapplication").modal("hide");

                              }
                              else
                              {
                                showmodal("alert", "Information updated.", "", null, "", null, "0");
                                $("#modal_previewleasingapplication").modal("hide");
                              }
                            }
                            loadreservationlist();
                            $("#modal_previewleasingapplication").modal("hide");
                          }
                        });
              }
              else
              {
                // showmodal("alert", "You entered duplicate check numbers.", "", null, "", null, "1");
                $("#unitinfo_div").click();
                checkpdcinput2();
                var arr = dup_count.split("|");
                  $('#tbodypdc_inquiry tr td .required_reservation').each(function(){
                    for(var i=0; i<=arr.length-2; i++)
                    {
                      var thisval = $(this).val();
                      if(thisval == arr[i])
                      {
                        $(this).attr("style", "border: 1px solid #f2a696 !important");
                      }
                    }
                  })

                   $('#tbodypdc_inquiry tr td .required_reservation').each(function(){
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
              if(k != 0 && e == 0)
                {
                  $("#terms_and_con_btn").click();
                  showmodal("alert", "Please select terms and condition to proceed.", "", null, "", null, "1");
                }
            }
          }
          else
          {
              var stat = $("#reservation_stat_select").val();
              var chknum = "";
              $("#tbodypdc_inquiry tr td .txtchnummmm").each(function(){
                var value = $(this).val();
                var trval = $(this).closest('tr').attr("class");
                chknum +=  "#"+value+"|"+trval;
              });
              var bankname = "";
              $("#tbodypdc_inquiry tr td .bnk").each(function(){
                var value = $(this).val();
                bankname +=  "|"+value;
              });

              var mallid = $("#txtinq_mallbranch").val();

              var tradename = $("#txtinq_tradename").val();
              var tradeid = $("#txtinq_tradename").attr("value");
              var companyname = $("#txtinq_companyname").val();
              var companyid = $("#txtinq_companyname").attr("value");
              var industryname = $("#txtinq_industryname").val();
              var address = $("#txtinq_address").val();
              var remarks = $("#txtinq_remarks").val();

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
              if($("#radio_set").is(":checked"))
              {
                var unittype = "SET";
                var unit_id = $("#txtinq_unitunit").val();
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
                var unit_id = $("#txtinq_lca_unitname").val();
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

                if(e == i)
                {
                    var req = "Completed";
                }
                else
                {
                    var req = "Incomplete";
                }

                    var sqm_width = $("#txtinq_sqm_width").val();
                    var sqm_length = $("#txtinq_sqm_length").val();
                    var persqm = $("#txtinq_persqm").val();
                    var totalsqm = $("#txtinq_totalsqm").val().replace(",", "");
                    var unitwing = $("#txtinq_unitwing").val();
                    var unitfloor = $("#txtinq_unitfloor").val();
                    var classid = $("#txtinq_unitclass").val();
                    var monthnum = $("#txtnoofmonths_inq").val();
                    var daynum = $("#txtnoofdays_inq").val();
                    var billtype = $("#txttenanttype").val();
                    var perc = $("#txttenanttypepercent").val();
                    var merchcode = $("#txtmerchantcode").val();
                    var selectedmonth = "";
                    $("#tbodypdc_inquiry .selected").each(function(){
                      selectedmonth += $(this).attr("id") + "#";
                    })
                $.ajax({
                  type: 'POST',
                  url: 'mainclass.php',
                  data: 'Application_ID='+Application_ID+'&Inquiry_ID='+Inquiry_ID+'&stat='+stat+'&chknum='+chknum+'&dep_id='+dep_id+'&cat_id='+cat_id+'&unit_id='+unit_id+'&datefrom='+datefrom+'&dateto='+dateto+'&req='+req+'&sqm_width='+sqm_width+'&sqm_length='+sqm_length+'&persqm='+persqm+'&totalsqm='+totalsqm+'&unitwing='+unitwing+'&unitfloor='+unitfloor+'&classid='+classid+'&unittype='+unittype+'&mallid='+mallid+'&tradeid='+tradeid+'&tradename='+tradename+'&companyname='+companyname+'&companyid='+companyid+'&industryname='+industryname+'&address='+address+'&remarks='+remarks+'&unitid='+unit_id+'&dep_id='+dep_id+'&cat_id='+cat_id+'&datefrom='+datefrom+'&dateto='+dateto+'&monthlyadvamt='+monthlyadvamt+'&monthlydepamt='+monthlydepamt+'&advancepayment='+advancepayment+'&depositpayment='+depositpayment+'&monthnum='+monthnum+'&daynum='+daynum+'&billtype='+billtype+'&perc='+perc+'&merchcode='+merchcode+'&bankname='+bankname+'&selectedmonth=' + selectedmonth +'&contractterms=' + contractterms+'&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&assocdues='+assocdues+'&cardtype=' + cardtype + '&cardholder=' + cardholder + '&authno=' + authno + '&securitycode=' + securitycode + '&ccno=' + ccno + '&expirydate=' + expirydate + '&bankfrom=' + bankfrom + '&bf_accno=' + bf_accno + '&bankto=' + bankto + '&bt_accno=' + bt_accno + '&form=savereservationform',
                  beforeSend : function() {
                    $('#reservationloadingscreen').addClass('myspinner');
                  },
                  success: function(data){
                    $('#reservationloadingscreen').removeClass('myspinner');
                    var arr = data.split("|");
                    if(arr[0] == "1")
                    {
                      if(stat == "Confirmed")
                      {
                        showmodal("alert", "Status successfully changed.", "", null, "", null, "0");
                        $("#contracttenantIDgen_modal").modal("show");
                        $("#txt_tenant_code").text(arr[1]);
                        $("#modal_previewleasingapplication").modal("hide");

                      }
                      else
                      {
                        showmodal("alert", "Information updated.", "", null, "", null, "0");
                        $("#modal_previewleasingapplication").modal("hide");
                      }
                    }
                    loadreservationlist();
                    $("#modal_previewleasingapplication").modal("hide");
                  }
                });
          }
        }
        else
        {

          $('.required_reservation').each(function() {
          if ( this.value === ''  || this.value == '0.00' || this.value == '0') {
              showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
              var classes = $(this).parent().closest('.tab-pane').attr('id');
              var finds = $("a[href$='#"+classes+"']").click();
              this.focus();
              return false;
            }
          });

          if(e == 0 && mrcntstat == "existing")
          {
            $("#div_businf").click();
            showmodal("alert", "The merchant code you entered is already existing.", "existingmrcnt()", null, "", null, "1");
          }
        }
    }
    else
    {
      $("#txtinq_unitunit").css("border-color", "red");
      $("#txtnoofmonths_inq").css("border-color", "red");
      $("#txtinq_datefrom").css("border-color", "red");
      $("#unitinfo_div").click();
    }
  }
  else
  {
      var e = 0;
      $(".required_reservation").each(function(){
        if($(this).val() == "" || $(this).val() == "0.00" || $(this).val() == "0")
        {
          e++;
          var eto = $(this).attr("id");
          // alert(eto)
          $(this).css("border-color","#f2a696");
        }
        else
          {
            $(this).css("border-color","#D5D5D5");
          }
      });

      var k = 0;
      var termsandconb = $("#displayselected").html();
      if(termsandconb == "")
      {
        k++;
      }

        if(e == 0 && mrcntstat == "not_existing")
        {
            if(stat_2 == "Confirmed")
            {
              if(k == 0)
              {
                if(dup_count == "")
                {
                    var stat = $("#reservation_stat_select").val();
                    var chknum = "";
                    $("#tbodypdc_inquiry tr td .txtchnummmm").each(function(){
                      var value = $(this).val();
                      var trval = $(this).closest('tr').attr("class");
                      chknum +=  "#"+value+"|"+trval;
                    });
                    var bankname = "";
                    $("#tbodypdc_inquiry tr td .bnk").each(function(){
                      var value = $(this).val();
                      bankname +=  "|"+value;
                    });

                    var mallid = $("#txtinq_mallbranch").val();

                    var tradename = $("#txtinq_tradename").val();
                    var tradeid = $("#txtinq_tradename").attr("value");
                    var companyname = $("#txtinq_companyname").val();
                    var companyid = $("#txtinq_companyname").attr("value");
                    var industryname = $("#txtinq_industryname").val();
                    var address = $("#txtinq_address").val();
                    var remarks = $("#txtinq_remarks").val();

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
                    if($("#radio_set").is(":checked"))
                    {
                      var unittype = "SET";
                      var unit_id = $("#txtinq_unitunit").val();
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
                      var unit_id = $("#txtinq_lca_unitname").val();
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

                      if(e == i)
                      {
                          var req = "Completed";
                      }
                      else
                      {
                          var req = "Incomplete";
                      }

                          var sqm_width = $("#txtinq_sqm_width").val();
                          var sqm_length = $("#txtinq_sqm_length").val();
                          var persqm = $("#txtinq_persqm").val();
                          var totalsqm = $("#txtinq_totalsqm").val().replace(",", "");
                          var unitwing = $("#txtinq_unitwing").val();
                          var unitfloor = $("#txtinq_unitfloor").val();
                          var classid = $("#txtinq_unitclass").val();
                          var monthnum = $("#txtnoofmonths_inq").val();
                          var daynum = $("#txtnoofdays_inq").val();
                          var billtype = $("#txttenanttype").val();
                          var perc = $("#txttenanttypepercent").val();
                          var selectedmonth = "";
                          $("#tbodypdc_inquiry .selected").each(function(){
                            selectedmonth += $(this).attr("id") + "#";
                          })
                    $.ajax({
                      type: 'POST',
                      url: 'mainclass.php',
                      data: 'Application_ID='+Application_ID+'&Inquiry_ID='+Inquiry_ID+'&stat='+stat+'&chknum='+chknum+'&dep_id='+dep_id+'&cat_id='+cat_id+'&unit_id='+unit_id+'&datefrom='+datefrom+'&dateto='+dateto+'&req='+req+'&sqm_width='+sqm_width+'&sqm_length='+sqm_length+'&persqm='+persqm+'&totalsqm='+totalsqm+'&unitwing='+unitwing+'&unitfloor='+unitfloor+'&classid='+classid+'&unittype='+unittype+'&mallid='+mallid+'&tradeid='+tradeid+'&tradename='+tradename+'&companyname='+companyname+'&companyid='+companyid+'&industryname='+industryname+'&address='+address+'&remarks='+remarks+'&unitid='+unit_id+'&dep_id='+dep_id+'&cat_id='+cat_id+'&datefrom='+datefrom+'&dateto='+dateto+'&monthlyadvamt='+monthlyadvamt+'&monthlydepamt='+monthlydepamt+'&advancepayment='+advancepayment+'&depositpayment='+depositpayment+'&monthnum='+monthnum+'&daynum='+daynum+'&billtype='+billtype+'&perc='+perc+'&bankname='+bankname+'&selectedmonth=' + selectedmonth +'&contractterms=' + contractterms+'&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&assocdues='+assocdues+'&cardtype=' + cardtype + '&cardholder=' + cardholder + '&authno=' + authno + '&securitycode=' + securitycode + '&ccno=' + ccno + '&expirydate=' + expirydate + '&bankfrom=' + bankfrom + '&bf_accno=' + bf_accno + '&bankto=' + bankto + '&bt_accno=' + bt_accno + '&form=savereservationform',
                      beforeSend : function() {
                        $('#reservationloadingscreen').addClass('myspinner');
                      },
                      success: function(data){
                        $('#reservationloadingscreen').removeClass('myspinner');
                        var arr = data.split("|");
                        if(arr[0] == "1")
                        {
                          if(stat == "Confirmed")
                          {
                            showmodal("alert", "Status successfully changed.", "", null, "", null, "0");
                            $("#contracttenantIDgen_modal").modal("show");
                            $("#txt_tenant_code").text(arr[1]);
                            $("#modal_previewleasingapplication").modal("hide");

                          }
                          else
                          {
                            showmodal("alert", "Information updated.", "", null, "", null, "0");
                            $("#modal_previewleasingapplication").modal("hide");
                          }
                        }
                        loadreservationlist();
                        $("#modal_previewleasingapplication").modal("hide");
                      }
                    });
                }
                else
                {
                  showmodal("alert", "You entered duplicate check numbers.", "", null, "", null, "1");
                  var arr = dup_count.split("|");
                    $('#tbodypdc_inquiry tr td .required_reservation').each(function(){
                      for(var i=0; i<=arr.length-2; i++)
                      {
                        var thisval = $(this).val();
                        if(thisval == arr[i])
                        {
                          $(this).attr("style", "border: 1px solid #f2a696 !important");
                        }
                      }
                    })

                     $('#tbodypdc_inquiry tr td .required_reservation').each(function(){
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
                if(k != 0 && e == 0)
                  {
                    $("#terms_and_con_btn").click();
                    showmodal("alert", "Please select terms and condition to proceed.", "", null, "", null, "1");
                  }
              }
            }
            else
            {
                  var stat = $("#reservation_stat_select").val();
                  var chknum = "";
                  $("#tbodypdc_inquiry tr td .txtchnummmm").each(function(){
                    var value = $(this).val();
                    var trval = $(this).closest('tr').attr("class");
                    chknum +=  "#"+value+"|"+trval;
                  });
                  var bankname = "";
                  $("#tbodypdc_inquiry tr td .bnk").each(function(){
                    var value = $(this).val();
                    bankname +=  "|"+value;
                  });

                  var mallid = $("#txtinq_mallbranch").val();

                  var tradename = $("#txtinq_tradename").val();
                  var tradeid = $("#txtinq_tradename").attr("value");
                  var companyname = $("#txtinq_companyname").val();
                  var companyid = $("#txtinq_companyname").attr("value");
                  var industryname = $("#txtinq_industryname").val();
                  var address = $("#txtinq_address").val();
                  var remarks = $("#txtinq_remarks").val();

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
                  if($("#radio_set").is(":checked"))
                  {
                    var unittype = "SET";
                    var unit_id = $("#txtinq_unitunit").val();
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
                    var unit_id = $("#txtinq_lca_unitname").val();
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

                    if(e == i)
                    {
                        var req = "Completed";
                    }
                    else
                    {
                        var req = "Incomplete";
                    }

                        var sqm_width = $("#txtinq_sqm_width").val();
                        var sqm_length = $("#txtinq_sqm_length").val();
                        var persqm = $("#txtinq_persqm").val();
                        var totalsqm = $("#txtinq_totalsqm").val().replace(",", "");
                        var unitwing = $("#txtinq_unitwing").val();
                        var unitfloor = $("#txtinq_unitfloor").val();
                        var classid = $("#txtinq_unitclass").val();
                        var monthnum = $("#txtnoofmonths_inq").val();
                        var daynum = $("#txtnoofdays_inq").val();
                        var billtype = $("#txttenanttype").val();
                        var perc = $("#txttenanttypepercent").val();
                        var selectedmonth = "";
                        $("#tbodypdc_inquiry .selected").each(function(){
                          selectedmonth += $(this).attr("id") + "#";
                        })
                  $.ajax({
                    type: 'POST',
                    url: 'mainclass.php',
                    data: 'Application_ID='+Application_ID+'&Inquiry_ID='+Inquiry_ID+'&stat='+stat+'&chknum='+chknum+'&dep_id='+dep_id+'&cat_id='+cat_id+'&unit_id='+unit_id+'&datefrom='+datefrom+'&dateto='+dateto+'&req='+req+'&sqm_width='+sqm_width+'&sqm_length='+sqm_length+'&persqm='+persqm+'&totalsqm='+totalsqm+'&unitwing='+unitwing+'&unitfloor='+unitfloor+'&classid='+classid+'&unittype='+unittype+'&mallid='+mallid+'&tradeid='+tradeid+'&tradename='+tradename+'&companyname='+companyname+'&companyid='+companyid+'&industryname='+industryname+'&address='+address+'&remarks='+remarks+'&unitid='+unit_id+'&dep_id='+dep_id+'&cat_id='+cat_id+'&datefrom='+datefrom+'&dateto='+dateto+'&monthlyadvamt='+monthlyadvamt+'&monthlydepamt='+monthlydepamt+'&advancepayment='+advancepayment+'&depositpayment='+depositpayment+'&monthnum='+monthnum+'&daynum='+daynum+'&billtype='+billtype+'&perc='+perc+'&bankname='+bankname+'&selectedmonth=' + selectedmonth +'&contractterms=' + contractterms+'&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&assocdues='+assocdues+'&cardtype=' + cardtype + '&cardholder=' + cardholder + '&authno=' + authno + '&securitycode=' + securitycode + '&ccno=' + ccno + '&expirydate=' + expirydate + '&bankfrom=' + bankfrom + '&bf_accno=' + bf_accno + '&bankto=' + bankto + '&bt_accno=' + bt_accno + '&form=savereservationform',
                    beforeSend : function() {
                      $('#reservationloadingscreen').addClass('myspinner');
                    },
                    success: function(data){
                      $('#reservationloadingscreen').removeClass('myspinner');
                      var arr = data.split("|");
                      if(arr[0] == "1")
                      {
                        if(stat == "Confirmed")
                        {
                          showmodal("alert", "Status successfully changed.", "", null, "", null, "0");
                          $("#contracttenantIDgen_modal").modal("show");
                          $("#txt_tenant_code").text(arr[1]);
                          $("#modal_previewleasingapplication").modal("hide");

                        }
                        else
                        {
                          showmodal("alert", "Information updated.", "", null, "", null, "0");
                          $("#modal_previewleasingapplication").modal("hide");
                        }
                      }
                      loadreservationlist();
                      $("#modal_previewleasingapplication").modal("hide");
                    }
                  });
            }
        }
        else
        {
          showmodal("alert", "Fill all required fields.", "", null, "", null, "0");
          $('.required_reservation').each(function() {
          if ( this.value === '' || this.value == '0.00' || this.value == '0') {
              $("#unitinfo_div").click();
              this.focus();
              return false;
            }
          });


          if(e == 0 && mrcntstat == "existing")
          {
            $("#div_businf").click();
            showmodal("alert", "The merchant code you entered is already existing.", "existingmrcnt()", null, "", null, "1");
          }
        }
  }
}

function existingmrcnt()
{
  $("#alertmodal").modal("hide");
  $("#txtmerchantcode").css("border-color", "#f2a696");
  $("#txtmerchantcode").focus();
}

function chkmerchntcode(Application_ID)
{
    var code = $("#txtmerchantcode").val()
    $.ajax({
      type: 'POST',
      async: false,
      url: 'mainclass.php',
      data: 'code=' + code + '&Application_ID=' + Application_ID + '&form=chkmerchntcode',
      success: function(data)
      {
          conttt = data;
      }
    })
    return conttt;
}

// function for checking of duplicate check number
function checkpdcinput()
{
     var e = 0;
     var chk = "";
     var bankname = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td .txtchnummmm");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td .txtchnummmm").val();
        var bnk = $(this).find("td .bnk").val();
        chk +=  "|"+num;
        bankname +=  "|"+bnk;

      });

     var dup = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td .txtchnummmm");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td .txtchnummmm").val();
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
        var thischk = $(this).find("td .txtchnummmm");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td .txtchnummmm").val();
        var bnk = $(this).find("td .bnk").val();
        chk +=  "|"+num;
        bankname +=  "|"+bnk;

      });

     var dup = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td .txtchnummmm");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td .txtchnummmm").val();
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



function loadnotifications()
{
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'form=loadnotifications',
      success: function(data)
      {
        var arr = data.split("|");
        $("#span_id_notif").attr("title", arr[0]);
        $("#span_id_notif").html(arr[1]);
        $('[data-rel=tooltip]').tooltip();
        $('[data-rel=popover]').popover({html:true});
      }
    });
}

function cancelreservation(Inquiry_ID, Application_ID, datefrom, dateto, UnitID)
{
  // alert(Inquiry_ID+"|"+Application_ID+"|"+datefrom+"|"+dateto)
  var conf = confirm("Are you sure you want to cancel this application?");
  if(conf == true)
  {
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'Inquiry_ID='+Inquiry_ID+'&Application_ID='+Application_ID+'&datefrom='+datefrom+'&dateto='+dateto+'&UnitID='+UnitID+'&form=cancelreservation',
      success: function(data)
      {
        $("#modal_previewleasingapplication").modal("hide");
        showmodal("alert", data, "", null, "", null, "0");
        loadreservationlist()
      }
    });
  }
}

function reinstatereservation(Inquiry_ID, Application_ID)
{
  if($("#radio_set").is(":checked"))
  {
    var unit = $("#txtinq_unitunit").val();
    var unitid = $("#txtinq_unitunit");
  }
  else if($("#radio_lca").is(":checked"))
  {
    var unit = $("#txtinq_lca_unitname").val();
    var unitid = $("#txtinq_lca_unitname");
  }
  var datef = $("#txtinq_datefrom").val();
  var datet = $("#txtinq_dateto").val();

  var conf = confirm("Are you sure you want to reinstate this application?");
  if(conf == true)
  {
    var stat = chkunitfrst3(datef, datet, unit);
    if(stat == "valid")
    {
        $.ajax({
          type: 'POST',
          url: 'mainclass.php',
          data: 'Inquiry_ID='+Inquiry_ID+'&Application_ID='+Application_ID+'&datefrom='+datef+'&dateto='+datet+'&UnitID='+unit+'&form=reinstatereservation',
          success: function(data)
          {
            $("#modal_previewleasingapplication").modal("hide");
            showmodal("alert", data, "", null, "", null, "0");
            loadreservationlist();
            unitid.css("border-color", "#CCC");
            $("#txtinq_datefrom").css("border-color", "#CCC");
            $("#txtinq_dateto").css("border-color", "#CCC");
          }
        });
    }
    else
    {
      var prompt = chkunitfrst4(datef, datet, unit);
      showmodal("alert", prompt, "", null, "", null, "1");
      unitid.css("border-color", "red");
      $("#txtinq_datefrom").css("border-color", "red");
      $("#txtinq_dateto").css("border-color", "red");
      $("#unitinfo_div").click();
      unitid.focus();
    }
  }
}

function chkunitfrst3(datefrom, dateto, UnitID)
{
  var conttt = "";
    $.ajax({
      type: 'POST',
      async: false,
      url: 'mainclass.php',
      data: 'unit=' + UnitID + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=chkunitfrst',
      success: function(data)
      {
        if(data != "")
        {
          conttt = "invalid";
        }
        else
        {
          conttt = "valid";
        }
      }
    })
  return conttt;
}

function chkunitfrst4(datefrom, dateto, UnitID)
{
  var conttt = "";
    $.ajax({
      type: 'POST',
      async: false,
      url: 'mainclass.php',
      data: 'unit=' + UnitID + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=chkunitfrst',
      success: function(data)
      {
          conttt = data;
      }
    })
  return conttt;
}

function loadcontractagreement()
{
    var e = 0;
  $(".required_reservation").each(function(){
    if($(this).val() == "" || $(this).val() == "0.00")
    {
      e++;
      var eto = $(this).attr("id");
      // alert(eto)
      $(this).css("border-color","#f2a696");
    }
    else
      {
        $(this).css("border-color","#D5D5D5");
      }
  });

  if(e == 0)
  {
       // printcontract();
       $("#modal_previewleasingapplication").modal("hide");
       loadreservationlist();
  }
 else
  {
    showmodal("alert", "Fill all required fields.", "", null, "", null, "0");
    $('.required_reservation').each(function() {
    if ( this.value === '' ) {
        this.focus();
        return false;
    }
    });
  }

}

// July 04 Kevin M
function editreservationmodal(TradeID, Company_ID, Inquiry_ID, UnitID, Application_ID, stat, appStat, paytype)
{
  $("#modal_previewleasingapplication").modal("show");
  $("#paymenttypeinfo").val(Inquiry_ID);
  $("#tabcont :input").prop("disabled", false); //enable all first
  $("#txtinq_totalmonthlydues").prop("disabled", true);
  $("#txtmerchantcode").removeClass("required_reservation");
  $("#txttenanttype").removeClass("required_reservation");
  $("#txttenanttypepercent").removeClass("required_reservation");
  $("#txttenanttypepercent2").css("display", "none");
  $("#btn_savenewremark").attr("onclick", "savenewremark(\""+Inquiry_ID+"\")");
  $("#txtinq_unitunit").css("border-color", "#CCC");
  $("#txtinq_lca_unitname").css("border-color", "#CCC");
  $("#txtinq_datefrom").css("border-color", "#CCC");
  $("#txtinq_dateto").css("border-color", "#CCC");
  $("#div_businf").click();
  var invi = $("#invi").attr("value", Inquiry_ID);
  displayselected();
  changeclassification();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'TradeID=' + TradeID + '&Company_ID=' + Company_ID + '&Inquiry_ID=' + Inquiry_ID + '&form=viewinquiry',
    beforeSend : function() {
      $('#reservationloadingscreen').addClass('myspinner');
    },
    success: function(data){
      $('#reservationloadingscreen').removeClass('myspinner');
      var arr = data.split("|");
      $("#txtselected_month").val(arr[42]);
      $("#txtinq_mallbranch").val(arr[1]);
      $("#txtinq_pymenttype").val(arr[45]);
      forinputofdetails(arr[45]);
      $("#txtapp_createdby").text(arr[39]);
      $("#txtapp_datecreated").text(arr[36]);
      $("#txtapp_modifby").text(arr[34]);
      $("#txtapp_modifdate").text(arr[38]);
      $("#txtapp_createdby2").text(arr[32]);
      $("#txtapp_datecreated2").text(arr[35]);
      $("#status_todo").val(stat);
      $("#txtinq_datefrom").attr("onkeyup", "loaddatetofunction(\""+stat+"\")");
      $("#statinquiryyy").val("valid");
      $("#txtinq_mallbranch").val(arr[1]);
      if(arr[1] != "")
      {
        $("#txtinq_unitclass").prop("disabled", false);
      }
      else
      {
        $("#txtinq_unitclass").prop("disabled", true);
      }

      $("#txtresidreq").val(Inquiry_ID);
      $("#txtinq_remarks").val(arr[2]);
      $("#txtinq_mallbranch").prop("disabled", true);
      // $("#txtinq_remarks").prop("disabled", true);
      $("#txtinq_tradename").prop("disabled", true);
      $("#txtinq_companyname").prop("disabled", true);
      $("#txtinq_industryname").prop("disabled", true);
      $("#div_res_1 :input").prop("disabled", true);
      $("#txtinq_address").prop("disabled", true);
      // $("#txtinq_mallbranch").prop("style","background-color:white !important");
      // $("#txtinq_remarks").prop("style","background-color:white !important;height:200px;");
      // $("#txtinq_tradename").prop("style","background-color:white !important");
      // $("#btn_saveinquiry").prop("disabled", false);
      $("#btn_savereservation").attr("onclick", "savereservationform(\""+Application_ID+"\",\""+Inquiry_ID+"\")");
      selecttenant(Company_ID, TradeID);

      $("#div_modal_inquiry_remarks").prop("class", "col-md-6 col-xs-6");
      $("#div_modal_inquiry_requirements").css("display", "block");
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
      // $("#reservation_stat_select").val(arr[21]);
      if(arr[46] != ""){
        trappayment(Application_ID, Inquiry_ID, "Confirmed");
        checkvalueofstat(Application_ID, Inquiry_ID, "Confirmed")
      }else{
        trappayment(Application_ID, Inquiry_ID, "Tentative");
        checkvalueofstat(Application_ID, Inquiry_ID, "Tentative")
      }
      $("#txtinq_unitclass").val(arr[26]);
      $("#tbodypdc_inquiry").html("");
      $("#txtmerchantcode").val(arr[40]);

      if(arr[31] != "")
      {
        $("#txttenanttypepercent").val(arr[31]);
        $("#txttenanttypepercent2").css("display", "block");
      }
      else
      {
        $("#txttenanttypepercent").val("");
        $("#txttenanttypepercent2").css("display", "none");
      }
      if(arr[27] == "SET")
      {
        selectunit(Company_ID, TradeID, UnitID, Inquiry_ID, Application_ID, stat, appStat, arr[27]);
        $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction(\""+stat+"\");");
        $("#div_unit_set").css("display", "block");
        $("#div_unit_lca").css("display", "none");

        $("#txtinq_unitunit").removeClass("required_reservation");
        $("#txtnoofmonths_inq").removeClass("required_reservation");
        $("#txtinq_sqm").removeClass("required_reservation");
        $("#txtinq_persqm").removeClass("required_reservation");
        $("#txtinq_totalsqm").removeClass("required_reservation");
        $("#txtinq_unitunit").addClass("required_reservation");
        $("#txtnoofmonths_inq").addClass("required_reservation");
        $("#txtinq_sqm").addClass("required_reservation");
        $("#txtinq_persqm").addClass("required_reservation");
        $("#txtinq_totalsqm").addClass("required_reservation");
        $("#txtinq_lca_unitname").removeClass("required_reservation");
        $("#txtnoofdays_inq").removeClass("required_reservation");
        $("#txtinq_sqm_width").removeClass("required_reservation");
        $("#txtinq_sqm_length").removeClass("required_reservation");
        $("#txtinq_pymentterms").html("<option value=''>-- Select Payment Terms --</option><option value='monthly'>Monthly</option><option value='1time'>1 Time Payment</option>");
        $("#txtinq_pymentterms").val(arr[44]);
      }
      else if(arr[27] == "LCA")
      {
        selectunit3(Company_ID, TradeID, UnitID, Inquiry_ID, Application_ID, stat, appStat, arr[27]);
        $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction(\""+stat+"\");");
        $("#div_unit_set").css("display", "none");
        $("#div_unit_lca").css("display", "block");
        $("#txtinq_lca_unitname").removeClass("required_reservation");
        $("#txtnoofdays_inq").removeClass("required_reservation");
        $("#txtinq_sqm_width").removeClass("required_reservation");
        $("#txtinq_sqm_length").removeClass("required_reservation");
        $("#txtinq_persqm").removeClass("required_reservation");
        $("#txtinq_totalsqm").removeClass("required_reservation");
        $("#txtinq_lca_unitname").addClass("required_reservation");
        $("#txtnoofdays_inq").addClass("required_reservation");
        $("#txtinq_sqm_width").addClass("required_reservation");
        $("#txtinq_sqm_length").addClass("required_reservation");
        $("#txtinq_persqm").addClass("required_reservation");
        $("#txtinq_totalsqm").addClass("required_reservation");
        $("#txtinq_unitunit").removeClass("required_reservation");
        $("#txtinq_sqm").removeClass("required_reservation");
        $("#txtinq_pymentterms").html("<option value=''>-- Select Payment Terms --</option><option value='daily'>Daily</option><option value='monthly'>Monthly</option><option value='1time'>1 Time Payment</option>");
        $("#txtinq_pymentterms").val(arr[44]);
      }
      var arr2 = arr[25].split("|");
      $("#slctdate_evict").val(arr[24]);
      uploadrequirementscss();
      $("#status_filled").val("0");
      if(stat == "occupy")
      {
        $("#tabcont :input").prop("disabled", true);
        $("#btnaddnewreeeeem").prop("disabled", false); //enable adding of remarks alwayss
        $("#btn_savereservation").hide();
        $("#btn_savereservation_occupy").attr("onclick", "occupyunit(\""+Application_ID+"\", \""+Inquiry_ID+"\")");
        $("#btn_savereservation_occupy").show();
        $("#btn_addtermsandcondition").hide();
        $("#btn_savereservation_reinstate").hide();
        $("#btn_savereservation_cancel").hide();
        // document.getElementById('btn_savereservation_print').style.display='inline-block';
      }
      else if(stat == "viewonly")
      {
        $("#tabcont :input").prop("disabled", true);
        $("#btnaddnewreeeeem").prop("disabled", false); //enable adding of remarks alwayss
        $("#btn_savereservation").hide();
        $("#btn_savereservation_occupy").attr("onclick", "occupyunit(\""+Application_ID+"\", \""+Inquiry_ID+"\")");
        $("#btn_savereservation_occupy").hide();
        $("#btn_addtermsandcondition").hide();
        $("#btn_savereservation_reinstate").hide();
        $("#btn_savereservation_cancel").hide();
        // document.getElementById('btn_savereservation_print').style.display='inline-block';
      }
      else if(stat == "reinstate")
      {
        $("#div_res_0 :input").prop("disabled", true);
        $("#btnaddnewreeeeem").prop("disabled", false); //enable adding of remarks alwayss
        $("#div_res_1 :input").prop("disabled", true);
        $("#btn_savereservation").hide();
        $("#btn_savereservation_occupy").hide();
        $("#btn_savereservation_reinstate").show();
        $("#btn_savereservation_cancel").hide();
        $("#btn_savereservation_reinstate").attr("onclick", "reinstatereservation(\""+Inquiry_ID+"\",\""+Application_ID+"\",\""+arr[11]+"\",\""+arr[12]+"\",\""+UnitID+"\")");
      }
      else if(stat == "cancel")
      {
        $("#tabcont :input").prop("disabled", true);
        $("#btnaddnewreeeeem").prop("disabled", false); //enable adding of remarks alwayss
        $("#btn_savereservation").hide();
        $("#btn_savereservation_occupy").hide();
        $("#btn_savereservation_reinstate").hide();
        $("#btn_savereservation_cancel").show();
        $("#btn_savereservation_cancel").attr("onclick", "cancelreservation(\""+Inquiry_ID+"\",\""+Application_ID+"\")");
      }
      else
      {
        $("#btnaddnewreeeeem").prop("disabled", false); //enable adding of remarks alwayss
        // $("#reservation_stat_select").attr("onchange", "checkvalueofstat(\""+Application_ID+"\", \""+Inquiry_ID+"\")");
        $("#btn_savereservation").show();
        $("#btn_savereservation_occupy").hide();
        $("#btn_savereservation_cancel").hide();
        $("#btn_savereservation_reinstate").hide();
      }
      $.ajax({
      type: 'POSt',
      url: 'mainclass.php',
      data: 'paymenttype=' + arr[45] + '&inqid=' + Inquiry_ID + '&form=onloadcardinfo',
      success:function(data){
        var arr = data.split("|");
        if(data != ""){
          if(arr[45] == "Credit Card" || arr[45] == "Debit Card"){
            $("#ptinfocardtype").val(arr[0]);
            $("#ptinfocardholder").val(arr[1]);
            $("#ptinfoauthno").val(arr[2]);
            $("#ptinfosecuritycode").val(arr[3]);
            var arr2 = arr[5].split("-");
            $("#ptinfoccno1").val(arr2[0]);
            $("#ptinfoccno2").val(arr2[1]);
            $("#ptinfoccno3").val(arr2[2]);
            $("#ptinfoccno4").val(arr2[3]);
            var arr3 = arr[4].split("-");
            $("#ptinfoexpirymonth").val(arr3[0]);
            $("#ptinfoexpiryyear").val(arr3[1]);
          }else{
            $("#ptinfobankfrom").val(arr[0]);
            $("#ptinfobf_accno").val(arr[1]);
            $("#ptinfobankto").val(arr[2]);
            $("#ptinfobt_accno").val(arr[3]);
          }
        }else{
          $("#ptinfocardtype").val("");
          $("#ptinfocardholder").val("");
          $("#ptinfoauthno").val("");
          $("#ptinfosecuritycode").val("");
          $("#ptinfoccno1").val("");
          $("#ptinfoccno2").val("");
          $("#ptinfoccno3").val("");
          $("#ptinfoccno4").val("");
          $("#ptinfoexpirymonth").val("");
          $("#ptinfoexpiryyear").val("");
          $("#ptinfobankfrom").val("");
          $("#ptinfobf_accno").val("");
          $("#ptinfobankto").val("");
          $("#ptinfobt_accno").val("");
        }
      }
    })
    }
  });
  loadremakrs(Inquiry_ID);

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: '&appid=' + Application_ID + '&inqid=' + Inquiry_ID + '&form=loadrequirements_application',
    success: function(data)
    {
      $("#div_modal_inquiry_requirements").html(data);
      uploadrequirementscss();
      $(".overridebutton").css("display", "none");
    }
  })

   $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'appid=' + Application_ID + '&inqid=' + Inquiry_ID + '&form=viewinquiry2',
    success: function(data)
    {
      var arr = data.split("#");
      if(arr[0] == "")
      {
        $("#txttenanttype").val("Rent");
        chkbilltype();
      }
      else
      {
        $("#txttenanttype").val(arr[0]);
      }
    }
  })
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'Inquiry_ID=' + Inquiry_ID + '&form=viewcardinformation',
    success:function(data){
      var arr = data.split("|");
      $("#viewinquirycardtype").val(arr[0]);
      var arr2 = arr[1].split("-");
      $("#viewinquirycc1").val(arr2[0]);
      $("#viewinquirycc2").val(arr2[1]);
      $("#viewinquirycc3").val(arr2[2]);
      $("#viewinquirycc4").val(arr2[3]);
      var arr3 = arr[2].split("-");
      $("#viewinquirymm").val(arr3[0]);
      $("#viewinquiryyy").val(arr3[1]);
      $("#viewinquirybf").val(arr[3]);
      $("#viewinquirybf_acc").val(arr[4]);
      $("#viewinquirybt").val(arr[5]);
      $("#viewinquirybt_acc").val(arr[6]);
    }
  })
}

//July 31, 2017 Jonas
function trappayment(Application_ID, Inquiry_ID, stat){
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'Inquiry_ID=' + Inquiry_ID + '&form=onloadreservationpaymentlist',
    success:function(data){
      var arr = data.split("|");
      $("#tblreservationpaymentlist").html(arr[0]);
      if(arr[0] != ""){
        $("#reservation_stat_select").val(arr[1]);
        checkvalueofstat(Application_ID, Inquiry_ID, stat);
      }else{
        $("#reservation_stat_select").val(arr[2]);
      }
    }
  })
}
// End

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
      $("#txtnoofdays_inq").removeClass("required_reservation");
      $("#txtnoofmonths_inq").removeClass("required_reservation");
    }
    else
    {
      if(type == "SET")
      {
        $("#txtnoofdays_inq").removeClass("required_reservation");
        $("#txtnoofmonths_inq").removeClass("required_reservation");
        $("#txtnoofmonths_inq").addClass("required_reservation");
      }
      else
      {
        var months = parseInt($("#txtnoofmonths_inq").val()||0);
        var days = parseInt($("#txtnoofdays_inq").val()||0);
        if(months == 0 && days == 0)
        {
          $("#txtnoofdays_inq").removeClass("required_reservation");
          $("#txtnoofdays_inq").addClass("required_reservation");
          $("#txtnoofmonths_inq").removeClass("required_reservation");
          $("#txtnoofmonths_inq").addClass("required_reservation");
        }
        else
        {
          if(months > 0 && days == 0)
          {
            $("#txtnoofdays_inq").removeClass("required_reservation");
            $("#txtnoofmonths_inq").addClass("required_reservation");
          }
          else if(months == 0 && days > 0)
          {
            $("#txtnoofmonths_inq").removeClass("required_reservation");
            $("#txtnoofdays_inq").addClass("required_reservation");
          }
          else
          {
            $("#txtnoofdays_inq").addClass("required_reservation");
            $("#txtnoofdays_inq").addClass("required_reservation");
          }
        }
      }
    }
}

function reqmonORday2(idnum, type, months, days)
{
  if(idnum == "")
  {
    $("#txtnoofdays_inq").removeClass("required_reservation");
    $("#txtnoofmonths_inq").removeClass("required_reservation");
  }
  else
  {
    var months = parseInt(months||0);
    var days = parseInt(days||0);
    if(type == "SET")
    {
      if(months == 0 && days == 0)
      {
        $("#txtnoofdays_inq").removeClass("required_reservation");
        $("#txtnoofdays_inq").addClass("required_reservation");
        $("#txtnoofmonths_inq").removeClass("required_reservation");
        $("#txtnoofmonths_inq").addClass("required_reservation");
      }
      else
      {
        if(months > 0 && days == 0)
        {
          $("#txtnoofdays_inq").removeClass("required_reservation");
          $("#txtnoofmonths_inq").addClass("required_reservation");
        }
        else if(months == 0 && days > 0)
        {
          $("#txtnoofmonths_inq").removeClass("required_reservation");
          $("#txtnoofdays_inq").addClass("required_reservation");
        }
        else
        {
          $("#txtnoofdays_inq").addClass("required_reservation");
          $("#txtnoofdays_inq").addClass("required_reservation");
        }
      }
    }
    else
    {
      $("#txtnoofdays_inq").removeClass("required_reservation");
      $("#txtnoofmonths_inq").addClass("required_reservation");
    }

  }
}

function selectunit3(Company_ID, TradeID, UnitID, Inquiry_ID, Application_ID, stat, appStat, unitstta)
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'Company_ID=' +Company_ID+ '&TradeID=' +TradeID+ '&UnitID=' +UnitID+ '&Inquiry_ID='+Inquiry_ID+ '&form=selectunit2',
    success: function(data)
    {
        var arr = data.split("|");
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
        $("#txtinq_monthlyadvamt").removeClass("required_inq");
        // $("#txtinq_monthlydepamt").removeClass("required_inq");
        $("#txtinq_advancepayment").removeClass("required_inq");
        $("#txtinq_depositpayment").removeClass("required_inq");
        $("#txtinq_advancepayment2").removeClass("required_inq");
        $("#txtinq_depositpayment2").removeClass("required_inq");
        $("#txtinq_advancepayment2").addClass("required_inq");
        $("#txtinq_depositpayment2").addClass("required_inq");
        $("#div_unit_area_set").css("display", "none");
        $("#div_unit_area_lca").css("display", "block");

        $("#txtinq_datefrom").val();
        $("#txtinq_advancepayment2").val(arr[11]);
        $("#txtinq_depositpayment2").val(arr[10]);
        $("#txtinq_sqm_width").val(arr[1])
        $("#txtinq_sqm_length").val(arr[2])
        $("#txtinq_persqm").val(arr[3])
        $("#txtinq_totalsqm").val(arr[4])
        $("#txtmonthlymath").val(arr[4]);
        $("#txtinq_assocdues").val(arr[13]);
        $("#txtinq_totalmonthlydues").val(arr[14]);
        $("#txtmonthlymath").prop("disabled", true);
        $("#txtinq_assocdues").prop("disabled", true);
        $("#txtmonthlymathdays").prop("disabled", true);
        // $("#txtinq_monthlyrate2").val(arr[4])
        $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction(\""+stat+"\")");
        $("#txtnoofdays_inq").attr("onkeyup", "reqmonORday();loaddatetofunction(\""+stat+"\")");

        $("#txtinq_lca_unitname").prop("disabled", true);
        $("#txtinq_datefrom").prop("disabled", true);
        $("#txtinq_advancepayment2").prop("disabled", false);
        $("#txtinq_depositpayment2").prop("disabled", false);
        $("#txtinq_sqm_width").prop("disabled", false);
        $("#txtinq_sqm_length").prop("disabled", false);
        $("#txtinq_persqm").prop("disabled", false);
        $("#txtinq_totalsqm").prop("disabled", false);
        // $("#txtinq_monthlyrate2").prop("disabled", false);

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
          loadinquiry_flr2(arr[5], stat);
          loadinquiry_unit2(UnitID);
          loaddatetofunction(stat);
    }
  })
}


function selecttenant(companyID, tradeID)
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'companyID=' + companyID + '&tradeID=' + tradeID +'&form=selecttenant',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_companyname").attr("value",companyID);
      $("#txtinq_tradename").val(arr[13]);
      $("#txtinq_tradename").attr("value",tradeID);
      $("#txtinq_companyname").val(arr[1]);
      $("#txtinq_industryname").val(arr[3]);
      $("#txtinq_address").val(arr[4]);
      $("#txtcomp_fname").val(arr[5]);
      $("#txtcomp_mname").val(arr[6]);
      $("#txtcomp_lname").val(arr[7]);
      $("#txtcomp_perm_add").val(arr[8]);
      $("#txtcomp_curr_add").val(arr[9]);
      $("#txtcomp_bill_add").val(arr[10]);
      $("#add_tel_no_owner").html(arr[15]);
      if(arr[14] != "")
      {
        $("#imgtradeaccount").attr("src", "server/company/"+companyID+"/trades/"+tradeID+"/"+arr[14]);
      }

    }
  });

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'companyID=' + companyID + '&tradeID=' + tradeID +'&form=selectcontactnumbers',
    success: function(data)
    {
      $("#div_inquiry_contact_numbers").html(data);
    }
  });

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'companyID=' + companyID + '&tradeID=' + tradeID +'&form=selectcontactpersons',
    success: function(data)
    {
      $("#div_inquiry_contact_person").html(data);
    }
  });
}

function selectunit(Company_ID, TradeID, UnitID, Inquiry_ID, Application_ID, stat, appStat, unitstta)
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
      $("#txtinq_totalsqm").val(arr[40]);
      $("#txtinq_datefrom").val(arr[11]);
      $("#txtinq_dateto").val(arr[12]);
      $("#txtmonthlymath").val(arr[40]);
      // $("#txtinq_monthlyrate2").val(arr[4]);
      $("#txtinq_assocdues").val(arr[39]);
      $("#txtinq_totalmonthlydues").val(arr[41]);
      if(arr[39] != 0){
        $("#chkassocdues").attr("onclick", "removeassocdues()");
        $(".radassocdues").prop("checked", true);
      }else{
        $(".radassocdues").prop("checked", false);
        $("#chkassocdues").attr("onclick", "getassocdues()");
      }
      if(arr[40] != 0){
         $(".chkrentbox").prop("checked", true);
        $("#chkclearrent").attr("onclick", "clearrent()");
      }else{
        $("#chkclearrent").attr("onclick", "retrieverent()");
        $(".chkrentbox").prop("checked", false);
      }
      $("#btn_saveinquiry").attr("onclick", "saveleasingapplication(\""+Inquiry_ID+"\")");
      $("#txtmonthlymath").prop("disabled", true);
      $("#txtinq_assocdues").prop("disabled", true);
      if(unitstta == "SET")
      {
        $("#radio_set").prop("checked", true);
        $("#radio_lca").prop("checked", false);
        $("#div_nomonths").css("display", "block");
        $("#div_nodays").css("display", "none");

        $("#div_advance_set").css("display", "block");
        $("#div_deposit_set").css("display", "block");
        $("#div_advance_set_amt").css("display", "none");
        $("#div_deposit_set_amt").css("display", "none");
        $("#txtinq_monthlyadvamt").removeClass("required_inq");
        $("#txtinq_monthlydepamt").removeClass("required_inq");
        $("#txtinq_monthlyadvamt").addClass("required_inq");
        $("#txtinq_monthlydepamt").addClass("required_inq");
        $("#txtinq_advancepayment").removeClass("required_inq");
        $("#txtinq_depositpayment").removeClass("required_inq");
        $("#txtinq_advancepayment").addClass("required_inq");
        $("#txtinq_depositpayment").addClass("required_inq");
        $("#txtinq_advancepayment2").removeClass("required_inq");
        $("#txtinq_depositpayment2").removeClass("required_inq");
        $("#txtinq_advancepayment2").val("");
        $("#txtinq_depositpayment2").val("");
        $("#div_unit_area_set").css("display", "block");
        $("#div_unit_area_lca").css("display", "none");
      }
      else if(unitstta == "LCA")
      {
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
        $("#txtinq_monthlyadvamt").removeClass("required_inq");
        $("#txtinq_monthlydepamt").removeClass("required_inq");
        $("#txtinq_advancepayment").removeClass("required_inq");
        $("#txtinq_depositpayment").removeClass("required_inq");
        $("#txtinq_advancepayment2").removeClass("required_inq");
        $("#txtinq_depositpayment2").removeClass("required_inq");
        $("#txtinq_advancepayment2").addClass("required_inq");
        $("#txtinq_depositpayment2").addClass("required_inq");
      }
      $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction(\""+stat+"\")");
      $("#txtnoofdays_inq").attr("onkeyup", "reqmonORday();loaddatetofunction(\""+stat+"\")");


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
      loadinquiry_flr2(arr[7], stat);
      loadinquiry_unit2(arr[0]);
      loaddatetofunction(stat);
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
  }
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'department_id=' + department_id + '&form=loadinquiry_category',
    success: function(data)
    {
      $("#txtinq_unitcategory").html(data);
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
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id='+classification_id +'&mallid='+mallid+'&type='+type+'&form=loadinquiry_flr2',
    success: function(data)
    {
      $("#txtinq_unitfloor").html(data);
      $("#txtinq_unitfloor").val(selected);

      if(action != "viewonly" && action != "occupy" && action != "cancel")
      {
        if(selected == "")
        {
          $("#txtinq_datefrom").prop("disabled", false);
          $("#txtnoofmonths_inq").prop("disabled", false);
          $("#txtinq_monthlyadvamt").prop("disabled", true);
          $("#txtinq_advancepayment").prop("disabled", true);
          $("#txtinq_monthlydepamt").prop("disabled", false);
          $("#txtinq_depositpayment").prop("disabled", true);
          // $("#txtinq_monthlyrate2").prop("disabled", true); //disable

          $("#txtinq_dateto").prop("disabled", true);
          $("#txtnoofdays_inq").prop("disabled", false);
          $("#txtinq_advancepayment2").prop("disabled", false);
          $("#txtinq_depositpayment2").prop("disabled", false);
          $("#txtinq_sqm_width").prop("disabled", true);//disable
          $("#txtinq_sqm_length").prop("disabled", true);//disable
          $("#txtinq_totalsqm").prop("disabled", true);//disable
          $("#txtinq_sqm").prop("disabled", true);

          if($("#radio_set").is(":checked"))
          {
            $("#txtinq_persqm").prop("disabled", true);
          }
          else if($("#radio_lca").is(":checked"))
          {
            $("#txtinq_persqm").prop("disabled", true);
          }
        }
        else
        {
          $("#txtinq_datefrom").prop("disabled", true);
          $("#txtnoofmonths_inq").prop("disabled", false);
          $("#txtinq_monthlyadvamt").prop("disabled", true);
          $("#txtinq_advancepayment").prop("disabled", true);
          $("#txtinq_monthlydepamt").prop("disabled", true);
          $("#txtinq_depositpayment").prop("disabled", true);
          $("#txtinq_monthlyrate2").prop("disabled", true);

          $("#txtinq_dateto").prop("disabled", true);
          $("#txtnoofdays_inq").prop("disabled", false);
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
          // $("#txtinq_monthlyrate2").prop("disabled", true);

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
      }
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
    $("#txtinq_unitunit").val("");
  }
  else
  {
    $("#txtinq_unitfloor").prop("disabled", true);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_lca_unitname").prop("disabled", true);
    $("#txtinq_unitfloor").val("");
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
      if(type == "LCA")
      {
        $("#txtinq_lca_unitname").html(data);
        $("#txtinq_lca_unitname").val(selected);
      }
      else
      {
        $("#txtinq_unitunit").html(data);
        $("#txtinq_unitunit").val(selected);
      }
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
  $("#txtinq_pymentterms").val("");
  $("#txtinq_pymenttype").val("");
  $("#tbodypdc_inquiry").html("");
  $("#lbltotalamountofpayment").text("Php 0.00");
  // $("#totalpayment").text("Php 0.00");
  var unit_id =  $("#txtinq_unitunit").val();
  var txtinq_mallbranch = $("#txtinq_mallbranch").val();
  if(unit_id != "")
  {
    $("#txtinq_datefrom").prop("disabled", false);
    $("#txtnoofmonths_inq").prop("disabled", false);
    $("#txtinq_monthlyadvamt").prop("disabled", true); //autofill
    $("#txtinq_advancepayment").prop("disabled", true); //autofill
    $("#txtinq_monthlydepamt").prop("disabled", false);
    $("#txtinq_depositpayment").prop("disabled", true); //autofill
    // $("#txtinq_monthlyrate2").prop("disabled", true); //autofill
    $("#txtinq_persqm").prop("disabled", true);
    $("#txtinq_pymentterms").prop("disabled", false);
    $("#txtinq_pymenttype").prop("disabled", false);
  }
  else
  {
    $("#txtinq_datefrom").prop("disabled", true);
    $("#txtnoofmonths_inq").prop("disabled", true);
    $("#txtinq_monthlyadvamt").prop("disabled", true);
    $("#txtinq_advancepayment").prop("disabled", true);
    $("#txtinq_monthlydepamt").prop("disabled", true);
    $("#txtinq_depositpayment").prop("disabled", true);
    // $("#txtinq_monthlyrate2").prop("disabled", true);
    $("#txtinq_persqm").prop("disabled", true);
    $("#txtinq_pymentterms").prop("disabled", true);
    $("#txtinq_pymenttype").prop("disabled", true);
  }

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unit_id=' + unit_id + '&mallid=' + txtinq_mallbranch + '&form=selected_unit',
    success: function(data)
    {
      var arr = data.split("|");
      $("#txtinq_sqm").val(arr[0])
      $("#txtinq_persqm").val(arr[1])
      $("#txtinq_totalsqm").val(arr[2]);
      // $("#txtinq_monthlyrate2").val(arr[2]);
      $("#txtinq_assocdues").val(arr[3]);
      if(arr[3] == "0.00"){
        $("#chkassocdues").prop("checked", false);
      }else{
        $("#chkassocdues").prop("checked", true);
      }
      $("#txtmonthlymath").val(arr[2]);
      $("#txtinq_totalmonthlydues").val(arr[4]);
      if(arr[5] == "SET"){
        $("#txtinq_depositpayment").prop("disabled", false);
      }else if(arr[5] == "LCA"){
        $("#txtinq_depositpayment2").prop("disabled", false);
      }else{
        //
      }
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


function loadinquiry_wing()
{
  var classification_id = $("#txtinq_unitclass").val();;
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&form=loadinquiry_wing',
    success: function(data)
    {
      $("#list_unitWing").html(data)
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
    $("#txtinq_lca_unitname").val("");
  }
  else
  {
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_lca_unitname").prop("disabled", true);
    $("#txtinq_unitunit").val("");
    $("#txtinq_lca_unitname").val("");
    $("#txtinq_lca_unitname").val("");
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
            showmodal("alert", "No available "+type+ " units under "+classification+" classification.", "", null, "", null, "0");
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

         if($("#radio_set").is(":checked"))
          {
            selected_unit()
          }
          else if($("#radio_lca").is(":checked"))
          {
            txtchklcaunitval()
          }
      }
    }
  })
}

function loadinquiry_unit_set()
{
  var classification_id = $("#txtinq_unitclass").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&form=loadinquiry_unit_set',
    success: function(data)
    {
      $("#list_unitUnit").html(data)
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
}

function datenow()
{
  var d = new Date();

  var month = d.getMonth()+1;
  var day = d.getDate();

  var output = (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day + '/' + d.getFullYear();

  $("#txtapp_datepayment").val(output);
  $("#txtapp_alertdate").val(output);
}

function unloadmodal_reservation_application(){
  $("#modal_div_inquiry").modal("hide");
  document.getElementById('btn_savereservation_print').style.display='none';
}

function countallselectedmonth()
{
  var paymentterms = $("#txtinq_pymentterms").val();
  var i = 0;
  var amt = 0;
  $("#tbodypdc_inquiry tr").each(function(){
    var chk_advpyment = $(this).find(".chk_advpyment");
    if(paymentterms == "1time"){
      var txtadvpyment = parseInt(($(this).find(".txtadvpyment").val())||0);
    }else{
      var txtadvpyment = parseInt(($(this).find(".txtadvpyment").val()).replace(",", "")||0);
    }
    if(chk_advpyment.is(":checked"))
    {
      i++;
      amt+=txtadvpyment;
    }
  });
  $("#txtinq_monthlyadvamt").val(i);
  $("#txtinq_advancepayment").val(amt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
  $("#txtinq_advancepayment2").val(amt.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
}

function removeassocdues(){
  $("#txtinq_assocdues").val("");
  var monthly = $("#txtinq_totalsqm").val();
  $("#txtinq_totalmonthlydues").val(monthly);
  loaddatetofunction();
  $("#chkassocdues").attr("onclick", "getassocdues()");
}

function getassocdues(){
  var mallid = $("#txtinq_mallbranch").val();
  if($("#radio_set").is(":checked"))
  {
    var unitid = $("#txtinq_unitunit").val();
  }
  else if($("#radio_lca").is(":checked"))
  {
    var unitid = $("#txtinq_lca_unitname").val();
  } 
  var monthlydue = $("#txtinq_totalsqm").val().replace(",", "")||0;
  if(monthlydue == ""){
    var monthlydue2 = 0;
  }else{
    var monthlydue2 = monthlydue;
  }
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unitid=' + unitid + '&mallid=' + mallid + '&form=getassocdues',
    success:function(data){
      var arr = data.split("|");
      var total = parseFloat(arr[0].replace(",", ""))+parseFloat(monthlydue2);
      if($("#chkassocdues").is(":checked")){
        $("#txtinq_assocdues").val(arr[0]);
        $("#txtinq_totalmonthlydues").val(total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        loaddatetofunction();
      }else{
        $("#txtinq_assocdues").val(arr[0]);
        $("#txtinq_totalmonthlydues").val(arr[0]);
        loaddatetofunction();
      }
      $("#chkassocdues").attr("onclick", "removeassocdues()");
    }
  })
}

function forinputofdetails(tipo){
  loaddatetofunction();
  if(tipo == "Cash"){
    $("#btnforinputofdetails").prop("disabled", true);
    $("#modalforinputofdetailsheader").text("");
    $(".ptinfocordcard").css("display", "none");
    $(".ptinfobanktransfer").css("display", "none");
    $(".paymenttypeinformationcord").css("display", "none");
    $(".paymenttypeinformationbtob").css("display", "none");
    $("#paymenttypeinformation").css("display", "none");
    $("#cashheaderto").css("display", "table-row");
    $("#checkheaderto").css("display", "none");
  }else if(tipo == "Check"){
    $("#btnforinputofdetails").prop("disabled", true);
    $("#modalforinputofdetailsheader").text("Check Information");
    $(".ptinfocordcard").css("display", "none");
    $(".ptinfobanktransfer").css("display", "none");
    $(".paymenttypeinformationcord").css("display", "none");
    $(".paymenttypeinformationbtob").css("display", "none");
    $("#paymenttypeinformation").css("display", "none");
    $("#checkheaderto").css("display", "table-row");
    $("#cashheaderto").css("display", "none");
  }else if(tipo == "Credit Card"){
    $("#btnforinputofdetails").prop("disabled", false);
    $("#modalforinputofdetailsheader").text("Credit Card Information");
    $(".ptinfocordcard").css("display", "block");
    $(".ptinfobanktransfer").css("display", "none");
    $(".paymenttypeinformationcord").css("display", "block");
    $(".paymenttypeinformationbtob").css("display", "none");
    $("#paymenttypeinformation").css("display", "block");
    $("#checkheaderto").css("display", "none");
    $("#cashheaderto").css("display", "none");
    $("#cashheaderto").css("display", "table-row");
    $("#checkheaderto").css("display", "none");
  }else if(tipo == "Debit Card"){
    $("#btnforinputofdetails").prop("disabled", false);
    $("#modalforinputofdetailsheader").text("Debit Card Information");
    $(".ptinfocordcard").css("display", "block");
    $(".ptinfobanktransfer").css("display", "none");
    $(".paymenttypeinformationcord").css("display", "block");
    $(".paymenttypeinformationbtob").css("display", "none");
    $("#paymenttypeinformation").css("display", "block");
    $("#checkheaderto").css("display", "none");
    $("#cashheaderto").css("display", "none");
    $("#cashheaderto").css("display", "table-row");
    $("#checkheaderto").css("display", "none");
  }else if(tipo == "Bank Transfer"){
    $("#btnforinputofdetails").prop("disabled", false);
    $("#modalforinputofdetailsheader").text("Bank Transfer Information");
    $(".ptinfocordcard").css("display", "none");
    $(".ptinfobanktransfer").css("display", "block");
    $(".paymenttypeinformationcord").css("display", "none");
    $(".paymenttypeinformationbtob").css("display", "block");
    $("#paymenttypeinformation").css("display", "block");
    $("#checkheaderto").css("display", "none");
    $("#cashheaderto").css("display", "none");
    $("#cashheaderto").css("display", "table-row");
    $("#checkheaderto").css("display", "none");
  }
}

function savepaymenttypeinfo(){
  $("#modalforinputofdetails").modal("hide");
  var paymenttype = $("#txtinq_pymenttype").val();
  var n = $("#ptinfocardtype").val();
  var a = $("#ptinfocardholder").val();
  var b = $("#ptinfoauthno").val();
  var c = $("#ptinfosecuritycode").val();
  var d = $("#ptinfoccno1").val();
  var e = $("#ptinfoccno2").val();
  var f = $("#ptinfoccno3").val();
  var g = $("#ptinfoccno4").val();
  var h = $("#ptinfoexpirymonth").val();
  var i = $("#ptinfoexpiryyear").val();
  var j = $("#ptinfobankfrom").val();
  var k = $("#ptinfobf_accno").val();
  var l = $("#ptinfobankto").val();
  var m = $("#ptinfobt_accno").val();
  if(paymenttype == "Credit Card" || paymenttype == "Debit Card"){
    $("#viewinquirycardtype").val(n);
    $("#viewinquirycc1").val(d);
    $("#viewinquirycc2").val(e);
    $("#viewinquirycc3").val(f);
    $("#viewinquirycc4").val(g);
    $("#viewinquirymm").val(h);
    $("#viewinquiryyy").val(i);
  }else{
    $("#viewinquirybf").val(j);
    $("#viewinquirybf_acc").val(k);
    $("#viewinquirybt").val(l);
    $("#viewinquirybt_acc").val(m);
  }
  loaddatetofunction();
}

function showmodalforinputofdetails(){
  var inqid = $("#paymenttypeinfo").val();
  var paymenttype = $("#txtinq_pymenttype").val();
  $.ajax({
    type: 'POSt',
    url: 'mainclass.php',
    data: 'paymenttype=' + paymenttype + '&inqid=' + inqid + '&form=onloadcardinfo',
    success:function(data){
      var arr = data.split("|");
      if(data != ""){
        if(paymenttype == "Credit Card" || paymenttype == "Debit Card"){
          $("#ptinfocardtype").val(arr[0]);
          $("#ptinfocardholder").val(arr[1]);
          $("#ptinfoauthno").val(arr[2]);
          $("#ptinfosecuritycode").val(arr[3]);
          var arr2 = arr[5].split("-");
          $("#ptinfoccno1").val(arr2[0]);
          $("#ptinfoccno2").val(arr2[1]);
          $("#ptinfoccno3").val(arr2[2]);
          $("#ptinfoccno4").val(arr2[3]);
          var arr3 = arr[4].split("-");
          $("#ptinfoexpirymonth").val(arr3[0]);
          $("#ptinfoexpiryyear").val(arr3[1]);
        }else{
          $("#ptinfobankfrom").val(arr[0]);
          $("#ptinfobf_accno").val(arr[1]);
          $("#ptinfobankto").val(arr[2]);
          $("#ptinfobt_accno").val(arr[3]);
        }
      }else{
        $("#ptinfocardtype").val("");
        $("#ptinfocardholder").val("");
        $("#ptinfoauthno").val("");
        $("#ptinfosecuritycode").val("");
        $("#ptinfoccno1").val("");
        $("#ptinfoccno2").val("");
        $("#ptinfoccno3").val("");
        $("#ptinfoccno4").val("");
        $("#ptinfoexpirymonth").val("");
        $("#ptinfoexpiryyear").val("");
        $("#ptinfobankfrom").val("");
        $("#ptinfobf_accno").val("");
        $("#ptinfobankto").val("");
        $("#ptinfobt_accno").val("");
      }
    }
  })
}

function savepaymenttypeinfo(){
  $("#modalforinputofdetails").modal("hide");
  loaddatetofunction();
}

function clearcardinfomodal(){
  $("#modalforinputofdetails :input").val("");
}

function clickone(){
  $("#monthlyduesiconforsave").css("display", "block");
  $("#monthlyduesiconforclose").css("display", "block");
  $("#monthlyduesiconforedit").css("display", "none");
  $("#txtinq_totalsqm").prop("disabled", false);
}

function clicktwo(){
  $("#monthlyduesiconforsave").css("display", "none");
  $("#monthlyduesiconforclose").css("display", "none");
  $("#monthlyduesiconforedit").css("display", "block");
  $("#txtinq_totalsqm").prop("disabled", true);
  loaddatetofunction();
}

function clickthree(){
  $("#monthlyduesiconforsave").css("display", "none");
  $("#monthlyduesiconforclose").css("display", "none");
  $("#monthlyduesiconforedit").css("display", "block");
  $("#txtinq_totalsqm").prop("disabled", true);
  var assocdues = $("#txtinq_assocdues").val().replace(",", "")||0;
  if($("#radio_set").is(":checked")){
    var unitid = $("#txtinq_unitunit").val();
  }
  else if($("#radio_lca").is(":checked")){
    var unitid = $("#txtinq_lca_unitname").val();
  }
  var inqid = $("#paymenttypeinfo").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unitid=' + unitid + '&inqid=' + inqid + '&form=reloadmonthlydues',
    success:function(data){
      var total = parseFloat(data.replace(",", ""))+parseFloat(assocdues);
      if($("#chkassocdues").is(":checked")){
        $("#txtinq_totalsqm").val(data);
        $("#txtinq_totalmonthlydues").val(total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
      }else{
        $("#txtinq_totalsqm").val(data);
        $("#txtinq_totalmonthlydues").val(data);
      }
    }
  })
  loaddatetofunction();
}

function clearrent(){
  $("#txtinq_totalsqm").val("");
  $("#chkclearrent").attr("onclick", "retrieverent()");
  if($("#radio_set").is(":checked")){
    var unitid = $("#txtinq_unitunit").val();
  }
  else if($("#radio_lca").is(":checked")){
    var unitid = $("#txtinq_lca_unitname").val();
  }
  var assocdues = $("#txtinq_assocdues").val();
  $("#monthlyduesiconforedit").prop("disabled", true);
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unitid=' + unitid + '&form=dipslaytotalonly',
    success:function(data){
        
      if($("#chkassocdues").is(":checked")){
        $("#txtinq_totalmonthlydues").val(data);
        loaddatetofunction();
      }else{
        $("#txtinq_totalmonthlydues").val("");
        loaddatetofunction();
      }
    }
  })
}

function retrieverent(){
  if($("#radio_set").is(":checked")){
    var unitid = $("#txtinq_unitunit").val();
  }
  else if($("#radio_lca").is(":checked")){
    var unitid = $("#txtinq_lca_unitname").val();
  }
  var assocdues = $("#txtinq_assocdues").val().replace(",", "")||0;
  var inqid = $("#paymenttypeinfo").val();
  $("#monthlyduesiconforedit").prop("disabled", false);
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unitid=' + unitid + '&inqid=' + inqid + '&form=reloadmonthlydues',
    success:function(data){
      $("#txtinq_totalsqm").val(data);
      var total = parseFloat(data.replace(",", ""))+parseFloat(assocdues);
      if($("#chkassocdues").is(":checked")){
        $("#txtinq_totalmonthlydues").val(total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        loaddatetofunction();
      }else{
        $("#txtinq_totalmonthlydues").val(data);
        loaddatetofunction();
      }
      $("#chkclearrent").attr("onclick", "clearrent()");
    }
  })
}

function removeassocdues(){
  $("#txtinq_assocdues").val("");
  var monthly = $("#txtinq_totalsqm").val();
  $("#txtinq_totalmonthlydues").val(monthly);
  loaddatetofunction();
  $("#chkassocdues").attr("onclick", "getassocdues()");
}

function getassocdues(){
  var mallid = $("#txtinq_mallbranch").val();
  if($("#radio_set").is(":checked"))
  {
    var unitid = $("#txtinq_unitunit").val();
  }
  else if($("#radio_lca").is(":checked"))
  {
    var unitid = $("#txtinq_lca_unitname").val();
  } 
  var monthlydue = $("#txtinq_totalsqm").val().replace(",", "")||0;
  if(monthlydue == ""){
    var monthlydue2 = 0;
  }else{
    var monthlydue2 = monthlydue;
  }
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'unitid=' + unitid + '&mallid=' + mallid + '&form=getassocdues',
    success:function(data){
      var arr = data.split("|");
      var total = parseFloat(arr[0].replace(",", ""))+parseFloat(monthlydue2);
      if($("#chkassocdues").is(":checked")){
        $("#txtinq_assocdues").val(arr[0]);
        $("#txtinq_totalmonthlydues").val(total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
        loaddatetofunction();
      }else{
        $("#txtinq_assocdues").val(arr[0]);
        $("#txtinq_totalmonthlydues").val(arr[0]);
        loaddatetofunction();
      }
      $("#chkassocdues").attr("onclick", "removeassocdues()");
    }
  })
}

function foreditingofamount(){
  var monthly = $("#txtinq_totalsqm").val().replace(",", "")||0;
  var assocdues = $("#txtinq_assocdues").val().replace(",", "")||0;
  var total = parseFloat(monthly)+parseFloat(assocdues);
  if($("#chkassocdues").is(":checked")){
    $("#txtinq_totalmonthlydues").val(total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
  }else{
    $("#txtinq_totalmonthlydues").val(monthly.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
  }
  loaddatetofunction();
}

function paymentterms_LCA(){
  $("#txtinq_pymentterms").html("<option value=''>-- Select Payment Terms --</option><option value='daily'>Daily</option><option value='monthly'>Monthly</option><option value='1time'>1 Time Payment</option>");
}

function paymentterms_SET(){
  $("#txtinq_pymentterms").html("<option value=''>-- Select Payment Terms --</option><option value='monthly'>Monthly</option><option value='1time'>1 Time Payment</option>");
}
</script>
