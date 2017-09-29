<script type="text/javascript">

$(function()
{
	blocking();
});

	setTimeout(function() {
		displayPosition();
	}, 300)

	clickRefs()

	var count906 = 0;

	function displayPosition2() {
		count906 = 0;
		displayPosition();
	}
	
	
	function blocking()
	{
		$("#positionDesc").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*() 0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	
	}//end
	
	
	
	
	
	
	
	
	

	function displayPosition() {
		var key = $("#txtsearchposition").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_position/class.php',
			data: 'count906=' + count906 + '&key=' + key + '&form=displayPosition',
			success: function(data) {
				var arr = data.split("|");
				$("#tblref_companyposition").html(arr[0]);
				$("#positioncounts").val(arr[1]);
				positionSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first906").attr("disabled", "disabled");
					$("#btn-prev906").attr("disabled", "disabled");
					$("#btn-next906").attr("disabled", "disabled");
					$("#btn-last906").attr("disabled", "disabled");
				}

				else {
					if ( count906 == 0 ) {
						$("#btn-first906").attr("disabled", "disabled");
						$("#btn-prev906").attr("disabled", "disabled");
						$("#btn-next906").removeAttr("disabled");
						$("#btn-last906").removeAttr("disabled");
					}

					else if ( count906 == $("#positioncounts").val() * 10 ) {
						$("#btn-first906").removeAttr("disabled");
						$("#btn-prev906").removeAttr("disabled");
						$("#btn-next906").attr("disabled", "disabled");
						$("#btn-last906").attr("disabled", "disabled");
					}

					else {
						$("#btn-first906").removeAttr("disabled");
						$("#btn-prev906").removeAttr("disabled");
						$("#btn-next906").removeAttr("disabled");
						$("#btn-last906").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page906(txt) {
		if ( txt == 'first' ) {
			count906 = 0;
			displayPosition();
		}

		else if ( txt == "prev" ) {
			count906 = count906 - 10;
			displayPosition();
		}

		else if ( txt == "next" ) {
			count906 = count906 + 10;
			displayPosition();
		}

		else {
			count906 = $("#positioncounts").val() * 10;
			displayPosition();
		}
	}

	function positionSelected() {
		$("#tblref_companyposition tr").each(function(){
			$(this).click(function(){
				$("#tblref_companyposition tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedPosition(this.id);
			})
		})
	}

	function selectedPosition(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_position/class.php',
			data: 'id=' + id + '&form=selectedPosition',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddenpositionid").val(arr[0]);
				$("#positionDesc").val(arr[0]);
			}
		})
	}

	function clickAddPosition() {
		$("#tblref_companyposition tr").unbind("click");
		$("#tblref_companyposition tr").removeClass("bg-selected");
		$("#buttonsPosition").css("display", "none");
		$("#savingbuttonsPosition").css("display", "block");
		$(".txtPosition").removeAttr("readonly");
		$(".txtPosition").val("");
	}

	function cancelbuttonPosition() {
		positionSelected();
		displayPosition2();
		$("#buttonsPosition").css("display", "block");
		$("#savingbuttonsPosition").css("display", "none");
		$(".txtPosition").attr("readonly", "readonly");
		$(".txtPosition").val("");
	}

	function cancelbuttonPosition2() {
		// deptselected();
		// displayDepartment2();
		$("#buttonsPosition").css("display", "block");
		$("#updatebuttonsPosition").css("display", "none");
		$(".txtPosition").attr("readonly", "readonly");
	}

	function savePosition() {
		var positionDesc = $("#positionDesc").val();
		
        if($("#positionDesc").val()!="")
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_position/class.php',
			data: 'positionDesc=' + positionDesc + '&form=savePosition',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonPosition();
					displayPosition2();
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

	function clickUpdatePosition() {
		var positionDesc = $("#positionDesc").val();
		
		if ( positionDesc == "" ) {
			alert("Select description first");
		}

		else {
			$("#tblref_companyposition tr").unbind("click");
			$("#buttonsPosition").css("display", "none");
			$("#updatebuttonsPosition").css("display", "block");
			$(".txtPosition").removeAttr("readonly");
		}
	}

	function updatePosition() {
		var hiddenpositionid = $("#hiddenpositionid").val();
		var positionDesc = $("#positionDesc").val();

		if($("#positionDesc").val()!="")
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_position/class.php',
			data: 'hiddenpositionid=' + hiddenpositionid + '&positionDesc=' + positionDesc + '&form=updatePosition',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonPosition();
					cancelbuttonPosition2();
					displayPosition2();
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

	function clickDeletePosition() {
		var positionDesc = $("#positionDesc").val();

		if ( positionDesc == "" ) {
			alert("Select description first.");
		}

		else {
			if ( confirm( "Are you sure you want to delete " + positionDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/unit_position/class.php',
					data: 'positionDesc=' + positionDesc + '&form=deletePosition',
					success: function (data) {
						if ( data == 1 ) {
							alert(positionDesc + " has been deleted.");
							cancelbuttonPosition2();
							cancelbuttonPosition();
							displayPosition2();
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