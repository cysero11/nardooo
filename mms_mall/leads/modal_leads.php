<style>
  .zoom {
      display:inline-block;
      position: relative;
    }
    
    /* magnifying glass icon */
    .zoom:after {
      content:'';
      display:block; 
      width:33px; 
      height:33px; 
      position:absolute; 
      top:0;
      right:0;
      background:url(icon.png);
    }

    

    .zoom img::selection { background-color: transparent; }
</style>

<div class="modal fade" id="bwiset" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" id="modal_div_inquiry" style="width: 85%;">
  
    <!-- Modal content-->
    <div class="modal-content ">
       <!-- Modal header-->
        <div class="modal-header" style="background-color: #438EB9;">
            <button type="button" class="close" onclick="closeleadsModal()">&times;</button>
            <h4 class="modal-title" id="div_modal_title_inquiry" style="color:white; font-weight: bold;">New Leads</h4>
            <input type="hidden" id="statinquiryyy" name="">
            <input type="hidden" class="text_inquiry" id="txtinq_leadsID" name="">
            <input type="hidden" class="text_inquiry" id="statLeads" name="">
            <input type="hidden" id="status_filled" name="">
      </div>

       <!-- Modal body-->
    <div class="modal-body" style="display: block; height: 35em;overflow-y: scroll;" id="div_view_inquiry_modal"> 
      <div class="row form-group" style="margin-bottom: 0px;">
        <div class="col-md-6 col-xs-12">
         <div class="tabbable">
                      <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                          <a data-toggle="tab" href="#home_div_tab" id="div_businessinfo">
                            <i class="green ace-icon fa fa-info bigger-120"></i>
                           Leads Information Form
                          </a>
                        </li>

                     </ul>   
                </div>  
      
         </div>
        </div> 




         <div class="tab-content" style="display: block; height: 28em;overflow-y: scroll;padding-bottom:0px;padding-top: 10px;">
                        <div id="home_div_tab" class="tab-pane fade in active">
                          <div class="row form-group" style="margin-bottom: 0px;">
                            <div class="col-md-6 col-xs-12">
                                <div class="well" style="padding-bottom: 0px;padding-top: 30px;">
                                  <div class="row form-group">
                                    <div class="col-xs-12">
                                        <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                               First Name
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                          <!-- <input class="form-control nakaraan" id="sdsdd" type="text" data-date-format="dd-mm-yyyy"> -->
                                            <!-- <input list="list_mallbranch"  type="text" li="txtbuss" placeholder="-- Select Mall Branch --" oninput=""/>
                                                <datalist id="list_mallbranch">
                                                </datalist> -->
                                           <input type="text" name="" class="form-control" id="firstName" placeholder="First Name">
                                          </div>
                                        </div> 

                                        <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Middle Name 
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                          <!-- <input class="form-control nakaraan" id="sdsdd" type="text" data-date-format="dd-mm-yyyy"> -->
                                            <!-- <input list="list_mallbranch"  type="text" li="txtbuss" placeholder="-- Select Mall Branch --" oninput=""/>
                                                <datalist id="list_mallbranch">
                                                </datalist> -->
                                            <input type="text" name="" class="form-control" id="Mname" placeholder="Middle Name">
                                          </div>
                                        </div> 

                                        <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Last Name
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                              <input type="text" name="" class="form-control" id="Lname" placeholder="Last Name">
                                          </div>                     
                                        </div> 

                                        <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Industry
                                          </div>
                                          <div class="col-md-9 col-xs-12">

                                            <select  type="text" name="" class="form-control" id="Occu" >
                                              
                                            </select>
                                            
                                          </div>                     
                                        </div> 

                                    </div>
                                  </div>
                                </div>
                            </div> 

                            <div class="col-md-6 col-xs-12">  
                              <div class="well" style="padding-bottom: 0px;padding-top: 30px;">
                                 
                                <div class="row form-group">
                                          <div class="col-md-9 col-md-12">
                                            <h3>Contact Information:</h3> 
                                          </div>
                                </div>        

                                <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Mobile Number:
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                        
                                          <input type="text" maxlength="11"  class="form-control CpNum" id="Cnum" placeholder="Mobile Number" />
                                          <span id="spanMoKo" style="color:red;"></span>
                                          </div>                     
                                </div> 


                                <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Telephone Number:
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                               <input type="text" name="" class="form-control TNum" id="Tnum" placeholder="Telephone Number" maxlength="7">
                                               <span id="spanMoKo1" style="color:red;"></span>
                                          </div>                     
                                </div> 


                                <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                            Address:
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                               <input type="text" name="" class="form-control" id="Addr" placeholder="Address">
                                          </div>                     
                                 </div> 


                                 <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Email:
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                        <input type="text" name="" class='form-control EmailPo' id="email" placeholder="Email">
                                        <span id="spanMo" style="color:red;"></span>
                                         
                                          </div>                     
                                </div>  



                                 <!--  <div class="row form-group">
                                    <div class="col-xs-12" style="display: inline-block; height: 265px;overflow-y: scroll;" id="div_inquiry_contact_numbers">
                                      
                                    </div>
                                  </div> -->
                              </div>
                            </div>                  
                          </div> 
                        </div>
                       </div> 





                          
    
   </div>

                           <div class="modal-footer">
                               <button type="button" class="btn btn-primary" id="btn_saveleads" onclick="saveleads()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
                            </div>  


  </div>

 </div>


