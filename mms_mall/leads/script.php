<?php include('modal_leads.php'); ?>
<?php include('../alert_modal/modal.php'); ?>

<script src="assets/dist/easyzoom.js"></script>
<script type="text/javascript">

   function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }


 $(document).ready(function(e) {
        $('.EmailPo').each(function(){
            $(this).focusout(function() {
                var sEmail = $(this).val();
                
                if ($.trim(sEmail).length == 0) {
                    // $(this).focus();
                    // $(".errohere").text("Please enter valid email address");
                    // alert('Please enter valid email address');
                    $("#spanMo").text("");
                    $("#spanMo4").text("");
                    e.preventDefault();
                }
                if (validateEmail(sEmail)) {
                    $("#spanMo").text("");
                     $("#spanMo4").text("");
                    // alert('Email is valid');
                    // Nothing happens...
                }
                else {
                    $(this).focus();
                     $("#spanMo").text("Invalid Email Address");
                       $("#spanMo4").text("Invalid Email Address");
                    // alert('Invalid Email Address');
                    e.preventDefault();
                }
            });
        });
    });


$(function(){

	$('[data-rel=tooltip]').tooltip();
    $('[data-rel=popover]').popover({html:true});

    $('.CpNum').keyup(function () { 
     if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
       this.value = this.value.replace(/[^0-9\.]/g, '');
    }
	});

	 $('.TNum').keyup(function () { 
     if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
       this.value = this.value.replace(/[^0-9\.]/g, '');
    }
	});

	
	$(".CpNum").each(function(){
		$(this).focusout(function(){
			var numCp = $(this).val().length;
		
			if(numCp == 11 || numCp == 0){
				   $("#spanMoKo").text("");
				    $("#spanMoKo2").text("");
			
			}
			else{
			  $(this).focus(); 
			  $("#spanMoKo").text("Invalid Mobile Number");
			  $("#spanMoKo2").text("Invalid Mobile Number");
			}
		});
	});

		$(".TNum").each(function(){
		$(this).focusout(function(){
			var numCp = $(this).val().length;
		
			if(numCp == 7 || numCp == 0){
				   $("#spanMoKo1").text("");
				   $("#spanMoKo3").text("");
			
			}
			else{
			  $(this).focus(); 
			  $("#spanMoKo1").text("Invalid telephone Number");
			  $("#spanMoKo3").text("Invalid telephone Number");
			}
		});
	});



$("#txt_userpage").val("1");
loadfilters_leads('Leads');
tblLeads();
loadRemarks();
Occu();


});

$(document).ready(function() {
        $(".fixTable").tableHeadFixer();
  });
	
function loadmodal_leads(){

$("#bwiset").modal("show");



}

function closeleadsModal(){

	$("#bwiset").modal("hide");
}

function deleteMe(){
alert();

}

