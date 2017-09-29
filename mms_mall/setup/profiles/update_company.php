
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

.div_contact_person {
   float: left;
   margin: 10px;
   padding: 10px;
   width: 250px;
   max-width: 250px;
   height: auto;
   border: 1px solid #ddd;
   background-image: url("images/background.png");
   background-repeat: repeat;
   text-align: center;
   vertical-align: middle;
} 
</style>
<div  class="modal fade" id="modal_new_company" area-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #438EB9;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white; font-weight: bold;">Company</h4>
            </div>
            
                <div class="modal-body" id="div_add_contact" style="display: block; height: 450px; overflow-y: scroll;">
                    <div class="row form-group">
                        <div class="col-md-3 col-xs-12">
                            <div class="image">
                                <img class="img-thumbnail imageName form-control" src="assets/images/avatars/noimage.png" id="imgaccount" style="border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;">
                            </div>
                            <form name="posting_profilepic" id="posting_profilepic" >
                                <div style="display: none"><input type="text" id="hidden_company_id" name="hidden_company_id"></div>
                                <input id="file_upload" name="attachment_profilepic" class="form-control upload" type="file" onchange="showimg();" />
                            </form>
                        </div>
                        <div class="col-md-9 col-xs-12">
                            <div class="row form-group">
                                <div class="col-xs-12 col-md-4">
                                    Company Name
                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <input type="text" class="form-control text_reqcompany" name="" id="txtcomp_name" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-md-4">
                                    Industry
                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <div class="input-group">
                                        <select class="form-control text_reqcompany" id="txtcomp_industry">
                                        
                                        </select>
                                        <div class="spinbox-buttons input-group-btn">         
                                          <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="loadreferentialmodal('industry')">            
                                            <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                          </button>       
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-md-4">
                                    Business Address<br />
                                    <h6 style="font-size:10px; font-style: italic;">(other than address in commercial center)</h6>

                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <span class="input-icon" style="width: 100%;">
                                        <textarea class="form-control text_reqcompany home-address" style="height: 50px;" id="txtcomp_busadd" onclick="loadaddressmodal('txtcomp_busadd')" onkeyup="loadaddressmodal('txtcomp_busadd')" placeholder="Click to add address..."></textarea>
                                        <i class="ace-icon fa orange" id="txtcomp_busadd_icon"></i>
                                    </span>
                                </div>
                            </div>                                                                                    
                        </div>
                    </div>
                    <div class="row form-group" style="margin-bottom: 0px;">
                        <div class="col-md-6 col-xs-12">
                            <div class="well">
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <h4 class="green smaller lighter">Other Informations</h4>
                                    </div>
                                </div> 
                                <div class="row form-group" style="display: block; height: 420px;overflow-y: scroll;">
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
                                    <span class="input-icon" style="width: 100%;">
                                    <textarea class="form-control home-address" style="height: 50px;" id="txtcomp_perm_add" onclick="loadaddressmodal('txtcomp_perm_add')" onkeyup="loadaddressmodal('txtcomp_perm_add')" placeholder="Click to add address..." readonly></textarea>
                                         <i class="ace-icon fa orange" id="txtcomp_perm_add_icon"></i>
                                    </span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4 col-xs-12">
                                    Current Address
                                    </div>
                                    <div class="col-md-8 col-xs-12">
                                    <span class="input-icon" style="width: 100%;">
                                    <textarea class="form-control text_reqcompany home-address" style="height: 50px;" id="txtcomp_curr_add" onclick="loadaddressmodal('txtcomp_curr_add')" onkeyup="loadaddressmodal('txtcomp_curr_add')" placeholder="Click to add address..." readonly></textarea>
                                    <i class="ace-icon fa orange" id="txtcomp_curr_add_icon"></i>
                                    </span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4 col-xs-12">
                                    Billing Address
                                    </div>
                                    <div class="col-md-8 col-xs-12">
                                    <span class="input-icon" style="width: 100%;">
                                    <textarea class="form-control text_reqcompany home-address" style="height: 50px;" id="txtcomp_bill_add" onclick="loadaddressmodal('txtcomp_bill_add')" onkeyup="loadaddressmodal('txtcomp_bill_add')" placeholder="Click to add address..." readonly></textarea>
                                    <i class="ace-icon fa orange" id="txtcomp_bill_add_icon"></i>
                                    </span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4 col-xs-12">
                                        <div class="input-group">
                                          Telephone No
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xs-12" id="add_tel_no_owner">
                                        <div class="input-group">
                                          <input type="text" id="add_tel_no_owner" class="spinbox-input form-control input-mask-tele" maxlength="11" placeholder="(99)-999-9999">
                                            <div class="spinbox-buttons input-group-btn">         
                                              <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_addtel_owner()">            
                                                <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                              </button>       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="well" id="div_well_contacts">
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <h4 class="green smaller lighter">Company Contacts</h4>
                                    </div>
                                </div> 
                                <div class="row form-group" style="display: block; height: 420px;overflow-y: scroll;" id="div_company_contacts">
                                <div class="col-xs-12">
                                <div class="row form-group">
                                    <div class="col-md-4 col-xs-12">
                                        <div class="input-group">
                                          Mobile No
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group" id="company_contact_mobile" style="width: 100%;">
                                          <input type="text" id="company_contact_mobile" class="spinbox-input form-control input-mask-phone" maxlength="11" placeholder="(999)-999-9999">
                                            <div class="spinbox-buttons input-group-btn">         
                                              <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('company_contact_mobile', 'input-mask-phone')">            
                                                <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                              </button>       
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row form-group">
                                    <div class="col-md-4 col-xs-12">
                                        <div class="input-group">
                                          Telephone No
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group" id="company_contact_tele" style="width: 100%;">
                                          <input type="text" id="company_contact_tele" class="spinbox-input form-control input-mask-tele" maxlength="11" placeholder="(99)-999-9999">
                                            <div class="spinbox-buttons input-group-btn">         
                                              <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('company_contact_tele', 'input-mask-tele')">            
                                                <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                              </button>       
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row form-group">
                                    <div class="col-md-4 col-xs-12">
                                        <div class="input-group">
                                          Fax No
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group" id="company_contact_fax" style="width: 100%;">
                                          <input type="text" id="company_contact_fax" class="spinbox-input form-control input-mask-tele" maxlength="11" placeholder="(99)-999-9999">
                                            <div class="spinbox-buttons input-group-btn">         
                                              <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('company_contact_fax',  'input-mask-tele')">            
                                                <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                              </button>       
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row form-group">
                                    <div class="col-md-4 col-xs-12">
                                        <div class="input-group">
                                          Email Address
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group" id="company_contact_email" style="width: 100%;">
                                          <input type="text" id="company_contact_email" onkeyup="" class="spinbox-input form-control email-address" placeholder="sample@yahoo.com">
                                            <div class="spinbox-buttons input-group-btn">         
                                              <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('company_contact_email', 'emailaddress')">            
                                                <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                              </button>       
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4 col-xs-12">
                                        <div class="input-group">
                                          Website
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xs-12">
                                        <div class="input-group" id="company_contact_website" style="width: 100%;">
                                          <input type="text" id="company_contact_website" class="spinbox-input form-control website-input" placeholder="www.sample.com">
                                            <div class="spinbox-buttons input-group-btn">         
                                              <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('company_contact_website', 'website')">            
                                                <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                              </button>       
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="row form-group" style="margin-bottom: 0px;">
                        <div class="col-md-12 col-xs-12">
                            <div class="well" id="div_well_contact_persons">
                                
                                <div class="row form-group" style="border-bottom: 1px dotted #478FCA;">
                                     <div class="col-md-6 col-xs-6" style="padding-right: 0px;">
                                        <h4 class="green smaller lighter">Contact Persons</h4>
                                    </div>
                                    <div class="col-md-6 col-xs-6" style="padding-left: 0px;">
                                        <h5 class="blue lighter less-margin">
                                          <a href="#" id="" style="float: right;" onclick="addnewcontactperson()">
                                          <i id="carret_icon_div" class="ace-icon fa fa-caret-up bigger-120"></i>
                                          </a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row form-group" style="display: block;" id="div_addnewcontactperson">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row form-group">
                                            <div class="col-xs-12 col-md-4">
                                                Contact Name
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control save_contact_per" name="" placeholder="First Name" id="txtcontact_fname">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-12 col-md-4">
                                                
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control" name="" placeholder="Middle Name" id="txtcontact_mname">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-12 col-md-4">
                                                
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <input type="text" class="form-control save_contact_per" name="" placeholder="Last Name" id="txtcontact_lname">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-12 col-md-4">
                                                Company Position
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <div class="input-group">
                                                    <select class="form-control save_contact_per" id="txtcontact_designation">
                                        
                                                    </select>
                                                    <div class="spinbox-buttons input-group-btn">         
                                                      <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="loadreferentialmodal('position')">            
                                                        <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                                      </button>       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="row form-group">
                                            <div class="col-xs-12 col-md-4">
                                                Address
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                            <span class="input-icon" style="width: 100%;">
                                                <input type="text" style="background-color: white !important;" class="form-control home-address save_contact_per" name="" id="txtcontact_address" onclick="loadaddressmodal('txtcontact_address')" onkeyup="loadaddressmodal('txtcontact_address')" placeholder="Click to add address..." readonly>
                                            <i class="ace-icon fa orange" id="txtcontact_address_icon"></i>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-12 col-md-4">
                                                Email Address
                                            </div>
                                            <div class="col-xs-12 col-md-8" id="div_add_contact_person_email">
                                                <div class="input-group">
                                                  <input type="text" id="div_add_contact_person_email" class="spinbox-input form-control email-address" placeholder="sample@yahoo.com">
                                                    <div class="spinbox-buttons input-group-btn">         
                                                      <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('div_add_contact_person_email', 'emailaddress')">            
                                                        <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                                      </button>       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-12 col-md-4">
                                                Mobile No
                                            </div>
                                            <div class="col-xs-12 col-md-8" id="div_add_contact_person_mobile">
                                                <div class="input-group">
                                                  <input type="text" id="div_add_contact_person_mobile" class="spinbox-input form-control input-mask-phone" maxlength="11" placeholder="(999)-999-9999">
                                                    <div class="spinbox-buttons input-group-btn">         
                                                      <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('div_add_contact_person_mobile', 'input-mask-phone')">            
                                                        <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                                      </button>       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-xs-12 col-md-4">
                                                Telephone No
                                            </div>
                                            <div class="col-xs-12 col-md-8" id="div_add_contact_person_tele">
                                                <div class="input-group">
                                                  <input type="text" id="div_add_contact_person_tele" class="spinbox-input form-control input-mask-tele" maxlength="11" placeholder="(99)-999-9999">
                                                    <div class="spinbox-buttons input-group-btn">         
                                                      <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('div_add_contact_person_tele', 'input-mask-tele')">            
                                                        <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                                      </button>       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr hr-dotted"></div>
                                        <div class="clearfix">
                                          <button id="btn-save-contact-person" class="pull-right btn btn-sm btn-success btn-white btn-round" type="button" onclick="addcontactperson()">
                                            Save Contact Person
                                            <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                          </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12" id="div_content_contact_person_list">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Modal-body -->
                <div class="modal-footer">
                    <button id="modal_company_name" class="btn btn-primary" onclick="savenewmall();">Save</button>
                </div>
        </div>
    </div>
