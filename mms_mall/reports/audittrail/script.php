
<script type="text/javascript">
	setTimeout(function(){
    $(".fixTable").tableHeadFixer();
    $("#txt_userpage").val("1");
    displayaudittrail();
    loadentries();
    loadpageaudittrail();
    printtemplate();
    $(".date-picker").datepicker({
            autoHide: true,
            format: 'mm/dd/yyyy',
            todayHighlight: true
        })

        $('.numbers').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57 || event.which == 44 )) {
                event.preventDefault();
            }
        }); 

        $(".numbers").blur(function(){
            var amount = $(this).val();

            $(this).val(currency(amount)); 
        })

        checkDate();
    }, 500)

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

$(function(){
    displayaudittrail();
    filterbymodule();
    loadentries();
    loadpageaudittrail();
})
	function displayaudittrail(){
        var page = $("#txt_userpage").val();
        var txtaudittrail = $("#txtaudittrail").val();
        var filterbymodule = $("#filterbymodule").val();
		var dateFrom = $("#dateFrom5").val();
    	var dateTo = $("#dateTo5").val();
		$.ajax({
			type: 'POST',
			url: 'reports/audittrail/class.php',
			data: 'page=' + page +'&txtaudittrail=' + txtaudittrail + '&filterbymodule=' + filterbymodule + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=displayaudittrail',
			beforeSend : function() {
            $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
				$("#displayaudittrail").html(data);
			    loadentries();
                loadpageaudittrail();
            }
		})
	}

	function printaudittrail(){
		var dateFrom = $("#dateFrom5").val();
		var dateTo = $("#dateTo5").val();
		$.ajax({
			type: 'POST',
			url: 'reports/audittrail/class.php',
			data: 'dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&form=printaudittrail',
			success:function(data){
				$("#displayaudittrail2").html(data);
				$("#dateFrom2").text(dateFrom);
				$("#dateTo2").text(dateTo);

				var toprint = $("#div_form_audittrail").html();
				var myheight = $(window).height()-40;
				var mywidth = $(window).width()-40;
				var popupWin = window.open("", "_blank", "height=" + myheight + ",width=" + mywidth + ",location=no,scrollbars=1,left=" + 20);
				popupWin.document.open();
				popupWin.document.write("<html><head><title>Audit Trail</title><link href='assets/css/style2.css' rel='stylesheet' type='text/css'></head><body onload='window.print();'><div class='checklist'>" + toprint + "</div></body></html>");
				popupWin.document.close();
				}
			})
		}

    function filterbymodule(){
    $.ajax({
        type: 'POST',
        url: 'reports/audittrail/class.php',
        data: 'form=loaddropdowndata',
        success: function(data){
                $("#filterbymodule").html(data);
            }
        })
    }

    function loadentries(){
        var page = $("#txt_userpage").val();
        var txtaudittrail = $("#txtaudittrail").val();
        var dateFrom = $("#dateFrom5").val();
        var dateTo = $("#dateTo5").val();
        var filterbymodule = $("#filterbymodule").val();
        $.ajax({
            type: 'POST',
            url: 'reports/audittrail/class.php',
            data: 'filterbymodule=' + filterbymodule + '&page=' + page + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo + '&txtaudittrail=' + txtaudittrail + '&form=loadentries',
            success: function(data){
                if(data == "no data"){
                    $("#txtauditrailentries").text("");
                }
                else{
                    $("#txtauditrailentries").text(data);
                }
            }
        });
    }

    function loadpageaudittrail(){
        var page = $("#txt_userpage").val();
        var txtaudittrail = $("#txtaudittrail").val();
        var dateFrom = $("#dateFrom5").val();
        var dateTo = $("#dateTo5").val();
        var filterbymodule = $("#filterbymodule").val();
        $.ajax({
            type: 'POST',
            url: 'reports/audittrail/class.php',
            data: 'filterbymodule=' + filterbymodule + '&dateFrom=' + dateFrom +  '&dateTo=' + dateTo + '&page=' + page + '&txtaudittrail=' + txtaudittrail + '&form=loadpageaudittrail',
            success: function(data){
                $("#ulpaginationaudittrail").html(data);
            }
        });
    }

    function pagination(page, pagenums){
        $(".pgnumaudittrail").removeClass("active");
        var value = "#" + pagenums;
        $("#pgaudittrail" + pagenums).addClass("active");
        $("#txt_userpage").val(page);
        displayaudittrail();
        loadpageaudittrail();
        loadentries();
    }
    
    function printtemplate(){
    $.ajax({
        type: 'POST',
        url: 'setup/systemsetup/class.php',
        data: 'form=template',
        success: function(data){
            $("#template123").html(data);
        }
    })
    }
</script>