function loadtradefunction()
{
  var mallid = $("#txtinq_mallbranch").val();
  if(mallid == undefined)
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


function saveleads(){

	 
	var	firstName = $("#firstName").val();
	var	Mname = $("#Mname").val();
	var	Lname = $("#Lname").val();
	var	Occu = $("#Occu").val();
	var	Cnum = $("#Cnum").val();
	var	Tnum = $("#Tnum").val();
	var	Addr = $("#Addr").val();
	var	email = $("#email").val();

	$.ajax({
		type: 'POST',
		url: 'leads/class.php',
		data: 	'firstName=' +firstName+
				'&Mname=' +Mname+
				'&Lname=' +Lname+
				'&Occu=' +Occu+
				'&Cnum=' +Cnum+
				'&Tnum=' +Tnum+
				'&Addr=' +Addr+
				'&email=' +email+
				'&form=saveleads',
		success: function (data){
			$("#bwiset").modal("hide");
			tblLeads();
		


		}			


	});


}

function tblLeads(){
	var txtlead = $("#txtlead").val();
	var page = $("#txt_userpage").val();
	var leadsID = $("#leadsID").val();
	
	$.ajax({
		type: 'POST',
		url:  'leads/class.php',
		data: 'page=' +page+
			  '&txtlead=' +txtlead+
			  '&leadsID=' +leadsID+
			  '&form=tblLeads',
		success: function (data){

			$("#tblLeads").html(data);
			loadpaginationuser();
			loadentriesuser();
		}


	});

}

function loadpaginationuser(){
        
        var page = $("#txt_userpage").val();
       

        $.ajax({
            type: 'POST',
            url: 'leads/class.php',
            data: 'page='+page+
                  '&form=loadpaginationuser',
            success: function(data){
                $("#ulpaginationitemlist").html(data);
            }
        });
 }

 function getvaluser(page, pagenums){
        $(".pgnumptnts").removeClass("active");
        var value = "#" + pagenums;
        $("#pgptnts" + pagenums).addClass("active");
        $("#txt_userpage").val(page);
        // reloadhmo();
        tblLeads();
        loadpaginationuser();
        loadentriesuser();
    }

    function loadentriesuser(){
        var page = $("#txt_userpage").val();
        

        $.ajax({
            type: 'POST',
            url: 'leads/class.php',
            data: 'page='+page+
            '&form=loadentriesuser',
            success: function(data){
                if(data == ""){
                    $("#txtitemlistentries").html("<br />");
                }
                else{
                    $("#txtitemlistentries").text(data);
                }
            }
        });
    }

function viewLeads(firstName, middleName, lastName, occupation, id, mobile, telephone, email, address, status){



	var	firstName1 = $("#firstName1").val(firstName);
	var	Mname1 = $("#Mname1").val(middleName);
	var	Lname1 = $("#Lname1").val(lastName);
	var	Occu1 = $("#Occu1").val(occupation);
	var userID = $("#userID").val(id);
	var leadsID = $("#leadsID").val(id);
	var	Cnum1 = $("#Cnum1").val(mobile);
	var	Tnum1 = $("#Tnum1").val(telephone);
	var	Addr1 = $("#Addr1").val(email);
	var	email1 = $("#email1").val(address);
	$("#btn_savenewremark").attr("onclick", "savenewremark(\""+id+"\")");

	if(status == 'Denied'){
		$("#btn_unblockLeads").show();
		$("#btn_CancelLeadsTo").hide();
		$("#btn_enableleads").show();
	}else if(status == 'Approved'){
		$("#btn_unblockLeads").hide();
		$("#btn_CancelLeadsTo").show();
		$("#btn_enableleads").show();

	}else if(status == 'Pending'){
		$("#btn_unblockLeads").hide();
		$("#btn_CancelLeadsTo").show();
		$("#btn_enableleads").show();

	}

	$("#view_leads").modal("show");
	
	
	loadRemarks();
	Rleads();
}

function closeUpdate(){

	$("#view_leads").modal("hide");
	$("#btn_Editleads").hide();
	$("#btn_Cancelleads").hide();
	
}

function UpdateLeads(){

	$("#Haha input").removeAttr("readonly");
	$("#Hoho input").removeAttr("readonly");
	$("#Occu1").removeAttr("disabled");

	$("#btn_Editleads").show();
	$("#btn_Cancelleads").show();
	$("#btn_enableleads").hide();
	$("#btn_CancelLeadsTo").hide();
	$("#btn_unblockLeads").hide();
	
	
	

}

function CancelEdit(){

	$("#Haha input").prop("readonly", true);
	$("#Hoho input").prop("readonly", true);

	$("#btn_Editleads").hide();
	$("#btn_Cancelleads").hide();
	$("#btn_enableleads").show();
	$("#btn_CancelLeadsTo").hide();


}

function EditLeads(){

	$("#Haha input").prop("readonly", true);
	$("#Hoho input").prop("readonly", true);
	$("#Occu1").prop("disabled", true);


	$("#btn_Editleads").hide();
	$("#btn_Cancelleads").hide();
	$("#btn_enableleads").show();
	$("#btn_CancelLeads").show();

	var	firstName1 = $("#firstName1").val();
	var	Mname1 = $("#Mname1").val();
	var	Lname1 = $("#Lname1").val();
	var	Occu1 = $("#Occu1").val();
	var userID = $("#userID").val();
	var	Cnum1 = $("#Cnum1").val();
	var	Tnum1 = $("#Tnum1").val();
	var	Addr1 = $("#Addr1").val();
	var	email1 = $("#email1").val();

	$.ajax({
		type: 'POST',
		url: 'leads/class.php',
		data: 'firstName1=' +firstName1+
			  '&Mname1=' +Mname1+
			  '&Lname1=' +Lname1+
			  '&Occu1=' +Occu1+
			  '&userID=' +userID+
			  '&Cnum1=' +Cnum1+
			  '&Tnum1=' +Tnum1+
			  '&Addr1=' +Addr1+
			  '&email1=' +email1+
			  '&form=EditLeads',
		success: function (data){
			tblLeads();
			$("#view_leads").modal("hide");
		},complete: function(){

			$("#div_modal_inquiry_requirements").css("border-color", "#d5d5d5");
                  
                    $(".form_lease_application_req").each(function(){
                        var this_id = $(this).attr("id");
                     	sendData(this_id);
                    })
		}
	});
	
}

function sendData(formid){
    var data = new FormData($('#'+formid)[0]);
    $.ajax({
      type:"POST",
      url:"leads/upload_class.php",
      data: data,
      mimeType: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
      

       // loadrequirements(inqid, appid);
        // closemodal("uploadattach");
      }
    });
 }

