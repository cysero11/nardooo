<script type="text/javascript">
	setTimeout(function(){
    	displaycomplaints();
    	$("#txt_userpage").val("1");
		loadentries();
		loadfilters_complaint('Complaint');
	}, 500)
	$(function(){
		displaycomplaints();
    	$("#txt_userpage").val("1");
		loadentries();
		loadfilters_complaint('Complaint');
	})
	function displaycomplaints() {
    var page = $("#txt_userpage").val();
    var key = $("#txtsearchcomplaints").val();
        $.ajax({
            type: 'POST',
            url: 'maintenance/class2.php',
            data: 'page=' + page + '&key=' + key + '&form=displaycomplaints',
            success: function(data) {
                $("#displaycomplaints").html(data);
                loadentries();
                loadpagecomplaints();
            }
        })
	}

	function loadentries(){
	var page = $("#txt_userpage").val();
    var key = $("#txtsearchcomplaints").val();

        $.ajax({
            type: 'POST',
            url: 'maintenance/class2.php',
            data: 'page=' + page + '&key=' + key + '&form=loadentries',
            success: function(data){
                if(data == ""){
                    $("#txtcomplaintsentries").text("");
                }
                else{
                    $("#txtcomplaintsentries").text(data);
                }
            }
        });
    }

	function loadpagecomplaints(){
	var page = $("#txt_userpage").val();
    var key = $("#txtsearchcomplaints").val();

	    $.ajax({
	        type: 'POST',
	        url: 'maintenance/class2.php',
	        data: 'page=' + page + '&key=' + key + '&form=loadpagecomplaints',
	        success: function(data){
	            $("#ulpaginationcomplaint").html(data);
	        }
	    });
	}

	function pagination(page, pagenums){
	    $(".pgnumpcomplaints").removeClass("active");
	    var value = "#" + pagenums;
	    $("#pgcomplaints" + pagenums).addClass("active");
	    $("#txt_userpage").val(page);
	    displaycomplaints();
	    loadpagecomplaints();
	    loadentries();
	}

    function loadfilters_complaint(module){
        $.ajax({
	        type: 'POST',
	        url: 'maintenance/class2.php',
	        data: 'module=' + module + '&form=loadfilters_complaint',
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
	            $("#dateentrystart2").val(arr2[0]);
	            $("#dateentryend2").val(arr2[1]);
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
	            displaycomplaints()
	        }
    	})
	}

    function savecomplaintfilter(){
        var module = "Complaint";
        var checked = "";
        $('input:checkbox[name="form-field-checkboxph"]').each(function(){
            if($(this).is(":checked")){
                var value = $(this).attr("value");
                checked += value + "|";
            }
        })

        var checked2 = "";
        $('input:checkbox[name="form-field-checkboxph"]').each(function(){

                var value2 = $(this).attr("value");
                checked2 += value2 + "|";
        })

        var checked3 = "";
        $('input:checkbox[name="form-field-checkbox-pstat2"]').each(function(){
          if($(this).is(":checked"))
          {
            var value3 = $(this).attr("value");
            checked3 += value3 + "|";
          }
        })

        var checked4 = "";
        $('input:checkbox[name="form-field-checkbox-fbcs"]').each(function(){
          if($(this).is(":checked"))
          {
            var value4 = $(this).attr("value");
            checked4 += value4 + "|";
          }
        })           
        var datefrom = $("#dateentrystart2").val();
        var dateto = $("#dateentryend2").val();

        $.ajax({
            type: 'POST',
            url: 'maintenance/class2.php',
            data: 'module=' + module + '&checked=' + checked + '&checked2=' + checked2 + '&checked3=' + checked3 + '&checked4=' + checked4 + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=savecomplaintfilter',
            success: function(data){
                loadfilters_complaint(module);
                $("#LINK_complaint_filter").click();
            }
        })
    }

    function showfilterngcomplaints(){
    	$("#pangcomplaints").css("display", "block");
    }

    function hidefilterngcomplaints(){
    	$("#pangcomplaints").css("display", "none");    
    }

    function setcomplaintastask(tenantid, complaint_code, complaints_cdescription, customer_name, unitname, complaint_series_no){
    	$("#complaintsmodal").modal("show");
    	$("#complaints_tenantsid").text(tenantid);
		$("#complaints_ccode").text(complaint_code);
		$("#complaints_cdescription").text(complaints_cdescription);
		$("#complaints_ccname").text(customer_name);
		$("#complaints_unit").text(unitname);
		$("#nakatagodahilhindikayangipagsigawan").val(complaint_series_no);
    }

    function savecomplaintsmodal(){
    	var tenantid = $("#complaints_tenantsid").text();
		var complaint_code = $("#complaints_ccode").text();
		var complaints_description = $("#complaints_cdescription").text();
		var customer_name = $("#complaints_ccname").text();
		var unitname = $("#complaints_unit").text();
		var complaint_series_no = $("#nakatagodahilhindikayangipagsigawan").val();
		var datestart = $("#complaints_newsched").val();
		var starttime = $("#complaints_newtime").val();
		var assignedperson = $("#complaints_newperson").val();
		var remarks = $("#complaints_details").val();
		if(assignedperson != ""){
			$.ajax({
				type: 'POST',
				url: 'maintenance/class2.php',
				data: 'tenantid=' + tenantid + '&complaint_code=' + complaint_code + '&complaints_description=' + complaints_description + '&customer_name=' + customer_name + '&unitname=' + unitname + '&complaint_series_no=' + complaint_series_no + '&datestart=' + datestart + '&starttime=' + starttime + '&assignedperson=' + assignedperson + '&remarks=' + remarks + '&form=savecomplaintsmodal',
				success:function(data){
                    alert(data);
					if(data == 1){
						showmodal("alert", "Task from complaints saved.", "closecomplaintsmodal", null, "", null, "0");
						displaycomplaints();
					}
				}
			})
		}else{
			showmodal("alert", "Please select a person to do the task.", "closecomplaintsmodal", null, "", null, "1");
		}
    }

    function closecomplaintsmodal(){
    	$("#complaintsmodal").modal("hide");
    }

    function printbydaterange(){
    	var datefrom = $("#pdatefrom").val();
		var dateto = $("#pdateto").val();
        var mallid = $("#printbymecomplaint").val();
        if(mallid != ""){
            $.ajax({
            	type: 'POST',
            	url: 'maintenance/class2.php',
            	data: 'datefrom=' + datefrom + '&dateto=' + dateto + '&form=printbydaterange',
            	success:function(data){
                    var arr = data.split("|");
            		$("#tblmpocbodrc").html(arr[0]);
                    $("#dateFrommpocbodrcprint").text(arr[1])
                    $("#dateTompocbodrcprint").text(arr[2])

                    $.ajax({
                        type: 'POST',
                        url: 'maintenance/class.php',
                        data: 'mallid=' + mallid + '&form=template',
                        success:function(data){

                            $("#template").html(data);
                            var toprint = $("#mpocbodrc").html();
                            var myheight = $(window).height()-40;
                            var mywidth = $(window).width()-40;
                            var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
                            popupWin.document.open();
                            popupWin.document.write("<html><head><title></title><link rel='stylesheet' href='assets/font-awesome/4.5.0/css/font-awesome.min.css' /><link href='assets/css/style2.css' rel='stylesheet' type='text/css'></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
                            popupWin.document.close();
                        }
                    })
            	}
            })
        }else{
            showmodal("alert", "Please select mall.", "", null, "", null, "0");
        }
    }

    function printcomplaint(csn, mallid){
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'csn=' + csn + '&form=printcomplaint',
        success:function(data){
            var arr = data.split("|");
            $("#printcomplainttradename").text(arr[0]);
            $("#printcomplaintmallname").text(arr[1]);
            $("#printcomplaintwingname").text(arr[2]);
            $("#printcomplaintfloorname").text(arr[3]);
            $("#printcomplaintunitname").text(arr[4]);
            $("#printcomplaintcomplaintdate").text(arr[5]);
            $("#printcomplaintusername").text(arr[6]);
            $("#printcomplaintcomplaintcode").text(arr[7]);
            $("#printcomplaintdescription").text(arr[8]);
            $("#printcomplaintassignedperson").text(arr[9]);
            $("#printcomplainttenantid").text(arr[10]);

            $.ajax({
                type: 'POST',
                url: 'maintenance/class.php',
                data: 'mallid=' + mallid + '&form=template',
                success:function(data){
                    $("#template4").html(data);

                    var toprint = $("#printcomplaint").html();
                    var myheight = $(window).height()-40;
                    var mywidth = $(window).width()-40;
                    var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
                    popupWin.document.open();
                    popupWin.document.write("<html><head><title></title><link href='assets/css/style.css' rel='stylesheet' type='text/css'></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
                    popupWin.document.close();
                }
            })
        }
    })
    
}
</script>