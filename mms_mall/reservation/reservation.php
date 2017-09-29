<?php
include("../connect.php");
?>
<style>
.parent2 {
    height: 50vh;
}

.parent3 {
    height: 30vh;
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
		$("#txtsearchreservation").focus();
		$('#modal_previewleasingapplication').on('hidden.bs.modal', function() {
    		$("#txtsearchreservation").focus();
  		}) 
		loadreservationlist();
  		$("#statinquiryyy").val("valid");
		$('input:checkbox[name="form-field-checkbox2"][value="Tentative"]').attr('checked', 'checked');
		$('input:checkbox[name="form-field-checkbox2"][value="Confirmed"]').attr('checked', 'checked');
		$('input:checkbox[name="form-field-checkbox"][value="Occupied"]').attr('checked', 'checked');
		$("#txtreservationpages").val("1");
		$("#tblreservationlist").niceScroll({cursorcolor:"#999"});
		$("#modal_body_leasing_reservation2").niceScroll({cursorcolor:"#999"});
		$('select[id="txtinq_mallbranch2"] option:eq(1)').attr('selected', 'selected');
		$(".required_reservation").keyup(function(){
		  $("#status_filled").val("1");
		})

		$(".required_reservation").change(function(){
	    $("#status_filled").val("1");
	    $("#txtcurrentpage").val("1");
		});	
	}) 

	function chkoccdate()
	{
		var eto = $("#chkoccdate");
		if(eto.is(":checked"))
		{
			$("#chkappdate").prop("checked", false);
			$("#div_chkappdate").css("background-color", "#f5f5f0");
			$("#div_chkoccdate").css("background-color", "white");
			$(".div_occ").prop("disabled", false);
			$(".div_app").prop("disabled", true);
		}
		else
		{
			$("#chkoccdate").prop("checked", true);
		}
	}

	function chkappdate()
	{
		var eto = $("#chkappdate");
		if(eto.is(":checked"))
		{
			$("#chkoccdate").prop("checked", false);
			$("#div_chkoccdate").css("background-color", "#f5f5f0");
			$("#div_chkappdate").css("background-color", "white");
			$(".div_occ").prop("disabled", true);
			$(".div_app").prop("disabled", false);
		}
		else
		{
			$("#chkappdate").prop("checked", true);
		}
	}

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
            var v = parseFloat($(this).val());
            $(this).val((isNaN(v)) ? '' : v.toFixed(2));
       });
    }


	function loadreservationlist()
	{
		var key = $("#txtsearchreservation").val();
		var mall = $("#txtinq_mallbranch2").val();
		var page = $("#txtreservationpages").val();
		
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 
			'key=' + key + 
			'&mall=' + mall + 
			'&page=' + page + 
			'&form=loadreservationlist',
			beforeSend : function() {
                $('#indexloadingscreen').addClass('myspinner');
            },
             success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
				$("#tblreservationlist").html(data);
				loadpaginationreservation();
	            loadreservationentries();
			}
		})
	}

	function loadpaginationreservation()
	{
		var key = $("#txtsearchreservation").val();
		var mall = $("#txtinq_mallbranch2").val();
		var page = $("#txtreservationpages").val();

	        $.ajax({
	            type: 'POST',
	            url: 'mainclass.php',
	            data: 'key=' + key + 
				'&mall=' + mall + 
				'&page=' + page + 
				'&form=loadpaginationreservation',
		            success: function(data){
		            	// alert(data)
		                $("#ulreservationpagination").html(data);
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
	            $("#txtreservationpages").val(page);
	            // reloadhmo();
	            loadreservationlist();
	            loadpaginationreservation();
	            loadreservationentries();
	}
	
	function loadreservationentries()
	{
		var key = $("#txtsearchreservation").val();
		var mall = $("#txtinq_mallbranch2").val();
		var page = $("#txtreservationpages").val();

	        $.ajax({
	            type: 'POST',
	            url: 'mainclass.php',
	            data: 'key=' + key + 
				'&mall=' + mall + 
				'&page=' + page + 
				'&form=loadreservationentries',
	            success: function(data){
	            	// alert(data)
	                if(data == 000)
	                {
	                    $("#txtresrvationentries").html("<br />");
	                }
	                else
	                {
	                    $("#txtresrvationentries").text(data);
	                }
	            }
	        }).error(function() {
	            alert(data);
	        });
	}

    function savefilter()
    {
    	occstrt = $("#txtdiv_strtocc").val();
		occend = $("#txtdiv_endocc").val();
		appstart = $("#txtdiv_strtapp").val();
		append = $("#txtdiv_endapp").val();
        var module = "Reservation";

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
        $('input:checkbox[name="form-field-checkbox2"]').each(function(){
            if($(this).is(":checked"))
            {
                var value3 = $(this).attr("value");
                checked3 += value3 + "|";
            }
        })     

        if($("#chkoccdate").is(":checked")){ var datefilter = "chkoccdate"; }
		if($("#chkappdate").is(":checked")){ var datefilter = "chkappdate"; }  
        // alert(checked)
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'module=' + module + 
            '&checked=' + checked + 
            '&checked2=' + checked2 + 
            '&checked3=' + checked3 + 
            '&occstrt=' + occstrt +
			'&occend=' + occend +
			'&appstart=' + appstart +
			'&append=' + append +
			'&datefilter=' + datefilter +
            '&form=savefilter',
            success: function(data)
            {
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
                var arr = data.split("#");
                var arr2 = arr[0].split("|");
                for(var i=0; i<=arr2.length-3; i++)
                {
                    $('input:checkbox[id="filter_'+arr2[i]+'"][value="'+arr2[i]+'"]').attr('checked', 'checked');
                }
                var arr3 = arr[1].split("|");
                $("#txtdiv_strtocc").val(arr3[0]);
				$("#txtdiv_endocc").val(arr3[1]);
				$("#txtdiv_strtapp").val(arr3[2]);
				$("#txtdiv_endapp").val(arr3[3]);

				arr4 = arr[2].split("|");
				for(var i=0; i<=arr4.length-1; i++)
                {
                    $('input:checkbox[id="filter_'+arr4[i]+'"][value="'+arr4[i]+'"]').attr('checked', 'checked');
                }               
				
				if(arr[3] == "chkoccdate")
				{
					$("#chkoccdate").prop("checked", true);
					chkoccdate();
				}
				else
				{
					$("#chkappdate").prop("checked", true);
					chkappdate();
				}
				
                loadreservationlist();
            }
        })
    }

    function savefilter2()
    {	
    	var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = (month)+"/"+(day)+"/"+now.getFullYear() ;

    	occstrt = today;
		occend = today;
		appstart = today;
		append = today;
        var module = "Reservation";     
        // alert(checked)
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'module=' + module +  
            '&occstrt=' + occstrt +
			'&occend=' + occend +
			'&appstart=' + appstart +
			'&append=' + append +
            '&form=savefilter2',
            success: function(data)
            {
                loadfilters_inquiry(module)
                $("#LINK_inquiry_filter").click();
            }
        })
    }

    // JONAS's CODE
	$(function(){
		displaytnc();
		selectfilterdisplay();
	})

	function displaytnc(){
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'form=displaytnc',
			success: function(data){
				$("#displaytnc").html(data);
				clickReservation();
			}
		})
	}

	function modal_tnccheckbox(){
		$("#modal_tnccheckbox").modal("show")
		var id = $("#invi").val();
		var ids = $("#nakacheck").val();
		$.ajax ({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + id + '&form=searchChecked',
			success:function(data) {
				if(data == ""){
					$("#nakacheck").val(ids.trim());
				}else{
					$("#nakacheck").val(data.trim());
				}
				checkSelected3();
			}
		})
	}

	function unloadmodal_tnccheckbox()
	{
		$("#modal_tnccheckbox").modal("hide");
		$("#nakacheck").val("");
		$("#displayselected").html("");
	}

	function selectfilterdisplay(){
	    $.ajax({
	        type: 'POST',
	        url: 'mainclass.php',
	        data: 'form=selectfilterdisplay',
	        success: function(data){
	            $("#selectfilterdisplay").html(data);
	        }
	    })
	}

	function addselectedtnc() {
		var nakacheck = $("#nakacheck").val();
		var terms = "";
		$("#displaytnc tr").each(function(){
			var obj = $(this);

			if ( obj.find(".checkbox").prop("checked") ) {
				terms += "|" + obj.find(".checkbox").val();
			}
			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'nakacheck=' + nakacheck + '&form=addselectedtnc',
				success: function(data){
					$("#displayselected").html(data);
					$("#modal_tnccheckbox").modal("hide");
				}
			})
		})
		showmodal("alert", "Selected Terms and Conditions Successfully added.", "", null, "", null, "0");  
	}

	function selectfilter(id) { 
	    $.ajax({
	        type: 'POST',
	        url: 'mainclass.php',
	        data: 'id=' + id + '&form=selectfilter',
	        success: function(data) {
	        		$("#displaytnc").html(data);
	        		clickReservation();
	        		checkSelected3();
		        }
	    })
	}

	function selectfilterdisplay(){
	    $.ajax({
	        type: 'POST',
	        url: 'mainclass.php',
	        data: 'form=selectfilterdisplay',
	        success: function(data){
	            $("#selectfilterdisplay").html(data);
	        }
	    })
	}

	function displayselected(){
		var invi = $("#invi").val();
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: "invi=" + invi + '&form=displayselected',
			success: function(data){
				 var arr = data.split("#");
				$("#displayselected").html(arr[0]);
			}
		})
	}

	function clickReservation(){
		
		$("#displaytnc tr").each(function(){
			$(this).click(function(){
				eto = $(this).find(".checkbox");

				if ( eto.is(":checked") ) {
					var ids = $("#nakacheck").val();
					eto.prop("checked", false);
					
					$("#nakacheck").val(ids.replace($(this).find(".checkbox").val() + "|", ""));
					$(this).css("color","");
					$(this).css("background-color","");
				}

				else {
					var ids = $("#nakacheck").val();
					eto.prop("checked", true);
					ids += $(this).find(".checkbox").val() + "|";

					$("#nakacheck").val(ids);
					$(this).css("color","#FFF");
					$(this).css("background-color","#666");
				}
				
			})
		})
	}

	function checkselected2(){
		var invi = $("#invi").val();
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'invi=' + invi + '&form=checkselected2',
			success: function(data){
				$("#nakacheck").val(data);
				// setTimeout(function(){
				// 	checkSelected3();
				// },1000)
			}
		})
	}

	function checkSelected3() 
	{
		var allselected = $("#nakacheck").val();
		var arr = allselected.split("|");
		
		for ( var a = 0; a <= arr.length; a++ ) {
			$("." + arr[a]).attr("checked", true);
			$("#tr"+arr[a]).attr("style","background-color: #666 !important;color:#FFF !important");

		}
	}

	function updatetenantcode()
	{
		var invi = $("#invi").val();
		var tenantcode = $("#txt_tenant_code").text();
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'invi=' + invi + '&tenantcode=' + tenantcode + '&form=updatetenantcode',
			success: function(data){
				if (data == 1){
				}
				else{
					showmodal("alert", data, "", null, "", null, "0");  
				}
			}
		})
	}

	function viewhistoryreservation(inquiryID)
	{
      $("#viewhistoryreservation").modal("show");
      $("#inqidnglogsreservation").val(inquiryID);
      viewhistoryreservationdisplay();
  	}

	function viewhistoryreservationdisplay(){
	  var inqidnglogsreservation = $("#inqidnglogsreservation").val();
	   $.ajax({
	      type: 'POST',
	      url: 'mainclass.php',
	      data: 'inqidnglogsreservation=' + inqidnglogsreservation + '&form=viewhistoryreservationdisplay',
	      success: function(data){
	          $("#viewhistoryreservationdisplay").html(data);
	      }
	    })
	}

	function getdatetoday()
	{
		var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = (month)+"-"+(day)+"-"+now.getFullYear();
	}

	function loadallpaymentlist(){
	  	var page = $("#txtcurrentpage").val();
	  	$.ajax({
	    	type: 'POST',
	    	url: 'mainclass.php',
	    	data: 'page=' + page + '&form=showreservationpaymentlist',
	    	success:function(data){
	    	  $("#reservationpaymentlist").html(data);
	    	  loadpaymentlisentries();
	    	  loadpaymentlistpagination();
	    	}
	  	})
	}

	function showpaymentlist(){
		loadallpaymentlist();
		$("#modalpaymentlist").modal("show");
		var id = $("#invi").val();
		$.ajax ({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + id + '&form=searchids',
			success:function(data) {
				$("#fortblpaymentlist").val(data.trim());
				checkSelected4();
			}
		})
	}

	function checkSelected4() 
	{
		var allselected = $("#fortblpaymentlist").val();
		var arr = allselected.split("|");
		
		for ( var a = 0; a <= arr.length; a++ ) {
			$(".ids" + arr[a]).attr("checked", true);
		}
	}

	function savereservationfee(){
		var ids = "";
		$(".chkpayment").each(function(){
	    	if ( $(this).is(":checked") == true ) {
				ids += this.value+"|";			}
	    })
		var inquiryID = $("#invi").val();
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'ids=' + ids + '&inquiryID=' + inquiryID + '&form=savereservationfee',
			success:function(data){
				var arr = data.split("|");
				if(arr[0] == "1"){
					showmodal("alert", "Payment added Successfully.", "uponclosingofsavenotification", null, "", null, "0");
					$("#reservation_stat_select").val(arr[3]);
					trappayment(arr[1], arr[2], arr[3]);
				}else{
					showmodal("alert", "Insufficient balance.", "", null, "", null, "0");
				}
			}
		})
	}

	function uponclosingofsavenotification(){
		$("#modalpaymentlist").modal("hide");
		loadreservationlist();
	}

	function loadpaymentlisentries(){
	    var page = $("#txtcurrentpage").val();

	    $.ajax({
	        type: 'POST',
	        url: 'mainclass.php',
	        data: 'page=' + page + '&form=loadpaymentlisentries',
	        success: function(data){
	            if(data == "no data"){
	                $("#txtpaymentlistcounts").text("");
	            }
	            else{
	                $("#txtpaymentlistcounts").text(data);
	            }
	        }
	    });
	}

	function loadpaymentlistpagination(){
	    var page = $("#txtcurrentpage").val();

	    $.ajax({
	        type: 'POST',
	        url: 'mainclass.php',
	        data: 'page=' + page + '&form=loadpaymentlistpagination',
	        success: function(data){
	            $("#ulpaginationpaymentlist").html(data);
	        }
	    });
	}

	function paginationforpaymentlist(page, pagenums){
	    $(".pgnumofpaymentlist").removeClass("active");
	    var value = "#" + pagenums;
	    $("#pgpaymentlist" + pagenums).addClass("active");
	    $("#txtcurrentpage").val(page);
	    loadallpaymentlist();
	    loadpaymentlistpagination();
	    showpaymentlist();
	}

