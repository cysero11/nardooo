<script type="text/javascript">
$(function(){
	showtxtmall();
	displayEmployee();
	showEmpDepartment();
	showEmpPosition();
})

function showtxtmall(){
	displayEmployee();
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/em_Employee/class.php',
		data: 'form=showtxtmall',
		success:function(data){
			$("#txtmall").html(data);
		}
	})
}	

function showEmpDepartment(){
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/em_Employee/class.php',
		data: 'form=showEmpDepartment',
		success:function(data){
			$("#EmpDepartment").html(data);
		}
	})
}

clickRefs()

var count999 = 0;

function displayEmployee2() {
	count999 = 0;
	displayEmployee();
}

function displayEmployee() {
	var key = $("#txtsearchEmployee").val();

	$.ajax ({
		type: 'POST',
		url: 'setup/referentialFiles/em_Employee/class.php',
		data: 'count999=' + count999 + '&key=' + key + '&form=displayEmployee',
		success: function(data) {
			var arr = data.split("|");
			$("#tblEmployee").html(arr[0]);
			$("#Employeecounts").val(arr[1]);
			EmployeeSelected();
			if ( arr[1] == 0 ) {
				$("#btn-first999").attr("disabled", "disabled");
				$("#btn-prev999").attr("disabled", "disabled");
				$("#btn-next999").attr("disabled", "disabled");
				$("#btn-last999").attr("disabled", "disabled");
			}

			else {
				if ( count999 == 0 ) {
					$("#btn-first999").attr("disabled", "disabled");
					$("#btn-prev999").attr("disabled", "disabled");
					$("#btn-next999").removeAttr("disabled");
					$("#btn-last999").removeAttr("disabled");
				}

				else if ( count999 == $("#Employeecounts").val() * 10 ) {
					$("#btn-first999").removeAttr("disabled");
					$("#btn-prev999").removeAttr("disabled");
					$("#btn-next999").attr("disabled", "disabled");
					$("#btn-last999").attr("disabled", "disabled");
				}

				else {
					$("#btn-first999").removeAttr("disabled");
					$("#btn-prev999").removeAttr("disabled");
					$("#btn-next999").removeAttr("disabled");
					$("#btn-last999").removeAttr("disabled");
				}
			}
		}
	})
}

function page999(txt) {
	if ( txt == 'first' ) {
		count999 = 0;
		displayEmployee();
	}

	else if ( txt == "prev" ) {
		count999 = count999 - 10;
		displayEmployee();
	}

	else if ( txt == "next" ) {
		count999 = count999 + 10;
		displayEmployee();
	}

	else {
		count999 = $("#Employeecounts").val() * 10;
		displayEmployee();
	}
}

function EmployeeSelected() {
	$("#tblEmployee tr").each(function(){
		$(this).click(function(){
			$("#tblEmployee tr").removeClass("bg-info");
			$(this).addClass("bg-info");
			selectedEmployee(this.id);
			$("#hiddenemployeeid").val(this.id);
		})
	})
}

function selectedEmployee(id) {
	$.ajax ({
		type: 'POST',
		url: 'setup/referentialFiles/em_Employee/class.php',
		data: 'id=' + id + '&form=selectedEmployee',
		success: function(data) {
			var arr = data.split("|");
			$("#txtmall").val(arr[0]);
			$("#EmpCode").val(arr[1]);
			$("#EmpPosition").val(arr[2]);
			$("#EmpFN").val(arr[3]);
			$("#EmpMN").val(arr[4]);
			$("#EmpLN").val(arr[5]);
		}
	})
}

function clickAddEmployee() {
	$("#tblEmployee tr").unbind("click");
	$("#tblEmployee tr").removeClass("bg-selected");
	$("#buttonsEmployee").css("display", "none");
	$("#savingbuttonsEmployee").css("display", "block");
	$(".txtEmployee").removeAttr("readonly");
	$(".txtEmployee").val("");
	$(".txtEmployee2").prop("disabled", false);
	$(".txtEmployee2").val("");
}

function cancelbuttonEmployee() {
	EmployeeSelected();
	displayEmployee2();
	$("#buttonsEmployee").css("display", "block");
	$("#savingbuttonsEmployee").css("display", "none");
	$(".txtEmployee").attr("readonly", "readonly");
	$(".txtEmployee").val("");
	$(".txtEmployee2").prop("disabled", true);
	$(".txtEmployee2").val("");
}

