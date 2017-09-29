<?php
    include("../connect.php");
?>
<style>
  
.parent {
    height: 50vh;
}

.parent2 {
    height: 50vh;
}

.parent3 {
    height: 40vh;
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
<script type="text/javascript">
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
    loadfilters_inquiry('Inquiry')
		$("#txtinquirypages").val("1");
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
            url: 'mainclass.php',
            data: 'module=' + module + '&form=loadfilters_inquiry',
            success: function(data)
            {
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
                $("#txtdiv_strtinquiry").val(arr2[0]);
                $("#txtdiv_endinquiry").val(arr2[1]);
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
                loadinquiries()
            }
        })
    }

// loading of inquiries
	function loadinquiries()
	{
			var key = $("#txtsearchinquiry").val();
			var page = $("#txtinquirypages").val();

	    $.ajax({
	    type: 'POST',
	    url: 'mainclass.php',
	    data: 'key=' + key + '&page=' + page + '&form=loadinquiries',
      beforeSend : function() {
       $('#indexloadingscreen').addClass('myspinner');
      },
	    success: function(data){
        $('#indexloadingscreen').removeClass('myspinner');
	   	  $("#tblinquirylist").html(data);
	   	  $(".scroll").niceScroll({cursorcolor:"#999"});
	   	  loadpaginationinquiry();
      	loadinquiryentries();
	    }
    });
	}

    function savefilter()
    {
        var module = "Inquiry";
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

        var occstrt = $("#txtdiv_strtinquiry").val();
        var occend = $("#txtdiv_endinquiry").val();
        var appstart = "";
        var append = "";
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'module=' + module + '&checked=' + checked + '&checked2=' + checked2 + '&checked3=' + checked3 + '&datefilter=' + unit + '&occstrt=' + occstrt + '&occend=' + occend + '&appstart=' + appstart + '&append=' + append + '&form=savefilter',
            beforeSend : function() {
              $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
              $('#indexloadingscreen').removeClass('myspinner');
              loadfilters_inquiry(module)
              $("#LINK_inquiry_filter").click();
              $("#txtsearchinquiry").focus();
            }
        })
    }

// loading of pagination
    function loadpaginationinquiry() //added by melanie
    {
      var key = $("#txtsearchinquiry").val();
      var page = $("#txtinquirypages").val();

            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationinquiry',
                success: function(data){
                    $("#ulinquirypagination").html(data);
                }
            }).error(function() {
                alert(data);
            });
    }
// clicking of pagination
    function getvalinquiry(page, pagenums) //added by melanie
    {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txtinquirypages").val(page);
                // reloadhmo();
                loadinquiries();
                loadpaginationinquiry();
                loadinquiryentries();
    }
// entries of pagination
    function loadinquiryentries() //added by melanie
    {
      var key = $("#txtsearchinquiry").val();
      var page = $("#txtinquirypages").val();

            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadinquiryentries',
                success: function(data){
                    if(data == 000)
                    {
                        $("#txtinquiryenties").html("<br />");
                    }
                    else
                    {
                        $("#txtinquiryenties").text(data);
                    }
                }
            });
    }

