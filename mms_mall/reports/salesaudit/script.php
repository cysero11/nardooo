<script type="text/javascript">
$(function(){
    sayear();
    showtblaccreditationlist();
    $("#txt_userpageaccreditation").val("1");
    $('.input-mask-phone').mask('(99)-999-9999');
	$(".POSInformation").attr("disabled", true);
	$(".AccreditationInformation").attr("disabled", true);
	showtenantlistthatisnotaccreditedyet();

	$('.upload_acc_req').ace_file_input({
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

	$(".goblin").keydown(function (e){ 
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || 
		(e.keyCode == 65 && e.ctrlKey === true) ||  
		(e.keyCode >= 35 && e.keyCode <= 40)) { 
		 return;
	} 
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}

	});
})

	setTimeout(function(){
    updateaccreditationinfo();
    }, 10000)

setTimeout(function(){
    $(".fixTable").tableHeadFixer(); 
	
    $(".date-picker").datepicker({
        autoHide: true,
        format: 'dd',
        todayHighlight: true
    });
    }, 500)

function sayear(){
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'form=sayear',
	success: function(data){
		$("#sayear").html(data);
	}
	})
}

function saday(){
	var month = $("#samonth").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'month=' + month + '&form=saday',
	success: function(data){
		$("#saday").html(data);
		}
	})
}

function company(){
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'year=' + year + '&month=' + month + '&day=' + day + '&form=companysales',
		beforeSend : function() {
	        $('#indexloadingscreen').addClass('myspinner');
	    },
	    success: function(data){
	        $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
			if(data == "1"){
	        showmodal("alert", "If you want to filter on a certain date you must also select month.", "", null, "", null, "0");
	  	}else{
	    	$("#dbsalesnanagaappend").html(arr[0]);
	    	$("#companynamelabel").text(arr[2]);
	    	$("#companyname").css("background-color", "#a1c7dd");
	    	$("#companyname").css("color", "#0000e6");
	    	$("#companyname").css("display", "inherit");
	    	$("#mallname").css("display", "none");
			$("#wingname").css("display", "none");
			$("#floorname").css("display", "none");
			$("#unittypename").css("display", "none");
			$("#unitname").css("display", "none");
			$("#tenantname").css("display", "none");
			$("#monthname").css("display", "none");
			$("#dayname").css("display", "none");
			$("#mallenamelabel").text("Mall");
			$("#wingnamelabel").text("Wing");
			$("#floornamelabel").text("Floor");
			$("#unittypenamelabel").text("Unit Type");
			$("#unitnamelabel").text("Unit");
			$("#yearlysaleslabel").text("Tenant Sales By Year");
			$("#monthlysaleslabel").text("Tenant Sales By Month");
			$("#dailysaleslabel").text("");
	    }
		}
	})
}

function mallsales(){
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'year=' + year + '&month=' + month + '&day=' + day + '&form=mallsales',
		beforeSend : function() {
	        $('#indexloadingscreen').addClass('myspinner');
	    },
	    success: function(data){
	        $('#indexloadingscreen').removeClass('myspinner');
			var arr = data.split("|");
			$("#dbsalesnanagaappend").html(arr[0]);
			$("#companyname").css("background-color", "");
	    	$("#companyname").css("color", "");
	    	$("#mallenamelabel").css("background-color", "#a1c7dd");
	    	$("#mallenamelabel").css("color", "#0000e6");
		    $("#mallname").css("display", "inherit");
		    $("#wingname").css("display", "none");
			$("#floorname").css("display", "none");
			$("#unittypename").css("display", "none");
			$("#unitname").css("display", "none");
			$("#tenantname").css("display", "none");
			$("#monthname").css("display", "none");
			$("#dayname").css("display", "none");
			$("#mallenamelabel").text("Mall");
			$("#wingnamelabel").text("Wing");
			$("#floornamelabel").text("Floor");
			$("#unittypenamelabel").text("Unit Type");
			$("#unitnamelabel").text("Unit");
			$("#yearlysaleslabel").text("Tenant Sales By Year");
			$("#monthlysaleslabel").text("Tenant Sales By Month");
			$("#dailysaleslabel").text("");
		}
	})
}

