<?php
include("../connect.php");
?>
<style>
tbody tr td { cursor: hand !important; cursor: pointer !important; }

.parent2 {
    height: 50vh;
}

.parent3 {
    height: 40vh;
}

.parent {
    height: 50vh;
}

.business_affiliated {
   float: left;
   margin: 10px;
   padding: 10px;
   width: 200px;
   max-width: 200px;
   height: 150px;
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

.popover {
  min-width: 500px ! important;
  width: auto;
}

.popover-content{
    padding-left: 0px; /* Max Width of the popover (depending on the container!) */
    padding-right: 0px;
}
</style>

<script>
setTimeout(function(){
  $(".fixTable").tableHeadFixer();
}, 1000)
$(function(){
  $("#txtsearchapplication").focus();
	$("#txtapplicationpagesss").val("1");
  $("#txt_userpage_tenants").val("1");
	loadleasingapplications();
  $("#div_modal_inquiry_requirements").niceScroll({cursorcolor:"#999"});  
	$(".scroll").niceScroll({cursorcolor:"#999"});
	$("#tblapplicationlist").niceScroll({cursorcolor:"#999"});
	numonly();
  $("#statinquiryyy").val("valid");

	 var sys = $("#txt_syssetup").val();
    if(sys == "0")
    {
      $("#div_merchandiseinfo").css("display", "block");
      $("#txtapp_merchandise_dep").removeClass("app_req");
      $("#txtapp_merchandise_class").removeClass("app_req");
      $("#txtapp_merchandise_cat").removeClass("app_req");
      $("#txtapp_merchandise_dep").addClass("app_req");
      $("#txtapp_merchandise_class").addClass("app_req");
      $("#txtapp_merchandise_cat").addClass("app_req");
    }
    else
    {
      $("#div_merchandiseinfo").css("display", "none");
      $("#txtapp_merchandise_dep").removeClass("app_req");
      $("#txtapp_merchandise_class").removeClass("app_req");
      $("#txtapp_merchandise_cat").removeClass("app_req");
    }
  $('#radio_set').prop('checked', true); 
});

function clicklca()
{     
      $("#txtlabel_payment").text("Daily Payment");
      $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction();");
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
      paymentterms_LCA();
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
      $("#txtinq_monthlyrate2").val("");
      $("#txtinq_sqm").val("");
      $("#txtinq_persqm").val("");
      $("#txtinq_totalsqm").val("");
      $("#txtinq_assocdues").val("");
      $("#txtinq_totalmonthlydues").val("");
      $("#txtmonthlymath").val("");
      $("#div_amenities_inquiry").html("");
      $("#lbltotalamountofpayment").text("Php 0.00");
      $("#totalpayment").text("Php 0.00");
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

function clickset()
{
      $("#txtlabel_payment").text("Monthly Payment");
      $("#txtnoofmonths_inq").attr("onkeyup", "loaddatetofunction();");
      $("#txtinq_unitclass").val("");
      $("#div_wing").css("display","block");
      $("#div_floor").css("display","block");
      $("#div_unit").css("display","block");
      $("#txtinq_unitcategory").attr("onchange", "loadinquiry_wing()");
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
      paymentterms_SET();
      $("#txtinq_unitcategory").attr("onclick", "loadinquiry_wing_set()");
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
      $("#totalpayment").text("Php 0.00");
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

function chkclippeddocx(thisfile)
{
  var sel = "";
  $(".req_already_added_na").each(function(){
    var added = $(this).attr("id");
    sel += added + "|";
  })
  $(".form_lease_application_req_2").each(function(){
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
      showmodal("alert", "Sorry, but you already attached the same file.", "", null, "", null, "1");
      thisfile.click();
    }

}

function loadinquiry_unit_lca()
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
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'classification_id=' + classification_id + '&type=' + type + '&form=loadinquiry_unit_lca',
    success: function(data)
    {
      $("#txtinq_unitunit").html(data)
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

function numonly()
{
   $(".numonly").keydown(function(event) {

       // Allow only backspace and delete
       if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190) {
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
        $(this).val((isNaN(v)) ? '' : v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
   });
}

function loadleasingapplications()
{
	var key = $("#txtsearchapplication").val();
	var page = $("#txtapplicationpagesss").val();
	$.ajax({
		type: 'POST',
		url: 'mainclass.php',
		data: 'key=' + key + '&page=' + page + '&form=loadleasingapplications',
    beforeSend : function() {
     $('#indexloadingscreen').addClass('myspinner');
    },
    success: function(data){
      $('#indexloadingscreen').removeClass('myspinner');
			$("#tblapplicationlist").html(data);
			$(".scroll").niceScroll({cursorcolor:"#999"});
			loadpaginationleasingapp();
      loadleasingappentries();
		}
	})
}

function loadpaginationleasingapp()
{
  var key = $("#txtsearchapplication").val();
  var page = $("#txtapplicationpagesss").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'key=' + key + '&page=' + page + '&form=loadpaginationleasingapp',
            success: function(data){
                $("#ulleasingapppagination").html(data);
            }
        }).error(function() {
            alert(data);
        });
}

function getvalinquiry(page, pagenums)
{
        // alert(page);
            $(".pgnumptnts").removeClass("active");
            var value = "#" + pagenums;
            $("#pgptnts" + pagenums).addClass("active");
            $("#txtapplicationpagesss").val(page);
            // reloadhmo();
            loadleasingapplications();
            loadpaginationleasingapp();
            loadleasingappentries();
}

function loadleasingappentries()
{
  var key = $("#txtsearchapplication").val();
  var page = $("#txtapplicationpagesss").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'key=' + key + '&page=' + page + '&form=loadleasingappentries',
            success: function(data){
                if(data == 000)
                {
                    $("#txtleasingappentries").html("<br />");
                }
                else
                {
                    $("#txtleasingappentries").text(data);
                }
            }
        }).error(function() {
            alert(data);
        });
}	

function changestatleasingapp(Application_ID, Inquiry_ID, stat, unitid)
{
  var setunit = $("#txtinq_unitunit").val();
  var lcaunit = $("#txtinq_lca_unitname").val();
  var conttt = chkunitfrst2();
  
  if(setunit != "" || lcaunit != "")
  {
    if(conttt == "valid")
    {
      showmodal("confirm", "Do you want to save changes on this application?", "changestatleasingapp2(\""+Application_ID+"\",\""+Inquiry_ID+"\", \""+stat+"\", \""+unitid+"\")", null, "", null, "1");
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
  showmodal("confirm", "Do you want to save changes on this application?", "changestatleasingapp3(\""+Application_ID+"\",\""+Inquiry_ID+"\", \""+stat+"\", \""+unitid+"\")", null, "", null, "1");
  }
}

function changestatleasingapp2(Application_ID, Inquiry_ID, stat, unitid){
  $("#alertmodal").modal("hide");
  var remarks = $("#txtinq_remarks").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'Application_ID=' + Application_ID + '&Inquiry_ID=' + Inquiry_ID + '&stat=' + stat + '&remarks=' + remarks + '&stat=' + stat + '&unitid='+ unitid + '&form=changestatleasingapp',
    beforeSend : function() {
      $('#leasingloadingscreen').addClass('myspinner');
    },
    success: function(data){
      $('#leasingloadingscreen').removeClass('myspinner');
      if(data == 1)
      {
        loadleasingapplications();    
        $("#modal_previewleasingapplication").modal("hide");  
      }
      else if(data == 2)
      {
        loadleasingapplications();  
        showmodal("alert", "Successfully Updated.", "", null, "", null, "0");
      }
    }
  })
}

function changestatleasingapp3(Application_ID, Inquiry_ID, stat, unitid){
  $("#alertmodal").modal("hide");
  var remarks = $("#txtinq_remarks").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'Application_ID=' + Application_ID + '&Inquiry_ID=' + Inquiry_ID + '&stat=' + stat + '&remarks=' + remarks + '&stat=' + stat + '&unitid='+ unitid + '&form=changestatleasingapp',
    beforeSend : function() {
     $('#leasingloadingscreen').addClass('myspinner');
    },
    success: function(data){
      $('#leasingloadingscreen').removeClass('myspinner');
      if(data == 1)
      {
        loadleasingapplications();    
        $("#modal_previewleasingapplication").modal("hide");  
      }
      else if(data == 2)
      {
        loadleasingapplications();  
        showmodal("alert", "Successfully Updated.", "", null, "", null, "1");
      }
    }
  })
}


    function savefilter()
    {
        var module = "Application";
        var checked = "";
        $('input:checkbox[name="form-field-checkbox"]').each(function(){
            if($(this).is(":checked"))
            {
                var value = $(this).attr("value");
                checked += value + "|";
            }
        })

        var checked2 = "";
        $('input:checkbox[name="form-field-checkbox"]').each(function(){

                var value2 = $(this).attr("value");
                checked2 += value2 + "|";
        })        

        var checked3 = "";
        $('input:checkbox[name="form-field-checkbox-stat"]').each(function(){
          if($(this).is(":checked"))
          {
            var value3 = $(this).attr("value");
            checked3 += value3 + "|";
          }
        })  

        var unit = "";
        $('input:checkbox[name="form-field-checkbox-unt"]').each(function(){
          if($(this).is(":checked"))
          {
            var value3 = $(this).attr("value");
            unit += value3 + "|";
          }
        })
        
        var occstrt = $("#txtdiv_strtappp").val();
        var occend = $("#txtdiv_endappp").val();
        var appstart = "";
        var append = ""; 
        // alert(checked)
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'module=' + module +  '&checked=' + checked +  '&checked2=' + checked2 +  '&checked3=' + checked3 +  '&datefilter=' + unit +  '&occstrt=' + occstrt +  '&occend=' + occend +  '&appstart=' + appstart +  '&append=' + append + '&form=savefilter',
            beforeSend : function() {
             $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
              $('#indexloadingscreen').removeClass('myspinner');
              loadfilters_inquiry(module)
              $("#LINK_inquiry_filter").click();
            }
        })
    }

    function loadfilters_inquiry(module)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'module=' + module + '&form=loadfilters_inquiry',
            success: function(data)
            {
                // alert(data)
                var datas = data.split("#");
                var arr = datas[0].split("|");
                var arr2 = datas[1].split("|");
                var arr3 = datas[2].split("|");
                var arr4 = datas[3].split("|");
                // filter by
                for(var i=0; i<=arr.length-1; i++)
                {
                    $('input:checkbox[id="filter_'+arr[i]+'"][value="'+arr[i]+'"]').attr('checked', 'checked');
                }
                // date
                $("#txtdiv_strtappp").val(arr2[0]);
                $("#txtdiv_endappp").val(arr2[1]);
                // Status filter
                for(var i=0; i<=arr3.length-1; i++)
                {
                    $('input:checkbox[id="filter_'+arr3[i]+'"][value="'+arr3[i]+'"]').attr('checked', 'checked');
                }
                // if LCA or SET
                for(var i=0; i<=arr4.length-1; i++)
                {
                    $('input:checkbox[id="filter_'+arr4[i]+'"][value="'+arr4[i]+'"]').attr('checked', 'checked');
                }
                loadleasingapplications()
            }
        })
    }

    function lstatus(type){
      $("#lstatus").val(type);
      loadleasingapplications();
    }

    function viewhistoryleasing(inquiryID){
      $("#viewhistoryleasing").modal("show");
      $("#inqidnglogsleasing").val(inquiryID);
      viewhistoryleasingdisplay();
  }

  function viewhistoryleasingdisplay(){
    var inqidnglogsleasing = $("#inqidnglogsleasing").val();
     $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'inqidnglogsleasing=' + inqidnglogsleasing + '&form=viewhistoryleasingdisplay',
        beforeSend : function() {
         $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
          $('#indexloadingscreen').removeClass('myspinner');
            $("#viewhistoryleasingdisplay").html(data);
        }
      })
  }
