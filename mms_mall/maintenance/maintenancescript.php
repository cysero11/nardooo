<script>
//<<<<<<<<<<<<<<<<<<<<<<<<<<<<MAINTENANCE SCRIPTS>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
setTimeout(function(){
    $(".fixTable").tableHeadFixer(); 
	$("#txt_userpagejo").val("1");
    showtenantlist();
    showwoperson();
    tblworkorder();
	showwodep();
    tblbudget();
    showtypeofbudget();
    showwomanagementlist();
    $("#billedyes").click();
    $('[data-rel=tooltip]').tooltip();
    $('[data-rel=popover]').popover({html:true});
	$(".durationsdsdsd").change(function(){
       		var x = ($(this).val()).replace(/,/g,"");
            var v = parseFloat(x||0);
            $(this).val(v.toFixed(1).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
       });
	$(".halaga").change(function(){
       		var x = ($(this).val()).replace(/,/g,"");
            var v = parseFloat(x||0);
            $(this).val(v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
       });

    $(".date-picker").datepicker({
        autoHide: true,
        format: 'mm/dd/yyyy',
        todayHighlight: true
    });

    $(".numberlang").keydown(function (e){ 
		if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || 
		(e.keyCode == 65 && e.ctrlKey === true) ||  
		(e.keyCode >= 35 && e.keyCode <= 40)) { 
		 return;
	} 
		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
	});

    checkDate2();
    checkDate3();

    }, 500)

$(function(){
	$("#txt_userpagejo").val("1");
	loadentriesjo();
	loadfilters_maintenance('Maintenance');
	// jocalendar();
	// var arrdata = JSON.parse(jocalendar());

	// var data = arrdata;

	// $('#kalendaryo').fullCalendar({
	// 		header: {
	// 			left: 'today',
	// 			center: 'prevYear, prev, title, next, nextYear',
	// 			right: 'month,basicWeek,agendaDay,listWeek'
	// 		},
	// 		views: {
	// 			month: { buttonText: 'Month' },
	// 			basicWeek: { buttonText: 'Week' },
	// 			agendaDay: { buttonText: 'Day' },
	// 			listWeek: { buttonText: 'List View Per Week' }
	// 		},
	// 		defaultDate: '2017-04-12',
	// 		nowIndicator:  true,
	// 		navLinks: true, // can click day/week names to navigate views
	// 		// selectable: true,
	// 		selectHelper: true,
	// 		select: function(start, end) {
	// 			var title = prompt('Event Title:');
	// 			var eventData;
	// 			if (title) {
	// 				eventData = {
	// 					title: title,
	// 					start: start,
	// 					end: end
	// 				};
	// 				$('#kalendaryo').fullCalendar('renderEvent', eventData, true); // stick? = true
	// 			}
	// 			$('#kalendaryo').fullCalendar('unselect');
	// 		},
	// 		height: 400,
	// 		editable: false,
	// 		eventLimit: true, // allow "more" link when too many events
	// 		events: data
	// 	});
});

	function tblworkorder(){
		var dateFrom = $("#dateFrom3").val();
		var dateTo = $("#dateTo3").val();
		var key = $("#txtsearchmaintenance").val();
		var page = $("#txt_userpagejo").val();
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&key=' + key + '&page=' + page + '&form=tblworkorder',
			beforeSend : function() {
		       $('#indexloadingscreen').addClass('myspinner');
		    },
		    success: function(data){
        		$('#indexloadingscreen').removeClass('myspinner');
		    	$("#tblworkorder").html(data);	
				loadentriesjo();
		        loadpagejo();
		    }
		})
	}

	function loadentriesjo(){
	    var page = $("#txt_userpagejo").val();
	    var dateFrom = $("#dateFrom3").val();
	    var dateTo = $("#dateTo3").val();
	    var txtsearchmaintenance = $("#txtsearchmaintenance").val();
	    $.ajax({
	        type: 'POST',
	        url: 'maintenance/class.php',
	        data: 'txtsearchmaintenance=' + txtsearchmaintenance + '&page=' + page + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=loadentriesjo',
	        success: function(data){
	            if(data == ""){
	                $("#txtjoentries").text("");
	            }
	            else{
	                $("#txtjoentries").text(data);
	            }
	        }
	    });
	}

	function loadpagejo(){
	    var page = $("#txt_userpagejo").val();
	    var dateFrom = $("#dateFrom3").val();
	    var dateTo = $("#dateTo3").val();
	    var txtsearchmaintenance = $("#txtsearchmaintenance").val();
	    $.ajax({
	        type: 'POST',
	        url: 'maintenance/class.php',
	        data: 'txtsearchmaintenance=' + txtsearchmaintenance + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&page=' + page + '&form=loadpagejo',
	        success: function(data){
	            $("#ulpaginationjo").html(data);
	        }
	    });
	}

    function paginationjo(pagejo, pagenumsjo){
        $(".pgnumjo").removeClass("active");
        var value = "#" + pagenumsjo;
        $("#pgjo" + pagenumsjo).addClass("active");
        $("#txt_userpagejo").val(pagejo);
        // joblist();
        loadentriesjo();
        loadpagejo();
    }

	function ViewWOdetailed(workorderid, tenantid, formanagement, taskstatus, csn, postat, dep){
		if(taskstatus == "Resolved"){
			$(".btnforscheduling").prop("disabled", true);
			$("#detailedWOResolve").prop("disabled", true);
			$("#buttonforpostingtobilling").css("display", "inline");
		}else{
			$(".btnforscheduling").prop("disabled", false);
			$("#detailedWOResolve").prop("disabled", false);
			$("#buttonforpostingtobilling").css("display", "none");
		}
		if(postat == "Not Posted"){
			$("#buttonforpostingtobilling").text("Post To Billing");
			$("#buttonforpostingtobilling").prop("disabled", false);
		}else{
			$("#buttonforpostingtobilling").text("Posted To Billing");
			$("#buttonforpostingtobilling").prop("disabled", true);
		}
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'workorderid=' + workorderid + '&tenantid=' + tenantid + '&formanagement=' + formanagement + '&form=ViewWOdetailed',
			success:function(data){
				var arr = data.split("|");
				if(tenantid != "" && formanagement == ""){
					$("#modaljoseries").text(workorderid);
					$("#modaltenantid").text(tenantid);
					$("#modalcompanyname").text(arr[0]);
					$("#modalbranchname").text(arr[2]);
					$("#modalwingname").text(arr[3]);
					$("#modalfloor").text(arr[4]);
					$("#modalunitnumber").text(arr[1]);
					$("#modalworkername").text(arr[5]);
					wodetailedwoi(workorderid, csn);
					$("#WODheader").text("Tenant Information");
					$("#div_pagtenant").css("display", "block");
					$("#div_pagmanagement").css("display", "none");
				}else{
					$("#modaljoseries2").text(workorderid);
					$("#WODheader").text("Information");
					$("#div_pagtenant").css("display", "none");
					$("#div_pagmanagement").css("display", "block");
					$("#modalbranchname2").text(arr[1]);
					$("#modalfloor2").text(arr[0]);
					$("#modalworkername2").text(arr[2]);
					wodetailedwoi(workorderid, '');
				}
			}
		})
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'workorderid=' + workorderid + '&form=thiswilldetermineeverythingthatishappeningtoyourlife',
			success:function(data){
				if(data == "Pending"){
					$("#detailedWOResolve").css("display", "none");
				}else if(data == "Resolved"){
					$("#detailedWOResolve").css("display", "inline");
				}else{
					$("#detailedWOResolve").css("display", "none");
				}
			}
		})
		$("#wodep").val(dep);
		showwopersonnel(dep);
	}

	function wodetailedwoi(workorderid, csn){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'workorderid=' + workorderid + '&csn=' + csn + '&form=wodetailedwoi',
			success:function(data){
				$("#detailedWO").modal("show");
				$("#wodetailedwoicontainer").html(data);
			}
		})
	}

	function checkDate2() {
        $("#dateTo2").blur(function(){
            var dateFrom = $("#dateFrom2").val().toString();
            var dateTo = $("#dateTo2").val().toString();
            if ( dateTo == "" ) {

            }

            else {
                if ( dateTo < dateFrom ) {
                    showmodal("alert", "The second date must not be less than the first.", "closeallmodal", null, "", null, "1");
                    $("#dateTo2").val("");

                    checkDate2();
                }
            }
        })
	}
    
    function checkDate3() {
        $("#dateTo3").blur(function(){
            var dateFrom = $("#dateFrom3").val().toString();
            var dateTo = $("#dateTo3").val().toString();
            if ( dateTo == "" ) {
            }
            else {
                if ( dateTo < dateFrom ) {
                    showmodal("alert", "The second date must not be less than the first.", "", null, "", null, "1");
                    $("#dateTo3").val("");
                    checkDate3();
                }
            }
        })
    }

	function displayngimageutangnaloob(){
		var stafftask = $("#stafftask").val();
			$.ajax({
				type: 'POST',
				url: 'maintenance/class.php',
				data: 'stafftask=' + stafftask +'&form=displayngimageutangnaloob',
			success: function(data)	{
				$("#displayngimage").html(data);
			}
		});
	}

    function loadfilters_maintenance(module){
        $.ajax({
            type: 'POST',
            url: 'maintenance/class.php',
            data: 'module=' + module + '&form=loadfilters_maintenance',
            success: function(data){
            	var datas = data.split("#");
                var arr = datas[0].split("|");
                var arr2 = datas[1].split("|");
                var arr3 = datas[2].split("|");
                $("#dateentrystart").val(arr3[0]);
				$("#dateentryend").val(arr3[1]);
                for(var i=0; i<=arr.length-2; i++){
                    $('input:checkbox[id="filter_'+arr[i]+'"][value="'+arr[i]+'"]').attr('checked', 'checked');
                    // alert(arr[i]);
                }
                for(var i=0; i<=arr2.length-1; i++)
                {
                    $('input:checkbox[id="filter_'+arr2[i]+'"][value="'+arr2[i]+'"]').attr('checked', 'checked');
                }
                // joblist();
                tblworkorder();
            }
        })
    }

    function savemaintenancefilter(){
        var module = "Maintenance";
        var checked = "";
        $('input:checkbox[name="form-field-checkboxxxxxxx"]').each(function(){
            if($(this).is(":checked")){
                var value = $(this).attr("value");
                checked += value + "|";
            }
        })

        var checked2 = "";
        $('input:checkbox[name="form-field-checkboxxxxxxx"]').each(function(){

                var value2 = $(this).attr("value");
                checked2 += value2 + "|";
        })

        var checked3 = "";
        $('input:checkbox[name="form-field-checkboxstatussssss"]').each(function(){
        	if($(this).is(":checked")){
                var value3 = $(this).attr("value");
                checked3 += value3 + "|";
            }
        })       
        var datefrom = $("#dateentrystart").val();
		var dateto = $("#dateentryend").val();
        $.ajax({
            type: 'POST',
            url: 'maintenance/class.php',
            data: 'module=' + module + '&checked=' + checked + '&checked2=' + checked2 + '&checked3=' + checked3 + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=savemaintenancefilter',
            success: function(data){
                loadfilters_maintenance(module);
                $("#LINK_maintenance_filter").click();
            }
        })
    }

 //    function jocalendar() {
	// 	var arr = '';
	// 	$.ajax({
	// 		type:'POST',
	// 		async:false,
	// 		url:'maintenance/class.php',
	// 		data: 'form=jocalendar', 
	// 		success:function(data){
	// 			arr = data; 
	// 		}
	// 	}); 

	// 	return arr;
	// }

	function cancelJO(JON){
		showmodal("confirm", "Are you sure?.", "cancelJO2(\""+JON+"\")", null, "", null, "1");
	}

	function cancelJO2(deletemokokoya){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'deletemokokoya=' + deletemokokoya + '&form=cancelJO',
		success:function(data){
			if(data == "1"){
			setTimeout(function(){
				showmodal("alert", "Work order deleted.", "tblworkorder", null, "", null, "1");
			}, 100)
			}
			else{
				alert(data);
			}
		}
		})
	}

  var clicknav2 = 0;
    $(function(){
        $("#ace-settings-btn2").click(function(){
            if(clicknav2 == 0)
            {
                $(this).addClass("open");
                $("#interactiveicon2").removeClass("fa fa-chevron-circle-left");
                $("#interactiveicon2").addClass("fa fa-chevron-circle-right");
                $("#ace-settings-box2").addClass("open");
                clicknav2 = 1;
            }
            else
            {
                $(this).removeClass("open");
	            $("#interactiveicon2").removeClass("fa fa-chevron-circle-right");
	            $("#interactiveicon2").addClass("fa fa-chevron-circle-left");
                $("#ace-settings-box2").removeClass("open");
                clicknav2 = 0;
            }
        })

        // $('#modal_login_eod').on('shown.bs.modal', function() {
        //   $('#txtlogin_username').focus();
        // })
        
        loadlistsss()
    })

	function loadlistsss()
	{
		$.ajax({
	    	type: 'POST',
	    	url: 'maintenance/class.php',
	    	data: 'form=loadchklist',
	    	success: function(data)
	    	{
	    		$("#simple-table-2").html(data);
	    	}
	    })
	}

    function changestatoflist(id, eto)
    {
    	if(eto.is(":checked"))
    	{
    		var a = "1";
    	}
    	else
    	{
    		var a = "0";
    	}

    	$.ajax({
    		type: 'POST',
    		url: 'maintenance/class.php',
    		data: 'id='+id+'&a='+a+'&form=changestatoflist',
    		success: function(data)
    		{
    			loadlistsss()
    		}
    	})
    }

    function billedyes(){
        $("#Tenantshow").css("display", "block");
		$("#wotenantlist").css("display", "block");
		$("#Maintenanceshow").css("display", "none");
		$("#womanagementlist").css("display", "none");
    }

    function billedno(){
		$("#Tenantshow").css("display", "none");
		$("#wotenantlist").css("display", "none");
		$("#Maintenanceshow").css("display", "block");
		$("#womanagementlist").css("display", "block");
    }

    function showtenantlist(){
    	$.ajax({
    		type: 'POST',
    		url: 'maintenance/class.php',
    		data: 'form=showtenantlist',
    	success:function(data){
    			$("#wotenantlist").html(data);
    		}
    	})
    }
	
	function showwoperson(){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'form=showwoperson',
		success:function(data){
				$("#woperson").html(data);
			}
		})
	}

	function addwojob(){
		$("#addingofwojobmodal").modal("show");
		var val = "";
		var ctr = "";
		$('.hindinadapat').each(function(){
			var val = $(this).attr("value");
                ctr += val + "|";
		})
		showtblwojob(ctr);
	}

	function showtblwojob(val){
		var key = $("#txtsearchwojob").val();
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'key=' + key + '&val=' + val+ '&form=showtblwojob',
		success:function(data){
				$("#tblwojob").html(data);
			}
		})
	}

	function addwotask(){
		var ctr = $('.isjobadded:checked').size();
		if(ctr==1){
			$("table.catheader .isjobadded").each(function(){
				if ( $(this).is(":checked") == true ) {
					showtblwotask(this.value);
				}
			});
		}else if(ctr==0){
			showmodal("alert", "Select job first.", "", null, "", null, "1");
		}else{
			showmodal("alert", "Please select one item only.", "", null, "", null, "1");
		}
	}

	function showtblwotask(catid){
		var key = $("#txtsearchwotask").val();
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'key=' + key + '&catid=' + catid + '&form=showtblwotask',
		success:function(data){
				$("#addingofwotaskmodal").modal("show");
				$("#tblwotask").html(data);
			}
		})
	}

	function createjob(catid, catname){
		var catnum = $("#categorynumber").val();
		catnum = Number(catnum) + 1;
		$("#categorynumber").val(catnum)
		$('#jobordercontainer').append('<table class="table table-bordered catheader" id="cattasklist'+catnum+'" style="width: 100%;margin-bottom: 20px;">' +
											'<tr>' +
												'<th style="background-color: #666;" colspan="12"><input type="hidden" class="hindinadapat" value="'+catid+'"><input type="checkbox" class="isjobadded" name='+catid+"/"+"cattasklist"+catnum+' value='+catid+"/"+"cattasklist"+catnum+'>&nbsp;&nbsp;&nbsp;'+ catname +'</th>' +
											'</tr>' +
										'</table>');
		$("#wojobmodalclose").click();
	}

	function createtask(idnosss, taskid, taskname, amount, equipid, equipname){
		$("#trindex").val(idnosss);
		var idnos = $("#trindex").val();
		var trindex = $("#task"+idnos).index();
				if($("#task" + idnos).length==0){
				$("#"+idnos).append('<tr id="task'+idnos+'">' +
	                    '<th width="5%"><input type="checkbox" class="checkedheader '+idnosss+'" value="'+idnosss+'"></th>' +
	                    '<th>Task Name</th>' +
	                    '<th>Equipment</th>' +
	                    '<th width="20%">Amount</th>' +
	                '</tr>');

				var trindex = $("#task"+idnos).index();
				// alert(trindex);
				$("#"+idnos+" > tbody:last tr:eq("+trindex+")").after('<tr class"tbltasklist">' +
                        '<td><input type="checkbox" class="uncheck taskidhere '+idnosss+'" value="'+taskid+'" name="'+taskid+'"></td>' +
                        '<td>'+taskname+'</td>' +
                        '<td>'+equipname+'</td>' +
                        '<td>'+amount+'</td>' +
                    '</tr>');
			}else{

				var trindex = $("#"+idnos+" .tbltasklist:last").index();
				// alert(trindex);
				$("#"+idnos+" > tbody:last tr:eq("+trindex+")").after('<tr class"tbltasklist">' +
                        '<td><input type="checkbox" class="uncheck taskidhere '+idnosss+'" value="'+taskid+'" name="'+taskid+'"></td>' +
                        '<td>'+taskname+'</td>' +
                        '<td>'+equipname+'</td>' +
                        '<td>'+amount+'</td>' +
                    '</tr>');
			}



		$("#wotaskmodalclose").click();
		$("#trindex").val("");
	}

	function removechecksacheckbox(){
		$(".uncheck").prop('checked',false);
	}

	function deletechecked(){
		var ctr = $('input.isjobadded:checked').size();
		var ctr2 = $('input.checkedheader:checked').size();
		var ctr3 = $('input.uncheck:checked').size();
		if(ctr > 0 ){
			if(ctr==1){
			// $("table.catheader .uncheck").each(function(){
			// 	if ( $(this).is(":checked") == true ) {
			// 		$(this).closest('tr').remove();
			// 	}
			// });
			$("table.catheader .isjobadded").each(function(){
				if ( $(this).is(":checked") == true ) {
					var arr = $(this).val().split("/");
					$("#"+arr[1]).remove();
				}
			});
			}else{
				showmodal("alert", "Please select one item only to delete or click the reset button.", "", null, "", null, "1");
			}
		}
		else if(ctr2 > 0){
			if(ctr2==1){
				// $("table.catheader .uncheck").each(function(){
				// 	if ( $(this).is(":checked") == true ) {
				// 		$(this).closest('tr').remove();
				// 	}
				// });
				$("table.catheader .checkedheader").each(function(){
					if ( $(this).is(":checked") == true ) {
						$("."+$(this).val()).closest('tr').remove();

					}
				});
			}else{
				showmodal("alert", "Please select one item only to delete or click the reset button.", "", null, "", null, "1");
			}
		}
		else if(ctr3 > 0){
			if(ctr3==1){
				// $("table.catheader .uncheck").each(function(){
				// 	if ( $(this).is(":checked") == true ) {
				// 		$(this).closest('tr').remove();
				// 	}
				// });
				$("table.catheader .uncheck").each(function(){
					if ( $(this).is(":checked") == true ) {
						$(this).closest('tr').remove();
					}
				});
			}else{
				showmodal("alert", "Please select one item only to delete or click the reset button.", "", null, "", null, "1");
			}
		}
	}

	// function akonalang(){
	// 	$("table.catheader .checkedheader").each(function(){
	// 		if ( $(this).is(":checked") == true ) {
	// 			$("."+$(this).prop('checked', true);
	// 	});
	// }

	function savenewworkorder(){
		var wotenant = $("#wotenantlist").val();
		var woperson = $("#woperson").val();
		var woremarks = $("#woremarks").val();
		var womanagementlist = $("#womanagementlist").val();
		var jobordercontainer = $("#jobordercontainer").html();
		var workorder = "";
		$("table.catheader").each(function(){
			$("#"+this.id+" .isjobadded").each(function(){
				if(this.value!=""){
					workorder +="|" +this.value;
				}
			});
			$("#"+this.id+" .taskidhere").each(function(){
				if(this.value!=''){
					workorder +="@" +this.value;
				}
			});
		});
		if(jobordercontainer != ""){
			if(woperson != ""){
				if((wotenant != "" && womanagementlist == "") || (wotenant == "" && womanagementlist != "")){
						$.ajax({
							type: 'POST',
							url: 'maintenance/class.php',
							data: 'wotenant=' + wotenant + '&woperson=' + woperson + '&woremarks=' + woremarks + '&WorkOrderModal=' + workorder + '&womanagementlist=' + womanagementlist + '&form=savenewworkorder',
						beforeSend : function() {
					       	$('#indexloadingscreen').addClass('myspinner');
					    },
						    success: function(data){
					        $('#indexloadingscreen').removeClass('myspinner');
								showmodal("alert", "Work order saved.", "clearingoftextboxifsuccess", null, "", null, "0");
							}
						})
				}else{
					showmodal("alert", "Please where to bill the work order.", "", null, "", null, "0");
				}
			}else{
				showmodal("alert", "Please assign a person to do the work order.", "", null, "", null, "0");
			}
		}else{
			showmodal("alert", "Please select a task.", "", null, "", null, "0");
		}
	}

	function clearingoftextboxifsuccess(){
		$("#wotenantlist").val("");
		$("#woperson").val("");
		$("#woremarks").val("");
		$("#womanagementlist").val("");
		$("#jobordercontainer").html("");
	}

	function showschedule(catid, taskid, workorderid, header, taskstatus, id){
		$("#schedlineids").val(catid+"|"+taskid+"|"+workorderid+"|"+id);
		$("#taskschedulertext").text(header);
		$("#taskscheduler").modal("show");
		if(taskstatus == "Resolved"){
			$("#taskscheduler input").prop("disabled", true);
			$(".taskschedulerbtn").prop("disabled", true);
		}else if(taskstatus == "Pending"){
			$("#taskscheduler input").prop("disabled", false);
			$(".taskschedulerbtn").prop("disabled", false);
		}else{
			$("#taskscheduler input").prop("disabled", false);
			$(".taskschedulerbtn").prop("disabled", false);
		}
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'catid=' + catid + '&taskid=' + taskid + '&workorderid=' + workorderid + '&form=showschedule',
			success:function(data){
				var arr = data.split("|");
				$("#tbodyschedline").html(arr[0]);
				$(".schedlinestat").each(function(){
					if($(this).val() == arr[1])
					{ $(this).prop("checked", true); }
				});
			}
		})
	}

	function appendschedline(){
		$("#tbodyschedline").append('<tr>' +
										'<td><input type="checkbox" class="cbschedline" style="margin-top: 10px;"></td>' +
                                        '<td><input type="text" class="date-picker schedline slstartdate" value="<?php echo date('m/d/Y'); ?>" id="slstartdate"></td>' +
                                        '<td><input type="text" class="date-picker schedline slenddate" value="<?php echo date('m/d/Y'); ?>" id="slenddate"></td>' +
                                        '<td><input type="time" class="schedline slstarttime" id="slstarttime"></td>' +
                                        '<td><input type="time" class="schedline slendtime" id="slendtime"></td>' +
                                        '<td><input type="text" size="4" class="schedline slduration numberlang" id="slduration"></td>' +
                                    '</tr>');
	}

	function deletecheckedschedline(){
		var ctr = $('input.cbschedline:checked').size();
		if(ctr!=0){
			$("table.tblschedline .cbschedline").each(function(){
				if ( $(this).is(":checked") == true ) {
					$(this).closest('tr').remove();
				}
			});
		}else{
			showmodal("alert", "Please select atleast one you want to delete.", "", null, "", null, "1");
		}
	}

	function saveschedline(){
		var ids = $("#schedlineids").val();
		var schedline = "";
		var stat = "";
		$("#tblschedline tr").each(function(){
	        var date1 = $(this).find(".slstartdate").val();
	        var date2 = $(this).find(".slenddate").val();
	        var time1 = $(this).find(".slstarttime").val();
	        var time2 = $(this).find(".slendtime").val();
	        var duration = $(this).find(".slduration").val();
	        schedline += date1 + "|" + date2 + "|" + time1 + "|" + time2 + "|" + duration + "#";
	    })
	    $(".schedlinestat").each(function(){
	    	if ( $(this).is(":checked") == true ) {
				stat = this.value;
			}
	    })
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'ids=' + ids + '&schedline=' + schedline + '&stat=' + stat + '&form=saveschedline',
			success:function(data){
				showmodal("alert", "Saved.", "", null, "", null, "0");
				$("#taskscheduler").modal("hide");
				$("#detailedWO").modal("hide");

			}
		})
	}

	function closewocatmodal(){
		$("#wocatmodal").modal("hide");
		$("#txtwocatmodalcatid").val("");
		$("#txtwocatmodalcatdes").val("");
	}

	function closewotaskmodal(){
		$("#wotaskmodal").modal("hide");
		$("#wotaskmodalcatid").val("");
		$("#wotaskmodalcatdes").val("");
	}

	function savewocatmodal(){
		var catdes = $("#txtwocatmodalcatdes").val();
		var catid = $("#txtwocatmodalcatid").val();
		if(catdes != "" && catid != ""){
			$.ajax({
				type: 'POST',
				url: 'maintenance/class.php',
				data: 'catdes=' + catdes + '&catid=' + catid + '&form=savewocatmodal',
				success:function(data){
					var arr = data.split("|");
					if(arr[0] == "1"){
						showmodal("alert", "Saved.", "", null, "", null, "0");
						closewocatmodal();
						showtblwojob('');
						hiddenpangupload54(arr[1]);
					}else{
						showmodal("alert", data, "", null, "", null, "0");
					}
				}
			})
		}else{
			showmodal("alert", "Please fill up all fields.", "", null, "", null, "0");
		}
	}

	function hiddenpangupload54(id){
		$("#frmIconID").val(id);
		var data = new FormData($('#frmIcon')[0]);
      	$.ajax({
	        type: 'POST',
	        url: 'maintenance/savingoficon.php',
	        data: data,
	        mimeType: 'multipart/form-data',
	        contentType: false,
	        cache: false,
	        processData: false,
	        success:function(data2){
	        	removephoto();
	        }
      	})
	}

	function savewowotaskmodal(){
		var taskid = $("#wotaskmodaltaskid").val();
		var taskname = $("#wotaskmodaltaskname").val();
		var amount = $("#wotaskmodalamount").val();
		var equipment = $("#wotaskmodalequipment").val();
		var catid = "";
		$("table.catheader .isjobadded").each(function(){
			if ( $(this).is(":checked") == true ) {
				catid = this.value;
			}
		});
		if(taskid != "" && taskname != "" && amount != "" && equipment != "" && catid != ""){
			$.ajax({
				type: 'POST',
				url: 'maintenance/class.php',
				data: 'taskid=' + taskid + '&taskname=' + taskname + '&amount=' + amount + '&equipment=' + equipment + '&catid=' + catid + '&form=savewowotaskmodal',
				success:function(data){
					if(data == "1"){
						showmodal("alert", "Saved.", "", null, "", null, "0");
						closewocatmodal();
						showtblwojob('');
					}else{
						showmodal("alert", data, "", null, "", null, "0");
					}
				}
			})
		}else{
			showmodal("alert", "Please fill up all fields.", "", null, "", null, "0");
		}
	}

	function printJO(workorderid, tenantid, mallid){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'tenantid=' + tenantid + '&form=printJOtenantinformation',
			success:function(data){
				$("#printjonumber").text(workorderid);
				$("#printtenantid").text(tenantid);
				var arr = data.split("|");
				$("#printbranchname").text(arr[2]);
				$("#printcompanyname").text(arr[0]);
				$("#printwingname").text(arr[3]);
				$("#printcontactpersion").text(arr[5]);
				$("#printfloor").text(arr[4]);
				$("#printcontactnumber").text(arr[6]);
				$("#printunitno").text(arr[1]);
			}
		})
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'workorderid=' + workorderid + '&tenantid=' + tenantid + '&form=printJOjotasklistcontainer',
			success:function(data){
				$("#jotasklistcontainer").html(data);

				$.ajax({
					type: 'POST',
					url: 'maintenance/class.php',
					data: 'mallid=' + mallid + '&form=template',
					success:function(data){
						$("#template3").html(data);
							var toprint = $("#joprintpreview").html();
				            var myheight = $(window).height()-40;
				            var mywidth = $(window).width()-40;
				            var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
				            popupWin.document.open();
				            popupWin.document.write("<html><head><title></title><link href='assets/css/style.css' rel='stylesheet' type='text/css'></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
				            popupWin.document.close();
					}
				})
			}
		})
	}

	function printbydaterangeJO(){
    	var datefrom = $("#jodatefrom").val();
		var dateto = $("#jodateto").val();
		var mallid = $("#printbymewo").val();
		if(mallid != ""){
	        $.ajax({
	        	type: 'POST',
	        	url: 'maintenance/class.php',
	        	data: 'datefrom=' + datefrom + '&dateto=' + dateto + '&mallid=' + mallid + '&form=printbydaterange',
	        	success:function(data){
	        		var arr = data.split("|");
	        		$("#tblmpowobodrc").html(arr[0]);
					$("#dateFromwoprint").text(arr[1]);
					$("#dateTowoprint").text(arr[2]);
	        		$.ajax({
	        			type: 'POST',
	        			url: 'maintenance/class.php',
	        			data: 'mallid=' + mallid + '&form=template',
	        			success:function(data){
	        				$("#template2").html(data);
				            var toprint = $("#mpowobodrc").html();
				            var myheight = $(window).height()-40;
				            var mywidth = $(window).width()-40;
				            var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
				            popupWin.document.open();
				            popupWin.document.write("<html><head><title></title><link rel='stylesheet' href='assets/font-awesome/4.5.0/css/font-awesome.min.css' /><link href='assets/css/style2.css' rel='stylesheet' type='text/css'></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
				            popupWin.document.close();
	        			}
	        		})
	        	}
	        })
        }else{
        	showmodal("alert", "Please select mall.", "", null, "", null, "0");
        }
    }

	function showwomanagementlist(){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'form=showwomanagementlist',
			success:function(data){
				$("#womanagementlist").html(data);
			}
		})
	}

	function cleartable(){
		$("#wodetailedwoicontainer").html("");
		$("#detailedWO").modal("hide");
	}

	function showwomodalscheduling(){
		$("#womodalscheduling").modal("show");
		var jonumber = $("#modaljoseries").text();
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'jonumber=' + jonumber + '&form=showwomodalscheduling',
			success:function(data){
				var arr = data.split("|");
				$("#woschedstartdate").val(arr[0]);
				$("#woschedenddate").val(arr[1]);
				$("#woschedstarttime").val(arr[2]);
				$("#woschedendtime").val(arr[3]);
			}
		})
	}

	function savewomodalscheduling(){
		var woschedstartdate = $("#woschedstartdate").val();
		var woschedenddate = $("#woschedenddate").val();
		var woschedstarttime = $("#woschedstarttime").val();
		var woschedendtime = $("#woschedendtime").val();
		var modaljoseries = $("#modaljoseries").text();
		var modaljoseries2 = $("#modaljoseries2").text();
		var wodep = $("#wodep").val();
		var wopersonnel = $("#wopersonnel").val();
		var jonumber = "";
		if(modaljoseries != "" && modaljoseries2 == ""){
			jonumber = modaljoseries;
		}else if(modaljoseries == "" && modaljoseries2 != ""){
			jonumber = modaljoseries2;
		}
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'woschedstartdate=' + woschedstartdate + '&woschedenddate=' + woschedenddate + '&woschedstarttime=' + woschedstarttime + '&woschedendtime=' + woschedendtime + '&jonumber=' + jonumber + '&wodep=' + wodep + '&wopersonnel=' + wopersonnel + '&form=savewomodalscheduling',
			success:function(data){
				if(data == 1){
					showmodal("alert", "Work order schedule has been saved.", "tblworkorder", null, "", null, "0");
				}
			}
		})
	}

	function settaskasresolve(){
		var modaljoseries = $("#modaljoseries").text();
		var modaljoseries2 = $("#modaljoseries2").text();
		var jonumber = "";
		if(modaljoseries != "" && modaljoseries2 == ""){
			jonumber = modaljoseries;
		}else if(modaljoseries == "" && modaljoseries2 != ""){
			jonumber = modaljoseries2;
		}
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'jonumber=' + jonumber + '&form=settaskasresolve',
			success:function(data){
				if(data == 1){
					showmodal("alert", "Work order status updated.", "cleartable", null, "", null, "0");
					tblworkorder();
				}
			}
		})		
	}

	function ViewWOdetailedcomplaint(workorderid, tenantid, csn, taskstatus){
		if(taskstatus == "Resolved"){
			$(".btnforscheduling").prop("disabled", true);
			$("#detailedWOResolve").css("display", "none");
			$("#buttonforpostingtobilling").css("display", "inline");
		}else{
			$(".btnforscheduling").prop("disabled", false);
			$("#detailedWOResolve").css("display", "none");
			$("#buttonforpostingtobilling").css("display", "none");
		}
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'workorderid=' + workorderid + '&tenantid=' + tenantid + '&csn=' + csn + '&form=ViewWOdetailed',
			success:function(data){
				var arr = data.split("|");
					$("#modaljoseries").text(workorderid);
					$("#modaltenantid").text(tenantid);
					$("#modalcompanyname").text(arr[0]);
					$("#modalbranchname").text(arr[2]);
					$("#modalwingname").text(arr[3]);
					$("#modalfloor").text(arr[4]);
					$("#modalunitnumber").text(arr[1]);
					$("#modalworkername").text(arr[5]);
					wodetailedwoi(workorderid, csn);
					$("#WODheader").text("Tenant Information");
					$("#div_pagtenant").css("display", "block");
					$("#div_pagmanagement").css("display", "none");
			}
		})
	}

	function resolvingofcomplaint(csn, status){
		if(status == "Resolved"){
			$("#nilalamanngpusobtn").prop("disabled", true);
		}else{
			$("#nilalamanngpusobtn").prop("disabled", false);
		}
		$("#modalresolvingofcomplaint").modal("show");
		$("#rikimaru").val(csn);
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'csn=' + csn + '&form=resolvingofcomplaint',
			success:function(data){
				$("#nilalamanngpuso").html(data);
			}
		})
	}

	function saveresolvingofcomplaint(){
		var enddate = $("#complaintenddate").val();
		var duration = $("#complaintduration").val();
		var endtime = $("#complaintendtime").val();
		var amount = $("#complaintamount").val();
		var remarks = $("#complaintremarks").val();
		var csn = $("#rikimaru").val();
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: '&enddate=' + enddate + '&duration=' + duration + '&endtime=' + endtime + '&amount=' + amount + '&remarks=' + remarks + '&csn=' + csn + '&form=saveresolvingofcomplaint',
			success:function(data){
				if(data == "1"){
					showmodal("alert", "Data has been saved.", "", null, "", null, "0");
					$("#detailedWO").modal("hide");
					tblworkorder();
				}
			}
		})
	}

	function inputreading(catid, status, workorderid, id, tenantid){
		$("#hiddenpangupload").val(workorderid+"|"+catid+"|"+id+"|"+tenantid);
		$("#womodalmetereading").modal("show");
		$("#womodalmetereadingheader").text("");
		if(status == "Resolved"){
			$("#metervalue").prop("disabled", true);
			$("#meter_image").prop("disabled", true);
			$("#btnforuploadinghidden").prop("disabled", true);
		}else{
			$("#metervalue").prop("disabled", false);
			$("#meter_image").prop("disabled", false);
			$("#btnforuploadinghidden").prop("disabled", false);
		}
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'workorderid=' + workorderid + '&catid=' + catid + '&status=' + status + '&id=' + id + '&tenantid=' + tenantid + '&form=inputreading',
			success:function(data){
				var arr = data.split("|");
				$("#metervalue").val(arr[0]);
				if(arr[1] != ""){
					$("#imahengmetro").css("display", "block");
					$("#logongupload").css("display", "none");
					$("#textngupload").css("display", "none");
					$("#imahengmetro").attr("src", arr[1]);
				}
			}
		})
	}

	function hiddenpangupload(){
		var ids = $("#hiddenpangupload").val();
		var data = new FormData($('#posting_meter_image')[0]);
		if($("#metervalue").val() != ""){
	      	$.ajax({
		        type:"POST",
		        url:"maintenance/saveimageofmanualjo.php",
		        data: data,
		        mimeType: "multipart/form-data",
		        contentType: false,
		        cache: false,
		        processData: false,
		        success:function(data2){
					showmodal("alert", "Saved.", "", null, "", null, "0");
					tblworkorder();
					$("#detailedWO").modal("hide");
					removeinputs();
		        }
	      	})
      	}else{
      		showmodal("alert", "Please input meter reading value.", "", null, "", null, "0");
      	}
	}

	function removeinputs(){
		$("#womodalmetereading").modal("hide");
		$("#metervalue").val("");
		$("#meter_image").val("");
		$("#pangalisnglarawan").click();
		$("#imahengmetro").attr("src", "");
		$("#imahengmetro").css("display", "none");
		$("#logongupload").css("display", "block");
		$("#textngupload").css("display", "block");
	}

	function showimahe(){
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("meter_image").files[0]);
		
		oFReader.onload = function (oFREvent) {
			$("#imahengmetro").css("display", "block");
			$("#logongupload").css("display", "none");
			$("#textngupload").css("display", "none");
			document.getElementById("imahengmetro").src = oFREvent.target.result;
		};
	}

	function confirmposting(){
		showmodal("confirm", "Confirm posting to billing?", "postingconfirmed", null, "", null, "1");
	}

	function postingconfirmed(){
		var joseries = $("#modaljoseries").text();
		var joseries2 = $("#modaljoseries2").text();
		var tenantid = $("#modaltenantid").text();
		var workorderid = "";
		if(joseries != ""){
			workorderid = joseries;
		}else{
			workorderid = joseries2;
		}
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: '&workorderid=' + workorderid + '&tenantid=' + tenantid + '&form=postingconfirmed',
			success:function(data){
				setTimeout(function(){
					showmodal("alert", "Posting success.", "tblworkorder", null, "", null, "0");
					$("#detailedWO").modal("hide");
				}, 1000)
			}
		})
	}

	function tblbudget(){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'form=tblbudget',
			success:function(data){
				$("#tblbudget").html(data);
			}
		})
	}

	function showtypeofbudget(){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'form=showtypeofbudget',
			success:function(data){
				$("#typeofbudget").html(data);
			}
		})
	}

	function addbudgetperyear(){
		var year = $("#budgetyear").val();
		var utility = $("#typeofbudget").val();
		if(year != ""){
			if(utility != ""){
				$("#modalforaddingbudget").modal("show");
				$.ajax({
					type: 'POST',
					url: 'maintenance/class.php',
					data: 'year=' + year + '&utility=' + utility + '&form=addbudgetperyear',
					success:function(data){
						var arr = data.split("|");
						$("#labelformodalofaddingbudget").text(arr[0]+" budget for the year of "+year);
						$("#xjan").val(arr[1]);
						$("#xfeb").val(arr[2]);
						$("#xmar").val(arr[3]);
						$("#xapr").val(arr[4]);
						$("#xmay").val(arr[5]);
						$("#xjun").val(arr[6]);
						$("#xjul").val(arr[7]);
						$("#xaug").val(arr[8]);
						$("#xsep").val(arr[9]);
						$("#xoct").val(arr[10]);
						$("#xnov").val(arr[11]);
						$("#xdec").val(arr[12]);
					}
				})
			}else{
				showmodal("alert", "Please select utility.", "", null, "", null, "0");
			}
		}else{
			showmodal("alert", "Please select year.", "", null, "", null, "0");
		}
	}

	function savebudgetperyear(){
		var year = $("#budgetyear").val();
		var utility = $("#typeofbudget").val();
		var xjan = $("#xjan").val();
		var xfeb = $("#xfeb").val();
		var xmar = $("#xmar").val();
		var xapr = $("#xapr").val();
		var xmay = $("#xmay").val();
		var xjun = $("#xjun").val();
		var xjul = $("#xjul").val();
		var xaug = $("#xaug").val();
		var xsep = $("#xsep").val();
		var xoct = $("#xoct").val();
		var xnov = $("#xnov").val();
		var xdec = $("#xdec").val();
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'year=' + year + '&xjan=' + xjan + '&xfeb=' + xfeb + '&xmar=' + xmar + '&xapr=' + xapr + '&xmay=' + xmay + '&xjun=' + xjun + '&xjul=' + xjul + '&xaug=' + xaug + '&xsep=' + xsep + '&xoct=' + xoct + '&xnov=' + xnov + '&xdec=' + xdec + '&utility=' + utility + '&form=savebudgetperyear',
			success:function(data){
				var arr = data.split("|");
				showmodal("alert", arr[0]+" budget for the year of "+arr[1]+" has been "+arr[2]+".", "tblbudget", null, "", null, "0");
				$("#modalforaddingbudget").modal("hide");
			}
		})
	}

	function showfilterofmall(){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'form=showfilterofmall',
			success:function(data){
				$(".malloption").html(data);
			}
		})
	}

	function showwodep(){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: 'form=showwodep',
			success:function(data){
				$("#wodep").html(data);
			}
		})
	}

	function showwopersonnel(dep){
		$.ajax({
			type: 'POST',
			url: 'maintenance/class.php',
			data: '&dep=' + dep + '&form=showwopersonnel',
			success:function(data){
				$("#wopersonnel").html(data);
			}
		})
	}

	function showpic(){
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("fileIcon").files[0]);
		
		oFReader.onload = function (oFREvent) {
			$("#imgIcon").css("display", "block");
			$("#iconLogoUpload").css("display", "none");
			$("#iconTextUpload").css("display", "none");
			$("#iconRemoveButton").css("display", "block");
			document.getElementById("imgIcon").src = oFREvent.target.result;
		};
	}

	function removephoto()
	{
		$("#imgIcon").attr("src", "");
		$("#imgIcon").css("display", "none");
		$("#iconLogoUpload").css("display", "block");
		$("#iconTextUpload").css("display", "block");
		$("#fileIcon").val("");
		$("#iconRemoveButton").css("display", "none");
	}

