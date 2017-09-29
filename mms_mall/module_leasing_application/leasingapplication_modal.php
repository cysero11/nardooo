<div class="modal fade" id="modal_previewleasingapplication" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" id="modal_div_inquiry" style="width: 85%;">
    <!-- Modal content-->
    <div class="modal-content ">
    <div id="leasingloadingscreen"></div>
       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <input type="hidden" id="statinquiryyy" name="">
        <button type="button" class="close" onclick="closeinquirymodal()">&times;</button>
        <h4 class="modal-title" id="div_modal_title_inquiry" style="color:white; font-weight: bold;">Leasing Application</h4>
        <input type="hidden" class="text_inquiry" id="txtinq_inquiryid" name="">
        <input type="hidden" class="text_inquiry" id="txtinq_app_status" name="">
        <input type="hidden" id="status_filled" name="">
        <input type="hidden" id="txtselected_month" name="">
      </div>
       <!-- Modal body-->
      <div class="modal-body" id="div_view_inquiry_modal">
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
                        Business Information
                      </a>
                    </li>

                    <li>
                      <a data-toggle="tab" href="#unitinfo" onclick="changemallselected()">
                      <i class="yellow ace-icon fa fa-key bigger-120"></i>
                        Unit Information
                      </a>
                    </li>

                    <!-- <li class="dropdown">
                      <a data-toggle="tab" href="#contactperson">
                      <i class="blue ace-icon fa fa-user bigger-120"></i>
                        Contact Persons
                      </a>
                    </li> -->

                    <li class="dropdown">
                      <a data-toggle="tab" href="#remarks">
                      <i class="orange ace-icon fa fa-folder-open bigger-120"></i>
                        Requirements and Remarks
                      </a>
                    </li>
                  </ul>

                  <div class="tab-content" style="height: 50em;overflow-y: scroll;padding-bottom:0px;padding-top: 10px;">
                    <div id="home" class="tab-pane fade in active">
                      <div class="row form-group" style="margin-bottom: 0px;">
                        <div class="col-md-6 col-xs-12">
                            <div class="well" style="padding-bottom: 0px;padding-top: 20px;">
                              <div class="row form-group">
                                <div class="row form-group">
                                  <div class="col-xs-12 col-md-12 col-lg-12">
                                    <h4 class="green smaller lighter">Business Information</h4>
                                  </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="row form-group">
                                      <div class="col-md-3 col-xs-12">
                                            Mall Branch
                                      </div>
                                      <div class="col-md-9 col-xs-12">
                                        <!-- <input list="list_mallbranch" type="text" li="txtbuss" placeholder="-- Select Mall Branch --"  oninput="changemallselected()"/>
                                            <datalist id="list_mallbranch">
                                              <?php 
                                                $queryind = "Select mallid, mallname FROM tblref_mall";
                                                $rsss = mysql_query($queryind, $connection);
                                              while($row = mysql_fetch_array($rsss)){
                                                $industry = "<option id='".$row['mallid']."' ";
                                                $industry .= "value='".$row['mallname']."' selected/>"; 

                                                echo $industry;
                                              }
                                            ?>
                                            </datalist> -->

                                        <select id="txtinq_mallbranch" class="form-control text_inquiry required_inq disable_this">
                                          <?php 
                                                echo "<option value=''>-- Select Mall --</option>";
                                                $queryind = "SELECT mallid, mallname FROM tblref_mall WHERE mallstat != '0' ";
                                                $rsss = mysql_query($queryind, $connection);
                                              while($row = mysql_fetch_array($rsss)){
                                                $industry = "<option value='".$row['mallid']."'> ";
                                                $industry .= $row['mallname']." </option>"; 

                                                echo $industry;
                                              }
                                            ?>
                                        </select>
                                      </div>
                                    </div> 

                                    <div class="row form-group">
                                      <div class="col-md-3 col-xs-12">
                                            Store Name
                                      </div>
                                      <div class="col-md-9 col-xs-12">
                                          <input type="text" id="txtinq_tradename" name="" class="form-control text_inquiry required_inq disable_this" placeholder="Click to search store name ..." onclick="loadtradefunction()" onfocus="loadtradefunction()">
                                      </div>                     
                                    </div> 

                                    <div class="row form-group">
                                      <div class="col-md-3 col-xs-12">
                                            Company
                                      </div>
                                      <div class="col-md-9 col-xs-12">
                                          <input type="text"  style="" id="txtinq_companyname" name="" class="form-control text_inquiry required_inq" placeholder="Company Name" disabled>
                                      </div>                     
                                    </div> 

                                    <div class="row form-group">
                                      <div class="col-md-3 col-xs-12">
                                            Industry
                                      </div>
                                      <div class="col-md-9 col-xs-12">
                                          <input type="text"  style="" id="txtinq_industryname" name="" class="form-control text_inquiry required_inq" placeholder="Select Industry" disabled>
                                      </div>                     
                                    </div> 

                                    <div class="row form-group">
                                      <div class="col-md-3 col-xs-12">
                                            Address
                                      </div>
                                      <div class="col-md-9 col-xs-12">
                                          <textarea style="height: 70px;" id="txtinq_address" class="form-control text_inquiry required_inq" placeholder="Address" disabled></textarea>
                                      </div>                     
                                    </div>                      
                                </div>
                              </div>
                            </div>
                        </div> 

                        <div class="col-md-6 col-xs-12">  
                          <div class="well" style="padding-bottom: 0px;padding-top: 20px;">
                              <div class="row form-group">
                                <div class="col-xs-12">
                                  <h4 class="green smaller lighter">Contact Information</h4>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-xs-12" style="display: inline-block; height: 265px;overflow-y: scroll;" id="div_inquiry_contact_numbers">
                                  
                                </div>
                              </div>
                          </div>
                        </div>                  
                      </div> 
                      <div class="row form-group">           
                        <div class="col-md-12 col-xs-12">
                            <div class="well">
                              <div class="row form-group">
                                <div class="col-xs-12">
                                  <h4 class="green smaller lighter">Contact Persons</h4>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-xs-12" style="display: inline-block; height: 380px; overflow-y: scroll;" id="div_inquiry_contact_person">
                                </div>
                              </div>
                            </div>
                        </div>                    
                      </div>
                    </div>

                    <div id="unitinfo" class="tab-pane fade">
                      <div class="row form-group">
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
                                                <input name="form-field-radio" type="radio" class="ace disable_this" id="radio_set" onclick="clickset()" />
                                                <span class="lbl">&nbsp;&nbsp;&nbsp;SET</span>
                                              </label>
                                            </div>
                                          </div>
                                          <div class="col-md-8">
                                            <div class="radio">
                                              <label>
                                                <input name="form-field-radio" type="radio" class="ace disable_this" id="radio_lca" onclick="clicklca()" />
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
                                              <select id="txtinq_unitclass" class="form-control text_inquiry required_inq disable_this" onchange="changeclassification()">
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
                                              <select id="txtinq_unitdepartment" class="form-control text_inquiry required_inq disable_this" onchange="loadinquiry_category()">
                                            <option value="">-- Select Department --</option>
                                            </select>
                                            </div>
                                          </div>
                                          <div class="row form-group">
                                            <div class="col-md-4">
                                              Category
                                            </div>
                                            <div class="col-md-8">
                                             <select id="txtinq_unitcategory" class="form-control disable_this text_inquiry required_inq" onchange="loadinquiry_wing_lca()">
                                              <option value="">-- Select Category --</option>
                                             </select>
                                            </div>
                                          </div>
                                          <div class="row form-group" id="div_wing">
                                            <div class="col-md-4">
                                              Wing/Bldg
                                            </div>
                                            <div class="col-md-8">
                                              <select id="txtinq_unitwing" class="form-control text_inquiry disable_this" onchange="loadinquiry_flr()">
                                                <option value="">-- Select Wing --</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row form-group" id="div_floor">
                                            <div class="col-md-4">
                                              Floor
                                            </div>
                                            <div class="col-md-8">
                                              <select id="txtinq_unitfloor" class="form-control text_inquiry disable_this" onchange="loadinquiry_unit_lca()" >
                                                <option value="">-- Select Floor --</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row form-group" id="div_unit_set">
                                            <div class="col-md-4">
                                              Unit
                                            </div>
                                            <div class="col-md-8">
                                              <select id="txtinq_unitunit" class="form-control text_inquiry disable_this" onchange="selected_unit();" >
                                                <option value="">-- Select Unit --</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="row form-group" id="div_unit_lca">
                                            <div class="col-md-4">
                                              Unit
                                            </div>
                                            <div class="col-md-8">
                                              <select class="form-control disable_this" name="" id="txtinq_lca_unitname" placeholder="Enter Unit Name" onchange="txtchklcaunitval();selected_lca_unit();">
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
                                            <select class="form-control text_inquiry disable_this" id="txtinq_pymentterms" onchange="loaddatetofunction();">
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
                                              <button class="btn spinbox-up btn-sm btn-success" id="btnforinputofdetails" onclick='$("#modalforinputofdetails").modal("show");' disabled><i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i></button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xs-4 col-md-4">
                                  <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 10px;">
                                    <div class="col-xs-12">
                                      <div class="row form-group" id="div_unit_area_set">
                                        <div class="col-md-4">
                                          Unit Area
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                          <input type="text" class="form-control text_inquiry" name="" id="txtinq_sqm" style="text-align: right;" disabled="" placeholder="Square Meter">
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
                                          <input type="text" class="form-control amount numonly text_inquiry" onkeyup="unitareachk()" style="text-align: right;" name="" placeholder="0.00" id="txtinq_persqm" disabled="">
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
                                          <input type="text" class="form-control amount numonly text_inquiry" onkeyup="loaddatetofunction();foreditingofamount();" style="text-align: right;" name="" placeholder="0.00" id="txtinq_totalsqm" disabled="">
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
                                          <input type="text" class="form-control amount numonly " style="text-align: right;" placeholder="0.00" id="txtinq_totalmonthlydues" disabled="">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row form-group" style="border: 1px dotted #CCC;margin-right: 3px;margin-left: 3px;padding-top: 10px;">
                                    <div class="row form-group" style="margin-right: 3px;margin-left: 3px;">
                                      <div class="col-xs-12">
                                        <div class="row form-group">
                                          <div class="col-md-4">
                                            Occupancy Date
                                          </div>
                                          <div class="col-md-4">
                                            <input class="form-control date-picker disable_this" id="txtinq_datefrom" type="text" data-date-format="m/d/Y"  onchange="loaddatetofunction();"/>
                                          </div>
                                          <div class="col-md-4">
                                            <input type="text" name="" id="txtinq_dateto" class="form-control date-picker" data-date-format="m/d/Y" onchange="loaddatetofunction8()" disabled>

                                          </div>
                                        </div>
                                        <div class="row form-group" id="div_nomonths" style="display: block;">
                                          <div class="col-md-4">
                                            No of Months
                                          </div>
                                          <div class="col-md-2">
                                            <input type="text" class="form-control numonly text_inquiry disable_this" placeholder="0" name="" id="txtnoofmonths_inq" onkeyup="loaddatetofunction();" maxlength="2">
                                          </div>
                                          <div class="col-md-1" style="margin-top: 5px;">
                                            <span style="font-weight: bold;">x</span>
                                          </div>
                                          <div class="col-md-4">
                                            <input type="text" class="form-control" id="txtmonthlymath" style="text-align: right;" disabled>
                                          </div>
                                        </div>                                                                         
                                        <div class="row form-group" id="div_nodays" style="display: none;">
                                          <div class="col-md-4">
                                            No of Days
                                          </div>
                                          <div class="col-md-2">
                                             <input type="text" class="form-control disable_this numonly text_inquiry" placeholder="0" name="" id="txtnoofdays_inq" onkeyup="reqmonORday();loaddatetofunction()">
                                          </div>
                                          <div class="col-md-1" style="margin-top: 5px;">
                                            <span style="font-weight: bold;">x</span>
                                          </div>
                                          <div class="col-md-4">
                                            <input type="text" class="form-control" id="txtmonthlymathdays" style="text-align: right;" disabled>
                                          </div>
                                        </div>
                                        <div class="row form-group" style="margin-bottom: -3px;">
                                          <div class="col-md-4" id="txtlabel_payment">
                                            Total Amount
                                          </div>
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
                                            <input class="form-control text_inquiry numonly disable_this" id="txtinq_monthlydepamt" type="text" placeholder="0" onkeyup="loaddatefunction4()"  maxlength="2" style="display: none;"/>
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" id="txtinq_depositpayment" style="text-align: right;background-color: white;" class="numonly form-control amount text_inquiry" placeholder="0.00" disabled="true" />
                                            <h6 style="font-size:10px; font-style: italic;">(Deposit is not deducted from the total amount. but can be applied for refund or credit memo.)</h6>
                                          </div>
                                        </div>    
                                        <div class="row form-group" id="div_advance_set" style="margin-bottom: -3px;">
                                          <div class="col-md-4">
                                            Advance<br />
                                            <h6 style="font-size:10px; font-style: italic;">(No of Months)</h6>
                                          </div>
                                          <div class="col-md-2">
                                            <input class="form-control text_inquiry numonly disable_this" id="txtinq_monthlyadvamt" type="text" placeholder="0" onkeyup="loaddatefunction4()"  maxlength="2"/>
                                          </div>
                                          <div class="col-md-6">
                                            <input type="text" id="txtinq_advancepayment" style="text-align: right;background-color: white;" class="numonly form-control text_inquiry amount" placeholder="0.00" disabled="true" />
                                            <h6 style="font-size:10px; font-style: italic;">(Please settle the amount in the cashiering)</h6>
                                          </div>
                                        </div>
                                        <div class="row form-group" id="div_deposit_set_amt" style="margin-bottom: -3px;">
                                          <div class="col-md-4">
                                            Deposit
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" id="txtinq_depositpayment2" style="text-align: right;" class="numonly amount form-control text_inquiry disable_this" placeholder="0.00" />
                                          </div>
                                        </div> 
                                        <div class="row form-group" id="div_advance_set_amt" style="margin-bottom: -3px;">
                                          <div class="col-md-4">
                                            Advance<br />
                                            <h6 style="font-size:10px; font-style: italic;">(No of Months)</h6>
                                          </div>
                                          <div class="col-md-8">
                                            <input type="text" id="txtinq_advancepayment2" style="text-align: right;" class="numonly amount form-control text_inquiry disable_this" placeholder="0.00" />
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
                                  <h4 class="green smaller lighter">Payment Schedule</h4>
                                  <h6 class="blue smaller lighter" id="txtclick2"><i class="fa fa-check orange"></i> Select months that will have advance payment</h6>
                                </div>
                              </div>
                              <div class="row form-group">
                                <div class="col-md-12 col-xs-12">
                                  <div id="statussavingreservation"></div>
                                  <div class="parent3">
                                    <table class="table table-striped table-bordered fixTable">
                                      <thead>
                                        <tr>
                                          <td width="10%" class="center"><span class="fa fa-money" style="font-size: 18px;"></span></td>
                                          <td>Date of Payment</td>
                                          <th style="text-align: right;">Amount Due</th>
                                          <th style="text-align: right;">Association Due</th>
                                          <th style="text-align: right;">Total Due</th>
                                          <td style="text-align: right;">Advance Payment</td>
                                        </tr>
                                      </thead>
                                      <tbody id="tbodypdc_inquiry"></tbody>
                                    </table>   
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
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> 
                      </div>
                    </div>

                    <div id="remarks" class="tab-pane fade">
                      <div class="row form-group" style="margin-bottom: 0px;">
                        <div class="col-md-12 col-xs-12" >
                          <div class="well" id="div_modal_inquiry_requirements">
                            <div class="row form-group">
                              <div class="col-xs-12">
                                <h4 class="green smaller lighter">Requirements</h4>
                              </div>
                            </div>
                            <div class="row form-group">
                              <div class="col-xs-12" style="display: block;height: 220px;overflow-y: hidden; overflow-x: hidden;" id="div_modal_inquiry_requirements2">
                                <form name="posting_comment" id="posting_comment"> 
                                      <input type="hidden" name="txtaapid" id="txtappid_form">
                                      <input type="hidden" name="txtinqqid" id="txtinqid_form">
                                    <div class="form-group" id="div_req_passed">
                                      <?php 
                                        $queryind = "Select id, requirements, override FROM tblref_applicationrequirements";
                                        $rsss = mysql_query($queryind, $connection);
                                         while($row = mysql_fetch_array($rsss)){
                                              ?>
                                              <div class="row">
                                                <div class="col-xs-6"><?php echo $row["requirements"]; ?></div>
                                                <div class="col-xs-6">
                                                  <input type="file" class="upload_app_req id-input-file-2" name="attachment_file[]"/>
                                                  <input type="hidden" name="hiddenid[]" value="<?php echo $row["id"]; ?>"/>
                                                </div>
                                              </div>
                                              <?php

                                        }
                                    ?>
                                    </div>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>          
                        <div class="col-md-12 col-xs-12" id="div_modal_inquiry_remarks">
                          <div class="well" id="fornewapp_remarks">
                            <div class="row form-group" style="margin-bottom: 0px;">
                              <div class="col-md-8 col-xs-12">
                                <h4 class="green smaller lighter">Remarks</h4>
                              </div>
                              <div class="col-md-4 col-xs-12" style="padding-right: 17px;">
                                <button class="btn btn-xs btn-info" style="float: right;" id="btnaddnewreeeeem" onclick="addnewremarks()"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;Add New Remarks</button>
                              </div>
                            </div>
                            <div class="row form-group" style="padding-top: 0px;height:225px;overflow-y:scroll;">
                              <div class="col-xs-12">
                                  <ol class="dd-list" id="remarkslist_ol"></ol>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div>
        </div>
      </div>

       <!-- Modal footer-->
      <div class="modal-footer">
        <div class="row form-group" style="margin-bottom: 0px;">
          <div class="col-md-4" style="padding-top: 5px;">
            <label class="updatedby_texts">
              <small class="text-success pull-left">
                <b>Created by:</b>&nbsp;<i id="txtapp_createdby"></i>
              </small>
              <small class="text-success pull-left">
                <b>Date Created:</b>&nbsp;<i id="txtapp_datecreated"></i>
              </small>
            </label>
          </div>
          <div class="col-md-4 pull-left" style="padding-top: 5px;">
            <label class="updatedby_texts">
              <small class="text-success pull-left">
                <b>Modified by:</b>&nbsp;<i id="txtapp_modifby"></i>
              </small>
              <small class="text-success pull-left">
                <b>Date Modified:</b>&nbsp;<i id="txtapp_modifdate"></i>
              </small>
            </label>
          </div>
          <div class="col-md-4">
            <button type="button" class="btn btn-primary" id="btn_updateleasingapplication" onclick="saveinquiry()"><i class="ace-icon fa fa-check"></i>&nbsp;<label id="">Save</label></button>
            <button type="button" class="btn btn-primary" id="btn_saveremrks" onclick=""><i class="ace-icon fa fa-check"></i>&nbsp;<label id="">Update</label></button>
            <button type="button" class="btn btn-primary" id="btn_saveinquiry" onclick=""><i class="ace-icon fa fa-check"></i>&nbsp;<label id="btntext_inq">For Approval</label></button>
            <button type="button" class="btn btn-danger" id="btn_disapprove" style="display: none;" onclick=""><i class="ace-icon fa fa-times"></i>&nbsp;<label id="">Disapprove</label></button>
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
                <button type="button" class="close" data-dismiss="modal" id="btnretrievecardinfo" aria-label="Close" onclick='$("#modalforinputofdetails").modal("hide");'>
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
$(function(){
    $("#status_filled").val("0");
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
      $("#totalpayment").text("Php 0.00");
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
      $("#totalpayment").text("Php 0.00");
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
      $("#totalpayment").text("Php 0.00");
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
      $("#totalpayment").text("Php 0.00");
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
      $("#totalpayment").text("Php 0.00");
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
      $("#totalpayment").text("Php 0.00");
      $("#div_amenities_inquiry").html("");
    }
  });

  $('#modal_previewleasingapplication').on('shown.bs.modal', function() {
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

  $('#modal_previewleasingapplication').on('hidden.bs.modal', function() {
    $("#txtsearchapplication").focus();
  })  

  $(".required_inq").keyup(function(){
    $("#status_filled").val("1");
  })

  $(".required_inq").change(function(){
    $("#status_filled").val("1");
  })

  $("#ptinfoccno1").keyup(function(){
    var len = ($(this).val()).length;
    if(len == 4)
    {
      $("#ptinfoccno2").focus();
    }
  })

  $("#ptinfoccno2").keyup(function(){
    var len = ($(this).val()).length;
    if(len == 4)
    {
      $("#ptinfoccno3").focus();
    }
  })

  $("#ptinfoccno3").keyup(function(){
    var len = ($(this).val()).length;
    if(len == 4)
    {
      $("#ptinfoccno4").focus();
    }
  })
});

