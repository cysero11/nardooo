<div class="modal fade" id="modal_login_override" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">   
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" onclick="hidemodal_login_override()">×</button>
         <h4 class="modal-title" id="txtref_name">Login</h4><br>
          <div class="row form-group">
              <div class="col-xs-12 col-md-3">
                 Username
              </div>
              <div class="col-xs-12 col-md-9">
                <span class="input-icon">
          <input type="text" class="form-control" name="" id="txtoverrideusername">
          <i class="ace-icon fa fa-user blue"></i>
        </span>
              </div>
          </div>
          <div class="row form-group">
              <div class="col-xs-12 col-md-3">
                 Password
              </div>
              <div class="col-xs-12 col-md-9">
                <span class="input-icon">
          <input type="password" class="form-control" name="" id="txtoverridepassword">
          <i class="ace-icon fa fa-lock blue"></i>
        </span>
                 
              </div>
          </div>
          <div class="row form-group" style="margin-bottom: 0px;">
              <div class="col-xs-12 col-md-6">
                 <button class="btn btn-danger btn-sm btn-block" onclick="hidemodal_login_override()">Cancel
                  </button>
              </div>
              <div class="col-xs-12 col-md-6">
                 <button class="btn btn-info btn-sm btn-block" id="btnshowoverridemodal">Login
                  </button>
              </div>
          </div>
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">
function showmodal_login_override(id, increament, appid, inqid){
  $("#modal_login_override").modal("show");
  $("#btnshowoverridemodal").attr("onclick", "confirmoverride(\""+id+"\", \""+increament+"\", \""+appid+"\", \""+inqid+"\")");
}

function hidemodal_login_override(){
  $("#modal_login_override").modal("hide");
  $("#txtoverrideusername").val("");
  $("#txtoverridepassword").val("");
}

function confirmoverride(id, increament, appid, inqid){
  var username = $("#txtoverrideusername").val();
  var password = $("#txtoverridepassword").val();
  if(username != ""){
    if(password != ""){
      $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'username=' + username + '&password=' + password + '&id=' + id + '&appid=' + appid + '&inqid=' + inqid + '&form=confirmoverride',
        success:function(data){
          if(data == "1"){
            showmodal("alert", "Override Success.", "hidemodal_login_override", null, "", null, "0");
            $("#overridemoko"+id).removeClass("upload_app_req");
            $("#posting_commentreq_"+increament).removeClass("form_lease_application_req_2");
          }else if(data == "2"){
            showmodal("alert", "User not found.", "hidemodal_login_override", null, "", null, "0");
          }else if(data == "3"){
            showmodal("alert", "Sorry but you don't have access for this function.", "hidemodal_login_override", null, "", null, "0");
          }
        }
      })
    }else{
      showmodal("alert", "Please enter your password.", "", null, "", null, "0");
    }
  }else{
    showmodal("alert", "Please enter your username.", "", null, "", null, "0");
  }
}