// new inquiry modal
  function loadmodal_inquiry()
 	{
      $("#btnshortucutunit").prop("disabled", false);
      $("#txtselected_month").val("");
      $("#btn_saveinquiry").css("display", "");
      $(".updatedby_texts").css("display", "none");
      $(".modified_info").css("display", "none");
      $("#txtinq_pymentterms").val("");
      $("#txtinq_pymenttype").val("");
      $("#txtlabel_payment").text("Monthly Dues");
      $("#txtnoofmonths_inq").attr("onkeyup", "loaddatetofunction();");
      $("#btn_savenewremark").prop("onclick", "savenewremark(\"\")");
      loadmalllist();
      paymentterms_SET();
      $("#paymenttypeinformation :input").val("");
      $("#modalforinputofdetails :input").val("");
      $("#monthlyduesiconforedit").prop("disabled", false);
      $("#btnforinputofdetails").prop("disabled", true);
      $(".chkrentbox").prop("disabled", false);
      $(".radassocdues").prop("disabled", false);
      $("#div_assocdue").css("display", "none");
      $(".text_inquiry").prop("disabled", false);
      $("#txtinq_unitclass").prop("disabled", true);
      $("#txtremakrstext").text("Remarks");
 		  $(".text_inquiry").val("");
 		  $(".required_inq").css("border-color","#D5D5D5");
      $("#txtinq_mallbranch").prop("disabled", false);
      $("#txtinq_remarks").prop("disabled", false);
      $("#txtinq_tradename").prop("disabled", false);
      $("#btn_saveinquiry").prop("disabled", false);
 		  $("#modal_addnewinquiry").modal("show");
      $("#div_modal_inquiry_remarks").prop("class", "col-md-6 col-xs-6");
      $("#div_modal_inquiry_requirements").css("display", "none");
      $("#div_modal_title_inquiry").text("New Inquiry");
      $("#div_inquiry_contact_numbers").html('<center><img src="assets/images/phone-receiver.png" style="margin: 20px;"></center><center><h3>No contacts yet.</h3></center>');
      $("#div_inquiry_contact_person").html('<center><img src="assets/images/network.png" style="margin: 20px;"></center><center><h3>No contact persons yet.</h3></center>');
      $("#div_amenities_inquiry").html("");
      $("#btn_saveinquiry").attr("onclick", "saveinquiry()");
      $("#txtinq_datefrom").prop("disabled", false);
      $("#radio_set").prop("disabled", false);
      $("#radio_lca").prop("disabled", false);
      $("#tbodypdc_inquiry").html('');
      $("#lbltotalamountofpayment").text("0.00");
      $('#radio_set').prop("checked", true);
      $('#radio_lca').prop("checked", false);
      $("#div_advance_set").css("display", "block");
      $("#div_deposit_set").css("display", "block");
      $("#div_advance_set_amt").css("display", "none");
      $("#div_deposit_set_amt").css("display", "none");
      $("#txtinq_advancepayment").val("");
      $("#txtinq_depositpayment").val("");
      $("#txtinq_monthlyadvamt").attr("onkeyup", "loaddatefunction4()");
      $("#txtinq_monthlydepamt").attr("onkeyup", "loaddatefunction4()");
      $("#txtinq_mallbranch").focus();
      $("#div_unit_area_set").css("display", "block");
      $("#div_unit_area_lca").css("display", "none");
      $("#div_unit_set").css("display", "block");
      $("#div_unit_lca").css("display", "none");
      $("#txtinq_dateto").prop("disabled", true);
      $("#txtnoofdays_inq").val("");
      $("#txtinq_monthlyadvamt").val("0");
      $("#txtinq_monthlydepamt").val("0");
      $("#txtinq_sqm").prop("disabled", true);
      $("#txtinq_persqm").prop("disabled", true);
      $("#txtinq_totalsqm").prop("disabled", true);
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
      $("#txtinq_monthlyadvamt").val("0");
      $("#txtinq_monthlydepamt").val("0");
      $("#txtinq_sqm_width").val("0");
      $("#txtinq_sqm_length").val("0");
      $("#div_businessinfo").click();
      $("#txtinq_advancepayment2").removeClass("required_inq");
      $("#txtinq_depositpayment2").removeClass("required_inq");
      $("#txtinq_monthlyadvamt").removeClass("required_inq");
      $("#txtinq_advancepayment").removeClass("required_inq");
      $("#txtinq_monthlydepamt").removeClass("required_inq");
      $("#txtinq_depositpayment").removeClass("required_inq");
      $("#txtinq_pymentterms").removeClass("required_inq");
      $("#txtinq_pymenttype").removeClass("required_inq");
      $("#txtinq_lca_unitname").val("");
      $("#txtnoofmonths_inq").val("");
      $("#txtnoofdays_inq").val("");

      // merchandise class and unit info
      $("#txtinq_unitdepartment").prop("disabled", true);
      $("#txtinq_unitcategory").prop("disabled", true);
      $("#txtinq_unitwing").prop("disabled", true);
      $("#txtinq_unitfloor").prop("disabled", true);
      $("#txtinq_unitunit").prop("disabled", true);

      //set
      $("#txtinq_datefrom").prop("disabled", true);
      $("#txtnoofmonths_inq").prop("disabled", true);
      $("#txtinq_monthlyadvamt").prop("disabled", true);
      $("#txtinq_advancepayment").prop("disabled", true);
      $("#txtinq_monthlydepamt").prop("disabled", true);
      $("#txtinq_depositpayment").prop("disabled", true);
      $("#txtinq_monthlyrate2").prop("disabled", true);
      $("#txtinq_pymentterms").prop("disabled", true);
      $("#txtinq_pymenttype").prop("disabled", true);

      $("#div_nodays").css("display", "none");

      // disabling of auto fill fields on first tab
      $("#txtinq_tradename").prop("disabled", false);
      $("#txtinq_mallbranch").prop("disabled", false);
      $("#txtinq_companyname").prop("disabled", true);
      $("#txtinq_industryname").prop("disabled", true);
      $("#txtinq_address").prop("disabled", true);
      $("#txtinq_tradename").attr("style", "background-color:#ffffff !important");
      $("#txtinq_mallbranch").attr("style", "background-color:#ffffff !important");
      $("#txtinq_tradename").attr("style", "background-color:#ffffff !important");
      $("#txtinq_companyname").attr("style", "background-color:#ffffff !important");
      $("#txtinq_industryname").attr("style", "background-color:#ffffff !important");
      $("#txtinq_address").attr("style", "background-color:#ffffff !important");

      $("#fornewapp_remarks").css("display", "none");
      $("#fornewinq_remarks").css("display", "block");

      $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=getfirstmall',
        success: function(data)
        {
          var arr = data.split("|");
          $("#txtinq_mallbranch").val(arr[0]);
        }
      })
      reqmonORday();
 	}

