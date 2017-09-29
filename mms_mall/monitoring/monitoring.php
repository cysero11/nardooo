<?php include "script.php"; ?>
<div class="page-header" style="margin-bottom: 10px;padding-top:10px;background-color: #edf4f8;padding-bottom: 35px;">
	<div class="col-md-6 col-xs-12" style="padding-left: 0px!important;">
		<h1><b>FILE MONITORING</b></h1>
		<input type="hidden" id="synctype">
		<input type="hidden" id="txtreservationpages" name="">
	</div>
</div>

<div class="container-fluid">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Files Synced
		</div>

		<div class="panel-body">
			<div class="container-fluid">
				<div class="col-md-12">
					<div class="form-horizontal">
						<!-- <div class="form-group">
							<div class="btn-group">
								<button class="btn btn-warning"><span class="glyphicon glyphicon-warning-sign"></span> Select Incomplete Files</button>
							</div>
						</div> -->

						<div class="form-group">
							<label class="control-label col-md-12" style="text-align: left;">Filter</label>
							<div class="col-md-3">
								<div class="input-group">
									<input type="text" class="form-control" id="tenantName" placeholder="Search" title="Search according to filter selected">
									<label class="input-group-addon"><span class="glyphicon glyphicon-search"></span></label>
								</div>
							</div>

							<div class="col-md-9">
								<label class="control-label col-md-2">Date Range</label>
								<div class="col-md-3">
									<div class="input-group">
										<input type="text" class="form-control date-picker" id="dateFrom" value="<?php echo date('m/d/Y'); ?>">
										<label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="input-group">
										<input type="text" class="form-control date-picker" id="dateTo" value="<?php echo date('m/d/Y'); ?>">
										<label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
									</div>
								</div>

								<div class="col-md-2">
									<select class="form-control" id="filterStat">
										<option value="">All</option>
										<option value="1">Complete</option>
										<option value="2">Incomplete</option>
									</select>
								</div>
								<button class="btn btn-info btn-sm" onclick="searchSync()"><span class="glyphicon glyphicon-search"></span> Go</button>
								<button class="btn btn-warning btn-sm" onclick="resetSync()"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
							</div>

						</div>
					</div>

					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="col-md-12 hidden-sm hidden-xs">
									<div class="col-md-1">
										<center>
											<div class="ace-settings-item">
												<input type="checkbox" class="ace ace-checkbox-2" id="maincheckbox" onclick="tsekanlahat()" />
												<label class="lbl" for="ace-settings-navbar"></label>
											</div>
										</center>
									</div>

									<div class="col-md-2 bg-primary" style="padding: 5px;">
										Transaction Date
									</div>

									<div class="col-md-3 bg-primary" style="padding: 5px;">
										Store Name
									</div>

									<div class="col-md-1 bg-primary" style="text-align: center; padding: 5px;">
										Sales
									</div>
									<div class="col-md-1 bg-primary" style="text-align: center; padding: 5px;">
										Discount
									</div>
									<div class="col-md-1 bg-primary" style="text-align: center; padding: 5px;">
										Void
									</div>
									<div class="col-md-1 bg-primary" style="text-align: center; padding: 5px;">
										Sales/Hour
									</div>
									<div class="col-md-1 bg-primary" style="text-align: center; padding: 5px;">
										Types
									</div>
									<div class="col-md-1 bg-primary" style="text-align: center; padding: 5px;">
										Penalty
									</div>
								</div>

								<div class="hidden-lg hidden-md">
									<span class="glyphicon glyphicon-list"></span> Details
								</div>
							</div>
						</div>

						<div class="panel-body" style="min-height: 300px;">
							<div class="container-fluid">
								<div id="syncbody">
								
								</div>
							</div>
						</div>

						<div class="panel-footer">
							<div class="container-fluid">
								<button onclick="page('first')" class="btn btn-default btn-page btn-page-1"><span class="glyphicon glyphicon-fast-backward"></span></button>
								<button onclick="page('prev')" class="btn btn-default btn-page btn-page-1"><span class="glyphicon glyphicon-backward"></span></button>
								<button onclick="page('next')" class="btn btn-default btn-page btn-page-2"><span class="glyphicon glyphicon-forward"></span></button>
								<button onclick="page('last')" class="btn btn-default btn-page btn-page-2"><span class="glyphicon glyphicon-fast-forward"></span></button>

								<button class="btn btn-warning pull-right" onclick="postPenalty()"><span class="fa fa-paperclip"></span> Post Penalty</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" id="forPenalty">

		<div class="panel-footer">
			<button class="btn btn-success" title="Set time of syncing files" onclick="modal_opensettingTIme()"><span class="glyphicon glyphicon-cog"></span> Setup</button>
			<button class="btn btn-warning" onclick="savecsv()"><span class="fa fa-list"></span> Sync Files</button>
		</div>

		<input type="hidden" id="countid">
	</div>
</div>

<div class="modal fade" id="settingTIme">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				Monitoring Setup
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li class="active thistab">
                                    <a data-toggle="tab" href="#synctime" style="color: black; font-weight: bold">
                                        <i class="green ace-icon fa fa-clock-o bigger-120"></i>
                                      Syncing Time
                                    </a>
                                </li>

                                <li class="thistab">
                                    <a data-toggle="tab" href="#syncdate" style="color: black; font-weight: bold">
                                        <i class="green ace-icon glyphicon glyphicon-calendar bigger-120"></i>
                                      Syncing Date
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane fade in active" id="synctime">
                                	<div class="row">
										<div class="col-md-4">
											<select id="hours" class="form-control">
												<?php
													for ( $a = 1; $a<=12; $a++ ) {
														?>
															<option value="<?php echo $a; ?>"><?php echo str_pad($a, 2, 0, STR_PAD_LEFT); ?></option>
														<?php
													}
												?>
											</select>
										</div>
										<div class="col-md-4">
											<select id="mins" class="form-control">
												<?php
													for ( $b = 0; $b<=59; $b++ ) {
														?>
															<option value="<?php echo str_pad($b, 2, 0, STR_PAD_LEFT); ?>"><?php echo str_pad($b, 2, 0, STR_PAD_LEFT); ?></option>
														<?php
													}
												?>
											</select>
										</div>
										<div class="col-md-4">
											<select id="ampm" class="form-control">
												<option value="am">am</option>
												<option value="pm">pm</option>
											</select>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="syncdate">
									<div class="row">
										<div class="col-xs-12">
											<div class="col-md-3">
												<input type="radio" id="daterange" name="synctype" value="1" class="synctype">Date Range
											</div>
											<div class="pull right">
												<div class="col-md-4">
													<div class="input-group">
														<input type="text" class="form-control date-picker" id="dateFromsync" value="<?php echo date('m/d/Y'); ?>">
														<label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
													</div>
												</div>
												<div class="col-md-4">
													<div class="input-group">
														<input type="text" class="form-control date-picker" id="dateTosync" value="<?php echo date('m/d/Y'); ?>">
														<label class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12">				
											<div class="col-md-3">
												<input type="radio" id="datetodaysync" name="synctype" value="2" class="synctype">Date Today	
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
				<button class="btn btn-success" onclick="saveTime()"><span class="glyphicon glyphicon-save"></span> Save</button>
				<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
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

<div class="modal fade" data-backdrop="static" id="syncFiles2">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<b>Sync File Manualy</b>
			</div>

			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>