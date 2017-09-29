<script type="text/javascript">

setTimeout(function(){
    $(".fixTable").tableHeadFixer(); 
    $("#txt_userpage").val("1");
    $("#txt_userpagehr").val("1");
    displaycomplaints2();
    loadentries();
    tblviolation();
    loadentriesofhr();
    $('[data-rel=tooltip]').tooltip();
    $('[data-rel=popover]').popover({html:true});

    $(".date-picker").datepicker({
        autoHide: true,
        format: 'mm/dd/yyyy',
        todayHighlight: true
    });

    checkDate();

    }, 1000)

    function checkDate() {
        $("#dateTo").blur(function(){
            var dateFrom = $("#dateFrom").val().toString();
            var dateTo = $("#dateTo").val().toString();
            if ( dateTo == "" ) {

            }

            else {
                if ( dateTo < dateFrom ) {
                    showmodal("alert", "The second date must not be less than the first.", "", null, "", null, "0");
                    $("#dateTo").val("");

                    checkDate();
                }
            }
        })
    }

function displaycomplaints2() {
    var page = $("#txt_userpage").val();
    var key = $("#txtsearchcomplaints").val();
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'page=' + page + '&key=' + key + '&form=displaycomplaints2',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            $("#displaycomplaints2").html(data);
            loadentries();
            loadpagecomplaints();
        }
    })
}

function loadentries(){
    var page = $("#txt_userpage").val();

    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'page=' + page + '&form=loadentries',
        success: function(data){
            if(data == "no data"){
                $("#txtcomplaintsentries").text("");
            }
            else{
                $("#txtcomplaintsentries").text(data);
            }
        }
    });
}

function loadpagecomplaints(){
    var page = $("#txt_userpage").val();

    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'page=' + page + '&form=loadpagecomplaints',
        success: function(data){
            $("#ulpaginationcomplaint").html(data);
        }
    });
}

function pagination(page, pagenums){
    $(".pgnumpcomplaints").removeClass("active");
    var value = "#" + pagenums;
    $("#pgcomplaints" + pagenums).addClass("active");
    $("#txt_userpage").val(page);
    displaycomplaints2();
    loadpagecomplaints();
    loadentries();
}

function printcomplaints(){
    var dateFrom = $("#dateFrom").val();
    var dateTo = $("#dateTo").val();
    var mallid = $("#printbymec").val();
    if(mallid != ""){
        $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&mallid=' + mallid + '&form=printcomplaints',
        success:function(data){
            var arr = data.split("|");
            $("#contentngcomplaints").html(arr[0]);
            $("#dateFrom2").text(arr[1]);
            $("#dateTo2").text(arr[2]);

                $.ajax({
                    type: 'POST',
                    url: 'complaints/class.php',
                    data: 'mallid=' + mallid + '&form=template2',
                    success:function(data){
                        $("#template").html(data);

                            var toprint = $("#div_form_complaints").html();
                            var myheight = $(window).height()-40;
                            var mywidth = $(window).width()-40;
                            var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
                            popupWin.document.open();
                            popupWin.document.write("<html><head><title></title><link href='assets/css/style2.css' rel='stylesheet' type='text/css'></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
                            popupWin.document.close();
                    }
                })
            }
        })
    }else{
        showmodal("alert", "Please select mall.", "", null, "", null, "0");
    }
}

function loadfilters_complaints(module){
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'module=' + module + '&form=loadfilters_complaints',
        success: function(data){
            var datas = data.split("#");
            var arr = datas[0].split("|");
            var arr2 = datas[1].split("|");
            var arr3 = datas[2].split("|");
            var arr4 = datas[3].split("|");
            // filter by
            for(var i=0; i<=arr.length-1; i++)
            {
                $('input:checkbox[id="filter_'+arr[i]+'"][value="'+arr[i]+'"]').attr('checked', 'checked');
            }
            // date
            $("#dateentrystart").val(arr2[0]);
            $("#dateentryend").val(arr2[1]);
            // Status filter
            for(var i=0; i<=arr3.length-1; i++)
            {
                $('input:checkbox[id="filter_'+arr3[i]+'"][value="'+arr3[i]+'"]').attr('checked', 'checked');
            }
            // if LCA or SET
            for(var i=0; i<=arr4.length-1; i++)
            {
                $('input:checkbox[id="filter_'+arr4[i]+'"][value="'+arr4[i]+'"]').attr('checked', 'checked');
            }
            displaycomplaints2()
        }
    })
}