// function savemanualjoborderreport(){
//    	var utype = $("#utype").val();
//    	var tname = $("#tname").val();
//    	var ulocation = $("#ulocation").val();
//    	var wname = $("#wname").val();
//    	var joseries = $("#joseries").val();
//    	var tenantidsabush = $("#tenantidsabush").val();
//    	var ownernamesabush = $("#ownernamesabush").val();
//    	var building_idsabush = $("#building_idsabush").val();
//    	var flooridsabush = $("#flooridsabush").val();
//    	var categoryTenantsabush = $("#categoryTenantsabush").val();
// 	var categoryManagementsabush = $("#categoryManagementsabush").val();
// 	var taskidsabush = $("#taskidsabush").val();
// 	var location_idsabush = $("#location_idsabush").val();
// 	var workeridsabush = $("#workeridsabush").val();
// 	var schedsabush = $("#schedsabush").val();
// 	var manualassignperson = $("#manualassignperson").val();
// 	var txtchargestype = $("#txtchargestype").val();
// 	var manualdetails = $("#manualdetails").val();
// 	var manualdateFrom = $("#manualdateFrom").val(); 
// 	var manualtimestarted = $("#manualtimestarted").val();
// 	var manualdateTo = $("#manualdateTo").val();
// 	var manualtimeended = $("#manualtimeended").val();
// 	var kwhremarks = $("#kwhremarks").val();
// 	var cmremarks = $("#cmremarks").val();
// 	var complaintseriesnumber = $("#complaintseriesnumber").val();
// 	var kwhmanual = $("#kwhmanual").val();
// 	var cmmanual = $("#cmmanual").val();
// 	var temp = "";
// 		    $("#add_div .holder").each(function(){
// 		        var textbox1 = $(this).find(".laborremarks").val();
// 		        var textbox2 = $(this).find(".laboramount").val();
// 		        temp += textbox1 + "..." + textbox2 + "|";
// 		    })
// 	var temp2 = "";
// 		    $("#add_div2 .holder2").each(function(){
// 		        var textbox4 = $(this).find(".partsremarks").val();
// 		        var textbox5 = $(this).find(".partsamount").val();
// 		        var textbox6 = $(this).find(".partsquantity").val();
// 		        temp2 += textbox4 + "..." + textbox5 + ",,," + textbox6 + "|";
// 		    })

