<script type="text/javascript">
setTimeout(function() {
	showmainequip();
	showfloor();
	showunit();
}, 300)

var count54 = 0;

function showmainequip2(){
	count54 = 0;
	showmainequip();
}

function showmainequip(){
	var key = $("#txtsearchequipCat").val();
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_equipment/class.php',
		data: 'count54=' + count54 + '&key=' + key + '&form=showmainequip',
	success:function(data){
			var arr = data.split("|");
				$("#tblequipment_category").html(arr[0]);
				$("#equipcatcounts").val(arr[1]);
				equipCatSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first54").attr("disabled", "disabled");
					$("#btn-prev54").attr("disabled", "disabled");
					$("#btn-next54").attr("disabled", "disabled");
					$("#btn-last54").attr("disabled", "disabled");
				}

				else {
					if ( count54 == 0 ) {
						$("#btn-first54").attr("disabled", "disabled");
						$("#btn-prev54").attr("disabled", "disabled");
						$("#btn-next54").removeAttr("disabled");
						$("#btn-last54").removeAttr("disabled");
					}

					else if ( count54 == $("#equipcatcounts").val() * 10 ) {
						$("#btn-first54").removeAttr("disabled");
						$("#btn-prev54").removeAttr("disabled");
						$("#btn-next54").attr("disabled", "disabled");
						$("#btn-last54").attr("disabled", "disabled");
					}

					else {
						$("#btn-first54").removeAttr("disabled");
						$("#btn-prev54").removeAttr("disabled");
						$("#btn-next54").removeAttr("disabled");
						$("#btn-last54").removeAttr("disabled");
					}
				}
		}
	})
}

function page54(txt) {
	if ( txt == 'first' ) {
		count54 = 0;
		showmainequip();
	}

	else if ( txt == "prev" ) {
		count54 = count54 - 10;
		showmainequip();
	}

	else if ( txt == "next" ) {
		count54 = count54 + 10;
		showmainequip();
	}

	else {
		count54 = $("#maincatcounts").val() * 10;
		showmainequip();
	}
}

function equipCatSelected() {
	$("#tblequipment_category tr").each(function(){
		$(this).click(function(){
			$("#tblequipment_category tr").removeClass("bg-info");
			$(this).addClass("bg-info");
			selectedequipCat(this.id);
		})
	})
}

function selectedequipCat(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_equipment/class.php',
			data: 'id=' + id + '&form=selectedequipCat',
			success: function(data) {
				var arr = data.split("|");
				$("#equipCatCode").val(arr[0]);
				$("#equipCatDesc").val(arr[1]);
				$("#eqfloor").val(arr[2]);
				$("#equnit").val(arr[3]);
				$("#equipCatstatus").val(arr[4]);
			}
		})
	}

function showfloor(){
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_equipment/class.php',
		data: 'form=showfloor',
	success:function(data){
			$("#eqfloor").html(data);
		}
	})
}

function showunit(){
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_equipment/class.php',
		data: 'form=showunit',
	success:function(data){
			$("#equnit").html(data);
		}
	})
}

function clickAddequipCat() {
	$("#tblequipment_category tr").unbind("click");
	$("#tblequipment_category tr").removeClass("bg-selected");
	$("#buttonsequipCat").css("display", "none");
	$("#savingbuttonsequipCat").css("display", "block");
	$(".txtequipCat").removeAttr("readonly");
	$(".txtequipCat2").attr("disabled", false);
	$(".txtequipCat").val("");
	$(".txtequipCat2").val("");
}

function cancelbuttonequipCat() {
	// deptselected();
	// displayDepartment2();
	$("#buttonsequipCat").css("display", "block");
	$("#savingbuttonsequipCat").css("display", "none");
	$("#updatebuttonsequipCat").css("display", "none");
	$(".txtequipCat").attr("readonly", "readonly");
	$(".txtequipCat2").attr("disabled", true);
	$(".txtequipCat").val("");
	$(".txtequipCat2").val("");
	showmainequip2();
}

function cancelbuttonequipCat2() {
	// deptselected();
	showmainequip2();
	$("#buttonsequipCat").css("display", "block");
	$("#updatebuttonsequipCat").css("display", "none");
	$("#savingbuttonsequipCat").css("display", "none");
	$(".txtequipCat").attr("readonly", "readonly");
	$(".txtequipCat2").attr("disabled", true);
	showmainequip2();
}

