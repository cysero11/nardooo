<?php
    include("../connect.php");
?>
<div class="col-md-12 col-xs-12" style="margin-bottom: 10px;">
  <div class="col-md-2 col-xs-12 pull-right" style="padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px;">
      <a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="newcompany()">New Company</a>
  </div>
</div>
<div class="form-group row">
    <div class="col-xs-3">
        <div class="widget-box widget-color-blue2">
            <div class="widget-header">
                <h4 class="widget-title lighter smaller">Company List</h4>
            </div>
            <div class="widget-body">
                <div id="div_company_list_ol"></div>
                <div class="dd dd-draghandle cont" style="margin: 10px; height: 412px; overflow: hidden; outline: none;overflow-y: scroll;" tabindex="3">
                    <ol class="dd-list" id="companylist_ol">
                        
                    </ol>
                </div>
            </div>
        </div>        
    </div>
    <div class="col-xs-9">
        <div class="form-group row">
            <div class="col-md-3 col-xs-12">
                <img id="company_logo" class="img-responsive img-thumbnail" style="height: 180px; width: 180px;">
            </div>
            <div class="col-md-5 col-xs-12">
                <div class="form-group row">
                    <div class="col-md-4">Company Name</div>
                    <div class="col-md-8"><input type="text" class="form-control input-sm" name="" id="txtcompany_name" readonly="" style="background-color: white !important;"></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">Industry</div>
                    <div class="col-md-8"><input type="text" class="form-control input-sm" name="" id="txtcompany_industry" readonly="" style="background-color: white !important;"></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">Address</div>
                    <div class="col-md-8"><textarea class="form-control input-sm" name="" id="txtcompany_address" readonly="" style="background-color: white !important;height: 75px;"></textarea></div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="form-group row">
                    <div class="col-md-12"><h4 style="margin-top: 0px;margin-bottom: 0px;">Owner Name</h4></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">First Name</div>
                    <div class="col-md-8"><input type="text" class="form-control input-sm" name="" id="txtcompany_fname" readonly="" style="background-color: white !important;"></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">Middle Name</div>
                    <div class="col-md-8"><input type="text" class="form-control input-sm" name="" id="txtcompany_mname" readonly="" style="background-color: white !important;"></div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">Last Name</div>
                    <div class="col-md-8"><input type="text" class="form-control input-sm" name="" id="txtcompany_lname" readonly="" style="background-color: white !important;"></div>
                </div>                
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-9" style="padding-top: 10px;">
                <h4 style="display: inline;color: #2679B5;"><i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;</h4>
                <h3 style="font-weight: bold;margin: 0px;color: #2679B5;display: inline;">STORE LIST</h3>
            </div>
            <div class="col-md-3">
                <a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="addnewtradename()">New Store</a>
            </div>
        </div>
        <div class="form-group row">
            <table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
                <thead class="table-thead" style="flex: 0 0 auto;width: calc(100%);">
                  <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                    <td width="7%"></td> 
                    <td width="15%">Store ID</td>
                    <td>Store Name</td>
                  </tr>
                </thead>
                <div id="div_store_list_table"></div>
                <tbody id="tbltradeinfolisthist" style="flex: 1 1 auto; display: block; height: 15em; overflow: hidden; outline: none;" tabindex="5">

                </tbody>
            </table>        
        </div>
    </div>    
</div>
<?php 
include("update_company.php");
include("modal_update_contact_person.php");
include("modal_referential.php");
include("modal_new_address.php");
include("modal_add_new_store.php");
?>
<script>
$(function() {
    loadcompanylo();
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
    $("#tbltradeinfolisthist").niceScroll({cursorcolor:"#999"});
})

function loadcompanylo()
{
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=loadcompanylo',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            $("#companylist_ol").html(data)
        }
    })
}

function loadtenantlist(idnum)
{
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'id=' + idnum + '&form=loadtardelist',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            $("#tbltradeinfolisthist").html(data);
        }
    })
}

function loadinformationcomp(idnum)
{
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'id=' + idnum + '&form=loadinformationcomp',
        success: function(data)
        {
            var arr = data.split("|");
            $("#company_logo").attr("src", arr[6])
            $("#txtcompany_name").val(arr[0]);
            $("#txtcompany_industry").val(arr[1]);
            $("#txtcompany_address").val(arr[2]);
            $("#txtcompany_fname").val(arr[3]);
            $("#txtcompany_mname").val(arr[4]);
            $("#txtcompany_lname").val(arr[5]);
            loadtenantlist(idnum);

            $("#txttrade_companyname").val(arr[0]);
            $("#txttrade_companyname").attr("value", idnum);
            $("#txttrade_tradeindustry").val(arr[1]);
            $("#txttrade_busadd").val(arr[2]);
        }
    })
}