</script>
<style>
tbody tr td { cursor: hand !important; cursor: pointer !important; }
a { cursor: hand !important; cursor: pointer !important; }
</style>
<div id="statussavingreservation"></div>
<div class="page-header row" style="padding-bottom: 0px;">
    <div class="row form-group" style="margin-bottom: 10px;padding-top:10px;background-color: #edf4f8;">
    <!-- <input type="text" id="jxnjdncdj" name=""> -->
        <div class="col-md-2 col-xs-12">
            <h1 style="font-weight: bold;">RESERVATION</h1>
            <h6 style="color:#2679B5;">&nbsp;&nbsp;&nbsp;List of Reservations</h6>
            <input type="hidden" id="txtinquirypages" name="">
        </div>
        <div class="col-md-5">
        </div>
        <div class="col-md-3 col-xs-12" style="padding-bottom: 10px;padding-top: 10px;">
      		<span>All Status:</span>&nbsp;
            <label class='label label-sm' style="background-color: #925c92;color: white;">Tentative</label>
            <label class='label label-sm' style="background-color: #82AF6F;color: white;">Confirmed</label>
            <label class='label label-sm' style="background-color: #F89406;color: white;">Occupied</label>
            <label class='label label-sm' style="background-color: #D15B47;color: white;">Cancelled</label>	
    	</div>
    <div class="col-md-2" style="padding-bottom: 10px;padding-top: 10px;">
        <a href="#" id="btn_inquiry" class="btn btn-white btn-success btn-sm" style="width: 100% !important;" onclick="selectnav(7)"><i class="ace-icon fa fa-calendar-o"></i>&nbsp;&nbsp;View Calendar</a>
    </div> 
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<div class="row form-group" style="margin-bottom: 0px;">
            <div class="col-md-2 col-xs-12" style="padding-bottom: 5px;padding-left: 0px;">
                <span class="input-icon" style="width: 100%;">
                    <input type="text" class="form-control" placeholder="Search" title="Search according to filter selected" id="txtsearchreservation" onkeyup="loadreservationlist()">
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                </span>
            </div>
            <div class="col-md-6" style="padding-bottom: 5px;padding-left:0px;" id="">
        		<h5><a onclick="loadfilters_inquiry('Reservation')" id="LINK_inquiry_filter" style="" class="popover-info" data-rel="popover" data-placement="bottom" title="Filter by" data-content='
        		<fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;margin-top: 0px;">
				<legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:95px;">&nbsp;&nbsp;Select Filter&nbsp;&nbsp;</legend>
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
				<fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;">
				<legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:105px;">&nbsp;&nbsp;Select Status&nbsp;&nbsp;</legend>
					<div class="form-group row" style="margin:0px;">
					  <div class="col-md-3">
					    <label class="label label-success" style="margin-bottom: 0px;height:22px;background-color: #925c92;padding-left:4px;">
					      <input name="form-field-checkbox2" class="ace filter_reservation" type="checkbox" value="Tentative" id="filter_Tentative">
					      <span class="lbl"> Tentative</span>
					    </label>  
					  </div>
					  <div class="col-md-3">
					    <label class="label label-success" style="margin-bottom: 0px;height:22px;padding-left:4px;">
					      <input name="form-field-checkbox2" class="ace filter_reservation" type="checkbox" value="Confirmed" id="filter_Confirmed">
					      <span class="lbl"> Confirmed</span>
					    </label>  
					  </div>
					  <div class="col-md-3">
					    <label class="label label-warning" style="margin-bottom: 0px;height:22px;padding-left:4px;">
					      <input name="form-field-checkbox2" class="ace filter_reservation" type="checkbox" value="Occupied" id="filter_Occupied">
					      <span class="lbl"> Occupied</span>
					    </label>  
					  </div>
					  <div class="col-md-3">
					    <label class="label label-danger" style="margin-bottom: 0px;height:22px;padding-left:4px;">
					      <input name="form-field-checkbox2" class="ace filter_reservation" type="checkbox" value="Cancelled" id="filter_Cancelled">
					      <span class="lbl"> Cancelled</span>
					    </label>  
					  </div>  
					</div>
				</fieldset>
				<fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;background-color:#f5f5f0;" id="div_chkoccdate">
				<legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:130px;">&nbsp;&nbsp;Occupancy Date&nbsp;&nbsp;</legend>
					<div class="form-group row" style="margin:0px;">
  						<div class="col-md-1">
  							<label style="margin-top:5px;">
						        <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox" value="" id="chkoccdate" onclick="chkoccdate();loadreservationlist();">
						        <span class="lbl"></span>
					    	</label>
  						</div>
						<div class="col-md-5">
							<div class="input-group">
							  <span class="input-group-addon">
							    <i class="fa fa-calendar bigger-110"></i>
							  </span>
							  <input class="form-control div_occ date-picker" type="text" name="" id="txtdiv_strtocc" data-provide="datepicker" disabled>
							</div>   							
						</div>
						<div class="col-md-5">
							<div class="input-group">
							  <span class="input-group-addon">
							    <i class="fa fa-calendar bigger-110"></i>
							  </span>
							  <input class="form-control div_occ date-picker" type="text" name="" id="txtdiv_endocc" data-provide="datepicker" disabled>
							</div>   							
						</div>  						
					</div>
				</fieldset>
				<fieldset style="margin: 8px;border: 1px dotted #CCC;padding: 8px;" id="div_chkappdate">
				<legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:120px;">&nbsp;&nbsp;Approved Date&nbsp;&nbsp;</legend>
					<div class="form-group row" style="margin:0px;">
  						<div class="col-md-1">
  							<label style="margin-top:5px;">
						        <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox" value="" id="chkappdate" checked="true" onclick="chkappdate();loadreservationlist();">
						        <span class="lbl"></span>
					    	</label>
  						</div>
						<div class="col-md-5">
							<div class="input-group">
							  <span class="input-group-addon">
							    <i class="fa fa-calendar bigger-110"></i>
							  </span>
							  <input class="form-control div_app date-picker" type="text" name="" id="txtdiv_strtapp" data-provide="datepicker">
							</div>   							
						</div>
						<div class="col-md-5">
							<div class="input-group">
							  <span class="input-group-addon">
							    <i class="fa fa-calendar bigger-110"></i>
							  </span>
							  <input class="form-control div_app date-picker" type="text" name="" id="txtdiv_endapp" data-provide="datepicker">
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
							Click "<b>OK</b>" to filter data and permanently save the filter selected.
						</div>
					</div>
					<div class="col-md-3">
						<button class="btn btn-xs btn-info" onclick="savefilter()" style="float:right;margin-bottom:10px;margin-right:10px;width:80px;">
						    OK
						</button>
					</div>
				</div>
				'>
			<i class="fa fa-filter bigger-110"></i>&nbsp;&nbsp;Select Filter here</a></h5>
      		</div>
      		<div class="col-md-4"></div>
		</div>
		<div class="row form-group" style="margin-bottom: 0px !important;">
			<div class="parent2">
				<table id="simple-table" class="table  table-bordered table-hover fixTable">
                    <thead>
                        <tr>
                        	<td class="hide_mobile" width="5%"></td>
                            <td class="hide_mobile">Store Name</td>
                            <td class="scroll">Company</td>
                            <td class="scroll">Unit</td>
                            <td class="scroll">Unit Type</td>
                            <td class="hide_mobile">Floor No.</td>
                            <td class="hide_mobile">Wing</td>
                            <td class="hide_mobile">Start Date</td>
                            <td class="hide_mobile">End Date</td>
                            <td class="hide_mobile">Res. Status</td>
                            <td class="scroll">Option</td>
                
                        </tr>
                    </thead>
                    <div class="" id="status_load_reservations"></div>
                    <tbody id="tblreservationlist"></tbody>
                </table>
			</div>
	        <table class="tabledash_footer table" style="margin: 0px !important;">
	            <thead>
	                <tr>
	                    <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-top: 15px;padding-bottom: 15px;">
	                    <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtresrvationentries"><br /></font>
	                        <input type="hidden" id="txtreservationpages" name="">
	                         <ul id="ulreservationpagination" class="pagination pull-right"></ul>
	                    </th>
	                </tr>
	            </thead>
	        </table>
		</div>
	</div>
