<style>
.parent {
    height: 48vh;
}
</style>

<div class="page-header row" style="margin-bottom: 10px;padding-top:10px;background-color: #edf4f8;padding-bottom: 10px;">
	<div class="col-md-6 col-xs-12" style="padding-left: 0px!important;">
		<h1><b>REPORTS</b></h1>
		<input type="hidden" id="txtreservationpages" name="">
	</div>
</div>

<div class="page-content" style="padding: 0px;">
	<div class="tabbable">
        <ul class="nav nav-tabs" id="myTaba">

            <li class="active">
                <a data-toggle="tab" href="#tab1">
                    <i class="green menu-icon fa fa-line-chart bigger-120"></i>
                    Tenant Sales Report
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab2">
                    <i class="green menu-icon fa fa-phone bigger-120"></i>
                    Inquiry Reports
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab3">
                    <i class="green menu-icon fa fa-folder-open bigger-120"></i>
                    Application Reports
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab4">
                    <i class="green menu-icon fa fa-building-o bigger-120"></i>
                    Unit History
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab5">
                    <i class="green ace-icon fa fa-users bigger-120"></i>
                    Tenant History
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab6">
                    <i class="green ace-icon fa fa-dollar bigger-120"></i>
                    Sales Audit
                </a>
            </li>

            <li>
                <a data-toggle="tab" href="#tab7">
                    <i class="green ace-icon fa fa-history bigger-120"></i>
                    Audit Trail
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="tab1" class="tab-pane fade in active">
				<div class="row">
					<ul class="nav nav-tabs" id="navigationReps">
						<li onclick="openGraph()" role="presentation" class="active"><a href="#"><span class="fa fa-pie-chart"></span> Graphs</a></li>
						<li onclick="openList()" role="presentation"><a href="#"><span class="fa fa-list"></span> List</a></li>	
					</ul>

					<div id="pageList" class="row-fluid" style="display: none;">
						<div class="col-md-2 hidden-sm">
							<div class="sidebar-module sidebar-module-inset">
								<h5 class="page-header"><span class="fa fa-cog"></span> Options</h5>

								<div class="container-fluid">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="control-label"><b>Mall</b></label>
											<select class="form-control selectMall" id="mallsid2" onchange="palit(this.value)"></select>
										</div>

										<div class="form-group">
											<label class="control-label"><b>Store Name</b></label>
											<input type="hidden" class="form-control" id="listTenant">
											
											<div class="input-group">
												<input type="text" class="form-control" id="nameoftenant2" onclick="findTenant()" readonly>
												<label class="input-group-addon" onclick="resetSearch()"><span class="glyphicon glyphicon-refresh"></span></label>
											</div>
										</div>


										<div class="form-group">
											<label class="control-labe col-md-12"><b>Date Range</b></label>
											<label class="col-md-3 control-label">From</label>
											<div class="col-md-9">
												<input class="form-control date-picker" type="text" placeholder="From" id="dateFromList" value="<?php echo date('m/d/Y'); ?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label">To</label>
											<div class="col-md-9">
												<input class="form-control date-picker" type="text" placeholder="To" id="dateToList" value="<?php echo date('m/d/Y'); ?>">
											</div>
										</div>
									</div>
									<br>
									<button class="btn btn-success" onclick="clickforall()"> Go</button>
								</div>
							</div>
						</div>

						<div class="col-md-10 col-sm-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Data from CSV
								</div>

								<div class="panel-body">
									<ul class="nav nav-tabs" id="mgaList">
										<li onclick="showSales()" class="active"><a href="#">Daily Sales</a></li>
										<li onclick="showHour()"><a href="#">Hourly Sales</a></li>
										<li onclick="showPayment()"><a href="#">Daily Sales - Payment</a></li>
										<li onclick="showDiscount()"><a href="#">Daily Sales - Discount</a></li>
										<li onclick="showCanceled()"><a href="#">Daily Sales - Refund / Canceled</a></li>
									</ul>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300px; margin-top: 5px;" id="showSales">
										<table class="table table-bordered" style="width: 100%;">
											<thead>
												<th style="width:1%; white-space:nowrap;">MERCHANT NAME</th>
												<th style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th style="width:1%; white-space:nowrap;">OLD GRAND TOTAL </th>
												<th style="width:1%; white-space:nowrap;">NEW GRAND TOTAL</th>
												<th style="width:1%; white-space:nowrap;">DAILY SALES</th>
												<th style="width:1%; white-space:nowrap;">GRAND TOTAL DISCOUNT</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - SENIORS</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - PWD</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - GPC</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - VIP</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - EMP</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - REG</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - OTHERS</th>
												<th style="width:1%; white-space:nowrap;">TOTAL REFUND</th>
												<th style="width:1%; white-space:nowrap;">TOTAL CANCELED</th>
												<th style="width:1%; white-space:nowrap;">TOTAL VAT </th>
												<th style="width:1%; white-space:nowrap;">TOTAL VAT INCLUSIVE SALES</th>
												<th style="width:1%; white-space:nowrap;">TOTAL VAT EXCLUSIVE SALES</th>
												<th style="width:1%; white-space:nowrap;">BEGINNING O.R.</th>
												<th style="width:1%; white-space:nowrap;">ENDING O.R.</th>
												<th style="width:1%; white-space:nowrap;">DOCUMENT COUNT</th>
												<th style="width:1%; white-space:nowrap;">CUSTOMER COUNT</th>
												<th style="width:1%; white-space:nowrap;">SENIOR CITIZEN COUNT</th>
												<th style="width:1%; white-space:nowrap;">LOCAL TAX</th>
												<th style="width:1%; white-space:nowrap;">SERVICE CHARGE</th>
												<th style="width:1%; white-space:nowrap;">TOTAL NON-VAT SALE</th>
												<th style="width:1%; white-space:nowrap;">RAW GROSS</th>
												<th style="width:1%; white-space:nowrap;">DAILY LOCAL TAX </th>
												<th style="width:1%; white-space:nowrap;">WORKSTATION NUMBER</th>
												<th style="width:1%; white-space:nowrap;">TOTAL PAYMENT - CASH</th>
												<th style="width:1%; white-space:nowrap;">TOTAL PAYMENT - CARD</th>
												<th style="width:1%; white-space:nowrap;">TOTAL PAYMENT - OTHERS</th>

											</thead>

											<tbody id="db_sales"></tbody>
										</table>
									</div>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300; margin-top: 5px; display: none;" id="showHour">
										<table class="table table-bordered" style="width: 100%;">
											<thead>
												<th style="width:1%; white-space:nowrap;">MERCHANT NAME</th>
												<th style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th style="width:1%; white-space:nowrap;">HOUR CODE</th>
												<th style="width:1%; white-space:nowrap;">DAILY SALES</th>
												<th style="width:1%; white-space:nowrap;">DOCUMENT COUNT</th>
												<th style="width:1%; white-space:nowrap;">CUSTOMER COUNT</th>
												<th style="width:1%; white-space:nowrap;">SENIOR CITIZEN COUNT</th>
											</thead>
											<tbody id="db_hour"></tbody>
										</table>
									</div>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300; margin-top: 5px; display: none;" id="showPayment">
										<table class="table table-bordered" style="width: 100%;">
											<thead>
												<th  style="width:1%; white-space:nowrap;">MERCHANT CODE</th>
												<th  style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT CODE</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT DESCRIPTION</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT CODE CLASSIFICATION</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT CODE DESCRIPTION</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT AMOUNT</th>
											</thead>
											<tbody id="db_payment"></tbody>
										</table>
									</div>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300; margin-top: 5px; display: none;" id="showDiscount">
										<table class="table table-bordered" style="width: 100%;">
											<thead> 
												<th style="width:1%; white-space:nowrap;">MERCHANT NAME</th>
												<th style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th style="width:1%; white-space:nowrap;">DISCOUNT CODE</th>
												<th style="width:1%; white-space:nowrap;">DISCOUNT PERCENTAGE</th>
												<th style="width:1%; white-space:nowrap;">DISCOUNT AMOUNT</th>
												<th style="width:1%; white-space:nowrap;">DOCUMENT COUNT</th>
												<th style="width:1%; white-space:nowrap;">CUSTOMER COUNT</th>
												<th style="width:1%; white-space:nowrap;">SENIOR CITIZEN COUNT</th>
											</thead>
											<tbody id="db_discount"></tbody>
										</table>
									</div>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300; margin-top: 5px; display: none;" id="showVoid">
										<table class="table table-bordered" style="width: 100%;">
											<thead> 
												<th style="width:1%; white-space:nowrap;">MERCHANT CODE</th>
												<th style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th style="width:1%; white-space:nowrap;">CODE</th>
												<th style="width:1%; white-space:nowrap;">REASON</th>
												<th style="width:1%; white-space:nowrap;">AMOUNT</th>
												<th style="width:1%; white-space:nowrap;">DOCUMENT COUNT</th>
												<th style="width:1%; white-space:nowrap;">CUSTOMER COUNT</th>
												<th style="width:1%; white-space:nowrap;">SENIOR CITIZEN COUNT</th>
											</thead>
											<tbody id="db_void"></tbody>
										</table>
									</div>
								</div>

								<div class="panel-footer">
									<div id="pageSales" class="paginationLists">
										<button onclick="pagesales('first')" class="btn-sales btn-sales-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button onclick="pagesales('prev')" class="btn-sales btn-sales-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button onclick="pagesales('next')" class="btn-sales btn-sales-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button onclick="pagesales('last')" class="btn-sales btn-sales-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>

									<div id="pageHour" class="paginationLists" style="display: none;">
										<button  onclick="pagehour('first')"  class="btn-hour btn-hour-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button  onclick="pagehour('prev')"  class="btn-hour btn-hour-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button  onclick="pagehour('next')"  class="btn-hour btn-hour-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button  onclick="pagehour('last')"  class="btn-hour btn-hour-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>

									<div id="pagePayment" class="paginationLists" style="display: none;">
										<button  onclick="pagepayment('first')" class="btn-payment btn-payment-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button  onclick="pagepayment('prev')" class="btn-payment btn-payment-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button  onclick="pagepayment('next')" class="btn-payment btn-payment-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button  onclick="pagepayment('last')" class="btn-payment btn-payment-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>

									<div id="pageDiscount" class="paginationLists" style="display: none;">
										<button  onclick="pagediscount('first')" class="btn-discount btn-discount-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button  onclick="pagediscount('prev')" class="btn-discount btn-discount-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button  onclick="pagediscount('next')" class="btn-discount btn-discount-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button  onclick="pagediscount('last')" class="btn-discount btn-discount-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>

									<div id="pageVoid" class="paginationLists" style="display: none;">
										<button  onclick="pagevoid('first')" class="btn-void btn-void-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button  onclick="pagevoid('prev')" class="btn-void btn-void-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button  onclick="pagevoid('next')" class="btn-void btn-void-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button  onclick="pagevoid('last')" class="btn-void btn-void-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>
								</div>

								<input type="hidden" id="countsales">
								<input type="hidden" id="counthour">
								<input type="hidden" id="countpayment">
								<input type="hidden" id="countdiscount">
								<input type="hidden" id="countvoid">
							</div>
						</div>
					</div>

					<div id="pageList" class="row-fluid" style="display: none;">
						<div class="col-md-2 hidden-sm">
							<div class="sidebar-module sidebar-module-inset">
								<h5 class="page-header"><span class="fa fa-cog"></span> Options</h5>

								<div class="container-fluid">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="control-label"><b>Mall</b></label>
											<select class="form-control selectMall" id="mallsid2" onchange="palit(this.value)"></select>
										</div>

										<div class="form-group">
											<label class="control-label"><b>Store Name</b></label>
											<input type="hidden" class="form-control" id="listTenant">
											
											<div class="input-group">
												<input type="text" class="form-control" id="nameoftenant2" onclick="findTenant()" readonly>
												<label class="input-group-addon" onclick="resetSearch()"><span class="glyphicon glyphicon-refresh"></span></label>
											</div>
										</div>


										<div class="form-group">
											<label class="control-labe col-md-12"><b>Date Range</b></label>
											<label class="col-md-3 control-label">From</label>
											<div class="col-md-9">
												<input class="form-control date-picker" type="text" placeholder="From" id="dateFromList" value="<?php echo date('m/d/Y'); ?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-3 control-label">To</label>
											<div class="col-md-9">
												<input class="form-control date-picker" type="text" placeholder="To" id="dateToList" value="<?php echo date('m/d/Y'); ?>">
											</div>
										</div>
									</div>
									<br>
									<button class="btn btn-success" onclick="clickforall()"> Go</button>
								</div>
							</div>
						</div>

						<div class="col-md-10 col-sm-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Data from CSV
								</div>

								<div class="panel-body">
									<ul class="nav nav-tabs" id="mgaList">
										<li onclick="showSales()" class="active"><a href="#">Daily Sales</a></li>
										<li onclick="showHour()"><a href="#">Hourly Sales</a></li>
										<li onclick="showPayment()"><a href="#">Daily Sales - Payment</a></li>
										<li onclick="showDiscount()"><a href="#">Daily Sales - Discount</a></li>
										<li onclick="showCanceled()"><a href="#">Daily Sales - Refund / Canceled</a></li>
									</ul>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300px; margin-top: 5px;" id="showSales">
										<table class="table table-bordered" style="width: 100%;">
											<thead>
												<th style="width:1%; white-space:nowrap;">MERCHANT NAME</th>
												<th style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th style="width:1%; white-space:nowrap;">OLD GRAND TOTAL </th>
												<th style="width:1%; white-space:nowrap;">NEW GRAND TOTAL</th>
												<th style="width:1%; white-space:nowrap;">DAILY SALES</th>
												<th style="width:1%; white-space:nowrap;">GRAND TOTAL DISCOUNT</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - SENIORS</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - PWD</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - GPC</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - VIP</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - EMP</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - REG</th>
												<th style="width:1%; white-space:nowrap;">TOTAL DISCOUNT - OTHERS</th>
												<th style="width:1%; white-space:nowrap;">TOTAL REFUND</th>
												<th style="width:1%; white-space:nowrap;">TOTAL CANCELED</th>
												<th style="width:1%; white-space:nowrap;">TOTAL VAT </th>
												<th style="width:1%; white-space:nowrap;">TOTAL VAT INCLUSIVE SALES</th>
												<th style="width:1%; white-space:nowrap;">TOTAL VAT EXCLUSIVE SALES</th>
												<th style="width:1%; white-space:nowrap;">BEGINNING O.R.</th>
												<th style="width:1%; white-space:nowrap;">ENDING O.R.</th>
												<th style="width:1%; white-space:nowrap;">DOCUMENT COUNT</th>
												<th style="width:1%; white-space:nowrap;">CUSTOMER COUNT</th>
												<th style="width:1%; white-space:nowrap;">SENIOR CITIZEN COUNT</th>
												<th style="width:1%; white-space:nowrap;">LOCAL TAX</th>
												<th style="width:1%; white-space:nowrap;">SERVICE CHARGE</th>
												<th style="width:1%; white-space:nowrap;">TOTAL NON-VAT SALE</th>
												<th style="width:1%; white-space:nowrap;">RAW GROSS</th>
												<th style="width:1%; white-space:nowrap;">DAILY LOCAL TAX </th>
												<th style="width:1%; white-space:nowrap;">WORKSTATION NUMBER</th>
												<th style="width:1%; white-space:nowrap;">TOTAL PAYMENT - CASH</th>
												<th style="width:1%; white-space:nowrap;">TOTAL PAYMENT - CARD</th>
												<th style="width:1%; white-space:nowrap;">TOTAL PAYMENT - OTHERS</th>

											</thead>

											<tbody id="db_sales"></tbody>
										</table>
									</div>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300; margin-top: 5px; display: none;" id="showHour">
										<table class="table table-bordered" style="width: 100%;">
											<thead>
												<th style="width:1%; white-space:nowrap;">MERCHANT NAME</th>
												<th style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th style="width:1%; white-space:nowrap;">HOUR CODE</th>
												<th style="width:1%; white-space:nowrap;">DAILY SALES</th>
												<th style="width:1%; white-space:nowrap;">DOCUMENT COUNT</th>
												<th style="width:1%; white-space:nowrap;">CUSTOMER COUNT</th>
												<th style="width:1%; white-space:nowrap;">SENIOR CITIZEN COUNT</th>
											</thead>
											<tbody id="db_hour"></tbody>
										</table>
									</div>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300; margin-top: 5px; display: none;" id="showPayment">
										<table class="table table-bordered" style="width: 100%;">
											<thead>
												<th  style="width:1%; white-space:nowrap;">MERCHANT CODE</th>
												<th  style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT CODE</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT DESCRIPTION</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT CODE CLASSIFICATION</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT CODE DESCRIPTION</th>
												<th  style="width:1%; white-space:nowrap;">PAYMENT AMOUNT</th>
											</thead>
											<tbody id="db_payment"></tbody>
										</table>
									</div>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300; margin-top: 5px; display: none;" id="showDiscount">
										<table class="table table-bordered" style="width: 100%;">
											<thead> 
												<th style="width:1%; white-space:nowrap;">MERCHANT NAME</th>
												<th style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th style="width:1%; white-space:nowrap;">DISCOUNT CODE</th>
												<th style="width:1%; white-space:nowrap;">DISCOUNT PERCENTAGE</th>
												<th style="width:1%; white-space:nowrap;">DISCOUNT AMOUNT</th>
												<th style="width:1%; white-space:nowrap;">DOCUMENT COUNT</th>
												<th style="width:1%; white-space:nowrap;">CUSTOMER COUNT</th>
												<th style="width:1%; white-space:nowrap;">SENIOR CITIZEN COUNT</th>
											</thead>
											<tbody id="db_discount"></tbody>
										</table>
									</div>

									<div class="container-fluid reportlists" style="overflow-x: scroll; min-height: 300; margin-top: 5px; display: none;" id="showVoid">
										<table class="table table-bordered" style="width: 100%;">
											<thead> 
												<th style="width:1%; white-space:nowrap;">MERCHANT CODE</th>
												<th style="width:1%; white-space:nowrap;">TRANSACTION DATE</th>
												<th style="width:1%; white-space:nowrap;">CODE</th>
												<th style="width:1%; white-space:nowrap;">REASON</th>
												<th style="width:1%; white-space:nowrap;">AMOUNT</th>
												<th style="width:1%; white-space:nowrap;">DOCUMENT COUNT</th>
												<th style="width:1%; white-space:nowrap;">CUSTOMER COUNT</th>
												<th style="width:1%; white-space:nowrap;">SENIOR CITIZEN COUNT</th>
											</thead>
											<tbody id="db_void"></tbody>
										</table>
									</div>
								</div>

								<div class="panel-footer">
									<div id="pageSales" class="paginationLists">
										<button onclick="pagesales('first')" class="btn-sales btn-sales-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button onclick="pagesales('prev')" class="btn-sales btn-sales-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button onclick="pagesales('next')" class="btn-sales btn-sales-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button onclick="pagesales('last')" class="btn-sales btn-sales-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>

									<div id="pageHour" class="paginationLists" style="display: none;">
										<button  onclick="pagehour('first')"  class="btn-hour btn-hour-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button  onclick="pagehour('prev')"  class="btn-hour btn-hour-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button  onclick="pagehour('next')"  class="btn-hour btn-hour-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button  onclick="pagehour('last')"  class="btn-hour btn-hour-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>

									<div id="pagePayment" class="paginationLists" style="display: none;">
										<button  onclick="pagepayment('first')" class="btn-payment btn-payment-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button  onclick="pagepayment('prev')" class="btn-payment btn-payment-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button  onclick="pagepayment('next')" class="btn-payment btn-payment-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button  onclick="pagepayment('last')" class="btn-payment btn-payment-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>

									<div id="pageDiscount" class="paginationLists" style="display: none;">
										<button  onclick="pagediscount('first')" class="btn-discount btn-discount-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button  onclick="pagediscount('prev')" class="btn-discount btn-discount-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button  onclick="pagediscount('next')" class="btn-discount btn-discount-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button  onclick="pagediscount('last')" class="btn-discount btn-discount-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>

									<div id="pageVoid" class="paginationLists" style="display: none;">
										<button  onclick="pagevoid('first')" class="btn-void btn-void-1 btn btn-info"><span class="glyphicon glyphicon-fast-backward"></span></button>
										<button  onclick="pagevoid('prev')" class="btn-void btn-void-1 btn btn-info"><span class="glyphicon glyphicon-backward"></span></button>
										<button  onclick="pagevoid('next')" class="btn-void btn-void-2 btn btn-info"><span class="glyphicon glyphicon-forward"></span></button>
										<button  onclick="pagevoid('last')" class="btn-void btn-void-2 btn btn-info"><span class="glyphicon glyphicon-fast-forward"></span></button>
									</div>
								</div>

								<input type="hidden" id="countsales">
								<input type="hidden" id="counthour">
								<input type="hidden" id="countpayment">
								<input type="hidden" id="countdiscount">
								<input type="hidden" id="countvoid">
							</div>
						</div>
					</div>

					<div class="row-fluid" id="graphs">
						<div class="col-md-2 hidden-sm">
							<div class="sidebar-module sidebar-module-inset">
								<h5 class="page-header"><span class="fa fa-cog"></span> Options</h5>

								<div class="container-fluid">
									<div class="form-horizontal">
										<div class="form-group">
											<label class="control-label"><b>Mall</b></label>
											<select class="form-control selectMall" id="mallsid" onchange="palit2(this.value)"></select>
										</div>

										<div class="form-group">
											<label class="control-label"><b>Store Name</b></label>
											<input type="hidden" class="form-control" id="listTenant">
											
											<div class="input-group">
												<input type="text" class="form-control" id="nameoftenant" onclick="findTenant()" readonly>
												<label class="input-group-addon" onclick="resetSearch()"><span class="glyphicon glyphicon-refresh"></span></label>
											</div>
										</div>
									</div>
									<ul class="nav nav-pills nav-stacked" id="selectType" style="margin-left: 0px; background: #FFF;">
										<li id="btnYear" class="active" ><a href="#">Year</a></li>
										<li id="btnMonth"><a href="#" >Month</a></li>
										<!-- <li><a href="#" onclick="forWeek()">Week</a></li> -->
									</ul>
									<br>
									<button class="btn btn-success" onclick="selectFirst()"> Go</button>
								</div>
							</div>
						</div>

						<div class="col-md-10 col-sm-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="container-fluid">
										<div class="btn-group pull-right">
											
											<button class="btn btn-info"><span class="fa fa-pie-chart"></span> Graph</button>
											<!-- <button class="btn btn-info"><span class="fa fa-list"></span> List</button> -->
											<!-- <button class="btn btn-warning" onclick="savecsv()"><span class="fa fa-list"></span> Sync Files</button> -->
										</div>
									</div>
								</div>

								<div class="panel-body mainBody" id="whole1">
									<div class="col-sm-12">
										<div class="col-md-2 pull-right">
											<div class="form-group">
												<!-- <label class="control-label"><input type="radio" name="charts" checked onclick="yearpie()"> <span class="fa fa-pie-chart"></span> Pie</label>
												<label class="control-label"><input type="radio" name="charts" onclick="stockYear()"> <span class="fa fa-bar-chart"></span> Stock</label> -->
											</div>
										</div>
										<div id="yearpie">
											
										</div>

										<div id="tblWholeYear">
											<div class="panel panel-primary">
												<div class="panel-heading hidden-xs hidden-sm">
													<div class="container-fluid">
														<!-- <div class="col-md-1">
															
														</div>
														<div class="col-md-3">
															<b>Store Name</b>
														</div> -->

														<div class="col-md-2 col-md-offset-2">
															<b>Month</b>
														</div>

														<div class="col-md-2 text-center">
															<b>Sales</b>
														</div>

														<div class="col-md-2 text-center">
															<b>Discount</b>
														</div>
														<div class="col-md-2 text-center">
															<b>Void</b>
														</div>
													</div>
												</div>

												<div class="panel-body">
													<div  id="tblWholeYearSales"></div>
												</div>

												<div class="panel-footer">
													
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- <div class="panel-body mainBody" id="body2" style="display: none;">
									
								</div> -->

								<div class="panel-body mainBody" id="monthview" style="display: none;">
									<div id="forMonthly">
										<div class="form-inline">
											<div class="form-group">
												<label class="control-label"><b>Year</b></label>
												<select class="form-control" id="selectYear">
													<?php
														
														for ( $a = 5; $a >= 1; $a-- ) {
															$timestamp = strtotime('-'. $a .' years');
															$forval1 = date('Y', $timestamp);

															?>
																<option value="<?php echo $forval1; ?>"><?php echo $forval1; ?></option>
															<?php
														}

														?>
															<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
														<?php

														
														for ( $b = 1; $b <= 5; $b++ ) {
															$timestamp2 = strtotime('+'. $b .' years');
															$forval2 = date('Y', $timestamp2);
															?>
																<option value="<?php echo $forval2; ?>"><?php echo $forval2; ?></option>
															<?php
														}
													?>
												</select>

												&nbsp;


												<label class="control-label"><b>Month</b></label>
												<select class="form-control" id="searchMonth">
													<option value="01">January</option>
													<option value="02">February</option>
													<option value="03">March</option>
													<option value="04">April</option>
													<option value="05">May</option>
													<option value="06">June</option>
													<option value="07">July</option>
													<option value="08">August</option>
													<option value="09">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>
												</select>

												<button class="btn btn-success" onclick="selectFirst()">Go</button>
											</div>
										</div>

										<div class="col-md-6">
											<div id="thisMonthly">
											
											</div>
										</div>

										<div class="col-md-6">
											<div id="displayresults">
												
											</div>
										</div>

										<div id="wholeMonth">
											
										</div>
									</div>
								</div>

								<div class="panel-body mainBody" id="weekview" style="display: none;">
									
								</div>

								<div class="panel-footer">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

           	<div id="tab2" class="tab-pane fade">                    
                <div class="row">
                <?php include("../inquiry_report/index.php"); ?>
                </div>
            </div>

            <div id="tab3" class="tab-pane fade">
                <div class="row">
                <?php include ("../app_report/index.php") ?>
                </div>
            </div>

            <div id="tab4" class="tab-pane fade">
            	<div class="row">
                	<?php include ("../unit_history/unithistory.php"); ?>
                </div>
            </div>

            <div id="tab5" class="tab-pane fade">
            	<div class="row">
                	<?php include ("../tenantshistory/tenantshistory.php"); ?>
                </div>
            </div>

            <div id="tab6" class="tab-pane fade">
            	<div class="row">
                	<?php include ("../salesaudit/index.php"); ?>
                </div>
            </div>

            <div id="tab7" class="tab-pane fade">
            	<div class="row">
                	<?php include ("../audittrail/index.php"); ?>
                </div>
            </div>
        </div>
    </div>
