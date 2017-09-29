<div style="display: none;">
	<div id="printcontract">
		<div class="container-fluid">
			<table style="width: 100%;margin-bottom: 20px;" cellspacing="0" cellpadding="0">
				<tbody id="template"></tbody>
			<tr><td style="padding:10px;"></td></tr>
			<tr>
				<td colspan="5" align="center" style="background-color: #333333 !important;-webkit-print-color-adjust: exact;"><h6 style="font-weight: bold;margin: 3px;font-size: 20px;color: #ffffff !important;">LEASE CONTRACT</h6></td>
			</tr>
			</table>
				<div class="row" id="showinfo">
					<table>
						<tr style="font-size: 18px;"><b>Unit Information</b></tr>
						<tr><td>Unit Address</td>						<td>:</td>				<td><label id="unitaddress"></label></td></tr>
						<tr><td>Tenant ID</td>							<td>:</td>				<td><label id="tenant_ID"></label></td></tr>
						<tr><td>Store Name</td>							<td>:</td>				<td><label id="storename" style="font-weight: bold !important;"></label></td></tr>
						<tr><td>Address</td>							<td>:</td>				<td><label id="address"></label></td></tr>
						<tr><td>Authorized Signatory</td>				<td>:</td>				<td><label id="authorizedsignatory"></label></td></tr>
						<tr><td>Contact Numbers</td>					<td>:</td>				<td><label id="contactnumbers"></label></td></tr>
						<tr><td>Nature of Business</td>					<td>:</td>				<td><label id="natureofbusiness"></label></td></tr>
						<tr><td>Classification</td>						<td>:</td>				<td><label id="classification"></label></td></tr>
						<tr><td>Lease Unit/Floor</td>					<td>:</td>				<td><label id="leaseunitfloor"></label></td></tr>
						<tr><td>Monthly Rent</td>						<td>:</td>				<td><label id="monthlyrent"></label></td></tr>
						<tr><td>Lease Period</td>						<td>:</td>				<td><label id="leaseperiod"></label></td></tr>
					</table>
				</div>

			<div id="termsandcondition" style="text-align: center; font-size: 20px;"><b>TERMS AND CONDITIONS</b></div>
			<hr style="border: 1px solid #333333;width: 100%;margin-top:7px;margin-bottom: 3px;">
				<table cellspacing="10">
					<th width="200" style="font-size: 18px;">Terms</th>
					<th width="400" style="font-size: 18px;">Conditions</th>
					<tbody id="termsandcondition2"></tbody>
				</table>
				<table style="margin-top: 50px;margin-left: 50px;">
                        <tr>
                            <td></td>
                            <td width="200" style="border-bottom: 1px solid #333;""></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td width="200" style="border-bottom: 1px solid #333"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: center;margin-left: 50px;"><strong>Lessee Signature</strong></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td style="text-align: center;"><strong>Lessor Signature</strong></td>
                        </tr>
                    </table>
		</div>
	</div>
</div>

<script>
function printcontract(Inquiry_ID, mallID){

		// load header depending on mall
		$.ajax({
			type: 'POST',
			url: 'mainclass.php',
			data: 'mallID=' + mallID + '&form=getheaderprint',
			success: function(data)
			{
				$("#template").html(data)
			}
		})
		
		$.ajax ({
			type: 'POST',
			url: 'mainclass.php',
			data: 'Inquiry_ID=' + Inquiry_ID + '&form=printcontract',
			success: function(data) {
				var arr = data.split("|");

				$("#classification").text(arr[0]);
				$("#storename").text(arr[1]);
				$("#authorizedsignatory").text(arr[2]);
				$("#tenant_ID").text(arr[3]);
				$("#termsandcondition2").html(arr[4]);
				$("#address").text(arr[7]);
				$("#unitaddress").text(arr[5]);
				$("#natureofbusiness").text(arr[8]);
				$("#leaseperiod").text(arr[11]);
				$("#monthlyrent").text(arr[9]);
				$("#leaseunitfloor").text(arr[10]);
				$("#contactnumbers").text(arr[12]);
				
				var toPrint = document.getElementById("printcontract");
			    var popupWin = window.open('', '', 'height=500,width=900');				
			        popupWin.document.open();
			        popupWin.document.write('<html><title>Contract</title><style>*{font-family: \'Segoe UI\', Tahoma, sans-serif; font-size:10px !important;}#contracttbl tr{font-size: 12px !important; font-family: arial !important; } #contracttbl td{text-align: left !important;} #contracttbl thead{border: 1px solid gray !important; background-color: grey !important; color: black !important;} #tblcontract tr{border-bottom: 1px solid grey !important;} #tblcontract td{font-size: 10px !important;} </style><header style="font-size: 16px; font-weight: 700;"></header><br><body onload="window.print();">');
			        popupWin.document.write( toPrint.innerHTML);
			        popupWin.document.write('</body></html>');
			        popupWin.document.close();
			}
		})
	}

</script>