// load mall list
  function loadmalllist()
  {
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'form=load_mall_select',
      success: function(data)
      {
        $("#txtinq_mallbranch").html(data);
      }
    })
  }

// for elements that only accepts numbers
 	function numonly()
    {
       $(".numonly").keydown(function(event) {

           // Allow only backspace and delete
           if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190 || event.keyCode == 9) {
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
            var x = ($(this).val()).replace(/,/g,"");
            var v = parseFloat(x||0);
            $(this).val(v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
       });
     }

// saving of leasing application
function saveleasingapplication(inquiryID){
  reqmonORday();
  clicktwo();
  var stathappened = chkunitfrst2();
  var setunit = $("#txtinq_unitunit").val();
  var lcaunit = $("#txtinq_lca_unitname").val();
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
  if(setunit != "" || lcaunit != ""){
    if(stathappened == "valid"){
      var y = 0;
      var z = 0;
      var f = 0;
      $(".form_lease_application_req .upload_app_req").each(function(){
        z++;
        if($(this).get(0).files.length === 0){
        }
        else{
          y++;
        }
      });

      $(".required_inq").each(function(){
        if($(this).val() == "" || $(this).val() == "0" || $(this).val() == "0.00"){
          f++;
          var eto = $(this).attr("id");
          $(this).css("border-color","#f2a696");
        }
        else{
          $(this).css("border-color","#D5D5D5");
        }
      });
      if(f == 0){
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

        if($("#radio_set").is(":checked")){
          var unit_id = $("#txtinq_unitunit").val();
          var unittype = "SET";
          var monthlyadvamt = monthlyadvamt2;
          var monthlydepamt = monthlydepamt2;
          var cnt = advancepayment2.split(",");
          for(var i = 0; i<=cnt.length; i++){
            advancepayment2 = advancepayment2.replace(",", "");
          }
          var advancepayment = advancepayment2;
          var cnt = depositpayment2.split(",");
          for(var i = 0; i<=cnt.length; i++){
            depositpayment2 = depositpayment2.replace(",", "");
          }
          var depositpayment = depositpayment2;
        }
        else if($("#radio_lca").is(":checked")){
          var unit_id = $("#txtinq_lca_unitname").val();
          var unittype = "LCA";
          var monthlyadvamt = "";
          var monthlydepamt = "";
          var cnt = advancepayment3.split(",");
          for(var i = 0; i<=cnt.length; i++){
            advancepayment3 = advancepayment3.replace(",", "");
          }
          var advancepayment = advancepayment3;
          var cnt = depositpayment3.split(",");
          for(var i = 0; i<=cnt.length; i++){
            depositpayment3 = depositpayment3.replace(",", "");
          }
          var depositpayment = depositpayment3;
        }
        if(z == y && z != 0 && y != 0){
            var req = "Completed";
        }
        else{
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
          data: 'id='+inquiryID+'&dep_id='+dep_id+'&cat_id='+cat_id+'&unit_id='+unit_id+'&datefrom='+datefrom+'&dateto='+dateto+'&req='+req+'&sqm_width='+sqm_width+'&sqm_length='+sqm_length+'&persqm='+persqm+'&totalsqm='+totalsqm+'&unitwing='+unitwing+'&unitfloor='+unitfloor+'&classid='+classid+'&monthnum=' + monthnum +'&daynum=' + daynum  + '&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&assocdues=' + assocdues + '&form=saveleasingapplication',
          beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
          },
          success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            $("#div_modal_inquiry_requirements").css("border-color", "#d5d5d5");
            var arr = data.split("|");
            sendData(inquiryID, arr[0], i)
          }
        });
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'mallname=' + mallname +'&mallid=' + mallid + '&tradeid=' + tradeid + '&tradename=' + tradename + '&companyname=' + companyname + '&companyid=' + companyid + '&industryname=' + industryname + '&address=' + address + '&unitid=' + unit_id + '&dep_id=' + dep_id + '&cat_id=' + cat_id + '&datefrom=' + datefrom + '&dateto=' + dateto + '&monthlyadvamt=' + monthlyadvamt + '&monthlydepamt=' + monthlydepamt + '&advancepayment=' + advancepayment + '&depositpayment=' + depositpayment + '&unittype=' + unittype + '&sqm_width=' + sqm_width + '&sqm_length=' + sqm_length + '&persqm=' + persqm + '&totalsqm=' + totalsqm + '&unitwing=' + unitwing + '&unitfloor=' + unitfloor + '&classid=' + classid + '&id=' + inquiryID + '&monthnum=' + monthnum + '&daynum=' + daynum + '&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&req='+req+ '&assocdues=' + assocdues + '&cardtype=' + cardtype + '&cardholder=' + cardholder + '&authno=' + authno + '&securitycode=' + securitycode + '&ccno=' + ccno + '&expirydate=' + expirydate + '&bankfrom=' + bankfrom + '&bf_accno=' + bf_accno + '&bankto=' + bankto + '&bt_accno=' + bt_accno + '&form=saveinquiryupdate',
            beforeSend : function() {
              $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
              $('#indexloadingscreen').removeClass('myspinner');
              clearcardinfomodal();
            }
        });
      }
      else{
        showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
        $('.required_inq').each(function() {
          if ( this.value === '' || this.value === '0' || this.value === '0.00') {
            this.focus();
            return false;
          }
        });
        $("#div_modal_inquiry_requirements .well").css("border-color", "#f2a696");
      }
    }
    else{
      chkunitfrst();
      $("#txtinq_unitunit").css("border-color", "red");
      $("#txtnoofmonths_inq").css("border-color", "red");
      $("#txtinq_datefrom").css("border-color", "red");
      $("#div_unitinfo").click();
    }
  }
  else
  {
    var y = 0;
    var z = 0;
    var f = 0;
    $(".form_lease_application_req .upload_app_req").each(function(){
        z++;
        if($(this).get(0).files.length === 0)
        {
        }
        else
        {
          y++;
        }
    });

    $(".required_inq").each(function(){
      if($(this).val() == "" || $(this).val() == "0" || $(this).val() == "0.00"){
        f++;
        var eto = $(this).attr("id");
        $(this).css("border-color","#f2a696");
      }
      else{
        $(this).css("border-color","#D5D5D5");
      }
    });
    if(f == 0){
      var mallname = $("#txtinq_mallbranch").text();
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
      if($("#radio_set").is(":checked")){
        var unit_id = $("#txtinq_unitunit").val();
        var unittype = "SET";
        var monthlyadvamt = monthlyadvamt2;
        var monthlydepamt = monthlydepamt2;
        var cnt = advancepayment2.split(",");
        for(var i = 0; i<=cnt.length; i++){
          advancepayment2 = advancepayment2.replace(",", "");
        }
        var advancepayment = advancepayment2;
        var cnt = depositpayment2.split(",");
        for(var i = 0; i<=cnt.length; i++){
          depositpayment2 = depositpayment2.replace(",", "");
        }
        var depositpayment = depositpayment2;
      }
      else if($("#radio_lca").is(":checked")){
        var unit_id = $("#txtinq_lca_unitname").val();
        var unittype = "LCA";
        var monthlyadvamt = "";
        var monthlydepamt = "";

        var cnt = advancepayment3.split(",");
        for(var i = 0; i<=cnt.length; i++){
          advancepayment3 = advancepayment3.replace(",", "");
        }
        var advancepayment = advancepayment3;
        var cnt = depositpayment3.split(",");
        for(var i = 0; i<=cnt.length; i++){
          depositpayment3 = depositpayment3.replace(",", "");
        }
        var depositpayment = depositpayment3;
        }

        if(y == z && y != 0 && z != 0){
            var req = "Completed";
        }
        else{
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
          data: 'id='+inquiryID+'&dep_id='+dep_id+'&cat_id='+cat_id+'&unit_id='+unit_id+'&datefrom='+datefrom+'&dateto='+dateto+'&req='+req+'&sqm_width='+sqm_width+'&sqm_length='+sqm_length+'&persqm='+persqm+'&totalsqm='+totalsqm+'&unitwing='+unitwing+'&unitfloor='+unitfloor+'&classid='+classid+'&monthnum=' + monthnum +'&daynum=' + daynum  + '&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&assocdues=' + assocdues + '&form=saveleasingapplication',
          beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
          },
          success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            $("#div_modal_inquiry_requirements").css("border-color", "#d5d5d5");
            var arr = data.split("|");
            sendData(inquiryID, arr[0], i)
          }
        });
        $.ajax({
          type: 'POST',
          url: 'mainclass.php',
          data: 'mallname=' + mallname + '&mallid=' + mallid + '&tradeid=' + tradeid + '&tradename=' + tradename + '&companyname=' + companyname + '&companyid=' + companyid + '&industryname=' + industryname + '&address=' + address + '&unitid=' + unit_id + '&dep_id=' + dep_id + '&cat_id=' + cat_id + '&datefrom=' + datefrom + '&dateto=' + dateto + '&monthlyadvamt=' + monthlyadvamt + '&monthlydepamt=' + monthlydepamt + '&advancepayment=' + advancepayment + '&depositpayment=' + depositpayment + '&unittype=' + unittype + '&sqm_width=' + sqm_width + '&sqm_length=' + sqm_length + '&persqm=' + persqm + '&totalsqm=' + totalsqm + '&unitwing=' + unitwing + '&unitfloor=' + unitfloor + '&classid=' + classid + '&id=' + inquiryID + '&monthnum=' + monthnum + '&daynum=' + daynum + '&selectedmonth=' + selectedmonth + '&pymentterms=' + pymentterms + '&pymenttype=' + pymenttype + '&req='+req+ '&assocdues=' + assocdues + '&cardtype=' + cardtype + '&cardholder=' + cardholder + '&authno=' + authno + '&securitycode=' + securitycode + '&ccno=' + ccno + '&expirydate=' + expirydate + '&bankfrom=' + bankfrom + '&bf_accno=' + bf_accno + '&bankto=' + bankto + '&bt_accno=' + bt_accno + '&form=saveinquiryupdate',
          beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
          },
          success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            clearcardinfomodal();
          }
        });
      }
      else{
        showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
        $('.required_inq').each(function() {
          if ( this.value === '' || this.value === '0' || this.value === '0.00' ) {
              this.focus();
              return false;
          }
        });
        $("#div_modal_inquiry_requirements .well").css("border-color", "#f2a696");
      }
    }
}