</div>	

<div class="modal fade" id="mdlFordaily">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				Daily Breakdown
			</div>

			<div class="modal-body">
				<div class="container-fluid">
					<div class="form-inline">
						<div class="form-group">
							<label class="control-label"><input type="radio" name="hourlySales" checked onclick="showList()"> <span class="fa fa-list"></span> List</label> &nbsp;
							<label class="control-label"><input type="radio" name="hourlySales" onclick="showLine()"><span class="fa fa-line-chart"></span> Graph</label>
						</div>
					</div>
					<div class="listHourly">
						<table class="table table-bordered">
							<thead>
								<th>Date</th>
								<th>Time</th>
								<th>Amount</th>
							</thead>

							<tbody id="perhourtbl"></tbody>
						</table>
					</div>

					<div class="col-md-12">
						<center>
							<div id="graphHourly" style="display:none;">
								
							</div>
						</center>
					</div>
						
				</div>
					
			</div>

			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="loadingSync" data-backdrop="static" style="margin-top: 20% !important;">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				Loading. Please wait while files are syncing...
			</div>
			<div class="modal-body row">
				<div class="container-fluid">
					<center>
						<span class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size: 80px;"></span>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAlert">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				System Alert
			</div>

			<div class="modal-body">
				<center><h3 id="alertStat">Time has been set. . .</h3></center>
			</div>

			<div class="modal-footer">
				<button class="btn btn-info" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span> OK</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="searchTenat" data-backdrop="static">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				Select Store Name
			</div>

			<div class="modal-body">
				<div style="min-height: 300px;">
					<div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control" id="txtSearchTenant" onkeyup="displayTenants2()" title="Search according to filter selected">
							<label class="input-group-addon"><span class="glyphicon glyphicon-search"></span></label>
						</div>
					</div>
					<table class="table table-bordered table-striped">
						<thead>
							<th>Store Name</th>
						</thead>
						<tbody id="tblTenants"></tbody>
					</table>
				</div>

				<div class="btn-group">
					<button class="btn btn-info btn-page btn-page-1" onclick="pageTenant('first')"><span class="glyphicon glyphicon-fast-backward"></span></button>
					<button class="btn btn-info btn-page btn-page-1" onclick="pageTenant('prev')"><span class="glyphicon glyphicon-backward"></span></button>
					<button class="btn btn-info btn-page btn-page-2" onclick="pageTenant('next')"><span class="glyphicon glyphicon-forward"></span></button>
					<button class="btn btn-info btn-page btn-page-2" onclick="pageTenant('last')"><span class="glyphicon glyphicon-fast-forward"></span></button>
				</div>
				<input type="hidden" id="countTenants">
			</div>

			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade">
<span id="tooltip_contentlaman">Search according to filter selected</span>
</div>


<input type="hidden" id="selectedTenant">
<input type="hidden" id="tenantName">
<?php include ("../tenantsalesreport/script.php"); ?>
<?php include ("../tenantsalesreport/script2.php"); ?>
<?php include ("../tenantsalesreport/monthly-script.php"); ?>