function updatecompany(compid) {

  loadinformationcomp(compid);
  loadindustry();
  loadcompanyposition();
  $("#btn-save-contact-person").attr("onclick", "addcontactperson_update(\""+compid+"\")");
  $("#div_type_id").val("div_content_contact_person_list");
  $("#posting_profilepic").html('<div style="display: none"><input type="text" id="hidden_company_id" name="hidden_company_id"></div><input id="file_upload" name="attachment_profilepic" class="form-control upload" type="file" onchange="showimg();" />');
  $('#file_upload').ace_file_input({
    no_file:'No File ...',
    btn_choose:'Choose',
    btn_change:'Change',
    droppable:false,
    onchange:null,
    thumbnail:false
  });
  $("#modal_company_name").text("Update");
  $("#modal_new_company").modal("show");
  $("#modal_company_name").attr("onclick", "savenewmall_update(\""+compid+"\")");
  

  

  // loading of other information
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'id=' + compid + '&form=load_updatecompany',
    success: function(data) {
      var arr = data.split("|");
      
      $("#txtcomp_name").val(arr[0]);
      $("#txtcomp_industry").val(arr[1]);
      $("#txtcomp_busadd").val(arr[2]);
      $("#txtcomp_fname").val(arr[3]);
      $("#txtcomp_mname").val(arr[4]);
      $("#txtcomp_lname").val(arr[5]);
      $("#txtcomp_perm_add").val(arr[6]);
      $("#txtcomp_curr_add").val(arr[7]);
      $("#txtcomp_bill_add").val(arr[8]);
      $("#imgaccount").attr("src", arr[9]);

      $("#div_add_contact .home-address").each(function(){
      var thisid = $(this).attr("id");
        if($(this).val() == "")
        {
            $(this).attr("onclick", "loadaddressmodal(\""+thisid+"\")");
            $(this).attr("onkeyup", "loadaddressmodal(\""+thisid+"\")");        
        }
        else
        {
            $(this).attr("onclick", "");
            $(this).attr("onkeyup", ""); 
        }
      });
    }
  })

  // owner telephone number
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'id=' + compid + '&form=load_updatecompany_ownertelno',
    success: function(data) {
      $("#add_tel_no_owner").html(data);
      telno();
      autotrapfields();
    }
  })

  // company contact number
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'id=' + compid + '&form=load_updatecompany_companycontacts',
    success: function(data) {
      var arr = data.split("#|");
      $("#company_contact_mobile").html(arr[0]);
      $("#company_contact_tele").html(arr[1]);
      $("#company_contact_fax").html(arr[2]);
      $("#company_contact_email").html(arr[3]);
      $("#company_contact_website").html(arr[4]);
      telno();
      autotrapfields();
    }
  }) 

  // company contact persons
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'id=' + compid + '&form=load_updatecompany_contactpersons',
    success: function(data) {
      // alert(data)
      $("#div_content_contact_person_list").html(data);
    }
  })  
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