function savecomplaintsfilter(){
    var module = "Complaints";
    var checked = "";
    $('input:checkbox[name="form-field-checkbox"]').each(function(){
        if($(this).is(":checked")){
            var value = $(this).attr("value");
            checked += value + "|";
        }
    })

    var checked2 = "";
    $('input:checkbox[name="form-field-checkbox"]').each(function(){

            var value2 = $(this).attr("value");
            checked2 += value2 + "|";
    })

    var checked3 = "";
    $('input:checkbox[name="form-field-checkbox-pstat"]').each(function(){
      if($(this).is(":checked"))
      {
        var value3 = $(this).attr("value");
        checked3 += value3 + "|";
      }
    })        

    var checked4 = "";
    $('input:checkbox[name="form-field-checkbox-angbawatisaaymaykarapatangmamili"]').each(function(){
    if($(this).is(":checked")){
        var value4 = $(this).attr("value");
        checked4 += value4 + "|";
    }
})    

    var datefrom = $("#dateentrystart").val();
    var dateto = $("#dateentryend").val();

    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'module=' + module + '&checked=' + checked + '&checked2=' + checked2 + '&checked3=' + checked3 + '&checked4=' + checked4 + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=savecomplaintsfilter',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            loadfilters_complaints(module);
            $("#LINK_complaints_filter").click();
        }
    })
}

function printcomplaint(csn, mallid){
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'csn=' + csn + '&form=printcomplaint',
        success:function(data){
            var arr = data.split("|");
            $("#printcomplainttradename").text(arr[0]);
            $("#printcomplaintmallname").text(arr[1]);
            $("#printcomplaintwingname").text(arr[2]);
            $("#printcomplaintfloorname").text(arr[3]);
            $("#printcomplaintunitname").text(arr[4]);
            $("#printcomplaintcomplaintdate").text(arr[5]);
            $("#printcomplaintusername").text(arr[6]);
            $("#printcomplaintcomplaintcode").text(arr[7]);
            $("#printcomplaintdescription").text(arr[8]);
            $("#printcomplaintassignedperson").text(arr[9]);
            $("#printcomplainttenantid").text(arr[10]);

                $.ajax({
                    type: 'POST',
                    url: 'complaints/class.php',
                    data: 'mallid=' + mallid + '&form=template2',
                    success: function(data){
                        $("#template2").html(data);
                            var toprint = $("#printcomplaint").html();
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

function showlegendsofcomplaints(){
    $("#legendsofcomplaints").css("display", "block");
    $("#legendsofhouserules").css("display", "none");
}

function hidelegendsofcomplaints(){
    $("#legendsofcomplaints").css("display", "none");
    $("#legendsofhouserules").css("display", "block");
}

function tblviolation(){
    var key = $("#txtsearchhr").val();
    var page = $("#txt_userpagehr").val();
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'page=' + page + '&key=' + key + '&form=tblviolation',
        success:function(data){
            $("#tblviolation").html(data);
            loadentriesofhr();
            loadpagehr();
        }
    })
}

function loadentriesofhr(){
    var page = $("#txt_userpagehr").val();

    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'page=' + page + '&form=loadentriesofhr',
        success: function(data){
            if(data == "no data"){
                $("#txthrentries").text("");
            }
            else{
                $("#txthrentries").text(data);
            }
        }
    });
}

function loadpagehr(){
    var page = $("#txt_userpage").val();

    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'page=' + page + '&form=loadpagehr',
        success: function(data){
            $("#ulpaginationhr").html(data);
        }
    });
}

function createviolation(){
    $("#modalviolation").modal("show");
    $("#chktenant").click();
    showviolations();
}

function modalviolationselection(){
    $("#modalviolationselection").modal("show");
    tblviolationlist();
}

function closeandclearviolationcreationmodal(){
    $("#modalviolation").modal("hide");
    $("#selectwhoeveritis").val("");
    $("#checkedviolation").val("");
    $("#tblviolistmini").html("");
    tblviolation();
}

