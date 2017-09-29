<div class="container-fluid modules" id="main_HouseRules" style="display:none;">
	<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="container-fluid">
								<div class="form-horizontal">  <!-- search keyword -->
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
											<input type="text" class="form-control" id="txtsearchHouseRulesCat" onkeyup="showmainHouseRules()">
										</div>
									</div>
								</div> <!-- end -->
							</div>
						</div>

						<div class="panel-body" style="min-height: 300px;">
							<div class="container-fluid">
								<table class="table">
									<thead>
										<th>Code</th>
										<th>Violation</th>
										<th>1st Offense</th>
										<th>2nd Offense</th>
										<th>3rd Offense</th>
										<th>Succeeding</th>
									</thead>

									<tbody id="tblHouseRules" class="refsss"></tbody>
								</table>
							</div>
						</div>

						<div class="panel-footer">
							<button id="btn-first542" onclick="page542('first')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-backward"></span></button>
							<button id="btn-prev542" onclick="page542('prev')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-backward"></span></button>
							<button id="btn-next542" onclick="page542('next')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-forward"></span></button>
							<button id="btn-last542" onclick="page542('last')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fast-forward"></span></button>
						</div>
					</div>

					<hr/>

					<div class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3"> Code:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtHouseRules" id="txtHouseRulesCode" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Violation:</label>
							<div class="col-md-3 col-lg-9">
								<textarea class="form-control txtHouseRules" readonly style="resize: none;" id="txtHouseRulesViolation"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">1st Offense:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtHouseRules" id="txtHouseRules1stoffense" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">2nd Offense:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtHouseRules" id="txtHouseRules2ndoffense" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">3rd offense:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtHouseRules" id="txtHouseRules3rdoffense" readonly>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-lg-3">Succeeding:</label>
							<div class="col-md-3 col-lg-9">
								<input type="text" class="form-control txtHouseRules" id="txtHouseRulesSucceeding" readonly>
							</div>
						</div>

					</div>

					<div class="btn-group pull-left" id="buttonsHouseRulesCat">
						<button class="btn btn-primary" onclick="clickAddHouseRulesCat()"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
						<button class="btn btn-success" onclick="clickUpdateHouseRulesCat()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
						<button class="btn btn-danger" onclick="clickDeleteHouseRulesCat()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="savingbuttonsHouseRulesCat">
						<button class="btn btn-success" onclick="saveHouseRules()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonHouseRulesCat()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>

					<div class="btn-group pull-left" style="display: none;" id="updatebuttonsHouseRulesCat">
						<button class="btn btn-success" onclick="updateHouseRulesCat()"><span class="glyphicon glyphicon-save"></span> Save</button>
						<button class="btn btn-danger" onclick="cancelbuttonHouseRulesCat2()"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
					</div>
</div>

<input type="hidden" id="HouseRulescatcounts">
<input type="hidden" id="hiddenequipcatid">
