<div class="modal fade" id="modal_loadcompany" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:white; font-weight: bold;">Company List</h4>
      </div>

       <!-- Modal body-->
      <div class="modal-body">
          <div class="row form-group">
              <div class="col-md-8 col-xs-12">
                  <span class="input-icon" style="width: 100%;">
                    <input type="text" class="form-control" title="Search according to filter selected" placeholder="Search" id="txtsearchcompany">
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                  </span>
              </div>
              <div class="col-md-4 col-xs-12">
                <a href="#" id="btn_new_comany" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="newcompany()">New Company</a>
              </div>
          </div>
          <div class="row form-group" style="margin-bottom: 0px !important;">

                <div id="companytable" class="parent">
                  <table id="simple-table" class="table table-bordered table-hover fixTable">
                        <thead>
                          <tr>
                            <td><label style="margin-left: 25px;">Company Name</label></td>
                            <td>Business Address</td>
                          </tr>
                        </thead>
                        <div class="" id="statussavingreservation_company"></div>
                        <tbody id="tblcompanylist"></tbody>
                    </table>
                </div>

                <table class="tabledash_footer table" style="margin: 0px !important;">
                  <thead>
                    <tr>
                        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                        <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtentriescompanylist"><br /></font>
                            <input type="hidden" id="txt_userpage" name="">
                            <ul id="ulpaginationcompanylist" class="pagination pull-right"></ul>
                        </th>
                    </tr>
                  </thead>
              </table>
          </div>
      </div>

       <!-- Modal footer-->
    </div>

  </div>
</div>
<div style="display: none;">
  <span id="tooltip_content3">Click <b>Enter</b> to search, and <b>Arrow Down</b> to focus on table rows.</span>
</div>
<script>
$(function(){
  $("#txtsearchcompany").focus(function(){
    $("#tblcompanylist").tablenav("remove", "tblcompanylist", "tblcompanylist", $("#tradetable"));
  });

  $("#txttrade_companyname").focus(function(){
    $("#tblcompanylist").tablenav("add", "tblcompanylist", "tblcompanylist", $("#tradetable"));
  });

  $("#txtsearchcompany").keydown(function(e){
    var x = e.keyCode;
    if(x == 13)
    { loadcompanylist(); }
    else if(x == 40)
    {
      $("#tblcompanylist").focus();
      $("#tblcompanylist").tablenav("add", "tblcompanylist", "tblcompanylist", $("#tradetable"));
    }
  });

  $("#btn_new_comany").keydown(function(e){
    var x = e.keyCode;
    if(x == 13)
    { newcompany() }
  });
});

$(function(){
  $("#companytable").click(function(){
    var obj = $(this);
    $("#tblcompanylist").tablenav("tblcompanylist", "tblcompanylist", obj);
  });
});

// laoding of company list
function updatecompany(compid) {

  // loading of other functions
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

function savenewmall_update(compid)
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

        var i = 1;
        // $("#div_content_contact_person_list .div_contact_person").each(function(){
        //         i++;
        // });
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
                '&id=' + compid +
                '&form=savenewmall_update',
                beforeSend : function() {
                  $('#indexloadingscreen').addClass('myspinner');
                },
                success: function(data){
                  $('#indexloadingscreen').removeClass('myspinner');
                    var arr = data.split("|");
                    if(arr[1] == "1")
                    {
                        sendprofilepic(arr[0]);
                        showmodal("alert", arr[2], "", null, "", null, "0");
                        $("#modal_new_company").modal("hide");
                        loadcompanylist();
                        // savecontactpersons(arr[0]);
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
          showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
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

function loadcompanylist() {
  var txtsearchcompany = $("#txtsearchcompany").val();
  var page = $("#txt_userpage").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'txtsearchcompany=' + txtsearchcompany + '&page=' + page + '&form=loadcompanylist',
    beforeSend : function() {
     $('#indexloadingscreen').addClass('myspinner');
    },
    success: function(data){
      $('#indexloadingscreen').removeClass('myspinner');
      $('#statussavingreservation_company').removeClass('myspinner2');
      $("#tblcompanylist").html(data);
      loadentriescompanylist();
      loadpagecompanylist();
    }
  })
}

// displaying of modal for loading companies
function modal_loadcompany(){
  // var trade = $("#txttrade_tradename").val();
  // if(trade == "")
  // {
  //   alert("Enter trade name first.");
  //   $("#txttrade_tradename").css("border-color","#f2a696");
  // }
  // else
  // {
    // $("#txttrade_tradename").css("border-color","#D5D5D5");
    loadentriescompanylist();
    $("#txt_userpage").val("1");
    loadcompanylist();
    $("#modal_loadcompany").modal("show");
  // }

}

// modal for new company
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

    // selecting company
    function selectthiscompanyforref(this_company)
    {
      $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'companyid=' + this_company + '&form=selectthiscompanyforref',
        success: function(data)
        {
          var arr = data.split("|");
          $("#txttrade_companyname").val(arr[1]);
          $("#txttrade_companyname").attr("value", arr[0]);
          $("#txttrade_tradeindustry").val(arr[2]);
          $("#txttrade_busadd").val(arr[3]);
          $("#modal_loadcompany").modal("hide");
        }
      })
    }

    function loadentriescompanylist(){
        var page = $("#txt_userpage").val();
        var txtsearchcompany = $("#txtsearchcompany").val();

        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'txtsearchcompany=' + txtsearchcompany + '&page=' + page  + '&form=loadentriescompanylist',
            success: function(data){
                if(data == "no data"){
                    $("#txtentriescompanylist").html("<br />");
                }
                else{
                    $("#txtentriescompanylist").text(data);
                }
            }
        });
    }

    function loadpagecompanylist()
    {
      var page = $("#txt_userpage").val();
      var txtsearchcompany = $("#txtsearchcompany").val();

      $.ajax({
          type: 'POST',
          url: 'mainclass.php',
          data: 'page=' + page + '&txtsearchcompany=' + txtsearchcompany + '&form=loadpagecompanylist',
          success: function(data){
              $("#ulpaginationcompanylist").html(data);
          }
      });
    }

    function pagination(page, pagenums){
        $(".pgnum").removeClass("active");
        var value = "#" + pagenums;
        $("#pg" + pagenums).addClass("active");
        $("#txt_userpage").val(page);
        loadcompanylist();
        loadpagecompanylist();
        loadentriescompanylist();
    }
</script>