function tblviolationlist(){
    var ids = $("#checkedviolation").val();
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'ids=' + ids + '&form=tblviolationlist',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            $("#tblviolationlist").html(data);
            clickablenatblviolationlist();
            checkSelected();
        }
    })
}

function clickablenatblviolationlist(){
    $("#tblviolationlist tr").each(function(){
        $(this).click(function(){
            eto = $(this).find(".checkbox");

            // if( $(this).find(".wagmonasubukin").attr("checked") == "checked" ){
                //
            // }
            // else{
                if ( eto.is(":checked") ) {
                    var ids = $("#checkedviolation").val();
                    eto.prop("checked", false);

                    $("#checkedviolation").val(ids.replace($(this).find(".checkbox").val() + "|", ""));
                    $(this).css("color","");
                    $(this).css("background-color","");
                }

                else {
                    var ids = $("#checkedviolation").val();
                    eto.prop("checked", true);
                    ids += $(this).find(".checkbox").val() + "|";

                    $("#checkedviolation").val(ids);
                    $(this).css("color","#FFF");
                    $(this).css("background-color","#666");
                }
            // }
        })
    })
}

function checkSelected(){
    var allselected = $("#checkedviolation").val();
    var arr = allselected.split("|");

    for ( var a = 0; a <= arr.length; a++ ) {
        $("." + arr[a]).attr("checked", true);
        $("#tr"+arr[a]).attr("style","background-color: #666 !important;color:#FFF !important");

    }
}

function savecheckedviolations(){
    var ids = $("#checkedviolation").val();
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'ids=' + ids + '&form=savecheckedviolations',
        success:function(data){
            $("#tblviolistmini").html(data);
            $("#modalviolationselection").modal("hide");
        }
    })
}

function iftenantischecked(){
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'form=iftenantischecked',
        success:function(data){
            $("#selectwhoeveritis").html(data);
        }
    })
}

function ifemployeeischecked(){
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'form=ifemployeeischecked',
        success:function(data){
            $("#selectwhoeveritis").html(data);
        }
    })
}

function saveviolationticket(){
    var whoeveritis = $("#selectwhoeveritis").val();
    var ids = $("#checkedviolation").val();
    var type = "";
    $(".typeofviolator").each(function(){
        if ( $(this).prop("checked") ) {
        type = this.value;
        }
    })
    if(whoeveritis != "" && ids != "" && type != ""){
        $.ajax({
            type: 'POST',
            url: 'complaints/class.php',
            data: 'whoeveritis=' + whoeveritis + '&ids=' + ids + '&type=' + type + '&form=saveviolationticket',
            beforeSend : function() {
                $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
                if(data == "1"){
                    showmodal("alert", "Violation ticket successfully created.", "closeandclearviolationcreationmodal", null, "", null, "0");
                }else{
                    showmodal("alert", "Failed to record violation.", "closeandclearviolationcreationmodal", null, "", null, "0");
                }
            }
        })
    }else{
        showmodal("alert", "Please fill all fields.", "", null, "", null, "0");
    }
}

function saveHouseRulesfilter(){
    var module = "HouseRules";
    var checked = "";
    $('input:checkbox[name="form-field-checkbox-hrfilter"]').each(function(){
        if($(this).is(":checked")){
            var value = $(this).attr("value");
            checked += value + "|";
        }
    })

    var checked2 = "";
    $('input:checkbox[name="form-field-checkbox-hrfilter"]').each(function(){

            var value2 = $(this).attr("value");
            checked2 += value2 + "|";
    })

    var checked3 = "";
    $('input:checkbox[name="form-field-checkbox-hrstat"]').each(function(){
      if($(this).is(":checked"))
      {
        var value3 = $(this).attr("value");
        checked3 += value3 + "|";
      }
    })            

    var datefrom = $("#hrstart").val();
    var dateto = $("#hrend").val();

    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'module=' + module + '&checked=' + checked + '&checked2=' + checked2 + '&checked3=' + checked3 + '&datefrom=' + datefrom + '&dateto=' + dateto + '&form=saveHouseRulesfilter',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            loadfilters_HouseRules(module);
            $("#LINK_HouseRules_filter").click();
        }
    })
}

