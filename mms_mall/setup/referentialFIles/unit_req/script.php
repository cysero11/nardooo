<script type="text/javascript">

$(function()
{
	blocking();
});


	setTimeout(function() {
		displayReq();
	}, 300)

	clickRefs()

	var count907 = 0;

	function displayReq2() {
		count907 = 0;
		displayReq();
	}
	
	
	function blocking()
	{
		$("#reqDesc").on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Z!@#$%^*() 0-9\s]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
     });
	 
	
	}//end
	
	
	
	
	
	
	

	function displayReq() {
		var key = $("#txtsearchreq").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_req/class.php',
			data: 'count907=' + count907 + '&key=' + key + '&form=displayReq',
			success: function(data) {
				var arr = data.split("|");
				$("#tblref_applicationrequirements").html(arr[0]);
				$("#reqcounts").val(arr[1]);
				reqSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first907").attr("disabled", "disabled");
					$("#btn-prev907").attr("disabled", "disabled");
					$("#btn-next907").attr("disabled", "disabled");
					$("#btn-last907").attr("disabled", "disabled");
				}

				else {
					if ( count907 == 0 ) {
						$("#btn-first907").attr("disabled", "disabled");
						$("#btn-prev907").attr("disabled", "disabled");
						$("#btn-next907").removeAttr("disabled");
						$("#btn-last907").removeAttr("disabled");
					}

					else if ( count907 == $("#reqcounts").val() * 10 ) {
						$("#btn-first907").removeAttr("disabled");
						$("#btn-prev907").removeAttr("disabled");
						$("#btn-next907").attr("disabled", "disabled");
						$("#btn-last907").attr("disabled", "disabled");
					}

					else {
						$("#btn-first907").removeAttr("disabled");
						$("#btn-prev907").removeAttr("disabled");
						$("#btn-next907").removeAttr("disabled");
						$("#btn-last907").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page907(txt) {
		if ( txt == 'first' ) {
			count907 = 0;
			displayReq();
		}

		else if ( txt == "prev" ) {
			count907 = count907 - 10;
			displayReq();
		}

		else if ( txt == "next" ) {
			count907 = count907 + 10;
			displayReq();
		}

		else {
			count907 = $("#reqcounts").val() * 10;
			displayReq();
		}
	}

	function reqSelected() {
		$("#tblref_applicationrequirements tr").each(function(){
			$(this).click(function(){
				$("#tblref_applicationrequirements tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedReq(this.id);
			})
		})
	}

	function selectedReq(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_req/class.php',
			data: 'id=' + id + '&form=selectedReq',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddenreqid").val(arr[0]);
				$("#reqDesc").val(arr[0]);
				alert(arr[2]);
				$(".override").each(function(){
		            if($(this).val() == arr[2])
		            { $(this).prop("checked", true); }
		        });
			}
		})
	}

	function clickAddReq() {
		$("#tblref_applicationrequirements tr").unbind("click");
		$("#tblref_applicationrequirements tr").removeClass("bg-selected");
		$("#buttonsReq").css("display", "none");
		$("#savingbuttonsReq").css("display", "block");
		$(".txtReq").removeAttr("readonly");
		$(".txtReq").val("");
	}

	function cancelbuttonReq() {
		reqSelected();
		displayReq2();
		$("#buttonsReq").css("display", "block");
		$("#savingbuttonsReq").css("display", "none");
		$(".txtReq").attr("readonly", "readonly");
		$(".txtReq").val("");
	}

	function cancelbuttonReq2() {
		// deptselected();
		// displayDepartment2();
		$("#buttonsReq").css("display", "block");
		$("#updatebuttonsReq").css("display", "none");
		$(".txtReq").attr("readonly", "readonly");
	}

	function saveReq() {
		var reqDesc = $("#reqDesc").val();
		var override = "";
	    $(".override").each(function(){
	        if ( $(this).is(":checked") == true ) {
	          override = this.value;
	        }
	    });

	     if($("#reqDesc").val()!="")
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_req/class.php',
			data: 'reqDesc=' + reqDesc + '&override=' + override + '&form=saveReq',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonReq();
					displayReq2();
				}

				else 
				{
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

	function clickUpdateReq() {
		var reqDesc = $("#reqDesc").val();
		
		if ( reqDesc == "" ) {
			alert("Select description first");
		}

		else {
			$("#tblref_applicationrequirements tr").unbind("click");
			$("#buttonsReq").css("display", "none");
			$("#updatebuttonsReq").css("display", "block");
			$(".txtReq").removeAttr("readonly");
		}
	}

	function updateReq() {
		var hiddenreqid = $("#hiddenreqid").val();
		var reqDesc = $("#reqDesc").val();
		var override = "";
	    $(".override").each(function(){
	        if ( $(this).is(":checked") == true ) {
	          override = this.value;
	        }
	    });
        
		if($("#reqDesc").val()!="")
		{
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/unit_req/class.php',
			data: 'hiddenreqid=' + hiddenreqid + '&reqDesc=' + reqDesc + '&override=' + override + '&form=updateReq',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonReq();
					cancelbuttonReq2();
					displayReq2();
				}

				else {
					alert(data);
				}
			}
		})
		}
		else
		{
			alert("PLEASE FILL UP ALL FIELDS")
		}
	}//end

	function clickDeleteReq() {
		var reqDesc = $("#reqDesc").val();

		if ( reqDesc == "" ) {
			alert("Select description first.");
		}

		else {
			if ( confirm( "Are you sure you want to delete " + reqDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/unit_req/class.php',
					data: 'reqDesc=' + reqDesc + '&form=deleteReq',
					success: function (data) {
						if ( data == 1 ) {
							alert(reqDesc + " has been deleted.");
							cancelbuttonReq2();
							cancelbuttonReq();
							displayReq2();
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