</div>
<script>
$(function(){
    autotrapfields();

    $(".home-address").keyup(function(){
        var value = $(this).val();
        var thisid = $(this).attr("id");
        if(value == "")
        {
            $(this).attr("onclick", "loadaddressmodal(\""+thisid+"\")");
            $(this).attr("onkeyup", "loadaddressmodal(\""+thisid+"\")");
        }
    });
});

function chkmobiledup(divthis, this_text)
{
    if(divthis == "company_contact_mobile")
    {
        var prompt_alert = "mobile number";
    }
    
    if(divthis == "company_contact_tele")
    {
        var prompt_alert = "telephone number";
    }
    
    if(divthis == "company_contact_fax")
    {
        var prompt_alert = "fax number";
    }
    
    if(divthis == "company_contact_email")
    {
        var prompt_alert = "email address";
    }
    
    if(divthis == "company_contact_website")
    {
        var prompt_alert = "website";
    }
    
    if(divthis == "div_add_contact_person_email" || divthis == "div_add_contact_person_email_update")
    {
        var prompt_alert = "email address";
    }
    
    if(divthis == "div_add_contact_person_mobile" || divthis == "div_add_contact_person_mobile_update")
    {
        var prompt_alert = "mobile number";
    }
    
    if(divthis == "div_add_contact_person_tele" || divthis == "div_add_contact_person_tele_update")
    {
        var prompt_alert = "telephone number";
    }
    
    var existing = "";
    $("#"+ divthis +" :input").each(function(){
        var mob = $(this).val();
        if(mob != "")
        {
            existing += mob + "|";                
        }
    });
    var arr = existing.split("|");
    var i = 0;
    var c = 0;
    var etoyun = this_text.val();
    for(i=0; i<=arr.length-1; i++)
    {
      if(etoyun == arr[i])
      {
        c++;
      }
    }

    if(c >= 2)
    {
      alert("Sorry, but you already entered the same "+prompt_alert+".");
      this_text.val("");
      this_text.focus();
    }
}

