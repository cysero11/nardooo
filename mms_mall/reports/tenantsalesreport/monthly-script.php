<script type="text/javascript">
	setTimeout(function() {
		loadDefault();
		// displayMonth();
		displayTenantList();
		Highcharts.setOptions({
			lang: {
				decimalPoint: '.',
				thousandsSep: ','
			}
		});
		
	}, 300)

	function loadDefault() {
		$("#selectYear").val("<?php echo date('Y'); ?>");
		$("#searchMonth").val("<?php echo date('m'); ?>");
	}

	function getMonthDetails(id) {
		var mallid = $("#mallsid").val();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&id=' + id + '&mallid=' + mallid + '&form=monthpie', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	var mgaBuwan = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

	function displayMonth() {
		$("#selectType li").removeClass("active");
		$("#btnMonth").addClass("active");
		$("#displayresults").html("");
		forMonth();

		var id = $("#listTenant").val();
		var arrdata = JSON.parse(getMonthDetails(id));
		var monthName = "";
		var tenantName = $("#nameoftenant").val();
		var tenantName2 = "";
		if ( tenantName == "" ) {
			tenantName2 = "All Stores";
			monthName = mgaBuwan[Number($("#searchMonth").val())] + ", " + $("#selectYear").val();
		}

		else {
			tenantName2 = $("#tenantName").val();
			monthName = mgaBuwan[Number($("#searchMonth").val())] + ", " + $("#selectYear").val();
		}

		chart = new Highcharts.Chart(
		{
			credits: {
				enabled: false
			},
			series:[{
				"data": arrdata,
				type: 'pie',
				animation: false,
				point:{
					events:{
						click: function (event) {
							breakdownMonth(this.id, this.name);
						}
					}
				},
				dataLabels:{
					enabled:true,
					formatter:function() {
						return Highcharts.numberFormat(this.y);
					}
				}   
			}],
			legend: {
				layout: 'vertical',
				align: 'left',
				verticalAlign: 'bottom',
				// x: -40,
				// y: 80,
				floating: true,
				borderWidth: 1,
				backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
				shadow: true
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			"chart":{
				"renderTo":"thisMonthly"
			},
			title: {
				text: tenantName2 + '<br>Monthly Sales<br>' + monthName
			},
		});

		barMonth();
		numdays();
	}

	function numdays() {
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&form=monthdays', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function getMonthSales() {
		var mallid = $("#mallsid").val();
		var id = $("#listTenant").val();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&id=' + id + '&mallid=' + mallid + '&form=getMonthSales', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function getMonthDiscount() {
		var mallid = $("#mallsid").val();
		var id = $("#listTenant").val();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&id=' + id + '&mallid=' + mallid + '&form=getMonthDiscount', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function getMonthVoid() {
		var mallid = $("#mallsid").val();
		var id = $("#listTenant").val();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&id=' + id + '&mallid=' + mallid + '&form=getMonthVoid', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function barMonth() {
		Highcharts.setOptions({
			lang: {
				decimalPoint: '.',
				thousandsSep: ','
			}
		});

		var tenantName = $("#nameoftenant").val();
		var tenantName2 = "";
		var monthName = "";
		if ( tenantName == "" ) {
			tenantName2 = "All Tenants";
			monthName = mgaBuwan[Number($("#searchMonth").val())] + " " + $("#selectYear").val();
		}

		else {
			tenantName2 = $("#tenantName").val();
			monthName = mgaBuwan[Number($("#searchMonth").val())] + " " + $("#selectYear").val();
		}

		var arrdata = JSON.parse(getMonthSales());
		var arrdata2 = JSON.parse(numdays());
		var arrdata3 = JSON.parse(getMonthDiscount());
		var arrdata4 = JSON.parse(getMonthVoid());
		
		Highcharts.chart('wholeMonth', {
			credits: {
				enabled: false
			},
			chart: {
				type: 'line'
			},
			title: {
				text: tenantName2 + '<br>Daily Sales<br>' + monthName
			},
			subtitle: {
				
			},
			xAxis: {
				categories: arrdata2,
				crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Php'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y:,.1f} Php</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: 'Sales',
				data: arrdata,
				color: "#00D40E",
				point:{
					events:{
						click: function (event) {
							openDaily( Number(this.x) + 1, "Sales" );
						}
					}
				},

			}, {
				name: 'Discount',
				data: arrdata3,
				color: "#006AD4",
				point:{
					events:{
						click: function (event) {
							openDaily( Number(this.x) + 1, "Discount" );
						}
					}
				},

			}, {
				name: 'Void',
				data: arrdata4,
				color: "#D40000",
				point:{
					events:{
						click: function (event) {
							openDaily( Number(this.x) + 1, "Sales" );
						}
					}
				},
			}]
		});
	}

	function breakdownMonth(id, name) {
		previewSales(id, name);
	}

	function previewSales(id, name) {
		var arrdata = "";
		var txt = "";

		if ( name == "Sales" ) {
			arrdata = JSON.parse(monthSales(id));
			txt = "Sales Breakdown";
		}

		else if ( name == "Void" ) {
			arrdata = JSON.parse(monthVoid(id));
			txt = "Void Breakdown";
		}

		else if (name == "Discount") {
			arrdata = JSON.parse(monthDiscount(id));
			txt = "Discount Breakdown";
		}

		

		chart = new Highcharts.Chart(
		{
			credits: {
				enabled: false
			},
			series:[{
				"data": arrdata,
				type: 'pie',
				animation: false,
				point:{
					events:{
						click: function (event) {
							//breakdownMonth(this.id, this.name);
						}
					}
				},
				dataLabels:{
					enabled:true,
					formatter:function() {
						return Highcharts.numberFormat(this.y);
					}
				}   
			}],
			legend: {
				layout: 'vertical',
				align: 'left',
				verticalAlign: 'bottom',
				// x: -40,
				// y: 80,
				floating: true,
				borderWidth: 1,
				backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
				shadow: true
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			"chart":{
				"renderTo":"displayresults"
			},
			title: {
				text: txt
			},
		});
	}

	function hourly(id, dayNum) {

		Highcharts.setOptions({
			lang: {
				decimalPoint: '.',
				thousandsSep: ','
			}
		});
		
		var tenantName = $("#tenantName").val();
		var tenantName2 = "";
		if ( tenantName == "" ) {
			tenantName2 = " of All Tenants<br>for " + mgaBuwan[Number($("#searchMonth").val())] + " " + dayNum + ", " + $("#selectYear").val();
		}

		else {
			tenantName2 = " of " + $("#tenantName").val() + "<br>for " + mgaBuwan[Number($("#searchMonth").val())] + " " + dayNum + ", " + $("#selectYear").val();
		}

		
		var arrdata = JSON.parse(getHourlySales(id, dayNum));
		// alert(arrdata);
		Highcharts.chart('graphHourly', {
			credits: {
				enabled: false
			},
			chart: {
				type: 'line'
			},
			title: {
				text: 'Hourly Sales ' + tenantName2
			},
			subtitle: {
				
			},
			xAxis: {
				categories: ['7:00am', '8:00am', '9:00am', '10:00am', '11:00am', '12:00nn', '1:00pm', '1:00pm', '2:00pm', '3:00pm', '4:00pm', '5:00pm', '6:00pm', '7:00pm', '8:00pm', '9:00pm', '10:00pm', '11:00pm'],
				crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Php'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y:,.1f} Php</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: 'Sales',
				data: arrdata,
				color: "#00D40E",
				// point:{
				// 	events:{
				// 		click: function (event) {
				// 			openDaily( Number(this.x) + 1, "Sales" );
				// 		}
				// 	}
				// },

			}]
		});
	}

	function monthSales(id) {
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&id=' + id + '&form=paymenttypeMonth', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function monthVoid(id) {
		// alert();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&id=' + id + '&form=voidMonth', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function monthDiscount(id) {
		// alert(id);

		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&id=' + id + '&form=monthDiscount', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function openDaily(dayNum, type) {
		$("#mdlFordaily").modal("show");
		var id = $("#listTenant").val();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class.php',
			data: 'id=' + id + '&year=' + year + '&month=' + month + '&dayNum=' + dayNum + '&form=perhourtbl',
			success: function(data) {
				$("#perhourtbl").html(data);
				hourly(id, dayNum);
			}
		})
	}

	function getHourlySales(id, dayNum) {
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();

		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'year=' + year + '&month=' + month + '&dayNum=' + dayNum + '&id=' + id + '&form=getHourlySales', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function showList() {
		$(".listHourly").css("display", "block");
		$("#graphHourly").css("display", "none");
	}

	function showLine() {
		$(".listHourly").css("display", "none");
		$("#graphHourly").css("display", "block");
	}

	function findTenant() {
		$("#searchTenat").modal("show");
		displayTenantList();
		countTenants = 0;
	}

	function kuhaInfo(id, name) {
		$("#listTenant").val(id);
		$("#tenantName").val(name);
		$("#searchTenat").modal("hide");
		$("#nameoftenant").val(name);
		$("#nameoftenant2").val(name);
		// alert(name);
	}

	var countTenants = 0;
	function displayTenantList() {
		var key = $("#txtSearchTenant").val();
		var mallsid = $("#mallsid").val();

		$.ajax({
			type: 'POST',
			url: 'reports/tenantsalesreport/class.php',
			data: 'key=' + key + '&countTenants=' + countTenants + '&mallsid=' + mallsid + '&form=displayTenants',
			success: function(data) {
				// alert(data);
				var arr = data.split("|");
				$("#tblTenants").html(arr[0]);
				$("#countTenants").val(arr[1]);
				var bilang = $("#countTenants").val();
				if ( bilang == 0 ) {
					$(".btn-page").attr("disabled", "disabled");
				}

				else {
					if ( countTenants == 0 ) {
						$(".btn-page-1").attr("disabled", "disabled");
						$(".btn-page-2").removeAttr("disabled");
					}
					else if ( countTenants == Number(bilang) * 10 ) {
						$(".btn-page-2").attr("disabled", "disabled");
						$(".btn-page-1").removeAttr("disabled");
					}

					else {
						$(".btn-page").removeAttr("disabled");
					}
				}
				
			}
		})
	}

	function palit(mallsid) {
		// var key = $("#txtSearchTenant").val();
		// var mallsid = $("#mallsid2").val();
		$("#mallsid").val(mallsid);
	}

	function palit2(mallsid) {
		// var key = $("#txtSearchTenant").val();
		// var mallsid = $("#mallsid2").val();
		$("#mallsid2").val(mallsid);
	}

	function pageTenant(txt) {
		var bilang = $("#countTenants").val();
		if ( txt == 'first' ) {
			countTenants = 0;
			displayTenantList();
		}

		else if ( txt == 'prev' ) {
			countTenants = Number(countTenants) - 10;
			displayTenantList();
		}
		else if ( txt == 'next' ) {
			countTenants = Number(countTenants) + 10;
			displayTenantList();
		}

		else {
			countTenants = Number(bilang) * 10;
			displayTenantList();
		}
	}

	

	function displayTenants2() {
		countTenants = 0;
		displayTenantList();
	}

	function resetSearch() {
		// alert();
		countTenants = 0;
		$("#nameoftenant").val("");
		$("#listTenant").val("");
		$("#nameoftenant2").val("");
	}
</script>