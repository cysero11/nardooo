<div id="reportcontainer" style="margin-top: 10px; display: none;">
	<center>
	<div class="checklist" id="div_form_complaints" style="margin-top: 20px; width: 99%;margin-bottom: 0;">
		<center>
			<table cellspacing="0" style="padding: 5px; width: 95%">
				<tr><td colspan="2" align="center"><div style="width: 100%; text-align: left;">
					<table style="width: 100%;" cellspacing="0" cellpadding="0">
						<tbody id="template"></tbody>
					</table>
				</div></td></tr>
				<tr><td align="right"><p style="font-size:; 12px; margin-top: 5px;">From:&nbsp;&nbsp;<label id="dateFrom2"></label>&nbsp;&nbsp;To&nbsp;&nbsp;<label id="dateTo2"></label></p></td></tr>
				<tr><td colspan="2"><center><p style="font-size: 16px; font-weight: bold;background-color: #666;color: white;width: 100%;">Complaints</p></center></td></tr>
				<tr>
					<td colspan="2">
						<center>
							<table style="width: 100%;"> 
								<thead>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Tenant ID</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Date Entry</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Complaint Code</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Complaint Description</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Customer Name</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Company</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Unit Number</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Date Received</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Date Resolved</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Duration</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Resolved By</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Complaint Status</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;">Priority Status</th>
										<th style="border-left: 1px solid black;border-bottom: 1px solid;border-right: 1px solid;">User ID</th>
								</thead>
							<tbody id="contentngcomplaints"></tbody>
							</table>
						</center>
					</td>
				</tr>
			</table>
		</center>
	</div>
	</center>
</div>

<div id="printcomplaint" style="display: none;">
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tbody id="template2"></tbody>
    </table>
    <center style="font-size: 32px;font-weight: bold;border-bottom: 3px solid black;width: 100%;">Tenant Complaint Form</center>
    <center style="width: 100%;background-color: #666;color: white;margin-top: 10px;">Tenant Information</center>
    <table style="width: 100%;border: 1px solid;">
    	<tbody>
	    	<tr>
	    		<td style="width: 50%;"><b>Trade Name: </b><label id="printcomplainttradename"></label></td>
	    		<td style="border-left: 1px solid;width: 50%;"><b>Tenant ID: </b><label id="printcomplainttenantid"></label></td>
	    	</tr>
	    	<tr>
	    		<td style="width: 50%;border-top: 1px solid;"><b>Mall Name: </b><label id="printcomplaintmallname"></label></td>
	    		<td style="border-left: 1px solid;width: 50%;border-top: 1px solid;"><b>Wing Name: </b><label id="printcomplaintwingname"></label></td>
	    	</tr>
	    	<tr>
	    		<td style="width: 50%;border-top: 1px solid;"><b>Floor Name: </b><label id="printcomplaintfloorname"></label></td>
	    		<td style="border-left: 1px solid;width: 50%;border-top: 1px solid;"><b>Unit Name: </b><label id="printcomplaintunitname"></label></td>
	    	</tr>
    	</tbody>
    </table>

    <center style="width: 100%;background-color: #666;color: white;margin-top: 10px;">Complaint Information</center>
    <table style="width: 100%;border: 1px solid;">
    	<tbody>
	    	<tr>
	    		<td style="width: 50%;"><b>Complaint Date: </b><label id="printcomplaintcomplaintdate"></label></td>
	    		<td style="border-left: 1px solid;width: 50%;"><b>Complaint Taken By: </b><label id="printcomplaintusername"></label></td>
	    	</tr>
	    	<tr>
	    		<td colspan="2" style="width: 50%;border-top: 1px solid;"><b>Complaint Code: </b><label id="printcomplaintcomplaintcode"</label></td>
	    	</tr>
	    	<tr>
	    		<td colspan="2" style="width: 50%;border-top: 1px solid;height: 100px;vertical-align: top;"><b>First Response Corrective Action: </b><label></label></td>
	    	</tr>
	    	<tr>
	    		<td colspan="2" style="width: 50%;border-top: 1px solid;height: 100px;vertical-align: top;"><b>Suspected Cause: </b><label id="printcomplaintdescription"></label></td>
	    	</tr>
	    	<tr>
	    		<td colspan="2" style="width: 50%;border-top: 1px solid;height: 40px;vertical-align: top;"><b>Corrective Action Person(s): </b><label id="printcomplaintassignedperson"></label></td>
	    	</tr>
	    	<tr>
	    		<td colspan="2" style="width: 50%;border-top: 1px solid;height: 40px;vertical-align: top;"><b>Corrective Action Follow-up: </b><label></label></td>
	    	</tr>
	    	<tr>
	    		<td colspan="2" style="width: 50%;border-top: 1px solid;height: 100px;vertical-align: top;"><b>What steps should be considered to avoid a repeat of the problem: </b><label></label></td>
	    	</tr>
    	</tbody>
    </table>

    <table style="margin-top: 30px;">
    	<tr>
    		<td>
    			<label style="border-top: 1px solid;">Name of person completing this form</label>
    		</td>
    		<td align="right">
    			<label style="border-top: 1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
    		</td>
    	</tr>
    </table>