function changemallselected()
{
  var appStat = $("#txtinq_app_status").val();
  var mallid = $("#txtinq_mallbranch").val();
  if(mallid != "" && mallid != undefined && appStat != "approve" && appStat != "for_approval")
  {
    $("#txtinq_unitclass").prop("disabled", false);
  }
  else if(appStat == "update_application")
  {
    $("#txtinq_unitclass").prop("disabled", true);
    $("#txtinq_unitclass").val("");
    changeclassification();
  }
  else
  {
    $("#txtinq_unitclass").prop("disabled", true);
  }
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'mallid=' + mallid + '&form=showdepositperc',
    success:function(data2){
      $("#depositpercentage").text(data2);
    }
  })
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
    clearcardinfomodal();
    $("#alertmodal").modal("hide");
    $("#modal_previewleasingapplication").modal("hide");
  }
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
  var unit_id =  $("#txtinq_unitunit").val();
  var txtinq_mallbranch = $("#txtinq_mallbranch").val();
  if(unit_id != "")
  {
    $("#txtinq_datefrom").prop("disabled", false);
    $("#txtnoofmonths_inq").prop("disabled", false);
    $("#txtinq_monthlyadvamt").prop("disabled", true); //autofill
    $("#txtinq_advancepayment").prop("disabled", true); //autofill
    $("#txtinq_monthlydepamt").prop("disabled", false);
    // $("#txtinq_depositpayment").prop("disabled", true); //autofill
    // $("#txtinq_monthlyrate2").prop("disabled", true); //autofill
    $("#txtinq_persqm").prop("disabled", true);
    $("#txtinq_pymentterms").prop("disabled", false);
    $("#txtinq_pymenttype").prop("disabled", false);

    //require set unit information if SET UNIT is NOT empty
    $("#txtinq_datefrom").addClass("required_inq");
    $("#txtinq_dateto").addClass("required_inq");
    $("#txtnoofmonths_inq").addClass("required_inq");
    $("#txtinq_monthlyadvamt").addClass("required_inq");
    $("#txtinq_advancepayment").addClass("required_inq");
    $("#txtinq_monthlydepamt").addClass("required_inq");
    $("#txtinq_depositpayment").addClass("required_inq");
    // $("#txtinq_monthlyrate2").addClass("required_inq");
    $("#txtinq_sqm").addClass("required_inq");
    $("#txtinq_persqm").addClass("required_inq");
    $("#txtinq_totalsqm").addClass("required_inq");
    $("#txtinq_pymentterms").addClass("required_inq");
    $("#txtinq_pymenttype").addClass("required_inq");
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
    // $("#txtnoofmonths_inq").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_monthlyadvamt").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_advancepayment").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_monthlydepamt").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_depositpayment").removeClass("required_inq"); //remove required. empty naman yung unit
    // $("#txtinq_monthlyrate2").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_sqm").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_persqm").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_totalsqm").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtnoofdays_inq").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_sqm_width").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_sqm_length").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_advancepayment2").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_depositpayment2").removeClass("required_inq"); //remove required. empty naman yung unit
    $("#txtinq_pymentterms").removeClass("required_inq");
    $("#txtinq_pymenttype").removeClass("required_inq");

    $("#txtinq_datefrom").prop("disabled", true);
    $("#txtnoofmonths_inq").prop("disabled", true);
    $("#txtinq_monthlyadvamt").prop("disabled", true);
    $("#txtinq_advancepayment").prop("disabled", true);
    $("#txtinq_monthlydepamt").prop("disabled", true);
    // $("#txtinq_depositpayment").prop("disabled", true);
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
      $("#txtinq_assocdues").val(arr[3]);
      $("#txtmonthlymath").val(arr[2]);
      $("#txtinq_totalmonthlydues").val(arr[4]);
      if(arr[3] == "0.00"){
        $("#chkassocdues").prop("checked", false);
      }else{
        $("#chkassocdues").prop("checked", true);
      }
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
    $("#txtinq_monthlyrate2").prop("disabled", true); //autofill
    
    $("#txtinq_dateto").prop("disabled", true); //autofill
    $("#txtnoofdays_inq").prop("disabled", false);
    $("#txtinq_advancepayment2").prop("disabled", true); //autofill
    $("#txtinq_depositpayment2").prop("disabled", false);
    $("#txtinq_sqm_width").prop("disabled", true); //autofill
    $("#txtinq_sqm_length").prop("disabled", true); //autofill
    $("#txtinq_persqm").prop("disabled", true); //autofill
    $("#txtinq_totalsqm").prop("disabled", true); //autofill
    $("#txtinq_pymentterms").prop("disabled", false);
    $("#txtinq_pymenttype").prop("disabled", false);

    //require lca unit information if LCA UNIT is NOT empty
    $("#txtinq_datefrom").addClass("required_inq");
    $("#txtinq_dateto").addClass("required_inq");
    // $("#txtnoofmonths_inq").addClass("required_inq");
    $("#txtnoofdays_inq").addClass("required_inq");
    $("#txtinq_monthlyrate2").addClass("required_inq");
    $("#txtinq_advancepayment2").addClass("required_inq");
    $("#txtinq_depositpayment2").addClass("required_inq");
    $("#txtinq_sqm_width").addClass("required_inq");
    $("#txtinq_sqm_length").addClass("required_inq");
    $("#txtinq_persqm").addClass("required_inq");
    $("#txtinq_totalsqm").addClass("required_inq");
    $("#txtinq_pymentterms").addClass("required_inq");
    $("#txtinq_pymenttype").addClass("required_inq");
  }
  else
  {
    $("#txtinq_datefrom").css("border-color", "#CCC"); //remove red border
    $("#txtinq_dateto").css("border-color", "#CCC"); //remove red border
    // $("#txtnoofmonths_inq").css("border-color", "#CCC"); //remove red border
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
    // $("#txtnoofmonths_inq").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_monthlyadvamt").removeClass("required_inq"); //remove trap. empty naman yung unit
    $("#txtinq_advancepayment").removeClass("required_inq"); //remove trap. empty naman yung unit
    // $("#txtinq_monthlydepamt").removeClass("required_inq"); //remove trap. empty naman yung unit
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
    $("#txtinq_pymentterms").removeClass("required_inq");
    $("#txtinq_pymenttype").removeClass("required_inq");

    $("#txtinq_dateto").val("");
    $("#txtnoofmonths_inq").val("");
    $("#txtinq_monthlyadvamt").val("");
    $("#txtinq_advancepayment").val("");
    $("#txtinq_monthlydepamt").val("");
    $("#txtinq_depositpayment").val("");
    $("#txtinq_monthlyrate2").val("");
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

    $("#txtinq_datefrom").prop("disabled", true);
    $("#txtnoofmonths_inq").prop("disabled", true);
    $("#txtinq_monthlyadvamt").prop("disabled", true);
    $("#txtinq_advancepayment").prop("disabled", true);
    $("#txtinq_monthlydepamt").prop("disabled", true);
    $("#txtinq_depositpayment").prop("disabled", true);
    $("#txtinq_monthlyrate2").prop("disabled", true);
    $("#txtinq_pymentterms").prop("disabled", true);
    $("#txtinq_pymenttype").prop("disabled", true);

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

function chkunitfrst()
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

    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'unit=' + unit + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=chkunitfrst',
      success: function(data)
      {
        var cont = "";
        if(data != "")
        {
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
          $("#statinquiryyy").val("valid");
          $("#txtinq_unitunit").css("border-color", "#CCC");
          $("#txtnoofmonths_inq").css("border-color", "#CCC");
          $("#txtnoofdays_inq").css("border-color", "#CCC");
          $("#txtinq_datefrom").css("border-color", "#CCC");
        }
      }
    })
}