function newcompany()
{
  $("#btn-save-contact-person").attr("onclick", "addcontactperson()");
  $(".home-address").each(function(){
    var this_id = $(this).attr("id");
    $(this).attr("onclick", "loadaddressmodal(\""+this_id+"\")")
  })
  $("#posting_profilepic").html('<div style="display: none"><input type="text" id="hidden_company_id" name="hidden_company_id"></div><input id="file_upload" name="attachment_profilepic" class="form-control upload" type="file" onchange="showimg();" />');
  $('#file_upload').ace_file_input({
    no_file:'No File ...',
    btn_choose:'Choose',
    btn_change:'Change',
    droppable:false,
    onchange:null,
    thumbnail:false
  });
  $("#imgaccount").attr("src", "assets/images/avatars/noimage.png");
  $(".text_reqcompany").val("");
  $("#modal_new_company").modal("show");
  $("#modal_company_name").text("Save");
  $("#modal_company_name").attr("onclick", "savenewmall()");
  $(".home-address").val("");
  loadindustry();
  loadcompanyposition();
  $("#txtcontact_address").attr("onclick", "loadaddressmodal(\"txtcontact_address\")");
  $("#txtcontact_address").attr("onkeyup", "loadaddressmodal(\"txtcontact_address\")");
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
  $("#div_add_contact_person_email").html("<div class='input-group'><input type='text' id='spinner3' class='spinbox-input form-control email-address' placeholder='sample@yahoo.com'><div class='spinbox-buttons input-group-btn'><button type='button' class='btn spinbox-up btn-sm btn-success' onclick='div_add_field(\""+div_add_contact_person_email+"\", \""+person_email+"\")'><i class='icon-only  ace-icon ace-icon fa fa-plus bigger-110'></i></button></div></div>");
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
  $("#txtcomp_busadd").css("text-indent", "");
  $("#txtcomp_busadd_icon").removeClass("fa-map-marker");
  $("#txtcomp_perm_add").css("text-indent", "");
  $("#txtcomp_perm_add_icon").removeClass("fa-map-marker");
  $("#txtcomp_curr_add").css("text-indent", "");
  $("#txtcomp_curr_add_icon").removeClass("fa-map-marker");
  $("#txtcomp_bill_add").css("text-indent", "");
  $("#txtcomp_bill_add_icon").removeClass("fa-map-marker");
  $("#txtcontact_address").css("text-indent", "");
  $("#txtcontact_address_icon").removeClass("fa-map-marker");
  $("#add_tel_no_owner").html('<div class="input-group"><input type="text" id="add_tel_no_owner" class="spinbox-input form-control input-mask-tele" maxlength="11" placeholder="(99)-999-9999"><div class="spinbox-buttons input-group-btn"><button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_addtel_owner()"><i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i></button></div></div>');
  $("#company_contact_mobile").html('<input type="text" id="company_contact_mobile" class="spinbox-input form-control input-mask-phone" maxlength="11" placeholder="(999)-999-9999"><div class="spinbox-buttons input-group-btn"><button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field(\'company_contact_mobile\', \'input-mask-phone\')"><i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i></button></div>');
  $("#company_contact_tele").html('<input type="text" id="company_contact_tele" class="spinbox-input form-control input-mask-tele" maxlength="11" placeholder="(99)-999-9999"> <div class="spinbox-buttons input-group-btn"><button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field(\'company_contact_tele\', \'input-mask-tele\')"><i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i></button></div>');
  $("#company_contact_fax").html('<input type="text" id="company_contact_fax" class="spinbox-input form-control input-mask-tele" maxlength="11" placeholder="(99)-999-9999"><div class="spinbox-buttons input-group-btn"><button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field(\'company_contact_fax\', \'input-mask-tele\')"><i class="icon-only ace-icon ace-icon fa fa-plus bigger-110"></i></button></div>');
  $("#company_contact_email").html('<input type="text" id="company_contact_email" onkeyup="" class="spinbox-input form-control email-address" placeholder="sample@yahoo.com"><div class="spinbox-buttons input-group-btn"><button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field(\'company_contact_email\', \'emailaddress\')"><i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i></button></div>');
  $("#company_contact_website").html('<input type="text" id="company_contact_website" class="spinbox-input form-control website-input" placeholder="www.sample.com"><div class="spinbox-buttons input-group-btn"><button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field(\'company_contact_website\', \'website\')"><i class="icon-only ace-icon ace-icon fa fa-plus bigger-110"></i></button></div>');
  $("#div_content_contact_person_list").html("");
  $("#txtcontact_fname").val("");
  telno();
  autotrapfields();
}


    function telno()
    {
        $.mask.definitions['~']='[+-]';
        $('.input-mask-date').mask('99/99/9999', {placeholder:" ",completed:function(){var idselected = $(this).attr("id");  chkmobiledup(idselected, $(this))}});
        $('.input-mask-phone').mask('(999) 999-9999', {placeholder:" ",completed:function(){var idselected = $(this).attr("id");  chkmobiledup(idselected, $(this))}});
        $('.input-mask-tele').mask('(99)-999-9999', {placeholder:" ",completed:function(){var idselected = $(this).attr("id");  chkmobiledup(idselected, $(this))}});
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
    }
    
    $.mask.definitions['~']='[+-]';
    $('.input-mask-date').mask('99/99/9999', {placeholder:" ",completed:function(){var idselected = $(this).attr("id");  chkmobiledup(idselected, $(this))}});
    $('.input-mask-month').mask('99/99/9999', {placeholder:" ",completed:function(){var idselected = $(this).attr("id");  chkmobiledup(idselected, $(this))}});
    $('.input-mask-phone').mask('(999) 999-9999',{placeholder:" ",completed:function(){chkmobiledup($(this))}});
    $('.input-mask-tele').mask('(99)-999-9999', {placeholder:" ",completed:function(){var idselected = $(this).attr("id");  chkmobiledup(idselected, $(this))}});
    $('.input-mask-eyescript').mask('~9.99 ~9.99 999', {placeholder:" ",completed:function(){var idselected = $(this).attr("id");  chkmobiledup(idselected, $(this))}});
    $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});

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

    $('[data-rel=tooltip]').tooltip();
    $('[data-rel=popover]').popover({html:true});
</script>
