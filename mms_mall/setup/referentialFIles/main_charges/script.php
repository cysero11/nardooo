<script type="text/javascript">
	setTimeout(function() {
		displayCharge();
	}, 300)

	clickRefs()

	var count3 = 0;

	function displayCharge2() {
		count3 = 0;
		displayCharge();
	}

	function displayCharge() {
		var key = $("#txtsearchCharge").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_charges/class.php',
			data: 'count3=' + count3 + '&key=' + key + '&form=displayCharge',
			success: function(data) {
				var arr = data.split("|");
				$("#tblref_charges").html(arr[0]);
				$("#chargecounts").val(arr[1]);
				chargeSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first3").attr("disabled", "disabled");
					$("#btn-prev3").attr("disabled", "disabled");
					$("#btn-next3").attr("disabled", "disabled");
					$("#btn-last3").attr("disabled", "disabled");
				}

				else {
					if ( count3 == 0 ) {
						$("#btn-first3").attr("disabled", "disabled");
						$("#btn-prev3").attr("disabled", "disabled");
						$("#btn-next3").removeAttr("disabled");
						$("#btn-last3").removeAttr("disabled");
					}

					else if ( count3 == $("#chargecounts").val() * 10 ) {
						$("#btn-first3").removeAttr("disabled");
						$("#btn-prev3").removeAttr("disabled");
						$("#btn-next3").attr("disabled", "disabled");
						$("#btn-last3").attr("disabled", "disabled");
					}

					else {
						$("#btn-first3").removeAttr("disabled");
						$("#btn-prev3").removeAttr("disabled");
						$("#btn-next3").removeAttr("disabled");
						$("#btn-last3").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page3(txt) {
		if ( txt == 'first' ) {
			count3 = 0;
			displayCharge();
		}

		else if ( txt == "prev" ) {
			count3 = count3 - 10;
			displayCharge();
		}

		else if ( txt == "next" ) {
			count3 = count3 + 10;
			displayCharge();
		}

		else {
			count3 = $("#chargecounts").val() * 10;
			displayCharge();
		}
	}

	function chargeSelected() {
		$("#tblref_charges tr").each(function(){
			$(this).click(function(){
				$("#tblref_charges tr").removeClass("bg-primary");
				$(this).addClass("bg-primary");
				selectedCharge(this.id);
			})
		})
	}

	function selectedCharge(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_charges/class.php',
			data: 'id=' + id + '&form=selectedCharge',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddenchargeid").val(arr[0]);
				$("#chargeCode").val(arr[0]);
				$("#chargeDesc").val(arr[1]);
				$("#chargeAmount").val(arr[2]);
			}
		})
	}

	function clickAddCharge() {
		$("#tblref_charges tr").unbind("click");
		$("#tblref_charges tr").removeClass("bg-selected");
		$("#buttonsCharge").css("display", "none");
		$("#savingbuttonsCharge").css("display", "block");
		$(".txtCharge").removeAttr("readonly");
		$(".txtCharge").val("");
	}

	function cancelbuttonCharge() {
		chargeSelected();
		displayCharge2();
		$("#buttonsCharge").css("display", "block");
		$("#savingbuttonsCharge").css("display", "none");
		$(".txtCharge").attr("readonly", "readonly");
		$(".txtCharge").val("");
	}

	function cancelbuttonCharge2() {
		// deptselected();
		// displayDepartment2();
		$("#buttonsCharge").css("display", "block");
		$("#updatebuttonsCharge").css("display", "none");
		$(".txtCharge").attr("readonly", "readonly");
	}

	function saveCharge() {
		var chargeCode = $("#chargeCode").val();
		var chargeDesc = $("#chargeDesc").val();
		var chargeAmount = $("#chargeAmount").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_charges/class.php',
			data: 'chargeCode=' + chargeCode + '&chargeAmount=' + chargeAmount +  '&chargeDesc=' + chargeDesc + '&form=saveCharge',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonCharge();
					displayCharge2();
				}

				else {
					alert(data);
				}
			}
		})
	}

	function clickUpdateCharge() {
		var chargeCode = $("#chargeCode").val();
		var chargeDesc = $("#chargeDesc").val();
		var chargeAmount = $("#chargeAmount").val();

		if ( chargeCode == "" ) {
			alert("Select code first");
		}

		else if ( chargeDesc == "" ) {
			alert("Select description first");
		}

		else if ( chargeAmount == "" ) {
			alert("Select amount first");
		}

		else {
			$("#tblref_charges tr").unbind("click");
			$("#buttonsCharge").css("display", "none");
			$("#updatebuttonsCharge").css("display", "block");
			$(".txtCharge").removeAttr("readonly");
		}
	}

	function updateCharge() {
		var hiddenchargeid = $("#hiddenchargeid").val();
		var chargeCode = $("#chargeCode").val();
		var chargeDesc = $("#chargeDesc").val();
		var chargeAmount = $("#chargeAmount").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_charges/class.php',
			data: 'hiddenchargeid=' + hiddenchargeid + '&chargeCode=' + chargeCode + '&chargeDesc=' + chargeDesc + '&form=updateCharge',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonCharge();
					cancelbuttonCharge2();
					displayCharge2();
				}

				else {
					alert(data);
				}
			}
		})
	}

	function clickDeleteCharge() {
		var chargeCode = $("#chargeCode").val();
		var chargeDesc = $("#chargeDesc").val();
		var chargeAmount = $("#chargeAmount").val();

		if ( chargeCode == "" ) {
			alert("Select code first");
		}

		else {
			if ( confirm( "Are you sure you want to delete " + chargeDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/main_charges/class.php',
					data: 'chargeCode=' + chargeCode + '&chargeAmount=' + chargeAmount +  '&chargeDesc=' + chargeDesc + '&form=deleteCharge',
					success: function (data) {
						if ( data == 1 ) {
							alert(chargeDesc + " has been deleted.");
							cancelbuttonCharge2();
							cancelbuttonCharge();
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