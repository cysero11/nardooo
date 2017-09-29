<script type="text/javascript">
$(function()
{
	blocking();
});



	setTimeout(function() {
		displayUnitClass();
	}, 300)

	clickRefs()

	var count900 = 0;

	function displayUnitClass2() {
		count900 = 0;
		displayUnitClass();
	}
	
	
	function blocking()
	{
		$("#classCode").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*() 0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	 $("#classDesc").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*()0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	
	 
	}//end
	

	function displayUnitClass() {
		var key = $("#txtsearchunitclass").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_class/class.php',
			data: 'count900=' + count900 + '&key=' + key + '&form=displayUnitClass',
			success: function(data) {
				var arr = data.split("|");
				$("#tblref_merchandise_class").html(arr[0]);
				$("#classcounts").val(arr[1]);
				classselected();
				if ( arr[1] == 0 ) {
					$("#btn-first900").attr("disabled", "disabled");
					$("#btn-prev900").attr("disabled", "disabled");
					$("#btn-next900").attr("disabled", "disabled");
					$("#btn-last900").attr("disabled", "disabled");
				}

				else {
					if ( count900 == 0 ) {
						$("#btn-first900").attr("disabled", "disabled");
						$("#btn-prev900").attr("disabled", "disabled");
						$("#btn-next900").removeAttr("disabled");
						$("#btn-last900").removeAttr("disabled");
					}

					else if ( count900 == $("#classcounts").val() * 10 ) {
						$("#btn-first900").removeAttr("disabled");
						$("#btn-prev900").removeAttr("disabled");
						$("#btn-next900").attr("disabled", "disabled");
						$("#btn-last900").attr("disabled", "disabled");
					}

					else {
						$("#btn-first900").removeAttr("disabled");
						$("#btn-prev900").removeAttr("disabled");
						$("#btn-next900").removeAttr("disabled");
						$("#btn-last900").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page900(txt) {
		if ( txt == 'first' ) {
			count900 = 0;
			displayUnitClass();
		}

		else if ( txt == "prev" ) {
			count900 = count900 - 10;
			displayUnitClass();
		}

		else if ( txt == "next" ) {
			count900 = count900 + 10;
			displayUnitClass();
		}

		else {
			count900 = $("#classcounts").val() * 10;
			displayUnitClass();
		}
	}

	function classselected() {
		$("#tblref_merchandise_class tr").each(function(){
			$(this).click(function(){
				$("#tblref_merchandise_class tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedClass(this.id);
			})
		})
	}

	function selectedClass(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_class/class.php',
			data: 'id=' + id + '&form=selectedClass',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddenclassid").val(arr[0]);
				$("#classCode").val(arr[0]);
				$("#classDesc").val(arr[1]);
			}
		})
	}

	function clickAddClass() {
		$("#tblref_merchandise_class tr").unbind("click");
		$("#tblref_merchandise_class tr").removeClass("bg-selected");
		$("#buttonsClass").css("display", "none");
		$("#savingbuttonsClass").css("display", "block");
		$(".txtUnitClass").removeAttr("readonly");
		$(".txtUnitClass").val("");
	}

	function cancelbuttonClass() {
		classselected();
		displayUnitClass2();
		$("#buttonsClass").css("display", "block");
		$("#savingbuttonsClass").css("display", "none");
		$(".txtUnitClass").attr("readonly", "readonly");
		$(".txtUnitClass").val("");
	}

	function cancelbuttonClass2() {
		// deptselected();
		displayUnitClass2();
		$("#buttonsClass").css("display", "block");
		$("#updatebuttonsClass").css("display", "none");
		$(".txtUnitClass").attr("readonly", "readonly");
	}

	function saveClass() {
		var classCode = $("#classCode").val();
		var classDesc = $("#classDesc").val();

		if($("#classCode").val()!="" && $("#classDesc").val()!="" )
		{	
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_class/class.php',
			data: 'classCode=' + classCode + '&classDesc=' + classDesc + '&form=saveClass',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonClass();
					displayUnitClass2();
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

	function clickUpdateClass() {
		var classCode = $("#classCode").val();
		if ( classCode == "" ) {
			alert("Select class first");
		}

		else {
			$.ajax({
				type: 'POST',
				url: 'setup/referentialFiles/unit_class/class.php',
				data: 'classCode=' + classCode + '&form=clickUpdateClass',
				success:function(data){
					if(data == 0){
						$("#tblref_merchandise_class tr").unbind("click");
						$("#buttonsClass").css("display", "none");
						$("#updatebuttonsClass").css("display", "block");
						$(".txtUnitClass").removeAttr("readonly");
					}else{
						$("#tblref_merchandise_class tr").unbind("click");
						$("#buttonsClass").css("display", "none");
						$("#updatebuttonsClass").css("display", "block");
						$("#classDesc").removeAttr("readonly");
					}
				}
			})
			
		}
	}

	function updateClass() {
		
		var hiddenclassid = $("#hiddenclassid").val();
		var classCode = $("#classCode").val();
		var classDesc = $("#classDesc").val();

		if($("#classCode").val()!="" && $("#classDesc").val()!="" )
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_class/class.php',
			data: 'hiddenclassid=' + hiddenclassid + '&classCode=' + classCode + '&classDesc=' + classDesc + '&form=updateClass',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonClass();
					cancelbuttonClass2();
					displayUnitClass2();
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

	function clickDeleteClass() {
		var classCode = $("#classCode").val();
		var classDesc = $("#classDesc").val();

		if ( classCode == "" ) {
			alert("Select class first");
		}

		else {
			if ( confirm( "Are you sure you want to delete " + classDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/unit_class/class.php',
					data: 'classCode=' + classCode + '&classDesc=' + classDesc + '&form=deleteClass',
					success: function (data) {
						if ( data == 1 ) {
							alert(classDesc + " has been deleted.");
							cancelbuttonClass2();
							cancelbuttonClass();
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
</script>