function sendData(inq, app, i){
  var t = 0;
  var u = 0;
  $(".form_lease_application_req").each(function(){
    var this_id = $(this).attr("id");
    var txtaapid = $(this).find(".txtaapid");
    var txtaapid2 = txtaapid.attr("id");
    var txtinqqid = $(this).find(".txtinqqid");
    var txtinqqid2 = txtinqqid.attr("id");
    t++;
    $("#"+txtaapid2).val(app);
    $("#"+txtinqqid2).val(inq);
    var data = new FormData($('#'+this_id)[0]);
    $.ajax({
      type:"POST",
      url:"inquiry/uploadappreq.php",
      data: data,
      mimeType: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
      }
    });
  })

  $(".form_lease_application_req").each(function(){
    u++;
  });

  if(t == u)
  {
      showmodal("alert", "Record successfully updated.", "", null, "", null, "0");
      loadinquiries();
      $("#modal_addnewinquiry").modal("hide");
      $("#div_modal_inquiry_requirements .well").css("border-color", "#e3e3e3");
  }

  }

   function istatus(type){
      $("#istatus").val(type);
      loadinquiries();
    }

   function viewhistorytenants(inquiryID){
      $("#viewhistoryinquiry").modal("show");
      $("#inqidnglogs").val(inquiryID);
      viewhistoryinquirydisplay();
  }

  function viewhistoryinquirydisplay(){
    var inqidnglogs = $("#inqidnglogs").val();
     $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'inqidnglogs=' + inqidnglogs + '&form=viewhistoryinquirydisplay',
        success: function(data){
            $("#viewhistoryinquirydisplay").html(data);
        }
      })
  }

