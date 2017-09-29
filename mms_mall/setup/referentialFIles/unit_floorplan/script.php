<script type="text/javascript">
$(function()
{
	blocking();
});


	setTimeout(function() {
		displayFloor();
	}, 300)

	clickRefs()

	var count908 = 0;

	function displayFloor2() {
		count908 = 0;
		displayFloor();
	}
	
	function blocking()
	{
		$("#FloorDesc").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*() 0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	
	}//end
	
	
	
	
	
	
	

	function displayFloor() {
		var key = $("#txtsearchfloor").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_floorplan/class.php',
			data: 'count908=' + count908 + '&key=' + key + '&form=displayFloor',
			success: function(data) {
				var arr = data.split("|");
				$("#tblref_floors").html(arr[0]);
				$("#floorcounts").val(arr[1]);
				floorSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first908").attr("disabled", "disabled");
					$("#btn-prev908").attr("disabled", "disabled");
					$("#btn-next908").attr("disabled", "disabled");
					$("#btn-last908").attr("disabled", "disabled");
				}

				else {
					if ( count908 == 0 ) {
						$("#btn-first908").attr("disabled", "disabled");
						$("#btn-prev908").attr("disabled", "disabled");
						$("#btn-next908").removeAttr("disabled");
						$("#btn-last908").removeAttr("disabled");
					}

					else if ( count908 == $("#floorcounts").val() * 10 ) {
						$("#btn-first908").removeAttr("disabled");
						$("#btn-prev908").removeAttr("disabled");
						$("#btn-next908").attr("disabled", "disabled");
						$("#btn-last908").attr("disabled", "disabled");
					}

					else {
						$("#btn-first908").removeAttr("disabled");
						$("#btn-prev908").removeAttr("disabled");
						$("#btn-next908").removeAttr("disabled");
						$("#btn-last908").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page908(txt) {
		if ( txt == 'first' ) {
			count908 = 0;
			displayFloor();
		}

		else if ( txt == "prev" ) {
			count908 = count908 - 10;
			displayFloor();
		}

		else if ( txt == "next" ) {
			count908 = count908 + 10;
			displayFloor();
		}

		else {
			count908 = $("#floorcounts").val() * 10;
			displayFloor();
		}
	}

	function floorSelected() {
		$("#tblref_floors tr").each(function(){
			$(this).click(function(){
				$("#tblref_floors tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedFloor(this.id);
			})
		})
	}

	function selectedFloor(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_floorplan/class.php',
			data: 'id=' + id + '&form=selectedFloor',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddenfloorid").val(arr[0]);
				$("#FloorDesc").val(arr[0]);
			}
		})
	}

	function clickAddFloor() {
		$("#tblref_floors tr").unbind("click");
		$("#tblref_floors tr").removeClass("bg-selected");
		$("#buttonsFloor").css("display", "none");
		$("#savingbuttonsFloor").css("display", "block");
		$(".txtPosition").removeAttr("readonly");
		$(".txtPosition").val("");
	}

	function cancelbuttonFloor() {
		floorSelected();
		displayFloor2();
		$("#buttonsFloor").css("display", "block");
		$("#savingbuttonsFloor").css("display", "none");
		$(".txtPosition").attr("readonly", "readonly");
		$(".txtPosition").val("");
	}

	function cancelbuttonFloor2() {
		// deptselected();
		// displayDepartment2();
		$("#buttonsFloor").css("display", "block");
		$("#updatebuttonsFloor").css("display", "none");
		$(".txtPosition").attr("readonly", "readonly");
	}

	function saveFloor() {
		var FloorDesc = $("#FloorDesc").val();
         
		 if($("#FloorDesc").val()!="")
		 {
			 
		 $.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_floorplan/class.php',
			data: 'FloorDesc=' + FloorDesc + '&form=saveFloor',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonFloor();
					displayFloor2();
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

	function clickUpdateFloor() {
		var FloorDesc = $("#FloorDesc").val();
		
		if ( FloorDesc == "" ) {
			alert("Select description first");
		}

		else {
			$("#tblref_floors tr").unbind("click");
			$("#buttonsFloor").css("display", "none");
			$("#updatebuttonsFloor").css("display", "block");
			$(".txtPosition").removeAttr("readonly");
		}
	}

	function updateFloor() {
		var hiddenfloorid = $("#hiddenfloorid").val();
		var FloorDesc = $("#FloorDesc").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_floorplan/class.php',
			data: 'hiddenfloorid=' + hiddenfloorid + '&FloorDesc=' + FloorDesc + '&form=updateFloor',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonFloor();
					cancelbuttonFloor2();
					displayFloor2();
				}

				else {
					alert(data);
				}
			}
		})
	}

	function clickDeleteFloor() {
		var FloorDesc = $("#FloorDesc").val();

		if ( FloorDesc == "" ) {
			alert("Select description first.");
		}

		else {
			if ( confirm( "Are you sure you want to delete " + FloorDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/unit_floorplan/class.php',
					data: 'FloorDesc=' + FloorDesc + '&form=deleteFloor',
					success: function (data) {
						if ( data == 1 ) {
							alert(FloorDesc + " has been deleted.");
							cancelbuttonFloor2();
							cancelbuttonFloor();
							displayFloor2();
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