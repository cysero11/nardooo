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

textarea:focus, input:focus{

outline: 0;

}



</style>

<script>

$(function(){
  // showitemlist2();
  //showitemlist();
  showprintbyme2();
  generatevisitid();

  $( "#datec_start" ).datepicker( "option", "dateFormat", "dd/mm/yy" );

  $("#txt_userpage").val("1");

});

function generatevisitid()
{
//  alert();
  $.ajax({
    url:'itemsclaim/class/jonardclass.php',
    method:"POST",
    data:'form=generatevisitid',
    success:function(data){
      //alert(data);
      $("#transac").val(data);
      
    }
  });
}


function deposititem(){

  generatevisitid();

  $("#deposhit").modal("show");
  display_ct();
}

function loadcardid(){

  $.ajax({
    type: 'POST',
    url: 'itemsclaim/class/jonardclass.php',
    data: 'form=loadcardid',
    success:function(data){
      // alert(data);
      $("#cardid").val(data);
      display_ct();
    }
  });
}

function saveitem(){

  var transac = $("#transac").val();
  var ownernames = $("#namess").val();
  var itemsdesc = $("#itemdescriptionhehe").val();
  var cardid = $("#cardid").val();
  var notesj = $("#notes").val();
  var importantj = $("#important").val();
  var quantityj = $("#quantity").val();
  var datej = $("#item_date").val();
  var timesj = $("#item_time").val();

  if(ownernames == '' || itemsdesc == '' || notesj == '' || importantj == '' || quantityj == '' || cardid == ''){
    $("#requiredfields").modal("show");


  }
  else{
    $.ajax({
    type: 'POST',
    url: 'itemsclaim/class/jonardclass.php',
    data: 'cardid=' + cardid + 
    '&itemdesc=' + itemsdesc +
    '&ownername=' + ownernames +
    '&notess=' + notesj +
    '&importants=' + importantj +
    '&quantityy=' + quantityj +
    '&datess=' + datej +
    '&timess=' + timesj + 
    '&transac=' + transac + 
    '&form=insertdata',
    success:function(data){
      if(data == "")
      {
        $("#invalidcard").modal("show");
        $("#deposhit").modal("show");
        document.getElementById('cardid').value = '';
      }
      else
      {
        $("#successdeposit").modal("show");
        $("#deposhit").modal("hide");

        showitemlist();

        $("#namess").val("");
        $("#itemdescriptionhehe").val("");
        $("#cardid").val("");
        $("#notes").val("");
        $("#important").val("");
        $("#quantity").val("");

        generatevisitid();
      }
    }
  });
  }
}


function showitemlist(){
var search = $("#searchehe").val();
var page = $("#txt_userpage").val();


  $.ajax({
    type: 'POST',
    url: 'itemsclaim/class/jonardclass.php',
    data: 'searchehe='+ search +
    '&page=' + page +
    '&form=listofitems',
    success:function(data){
      // alert(data);
      $("#depositlist").html(data);
      loadpaginationdeposit();
      loadentrieshehe();
    }
  });
}

// function showitemlist2()
// {
//   $.ajax({
//     type: 'POST',
//     url: 'itemsclaim/class/jonardclass.php',
//     data: 'form=gettable',
//     success:function(data){
//       $("#depositlist").html(data);
//     }
//   });
// }

function search1(){

  var searchj = $("#searchehe").val();
  var claimdaterts = $("#selectdate").val();
  $.ajax({
    type: 'POST',
    url: 'itemsclaim/class/jonardclass.php',
    data: 'search=' + searchj +
    '&wawww=' + claimdaterts +
    '&form=searchbox',
    success:function(data){
      // alert(data);
      $("#depositlist").html(data);

    }
  });
}

function search2(){
  search1();
}

function display_ct(){

  var strcount
  var x = new Date();
  time = x.toLocaleString('en-US', { hour: 'numeric',minute:'numeric', hour12: true });
  document.getElementById('item_time').value = time;

  tt=display_c();
}

function display_ct2(){

  var strcount
  var x = new Date();
  time = x.toLocaleString('en-US', { hour: 'numeric',minute:'numeric', hour12: true });
  document.getElementById('claimtimej').value = time;

  tt=display_c();
}

function updatehehe(id){
 $("#claimmodal").modal("show");
  $("#cardidj").val(id);
  display_ct2();

  
}


function updatehihi(){
var cardidj =  $("#cardidj").val();
var claimdatej = $("#claimdatej").val();
var claimtimej = $("#claimtimej").val();

  $.ajax({
    type: 'POST',
    url: 'itemsclaim/class/jonardclass.php',
    data: 'cardidj=' + cardidj +
    '&claimdatej=' + claimdatej + 
    '&claimtimej=' + claimtimej + 
    '&form=updateclaim',
    success:function(data){
   
      showitemlist();
      $("#claimmodal").modal("hide");
          $("#successclaimedmodal").modal("show");

    }
  });
}

function enternumber(){

  var e = document.getElementById('quantity');

    if (!/^[0-9]+$/.test(e.value)) 
  { 
  alert("Please Enter Number Only");
  e.value = e.value.substring(0,e.value.length-1);
  }
    
}

function printkomamamo2(){

    var dateFrom = $("#dateFrom").val();
    var dateTo = $("#dateTo").val();
    var itemstatus = $("#printbymec").val();
    var mallid = $("#printbymec2").val();
    if(itemstatus != ""){
        $.ajax({
        type: 'POST',
        url: 'itemsclaim/class/jonardclass.php',
        data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&itemstatus=' + itemstatus + '&form=printkomamamo',
        success:function(data){
              var arr = data.split("|");
              $("#dateFrom2").text(arr[1]);
              $("#dateTo2").text(arr[2]);
              $("#contentngmamamo").html(data);
    if(mallid != ""){
          $.ajax({
            type: 'POST',
            url: 'itemsclaim/class/jonardclass.php',
             data: 'mallid='+ mallid +'&form=printkomamammo2',
             success:function(data){
              $("#template3").html(data);

                            var toPrint = document.getElementById("div_form_printngmamamo");
                            var myheight = $(window).height()-40;
                            var mywidth = $(window).width()-40;
                            var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
                            popupWin.document.open();
                            popupWin.document.write('<html><link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" /><link href="assets/css/style2.css" rel="stylesheet" type="text/css"><header style="font-size: 16px; font-weight: 700;"></header><br><body onload="window.print();">' );

                            popupWin.document.write( toPrint.innerHTML);
                            popupWin.document.write('</body></html>');
                            popupWin.document.close();

          
             }

          });
          }

            }
        });
    }
    else
    {
        showmodal("alert", "Please Select a Filter", "", null, "", null, "0");
    }
    
}

function showprintbyme(){
    $.ajax({
        type: 'POST',
        url: 'itemsclaim/class/jonardclass.php',
        data: 'form=printfilter',
        success:function(data){
          // alert(data);
            $("#printbymec").html(data);
            showprintbyme2();
        }
    })
}