function autotrapfields() {
    $('.email-address').each(function(){
        var getid = $(this).attr("id");
        $(this).focusout(function() {
            chkmobiledup(getid, $(this))
            var sEmail = $(this).val();
            if ($.trim(sEmail).length == 0) {
                // $(this).focus();
                // alert("Please enter valid email address");
                e.preventDefault();
            }
            if (validateEmail(sEmail)) {
                // $(".errohere").hide();
                // alert('Email is valid');
                // Nothing happens...
            }
            else {
                // $(this).focus();
                alert("Invalid Email Address");
                $(this).val("");
                e.preventDefault();
            }
        });
    });

    $('.website-input').each(function(){
        var getid = $(this).attr("id");
        $(this).focusout(function() {
            chkmobiledup(getid, $(this))
            var sEmail = $(this).val();
            if ($.trim(sEmail).length == 0) {
                // $(this).focus();
                // alert("Please enter valid web address");
                e.preventDefault();
            }
            if (validatWebsite(sEmail)) {
                $(".errohere").hide();
                // alert('Email is valid');
                // Nothing happens...
            }
            else {
                // $(this).focus();
                alert("Invalid Web Address");
                $(this).val("");
                e.preventDefault();
            }
        });
    });        
}


function addcontactperson_update(compid)
{
        var aff = "";
        // aff += $("#div_content_contact_person_list").html();

        var contact_firstname = $("#txtcontact_fname").val();
        var contact_middlename = $("#txtcontact_mname").val();
        var contact_lastname = $("#txtcontact_lname").val();
        var contact_designation = $("#txtcontact_designation").val();
        var contact_address = $("#txtcontact_address").val();


        var div_add_contact_person_email = "";
        $("#div_add_contact_person_email input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_email += value + "|";
            }
        });

        var div_add_contact_person_mobile = "";
        $("#div_add_contact_person_mobile input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_mobile += value + "|";
            }
        });

        var div_add_contact_person_tele = "";
        $("#div_add_contact_person_tele input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_tele += value + "|";
            }
        });



        var i = 0;
        $("div .div_contact_person").each(function(){
            i++;
          });

        var idimg = "imgaccount_"+i;
        var fileimg = "file_upload"+i;
        var fileform = "posting_profilepic"+i;

        var div_add_contact_person_email_a = "";
        $("#div_add_contact_person_email input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_email_a += "<p style='font-size: 10px; font-weight: normal;margin: 0px !important;font-style: underline;' class='contact_person_emailadd'>" + value + "</p>";
            }
        });

        var div_add_contact_person_mobile_a = "";
        $("#div_add_contact_person_mobile input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_mobile_a += "<p style='font-size: 12px; font-weight: normal;font-style: italic;margin: 0px !important;' class='contact_person_mobno'>" + value + "</p>";
            }
        });

        var div_add_contact_person_tele_a = "";
        $("#div_add_contact_person_tele input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_tele_a += "<p style='font-size: 12px; font-weight: normal;font-style: italic;margin: 0px !important;' class='contact_person_telno'>" + value + "</p>";
            }
        });
        

        if((contact_firstname != "" && !contact_firstname.match(/^\s*$/)) && (contact_lastname != "" && !contact_lastname.match(/^\s*$/)) && (contact_designation != "" && !contact_designation.match(/^\s*$/)) && (contact_address != "" && !contact_address.match(/^\s*$/)) && (div_add_contact_person_email != "" || div_add_contact_person_mobile != "" || div_add_contact_person_tele != "") )
        {
            

            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id='+compid+
                '&contact_firstname='+contact_firstname+
                '&contact_middlename='+contact_middlename+
                '&contact_lastname='+contact_lastname+
                '&contact_designation='+contact_designation+
                '&contact_address='+contact_address+
                '&person_email='+div_add_contact_person_email+
                '&person_mobile='+div_add_contact_person_mobile+
                '&person_tele='+div_add_contact_person_tele+
                '&form=addcontactperson_update',
                success: function(data)
                {
                    var arr = data.split("|");
                    if(arr[0] == "1")
                    {
                        aff += "<div class='alert alert-info div_contact_person save_this_div' id='contact_"+arr[1]+"'><div class='tools tools-left in'><a href='#' title='Edit Photo' class='btnedit' style='float:right;margin-bottom:8px;margin-top:8px;' onclick='editthiscontactperson(\""+arr[1]+"\", \""+compid+"\")'><i class='ace-icon fa fa-pencil'></i></a><a href='#' title='Remove Photo' class='btndelete' style='float:right;margin-right:5px;margin-bottom:8px;margin-top:8px;' onclick='removethiscontactperson(\""+arr[1]+"\")'><i class='ace-icon fa fa-times red'></i></a></div><center><div class='image'><img class='img-thumbnail imageName form-control' src='assets/images/avatars/noimage.png' id='div_add_new_contact_per_edit' style='border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;width:90%;'></div><form name='posting_profilepic_addnew_"+arr[1]+"' id='posting_profilepic_addnew_"+arr[1]+"' class='posting_profilepic'><div style='display:none;'><input type='text' name='contactID' id='txtcon_person_addnew_"+arr[1]+"' class='txtcon_person'><input type='text' name='companyID' id='txtcon_company_addnew_"+arr[1]+"' class='txtcon_company'></div><input id='posting_profilepic_addnew_input_"+arr[1]+"' name='file_upload_trade_update' class='form-control upload_app_req' type='file' onchange='showimg3(\"div_add_new_contact_per_edit\",\"posting_profilepic_addnew_input_"+arr[1]+"\", \""+arr[1]+"\", \""+compid+"\");' /></form></center><label style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_firstname'>"+contact_firstname+" </label>&nbsp;<label style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_middlename'>"+contact_middlename+"</label>&nbsp;<label style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_lastname'>"+contact_lastname+"</label><p style='font-size: 14px; font-weight: normal;margin: 0px !important;' class='contact_person_designation'>"+contact_designation+"</p><p style='font-size: 10px; font-weight: normal;margin: 0px !important;' class='address_person'>"+contact_address+"</p>"+div_add_contact_person_email_a+""+div_add_contact_person_mobile_a+""+div_add_contact_person_tele_a+"</div>";
                        $("#txtcontact_address").attr("onclick", "loadaddressmodal(\"txtcontact_address\")");
                        $("#txtcontact_address").attr("onkeyup", "loadaddressmodal(\"txtcontact_address\")");
                        $( aff ).appendTo( "#div_content_contact_person_list" );
                        $("#txtcontact_address").css("background-color", "white !important");

                        $("#txtcontact_fname").val("");
                        $("#txtcontact_mname").val("");
                        $("#txtcontact_lname").val("");
                        $("#txtcontact_designation").val("");
                        $("#txtcontact_address").val("");
                        uploadcss();   

                        var div_add_contact_person_email = "div_add_contact_person_email";
                        var person_email = "";
                        var div_add_contact_person_mobile = "div_add_contact_person_mobile";
                        var person_mobile = "input-mask-phone";
                        var div_add_contact_person_tele = "div_add_contact_person_tele";
                        var person_tele = "input-mask-tele";
                        $("#div_add_contact_person_email").html("<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control email-address'  placeholder='sample@yahoo.com'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div_add_contact_person_email+"\", \""+person_email+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>");
                        $("#div_add_contact_person_mobile").html("<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control input-mask-phone' maxlength='11' placeholder='(999)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div_add_contact_person_mobile+"\", \""+person_mobile+"\")'> <i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>");
                        $("#div_add_contact_person_tele").html("<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control input-mask-tele' maxlength='11' placeholder='(99)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div_add_contact_person_tele+"\", \""+person_tele+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>");
                        telno();  
                        $("#div_add_contact_person_email input").attr("style", "border-color:#D5D5D5 !important");
                        $("#div_add_contact_person_mobile input").attr("style", "border-color:#D5D5D5 !important");
                        $("#div_add_contact_person_tele input").attr("style", "border-color:#D5D5D5 !important");
                        $('.save_contact_per').each(function() {
                          if ( $(this).val() ==  "") {
                              $(this).attr("style", "border-color:#D5D5D5 !important;background-color:white !important;");
                          }
                        });                      
                    }
                    else
                    {
                        showmodal("alert", "This contact person is already existing.", "", null, "", null, "1");
                        $("#div_add_contact_person_email input").attr("style", "border-color:#f2a696 !important");
                        $("#div_add_contact_person_mobile input").attr("style", "border-color:#f2a696 !important");
                        $("#div_add_contact_person_tele input").attr("style", "border-color:#f2a696 !important");

                        $('.save_contact_per').each(function() {
                              $(this).attr("style", "border-color:#f2a696 !important;background-color:white !important;");
                        }); 

                        $('.save_contact_per').each(function() {
                              this.focus();
                              return false;
                        });
                    }
                }
            })

                           
        }
        else
        {
            if(div_add_contact_person_email == "" && div_add_contact_person_mobile == "" && div_add_contact_person_tele == "")
            {
                showmodal("alert", "Please enter atleast one contact information, and fill other required information.", "", null, "", null, "1");
                $("#div_add_contact_person_email input").attr("style", "border-color:#f2a696 !important");
                $("#div_add_contact_person_mobile input").attr("style", "border-color:#f2a696 !important");
                $("#div_add_contact_person_tele input").attr("style", "border-color:#f2a696 !important");

                $(".save_contact_per").each(function() {
                  if ( $(this).val() ==  "") {
                       $(this).attr("style", "border-color:#f2a696 !important;background-color:white !important;");
                  }
                }); 

                $('.save_contact_per').each(function() {
                  if ( this.value === '' ) {
                      this.focus();
                      return false;
                  }
                });
            }
            else
            {
                showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
                $('.save_contact_per').each(function() {
                  if ( $(this).val() ==  "" ) {
                       $(this).attr("style", "border-color:#f2a696 !important;background-color:white !important;");
                  }
                }); 

                $('.save_contact_per').each(function() {
                  if ( this.value === '' ) {
                      this.focus();
                      return false;
                  }
                });
            }
        }  
}

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