</div>

<!-- Update leads -->

<div class="modal fade" id="view_leads" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" id="modal_div_inquiry" style="width: 85%;">
  
    <!-- Modal content-->
    <div class="modal-content ">
       <!-- Modal header-->
        <div class="modal-header" style="background-color: #438EB9;">
            <button type="button" class="close" onclick="closeUpdate()">&times;</button>
            <h4 class="modal-title" id="div_modal_title_inquiry" style="color:white; font-weight: bold;">View Leads</h4>
            <input type="hidden" id="statinquiryyy" name="">
            <input type="hidden" class="text_inquiry" id="txtinq_leadsID" name="">
            <input type="hidden" class="text_inquiry" id="statLeads" name="">
            <input type="hidden" id="status_filled" name="">
      </div>

       <!-- Modal body-->
    <div class="modal-body" style="display: block; height: 35em;overflow-y: scroll;" id="div_view_inquiry_modal"> 
      <div class="row form-group" style="margin-bottom: 0px;">
        <div class="col-md-6 col-xs-12">
         <div class="tabbable">
                      <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                          <a data-toggle="tab" href="#home_yow" id="div_businessinfo">
                            <i class="green ace-icon fa fa-info bigger-120"></i>
                          Leads Information
                          </a>
                        </li>
                        <li class="dropdown">
                          <a data-toggle="tab" href="#remarks_div_tab" onclick="">
                          <i class="orange ace-icon fa fa-pencil bigger-120" ></i>
                            <text id="txtremakrstext">Requirements and Remarks</text>
                          </a>
                      </li>
                     </ul>   
                </div>  
      
         </div>
        </div>  

         <div class="tab-content" style="display: block; height: 28em;overflow-y: scroll;padding-bottom:0px;padding-top: 10px;">
                        <div id="home_yow" class="tab-pane fade in active">
                          <div class="row form-group" style="margin-bottom: 0px;">
                            <div class="col-md-6 col-xs-12">
                                <div class="well" id="Haha" style="padding-bottom: 0px;padding-top: 30px;">
                                  <div class="row form-group">
                                    <div class="col-xs-12">

                                      <div class="row form-group">
                                         
                                          <div class="col-md-9 col-xs-12">
                                          <!-- <input class="form-control nakaraan" id="sdsdd" type="text" data-date-format="dd-mm-yyyy"> -->
                                            <!-- <input list="list_mallbranch"  type="text" li="txtbuss" placeholder="-- Select Mall Branch --" oninput=""/>
                                                <datalist id="list_mallbranch">
                                                </datalist> -->
                                           <input type="hidden" name="" class="form-control" id="userID" placeholder="" readonly="">
                                          </div>
                                        </div> 

                                        <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                               First Name
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                          <!-- <input class="form-control nakaraan" id="sdsdd" type="text" data-date-format="dd-mm-yyyy"> -->
                                            <!-- <input list="list_mallbranch"  type="text" li="txtbuss" placeholder="-- Select Mall Branch --" oninput=""/>
                                                <datalist id="list_mallbranch">
                                                </datalist> -->
                                           <input type="text" name="" class="form-control" id="firstName1" placeholder="First Name" readonly="">
                                          </div>
                                        </div> 

                                        <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Middle Name 
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                          <!-- <input class="form-control nakaraan" id="sdsdd" type="text" data-date-format="dd-mm-yyyy"> -->
                                            <!-- <input list="list_mallbranch"  type="text" li="txtbuss" placeholder="-- Select Mall Branch --" oninput=""/>
                                                <datalist id="list_mallbranch">
                                                </datalist> -->
                                            <input type="text" name="" class="form-control" id="Mname1" placeholder="Middle Name" readonly="">
                                          </div>
                                        </div> 

                                        <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Last Name
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                              <input type="text" name="" class="form-control" id="Lname1" placeholder="Last Name" readonly="">
                                          </div>                     
                                        </div> 

                                        <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Industry
                                          </div>
                                          <div class="col-md-9 col-xs-12">

                                            <select type="text" name="" class="form-control" id="Occu1"  disabled=""></select> 
                                            
                                          </div>                     
                                        </div> 

                                    </div>
                                  </div>
                                </div>
                            </div> 

                            <div class="col-md-6 col-xs-12">  
                              <div class="well" id="Hoho" style="padding-bottom: 0px;padding-top: 30px;">
                                 
                                <div class="row form-group">
                                          <div class="col-md-9 col-md-12">
                                            <h3>Contact Information:</h3> 
                                          </div>
                                </div>        

                                <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Mobile Number:

                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                             <input type="text" name="" class="form-control CpNum" id="Cnum1" placeholder="Mobile Number" readonly="" maxlength="11">
                                              <span id="spanMoKo2" style="color:red;"></span>
                                          </div>                     
                                </div> 


                                <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Telephone Number:
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                               <input type="text" name="" class="form-control TNum" id="Tnum1" placeholder="Telephone Number" readonly="" maxlength="7">
                                               <span id="spanMoKo3" style="color:red;"></span>
                                          </div>                     
                                </div> 


                                <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                            Address:
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                               <input type="text" name="" class="form-control" id="Addr1" placeholder="Address" readonly="">
                                          </div>                     
                                 </div> 


                                 <div class="row form-group">
                                          <div class="col-md-3 col-xs-12">
                                                Email:
                                          </div>
                                          <div class="col-md-9 col-xs-12">
                                               <input type="text" name="" class="form-control EmailPo" id="email1" placeholder="Email" readonly="">
                                                 <span id="spanMo4" style="color:red;"></span>
                                          </div>                     
                                </div>  



                                 <!--  <div class="row form-group">
                                    <div class="col-xs-12" style="display: inline-block; height: 265px;overflow-y: scroll;" id="div_inquiry_contact_numbers">
                                      
                                    </div>
                                  </div> -->
                              </div>
                            </div>                  
                          </div> 
                        </div>

                        <!-- Requirements and Remarks -->
                          <div id="remarks_div_tab" class="tab-pane fade">
                          <div class="row form-group" id="div_last_row">
                            <div class="col-xs-6 col-xs-12" id="div_modal_inquiry_remarks">
                                  <div class="well" id="fornewapp_remarks" style="display: block;">
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
                                  <div class="well" id="fornewinq_remarks" style="display: none;">
                                    <div class="row form-group">
                                      <div class="col-xs-12">
                                        <h4 class="green smaller lighter">Remarks</h4>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <div class="col-xs-12" style="display: block;height: 220px;">
                                        <textarea class="form-control text_inquiry" id="txtinq_remarks" style="height: 190px;" placeholder="remarks here ..."></textarea>
                                      </div>
                                    </div>
                                  </div>
                            </div>

                            <div class="col-md-6 col-xs-12" id="div_modal_inquiry_requirements">
                                  <div class="well">
                                    <div class="row form-group">
                                      <div class="col-xs-12">
                                        <h4 class="green smaller lighter">Requirements</h4>
                                      </div>
                                    </div>
                                    <div class="row form-group">
                                      <div class="col-xs-12">
                                       
                                            <div class="form-group" id="div_req_passed" style="overflow-y: scroll;overflow-x: hidden;">
                                            
                                            </div>
                                      
                                      </div>
                                    </div>
                                  </div>
                            </div>
                          </div> 
                        </div>

                       </div> 


                          
    
   </div>

                           <div class="modal-footer">
                               <button type="button" class="btn btn-warning" id="btn_enableleads" onclick="UpdateLeads()"><i class="ace-icon fa fa-refresh"></i>&nbsp;Edit</button>
                               <button type="button" class="btn btn-danger" id="btn_CancelLeadsTo" onclick="cancelLeads()"><i class="ace-icon fa fa-times"></i>&nbsp;Block</button>
                                <button type="button" class="btn btn-success" id="btn_unblockLeads" onclick="unblockLeads()" style="display: none;"><i class="ace-icon fa fa-check"></i>&nbsp;Unblock</button>
                                 <button type="button" class="btn btn-primary" id="btn_Editleads" onclick="EditLeads()" style="display: none;"><i class="ace-icon fa fa-check" ></i>&nbsp;Save</button>
                                   <button type="button" class="btn btn-danger" id="btn_Cancelleads" onclick="CancelEdit()" style="display: none;"><i class="ace-icon fa fa-times"></i>&nbsp;Cancel</button>
                            </div>  



  </div>

 </div>