function wingsales(mallid){
	$("#mallid").val(mallid);
	var mallid = $("#mallid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=wingsales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#mallenamelabel").text(arr[1]);
		$("#mallenamelabel").css("background-color", "");
    	$("#mallenamelabel").css("color", "");
    	$("#wingnamelabel").css("background-color", "#a1c7dd");
    	$("#wingnamelabel").css("color", "#0000e6");
		$("#wingname").css("display", "inherit");
		$("#floorname").css("display", "none");
		$("#unittypename").css("display", "none");
		$("#unitname").css("display", "none");
		$("#tenantname").css("display", "none");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		}
	})
}

function wingsales2(){
	var mallid = $("#mallid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=wingsales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#mallenamelabel").text(arr[1]);
		$("#mallenamelabel").css("background-color", "");
    	$("#mallenamelabel").css("color", "");
    	$("#wingnamelabel").css("background-color", "#a1c7dd");
    	$("#wingnamelabel").css("color", "#0000e6");
		$("#wingname").css("display", "inherit");
		$("#floorname").css("display", "none");
		$("#unittypename").css("display", "none");
		$("#unitname").css("display", "none");
		$("#tenantname").css("display", "none");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		$("#wingnamelabel").text("Wing");
		$("#floornamelabel").text("Floor");
		$("#unittypenamelabel").text("Unit Type");
		$("#unitnamelabel").text("Unit");
		$("#yearlysaleslabel").text("Tenant Sales By Year");
		$("#monthlysaleslabel").text("Tenant Sales By Month");
		$("#dailysaleslabel").text("");
		}
	})
}

function floorsales(wingid){
	$("#wingid").val(wingid);
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&wingid=' + wingid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=floorsales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#wingnamelabel").text(arr[1]);
		$("#wingnamelabel").css("background-color", "");
    	$("#wingnamelabel").css("color", "");
    	$("#floornamelabel").css("background-color", "#a1c7dd");
    	$("#floornamelabel").css("color", "#0000e6");
		$("#floorname").css("display", "inherit");
		$("#unittypename").css("display", "none");
		$("#unitname").css("display", "none");
		$("#tenantname").css("display", "none");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		}
	})
}

function floorsales2(){
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&wingid=' + wingid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=floorsales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#wingnamelabel").text(arr[1]);
		$("#wingnamelabel").css("background-color", "");
    	$("#wingnamelabel").css("color", "");
    	$("#floornamelabel").css("background-color", "#a1c7dd");
    	$("#floornamelabel").css("color", "#0000e6");
		$("#floorname").css("display", "inherit");
		$("#unittypename").css("display", "none");
		$("#unitname").css("display", "none");
		$("#tenantname").css("display", "none");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		$("#floornamelabel").text("Floor");
		$("#unittypenamelabel").text("Unit Type");
		$("#unitnamelabel").text("Unit");
		$("#yearlysaleslabel").text("Tenant Sales By Year");
		$("#monthlysaleslabel").text("Tenant Sales By Month");
		$("#dailysaleslabel").text("");
		}
	})
}

function unittypesales(floorid){
	$("#floorid").val(floorid);
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&wingid=' + wingid + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=unittypesales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#floornamelabel").text(arr[1]);
		$("#floornamelabel").css("background-color", "");
    	$("#floornamelabel").css("color", "");
    	$("#unittypenamelabel").css("background-color", "#a1c7dd");
    	$("#unittypenamelabel").css("color", "#0000e6");
		$("#unittypename").css("display", "inherit");
		$("#unitname").css("display", "none");
		$("#tenantname").css("display", "none");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		}
	})
}

function unittypesales2(){
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&wingid=' + wingid + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=unittypesales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#floornamelabel").text(arr[1]);
		$("#floornamelabel").css("background-color", "");
    	$("#floornamelabel").css("color", "");
    	$("#unittypenamelabel").css("background-color", "#a1c7dd");
    	$("#unittypenamelabel").css("color", "#0000e6");
		$("#unittypename").css("display", "inherit");
		$("#unitname").css("display", "none");
		$("#tenantname").css("display", "none");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		$("#unittypenamelabel").text("Unit Type");
		$("#unitnamelabel").text("Unit");
		$("#yearlysaleslabel").text("Tenant Sales By Year");
		$("#monthlysaleslabel").text("Tenant Sales By Month");
		$("#dailysaleslabel").text("");
		}
	})
}