</script>
<style>
tbody tr td { cursor: hand !important; cursor: pointer !important; }
a { cursor: hand !important; cursor: pointer !important; }
</style>
<div class="page-header" style="padding-bottom: 0px;">
<input type="hidden" id="txtapplicationpagesss" name="">
  <div class="row form-group" style="margin-bottom: 0px;padding-top:10px;background-color: #edf4f8;padding-bottom: 10px;">
        <div class="col-md-3 col-xs-12">
            <h1 style="font-weight: bold;">LEASING APPLICATION</h1>
            <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;List of Leasing Applications</h6>
            <input type="hidden" id="txtinquirypages" name="">
        </div>
        <div class="col-md-1 col-xs-12" style="margin-left: 0px;">
        </div>
        <div class="col-md-8 col-xs-12 divstat" style="padding-bottom: 10px;padding-top: 10px;">
            <label>All Status:</span>&nbsp;
            <label class='label label-sm label-pink'>Pending Application</label>
            <label class='label label-sm label-sm label-success'>For Approval</label>
            <label class='label label-sm label-info'>Approved Application</label>
            <label class='label label-sm label-danger'>Disapproved Application</label>
            <label class='label label-sm label-yellow'>Reserved</label>
            <label class='label label-sm label-warning'>Occupied</label>
            <label class='label label-sm label-danger'>Cancelled Reservation</label>
        </div>
                   
    </div>
	<h1></h1>
	
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<div class="row form-group" style="margin-bottom: 0px;">
			<div class="col-md-2 col-xs-12" style="padding-left: 0px;padding-bottom: 5px;">
				<span class="input-icon" style="width: 100%;">
            <input type="text" class="form-control" title="Search according to selected filter" placeholder="Search" id="txtsearchapplication" onkeyup="$('#txtapplicationpagesss').val('1');loadleasingapplications()">
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
      </div>
      <div class="col-md-2" style="padding-bottom: 5px;padding-left:0px;">
          <h5><a onclick="loadfilters_inquiry('Application')" id="LINK_inquiry_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='
          <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
            <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Select by&nbsp;&nbsp;</legend>
              <div class="form-group row" style="margin:0px;">
                <div class="col-md-4">
                  <label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 inquiry_module_filter" type="checkbox" value="Company_Name" id="filter_Company_Name">
                      <span class="lbl"> Company Name</span>
                  </label>
                </div>
                <div class="col-md-4">
                  <label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 inquiry_module_filter" type="checkbox" value="Trade_Name" id="filter_Trade_Name">
                      <span class="lbl"> Store Name</span>
                  </label>                            
                </div>
                <div class="col-md-4">
                  <label>
                      <input name="form-field-checkbox" class="ace ace-checkbox-2 inquiry_module_filter" type="checkbox" value="Industry" id="filter_Industry">
                      <span class="lbl"> Industry</span>
                  </label>                            
                </div>
              </div>
          </fieldset>
          <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
            <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Unit Type&nbsp;&nbsp;</legend>
              <div class="form-group row" style="margin:0px;">
                <div class="col-md-6">
                  <label style="margin-bottom: 0px;margin-top: 5px;margin-right: 30px;margin-left: 10px;margin-top: 0px;">
                    <input name="form-field-checkbox-unt" class="ace ace-checkbox-2 chk_inquiry_unittype" type="checkbox" value="SET" onclick="loadinquiries();loadinquiries();" id="filter_SET">
                    <span class="lbl"> Applied <b>SET</b> units</span>
                  </label>
                </div>
                <div class="col-md-6">
                  <label style="margin-bottom: 0px;margin-top: 0px;margin-right: 20px;">
                    <input name="form-field-checkbox-unt" class="ace ace-checkbox-2 chk_inquiry_unittype" type="checkbox" value="LCA" onclick="loadinquiries();loadinquiries();" id="filter_LCA">
                    <span class="lbl"> Applied <b>LCA</b> units</span>
                  </label>                            
                </div>
              </div>
          </fieldset>     
          <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
            <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Filter Status&nbsp;&nbsp;</legend>
              <div class="form-group row" style="margin:0px;">
                <div class="col-md-3" style="padding-right:0px;">
                  <label class="label label-pink" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                    <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Pending" id="filter_Pending">
                    <span class="lbl"> Pending</span>
                  </label>
                </div>
                <div class="col-md-3" style="padding-right:0px;">
                  <label class="label label-success" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                    <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="ForApproval" id="filter_ForApproval">
                    <span class="lbl"> For Approval</span>
                  </label>
                </div>
                <div class="col-md-3">
                  <label class="label label-info" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                    <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Approved" id="filter_Approved">
                    <span class="lbl"> Approved</span>
                  </label>
                </div>
                <div class="col-md-3" style="padding-left:0px;">
                  <label class="label label-danger" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                    <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Disapproved" id="filter_Disapproved">
                    <span class="lbl"> Disapproved</span>
                  </label>
                </div>                        
              </div>
              <div class="form-group row" style="margin:0px;">
                <div class="col-md-3">
                  <label class="label label-yellow" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                    <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Reserved" id="filter_Reserved">
                    <span class="lbl"> Reserved</span>
                  </label>
                </div>
                <div class="col-md-3">
                  <label class="label label-danger" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                    <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Cancelled" id="filter_Cancelled">
                    <span class="lbl"> Cancelled</span>
                  </label>
                </div>
                <div class="col-md-3">
                  <label class="label label-warning" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                    <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Occupied" id="filter_Occupied">
                    <span class="lbl"> Occupied</span>
                  </label>
                </div>
                <div class="col-md-3">
                  
                </div>                        
              </div>
          </fieldset>               
          <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
             <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:130px;">&nbsp;&nbsp;Application Date&nbsp;&nbsp;</legend>
               <div class="form-group row" style="margin:0px;">
                 <div class="col-md-1">
                 </div>
                 <div class="col-md-5">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="fa fa-calendar bigger-110"></i>
                     </span>
                     <input class="form-control div_app date-picker" type="text" name="" id="txtdiv_strtappp" data-provide="datepicker">
                   </div>                
                 </div>
                 <div class="col-md-5">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="fa fa-calendar bigger-110"></i>
                     </span>
                     <input class="form-control div_app date-picker" type="text" name="" id="txtdiv_endappp" data-provide="datepicker">
                   </div>                
                 </div>
                 <div class="col-md-1">
                 </div>
               </div>
          </fieldset>
          <div class="form-group row" style="padding-left:8px;margin-bottom:0px;">
            <div class="col-md-9" style="padding-right:0px;">
              <div class="alert alert-info" style="padding-top:10px;padding-bottom:10px;">
                <button class="close" data-dismiss="alert">
                  <i class="ace-icon fa fa-times"></i>
                </button>
                Click "<b>OK</b>" to filter data and permanently save the filter selected.
              </div>
            </div>
            <div class="col-md-3">
              <button class="btn btn-xs btn-info" onclick="savefilter()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                  OK
              </button>
            </div>
          </div>
            '><i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
      </div>
      <div class="col-md-4" style="padding-bottom: 5px;text-align: right;"></div>
      <div class="col-md-2" style="padding-bottom: 5px;text-align: right;padding-left:0px;"></div>
      <div class="col-md-2" style="padding:0px;padding-bottom: 5px;"></div>
		</div>
		<div class="row form-group" style="margin-bottom: 0px !important;">
			<div class="parent">
				<table id="simple-table" class="table table-bordered table-hover fixTable">
    			<thead>
    				<tr>
    					<td class="hide_mobile">Application ID</td>
              <td class="hide_mobile">Unit Type</td>
    					<td class="scroll">Store Name</td>
    					<td class="hide_mobile">Company</td>
    					<td class="hide_mobile">Industry</td>
    					<!-- <td class="hide_mobile scroll" style="width:30%;">Contact</td> -->
    					<td class="hide_mobile">Date Applied</td>
              <td class="hide_mobile">Requirement Status</td> 
    					<td class="hide_mobile">Application Status</td> 
    					<td>Option</td>
    				</tr>
    			</thead>
    			<tbody id="tblapplicationlist"></tbody>
			 </table>
      </div>
			<table class="tabledash_footer table" style="margin: 0px !important;">
  				<thead>
  				    <tr>
  				        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                  <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtleasingappentries"><br /></font>
                      <!-- <div class="pagination">
                          <ul id="ulleasingapppagination"></ul>
                      </div> -->
                      <ul id="ulleasingapppagination" class="pagination pull-right"></ul>
                  </th>
  				    </tr>
  				</thead>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="viewhistoryleasing" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" style="width: 1200px;">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Transaction Logs</h4>
        <input type="hidden" id="inqidnglogsleasing">
      </div>

       <!-- Modal body-->
       <div class="modal-body"  id="modal-body-group">
          <div class="parent2">
              <table class="table table-bordered table-striped fixTable">
                  <thead>
                      <tr>
                        <td width="20%">User Name</td>
                        <td width="20%">Date</td>
                        <td width="20%">Time</td>
                        <td width="10%">Module</td>
                        <td width="10%">Action</td>
                      </tr>
                  </thead>
                  <tbody id="viewhistoryleasingdisplay"></tbody>
              </table>
          </div>

        <table class="tabledash_footer table" style="margin: 0px !important;">
          <thead>
              <tr>
                  <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                      <div class="row">
                          <div class="col-md-6">
                              <label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtcomplaintsentriespertenant"></label>
                          </div>                               
                          <div class="col-md-6">
                              <input type="hidden" id="txt_userpagepertenant" class="form-control input-sm" style="width: 5%; text-align: center;">
                              <ul id="ulpaginationcomplaintpertenant" class="pagination pull-right"></ul>
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

<?php
	include("leasingapplication_modal.php");
  include("modal_view_requirements.php");
	include("modal_update_inquiry.php");
  include("modal_view_image.php");
  include("modal_load_tenants.php");
  include("modal_new_tenant.php");
  include("modal_load_companies.php");
  include("modal_new_company.php");
  include("modal_new_address.php");
  include("modal_new_referential.php");
	include("print_application.php");
  include("modal_update_contact_person.php");
  include("modal_new_remarks.php");  
  include("../inquiry/modal_shortcut_unit.php");
  include("../inquiry/kevinMscript.php");
?>
<script>
  $.mask.definitions['~']='[+-]';
    $('.input-mask-date').mask('99/99/9999');
    $('.input-mask-month').mask('99/99/9999');
    $('.input-mask-phone').mask('(999) 999-9999');
    $('.input-mask-tele').mask('(99)-999-9999');
    $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
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