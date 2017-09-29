<script type="text/javascript">
	setTimeout(function() {
		$("#mgaList li").each(function() {
			$(this).click(function(){
				$("#mgaList li").removeClass("active");
				$(this).addClass("active");
			})
		})

		dbSales();
		dbHour();
		dbPayment();
		dbDiscount();
		dbVoid();

		mallsid();
	})

	function clickforall() {
		dbSales();
		dbHour();
		dbPayment();
		dbDiscount();
		dbVoid();

		countsales = 0;
		counthour = 0;
		countpayment = 0;
		countdiscount = 0;
		countvoid = 0;
	}

	function showSales() {
		$(".reportlists").css("display", "none");
		$(".paginationLists").css("display", "none");
		$("#showSales").css("display", "block");
		$("#pageSales").css("display", "block");
	}

	function showHour() {
		$(".reportlists").css("display", "none");
		$(".paginationLists").css("display", "none");
		$("#showHour").css("display", "block");
		$("#pageHour").css("display", "block");
	}

	function showPayment() {
		$(".reportlists").css("display", "none");
		$(".paginationLists").css("display", "none");
		$("#showPayment").css("display", "block");
		$("#pagePayment").css("display", "block");
	}

	function showDiscount() {
		$(".reportlists").css("display", "none");
		$(".paginationLists").css("display", "none");
		$("#showDiscount").css("display", "block");
		$("#pageDiscount").css("display", "block");
	}

	function showCanceled() {
		$(".reportlists").css("display", "none");
		$(".paginationLists").css("display", "none");
		$("#showVoid").css("display", "block");
		$("#pageVoid").css("display", "block");
	}

	var countsales = 0;
	var counthour = 0;
	var countpayment = 0;
	var countdiscount = 0;
	var countvoid = 0;

	function dbSales() {
		var mallid = $("#mallsid2").val();
		// alert(mallid);
		var id = $("#listTenant").val();
		var dateFrom = $("#dateFromList").val();
		var dateTo = $("#dateToList").val();

		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class4.php',
			data: 'id=' + id + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&countsales=' + countsales + '&mallid=' + mallid +  '&form=dbSales',
			success: function(data) {
				var arr = data.split("|")
				$("#db_sales").html(arr[0]);
				$("#countsales").val(arr[1]);

				var count = $("#countsales").val();
				if ( count == 0 ) {
					$(".btn-sales").attr("disabled", "disabled");
				}

				else {
					if ( countsales == 0 ) {
						$(".btn-sales-1").attr("disabled", "disabled");
						$(".btn-sales-2").removeAttr("disabled");
					}

					else if ( countsales == Number(count) * 10 ) {
						$(".btn-sales-2").attr("disabled", "disabled");
						$(".btn-sales-1").removeAttr("disabled");
					}

					else {
						$(".btn-sales").removeAttr("disabled");
					}
				}
			}
		})
	}

	function pagesales(txt) {
		var count = $("#countsales").val();
		if ( txt == 'first' ) {
			countsales = 0;
			dbSales();
		}

		else if ( txt == 'prev' ) {
			countsales = Number(countsales) - 10;
			dbSales();
		}

		else if ( txt == 'next' ) {
			countsales = Number(countsales) + 10;
			dbSales();
		}

		else {
			countsales = Number(count) * 10;
			dbSales();
		}
	}

	function dbHour() {
		var mallid = $("#mallsid2").val();
		var id = $("#listTenant").val();

		var id = $("#listTenant").val();
		var dateFrom = $("#dateFromList").val();
		var dateTo = $("#dateToList").val();

		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class4.php',
			data: 'id=' + id + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&counthour=' + counthour + '&mallid=' + mallid +   '&form=dbHour',
			success: function(data) {
				// alert(data);
				var arr = data.split("|")
				$("#db_hour").html(arr[0]);
				$("#counthour").val(arr[1]);

				var count = $("#counthour").val();
				if ( count == 0 ) {
					$(".btn-hour").attr("disabled", "disabled");
				}

				else {
					if ( counthour == 0 ) {
						$(".btn-hour-1").attr("disabled", "disabled");
						$(".btn-hour-2").removeAttr("disabled");
					}

					else if ( counthour == Number(count) * 10 ) {
						$(".btn-hour-2").attr("disabled", "disabled");
						$(".btn-hour-1").removeAttr("disabled");
					}

					else {
						$(".btn-hour").removeAttr("disabled");
					}
				}
			}
		})
	}

	function pagehour(txt) {
		var count = $("#counthour").val();
		if ( txt == 'first' ) {
			counthour = 0;
			dbHour();
		}

		else if ( txt == 'prev' ) {
			counthour = Number(counthour) - 10;
			dbHour();
		}

		else if ( txt == 'next' ) {
			counthour = Number(counthour) + 10;
			dbHour();
		}

		else {
			counthour = Number(count) * 10;
			dbHour();
		}
	}

	function dbPayment() {
		var mallid = $("#mallsid2").val();
		var id = $("#listTenant").val();

		var id = $("#listTenant").val();
		var dateFrom = $("#dateFromList").val();
		var dateTo = $("#dateToList").val();

		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class4.php',
			data: 'id=' + id + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&countpayment=' + countpayment + '&mallid=' + mallid +  '&form=dbPayment',
			success: function(data) {
				var arr = data.split("|")
				$("#db_payment").html(arr[0]);
				$("#countpayment").val(arr[1]);
				
				var count = $("#countpayment").val();
				if ( count == 0 ) {
					$(".btn-payment").attr("disabled", "disabled");
				}

				else {
					if ( countpayment == 0 ) {
						$(".btn-payment-1").attr("disabled", "disabled");
						$(".btn-payment-2").removeAttr("disabled");
					}

					else if ( countpayment == Number(count) * 10 ) {
						$(".btn-payment-2").attr("disabled", "disabled");
						$(".btn-payment-1").removeAttr("disabled");
					}

					else {
						$(".btn-payment").removeAttr("disabled");
					}
				}
			}
		})
	}

	function pagepayment(txt) {
		var count = $("#countpayment").val();
		if ( txt == 'first' ) {
			countpayment = 0;
			dbPayment();
		}

		else if ( txt == 'prev' ) {
			countpayment = Number(countpayment) - 10;
			dbPayment();
		}

		else if ( txt == 'next' ) {
			countpayment = Number(countpayment) + 10;
			dbPayment();
		}

		else {
			countpayment = Number(count) * 10;
			dbPayment();
		}
	}

	function dbDiscount() {
		var mallid = $("#mallsid2").val();
		var id = $("#listTenant").val();

		var id = $("#listTenant").val();
		var dateFrom = $("#dateFromList").val();
		var dateTo = $("#dateToList").val();

		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class4.php',
			data: 'id=' + id + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&countdiscount=' + countdiscount + '&mallid=' + mallid +  '&form=dbDiscount',
			success: function(data) {
				var arr = data.split("|")
				$("#db_discount").html(arr[0]);
				$("#countdiscount").val(arr[1]);

				var count = $("#countdiscount").val();
				if ( count == 0 ) {
					$(".btn-discount").attr("disabled", "disabled");
				}

				else {
					if ( countdiscount == 0 ) {
						$(".btn-discount-1").attr("disabled", "disabled");
						$(".btn-discount-2").removeAttr("disabled");
					}

					else if ( countdiscount == Number(count) * 10 ) {
						$(".btn-discount-2").attr("disabled", "disabled");
						$(".btn-discount-1").removeAttr("disabled");
					}

					else {
						$(".btn-discount").removeAttr("disabled");
					}
				}
			}
		})
	}

	function pagediscount(txt) {
		var count = $("#countdiscount").val();
		if ( txt == 'first' ) {
			countdiscount = 0;
			dbDiscount();
		}

		else if ( txt == 'prev' ) {
			countdiscount = Number(countdiscount) - 10;
			dbDiscount();
		}

		else if ( txt == 'next' ) {
			countdiscount = Number(countdiscount) + 10;
			dbDiscount();
		}

		else {
			countdiscount = Number(count) * 10;
			dbDiscount();
		}
	}

	function dbVoid() {
		var mallid = $("#mallsid2").val();
		var id = $("#listTenant").val();

		var id = $("#listTenant").val();
		var dateFrom = $("#dateFromList").val();
		var dateTo = $("#dateToList").val();

		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class4.php',
			data: 'id=' + id + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&countvoid=' + countvoid + '&mallid=' + mallid + '&form=dbVoid',
			success: function(data) {
				var arr = data.split("|")
				$("#db_void").html(arr[0]);
				$("#countvoid").val(arr[1]);

				var count = $("#countvoid").val();
				if ( count == 0 ) {
					$(".btn-void").attr("disabled", "disabled");
				}

				else {
					if ( countvoid == 0 ) {
						$(".btn-void-1").attr("disabled", "disabled");
						$(".btn-void-2").removeAttr("disabled");
					}

					else if ( countvoid == Number(count) * 10 ) {
						$(".btn-void-2").attr("disabled", "disabled");
						$(".btn-void-1").removeAttr("disabled");
					}

					else {
						$(".btn-void").removeAttr("disabled");
					}
				}
			}
		})
	}

	function pagevoid(txt) {
		var count = $("#countvoid").val();
		if ( txt == 'first' ) {
			countvoid = 0;
			dbVoid();
		}

		else if ( txt == 'prev' ) {
			countvoid = Number(countvoid) - 10;
			dbVoid();
		}

		else if ( txt == 'next' ) {
			countvoid = Number(countvoid) + 10;
			dbVoid();
		}

		else {
			countvoid = Number(count) * 10;
			dbVoid();
		}
	}

	function mallsid() {
		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class4.php',
			data: 'form=mallsid',
			success: function(data) {
				$(".selectMall").html(data);
			}
		})
	}
</script>