function validatWebsite(sEmail) {
    var filter = /www.((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}  

function loadindustry()
{
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=loadindustry',
        success: function(data)
        {
            $("#txtcomp_industry").html(data);
        }
    })
}

function loadcompanyposition()
{
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=loadcompanyposition',
        success: function(data)
        {
            $("#txtcontact_designation").html(data);
        }
    })
}
// css of image upload
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

        $('.upload').ace_file_input({
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
 // (end) css of upload 

 // drop add new contact person form
  var clicked2 = false;
  $("#div_addnewcontactperson").slideDown();
  clicked2 = true; 

    function addnewcontactperson()
    {
     if(clicked2)
     {
        $("#div_addnewcontactperson").slideUp();
        $("#carret_icon_div").removeClass("fa-caret-down");
        $("#carret_icon_div").removeClass("fa-caret-up");
        $("#carret_icon_div").addClass("fa-caret-down");
        clicked2 = false;
        
     }
     else
     {
        $("#div_addnewcontactperson").slideDown();
        $("#div_addnewcontactperson").css("display", "block");
        // $("#txtapp_contact_firstname").focus();
        $("#carret_icon_div").removeClass("fa-caret-down");
        $("#carret_icon_div").removeClass("fa-caret-up");
        $("#carret_icon_div").addClass("fa-caret-up");
        clicked2 = true;
     }
    }

// appearing of attached (logo) image
  function showimg(){
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("file_upload").files[0]);
        
    oFReader.onload = function (oFREvent) {
        document.getElementById("imgaccount").src = oFREvent.target.result;
    };
  }

// save new mall func
    function savenewmall()
    {
        $("#div_company_contacts input").each(function(){
                $(this).css("border-color","#D5D5D5");
        }); 
        $("#add_tel_no_owner input").each(function(){
            $(this).css("border-color","#D5D5D5");
        });
        $("#div_well_contacts").css("border-color","#D5D5D5"); 
        $("#div_well_contact_persons").css("border-color","#D5D5D5");
        var e = 0;
        $(".text_reqcompany").each(function(){
          if($(this).val() == "")
          {
            e++;
            $(this).css("border-color","#f2a696");
          }
          else
            {
              $(this).css("border-color","#D5D5D5");
            }
        });

        var f = 0;
        $("#div_company_contacts input").each(function(){
            if($(this).val() != "")
            {
                f++;
            }
        });

        var g = 0;
        $("#add_tel_no_owner input").each(function(){
            if($(this).val() != "")
            {
                g++;
            }
        }); 

        var i = 0;
        $("#div_content_contact_person_list .div_contact_person").each(function(){
                i++;
        });       
        // alert(f +"|"+ g +"|"+ i)
        if(e == 0 && f != 0 && g != 0 && i != 0)
        { 
            var name = $("#txtcomp_name").val();
            var industry = $("#txtcomp_industry").val();
            var busadd = $("#txtcomp_busadd").val();

            var fname = $("#txtcomp_fname").val();
            var mname = $("#txtcomp_mname").val();
            var lname = $("#txtcomp_lname").val();
            var perm_add = $("#txtcomp_perm_add").val();
            var curr_add = $("#txtcomp_curr_add").val();
            var bill_add = $("#txtcomp_bill_add").val();

            var owner_tel_no = "";
            $("#add_tel_no_owner input").each(function()
            {
                var tel = $(this).val();
                if (!tel.match(/^\s*$/) || tel != "")
                {
                    owner_tel_no += tel + "|";
                }
            });

            var contact_mobile = "";
            $("#company_contact_mobile input").each(function()
            {
                var mob = $(this).val();
                if (!mob.match(/^\s*$/) || mob != "")
                {
                    contact_mobile += mob + "|";
                }            
            });

            var contact_tele = "";
            $("#company_contact_tele input").each(function()
            {
                var tel = $(this).val();
                if (!tel.match(/^\s*$/) || tel != "")
                {
                    contact_tele += tel + "|";
                }            
            });

            var contact_fax = "";
            $("#company_contact_fax input").each(function()
            {
                var fax = $(this).val();
                if (!fax.match(/^\s*$/) || fax != "")
                {
                    contact_fax += fax + "|";
                }            
            });

            var contact_email = "";
            $("#company_contact_email input").each(function()
            {
                var email = $(this).val();
                if (!email.match(/^\s*$/) || email != "")
                {
                    contact_email += email + "|";
                }            
            });

            var contact_website = "";
            $("#company_contact_website input").each(function()
            {
                var web = $(this).val();
                if (!web.match(/^\s*$/) || web != "")
                {
                    contact_website += web + "|";
                }            
            });

            
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'name=' + name +
                '&industry=' + industry +
                '&busadd=' + busadd +
                '&fname=' + fname +
                '&mname=' + mname +
                '&lname=' + lname +
                '&perm_add=' + perm_add +
                '&curr_add=' + curr_add +
                '&bill_add=' + bill_add +
                '&owner_tel_no=' + owner_tel_no +
                '&contact_mobile=' + contact_mobile +
                '&contact_tele=' + contact_tele +
                '&contact_fax=' + contact_fax +
                '&contact_email=' + contact_email +
                '&contact_website=' + contact_website +
                '&form=savenewmall',
                success: function(data)
                {
                    var arr = data.split("|");
                    if(arr[1] == "1")
                    {
                        sendprofilepic(arr[0]);   
                        savecontactpersons(arr[0]);
                        loadcompanylo();
                        $("#div_company_contacts input").each(function(){
                                $(this).css("border-color","#D5D5D5");
                        }); 
                        $("#add_tel_no_owner input").each(function(){
                            $(this).css("border-color","#D5D5D5");
                        });
                        $("#div_well_contacts").css("border-color","#D5D5D5"); 
                        $("#div_well_contact_persons").css("border-color","#D5D5D5");              
                    }
                }
            })
        }
        else
        {
          alert("Fill all required fields!");
          $('.text_reqcompany').each(function() {
          if ( this.value === '' ) {
              this.focus();
              return false;
          }
          });

            if(f == 0)
            {
               $("#div_well_contacts").css("border-color","#f2a696");                
            }

            if(g == 0)
            {
                $("#add_tel_no_owner input").each(function(){
                    if($(this).val() == "")
                    {
                        $(this).css("border-color","#f2a696");
                    }
                }); 
            }
           if(i == 0)
            {
                $("#div_well_contact_persons").css("border-color","#f2a696"); 
            } 
        }
    }

