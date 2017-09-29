<script type="text/javascript">
setTimeout(function() {
	showmainDepartment();
}, 300)

var count552 = 0;

function showmainDepartment2(){
	count552 = 0;
	showmainDepartment();
}

function showmainDepartment(){
	var key = $("#txtsearchDepartmentCat").val();
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_Department/class.php',
		data: 'count552=' + count552 + '&key=' + key + '&form=showmainDepartment',
	success:function(data){
			var arr = data.split("|");
				$("#tblDepartment_category").html(arr[0]);
				$("#Departmentcatcounts").val(arr[1]);
				DepartmentCatSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first552").attr("disabled", "disabled");
					$("#btn-prev552").attr("disabled", "disabled");
					$("#btn-next552").attr("disabled", "disabled");
					$("#btn-last552").attr("disabled", "disabled");
				}

				else {
					if ( count552 == 0 ) {
						$("#btn-first552").attr("disabled", "disabled");
						$("#btn-prev552").attr("disabled", "disabled");
						$("#btn-next552").removeAttr("disabled");
						$("#btn-last552").removeAttr("disabled");
					}

					else if ( count552 == $("#Departmentcatcounts").val() * 10 ) {
						$("#btn-first552").removeAttr("disabled");
						$("#btn-prev552").removeAttr("disabled");
						$("#btn-next552").attr("disabled", "disabled");
						$("#btn-last552").attr("disabled", "disabled");
					}

					else {
						$("#btn-first552").removeAttr("disabled");
						$("#btn-prev552").removeAttr("disabled");
						$("#btn-next552").removeAttr("disabled");
						$("#btn-last552").removeAttr("disabled");
					}
				}
		}
	})
}

function page552(txt) {
	if ( txt == 'first' ) {
		count552 = 0;
		showmainDepartment();
	}

	else if ( txt == "prev" ) {
		count552 = count552 - 10;
		showmainDepartment();
	}

	else if ( txt == "next" ) {
		count552 = count552 + 10;
		showmainDepartment();
	}

	else {
		count552 = $("#Departmentcatcounts").val() * 10;
		showmainDepartment();
	}
}

function DepartmentCatSelected() {
	$("#tblDepartment_category tr").each(function(){
		$(this).click(function(){
			$("#tblDepartment_category tr").removeClass("bg-info");
			$(this).addClass("bg-info");
			selectedDepartmentCat(this.id);
		})
	})
}

function selectedDepartmentCat(id) {
	$("#hiddenDepartmentcatid").val(id);
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_Department/class.php',
			data: 'id=' + id + '&form=selectedDepartmentCat',
			success: function(data) {
				var arr = data.split("|");
				$("#DepartmentCatCode").val(arr[0]);
				$("#DepartmentCatDesc").val(arr[1]);
			}
		})
	}

function clickAddDepartmentCat() {
	$("#tblDepartment_category tr").unbind("click");
	$("#tblDepartment_category tr").removeClass("bg-selected");
	$("#buttonsDepartmentCat").css("display", "none");
	$("#savingbuttonsDepartmentCat").css("display", "block");
	$(".txtDepartmentCat").val("");
	$(".txtDepartmentCat").removeAttr("readonly");
}

function cancelbuttonDepartmentCat() {
	// deptselected();
	// displayDepartment2();
	$("#buttonsDepartmentCat").css("display", "block");
	$("#savingbuttonsDepartmentCat").css("display", "none");
	$("#updatebuttonsDepartmentCat").css("display", "none");
	$(".txtDepartmentCat").attr("readonly", "readonly");
	$(".txtDepartmentCat").val("");
	showmainDepartment2();
}

function cancelbuttonDepartmentCat2() {
	// deptselected();
	// displayDepartment2();
	$("#buttonsDepartmentCat").css("display", "block");
	$("#updatebuttonsDepartmentCat").css("display", "none");
	$("#savingbuttonsDepartmentCat").css("display", "none");
	$(".txtDepartmentCat").attr("readonly", "readonly");
	showmainDepartment2();
}

function clickUpdateDepartmentCat() {
	var DepartmentCatCode = $("#DepartmentCatCode").val();
		if ( DepartmentCatCode == "" ) {
			alert("Select code first");
		}

		else if ( DepartmentCatDesc == "" ) {
			alert("Select description first");
		}

		else {
			$.ajax({
				type: 'POST',
				url: 'setup/referentialFiles/main_Department/class.php',
				data: 'DepartmentCatCode=' + DepartmentCatCode + '&form=clickUpdateMainDepartment',
				success:function(data){
					if(data == 0){
						$("#tblDepartment_category tr").unbind("click");
						$("#buttonsDepartmentCat").css("display", "none");
						$("#updatebuttonsDepartmentCat").css("display", "block");
						$(".txtDepartmentCat").removeAttr("readonly");
					}else{
						$("#tblDepartment_category tr").unbind("click");
						$("#buttonsDepartmentCat").css("display", "none");
						$("#updatebuttonsDepartmentCat").css("display", "block");
						$("#DepartmentCatDesc").removeAttr("readonly");
					}
				}
			})
			
		}
}

function saveDepartmentCat() {
	var	DepartmentCatCode = $("#DepartmentCatCode").val();
	var	DepartmentCatDesc = $("#DepartmentCatDesc").val();
	if($("#DepartmentCatCode").val()!="" && $("#DepartmentCatDesc").val()!="")
    {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_Department/class.php',
			data: 'DepartmentCatCode=' + DepartmentCatCode + '&DepartmentCatDesc=' + DepartmentCatDesc + '&form=saveDepartmentCat',
			success: function (data) {
				if ( data == 1 ) {
					showmodal("alert", "Saved.", "", null, "", null, "0");
					cancelbuttonDepartmentCat();
					showmainDepartment2();
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

function updateDepartmentCat() {
	var	DepartmentCatCode = $("#DepartmentCatCode").val();
	var	DepartmentCatDesc = $("#DepartmentCatDesc").val();
	var id = $("#hiddenDepartmentcatid").val();

	$.ajax ({
		type: 'POST',
		url: 'setup/referentialFiles/main_Department/class.php',
		data: 'DepartmentCatCode=' + DepartmentCatCode + '&DepartmentCatDesc=' + DepartmentCatDesc + '&id=' + id + '&form=updateDepartmentCat',
		success: function (data) {
			if ( data == 1 ) {
				showmodal("alert", "Saved.", "", null, "", null, "0");
				cancelbuttonDepartmentCat();
				showmainDepartment2();
			}
			else {
				showmodal("alert", data, "", null, "", null, "0");
			}
		}
	})
}

function clickDeleteDepartmentCat() {
	var	DepartmentCatCode = $("#DepartmentCatCode").val();
	var	DepartmentCatDesc = $("#DepartmentCatDesc").val();

	if ( DepartmentCatCode == "" ) {
		alert("Select code first.");
	}

	else if ( DepartmentCatDesc == "" ) {
		alert("Select description first.");
	}

	else {
		if ( confirm( "Are you sure you want to delete " + DepartmentCatDesc ) == true ) {
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/main_Department/class.php',
				data: 'DepartmentCatCode=' + DepartmentCatCode + '&DepartmentCatDesc=' + DepartmentCatDesc + '&form=clickDeleteDepartmentCat',
				success: function (data) {
					if ( data == 1 ) {
						showmodal("alert", DepartmentCatDesc+" has been deleted.", "", null, "", null, "0");
						showmainDepartment2();
						cancelbuttonDepartmentCat();
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