function unitsales(unittype){
	$("#unittype").val(unittype);
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unittype = $("#unittype").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&wingid=' + wingid + '&unittype=' + unittype + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=unitsales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#unittypenamelabel").text(arr[1]);
		$("#unittypenamelabel").css("background-color", "");
    	$("#unittypenamelabel").css("color", "");
    	$("#unitnamelabel").css("background-color", "#a1c7dd");
    	$("#unitnamelabel").css("color", "#0000e6");
		$("#unitname").css("display", "inherit");
		$("#tenantname").css("display", "none");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		}
	})
}

function unitsales2(){
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unittype = $("#unittype").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&wingid=' + wingid + '&unittype=' + unittype + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=unitsales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#unittypenamelabel").text(arr[1]);
		$("#unittypenamelabel").css("background-color", "");
    	$("#unittypenamelabel").css("color", "");
    	$("#unitnamelabel").css("background-color", "#a1c7dd");
    	$("#unitnamelabel").css("color", "#0000e6");
		$("#unitname").css("display", "inherit");
		$("#tenantname").css("display", "none");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		$("#unitnamelabel").text("Unit");
		$("#yearlysaleslabel").text("Tenant Sales By Year");
		$("#monthlysaleslabel").text("Tenant Sales By Month");
		$("#dailysaleslabel").text("");
		}
	})
}

function tenantsales(unitid){
	$("#unitid").val(unitid);
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&wingid=' + wingid + '&unittype=' + unittype + '&unitid=' + unitid + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=tenantsales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#unitnamelabel").text(arr[1]);
		$("#unitnamelabel").css("background-color", "");
    	$("#unitnamelabel").css("color", "");
    	$("#yearlysaleslabel").css("background-color", "#a1c7dd");
    	$("#yearlysaleslabel").css("color", "#0000e6");
		$("#tenantname").css("display", "inherit");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		}
	})
}

function tenantsales2(){
	var unittype = $("#unittype").val();
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'mallid=' + mallid + '&wingid=' + wingid + '&unittype=' + unittype + '&unitid=' + unitid + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=tenantsales',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#unitnamelabel").text(arr[1]);
		$("#unitnamelabel").css("background-color", "");
    	$("#unitnamelabel").css("color", "");
    	$("#yearlysaleslabel").css("background-color", "#a1c7dd");
    	$("#yearlysaleslabel").css("color", "#0000e6");
		$("#tenantname").css("display", "inherit");
		$("#monthname").css("display", "none");
		$("#dayname").css("display", "none");
		$("#yearlysaleslabel").text("Tenant Sales By Year");
		$("#monthlysaleslabel").text("Tenant Sales By Month");
		$("#dailysaleslabel").text("");
		}
	})
}

function tenantsalesbymonth(tenantid){
	$("#tenantid").val(tenantid);
	var tenantid = $("#tenantid").val();
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	var unittype = $("#unittype").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'tenantid=' + tenantid + '&mallid=' + mallid + '&wingid=' + wingid + '&unittype=' + unittype + '&unitid=' + unitid + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=tenantsalesbymonth',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#yearlysaleslabel").text(arr[1]);
		$("#unitnamelabel").text(arr[2]);
		$("#yearlysaleslabel").css("background-color", "");
		$("#unitnamelabel").css("background-color", "");
    	$("#unitnamelabel").css("color", "");
    	$("#yearlysaleslabel").css("color", "");
    	$("#monthlysaleslabel").css("background-color", "#a1c7dd");
    	$("#monthlysaleslabel").css("color", "#0000e6");
		$("#monthname").css("display", "inherit");
		$("#dayname").css("display", "none");
		}
	})
}