// saving of contact person
    function savecontactpersons(compID)
    {
        var i = 0;
        var e = 0;
        $("#div_content_contact_person_list .div_contact_person").each(function(){
                i++;
        });

        if(i == 0)
        {
            $("#modal_new_company").modal("hide");
            alert("Successfully Added!");
            $("#div_content_contact_person_list").html("");
            loadcompanylist();
        }
        else
        {

            $("#div_content_contact_person_list .div_contact_person").each(function(){
                var firstname = $(this).find(".contact_person_firstname");
                var middlename = $(this).find(".contact_person_middlename");
                var lastname = $(this).find(".contact_person_lastname");
                var designation = $(this).find(".contact_person_designation");
                var address = $(this).find(".address_person");
                var email = $(this).find(".contact_person_emailadd");
                var mobile = $(this).find(".contact_person_mobno");
                var tele = $(this).find(".contact_person_telno");
                var form = $(this).find(".posting_profilepic");

                var firstname_val = firstname.text();
                var middlename_val = middlename.text();
                var lastname_val = lastname.text();
                var designation_val = designation.text();
                var address_val = address.text();
                var formselected = form.attr("id");

                // var email_val = email.text();
                // var mobile_val = mobile.text();
                // var tele_val = tele.text();
                
                var email_string = "";
                var mobile_string = "";
                var tele_string = ""            

                for(var a=0; a<=email.length-1; a++)
                {
                    email_string +=$( email[a]).text() + "|";
                }
                
                for(var b=0; b<=mobile.length-1; b++)
                {
                    mobile_string +=$( mobile[b]).text() + "|";
                }

                for(var c=0; c<=tele.length-1; c++)
                {
                    tele_string += $(tele[c]).text() + "|";
                } 
                
                $.ajax({
                    type: 'POST',
                    url: 'mainclass.php',
                    data: 'id=' + compID + 
                          '&firstname_val=' + firstname_val +
                          '&middlename_val=' + middlename_val +
                          '&lastname_val=' + lastname_val +
                          '&designation_val=' + designation_val +
                          '&address_val=' + address_val +
                          '&email_string=' + email_string +
                          '&mobile_string=' + mobile_string +
                          '&tele_string=' + tele_string +
                          '&form=savecontactpersons',
                    success: function(data)
                    {
                        e++;
                        sendcontactpic(data, formselected, compID, i, e);
                    }
                })    
            });
        }
    }

