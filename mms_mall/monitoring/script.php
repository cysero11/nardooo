<script type="text/javascript">
	setTimeout(function(){
		sycndata();
		opensettingTIme();

		$(".date-picker").datepicker({
			autoHide: true,
			format: 'mm/dd/yyyy',
			todayHighlight: true
		})

		$('.numbers').keypress(function(event) {
			if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57 || event.which == 44 )) {
				event.preventDefault();
			}
		}); 

		// function getNumber(num) {

		// }

		$(".numbers").blur(function(){
			var amount = $(this).val();

			$(this).val(currency(amount)); 
		})

		checkDate();
	}, 500)

	function checkDate() {
		$("#dateTo").blur(function(){
			var dateFrom = $("#dateFrom").val().toString();
			var dateTo = $("#dateTo").val().toString();
			// alert(dateFrom);
			if ( dateTo == "" ) {

			}

			else {
				if ( dateTo < dateFrom ) {
					$("#modalAlert").modal("show");
					$("#alertStat").text("The second date must not be less than the first.");
					$("#dateTo").val("");

					checkDate();
				}
			}
		})
	}

	function currency(price) {
		// alert(price);
		$.ajax ({
			type: 'POST',
			url: 'monitoring/class.php',
			async: !1,
			data: 'amount=' + price + '&form=numLayout',
			success: function(data) {
				amount2 = data; 
			}
		}) 
		return amount2;
	}

	var count = 0;
	function sycndata() {
		// alert();
		var tenantName = $("#tenantName").val();
		var dateFrom = $("#dateFrom").val();
		var dateTo = $("#dateTo").val();
		var filterStat = $("#filterStat").val();
		$.ajax({
			type: 'POST',
			url: 'monitoring/class.php',
			data: 'tenantName=' + tenantName + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&count=' + count + '&filterStat=' + filterStat + '&form=syncbody',
			beforeSend : function() {
	            $('#indexloadingscreen').addClass('myspinner');
	        },
	        success: function(data){
	            $('#indexloadingscreen').removeClass('myspinner');
				var arr = data.split("|");

				$("#syncbody").html(arr[0]);
				$("#countid").val(arr[1]);
				var countid = $("#countid").val();
				if ( countid == 0 ) {
					$(".btn-page").attr("disabled", "disabled");
				}

				else {
					if ( count == 0 ) {
						$(".btn-page-1").attr("disabled", "disabled");
						$(".btn-page-2").removeAttr("disabled");
					}

					else if ( count == Number(countid) * 10 ) {
						$(".btn-page-2").attr("disabled", "disabled");
						$(".btn-page-1").removeAttr("disabled");	
					}

					else {
						$(".btn-page").removeAttr("disabled");
					}
				}

				selectOne();
				checkSelected();
			}
		})
	}

	function page(txt) {
		var countid = $("#countid").val();
		if ( txt == 'first' ) {
			count = 0;
			sycndata();
		}

		else if ( txt == 'prev' ) {
			count = Number(count) - 10;
			sycndata();
		}

		else if ( txt == 'next' ) {
			count = Number(count) + 10;
			sycndata();
		}

		else {
			count = Number(countid) * 10;
			sycndata();
		}
	}

	function saveTime() {
		var wholeTime = $("#hours").val() + ":" + $("#mins").val() + " " + $("#ampm").val();
		var oras = $("#hours").val();
		var minuto = $("#mins").val();
		var ewan = $("#ampm").val();
		var dateFromsync = $("#dateFromsync").val();
		var dateTosync = $("#dateTosync").val();
		var daterange = 0;
		var allexistingcsv = 0;
		var datetodaysync = 0;
		var synctype = "";

		$(".synctype").each(function(){
        if ( $(this).prop("checked") ) {
            synctype = this.value;
	        }
	    })

	    if( synctype == "1" ){
			daterange = "1";
		}
		else if( synctype == "2" ){
			datetodaysync = "2";
		}

		$.ajax ({
			type: 'POST',
			url: 'monitoring/class.php',
			data: 'dateFromsync=' + dateFromsync + '&dateTosync=' + dateTosync + '&daterange=' + daterange + '&datetodaysync=' + datetodaysync + '&wholeTime=' + wholeTime + '&oras=' + oras + '&minuto=' + minuto + '&ewan=' + ewan + '&form=saveTime2',
			success: function(data) {
				if ( data == 1 ) {
					$("#modalAlert").modal("show");
					$("#alertStat").text("Setup has been saved. . .");
					opensettingTIme();
				}

				else {
					alert(data);
				}
			}
		})
	}

	function modal_opensettingTIme(){
		$("#settingTIme").modal("show");
		opensettingTIme();
	}

	function opensettingTIme() {

		$.ajax ({
			type: 'POST',
			url: 'monitoring/class.php',
			data: 'form=getTimeSync',
			success: function(data) {
				// alert(data);
				var arr = data.split("|");
				$("#hours").val(arr[0]);
				$("#mins").val(arr[1]);
				$("#ampm").val(arr[2]);
				$("#dateFromsync").val(arr[3]);
				$("#dateTosync").val(arr[4]);
				$("#synctype").val(arr[5]);
				$(".synctype").each(function(){
					if($(this).val() == arr[5])
					{ $(this).prop("checked", true); }
				});
			}
		})
	}

	function savecsv() {
		var synctype =  $("#synctype").val();
		var dateFrom = $("#dateFromsync").val();
		var dateTo = $("#dateTosync").val();
		if(synctype == "2"){
			$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class2.php',
			data: 'form=importcsv',
			beforeSend: function() {
				$("#loadingSync").modal("show");
			},
			success: function(data) {
					if ( data == "8888" ) {
						$("#loadingSync").modal("hide");
						alert("Files for this date has already synced.");
					}

					else {
						$("#loadingSync").modal("hide");
						alert("Files Successfully Synced.");
						sycndata();
					}
				}
			})
		}
		else if(synctype == "1"){
			$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class5.php',
			data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=importcsv',
			beforeSend: function() {
				$("#loadingSync").modal("show");
			},
			success: function(data) {
					// $("#loadingSync").modal("hide");
					// alert("Files Successfully Synced.");
					// sycndata();	

					if ( data == "8888" ) {
						$("#loadingSync").modal("hide");
						alert("Files for this date has already synced.");
					}

					else {
						$("#loadingSync").modal("hide");
						alert("Files Successfully Synced.");
						sycndata();
					}
					// alert(data);
				}
			})
		}
	}

	function searchSync() {
		count = 0;
		sycndata();
	}

	function resetSync() {
		count = 0;
		dateFrom = "<?php echo date('m/d/Y'); ?>";
		dateTo = "<?php echo date('m/d/Y'); ?>";
		// alert(dateTo);	

		$("#tenantName").val("");
		$("#dateFrom").val(dateFrom);
		$("#dateTo").val(dateTo);

		setTimeout(function(){
			sycndata();
		}, 300)
	}

	function tsekanlahat() {
		var tenantName = $("#tenantName").val();
		var dateFrom = $("#dateFrom").val();
		var dateTo = $("#dateTo").val();
		if ( $("#maincheckbox").is(":checked") ) {
			$.ajax ({
				type: 'POST',
				url: 'monitoring/class.php',
				// data: 'form=mgaKulang',
				data: 'tenantName=' + tenantName + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&count=' + count + '&form=mgaKulang',
				success: function(data) {
					$("#forPenalty").val(data);
					var incomplete = $("#forPenalty").val();

					var arr = incomplete.split("|");

					
				}
			})
			$(".mgacheckbox").prop("checked", true);
			
		}

		else {
			$(".mgacheckbox").removeAttr("checked");
			$("#forPenalty").val("");
		}
	}

	function selectOne() {
		
		$(".mgacheckbox").each(function(){
			$(this).click(function(){
				var incomplete = $("#forPenalty").val();
				var eto = this.id;
					
				
				if ( $(this).is(":checked") ) {
					$("#forPenalty").val(incomplete + "|" + eto);
					// setTimeout(function(){
						if ( $("#forPenalty").val() == "" ) {
							$("#maincheckbox").removeAttr("checked");
							alert();
						}

						else {
							$("#maincheckbox").prop("checked", "checked");
						}
					// }, 300)

				}

				else {
					$("#forPenalty").val(incomplete.replace("|" +  this.id, ""));
					// setTimeout(function(){
						if ( $("#forPenalty").val() == "" ) {
							$("#maincheckbox").removeAttr("checked");
						}

						else {
							$("#maincheckbox").prop("checked", "checked");
						}
					// }, 300)
				}


			})
		})
	}

	function checkSelected() {
		var mganapili = $("#forPenalty").val();
		var arr = mganapili.split("|");

		for ( var a = 1; a <= arr.length - 1; a++ ) {
			$("#" + arr[a]).prop("checked", true);
		}
	}

	function postPenalty() {
		if ( $("#forPenalty").val() == "" ) {
			$("#modalAlert").modal("show");
			$("#alertStat").text("There's no data selected.");
		}

		else {
			var interference = $("#forPenalty").val();
			$.ajax ({
				type: 'POST',
				url: 'monitoring/class.php',
				data: 'interference=' + interference + '&form=applyPenalty',
				success: function(data) {
					if ( data == 1 ) {
						searchSync();
						$("#forPenalty").val("");
						// alert();
						$("#maincheckbox").removeAttr("checked");
						$("#modalAlert").modal("show");
						$("#alertStat").text("Penalty successfully posted.");
					}

					else {
						alert(data);

						$("#tenantName").val(data);
					}
					// alert(data);
				}
			})
		}
	}

	function syncfiles2(refno) {
		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class2.php',
			data: 'refno=' + refno + '&form=importcsv2',
			beforeSend: function() {
				$("#loadingSync").modal("show");
			},
			success: function(data) {
				// $("#loadingSync").modal("hide");
				// alert("Files Successfully Synced.");
				// sycndata();	

				if ( data == "8888" ) {
					$("#loadingSync").modal("hide");
					alert("Files for this date has already synced.");
				}

				else {
					$("#loadingSync").modal("hide");
					alert("Files Successfully Synced.");
					sycndata();
				}
				// alert(data);
			}
		})
	}
</script>