// 	if(txtchargestype == null){
// 		alert("You must select atleast one charges type.");
// 	}else{
// 		$.ajax({
// 			type: 'POST',
// 			url: 'maintenance/class.php',
// 			data: 'cmremarks=' + cmremarks + '&kwhremarks=' +  kwhremarks + '&temp=' + temp + '&temp2=' + temp2 + '&tname=' + tname + '&ulocation=' + ulocation + '&wname=' + wname + '&joseries=' + joseries + '&tenantidsabush=' + tenantidsabush + '&ownernamesabush=' + ownernamesabush + '&building_idsabush=' + building_idsabush + '&flooridsabush=' + flooridsabush + '&categoryTenantsabush=' + categoryTenantsabush + '&categoryManagementsabush=' + categoryManagementsabush + '&taskidsabush=' + taskidsabush + '&location_idsabush=' + location_idsabush + '&workeridsabush=' + workeridsabush + '&schedsabush=' + schedsabush + '&manualassignperson=' + manualassignperson + '&txtchargestype=' + txtchargestype + '&manualdetails=' + manualdetails + '&manualdateFrom=' + manualdateFrom + '&manualtimestarted=' + manualtimestarted + '&manualdateTo=' + manualdateTo + '&manualtimeended=' + manualtimeended + '&complaintseriesnumber=' + complaintseriesnumber + '&kwhmanual=' + kwhmanual + '&cmmanual=' + cmmanual + '&form=savemanualjoborderreport',
// 		success:function(data){
// 			var arr = data.split("|");
// 				if(arr[0] == "1"){
// 						setTimeout(function(){
// 						showmodal("alert", "Manual Report Saved.", "closeallmodal", null, "", null, 0);
// 						}, 1000)
// 						saveimage(arr[1]);
// 						// joblist();
// 						$(".clearme").val("");
// 						$(".clearme").text("");
// 				}
// 				else{
// 					setTimeout(function(){
// 					showmodal("alert", "Something went wrong.", "closeallmodal", null, "", null, 0);
// 					}, 1000)
// 				}
// 			}
// 		})
// 	}
//    }

 // function checkdate(){
	// 	var automaticsetup = $("#automaticsetup").val();
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: 'maintenance/class.php',
	// 		data: 'automaticsetup=' + automaticsetup + '&form=checkdate',
	// 	success:function(data){
	// 		if(data != "1"){
	// 			$("#datengpaggawa").val(data);
	// 			checkexistingER();
	// 			checkexistingWR();
	// 		}
	// 	}
	// 	})
	// }

	// function checkexistingER(){
	// 	var datengpaggawa = $("#datengpaggawa").val();
	// 	var automaticsetup = $("#automaticsetup").val();
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: 'maintenance/class.php',
	// 		data: 'automaticsetup=' + automaticsetup + '&datengpaggawa=' + datengpaggawa + '&form=checkexistingER',
	// 	success:function(data){
	// 		}
	// 	})
	// }

	// function checkexistingWR(){
	// 	var datengpaggawa = $("#datengpaggawa").val();
	// 	var automaticsetup = $("#automaticsetup").val();
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: 'maintenance/class.php',
	// 		data: 'automaticsetup=' + automaticsetup + '&datengpaggawa=' + datengpaggawa + '&form=checkexistingWR',
	// 	success:function(data){
	// 		}
	// 	})
	// }

	// function clickcheckbox() {
	// 	$("#tblcharges tr").each(function(){
	// 		$(this).click(function(){
	// 			var eto = $(this).find(".checkboxxx");

	// 			if( $(this).find(".POSTEDNAKO").text() == 'POSTED' ){
	// 				// 
	// 			}
		         

	// 			else {
	// 				if ( eto.is(":checked") ) {
	// 					var ids = $("#ipopost").val();
	// 					eto.prop("checked", false);
						
	// 					$("#ipopost").val(ids.replace($(this).find(".checkboxxx").val() + "|", ""));
	// 					$(this).css("color","");
	// 					$(this).css("background-color","");
	// 				}

	// 				else {
	// 					var ids = $("#ipopost").val();
	// 					eto.prop("checked", true);
	// 					ids += $(this).find(".checkboxxx").val() + "|";

	// 					$("#ipopost").val(ids);
	// 					$(this).css("color","#FFF");
	// 					$(this).css("background-color","#666");
	// 				}
	// 			}
	// 		})
	// 	})
	// }
	// function saveimage(staff_task_id){
 //    $("#jolarawanid").val(staff_task_id);
 //    var data = new FormData($('#larawanngmanualjo')[0]);
	//     $.ajax({
	//       type:"POST",
	//       url:"maintenance/saveimageofmanualjo.php",
	//       data: data,
	//       mimeType: "multipart/form-data",
	//       contentType: false,
	//       cache: false,
	//       processData: false,
	//       success:function(data){
	//         alert(data);
	//         // closemodal("uploadattach");
	//       }
	//     });
 //  	}
</script>