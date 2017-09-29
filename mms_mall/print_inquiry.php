<div style="display: none;">
<table style="width: 100%;" id="div_form_inquiry">
	<tr>
		<td colspan="4">
			<h3>Inquiry</h3>
			<br />
		</td>
	</tr>
	<tr>
		<td>Date Inquired</td>
		<td id="txtinqprint_dateinquired"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Company Name</td>
		<td id="txtinqprint_companyname"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Store Name</td>
		<td id="txtinqprint_storename"></td>
		<td></td>
		<td></td>		
	</tr>
	<tr>
		<td>Industry</td>
		<td id="txtinqprint_industry"></td>
		<td></td>
		<td></td>		
	</tr>	

	<tr>
		<td>Business Address</td>
		<td colspan="3" id="txtinqprint_busadd"></td>	
	</tr>	
	<tr><td colspan="4"><hr /></td></tr>
	<tr>
		<td colspan="4"><h4>Contacts</h4></td>	
	</tr>
	<tr>
		<td>Mobile numbers</td>
		<td id="Mobile_li_print"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Telephone numbers</td>
		<td id="Telephone_li_print"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Fax numbers</td>
		<td id="Fax_li_print"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Email Address</td>
		<td id="Email_li_print"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Website</td>
		<td id="Website_li_print"></td>
		<td></td>
		<td></td>
	</tr>
	<tr><td colspan="4"><hr /></td></tr>
	<tr>
		<td colspan="4"><h4>Unit Information</h4></td>	
	</tr>
	<tr>
		<td>Unit</td>
		<td id="txtinqprint_unit"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Floor</td>
		<td id="txtinqprint_flrname"></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Wing/Building</td>
		<td id="txtinqprint_wingname"></td>
		<td></td>
		<td></td>
	</tr>
	<tr><td><br /></td></tr>
	<tr>
		<td>Unit Type</td>
		<td id="txtinqprint_unittype"></td>
		<td>Unit Area</td>
		<td id="txtinqprint_area"></td>
	</tr>
	<tr>
		<td>Unit Classification</td>
		<td id="txtinqprint_class">Food</td>
		<td>Price per sqm</td>
		<td id="txtinqprint_priceperarea">Php 12,000.00</td>
	</tr>
	<tr>
		<td>Unit Department</td>
		<td id="txtinqprint_depa">Food Court</td>
		<td>Total Price</td>
		<td id="txtinqprint_ttlprice">Php 144,000.00</td>
	</tr>
	<tr>
		<td>Unit Category</td>
		<td id="txtinqprint_unitcategory">Specialty Food</td>
		<td></td>
		<td></td>
	</tr>
	<tr><td colspan="4"><hr /></td></tr>
	<tr>
		<td colspan="4"><h4>Unit Amenities</h4></td>	
	</tr>
	<tr>
		<td colspan="4">
			<ul class="list-unstyled" id="amenities_list">
			</ul></td>
	</tr>
	<tr><td colspan="4"><br /></td></tr>
	<tr><td colspan="4"><hr /></td></tr>
	<tr>
		<td colspan="2" style="display: block; position: relative;">
			<table width="100%">
				<tr>
					<td>Occupancy Date</td>
					<td id="txtinqprint_occupancydate">2-18-2017 - 2-19-2017</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Monthly Payment</td>
					<td id="txtinqprint_monthlypayment">Php 144,000.00</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>No of months</td>
					<td id="txtinqprint_noofmonths">24 months</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>No of days</td>
					<td id="txtinqprint_noofdays"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Advance<h6 style="font-size:10px; font-style: italic;margin:0px;">(No of Months)</h6></td>
					<td id="txtinqprint_advance">12 months - Php 144,000.00</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Deposit<h6 style="font-size:10px; font-style: italic;margin:0px;">(No of Months)</h6></td>
					<td id="txtinqprint_deposit">12 months - Php 144,000.00</td>
					<td></td>
					<td></td>
				</tr>				
			</table>
		</td>
		<td colspan="2" style="padding-top: 10px;">
			<table class="table table-striped table-bordered" style="width: 100%;border: 1px solid #CCC;">
              <thead>
                <tr>
                  <th style="width:15%;border-right: 1px solid #CCC;border-bottom: 1px solid #CCC;text-align: left;">#</th>
                  <th style="text-align: left;border-right: 1px solid #CCC;border-bottom: 1px solid #CCC;">PDC Date</th>
                  <th style="text-align: right;border-bottom: 1px solid #CCC;">Monthly Rent Fee</th>
                </tr>
              </thead>

              	<tbody id="tbodypdc_inquiry_print" >
				</tbody>
            </table>
            <hr />
            <h4 class="pull-right">
              Total amount :
              <span class="red"  id="txtinqprint_ttlamountpdc">Php 1,728.00</span>
            </h4>
		</td>
	</tr>	
