<?php 
include('connect.php'); 
// include('inquiry/new_inquiry.php');
?>
<script>
    $(function(){
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $("#txt_bldgpage").val("1");
        bldginventory();
        displaybldgname();
        mallnamee();

        $('#bldgabb').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
        
        bldgamenities();
        $("#bldginventory").niceScroll({cursorcolor:"#999"});
       
    });


    // function location_modal(){

    //   $("#location_modal").modal("show");
    // }

    function bldginventory(){
        var page = $("#txt_bldgpage").val();
        var key = $("#txt_bldgpage").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'key=' + key + '&page=' + page + '&form=bldginventory',
            success:function(data){
                // var arr = data.split("|");
                // alert(arr[1]);
                $("#bldginventory").html(data);
                $(".scroll").niceScroll({cursorcolor:"#999"});
                loadpaginationbldg();
                loadentriesbldg();
            }
        });
    }

    function loadpaginationbldg() //added by melanie
        {
            var page = $("#txt_bldgpage").val();
            var key = $("#txt_bldgpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadpaginationbldg',
                success: function(data){
                    $("#ulpaginationbldg").html(data);
                }
            }).error(function() {
                alert(data);
            });
        }

    function getvalbldg(page, pagenums) //added by melanie
        {
            // alert(page);
                $(".pgnumptnts").removeClass("active");
                var value = "#" + pagenums;
                $("#pgptnts" + pagenums).addClass("active");
                $("#txt_bldgpage").val(page);
                // reloadhmo();
                bldginventory();
                loadpaginationbldg();
                loadentriesbldg();
        }

    function loadentriesbldg() //added by melanie
        {
            var page = $("#txt_bldgpage").val();
            var key = $("#txt_bldgpage").val();
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'key=' + key + '&page=' + page + '&form=loadentriesbldg',
                success: function(data){
                    if(data == "no data")
                    {
                        $("#txtbldgentries").text("");
                    }
                    else
                    {
                        $("#txtbldgentries").text(data);
                    }
                }
            }).error(function() {
                alert(data);
            });
        }       


    function addbldg(){
        generateid();
        bldgthumbnail();
        bldgamenities();
        $("#btnsave").text("Save");
        $("#btndelete").hide();
        // $("#roomnumber").prop("disabled", false);
        $("#modalnewbldg").modal("show");
    }

    function selectbldg(multiunit, bldgnumber, bldgtype, bldgname, bldgabb, nooffloors, noofrooms, address, city, province, zipcode, fulladdress){
        $("#btnsave").text("Update");
        $("#btndelete").show();

        $("#hiddennumber").val(bldgnumber);
        $("#generatedit").val(bldgnumber);
        
        $("#multiunit").val(multiunit);
        $("#bldgtype").val(bldgtype);
        $("#bldgname").val(bldgname);
        $("#bldgabb").val(bldgabb);
        $("#nooffloors").val(nooffloors);
        $("#noofrooms").val(noofrooms);

        $("#address").val(address);
        $("#city").val(city);
        $("#province").val(province);
        $("#zipcode").val(zipcode);
        $("#fulladdress").val(fulladdress);

        bldgthumbnail();
        bldgamenities();
        // $("#roomnumber").prop("disabled", true);
        $("#modalnewbldg").modal("show");
    }

    function modalbldgclose(){
        generateid();
        $("#btndelete").hide();
        $("#hiddennumber").val("");
        $("#generatedit").val("");
        $("#modalnewbldg").modal("hide");
    }

    function savebldg(){
        var hiddennumber = $("#hiddennumber").val();

        var multiunit = $("#multiunit").val();
        var bldgtype = $("#bldgtype").val();
        var bldgname = $("#bldgname").val();
        var bldgabb = $("#bldgabb").val();
        var nooffloors = $("#nooffloors").val();
        var noofrooms = $("#noofrooms").val();

        var address = $("#address").val();
        var city = $("#city").val();
        var province = $("#province").val();
        var zipcode = $("#zipcode").val();

        var fulladdress = $("#fulladdress").val();
        var bldgdesc = $("#bldgdesc").val();

        var wcutoff = $("#wcutoff").val();
        var wduedate = $("#wduedate").val();
        var ecutoff = $("#ecutoff").val();
        var eduedate = $("#eduedate").val();
        var mallidd = $("#mallidd").val();
        var mallname3 = $("#mallname3").val();

        var bldgamenities = "";
            $(".bldg:checked").each(function(){
                bldgamenities += "|" + this.value;
            });

        var reffloors = "";
            $("#floorrooms tr").each(function(){
                reffloors += "#|" +  bldgname + "|" + $(this).find(".rowflrname").text() + "|" + $(this).find(".rowflrroom").text();
            });
            // alert(reffloors);
            
            $.ajax({
                type:'POST',
                url:'mainclass.php',
                data:'hiddennumber='+ hiddennumber +'&multiunit='+ multiunit +'&bldgtype='+ bldgtype +'&bldgname='+ bldgname +'&bldgabb='+ bldgabb +'&nooffloors='+ nooffloors +'&noofrooms='+ noofrooms +'&address='+ address +'&city='+ city +'&province='+ province +'&zipcode='+ zipcode +'&bldgamenities='+ bldgamenities +'&fulladdress='+ fulladdress +'&reffloors='+ reffloors +'&bldgdesc='+ bldgdesc +'&wcutoff='+ wcutoff +'&wduedate='+ wduedate +'&ecutoff='+ ecutoff +'&eduedate='+ eduedate + '&mallidd='+ mallidd + '&mallname3='+ mallname3 + '&form=savebldg',
                success: function(data){
                    alert(data);
                    $("#hiddennumber").val(data);
                    $("#modalnewbldg").modal("hide");
                    bldginventory();
                    generateid();
                }
            });
    }

    function deletebldg(){
        var hiddennumber = $("#hiddennumber").val();
        
        var msg = confirm("Do you want to delete this building?");
        if(msg==true){
                    $.ajax({
                        type:'POST',
                        url:'mainclass.php',
                        data:'hiddennumber='+ hiddennumber +'&form=deletebldg',
                        success:function(data){
                            alert(data);
                            $("#modalnewbldg").modal("hide");
                            bldginventory();
                        }
                    });
        }else{
            // Nothing happen
        }
    }

    function generateid(){
        $.ajax({
            type:'POST',
            url:'mainclass.php',
            data: '&form=generateid',
            success: function(data){
                $("#generatedit").val(data);
            }
        });
    }

    function displaybldgname(){
        $.ajax({
            type:'POST',
            url:'mainclass.php',
            data:'&form=displaybldgname',
            success:function(data){
                $("#bldgname").html(data);
            }
        });
    }

    function displayfullbldgadd(key){
        $.ajax({
            type:'POST',
            url:'mainclass.php',
            data:'key='+key+'&form=displayfullbldgadd',
            success:function(data){
                var arr = data.split("|");
                $("#fulladdress").val(arr[1]);
            }
        });
    }

    // ================================================================
     function mallnamee(){
        $.ajax({
            type:'POST',
            url:'mainclass.php',
            data:'&form=mallnamee',
            success:function(data){
                // alert(data);
                $("#mallnamee").html(data);
            }
        });
    }

    function mallnameinfo(key){
        var mallname = $("#mallnamee").val();
        $.ajax({
            type:'POST',
            url:'mainclass.php',
            data:'mallname='+mallname+  '&form=mallnameinfo',
            success:function(data){
                // alert(data);
                var arr = data.split("|"); 
                $("#mallidd").val(arr[1]);
                $("#mallname3").val(arr[2]);
            }
        });
    }

    function bldgamenities(){
        var generatedit = $("#generatedit").val();

        $.ajax({
            type:'POST',
            url:'mainclass.php',
            data:'generatedit='+generatedit+'&form=bldgamenities',
            success: function(data){
                $("#bldgamenities").html(data);
            }
        })
    }

    function unitamenities(){
        $.ajax({
            type:'POST',
            url:'mainclass.php',
            data:'&form=unitamenities',
            success: function(data){
                $("#unitamenities").html(data);
            }
        })
    }

    function modaluploadbldg(){
        var generatedit = $("#generatedit").val();
        if(generatedit == ""){
            // alert("Fill-up the room number, before add an images.");
        }else{
            $.ajax({
                type:'POST',
                url:'mainclass.php',
                data:'generatedit='+generatedit+'&form=createfolder',
                success:function(data){
                    $("#uploadfilebldg").attr("src", "susi3.php?generatedit=" + generatedit);
                    $("#uploadattachbuidling").modal("show");
                }
            });
        }
    }

    function bldgthumbnail(){
        var generatedit = $("#generatedit").val();

        $.ajax({
            type:'POST',
            url:'mainclass.php',
            data:'generatedit='+generatedit+'&form=bldgthumbnail',
            success: function(data){
                $("#bldgthumbnail").html(data);
            }
        });
    }

    function openfloormodal(){
       var nooffloors = $("#nooffloors").val();

        if(nooffloors == ""){
            alert("Enter the number of the floors.");
        }else{
            $("#modalfloor").modal("show");
        }
    }

    function addfloor(){
        var count = $("#floorrooms tr").length;
        var nooffloors = $("#nooffloors").val();

        var floorname = $("#floorname").val();
        var flrroom = $("#flrroom").val();

        if(count == nooffloors){
            alert("You reach the maximum number of the floors that you have entered.")
        }else{
            $("#floorrooms").append("<tr class='flrrow' onclick='removeLine();'><td width='300px' class='rowflrname'>"+ floorname +"</td><td width='100px' class='rowflrroom'>"+ flrroom +"</td></tr>");
        
            count ++;
        }
    }

    function removeLine() {
        $(".flrrow").each(function(){
            $(this).click(function(){
                $(this).remove();
            })
        });
    }

    function savefloormodal(){
        var sum = 0.0;
        $('.rowflrroom').each(function(){
                if($(this).text() == ""){
                    alert("Fill up all the number of rooms.");
                }else{
                    sum += parseFloat($(this).text());
                }
        });
                $("#noofrooms").val(sum || 0);
                $("#modalfloor").modal("hide");
    }

    function closefloormodal(){
        $(".flrrow").remove();
        $("#modalfloor").modal("hide");
    }

    $(function(){
        loadlocationlist();
        displayfullbldgadd(); 

    $("#btncompleteadd").click(function(){
    
            $("#btnsaveadd").prop("disabled", false);
     
            });

    });


    function new_location(){
        $("#colortitle").text("New Amenities");
        $("#location_modal").modal("show");
        $("#txtamenitiesname").val("");
        $("#txtabbreviation").val("");
    }

    function loadlocationlist(){
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=loadlocationlist',
            success: function(data){
                $("#tblocationlist").html(data);
            }
        });
    }

    function searchlocation(key)
        {
            $.ajax({
                type: 'POST',
                url: 'paula_mainclass.php',
                data: 'key=' + key + '&form=searchlocation',
                success: function(data){
                    $("#tblocationlist").html(data);
                    loadlocationlist(); 
                }
            }).error(function() {
                alert(data);
            });
        }

    function applylocationclick(locationid, buildingname, completeaddress){
        $("#tblocationlist tr").each(function(){
            $(this).click(function(){
                $("#tblocationlist tr").removeClass("active");
                $(this).addClass("active");
                $("#txtlocationid").val(locationid);
                $("#txtbuildingnamelocation").val(buildingname);
                $("#completeaddress").val(completeaddress);
                
                $("#location_modal").modal("show");

            });
        });
    }

    // loading of brgy
    function getbrgy(){
        var val = $("#txtcity").val();
        $.ajax({
            type: 'POST',
            url: 'address_mainclass.php',
            data: 'val=' + val + '&form=searchcity',
            success: function(data) {
                $("#databarangay2").html(data);
            }
        });
     }

    // loading of province
    function getcty(){
        var val = $("#txtcity").val();
        $.ajax({
            type: 'POST',
            url: 'address_mainclass.php',
            data: 'val=' + val + '&form=searchprovince',
            success: function(data) {
                // alert(data);
                $("#txtprovince").val(data);
                getprvnce();
            }
        });
     }

    // loading of region
    function getprvnce(){
    
        var val = $("#txtprovince").val();
        $.ajax({
            type: 'POST',
            url: 'address_mainclass.php',
            data: 'val=' + val + '&form=searchregion',
            success: function(data) {
                // alert(data);
                $("#txtregion").val(data);
            }
        });
     }

    function addnewlocation(){
        var locationid = $("#txtlocationid").val();
        var str = "";
        var str2 = "";
        if(locationid == "")
        {
            str = "Save Location?";
            str2 = "Location has been saved";
        }
        else
        {
            str = "Update Location?";
            str2 = "Location has been updated";
        }
        var conf = confirm(str);
        if(conf == true)
        {
            alert(str2);
            var locationid = $("#txtlocationid").val();
            var completeaddress = $("#completeaddress").val();
            var txtbuildingnamelocation = $("#txtbuildingnamelocation").val();
                
            $.ajax({
                type: 'POST',
                url: 'mainclass.php',
                data: 'locationid=' + locationid + '&completeaddress=' + completeaddress + '&txtbuildingnamelocation=' + txtbuildingnamelocation + '&form=addnewlocation',
                success: function(data) {
                    // alert(data);
                    $("#tblocationlist").html(data);
                    loadlocationlist();
                    $('#location_modal').modal('hide');
                    displayfullbldgadd(); 
                }
            });
        }
    }

     function clearaddress(){
        $("#txtbarangay").val("");
        $("#txtprovince").val("");
        $("#txtregion").val("");
     }

     function submitregionprovince(){

        var unitroomno1 = $("#unitroomno").val();
        var buildingname1 = $("#txtbuildingnamelocation").val();
        var lotnoblockno1 = $("#lotnoblockno").val();
        var streetname1 = $("#streetname").val();
        var subdivision1 = $("#subdivision").val();
        var txtregion1 = $("#txtregion").val();
        var txtprovince1 = $("#txtprovince").val();
        var txtcity1 = $("#txtcity").val();
        var txtbrgy1 = $("#txtbarangay").val();

        if(unitroomno1 == ""){ var unitroomno = ""; }else { var unitroomno = unitroomno1 + " ,"; }
        if(buildingname1 == ""){ var buildingname = "";} else { var buildingname = buildingname1 + " ,"; }
        if(lotnoblockno1 == ""){ var lotnoblockno = "";} else { var lotnoblockno = lotnoblockno1 + " ,"; }
        if(streetname1 == ""){ var streetname = "";} else { var streetname = streetname1 + " ,"; }
        if(subdivision1 == ""){ var subdivision = "";} else { var subdivision = subdivision1 + " ,"; }
        if(txtregion1 == ""){ var txtregion = "";} else { var txtregion = txtregion1 + " ,"; }
        if(txtprovince1 == ""){ var txtprovince = "";} else { var txtprovince = txtprovince1 + " ,"; }
        if(txtcity1 == ""){ var txtcity = "";} else { var txtcity = txtcity1 + " ,"; }
        if(txtbrgy1 == ""){ var txtbrgy = "";} else { var txtbrgy = txtbrgy1 + " ,"; }

        $("#completeaddress").val(unitroomno + buildingname + lotnoblockno + streetname + subdivision + txtbrgy + txtcity + txtregion + txtprovince + " PHILIPPINES");
        // $("#location_modal").modal("hide");
    }