function loadfilters_HouseRules(module){
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'module=' + module + '&form=loadfilters_HouseRules',
        success: function(data){
            var datas = data.split("#");
            var arr = datas[0].split("|");
            var arr2 = datas[1].split("|");
            var arr3 = datas[2].split("|");
            // filter by
            for(var i=0; i<=arr.length-1; i++)
            {
                $('input:checkbox[id="filter_'+arr[i]+'"][value="'+arr[i]+'"]').attr('checked', 'checked');
            }
            // date
            $("#hrstart").val(arr2[0]);
            $("#hrend").val(arr2[1]);
            // Status filter
            for(var i=0; i<=arr3.length-1; i++)
            {
                $('input:checkbox[id="filter_'+arr3[i]+'"][value="'+arr3[i]+'"]').attr('checked', 'checked');
            }
            tblviolation()
        }
    })
}

function printcomplaintshr(){
    var dateFrom = $("#dateFromhr").val();
    var dateTo = $("#dateTohr").val();
    var mallid = $("#printbymehr").val();
    if(mallid != ""){
        $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&mallid=' + mallid + '&form=printcomplaintshr',
        success:function(data){
            var arr = data.split("|");
            $("#listofviolatorstoprint").html(arr[0]);
            $("#dateFromhrprint").text(arr[1]);
            $("#dateTohrprint").text(arr[2]);
                $.ajax({
                    type: 'POST',
                    url: 'complaints/class.php',
                    data: 'mallid=' + mallid + '&form=template2',
                    success:function(data){
                        $("#template3").html(data);

                            var toPrint = document.getElementById("allhouserulesviolations");
                            var myheight = $(window).height()-40;
                            var mywidth = $(window).width()-40;
                            var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
                            popupWin.document.open();
                            popupWin.document.write('<html><link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" /><link href="assets/css/style2.css" rel="stylesheet" type="text/css"><header style="font-size: 16px; font-weight: 700;"></header><br><body onload="window.print();">' );

                            popupWin.document.write( toPrint.innerHTML);
                            popupWin.document.write('</body></html>');
                            popupWin.document.close();
                    }
                })
            }
        })
    }else{
        showmodal("alert", "Please select mall.", "", null, "", null, "0");
    }
}

function deletethisticket(vsn){
    showmodal("confirm", "Are you sure you want to delete this ticket?", "confirmdeleteticket(\""+vsn+"\")", null, "", null, "0");
}

function confirmdeleteticket(vsn){
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'vsn=' + vsn + '&form=deletethisticket',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            if(data == 1){
                showmodal("alert", "House rules violation ticket successfully deleted.", "tblviolation", null, "", null, "0");
            }else{
                showmodal("alert", "Failed to delete.", "tblviolation", null, "", null, "0");
            }
        }
    })
}

function viewticket(vsn, type, violatorname, date, time, violatorid, status){
    if(status == "Resolved"){
        $("#btnpostingsabilling").prop("disabled", true);
    }else{
        $("#btnpostingsabilling").prop("disabled", false);
    }
    $("#viewticketmodal").modal("show");
    if(type == "Tenant"){
        $("#viewticketmodaldestino").text("Tenant Name");
        $("#viewticketmodalkinabibilangan").text("Unit No.");
    }else{
        $("#viewticketmodaldestino").text("Employee Name");
        $("#viewticketmodalkinabibilangan").text("Position");
    }
    $("#vtmvseriesnumber").text(vsn);
    $("#vtmpangalan").text(violatorname);
    $("#vtmpetsa").text(date);
    $("#vtmoras").text(time);
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'violatorid=' + violatorid + '&type=' + type + '&form=viewticket',
        success:function(data){
            $("#vtmlokasyon").text(data);
        }
    })
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'vsn=' + vsn + '&form=viewtickettable',
        success:function(data){
            var arr = data.split("|");
            $("#tblticketinformation").html(arr[0]);
            $("#modaltxttamount").text(arr[1]);
        }
    })
}