function showprintbyme2(){
    $.ajax({
        type: 'POST',
        url: 'itemsclaim/class/jonardclass.php',
        data: 'form=malloption',
        success:function(data){
           // alert(data);
            $("#printbymec2").html(data);
        }
    })
}


/////////////////////////// Jerms Filter Function ///////////////////////////////////////

// function searchitem(search){
  
//     var dateFrom = $("#datep_start").val();
//     var dateTo = $("#datep_end_").val();
//     var claimdateFrom = $("datec_start").val();
//     var claimdateTo = $("datec_end").val();

//     var page = $("#txt_userpagepdc").val();
//     // var searchehe = $("#searchehe").val();

//     // 
   
//     $.ajax({
//         type: 'POST',
//         url: 'itemsclaim/jonardclass.php',
//         data: 'depoappstart=' + dateFrom +
//         '&depoappend=' + dateTo +
//         '&claimappstart=' + claimdateFrom +
//         '&claimappend=' + claimdateTo +
//         '&page=' + page +
//         '&searchehe=' + searchehe +
//         '&form=listofitems'  ,
//         success:function(data){
//           alert(data);
//             if(searchehe === ""){
//                 $("#depositlist").html();
//             }
//             else{
//                  $("#depositlist").html(data);
//             }
//         $('#indexloadingscreen').removeClass('myspinner');
       
//        // alert(data);
//         depositlist();
//          }
//          });
   
// }


function checkfirstdate()
  {
    var eto = $("#datecheck1");
    if(eto.is(":checked"))
    {
      $("#datecheck2").prop("checked", false);
      $("#div_claimed").css("background-color", "#f5f5f0");
      $("#div_deposited").css("background-color", "white");
      $(".div_depo").prop("disabled", false);
      $(".div_claim").prop("disabled", true);
    }
    else
    {
      $("#datecheck1").prop("checked", true);
    }
  }

function checksecdate()
{
    var eto = $("#datecheck2");
    if(eto.is(":checked"))
    {
      $("#datecheck1").prop("checked", false);
      $("#div_deposited").css("background-color", "#f5f5f0");
      $("#div_claimed").css("background-color", "white");
      $(".div_claim").prop("disabled", false);
      $(".div_depo").prop("disabled", true);
    }
    else
    {
      $("#datecheck2").prop("checked", true);
    }
}


function loadpaginationdeposit()
{
  var page = $("#txt_userpage").val();
  var search = $("#searchehe").val();
       

  $.ajax({
  type: 'POST',
  url: 'itemsclaim/class/jonardclass.php',
  data: 'page='+page+
  '&searchehe=' + search +
  '&form=loadpaginationdeposit',
  success: function(data)
  {
    // alert(data);
    $("#ulpaginationitemlist").html(data);
  }
  });
}

function loadentrieshehe()
{
  var page = $("#txt_userpage").val();
  var search = $("#searchehe").val();

  $.ajax({
    type: 'POST',
    url: 'itemsclaim/class/jonardclass.php',
    data: 'page='+page+
    '&searchehe=' + search +
    '&form=loadentries',
    success: function(data)
    {
      if(data == ""){
      $("#txtitemlistentries").text("");
      }
      else{
      $("#txtitemlistentries").text(data);
      }
      // alert(data);
        // $("#txtitemlistentries").html(data);
    }
  });
}

function getvaluser(page, pagenums)
{
  $(".pgnumptnts").removeClass("active");
  var value = "#" + pagenums;
  $("#pgptnts" + pagenums).addClass("active");
  $("#txt_userpage").val(page);
  // reloadhmo();
  showitemlist();
  loadpaginationdeposit();
  loadentrieshehe();
}





















setTimeout(function(){
  $(".fixTable").tableHeadFixer();
}, 1000)
// $(function(){
//   $('#txt_userpage').val("1");
//   $("#txtsearchapplication").focus();
// 	$("#txtapplicationpagesss").val("1");
//   $("#txt_userpage_tenants").val("1");
// 	loadleasingapplications();
//   $("#div_modal_inquiry_requirements").niceScroll({cursorcolor:"#999"});  
// 	$(".scroll").niceScroll({cursorcolor:"#999"});
// 	$("#tblapplicationlist").niceScroll({cursorcolor:"#999"});
// 	numonly();
//   $("#statinquiryyy").val("valid");

// 	 var sys = $("#txt_syssetup").val();
//     if(sys == "0")
//     {
//       $("#div_merchandiseinfo").css("display", "block");
//       $("#txtapp_merchandise_dep").removeClass("app_req");
//       $("#txtapp_merchandise_class").removeClass("app_req");
//       $("#txtapp_merchandise_cat").removeClass("app_req");
//       $("#txtapp_merchandise_dep").addClass("app_req");
//       $("#txtapp_merchandise_class").addClass("app_req");
//       $("#txtapp_merchandise_cat").addClass("app_req");
//     }
//     else
//     {
//       $("#div_merchandiseinfo").css("display", "none");
//       $("#txtapp_merchandise_dep").removeClass("app_req");
//       $("#txtapp_merchandise_class").removeClass("app_req");
//       $("#txtapp_merchandise_cat").removeClass("app_req");
//     }
//   $('#radio_set').prop('checked', true); 
// });

// function clicklca()
// {     
//       $("#txtlabel_payment").text("Daily Payment");
//       $("#txtnoofmonths_inq").attr("onkeyup", "reqmonORday();loaddatetofunction();");
//       $("#txtinq_unitclass").val("");
//       $("#div_wing").css("display","block");
//       $("#div_floor").css("display","block");
//       $("#div_unit").css("display","block");
//       $("#txtinq_unitcategory").attr("onchange", "loadinquiry_unit_lca()");
//       $("#txtinq_unitwing").val("");
//       $("#txtinq_unitfloor").val("");
//       $("#txtinq_unitunit").val("");
//       $("#div_nomonths").css("display", "block");
//       $("#div_nodays").css("display", "block");
//       $("#txtinq_sqm").prop("disabled", false);
//       $("#txtinq_persqm").prop("disabled", false);
//       $("#txtinq_totalsqm").prop("disabled", false);
//       loadinquiry_unit_lca();
//       loadinquiry_wing_lca();
//       paymentterms_LCA();
//       $("#txtinq_unitcategory").attr("onclick", "loadinquiry_wing_lca()");
//       $("#txtinq_unitdepartment").val("");
//       $("#txtinq_unitcategory").val("");
//       $("#txtinq_unitwing").val("");
//       $("#txtinq_unitfloor").val("");
//       $("#txtinq_unitunit").val("");
//       $("#txtnoofmonths_inq").val("");
//       $("#txtnoofdays_inq").val("");   
//       $("#div_advance_set").css("display", "none");
//       $("#div_deposit_set").css("display", "none");   
//       $("#div_advance_set_amt").css("display", "block");
//       $("#div_deposit_set_amt").css("display", "block");
//       $("#txtinq_advancepayment").val("");
//       $("#txtinq_depositpayment").val("");
//       $("#tbodypdc_inquiry").html("");
//       $("#txtinq_monthlyrate2").val("");
//       $("#txtinq_sqm").val("");
//       $("#txtinq_persqm").val("");
//       $("#txtinq_totalsqm").val("");
//       $("#txtinq_assocdues").val("");
//       $("#txtinq_totalmonthlydues").val("");
//       $("#txtmonthlymath").val("");
//       $("#div_amenities_inquiry").html("");
//       $("#lbltotalamountofpayment").text("Php 0.00");
//       $("#totalpayment").text("Php 0.00");
//       $("#txtinq_monthlyadvamt").val("");
//       $("#txtinq_monthlyadvamt").val("");
//       $("#txtinq_monthlydepamt").val("");
//       $("#txtinq_advancepayment").val("");
//       $("#txtinq_depositpayment").val("");
//       $("#div_unit_area_set").css("display", "none");
//       $("#div_unit_area_lca").css("display", "block");
//       $("#div_unit_set").css("display", "none");
//       $("#div_unit_lca").css("display", "block");
//       $("#txtinq_dateto").prop("disabled", false);
//       $("#txtnoofdays_inq").val("0");
//       $("#txtnoofmonths_inq").val("0");
//       $("#txtinq_lca_unitname").prop("disabled", false);  
//       $("#txtinq_sqm_width").prop("disabled", false);
//       $("#txtinq_sqm_length").prop("disabled", false);
//       $("#div_advance_set").css("display", "none");
//       $("#div_deposit_set").css("display", "none");
//       $("#div_advance_set_amt").css("display", "block");
//       $("#div_deposit_set_amt").css("display", "block");

