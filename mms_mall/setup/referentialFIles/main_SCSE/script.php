<script type="text/javascript">
setTimeout(function() {
	showmainscse();
	showfloor3();
	showunit3();
}, 300)

var count55 = 0;

function showmainscse2(){
	count55 = 0;
	showmainscse();
}

function showmainscse(){
	var key = $("#txtsearchscseCat").val();
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_SCSE/class.php',
		data: 'count55=' + count55 + '&key=' + key + '&form=showmainscse',
	success:function(data){
			var arr = data.split("|");
				$("#tblSCSE_category").html(arr[0]);
				$("#scsecatcounts").val(arr[1]);
				scseCatSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first55").attr("disabled", "disabled");
					$("#btn-prev55").attr("disabled", "disabled");
					$("#btn-next55").attr("disabled", "disabled");
					$("#btn-last55").attr("disabled", "disabled");
				}

				else {
					if ( count55 == 0 ) {
						$("#btn-first55").attr("disabled", "disabled");
						$("#btn-prev55").attr("disabled", "disabled");
						$("#btn-next55").removeAttr("disabled");
						$("#btn-last55").removeAttr("disabled");
					}

					else if ( count55 == $("#scsecatcounts").val() * 10 ) {
						$("#btn-first55").removeAttr("disabled");
						$("#btn-prev55").removeAttr("disabled");
						$("#btn-next55").attr("disabled", "disabled");
						$("#btn-last55").attr("disabled", "disabled");
					}

					else {
						$("#btn-first55").removeAttr("disabled");
						$("#btn-prev55").removeAttr("disabled");
						$("#btn-next55").removeAttr("disabled");
						$("#btn-last55").removeAttr("disabled");
					}
				}
		}
	})
}

function page55(txt) {
	if ( txt == 'first' ) {
		count55 = 0;
		showmainscse();
	}

	else if ( txt == "prev" ) {
		count55 = count55 - 10;
		showmainscse();
	}

	else if ( txt == "next" ) {
		count55 = count55 + 10;
		showmainscse();
	}

	else {
		count55 = $("#maincatcounts").val() * 10;
		showmainscse();
	}
}

function scseCatSelected() {
	$("#tblSCSE_category tr").each(function(){
		$(this).click(function(){
			$("#tblSCSE_category tr").removeClass("bg-info");
			$(this).addClass("bg-info");
			selectedscseCat(this.id);
		})
	})
}

function selectedscseCat(id) {
	$.ajax ({
		type: 'POST',
		url: 'setup/referentialFiles/main_SCSE/class.php',
		data: 'id=' + id + '&form=selectedscseCat',
		success: function(data) {
			var arr = data.split("|");
			$("#scseCatCode").val(arr[0]);
			$("#scseCatDesc").val(arr[1]);
			$("#scsefloor").val(arr[2]);
			$("#scseunit").val(arr[3]);
			$("#scseCatstatus").val(arr[4]);
		}
	})
}

function showfloor3(){
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_SCSE/class.php',
		data: 'form=showfloor',
	success:function(data){
			$("#scsefloor").html(data);
		}
	})
}

function showunit3(){
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_SCSE/class.php',
		data: 'form=showunit',
	success:function(data){
			$("#scseunit").html(data);
		}
	})
}

function clickAddscseCat() {
	$("#tblSCSE_category tr").unbind("click");
	$("#tblSCSE_category tr").removeClass("bg-selected");
	$("#buttonsscseCat").css("display", "none");
	$("#savingbuttonsscseCat").css("display", "block");
	$(".txtscseCat").removeAttr("readonly");
	$(".txtscseCat2").attr("disabled", false);
	$(".txtscseCat").val("");
	$(".txtscseCat2").val("");
}

function cancelbuttonscseCat() {
	// deptselected();
	// displayDepartment2();
	$("#buttonsscseCat").css("display", "block");
	$("#savingbuttonsscseCat").css("display", "none");
	$("#updatebuttonsscseCat").css("display", "none");
	$(".txtscseCat").attr("readonly", "readonly");
	$(".txtscseCat2").attr("disabled", true);
	$(".txtscseCat").val("");
	$(".txtscseCat2").val("");
	showmainscse2();
}