// uploading of contact iamge
    function sendcontactpic(contactID, form, compid, i, e){
        $(".txtcon_person").val(contactID);
        $(".txtcon_company").val(compid);
        var data = new FormData($('#'+form)[0]);
        $.ajax({
          type:"POST",
          url:"inquiry/upload_app_contact.php",
          data: data,
          mimeType: "multipart/form-data",
          contentType: false,
          cache: false,
          processData: false,
          success:function(data){
            // listofrequirements();
            // closemodal("uploadattach");
            if(i == e)
            {
                $("#modal_new_company").modal("hide");
                $("#div_well_contact_persons").html("");
                alert("Successfully Added!");
                loadcompanylist();
            }
          }
        });
    }

// uploading of company logo
    function sendprofilepic(custid){
        $("#hidden_company_id").val(custid);
        var data = new FormData($('#posting_profilepic')[0]);
        $.ajax({
          type:"POST",
          url:"inquiry/upload_app_profile.php",
          data: data,
          mimeType: "multipart/form-data",
          contentType: false,
          cache: false,
          processData: false,
          success:function(data){
            // listofrequirements();
            // closemodal("uploadattach");
          }
        });
    }

// adding new contact number (tele num) for owner
    function div_addtel_owner()
    {
      var div_addtel_owner = "";
      var i = 0;
      $("#add_tel_no_owner input").each(function(){
        var value = $(this).val();
        if (!value.match(/^\s*$/)) {
          div_addtel_owner += "<input type='text' class='form-control input-mask-tele' value='"+value+"' style='margin-bottom:5px;' maxlength='11'>";
        } 
        else
        {
          i++;
        }
      });
      if(i == 0)
      {
        div_addtel_owner += "<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control input-mask-tele' maxlength='11'><div class='spinbox-buttons input-group-btn' placeholder='(99)-999-9999'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_addtel_owner()'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
      }
      else
      {
        div_addtel_owner += "<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control input-mask-tele' maxlength='11' style='border-color:#f2a696;' placeholder='(99)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_addtel_owner()'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";
        alert("Fill the field first with correct format required to add more.");
      }
      

      $("#add_tel_no_owner").html(div_addtel_owner);
      telno()
    }

