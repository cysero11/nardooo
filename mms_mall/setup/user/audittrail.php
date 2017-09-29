<script>
	$(function(){
		$(".cont").niceScroll({ cursorcolor: "#666", width: "8px" });
		$("#audittable").click(function(){
			var obj = $(this);
			$("#auditlist").tablenav("auditlist", "auditcont", obj);
		});
	});
</script>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-sm-3">
        <div class="input-group">
            <input type="text" class="form-control" id="txtauditdate" placeholder="mm/dd/YYYY" data-provide="datepicker">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>
</div>
<div id="audittable">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 10%;">Date</th>
                <th style="width: 10%;">Time</th>
                <th style="width: 60%;">Remarks</th>
                <th style="width: 20%; border-right: solid 1px #dddddd;">Module</th>
            </tr>
        </thead>
    </table>
    <div class="cont" id="auditcont" style="height: 320px; margin-top: -20px; overflow-x: hidden; overflow-y: hidden;">
        <div class="overlay" id="overlay2"></div>
        <table class="table table-bordered table-hover">
            <tbody id="auditlist">
            <?php
				$getaudit = "select logID, userid, username, mydate, mytime, remarks, module from tbllogs_trans";
				$auditresult = mysql_query($getaudit);
				while($audit = mysql_fetch_array($auditresult))
				{
					echo "
					<tr id='" . $audit[0] . "'>
						<td style='width: 10%;'>" . date("m/d/Y", strtotime($audit[3])) . "</td>
						<td style='width: 10%;'>" . date("h:i A", strtotime($audit[4])) . "</td>
						<td style='width: 60%;'>" . $audit[5] . "</td>
						<td style='width: 20%;'>" . $audit[6] . "</td>
					</tr>
					";
				}
			?>
            </tbody>
        </table>
    </div>
</div>