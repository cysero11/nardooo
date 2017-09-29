<script type="text/javascript">
setTimeout(function() {
	showmainHouseRules();
}, 300)

var count542 = 0;

function showmainHouseRules2(){
	count542 = 0;
	showmainHouseRules();
}

function showmainHouseRules(){
	var key = $("#txtsearchHouseRulesCat").val();
	$.ajax({
		type: 'POST',
		url: 'setup/referentialFiles/main_HouseRules/class.php',
		data: 'count542=' + count542 + '&key=' + key + '&form=showmainHouseRules',
	success:function(data){
			var arr = data.split("|");
				$("#tblHouseRules").html(arr[0]);
				$("#HouseRulescatcounts").val(arr[1]);
				HouseRulesCatSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first542").attr("disabled", "disabled");
					$("#btn-prev542").attr("disabled", "disabled");
					$("#btn-next542").attr("disabled", "disabled");
					$("#btn-last542").attr("disabled", "disabled");
				}

				else {
					if ( count542 == 0 ) {
						$("#btn-first542").attr("disabled", "disabled");
						$("#btn-prev542").attr("disabled", "disabled");
						$("#btn-next542").removeAttr("disabled");
						$("#btn-last542").removeAttr("disabled");
					}

					else if ( count542 == $("#HouseRulescatcounts").val() * 10 ) {
						$("#btn-first542").removeAttr("disabled");
						$("#btn-prev542").removeAttr("disabled");
						$("#btn-next542").attr("disabled", "disabled");
						$("#btn-last542").attr("disabled", "disabled");
					}

					else {
						$("#btn-first542").removeAttr("disabled");
						$("#btn-prev542").removeAttr("disabled");
						$("#btn-next542").removeAttr("disabled");
						$("#btn-last542").removeAttr("disabled");
					}
				}
		}
	})
}

function page542(txt) {
	if ( txt == 'first' ) {
		count542 = 0;
		showmainHouseRules();
	}

	else if ( txt == "prev" ) {
		count542 = count542 - 10;
		showmainHouseRules();
	}

	else if ( txt == "next" ) {
		count542 = count542 + 10;
		showmainHouseRules();
	}

	else {
		count542 = $("#HouseRulescatcounts").val() * 10;
		showmainHouseRules();
	}
}

function HouseRulesCatSelected() {
	$("#tblHouseRules tr").each(function(){
		$(this).click(function(){
			$("#tblHouseRules tr").removeClass("bg-info");
			$(this).addClass("bg-info");
			selectedHouseRules(this.id);
		})
	})
}

function selectedHouseRules(id) {
	$("#hiddenequipcatid").val(id);
	$.ajax ({
		type: 'POST',
		url: 'setup/referentialFiles/main_HouseRules/class.php',
		data: 'id=' + id + '&form=selectedHouseRules',
		success: function(data) {
			var arr = data.split("|");
			$("#txtHouseRulesCode").val(arr[0]);
			$("#txtHouseRulesViolation").val(arr[1]);
			$("#txtHouseRules1stoffense").val(arr[2]);
			$("#txtHouseRules2ndoffense").val(arr[3]);
			$("#txtHouseRules3rdoffense").val(arr[4]);
			$("#txtHouseRulesSucceeding").val(arr[5]);
		}
	})
}


function clickAddHouseRulesCat() {
	$("#tblHouseRules tr").unbind("click");
	$("#tblHouseRules tr").removeClass("bg-selected");
	$("#buttonsHouseRulesCat").css("display", "none");
	$("#savingbuttonsHouseRulesCat").css("display", "block");
	$(".txtHouseRules").removeAttr("readonly");
	$(".txtHouseRules").val("");
}

function cancelbuttonHouseRulesCat() {
	// deptselected();
	// displayDepartment2();
	$("#buttonsHouseRulesCat").css("display", "block");
	$("#savingbuttonsHouseRulesCat").css("display", "none");
	$("#updatebuttonsHouseRulesCat").css("display", "none");
	$(".txtHouseRules").attr("readonly", "readonly");
	$(".txtHouseRules").val("");
	showmainHouseRules2();
}

function cancelbuttonHouseRulesCat2() {
	// deptselected();
	showmainHouseRules2();
	$("#buttonsHouseRulesCat").css("display", "block");
	$("#updatebuttonsHouseRulesCat").css("display", "none");
	$("#savingbuttonsHouseRulesCat").css("display", "none");
	$(".txtHouseRules").attr("readonly", "readonly");
}