function tenantsales2bymonth(){
	var tenantid = $("#tenantid").val();
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	var unittype = $("#unittype").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'tenantid=' + tenantid + '&mallid=' + mallid + '&wingid=' + wingid + '&unittype=' + unittype + '&unitid=' + unitid + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=tenantsalesbymonth',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#yearlysaleslabel").text(arr[1]);
		$("#yearlysaleslabel").css("background-color", "");
    	$("#yearlysaleslabel").css("color", "");
    	$("#monthlysaleslabel").css("background-color", "#a1c7dd");
    	$("#monthlysaleslabel").css("color", "#0000e6");
		$("#monthname").css("display", "inherit");
		$("#dayname").css("display", "none");
		$("#monthlysaleslabel").text("Tenant Sales By Month");
		$("#dailysaleslabel").text("");
		}
	})
}

function tenantsalesbyday(tenantmonth, tenantid){
	$("#tenantmonth").val(tenantmonth);
	$("#tenantid").val(tenantid);
	var tenantid = $("#tenantid").val();
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	var tenantmonth = $("#tenantmonth").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'tenantmonth=' + tenantmonth + '&tenantid=' + tenantid + '&mallid=' + mallid + '&wingid=' + wingid + '&unittype=' + unittype + '&unitid=' + unitid + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=tenantsalesbyday',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#monthlysaleslabel").text(arr[1]);
		$("#dailysaleslabel").text(arr[2]);
		$("#monthlysaleslabel").css("background-color", "");
    	$("#monthlysaleslabel").css("color", "");
    	$("#dailysaleslabel").css("background-color", "#a1c7dd");
    	$("#dailysaleslabel").css("color", "#0000e6");
		$("#dayname").css("display", "inherit");
		}
	})
}

function tenantsales2byday(){
	var tenantid = $("#tenantid").val();
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	var tenantmonth = $("#tenantmonth").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'tenantmonth=' + tenantmonth + '&tenantid=' + tenantid + '&mallid=' + mallid + '&wingid=' + wingid + '&unittype=' + unittype + '&unitid=' + unitid + '&floorid=' + floorid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=tenantsalesbyday',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#monthlysaleslabel").text(arr[1]);
		$("#monthlysaleslabel").css("background-color", "");
    	$("#monthlysaleslabel").css("color", "");
    	$("#dailysaleslabel").css("background-color", "#a1c7dd");
    	$("#dailysaleslabel").css("color", "#0000e6");
		$("#dayname").css("display", "inherit");
		}
	})
}

function tenantsalesbyday3(){
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	var mallid = $("#mallid").val();
	var wingid = $("#wingid").val();
	var floorid = $("#floorid").val();
	var unittype = $("#unittype").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'unittype=' + unittype + '&mallid=' + mallid + '&wingid=' + wingid + '&floorid=' + floorid + '&unitid=' + unitid + '&year=' + year + '&month=' + month + '&day=' + day + '&form=tenantsalesbyday3',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		$("#dbsalesnanagaappend").html(arr[0]);
		$("#dailysaleslabel").text(arr[1]);
		$("#unitnamelabel").text(arr[2]);
		$("#unitnamelabel").css("background-color", "");
    	$("#unitnamelabel").css("color", "");
		$("#monthlysaleslabel").css("background-color", "");
    	$("#monthlysaleslabel").css("color", "");
    	$("#dailysaleslabel").css("background-color", "#a1c7dd");
    	$("#dailysaleslabel").css("color", "#0000e6");
		$("#dayname").css("display", "inherit");
		}
	})
}

function checkfilterofdate(unitid){
	$("#unitid").val(unitid)
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	if(month != "" && day != ""){
		tenantsalesbyday3();
	}
	else if(month != "" && day == ""){
		tenantsalesbymonth();
	}
	else if(month == "" && day == ""){
		tenantsales2();
	}
}

function checkfilterofdate2(){
	var unitid = $("#unitid").val();
	var year = $("#sayear").val();
	var month = $("#samonth").val();
	var day = $("#saday").val();
	if(month != "" && day != ""){
		tenantsalesbyday3();
	}
	else if(month != "" && day == ""){
		tenantsales2bymonth();
	}
	else if(month == "" && day == ""){
		tenantsales2();
	}
}

