<script type="text/javascript">
	$(function(){
	        var _URL = window.URL || window.webkitURL;
	        
			loadsetup();
			printtemplate();
			printtemplate2();
			printtemplate3();
			printtemplate4();
			trap();
	        $("#savesetup").on('submit',(function(e) {
	            e.preventDefault();
	            var trapmachine = $("#hiddencount").val();
	            if(trapmachine != "1"){
	            $.ajax({
	                url: 'setup/systemsetup/savesetup.php',
	                type: 'POST',
	                data: new FormData(this),
	                contentType: false,
	                cache: false,
	                processData: false,
	                success: function(data) {
	                    var arr = data.split("|");
	                    if(arr[1] == "1")
	                    {
	                        showmodal("alert", arr[2], "", null, "", null, "0");
	                        loadsetup();
	                        loadcount();
	                    }
	                    else
	                    { alert(arr[1]); }
	                }
	            }).error(function() {
	                alert(data);
	            });
	        	}
	        	else{
	        		showmodal("alert", "Machine Number already existing.", "", null, "", null, "0");
	        	}
	        }));
	    });
		$(".disablemoko").prop("disabled", true);
		$('.input-mask-tele').mask('(99)-999-9999');
		$('.input-mask-phone').mask('(999) 999-9999');
		$(".numberlang").keydown(function (e){ 
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || 
				(e.keyCode == 65 && e.ctrlKey === true) ||  
				(e.keyCode >= 35 && e.keyCode <= 40)) { 
			 	return;
			} 
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}

		});

	function showimg(num)
    {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file" + num).files[0]);
        
        oFReader.onload = function (oFREvent) {
        document.getElementById("imgg" + num).src = oFREvent.target.result;
        };
    }

    function enableedit(){
    	var wards = $("#wards").val();

    	if(wards == "1"){
    		$("#wards").val("");
    		$(".disablemoko").attr("disabled", false);
	    	$("#pangedit").removeClass("glyphicon glyphicon-edit");
	    	$("#pangedit").addClass("glyphicon glyphicon-remove");
	    	$("#pangedit").css("color", "red");
    	}
    	else{
    		$("#wards").val("1");
    		$(".disablemoko").attr("disabled", true);
	    	$("#pangedit").removeClass("glyphicon glyphicon-remove");
	    	$("#pangedit").addClass("glyphicon glyphicon-edit");
	    	$("#pangedit").css("color", "white");
    	}

    }

    function loadsetup(){
    	$.ajax({
    		type: 'POST',
    		url: 'setup/systemsetup/class.php',
    		data: 'form=loadsetup',
    		success: function(data){
    			var arr = data.split("|");
				$("#txtcorporatename").val(arr[1]);
				$("#txtcompanyabout").val(arr[2]);
				$("#txtcompanyaddress").val(arr[3]);
				$("#txtcompanycont").val(arr[4]);
				$("#txtnumofmall").val(arr[6]);
				$("#txtcompanyemail").val(arr[5]);
				$(".txtcompanytemplate").each(function(){
					if($(this).val() == arr[7])
					{ $(this).prop("checked", true); }
				});
				$("#imgg1").attr("src", arr[8]);
				$("#wards").val(arr[9]);
				$("#txtmallprefix").val(arr[10]);
				$("#txtinqprefix").val(arr[11]);
				$("#txtappprefix").val(arr[12]);
				$("#txtTIN").val(arr[14]);
		    	$("#txttelephone").val(arr[15]);
				$("#txtfax").val(arr[16]);
				$("#txtwebsite").val(arr[17]);
				$("#txtmachineno").val(arr[18]);
				$("#txtserialno").val(arr[19]);
				$("#txtaccreditationno").val(arr[20]);
				$(".btnsoftwaretype").each(function(){
					if($(this).val() == arr[21])
					{ $(this).prop("checked", true); }
				});
				loadcount();
				checkmachineno(arr[18]);
				var wards = $("#wards").val();
					if(wards == "1"){
						$(".disablemoko").attr("disabled", true);
				    	$("#pangedit").removeClass("glyphicon glyphicon-remove");
				    	$("#pangedit").addClass("glyphicon glyphicon-edit");
				    	$("#pangedit").css("color", "white");					
				    }
					else if(wards = "0"){
						$(".disablemoko").attr("disabled", false);
				    	$("#pangedit").removeClass("glyphicon glyphicon-edit");
				    	$("#pangedit").addClass("glyphicon glyphicon-remove");
				    	$("#pangedit").css("color", "red");					
				    }
    		}
    	})
    }

    function loadcount(){
    	$.ajax({
    		type: 'POST',
    		url: 'setup/systemsetup/class.php',
    		data: 'form=loadcount',
    		success: function(data){
	    		$("#wards").val(data);
    		}
    	})
    }

    function trap(){
        $('.email-address').each(function(){
            $(this).focusout(function() {
                var sEmail = $(this).val();
                if ($.trim(sEmail).length == 0) {
                    // $(this).focus();
                    // alert("Please enter valid email address");
                    // alert('Please enter valid email address');
                }
                if (validateEmail(sEmail)) {
                    // $(".errohere").hide();
                    // alert('Email is valid');
                    // Nothing happens...
                }
                else {
                    // $(this).focus();
                    showmodal("alert", "The email address you entered is in invalid format.", "", null, "", null, "0");
                }
            });
        });

        $('.website-input').each(function(){
        $(this).focusout(function() {
            var sEmail = $(this).val();
            if ($.trim(sEmail).length == 0) {
                // $(this).focus();
                // alert("Please enter valid web address");
                // alert('Please enter valid email address');
                e.preventDefault();
            }
            if (validatWebsite(sEmail)) {
                $(".errohere").hide();
                // alert('Email is valid');
                // Nothing happens...
            }
            else {
                // $(this).focus();
                showmodal("alert", "The website you entered is in invalid format.", "", null, "", null, "0");
                $(this).val("")
                e.preventDefault();
            }
        });
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

	function validatWebsite(sEmail) {
	    var filter = /www.((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	    if (filter.test(sEmail)) {
	        return true;
	    }
	    else {
	        return false;
	    }
	}  


	function printtemplate(){
    $.ajax({
    	type: 'POST',
    	url: 'setup/systemsetup/class.php',
    	data: 'form=template',
    	success: function(data){
    		$("#template").html(data);
    		$("#templatemall").html(data);
    		$("#templatemall2").html(data);
    	}
    })
	}

	function printtemplate2(){
    $.ajax({
    	type: 'POST',
    	url: 'setup/systemsetup/class.php',
    	data: 'form=template',
    	success: function(data){
    		$("#template2").html(data);
    	}
    })
	}
	function printtemplate3(){
    $.ajax({
    	type: 'POST',
    	url: 'setup/systemsetup/class.php',
    	data: 'form=template',
    	success: function(data){
    		$("#template3").html(data);
    	}
    })
	}
	function printtemplate4(){
    $.ajax({
    	type: 'POST',
    	url: 'setup/systemsetup/class.php',
    	data: 'form=template',
    	success: function(data){
    		$("#template4").html(data);
    	}
    })
	}

	function checkmachineno(txtmachineno){
		$.ajax({
			type: 'POST',
			url: 'setup/systemsetup/class.php',
			data: 'txtmachineno=' + txtmachineno + '&form=checkmachineno',
		success:function(data){
				$("#hiddencount").val(data);
			}
		})
	}

</script>