</div>

  <div class="modal fade bd-example-modal-md" id="modal_new_remarks" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" style="margin-top: 10%;">   
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" onclick="closenewremarkmodal()">&times;</button>
          <h4 class="modal-title" id="remtext_cont">New Remarks</h4>
          <input type="hidden" id="txtremID" name="">
            <div class="row form-group" style="margin-top: 15px;">
              <div class="col-xs-12">
                <textarea class="form-control" id="txtinq_remarks2" style="height: 100px;margin-bottom: 10px;"></textarea>
                <button class="btn btn-info btn-sm" id="btn_savenewremark" style="float: right;" onclick="savenewremark()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div> 


<link rel="stylesheet" href="assets/css/easyzoom.css" />
<div class="modal fade" id="modal_view_image" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h4 class="modal-title">Leasing Application</h4> -->
      </div>

       <!-- Modal body-->
      <div class="modal-body" style="" id="modal-body-leasingapp2">
        <div class="row form-group">
          <div class="col-xs-12">
            <br/>
            <center id='content_img'>
              <div class="easyzoom easyzoom--overlay easyzoom--with-toggle">
                  <a id="img_viewed2" href="">
                      <img id="img_viewed" src="" alt="" width="380" height="400" />
                  </a>
              </div>
            </center>  
            <br/>
          </div>    
        </div>
      </div>

      <!-- Modal body-->
      <div class="modal-footer">
      <br /><br />
          <button style="display: none;" class="toggle btn btn-md btn-info" data-active="true"><i style='color:white !important;' class='ace-icon fa fa-search-minus bigger-120'></i></button>
      </div> 
    </div>
  </div>
</div>



<script src="assets/dist/easyzoom.js"></script>

    