function cancelbuttonEmployee2() {
	// deptselected();
	displayEmployee2();
	$("#buttonsEmployee").css("display", "block");
	$("#updatebuttonsEmployee").css("display", "none");
	$(".txtEmployee").attr("readonly", "readonly");
	$(".txtEmployee2").prop("disabled", true);
}

function saveEmployee() {
	var mallid = $("#txtmall").val();
	var Code = $("#EmpCode").val();
	var Position = $("#EmpPosition").val();
	var firstname = $("#EmpFN").val();
	var middlename = $("#EmpMN").val();
	var lastname = $("#EmpLN").val();
	var department = $("#EmpDepartment").val();
	if($("#txtmall").val() != "" && $("#EmpCode").val() != "" && $("#EmpPosition").val() != "" && $("#EmpFN").val() != "" && $("#EmpMN").val() != "" && $("#EmpLN").val() != "" && $("#EmpDepartment").val() != "")
    {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/em_Employee/class.php',
			data: 'mallid=' + mallid + '&Code=' + Code + '&Position=' + Position + '&firstname=' + firstname + '&middlename=' + middlename + '&lastname=' + lastname + '&department=' + department + '&form=saveEmployee',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonEmployee();
					displayEmployee2();
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

function clickUpdateEmployee() {
	var Code = $("#EmpCode").val();
	if ( Code == "" ) {
		alert("Select code first");
	}
	else {
		$.ajax({
			type: 'POST',
			url: 'setup/referentialFiles/em_Employee/class.php',
			data: 'Code=' + Code + '&form=clickUpdateEmployee',
			success:function(data){
				if(data == 0){
					$("#tblEmployee tr").unbind("click");
					$("#buttonsEmployee").css("display", "none");
					$("#updatebuttonsEmployee").css("display", "block");
					$(".txtEmployee").removeAttr("readonly");
					$(".txtEmployee2").prop("disabled", false);
				}else{
					$("#tblEmployee tr").unbind("click");
					$("#buttonsEmployee").css("display", "none");
					$("#updatebuttonsEmployee").css("display", "block");
					$(".txtEmployee").removeAttr("readonly");
					$("#EmpCode").attr("readonly", "readonly");
					$(".txtEmployee2").prop("disabled", false);
				}
			}
		})
		
	}
}

function updateEmployee() {
	var mallid = $("#txtmall").val();
	var Code = $("#EmpCode").val();
	var Position = $("#EmpPosition").val();
	var firstname = $("#EmpFN").val();
	var middlename = $("#EmpMN").val();
	var lastname = $("#EmpLN").val();
	var id = $("#hiddenemployeeid").val();
	var department = $("#EmpDepartment").val();

	if($("#EmployeeCode").val()!="" && $("#EmployeeDesc").val()!="")
    {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/em_Employee/class.php',
			data: 'id=' + id + '&mallid=' + mallid + '&Code=' + Code + '&Position=' + Position + '&firstname=' + firstname + '&middlename=' + middlename + '&lastname=' + lastname + '&department=' + department + '&form=updateEmployee',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonEmployee();
					cancelbuttonEmployee2();
					displayEmployee2();
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

function clickDeleteEmployee() {
	var Code = $("#EmpCode").val();
	var firstname = $("#EmpFN").val();
	var middlename = $("#EmpMN").val();
	var lastname = $("#EmpLN").val();

	var id = $("#hiddenemployeeid").val();
	if ( Code == "" ) {
		alert("Select code first.");
	}
	else {
		if ( confirm( "Are you sure you want to delete " + firstname + " " + middlename + " " + lastname ) == true ) {
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/em_Employee/class.php',
				data: 'id=' + id + '&form=deleteEmployee',
				success: function (data) {
					if ( data == 1 ) {
						alert(firstname + " " + middlename + " " + lastname + " has been deleted.");
						cancelbuttonEmployee2();
						cancelbuttonEmployee();
						displayEmployee2();
					}

					else {
						alert(data);
					}
				}
			})
		}
	}
}

function showEmpPosition(){
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/em_Employee/class.php',
		data: 'form=showEmpPosition',
		success:function(data){
			$("#EmpPosition").html(data);
		}
	})
}
</script>