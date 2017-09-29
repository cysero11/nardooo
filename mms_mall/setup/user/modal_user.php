<style>
	.myupload
	{
		border: dashed 1px #999;
		padding: 15px;
		display: block;
		margin: 10px;
	}
	
	.myupload h1
	{
		font-size: 18px;
		font-weight: 400 !important;
		color: #999;
		text-align: center;
		margin-top: 10px;
		margin-bottom: 20px;
	}
	
	.myupload input[type="file"]
	{ opacity: 0; }
</style>
<script>
	$(function(){
		var _URL = window.URL || window.webkitURL;
		loadgaccess();
        trappingforfields();
    		$("#saveuser").on('submit',(function(e) {
    			e.preventDefault();
    			$.ajax({
    				url: 'setup/user/save_user.php',
    				type: 'POST',
    				data: new FormData(this),
    				contentType: false,
    				cache: false,
    				processData: false,
    				beforeSend : function() {
                        $('#indexloadingscreen').addClass('myspinner');
                    },
                        success: function(data){
                        $('#indexloadingscreen').removeClass('myspinner');
    					var arr = data.split("|");
    					if(arr[1] == "1")
    					{
    						$("#modal_newuser").modal("hide");
    						showmodal("alert", arr[2], "", null, "", null, "0");
    						loadusers();
    					}
    					else if(arr[1] == "2"){
                            showmodal("alert", arr[2], "", null, "", null, "0");
                        }else
    					{ alert(arr[1]); }
    				}
    			}).error(function() {
    				alert(data);
    			});
    		}));
        $('.input-mask-phone').mask('(999) 999-9999');
	});
	
	function loadgaccess()
	{
		$.ajax({
			type: 'POST',
			url: 'setup/user/modal_mainclass.php',
			data: 'form=loadgaccess',
			beforeSend:function(){
			},
			success: function(data) {
				$("#txtgroupaccess").html(data);
			}
		}).error(function() {
			alert(data);
		});
	}
	
	function showimgggggg()
	{
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("txtfile").files[0]);
		
		oFReader.onload = function (oFREvent) {
			$("#img").css("display", "block");
			$("#txtspan").css("display", "none");
			$("#txtclick").css("display", "none");
			document.getElementById("img").src = oFREvent.target.result;
			$("#btnremovephoto").css("display", "inline-block");
		};
	}
	
	function removephoto()
	{
		$("#img").attr("src", "#");
		$("#img").css("display", "none");
		$("#txtspan").css("display", "block");
		$("#txtclick").css("display", "block");
		$("#txtfile").val("");
		$("#btnremovephoto").css("display", "none");
	}

    function trappingforfields() {
    $('.email-addressssssss').each(function(){
        var getid = $(this).attr("id");
        $(this).focusout(function() {
            var sEmail = $(this).val();
            if ($.trim(sEmail).length == 0) {
                // $(this).focus();
                // alert("Please enter valid email address");
                $(".errohere").text("");
                e.preventDefault();
            }
            if (validateEmail(sEmail)) {
                // $(".errohere").hide();
                // alert('Email is valid');
                // Nothing happens...
                $(".errohere").text("");
                $(this).css("border-color", "#b5b5b5");
            }
            else {
                // $(this).focus();
                // showmodal("alert", "Invalid Email Address.", "", null, "", null, "1");
                $(".errohere").text("Invalid Email Address");
                $(this).focus();
                // $(this).css("border-color", "orange");
                e.preventDefault();
            }
        });
    });

        $("#txtcpassword").focusout(function() {
            var firstpassword = $("#txtpassword").val();
            var password = $("#txtcpassword").val();
            if (firstpassword != password) {
                // $(".errohere").hide();
                // alert('Email is valid');
                // Nothing happens...
                // $(".errohere").text("");
                // $(this).css("border-color", "#b5b5b5");
                $(".errohere2").text("Password do not match");
                // $(this).focus();
                $("#txtpassword").focus();
                // e.preventDefault();
            }
            else {
                $(".errohere2").text("");
                // $(this).focus();
                // showmodal("alert", "Invalid Email Address.", "", null, "", null, "1");
                // $(".errohere").text("Invalid Email Address");
                // $(this).focus();
                // $(this).css("border-color", "orange");
                // e.preventDefault();
            }
        });
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
</script>
<div class="modal fade" role="dialog" id="modal_newuser" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header label-info">
            	<button type="button" class="close" data-dismiss="modal" onclick="clearuser()">&times;</button>
                <h4 class="modal-title" style="color: #FFF;"><label style="font-size: 18px; font-weight: 400;margin: 0;line-height: 1.42857143;" id="modalheader"></label></h4>
			</div>
            <form method="post" action="#" enctype="multipart/form-data" id="saveuser">
            <input type="hidden" id="txtuserid" name="txtuserid">
            <div class="modal-body">
            	<div class="row">
                	<div class="col-sm-3">
                    <h5><span style="color: red;">*</span> These fields are required</h5>
                    	<center>
                    	<label class="myupload">
                            <img class="img-responsive" src="#" id="img" style="display: none;">
                            <input type="file" name="txtfile" id="txtfile" onChange="showimgggggg();">
                            <span class="fa fa-cloud-upload" style="font-size: 60px; color: #999;" id="txtspan"></span>
                            <h1 id="txtclick">Click here to upload picture</h1>
                        </label>
                        <div class="btn btn-light" id="btnremovephoto" onclick="removephoto();" style="width: auto; display: none;"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Remove Photo</div>
                        </center>
                    </div>
                	<div class="col-sm-9" id="userfields">
                    	<div class="row">
                        	<div class="col-sm-5"></div>
                            <div class="col-sm-3" style="text-align: right;"><h5 style="color: #666; font-size: 14px;">User type <span style="color: red;">*</span></h5></div>
                            <div class="col-sm-4">
                                <select class="form-control" id="txtusertype" name="txtusertype" required="required">
                                	<option value="">Select user type </option>
                                	<option value="Admin">Admin</option>
                                	<option value="User">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                        	<div class="col-sm-5"></div>
                            <div class="col-sm-3" style="text-align: right;"><h5 style="color: #666; font-size: 14px;">Group Roles <span style="color: red;">*</span></h5></div>
                            <div class="col-sm-4"><select class="form-control" id="txtgroupaccess" name="txtgroupaccess" required="required"></select></div>
                        </div>
                        <hr style="margin: 10px;">
                        <div class="row">
                        	<div class="col-sm-6">
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Firstname <span style="color: red;">*</span></h5></div>
                                    <div class="col-sm-7"><input type="text" style="text-transform:capitalize;" class="form-control" id="txtfirstname" name="txtfirstname" required="required"></div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Middlename <span style="color: red;">*</span></h5></div>
                                    <div class="col-sm-7"><input type="text" style="text-transform:capitalize;" class="form-control" id="txtmiddlename" name="txtmiddlename" required="required"></div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Lastname <span style="color: red;">*</span></h5></div>
                                    <div class="col-sm-7"><input type="text" style="text-transform:capitalize;" class="form-control" id="txtlastname" name="txtlastname" required="required"></div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Contact No. <span style="color: red;">*</span></h5></div>
                                    <div class="col-sm-7"><input type="text" class="form-control input-mask-phone" id="txtcontactnumber" name="txtcontactnumber" required="required"></div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Gender</h5></div>
                                    <div class="col-sm-7">
                                        <div class="radio">
                                            <label>
                                                <input name="txtgender" type="radio" class="gender" checked="checked" value="Male">
                                                <span class="lbl">&nbsp;&nbsp;Male</span>
                                            </label>
                                            <label>
                                                <input name="txtgender" type="radio" class="gender" value="Female">
                                                <span class="lbl" style="padding-left: 5px;">&nbsp;&nbsp;Female</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        	<div class="col-sm-6">
                            	<div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Email <span style="color: red;">*</span></h5></div>
                                    <div class="col-sm-7"><input type="text" class="form-control email-addressssssss" id="txtemailaddress" name="txtemailaddress" required="required"><span class="errohere txtemailaddress" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Username <span style="color: red;">*</span></h5></div>
                                    <div class="col-sm-7"><input type="text" class="form-control" id="txtusername" name="txtusername" required="required"></div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Password <span style="color: red;">*</span></h5></div>
                                    <div class="col-sm-7"><input type="password" class="form-control" id="txtpassword" name="txtpassword" required="required"></div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Confirm Password <span style="color: red;">*</span></h5></div>
                                    <div class="col-sm-7"><input type="password" class="form-control" id="txtcpassword" name="txtcpassword" required="required"><span class="errohere2" style="color: red;"></span></div>
                                </div>
                                <div class="row" style="margin-top: 5px;">
                                    <div class="col-sm-5"><h5>Hint</h5></div>
                                    <div class="col-sm-7"><textarea class="form-control" id="txtpasswordhint" name="txtpasswordhint" style="resize: none;"></textarea></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer label-light">
                <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Save</button>
                <button class="btn btn-danger" onclick="clearuser();"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Cancel</button>
            </div>
            </form>
		</div>
	</div>
</div>