function chkunitfrst2()
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
      data: 'unit=' + unit + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=chkunitfrst',
      success: function(data)
      {
        
        var cont = "";
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
  // }
  // else
  // {
  //   conttt = "valid";
  // }
  return conttt;
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
    $("#txtinq_lca_unitname").prop("disabled", true);
    $("#txtinq_unitwing").val("");
    $("#txtinq_unitfloor").val("");
    $("#txtinq_unitunit").val("");  
  }
  else
  {
    $("#txtinq_unitwing").prop("disabled", true);
    $("#txtinq_unitfloor").prop("disabled", true);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_lca_unitname").prop("disabled", true);
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

function loaddatetofunction8()
{
  var from = $("#txtinq_datefrom").val();
  var to = $("#txtinq_dateto").val();
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
            
            loaddatetofunction3(arr[1])
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
  var ttlamnt = ($("#txtinq_totalsqm").val()).replace(",", "");
  var datesel = $("#txtselected_month").val();
 if($("#radio_set").is(":checked"))
  {
    var unit_id = $("#txtinq_unitunit").val();
    var type = "SET";
  }
  else if($("#radio_lca").is(":checked"))
  {
    var unit_id = $("#txtinq_lca_unitname").val();
    var type = "LCA";
  }
  var typeaction = $("#statinquiry_txt").val();
  var pymntterms = $("#txtinq_pymentterms").val();
  var radassocdues = "";
  $(".radassocdues").each(function(){
    if ( $(this).is(":checked") == true ) {
      radassocdues = this.value;
    }
  });
  if(datefrom != "")
  {
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&ttlamnt=' + ttlamnt + '&pymntterms=' + pymntterms + '&radassocdues=' + radassocdues + '&form=loadtbodypdc_inquiry',
      beforeSend : function() {
        $('#indexloadingscreen').addClass('myspinner');
      },
      success: function(data){
        $('#indexloadingscreen').removeClass('myspinner');
        if(unit_id != undefined)
        {
          $("#tbodypdc_inquiry").html(data);  
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
          
          if(typeaction != "view")
          {
            // $("#txtclick2").text("Select months that will have advance payment.");
            $("#tbodypdc_inquiry tr").click(function(){
              var chkbox = $(this).find(".chk_advpyment");
              var amnt = $(this).find(".lblamntsetup");
              var txtadvc = $(this).find(".txtadvpyment");
              var lbladvc = $(this).find(".lbladvpyment");
              if(chkbox.is(":checked"))
              {
                txtadvc.css("display", "block");
                if(pymntterms == "monthly")
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
            })             
          }
          else
          {
            // $("#txtclick2").text("");
          }
        }

      }
    })
  }  
}