</div>

<div class="modal fade" id="viewhistoryreservation" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" style="width: 1200px;">

    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header btn-primary" style="margin-bottom: 10px;padding-top:10px;padding-bottom: 10px;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Log History</h4>
        <input type="hidden" id="inqidnglogsreservation">
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
                  <tbody id="viewhistoryreservationdisplay"></tbody>
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

<div class="modal fade" id="modalpaymentlist" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  	<div class="modal-dialog modal-lg">
    	<div class="modal-content">

	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">List of Payments</h4>
	      	</div>

		    <div class="modal-body" style="" id="modal-body-leasingapp2">
		  		<div class="row form-group">
		  			<div class="parent" style="margin-bottom: -40px;">
		  				<table class="table table-bordered table-striped fixTable">
		  					<thead>
		  						<tr>
		  							<td></td>
		  							<td>Date of Payment</td>
		  							<td>Description</td>
		  							<td>O.R No.</td>
		  							<td>Payment Type</td>
		  							<td>Total Amount</td>
		  						</tr>
		  					</thead>
		  					<tbody id="reservationpaymentlist"></tbody>
		  				</table>
		  			</div>
		  			<table class="tabledash_footer table" style="margin: 0px !important;">
			          	<thead>
			              	<tr>
			                  	<th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
			                      	<div class="row">
			                          	<div class="col-md-6">
			                              	<label style="color: #FFF; float: center; margin-left: 10px; margin-top: 10px;" id="txtpaymentlistcounts"></label>
			                          	</div>                               
			                          	<div class="col-md-6">
			                              	<input type="hidden" id="txtcurrentpage" class="form-control input-sm" style="width: 5%; text-align: center;">
			                              	<ul id="ulpaginationpaymentlist" class="pagination pull-right"></ul>
			                          	</div>
			                      	</div>
			                  	</th>
			              	</tr>
			          	</thead>
			        </table>
		  		</div>  	    
		    </div>

	      	<div class="modal-footer">
	          <button class="btn btn-md btn-primary" onclick="savereservationfee()">Add Payment</button>
	      	</div> 
    	</div>
  	</div>
</div>
<input type="hidden" id="txtcurrentpage">
<input type="hidden" id="fortblpaymentlist">
<script>
	//datepicker plugin
	//link

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
	// 	'applyClass' : 'btn-sm btn-success',
	// 	'cancelClass' : 'btn-sm btn-default',
	// 	locale: {
	// 		applyLabel: 'Apply',
	// 		cancelLabel: 'Cancel',
	// 	}
	// })
	// .prev().on(ace.click_event, function(){
	// 	$(this).next().focus();
	// });	

    $('[data-rel=tooltip]').tooltip();
    $('[data-rel=popover]').popover({html:true});

</script>
<?php 
include("modal_reservation_application.php"); 
include("modal_reservation_contract.php");
include("modal_reservation_contract_tenantidgen.php");
include("modal_view_requirements.php"); 
include("modal_termsandcondition.php"); 
include("printcontract.php");
include("modal_add_remarks.php");
include("../inquiry/modal_shortcut_unit.php");
include("../inquiry/kevinMscript.php");
?>