//       $("#txtinq_datefrom").prop("disabled", true);
//       $("#txtnoofmonths_inq").prop("disabled", true);
//       $("#txtinq_monthlyadvamt").prop("disabled", true);
//       $("#txtinq_advancepayment").prop("disabled", true);
//       $("#txtinq_monthlydepamt").prop("disabled", true);
//       $("#txtinq_depositpayment").prop("disabled", true);
//       $("#txtinq_monthlyrate2").prop("disabled", true);

//       $("#txtinq_dateto").prop("disabled", true);
//       $("#txtnoofdays_inq").prop("disabled", true);
//       $("#txtinq_advancepayment2").prop("disabled", true);
//       $("#txtinq_depositpayment2").prop("disabled", true);
//       $("#txtinq_sqm_width").prop("disabled", true);
//       $("#txtinq_sqm_length").prop("disabled", true);
//       $("#txtinq_persqm").prop("disabled", true);
//       $("#txtinq_totalsqm").prop("disabled", true);
//       $("#txtinq_sqm").prop("disabled", true);
//       $("#txtinq_unitdepartment").prop("disabled", true);
//       $("#txtinq_unitcategory").prop("disabled", true);
//       $("#txtinq_unitwing").prop("disabled", true);
//       $("#txtinq_unitfloor").prop("disabled", true);
//       $("#txtinq_unitunit").prop("disabled", true); 
//       $("#txtinq_lca_unitname").prop("disabled", true); 
// }

// function clickset()
// {
//       $("#txtlabel_payment").text("Monthly Payment");
//       $("#txtnoofmonths_inq").attr("onkeyup", "loaddatetofunction();");
//       $("#txtinq_unitclass").val("");
//       $("#div_wing").css("display","block");
//       $("#div_floor").css("display","block");
//       $("#div_unit").css("display","block");
//       $("#txtinq_unitcategory").attr("onchange", "loadinquiry_wing()");
//       $("#txtinq_unitwing").val("");
//       $("#txtinq_unitfloor").val("");
//       $("#txtinq_unitunit").val("");
//       $("#div_nomonths").css("display", "block");
//       $("#div_nodays").css("display", "none");
//       $("#txtinq_sqm").prop("disabled", true);
//       $("#txtinq_persqm").prop("disabled", true);
//       $("#txtinq_totalsqm").prop("disabled", true);
//       loadinquiry_wing_set();
//       loadinquiry_unit_lca();
//       paymentterms_SET();
//       $("#txtinq_unitcategory").attr("onclick", "loadinquiry_wing_set()");
//       $("#txtinq_unitdepartment").val("");
//       $("#txtinq_unitcategory").val("");
//       $("#txtinq_unitwing").val("");
//       $("#txtinq_unitfloor").val("");
//       $("#txtinq_unitunit").val("");
//       $("#txtnoofmonths_inq").val("");
//       $("#txtnoofdays_inq").val("");  
//       $("#txtinq_advancepayment").val("");
//       $("#txtinq_depositpayment").val("");
//       $("#tbodypdc_inquiry").html("");
//       $("#txtinq_monthlyrate2").val("");
//       $("#txtinq_sqm").val("");
//       $("#txtinq_persqm").val("");
//       $("#txtinq_totalsqm").val("");
//       $("#div_amenities_inquiry").html("");
//       $("#lbltotalamountofpayment").text("Php 0.00");
//       $("#totalpayment").text("Php 0.00");
//       $("#txtinq_monthlyadvamt").val("");
//       $("#txtinq_monthlyadvamt").val("");
//       $("#txtinq_monthlydepamt").val("");
//       $("#txtinq_advancepayment").val("");
//       $("#txtinq_depositpayment").val("");
//       $("#div_unit_area_set").css("display", "block");
//       $("#div_unit_area_lca").css("display", "none");
//       $("#div_unit_set").css("display", "block");
//       $("#div_unit_lca").css("display", "none");
//       $("#txtinq_dateto").prop("disabled", true);
//       $("#txtnoofdays_inq").val("");
//       $("#txtnoofmonths_inq").val("0");
//       $("#txtinq_monthlyadvamt").val("0");
//       $("#txtinq_monthlydepamt").val("0");
//       $("#txtinq_sqm_width").val("0");
//       $("#txtinq_sqm_length").val("0"); 
//       $("#div_advance_set").css("display", "block");
//       $("#div_deposit_set").css("display", "block");
//       $("#div_advance_set_amt").css("display", "none");
//       $("#div_deposit_set_amt").css("display", "none");

//       $("#txtinq_datefrom").prop("disabled", true);
//       $("#txtnoofmonths_inq").prop("disabled", true);
//       $("#txtinq_monthlyadvamt").prop("disabled", true);
//       $("#txtinq_advancepayment").prop("disabled", true);
//       $("#txtinq_monthlydepamt").prop("disabled", true);
//       $("#txtinq_depositpayment").prop("disabled", true);
//       $("#txtinq_monthlyrate2").prop("disabled", true);