</table>
</div>
<script>
function printData()
{
   var divToPrint=document.getElementById("div_form_inquiry");
   var newWin = window.open('', 'Inquiry', 'height=400,width=600');
   newWin.document.write('<html><head><title>Inquiry</title>');
   newWin.document.write('<style>table tr td{padding:5px;} .table tr td{padding:8px;} .table tr th{padding:8px;}</style>');
   newWin.document.write('</head><body >');
   newWin.document.write(divToPrint.outerHTML);
   newWin.document.write('</body></html>');
   newWin.print();
   newWin.close();
}

		
		function loadprintinfo(TradeID, Company_ID, Inquiry_ID, UnitID){

			$.ajax({
				type: 'POST',
				url: 'mainclass.php',
				data: 'TradeID=' + TradeID + '&Company_ID=' + Company_ID + '&Inquiry_ID=' + Inquiry_ID + '&form=viewinquiry',
				success: function(data)
				{
					var arr = data.split("|");
					
					if(arr[18] == "0")
					{
						var gitling1 = "";
					}
					else
					{
						var gitling1 = arr[18] + "month(s) - ";
					}

					if(arr[17] == "0")
					{
						var gitling2 = "";
					}
					else
					{
						var gitling2 = arr[17] + "month(s) - ";
					}
					$("#txtinqprint_dateinquired").text(arr[19]);
					$("#txtinqprint_occupancydate").text(arr[11] + " - " + arr[12]);
					
					$("#txtinqprint_noofmonths").text(arr[13]);
					$("#txtinqprint_noofdays").text(arr[14]);
					var months = arr[13];
					var days = arr[14];
					var datefrom = arr[11];
					var dateto = arr[12];
					var unit_id = "U-0000040";
					loadotherprint(months,days,datefrom,dateto,unit_id,TradeID, Company_ID, Inquiry_ID, UnitID)
					$("#txtinqprint_advance").text(gitling1 + "Php " + arr[16]);
					$("#txtinqprint_deposit").text(gitling2 + "Php " + arr[15]);
					// $("#txtinqprint_ttlamountpdc").text();
					// alert(UnitID + "1")

				}
			});

			$.ajax({
			  type: 'POST',
			  url: 'mainclass.php',
			  data: 'companyID=' + Company_ID + '&tradeID=' + TradeID +'&form=selecttenant',
			  success: function(data)
			  {
			  	// alert(data)
			    var arr = data.split("|");
			    $("#txtinqprint_storename").text(arr[13]);
			    $("#txtinqprint_companyname").text(arr[1]);
			    $("#txtinqprint_industry").text(arr[3]);
			    $("#txtinqprint_busadd").text(arr[4]);
			  }
			});

			$.ajax({
			  type: 'POST',
			  url: 'mainclass.php',
			  data: 'companyID=' + Company_ID + '&tradeID=' + TradeID +'&form=selectcontactnumbers2',
			  success: function(data)
			  {
			  	// alert(data)
			  	var arr = data.split("#|");
			    $("#Mobile_li_print").html(arr[0]);
			    $("#Fax_li_print").html(arr[2]);
				$("#Telephone_li_print").html(arr[1]);
				$("#Email_li_print").html(arr[3]);
				$("#Website_li_print").html(arr[4]);
			  }
			});

			$.ajax({
			  type: 'POST',
			  url: 'mainclass.php',
			  data: 'unit_id=' + UnitID + '&form=selected_unit_amenities2',
			  success: function(data)
			  {
			    $("#amenities_list").html(data);
			  }
			});

		}

		function loadotherprint(months,days,datefrom,dateto,unit_id,TradeID, Company_ID, Inquiry_ID, UnitID)
		{
			// alert(UnitID + "2")
			$.ajax({
			  type: 'POST',
			  url: 'mainclass.php',
			  data: 'Company_ID=' +Company_ID+ '&TradeID=' +TradeID+ '&UnitID=' +UnitID+ '&Inquiry_ID='+Inquiry_ID+ '&form=selectunit',
			  success: function(data)
			  {
			  	// alert(data)
			    var arr = data.split("|");
			    $("#txtinqprint_unit").text(arr[1]);
				$("#txtinqprint_flrname").text(arr[17]);
				$("#txtinqprint_wingname").text(arr[18]);
				$("#txtinqprint_unittype").text(arr[10]);
				$("#txtinqprint_area").text(arr[15] +" x "+arr[16]);
				$("#txtinqprint_class").text(arr[19]);
				$("#txtinqprint_priceperarea").text(arr[3]);
				$("#txtinqprint_depa").text(arr[20]);
				$("#txtinqprint_ttlprice").text(arr[4]);
				$("#txtinqprint_monthlypayment").text(arr[4]);
				$("#txtinqprint_unitcategory").text(arr[21]);

				// type += arr[10];
				loadprintttl(months,days,datefrom,dateto,arr[10],UnitID);
				loaddatetofunction_print(months,days,datefrom,dateto,arr[10],UnitID);
			  }
			})
		}
		function loadprintttl(months,days,datefrom,dateto,type,unit_id)
		{
			$.ajax({
			  type: 'POST',
			  url: 'mainclass.php',
			  data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&form=loadtbodypdc_inquiry2',
			  success: function(data)
			  {
			    var arr = data.split("|");
			    $("#txtinqprint_ttlamountpdc").text("Php " + arr[0]);
			    // loaddatefunction4(arr[1], arr[2]) //set units
			  }
			})
		}

		function loaddatetofunction_print(months,days,datefrom,dateto,type,unit_id)
		{
			//alert(months+"|"+days+"|"+datefrom+"|"+dateto+"|"+type+"|"+unit_id+"|")
			// $("#jxnjdncdj").val()

		    $.ajax({
		      type: 'POST',
		      url: 'mainclass.php',
		      data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&form=loadtbodypdc_inquiry3',
		      success: function(data)
		      {
		      	// alert(data)
		             $("#tbodypdc_inquiry_print").html(data);          
					printData()
		      }
		    })
		}

	</script>