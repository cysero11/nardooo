<script type="text/javascript">

$(function()
{
	blocking();
}); 

	setTimeout(function() {
		displayDept();
		selectedClassification();
	}, 300)

	clickRefs()

	var count102 = 0;

	function displayDept2() {
		count102 = 0;
		displayDept();
	}
	
	
	function blocking()
	{
		$("#deptCode").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*()0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	 $("#deptDesc").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*()0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	
	 
	}//end
	
	
	

	function displayDept() {
		var key = $("#txtsearchdept").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_dept/class.php',
			data: 'count102=' + count102 + '&key=' + key + '&form=displayDept',
			success: function(data) {
				var arr = data.split("|");
				$("#tblref_merchandise_depa").html(arr[0]);
				$("#deptcounts").val(arr[1]);
				deptSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first102").attr("disabled", "disabled");
					$("#btn-prev102").attr("disabled", "disabled");
					$("#btn-next102").attr("disabled", "disabled");
					$("#btn-last102").attr("disabled", "disabled");
				}

				else {
					if ( count102 == 0 ) {
						$("#btn-first102").attr("disabled", "disabled");
						$("#btn-prev102").attr("disabled", "disabled");
						$("#btn-next102").removeAttr("disabled");
						$("#btn-last102").removeAttr("disabled");
					}

					else if ( count102 == $("#deptcounts").val() * 10 ) {
						$("#btn-first102").removeAttr("disabled");
						$("#btn-prev102").removeAttr("disabled");
						$("#btn-next102").attr("disabled", "disabled");
						$("#btn-last102").attr("disabled", "disabled");
					}

					else {
						$("#btn-first102").removeAttr("disabled");
						$("#btn-prev102").removeAttr("disabled");
						$("#btn-next102").removeAttr("disabled");
						$("#btn-last102").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page102(txt) {
		if ( txt == 'first' ) {
			count102 = 0;
			displayDept();
		}

		else if ( txt == "prev" ) {
			count102 = count102 - 10;
			displayDept();
		}

		else if ( txt == "next" ) {
			count102 = count102 + 10;
			displayDept();
		}

		else {
			count102 = $("#deptcounts").val() * 10;
			displayDept();
		}
	}

	function deptSelected() {
		$("#tblref_merchandise_depa tr").each(function(){
			$(this).click(function(){
				$("#tblref_merchandise_depa tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedDept(this.id);
			})
		})
	}

	function selectedDept(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_dept/class.php',
			data: 'id=' + id + '&form=selectedDept',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddendeptid").val(arr[0]);
				$("#classId").val(arr[0]);
				$("#deptCode").val(arr[1]);
				$("#deptDesc").val(arr[2]);
			}
		})
	}

	function clickAddDept() {
		selectedClassification();
		$("#tblref_merchandise_depa tr").unbind("click");
		$("#tblref_merchandise_depa tr").removeClass("bg-selected");
		$("#buttonsDept").css("display", "none");
		$("#savingbuttonsDept").css("display", "block");
		$(".txtDept").removeAttr("readonly");
		$("#classId").removeAttr("disabled");
		$(".txtDept").val("");

	}

	function cancelbuttonDept() {
		deptSelected();
		displayDept2();
		$("#buttonsDept").css("display", "block");
		$("#savingbuttonsDept").css("display", "none");
		$(".txtDept").attr("readonly", "readonly");
		$("#classId").attr("disabled","disabled");
		$(".txtDept").val("");
	}

	function cancelbuttonDept2() {
		// deptselected();
		displayDept2();
		$("#buttonsDept").css("display", "block");
		$("#updatebuttonsDept").css("display", "none");
		$(".txtDept").attr("readonly", "readonly");
		$("#classId").attr("disabled","disabled");
	}

	function saveDept() {
		var deptCode = $("#deptCode").val();
		var deptDesc = $("#deptDesc").val();
		var classId = $("#classId").val();
		 

		if($("#deptCode").val()!=""&&$("#deptDesc").val()!="") 
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_dept/class.php',
			data: 'classId=' + classId + '&deptCode=' + deptCode + '&deptDesc=' + deptDesc + '&form=saveDept',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonDept();
					displayDept2();
				}

				else {
					alert(data);
				}
			}
		})
		}
		else
		{
			alert("PLEASE FILL UP ALL FIELDS");
		}
	}//end

	function clickUpdateDept() {
		var deptCode = $("#deptCode").val();
		if ( deptCode == "" ) {
			alert("Select department first");
		}

		else {
			$.ajax({
				type: 'POST',
				url: 'setup/referentialFiles/unit_dept/class.php',
				data: 'deptCode=' + deptCode + '&form=clickUpdateDept',
				success:function(data){
					if(data == 0){
						$("#tblref_merchandise_depa tr").unbind("click");
						$("#buttonsDept").css("display", "none");
						$("#updatebuttonsDept").css("display", "block");
						$(".txtDept").removeAttr("readonly");
					}else{
						$("#tblref_merchandise_depa tr").unbind("click");
						$("#buttonsDept").css("display", "none");
						$("#updatebuttonsDept").css("display", "block");
						$("#deptDesc").removeAttr("readonly");
					}
				}
			})

			
		}
	}

	function updateDept() {
		var hiddendeptid = $("#hiddendeptid").val();
		var deptCode = $("#deptCode").val();
		var deptDesc = $("#deptDesc").val();
		var classId = $("#classId").val();

		if($("#deptCode").val()!=""&&$("#deptDesc").val()!="")
		{			
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_dept/class.php',
			data: 'classId=' + classId + '&hiddendeptid=' + hiddendeptid + '&deptCode=' + deptCode + '&deptDesc=' + deptDesc + '&form=updateDept',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonDept();
					cancelbuttonDept2();
					displayDept2();
				}

				else {
					alert(data);
				}
			}
		})
		}
		else
		{
			alert("PLEASE FILL UP ALL FIELDS");
		}
	}//end

	function clickDeleteDept() {
		var deptCode = $("#deptCode").val();
		var deptDesc = $("#deptDesc").val();
		var classId = $("#classId").val();

		if ( deptCode == "" ) {
			alert("Select code first");
		}

		else if  ( classId == "" ) {
			alert("Select classification first");
		}

		else if  ( deptDesc == "" ) {
			alert("Select description first");
		}


		else {
			if ( confirm( "Are you sure you want to delete " + deptDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/unit_dept/class.php',
					data: 'classId=' + classId + '&deptCode=' + deptCode + '&deptDesc=' + deptDesc + '&form=deleteClass',
					success: function (data) {
						if ( data == 1 ) {
							alert(deptDesc + " has been deleted.");
							cancelbuttonDept2();
							cancelbuttonDept();
							displayClass2();
						}

						else {
							alert(data);
						}
					}
				})
			}
		}
	}

	function selectedClassification() {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_dept/class.php',
			data: 'classId=' + classId + '&form=listClassification',
			success: function(data) {
				//alert(data);
				$("#classId").html(data);			
				//$("#classId").html(data);
			}
		})
	}
</script>