function cancelbuttonscseCat2() {
	// deptselected();
	// displayDepartment2();
	$("#buttonsscseCat").css("display", "block");
	$("#updatebuttonsscseCat").css("display", "none");
	$("#savingbuttonsscseCat").css("display", "none");
	$(".txtscseCat").attr("readonly", "readonly");
	$(".txtscseCat2").attr("disabled", true);
	showmainscse2();
}

function clickUpdatescseCat() {
	var scseCatCode = $("#scseCatCode").val();
	if ( scseCatCode == "" ) {
		showmodal("alert", "Select code first.", "", null, "", null, "0");
	}

	else if ( scseCatCode == "" ) {
		showmodal("alert", "Select description first.", "", null, "", null, "0");
	}

	else {
		$("#tblSCSE_category tr").unbind("click");
		$("#buttonsscseCat").css("display", "none");
		$("#updatebuttonsscseCat").css("display", "block");
		$(".txtscseCat").removeAttr("readonly");
		$(".txtscseCat2").attr("disabled", false);
		$("#scseCatCode").attr("readonly", "readonly");
	}
}

function savescseCat() {
	var	scseCatCode = $("#scseCatCode").val();
	var	scseCatDesc = $("#scseCatDesc").val();
	var	scsefloor = $("#scsefloor").val();
	var	scseunit = $("#scseunit").val();
	var	scseCatstatus = $("#scseCatstatus").val();
	if($("#scseCatCode").val()!="" && $("#scseCatDesc").val()!="" && $("#scsefloor").val()!="" && $("#scseCatstatus").val()!="")
    {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_SCSE/class.php',
			data: 'scseCatCode=' + scseCatCode + '&scseCatDesc=' + scseCatDesc + '&scsefloor=' + scsefloor + '&scseunit=' + scseunit + '&scseCatstatus=' + scseCatstatus + '&form=savescseCat',
			success: function (data) {
				if ( data == 1 ) {
					showmodal("alert", "Saved.", "", null, "", null, "0");
					cancelbuttonscseCat();
					showmainscse2();
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

function updatescseCat() {
	var	scseCatCode = $("#scseCatCode").val();
	var	scseCatDesc = $("#scseCatDesc").val();
	var	scsefloor = $("#scsefloor").val();
	var	scseunit = $("#scseunit").val();
	var	scseCatstatus = $("#scseCatstatus").val();

	$.ajax ({
		type: 'POST',
		url: 'setup/referentialFiles/main_SCSE/class.php',
		data: 'scseCatCode=' + scseCatCode + '&scseCatDesc=' + scseCatDesc + '&scsefloor=' + scsefloor + '&scseunit=' + scseunit + '&scseCatstatus=' + scseCatstatus + '&form=updatescseCat',
		success: function (data) {
			if ( data == 1 ) {
				showmodal("alert", "Saved.", "", null, "", null, "0");
				cancelbuttonscseCat();
				cancelbuttonscseCat2();
				showmainscse2();
			}
			else {
				showmodal("alert", data, "", null, "", null, "0");
			}
		}
	})
}

function clickDeletescseCat() {
	var	scseCatCode = $("#scseCatCode").val();
	var	scseCatDesc = $("#scseCatDesc").val();

	if ( scseCatCode == "" ) {
		alert("Select code first.");
	}

	else if ( scseCatDesc == "" ) {
		alert("Select description first.");
	}

	else {
		if ( confirm( "Are you sure you want to delete " + scseCatDesc ) == true ) {
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/main_SCSE/class.php',
				data: 'scseCatCode=' + scseCatCode + '&scseCatDesc=' + scseCatDesc + '&form=clickDeletescseCat',
				success: function (data) {
					if ( data == 1 ) {
						showmodal("alert", scseCatDesc+" has been deleted.", "", null, "", null, "0");
						cancelbuttonscseCat2();
						cancelbuttonscseCat();
						showmainscse2();
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