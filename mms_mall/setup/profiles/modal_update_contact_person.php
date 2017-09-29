<div class="modal fade" role="dialog" id="edit_contactperson_modal">
	<div class="modal-dialog modal-lg" style="width: 85%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="" style="color: white !important;">Contact Person</h4>
			</div>
			<div class="modal-body">
            <input type="hidden" id="div_type_id" name="">
				<div class="row form-group" style="display: block;" id="">
					<div class="col-md-2 col-xs-12" style="padding:10px;padding-top: 0px;">
                		<div class="image">
                        	<img class="img-thumbnail imageName form-control" src="assets/images/avatars/noimage.png" id="imgtradeaccount_update" style="border: 2px solid #bdc3c7; margin-bottom: 8px;height: 160px;">
                 		</div>
                 		<form name="posting_profilepic_contactperson" id="posting_profilepic_contactperson" >
                 		  <div style="display: none;"><input type="text" id="trade_hidden_custid_update" name="contactID"><input type="text" id="trade_hidden_custid_update_company" name="companyID"></div>
                 		    <input id="file_upload_trade_update" name="file_upload_trade_update" class="form-control upload" type="file" onchange="showimgtrade_update();" />
                 		</form>
               		</div>
                    <div class="col-xs-12 col-md-5">
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-4">
                                Contact Name
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" class="form-control" name="" placeholder="First Name" id="txtcontact_fname_update">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-4">
                                
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" class="form-control" name="" placeholder="Middle Name" id="txtcontact_mname_update">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-4">
                                
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" class="form-control" name="" placeholder="Last Name" id="txtcontact_lname_update">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-4">
                                Company Position
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <div class="input-group">
                                    <select class="form-control" id="txtcontact_designation_update"></select>
                                    <div class="spinbox-buttons input-group-btn">         
                                      <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="loadreferentialmodal('position')">            
                                        <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                      </button>       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-5">
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-4">
                                Address
                            </div>
                            <div class="col-xs-12 col-md-8">
                        		<span class="input-icon" style="width: 100%;">
                        		    <input type="text" style="background-color: white !important;" class="form-control home-address" name="" id="txtcontact_address_update" onclick="loadaddressmodal('txtcontact_address_update')" onkeyup="loadaddressmodal('txtcontact_address_update')" placeholder="Click to add address..." readonly="">
                        		<i class="ace-icon fa orange" id="txtcontact_address_update_icon"></i>
                        		</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-4">
                                Email Address
                            </div>
                            <div class="col-xs-12 col-md-8" id="div_add_contact_person_email_update">
                                <div class="input-group">
                                  <input type="text" id="div_add_contact_person_email_update" class="spinbox-input form-control email-address" placeholder="sample@yahoo.com">
                                    <div class="spinbox-buttons input-group-btn">         
                                      <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('div_add_contact_person_email_update', 'emailaddress')">            
                                        <i class="icon-only ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                      </button>       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-md-4">
                                Mobile No
                            </div>
                            <div class="col-xs-12 col-md-8" id="div_add_contact_person_mobile_update">
                                <div class="input-group">
                                  <input type="text" id="div_add_contact_person_mobile_update" class="spinbox-input form-control input-mask-phone" maxlength="11" placeholder="(999)-999-9999">
                                    <div class="spinbox-buttons input-group-btn">         
                                      <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('div_add_contact_person_mobile_update', 'input-mask-phone')">            
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
                            <div class="col-xs-12 col-md-8" id="div_add_contact_person_tele_update">
                                <div class="input-group">
                                  <input type="text" id="div_add_contact_person_tele_update" class="spinbox-input form-control input-mask-tele" maxlength="11" placeholder="(99)-999-9999">
                                    <div class="spinbox-buttons input-group-btn">         
                                      <button type="button" class="btn spinbox-up btn-sm btn-success" onclick="div_add_field('div_add_contact_person_tele_update', 'input-mask-tele')">            
                                        <i class="icon-only  ace-icon ace-icon fa fa-plus bigger-110"></i>          
                                      </button>       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="modal-footer" id="">
				<button type="button" class="btn btn-primary" id="btn_savecontactperson" onclick=""><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(function(){
		loadcompanyposition_update();
	});
	
	function editthiscontactperson(idnum, comid)
	{
        $("#trade_hidden_custid_update").val("");
        $("#trade_hidden_custid_update_company").val("");
        $("#btn_savecontactperson").attr("onclick", "savecontactperson_update(\""+idnum+"\", \""+comid+"\")");
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + idnum + '&form=editthiscontactperson',
			success: function(data)
			{
				var arr = data.split("|");
				$("#edit_contactperson_modal").modal("show");
				$("#imgtradeaccount_update").attr("src", arr[7]);
				$("#txtcontact_fname_update").val(arr[0]);
				$("#txtcontact_mname_update").val(arr[1]);
				$("#txtcontact_lname_update").val(arr[2]);
				$("#txtcontact_designation_update").val(arr[5]);
				$("#txtcontact_address_update").val(arr[6]);	
				telno();			
			}
		});

		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'id=' + idnum + '&form=editthiscontactperson_contacts',
			success: function(data)
			{
                var arr = data.split("#|")
				$("#div_add_contact_person_email_update").html(arr[0]);
                $("#div_add_contact_person_mobile_update").html(arr[1]);
                $("#div_add_contact_person_tele_update").html(arr[2]);
			}
		});
    }

    function savecontactperson_update(idnum, comID)
    {
        var fname_update = $("#txtcontact_fname_update").val();
        var mname_update = $("#txtcontact_mname_update").val();
        var lname_update = $("#txtcontact_lname_update").val();
        var designation_update = $("#txtcontact_designation_update").val();
        var address_update = $("#txtcontact_address_update").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + idnum + '&fname=' + fname_update + '&mname=' + mname_update + '&lname=' + lname_update + '&designation=' + designation_update + '&add=' + address_update + '&form=savecontactperson_update',
            success: function(data)
            {
                if(data == 1)
                {
                    showmodal("alert", "Successfully Modified.", "", null, "", null, "0");
                }
            }
        });

        var div_add_contact_person_email_update = "";
        $("#div_add_contact_person_email_update input").each(function(){
            var this_value = $(this).val();
            if (!this_value.match(/^\s*$/) || this_value != "")
                {
                    div_add_contact_person_email_update += this_value + "|";                    
                }

        });
        var div_add_contact_person_mobile_update = "";
        $("#div_add_contact_person_mobile_update input").each(function(){
            var this_value = $(this).val();  
            if (!this_value.match(/^\s*$/) || this_value != "")
                {
                    div_add_contact_person_mobile_update += this_value + "|";       
                }   
        });
        var div_add_contact_person_tele_update = "";
        $("#div_add_contact_person_tele_update input").each(function(){
            var this_value = $(this).val(); 
            if (!this_value.match(/^\s*$/) || this_value != "")
                {
                    div_add_contact_person_tele_update += this_value + "|"; 
                }  
        });

        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + idnum + '&email_update=' + div_add_contact_person_email_update + '&mobile_number=' + div_add_contact_person_mobile_update + '&tel_number=' + div_add_contact_person_tele_update + '&form=savecontactperson_update_contactnum',
            success: function(data)
            {
                // alert(data)
            }
        });

        $("#trade_hidden_custid_update").val(idnum);
        $("#trade_hidden_custid_update_company").val(comID);
        var data = new FormData($('#posting_profilepic_contactperson')[0]);
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

    function loadexistingcontactpersons(idcomp)
    {
        var div = $("#div_type_id").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'companyID=' + idcomp + '&form=selectcontactpersons',
            success: function(data)
            {
                $("#"+div).html(data);
            }
        })
        
    }

    function setvaluediv()
    {
        $("#div_type_id").val("div_inquiry_contact_person");
    }

	function showimgtrade_update(){
	  var oFReader = new FileReader();
	  oFReader.readAsDataURL(document.getElementById("file_upload_trade_update").files[0]);
	      
	  oFReader.onload = function (oFREvent) {
	      document.getElementById("imgtradeaccount_update").src = oFREvent.target.result;
	  };
	}

	function loadcompanyposition_update()
	{
	    $.ajax({
	        type: 'POST',
	        url: 'mainclass.php',
	        data: 'form=loadcompanyposition',
	        success: function(data)
	        {
	            $("#txtcontact_designation_update").html(data);
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
                success: function(data)
                {
                    var arr = data.split("|");
                    if(arr[1] == "1")
                    {
                        sendprofilepic(arr[0]);   
                        alert(arr[2]);
                        $("#modal_new_company").modal("hide");
                        // loadcompanylist();
                        loadcompanylo();
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
</script>