</script>
<style>
a { cursor: hand !important; cursor: pointer !important; }
</style>

<div class="page-header" style="padding-bottom: 0px;">
    <div class="row form-group" style="margin-bottom: 0px;padding-top:10px;background-color: #edf4f8;">
    <!-- <input type="text" id="jxnjdncdj" name=""> -->
        <div class="col-md-2 col-xs-12">
            <h1 style="font-weight: bold;">INQUIRY</h1>
            <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;List of Inquiries</h6>
            <input type="hidden" id="txtinquirypages" name="">
        </div>
        <div class="col-md-2">
          <?php
            // $sql = "SELECT startDate, endDate FROM tblref_unit where unitid = 'U-0000063' AND startDate >= '2017-02-27'";
            // $res = mysql_query($sql, $connection);
            // while($row = mysql_fetch_array($res)){
            //   echo $row["startDate"];
            // }
          ?>
        </div>
        <div class="col-md-8 col-xs-12" style="padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px;">
          <div class="row form-group">
            <div class="col-xs-12 divstat" style="padding-right: 0px;">
              <span>All Status:</span>&nbsp;
              <label class='label label-sm label-light'>Inquired</label>
              <label class='label label-sm label-success'>Application on process . . .</label>
              <label class='label label-sm label-danger'>Disapproved Application</label>
              <label class='label label-sm label-info'>Approved Application</label>
              <label class='label label-sm label-yellow'>Reserved</label>
              <label class='label label-sm label-warning'>Occupied</label>
              <label class='label label-sm label-danger'>Cancelled Reservation</label>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-4 col-xs-12" style="margin-left: 0px;">
                <a href="#" id="btn_inquiry" class="btn btn-white btn-success btn-sm" style="width: 100% !important;" onclick="selectnav(7)"><i class="ace-icon fa fa-calendar-o"></i>&nbsp;&nbsp;View Calendar</a>
            </div>
            <div class="col-md-4 col-xs-12" style="margin-left: 0px;">
                <a href="#" id="btn_inquiry" class="btn btn-white btn-info btn-sm" style="width: 100% !important;" onclick="selectnav(13)"><i class="ace-icon fa fa-map-o"></i>&nbsp;&nbsp;View LCA Units</a>
            </div>
            <div class="col-md-4 col-xs-12">
                <a href="#" id="btn_inquiry" class="btn btn-white btn-info btn-sm" style="width: 100% !important;" onclick="selectnav(14)"><i class="ace-icon fa fa-map-o"></i>&nbsp;&nbsp;View SET Units</a>
            </div>
          </div>
        </div>

    </div>
