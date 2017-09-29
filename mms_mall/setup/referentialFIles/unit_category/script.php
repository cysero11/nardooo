<script type="text/javascript">
$(function()
{
	blocking();
});


	setTimeout(function() {
		displayCat();
		selectedUnitDept();
	}, 300)

	clickRefs()

	var count101 = 0;

	function displayCat2() {
		count101 = 0;
		displayCat();
	}
	
	
	function blocking()
	{
		$("#catCode").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*() 0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	 $("#catDesc").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*()0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	
	 
	}//end
	
	
	
	
	

	function displayCat() {
		var key = $("#txtsearchCat").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_category/class.php',
			data: 'count101=' + count101 + '&key=' + key + '&form=displayCat',
			success: function(data) {
				var arr = data.split("|");
				$("#tblref_merchandisedep_cat").html(arr[0]);
				$("#catcounts").val(arr[1]);
				catSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first101").attr("disabled", "disabled");
					$("#btn-prev101").attr("disabled", "disabled");
					$("#btn-next101").attr("disabled", "disabled");
					$("#btn-last101").attr("disabled", "disabled");
				}

				else {
					if ( count101 == 0 ) {
						$("#btn-first101").attr("disabled", "disabled");
						$("#btn-prev101").attr("disabled", "disabled");
						$("#btn-next101").removeAttr("disabled");
						$("#btn-last101").removeAttr("disabled");
					}

					else if ( count101 == $("#catcounts").val() * 10 ) {
						$("#btn-first101").removeAttr("disabled");
						$("#btn-prev101").removeAttr("disabled");
						$("#btn-next101").attr("disabled", "disabled");
						$("#btn-last101").attr("disabled", "disabled");
					}

					else {
						$("#btn-first101").removeAttr("disabled");
						$("#btn-prev101").removeAttr("disabled");
						$("#btn-next101").removeAttr("disabled");
						$("#btn-last101").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page101(txt) {
		if ( txt == 'first' ) {
			count101 = 0;
			displayCat();
		}

		else if ( txt == "prev" ) {
			count101 = count101 - 10;
			displayCat();
		}

		else if ( txt == "next" ) {
			count101 = count101 + 10;
			displayCat();
		}

		else {
			count101 = $("#catcounts").val() * 10;
			displayCat();
		}
	}

	function catSelected() {
		$("#tblref_merchandisedep_cat tr").each(function(){
			$(this).click(function(){
				$("#tblref_merchandisedep_cat tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedCat(this.id);
			})
		})
	}

	function selectedCat(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_category/class.php',
			data: 'id=' + id + '&form=selectedCat',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddencatid").val(arr[0]);
				$("#deptId").val(arr[0]);
				$("#catCode").val(arr[1]);
				$("#catDesc").val(arr[2]);
			}
		})
	}

	function clickAddCat() {
		selectedUnitDept();
		$("#tblref_merchandisedep_cat tr").unbind("click");
		$("#tblref_merchandisedep_cat tr").removeClass("bg-selected");
		$("#buttonsCat").css("display", "none");
		$("#savingbuttonsCat").css("display", "block");
		$(".txtCat").removeAttr("readonly");
		$("#deptId").removeAttr("disabled");
		$(".txtCat").val("");

	}

	function cancelbuttonCat() {
		catSelected();
		displayCat2();
		$("#buttonsCat").css("display", "block");
		$("#savingbuttonsCat").css("display", "none");
		$(".txtCat").attr("readonly", "readonly");
		$("#deptId").attr("disabled","disabled");
		$(".txtCat").val("");
	}

	function cancelbuttonCat2() {
		// catSelected();
		displayCat2();
		$("#buttonsCat").css("display", "block");
		$("#updatebuttonsCat").css("display", "none");
		$(".txtCat").attr("readonly", "readonly");
		$("#deptId").attr("disabled","disabled");
	}

	function saveCat() {
		var catCode = $("#catCode").val();
		var catDesc = $("#catDesc").val();
		var deptId = $("#deptId").val();
		
		if($("#catCode").val()!="" && $("#catDesc").val()!="")
        {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_category/class.php',
			data: 'deptId=' + deptId + '&catCode=' + catCode + '&catDesc=' + catDesc + '&form=saveCat',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonCat();
					displayCat2();
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

	function clickUpdateCat() {
		var catCode = $("#catCode").val();
		if ( catCode == "" ) {
			alert("Select department first");
		}

		else {
			$.ajax({
				type: 'POST',
				url: 'setup/referentialFiles/unit_category/class.php',
				data: 'catCode=' + catCode + '&form=clickUpdateCat',
				success:function(data){
					alert(data);
					if(data == 0){
						$("#tblref_merchandisedep_cat tr").unbind("click");
						$("#buttonsCat").css("display", "none");
						$("#updatebuttonsCat").css("display", "block");
						$(".txtCat").removeAttr("readonly");
					}else{
						$("#tblref_merchandisedep_cat tr").unbind("click");
						$("#buttonsCat").css("display", "none");
						$("#updatebuttonsCat").css("display", "block");
						$("#catDesc").removeAttr("readonly");
					}
				}
			})
			
		}
	}

	function updateCat() {
		var hiddencatid = $("#hiddencatid").val();
		var catCode = $("#catCode").val();
		var catDesc = $("#catDesc").val();
		var deptId = $("#deptId").val();
		
        if($("#catCode").val()!="" && $("#catDesc").val())
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_category/class.php',
			data: 'deptId=' + deptId + '&hiddencatid=' + hiddencatid + '&catCode=' + catCode + '&catDesc=' + catDesc + '&form=updateCat',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonCat();
					cancelbuttonCat2();
					displayCat2();
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

	function clickDeleteCat() {
		var catCode = $("#catCode").val();
		var catDesc = $("#catDesc").val();
		var deptId = $("#deptId").val();

		if ( catCode == "" ) {
			alert("Select code first");
		}

		else if  ( deptId == "" ) {
			alert("Select department first");
		}

		else if  ( catDesc == "" ) {
			alert("Select description first");
		}


		else {
			if ( confirm( "Are you sure you want to delete " + catDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/unit_category/class.php',
					data: 'deptId=' + deptId + '&catCode=' + catCode + '&catDesc=' + catDesc + '&form=deleteCat',
					success: function (data) {
						if ( data == 1 ) {
							alert(catDesc + " has been deleted.");
							cancelbuttonCat2();
							cancelbuttonCat();
							displayCat2();
						}

						else {
							alert(data);
						}
					}
				})
			}
		}
	}

	function selectedUnitDept() {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_category/class.php',
			data: 'deptId=' + deptId + '&form=listUnitDept',
			success: function(data) {
				//alert(data);
				$("#deptId").html(data);			
				//$("#deptId").html(data);
			}
		})
	}
</script>