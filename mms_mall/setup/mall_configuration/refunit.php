
<div class="page-header">
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6" style="padding-bottom: 5px;">
        <span class="input-icon" style="width: 100%;">
            <input type="text" class="form-control" placeholder="Search Unit Name..." id="txtsearchamenities" onkeyup="loadunit()">
            <i class="ace-icon fa fa-search nav-search-icon"></i>
        </span>
    </div>
    <div class="col-xs-12 col-sm-3">
        <!-- <a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_wing()">New Wing</a> -->
    </div>
    <div class="col-xs-12 col-sm-3">
        <a href="#" id="btn_mall" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="loadmodal_unit()">New Unit</a>
    </div>
</div>
<input type="hidden" id="txt_unitpage" name="">
<table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
    <thead style="flex: 0 0 auto;width: calc(100%);">
        <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
            <td>Unit</td>
            <td class="hide_mobile">Wing</td>
            <td class="hide_mobile">Floor</td>
            
            <td class="hide_mobile">Type of Business</td>
            <td class="hide_mobile">Classification</td>
            <td>Option</td>                                     
        </tr>
    </thead>
    <div id="div_unit_table"></div>
    <tbody id="tblunitlist" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

    </tbody>
</table>
<table class="tabledash_footer table" style="margin: 0px !important;">
    <thead>
        <tr>
            <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;padding-bottom: 15px;padding-top: 15px;">
            <font style="float: left; color: white !important;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtunitentries"></font>
                <ul id="ulpaginationunit" class="pagination pull-right"></ul>
            </th>
        </tr>
    </thead>
