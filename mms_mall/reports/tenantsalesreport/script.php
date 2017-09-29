<script type="text/javascript">
	setTimeout(function(){
		notupdated();
		

		$('.sparkline').each(function(){
			var $box = $(this).closest('.infobox');
			var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
			$(this).sparkline('html',
			 {
				tagValuesAttribute:'data-values',
				type: 'bar',
				barColor: barColor ,
				chartRangeMin:$(this).data('min') || 0
			 });
		});

		numberoftenants();

		yearpie();
		selectType();
		// wholeYearBar();
		// sycndata();
		wholeYearList();

		Highcharts.setOptions({
			lang: {
				decimalPoint: '.',
				thousandsSep: ','
			}
		});

		selectNav();

		$(".date-picker").datepicker({
			autoHide: true,
			format: 'mm/dd/yyyy',
			todayHighlight: true
		})
		
	},400)

	

	function forYear() {
		$(".mainBody").css("display", "none");
		$("#whole1").css("display", "block");
	}

	function forMonth() {
		$(".mainBody").css("display", "none");
		$("#monthview").css("display", "block");
	}

	function forWeek() {
		$(".mainBody").css("display", "none");
		$("#weekview").css("display", "block");
	}

	function selectFirst() {
		if ( $("#btnYear").hasClass("active") ) {
			$(".mainBody").css("display", "none");
			$("#whole1").css("display", "block");
			// sycndata();
			selectallfirst();
			wholeYearList();
		}

		else {
			$(".mainBody").css("display", "none");
			$("#monthview").css("display", "block");
			displayMonth();
		}
	}


	function selectType() {
		$("#selectType li").each(function(){
			$(this).click(function(){
				$("#selectType li").removeClass("active");
				$(this).addClass("active");

				// if ( $(this).find("a").text() == "Month" ) {
				// 	// displayMonth();
				// }
			})
		})
	}

	function numberoftenants() {
		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class.php',
			data: 'form=tenant',
			success: function(data) {
				$("#tenants").text(data);
			}
		})
				
	}

	function tenantsName(id) {
		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class.php',
			data: 'id=' + id + '&form=tenantsName',
			success: function(data) {
				$("#tenantName").val(data);
			}
		})
	}

	function notupdated() {
		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class.php',
			data: 'form=notupdated',
			success: function(data) {
				var arr = data.split("|");

				$(".notupdated").attr("data-percent", arr[1])
				$(".notupdated2").text(arr[1]);
				$(".notupdated3").text(arr[0]);
				bilog();
			}
		})
	}

	function bilog() {
		$('.easy-pie-chart.percentage').each(function(){
			var $box = $(this).closest('.infobox');
			var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
			var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
			var size = parseInt($(this).data('size')) || 50;
			$(this).easyPieChart({
				barColor: barColor,
				trackColor: trackColor,
				scaleColor: false,
				lineCap: 'butt',
				lineWidth: parseInt(size/10),
				animate: ace.vars['old_ie'] ? false : 1000,
				size: size
			});
		})
	}

	function selectallfirst() {
		var id = $("#listTenant").val();
		if ( id == "" ) {
			yearpie();

		}

		else {
			wholeYearBar();
			// alert(id);
		}
	}

	function yearpie() {
		var arrdata = JSON.parse(yearlypie());

		var data = arrdata;
	
		chart = new Highcharts.Chart(
		{
			credits: {
				enabled: false
			},
			series:[{
				"data": data,
				type: 'pie',
				animation: false,
				point:{
					events:{
						click: function (event) {
							selectTenant(this.id);
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
				"renderTo":"yearpie"
			},
			title: {
				text: 'Total Sales of All Store for <?php echo date("Y"); ?>'
			},
		});
	}


	function yearlypie() {
		var mall = $("#mallsid").val();
		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'mall=' + mall + '&form=yearlypie', 
			success:function(data){
				// alert(data);
				arr = data; 
			}
		}); 

		return arr;
	}

	function selectedTenant() {
		var mall = $("#mallsid1").val();
		var id = $("#listTenant").val();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();
		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'id=' + id + '&year=' + year + '&month=' + month + '&form=selectedSales', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function selectedTenantDiscount() {
		var mall = $("#mallsid1").val();
		var id = $("#listTenant").val();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();
		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: 'id=' + id + '&year=' + year + '&month=' + month + '&form=selectedDiscount', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function selectedTenantVoid() {
		var mall = $("#mallsid1").val();
		var id = $("#listTenant").val();
		var year = $("#selectYear").val();
		var month = $("#searchMonth").val();
		var arr = '';
		$.ajax({
			type:'POST',
			async: false,
			url:'reports/tenantsalesreport/class.php',
			data: 'id=' + id + '&year=' + year + '&month=' + month + '&form=selectedTenantVoid', 
			success:function(data){
				// alert(data);
				arr = data;      
			}
		}); 

		return arr;
	}

	function wholeYearBar() {
		// $("#whole1").css("display", "none");
		// $("#body2").css("display", "block");
		// $("#selectedTenant").val(id);

		// $("#listTenant").val(id);
		var tenantName = $("#tenantName").val();
		var tenantName2 = "";
		if ( tenantName == "" ) {
			tenantName2 = "";
		}

		else {
			tenantName3 = "<b style='font-size: 40px;'>" + $("#tenantName").val() + "</b>" + '<br>';
			tenantName2 = '<br><br>Year <?php echo date("Y"); ?>';
		}



		var arrdata = JSON.parse(selectedTenant());
		var arrdata2 = JSON.parse(selectedTenantDiscount());
		var arrdata3 = JSON.parse(selectedTenantVoid());

		// var data = [107, 31, 635, 203, 2];
	
		Highcharts.chart('yearpie', {
			chart: {
				type: 'bar'
			},
			title: {
				text: tenantName3 + 'Monthly Sales' + tenantName2 
			},
			subtitle: {
				// text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
			},
			xAxis: {
				categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				title: {
					text: null
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Total',
					align: 'high',
				},
				labels: {
					overflow: 'justify'
				}
			},
			tooltip: {
				valueSuffix: ' millions'
			},
			plotOptions: {
				bar: {
					dataLabels: {
						enabled: true
					}
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'top',
				// x: -40,
				// y: 80,
				floating: true,
				borderWidth: 1,
				backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
				shadow: true
			},
			credits: {
				enabled: false
			},

			// plotOptions: {
			// 	series: {
			// 		cursor: 'pointer',
			// 		point: {
			// 			events: {
			// 				click: function () {
			// 					selectThis(this.category, this.x);
			// 				}
			// 			}
			// 		}
			// 	}
			// },

			series: [{
				name: 'Sales',
				data: arrdata,
			}, {
				name: 'Discount',
				data: arrdata2,
			}, {
				name: 'Void',
				data: arrdata3,
			}],

			exporting: { enabled: true }
		});
	}

	function selectThis(content, monthAxis) {
		var arr = content.split("|");
		$(".mainBody").css("display", "none");
		$("#monthview").css("display", "block");

		displayMonth();
		barMonth();
	}

	function searchTenant(id) {
		tenantsName(id);
	}




	function stockYear() {
		var arrdata = JSON.parse(stackedTenant());

		Highcharts.chart('yearpie', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Stacked column chart'
			},
			xAxis: {
				categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Total fruit consumption'
				},
				stackLabels: {
					enabled: true,
					style: {
						fontWeight: 'bold',
						color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
					}
				}
			},
			legend: {
				align: 'right',
				x: -30,
				verticalAlign: 'top',
				y: 25,
				floating: true,
				backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
				borderColor: '#CCC',
				borderWidth: 1,
				shadow: false
			},
			tooltip: {
				headerFormat: '<b>{point.x}</b><br/>',
				pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
			},
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
					}
				}
			},
			series: arrdata
		});
	}

	function stackedTenant() {
		var arr = '';
		$.ajax({
			type:'POST',
			async:false,
			url:'reports/tenantsalesreport/class.php',
			data: '&form=stackedTenant', 
			success:function(data){
				arr = data;      
			}
		}); 

		return arr;
	}

	function wholeYearList() {
		var id = $("#listTenant").val();
		var mallid = $("#mallsid").val();

		$.ajax ({
			type: 'POST',
			url: 'reports/tenantsalesreport/class.php',
			data: 'id=' + id + '&mallid=' + mallid + '&form=wholeYearList',
			success: function(data) {
				$("#tblWholeYearSales").html(data);
			}
		})
	}

	function selectNav() {
		$("#navigationReps li").each(function(){
			$(this).click(function(){
				$("#navigationReps li").removeClass("active");
				$(this).addClass("active");
			})
		})
	}

	function openGraph() {
		$("#graphs").css("display", "block");
		$("#pageList").css("display", "none");
	}

	function openList() {
		$("#pageList").css("display", "block");
		$("#graphs").css("display", "none");
	}
</script>