function countallselectedmonth()
{
  var paymentterms = $("#txtinq_pymentterms").val();
  var i = 0;
  var amt = 0;
  $("#tbodypdc_inquiry tr").each(function(){
    var chk_advpyment = $(this).find(".chk_advpyment");
    if(paymentterms =="1time"){
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
  var amt = $("#txtinq_totalsqm").val().replace(",", "");
  if(datefrom != "")
  {
    // alert(datefrom + "|" + dateto)
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&ttlamnt='  + amt + '&form=loadtbodypdc_inquiry2',
      success: function(data)
      {
        var arr = data.split("|");
        // alert(data)
        $("#lbltotalamountofpayment").text("Php " + arr[0]);
        $("#totalpayment").text("Php " + arr[0]);
        $("#txtmonthlymathdays").val(arr[3]);
        loaddatetofunction2(dateto)
        // loaddatefunction4(arr[1], arr[2]) //set units
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
  if(unit_id == "")
  {
    showmodal("alert", "Add unit first.", "", null, "", null, "1");
    $("#txtinq_unitunit").focus();
    $("#txtinq_monthlyadvamt").val("");
    $("#txtinq_monthlydepamt").val("");
  }
  else
  {
    if(noofmonths == "" || noofmonths == "0")
    {
      showmodal("alert", "Specify how many months first.", "", null, "", null, "1");
      $("#txtnoofmonths_inq").focus();      
      $("#txtinq_monthlyadvamt").val("");
      $("#txtinq_monthlydepamt").val("");
    }
    else
    {
        $.ajax({
          type: 'POST',
          url: 'mainclass.php',
          data: 'unit_id=' + unit_id + '&advance=' + advance + '&deposit=' + deposit + '&form=loaddatefunction4',
          success: function(data)
          {
              var ttl = parseInt(advance || 0);
              if(ttl > parseInt(noofmonths))
              {
                showmodal("alert", "You already exceeded the number of months you entered.", "", null, "", null, "1");
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

function previewleasingapp(TradeID, Company_ID, Inquiry_ID, UnitID, Application_ID, stat, appStat)
{
  $("#modal_previewleasingapplication").modal("show");
  $("#paymenttypeinfo").val(Inquiry_ID);
  $("#txtinq_app_status").val(stat);
  $("#div_businessinfo").click();
  $("#txtnoofmonths_inq").val("");
  $("#txtnoofdays_inq").val("");
  $("#statinquiryyy").val("valid");
  $("#btn_savenewremark").attr("onclick", "savenewremark(\""+Inquiry_ID+"\")");
  changeclassification();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'TradeID=' + TradeID + '&Company_ID=' + Company_ID + '&Inquiry_ID=' + Inquiry_ID + '&form=viewinquiry',
    beforeSend : function() {
      $('#leasingloadingscreen').addClass('myspinner');
    },
    success: function(data){
      $('#leasingloadingscreen').removeClass('myspinner');
      var arr = data.split("|");
      $("#txtselected_month").val(arr[42]);
      $("#txtinq_mallbranch").val(arr[1]);
      $("#txtinq_pymenttype").val(arr[45]);
      forinputofdetails(arr[45]);
      showmodalforinputofdetails(Inquiry_ID, arr[45]);
      $("#btnretrievecardinfo").attr("onclick", "showmodalforinputofdetails2(\""+Inquiry_ID+"\", \""+arr[45]+"\")");
      if(arr[1] != "" && appStat != "Pending")
      {
        $("#txtinq_unitclass").prop("disabled", false);
      }
      else
      {
        $("#txtinq_unitclass").prop("disabled", true);
      }

      $("#txtinq_remarks").val(arr[2]);
      $("#txtapp_createdby").text(arr[32]);
      $("#txtapp_datecreated").text(arr[35]);
      $("#txtapp_modifby").text(arr[34]);
      $("#txtapp_modifdate").text(arr[38]);


      if(stat == "for_approval" || stat == "approve")
      {
        $(".disable_this").prop("disabled", true);// disabling of some elements when it is for approval or approve
      }
      else
      {
        $(".disable_this").prop("disabled", false);// enabling of some elements when editing
      }
      reqmonORday2(UnitID, arr[23], arr[28], arr[29]);
      $("#txtinq_remarks").prop("style","height:190px;");
      selecttenant(Company_ID, TradeID);
      $("#div_modal_inquiry_remarks").prop("class", "col-md-12 col-xs-12");
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
      $("#txtinq_unitclass").val(arr[26]);
      if(UnitID != "")
      {
        $("#txtinq_datefrom").prop("disabled", false);
        $("#txtnoofmonths_inq").prop("disabled", false);
        $("#txtinq_monthlyadvamt").prop("disabled", true); //autofill
        $("#txtinq_advancepayment").prop("disabled", true); //autofill
        $("#txtinq_monthlydepamt").prop("disabled", false);
        $("#txtinq_depositpayment").prop("disabled", true); //autofill
        $("#txtinq_monthlyrate2").prop("disabled", false);
        // $("#txtinq_pymentterms").prop("disabled", false);
        // $("#txtinq_pymenttype").prop("disabled", false);
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
        $("#txtinq_pymentterms").prop("disabled", true);
        $("#txtinq_pymenttype").prop("disabled", true);
      }
      if(arr[27] == "SET")
      {
        // $("#txtlabel_payment").text("Monthly Dues");
        selectunit2(Company_ID, TradeID, UnitID, Inquiry_ID, Application_ID, stat);
        $("#txtnoofmonths_inq").attr("onkeyup", "loaddatetofunction();");
        $("#div_unit_set").css("display", "block");
        $("#div_unit_lca").css("display", "none");
        // $("#txtinq_lca_unitname").prop("disabled", true);  
        // $("#txtinq_sqm_width").prop("disabled", true);
        // $("#txtinq_sqm_length").prop("disabled", true);
        // $("#txtinq_persqm").prop("disabled", true);
        // $("#txtinq_totalsqm").prop("disabled", true);
        paymentterms_SET();
      }
      else if(arr[27] == "LCA")
      {
        // $("#txtlabel_payment").text("Daily Dues");
        selectunit3(Company_ID, TradeID, UnitID, Inquiry_ID, Application_ID, stat);
        $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction();");
        $("#div_unit_set").css("display", "none");
        $("#div_unit_lca").css("display", "block");
        // $("#txtinq_lca_unitname").prop("disabled", false);  
        // $("#txtinq_sqm_width").prop("disabled", false);
        // $("#txtinq_sqm_length").prop("disabled", false);
        // $("#txtinq_persqm").prop("disabled", false);
        // $("#txtinq_totalsqm").prop("disabled", false);
        paymentterms_LCA();
      }

      if(stat == "for_approval")
      {
        // $("#div_res_0 :input").prop("disabled", true);
        // $("#div_res_1 :input").prop("disabled", true);
        // $("#div_res_2 :input").prop("disabled", true);
        $("#btn_saveinquiry").show();
        $("#btn_saveremrks").show();
        $("#btn_updateleasingapplication").hide();
          $("#btn_disapprove").hide();
          $("#div_modal_title_inquiry").text("Tenant Investigation Report");
          $("#btn_saveinquiry").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"For Approval\", \""+UnitID+"\")");
          $("#btntext_inq").text("For Approval");
          if(appStat == "For Approval" || appStat == "Tentative" || appStat == "Disapproved")
          {
            $("#btn_saveinquiry").prop("disabled", true);
            if(appStat == "For Approval")
            {
              $("#btn_saveremrks").show();
              $("#btn_saveremrks").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"updateremarks\", \""+UnitID+"\")");
            }
            else
            {
              $("#btn_saveremrks").hide();
            }
          }
          else
          {
            $("#btn_saveinquiry").prop("disabled", false);
            $("#btn_saveremrks").hide();
          }
      }
      else if(stat == "approve")
      {
        $("#div_res_0 :input").prop("disabled", true);
        $("#div_res_1 :input").prop("disabled", true);
        $("#div_res_2 :input").prop("disabled", true);
        $("#btn_saveinquiry").show();
        $("#btn_saveremrks").show();
        $("#btn_updateleasingapplication").hide();
        $("#btn_saveremrks").hide();
        
        if(appStat == "Pending")
        {
            $("#txtinq_unitclass").prop("disabled", true);
            $("#btn_saveinquiry").hide();
            $("#btn_disapprove").hide();
            $("#div_modal_title_inquiry").text("Tenant Application Approval");
            $("#btn_saveinquiry").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"Tentative\", \""+UnitID+"\")");
            $("#btntext_inq").text("Approve");
            $("#txtinq_remarks").prop("disabled", false);
        }
        else if(appStat == "For Approval")
        {
          $("#div_modal_title_inquiry").text("Tenant Application Approval");
          $("#btn_saveinquiry").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"Tentative\")");
          $("#btn_disapprove").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"Disapproved\", \""+UnitID+"\")");
          
          $("#btntext_inq").text("Approve");
          $("#txtinq_remarks").prop("disabled", false);
          if(appStat == "Tentative")
          {
            $("#btn_saveinquiry").show();
            $("#btn_saveinquiry").prop("disabled", true);
            $("#txtinq_remarks").prop("disabled", true);
          }
          else
          {
            $("#btn_saveinquiry").show();
            $("#btn_saveinquiry").prop("disabled", false);
            $("#btn_disapprove").show();
            $("#txtinq_remarks").prop("disabled", false);
          }
        }
        else if(appStat == "Tentative")
        {
            $("#btn_saveinquiry").show();
            $("#btn_saveinquiry").prop("disabled", true);
            $("#div_modal_title_inquiry").text("Tenant Application Approval");
            $("#btn_saveinquiry").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"Tentative\", \""+UnitID+"\")");
            $("#btntext_inq").text("Approved");
            $("#btn_saveinquiry").prop("disabled", true);
            $("#btn_disapprove").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"Disapproved\", \""+UnitID+"\")");
            $("#btn_disapprove").prop("disabled", true);
            $("#txtinq_remarks").prop("disabled", true);
        }
        else if(appStat == "Disapproved")
        {
            $("#btn_saveinquiry").show();
            $("#btn_saveinquiry").prop("disabled", true);
            $("#div_modal_title_inquiry").text("Tenant Application Approval");
            $("#btn_saveinquiry").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"Tentative\", \""+UnitID+"\")");
            $("#btntext_inq").text("Approve");
            $("#btn_saveinquiry").prop("disabled", true);
            $("#btn_disapprove").attr("onclick", "changestatleasingapp(\""+Application_ID+"\",\""+Inquiry_ID+"\", \"Disapproved\", \""+UnitID+"\")");
            $("#btn_disapprove").prop("disabled", true);
            $("#txtinq_remarks").prop("disabled", true);
        }
      }
      else if(stat == "update_application")
      {
        // $("#div_res_0 :input").prop("disabled", false);
        // $("#div_res_1 :input").prop("disabled", false);
        // $("#div_res_2 :input").prop("disabled", false);
        $("#btn_updateleasingapplication").show();
        $("#btn_updateleasingapplication").attr("onclick", "saveinquiry(\""+Application_ID+"\",\""+Inquiry_ID+"\")");
        $("#div_modal_title_inquiry").text("Leasing Application");
        $("#btn_saveinquiry").hide();
        $("#btn_saveremrks").hide();
        $("#txtinq_remarks").prop("disabled", false);
      }
      loadremakrs(Inquiry_ID);   
      uploadrequirementscss();
      $("#status_filled").val("0");
      reqmonORday();
      $("#txtinq_pymentterms").val(arr[44]);
    }
  });

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: '&appid=' + Application_ID + '&inqid=' + Inquiry_ID + '&form=loadrequirements_application',
    success: function(data)
    {
      $("#div_modal_inquiry_requirements2").html(data);
      uploadrequirementscss();
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

function reqmonORday2(idnum, type, months, days)
{
  if(idnum == "")
  {
    $("#txtnoofdays_inq").removeClass("required_inq");
    $("#txtnoofmonths_inq").removeClass("required_inq");
  }
  else
  {
    var months = parseInt(months||0);
    var days = parseInt(days||0);
    if(type == "SET")
    {
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
    else
    {
      $("#txtnoofdays_inq").removeClass("required_inq");
      $("#txtnoofmonths_inq").addClass("required_inq");
    }
  
  }
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

function selectunit2(Company_ID, TradeID, UnitID, Inquiry_ID, Application_ID, action)
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
        $("#txtmonthlymath").val(arr[40]);
        $("#txtinq_datefrom").val(arr[11]);
        $("#txtinq_dateto").val(arr[12]);
        $("#txtinq_monthlyrate2").val(arr[4]);
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
        $("#txtinq_assocdues").val(arr[39]);
        $("#txtinq_totalmonthlydues").val(arr[41]);
        $("#radio_set").prop("checked", true);
        $("#radio_lca").prop("checked", false);
        $("#div_nomonths").css("display", "block");
        $("#div_nodays").css("display", "none");

        $("#div_advance_set").css("display", "block");
        $("#div_deposit_set").css("display", "block");
        $("#div_advance_set_amt").css("display", "none");
        $("#div_deposit_set_amt").css("display", "none");
        $("#txtinq_monthlyadvamt").removeClass("required_inq");
        // $("#txtinq_monthlydepamt").removeClass("required_inq");
        $("#txtinq_advancepayment2").removeClass("required_inq");
        $("#txtinq_depositpayment2").removeClass("required_inq");   
        $("#txtinq_advancepayment").removeClass("required_inq");
        $("#txtinq_depositpayment").removeClass("required_inq");

        if(UnitID != "")
        {
          $("#txtinq_advancepayment").addClass("required_inq");
          $("#txtinq_depositpayment").addClass("required_inq");
          $("#txtinq_monthlyadvamt").addClass("required_inq");
          // $("#txtinq_monthlydepamt").addClass("required_inq");  
          $("#txtinq_pymentterms").addClass("required_inq");  
          $("#txtinq_pymenttype").addClass("required_inq");          
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

function selectunit3(Company_ID, TradeID, UnitID, Inquiry_ID, Application_ID, action)
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
        $("#txtinq_advancepayment").removeClass("required_inq");
        $("#txtinq_depositpayment").removeClass("required_inq");
        if(UnitID != "")
        {
          $("#txtinq_advancepayment2").addClass("required_inq");
          $("#txtinq_depositpayment2").addClass("required_inq");         
        }
        $("#div_unit_area_set").css("display", "none");
        $("#div_unit_area_lca").css("display", "block");

        
        $("#txtinq_lca_unitname").val(arr[0]);
        $("#txtinq_datefrom").val();
        $("#txtinq_advancepayment2").val(arr[11]);
        $("#txtinq_depositpayment2").val(arr[10]);
        $("#txtinq_sqm_width").val(arr[1]);
        $("#txtinq_sqm_length").val(arr[2]);
        $("#txtinq_persqm").val(arr[3]);
        $("#txtinq_totalsqm").val(arr[13]);
        $("#txtmonthlymath").val(arr[13]);
        $("#txtinq_assocdues").val(arr[15]);
        $("#txtinq_totalmonthlydues").val(arr[14]);
        $("#txtmonthlymath").prop("disabled", true);
        $("#txtinq_assocdues").prop("disabled", true);
        $("#txtinq_totalmonthlydues").prop("disabled", true);
        $("#txtmonthlymathdays").prop("disabled", true);
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
        if(arr[5] != "" && action != "view") //enable unit if floor is not empty
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
        loadinquiry_unit2(UnitID);
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
  $("#totalpayment").text("Php 0.00");
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
  $("#txtinq_lca_unitname").prop("disabled", true); 
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
      if(action != "for_approval" && action != "approve")
      {
        if(selected != "")
        {
          $("#txtinq_datefrom").prop("disabled", false);
          $("#txtnoofmonths_inq").prop("disabled", false);
          $("#txtinq_monthlyadvamt").prop("disabled", true); //autofill
          $("#txtinq_advancepayment").prop("disabled", true); //autofill
          $("#txtinq_monthlydepamt").prop("disabled", false);
          $("#txtinq_depositpayment").prop("disabled", true); //autofill
          $("#txtinq_monthlyrate2").prop("disabled", true); //disable

          $("#txtinq_dateto").prop("disabled", true);
          $("#txtnoofdays_inq").prop("disabled", false);
          $("#txtinq_advancepayment2").prop("disabled", true); //autofill
          $("#txtinq_depositpayment2").prop("disabled", false);
          $("#txtinq_sqm_width").prop("disabled", true); //disable
          $("#txtinq_sqm_length").prop("disabled", true); //disable
          $("#txtinq_totalsqm").prop("disabled", true); //disable
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
          $("#txtinq_lca_unitname").prop("disabled", true);      
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
    $("#txtinq_lca_unitname").prop("disabled", true);
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
    $("#txtinq_lca_unitname").prop("disabled", true);
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

function loadinquiry_wing()
{
  var classification_id = $("#txtinq_unitclass").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&form=loadinquiry_wing',
    success: function(data)
    {
      $("#txtinq_unitwing").html(data)
      $("#txtinq_unitwing").prop("disabled", false);
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
    $("#txtinq_lca_unitname").val("");
  }
  else
  {
    $("#txtinq_unitfloor").prop("disabled", true);
    $("#txtinq_unitunit").prop("disabled", true);
    $("#txtinq_lca_unitname").prop("disabled", true);
    $("#txtinq_unitfloor").val("");
    $("#txtinq_unitunit").val(""); 
    $("#txtinq_lca_unitname").val("");
  }

  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'wing_id='+wing_id +'&classification_id='+classification_id+'&mallid='+mallid+'&form=loadinquiry_flr',
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
    $("#txtinq_unitunit").html("<option value=''>-- Select Unit --</option>");
    $("#txtinq_lca_unitname").html("<option value=''>-- Select Unit --</option>");
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

function loadinquiry_unit_set()
{
  var classification_id = $("#txtinq_unitclass").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&form=loadinquiry_unit_set',
    success: function(data)
    {
      $("#txtinq_unitunit").html(data)
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

  $(".form_lease_application_req_2").each(function(){
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

  function showimgupdatedreq(id)
  {
    // var oFReader = new FileReader();
    // oFReader.readAsDataURL(document.getElementById(id).files[0]);
        
    // oFReader.onload = function (oFREvent) {
    //     document.getElementById("imgtradeaccount").src = oFREvent.target.result;
    // };
    // alert()
  }

  function paymentterms_LCA(){
    $("#txtinq_pymentterms").html("<option value=''>-- Select Payment Terms --</option><option value='daily'>Daily</option><option value='monthly'>Monthly</option><option value='1time'>1 Time Payment</option>")
  }

  function paymentterms_SET(){
    $("#txtinq_pymentterms").html("<option value=''>-- Select Payment Terms --</option><option value='monthly'>Monthly</option><option value='1time'>1 Time Payment</option>")
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
    if(tipo == "Cash"){
      $("#btnforinputofdetails").prop("disabled", true);
      $("#modalforinputofdetailsheader").text("");
      $(".ptinfocordcard").css("display", "none");
      $(".ptinfobanktransfer").css("display", "none");
      $(".paymenttypeinformationcord").css("display", "none");
      $(".paymenttypeinformationbtob").css("display", "none");
      $("#paymenttypeinformation").css("display", "none");
    }else if(tipo == "Check"){
      $("#btnforinputofdetails").prop("disabled", true);
      $("#modalforinputofdetailsheader").text("Check Information");
      $(".ptinfocordcard").css("display", "none");
      $(".ptinfobanktransfer").css("display", "none");
      $(".paymenttypeinformationcord").css("display", "none");
      $(".paymenttypeinformationbtob").css("display", "none");
      $("#paymenttypeinformation").css("display", "none");
    }else if(tipo == "Credit Card"){
      $("#btnforinputofdetails").prop("disabled", false);
      $("#modalforinputofdetailsheader").text("Credit Card Information");
      $(".ptinfocordcard").css("display", "block");
      $(".ptinfobanktransfer").css("display", "none");
      $(".paymenttypeinformationcord").css("display", "block");
      $(".paymenttypeinformationbtob").css("display", "none");
      $("#paymenttypeinformation").css("display", "block");
    }else if(tipo == "Debit Card"){
      $("#btnforinputofdetails").prop("disabled", false);
      $("#modalforinputofdetailsheader").text("Debit Card Information");
      $(".ptinfocordcard").css("display", "block");
      $(".ptinfobanktransfer").css("display", "none");
      $(".paymenttypeinformationcord").css("display", "block");
      $(".paymenttypeinformationbtob").css("display", "none");
      $("#paymenttypeinformation").css("display", "block");
    }else if(tipo == "Bank Transfer"){
      $("#btnforinputofdetails").prop("disabled", false);
      $("#modalforinputofdetailsheader").text("Bank Transfer Information");
      $(".ptinfocordcard").css("display", "none");
      $(".ptinfobanktransfer").css("display", "block");
      $(".paymenttypeinformationcord").css("display", "none");
      $(".paymenttypeinformationbtob").css("display", "block");
      $("#paymenttypeinformation").css("display", "block");
    }else{
      $("#btnforinputofdetails").prop("disabled", true);
      $("#modalforinputofdetailsheader").text("");
      $(".ptinfocordcard").css("display", "none");
      $(".ptinfobanktransfer").css("display", "none");
      $(".paymenttypeinformationcord").css("display", "none");
      $(".paymenttypeinformationbtob").css("display", "none");
      $("#paymenttypeinformation").css("display", "none");
    }
  }

  function showmodalforinputofdetails(inqid, paymenttype){
    $.ajax({
      type: 'POSt',
      url: 'mainclass.php',
      data: 'paymenttype=' + paymenttype + '&inqid=' + inqid + '&form=onloadcardinfo',
      success:function(data){
        var arr = data.split("|");
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
      }
    })
  }

  function showmodalforinputofdetails2(inqid, paymenttype){
  $("#modalforinputofdetails").modal("hide");
  $.ajax({
    type: 'POSt',
    url: 'mainclass.php',
    data: 'paymenttype=' + paymenttype + '&inqid=' + inqid + '&form=onloadcardinfo',
    success:function(data){
      var arr = data.split("|");
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
    }
  })
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
</script>