</table>



  <script>
  $(function(){
    $("#txt_unitpage").val("1");
    numonly();
    loadunit();
    $("#tblunitlist").niceScroll({cursorcolor:"#999"});
    // $("#tblamenitiesreflist").niceScroll({cursorcolor:"#999"});   
    $('.upper').keyup(function() {
            $(this).val($(this).val().toUpperCase());
    });
    $('#txtbustype option[value=SET]').prop('selected','selected');
});

    function numonly()
    {
       $(".numonly").keydown(function(event) {

           // Allow only backspace and delete
           if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 190) {
               // let it happen, don't do anything
           }
           else {
               // Ensure that it is a number and stop the keypress
               if (event.keyCode < 48 || event.keyCode > 57 ) {
                   event.preventDefault(); 
               }   
           }
       });

       // $(".numonly").keyup(function(){
       //       $(this).val(parseFloat(($(this).val())|| 0).toFixed(2));
       // })

       $(".amount").change(function(){
            var v = parseFloat($(this).val());
            $(this).val((isNaN(v)) ? '' : v.toFixed(2));
       });
    }

    function addnewrefamenities()
    {
        $("input[name='count_type']").prop("selected", false);
        $("#txtaddnewrefame").val("");
        $("#modal_addnewrefamenities").modal("show");
        loadtblamenitiesreflist();
    }

    function closemodalrefam()
    {
        $("#modal_addnewrefamenities").modal("hide");
    }

    function checkamenities(chk)
    {
        if($("#trsschk_"+chk).is(":checked"))
        {
             $("#trss_"+chk).css("display", "table");
        }
        else
        {
            $("#trss_"+chk).css("display", "none");
        }
       
    }

    function addamenitiesselected()
    {
        var a = 0;
        var b = 0;
        var c = 0;
        var amenities = "";
        $("#tblamenitiesreflist .amenities_chk").each(function(){
            if($(this).is(":checked"))
            {
                c++
                var value = $(this).attr("value");
                var lbl = $("#amenities_chk_"+value).text();
                var qty = $("#txtqty_"+value).val();

                if(qty == undefined)
                {
                    var thisqty = "1";
                }
                else
                {
                    a++;
                    if(qty == "" || qty.match(/^\s*$/))
                    {

                    }
                    else
                    {
                        b++;
                        var thisqty = qty;
                    }
                }
                
                if(a == b)
                {
                    
                    amenities += '<span class="tag tagval_'+value+'" id="span_'+value+'">'+lbl+'<button type="button" class="close">×</button><input type="hidden" value="'+thisqty+'" class="qty_amenities"><input type="hidden" value="'+value+'" class="chosen_amenities"></span>';
                    

                }
                else
                {
                    // alert("Enter qty!");
                }

            }

        });

        if(a == b)
        {
            if(c == 0)
            {
                showmodal("alert", "Check first your chosen amenity.", "", null, "", null, "1");
            }
            else
            {
                $("#div_amenitiesselected").html(amenities + '<br/><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label></div>');
                $("#modal_addnewrefamenities").modal("hide");                
            }
        }
        else
        {
            showmodal("alert", "Please enter qty.", "", null, "", null, "1");
        }      
        // alert(a + "|" + b)  
    }

    function loadtblamenitiesreflist()
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=loadtblamenitiesreflist',
            success: function(data)
            {
                $("#tblamenitiesreflist").html(data);
                numonly();
            }
        })
    }

    function loadunit()
    {
        var key = $("#txtsearchamenities").val();
        var page = $("#txt_unitpage").val();
        var mallid = $("#txtmall_id").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'key=' + key + '&page=' + page + '&mallid=' + mallid + '&form=loadunit',
            beforeSend : function() {
                $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
                $("#tblunitlist").html(data);
                $(".scroll").niceScroll({cursorcolor:"#999"});
                loadpaginationunit();
                loadentriesunit();
            }
        })
    }

    function loadpaginationunit() //added by melanie
        {
            var key = $("#txtsearchamenities").val();
            var page = $("#txt_unitpage").val();
            var mallid = $("#txtmall_id").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&mallid=' + mallid + '&form=loadpaginationunit',
                success: function(data){
                    $("#ulpaginationunit").html(data);
                }
            });
        }

    function getvalunit(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_unitpage").val(page);
                // reloadhmo();
                loadunit();
                loadpaginationunit();
                loadentriesunit();
        }

    function loadentriesunit() //added by melanie
        {
            var key = $("#txtsearchamenities").val();
            var page = $("#txt_unitpage").val();
            var mallid = $("#txtmall_id").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&mallid=' + mallid + '&form=loadentriesunit',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtunitentries").text("");
                    }
                    else
                    {
                        $("#txtunitentries").text(data);
                    }
                }           
            });
        } 

    function checkbustypevalue()
    {
        var mallid = $("#txtmall_id").val();
        var bus = $("#txtbustype").val();
        if(bus == "LCA")
        {
            $("#txtbuilding").removeClass("req_unit");
            $("#txtflr").removeClass("req_unit");
        }
        else if(bus == "SET")
        {
            $("#txtbuilding").removeClass("req_unit");
            $("#txtflr").removeClass("req_unit");   
            $("#txtbuilding").addClass("req_unit");
            $("#txtflr").addClass("req_unit");            
        }
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'bus=' + bus + '&mallid=' + mallid + '&form=checkbustypevalue',
            success:function(data){
                var arr = data.split("|")
                if(arr[0] != ""){
                    showmodal("alert", arr[0], "", null, "", null, "1");
                    $("#txtbustype").val("");
                }
            }
        })
    }                  

    function saveunit()
    {
        var i = 0;
        // $(".req_unit").each(function(){
        //     if($(this).val() == "" || ($(this).val()).match(/^\s*$/))
        //     {
        //         i++;
        //         $(this).css("border-color","#f2a696");
        //     }
        //     else
        //     {
        //         $(this).css("border-color","#D5D5D5");
        //     }
        // });

        if(i == 0)
        { 
            var assocdues = 0;
            $(".assocdues").each(function(){
                if ( $(this).is(":checked") == true ) {
                    assocdues = this.value;
                }
            })
            var id = $("#txtrefunit").val();
            var flrid = $("#txtflr").val();
            var wingid = $("#txtbuilding").val();
            var classid = $("#txtclasses").val();
            var depid = $("#txtdepartments").val();
            var catid = $("#txtcategories").val();

            var sqm_height = $("#txtsqm_height").val();
            var sqm_width = $("#txtsqm_width").val();
            var pricepersqm = $("#txtpricepersqm").val();
            var bldgname = $("#txtbuilding").val();
            var bldgid = $("#txtbuilding").attr("value");
            var unitname = $("#txtunitname").val();
            var bustype = $("#txtbustype").val();
            var bussid = $("#txtbustype").attr("value");

            var mallid = $("#txtmall_id").val();
            var max = $("#txtmaxnum").val();

            var amenities = "";
            $("#div_amenitiesselected .tag").each(function(){
                var qty = $(this).find(".qty_amenities");
                var chosen = $(this).find(".chosen_amenities");

                var qtyval = qty.val(); 
                var chosenval = chosen.val(); 
                amenities += "#"+chosenval+"|"+qtyval+"|";
            });
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + id + '&mallid=' + mallid + '&flrid=' + flrid + '&wingid=' + wingid + '&sqm_height=' + sqm_height + '&sqm_width=' + sqm_width + '&pricepersqm=' + pricepersqm + '&bldgid=' + bldgid + '&unitname=' + unitname + '&classid=' + classid + '&bustype=' + bustype + '&bussid=' + bussid + '&amenities=' + amenities + '&depid=' + depid + '&catid=' + catid + '&max=' + max + '&assocdues=' + assocdues + '&form=saveunit',
                success: function(data)
                {
                        if(data == "Already Existing.")
                        {
                            showmodal("alert", data, "", null, "", null, "1");
                            $('.req_unit').css("border-color","#f2a696");
                            // $(".textreq_unit").val("");
                            $("#txttoiletqty").prop("disabled", true);
                            $("#txttoiletqty").val("0");
                            $('input[value="no"]').prop("checked", true);
                            $("#div_amenitiesselected").html('<br/><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label></div>');
                        }
                        else if(data == "Successfully modified.")
                        {
                            showmodal("alert", data, "", null, "", null, "0");
                            $('.req_unit').css("border-color","#D5D5D5");
                            $(".textreq_unit").val("");
                            $("#txttoiletqty").prop("disabled", true);
                            $("#txttoiletqty").val("0");
                            $('input[value="no"]').prop("checked", true);
                            $("#div_amenitiesselected").html('<br/><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label></div>');
                           $("#modal_addnewunit").modal("hide");                              
                            loadunit();     
                        }
                        else
                        {
                            showmodal("alert", data, "", null, "", null, "0");
                            $('.req_unit').css("border-color","#D5D5D5");
                            $(".textreq_unit").val("");
                            $("#txttoiletqty").prop("disabled", true);
                            $("#txttoiletqty").val("0");
                            $('input[value="no"]').prop("checked", true);
                            $("#div_amenitiesselected").html('<br/><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label></div>');
                            loadunit();     
 
                        }
                }
            })
        }
        else
        {
            showmodal("alert", "Fill all required fields.", "", null, "", null, "1");
            $('.req_unit').each(function() {
                if ( this.value === '' ) {
                    this.focus();
                    return false;
                }
            });
        }
    }

    function editrefunit(unit)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + unit + '&form=editrefunit',
            success: function(data)
            {
                var arr = data.split("|");
                $("#txtrefunit").val(arr[16]);
                $('input[value="'+arr[8]+'"]:checked').val();
                $("#txttoiletqty").val(arr[9]);
                $("#txtmall_id").val(arr[12]);
                loadmallls(arr[12], arr[14]);    
                loadflrrrls(arr[12], arr[13]);   
                loadclassrls(arr[15]);   
                $("#txtsqm").val(arr[4]);
                $("#txtmaxnum").val(arr[26]);
                $("#txtpricepersqm").val(arr[5]);
                loadotherinfo_edit(arr[15], arr[25]);
                $("#txtunitname").val(arr[0]);
                $("#txtbustype").val(arr[2]);
                $("#txtsqm_height").val(arr[23]);
                $("#txtsqm_width").val(arr[22]);
                loadotherinfo2_edit(arr[25], arr[24])
                $("#modal_addnewunit").modal("show");
                getallamenities(unit);
            }
        })
    }

    function getallamenities(unitid)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + unitid + '&form=getallamenities',
            success: function(data)
            {
                $("#div_amenitiesselected").html(data);
            }
        })
    }

    function loadotherinfo_edit(classid, selected)
    {
        var classid = classid;

        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'class_id=' + classid + '&form=load_list_department',
            success: function(data)
            {
                $("#txtdepartments").html(data);
                $("#txtdepartments").val(selected);
            }
        })
    }

    function loadotherinfo2_edit(depids, selected)
    {
        var depid = depids;
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'dep_id=' + depid + '&form=load_list_category',
            success: function(data)
            {
                $("#txtcategories").html(data);
                $("#txtcategories").val(selected);
            }
        })
    }

    function loadmallls(mallid, selectedwing)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + mallid + '&form=loadmallls',
            success: function(data)
            {
                $("#txtbuilding").html(data);
                $("#txtbuilding").val(selectedwing); 
            }
        })

    }

    function loadmallls2()
    {
        var mallid = $("#txtmall_id").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + mallid + '&form=loadmallls',
            success: function(data)
            {
                $("#txtbuilding").html(data);
                
            }
        })

    }

    function loadflrrrls(mallid, selectedflr)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + mallid + '&form=loadflrrrls',
            success: function(data)
            {
                $("#txtflr").html(data);
                $("#txtflr").val(selectedflr); 
            }
        })

    } 

    function loadflrrrls2()
    {
        var wingid = $("#txtbuilding").val();

        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + wingid + '&form=loadflrrrls2',
            success: function(data)
            {
                $("#txtflr").html(data);
            }
        })

    } 

    function loadclassrls(selectedclass)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=loadclassrls',
            success: function(data)
            {
                $("#txtclasses").html(data);
                $("#txtclasses").val(selectedclass); 
            }
        })

    } 

    function loadclassrls2()
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=loadclassrls',
            success: function(data)
            {
               $("#txtclasses").html(data); 
            }
        })

    }        

    function delrefunit(unit)
    {
        var conf = confirm("Are you sure?");
        if(conf == true)
        {
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'id=' + unit + '&form=delrefunit',
                success: function(data)
                {
                    showmodal("alert", data, "", null, "", null, "0");
                    loadunit();
                }
            })
        }
    }

    function chkradiovalue()
    {
        var toilet = $('input[name="toilet"]:checked').val();
        if(toilet == "yes")
        {
            $("#txttoiletqty").prop("disabled", false);
            // $("#txttoiletqty").val("0");
        }
        else
        {
            $("#txttoiletqty").prop("disabled", true);
            $("#txttoiletqty").val("0");
        }
    }

    function getbldgwing()
    {
        var mallid = $("#txtmall").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + mallid + '&form=getbldgwing',
            success: function(data)
            {
                var arr = data.split("|");
                $("#txtbuilding").val(arr[0]);
                $("#txtbuilding").attr("value", arr[1]);
                loadflrwing(mallid, "");
            }
        })
    }

    function loadflrwing()
    {
        var mallid = $("#txtmall").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + mallid + '&form=loadflrwing',
            success: function(data)
            {
                $("#txtflr").html(data);
            }
        })
    }

    function loadflrwing2(mallid, selected)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + mallid + '&form=loadflrwing',
            success: function(data)
            {
                $("#txtflr").html(data);
                $("#txtflr").val(selected);
                
            }
        })
    }


    function loadwingflr()
    {
        var flrid = $("#txtflr").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + flrid + '&form=loadwingflr',
            success: function(data)
            {
                $("#txtbuilding").html(data);
            }
        })  
    }

    function loadwingflr2(flrid, selected)
    {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + flrid + '&form=loadwingflr',
            success: function(data)
            {
                $("#txtwing").html(data);
                $("#txtwing").val(selected);
            }
        })  
    }


    function loadotherinfo()
    {
        var classid = $("#txtclasses").val();

        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'class_id=' + classid + '&form=load_list_department',
            success: function(data)
            {
                $("#txtdepartments").html(data);
            }
        })
    }

    function loadotherinfo2()
    {
        var depid = $("#txtdepartments").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'dep_id=' + depid + '&form=load_list_category',
            success: function(data)
            {
                $("#txtcategories").html(data);
            }
        })
    }

    function loadmodal_unit()
    {
        $("#modal_addnewunit").modal("show");
        $(".text_unit").val("");
        $("#txttoiletqty").prop("disabled", true);
        $("#txttoiletqty").val("0");
        $('input[value="no"]').prop("checked", true);
        $('#txtbustype option[value=SET]').prop('selected','selected');
        $("#div_amenitiesselected").html('<br/><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label></div>');
    }

    function closeunitmodal()
    {
        $("#modal_addnewunit").modal("hide");
        $('#txtbustype option[value=SET]').prop('selected','selected');
        $("#div_amenitiesselected").html('<br/><label style="width: 100%;" onclick="addnewrefamenities()">Click to add amenities ..</label></div>');
    }
  </script>