//       $("#txtinq_dateto").prop("disabled", true);
//       $("#txtnoofdays_inq").prop("disabled", true);
//       $("#txtinq_advancepayment2").prop("disabled", true);
//       $("#txtinq_depositpayment2").prop("disabled", true);
//       $("#txtinq_sqm_width").prop("disabled", true);
//       $("#txtinq_sqm_length").prop("disabled", true);
//       $("#txtinq_persqm").prop("disabled", true);
//       $("#txtinq_totalsqm").prop("disabled", true);
//       $("#txtinq_sqm").prop("disabled", true);
//       $("#txtinq_unitdepartment").prop("disabled", true);
//       $("#txtinq_unitcategory").prop("disabled", true);
//       $("#txtinq_unitwing").prop("disabled", true);
//       $("#txtinq_unitfloor").prop("disabled", true);
//       $("#txtinq_unitunit").prop("disabled", true); 
//       $("#txtinq_lca_unitname").prop("disabled", true); 
// }

// function unitareachk()
// {
//   var wid = $("#txtinq_sqm_width").val();
//   var len = $("#txtinq_sqm_length").val();
//   var amount = $("#txtinq_persqm").val();
//   var ttl = (parseInt(wid || 0) * parseInt(len || 0)) * parseInt(amount || 0);
  
//   $("#txtinq_monthlyrate2").val((ttl).toFixed(2));
//   $("#txtinq_totalsqm").val((ttl).toFixed(2));  
//   loaddatetofunction();
// }

// function chkclippeddocx(thisfile)
// {
//   var sel = "";
//   $(".req_already_added_na").each(function(){
//     var added = $(this).attr("id");
//     sel += added + "|";
//   })
//   $(".form_lease_application_req_2").each(function(){
//     var form_id = $(this).attr("id");
//     var inputfile = $(this).find(".upload_app_req");
//     var empty = $(this).find("a[class='remove']");
//     var thisicon = $(this).find(".icon-status-req");
//     var files  = inputfile.prop("files");
    
//     var names = $.map(files, function(val) { return val.name; });
//     if(names != "")
//     {
//         $("#"+form_id+"_icon").removeClass("fa-remove");
//         $("#"+form_id+"_icon").addClass("fa-check");
//         $("#"+form_id+"_icon").css("color", "green");
//         sel += names + "|";
//     }
//     else
//     {

//     }
//   });

//     var files2  = thisfile.prop("files");    
//     var aso = $.map(files2, function(val) { return val.name; });
//     // alert(sel)
//     var arr = sel.split("|");
//     var i = 0;
//     var c = 0;
//     for(i=0; i<=arr.length-1; i++)
//     {
//       if(aso == arr[i])
//       {
//         c++;
//       }
//     }

//     if(c >= 2)
//     {
//       showmodal("alert", "Sorry, but you already attached the same file.", "", null, "", null, "1");
//       thisfile.click();
//     }

// }

// // function hehehe(){
// // var ha = $("#selectdate").val();
// //   alert(ha);
// // }

// function loadinquiry_unit_lca()
// {
//   var classification_id = $("#txtinq_unitclass").val();
//   if($("#radio_set").is(":checked"))
//   {
//     var type = "SET";
//   }
//   else if($("#radio_lca").is(":checked"))
//   {
//     var type = "LCA";
//   }
//   $.ajax({
//     type: 'POST',
//     url: 'mainclass.php',
//     data: 'classification_id=' + classification_id + '&type=' + type + '&form=loadinquiry_unit_lca',
//     success: function(data)
//     {
//       $("#txtinq_unitunit").html(data)
//     }
//   })
// }

// function loadinquiry_wing_set()
// {
//   var classification_id = $("#txtinq_unitclass").val();
//   $.ajax({
//     type: 'POST',
//     url: 'mainclass.php',
//     data: 'classification_id=' + classification_id + '&form=loadwingflr2',
//     success: function(data)
//     {
//       $("#txtinq_unitwing").html(data);
//       $("#txtinq_unitunit").val("");
//       $("#txtinq_unitfloor").val("");
//     }
//   })
// }

// function numonly()
// {
//    $(".numonly").keydown(function(event) {

//        // Allow only backspace and delete
//        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190) {
//            // let it happen, don't do anything
//        }
//        else {
//            // Ensure that it is a number and stop the keypress
//            if (event.keyCode < 48 || event.keyCode > 57 ) {
//                event.preventDefault(); 
//            }   
//        }
//    });

//    $(".amount").change(function(){
//         var v = parseFloat($(this).val());
//         $(this).val((isNaN(v)) ? '' : v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
//    });
// }

// function loadleasingapplications()
// {
// 	var key = $("#txtsearchapplication").val();
// 	var page = $("#txtapplicationpagesss").val();
// 	$.ajax({
// 		type: 'POST',
// 		url: 'mainclass.php',
// 		data: 'key=' + key + '&page=' + page + '&form=loadleasingapplications',
//     beforeSend : function() {
//      $('#indexloadingscreen').addClass('myspinner');
//     },
//     success: function(data){
//       $('#indexloadingscreen').removeClass('myspinner');
// 			$("#tblapplicationlist").html(data);
// 			$(".scroll").niceScroll({cursorcolor:"#999"});
// 			loadpaginationleasingapp();
//       loadleasingappentries();
// 		}
// 	})
// }

// function loadpaginationleasingapp()
// {
//   var key = $("#txtsearchapplication").val();
//   var page = $("#txtapplicationpagesss").val();
//         $.ajax({
//             type: 'POST',
//             url: 'mainclass.php',
//             data: 'key=' + key + '&page=' + page + '&form=loadpaginationleasingapp',
//             success: function(data){
//                 $("#ulleasingapppagination").html(data);
//             }
//         }).error(function() {
//             alert(data);
//         });
// }

// // function getvalinquiry(page, pagenums)
// // {
// //         // alert(page);
// //             $(".pgnumptnts").removeClass("active");
// //             var value = "#" + pagenums;
// //             $("#pgptnts" + pagenums).addClass("active");
// //             $("#txtapplicationpagess s").val(page);
// //             // reloadhmo();
// //             loadleasingapplications();
// //             loadpaginationleasingapp();
// //             loadleasingappentries();
// // }

// function loadleasingappentries()
// {
//   var key = $("#txtsearchapplication").val();
//   var page = $("#txtapplicationpagesss").val();
//         $.ajax({
//             type: 'POST',
//             url: 'mainclass.php',
//             data: 'key=' + key + '&page=' + page + '&form=loadleasingappentries',
//             success: function(data){
//                 if(data == 000)
//                 {
//                     $("#txtleasingappentries").html("<br />");
//                 }
//                 else
//                 {
//                     $("#txtleasingappentries").text(data);
//                 }
//             }
//         }).error(function() {
//             alert(data);
//         });
// }	

// function changestatleasingapp(Application_ID, Inquiry_ID, stat, unitid)
// {
//   var setunit = $("#txtinq_unitunit").val();
//   var lcaunit = $("#txtinq_lca_unitname").val();
//   var conttt = chkunitfrst2();
  
