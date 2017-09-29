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

@media screen {div.divFooter {display: none;}}

.paddleft
{
	padding-left: 10px;
}
.paddright
{
	padding-right: 5px;
}
</style>
<!-- ============ MODAL FOR BILLING by YNNA TARRAYO ============= -->
<script>
	$(function(){
		loadheader();
		$("#tblbalancelist").niceScroll({cursorcolor:"#999"});

		$("#txtpaymentccno12").keyup(function(){
		    var len = ($(this).val()).length;
		    if(len == 4)
		    {
		      $("#txtpaymentccno22").focus();
		    }
		})
		$("#txtpaymentccno22").keyup(function(){
		    var len = ($(this).val()).length;
		    if(len == 4)
		    {
		      $("#txtpaymentccno32").focus();
		    }
		})

		$("#txtpaymentccno32").keyup(function(){
		    var len = ($(this).val()).length;
		    if(len == 4)
		    {
		      $("#txtpaymentccno42").focus();
		    }
		})

		$("#txtpaymentccno1").keyup(function(){
		    var len = ($(this).val()).length;
		    if(len == 4)
		    {
		      $("#txtpaymentccno2").focus();
		    }
		})

		$("#txtpaymentccno2").keyup(function(){
		    var len = ($(this).val()).length;
		    if(len == 4)
		    {
		      $("#txtpaymentccno3").focus();
		    }
		})

		$("#txtpaymentccno3").keyup(function(){
		    var len = ($(this).val()).length;
		    if(len == 4)
		    {
		      $("#txtpaymentccno4").focus();
		    }
		})
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
	
	function openpaymentmodule(){
		showtxtinfostorename();
		$("#txtpaymenttype").val("Cash");
		$("#paymentmodal").modal("show");
		$("#paymentmodal input:text").val("");
		$("#paymentmodal textarea").val("");
		$("#txtenteramount").text("0.00");
		$("#txtenterselected").text("0.00");
		$("#txtenterchange").text("0.00");
		// for payment toooooo
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
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'tenantid=' + tenantid + '&form=gettenantsoadetails',
			success: function(data) {
				var arr = data.split("|");
				$(".companyname").text(arr[2]);
				$(".companyaddress").text(arr[4]);
				$("#labelimg").attr("src", arr[3]);
				$("#txtprint_storename").text(arr[2]);
				$("#txtprint_cutoff").text(arr[5]);
				$("#txtprint_assignee").text("");
				$("#txtprint_address").text(arr[4]);
				$("#print_footer").html(arr[6]);
				$("#txtprint_billingperiod").text(arr[7]);
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&form=getsoadetails',
					success: function(data) {
						$("#tblreportcontent").html(data);
					}
				});

				// balance
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&form=getsoabalance',
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
					data: 'tenantid=' + tenantid + '&form=getsoacurrent',
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
					data: 'tenantid=' + tenantid + '&form=getsoapayment',
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
					data: 'tenantid=' + tenantid + '&form=getsoabreakdowns',
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
						$("#ttlamtdue").text(arr[3]);
						$("#ttlamtvat").text(arr[4]);
						// printsoa();
						$("#modal_opensoa").modal("show");
					}
				})
				// SIGNATORIES
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&form=soasignatories',
					success:function(data){
						var arr = data.split("#");
						$("#lblprepby").text(arr[0]);
						$("#lblchkby").text(arr[1]);
						$("#lblapprby").text(arr[2]);
						$("#lblrcvdby").text(arr[3]);
					}
				})
			}
		})
		mallprinttemplate(tenantid);
	}

	function opensoa_separate(tenantid, year, month)
	{
	$("#modal_opensoa").modal("show");
		var tenantid = tenantid;
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'tenantid=' + tenantid + '&month=' + month + '&year=' + year + '&form=gettenantsoadetails2',
			success: function(data) {
				var arr = data.split("|");
				$(".companyname").text(arr[2]);
				$(".companyaddress").text(arr[4]);
				$("#labelimg").attr("src", arr[3]);
				$("#txtprint_storename").text(arr[2]);
				$("#txtprint_cutoff").text(arr[5]);
				$("#txtprint_assignee").text("");
				$("#txtprint_address").text(arr[4]);
				$("#print_footer").html(arr[6])
				$("#txtprint_billingperiod").text(arr[7]);
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&year=' + year + '&form=getsoadetails',
					success: function(data) {
						$("#tblreportcontent").html(data);
					}
				});

				// current charges
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&year=' + year + '&form=getsoacurrent2',
					success: function(data)
					{
						// alert(data)
						$("#tblcurrchrges").html(data);
					}
				});

				// other charges
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&year=' + year + '&form=getothercharges2',
					success:function(data){
						$("#tblotherchrges").html(data);
					}
				})

				// payments
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&year=' + year + '&form=getsoapayment2',
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
					data: 'tenantid=' + tenantid + '&month=' + month + '&year=' + year + '&form=getsoabreakdowns2',
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
						$("#ttlamtdue").text(arr[3]);
						$("#ttlamtvat").text(arr[4]);
						$("#ttlnetsals").text(arr[6]);
						$("#ttlpnltychrgs").text(arr[5]);
						// printsoa();
					}
				})

				// Aging
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&month=' + month + '&year=' + year + '&form=getsoaaging2',
					success:function(data){
						var arr = data.split("|");
						$("#txtsoab00").text(arr[0]);
						$("#txtsoab13").text(arr[1]);
						$("#txtsoab36").text(arr[2]);
						$("#txtsoab69").text(arr[3]);
						$("#txtsoab99").text(arr[4]);
					}
				})
							// SIGNATORIES
				$.ajax({
					type: 'POST',
					url: 'billing/billingmainclass.php',
					data: 'tenantid=' + tenantid + '&form=soasignatories',
					success:function(data){
						var arr = data.split("#");
						$("#lblprepby").text(arr[0]);
						$("#lblchkby").text(arr[1]);
						$("#lblapprby").text(arr[2]);
						$("#lblrcvdby").text(arr[3]);
					}
				})
			}
		})
		mallprinttemplate(tenantid);
	}
	
	function printsoa()
	{
		var toprint = $("#tblsoa2").html();
		var popupWin = window.open("", "_blank", "height=600,width=600","location=no,scrollbars=1,left=" + 20);
		popupWin.document.open();
		popupWin.document.write("<html><head><title></title><style>*{font-family: 'Segoe UI', Tahoma, sans-serif; font-size:10px !important;}@media screen {div.divFooter {display: none;}}@media print { div.divFooter {position: fixed;bottom: 0;}}</style></head><body><div class='checklist'>" + toprint + "</div></body></html>");
		popupWin.print();
		popupWin.close();
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
						<div id="imgledgerhere"><img class="img-responsive img-thumbnail" style="height: 110px; width: 110px;" id="imglogo" src=""></div>
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
									<th>Soa ID</th>
									<th>Period</th>
									<th style="text-align: right;">Amount ( before vat )</th>
									<th style="text-align: right;" class="acc_header"></th>
									<th style="text-align: right;">Total Amount</th>
									<th style="text-align: right;">Balance</th>
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
					<a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;display: none;" onclick="opensoa()"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;SOA</a>
				</div>
				<!-- <div class="col-lg-2 col-xs-12">
					<a href="#" id="btn_inquiry" class="btn btn-info btn-sm" style="width: 100% !important;" onclick="openpaymentmodule()"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;Payment</a>
				</div> -->
				<div class="col-lg-8 col-xs-12">
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function loadbalancelist(tenantid){
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'tenantid=' + tenantid + '&form=loadbalancelist',
			success: function(data) {
				$("#tblbalancelist").html(data);
				$("#tblbalancelist").niceScroll({cursorcolor:"#999"});
				clickable();
				chkvalselected2()
				numonly();
				if(tenantid == ""){
					$("#btn_savingdorp").attr("onclick", "confirmsavedeposit()");
				}else{
					$("#btn_savingdorp").attr("onclick", "confirmsavepayment()");
				}
			}
		});
	}
	
	function changepayment(type)
	{
		if(type == "Cash")
		{
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
			var tenantid = $("#txtinfostorename").val();
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
					$("#txtpaymentcheckname").val(arr[7]);
					//$("#txtpaymentbankname").val(arr[4]);
					//$("#txtpaymentamount").attr("disabled", "disabled");
				}
			});
			getchknumberandothers(tenantid)
		}
		else
		{
			var tenantid = $("#txtinfostorename").val();
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
					$("#txtpaymentcheckname").val(arr[7]);
					//$("#txtpaymentbankname").val(arr[4]);
					//$("#txtpaymentamount").attr("disabled", "disabled");
				}
			});
		}
			$(".depositamount").prop('checked',false);
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

	function confirmsavedeposit(){
		showmodal("confirm", "Are you sure you want to deposit this amount?", "savedeposit", null, "", null, "1");
	}

	function savedeposit(){
		var paymenttype = $("#txtpaymenttype").val();
		if(paymenttype == "Cash")
		{
			var ccholder = "";
			var ccno = "";
			var expdate = "";
			var checkno = "";
			var checkdate = "";
			var checkname = "";
			var bankname = "";
			var namefrom = "";
			var nameto = "";
			var accfrom = "";
			var accto = "";
			var authno = "";
			var secno = "";
			var cardtype = "";
		}
		else if(paymenttype == "Check")
		{
			var ccholder = "";
			var ccno = "";
			var expdate = "";
			var checkno = $("#txtpaymentcheckno").val();
			var checkdate = $("#txtpaymentcheckdate").val();
			var checkname = $("#txtpaymentcheckname").val();
			var bankname = $("#txtpaymentbankname").val();
			var namefrom = "";
			var nameto = "";
			var accfrom = "";
			var accto = "";
			var authno = "";
			var secno = "";
			var cardtype = "";							
		}
		else if(paymenttype == "Credit Card")
		{
			var ccholder = $("#txtpaymentccholder").val();
			var ccno = $("#txtpaymentccno1").val() + "-" + $("#txtpaymentccno2").val() + "-" + $("#txtpaymentccno3").val() + "-" + $("#txtpaymentccno4").val();
			var expdate = $("#txtpaymentexpdate").val();
			var checkno = "";
			var checkdate = "";
			var checkname = "";
			var bankname = "";
			var namefrom = "";
			var nameto = "";
			var accfrom = "";
			var accto = "";
			var authno = $("#txtccauthno").val();
			var secno = $("#txtseccodeno").val();
			var cardtype = $("#txtcardtype").val();							
		}
		else if(paymenttype == "Debit Card")	
		{
			var ccholder = $("#txtpaymentccholder").val();
			var ccno = $("#txtpaymentccno1").val() + "-" + $("#txtpaymentccno2").val() + "-" + $("#txtpaymentccno3").val() + "-" + $("#txtpaymentccno4").val();
			var expdate = "";
			var checkno = "";
			var checkdate = "";
			var checkname = "";
			var bankname = "";
			var namefrom = "";
			var nameto = "";
			var accfrom = "";
			var accto = "";
			var authno = $("#txtccauthno").val();
			var secno = $("#txtseccodeno").val();
			var cardtype = $("#txtcardtype").val();	
		}
		else if(paymenttype == "Bank Transfer")		
		{
			var ccholder = "";
			var ccno = "";
			var expdate = "";
			var checkno = "";
			var checkdate = "";
			var checkname = "";
			var bankname = "";
			var namefrom = $("#txtbanknamefrom").val();
			var nameto = $("#txtbanknameto").val();
			var accfrom = $("#txtbankaccfrom").val();
			var accto = $("#txtbankaccto").val();
			var authno = "";
			var secno = "";
			var cardtype = "";	
		}

		var amount = ($("#txtpaymentamount").val()).replace(/,/g,"");
		var tenantid = $("#txtbillingtenantid").text();
		var orno = $("#txtpaymentorno").val();
		var remarks = $("#txtpaymentremarks").val();

		if(paymenttype == "Cash" && amount != ""){
			$.ajax({
				type: 'POST',
				url: 'billing/billingmainclass.php',
				data: 'tenantid=' + tenantid + '&paymenttype=' + paymenttype + '&ccholder=' + ccholder + '&ccno=' + ccno + '&expdate=' + expdate + '&checkno=' + checkno + '&checkdate=' + checkdate + '&checkname=' + checkname + '&bankname=' + bankname + '&amount=' + amount + '&orno=' + orno + '&remarks=' + remarks + '&authno=' + authno + '&secno=' + secno + '&cardtype=' + cardtype + '&namefrom=' + namefrom + '&nameto=' + nameto + '&accfrom=' + accfrom + '&accto=' + accto + '&form=savedeposit',
				beforeSend : function() {
			      $('#paymentmodalloadingscreen').addClass('myspinner');
			    },
			    success: function(data){
			      $('#paymentmodalloadingscreen').removeClass('myspinner');
					setTimeout(function(){
						showmodal("alert", "Deposit success.", "closepaymentmodal", null, "", null, "0");
					}, 1000)
				}
			})
		}else if(paymenttype == "Check" || paymenttype == "Credit Card" || paymenttype == "Debit Card" || paymenttype == "Bank Transfer"){
			$.ajax({
				type: 'POST',
				url: 'billing/billingmainclass.php',
				data: 'tenantid=' + tenantid + '&paymenttype=' + paymenttype + '&ccholder=' + ccholder + '&ccno=' + ccno + '&expdate=' + expdate + '&checkno=' + checkno + '&checkdate=' + checkdate + '&checkname=' + checkname + '&bankname=' + bankname + '&amount=' + amount + '&orno=' + orno + '&remarks=' + remarks + '&authno=' + authno + '&secno=' + secno + '&cardtype=' + cardtype + '&namefrom=' + namefrom + '&nameto=' + nameto + '&accfrom=' + accfrom + '&accto=' + accto + '&form=savedeposit',
				beforeSend : function() {
			      $('#paymentmodalloadingscreen').addClass('myspinner');
			    },
			    success: function(data){
			      $('#paymentmodalloadingscreen').removeClass('myspinner');
					setTimeout(function(){
						showmodal("alert", "Deposit success.", "closepaymentmodal", null, "", null, "0");
					}, 1000)
				}
			})
		}
		else{
			setTimeout(function(){
				showmodal("alert", "Please input amount", "closepaymentmodal", null, "", null, "1");
			}, 1000)
		}
	}

	function closepaymentmodal(){
		$("#paymentmodal").modal("hide");
		$("#tblbalancelist").html("");
		tbltenantlists();
	}

	function puttexttoamount(amount, paymenttype){
		$("#txtpaymentamount").val(amount);
		$("#txtpaymenttype").val(paymenttype);
	}

	function confirmsavepayment(){
		var balreamount = ($("#txtenterchange").text()).replace(/,/g,"");
		var tenantid = $("#txtinfostorename").val();
			if(balreamount == "0.00" || balreamount == "0" || balreamount == ""){
				showmodal("confirm", "Are you sure you want to post this transaction?", "savepayment", null, "", null, "1");
			}else if(tenantid != ""){
				showmodal("confirm", "Are you sure you want to post this transaction?", "savepayment", null, "", null, "1");
			}else{
				showmodal("confirm", "You still have " + balreamount.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " remaining amount do you still want to proceed?", "savepayment", null, "", null, "0");
			}
	}

	function savepayment()
	{
		var itemid2 = "";
		var itemamount2 = 0;
		var itembalance2 = 0;
		var balreamount = ($("#txtenterchange").text()).replace(/,/g,"");
		var paymenttype = $("#txtpaymenttype").val();
		var tenantid = $("#txtinfostorename").val();
		var amount = ($("#txtpaymentamount").val()).replace(/,/g,"");
		var orno = $("#txtpaymentorno").val();
		var remarks = $("#txtpaymentremarks").val();
		var itemid = "";
		var itemamount = "";
		var itembalance = "";
		if(paymenttype == "Cash")
		{
			var ccholder = "";
			var ccno = "";
			var expdate = "";
			var checkno = "";
			var checkdate = "";
			var checkname = "";
			var bankname = "";
			var namefrom = "";
			var nameto = "";
			var accfrom = "";
			var accto = "";
			var authno = "";
			var secno = "";
			var cardtype = "";
		}
		else if(paymenttype == "Check")
		{
			var ccholder = "";
			var ccno = "";
			var expdate = "";
			var checkno = $("#txtpaymentcheckno").val();
			var checkdate = $("#txtpaymentcheckdate").val();
			var checkname = $("#txtpaymentcheckname").val();
			var bankname = $("#txtpaymentbankname").val();
			var namefrom = "";
			var nameto = "";
			var accfrom = "";
			var accto = "";
			var authno = "";
			var secno = "";
			var cardtype = "";							
		}
		else if(paymenttype == "Credit Card")
		{
			var ccholder = $("#txtpaymentccholder").val();
			var ccno = $("#txtpaymentccno1").val() + "-" + $("#txtpaymentccno2").val() + "-" + $("#txtpaymentccno3").val() + "-" + $("#txtpaymentccno4").val();
			var expdate = $("#txtpaymentexpdate").val();
			var checkno = "";
			var checkdate = "";
			var checkname = "";
			var bankname = "";
			var namefrom = "";
			var nameto = "";
			var accfrom = "";
			var accto = "";
			var authno = $("#txtccauthno").val();
			var secno = $("#txtseccodeno").val();
			var cardtype = $("#txtcardtype").val();							
		}
		else if(paymenttype == "Debit Card")	
		{
			var ccholder = $("#txtpaymentccholder").val();
			var ccno = $("#txtpaymentccno1").val() + "-" + $("#txtpaymentccno2").val() + "-" + $("#txtpaymentccno3").val() + "-" + $("#txtpaymentccno4").val();
			var expdate = "";
			var checkno = "";
			var checkdate = "";
			var checkname = "";
			var bankname = "";
			var namefrom = "";
			var nameto = "";
			var accfrom = "";
			var accto = "";
			var authno = $("#txtccauthno").val();
			var secno = $("#txtseccodeno").val();
			var cardtype = $("#txtcardtype").val();	
		}
		else if(paymenttype == "Bank Transfer")		
		{
			var ccholder = "";
			var ccno = "";
			var expdate = "";
			var checkno = "";
			var checkdate = "";
			var checkname = "";
			var bankname = "";
			var namefrom = $("#txtbanknamefrom").val();
			var nameto = $("#txtbanknameto").val();
			var accfrom = $("#txtbankaccfrom").val();
			var accto = $("#txtbankaccto").val();
			var authno = "";
			var secno = "";
			var cardtype = "";	
		}
		$("#tblbalancelist tr").each(function(){
			if($(this).find("input:text").val() != "0.00" || $(this).find("input:text").val() != "")
			{
				itemid += "|" + $(this).attr("id");
				itemamount += "|" + ($(this).find("input:text").val()).replace(/,/g,"");
				itembalance += "|" + ($(this).find(".tdbalance").text()).replace(/,/g,"");
			}
		});
		$("#tblbalancelist tr").each(function(){
			if($(this).find("input:text").val() != "0.00" || $(this).find("input:text").val() != "")
			{
				itemid2 += "|" + $(this).attr("id");
				itemamount2 += parseFloat(($(this).find("input:text").val()).replace(/,/g,"") || 0);
				itembalance2 += parseFloat(($(this).find(".tdbalance").text()).replace(/,/g,"") || 0);
			}
		});
		if(itemamount2 != 0)
		{
			if(amount === ""){
				showmodal("alert", "Please input amount.", "", null, "", null, "1");
			}
			else if(amount === "0.00")
			{
				if(paymenttype == "Check")
				{
					$.ajax({
						type: 'POST',
						url: 'billing/billingmainclass.php',
						data: 'tenantid=' + tenantid + '&paymenttype=' + paymenttype + '&ccholder=' + ccholder + '&ccno=' + ccno + '&expdate=' + expdate + '&checkno=' + checkno + '&checkdate=' + checkdate + '&checkname=' + checkname + '&bankname=' + bankname + '&amount=' + amount + '&orno=' + orno + '&remarks=' + remarks + '&itemid=' + itemid + '&itemamount=' + itemamount + '&itemamount2=' + itemamount2 + '&itembalance=' + itembalance + '&authno=' + authno + '&secno=' + secno + '&cardtype=' + cardtype + '&namefrom=' + namefrom + '&nameto=' + nameto + '&accfrom=' + accfrom + '&accto=' + accto + '&balreamount=' + balreamount + '&form=savepayment',
						beforeSend : function() {
					      $('#paymentmodalloadingscreen').addClass('myspinner');
					    },
					    success: function(data){
					      $('#paymentmodalloadingscreen').removeClass('myspinner');
							setTimeout(function(){
								showmodal("alert", "Payment has been made.", "closepaymentmodal", null, "", null, "0");
							}, 1000)
						}
					});
				}
			}
			else
			{
				if(itemid == ""){ 
					showmodal("alert", "Please select item to be paid.", "closepaymentmodal", null, "", null, "1");
				}
				else
				{
					$.ajax({
						type: 'POST',
						url: 'billing/billingmainclass.php',
						data: 'tenantid=' + tenantid + '&paymenttype=' + paymenttype + '&ccholder=' + ccholder + '&ccno=' + ccno + '&expdate=' + expdate + '&checkno=' + checkno + '&checkdate=' + checkdate + '&checkname=' + checkname + '&bankname=' + bankname + '&amount=' + amount + '&orno=' + orno + '&remarks=' + remarks + '&itemid=' + itemid + '&itemamount=' + itemamount + '&itemamount2=' + itemamount2 + '&itembalance=' + itembalance + '&authno=' + authno + '&secno=' + secno + '&cardtype=' + cardtype + '&namefrom=' + namefrom + '&nameto=' + nameto + '&accfrom=' + accfrom + '&accto=' + accto + '&balreamount=' + balreamount + '&form=savepayment',
						beforeSend : function() {
					      $('#paymentmodalloadingscreen').addClass('myspinner');
					    },
					    success: function(data){
					      $('#paymentmodalloadingscreen').removeClass('myspinner');
							setTimeout(function(){
								showmodal("alert", "Payment has been made.", "closepaymentmodal", null, "", null, "0");
							}, 1000)
						}
					});
				}
			}			
		}
		else
		{
			$.ajax({
				type: 'POST',
				url: 'billing/billingmainclass.php',
				data: 'tenantid=' + tenantid + '&paymenttype=' + paymenttype + '&ccholder=' + ccholder + '&ccno=' + ccno + '&expdate=' + expdate + '&checkno=' + checkno + '&checkdate=' + checkdate + '&checkname=' + checkname + '&bankname=' + bankname + '&amount=' + amount + '&orno=' + orno + '&remarks=' + remarks + '&itemid=' + itemid + '&itemamount=' + itemamount + '&itemamount2=' + itemamount2 + '&itembalance=' + itembalance + '&authno=' + authno + '&secno=' + secno + '&cardtype=' + cardtype + '&namefrom=' + namefrom + '&nameto=' + nameto + '&accfrom=' + accfrom + '&accto=' + accto + '&balreamount=' + balreamount + '&form=savepayment',
				beforeSend : function() {
			      $('#paymentmodalloadingscreen').addClass('myspinner');
			    },
			    success: function(data){
			      $('#paymentmodalloadingscreen').removeClass('myspinner');
					setTimeout(function(){
						showmodal("alert", "Deposit success.", "closepaymentmodal", null, "", null, "0");
					}, 1000)
				}
			});
		}			
	}

	function savebalreamount(balreamount){
		$.ajax({
			type: 'POST',
			url: 'billing/billingmainclass.php',
			data: 'balreamount=' + balreamount + '&form=savebalreamount',
			success:function(data){
				alert(data);
			}
		})
	}
	
	function clickable()
	{
		$("#tblbalancelist tr").each(function(){
			$(this).click(function(){
				eto = $(this).find(".chk_inquiry_unittype");
				var amount_val = $("#txtpaymentamount").val();
				var amount = parseFloat(amount_val.replace(/,/g,"")||0);

				var remaining_val = $("#txtenterchange").text();
				var remaining = parseFloat(remaining_val.replace(/,/g,"")||0);

				var obj = $(this);
				var balance = parseFloat(obj.find(".hiddenamount").val()||0);
				var enteredamount = parseFloat((obj.find(".inputbal").val()).replace(/,/g,"")||0);

				var remainingamt = parseFloat(($("#txtenterchange").text()).replace(/,/g,"")||0);

				var total = 0;
				$("#tblbalancelist tr").each(function(){
					var objct = $(this);
					total += parseFloat((objct.find(".inputbal").val()).replace(/,/g,"")||0);
				});
				var batayan = eto.val();
				if(obj.find("input:checkbox").is(":checked") == false ) {
					eto.prop("checked", true);
					if(batayan == "1"){
						if(amount == 0) // if walang payment
						{
							eto.prop("checked", false);
							obj.find("input:checkbox").removeAttr('checked');
							showmodal("alert", "Enter payment amount first.", "", null, "", null, "1");
							obj.find(".inputbal").attr("disabled", "disabled");
						}
						else //if may payment
						{
							if(remainingamt > 0)
							{
								if(remainingamt >= balance) //if mas malaki or equal yung remaining amt ng payment sa balance ng charge
								{
									obj.find(".inputbal").val(balance.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
									obj.find(".inputbal").removeAttr("disabled");
									obj.find(".inputbal").focus();
									obj.find(".tdbalance").text("0.00");
									breakdown(balance);
									$(this).css("color","#FFF");
									$(this).css("background-color","#666");
								}
								else
								{
									// manual input
									obj.find(".inputbal").val("");
									obj.find(".inputbal").removeAttr("disabled");
									obj.find(".inputbal").focus();
									$(this).css("color","#FFF");
									$(this).css("background-color","#666");
								}						
							}
							else
							{
								obj.find("input:checkbox").removeAttr('checked');
								showmodal("alert", "Insufficient amount.", "", null, "", null, "1");
								obj.find(".inputbal").attr("disabled", "disabled");
							}
						}
					}
					else{
						showmodal("alert", "Please settle the oldest charges first.", "", null, "", null, "1");
					}
				}

				else {
					eto.prop("checked", false);
					$(this).css("color","");
					$(this).css("background-color","");
					obj.find(".tdbalance").text((balance || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
					breakdown("0.00")
					obj.find(".inputbal").val("");
					obj.find(".inputbal").attr("disabled", "disabled");	
				}
				
			})
		})
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
					breakdown("0.00");
				}
			})
		})
		
	}
	
	function computebalance(entered)
	{
		var remainingamt = parseFloat(($("#txtenterchange").text()).replace(/,/g,"")||0);
		var laman = parseFloat(($("."+entered).val()).replace(/,/g,"")||0);
		var inputval = parseFloat(($("#"+entered).val()).replace(/,/g,"")||0);
		var enteredval = $("#"+entered).val();
		if(remainingamt >= enteredval)
		{
			if(inputval > laman)
			{
				alert("You exceeded amount of balance.");
				$("#"+entered).val("");
				$("#"+entered).focus();
				breakdown(enteredval);
			}
			else
			{
				breakdown(enteredval);
			}			
		}
		else
		{
			alert("Your remaining amount is not enough.");
			$("#"+entered).val("");
			$("#"+entered).focus();
		}

		$("#tblbalancelist tr").each(function(){
			var obj = $(this);
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

	function breakdown(entered)
	{
		var amount_val = $("#txtpaymentamount").val();
		var amount = parseFloat(amount_val.replace(/,/g,"")||0);
		var total = 0;
		$("#tblbalancelist tr").each(function(){
			var objct = $(this);
			total += parseFloat((objct.find(".inputbal").val()).replace(/,/g,"")||0);
		});

		var remaining = amount - total;
		$("#txtenterchange").text(remaining.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); //change
		$("#txtenterselected").text(total.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); //applied		
	}
	
	function enteramount(val)
	{
		$("#txtenteramount").text(parseFloat(val || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		$("#txtenterchange").text(parseFloat(val || 0).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
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

     function closemodalref()
  	{
  		$("#modal_select_period").modal("hide");
  	}

  	function focusto(id)
  	{
  		$("#alertmodal").modal("hide");
  		$("#"+id).focus();
  	}

  	function clsemod()
  	{
  		alert("smdjsd")
  		$(".modal").modal("hide")
  	}

	$.mask.definitions['~']='[+-]';
    $(".input-mask-date").mask("99-9999",{placeholder:" "});
</script>

<!-- ============ MODAL FOR PAYMENTS by YNNA TARRAYO ============= -->
<div class="modal fade" id="paymentmodal" role="dialog">
	<div class="modal-dialog" style="width: 98%;">
		<div class="modal-content">
    	<div id="paymentmodalloadingscreen"></div>
			<div class="modal-header" style="background-color: #438EB9 !important;">
				<button type="button" class="close" data-dismiss="modal" onclick="closepaymentmodal();">&times;</button>
				<h4 class="modal-title" style="color:white; font-weight: bold;">Transaction Posting</h4>
				<input type="hidden" class="text_inquiry" id="txtinq_inquiryid" name="">
			</div>
			
			<!-- Modal body-->
			<div class="modal-body" style="padding:10px;overflow: none;">
				<div class="col-lg-4 col-xs-12" style="padding-left: 0px;padding-right: 10px;">
					<div class="widget-box widget-color-orange" id="widget-box-5">
						<div class="widget-header">
							<i class=" ace-icon fa fa-calculator bigger-120"></i>&nbsp;
							<h5 class="widget-title smaller">Payment</h5>
						</div>

						<div class="widget-body">
							<div class="widget-main padding-6">	
								<div class="well" style="display: block;height:287px;overflow-y: auto;margin-bottom: 0px;overflow-x: hidden;">
									<div class="row">
										<div class="row">
											<div class="col-sm-4">
												<h4 style="text-align: right; font-size: 12px;">Store Name</h4>
											</div>
											<div class="col-sm-8">
												<select class="form-control text_inquiry required_inq" style="font-size: 12px; margin-bottom: 5px;" id="txtinfostorename" onchange="loadbalancelist(this.value);"></select>
											</div>
										</div>
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
											<input id="txtpaymentccno1" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" disabled onkeypress="return isNumberKey(event)" maxlength="4">
										</div>
										<div class="col-sm-2" style="padding-left: 6px; padding-right: 5px;">
											<input id="txtpaymentccno2" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" disabled onkeypress="return isNumberKey(event)" maxlength="4">
										</div>
										<div class="col-sm-2" style="padding-left: 5px; padding-right: 6px;">
											<input id="txtpaymentccno3" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" disabled onkeypress="return isNumberKey(event)" maxlength="4">
										</div>
										<div class="col-sm-2" style="padding-left: 0px; padding-right: 12px;">
											<input id="txtpaymentccno4" class="form-control cardgroup debcardgroup" style="margin-bottom: 5px; padding: 3px;" disabled onkeypress="return isNumberKey(event)" maxlength="4">
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
						<div class="widget-toolbox padding-8 clearfix">
							<a href="#" id="btn_savingdorp" class="btn btn-yellow btn-sm pull-right" style="float: right;" onclick="confirmsavedeposit()"><i class="ace-icon fa fa-thumb-tack"></i>&nbsp;Post Payment</a>
						</div>
					</div>					
				</div>
				<div class="col-lg-8 col-xs-12" style="padding-right: 0px;padding-left: 0px;">
					<div class="widget-box ui-sortable-handle widget-color-orange" id="widget-box-5">
						<div class="widget-body" style="display: block;height: 389px;">
							<div class="widget-main" style="padding:0px;">
								<div class="parent5">
									<table class="table table-bordered table-hover fixTable">
										<thead>
										<tr>
											<th style="border-left: 0px !important;background-color: #FFC657;color: #855D10;display: none;"></th>
											<th style="background-color: #FFC657;color: #855D10;">Date</th>
											<th style="background-color: #FFC657;color: #855D10;">Charges</th>
											<th style="background-color: #FFC657;color: #855D10;">Amount (before vat)</th>
											<th style="background-color: #FFC657;color: #855D10;" class="acc_header"></th>
											<th style="background-color: #FFC657;color: #855D10;">Total Amount</th>
											<th style="background-color: #FFC657;color: #855D10;">Balance</th>
											<th style="border-right: 0px !important;background-color: #FFC657;color: #855D10;">Payment</th>
										</tr>
										</thead>
										<tbody id="tblbalancelist"></tbody>
									</table>
								</div>
							</div>
						</div>
					</div>					
				</div>
				<div class="form-group row" style="margin-bottom: 0px;">
					
					<div class="col-lg-12 col-xs-12">
						<div class="hr hr8 hr-double hr-dotted"></div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<div class="col-lg-4 col-xs-12" style="padding-right: 5px;">
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

<script>
	function closemodalsoa()
	{
		$(".companyname").text("");
		$(".companyaddress").text("");
		$("#labelimg").attr("src", "");
		$("#txtprint_storename").text("")
		$("#txtprint_cutoff").text("")
		$("#txtprint_assignee").text("")
		$("#txtprint_address").text("")
		$("#tblreportcontent").html("");
		$("#tblprevblncs").html("");
		$("#tblcurrchrges").html("");
		$("#tblpymentcrdtadj").html("");
		$("#ttlprevblncs").text("");
		$("#ttlcurrchrges").text("");
		$("#ttlpymentcrdtadj").text("");
		$("#ttlprevblncs2").text("");
		$("#ttlcurrchrges2").text("");
		$("#ttlpymentcrdtadj2").text("");
		$("#ttlamtdue").text("");
		$("#ttlamtvat").text("");
		$("#modal_opensoa").modal("hide");
		$("#txtprint_billingperiod").text("");
	}

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
		var tenantid = $("#txtinfostorename").val();
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

<!-- SOA BUTTON -->
<div class="modal fade" id="modal_statementofaccount" role="dialog">
	<div class="modal-dialog" style="width: 85%;">
		<div class="modal-content">
    	<div id="soaloadingscreen"></div>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="closemodal_statementofaccount()">&times;</button>
				<h4 class="modal-title">Statement of Account</h4>
				<input type="hidden" class="text_inquiry">
			</div>
			<div class="modal-body">
				<div class="row form-group"> 
					<div class="row form-group">
	                    <div class="col-md-4">
	                     	<div class="col-md-12">
                  				<fieldset style="margin: 8px;border: 1px solid #CCC;padding: 8px;margin-top: 0px;">
	                     			<legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:168px;">&nbsp;&nbsp;By Individual Account&nbsp;&nbsp;</legend>
	                     			<div class="row form-group">
	                     				<div class="col-md-12">
					                     	<select class="form-control" id="txtTenantID" onchange="loadpreviousperiods()">
					                     		<?php 
					                     			echo "<option value=''>-- Select Tenant --</option>";
					                     			$res = mysql_query("SELECT TenantID, tradename FROM tbltrans_tenants", $connection);
					                     			while($row = mysql_fetch_array($res)){
					                     				echo "<option value=". $row[0] .">".$row[1]."</option>";
					                     			}
					                     		?>
					                     	</select>			
	                     				</div>
	                     			</div>
	                     		</fieldset>
	                     	</div>
	                     	<div class="col-md-12">
                  				<fieldset style="margin: 8px;border: 1px solid #CCC;padding: 8px;margin-top: 0px;">
	                     			<legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:60px;">&nbsp;&nbsp;Period&nbsp;&nbsp;</legend>
	                     			<!-- <div class="row form-group">
	                     				<div class="col-md-3">
					                    	SOA No. 	
	                     				</div>
	                     				<div class="col-md-5">
	                     					<input type="text" class="form-control" id="txtSOANo">
	                     				</div>
	                     			</div> -->
	                     			<div class="row form-group">
	                     				<div class="col-md-3">
	                     					Period From
	                     				</div>
	                     				<div class="col-md-5">
	                     					<div class="input-group">
												<input class="form-control date-picker txtgensoa" id="txtPeriodFrom" type="text" data-date-format="dd-mm-yyyy">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
	                     				</div>
	                     			</div>
	                     			<div class="row form-group">
	                     				<div class="col-md-3">
	                     					Period To
	                     				</div>
	                     				<div class="col-md-5">
	                     					<div class="input-group">
												<input class="form-control date-picker txtgensoa" id="txtPeriodTo" type="text" data-date-format="dd-mm-yyyy">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
	                     				</div>
	                     				<div class="col-md-4">
	                     					<!-- <button class="btn btn-primary btn-sm btn-block">Unused Ctrl No.</button> -->
	                     				</div>
	                     			</div>
	                     			<div class="row form-group">
	                     				<div class="col-md-3">
	                     					Due Date
	                     				</div>
	                     				<div class="col-md-5">
	                     					<div class="input-group">
												<input class="form-control date-picker txtgensoa" id="txtDueDate" type="text" data-date-format="dd-mm-yyyy">
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
	                     				</div>
	                     				<div class="col-md-4">
	                     					<button class="btn btn-success btn-sm btn-block" id="btnprocessingofsoa" onclick="processsoa();">Process SOA</button>
	                     				</div>
	                     			</div>
	                     		</fieldset>
	                     	</div>
	                     	<div class="col-md-12">
                  				<fieldset style="margin: 8px;border: 1px solid #CCC;padding: 8px;margin-top: 0px;">
	                     			<legend style="border: none;margin-bottom: 0px;font-size: 15px; font-weight: normal;width:135px;">&nbsp;&nbsp;Previous Periods&nbsp;&nbsp;</legend>
	                     			<div class="row form-group">
	                     				<div class="col-md-12">
		                     				<div class="parent4">
		                     					<table class="table table-bordered table-hover fixTable">
		                     						<th>Billing Period</th>
		                     						<th>Due Date</th>
		                     						<th>Status</th>
		                     						<tbody id="tblperiodlist"></tbody>
		                     					</table>
		                     				</div>
		                     				<table class="tabledash_footer table" style="margin: 0px !important;">
	                                            <tr>
	                                                <th id="th_tabledash_footer">
	                                                    <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtbillingentries"><br /></font>
	                                                    <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
	                                                    <ul id="ulpaginationbilling" class="pagination pull-right"></ul>
	                                                </th>
	                                            </tr>
		                                    </table>
	                     				</div>
	                     			</div>
	                     		</fieldset>
	                     	</div>
	                    </div>
	                    <div class="col-md-8">
	                    	<div class="col-md-12" style="padding-left: 0px;">
		                        <div class="widget-box">
		                            <div class="widget-body">
		                                <div class="widget-main">
		                                    <div class="form-group row" style="margin-bottom: 0px;">
		                                        <div class="col-md-6">
		                                            <dt>Billing Period</dt>
		                                        </div>
		                                        <div class="col-md-6">
		                                            <dt>SOA No.</dt>
		                                        </div>
		                                    </div>
		                                    <div class="form-group row" style="margin-bottom: 0px;">
		                                        <div class="col-md-6">
		                                            <h4 class="widget-title smaller" style="color:#2679B5;margin-left: 20px;" id="txtsoadateofbilling"></h4>
		                                        </div>
		                                        <div class="col-md-6">
		                                            <h4 class="widget-title smaller" style="color:#2679B5;margin-left: 20px;" id="txtsoasoanoofbilling"></h4>
		                                        </div>
		                                    </div>

		                                    <hr style="margin-top: 5px;margin-bottom: 5px;">
		                                    <div class="form-group row" style="display: block;height: 527px;">
		                                        <div class="parent2" style="overflow: auto;">
			                                        <table class="table  table-bordered table-hover fixTable">
	                                                        <th style="width: 25%; background-color: rgb(67, 142, 185); position: relative; top: 0px;">Tenant ID</th>
	                                                        <th style="width: 25%; background-color: rgb(67, 142, 185); position: relative; top: 0px;">Store Name</th>
	                                                        <th style="width: 25%; background-color: rgb(67, 142, 185); position: relative; top: 0px;">Current Balance</th>
	                                                        <th style="width: 25%; background-color: rgb(67, 142, 185); position: relative; top: 0px;">Ctrl No</th>
                                                		<tbody id="tblperiodbilllist"></tbody>
		                                            </table>
	                                            </div>
		                                    </div>                                    
		                                </div>
		                            </div>
		                        </div>                    
		                    </div>
	                    </div>
                  	</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-yellow" style="float: right;" id="btnpostsoagenerated">
                    <i class="ace-icon fa fa-thumb-tack bigger-110"></i>
                    <span class="bigger-110 no-text-shadow" id="txtbtnpost">Post</span>
                </button>
			</div>
		</div>
	</div>
</div>
<!-- View OR -->
<div class="modal fade" id="modal_orlist" role="dialog" area-hidden="true">
    <div class="modal-dialog">   
	    <div class="modal-content">
	    	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">O.R List</h4>
				<input type="hidden" class="text_inquiry" id="" name="">
			</div>
	        <div class="modal-body">
	            <div class="row form-group">
	                <div class="col-xs-12 col-md-12">
	                	<div class="parent">
		                    <table class="table table-bordered table-hover fixTable">
		                    	<th>Date</th>
		                    	<th>Description</th>
		                    	<th>Payment Type</th>
		                    	<th>O.R No.</th>
		                    	<th>Amount</th>
		                    	<tbody id="tblorlist"></tbody>
		                    </table>
	                    </div>
	                    <table class="tabledash_footer table" style="margin: 0px !important;">
                            <tr>
                                <th id="th_tabledash_footer">
                                    <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtbillingentries"><br /></font>
                                    <input type="hidden" id="txt_userpage" class="form-control input-sm" style="width: 5%; text-align: center;">
                                    <ul id="ulpaginationbilling" class="pagination pull-right"></ul>
                                </th>
                            </tr>
                        </table>
	                </div>
	            </div>
	        </div>
	    </div>
    </div>
</div>

<script>
  	// JONAS FUNCTIONS ADDED July 19, 2017
  	$(function(){
	    loadpreviousperiods();
	})
  	function mallprinttemplate(tenantid){
        $.ajax({
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'tenantid=' + tenantid + '&form=mallprinttemplate',
        success:function(data){
                $("#template2").html(data);
            }
        })
    }

    function showtxtinfostorename(){
    	$.ajax({
    		type: 'POST',
    		url: 'billing/billingmainclass.php',
    		data: 'form=showtxtinfostorename',
    		success:function(data){
    			$("#txtinfostorename").html(data);
    		}
    	})
    }

    function loadtblorlist(){
    	$.ajax({
    		type: 'POST',
    		url: 'billing/billingmainclass.php',
    		data: 'form=loadtblorlist',
    		success:function(data){
    			$("#tblorlist").html(data);
    		}
    	})
    }

    function closemodal_statementofaccount(){
    	$("#modal_statementofaccount").modal("hide");
    	$("#modal_statementofaccount :input").val("");
    	$("#tblperiodbilllist").html("");
    	$("#txtsoadateofbilling").text("");
    	$("#txtsoasoanoofbilling").text("");
    	$(".txtgensoa").val();
    }

    function processsoa(){
	    var i = 0;
	    $(".txtgensoa").each(function(){
	        var thisval = $(this).val();
	        if(thisval == "")
	        {
	            i++;
	            $(this).css("border-color","#f2a696");
	        }
	    });
	    var tenantid = $("#txtTenantID").val();
	    var soano = $("#txtSOANo").val();
	    var datefrom = $("#txtPeriodFrom").val();
	    var dateto = $("#txtPeriodTo").val();
	    var duedate = $("#txtDueDate").val();
	    var arrr = datefrom.split("/");
	    var yrprd = arrr[2];
	    var monthprd = arrr[0];
	    if(i == 0)
	    {
        	$.ajax({  //Generate Bill Period
	            type: 'POST',
	            url: 'billing/billingmainclass.php',
	            data: '&datefrom='+datefrom+'&dateto='+dateto+'&duedate='+duedate+'&form=savenewperiodref',
	            beforeSend : function() {
                    $('#soaloadingscreen').addClass('myspinner');
                },
                    success: function(data3){
                    $('#soaloadingscreen').removeClass('myspinner');
	                if(data3 == "1"){

		                    $.ajax({  //Generate Rent
					            type:'POST',
					            url:  'billing/billingmainclass.php',
					            data: 'xdate=' + datefrom + '&tenantid=' + tenantid + '&form=savettenantslist',
					            beforeSend : function() {
				                    $('#soaloadingscreen').addClass('myspinner');
				                },
				                    success: function(data2){
				                    $('#soaloadingscreen').removeClass('myspinner');
					                if(data2 == "1"){

							                $.ajax({  //Generate of SOA
								                type: 'POST',
								                url: 'billing/billingmainclass.php',
								                data: 'datefrom=' + datefrom + '&dateto=' + dateto + '&tenantid=' + tenantid + '&yrprd=' + yrprd + '&monthprd=' + monthprd + '&duedate=' + duedate + '&form=processsoa',
								                beforeSend : function() {
								                    $('#soaloadingscreen').addClass('myspinner');
								                },
								                    success: function(data){
								                    $('#soaloadingscreen').removeClass('myspinner');
								                    var arr = data.split("|");
								                    if(arr[0] == "1"){
								                        $(".txtgensoa").css("border-color", "#CCC");
								                        loadpreviousperiods();
								                        setTimeout(function(){
															showmodal("alert", "SOA for "+arr[1]+" "+yrprd+" has been processed.", "tbltenantlists", null, "", null, "0");
   														}, 500)
								                    }else{
								                    	setTimeout(function(){
								                        	showmodal("alert", "An error occured.", "tbltenantlists", null, "", null, "1");
   														}, 500)
								                    }
								                }
								            })

						        	}
					            }
					        })

	                }
	                else if(data3 == "2"){
						reprocessbillconfirmation(monthprd, yrprd); //Reprocess of SOA
	                }
	                else{
	                	setTimeout(function(){
	                    	showmodal("alert", "An error occured.", "tbltenantlists", null, "", null, "1");
   						}, 500)
	                }
	            }
	        })   
	    }else{
	    	setTimeout(function(){
	       		showmodal("alert", "Select period first to proceed.", "tbltenantlists", null, "", null, "1");
   			}, 500)
	    }
	}

	function loadpreviousperiods(){
		var tenantid = $("#txtTenantID").val();
	    $.ajax({
	        type: 'POST',
	        url: 'billing/billingmainclass.php',
	        data: 'tenantid=' + tenantid + '&form=loadallprocessedsoa',
	        success: function(data)
	        {
	            $("#tblperiodlist").html(data)
	        }
	    })
	}

	function showallbills(soano){
	    $.ajax({
	        type: 'POST',
	        url: 'billing/billingmainclass.php',
	        data: 'id='+soano+'&form=showallbills',
	        success: function(data)
	        {
	            var arr = data.split("|");
	            $("#txtsoadateofbilling").html(arr[1]);
	            $("#txtsoasoanoofbilling").html(arr[0]);
	        }
	    })
	}

	function loadallbills(month, year, xstat, datefrom, dateto, duedate, tenantid){
	    if(xstat == "1")
	    {
	        $("#btnpostsoagenerated").prop("disabled", true);
	        $("#txtbtnpost").text("Posted");
	    }
	    else
	    {
	        $("#btnpostsoagenerated").attr("onclick", "postloadbill(\""+month+"\", \""+year+"\")");
	        $("#btnpostsoagenerated").prop("disabled", false);
	        $("#txtbtnpost").text("Post");
	    }
	    
	    $.ajax({
	        type: 'POST',
	        url: 'billing/billingmainclass.php',
	        data: 'month=' + month + '&year=' + year + '&tenantid=' + tenantid + '&form=loadallbills', 
	        success: function(data)
	        {
	            $("#tblperiodbilllist").html(data);
	            $("#txtPeriodFrom").val(datefrom);
	            $("#txtPeriodTo").val(dateto);
	            $("#txtDueDate").val(duedate);
	        }
	    })
	}

	function reprocessbillconfirmation(month, year){
	    $.ajax({
	        type: 'POST',
	        url: 'billing/billingmainclass.php',
	        data: 'month=' + month + '&form=convertlang',
	        success:function(data){
	        	setTimeout(function(){
	            	showmodal("confirm", "You are about to reprocess SOA for "+data+" "+year+" .", "reprocessbill", null, "", null, "1");
   				}, 500)
	        }
	    })
	}

	function reprocessbill(){
		var tenantid = $("#txtTenantID").val();
	    var soano = $("#txtSOANo").val();
	    var datefrom = $("#txtPeriodFrom").val();
	    var dateto = $("#txtPeriodTo").val();
	    var duedate = $("#txtDueDate").val();
	    var arrr = datefrom.split("/");
	    var yrprd = arrr[2];
	    var monthprd = arrr[0];
	    $.ajax({  
            type: 'POST',
            url: 'billing/billingmainclass.php',
            data: 'datefrom=' + datefrom + '&dateto=' + dateto + '&tenantid=' + tenantid + '&yrprd=' + yrprd + '&monthprd=' + monthprd + '&duedate=' + duedate + '&form=processsoa',
            beforeSend : function() {
                $('#soaloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#soaloadingscreen').removeClass('myspinner');
                var arr = data.split("|");
                if(arr[0] == "1"){
                	setTimeout(function(){
                    	showmodal("alert", "SOA for "+arr[1]+" "+yrprd+" has been reprocessed.", "tbltenantlists", null, "", null, "0");
   					}, 500)
                    $(".txtgensoa").css("border-color", "#CCC");
                    loadpreviousperiods();
                }else{
                	setTimeout(function(){
                    	showmodal("alert", "An error occured.", "tbltenantlists", null, "", null, "1");
					}, 500)
                }
            }
        })    
	}

	function postloadbill(month, year){
	    $.ajax({
	        type: 'POST',
	        url: 'billing/billingmainclass.php',
	        data:  'month=' + month + '&year=' + year + '&form=postloadbill',
	        success: function(data)
	        {
	            var arr = data.split("|");
	            if(arr[0] == "1")
	            {
	                $("#btnpostsoagenerated").prop("disabled", true);
	                $("#txtbtnpost").text("Posted");
	                loadpreviousperiods()
	                showmodal("alert", "SOA for "+arr[1]+" "+year+" has been posted.", "", null, "", null, "0");
	            }
	            else
	            {
	                showmodal("alert", "An error occured.", "", null, "", null, "1");
	            }
	        }
	    })
	}

	function opensoamodal(){
		$("#modal_statementofaccount").modal("show");
		$("#btnprocessingofsoa").prop("disabled", false);
	}
</script>

<div class="modal fade" id="modaldrilldown" role="dialog">
	<div class="modal-dialog" style="width: 80%;">
		<div class="modal-content">
			<div class="modal-header btn-primary">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" style="font-family: Roboto;font-size: 18px;"></h4>
				<input type="hidden" class="text_inquiry" id="txtinq_inquiryid" name="">
			</div>
			<div class="modal-body">
				<div class="row form-group">
					<div id="div_charges"></div>
				</div>
				<div class="row form-group">
					<div id="div_othercharges"></div>
				</div>
				<div class="row form-group">
					<div id="div_payment"></div>
				</div>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<!-- ============ MODAL INQUIRY ============= -->
<div class="modal fade" id="modal_opensoa" role="dialog" area-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content ">
      <div class="modal-body">
          <button type="button" class="close" onclick="closemodalsoa()">&times;</button>
          <div class="row form-group">
              <div class="col-md-12 col-xs-12">
				<div id="reportcontainer2" style="margin-top: 10px; display: block;">
					<center>
						<div class="checklist" id="tblsoa2" style="width: 99%;margin-bottom: 0;">
							<center>
							<!-- header starts here -->
								<table style="width: 100%;" cellspacing="0" cellpadding="0" style="display: none;">
									<tbody id="template2"></tbody>
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
										<td><h6 style="font-weight: normal;margin: 3px;font-size: 11px;">ADDRESS</h6></td>
										<td>:</td>
										<td><h6 style="font-weight: normal;margin: 3px;font-size: 11px;font-weight: bold;" id="txtprint_address"></h6></td>
										<td><h6 style="font-weight: normal;margin: 3px;font-size: 11px;">BILLING PERIOD</h6></td>
										<td>:</td>
										<td><h6 style="font-weight: normal;margin: 3px;font-size: 11px;font-weight: bold;" id="txtprint_billingperiod"></h6></td>
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
												<table style="border-bottom:2px solid #111109;width: 99%;">
													<tr>
														<td style="padding-bottom: 2px;"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="2"></td>
											<td>
												<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">TOTAL Penalty Charges (Account 31 days and over)</h6>
											</td>
											<td style="font-weight: normal;margin: 3px;font-size: 11px;" align="right">
												<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;">0.00</h6>
											</td>
										</tr>
										<tr>
											<td colspan="4" align="center">
												<table style="border-bottom:2px solid #111109;width: 99%;">
													<tr>
														<td style="padding-bottom: 2px;"></td>
													</tr>
												</table>
											</td>
										</tr>
										<!-- <tr>
											<td colspan="2"></td>
											<td>
												<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">Association Dues</h6>
											</td>
											<td style="font-weight: normal;margin: 3px;font-size: 11px;" align="right">
												<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;" id="">0.00</h6>
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
										</tr> -->
									</tbody>
									<!-- previous balance ends here -->


									<!-- current charges starts here ... -->
									<tr style="border-left:1px solid #111109;border-right:1px solid #111109;">
										<td colspan="4" style="padding-left: 5px;">
											<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;">CURRENT CHARGES</h6>
										</td>
									</tr>
									<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;border-bottom:1px solid #111109;" id="tblcurrchrges">
									</tbody>
									<tr style="border-left:1px solid #111109;border-right:1px solid #111109;">
										<td colspan="4" style="padding-left: 5px;">
											<h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #111109;">OTHER CHARGES</h6>
										</td>
									</tr>
									<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;border-bottom:1px solid #111109;" id="tblotherchrges">
									</tbody>
									<tbody style="border-left:1px solid #111109;border-right:1px solid #111109;">
										<tr>
											<td colspan="2"></td>
											<td>
												<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">TOTAL CURRENT CHARGES</h6>
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
																	<td align="left">
																		<h6 class="paddleft" style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
																			TOTAL PREVIOUS BALANCES
																		</h6>
																	</td>
																	<td align="right" style="">
																		<h6 class="paddright" style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;" id="ttlprevblncs2">
																			
																		</h6>
																	</td>
																</tr>
																<tr>
																	<td align="left">
																		<h6 class="paddleft" style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
																			ADD: TOTAL CURRENT CHARGES
																		</h6>
																	</td>
																	<td align="right" style="">
																		<h6 class="paddright" style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;" id="ttlcurrchrges2">
																			
																		</h6>
																	</td>
																</tr>
																<tr>
																	<td align="left">
																		<h6 class="paddleft" style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;">
																			LESS: TOTAL PAYMENTS
																		</h6>
																	</td>
																	<td align="right" style="">
																		<h6 class="paddright" style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #111109;" id="ttlpymentcrdtadj2">
																			
																		</h6>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td>
															<table style="width:100%;" cellpadding="0" cellspacing="0">
																<tr>
																	<td style="padding-right: 5px;background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-left: 10px;" align="left">
																		<h6 class="" style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #ffffff !important;">
																			AMOUNT DUE
																		</h6>
																	</td>
																	<td style="padding-left: 20px;background-color: #111109 !important;-webkit-print-color-adjust: exact;padding-right: 5px;" align="right">
																		<h6 style="font-weight: bold;margin-top: 4px;margin-bottom: 3px;font-size: 11px;color: #ffffff !important;" id="ttlamtdue">
																			 0.00
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
									<tbody>
										<tr>
											<td colspan="4">
												<table style="width: 100%;"">
													<tr>
														<td colspan="4"><br/></td>
													</tr>
													<tr style="border-left:1px solid #111109;border-right:1px solid #111109;">
														<td colspan="6" align="center" style="background-color: #111109 !important;-webkit-print-color-adjust: exact;"><h6 style="font-weight: bold;margin: 3px;font-size: 11px;color: #ffffff !important;">OVERDUE ACCOUNTS</h6></td>
													</tr>
													<tr  style="border-left:1px solid #111109;border-bottom:1px solid #111109;border-right:1px solid #111109;">
														<td style="text-align: center;">AGING SUMMARY</td>
														<td style="text-align: center;border-left:1px solid #111109;">CURRENT</td>
														<td style="text-align: center;border-left:1px solid #111109;">1-30 DAYS</td>
														<td style="text-align: center;border-left:1px solid #111109;">31-60 DAYS</td>
														<td style="text-align: center;border-left:1px solid #111109;">61-90 DAYS</td>
														<td style="text-align: center;border-left:1px solid #111109;">OVER 90 DAYS</td>
													</tr>
													<tr style="border-left:1px solid #111109;border-bottom:1px solid #111109;border-right:1px solid #111109;">
														<td style="text-align: center;"></td>
														<td style="text-align: center;border-left:1px solid #111109;" id="txtsoab00">0.00</td>
														<td style="text-align: center;border-left:1px solid #111109;" id="txtsoab13">0.00</td>
														<td style="text-align: center;border-left:1px solid #111109;" id="txtsoab36">0.00</td>
														<td style="text-align: center;border-left:1px solid #111109;" id="txtsoab69">0.00</td>
														<td style="text-align: center;border-left:1px solid #111109;" id="txtsoab99">0.00</td>
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
														<label id="lblprepby"></label>
															<hr style="border-color: #111109;width: 90%;margin:0px;">
														</td>
														<td width="25%">
														<label id="lblchkby"></label>
															<hr style="border-color: #111109;width: 90%;margin:0px;">
														</td>
														<td width="25%">
														<label id="lblapprby"></label>
															<hr style="border-color: #111109;width: 90%;margin:0px;">
														</td>
														<td width="25%">
														<label id="lblrcvdby"></label>
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
							<div class="divFooter"><h6 id="print_footer"></h6></div>
						</div>
					</center>
				</div>                
              </div>
          </div>
          <div class="row form-group" style="">
            <div class="col-md-2 col-xs-12" style="padding-right:0px;">
                
            </div>
            <div class="col-md-10 col-xs-12" style="">
                <button type="button" class="btn btn-primary" style="float: right;" id="" onclick="printsoa()">&nbsp;Print</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>