// remove str function
    function removestr(str, del)
    {
        var arr = str.split(del);
        for(var i = 0; i<arr.length; i++)
        {
            str = str.replace(del, "");
        }
        return str;
    }

// adding new field inside a div
    function div_add_field(div, format)
    {
      var div_addtel_owner = "";
      var i = 0;
      if(format == "emailaddress")
      {
            $("#"+div+" input").each(function(){
              var value = $(this).val();
                if( /(.+)@(.+){2,}\.(.+){2,}/.test(value) )
                {
                  if (!value.match(/^\s*$/)) {
                    div_addtel_owner += "<input type='text' id='"+div+"' class='form-control "+format+"' value='"+value+"' style='margin-bottom:5px;'>";
                  } 
                  else
                  {
                    i++;
                  }                
                }
                else
                {
                  $(this).val("");
                  i++;
                }

            });
      }
      else if(format == "website")
      {
            $("#"+div+" input").each(function(){
                var value = $(this).val();
                if( /www(.+){2,}\.(.+){2,}/.test(value) )
                {
                  if (!value.match(/^\s*$/)) {
                    
                        // var value = removestr(value, "https://");
                        div_addtel_owner += "<input type='text' id='"+div+"' class='form-control "+format+"' value='"+value+"' style='margin-bottom:5px;'>";
                
                  } 
                  else
                  {
                    i++;
                  }                
                }
                else
                {
                  $(this).val("");
                  i++;
                }

            });
      }
      else
      {
            $("#"+div+" input").each(function(){
              var value = $(this).val();
              // alert(($(this).val()).length)
              if (!value.match(/^\s*$/)) {
                div_addtel_owner += "<input type='text' id='"+div+"' class='form-control "+format+"' value='"+value+"' style='margin-bottom:5px;'>";
              } 
              else
              {
                i++;
              }
            });        
      }


      if(i == 0)
      {
        if(format == "input-mask-phone")
        {
            div_addtel_owner += "<div class='input-group' style='width:100%;'><input type='text' id='"+div+"' class='spinbox-input form-control "+format+"' placeholder='(999)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div+"\",\""+format+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";   
        }
        if(format == "input-mask-tele")
        {
            div_addtel_owner += "<div class='input-group' style='width:100%;'><input type='text' id='"+div+"' class='spinbox-input form-control "+format+"' placeholder='(99)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div+"\",\""+format+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";   
        }
        if(format == "emailaddress")
        {
            div_addtel_owner += "<div class='input-group' style='width:100%;'><input type='text' id='"+div+"' class='spinbox-input form-control email-address "+format+"' placeholder='sample@yahoo.com'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div+"\",\""+format+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";   
        }
        if(format == "website")
        {
            div_addtel_owner += "<div class='input-group' style='width:100%;'><input type='text' id='"+div+"' class='spinbox-input form-control website-input "+format+"' placeholder='www.sample.com'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div+"\",\""+format+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";            
        }


      }
      else
      {
        if(format == "input-mask-phone")
        {
           div_addtel_owner += "<div class='input-group' style='width:100%;'><input type='text' id='"+div+"' class='spinbox-input form-control "+format+"' style='border-color:#f2a696;' placeholder='(999)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div+"\",\""+format+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>";            
        }
        if(format == "input-mask-tele")
        {
           div_addtel_owner += "<div class='input-group' style='width:100%;'><input type='text' id='"+div+"' class='spinbox-input form-control "+format+"' style='border-color:#f2a696;' placeholder='(99)-999-9999'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div+"\",\""+format+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>"; 
        }
        if(format == "emailaddress")
        {
           div_addtel_owner += "<div class='input-group' style='width:100%;'><input type='text' id='"+div+"' class='spinbox-input form-control email-address "+format+"' style='border-color:#f2a696;' placeholder='sample@yahoo.com'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div+"\",\""+format+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>"; 

           $("#div_add_contact_person_email :input").each(function(){
            $(this).focusout(function(){
                chkmobiledup('div_add_contact_person_email', $(this));
            });
           });
        }
        if(format == "website")
        {
           div_addtel_owner += "<div class='input-group' style='width:100%;'><input type='text' id='"+div+"' class='spinbox-input form-control website-input "+format+"' style='border-color:#f2a696;' placeholder='www.sample.com'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div+"\",\""+format+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>"; 
        }


        alert("Fill the field first with correct format required to add more.");
      }
      

      $("#"+div).html(div_addtel_owner);
      telno();
      autotrapfields();


    }  

