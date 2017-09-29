<script type="text/javascript">
	setTimeout(function() {
		displayMainCat();
	}, 1000)

	clickRefs()

	var count103 = 0;

	function displayMainCat2() {
		count103 = 0;
		displayMainCat();
	}

	function displayMainCat() {
		var key = $("#txtsearchMainCat").val();

		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_cat/class.php',
			data: 'count103=' + count103 + '&key=' + key + '&form=displayMainCat',
			success: function(data) {
				var arr = data.split("|");
				$("#tblmaintenance_category").html(arr[0]);
				$("#maincatcounts").val(arr[1]);
				mainCatSelected();
				if ( arr[1] == 0 ) {
					$("#btn-first103").attr("disabled", "disabled");
					$("#btn-prev103").attr("disabled", "disabled");
					$("#btn-next103").attr("disabled", "disabled");
					$("#btn-last103").attr("disabled", "disabled");
				}

				else {
					if ( count103 == 0 ) {
						$("#btn-first103").attr("disabled", "disabled");
						$("#btn-prev103").attr("disabled", "disabled");
						$("#btn-next103").removeAttr("disabled");
						$("#btn-last103").removeAttr("disabled");
					}

					else if ( count103 == $("#maincatcounts").val() * 10 ) {
						$("#btn-first103").removeAttr("disabled");
						$("#btn-prev103").removeAttr("disabled");
						$("#btn-next103").attr("disabled", "disabled");
						$("#btn-last103").attr("disabled", "disabled");
					}

					else {
						$("#btn-first103").removeAttr("disabled");
						$("#btn-prev103").removeAttr("disabled");
						$("#btn-next103").removeAttr("disabled");
						$("#btn-last103").removeAttr("disabled");
					}
				}
			}
		})
	}

	function page103(txt) {
		if ( txt == 'first' ) {
			count103 = 0;
			displayMainCat();
		}

		else if ( txt == "prev" ) {
			count103 = count103 - 10;
			displayMainCat();
		}

		else if ( txt == "next" ) {
			count103 = count103 + 10;
			displayMainCat();
		}

		else {
			count103 = $("#maincatcounts").val() * 10;
			displayMainCat();
		}
	}

	function mainCatSelected() {
		$("#tblmaintenance_category tr").each(function(){
			$(this).click(function(){
				$("#tblmaintenance_category tr").removeClass("bg-info");
				$(this).addClass("bg-info");
				selectedMainCat(this.id);
			})
		})
	}

	function selectedMainCat(id) {
		$.ajax ({
			type: 'POST',
			url: 'setup/referentialFiles/main_cat/class.php',
			data: 'id=' + id + '&form=selectedMainCat',
			success: function(data) {
				var arr = data.split("|");
				$("#hiddenmaincatid").val(arr[0]);
				$("#MainCatCode").val(arr[0]);
				$("#MainCatDesc").val(arr[1]);
				$("#imahengmetro").attr("src", arr[2]);
				if(arr[2] != "1"){
					$(".androidicon").css("display", "block");
					$("#imahengmetro").css("display", "block");
					$("#logongupload").css("display", "none");
					$("#textngupload").css("display", "none");
					$("#androidicon").prop("disabled", true);
					$("#btnremovephoto").css("display", "none");
				}else{
					$(".androidicon").css("display", "none");
					$("#imahengmetro").css("display", "none");
					$("#logongupload").css("display", "none");
					$("#textngupload").css("display", "none");
					$("#androidicon").prop("disabled", false);
					$("#btnremovephoto").css("display", "none");
				}
			}
		})
	}

	function clickAddMainCat() {
		$("#tblmaintenance_category tr").unbind("click");
		$("#tblmaintenance_category tr").removeClass("bg-selected");
		$("#buttonsMainCat").css("display", "none");
		$("#savingbuttonsMainCat").css("display", "block");
		$(".txtMainCat").removeAttr("readonly");
		$(".txtMainCat").val("");
		$(".androidicon").css("display", "block");
		$("#imahengmetro").css("display", "none");
		$("#androidicon").css("display", "block");
		$("#textngupload").css("display", "block");
		$("#logongupload").css("display", "block");
		$("#btnremovephoto").css("display", "none");
	}

	function cancelbuttonMainCat() {
		mainCatSelected();
		displayMainCat2();
		$("#buttonsMainCat").css("display", "block");
		$("#savingbuttonsMainCat").css("display", "none");
		$(".txtMainCat").attr("readonly", "readonly");
		$(".txtMainCat").val("");
		$(".androidicon").css("display", "none");
		$("#imahengmetro").css("display", "none");
		$("#androidicon").css("display", "none");
		$("#textngupload").css("display", "none");
		$("#logongupload").css("display", "none");
		$("#btnremovephoto").css("display", "none");
	}

	function cancelbuttonMainCat2() {
		// deptselected();
		displayMainCat2();
		$("#buttonsMainCat").css("display", "block");
		$("#updatebuttonsMainCat").css("display", "none");
		$(".txtMainCat").attr("readonly", "readonly");
		$(".androidicon").css("display", "none");
		$("#imahengmetro").css("display", "none");
		$("#androidicon").css("display", "none");
		$("#textngupload").css("display", "none");
		$("#btnremovephoto").css("display", "none");
	}

	function saveMainCat() {
		var MainCatCode = $("#MainCatCode").val();
		var MainCatDesc = $("#MainCatDesc").val();
		if($("#MainCatCode").val()!="" && $("#MainCatDesc").val()!="")
        {
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/main_cat/class.php',
				data: 'MainCatCode=' + MainCatCode + '&MainCatDesc=' + MainCatDesc + '&form=saveMainCat',
				success: function (data) {
					var arr = data.split("|");
					if ( arr[0] == 1 ) {
						alert("Saved.");
						cancelbuttonMainCat();
						displayMainCat2();
						hiddenpangupload(arr[1]);
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

	function clickUpdateMainCat() {
		var MainCatCode = $("#MainCatCode").val();
		var image = $("#imahengmetro").attr("src");
		if(image != "1"){
			$("#btnremovephoto").css("display", "block");
		}else{
			$("#imahengmetro").css("display", "none");
			$("#logongupload").css("display", "block");
			$("#textngupload").css("display", "block");
			$("#androidicon").css("display", "block");
			$(".androidicon").css("display", "block");
			$("#btnremovephoto").css("display", "none");
			$("#androidicon").prop("disabled", false);
		}
		if ( MainCatCode == "" ) {
			alert("Select code first");
		}

		else if ( MainCatDesc == "" ) {
			alert("Select description first");
		}

		else {
			$.ajax({
				type: 'POST',
				url: 'setup/referentialFiles/main_cat/class.php',
				data: 'MainCatCode=' + MainCatCode + '&form=clickUpdateMainCat',
				success:function(data){
					if(data == 0){
						$("#tblmaintenance_category tr").unbind("click");
						$("#buttonsMainCat").css("display", "none");
						$("#updatebuttonsMainCat").css("display", "block");
						$(".txtMainCat").removeAttr("readonly");
					}else{
						$("#tblmaintenance_category tr").unbind("click");
						$("#buttonsMainCat").css("display", "none");
						$("#updatebuttonsMainCat").css("display", "block");
						$("#MainCatDesc").removeAttr("readonly");
					}
				}
			})
			
		}
	}

	function updateMainCat() {
		var hiddenmaincatid = $("#hiddenmaincatid").val();
		var MainCatCode = $("#MainCatCode").val();
		var MainCatDesc = $("#MainCatDesc").val();
		if($("#MainCatCode").val()!="" && $("#MainCatDesc").val()!="")
        {
			$.ajax ({
				type: 'POST',
				url: 'setup/referentialFiles/main_cat/class.php',
				data: 'hiddenmaincatid=' + hiddenmaincatid + '&MainCatCode=' + MainCatCode + '&MainCatDesc=' + MainCatDesc + '&form=updateMainCat',
				success: function (data) {
					var arr = data.split("|");
					if ( arr[0] == 1 ) {
						alert("Saved.");
						cancelbuttonMainCat();
						cancelbuttonMainCat2();
						displayMainCat2();
						hiddenpangupload(arr[1]);
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

	function clickDeleteMainCat() {
		var MainCatCode = $("#MainCatCode").val();
		var MainCatDesc = $("#MainCatDesc").val();

		if ( MainCatCode == "" ) {
			alert("Select code first.");
		}

		else if ( MainCatDesc == "" ) {
			alert("Select description first.");
		}

		else {
			if ( confirm( "Are you sure you want to delete " + MainCatDesc ) == true ) {
				$.ajax ({
					type: 'POST',
					url: 'setup/referentialFiles/main_cat/class.php',
					data: 'MainCatCode=' + MainCatCode + '&MainCatDesc=' + MainCatDesc + '&form=deleteMainCat',
					success: function (data) {
						if ( data == 1 ) {
							alert(MainCatDesc + " has been deleted.");
							cancelbuttonMainCat2();
							cancelbuttonMainCat();
							displayMainCat2();
						}

						else {
							alert(data);
						}
					}
				})
			}
		}
	}

	function saveicon(){

	}

	function showpic(){
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("androidicon").files[0]);
		
		oFReader.onload = function (oFREvent) {
			$("#imahengmetro").css("display", "block");
			$("#logongupload").css("display", "none");
			$("#textngupload").css("display", "none");
			$("#btnremovephoto").css("display", "block");
			$("#androidicon").prop("disabled", true);
			document.getElementById("imahengmetro").src = oFREvent.target.result;
		};
	}

	function removephoto()
	{
		$("#imahengmetro").attr("src", "#");
		$("#imahengmetro").css("display", "none");
		$("#logongupload").css("display", "block");
		$("#textngupload").css("display", "block");
		$("#androidicon").val("");
		$("#btnremovephoto").css("display", "none");
		$("#androidicon").prop("disabled", false);
	}

	function hiddenpangupload(id){
		$("#pinaghuhugutan").val(id);
		var data = new FormData($('#posting_icon')[0]);
      	$.ajax({
	        type: 'POST',
	        url: 'setup/referentialFiles/main_cat/uploadingicon.php',
	        data: data,
	        mimeType: 'multipart/form-data',
	        contentType: false,
	        cache: false,
	        processData: false,
	        success:function(data2){
	        	removephoto();
	        }
      	})
	}

</script>