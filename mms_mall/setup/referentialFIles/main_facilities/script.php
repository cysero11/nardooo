<script type="text/javascript">
setTimeout(function() {
	showmainfacilities();
	showfloor2();
	showunit2();
}, 300)

var count553 = 0;

function showmainfacilities2(){
	count553 = 0;
	showmainfacilities();
}

function showmainfacilities(){
	var key = $("#txtsearchfacilitiesCat").val();
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_facilities/class.php',
		data: 'count553=' + count553 + '&key=' + key + '&form=showmainfacilities',
	success:function(data){
			var arr = data.split("|");
				$("#tblfacilities_category").html(arr[0]);
				$("#facilitiescatcounts").val(arr[1]);
				facilitiesCatSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first553").attr("disabled", "disabled");
					$("#btn-prev553").attr("disabled", "disabled");
					$("#btn-next553").attr("disabled", "disabled");
					$("#btn-last553").attr("disabled", "disabled");
				}

				else {
					if ( count553 == 0 ) {
						$("#btn-first553").attr("disabled", "disabled");
						$("#btn-prev553").attr("disabled", "disabled");
						$("#btn-next553").removeAttr("disabled");
						$("#btn-last553").removeAttr("disabled");
					}

					else if ( count553 == $("#facilitiescatcounts").val() * 10 ) {
						$("#btn-first553").removeAttr("disabled");
						$("#btn-prev553").removeAttr("disabled");
						$("#btn-next553").attr("disabled", "disabled");
						$("#btn-last553").attr("disabled", "disabled");
					}

					else {
						$("#btn-first553").removeAttr("disabled");
						$("#btn-prev553").removeAttr("disabled");
						$("#btn-next553").removeAttr("disabled");
						$("#btn-last553").removeAttr("disabled");
					}
				}
		}
	})
}

function page553(txt) {
	if ( txt == 'first' ) {
		count553 = 0;
		showmainfacilities();
	}

	else if ( txt == "prev" ) {
		count553 = count553 - 10;
		showmainfacilities();
	}

	else if ( txt == "next" ) {
		count553 = count553 + 10;
		showmainfacilities();
	}

	else {
		count553 = $("#facilitiescatcounts").val() * 10;
		showmainfacilities();
	}
}

function facilitiesCatSelected() {
	$("#tblfacilities_category tr").each(function(){
		$(this).click(function(){
			$("#tblfacilities_category tr").removeClass("bg-info");
			$(this).addClass("bg-info");
			selectedfacilitiesCat(this.id);
		})
	})
}

function selectedfacilitiesCat(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_facilities/class.php',
			data: 'id=' + id + '&form=selectedfacilitiesCat',
			success: function(data) {
				var arr = data.split("|");
				$("#facilitiesCatCode").val(arr[0]);
				$("#facilitiesCatDesc").val(arr[1]);
				$("#facilitiesfloor").val(arr[2]);
				$("#facilitiesunit").val(arr[3]);
				$("#facilitiesCatstatus").val(arr[4]);
			}
		})
	}

function showfloor2(){
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_facilities/class.php',
		data: 'form=showfloor',
	success:function(data){
			$("#facilitiesfloor").html(data);
		}
	})
}

function showunit2(){
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_facilities/class.php',
		data: 'form=showunit',
	success:function(data){
			$("#facilitiesunit").html(data);
		}
	})
}

function clickAddfacilitiesCat() {
	$("#tblfacilities_category tr").unbind("click");
	$("#tblfacilities_category tr").removeClass("bg-selected");
	$("#buttonsfacilitiesCat").css("display", "none");
	$("#savingbuttonsfacilitiesCat").css("display", "block");
	$(".txtfacilitiesCat").removeAttr("readonly");
	$(".txtfacilitiesCat2").attr("disabled", false);
	$(".txtfacilitiesCat").val("");
	$(".txtfacilitiesCat2").val("");
}

function cancelbuttonfacilitiesCat() {
	// deptselected();
	// displayDepartment2();
	$("#buttonsfacilitiesCat").css("display", "block");
	$("#savingbuttonsfacilitiesCat").css("display", "none");
	$("#updatebuttonsfacilitiesCat").css("display", "none");
	$(".txtfacilitiesCat").attr("readonly", "readonly");
	$(".txtfacilitiesCat2").attr("disabled", true);
	$(".txtfacilitiesCat").val("");
	$(".txtfacilitiesCat2").val("");
	showmainfacilities2();
}