function printnotificationofviolation(vsn, type, violatorname, date, time, violatorid){
    if(type == "Tenant"){
        $("#ptxttn").text("Tenant Name: ");
        $("#ptxtun").text("Unit No.: ");
    }else{
        $("#ptxttn").text("Employee Name: ");
        $("#ptxtun").text("Position: ");
    }
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'type=' + type + '&violatorid=' + violatorid + '&form=template',
        success: function(data){
            $("#template4").html(data);
        }
    })
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'violatorid=' + violatorid + '&type=' + type + '&form=viewticket',
        success:function(data){
            $("#txtunitnumbernanagiiba").text(data);
            $("#txtvsn").text(vsn);
            $("#txttn").text(violatorname);
            $("#txtd").text(date);
            $("#txtt").text(time);

                $.ajax({
                    type: 'POST',
                    url: 'complaints/class.php',
                    data: 'vsn=' + vsn + '&form=viewtickettable2',
                    success:function(data2){
                        var arr = data2.split("|");
                        $("#tblnotificationofviolation").html(data2);
                            var toPrint = document.getElementById("notificationofviolation");
                            var myheight = $(window).height()-40;
                            var mywidth = $(window).width()-40;
                            var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
                            popupWin.document.open();
                            popupWin.document.write('<html><link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" /><link href="assets/css/style2.css" rel="stylesheet" type="text/css"><header style="font-size: 16px; font-weight: 700;"></header><br><body onload="window.print();">' );

                            popupWin.document.write( toPrint.innerHTML);
                            popupWin.document.write('</body></html>');
                            popupWin.document.close();
                    }
                })
        }
    })
        
}

function addreso(code, vsn, chargeamount, violation, status, resolution){
    $("#modalAddReso").modal("show");
    $("#txtchargeamount").val(chargeamount);
    $("#modaltxtReso").val(resolution);
    $("#modalAddResoheader").text(violation);
    $("#modalAddResoids").val(code+"|"+vsn);
    if(status == "Resolved"){
        $("#btnAddReso").prop("disabled", true);
        $("#modaltxtReso").attr("readonly", "readonly");
        $("#txtchargeamount").attr("readonly", "readonly");
    }else{
        $("#btnAddReso").prop("disabled", false);
        $("#modaltxtReso").removeAttr("readonly");
        $("#txtchargeamount").removeAttr("readonly");
    }
}

function savemodalAddReso(){
    var ids = $("#modalAddResoids").val();
    var reso = $("#modaltxtReso").val();
    var amount = $("#txtchargeamount").val();
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'ids=' + ids + '&reso=' + reso + '&amount=' + amount + '&form=savemodalAddReso',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            var arr = data.split("|");
            if(arr[0] == "1"){
                showmodal("alert", "Saved.", "closemodalAddReso", null, "", null, "0");
                $.ajax({
                    type: 'POST',
                    url: 'complaints/class.php',
                    data: 'vsn=' + arr[1] + '&form=viewtickettable',
                    success:function(data){
                        var arr = data.split("|");
                        $("#tblticketinformation").html(arr[0]);
                        $("#modaltxttamount").text(arr[1]);

                    }
                })
            }else{
                showmodal("alert", "Failed to save.", "", null, "", null, "0");
            }
        }
    })
}

function closemodalAddReso(vsn){
    $("#modalAddResoids").val("");
    $("#modaltxtReso").val("");
    $("#txtchargeamount").val("");
    $("#modalAddReso").modal("hide");
}

function checkmunabagopost(){
    var vsn = $("#vtmvseriesnumber").text();
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'vsn=' + vsn + '&form=checkmunabagopost',
        beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
        },
        success: function(data){
            $('#indexloadingscreen').removeClass('myspinner');
            if(data == "Resolved"){
                $.ajax({
                    type: 'POST',
                    url: 'complaints/class.php',
                    data: 'vsn=' + vsn + '&form=postmonabes',
                    success:function(data2){
                        if(data2 == ""){
                            showmodal("alert", "Charges are now posted to billing.", "tblviolation", null, "", null, "0");
                        }else{
                            showmodal("alert", "Posting Failed.", "tblviolation", null, "", null, "0");
                        }
                    }
                })
            }else{
                showmodal("alert", "Some violation are not yet resolved posting failed.", "tblviolation", null, "", null, "0");
            }
        }
    })
}

function showprintbyme(){
    $.ajax({
        type: 'POST',
        url: 'complaints/class.php',
        data: 'form=malloption',
        success:function(data){
            $(".malloption").html(data);
        }
    })
}

</script>