function transToInq(leadTo, stat, pBar){

showmodal("confirm", "Are you sure you want to approve this?", "stat(\""+leadTo+"\", \""+stat+"\", \""+pBar+"\")", null, "stat(\"No\")", null, "0");
}

function stat(haha, stat, pBar){

	if(haha == 'No'){
		$("#alertmodal").modal("hide");
	}else {
		if(stat == 'Denied'){
			showmodal("alert", "This user is blocked.", "okPo()", null, null, "1");

		}else if(stat == 'Approved'){
			showmodal("alert", "This user is already Approved.", "okPo()", null, null, "1");

		}else{	

			if(pBar < '4'){

				showmodal("alert", "Requirements are not yet complete", "okPo()", null, null, "1");


			}else{

				$.ajax({
			type: 'POST',
			url: 'leads/class.php',
			data: 'haha=' +haha+
					'&form=ApproveStat',
			success: function(data){
				$("#alertmodal").modal("hide");
					tblLeads();
			
				
			}	
		});

			}

			
		}
	}
	
}

function okPo(){
	$("#alertmodal").modal("hide");	
}

function cancelLeads(){

var userID = $("#userID").val();

showmodal("confirm", "Are you sure you want to block this?", "cancelTo(\""+userID+"\")", null, "cancelTo(\"No\")", null, "0");

}

function cancelTo(leadsID){


	if(leadsID == 'No'){
		$("#alertmodal").modal("hide");
	}else {

		$.ajax({
			type: 'POST',
			url: 'leads/class.php',
			data: 'leadsID=' +leadsID+
					'&form=cancelTo',
			success: function(data){
				
				$("#view_leads").modal("hide");
				$("#alertmodal").modal("hide");
				tblLeads();


			}

		});


	}

}

function unblockLeads(){

	var userID = $("#userID").val();

	$.ajax({
		type: 'POST',
		url: 'leads/class.php',
		data: 'userID=' +userID+
			  '&form=unblockLeads',
		success: function (data){
			$("#view_leads").modal("hide");
			tblLeads();

		}	  


	});
}

