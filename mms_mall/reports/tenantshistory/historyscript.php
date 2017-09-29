<script type="text/javascript">

    $(function(){
        tblstorename();
        $(".fixTable").tableHeadFixer();
        $(".divinfo input").prop("readonly", true);


    });

    setTimeout(function(){
        tblstorename();
        $(".fixTable").tableHeadFixer();
        // $(".divinfo input").prop("disabled", true);
    }, 3000);

    function tblstorename() {
        var srchhistory = $("#srchhistory").val();

        $.ajax({
            type: 'POST',
            url: 'tenantshistory/historymainclass.php',
            data: 'srchhistory='+srchhistory+
            '&form=tblstorename',
            beforeSend : function() {
                $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
                $("#tblstorename").html(data);
                clicking();
            }
        });
    }

    function clicking(){
        $("#tblstorename tr").each(function(){
            $(this).click(function(){
                $("#tblstorename tr").removeClass("activated");
                $(this).addClass("activated");
            });
        });
    }

    function  thiscompany(mallname, compid, compname, storename, tid, fname, mname, lname, tradeid, filename) {
        $("#mallname").val(mallname);
        $("#compid").val(compid);
        $("#compname").val(compname);
        $("#storename").val(storename);
        $("#tenantid").val(tid);
        $("#fname").val(fname);
        $("#lname").val(lname);
        $("#mname").val(mname);
        $("#historylogo").attr("src", "server/company/"+compid+"/trades/"+tradeid+"/"+filename);
        tblstoreunit(tid);

        $(".mallname").text(mallname);
        $(".compid").text(compid);
        $(".compname").text(compname);
        $(".storename").text(storename);
        $(".tenantid").text(tid);
        $(".fname").text(fname);
        $(".lname").text(lname);
        $(".mname").text(mname);
        $("#printlogo").attr("src", "server/company/"+compid+"/trades/"+tradeid+"/"+filename);
    }

    function tblstoreunit(tid) {
        var tid = tid;

        $.ajax({
            type: 'POST',
            url: 'tenantshistory/historymainclass.php',
            data: 'tid='+tid+
            '&form=tblstoreunit',
             beforeSend : function() {
                $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
                 $("#tblstoreunit").html(data);
                 $("#printtblstoreunit").html(data);
             }
        });
    }

    function printhistory(){
        var laman = $("#tblstoreunit tr").length;
        if(laman == 0){
            alert("Sorry, no data found.");
        }else{

            var toPrint = document.getElementById("historyreportgo");
            var popupWin = window.open('', '_blank', 'width=900,height=500,location=no,');
            popupWin.document.open();
            popupWin.document.write('<html><title>Tenant History Report</title><link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" /><style>*{font-style: arial !important; font-size: 12px !important} #historyreportgo{display:block !important;} #storeinfotable tr{font-size: 12px !important; font-family: arial !important; } #storeinfotable td{text-align: left !important;} #storeinfotable thead{border: 1px solid gray !important; background-color: #438EB9 !important; color: white !important; font-size: 12px} #tblstoreunit tr{border-bottom: 1px solid grey !important;} #tblstoreunit td{font-size: 12px !important; font-weight: 200 !important;} </style><header style="font-size: 16px; font-weight: 700;">Tenant History </header><br><br><body onload="window.print();">' );

            popupWin.document.write( toPrint.innerHTML);
            popupWin.document.write('</body></html>');
            popupWin.document.close();
        }
    }

</script>