function displaypenaltypertenant(tenantid){
	$("#displaypenaltypertenant").modal("show");
	$("#ptenantid").val(tenantid);
	var ptenantid = $("#ptenantid").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'ptenantid=' + ptenantid + '&form=displaypenaltypertenant',
	success: function(data){
		$("#tbldisplaypenaltypertenant").html(data);
		}
	})
}

function closeandclear(){
	$("#accreditationschedulemodal").modal("hide");
	$(".POSInformation").attr("disabled", true);
	$(".AccreditationInformation").attr("disabled", true);

	$("#pangedit3").removeClass("fa fa-times");
    $("#pangedit3").addClass("fa fa-pencil-square-o");
    $("#pangedit3").css("color", "green");

	$("#pangedit2").removeClass("fa fa-times");
    $("#pangedit2").addClass("fa fa-pencil-square-o");
    $("#pangedit2").css("color", "green");
    $("#execute").val("");
    $("#execute2").val("");

 //    $(".textfilegenerator").each(function(){
	// 	$(this).prop("checked", false);
	// });
	// $(".natureofpos").each(function(){
	// 	$(this).attr("checked", false);
	// });
}

function showaccreditationschedulemodal(tenantid){
	$("#accreditationschedulemodal").modal("show");
	$("#flicker").val(tenantid);
	$(".natureofpos").removeAttr("checked");
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'tenantid=' + tenantid + '&form=showaccreditationschedulemodal',
	success:function(data){
			var arr = data.split("#");
			$("#MACAddress").text(arr[0]);
			$("#accreditationdate").val(arr[1]);
			$("#operatingsystem").val(arr[2]);
			$("#softwareversion").val(arr[3]);
			var arr2 = arr[4].split("|");

			for ( var a = 0; a <= arr[12]; a++ ) {
			$("#" + arr2[a]).prop("checked", true);
			}

			$(".textfilegenerator").each(function(){
				if($(this).val() == arr[5]){
					$(this).prop("checked", true);
				}
			});

			$("#remarks").val(arr[6]);
			$("#retailpartnername").val(arr[7]);
			$("#numberofpos").val(arr[8]);
			$("#nameofposprovider").val(arr[9]);
			$("#mobilenumber").val(arr[10]);
		}
	})
}

function createnewschedule(){
	$("#createnewschedule").modal("show");
}

function showschedulingmodal(){
	$("#createnewschedule").modal("hide");
}

function showtenantlistthatisnotaccreditedyet(){
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'form=showtenantlistthatisnotaccreditedyet',
	success:function(data){
			$("#tenantidwithnoaccreditation").html(data);
		}
	})
}

function showtblaccreditationlist(){
	var page = $("#txt_userpageaccreditation").val();
	var dateFrom = $("#dateFrom10").val();
	var dateTo = $("#dateTo10").val();

	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=showtblaccreditationlist',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
			$("#tblaccreditationlist").html(data);
			loadentriesofaccreditation();
			loadpageofaccreditation();
		}
	})
}

function loadentriesofaccreditation(){
    var page = $("#txt_userpageaccreditation").val();
    var dateFrom = $("#dateFrom10").val();
    var dateTo = $("#dateTo10").val();

    $.ajax({
        type: 'POST',
        url: 'reports/salesaudit/class.php',
        data: 'page=' + page + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=loadentriesofaccreditation',
        success: function(data){
            if(data == "no data"){
                $("#txtaccreditationentries").text("");
            }
            else{
                $("#txtaccreditationentries").text(data);
            }
        }
    });
}

function loadpageofaccreditation(){
    var page = $("#txt_userpageaccreditation").val();
    var dateFrom = $("#dateFrom10").val();
    var dateTo = $("#dateTo10").val();

    $.ajax({
        type: 'POST',
        url: 'reports/salesaudit/class.php',
        data: 'dateFrom=' + dateFrom +  '&dateTo=' + dateTo + '&page=' + page + '&form=loadpageofaccreditation',
        success: function(data){
            $("#ulpaginationaccreditation").html(data);
        }
    });
}