//   if(setunit != "" || lcaunit != "")
//   {
//     if(conttt == "valid")
//     {
//       showmodal("confirm", "Do you want to save changes on this application?", "changestatleasingapp2(\""+Application_ID+"\",\""+Inquiry_ID+"\", \""+stat+"\", \""+unitid+"\")", null, "", null, "1");
//     }
//     else
//     {
//       chkunitfrst();
//       $("#txtinq_unitunit").css("border-color", "red");
//       $("#txtnoofmonths_inq").css("border-color", "red");
//       $("#txtinq_datefrom").css("border-color", "red");
//       $("#unitinfo").click();
//     }
//   }
//   else
//   {
//   showmodal("confirm", "Do you want to save changes on this application?", "changestatleasingapp3(\""+Application_ID+"\",\""+Inquiry_ID+"\", \""+stat+"\", \""+unitid+"\")", null, "", null, "1");
//   }
// }

// function changestatleasingapp2(Application_ID, Inquiry_ID, stat, unitid){
//   $("#alertmodal").modal("hide");
//   var remarks = $("#txtinq_remarks").val();
//   $.ajax({
//     type: 'POST',
//     url: 'mainclass.php',
//     data: 'Application_ID=' + Application_ID + '&Inquiry_ID=' + Inquiry_ID + '&stat=' + stat + '&remarks=' + remarks + '&stat=' + stat + '&unitid='+ unitid + '&form=changestatleasingapp',
//     beforeSend : function() {
//       $('#leasingloadingscreen').addClass('myspinner');
//     },
//     success: function(data){
//       $('#leasingloadingscreen').removeClass('myspinner');
//       if(data == 1)
//       {
//         loadleasingapplications();    
//         $("#modal_previewleasingapplication").modal("hide");  
//       }
//       else if(data == 2)
//       {
//         loadleasingapplications();  
//         showmodal("alert", "Successfully Updated.", "", null, "", null, "0");
//       }
//     }
//   })
// }

// function changestatleasingapp3(Application_ID, Inquiry_ID, stat, unitid){
//   $("#alertmodal").modal("hide");
//   var remarks = $("#txtinq_remarks").val();
//   $.ajax({
//     type: 'POST',
//     url: 'mainclass.php',
//     data: 'Application_ID=' + Application_ID + '&Inquiry_ID=' + Inquiry_ID + '&stat=' + stat + '&remarks=' + remarks + '&stat=' + stat + '&unitid='+ unitid + '&form=changestatleasingapp',
//     beforeSend : function() {
//      $('#leasingloadingscreen').addClass('myspinner');
//     },
//     success: function(data){
//       $('#leasingloadingscreen').removeClass('myspinner');
//       if(data == 1)
//       {
//         loadleasingapplications();    
//         $("#modal_previewleasingapplication").modal("hide");  
//       }
//       else if(data == 2)
//       {
//         loadleasingapplications();  
//         showmodal("alert", "Successfully Updated.", "", null, "", null, "1");
//       }
//     }
//   })
// }


    function savefilter()
    {

        var module = "ItemsClaim";
        var checked = "";
        $('input:checkbox[name="form-field-checkboxselect"]').each(function(){
            if($(this).is(":checked"))
            {
                var value = $(this).attr("value");
                checked += value + "|";
            }
        })


        var checked2 = "";
        $('input:checkbox[name="form-field-checkboxselect"]').each(function(){

                var value2 = $(this).attr("value");
                checked2 += value2 + "|";
        })

        // var checked1 = "";
        // $('input:checkbox[name="form-field-checkboxselect"]').each(function(){

        //         var value2 = $(this).attr("value");
        //         checked2 += value2 + "|";
        // })

        var checked3 = "";
        $('input:checkbox[name="form-field-checkboxstat"]').each(function(){
          if($(this).is(":checked"))
          {
            var value3 = $(this).attr("value");
            checked3 += value3 + "|";
          }
        })

  

        
        var depoappstart = $("#depstart").val();
        var depoappend = $("#depend").val();

        var claimappstart = $("#datec_start").val();
        var claimappend = $("#datec_end").val();

    

     if($("#datecheck1").is(":checked")){ var datefilter = "datecheck1"; }
    if($("#datecheck2").is(":checked")){ var datefilter = "datecheck2"; }  

    //alert(depoappstart+"/"+depoappend+"/"+claimappstart+"/"+claimappend+"/"+datefilter);
        $.ajax({
            type: 'POST',
            url: 'itemsclaim/class/jonardclass.php',
            data: 'module=' + module +  
            '&checked=' + checked +  
            '&checked2=' + checked2 +  
            '&checked3=' + checked3 +
            '&depoappstart=' + depoappstart +  
            '&depoappend=' + depoappend + 
            '&claimappstart=' + claimappstart +
            '&claimappend=' + claimappend + 
            '&datefilter=' + datefilter +
            '&form=savefilter',

            beforeSend : function() {
             $('#indexloadingscreen').addClass('myspinner');
            },

            success: function(data){
              $("#filtersave").modal("show");
              $('#indexloadingscreen').removeClass('myspinner');
              loadfilters_inquiry(module)
              $("#LINK_inquiry_filter").click();
              showitemlist();
              
            }
        })
    }

