<script type="text/javascript">

$(function()
{
	blocking();
});


	setTimeout(function() {
		displayIndustry();
	}, 300)

	clickRefs()

	var count3 = 0;

	function displayIndustry2() {
		count3 = 0;
		displayIndustry();
	}
	
	
	function blocking()
	{
		$("#industryCode").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*() 0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	 $("#industryDesc").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*()0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	
	 
	}//end
	
	
	
	
	

	function displayIndustry() {
		var key = $("#txtsearchindustry").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_industry/class.php',
			data: 'count3=' + count3 + '&key=' + key + '&form=displayIndustry',
			success: function(data) {
				var arr = data.split("|");
				$("#tblref_industry").html(arr[0]);
				$("#industrycounts").val(arr[1]);
				industrySelected();
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

					else if ( count3 == $("#industrycounts").val() * 10 ) {
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
			displayIndustry();
		}

		else if ( txt == "prev" ) {
			count3 = count3 - 10;
			displayIndustry();
		}

		else if ( txt == "next" ) {
			count3 = count3 + 10;
			displayIndustry();
		}

		else {
			count3 = $("#industrycounts").val() * 10;
			displayIndustry();
		}
	}

	function industrySelected() {
		$("#tblref_industry tr").each(function(){
			$(this).click(function(){
				$("#tblref_industry tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedIndustry(this.id);
			})
		})
	}

	function selectedIndustry(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_industry/class.php',
			data: 'id=' + id + '&form=selectedIndustry',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddenindustryid").val(arr[0]);
				$("#industryCode").val(arr[0]);
				$("#industryDesc").val(arr[1]);
			}
		})
	}

	function clickAddIndustry() {
		$("#tblref_industry tr").unbind("click");
		$("#tblref_industry tr").removeClass("bg-selected");
		$("#buttonsIndustry").css("display", "none");
		$("#savingbuttonsIndustry").css("display", "block");
		$(".txtIndustry").removeAttr("readonly");
		$(".txtIndustry").val("");
	}

	function cancelbuttonIndustry() {
		industrySelected();
		displayIndustry2();
		$("#buttonsIndustry").css("display", "block");
		$("#savingbuttonsIndustry").css("display", "none");
		$(".txtIndustry").attr("readonly", "readonly");
		$(".txtIndustry").val("");
	}

	function cancelbuttonIndustry2() {
		// deptselected();
		// displayDepartment2();
		$("#buttonsIndustry").css("display", "block");
		$("#updatebuttonsIndustry").css("display", "none");
		$(".txtIndustry").attr("readonly", "readonly");
	}

	function saveIndustry() {
		var industryCode = $("#industryCode").val();
		var industryDesc = $("#industryDesc").val();
             
		if($("#industryCode").val()!="" && $("#industryDesc").val()!="")
		{			
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_industry/class.php',
			data: 'industryCode=' + industryCode + '&industryDesc=' + industryDesc + '&form=saveIndustry',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonIndustry();
					displayIndustry2();
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

	function clickUpdateIndustry() {
		var industryCode = $("#industryCode").val();
		if ( industryCode == "" ) {
			alert("Select code first");
		}

		else if ( industryDesc == "" ) {
			alert("Select description first");
		}

		else {
			$("#tblref_industry tr").unbind("click");
			$("#buttonsIndustry").css("display", "none");
			$("#updatebuttonsIndustry").css("display", "block");
			$(".txtIndustry").removeAttr("readonly");
		}
	}

	function updateIndustry() {
		var hiddenindustryid = $("#hiddenindustryid").val();
		var industryCode = $("#industryCode").val();
		var industryDesc = $("#industryDesc").val();
        
		if($("#industryCode").val()!="" && $("#industryDesc").val()!="")
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_industry/class.php',
			data: 'hiddenindustryid=' + hiddenindustryid + '&industryCode=' + industryCode + '&industryDesc=' + industryDesc + '&form=updateIndustry',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonIndustry();
					cancelbuttonIndustry2();
					displayIndustry2();
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

	function clickDeleteIndustry() {
		var industryCode = $("#industryCode").val();
		var industryDesc = $("#industryDesc").val();

		if ( industryCode == "" ) {
			alert("Select code first");
		}

		else {
			if ( confirm( "Are you sure you want to delete " + industryDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/unit_industry/class.php',
					data: 'industryCode=' + industryCode + '&industryDesc=' + industryDesc + '&form=deleteIndustry',
					success: function (data) {
						if ( data == 1 ) {
							alert(industryDesc + " has been deleted.");
							cancelbuttonIndustry2();
							cancelbuttonIndustry();
							displayIndustry2();
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