function paginationofaccreditation(page, pagenums){
    $(".pgnumpaccreditation").removeClass("active");
    var value = "#" + pagenums;
    $("#pgaccreditation" + pagenums).addClass("active");
    $("#txt_userpageaccreditation").val(page);
    showtblaccreditationlist();
    loadentriesofaccreditation();
    loadpageofaccreditation();
}

function saveaccreditationschedule(){
	var tenantid = $("#flicker").val();
	var accreditationdate = $("#accreditationdate").val();
	var retailpartnername = $("#retailpartnername").val();
	var softwareversion = $("#softwareversion").val();
	var operatingsystem = $("#operatingsystem").val();
	var numberofpos = $("#numberofpos").val();
	var remarks = $("#remarks").val();
	var nameofposprovider = $("#nameofposprovider").val();
	var mobilenumber = $("#mobilenumber").val();
	var accredtationstatus = $("#accredtationstatus").val();
	var startdateofsendingfiles = $("#startdateofsendingfiles").val();
	var POSINFO = "";
	var textfilegeneratortype = "";
	var macaddress = $("#MACAddress").val();
	$(".textfilegenerator").each(function(){
		if($(this).prop("checked")){
			textfilegeneratortype = this.value;
		}
	})
	$(".natureofpos").each(function(){
		if($(this).prop("checked")){
			POSINFO += this.value + "|";
		}
	})
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'startdateofsendingfiles=' + startdateofsendingfiles + '&accredtationstatus=' + accredtationstatus + '&tenantid=' + tenantid + '&accreditationdate=' + accreditationdate + '&retailpartnername=' + retailpartnername + '&softwareversion=' + softwareversion + '&operatingsystem=' + operatingsystem + '&numberofpos=' + numberofpos + '&remarks=' + remarks + '&nameofposprovider=' + nameofposprovider + '&mobilenumber=' + mobilenumber + '&POSINFO=' + POSINFO + '&textfilegeneratortype=' + textfilegeneratortype + '&macaddress=' + macaddress + '&form=saveaccreditationschedule',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
		var arr = data.split("|");
		showmodal("alert", arr[0], "", $("#accreditationschedulemodal").modal("hide"), "", null, "0");
		showtblaccreditationlist();
		uploadpic(arr[1]);
		}
	})
}

function saveschedule(){
	var tenantid = $("#tenantidwithnoaccreditation").val();
	var accreditationdate = $("#accreditationdate2").val();
	var retailpartnername = $("#retailpartnername2").val();
	var softwareversion = $("#softwareversion2").val();
	var operatingsystem = $("#operatingsystem2").val();
	var numberofpos = $("#numberofpos2").val();
	var remarks = $("#remarks2").val();
	var nameofposprovider = $("#nameofposprovider2").val();
	var mobilenumber = $("#mobilenumber2").val();
	var POSINFO = "";
	var textfilegeneratortype = "";
	var macaddress = $("#MACAddress2").val();
	$(".textfilegenerator2").each(function(){
		if($(this).prop("checked")){
			textfilegeneratortype = this.value;
		}
	})
	$(".natureofpos2").each(function(){
		if($(this).prop("checked")){
			POSINFO += this.value + "|";
		}
	})
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'tenantid=' + tenantid + '&accreditationdate=' + accreditationdate + '&retailpartnername=' + retailpartnername + '&softwareversion=' + softwareversion + '&operatingsystem=' + operatingsystem + '&numberofpos=' + numberofpos + '&remarks=' + remarks + '&nameofposprovider=' + nameofposprovider + '&mobilenumber=' + mobilenumber + '&POSINFO=' + POSINFO + '&textfilegeneratortype=' + textfilegeneratortype + '&macaddress=' + macaddress + '&form=saveschedule',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
			if(data != "1"){
				showmodal("alert", "Accreditation schedule for " + data + " has been set.", "", null, "", null, "0");
			}else{
				showmodal("alert", "This tenant have an existing schedule.", "", null, "", null, "0");
			}
		}
	})
}