function clickUpdateHouseRulesCat() {
	var Code = $("#txtHouseRulesCode").val();
	var Violation = $("#txtHouseRulesViolation").val();
	var offense1 = $("#txtHouseRules1stoffense").val();
	var offense2 = $("#txtHouseRules2ndoffense").val();
	var offense3 = $("#txtHouseRules3rdoffense").val();
	var Succeeding = $("#txtHouseRulesSucceeding").val();
	if(Code != "" && Violation != "" && (offense1 != "" || offense2 != "" || offense3 != "" || Succeeding != "")){
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_HouseRules/class.php',
			data: '&Code=' + Code + '&Violation=' + Violation + '&offense1=' + offense1 + '&offense2=' + offense2 + '&offense3=' + offense3 + '&Succeeding=' + Succeeding + '&form=clickUpdateHouseRulesCat',
			success: function (data) {
				if(data == 0){
					$("#tblHouseRules tr").unbind("click");
					$("#buttonsHouseRulesCat").css("display", "none");
					$("#updatebuttonsHouseRulesCat").css("display", "block");
					$(".txtHouseRules").removeAttr("readonly");
				}else{
					$("#tblHouseRules tr").unbind("click");
					$("#buttonsHouseRulesCat").css("display", "none");
					$("#updatebuttonsHouseRulesCat").css("display", "block");
					$(".txtHouseRules").removeAttr("readonly");
					// $("#equipCatCode").attr("readonly", "readonly");
				}
			}
		})
	}else{
			alert("PLEASE FILL UP ALL FIELDS");
	}
}

function saveHouseRules() {
	var Code = $("#txtHouseRulesCode").val();
	var Violation = $("#txtHouseRulesViolation").val();
	var offense1 = $("#txtHouseRules1stoffense").val();
	var offense2 = $("#txtHouseRules2ndoffense").val();
	var offense3 = $("#txtHouseRules3rdoffense").val();
	var Succeeding = $("#txtHouseRulesSucceeding").val();
	if(Code != "" && Violation != "" && (offense1 != "" || offense2 != "" || offense3 != "" || Succeeding != "")){
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_HouseRules/class.php',
			data: '&Code=' + Code + '&Violation=' + Violation + '&offense1=' + offense1 + '&offense2=' + offense2 + '&offense3=' + offense3 + '&Succeeding=' + Succeeding + '&form=saveHouseRules',
			success: function (data) {
				if ( data == 1 ) {
					alert("Saved.");
					cancelbuttonHouseRulesCat();
					showmainHouseRules2();
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

function updateHouseRulesCat() {
	var Code = $("#txtHouseRulesCode").val();
	var Violation = $("#txtHouseRulesViolation").val();
	var offense1 = $("#txtHouseRules1stoffense").val();
	var offense2 = $("#txtHouseRules2ndoffense").val();
	var offense3 = $("#txtHouseRules3rdoffense").val();
	var Succeeding = $("#txtHouseRulesSucceeding").val();
	var id = $("#hiddenequipcatid").val();
	if(Code != "" && Violation != "" && (offense1 != "" || offense2 != "" || offense3 != "" || Succeeding != "")){
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_HouseRules/class.php',
			data: '&Code=' + Code + '&Violation=' + Violation + '&offense1=' + offense1 + '&offense2=' + offense2 + '&offense3=' + offense3 + '&Succeeding=' + Succeeding + '&id=' + id + '&form=updateHouseRulesCat',
			success: function (data) {
				if ( data == 1 ) {
					showmodal("alert", "Saved.", "", null, "", null, "0");
					cancelbuttonHouseRulesCat();
					cancelbuttonHouseRulesCat2();
					showmainHouseRules();
				}
				else {
					showmodal("alert", data, "", null, "", null, "0");
				}
			}
		})
	}else{
			alert("PLEASE FILL UP ALL FIELDS");
	}
}

function clickDeleteHouseRulesCat() {
	var Code = $("#txtHouseRulesCode").val();
	var Violation = $("#txtHouseRulesViolation").val();

	if ( Code == "" ) {
		alert("Select code first.");
	}

	else if ( Violation == "" ) {
		alert("Select description first.");
	}

	else {
		if ( confirm( "Are you sure you want to delete " + Violation ) == true ) {
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/main_HouseRules/class.php',
				data: 'Code=' + Code + '&Violation=' + Violation + '&form=clickDeleteHouseRulesCat',
				success: function (data) {
					if ( data == 1 ) {
						showmodal("alert", Violation+" has been deleted.", "", null, "", null, "0");
						cancelbuttonHouseRulesCat();
						cancelbuttonHouseRulesCat2();
						showmainHouseRules2();
					}

					else {
						showmodal("alert", data, "", null, "", null, "0");
					}
				}
			})
		}
	}
}

</script>