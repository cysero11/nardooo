<style>
@media print {
tr.vendorListHeading {
    background-color: #1a4567 !important;
    -webkit-print-color-adjust: exact; 
}}

@media print {
    .vendorListHeading th {
    color: white !important;
}}

@media print {
    * {
    font-family: 'Segoe UI', Tahoma, sans-serif
}}
</style>
<!-- ============ MODAL FOR BILLING by YNNA TARRAYO ============= -->
<script>
	$(function(){
		loadheader();
	})

	setTimeout(function(){
    $(".fixTable").tableHeadFixer();
    }, 500)
	
	function loadheader()
	{
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'form=loadheader',
			success: function(data)
			{
				$(".acc_header").text(data);
			}
		})
	}
	function isNumberKey(evt)
	{
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			if (charCode == 45 || charCode == 46) { return true; }
			else { return false; }
		}
		return true;
	}
	
	function openpaymentmodule()
	{
		var total = $("#windowtotal").text();
		if(total == "0.00")
		{	alert("Balance is already 0.");	}
		else
		{
			$("#paymentmodal").modal("show");
			$("#paymentmodal input:text").val("");
			$("#paymentmodal textarea").val("");
			
			$("#txtenteramoun").text("0.00");
			$("#txtenterselected").text("0.00");
			$("#txtenterchange").text("0.00");
			loadbalancelist();
		}

		$("#txtpaymenttype").val("Cash");
		$(".checkgroup").css("display", "none");
		$(".cardgroup").css("display", "none");
		$(".checkgroup input[type=text]").val("");
		$(".cardgroup input[type=text]").val("");
		$("#txtpaymentamount").css("display", "block");
		$("#txtpaymentamount").val("");
		$("#btncheckno").css("display", "block");
		// enable/disable texts
		$(".checkgroup").attr("disabled", "disabled");
		$(".cardgroup").attr("disabled", "disabled");
		$("#txtpaymentamount").removeAttr("disabled");
		$("#btncheckno").attr("disabled", "disabled");
		$(".banktrans").attr("disabled", "disabled");
		$(".banktrans").css("display", "none");
	}
	
	function opensoa()
	{
		var tenantid = $("#txtbillingtenantid").text();
		var month = $("#txtfiltermonth").val();
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'tenantid=' + tenantid + '&form=gettenantsoadetails',
			success: function(data) {
				var arr = data.split("|");
				$(".companyname").text(arr[2]);
				$(".companyaddress").text(arr[4]);
				$("#labelimg").attr("src", arr[3]);
				$("#txtprint_storename").text(arr[2])
				$("#txtprint_cutoff").text("")
				$("#txtprint_assignee").text("")
				$("#txtprint_address").text(arr[4])
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&form=getsoadetails',
					success: function(data) {
						$("#tblreportcontent").html(data);
					}
				});

				// balance
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&form=getsoabalance',
					success: function(data)
					{
						// alert(data)
						$("#tblprevblncs").html(data);
					}
				});

				// current
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&form=getsoacurrent',
					success: function(data)
					{
						// alert(data)
						$("#tblcurrchrges").html(data);
					}
				});

				// payments
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&form=getsoapayment',
					success: function(data)
					{
						// alert(data)
						$("#tblpymentcrdtadj").html(data);
					}
				});

				// breakdowns
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&form=getsoabreakdowns',
					success: function(data)
					{
						// alert(data)
						var arr = data.split("|");
						$("#ttlprevblncs").text(arr[0]);
						$("#ttlcurrchrges").text(arr[1]);
						$("#ttlpymentcrdtadj").text(arr[2]);
						$("#ttlprevblncs2").text(arr[0]);
						$("#ttlcurrchrges2").text(arr[1]);
						$("#ttlpymentcrdtadj2").text(arr[2]);
						printsoa();
					}
				})

				
			}
		})
	}
	
	function printsoa()
	{
		var toprint = $("#tblsoa2").html();
		var myheight = $(window).height()-40;
		var mywidth = $(window).width()-40;
		var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
		popupWin.document.open();
		popupWin.document.write("<html><head><title></title><style>*{font-family: 'Segoe UI', Tahoma, sans-serif; font-size:10px !important;}</style></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
		popupWin.document.close();
	}
</script>
<div class="modal fade" id="billingmodal" role="dialog">
	<div class="modal-dialog" style="width: 80%;">
		<div class="modal-content">
			<div class="modal-header btn-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="font-family: Roboto;font-size: 18px;">Transaction Billing</h4>
				<input type="hidden" class="text_inquiry" id="txtinq_inquiryid" name="">
			</div>
			
			<!-- Modal body-->
			<div class="modal-body" style="height: 440px;">

				<div class="form-group row">
					<div class="col-md-2 col-xs-12" style="padding-left: 25px;">
						<div id="imgledgerhere"><img class="img-responsive img-thumbnail" style="height: 110px; width: 110px;" onerror="imgerror($(this));" id="imglogo" src="server/company/COM-0000003/trades/TRADE-0000004/jollibee.jpg"></div>
					</div>
					<div class="col-md-7">	
						<div class="form-group row" style="margin-bottom: 5px;">
							<div class="col-xs-3" style="padding-left: 0px;">
									Store Name:
							</div>
							<div class="col-xs-9" style="padding-left: 0px;">
									<strong id="txtbillingtradename"></strong>
							</div>
						</div>
						<div class="form-group row" style="margin-bottom: 5px;">
							<div class="col-xs-3" style="padding-left: 0px;">
									Company Name:
							</div>
							<div class="col-xs-9" style="padding-left: 0px;">
									<strong id="txtbillingcompanyname"></strong>
							</div>
						</div>
						<div class="form-group row" style="margin-bottom: 5px;">
							<div class="col-xs-3" style="padding-left: 0px;">
									Mall Branch:
							</div>
							<div class="col-xs-9" style="padding-left: 0px;">
									<strong id="txtbillingmallbranch"></strong>
							</div>
						</div>
						<div class="form-group row" style="margin-bottom: 5px;">
							<div class="col-xs-3" style="padding-left: 0px;">
									Tenant ID:
							</div>
							<div class="col-xs-9" style="padding-left: 0px;">
									<strong id="txtbillingtenantid"></strong>
							</div>
						</div>
						<div class="form-group row" style="margin-bottom: 5px;">
							<div class="col-xs-3" style="padding-left: 0px;">
									Store Code:
							</div>
							<div class="col-xs-9" style="padding-left: 0px;">
									<strong id="txtbillingstorecode"></strong>
							</div>
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group row" style="margin-bottom: 5px;">
							<div class="col-xs-4" style="padding-left: 0px;text-align: right;">
									Billing Type:
							</div>
							<div class="col-xs-8" style="padding-left: 0px;">
								<abbr title="Billing Type"><strong id="txtbillingtype" class="text-primary"></strong></abbr>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-xs-12">
					<div class="panel panel-default">
						<div class="panel-heading" style="background-color: #dae9f1; color: #006666; padding: 5px 5px; height: 40px;margin-right:10px;">
							<div class="col-xs-6" style="padding-top: 2px;"><h3 class="panel-title" style="font-size: 14px; margin-left: -10px; margin-top: -2px;">
								<!--<select id="txtfiltermonth" onchange="showbilling();">
									<?php
										/*$current = date('F');
										$adddate = date('m');
										$adddate = $adddate + 1;
										for($i = 1 ; $i <= $adddate; $i++) {
											$month = date("F",mktime(0,0,0,$i,1,date("Y")));
											if( $current == $month )
												echo "<option value='" . $i . "' selected='selected'>" . $month . "</option>";
											else 
												echo "<option value='" . $i . "'>" . $month . "</option>";
										}*/
									?>
								</select>-->
							</h3></div>
							<div class="col-xs-6" style="text-align: right; padding-top: 2px;"><h3 class="panel-title" style="font-size: 14px; font-weight: bold; margin-top: 5px;" id="windowtotal">0.00</h3></div>
						</div>
						<div class="panel-body" style="height: 235px; overflow-y: scroll; padding: 0px;">
							<table class="table table-bordered table-responsive">
								<thead>
									<th>Date</th>
									<th>Charges</th>
									<th>Qty</th>
									<th style="text-align: right;">Amount ( before vat )</th>
									<th style="text-align: right;" class="acc_header"></th>
									<th style="text-align: right;">Total Amount</th>
									<th style="text-align: right;">Balance</th>
									<th>Reference</th>
								</thead>
								<tbody id="tbltranstenantdetails">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-lg-2 col-xs-12">
					<a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="opensoa()"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;SOA</a>
				</div>
				<div class="col-lg-2 col-xs-12">
					<a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="openpaymentmodule()"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;Payment</a>
				</div>
				<div class="col-lg-8 col-xs-12">
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function loadbalancelist()
	{
		var tenantid = $("#txtbillingtenantid").text();
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'tenantid=' + tenantid + '&form=loadbalancelist',
			success: function(data) 
			{
				$("#tblbalancelist").html(data);
				clickable();
				chkvalselected2()
				numonly();
			}
		});
	}
	
	function changepayment(type)
	{
		if(type == "Cash")
		{
			// $("input:checkbox").prop("checked", false);
			// $("input:checkbox").off('click');
			// $("input:checkbox").on('click', function() {
			//  	$(this).prop("checked", false)
			// }, function(){
			// 	$(this).prop("checked", true)
			// });
			$(".checkgroup").css("display", "none");
			$(".cardgroup").css("display", "none");
			$(".checkgroup input[type=text]").val("");
			$(".cardgroup input[type=text]").val("");
			$("#txtpaymentamount").css("display", "block");
			$("#txtpaymentamount").val("");
			$("#btncheckno").css("display", "block");
			// enable/disable texts
			$(".checkgroup").attr("disabled", "disabled");
			$(".cardgroup").attr("disabled", "disabled");
			$("#txtpaymentamount").removeAttr("disabled");
			$("#btncheckno").attr("disabled", "disabled");
			$(".banktrans").attr("disabled", "disabled");
			$(".banktrans").css("display", "none");
		}
		else if(type == "Credit Card")
		{
			// $("input:checkbox").prop("checked", false);
			// $("input:checkbox").off('click');
			// $("input:checkbox").on('click', function() {
			//  	$(this).prop("checked", false)
			// }, function(){
			// 	$(this).prop("checked", true)
			// });
			$(".checkgroup").css("display", "none");
			$(".cardgroup").css("display", "block");
			$(".cardgroup input[type=text]").val("");
			$("#txtpaymentamount").css("display", "block");
			$("#txtpaymentamount").val("");
			$("#btncheckno").css("display", "none");
			$("#row_ex_date").css("display", "block");
			// enable/disable texts
			$(".checkgroup").attr("disabled", "disabled");
			$(".cardgroup").removeAttr("disabled");
			$("#txtpaymentamount").removeAttr("disabled");
			$("#btncheckno").attr("disabled", "disabled");
			$(".banktrans").attr("disabled", "disabled");
			$(".banktrans").css("display", "none");
		}
		else if(type == "Debit Card")
		{
			// $("input:checkbox").prop("checked", false);
			// $("input:checkbox").off('click');
			// $("input:checkbox").on('click', function() {
			//  	$(this).prop("checked", false)
			// }, function(){
			// 	$(this).prop("checked", true)
			// });
			$(".checkgroup").css("display", "none");
			$(".debcardgroup").css("display", "block");
			$("#txtpaymentexpdate").css("display", "none");
			$("#row_ex_date").css("display", "none");			
			$(".cardgroup input[type=text]").val("");
			$("#txtpaymentamount").css("display", "block");
			$("#txtpaymentamount").val("");
			$("#btncheckno").css("display", "none");
			// enable/disable texts
			$(".checkgroup").attr("disabled", "disabled");
			$(".debcardgroup").removeAttr("disabled");
			$("#txtpaymentexpdate").attr("disabled", "disabled");
			$("#txtpaymentamount").removeAttr("disabled");
			$("#btncheckno").attr("disabled", "disabled");
			$(".banktrans").attr("disabled", "disabled");
			$(".banktrans").css("display", "none");
		}	
		else if(type == "Bank Transfer")
		{
			// $("input:checkbox").prop("checked", false);
			// $("input:checkbox").off('click');
			// $("input:checkbox").on('click', function() {
			//  	$(this).prop("checked", false)
			// }, function(){
			// 	$(this).prop("checked", true)
			// });
			$(".checkgroup").css("display", "none");
			$(".cardgroup").css("display", "none");
			$(".checkgroup input[type=text]").val("");
			$(".cardgroup input[type=text]").val("");
			$("#txtpaymentamount").css("display", "block");
			$("#txtpaymentamount").val("");
			$("#btncheckno").css("display", "block");
			// enable/disable texts
			$(".checkgroup").attr("disabled", "disabled");
			$(".cardgroup").attr("disabled", "disabled");
			$("#txtpaymentamount").removeAttr("disabled");
			$("#btncheckno").attr("disabled", "disabled");
			$(".banktrans").removeAttr("disabled");
			$(".banktrans").css("display", "block");
		}	
		else if(type == "Check")
		{
			// $("input:checkbox").prop("checked", false);
			// $("input:checkbox").off('click');
			// // the selector will match all input controls of type :checkbox
			// 	// and attach a click event handler 
			// 	$("input:checkbox").on('click', function() {
			// 	  // in the handler, 'this' refers to the box clicked on
			// 	  var $box = $(this);
			// 	  if ($box.is(":checked")) {
			// 	    // the name of the box is retrieved using the .attr() method
			// 	    // as it is assumed and expected to be immutable
			// 	    var group = "input:checkbox[name='" + $box.attr("name") + "']";
			// 	    // the checked state of the group/box on the other hand will change
			// 	    // and the current value is retrieved using .prop() method
			// 	    $(group).prop("checked", false);
			// 	    $box.prop("checked", true);
				    
			// 	    // var datedesc = $(this).closest('tr').find('.date_desc').text();
			// 	    // if(datedesc == "Monthly Rental")
			// 	    // {
			// 	    // 	getcheckinfo(dateadded);
			// 	    // }
			// 	  } else {
			// 	    $box.prop("checked", false);
			// 	  }
			// 	});

				var tenantid = $("#txtbillingtenantid").text();
				var tradename = $("#txtbillingtradename").text();
				$(".checkgroup").css("display", "block");
				$(".cardgroup").css("display", "none");
				$("#btncheckno").css("display", "block");
				$(".checkgroup input[type=text]").val("");
				// enable/disable texts
				$(".checkgroup").removeAttr("disabled");
				$(".cardgroup").attr("disabled", "disabled");
				$("#btncheckno").removeAttr("disabled");
				$(".banktrans").attr("disabled", "disabled");
				$(".banktrans").css("display", "none");
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&form=updatepdc',
					success: function(data) 
					{
						var arr = data.split("|");
						//$("#txtpaymentamount").val(arr[1]);
						//$("#txtpaymentcheckno").val(arr[2]);
						//$("#txtpaymentcheckdate").val(arr[3]);
						$("#txtpaymentcheckname").val(tradename);
						//$("#txtpaymentbankname").val(arr[4]);
						//$("#txtpaymentamount").attr("disabled", "disabled");
					}
				});

				getchknumberandothers(tenantid)

		}
		else
		{
			// $("input:checkbox").prop("checked", false);
			// $("input:checkbox").off('click');
			// $("input:checkbox").on('click', function() {
			//  	$(this).prop("checked", false)
			// }, function(){
			// 	$(this).prop("checked", true)
			// });
			var tenantid = $("#txtbillingtenantid").text();
			var tradename = $("#txtbillingtradename").text();
			$(".checkgroup").css("display", "block");
			$(".cardgroup").css("display", "none");
			$("#btncheckno").css("display", "block");
			$(".checkgroup input[type=text]").val("");
			// enable/disable texts
			$(".checkgroup").removeAttr("disabled");
			$(".cardgroup").attr("disabled", "disabled");
			$("#btncheckno").removeAttr("disabled");
			$(".banktrans").attr("disabled", "disabled");
			$(".banktrans").css("display", "none");
			$.ajax({
				type: 'POST',
				url: 'billing/billingmainclass.php',
				data: 'tenantid=' + tenantid + '&form=updatepdc',
				success: function(data) 
				{
					var arr = data.split("|");
					//$("#txtpaymentamount").val(arr[1]);
					//$("#txtpaymentcheckno").val(arr[2]);
					//$("#txtpaymentcheckdate").val(arr[3]);
					$("#txtpaymentcheckname").val(tradename);
					//$("#txtpaymentbankname").val(arr[4]);
					//$("#txtpaymentamount").attr("disabled", "disabled");
				}
			});
		}
	}

	function getchknumberandothers(tenantid)
	{
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'tenantid=' + tenantid + '&form=updatepdc',
			success: function(data) 
			{
				var arr = data.split("|");
				var cardnum = arr[5].split("-");
				$("#txtpaymentccno1").val(cardnum[0]);
				$("#txtpaymentccno2").val(cardnum[1]);
				$("#txtpaymentccno3").val(cardnum[2]);
				$("#txtpaymentccno4").val(cardnum[3]);
				$("#txtpaymentccholder").val(arr[6]);
			}
		});
	}
	
	function getcheckinfo(dateadded)
	{
		var transid = $("#txtbillingtenantid").text();
		// alert(transid+"|"+dateadded)
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'dateadded='+dateadded+'&transid='+transid+'&form=getcheckinfo',
			success: function(data)
			{
				alert(data);
			}
		})
	}

	function savepayment()
	{
		var itemid2 = "";
		var itemamount2 = 0;
		var itembalance2 = 0;
		$("#tblbalancelist tr").each(function(){
			if($(this).find("input:text").val() != "0.00" || $(this).find("input:text").val() != "")
			{
				itemid2 += "|" + $(this).attr("id");
				itemamount2 += parseFloat(($(this).find("input:text").val()).replace(/,/g,"") || 0);
				itembalance2 += parseFloat(($(this).find(".tdbalance").text()).replace(/,/g,"") || 0);
				// alert(itemamount + "|" + itembalance)
			}
		});
		
		if(itemamount2 != 0)
		{
			var balreamount = ($("#txtenterchange").text()).replace(/,/g,"");
			// alert("bal:"+balreamount)
			if(balreamount == "0.00" || balreamount == "0" || balreamount == "")
			{
				var paymenttype = $("#txtpaymenttype").val();
				var amount = ($("#txtpaymentamount").val()).replace(/,/g,"");
				// alert("amount:"+amount)
				var tenantid = $("#txtbillingtenantid").text();
				var paymenttype = $("#txtpaymenttype").val();
				var ccholder = $("#txtpaymentccholder").val();
				var ccno = $("#txtpaymentccno1").val() + "-" + $("#txtpaymentccno2").val() + "-" + $("#txtpaymentccno3").val() + "-" + $("#txtpaymentccno4").val();
				
				var expdate = $("#txtpaymentexpdate").val();
				var checkno = $("#txtpaymentcheckno").val();
				var checkdate = $("#txtpaymentcheckdate").val();
				var checkname = $("#txtpaymentcheckname").val();
				var bankname = $("#txtpaymentbankname").val();
				var orno = $("#txtpaymentorno").val();
				var remarks = $("#txtpaymentremarks").val();
				
				// bank transfer
				var namefrom = $("#txtbanknamefrom").val();
				var nameto = $("#txtbanknameto").val();
				var accfrom = $("#txtbankaccfrom").val();
				var accto = $("#txtbankaccto").val();

				var authno = $("#txtccauthno").val();
				var secno = $("#txtseccodeno").val();
				var cardtype = $("#txtcardtype").val();
				var itemid = "";
				var itemamount = "";
				var itembalance = "";
				$("#tblbalancelist tr").each(function(){
					if($(this).find("input:text").val() != "0.00" || $(this).find("input:text").val() != "")
					{
						itemid += "|" + $(this).attr("id");
						itemamount += "|" + ($(this).find("input:text").val()).replace(/,/g,"");
						itembalance += "|" + ($(this).find(".tdbalance").text()).replace(/,/g,"");
						// alert(itemamount + "|" + itembalance)
					}
				});
				
				if(amount === "")
				{
					alert("Please input amount.");
				}
				else if(amount === "0.00")
				{
					if(paymenttype == "Check")
					{
						$.ajax({
							type: 'POST',
							url: 'billing/billingmainclass.php',
							data: 'tenantid=' + tenantid + '&paymenttype=' + paymenttype + '&ccholder=' + ccholder + '&ccno=' + ccno + '&expdate=' + expdate + '&checkno=' + checkno + '&checkdate=' + checkdate + '&checkname=' + checkname + '&bankname=' + bankname + '&amount=' + amount + '&orno=' + orno + '&remarks=' + remarks + '&itemid=' + itemid + '&itemamount=' + itemamount + '&itembalance=' + itembalance + '&authno=' + authno + '&secno=' + secno + '&cardtype=' + cardtype + '&namefrom=' + namefrom + '&nameto=' + nameto + '&accfrom=' + accfrom + '&accto=' + accto + '&form=savepayment',
							success: function(data) 
							{
								alert("Payment has been made.");
								showbilling();
								$("#paymentmodal").modal("hide");
							}
						});
					}
				}
				else
				{
					if(itemid == "")
					{	alert("Please select item to be paid.");	}
					else
					{
						$.ajax({
							type: 'POST',
							url: 'billing/billingmainclass.php',
							data: 'tenantid=' + tenantid + '&paymenttype=' + paymenttype + '&ccholder=' + ccholder + '&ccno=' + ccno + '&expdate=' + expdate + '&checkno=' + checkno + '&checkdate=' + checkdate + '&checkname=' + checkname + '&bankname=' + bankname + '&amount=' + amount + '&orno=' + orno + '&remarks=' + remarks + '&itemid=' + itemid + '&itemamount=' + itemamount + '&itembalance=' + itembalance + '&authno=' + authno + '&secno=' + secno + '&cardtype=' + cardtype + '&namefrom=' + namefrom + '&nameto=' + nameto + '&accfrom=' + accfrom + '&accto=' + accto + '&form=savepayment',
							success: function(data) 
							{
								// alert(data)
								$("#smkdmks").text(data);
								alert("Payment has been made.");
								showbilling();
								$("#paymentmodal").modal("hide");
							}
						});
					}
				}			
			}
			else
			{
				alert("You still have " + balreamount.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " remaining amount.");
			}			
		}
		else
		{
			alert("Settle balance first to proceed.")
		}

	}
	
	function clickable()
	{
		$("#tblbalancelist tr").click(function(event){
			var obj = $(this);
			var amount2 = $("#txtpaymentamount").val();
			var amount = amount2.replace(/,/g,"");
			var total = 0;
			$("#tblbalancelist tr").each(function(){
				var obj = $(this);
				total += parseFloat((obj.find(".inputbal").val()).replace(/,/g,"")||0);
			});

			if(obj.find("input:checkbox").is(":checked") == true)
			{
				if(amount == "" || amount == "0.00" || amount == "0" || amount == 0)
				{
					obj.find("input:checkbox").removeAttr('checked');
					obj.find(".inputbal").attr("disabled", "disabled");
					alert("Please enter payment amount first.");
				}
				else
				{
					var remamount = $("#txtenterchange").text();
					if(remamount == "" || remamount == "0.00" || remamount == "0" || remamount == 0)
					{
						alert("zero ang balance ng payment");
						obj.find("input:checkbox").removeAttr('checked');
					}
					else
					{
						var bal2 = obj.find(".tdbalance").text();
						var bal = bal2.replace(/,/g,"");
						obj.find(".inputbal").removeAttr("disabled");
						obj.find(".inputbal").focus();
					}
					
					// obj.find(".inputbal").val(parseFloat(bal||0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
					// computebalance(bal.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))					
					
					if(total > amount)
					{	
						alert("Amount is bigger than the payment.");
						obj.find("input:checkbox").removeAttr("checked");
						obj.find(".inputbal").val("");
						obj.find(".inputbal").attr("disabled", "disabled");
					}
					else
					{
						obj.find(".inputbal").val(parseFloat(bal||0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
						computebalance(bal.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
					}

					var total2 = 0;
					$("#tblbalancelist tr").each(function(){
						var obj = $(this);
						total2 += parseFloat((obj.find(".inputbal").val()).replace(/,/g,"") || 0);
					});
					$("#txtenterselected").text((total2||0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
					var totalchange = amount - total2;
					// if(total != "" || total != "0.00" || total != "0" || total != 0)
					// {
						$("#txtenterchange").text((totalchange||0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
					// }
				}
			}
			else
			{
				obj.find(".inputbal").attr("disabled", "disabled");
				obj.find(".inputbal").val("");
			}
		});
		
	}

	function chkvalselected2()
	{
		$("#tblbalancelist tr .chk_inquiry_unittype").each(function(){
			$(this).change(function(){
				if($(this).is(":checked"))
				{
					// alert("sample");
				}
				else
				{
					computebalance("");
				}
			})
		})
		
	}
	
	function computebalance(val)
	{
		// alert(val)
		var amount2 = $("#txtpaymentamount").val();
		var amount = parseFloat(amount2.replace(/,/g,"") || 0);
		$("#tblbalancelist tr").each(function(){
			var obj = $(this);
			//total2 += parseFloat(obj.find(".inputbal").val());
			
			var total = 0;
			$("#tblbalancelist tr").each(function(){
				var obj = $(this);
				var thisval = (obj.find(".inputbal").val()).replace(/,/g,"");
				total += parseFloat(thisval || 0);
				// alert(total)
			});

			$("#txtenterselected").text((total || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
			if(total > amount)
			{
				alert("Amount is bigger than the payment.");
				obj.find(".inputbal").val("");
			}

			var totalchange = amount - total;
			$("#txtenterchange").text((totalchange || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
			
			var balance = parseFloat(obj.find(".hiddenamount").val() || 0);
			var input = parseFloat(obj.find(".inputbal").val() || 0);
			if(isNaN(obj.find(".inputbal").val() || 0)) 
			{	input = "";	}
		
			if(input > balance)
			{	obj.find(".inputbal").val("");	}
			else
			{
				var totalbal = balance - parseFloat((obj.find(".inputbal").val()).replace(/,/g,"") || 0);
				obj.find(".tdbalance").text((totalbal || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
			}
		});
	}
	
	function enteramount(val)
	{
		$("#txtenteramount").text(parseFloat(val || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
	}
	
	// for elements that only accepts numbers
 	function numonly()
    {
       $(".numonly").keydown(function(event) {

           // Allow only backspace and delete
           if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190 || event.keyCode == 9 || event.keyCode == 188) {
               // let it happen, don't do anything
           }
           else {
               // Ensure that it is a number and stop the keypress
               if (event.keyCode < 48 || event.keyCode > 57 || event.keyCode == 17) {
                   event.preventDefault(); 
               }   
           }
       });

       $(".amount").change(function(){
       		var x = ($(this).val()).replace(/,/g,"");
            var v = parseFloat(x||0);
            $(this).val(v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
       });
     }

	$.mask.definitions['~']='[+-]';
    $(".input-mask-date").mask("99-9999",{placeholder:" "});
</script>

<!-- ============ MODAL FOR PAYMENTS by YNNA TARRAYO ============= -->
<div class="modal fade" id="paymentmodal" role="dialog">
	<div class="modal-dialog" style="width: 98%;">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #438EB9 !important;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="color:white; font-weight: bold;">Transaction Posting</h4>
				<input type="hidden" class="text_inquiry" id="txtinq_inquiryid" name="">
			</div>
			
			<!-- Modal body-->
			<div class="modal-body" style="height: 500px;padding:10px;overflow: none;">
				<div class="col-lg-4 col-xs-12" style="padding-left: 0px;padding-right: 10px;">
					<div class="widget-box widget-color-orange" id="widget-box-5">
						<div class="widget-header">
							<i class=" ace-icon fa fa-calculator bigger-120"></i>&nbsp;
							<h5 class="widget-title smaller">Payment</h5>

							<!-- <div class="widget-toolbar">
								<span class="label label-success">
									16%
									<i class="ace-icon fa fa-arrow-up"></i>
								</span>
							</div> -->
						</div>

						<div class="widget-body">
							<div class="widget-main padding-6">	
								<div class="well" style="display: block; height:337px;overflow-y: auto;margin-bottom: 0px;">			
									<div class="row">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Payment Type</h4>
										</div>
										<div class="col-sm-8">
											<select id="txtpaymenttype" class="form-control text_inquiry required_inq" style="font-size: 12px; margin-bottom: 5px;" onchange="changepayment(this.value);">
												<?php
													include('../connect.php');
													$sql = "SELECT paymenttype FROM tblrefpaymenttype";
													$result = mysql_query($sql, $connection);
													while($row = mysql_fetch_array($result))
													{
														echo "
															<option value='" . $row[0] . "'>" . $row[0] . "</option>
														";
													}
												?>
												
											</select>
										</div>
									</div>
									<div class="row banktrans">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Bank Name</h4>
										</div>
										<div class="col-sm-8">
											<select id="txtbanknamefrom" class="form-control banktrans" style="font-size: 12px; margin-bottom: 5px;">
												<?php
													$sql2 = "SELECT description FROM tblrefbank";
													$result2 = mysql_query($sql2, $connection);
													while($row2 = mysql_fetch_array($result2))
													{
														echo "
															<option value='" . $row2[0] . "'>" . $row2[0] . "</option>
														";
													}
												?>
											</select>
										</div>
									</div>
									<div class="row banktrans">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Acc No.</h4>
										</div>
										<div class="col-sm-8">
											<input type="text" class="form-control banktrans" name="" id="txtbankaccfrom" style="margin-bottom: 5px;">
										</div>
									</div>
									<div class="row banktrans">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Bank Name</h4>
										</div>
										<div class="col-sm-8">
											<select id="txtbanknameto" class="form-control banktrans" style="font-size: 12px; margin-bottom: 5px;">
												<?php
													$sql2 = "SELECT description FROM tblrefbank";
													$result2 = mysql_query($sql2, $connection);
													while($row2 = mysql_fetch_array($result2))
													{
														echo "
															<option value='" . $row2[0] . "'>" . $row2[0] . "</option>
														";
													}
												?>
											</select>
										</div>
									</div>
									<div class="row banktrans">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Acc No.</h4>
										</div>
										<div class="col-sm-8">
											<input type="text" class="form-control banktrans" name="" id="txtbankaccto" style="margin-bottom: 5px;">
										</div>
									</div>
									<div class="row cardgroup debcardgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Card Type</h4>
										</div>
										<div class="col-sm-8">
											<select id="txtcardtype" class="form-control cardgroup debcardgroup" style="font-size: 12px; margin-bottom: 5px;">
												<?php
													$sql2 = "SELECT CardType FROM tblref_cardtype";
													$result2 = mysql_query($sql2, $connection);
													while($row2 = mysql_fetch_array($result2))
													{
														echo "
															<option value='" . $row2[0] . "'>" . $row2[0] . "</option>
														";
													}
												?>
											</select>
										</div>
									</div>
									<div class="row cardgroup debcardgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Card Holder</h4>
										</div>
										<div class="col-sm-8">
											<input id="txtpaymentccholder" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px;" disabled>
										</div>
									</div>
									<div class="row cardgroup debcardgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">CC No.</h4>
										</div>
										<div class="col-sm-2" style="padding-left: 12px; padding-right: 1px;">
											<input id="txtpaymentccno1" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" disabled onkeypress="return isNumberKey(event)">
										</div>
										<div class="col-sm-2" style="padding-left: 6px; padding-right: 5px;">
											<input id="txtpaymentccno2" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" disabled onkeypress="return isNumberKey(event)">
										</div>
										<div class="col-sm-2" style="padding-left: 5px; padding-right: 6px;">
											<input id="txtpaymentccno3" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" disabled onkeypress="return isNumberKey(event)">
										</div>
										<div class="col-sm-2" style="padding-left: 0px; padding-right: 12px;">
											<input id="txtpaymentccno4" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" disabled onkeypress="return isNumberKey(event)">
										</div>
									</div>
									<!-- newly added for authorization number -->
									<div class="row cardgroup debcardgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Authorization No.</h4>
										</div>
										<div class="col-sm-3" style="padding-left: 12px; padding-right: 1px;">
											<input id="txtccauthno" disabled class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" maxlength="6">
										</div>
									</div>
									<!-- end -->
									<!-- newly added for authorization number -->
									<div class="row cardgroup debcardgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;margin-top: 0px;">Security Code</h4>
											<h4 style="text-align: right; font-size: 9px;margin-bottom: 5px;">CVV/CVC</h4>
										</div>
										<div class="col-sm-2" style="padding-left: 12px; padding-right: 1px;">
											<input id="txtseccodeno" disabled class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" maxlength="3">
										</div>
									</div>
									<!-- end -->					
									<div class="row cardgroup" id="row_ex_date">
										<div class="col-sm-4">
											<h4 style="text-align: right; font-size: 12px;">Exp. Date</h4>
										</div>
										<div class="col-sm-5">
											<input id="txtpaymentexpdate" disabled class="form-control input-mask-date cardgroup" style="margin-bottom: 5px;" placeholder="mm-yyyy">
										</div>
									</div>
									<div class="row checkgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Check No.</h4>
										</div>
										<div class="col-sm-6" style="padding-bottom: 6px;">
											<div class="input-group" id="" style="width: 100%;">
												<input type="text" id="txtpaymentcheckno" class="form-control checkgroup" style="" disabled>
												<div class="spinbox-buttons input-group-btn" style="padding: 0px;">
													<button class='btn btn-xs btn-gray' onclick="openchecklist();" style="height:32px !important;" disabled id="btncheckno"><i class='ace-icon fa fa-search bigger-120'></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="row checkgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Check Date</h4>
										</div>
										<div class="col-sm-5">
											<input id="txtpaymentcheckdate" class="form-control checkgroup" style="margin-bottom: 5px;" disabled data-provide="datepicker">
										</div>
									</div>
									<div class="row checkgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Check Name</h4>
										</div>
										<div class="col-sm-8">
											<input id="txtpaymentcheckname" class="form-control checkgroup" style="margin-bottom: 5px;" disabled>
										</div>
									</div>
									<div class="row checkgroup">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Bank Name</h4>
										</div>
										<div class="col-sm-8">
											<input id="txtpaymentbankname" class="form-control checkgroup" style="margin-bottom: 5px;" disabled>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;"><span style="color: red">*</span>Amount</h4>
										</div>
										<div class="col-sm-8">
											<input id="txtpaymentamount" class="form-control amount" style="margin-bottom: 5px; text-align: right;" placeholder="0.00" onkeypress="return isNumberKey(event)" onkeyup="enteramount(this.value);">
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">O.R. No.</h4>
										</div>
										<div class="col-sm-8">
											<input id="txtpaymentorno" class="form-control" style="margin-bottom: 5px;">
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4 required">
											<h4 style="text-align: right; font-size: 12px;">Remarks.</h4>
										</div>
										<div class="col-sm-8">
											<textarea style="width: 100%; height: 100px;" id="txtpaymentremarks"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>					
				</div>
				<div class="col-lg-8 col-xs-12" style="padding-right: 0px;padding-left: 0px;">
					<div class="widget-box ui-sortable-handle" id="widget-box-5">
						<div class="widget-header">
							<i class="ace-icon fa fa-list bigger-120"></i>&nbsp;
							<h5 class="widget-title smaller">Bill</h5>

							<!-- <div class="widget-toolbar">
								<span class="label label-success">
									16%
									<i class="ace-icon fa fa-arrow-up"></i>
								</span>
							</div> -->
						</div>

						<div class="widget-body" style="display: block; height:350px;">
							<div class="widget-main" style="padding:0px;">
								<table class="table table-bordered table-responsive">
									<thead>
										<th style="border-left: 0px !important;"></th>
										<th>Date</th>
										<th>Charges</th>
										<th>Amount (before vat)</th>
										<th class="acc_header"></th>
										<th>Total Amount</th>
										<th>Balance</th>
										<th style="border-right: 0px !important;">Payment</th>
									</thead>
									<tbody id="tblbalancelist">
									</tbody>
								</table>
							</div>
						</div>
					</div>					
					
				</div>
				<div class="form-group row" style="margin-bottom: 0px;">
					<div class="col-lg-4 col-xs-12" style="padding-right: 5px;">
					</div>
					<div class="col-lg-8 col-xs-12">
						<div class="hr hr8 hr-double hr-dotted"></div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-4 col-xs-12" style="padding-right: 5px;">
						<a href="#" id="btn_inquiry" class="btn btn-yellow btn-sm" style="float: right;" onclick="savepayment()"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;Post Payment</a>
					</div>
					<div class="col-lg-8 col-xs-12">
						<div class="row">
							<div class="col-lg-5 col-xs-12" style="text-align: left;">
							</div>
							<div class="col-lg-4 col-xs-12" style="text-align: left; font-weight: bold;text-align: right;">
								<p style="margin-bottom: 0px;">Payment</p>
								<p style="margin-bottom: 0px;">Payment Applied</p>
								<p style="margin-bottom: 0px;">Remaining Amount</p>
							</div>
							<div class="col-lg-3 col-xs-12" style="font-weight: bold;">
								<p id="txtenteramount" style="text-align: right;margin-bottom: 0px;">0.00</p>
								<p id="txtenterselected" style="text-align: right;margin-bottom: 0px;">0.00</p>
								<p id="txtenterchange" style="text-align: right;margin-bottom: 0px;">0.00</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="billingmodallistoftenatsrents" role="dialog">
	<div class="modal-dialog" style="width: 80%;">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #438EB9 !important;">
				<button type="button" class="close" onclick="closelisttenst();">&times;</button>
				<h4 class="modal-title" style="color:white; font-weight: bold;">Tenants</h4>
				<input type="hidden" class="text_inquiry" id="" name="">
			</div>
			
			<!-- Modal body-->
			<div class="modal-body">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<div class="parent">
						<input type="hidden" id="txtxdatepass">
						<table class="table table-bordered table-striped fixTable">
							<thead>
								<th>Date</th>
								<th>Tenant ID</th>
								<th>Store Name</th>
								<th style="text-align: right;">Amount ( before vat )</th>
								<th style="text-align: right;" class="acc_header"></th>
								<th style="text-align: right;">Total Amount</th>
								<th>Billing Type</th>
							</thead>
							<tbody id="tbltenantlistrent">
							</tbody>
						</table>
					</div>
				</div>
			</div>
			</div>
					<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="btn_saveinquiry" onclick="savettenantslist()"><i class="ace-icon fa fa-check"></i>&nbsp;Save</button>		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="reportcontainer" style="margin-top: 10px; display: none;">
	<center>
	<div class="checklist" id="tblsoa" style="margin-top: 20px; width: 99%;margin-bottom: 0;">
		<center>
			<table cellspacing="0" style="padding: 5px; width: 95%">
				<tr><td colspan="2" align="center"><div style="width: 100%; text-align: left;">
					<!-- <table style="width: 100%;" cellspacing="0" cellpadding="0">
						<tbody id="template"></tbody>
					</table> -->
				</div></td></tr>
				<tr><td colspan="2"><center><p style="font-size: 18px; font-weight: bold; margin-top: 25px; margin-bottom: 15px;">Statement of Account</p></center></td></tr>
				<tr><td colspan="2" align="right"><p style="font-size: 13px; font-weight: normal;font-style: italic;">Date: <?php echo date("F j, Y"); ?></p><br/></td></tr>
				<tr>
					<td colspan="2">
						<center>
							<table cellspacing="0" class="tblprint4" id="tblreportcontent" style="width:100%;">
								
							</table>
						</center>
					</td>
				</tr>
			</table>
		</center>
	</div>
	</center>
</div>
<div id="reportcontainer2" style="margin-top: 10px; display: none;">
	<center>
		<div class="checklist" id="tblsoa2" style="margin-top: 20px; width: 99%;margin-bottom: 0;">
			<center>
			<!-- header starts here -->
				<table style="width: 100%;" cellspacing="0" cellpadding="0">
					<tbody id="template"></tbody>
				</table>
			<!-- header ends here ... -->

			<!-- billing information starts here -->
				<table style="width: 100%;margin-top: 20px;" cellpadding="0" cellspacing="0">
					<tr>
						<td width="15%"><h6 style="font-weight: normal;margin: 3px;font-size: 11px;">BILL TO</h6></td>
						<td width="2%">:</td>
						<td width="51%"><h6 style="font-weight: normal;margin: 3px;font-size: 11px;font-weight: bold;" id="txtprint_storename"></h6></td>
						<td width="15%"><h6 style="font-weight: normal;margin: 3px;font-size: 11px;">CUT-OFF DATE</h6></td>
						<td width="2%">:</td>
						<td width="15%"><h6 style="font-weight: normal;margin: 3px;font-size: 11px;font-weight: bold;" id="txtprint_cutoff"></h6></td>
					</tr>
					<tr>
						<td><h6 style="font-weight: normal;margin: 3px;font-size: 11px;">ASSIGNEE</h6></td>
						<td>:</td>
						<td><h6 style="font-weight: normal;margin: 3px;font-size: 11px;font-weight: bold;" id="txtprint_assignee"></h6></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><h6 style="font-weight: normal;margin: 3px;font-size: 11px;">ADDRESS</h6></td>
						<td>:</td>
						<td><h6 style="font-weight: normal;margin: 3px;font-size: 11px;font-weight: bold;" id="txtprint_address"></h6></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
			<!-- billing info ends here ... -->

				<table style="width: 100%;margin-top: 15px;" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="4" align="center" style="background-color: #111109 !important;-webkit-print-color-adjust: exact;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">STATEMENT OF ACCOUNT</h6></td>
					</tr>
					<tr>
						<td colspan="4"><br/></td>
					</tr>
					<tr style="border-left:1px solid #111109;border-right:1px solid #111109;">
						<td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 5px;" align="left">
							<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">DATE</h6>
						</td>
						<td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;" align="left">
							<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">REFERENCE</h6>
						</td>
						<td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;" align="left">
							<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">TRANSACTION DETAILS</h6>
						</td>
						<td style="background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-right: 5px;" align="right">
							<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">AMOUNT</h6>
						</td>
					</tr>

					<!-- previous balance starts here -->
					<!-- <tr style="border-left:1px solid #111109;border-right:1px solid #111109;">
						<td colspan="4" style="padding-left: 5px;">
							<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;">PREVIOUS BALANCE</h6>
						</td>
					</tr> -->
					<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;border-bottom:1px solid #111109;" id="tblprevblncs">						
					</tbody>
					<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;">
						<tr>
							<td colspan="2"></td>
							<td>
								<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">TOTAL PREVIOUS BALANCES</h6>
							</td>
							<td style="font-weight: normal;margin: 3px;font-size: 11px;" align="right">
								<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;" id="ttlprevblncs"></h6>
							</td>
						</tr>
						<tr>
							<td colspan="4" align="center">
								<table style="border-bottom:2px solid #111109;width: 99%;margin-bottom: 5px;">
									<tr>
										<td style="padding-bottom: 2px;"></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
					<!-- previous balance ends here -->


					<!-- current charges starts here ... -->
					<tr style="border-left:1px solid #111109;border-right:1px solid #111109;">
						<td colspan="4" style="padding-left: 5px;">
							<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;">CURRENT CHARGES AND CONSUMABLE CREDITS</h6>
						</td>
					</tr>
					<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;border-bottom:1px solid #111109;" id="tblcurrchrges">
					</tbody>
					<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;">
						<tr>
							<td colspan="2"></td>
							<td>
								<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">TOTAL CURRENT CHARGES AND CONSUMABLE CREDITS</h6>
							</td>
							<td style="font-weight: normal;margin: 3px;font-size: 11px;" align="right">
								<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;" id="ttlcurrchrges"></h6>
							</td>
						</tr>
						<tr>
							<td colspan="4" align="center">
								<table style="border-bottom:2px solid #111109;width: 99%;margin-bottom: 5px;">
									<tr>
										<td style="padding-bottom: 2px;"></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
					<!-- current charges ends here ... -->


					<!-- payment and adjustments starts here ... -->
					<tr style="border-left:1px solid #111109;border-right:1px solid #111109;">
						<td colspan="4" style="padding-left: 5px;">
							<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;">PAYMENTS AND CREDIT ADJUSTMENT</h6>
						</td>
					</tr>
					<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;border-bottom:1px solid #111109;" id="tblpymentcrdtadj">						
					</tbody>
					<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;border-bottom:1px solid #111109;">
						<tr>
							<td colspan="2"></td>
							<td>
								<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">TOTAL PAYMENTS</h6>
							</td>
							<td style="font-weight: normal;margin: 3px;font-size: 11px;" align="right">
								<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;" id="ttlpymentcrdtadj"></h6>
							</td>
						</tr>
						<tr>
							<td colspan="4" align="center">
								<table style="border-bottom:2px solid #111109;width: 99%;margin-bottom: 5px;">
									<tr>
										<td style="padding-bottom: 2px;"></td>
									</tr>
								</table>
							</td>
						</tr>
						<!-- payment and adjustments ends here ... -->

						<!-- breakdown starts here ... -->
						<tr>
							<td colspan="4">
								<table style="width:100%;">
									<tr>
										<td>
											<table style="width:100%;">
												<tr>
													<td align="left" style="padding-left: 5px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															Net Sales
														</h6>
													</td>
													<td align="right" style="padding-right: 20px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															0.00
														</h6>
													</td>
												</tr>
												<tr>
													<td align="left" style="padding-left: 5px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															Penalty Charges
														</h6>
													</td>
													<td align="right" style="padding-right: 20px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															 0.00
														</h6>
													</td>
												</tr>
												<tr>
													<td align="left" style="padding-left: 5px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															Add 12% EVAT
														</h6>
													</td>
													<td align="right" style="padding-right: 20px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															 0.00
														</h6>
													</td>
												</tr>
												<tr>
													<td align="left" style="padding-left: 5px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															Total VAT Charges
														</h6>
													</td>
													<td align="right" style="padding-right: 20px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															0.00
														</h6>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table style="width:100%;">
												<tr>
													<td colspan="2"><br/></td>
												</tr>
												<tr>
													<td align="left" style="padding-left: 20px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															TOTAL PREVIOUS BALANCES
														</h6>
													</td>
													<td align="right" style="">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;" id="ttlprevblncs2">
															
														</h6>
													</td>
												</tr>
												<tr>
													<td align="left" style="padding-left: 20px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															ADD: TOTAL CURRENT CHARGES
														</h6>
													</td>
													<td align="right" style="">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;" id="ttlcurrchrges2">
															
														</h6>
													</td>
												</tr>
												<tr>
													<td align="left" style="padding-left: 20px;">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
															LESS: TOTAL PAYMENTS
														</h6>
													</td>
													<td align="right" style="">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;" id="ttlpymentcrdtadj2">
															
														</h6>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<table style="width:100%;" cellpadding="0" cellspacing="0">
												<tr>
													<td style="padding-left: 5px;background-color: #111109 !important;-webkit-print-color-adjust: exact;width:16.5%;" align="left">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #ffffff !important;">
															Total Current Charges
														</h6>
													</td>
													<td style="padding-right: 20px;background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-right: 20px;" align="right">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #ffffff !important;">
															 6,000.00
														</h6>
													</td>
													<td style="padding-right: 5px;background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 20px;" align="left">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #ffffff !important;">
															AMOUNT DUE
														</h6>
													</td>
													<td style="padding-left: 20px;background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-right: 5px;" align="right">
														<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #ffffff !important;">
															 6,000.00
														</h6>
													</td>
												</tr>
											</table>
										</td>										
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
					<!-- payment and adjustments ends here ... -->
					<tbody>
						<tr>
							<td style="padding-top: 20px;" colspan="4">
								<table style="width:100%;">
									<tr>
										<td width="25%">
											<h6 style="font-weight: normal;margin: 3px;font-size: 10px;color: #111109;">Prepared by:</h6><br /><br />
										</td>
										<td width="25%">
											<h6 style="font-weight: normal;margin: 3px;font-size: 10px;color: #111109;">Checked by:</h6><br /><br />
										</td>
										<td width="25%">
											<h6 style="font-weight: normal;margin: 3px;font-size: 10px;color: #111109;">Approved by:</h6><br /><br />
										</td>
										<td width="25%">
											<h6 style="font-weight: normal;margin: 3px;font-size: 10px;color: #111109;">Received by / Date Received:</h6><br /><br />
										</td>
									</tr>
									<tr>
										<td width="25%">
											<hr style="border-color: #111109;width: 90%;margin:0px;">
										</td>
										<td width="25%">
											<hr style="border-color: #111109;width: 90%;margin:0px;">
										</td>
										<td width="25%">
											<hr style="border-color: #111109;width: 90%;margin:0px;">
										</td>
										<td width="25%">
											<hr style="border-color: #111109;width: 90%;margin:0px;">
										</td>
									</tr>
									<tr>
										<td width="25%">
											<h6 style="font-weight: normal;margin: 0px;font-size: 10px;color: #111109;">Billing, Credit and Collection</h6>
										</td>
										<td width="25%">
											<h6 style="font-weight: normal;margin: 0px;font-size: 10px;color: #111109;">Authorized Signatory</h6>
										</td>
										<td width="25%">
											<h6 style="font-weight: normal;margin: 0px;font-size: 10px;color: #111109;">Authorized Signatory</h6>
										</td>
										<td width="25%">
											<h6 style="font-weight: normal;margin: 0px;font-size: 10px;color: #111109;">Signature over Printed Name</h6>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</center>
		</div>
	</center>
</div>


<script>
	function loadtenanttype(val)
	{
		$.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'val=' + val + '&form=tbltenanttypelists',
            success: function(data){
                $("#tbltenantsetup").html(data);
            }
        });
	}
	
	var check = 0;
	function selectalltenant()
	{
		if(check == 0)
		{ $("#tbltenantsetup input:checkbox").prop("checked", true); check = 1; }
		else
		{ $("#tbltenantsetup input:checkbox").prop("checked", false);  check = 0; }
	}
	
	function updatetenanttype()
	{
		var tenantid = "";
		$("#tbltenantsetup tr").each(function(){
			var obj = $(this);
			if(obj.find("input:checkbox").is(":checked") == true)
			{
				tenantid += "|" + $(this).attr("id");
			}
		});
		var type = $("#txttenanttype").val();
		var percent = $("#txttenanttypepercent").val();
		$.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'tenantid=' + tenantid + '&type=' + type + '&percent=' + percent + '&form=updatetenanttype',
            success: function(data){
				alert("Tenant type has been modified.");
                loadtenanttype("");
            }
        });
	}

	function selectcheck(pdcdate, bank, checkno, amount)
	{
		$("#txtpaymentamount").val(parseFloat(amount || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		$("#txtenterchange").text(parseFloat(amount || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		$("#txtpaymentcheckno").val(checkno);
		$("#txtpaymentcheckdate").val(pdcdate);
		$("#txtpaymentbankname").val(bank);
		$("#billingchecklistmodal").modal("hide");
		$("#txtenteramount").text(parseFloat(amount || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		numonly();
	}
</script>
<div class="modal fade" id="tenanttypesetupmodal" role="dialog">
	<div class="modal-dialog" style="width: 70%;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 10px 5px 5px 10px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Setup - Tenant Type</h4>
				<input type="hidden" class="text_inquiry" id="" name="">
			</div>
			
			<!-- Modal body-->
			<div class="modal-body" style="height: 440px;">
				<div class="col-lg-12 col-xs-12">
                    <div class="row">
						<div class="col-sm-2">
							<h4 style="text-align: left; font-size: 12px;">Store Name</h4>
						</div>
						<div class="col-sm-4">
							<input id="txtpaymentccholder" class="form-control cardgroup" style="margin-bottom: 5px;" onkeyup="loadtenanttype(this.value)">
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-xs-12">
					<div class="panel panel-default">
						<div class="panel-body" style="height: 280px; overflow-y: scroll; padding: 0px;">
							<table class="table table-bordered table-responsive">
								<thead>
									<th><label><input type='checkbox' onclick="selectalltenant();"></label></th>
									<th>Tenant ID</th>
									<th>Store Name</th>
									<th>Company</th>
									<th>Tenant Type</th>
									<th>Rev %</th>
								</thead>
								<tbody id="tbltenantsetup">
								
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-lg-4 col-xs-12">
				</div>
				<div class="col-lg-4 col-xs-12">
					<div class="row">
						<div class="col-sm-4 required">
							<h4 style="text-align: right; font-size: 12px;">Tenant Type</h4>
						</div>
						<div class="col-sm-8">
							<select id="txttenanttype" class="form-control text_inquiry required_inq" style="font-size: 12px; margin-bottom: 5px;">
								<option value="Rent">Rent</option>
								<option value="Rent | Rev">Rent + Rev</option>
								<option value="Rent or Share">Rent or Share</option>
								<option value="Share Olny">Share Only</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-xs-12">
					<div class="row">
						<div class="col-sm-2 required">
							<h4 style="text-align: right; font-size: 12px;">%</h4>
						</div>
						<div class="col-sm-10">
							<input id="txttenanttypepercent" class="form-control cardgroup" style="margin-bottom: 5px;">
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-xs-12">
					<div class="row">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary" style="padding: 0px 7px; border-radius: 3px; width: 100%;" onclick="updatetenanttype();">Apply</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	function openchecklist()
	{
		$("#billingchecklistmodal").modal("show");
		getchecklist();
	}
	
	function getchecklist()
	{
		var tenantid = $("#txtbillingtenantid").text();
		$.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'tenantid=' + tenantid + '&form=getchecklist',
            success: function(data){
				$("#tblchecklist").html(data);
            }
        });
	}
	
	
</script>
<div class="modal fade" id="billingchecklistmodal" role="dialog">
	<div class="modal-dialog" style="width: 85%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Check List</h4>
				<input type="hidden" class="text_inquiry" id="" name="">
			</div>
			
			<!-- Modal body-->
			<div class="modal-body" style="height: 465px;">
				<div class="col-lg-12 col-xs-12">
					<div class="panel panel-default">
						<div class="panel-body" style="height: 430px; overflow-y: scroll; padding: 0px;">
							<input type="hidden" id="txtxdatepass">
							<table class="table table-bordered table-responsive table-hover">
								<thead>
									<th>Check #</th>
									<th>Bank</th>
									<th>Depository Status</th>
									<th>Check Status</th>
									<th>PDC Date</th>
									<th>Amount</th>
								</thead>
								<tbody id="tblchecklist">
								
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-lg-8 col-xs-12"></div>
				<div class="col-lg-4 col-xs-12">
					<div class="row">
						<div class="col-sm-6">
							<!--<button type="submit" class="btn btn-primary" style="padding: 0px 7px; border-radius: 3px; width: 100%;" onclick="savettenantslist();">Save</button>-->
						</div>
						<div class="col-sm-6">
							<a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="$('#billingchecklistmodal').modal('show');"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;Cancel</a>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_select_period" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">   
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" onclick="closemodalref()">×</button>
          <h4 class="modal-title" id="txtref_name">Select Period</h4>
            
            <div class="row form-group">
                <div class="col-xs-12 col-md-12">
                    <table table="" id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-top: 10px !important;">
                        <tbody id="tblperiodlist_choices" style="flex: 1 1 auto;display: block;height: 20em;overflow-x: hidden;">
						</tbody>
                    </table>
                    <hr>
                </div>
            </div>
        </div>
      </div>
      
    </div>
  </div>

  <script>
  	function closemodalref()
  	{
  		$("#modal_select_period").modal("hide");
  	}
  </script>