</div>

<div id="allhouserulesviolations" style="display: none;">
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tbody id="template3"></tbody>
    </table>
    <p style="text-align: right;">
    	<span style="font-weight: 700;">Violation Level :</span>&nbsp;&nbsp;
        <span class="fa fa-circle" style="color: #F89406;"></span> 1st Offense&nbsp;&nbsp;
        <span class="fa fa-circle" style="color: #D6487E;"></span> 2nd Offense&nbsp;&nbsp;
        <span class="fa fa-circle" style="color: #D15B47;"></span> 3rd Offense&nbsp;&nbsp;
        <span class="fa fa-circle" style="color: black;"></span> More than 3 Offense
    </p>
	<p style="font-size:; 12px; margin-top: 5px;text-align: right;">From:&nbsp;&nbsp;<label id="dateFromhrprint"></label>&nbsp;&nbsp;To&nbsp;&nbsp;<label id="dateTohrprint"></label></p>
    <center style="font-weight: bold;background-color: #666;color: white;width: 100%;">House Rules Violator's List</center>
    <table style="width: 100%;">
        <thead>
            <th style="border-left:1px solid;border-bottom: 1px solid;border-top: 1px solid;">Violation Series Number</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;border-top: 1px solid;">Tenant/Employee Name</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;border-top: 1px solid;">Violation/s</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;border-top: 1px solid;">Date</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;border-top: 1px solid;">Time</th>
            <th style="border-left:1px solid;border-bottom: 1px solid;border-right: 1px solid;border-top: 1px solid;">Status</th>
        </thead>
        <tbody id="listofviolatorstoprint"></tbody>
    </table>
</div>

<div id="notificationofviolation" style="display: none;">
    <table style="width: 100%;" cellspacing="0" cellpadding="0">
        <tbody id="template4"></tbody>
    </table>
    <center style="font-weight: bold;background-color: #666;color: white;width: 100%;font-size: 32px;margin-top: 10px;">Notification of Violation</center>
    <table style="width: 100%;">
    	<tr>
    		<td style="width: 50%;"><b>Violation Series Number: </b><label id="txtvsn">VHR-0000041</label></td>
    	</tr>
    	<tr>
    		<td style="width: 50%;"><b id="ptxttn">Tenant Name: </b><label id="txttn">Jonas</label></td>
    		<td style="width: 50%;"><b>Date: </b><label id="txtd">October 8, 1993</label></td>
    	</tr>
    	<tr>
    		<td style="width: 50%;"><b id="ptxtun">Unit No.: </b><label id="txtunitnumbernanagiiba">SHJAS</label></td>
    		<td style="width: 50%;"><b>Time: </b><label id="txtt">10:00 AM</label></td>
    	</tr>
    </table>
    <table style="width: 100%;">
        <thead>
            <td style="border-bottom: 1px solid;border-top: 1px solid;border-right: 1px solid;">Violation</td>
            <td style="border-bottom: 1px solid;border-top: 1px solid;">Violation Level</td>
            <td style="border-bottom: 1px solid;border-top: 1px solid;border-left: 1px solid;">Fine</td>
        </thead>
        <tbody id="tblnotificationofviolation"></tbody>
    </table>
</div>