</script>

<style>
    .fornewroom {
        max-height: calc(92vh - 120px);
        overflow-y: auto;
    }
    /* Let's get this party started */
    ::-webkit-scrollbar {
        width: 5px;
    }
     
    /* Track */
    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px #eee; 
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #333; 
        -webkit-box-shadow: inset 0 0 6px #333; 
    }
    ::-webkit-scrollbar-thumb:window-inactive {
        background: rgba(255,0,0,0.4); 
    }
</style>
<div class="row">
    <div class="col-xs-12" style="padding: 10px !important;">
        <div class="pull-left" style="padding-top:10px;">
            <b class="text-primary" style="margin-top: 15px !important;">Building List</b>
            <input type="hidden" id="txt_bldgpage" name="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <!-- <form class="form-search"> -->
            <span class="input-icon" style="width: 100%;">
                <input type="text" class="form-control" placeholder="Search ..." id="txtscrinvest" onkeyup="bldginventory()">
                <i class="ace-icon fa fa-search nav-search-icon"></i>
            </span>
        <!-- </form> -->
    </div>
    <div class="col-md-4 col-xs-12">
    </div>
    <div class="col-md-2 col-xs-6">
            <!-- <a href="#" id="" class="btn btn-danger btn-sm" style="width: 100% !important;">Delete</a> -->
    </div>
    <div class="col-md-2 col-xs-6">
            <a href="#" id="btn_modalnewbldg" class="btn btn-default btn-sm" style="width: 100% !important;" onclick="$('#modalnewbldg').modal('show');">New Building</a>
    </div>  