function ibahinmoko(){
    var enable = $("#execute").val();
    if(enable == ""){
        $("#execute").val("1");
		$(".AccreditationInformation").attr("disabled", false);
        $("#pangedit3").removeClass("fa fa-pencil-square-o");
        $("#pangedit3").addClass("fa fa-times");
        $("#pangedit3").css("color", "red");
    }
    else{
        $("#execute").val("");
       	$(".AccreditationInformation").attr("disabled", true);
        $("#pangedit3").removeClass("fa fa-times");
        $("#pangedit3").addClass("fa fa-pencil-square-o");
        $("#pangedit3").css("color", "green");
    }
}

function ibahinmoko2(){
    var enable = $("#execute2").val();
    if(enable == ""){
        $("#execute2").val("1");
		$(".POSInformation").attr("disabled", false);
        $("#pangedit2").removeClass("fa fa-pencil-square-o");
        $("#pangedit2").addClass("fa fa-times");
        $("#pangedit2").css("color", "red");
    }
    else{
        $("#execute2").val("");
       	$(".POSInformation").attr("disabled", true);
        $("#pangedit2").removeClass("fa fa-times");
        $("#pangedit2").addClass("fa fa-pencil-square-o");
        $("#pangedit2").css("color", "green");
    }
}

function clearlahat(){
	$("#accreditationschedulemodal").modal("hide");
	$(".POSTINFORMATION").val("");
	$(".natureofpos").attr("checked", false);
	$(".textfilegenerator").prop("checked", false);
	$(".AccreditationInformation").val("");
}

function setpenalty(tenantid){
	$("#penaltymodal").modal("show");
	$("#weaken").val(tenantid);
}

function sendpenalty(){
	var tenantid = $("#weaken").val();
	var reasonforpenalty = $("#reasonforpenalty").val();
	var amountforpenalty = $("#amountforpenalty").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'reasonforpenalty=' + reasonforpenalty + '&amountforpenalty=' + amountforpenalty + '&tenantid=' + tenantid + '&form=setpenalty',
		beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
			showmodal("alert", data, "", $("#penaltymodal").modal("hide"), "", null, "0");
			$(".settingofpenalty").val("");
		}
	})
}

function uploadpic(tenantid){
	$("#clint").val(tenantid);
  	var data = new FormData($('#postingpicture')[0]);
  	$.ajax({
    	type:"POST",
    	url:"reports/salesaudit/uploadngreqpic.php",
    	data: data,
    	mimeType: "multipart/form-data",
    	contentType: false,
    	cache: false,
    	processData: false,
    success:function(data){
    }
  });
}

function enabledatepicker(){
	var status = $("#accredtationstatus").val();
	if(status == "Accredited"){
		$("#startdateofsendingfiles").attr("disabled", false);
		$("#startdateofsendingfiles").attr("value", "<?php echo date('Y-m-d'); ?>");
	}else if(status == "Not Accredited"){
		$("#startdateofsendingfiles").attr("disabled", true);
		$("#startdateofsendingfiles").attr("value", "");
	}
}

function printaccreditation(){
	var dateFrom = $("#dateFrom10").val();
	var dateTo = $("#dateTo10").val();
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=printaccreditation',
		success:function(data){
			$("#displayaccreditationtbl").html(data);
			$("#dateFrom11").text(dateFrom);
			$("#dateTo11").text(dateTo);

			var toprint = $("#div_form_accreditation").html();
			var myheight = $(window).height()-40;
			var mywidth = $(window).width()-40;
			var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 110);
			popupWin.document.open();
			popupWin.document.write("<html><head><title>Accreditation List</title><link href='assets/css/style.css' rel='stylesheet' type='text/css'></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
			popupWin.document.close();
		}
	})
}

function updateaccreditationinfo(){
	$.ajax({
		type: 'POST',
		url: 'reports/salesaudit/class.php',
		data: 'form=updateaccreditationinfo',
	success:function(data){
		}
	})
}

function showbutton(){
	$("#buttonpangaddsched").css("display", "block");
}

function hidebutton(){
	$("#buttonpangaddsched").css("display", "none");
}
</script>