function cancelbuttonfacilitiesCat2() {
	// deptselected();
	// displayDepartment2();
	$("#buttonsfacilitiesCat").css("display", "block");
	$("#updatebuttonsfacilitiesCat").css("display", "none");
	$("#savingbuttonsfacilitiesCat").css("display", "none");
	$(".txtfacilitiesCat").attr("readonly", "readonly");
	$(".txtfacilitiesCat2").attr("disabled", true);
	showmainfacilities2();
}

function clickUpdatefacilitiesCat() {
	var facilitiesCatCode = $("#facilitiesCatCode").val();
	if ( facilitiesCatCode == "" ) {
		showmodal("alert", "Select code first.", "", null, "", null, "0");
	}

	else if ( facilitiesCatCode == "" ) {
		showmodal("alert", "Select description first.", "", null, "", null, "0");
	}

	else {
		$("#tblfacilities_category tr").unbind("click");
		$("#buttonsfacilitiesCat").css("display", "none");
		$("#updatebuttonsfacilitiesCat").css("display", "block");
		$(".txtfacilitiesCat").removeAttr("readonly");
		$(".txtfacilitiesCat2").attr("disabled", false);
		$("#facilitiesCatCode").attr("readonly", "readonly")
	}
}

function savefacilitiesCat() {
	var	facilitiesCatCode = $("#facilitiesCatCode").val();
	var	facilitiesCatDesc = $("#facilitiesCatDesc").val();
	var	facilitiesfloor = $("#facilitiesfloor").val();
	var	facilitiesunit = $("#facilitiesunit").val();
	var	facilitiesCatstatus = $("#facilitiesCatstatus").val();
	if($("#facilitiesCatCode").val()!="" && $("#facilitiesCatDesc").val()!="" && $("#facilitiesfloor").val()!="" && $("#facilitiesCatstatus").val()!="")
    {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_facilities/class.php',
			data: 'facilitiesCatCode=' + facilitiesCatCode + '&facilitiesCatDesc=' + facilitiesCatDesc + '&facilitiesfloor=' + facilitiesfloor + '&facilitiesunit=' + facilitiesunit + '&facilitiesCatstatus=' + facilitiesCatstatus + '&form=savefacilitiesCat',
			success: function (data) {
				if ( data == 1 ) {
					showmodal("alert", "Saved.", "", null, "", null, "0");
					cancelbuttonfacilitiesCat();
					showmainfacilities2();
				}
				else {
					showmodal("alert", data, "", null, "", null, "0");
				}
			}
		})
	}else{
			alert("PLEASE FILL UP ALL FIELDS");
	}
}

function updatefacilitiesCat() {
	var	facilitiesCatCode = $("#facilitiesCatCode").val();
	var	facilitiesCatDesc = $("#facilitiesCatDesc").val();
	var	facilitiesfloor = $("#facilitiesfloor").val();
	var	facilitiesunit = $("#facilitiesunit").val();
	var	facilitiesCatstatus = $("#facilitiesCatstatus").val();

	$.ajax ({
		type: 'POST',
		url: 'setup/referentialFiles/main_facilities/class.php',
		data: 'facilitiesCatCode=' + facilitiesCatCode + '&facilitiesCatDesc=' + facilitiesCatDesc + '&facilitiesfloor=' + facilitiesfloor + '&facilitiesunit=' + facilitiesunit + '&facilitiesCatstatus=' + facilitiesCatstatus + '&form=updatefacilitiesCat',
		success: function (data) {
			if ( data == 1 ) {
				showmodal("alert", "Saved.", "", null, "", null, "0");
				cancelbuttonfacilitiesCat();
				showmainfacilities2();
			}
			else {
				showmodal("alert", data, "", null, "", null, "0");
			}
		}
	})
}

function clickDeletefacilitiesCat() {
	var	facilitiesCatCode = $("#facilitiesCatCode").val();
	var	facilitiesCatDesc = $("#facilitiesCatDesc").val();

	if ( facilitiesCatCode == "" ) {
		alert("Select code first.");
	}

	else if ( facilitiesCatDesc == "" ) {
		alert("Select description first.");
	}

	else {
		if ( confirm( "Are you sure you want to delete " + facilitiesCatDesc ) == true ) {
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/main_facilities/class.php',
				data: 'facilitiesCatCode=' + facilitiesCatCode + '&facilitiesCatDesc=' + facilitiesCatDesc + '&form=clickDeletefacilitiesCat',
				success: function (data) {
					if ( data == 1 ) {
						showmodal("alert", facilitiesCatDesc+" has been deleted.", "", null, "", null, "0");
						showmainfacilities2();
						cancelbuttonfacilitiesCat();
					}

					else {
						showmodal("alert", data, "", null, "", null, "0");
					}
				}
			})
		}
	}
}
</script>