</div><!-- /.page-header -->


<div class="row">
	<div class="col-xs-12">
		<div class="row form-group">
			<div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-left: 0px;">
				<span class="input-icon" style="width: 100%;">
                  <input type="text" class="form-control" id="txtsearchinquiry" title="Search according to selected filter" placeholder="Search" onkeyup="$('#txtinquirypages').val('1');loadinquiries()">
                  <i class="ace-icon fa fa-search nav-search-icon"></i>
              </span>
            </div>
            <div class="col-md-4" style="padding-bottom: 5px;padding-left:0px;">
                <h5><a onclick="loadfilters_inquiry('Inquiry')" id="LINK_inquiry_filter" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='
                  <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Select by&nbsp;&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-3">
                          <label>
                             <input name="form-field-checkbox" class="ace ace-checkbox-2 inquiry_module_filter" type="checkbox" value="Company_Name" id="filter_Company_Name">
                             <span class="lbl"> Company</span>
                          </label>
                        </div>
                        <div class="col-md-3">
                          <label>
                              <input name="form-field-checkbox" class="ace ace-checkbox-2 inquiry_module_filter" type="checkbox" value="Trade_Name" id="filter_Trade_Name">
                              <span class="lbl"> Store</span>
                          </label>
                        </div>
                        <div class="col-md-3">
                          <label>
                              <input name="form-field-checkbox" class="ace ace-checkbox-2 inquiry_module_filter" type="checkbox" value="Industry" id="filter_Industry">
                              <span class="lbl"> Industry</span>
                          </label>
                        </div>
                        <div class="col-md-3">
                          <label>
                              <input name="form-field-checkbox" class="ace ace-checkbox-2 inquiry_module_filter" type="checkbox" value="Address" id="filter_Address">
                              <span class="lbl"> Address</span>
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
                            <span class="lbl"> Inquired <b>SET</b> units</span>
                          </label>
                        </div>
                        <div class="col-md-6">
                          <label style="margin-bottom: 0px;margin-top: 0px;margin-right: 20px;">
                            <input name="form-field-checkbox-unt" class="ace ace-checkbox-2 chk_inquiry_unittype" type="checkbox" value="LCA" onclick="loadinquiries();loadinquiries();" id="filter_LCA">
                            <span class="lbl"> Inquired <b>LCA</b> units</span>
                          </label>
                        </div>
                      </div>
                  </fieldset>
                  <fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:100px;">&nbsp;&nbsp;Filter Status&nbsp;&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-3" style="padding-right:0px;">
                          <label class="label label-light" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Inquired" id="filter_Inquired">
                            <span class="lbl"> Inquired</span>
                          </label>
                        </div>
                        <div class="col-md-3" style="padding-right:0px;">
                          <label class="label label-success" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Processing" id="filter_Processing">
                            <span class="lbl"> Processing</span>
                          </label>
                        </div>
                        <div class="col-md-3" style="padding-right:0px;">
                          <label class="label label-danger" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Disapproved" id="filter_Disapproved">
                            <span class="lbl"> Disapproved</span>
                          </label>
                        </div>
                        <div class="col-md-3">
                          <label class="label label-info" style="margin-bottom: 0px;height:22px;padding-left:4px;">
                            <input name="form-field-checkbox-stat" class="ace" type="checkbox" value="Approved" id="filter_Approved">
                            <span class="lbl"> Approved</span>
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
                    <legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:100px;">&nbsp;&nbsp;Inquiry Date&nbsp;&nbsp;</legend>
                      <div class="form-group row" style="margin:0px;">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-5">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar bigger-110"></i>
                            </span>
                            <input class="form-control div_app date-picker" type="text" name="" id="txtdiv_strtinquiry" data-provide="datepicker">
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar bigger-110"></i>
                            </span>
                            <input class="form-control div_app date-picker" type="text" name="" id="txtdiv_endinquiry" data-provide="datepicker">
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
            <div>
            <div class="col-md-4" style="padding-bottom: 5px;text-align: right;"></div>
            <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-right: 0px;">
				      <a href="#" id="btn_inquiry_add_new" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="loadmodal_inquiry();">New Inquiry</a>
            </div>
		</div>
		<div class="row form-group" style="margin-bottom: 0px !important;">
      <div class="col-xs-12 col-md-12 col-lg-12">
  			<div class="parent">
  				<table id="simple-table" class="table table-bordered table-hover fixTable">
          			<thead>
          				<tr>
          					<td>Branch</td>
                    <td>Unit Type</td>
          					<td>Name</td>
          					<td class="hide_mobile">Company Name</td>
          					<td class="hide_mobile">Industry</td>
          					<td class="hide_mobile">Address</td>
                    <td class="hide_mobile">Inquiry Status</td>
          					<td>Option</td>
          				</tr>
          			</thead>
                <div class="" id="statussavingreservation"></div>
          			<tbody id="tblinquirylist"></tbody>
      		</table>
        </div>
			<table class="tabledash_footer table" style="margin: 0px !important;">
  				<thead>
  				    <tr>
  				        <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
                  <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtinquiryenties"><br /></font>
                      <ul id="ulinquirypagination" class="pagination pull-right"></ul>
                  </th>
  				    </tr>
  				</thead>
			</table>
		</div>
    </div>
	</div>