function saveinquiry(Application_ID, Inquiry_ID)
{
  var setunit = $("#txtinq_unitunit").val();
  var lcaunit = $("#txtinq_lca_unitname").val();
  var conttt = chkunitfrst2();
  var assocdues = $("#txtinq_assocdues").val().replace(",", "");
  var pymentterms = $("#txtinq_pymentterms").val();
  var pymenttype = $("#txtinq_pymenttype").val();
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
        var y = 0;
        var z = 0;
        var f = 0;

        $("#div_modal_inquiry_requirements .form_lease_application_req_2 .upload_app_req").each(function(){
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

        $(".required_inq").each(function(){
          if($(this).val() == "" || $(this).val() == "0" || $(this).val() == "0.00")
          {
            f++;
            var eto = $(this).attr("id");
            $(this).css("border-color","#f2a696");
          }
          else
            {
              $(this).css("border-color","#D5D5D5");
            }
        });

        if(f == 0)
        {
          var mallname = $("#txtinq_mallbranch option:selected").text();
          var mallid = $("#txtinq_mallbranch").val();

          var tradename = $("#txtinq_tradename").val();
          var tradeid = $("#txtinq_tradename").attr("value");
          var companyname = $("#txtinq_companyname").val();
          var companyid = $("#txtinq_companyname").attr("value");
          var industryname = $("#txtinq_industryname").val();
          var address = $("#txtinq_address").val();

          
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
            var unit_id = $("#txtinq_unitunit").val();
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

            if(y == z && y != 0 && z != 0)
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
                var selectedmonth = "";
                $("#tbodypdc_inquiry .selected").each(function(){
                  selectedmonth += $(this).attr("id") + "P" + $(this).find(".txtadvpyment").val() +"#";
                })
                
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id='+Inquiry_ID+'&appidd='+Application_ID+'&dep_id='+dep_id+'&cat_id='+cat_id+'&unit_id='+unit_id+'&datefrom='+datefrom+'&dateto='+dateto+'&req='+req+'&sqm_width='+sqm_width+'&sqm_length='+sqm_length+'&persqm='+persqm+'&totalsqm='+totalsqm+'&unitwing='+unitwing+'&unitfloor='+unitfloor+'&classid='+classid+'&unittype='+unittype+'&mallid=' + mallid +'&tradeid=' + tradeid +'&tradename=' + tradename +'&companyname=' + companyname +'&companyid=' + companyid +'&industryname=' + industryname +'&address=' + address +'&unitid=' + unit_id +'&dep_id=' + dep_id +'&cat_id=' + cat_id +'&datefrom=' + datefrom +'&dateto=' + dateto +'&monthlyadvamt=' + monthlyadvamt +'&monthlydepamt=' + monthlydepamt +'&advancepayment=' + advancepayment +'&depositpayment=' + depositpayment+'&monthnum='+monthnum+ '&daynum=' + daynum + '&statss=' + 'leaseapp' + '&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&assocdues=' + assocdues + '&cardtype=' + cardtype + '&cardholder=' + cardholder + '&authno=' + authno + '&securitycode=' + securitycode + '&ccno=' + ccno + '&expirydate=' + expirydate + '&bankfrom=' + bankfrom + '&bf_accno=' + bf_accno + '&bankto=' + bankto + '&bt_accno=' + bt_accno + '&form=saveinquiryupdate',
                beforeSend : function() {
                  $('#indexloadingscreen').addClass('myspinner');
                },
                success: function(data){
                  $('#indexloadingscreen').removeClass('myspinner');
                  $("#div_modal_inquiry_requirements").css("border-color", "#d5d5d5");
                    var t = 0;
                    $(".form_lease_application_req_2").each(function(){
                        var this_id = $(this).attr("id");
                        var txtaapid = $(this).find(".txtaapid");
                        var txtaapid2 = txtaapid.attr("id");
                        var txtinqqid = $(this).find(".txtinqqid");
                        var txtinqqid2 = txtinqqid.attr("id");
                        t++;
                        sendData(Inquiry_ID, Application_ID, this_id, txtaapid2, txtinqqid2, i, t);
                        clicktwo();
                    })
                    showmodal("alert", "Successfully Updated.", "", null, "", null, "0");
                    loadleasingapplications();
                    $("#modal_previewleasingapplication").modal("hide");
                    clearcardinfomodal();
                }
            });
        }
        else
        {
          showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
                $('.required_inq').each(function() {
                  if ( this.value === ''  || this.value === '0' || this.value === '0.00') {
                      this.focus();
                      return false;
                  }
                });
                $("#div_modal_inquiry_requirements").css("border-color", "#f2a696");   
                        // alert(i + "|" + f)
        }
    }
    else
    {
      chkunitfrst();
      $("#txtinq_unitunit").css("border-color", "red");
      $("#txtnoofmonths_inq").css("border-color", "red");
      $("#txtinq_datefrom").css("border-color", "red");
      $("#unitinfo").click();
    }
  }
  else
  {

        var y = 0;
        var z = 0;
        var f = 0;
        $("#div_modal_inquiry_requirements .form_lease_application_req_2 .upload_app_req").each(function(){
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

        $(".required_inq").each(function(){
          if($(this).val() == "" || $(this).val() == "0" || $(this).val() == "0.00")
          {
            f++;
            var eto = $(this).attr("id");
            // alert(eto)
            $(this).css("border-color","#f2a696");
          }
          else
            {
              $(this).css("border-color","#D5D5D5");
            }
        });

        if(f == 0)
        {
          var mallname = $("#txtinq_mallbranch option:selected").text();
          var mallid = $("#txtinq_mallbranch").val();

          var tradename = $("#txtinq_tradename").val();
          var tradeid = $("#txtinq_tradename").attr("value");
          var companyname = $("#txtinq_companyname").val();
          var companyid = $("#txtinq_companyname").attr("value");
          var industryname = $("#txtinq_industryname").val();
          var address = $("#txtinq_address").val();

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
          if($("#radio_set").is(":checked"))
          {
            var unit_id = $("#txtinq_unitunit").val();
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

            if(y == z && y != 0 && z != 0)
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
            var selectedmonth = "";
            $("#tbodypdc_inquiry .selected").each(function(){
              selectedmonth += $(this).attr("id") + "P" + $(this).find(".txtadvpyment").val() +"#";
            })
              $.ajax({
                  type: 'POST',
                  url: 'mainclass.php',
                  data: 'id='+Inquiry_ID+'&dep_id='+dep_id+'&cat_id='+cat_id+'&unit_id='+unit_id+'&datefrom='+datefrom+'&dateto='+dateto+'&req='+req+'&sqm_width='+sqm_width+'&sqm_length='+sqm_length+'&persqm='+persqm+'&totalsqm='+totalsqm+'&unitwing='+unitwing+'&unitfloor='+unitfloor+'&classid='+classid+'&unittype='+unittype+'&mallid=' + mallid +'&tradeid=' + tradeid +'&tradename=' + tradename +'&companyname=' + companyname +'&companyid=' + companyid +'&industryname=' + industryname +'&address=' + address +'&remarks=' + remarks +'&unitid=' + unit_id +'&dep_id=' + dep_id +'&cat_id=' + cat_id +'&datefrom=' + datefrom +'&dateto=' + dateto +'&monthlyadvamt=' + monthlyadvamt +'&monthlydepamt=' + monthlydepamt +'&advancepayment=' + advancepayment +'&depositpayment=' + depositpayment+'&monthnum='+monthnum+'&daynum='+daynum+'&statss='+'leaseapp' + '&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&assocdues=' + assocdues + '&cardtype=' + cardtype + '&cardholder=' + cardholder + '&authno=' + authno + '&securitycode=' + securitycode + '&ccno=' + ccno + '&expirydate=' + expirydate + '&bankfrom=' + bankfrom + '&bf_accno=' + bf_accno + '&bankto=' + bankto + '&bt_accno=' + bt_accno + '&form=saveinquiryupdate',
                  beforeSend : function() {
                    $('#indexloadingscreen').addClass('myspinner');
                  },
                  success: function(data){
                    $('#indexloadingscreen').removeClass('myspinner');
                    $("#div_modal_inquiry_requirements").css("border-color", "#d5d5d5");
                      var t = 0;
                      $(".form_lease_application_req_2").each(function(){
                          var this_id = $(this).attr("id");
                          var txtaapid = $(this).find(".txtaapid");
                          var txtaapid2 = txtaapid.attr("id");
                          var txtinqqid = $(this).find(".txtinqqid");
                          var txtinqqid2 = txtinqqid.attr("id");
                          t++;
                          sendData(Inquiry_ID, Application_ID, this_id, txtaapid2, txtinqqid2, i, t);
                          clicktwo();
                      })
                      showmodal("alert", "Successfully Updated.", "", null, "", null, "0");
                      loadleasingapplications();
                      $("#modal_previewleasingapplication").modal("hide");
                      clearcardinfomodal();
                  }
              });
        }
        else
        {
          showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
                $('.required_inq').each(function() {
                  if ( this.value === '' || this.value == '0' || this.value == '0.00') {
                      this.focus();
                      return false;
                  }
                });
                $("#div_modal_inquiry_requirements").css("border-color", "#f2a696");   
                        // alert(i + "|" + f)
        }
  }
} 

function sendData(inq, app, formid, appid, inqid, t, i){
    $("#"+appid).val(app);
    $("#"+inqid).val(inq);
    var data = new FormData($('#'+formid)[0]);
    $.ajax({
      type:"POST",
      url:"inquiry/uploadappreq.php",
      data: data,
      mimeType: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
        if(t == i)
        {
            // alert("Successfully Added a New Application");
            loadleasingapplications();
            $("#modal_addnewinquiry").modal("hide"); 
            $("#div_modal_inquiry_requirements .well").css("border-color", "#e3e3e3");           
        }
        loadleasingapplications();
       // loadrequirements(inqid, appid);
        // closemodal("uploadattach");
      }
    });
  }

function loadtradefunction()
{
  var mallid = $("#txtinq_mallbranch").val();

  if(mallid == "")
  {
    showmodal("alert", "Select Mall First.", "", null, "", null, "1");
    $("#txtinq_mallbranch").focus();
    $("#txtinq_mallbranch").css("border-color","#f2a696");
  }
  else
  {
    modal_loadtradename();
    $("#txtinq_mallbranch").css("border-color","rgb(213, 213, 213)");
  }
}

</script>