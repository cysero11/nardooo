<script type="text/javascript">
	setTimeout(function() {
		displaySetTask();
		showtaskcat();
		showsetEquip();
		$(".numonly").keydown(function(event) {

           // Allow only backspace and delete
           if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190 || event.keyCode == 9) {
               // let it happen, don't do anything
           }
           else {
               // Ensure that it is a number and stop the keypress
               if (event.keyCode < 48 || event.keyCode > 57 ) {
                   event.preventDefault(); 
               }   
           }
       });

       $(".amount").change(function(){
            var v = parseFloat($(this).val());
            $(this).val((isNaN(v)) ? '' : v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
       });
	}, 300)

	clickRefs()

	var count57 = 0;

	function displaySetTask2() {
		count57 = 0;
		displaySetTask();
	}

	function displaySetTask() {
		var key = $("#txtsearchsettask").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_setTask/class.php',
			data: 'count57=' + count57 + '&key=' + key + '&form=displaySetTask',
			success: function(data) {
				var arr = data.split("|");
				$("#tblmaintenance_tasklist").html(arr[0]);
				$("#settaskcounts").val(arr[1]);
				setTaskSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first57").attr("disabled", "disabled");
					$("#btn-prev57").attr("disabled", "disabled");
					$("#btn-next57").attr("disabled", "disabled");
					$("#btn-last57").attr("disabled", "disabled");
				}

				else {
					if ( count57 == 0 ) {
						$("#btn-first57").attr("disabled", "disabled");
						$("#btn-prev57").attr("disabled", "disabled");
						$("#btn-next57").removeAttr("disabled");
						$("#btn-last57").removeAttr("disabled");
					}

					else if ( count57 == $("#settaskcounts").val() * 10 ) {
						$("#btn-first57").removeAttr("disabled");
						$("#btn-prev57").removeAttr("disabled");
						$("#btn-next57").attr("disabled", "disabled");
						$("#btn-last57").attr("disabled", "disabled");
					}

					else {
						$("#btn-first57").removeAttr("disabled");
						$("#btn-prev57").removeAttr("disabled");
						$("#btn-next57").removeAttr("disabled");
						$("#btn-last57").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page57(txt) {
		if ( txt == 'first' ) {
			count57 = 0;
			displaySetTask();
		}

		else if ( txt == "prev" ) {
			count57 = count57 - 10;
			displaySetTask();
		}

		else if ( txt == "next" ) {
			count57 = count57 + 10;
			displaySetTask();
		}

		else {
			count57 = $("#settaskcounts").val() * 10;
			displaySetTask();
		}
	}

	function setTaskSelected() {
		$("#tblmaintenance_tasklist tr").each(function(){
			$(this).click(function(){
				$("#tblmaintenance_tasklist tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedSetTask(this.id);
			})
		})
	}

	function selectedSetTask(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_setTask/class.php',
			data: 'id=' + id + '&form=selectedSetTask',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddensettaskid").val(arr[1]);
				$("#taskcat").val(arr[0]);
				$("#setTaskCode").val(arr[1]);
				$("#setTaskDesc").val(arr[2]);
				$("#setTaskAmount").val(arr[3]);
				$("#setEquip").val(arr[4]);
			}
		})
	}

	function clickAddSetTask() {
		$("#tblmaintenance_tasklist tr").unbind("click");
		$("#tblmaintenance_tasklist tr").removeClass("bg-selected");
		$("#buttonsSetTask").css("display", "none");
		$("#savingbuttonsSetTask").css("display", "block");
		$(".txtSetTask").removeAttr("readonly");
		$("#floorId").removeAttr("disabled");
		$("#bldgId").removeAttr("disabled");
		$(".txtSetTask").val("");
		$("#taskcat").attr("disabled", false);
		$("#setEquip").attr("disabled", false);
		$("#taskcat").val("");
	}

	function cancelbuttonSetTask() {
		setTaskSelected();
		displaySetTask();
		$("#buttonsSetTask").css("display", "block");
		$("#savingbuttonsSetTask").css("display", "none");
		$(".txtSetTask").attr("readonly", "readonly");
		$("#floorId").attr("disabled","disabled");
		$("#bldgId").attr("disabled","disabled");
		$(".txtSetTask").val("");
		$("#taskcat").attr("disabled", true);
		$("#setEquip").attr("disabled", true);
	}

	function cancelbuttonSetTask2() {
		// setTaskSelected();
		// displayDepartment2();
		displaySetTask2();
		$("#buttonsSetTask").css("display", "block");
		$("#updatebuttonsSetTask").css("display", "none");
		$(".txtSetTask").attr("readonly", "readonly");
		$("#floorId").attr("disabled","disabled");
		$("#bldgId").attr("disabled","disabled");
		$("#taskcat").attr("disabled", true);
		$("#setEquip").attr("disabled", true);
	}

	function saveSetTask() {
		var taskcat = $("#taskcat").val();
		var setTaskCode = $("#setTaskCode").val();
		var setTaskDesc = $("#setTaskDesc").val();
		var setTaskAmount = $("#setTaskAmount").val();
		var setEquip = $("#setEquip").val();
		if($("#taskcat").val()!="" && $("#setTaskCode").val()!="" && $("#setTaskDesc").val()!="" && $("#setEquip").val()!="")
    	{
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/main_setTask/class.php',
				data: 'taskcat=' + taskcat + '&setTaskAmount=' + setTaskAmount + '&setTaskCode=' + setTaskCode + '&setTaskDesc=' + setTaskDesc + '&setEquip=' + setEquip + '&form=saveSetTask',
				success: function (data) {
					if ( data == 1 ) {
						alert("Saved.");
						cancelbuttonSetTask();
						displaySetTask();
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

	function clickUpdateSetTask() {
		var setTaskCode = $("#setTaskCode").val();
		var setTaskDesc = $("#setTaskDesc").val();

		if ( setTaskCode == "" ) {
			alert("Select code first");
		}

		else if ( setTaskDesc == "" ) {
			alert("Select description first");
		}

		else {
			$.ajax({
				type: 'POST',
				url: 'setup/referentialFiles/main_setTask/class.php',
				data: 'setTaskCode=' + setTaskCode + '&form=clickUpdateSetTask',
				success:function(data){
					if(data == 0){
						$("#tblmaintenance_tasklist tr").unbind("click");
						$("#buttonsSetTask").css("display", "none");
						$("#updatebuttonsSetTask").css("display", "block");
						$(".txtSetTask").removeAttr("readonly");
						$("#setEquip").attr("disabled", false);
					}else{
						$("#tblmaintenance_tasklist tr").unbind("click");
						$("#buttonsSetTask").css("display", "none");
						$("#updatebuttonsSetTask").css("display", "block");
						$(".txtSetTask").removeAttr("readonly");
						$("#setEquip").attr("disabled", false);
						$("#setTaskCode").attr("disabled", true);
					}
				}
			})
			
		}
	}

	function updateSetTask() {
		var taskcat = $("#taskcat").val();
		var hiddensettaskid = $("#hiddensettaskid").val();
		var setTaskCode = $("#setTaskCode").val();
		var setTaskDesc = $("#setTaskDesc").val();
		var setTaskAmount = $("#setTaskAmount").val();
		var setEquip = $("#setEquip").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_setTask/class.php',
			data: 'hiddensettaskid=' + hiddensettaskid + '&setTaskCode=' + setTaskCode + '&setTaskDesc=' + setTaskDesc + '&setTaskAmount=' + setTaskAmount + '&taskcat=' + taskcat +  '&setEquip=' + setEquip + '&form=updateSetTask',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonSetTask();
					cancelbuttonSetTask2();
					displaySetTask2();
				}

				else {
					alert(data);
				}
			}
		})
	}

	function clickDeleteSetTask() {
		var setTaskCode = $("#setTaskCode").val();
		var setTaskDesc = $("#setTaskDesc").val();

		if ( setTaskCode == "" ) {
			alert("Select code first");
		}

		else if  ( setTaskDesc == "" ) {
			alert("Select description first");
		}


		else {
			if ( confirm( "Are you sure you want to delete " + setTaskDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/main_setTask/class.php',
					data: 'setTaskCode=' + setTaskCode + '&setTaskDesc=' + setTaskDesc + '&form=deleteSetTask',
					success: function (data) {
						if ( data == 1 ) {
							alert(setTaskDesc + " has been deleted.");
							cancelbuttonSetTask2();
							cancelbuttonSetTask();
							displaySetTask2();
						}

						else {
							alert(data);
						}
					}
				})
			}
		}
	}

	function showtaskcat(){
		$.ajax({
			type: 'POST',
			url: 'setup/referentialFiles/main_setTask/class.php',
			data: 'form=showtaskcats',
		success:function(data){
				$("#taskcat").html(data);
			}
		})
	}

	function showsetEquip(){
		$.ajax({
			type: 'POST',
			url: 'setup/referentialFiles/main_setTask/class.php',
			data: 'form=showsetEquip',
			success:function(data){
				$("#setEquip").html(data);	
			}
		})
	}
</script>