</div>

<div class="modal fade" id="viewhistoryinquiry" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" style="width: 1200px;">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Transaction Logs</h4>
        <input type="hidden" id="inqidnglogs">
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
                        <td width="20%">Module</td>
                        <td width="20%">Action</td>
                      </tr>
                  </thead>
                  <tbody id="viewhistoryinquirydisplay"></tbody>
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

<!-- INQUIRY MODAL -->
<?php
  include("modal_inquiry.php");
  include("print_inquiry.php");
  include("modal_view_image.php");
  include("modal_load_tenants.php");
  include("modal_new_tenant.php");
  include("modal_load_companies.php");
  include("modal_new_company.php");
  include("modal_new_address.php");
  include("modal_new_referential.php");
  include("modal_editcontactperson.php");
  include("modal_new_remarks.php");
  // July 04 Kevin M
  include("modal_shortcut_unit.php");
  include("kevinMscript.php");
?>
<script>
$(function(){
  $("#txtsearchinquiry").focus();
  $('input:checkbox[name="form-field-checkbox-unt"][value="SET"]').attr('checked', 'checked');
  $('input:checkbox[name="form-field-checkbox-unt"][value="LCA"]').attr('checked', 'checked');
})
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

    var dateToday = new Date();

    $("#sdsdd").datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      dateFormat: 'yy-mm-dd',
      minDate: 0
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
<!-- END (lahat ng bagay may ending. pwe.)-->
<!-- <script src="jquery.nicescroll.min.js"></script> -->