function clickUpdateequipCat() {
	var equipCatCode = $("#equipCatCode").val();
	var equipCatDesc = $("#equipCatDesc").val();
	if ( equipCatCode == "" ) {
		showmodal("alert", "Select code first.", "", null, "", null, "0");
	}

	else if ( equipCatDesc == "" ) {
		showmodal("alert", "Select description first.", "", null, "", null, "0");
	}

	else {
		$.ajax({
			type: 'POST',
			url: 'setup/referentialFiles/main_equipment/class.php',
			data: 'equipCatCode=' + equipCatCode + '&form=clickUpdateequipCat',
			success:function(data){
					if(data == 0){
						$("#tblequipment_category tr").unbind("click");
						$("#buttonsequipCat").css("display", "none");
						$("#updatebuttonsequipCat").css("display", "block");
						$(".txtequipCat").removeAttr("readonly");
						$(".txtequipCat2").attr("disabled", false);
					}else{
						$("#tblequipment_category tr").unbind("click");
						$("#buttonsequipCat").css("display", "none");
						$("#updatebuttonsequipCat").css("display", "block");
						$(".txtequipCat").removeAttr("readonly");
						$(".txtequipCat2").attr("disabled", false);
						$("#equipCatCode").attr("readonly", "readonly");
					}
			}
		})
		
	}
}

function saveequipCat() {
	var	equipCatCode = $("#equipCatCode").val();
	var	equipCatDesc = $("#equipCatDesc").val();
	var	eqfloor = $("#eqfloor").val();
	var	equnit = $("#equnit").val();
	var	equipCatstatus = $("#equipCatstatus").val();
	if($("#equipCatCode").val()!="" && $("#equipCatDesc").val()!="" && $("#eqfloor").val()!="" && $("#equipCatstatus").val()!="")
    {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_equipment/class.php',
			data: 'equipCatCode=' + equipCatCode + '&equipCatDesc=' + equipCatDesc + '&eqfloor=' + eqfloor + '&equnit=' + equnit + '&equipCatstatus=' + equipCatstatus + '&form=saveequipCat',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonequipCat();
					showmainequip2();
				}
				else {
					alert(data);
				}
			}
		})
	}else{
			alert("PLEASE FILL UP ALL FIELDS");
	}
}

function updateequipCat() {
	var	equipCatCode = $("#equipCatCode").val();
	var	equipCatDesc = $("#equipCatDesc").val();
	var	eqfloor = $("#eqfloor").val();
	var	equnit = $("#equnit").val();
	var	equipCatstatus = $("#equipCatstatus").val();

	$.ajax ({
		type: 'POST',
		url: 'setup/referentialFiles/main_equipment/class.php',
		data: 'equipCatCode=' + equipCatCode + '&equipCatDesc=' + equipCatDesc + '&eqfloor=' + eqfloor + '&equnit=' + equnit + '&equipCatstatus=' + equipCatstatus + '&form=updateequipCat',
		success: function (data) {
			if ( data == 1 ) {
				showmodal("alert", "Saved.", "", null, "", null, "0");
				cancelbuttonequipCat();
				cancelbuttonequipCat2()
				showmainequip2();
			}
			else {
				showmodal("alert", data, "", null, "", null, "0");
			}
		}
	})
}

function clickDeleteequipCat() {
	var	equipCatCode = $("#equipCatCode").val();
	var	equipCatDesc = $("#equipCatDesc").val();

	if ( equipCatCode == "" ) {
		alert("Select code first.");
	}

	else if ( equipCatDesc == "" ) {
		alert("Select description first.");
	}

	else {
		if ( confirm( "Are you sure you want to delete " + equipCatDesc ) == true ) {
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/main_equipment/class.php',
				data: 'equipCatCode=' + equipCatCode + '&equipCatDesc=' + equipCatDesc + '&form=clickDeleteequipCat',
				success: function (data) {
					if ( data == 1 ) {
						showmodal("alert", equipCatDesc+" has been deleted.", "", null, "", null, "0");
						cancelbuttonequipCat();
						cancelbuttonequipCat2();
						showmainequip2();
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