</div>
<div class="row" style="padding: 10px !important;overflow-x: auto;">
    <table id="simple-table" class="table  table-bordered table-hover" style="display: flex;flex-flow: column;height: 100%;width: 100%;margin-bottom: 0px !important;">
        <thead style="flex: 0 0 auto;width: calc(100%);">
            <tr style="display: table;table-layout: fixed;width: 100%;display: table;">
                <!-- <th class="center">
                    <label class="pos-rel">
                        <input type="checkbox" class="ace" />
                        <span class="lbl"></span>
                    </label>
                </th> -->
               <td>Building Name</td>
               <td>Classification</td>
               <td class="hide_mobile">No. of Floors</td>
               <td class="hide_mobile">No. of Rooms</td>
               <td class="hide_mobile">Building Address</td>
               <td class="hide_mobile">Mall Name</td>
               <td>Option</td>                                                      
            </tr>
        </thead>
        <tbody id="bldginventory" style="flex: 1 1 auto;display: block;height: 16em;overflow-x: hidden;">

        </tbody>
    </table>
    <table class="tabledash_footer table" style="margin: 0px !important;">
        <thead>
            <tr>
                <th id="th_tabledash_footer" width="" colspan="7" style="width: 911px;">
                <font style="float: left; color: #777 !important;margin-top: 17px;margin-left: 15px;font-weight: normal;font-weight: 8px !important;" id="txtbldgentries"></font>
                    <div class="pagination">
                        <ul id="ulpaginationbldg"></ul>
                    </div>
                </th>
            </tr>
        </thead>
</table>
</div>

<!-- ==================================  NEW BUILDING MODAL  ======================================= -->
<div  class="modal fade" id="modalnewbldg" area-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;">Add New Building/Wing</h4>
            </div>
            
                <div class="modal-body fornewroom">
                    
                </div>
                <!-- End of Modal-body -->
                <div class="modal-footer">
                    <button id="btnsave" class="btn btn-primary" onclick="savebldg();">Save</button>
                </div>
        </div>
    </div>
</div>
<!-- ===================================================================================================== -->


<script>
function loadmodal_modalnewbldg()
{
    $("#modalnewbldg").modal("show");
    $(".text_modalnewbldg").val("");
}
</script>