function addnewremarks()
    {
      $("#modal_new_remarks").modal("show");
      $("#txtinq_remarks2").val("");
      $("#txtremID").val("");
      $("#remtext_cont").text("New Remarks");


    }

 function closenewremarkmodal(){

 	$("#modal_new_remarks").modal("hide");

 } 

 function Rleads(){

 	var userID = $("#userID").val();

	$.ajax({
 		type: 'POST',
 		url: 'leads/class.php',
 		data: 'userID=' +userID+
 			  '&form=Rleads',
 		success: function (data){
		
			$("#div_req_passed").html(data);
 		}, complete: function(){
 			uploadrequirementscss();
 		}		  


 	});


 }  

 function chkclippeddocx(thisfile)
{
  var sel = "";
  $(".form_lease_application_req").each(function(){
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

        $(".form_lease_application_req").each(function(){
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

function savenewremark(id){

	var txtArea = $("#txtinq_remarks2").val();

	if(txtArea == ''){
		showmodal("alert", "Please enter remarks field.", "", null, "", null, "1");
	}else{

	$.ajax({
		type: 'POST',
		url: 'leads/class.php',
		data: 'id=' +id+
		       '&txtArea=' +txtArea+
		       '&form=savenewremark',
		success: function (data){
			$("#modal_new_remarks").modal("hide");
			loadRemarks();

		}       

	});

	}



}

function load_req_image1(url)
  {
    $("#content_img").html("<div class='easyzoom easyzoom--overlay easyzoom--with-toggle'><a id='img_viewed2' href='"+url+"'><img id='img_viewed' src='"+url+"' alt=' width='100%' height='380' /></a></div>");
    funczoom(url);
  }

  function funczoom()
  {
    $("#modal_view_image").modal("show");
      var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.html("<i style='color:white !important;' class='ace-icon fa fa-search-plus bigger-120'></i>").data("active", false);
                api2.teardown();
            } else {
                $this.html("<i style='color:white !important;' class='ace-icon fa fa-search-minus bigger-120'></i>").data("active", true);
                api2._init();
            }
        });
  }

function loadRemarks(){

var userID = $("#userID").val();

	$.ajax({
		type: 'POST',
		url: 'leads/class.php',
		data: 'userID=' +userID+
				'&form=loadRemarks',
		success : function (data){
			$("#remarkslist_ol").html(data);
		}		

	});

}
 
function Occu(){

$.ajax({
	type: 'POST',
	url: 'leads/class.php',
	data: '&form=Occu',
	success: function (data){
		$("#Occu").html(data);
		$("#Occu1").html(data);
	}

	});

}
// codes for email validation

  function loadfilters_leads(module){

            $.ajax({
                type: 'POST',
                url: 'leads/class.php',
                data: 'module=' + module + '&form=loadfilters_leads',
                success: function(data){
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
                    $("#contractstart").val(arr2[0]);
                    $("#contractend").val(arr2[1]);
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
                    tblLeads();
                }
            })
        }


 function saveleadsfilter(){
        var module = "Tenant";
        var checked = "";
        $('input:checkbox[name="form-field-checkboxtttttttt"]').each(function(){
            if($(this).is(":checked")){
                var value = $(this).attr("value");
                checked += value + "|";
            }
        })

        var checked2 = "";
        $('input:checkbox[name="form-field-checkboxtttttttt"]').each(function(){

                var value2 = $(this).attr("value");
                checked2 += value2 + "|";
        })

        var checked3 = "";
        $('input:checkbox[name="form-field-checkbox-stado"]').each(function(){
          if($(this).is(":checked"))
          {
            var value3 = $(this).attr("value");
            checked3 += value3 + "|";
          }
        })  

        var tstatus = "";
        $('input:checkbox[name="form-field-checkbox-tstatus"]').each(function(){
          if($(this).is(":checked"))
          {
            var value3 = $(this).attr("value");
            tstatus += value3 + "|";
          }
        })
        var contractstart = $("#contractstart").val();
        var contractend = $("#contractend").val();

        $.ajax({
            type: 'POST',
            url: 'leads/class.php',
            data: 'module=' + module + '&checked=' + checked + '&checked2=' + checked2 + '&checked3=' + checked3 + '&tstatus=' + tstatus + '&contractstart=' + contractstart + '&contractend=' + contractend + '&form=saveleadsfilter',
            success: function(data){
                loadfilters_leads(module);
                $("#LINK_leads_filter").click();
            }
        })
    }        
   

 





</script>