setTimeout(function(){
  $(".fixTable").tableHeadFixer();
}, 1000)
  var date = new Date();
           date.setDate(date.getDate() - 0);
          $('.kev-date-picker').datepicker({
           autoclose: true,
           todayHighlight: true,
           format: 'mm/dd/yyyy',
            startDate: date
  });
  $(function(){
    loadfilters_inquiry('ItemsClaim')
    $("#txt_userpage").val("1");
    // $("#tbodypdc_inquiry").niceScroll({cursorcolor:"#999"});
  //   $("#tblcompanylist").niceScroll({cursorcolor:"#999"});
    // $("#tblinquirylist").niceScroll({cursorcolor:"#999"});
  //   $("#div_other_contacts").niceScroll({cursorcolor:"#999"});
  //   $("#tblcompanylist").niceScroll({cursorcolor:"#999"});
  //   $("#tbltradenamelist").niceScroll({cursorcolor:"#999"});
    // $("#modal-body-application").niceScroll({cursorcolor:"#999"});
  });

    function loadfilters_inquiry(module)
    {
        $.ajax({
            type: 'POST',
            url: 'itemsclaim/class/jonardclass.php',
            data: 'module=' + module + '&form=loadfilters_inquiry',
            success: function(data)
            {
                 //alert(data);

                 //arr[0] checked arr[1] other [2] bystat [3] xcheck
                var datas = data.split("#");
                var arr = datas[0].split("|");
                var arr2 = datas[1].split("|");
                var arr3 = datas[2].split("|");
                var arr4 = datas[3];
           
                // // filter by


                for(var i=0; i<=arr.length-1; i++) //checked value
                {
                    $('input:checkbox[id="filter_'+arr[i]+'"][value="'+arr[i]+'"]').attr('checked', 'checked');
                }

                // Status filter
                for(var i=0; i<=arr3.length; i++)
                {
                    $('input:checkbox[id="filter_'+arr3[i]+'"][value="'+arr3[i]+'"]').attr('checked', 'checked');
                }
                // date deposit
              
                // date claim
                $("#datec_start").val(arr2[0]);
                $("#datec_end").val(arr2[1]);
                $("#depstart").val(arr2[2]);
                $("#depend").val(arr2[3]);
             

            //date check thing
            if(arr4 === 'datecheck1'){ //xcheck
                $("#datecheck2").prop("checked", false);
      $("#div_claimed").css("background-color", "#f5f5f0");
      $("#div_deposited").css("background-color", "white");
      $(".div_depo").prop("disabled", false);
      $(".div_claim").prop("disabled", true);
      $("#datecheck1").prop("checked", true);
            }    
            // else if(arr3[1] === 'datecheck2'){
            //     $("#datecheck2").prop("checked", true);
            //     $("#datecheck1").prop("checked", false);
               
            // }
            else{
                $("#datecheck1").prop("checked", false);
      $("#div_deposited").css("background-color", "#f5f5f0");
      $("#div_claimed").css("background-color", "white");
      $(".div_claim").prop("disabled", false);
      $(".div_depo").prop("disabled", true);
      $("#datecheck2").prop("checked", true);
                // depositlist()

              }
    
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
  var date = new Date();
           date.setDate(date.getDate() - 0);
          $('.kev-date-picker').datepicker({
           autoclose: true,
           todayHighlight: true,
           format: 'yyyy-mm-dd',
            // startDate: date
  });
</script>
<style>
tbody tr td { cursor: hand !important; cursor: pointer !important; }
a { cursor: hand !important; cursor: pointer !important; }
</style>


<div class="page-header" style="padding-bottom: 0px;">
<input type="hidden" id="txtapplicationpagesss" name="">
  <div class="row form-group" style="margin-bottom: 0px;padding-top:10px;background-color: #edf4f8;padding-bottom: 10px;">
        <div class="col-md-3 col-xs-12">
            <h1 style="font-weight: bold;">Items Claiming Area</h1>
            <!-- <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;List of Leasing Applications</h6> -->
            <input type="hidden" name="aa" id="aa">
            <input type="hidden" id="txtinquirypages" name="">
        </div>
       <div class="row form-group pull-right" style="margin-right: 175px;">
            <div class="col-xs-12 divstat" style="padding-right: 0px;">
              <span style="font-size: 15px;">All Status:</span>&nbsp;
              <label class='label label-sm label-success' style="font-size: 12px; background-color: green;">Claimed</label>
              <label class='label label-sm label-warning' style="font-size: 12px;">Deposited</label>
            </div>
          </div>
        <div class="col-md-1 col-xs-12" style="margin-left: 0px;">
        </div>
	<h1></h1>
	
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<div class="row form-group" style="margin-bottom: 0px;">
			<div class="col-md-2 col-xs-12" style="padding-left: 0px;padding-bottom: 5px;">
				<span class="input-icon" style="width: 100%;">
            <input type="text" class="form-control" placeholder="Search" id="searchehe" onkeyup="showitemlist();">
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
      </div>
      <!-- <div class="col-md-2">
        <div class="input-group">
          <input type="text" class="form-control kev-date-picker" id="selectdate" name="selectdate">
          <label class="input-group-addon">
            <span class="fa fa-calendar bigger-110">
            </span>
          </label> -->


      <div class="col-md-4" style="padding-bottom: 5px;padding-left:0px;">
            <h5><a onclick="loadfilters_inquiry('ItemsClaim')" id="LINK_inquiry_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='
                  <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Select by&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-3">
                          <label>
                             <input name="form-field-checkboxselect" class="ace ace-checkbox-2 itemsfilter" type="checkbox" value="card_id" id="filter_card_id">
                             <span class="lbl"> Card #</span>
                          </label> 
                        </div>
                        <div class="col-md-3">
                          <label>
                              <input name="form-field-checkboxselect" class="ace ace-checkbox-2 itemsfilter" type="checkbox" value="item_description" id="filter_item_description">
                              <span class="lbl"> Item</span>
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label>
                              <input name="form-field-checkboxselect" class="ace ace-checkbox-2 itemsfilter" type="checkbox" value="owner_name" id="filter_owner_name">
                              <span class="lbl"> Owner Name</span>
                          </label>
                        </div>
                        <div class="col-md-3">
                        </div>
                      </div>
                  </fieldset>

                  <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Status&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-4">
                          <label>
                             <input name="form-field-checkboxstat" class="ace ace-checkbox-2 d" type="checkbox" value="Deposited" id="filter_Deposited">
                             <span class="lbl"> Deposited</span>
                          </label> 
                        </div>
                        <div class="col-md-4">
                          <label>
                              <input name="form-field-checkboxstat" class="ace ace-checkbox-2 d" type="checkbox" value="Claimed" id="filter_Claimed">
                              <span class="lbl"> Claimed</span>
                          </label>
                        </div>
                       
                        <div class="col-md-3">
                        </div>
                      </div>
                  </fieldset>
                  


                  <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_deposited">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:120px;">&nbsp;Date Deposited</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="form-group row" style="margin:0px;">
                    <div class="form-group row" style="margin:0px;">
                        <div class="col-md-2">
                            <label style="margin-top:5px;">
                                <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox" value="" id="datecheck1"  onclick="checkfirstdate();">
                                <span class="lbl"> Date</span>
                            </label>
                        </div>
                        <div class="col-md-5">

                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                              </span>
                              <input class="form-control div_depo date-picker" type="text" name="" id="depstart" data-provide="datepicker" value = "<?php echo date('Y-m-d'); ?>">
                            </div>                              
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                              </span>
                              <input class="form-control div_depo date-picker" type="text" name="" id="depend" data-provide="datepicker" value = "<?php echo date('Y-m-d'); ?>">
                            </div>                              
                        </div>
                    </div>
                        <div class="col-md-1">
                        </div>
                      </div>
                    </fieldset>

                     <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_claimed">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:100px;">&nbsp;&nbsp;Date Claimed</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="form-group row" style="margin:0px;">
                    <div class="form-group row" style="margin:0px;">
                        <div class="col-md-2">
                            <label style="margin-top:5px;">
                                <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox" value="" id="datecheck2"  onclick="checksecdate();">
                                <span class="lbl"> Date</span>
                            </label>
                        </div>

                        <div class="col-md-5">

                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                              </span>
                              <input class="form-control div_claim date-picker" type="text" name="" id="datec_start" data-provide="datepicker" value = "<?php echo date('Y-m-d'); ?>">
                            </div>                              
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                              </span>
                              <input class="form-control div_claim date-picker" type="text" name="" id="datec_end" data-provide="datepicker" value = "<?php echo date('Y-m-d'); ?>">
                            </div>                              
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
                    </div>'><i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
            </div>

      <!-- <div class="col-md-3 col-md-12"> -->
        <div class="right">
          <h5><a onclick="showprintbyme();" id="ehehe" class="popover-info" data-rel="popover" data-placement="bottom" style="float: right; margin-right: 15px; font-size: 15px;" title="Print by" data-content='
                                            <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                                                <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:205px;">&nbsp;&nbsp;Filter by Claimed/Deposited&nbsp;&nbsp;</legend>
                                                    <div class="form-group row" style="margin:0px;">
                                                        <select class="form-control malloption" id="printbymec"></select>
                                                    </div>
                                                    <br>
                                                <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:205px;">&nbsp;&nbsp;Filter by Mall&nbsp;&nbsp;</legend>
                                                    <div class="form-group row" style="margin:0px;">
                                                        <select class="form-control malloption" id="printbymec2"></select>
                                                    </div>
                                            </fieldset>

                                          <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
                                              <div class="form-group row" style="margin:0px;">
                                                
                                                <div class="col-md-6">
                                                  <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control date-picker" type="text" id="dateFrom" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
                                                  </div>                
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="input-group">
                                                    <span class="input-group-addon">
                                                      <i class="fa fa-calendar bigger-110"></i>
                                                    </span>
                                                    <input class="form-control date-picker" type="text" id="dateTo" data-provide="datepicker" value="<?php echo date('m/d/Y'); ?>">
                                                  </div>                
                                                </div>
                                               
                                              </div>
                                            </fieldset>

                                            <div class="form-group row" style="padding-left:8px;margin-bottom:0px;">
                                                <div class="col-md-9" style="padding-right:0px;">
                                                    <div class="alert alert-info" style="padding-top:10px;padding-bottom:10px;">
                                                        <button class="close" data-dismiss="alert">
                                                            <i class="ace-icon fa fa-times"></i>
                                                        </button>
                                                  Select the range of date you want to print.
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-xs btn-success" onclick="printkomamamo2()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
                                                    Print
                                                </button>
                                            </div>'>
                                        <i class="glyphicon glyphicon-print bigger-110"></i>&nbsp;&nbsp;Print</a></h5>

        </div>

      <div class="pull-right" style="float: right; margin-top: -10px; margin-right: 15px;">
        <button type="button" class="btn btn-primary" onclick="deposititem();" style="font-size: 13px;">&nbsp; DEPOSIT ITEM</button>
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
    					<td class="hide_mobile">Card ID</td>
              <td class="hide_mobile"> Owner's Name </td> 
              <td class="hide_mobile">Item </td>
              <td class="hide_mobile"> Notes </td>
              <td class="hide_mobile"> Quantity </td>
              <td class="hide_mobile"> Date In </td>
              <td class="hide_mobile"> Time In </td>
              <td class="hide_mobile"> Date Out </td>
              <td class="hide_mobile"> Time Out </td>
              <td class="hide_mobile"> Status </td>
    					<td>Option</td>
    				</tr>
    			</thead>
    			<tbody id="depositlist"></tbody>
			 </table>
      </div>
			<table class="tabledash_footer table" style="margin: 0px !important;">
        <input type="text" id = "aa" hidden>
                <thead>
                    <tr>
                       
                        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                                <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtitemlistentries"><br /></font>
                                <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                                <ul id="ulpaginationitemlist" class="pagination pull-right"></ul>
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

        <!-- <table class="tabledash_footer table" style="margin: 0px !important;">
                <thead>
                    <tr>
                        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                            <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;"/>
                            <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtitemlistentries"><br /></font>
                            <ul id="ulpaginationitemlist" class="pagination pull-right"></ul>
                        </th>
                    </tr>
                </thead>
          </table> -->
      </div>
    </div>
  </div>
</div>




<!--                                               modal ni nardingerts                                          -->


<div class="modal fade" id="deposhit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #438EB9;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="div_modal_title_inquiry" style="color:white; font-weight: bold;">Deposit Item </h4>
      </div>


      <div class="modal-body body-lg">  
        <form name= "depositmodal" method="post" onsubmit="return saveitem()" id="depositmodal">
          <div class="container">
            <div class="row">
              <div class="col-sm-3 col-sm-3 form-group">
                <label><b> CARD ID </b></label>
                <input type="text" id="cardid" name="cardid" maxlength="50" class="form-control" style="font-weight: bold;" required />
              </div>
              <div class="col-sm-3 form-group">
                <label><b> Name </b></label><font color="red"><b> * </b></font>
                <input type="text" id="namess" name="namess" placeholder="Name" class="form-control" required />
              </div>
              <div class="col-sm-3 form-group">
                <label><b> Item Description </b></label><font color="red"><b> * </b></font>
                <textarea type="text" id="itemdescriptionhehe" placeholder="Item Description" name="itemdescriptionhehe" class="form-control" rows="3" cols="50" required /></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3 col-sm-3 form-group">
                <label><b> Quantity </b></label><font color="red"><b> * </b></font>
                <input type="number" id="quantity" name="quantity" placeholder="Quantity" class="form-control" onkeyup="enternumber();" required />
              </div>
              <div class="col-sm-3 form-group">
                <label><b> Important </b></label><font color="red"><b> * </b></font>
                <input type="text" id="important" name="important" placeholder="Important" class="form-control" required />
              </div>
              <div class="col-sm-3 form-group">
                <label><b> Notes </b></label><font color="red"><b> * </b></font>
                <textarea type="text" id="notes" name="notes" placeholder="Notes" class="form-control" rows="3" cols="50" required /></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3 col-sm-3 form-group">
                <label><b> Date: </b></label> &nbsp;
                <input type="text" id="item_date" name="item_date" value="<?php echo date("Y-m-d"); ?>" readonly style="font-weight: bold; width: 250px;">
              </div>
              <div class="col-sm-3 form-group">
                <label><b> Time: </b></label> &nbsp;
                <input type="text" id="item_time" name="item_time" readonly style="font-weight: bold; width: 250px;" />
              </div>
              <div class="col-sm-3 form-group">
                <input type="hidden" id="transac" name="transac"  style="font-weight: bold; width: 250px;" />
              </div>
            </div>  
          </div>
        </form>
        <div class="modal-footer" style="">
          <button class="btn btn-success" type="button" align="center" onclick="saveitem();"> Deposit </button>
        </div> 
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="claimmodal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: white !important;">
        <h6 class="atitle"><span class="fa fa-info-circle" style="color: #06F;"></span> Confirm </h6>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>

      <div class="modal-body">
        <input type="text" id="cardidj" name="cardidj" hidden>
        <h3 class="modaltxt"> Are You Sure You Want To Claim Your Item? </h3>
      </div>

      <div class="modal-footer">
        <center> 
          <button type="button" class="btn btn-success btn-sm" id="yesbtn" onclick="updatehihi();"><span class="glyphicon glyphicon-ok"> Yes </span></button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove"> No </span></button>
          
          <div class="col-sm-3 col-sm-3 form-group" hidden>
                <label><b> Date: </b></label> &nbsp;
                <input type="date" id="claimdatej" name="claimdatej" value="<?php echo date("Y-m-d"); ?>" readonly style="font-weight: bold; width: 250px;">
          </div>
          <div class="col-sm-3 form-group" hidden>
                <label><b> Time: </b></label> &nbsp;
                <input type="text" id="claimtimej" name="claimtimej" readonly style="font-weight: bold; width: 250px;" />
          </div>
        </center>
      </div>
    </div>
  </div>
</div>

<div id="reportcontainer" style="margin-top: 10px; display: none;">
  <center>
  <div class="checklist" id="div_form_printngmamamo" style="margin-top: 20px; width: 99%;margin-bottom: 0;">
    <center>
      <table cellspacing="0" style="padding: 5px; width: 95%">
        <tr><td colspan="2" align="center"><div style="width: 100%; text-align: left;">
          <table style="width: 100%;" cellspacing="0" cellpadding="0">
            <tbody id="template3"></tbody>
          </table>
        </div></td></tr>
        <tr><td align="right"><p style="font-size: 15px; margin-top: 5px;">From:&nbsp;&nbsp;<label id="dateFrom2" style="font-weight: bold;"></label>&nbsp;&nbsp;To:&nbsp;&nbsp;<label id="dateTo2" style="font-weight: bold;"></label></p></td></tr>
        <tr><td colspan="2"><center><p style="font-size: 16px; font-weight: bold;background-color: #666;color: white;width: 100%;"></p></center></td></tr>
        <tr>
          <td colspan="2">
            <center>
              <table class="table table-bordered" style="width: 100%; border: 1px solid black;"> 
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Owner's Name</th>
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Item</th>
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Notes</th>
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Quantity</th>
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Date In </th>
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Time In</th>
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Date Out</th>
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Time Out</th>
                    <th style="border-left: 1px solid black;border-bottom: 1px solid black;">Status</th>
                <tbody id="contentngmamamo" style="border: 1px solid black; border-right: 1px solid black;"></tbody>
              </table>
            </center>
          </td>
        </tr>
      </table>
    </center>
  </div>
  </center>
</div>

<div class="modal fade" id="successclaimedmodal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: white !important;">
        <h6 class="atitle"><span class="fa fa-info-circle" style="color: #06F;"></span> Confirm </h6>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>

      <div class="modal-body">
        <input type="text" id="cardidj" name="cardidj" hidden>
        <h3 class="modaltxt"> Item successfully claimed</h3>
      </div>

      <div class="modal-footer">
        <center> 
          <button type="button" class="btn btn-success btn-sm" id="yesbtn" data-dismiss="modal"><span class="glyphicon glyphicon-ok"> Ok </span></button>
         
          
          <div class="col-sm-3 col-sm-3 form-group" hidden>
                <label><b> Date: </b></label> &nbsp;
                <input type="date" id="claimdatej" name="claimdatej" value="<?php echo date("Y-m-d"); ?>" readonly style="font-weight: bold; width: 250px;">
          </div>
          <div class="col-sm-3 form-group" hidden>
                <label><b> Time: </b></label> &nbsp;
                <input type="text" id="claimtimej" name="claimtimej" readonly style="font-weight: bold; width: 250px;" />
          </div>
        </center>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="requiredfields">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: white !important;">
        <h6 class="atitle"><span class="fa fa-info-circle" style="color: #06F;"></span> Confirm </h6>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>

      <div class="modal-body">
        <input type="text" id="cardidj" name="cardidj" hidden>
        <h3 class="modaltxt"> You can't leave the fields empty!</h3>
      </div>

      <div class="modal-footer">
        <center> 
          <button type="button" class="btn btn-success btn-sm" id="yesbtn" data-dismiss="modal"><span class="glyphicon glyphicon-ok"> OK</span></button>
        </center>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="invalidcard">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: white !important;">
        <h6 class="atitle"><span class="fa fa-info-circle" style="color: #06F;"></span> Confirm </h6>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>

      <div class="modal-body">
        <input type="text" id="cardidj" name="cardidj" hidden>
        <h3 class="modaltxt"> Card ID already used!</h3>
      </div>

      <div class="modal-footer">
        <center> 
          <button type="button" class="btn btn-success btn-sm" id="yesbtn" data-dismiss="modal"><span class="glyphicon glyphicon-ok"> OK</span></button>
        </center>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="successdeposit">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: white !important;">
        <h6 class="atitle"><span class="fa fa-info-circle" style="color: #06F;"></span> Confirm </h6>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>

      <div class="modal-body">
        <input type="text" id="cardidj" name="cardidj" hidden>
        <h3 class="modaltxt"> Item Successfully Deposited!</h3>
      </div>

      <div class="modal-footer">
        <center> 
          <button type="button" class="btn btn-success btn-sm" id="yesbtn" data-dismiss="modal"><span class="glyphicon glyphicon-ok"> OK</span></button>
        </center>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="filtersave">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: white !important;">
        <h6 class="atitle"><span class="fa fa-info-circle" style="color: #06F;"></span> Confirm </h6>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>

      <div class="modal-body">
        <input type="text" id="cardidj" name="cardidj" hidden>
        <h3 class="modaltxt"> Filter Successfully Saved!</h3>
      </div>

      <div class="modal-footer">
        <center> 
          <button type="button" class="btn btn-success btn-sm" id="yesbtn" data-dismiss="modal"><span class="glyphicon glyphicon-ok"> OK</span></button>
         
          
          <div class="col-sm-3 col-sm-3 form-group" hidden>
                <label><b> Date: </b></label> &nbsp;
                <input type="date" id="claimdatej" name="claimdatej" value="<?php echo date("Y-m-d"); ?>" readonly style="font-weight: bold; width: 250px;">
          </div>
          <div class="col-sm-3 form-group" hidden>
                <label><b> Time: </b></label> &nbsp;
                <input type="text" id="claimtimej" name="claimtimej" readonly style="font-weight: bold; width: 250px;" />
          </div>
        </center>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalAlert">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        System Alert
      </div>

      <div class="modal-body">
        <center><h3 id="alertStat">Time has been set. . .</h3></center>
      </div>

      <div class="modal-footer">
        <button class="btn btn-info" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span> OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="loadingSync" data-backdrop="static" style="margin-top: 20% !important;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        Loading. Please wait while files are syncing...
      </div>
      <div class="modal-body row">
        <div class="container-fluid">
          <center>
            <span class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size: 80px;"></span>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>




<?php
	// include("leasingapplication_modal.php");
 //  include("modal_view_requirements.php");
	// include("modal_update_inquiry.php");
 //  include("modal_view_image.php");
 //  include("modal_load_tenants.php");
 //  include("modal_new_tenant.php");
 //  include("modal_load_companies.php");
 //  include("modal_new_company.php");
 //  include("modal_new_address.php");
 //  include("modal_new_referential.php");
	// include("print_application.php");
 //  include("modal_update_contact_person.php");
 //  include("modal_new_remarks.php");  
 //  include("../inquiry/modal_shortcut_unit.php");
 //  include("../inquiry/kevinMscript.php");
include("itemsclaim/modal/modal.php");
include("itemsclaim/function/jonardfunction.php")
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