//adding of contact person
    function addcontactperson()
    {
        var aff = "";
        // aff += $("#div_content_contact_person_list").html();

        var contact_firstname = $("#txtcontact_fname").val();
        var contact_middlename = $("#txtcontact_mname").val();
        var contact_lastname = $("#txtcontact_lname").val();
        var contact_designation = $("#txtcontact_designation").val();
        var contact_address = $("#txtcontact_address").val();


        var div_add_contact_person_email = "";
        $("#div_add_contact_person_email input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_email += "<p style='font-size: 10px; font-weight: normal;margin: 0px !important;font-style: underline;' class='contact_person_emailadd'>" + value + "</p>";
            }
        });

        var div_add_contact_person_mobile = "";
        $("#div_add_contact_person_mobile input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_mobile += "<p style='font-size: 12px; font-weight: normal;font-style: italic;margin: 0px !important;' class='contact_person_mobno'>" + value + "</p>";
            }
        });

        var div_add_contact_person_tele = "";
        $("#div_add_contact_person_tele input").each(function(){
            var value = $(this).val();
            if(!value.match(/^\s*$/))
            {
                div_add_contact_person_tele += "<p style='font-size: 12px; font-weight: normal;font-style: italic;margin: 0px !important;' class='contact_person_telno'>" + value + "</p>";
            }
        });



        var i = 0;
        $("div .div_contact_person").each(function(){
            i++;
          });

        var idimg = "imgaccount_"+i;
        var fileimg = "file_upload"+i;
        var fileform = "posting_profilepic"+i;

        aff += "<div class='alert alert-info div_contact_person save_this_div'><center><div class='image'><img class='img-thumbnail imageName form-control' src='assets/images/avatars/noimage.png' id='"+idimg+"' style='border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;width:90%;'></div><form name='posting_profilepic' id='"+fileform+"' class='posting_profilepic'><div style='display:none;'><input type='text' name='txtcon_person' class='txtcon_person'><input type='text' name='txtcon_company' class='txtcon_company'></div><input id='"+fileimg+"' name='attachment_profilepic' class='form-control upload_app_req' type='file' onchange='showimg2(\""+idimg+"\",\""+fileimg+"\");' /></form></center><label style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_firstname'>"+contact_firstname+" </label>&nbsp;<label style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_middlename'>"+contact_middlename+"</label>&nbsp;<label style='font-size: 14px; font-weight: bold;margin: 0px !important;' class='contact_person_lastname'>"+contact_lastname+"</label><p style='font-size: 14px; font-weight: normal;margin: 0px !important;' class='contact_person_designation'>"+contact_designation+"</p><p style='font-size: 10px; font-weight: normal;margin: 0px !important;' class='address_person'>"+contact_address+"</p>"+div_add_contact_person_email+""+div_add_contact_person_mobile+""+div_add_contact_person_tele+"</div>";

        if((contact_firstname != "" && !contact_firstname.match(/^\s*$/)) && (contact_lastname != "" && !contact_lastname.match(/^\s*$/)) && (contact_designation != "" && !contact_designation.match(/^\s*$/)) && (contact_address != "" && !contact_address.match(/^\s*$/)) && (div_add_contact_person_email != "" || div_add_contact_person_mobile != "" || div_add_contact_person_tele != "") )
        {
            $( aff ).appendTo( "#div_content_contact_person_list" );
            uploadcss();

            $("#txtcontact_fname").val("");
            $("#txtcontact_mname").val("");
            $("#txtcontact_lname").val("");
            $("#txtcontact_designation").val("");
            $("#txtcontact_address").val("");
            var div_add_contact_person_email = "div_add_contact_person_email";
            var person_email = "";
            var div_add_contact_person_mobile = "div_add_contact_person_mobile";
            var person_mobile = "input-mask-phone";
            var div_add_contact_person_tele = "div_add_contact_person_tele";
            var person_tele = "input-mask-tele";
            $("#div_add_contact_person_email").html("<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control' maxlength='11'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div_add_contact_person_email+"\", \""+person_email+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>");
            $("#div_add_contact_person_mobile").html("<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control input-mask-phone' maxlength='11'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div_add_contact_person_mobile+"\", \""+person_mobile+"\")'> <i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>");
            $("#div_add_contact_person_tele").html("<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control input-mask-tele' maxlength='11'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div_add_contact_person_tele+"\", \""+person_tele+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>");
            telno();  
            $("#div_add_contact_person_email input").attr("style", "border-color:#D5D5D5 !important");
            $("#div_add_contact_person_mobile input").attr("style", "border-color:#D5D5D5 !important");
            $("#div_add_contact_person_tele input").attr("style", "border-color:#D5D5D5 !important");
            $('.save_contact_per').each(function() {
              if ( $(this).val() ==  "") {
                  $(this).attr("style", "border-color:#D5D5D5 !important");
              }
            });                    
        }
        else
        {
            if(div_add_contact_person_email == "" && div_add_contact_person_mobile == "" && div_add_contact_person_tele == "")
            {
                showmodal("alert", "Please enter atleast one contact information, and fill other required information.", "", null, "", null, "1");
                $("#div_add_contact_person_email input").attr("style", "border-color:#f2a696 !important");
                $("#div_add_contact_person_mobile input").attr("style", "border-color:#f2a696 !important");
                $("#div_add_contact_person_tele input").attr("style", "border-color:#f2a696 !important");

                $(".save_contact_per").each(function() {
                  if ( $(this).val() ==  "") {
                       $(this).attr("style", "border-color:#f2a696 !important");
                  }
                }); 

                $('.save_contact_per').each(function() {
                  if ( this.value === '' ) {
                      this.focus();
                      return false;
                  }
                });
            }
            else
            {
                // showmodal("alert", "Fill all required fields.", "", null, "", null, "1"); 
                alert("Fill all required fields.") 
                $('.save_contact_per').each(function() {
                  if ( $(this).val() ==  "" ) {
                       $(this).attr("style", "border-color:#f2a696 !important");
                  }
                }); 

                $('.save_contact_per').each(function() {
                  if ( this.value === '' ) {
                      this.focus();
                      return false;
                  }
                });
            }
        }
    } 

// adding css to upload element
  function uploadcss()
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

  // show image of contact person
    function showimg2(imgid, fileid){
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById(fileid).files[0]);
            
        oFReader.onload = function (oFREvent) {
            document.getElementById(imgid).src = oFREvent.target.result;
        };
      } 

      function showimg3(imgid, fileid, conID, comID){
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById(fileid).files[0]);
            
        oFReader.onload = function (oFREvent) {
            document.getElementById(imgid).src = oFREvent.target.result;
        };

        $("#txtcon_person_addnew_"+conID+"").val(conID);
        $("#txtcon_company_addnew_"+conID+"").val(comID);
        var data = new FormData($('#posting_profilepic_addnew_'+conID)[0]);
        $.ajax({
          type:"POST",
          url:"inquiry/update_contact_profilepic.php",
          data: data,
          mimeType: "multipart/form-data",
          contentType: false,
          cache: false,
          processData: false,
          success:function(data){
            loadexistingcontactpersons(comID)
          }
        });
      } 
</script>