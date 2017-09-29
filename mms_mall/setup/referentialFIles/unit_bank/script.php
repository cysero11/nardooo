<script type="text/javascript">
$(function()
{
	blocking();
});
	setTimeout(function() {
		displayBank();
	}, 300)

	clickRefs()

	var count905 = 0;

	function displayBank2() {
		count905 = 0;
		displayBank();
	}
	
	
	function blocking()
	{
		$("#bankCode").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*() 0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	 $("#bankDesc").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*()0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 }
	
	
	
	
	
	

	function displayBank() {
		var key = $("#txtsearchbank").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_bank/class.php',
			data: 'count905=' + count905 + '&key=' + key + '&form=displayBank',
			success: function(data) {
				var arr = data.split("|");
				$("#tblrefbank").html(arr[0]);
				$("#bankcounts").val(arr[1]);
				bankSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first905").attr("disabled", "disabled");
					$("#btn-prev905").attr("disabled", "disabled");
					$("#btn-next905").attr("disabled", "disabled");
					$("#btn-last905").attr("disabled", "disabled");
				}

				else {
					if ( count905 == 0 ) {
						$("#btn-first905").attr("disabled", "disabled");
						$("#btn-prev905").attr("disabled", "disabled");
						$("#btn-next905").removeAttr("disabled");
						$("#btn-last905").removeAttr("disabled");
					}

					else if ( count905 == $("#bankcounts").val() * 10 ) {
						$("#btn-first905").removeAttr("disabled");
						$("#btn-prev905").removeAttr("disabled");
						$("#btn-next905").attr("disabled", "disabled");
						$("#btn-last905").attr("disabled", "disabled");
					}

					else {
						$("#btn-first905").removeAttr("disabled");
						$("#btn-prev905").removeAttr("disabled");
						$("#btn-next905").removeAttr("disabled");
						$("#btn-last905").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page905(txt) {
		if ( txt == 'first' ) {
			count905 = 0;
			displayBank();
		}

		else if ( txt == "prev" ) {
			count905 = count905 - 10;
			displayBank();
		}

		else if ( txt == "next" ) {
			count905 = count905 + 10;
			displayBank();
		}

		else {
			count905 = $("#bankcounts").val() * 10;
			displayBank();
		}
	}

	function bankSelected() {
		$("#tblrefbank tr").each(function(){
			$(this).click(function(){
				$("#tblrefbank tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedBank(this.id);
			})
		})
	}

	function selectedBank(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_bank/class.php',
			data: 'id=' + id + '&form=selectedBank',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddenbankid").val(arr[0]);
				$("#bankCode").val(arr[0]);
				$("#bankDesc").val(arr[1]);
			}
		})
	}

	function clickAddBank() {
		$("#tblrefbank tr").unbind("click");
		$("#tblrefbank tr").removeClass("bg-selected");
		$("#buttonsBank").css("display", "none");
		$("#savingbuttonsBank").css("display", "block");
		$(".txtBank").removeAttr("readonly");
		$(".txtBank").val("");
	}

	function cancelbuttonBank() {
		bankSelected();
		displayBank2();
		$("#buttonsBank").css("display", "block");
		$("#savingbuttonsBank").css("display", "none");
		$(".txtBank").attr("readonly", "readonly");
		$(".txtBank").val("");
	}

	function cancelbuttonBank2() {
		// deptselected();
		// displayDepartment2();
		$("#buttonsBank").css("display", "block");
		$("#updatebuttonsBank").css("display", "none");
		$(".txtBank").attr("readonly", "readonly");
	}

	function saveBank() {
		var bankCode = $("#bankCode").val();
		var bankDesc = $("#bankDesc").val();

		if($("#bankCode").val()!="" && $("#bankDesc").val()!="")
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_bank/class.php',
			data: 'bankCode=' + bankCode + '&bankDesc=' + bankDesc + '&form=saveBank',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonBank();
					displayBank2();
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

	function clickUpdateBank() {
		var bankCode = $("#bankCode").val();
		if ( bankCode == "" ) {
			alert("Select code first");
		}

		else if ( bankDesc == "" ) {
			alert("Select description first");
		}

		else {
			$("#tblrefbank tr").unbind("click");
			$("#buttonsBank").css("display", "none");
			$("#updatebuttonsBank").css("display", "block");
			$(".txtBank").removeAttr("readonly");
		}
	}

	function updateBank() {
		var hiddenbankid = $("#hiddenbankid").val();
		var bankCode = $("#bankCode").val();
		var bankDesc = $("#bankDesc").val();
        
		if($("#bankCode").val()!="" && $("#bankDesc").val()!="")
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_bank/class.php',
			data: 'hiddenbankid=' + hiddenbankid + '&bankCode=' + bankCode + '&bankDesc=' + bankDesc + '&form=updateBank',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonBank();
					cancelbuttonBank2();
					displayBank2();
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

	function clickDeleteBank() {
		var bankCode = $("#bankCode").val();
		var bankDesc = $("#bankDesc").val();

		if ( bankCode == "" ) {
			alert("Select code first.");
		}

		else if ( bankDesc == "" ) {
			alert("Select description first.");
		}

		else {
			if ( confirm( "Are you sure you want to delete " + bankDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/unit_bank/class.php',
					data: 'bankCode=' + bankCode + '&bankDesc=' + bankDesc + '&form=deleteBank',
					success: function (data) {
						if ( data == 1 ) {
							alert(bankDesc + " has been deleted.");
							cancelbuttonBank2();
							cancelbuttonBank();
							displayBank2();
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