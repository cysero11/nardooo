<script type="text/javascript">
    // setTimeout(function(){

    // }, 300)
    $("#modal_tenantinformation :input").prop("disabled", true);

    $(document).ready(function() {
        $(".fixTable").tableHeadFixer();
    });

    setTimeout(function(){
        $(".fixTable").tableHeadFixer();
        tbltenantlists();
        $("#txt_userpage_tenants").val("1");
        $("#txt_userpage").val("1");
        $("#txt_userpagepertenant").val("1");
        loadentriespertenant();
        displaycomplaintcode();
        activateaddendum();
    },300);

    $(function(){
        displaycomplaintcode();
        tbltenantlists();
        tblcontactinfo();
        tblaccountdetails();
        numonly();
        // changestatos();
        loadfilters_tenant('Tenant');
        var txtsearchtenantlist = $("#txtsearchtenantlist").val();
        var txtstatus =  $("#txtstatus").val();

        $("#acccheckstat").val("");

        var counter = 0;
        var interval = setInterval(function() {
            counter++;
            if (counter == 1){
                tbltenantlists();
                $.ajax({
                    type: 'POST',
                    url: 'tenants/tenantmainclass.php',
                    data: '&form=counttenantstatus',
                    success: function(data){
                        if(data > 0){
                            $("#cntnotify").text(data);
                            $("#modalnotify").modal("show");
                        }
                    }
                });
            }
        }, 1000);

        loaddsasasas();

        $("#savephoto").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'tenants/savetenantphoto.php',
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    alert(data);
                    showmodal("alert", "Tenant Image has been saved.", "", null, "", null, "0");
                    tbltenantlists();
                }
            })
        }));
    });

    $('[data-rel=tooltip]').tooltip();
    $('[data-rel=popover]').popover({html:true});

    function tbltenantlists(){
        var page = $("#txt_userpage").val();
        var key = $("#txtsearchtenantlist").val();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'page=' + page + '&key=' + key+
            '&form=tbltenantlists',
            beforeSend : function() {
                $('#indexloadingscreen').addClass('myspinner');
            },
            success: function(data){
                $('#indexloadingscreen').removeClass('myspinner');
                $("#tbltenantlists").html(data);
                loadpaginationuser();
                loadentriesuser();
            }
        });
    }

function loadcompanyposition22()
{
    $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'form=loadcompanyposition',
        success: function(data)
        {
            $("#txtcontact_designation").html(data);
        }
    })
}

    // new tenant modal
  function loadmodal_tenant_new()
    {
        $("#brdrwell_req").css("border-color", "#CCC");
        $("#status_filled").val("0");
        load_mall_select();
        load_mall_select_class();
        loadcompanyposition22();
        loadrequirements_tenants();
        $("#txttenanttypepercent").removeClass("required_inq");
        $("#txttenanttypepercent2").css("display", "none");
        $(".text_inquiry").prop("disabled", false);
        $("#txtinq_unitclass").prop("disabled", false);
        $("#txtremakrstext").text("Requirements and Remarks");
        $(".text_inquiry").val("");
        $(".required_inq").css("border-color","#D5D5D5");
        $("#txtinq_mallbranch").prop("disabled", false);
        $("#txtinq_remarks").prop("disabled", false);
        $("#txtinq_tradename").prop("disabled", false);
        $("#btn_savenewtenant").prop("disabled", false);
        $("#modal_addnewinquiry").modal("show");
        $("#div_modal_inquiry_remarks").prop("class", "col-md-6 col-xs-12");
        $("#div_modal_inquiry_requirements").css("display", "block");
        $("#div_modal_title_inquiry").text("New Tenant");
        $("#div_inquiry_contact_numbers").html('<center><img src="assets/images/phone-receiver.png" style="margin: 20px;"></center><center><h3>No contacts yet.</h3></center>');
        $("#div_inquiry_contact_person").html('<center><img src="assets/images/network.png" style="margin: 20px;"></center><center><h3>No contact persons yet.</h3></center>');
        $("#div_amenities_inquiry").html("");
        $("#btn_savenewtenant").attr("onclick", "saveinquiry()");
        $("#txtinq_datefrom").prop("disabled", false);
        $("#radio_set").prop("disabled", false);
        $("#radio_lca").prop("disabled", false);
        $("#tbodypdc_inquiry").html('');
        $("#lbltotalamountofpayment").text("0.00");
        $('#radio_set').prop("checked", true);
        $('#radio_lca').prop("checked", false);
        $("#div_advance_set").css("display", "block");
        $("#div_deposit_set").css("display", "block");
        $("#div_advance_set_amt").css("display", "none");
        $("#div_deposit_set_amt").css("display", "none");
        $("#txtinq_advancepayment").val("");
        $("#txtinq_depositpayment").val("");
        $("#txtinq_monthlyadvamt").attr("onkeyup", "loaddatefunction4()");
        $("#txtinq_monthlydepamt").attr("onkeyup", "loaddatefunction4()");
        $("#txtinq_mallbranch").focus();
        $("#div_unit_area_set").css("display", "block");
        $("#div_unit_area_lca").css("display", "none");
        $("#div_unit_set").css("display", "block");
        $("#div_unit_lca").css("display", "none");
        $("#txtinq_dateto").prop("disabled", true);
        $("#txtnoofdays_inq").val("");
        $("#txtnoofmonths_inq").val("0");
        $("#txtinq_monthlyadvamt").val("0");
        $("#txtinq_monthlydepamt").val("0");
        $("#txtinq_sqm").prop("disabled", true);
        $("#txtinq_persqm").prop("disabled", true);
        $("#txtinq_totalsqm").prop("disabled", true);
        $("#txtinq_monthlyadvamt").val("");
        $("#txtinq_monthlyadvamt").val("");
        $("#txtinq_monthlydepamt").val("");
        $("#txtinq_advancepayment").val("");
        $("#txtinq_depositpayment").val("");
        $("#div_unit_area_set").css("display", "block");
        $("#div_unit_area_lca").css("display", "none");
        $("#div_unit_set").css("display", "block");
        $("#div_unit_lca").css("display", "none");
        $("#txtinq_dateto").prop("disabled", true);
        $("#txtnoofdays_inq").val("");
        $("#txtnoofmonths_inq").val("0");
        $("#txtinq_monthlyadvamt").val("0");
        $("#txtinq_monthlydepamt").val("0");
        $("#txtinq_sqm_width").val("0");
        $("#txtinq_sqm_length").val("0");
        $("#div_businessinfo").click();
        $(".required_txt").text("");
        $("#txtinq_advancepayment2").removeClass("required_inq");
        $("#txtinq_depositpayment2").removeClass("required_inq");
        $("#txtinq_monthlyadvamt").removeClass("required_inq");
        $("#txtinq_advancepayment").removeClass("required_inq");
        $("#txtinq_monthlydepamt").removeClass("required_inq");
        $("#txtinq_depositpayment").removeClass("required_inq");
        $("#txtinq_lca_unitname").val("");
        $("#txtnoofmonths_inq").val("");
        $("#txtnoofdays_inq").val("");

        // merchandise class and unit info
        $("#txtinq_unitdepartment").prop("disabled", true);
        $("#txtinq_unitcategory").prop("disabled", true);
        $("#txtinq_unitwing").prop("disabled", true);
        $("#txtinq_unitfloor").prop("disabled", true);
        $("#txtinq_unitunit").prop("disabled", true);

        //set
        $("#txtinq_datefrom").prop("disabled", true);
        $("#txtnoofmonths_inq").prop("disabled", true);
        $("#txtinq_monthlyadvamt").prop("disabled", true);
        $("#txtinq_advancepayment").prop("disabled", true);
        $("#txtinq_monthlydepamt").prop("disabled", true);
        $("#txtinq_depositpayment").prop("disabled", true);
        $("#txtinq_monthlyrate2").prop("disabled", true);

        $("#div_nodays").css("display", "none");
        $("#txtinq_unitunit").removeClass("required_inq");
        $("#txtinq_lca_unitname").removeClass("required_inq");
        $("#txtinq_unitunit").addClass("required_inq");

        $("#txtinq_unitwing").removeClass("required_inq");
        $("#txtinq_unitfloor").removeClass("required_inq");
        $("#txtinq_unitwing").addClass("required_inq");
        $("#txtinq_unitfloor").addClass("required_inq");
        selected_unit();

        $.ajax({
          type: 'POST',
          url: 'mainclass.php',
          data: 'form=getfirstmall',
          success: function(data)
          {
            var arr = data.split("|");
            var a = $("#list_mallbranch").find('option[id="'+arr[0]+'"]');
            var endval_a = a.attr('value');
            $("#txtinq_mallbranch").val(endval_a);
          }
        })
    }

    function loadpaginationuser(){
        var page = $("#txt_userpage").val();
        var txtsearchtenantlist = $("#txtsearchtenantlist").val();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'page='+page+
            '&txtsearchtenantlist='+txtsearchtenantlist+
            '&form=loadpaginationuser',
            success: function(data){
                $("#ulpaginationitemlist").html(data);
            }
        });
    }

    function getvaluser(page, pagenums){
        $(".pgnumptnts").removeClass("active");
        var value = "#" + pagenums;
        $("#pgptnts" + pagenums).addClass("active");
        $("#txt_userpage").val(page);
        // reloadhmo();
        tbltenantlists();
        loadpaginationuser();
        loadentriesuser();
    }

    function loadentriesuser(){
        var page = $("#txt_userpage").val();
        var txtsearchtenantlist = $("#txtsearchtenantlist").val();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'page='+page+
            '&txtsearchtenantlist='+txtsearchtenantlist+
            '&form=loadentriesuser',
            success: function(data){
                if(data == ""){
                    $("#txtitemlistentries").html("<br />");
                }
                else{
                    $("#txtitemlistentries").text(data);
                }
            }
        });
    }

    function tblcontactinfo(){
        var compid = $("#txtcompid").val();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'compid='+compid+
            '&form=tblcontactinfo',
            success: function(data){
                $("#tblcontactinfo").html(data);
            }
        });
    }

    function tblrequirements(inqid){
        var id = $("#inqid").text();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'id='+id+
            '&form=tblrequirements',
            success: function(data){
                $("#tblrequirements").html(data);
            }
        });
    }

    function savereq(){
      var data = new FormData($('#posting_comments')[0]);
      var mgs = "";

      msg = confirm("Save the document?");
      if(msg == true){
            $.ajax({
              type:"POST",
              url:"tenants/uploadreq.php",
              data: data,
              mimeType: "multipart/form-data",
              contentType: false,
              cache: false,
              processData: false,
              success:function(data){
                //   alert(data);
                  showmodal("alert", ""+data+"", "$(\"#alertmodal\").modal(\"hide\")", "", null, "1");
                  tblrequirements();
              }
            });
      }else{
        //  Nothing happens
      }
    }

    function renewcontract(tenantid, inquiryid, companyID, TradeID, UnitID,  Inquiry_ID, mallid, type, Application_ID){
        $("#pangaddngtnc").attr("disabled", false);
        $("#pangclosewindow").attr("disabled", false);
        $("#alucard").val(Inquiry_ID);
        $("#yisunshin").val(UnitID);
        $("#yunzhao").val(tenantid);
        $("#clint").val(inquiryid);
        $("#eudora").val(companyID);
        $("#tigreal").val(TradeID);
        $("#estes").val(mallid);
        $("#saber").val(Application_ID);
        $("#moskov").val(type);
       $("#modal_tenantinformation").modal("show");
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tenantid=' + tenantid + '&inquiryid=' + inquiryid + '&form=inquiryinfosatenantmodule',
        success:function(data){
                var arr = data.split("|");
                $("#tenantmall").val(arr[0]);
                $("#tenantcompany").val(arr[1]);
                $("#tenantstore").val(arr[2]);
                $("#tenantindustry").val(arr[3]);
                $("#tenantaddress").val(arr[4]);
                $("#tenantbillingtype").val(arr[5]);
                $("#tenantmerchantcode").val(arr[6]);
                var arr2 = arr[7].split("-");
                $("#tenantownercardnum_01").val(arr2[0]);
                $("#tenantownercardnum_02").val(arr2[1]);
                $("#tenantownercardnum_03").val(arr2[2]);
                $("#tenantownercardnum_04").val(arr2[3]);
                $("#tenantimgtradeaccount").attr("src", arr[8]);
                $("#tenants_fname").val(arr[9]);
                $("#tenants_mname").val(arr[10]);
                $("#tenants_lname").val(arr[11]);
                $("#tenants_perm_add").val(arr[12]);
                $("#tenants_curr_add").val(arr[13]);
                $("#tenants_bill_add").val(arr[14]);
                $("#txtnoofmonths_tenants").val(arr[15]);
                $("#txtnoofdays_tenants").val(arr[16]);
                $("#tenants_advancepayment").val(arr[17]);
                $("#tenants_depositpayment").val(arr[18]);
                $("#tenants_monthlyadvamt").val(arr[20]);
                $("#tenants_monthlydepamt").val(arr[21]);
                $("#tenant_datefrom").val(arr[22]);
                $("#tenant_dateto").val(arr[23]);
                $("#ptenant_datefrom").val(arr[23]);
                $(".unittype123").each(function(){
                    if($(this).val() == arr[19])
                    { $(this).prop("checked", true); }
                });
                displayselected2(arr[22], arr[23]);
                if(arr[19] == "LCA"){
                    selectunitLCA(TradeID, UnitID, Inquiry_ID);
                    $("#txtlabel_payment2").text("Daily Payment");
                    $("#div_unit_set2").css("display", "none");
                    $("#div_unit_lca2").css("display", "block");
                    $("#div_advance_set2").css("display", "none");
                    $("#div_deposit_set2").css("display", "none");
                    $("#tenant_sqm").css("display", "none");
                    $("#div_advance_set_amt2").css("display", "block");
                    $("#div_deposit_set_amt2").css("display", "block");
                    $("#div_unit_area_set2").css("display", "none");
                    $("#div_unit_area_lca2").css("display", "block");
                    $("#div_nodays2").css("display", "block");
                }
                else if(arr[19] == "SET"){
                    selectunitset(TradeID, UnitID, Inquiry_ID);
                    $("#div_unit_area_lca2").css("display", "none");
                    $("#div_nodays2").css("display", "none");
                    $("#tenant_sqm").css("display", "block");
                    $("#txtlabel_payment2").text("Monthly Payment");
                     $("#div_advance_set2").css("display", "block");
                    $("#div_deposit_set2").css("display", "block");
                    $("#div_unit_set2").css("display", "block");
                    $("#div_unit_lca2").css("display", "none");
                    $("#div_advance_set_amt2").css("display", "none");
                    $("#div_deposit_set_amt2").css("display", "none");
                    $("#div_unit_area_set2").css("display","block");

                }
            }
        });
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'companyID=' + companyID + '&form=selectcontactnumbers',
        success:function(data){
                $("#div_tenantsadd_contact_numbers").html(data);
            }
        });
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'companyID=' + companyID + '&form=selectcontactpersons',
        success:function(data){
                $("#div_tenantsadd_contact_person").html(data);
            }
        });
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: '&appid=' + Application_ID + '&inqid=' + Inquiry_ID + '&form=loadrequirements_application',
            success: function(data)
            {
              $("#div_modal_tenants_requirements").html(data);
              uploadrequirementscss2();
            }
        });
        $("#div_businfoadd").click();
        loadamenities(UnitID);
        displaytnc54();
        selectfilterdisplay2();

        displayunitinformationtab();
    }

    function uploadrequirementscss2(){
    var tag_input = $('#form-field-tags');
      try{
        tag_input.tag(
          {
          placeholder:tag_input.attr('placeholder'),
          //enable typeahead by specifying the source array
          source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
          /**
          //or fetch data from database, fetch those that match "query"
          source: function(query, process) {
            $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
            .done(function(result_items){
            process(result_items);
            });
          }
          */
          }
        )

        //programmatically add/remove a tag
        var $tag_obj = $('#form-field-tags').data('tag');
        // $tag_obj.add('Programmatically Added');

        var index = $tag_obj.inValues('some tag');
        $tag_obj.remove(index);
      }
      catch(e) {
        //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
        tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
        //autosize($('#form-field-tags'));
      }

      $('.upload_app_req').ace_file_input({
        no_file:'No File ...',
        btn_choose:'Choose',
        btn_change:'Change',
        droppable:false,
        onchange:null,
        thumbnail:false //| true | large
        //whitelist:'gif|png|jpg|jpeg'
        //blacklist:'exe|php'
        //onchange:''
        //
      });
}

    function selectunitLCA(TradeID, UnitID, Inquiry_ID){
         $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'TradeID=' + TradeID + '&UnitID=' + UnitID + '&Inquiry_ID=' + Inquiry_ID + '&form=selectunit2',
        success:function(data){
                var arr = data.split("|");
                    $("#tenants_advancepayment2").val(arr[11]);
                    $("#tenants_depositpayment2").val(arr[10]);
                    $("#tenant_sqm_width").val(arr[1]);
                    $("#tenant_sqm_length").val(arr[2]);
                    $("#tenant_persqm").val(arr[3]);
                    $("#tenant_totalsqm").val(arr[4]);
                    $("#tenants_monthlyrate2").val(arr[4]);
                    loadpdctable(arr[4]);
            }
        });
    }

    function selectunitset(TradeID, UnitID, Inquiry_ID){
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'TradeID=' + TradeID + '&UnitID=' + UnitID + '&Inquiry_ID=' + Inquiry_ID + '&form=selectunit',
        success:function(data){
                var arr = data.split("|");
                    $("#tenant_sqm").val(arr[2]);
                    $("#tenant_persqm").val(arr[3]);
                    $("#tenant_totalsqm").val(arr[4]);
                    $("#tenants_monthlyrate2").val(arr[4]);
                    loadpdctable(arr[4]);
            }
        });
    }

    function cloasemodalandclear(){
        $("#modal_tenantinformation").modal("hide");
        $("#tbodypdc_inquiry2").html("");
        $(".tenantadd").val("");
        $(".tenantdisabled").attr("disabled", true);
        $("#tenant_unitclass").attr("disabled", true);
        $("#txtnoofmonths_tenants").attr("disabled", true);
        $("#tenants_monthlyadvamt").attr("disabled", true);
        $("#tenants_monthlydepamt").attr("disabled", true);
        $("#txtnoofdays_tenants").attr("disabled", true);
        $("#pangenable").removeClass("fa fa-times");
        $("#pangenable").addClass("fa fa-pencil-square-o");
        $("#pangenable").css("color", "green");
    }

    function loadpdctable(ttlamnt){
        var inqid = $("#alucard").val();
        var unit_id =  $("#yisunshin").val();
        var datefrom = $("#tenant_datefrom").val();
        var dateto = $("#tenant_dateto").val();
        var unittype123 = "";

        $(".unittype123").each(function(){
        if ( $(this).prop("checked") ) {
            unittype123 = this.value;
            }
        })
        if(unittype123 == "SET"){
            $.ajax({
                type: 'POST',
                url: 'tenants/tenantmainclass.php',
                data: 'datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + unittype123 + '&ttlamnt=' + ttlamnt + '&unit_id=' + unit_id + '&inqid=' + inqid + '&form=loadtbodypdc_inquiry1',
            success:function(data){
                    $("#tbodypdc_inquiry2").html(data);
                }
            })
        }
        else if(unittype123 == "LCA"){
            $.ajax({
                type: 'POST',
                url: 'tenants/tenantmainclass.php',
                data: 'datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + unittype123 + '&ttlamnt=' + ttlamnt + '&unit_id=' + unit_id + '&inqid=' + inqid + '&form=loadtbodypdc_inquiry2',
            success:function(data){
                // alert(data);
                    $("#tbodypdc_inquiry2").html(data);
                }
            })
        }
    }

    function loaddatetofunction3(){
        var months = $("#txtnoofmonths_tenants").val();
        var dateto = $("#tenant_dateto").val();
        var days = $("#txtnoofdays_tenants").val();
        var datefrom = $("#tenant_datefrom").val();
        var ttlamnt = $("#tenant_totalsqm").val();
        var unittype123 = "";

        $(".unittype123").each(function(){
        if ( $(this).prop("checked") ) {
            unittype123 = this.value;
            }
        })

        var unit_id = $("#txtinq_unitunit").val();
        if(datefrom != ""){
          $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&ttlamnt=' + ttlamnt + '&form=loadtbodypdc_inquiry2',
            success: function(data){
                var arr = data.split("|");
                $("#tenant_totalsqm").text("Php " + arr[0]);
            }
            })
        }
    }

    function loadamenities(selected){
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'unit_id=' + selected + '&form=selected_unit_amenities',
        success: function(data){
              $("#div_amenities_inquiry2").html(data);
            }
        })
    }


    function displaytnc54(){
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=displaytnc',
            success: function(data){
                $("#displaytnc2").html(data);
                clickReservation54();
            }
        })
    }

    function modal_tnccheckbox2(){
        $("#modal_tenantstncadd").modal("show")
        var id = $("#alucard").val();
        $.ajax ({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + id + '&form=searchChecked',
            success:function(data) {
                $("#nakacheck").val(data.trim());
                checkSelected54();
                clickReservation54();
            }
        })
    }

    function checkSelected54() {
        var allselected = $("#nakacheck").val();
        var arr = allselected.split("|");

        for ( var a = 0; a <= arr.length; a++ ) {
            $("." + arr[a]).attr("checked", true);
            $("#tr"+arr[a]).attr("style","background-color: #666 !important;color:#FFF !important");
            $("." + arr[a]).addClass("wagmonasubukin");

        }
    }

    function clickReservation54(){

        $("#displaytnc2 tr").each(function(){
            $(this).click(function(){
                eto = $(this).find(".checkbox");

                if( $(this).find(".wagmonasubukin").attr("checked") == "checked" ){
                    //
                }
                else{
                    if ( eto.is(":checked") ) {
                        var ids = $("#chineckan").val();
                        eto.prop("checked", false);

                        $("#chineckan").val(ids.replace($(this).find(".checkbox").val() + "|", ""));
                        $(this).css("color","");
                        $(this).css("background-color","");
                    }

                    else {
                        var ids = $("#chineckan").val();
                        eto.prop("checked", true);
                        ids += $(this).find(".checkbox").val() + "|";

                        $("#chineckan").val(ids);
                        $(this).css("color","#FFF");
                        $(this).css("background-color","#666");
                    }
                }

            })
        })
    }

    function selectfilter2(id) {
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'id=' + id + '&form=selectfilter',
            success: function(data) {
                    $("#displaytnc2").html(data);
                    clickReservation54();
                    checkSelected54();
                }
        })
    }

    function selectfilterdisplay2(){
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'form=selectfilterdisplay',
            success: function(data){
                $("#selectfilterdisplay2").html(data);
            }
        })
    }

    function displayselected2(datefromlabas, datetolabas){
        var invi = $("#alucard").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: "invi=" + invi + '&datefromlabas=' + datefromlabas + '&datetolabas=' + datetolabas + '&form=displayselected2',
            success: function(data){
                $("#displayselected2").html(data);
            }
        })
    }

    function modaleviction(tid, type, tenantid, inqid, appid){
        if(type == "eviction"){
            $("#eviction").show();
            $("#warning").hide();
        }        else{
            $("#eviction").hide();
            $("#warning").show();
        }
        $("#evictid").val(tid);
        $("#tidforwarning").val(tenantid);
        $("#iidforwarning").val(inqid);
        $("#aidforwarning").val(appid);
        $("#modaleviction").modal("show");
    }

    function eviction() {
        showmodal("confirm", "Evic This tenant?", "eviction2", null, "", null, "0");
    }

    function eviction2(){
        var tenantid = $("#evictid").val();
        var remarks = $("#remarksasdgas").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tenantid='+tenantid+
            '&remarks='+remarks+
            '&form=eviction',
            success: function(data){
                $("#remarks").val("");
                $("#modaleviction").modal("hide");
                tbltenantlists();
            }
        })
    }

    function warning(){
        showmodal("confirm", "Send a warning to this tenant?", "warning2", null, "", null, "0");
    }

    function warning2(){
        var tid = $("#tidforwarning").val();
        var iid = $("#iidforwarning").val();
        var aid = $("#aidforwarning").val();
        var remarks = $("#remarksasdgas").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tid=' + tid + '&iid=' + iid + '&aid=' + aid + '&remarks=' + remarks + '&form=warning',
        success:function(data){
                // alert(data);
                $("#alertmodal").modal("hide");
            }
        })
    }

    function showinfo(tid, start, end, unit, floor, wing, nomon, costmon, inqid, type, classi, area, pricearea, totalprice, stat, custname, company, appid, nodays, compid, imgname, imgtradeid, branch, remarks, merchant_code, billingttype, mallidprint, tenantphoto){
        $("#mallidprint").val(mallidprint);

        if(stat == "evicted" || stat == "inactive"){
            // $(".evict").prop("disabled", true);
            $(".evict").hide();
        }else{
            // $(".evict").prop("disabled", false);
            $(".evict").show();
        }

        if(tenantphoto == ""){
            $("#imglogo").attr("src", "server/company/"+compid+"/trades/"+imgtradeid+"/"+imgname);
        }else{
            $("#imglogo").attr("src", "tenants/tenantsimages/"+tenantphoto);
        }

        $("#hiddentenantidsapicture").val(tid);
        $("#Tid").text(tid);
        $("#inqid").text(inqid);
        $("#Sdate").val(start);
        $("#Edate").val(end);
        $("#unitno").val(unit);
        $("#floorno").val(floor);
        $("#wing").val(wing);
        // $("#unittype").val();

        $("#unittype").val(type);
        $("#unitclass").val(classi);
        $("#unitarea").val(area);
        $("#priceperarea").val(Number(pricearea).toLocaleString()+".00");
        $("#unitprice").val(Number(totalprice).toLocaleString()+".00");
        $("#remarkshere").val(remarks);

        $("#company").text(company);
        $("#contactp").text(custname);
        $("#branch").text(branch);

        $("#appidreq").val(appid);
        $("#inqidreq").val(inqid);


        $("#merchant_code").text(merchant_code);
        $("#billingttype").text(billingttype);



        if(stat == "actived"){
            $("#stathere").html("<span class='fa fa-flag' style='font-weight: 700; color: #DFE21A;'></span>&nbsp;&nbsp;Active");
        }else if(stat == "inactive"){
            $("#stathere").html("<span class='fa fa-flag' style='font-weight: 700; color: DarkGray;'></span>&nbsp;&nbsp;In-active");
        }else if(stat == "forrenewal"){
            $("#stathere").html("<span class='fa fa-flag' style='font-weight: 700; color: #428BCA;'></span>&nbsp;&nbsp;For Renewal");
        }else if(stat == "foreviction"){
            $("#stathere").html("<span class='fa fa-flag' style='font-weight: 700; color: red;'></span>&nbsp;&nbsp;For Eviction");
        }else{
            $("#stathere").html("<span class='fa fa-flag' style='font-weight: 700; color: grey;'></span>&nbsp;&nbsp;Evicted");
        }

        $("#nodays").val(nodays);
        $("#nomonths").val(nomon);
        $("#costpermonth").val(Number(costmon).toLocaleString()+".00");

        compute = "";
        unitcost = Number(costmon) * Number(nomon);
        $("#unitcost").text(Number(unitcost).toLocaleString()+".00");

        $("#txtcompid").val(compid);
        tblcontactinfo();
        tblaccountdetails();
        tblrequirements();
        tblpdc();
        tblpdc2();
        tblmaintenance();
        tblmaintenance2();
        tblcontract(tid,inqid);
        malltemplate();
        malltemplate2();
        malltemplate3();
        malltemplate4();
        displaytenantER(tid);
        displaytenantWR(tid);
        displaytenantPC(tid);
        $("#tenantinfo").modal('show');
    }

    function savecontactperson(){
        var Tid = $("#Tid").text();
        var inqid = $("#inqid").text();
        var conid = $("#conid").val();
        var compid = $("#txtcompid").val();
        var name = $("#fname").val() + " " + $("#mname").val() +", "+$("#lname").val();
        var confname = $("#fname").val();
        var conmname = $("#mname").val();
        var conlname = $("#lname").val();
        var designation = $("#designation").val();
        var address = $("#address").val();

        var paddingmob = "";
        $("#appendinfo .divko").each(function(){
            paddingmob += "#|" + "Mobile" + "|" + $(this).find(".mobno").val();
        });

        var paddingtelno = "";
        $("#appendinfo .divko").each(function(){
            paddingtelno += "#|" + "Telephone" + "|" + $(this).find(".telno").val();
        });

        var paddingemail = "";
        $("#appendinfo .divko").each(function(){
            paddingemail += "#|" + "Email" + "|" + $(this).find(".email").val();
        });

        if(name == "" || confname == "" || conmname == "" || conlname == "" || designation == "" || address == "" || $(".email").val() == "" || $(".telno").val() == "" || $(".mobno").val() == ""){
           showmodal("alert", "Fill-up all the informations.", "", null, "", null, "0");
        }else{
            var msg = "";
            msg = confirm("Do you want to save "+name+ " to your contacts?" );
            if(msg == true){
                $.ajax({
                    type: 'POST',
                    url: 'tenants/tenantmainclass.php',
                    data: 'Tid='+Tid+
                    '&conid='+conid+
                    '&compid='+compid+
                    '&name='+name+
                    '&confname='+confname+
                    '&conmname='+conmname+
                    '&conlname='+conlname+
                    '&paddingmob='+paddingmob+
                    '&paddingtelno='+paddingtelno+
                    '&paddingemail='+paddingemail+
                    '&designation='+designation+
                    '&address='+address+
                    '&form=savecontactperson',
                    success:function(data){
                        var arr = data.split("|");
                        alert(arr[0]);
                        sendData2(arr[1], arr[2]);
                        tblcontactinfo();
                        $("#modalcontactperson").find("input").val("");
                        $("#modalcontactperson").modal('hide');
                    }
                });
            }else{
                // alert("Nothing happens");
            }

        }
    }

    function sendData2(con, com){
    var compid = $("#txtcompid").val();
    $("#conidpic").val(con);
    $("#comidpic").val(compid);

      var data = new FormData($('#posting_contactimage')[0]);
      $.ajax({
        type:"POST",
        url:"tenants/uploadpic.php",
        data: data,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
        }
      });
    }

    function thisinfo(conid, confname, conmname, conlname, mobno, telno, email, designation){
        $("#conid").val(conid);
        $("#fname").val(confname);
        $("#mname").val(conmname);
        $("#lname").val(conlname);
        $("#mobno").val(mobno);
        $("#telno").val(telno);
        $("#email").val(email);
        $("#designation").val(designation);
        $("#modalcontactperson").modal('show');
    }

    function tblaccountdetails(){
        var tid = $("#Tid").text();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tid='+tid+
            '&form=tblaccountdetails',
            success: function(data){
                $("#tblaccountdetails").html(data);
            }
        });
    }

    function tblpdc(){
        var id = $("#inqid").text();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'id='+id+
            '&form=tblpdc',
            success: function(data){
                $("#tblpdc").html(data);
                thisrow();
            }
        });
    }

    function tblpdc2(){
        var id = $("#inqid").text();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'id='+id+
            '&form=tblpdc',
            success: function(data){
                $("#tblpdc2").html(data);
            }
        });
    }

    function choosepdc(pdcdate, accstat, lname, fname, checkno, bank, rcvby, depo, amount, stat, id, total1, total, depdate){
        var id = $("#inqid").text();

        if(stat == "Cleared"){
            $("#btnsavepdc").prop('disabled', true);
            $("#accbank").prop('disabled', true);
            $("#accreceiveby").prop('disabled', true);
            $("#accdepository").prop('disabled', true);
            $("#acccheckstat").prop('disabled', true);
        }else{
            $("#btnsavepdc").prop('disabled', false);
            $("#accbank").prop('disabled', false);
            $("#accreceiveby").prop('disabled', false);
            $("#accdepository").prop('disabled', false);
            $("#acccheckstat").prop('disabled', false);
        }

        $("#accpdcdate").val(pdcdate);
        $("#accbank").text(bank);
        $("#banko").text(bank);
        $("#acctnum").val(id);
        $("#acctname").val(fname+" "+lname);
        $("#accreceiveby").val(rcvby);
        $("#acccheckstat").val(stat);
        $("#accstat").val(accstat);
        $("#accamount").val(Number(amount).toLocaleString()+".00");
        $("#acccheckno").val(checkno);
        $("#accdepository").val(depo);
        $("#acctotal").val(total);
        $("#accdatedep").val(depdate);

        $("#amntwrd").text(toWords(amount)+" Pesos.");

    }

    // American Numbering System
    var th = ['','thousand','million', 'billion','trillion'];
    // uncomment this line for English Number System
    // var th = ['','thousand','million', 'milliard','billion'];
    var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine']; var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen']; var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety']; function toWords(s){s = s.toString(); s = s.replace(/[\, ]/g,''); if (s != parseFloat(s)) return 'not a number'; var x = s.indexOf('.'); if (x == -1) x = s.length; if (x > 15) return 'too big'; var n = s.split(''); var str = ''; var sk = 0; for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' '; i++; sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' '; if ((x-i)%3==0) str += 'hundred ';sk=1;} if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}} if (x != s.length) {var y = s.length; str += 'point '; for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';} return str.replace(/\s+/g,' ');}

    function thisrow(){
        $(".thisrow").each(function(){
            $(this).click(function(){
                $(".thisrow").removeClass("activated");
                $(this).addClass("activated");
            });
        });
    }

    function cancelpdctransaction(){
        $('#pdc').find(".form-control").val("");
        $("#accamount").val("");
        $("#amntwrd").text("");
        $("#banko").text("");
        $('.thisrow').removeClass('activated');
    }

    function savepdctransaction(){
		var id = $("#inqid").text();
        var tid = $("#Tid").text();

        var acctname =$("#acctname").val();
		var accpdcdate = $("#accpdcdate").val();
		var accbank = $("#accbank").text();
		var accreceiveby = $("#accreceiveby").val();
		var acccheckstat = $("#acccheckstat").val();
		var accstat = $("#accstat").val();
		var accamount = $("#accamount").val();
		var acccheckno = $("#acccheckno").val();
		var accdepository = $("#accdepository").val();
		var acctotal = $("#acctotal").val();
        var accdatedep = $("#accdatedep").val();

        var opt = $('#acccheckstat option:selected').map(function() {
            return this.value;
        }).get();

        if(opt != "Pending"){
            if(acctname == "" || accpdcdate == "" || accbank == "" || accreceiveby == "" || acccheckstat == "" || accstat == "" || accamount == "" || acccheckno == "" || accdepository == "" || acctotal == "" || accdatedep == ""){
                showmodal("alert", "Select and fill-up all the informations.", "", null, "", null, "0");
            }else{
                    var msg = "";
                    msg = confirm("Do you want to clear the PDC check no: "+acccheckno+"?");
                    if(msg == true){
                        $.ajax({
                            	type: 'POST',
                            	url: 'tenants/tenantmainclass.php',
                            	data: 'id='+id+
                                '&tid='+tid+
                            	'&acctname='+acctname+
                            	'&accpdcdate='+accpdcdate+
                            	'&accbank='+accbank+
                            	'&accreceiveby='+accreceiveby+
                            	'&acccheckstat='+acccheckstat+
                            	'&accstat='+accstat+
                            	'&accamount='+accamount+
                            	'&acccheckno='+acccheckno+
                            	'&accdepository='+accdepository+
                            	'&acctotal='+acctotal+
                                '&accdatedep='+accdatedep+
                            	'&form=savepdctransaction',
                            	success: function(data){
                            		$(".form-control").val("");
                                    $("input").text("");
                            		tblpdc();
                                    tblaccountdetails();
                            	}
                            });
                    }else{
                        // Nothing happens
                    }
            }
        }else{
            showmodal("alert", "Change the check status to be cleared.", "", null, "", null, "0");
        }
	}

    function tblmaintenance(){
        var tid = $("#Tid").text();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tid='+tid+
            '&form=tblmaintenance',
            success: function(data){
                $("#tblmaintenance").html(data);
            }
        });
    }

    function tblmaintenance2(){
        var tid = $("#Tid").text();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tid='+tid+
            '&form=tblmaintenance',
            success: function(data){
                $("#tblmaintenanceprint").html(data);
            }
        });
    }

    function viewimg(imgpath, kilowatt, cubicmeter) {
        $("#taskimg").attr("src", imgpath);
        $("#modalimg").modal("show");

        if(kilowatt != "" && cubicmeter == ""){
            $(".hovertext").attr("title", "Kilowatt reading: "+kilowatt+" Kw");
        }else{
            $(".hovertext").attr("title", "Cubic meter reading: "+cubicmeter+" m3");
        }

    }

    function viewdocuimg(imgpath) {
        $("#docuimg").attr("src", imgpath);
        $(".hoverdoc").attr("href", imgpath);
        $("#modaldocu").modal("show");
    }

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

       $(".amount").change(function(){
            var v = parseFloat($(this).val());
            $(this).val((isNaN(v)) ? '' : v.toFixed(2));
       });
    }

    // codes for email validation
    $(document).ready(function(e) {
        $('.txtEmail').each(function(){
            $(this).focusout(function() {
                var sEmail = $(this).val();
                if ($.trim(sEmail).length == 0) {
                    // $(this).focus();
                    $(".errohere").text("");
                    // alert('Please enter valid email address');
                    e.preventDefault();
                }
                if (validateEmail(sEmail)) {
                    $(".errohere").hide();
                    // alert('Email is valid');
                    // Nothing happens...
                }
                else {
                    $(this).focus();
                    $(".errohere").text("Invalid Email Address");
                    // alert('Invalid Email Address');
                    e.preventDefault();
                }
            });
        });
    });

    function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        }
        else {
            return false;
        }
    }

    function timeemail(){
        $('.txtEmail').each(function(){
            $(this).focusout(function() {
                var sEmail = $(this).val();
                if ($.trim(sEmail).length == 0) {
                    $(this).focus();
                    $(".errohere").text("Please enter valid email address");
                    // alert('Please enter valid email address');
                    e.preventDefault();
                }
                if (validateEmail(sEmail)) {
                    $(".errohere").hide();
                    // alert('Email is valid');
                    // Nothing happens...
                }
                else {
                    $(this).focus();
                    $(".errohere").text("Invalid Email Address");
                    // alert('Invalid Email Address');
                    e.preventDefault();
                }
            });
        });
    }

    function addinfo() {
        var count = $("#appendinfo .divko").length;

        $( "#appendinfo" ).append('<div class="divko new'+count+'">'+
        '<div class="row">'+
            '<div class="form-group">'+
                '<label class="col-md-4 control-label">Mobile No.</label>'+
                '<div class="col-md-8">'+
                    '<div class="input-group" id="company_contact_mobile" style="width: 100%;">'+
                        '<input type="text" id="spinner3" class="mobno spinbox-input form-control input-mask-phone mobilenum" maxlength="11">'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="row">'+
            '<div class="form-group">'+
                '<label class="col-md-4 control-label">Telephone No.</label>'+
                '<div class="col-md-8">'+
                    '<div class="input-group" id="company_contact_mobile" style="width: 100%;">'+
                        '<input type="text" id="spinner3" class="telno spinbox-input form-control input-mask-tele telnum" maxlength="11">'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="row">'+
            '<div class="form-group">'+
                '<label class="col-md-4 control-label">Email</label>'+
                '<div class="col-md-8">'+
                    '<input type="text" class="email form-control input-sm txtEmail" />'+
                    '<span class="errohere" style="color: red; font-weight: 700;"></span>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '<div class="row">'+
            '<div class="col-md-12">'+
                '<button title="Remove Information" class="btn btn-xs btn-warning pull-right" onclick="removeinfo('+count+');"><i class="fa fa-remove"></i></button>'+
                '<button title="Add Information" class="btn btn-xs btn-primary pull-right" onclick="addinfo();"><i class="fa fa-plus"></i></button>'+
            '</div>'+
        '</div>'+
    '</div>');

    count ++;
    telno();
    timeemail();
    }

    function removeinfo(type){
        $(".new"+type).remove();
    }

    function showimgcontact(){
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("contactimage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("imgcontact").src = oFREvent.target.result;
        };
    }

    function tblviewtransall(tid, year, mon){
        var tenantid = tid;
        var yearname = year;
        var monname = mon;
        var m = "";

        if(mon == 1){
            m = "January";
        }else if(mon == 2){
            m = "February";
        }else if(mon == 3){
            m = "March";
        }else if(mon == 4){
            m = "April";
        }else if(mon == 5){
            m = "May";
        }else if(mon == 6){
            m = "June";
        }else if(mon == 7){
            m = "July";
        }else if(mon == 8){
            m = "August";
        }else if(mon == 9){
            m = "September";
        }else if(mon == 10){
            m = "Octorber";
        }else if(mon == 11){
            m = "November";
        }else{
            m = "December";
        }

            $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tenantid='+tenantid+
            '&yearname='+yearname+
            '&monname='+monname+
            '&form=tblviewtransall',
            success: function(data){
                $("#tblviewtransall").html(data);
                $("#modalviewtransall").modal("show");
                $("#transtitle").text("All Transactions in month of " +m+ " year " + year);
            }
        });
    }

    function printsoa(){
        var laman = $("#tblaccountdetails tr").length;
        if(laman == 0){
            showmodal("alert", "Sorry, No data found.", "", null, "", null, "0");
        }else{
            var toPrint = document.getElementById("soatable");
            var popupWin = window.open('', '_blank', 'width=900,height=500,location=no,');
            popupWin.document.open();
            popupWin.document.write('<html><title>Statement Of Account Report (Summary)</title><style>#soatbl tr{font-size: 12px !important; font-family: arial !important; } #soatbl td{text-align: left !important;} #soatbl thead{border: 1px solid gray !important; background-color: black !important; color: black !important;} #tblaccountdetails tr{border-bottom: 1px solid grey !important;} #soatbl td:last-child{display: none !important;} #tblaccountdetails td{font-size: 10px !important;} </style><header style="font-size: 16px; font-weight: 700;">Statement Of Account (Summary)</header><br><body onload="window.print();">' );

            popupWin.document.write( toPrint.innerHTML);
            popupWin.document.write('</body></html>');
            popupWin.document.close();
        }
    }

    function printallsoa(){
        var laman = $("#tblviewtransall tr").length;
        if(laman == 0){
           showmodal("alert", "Sorry, No data found.", "", null, "", null, "0");
        }else{
            var transtitle = $("#transtitle").text();
            var toPrint = document.getElementById("allsoatable");
            var popupWin = window.open('', '_blank', 'width=900,height=500,location=no,');
            popupWin.document.open();
            popupWin.document.write('<html><title>Statement Of Account Report (Per Month)</title><style>#allsoatbl tr{font-size: 12px !important; font-family: arial !important; } #allsoatable td{text-align: left !important;} #allsoatbl thead{border: 1px solid gray !important; background-color: grey !important; color: black !important;} #tblviewtransall tr{border-bottom: 1px solid grey !important;} #tblviewtransall td{font-size: 10px !important;} </style><header style="font-size: 16px; font-weight: 700;">Statement Of Account ('+transtitle+') </header><br><body onload="window.print();">' );

            popupWin.document.write( toPrint.innerHTML);
            popupWin.document.write('</body></html>');
            popupWin.document.close();
        }
    }

    function printpdc(){
        var laman = $("#tblpdc tr").length;
        if(laman == 0){
            showmodal("alert", "Sorry, No data found.", "", null, "", null, "0");
        }else{
            var toPrint = document.getElementById("divpdc2");
            var popupWin = window.open('', '_blank', 'width=900,height=500,location=no,');
            popupWin.document.open();
            popupWin.document.write('<html><title>PDC Reports</title><link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" /><style>#pdctbl {width: 100% !important;} #pdctbl tr{font-size: 12px !important; font-family: arial !important; } #pdctbl td{text-align: left !important;} #pdctbl thead{border: 1px solid gray !important; background-color: grey !important; color: black !important;} #tblpdc tr{border-bottom: 1px solid grey !important;} #tblpdc td{font-size: 10px !important;} </style><header style="font-size: 16px; font-weight: 700;"></header><br><body onload="window.print();">' );

            popupWin.document.write( toPrint.innerHTML);
            popupWin.document.write('</body></html>');
            popupWin.document.close();
        }
    }

    function printmaintenance(){
        var laman = $("#tblmaintenanceprint tr").length;
        if(laman == 0){
           showmodal("alert", "Sorry, No data found.", "", null, "", null, "0");
        }else{
            var toPrint = document.getElementById("printmaintenancediv");
            var popupWin = window.open('', '_blank', 'width=900,height=500,location=no,');
            popupWin.document.open();
            popupWin.document.write('<html><title>Maintenance History Reports</title><link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" /><style>.parent td:last-child{display: none !important;} #maintenancetbl tr{font-size: 12px !important; font-family: arial !important; } #maintenancetbl td{text-align: left !important;} #maintenancetbl thead{border: 1px solid gray !important; background-color: grey !important; color: black !important;} button{display: none !important;} #tblmaintenance tr{border-bottom: 1px solid grey !important;} #tblmaintenance td{font-size: 10px !important;} </style><header style="font-size: 16px; font-weight: 700;"></header><br><body onload="window.print();">' );

            popupWin.document.write( toPrint.innerHTML);
            popupWin.document.write('</body></html>');
            popupWin.document.close();
        }
    }

    function printcontract(){
        var laman = $("#tblcontract tr").length;
        if(laman == 0){
            showmodal("alert", "Sorry, No data found.", "", null, "", null, "0");
        }else{
            var toPrint = document.getElementById("printmokokoya");
            var popupWin = window.open('', 'Contract', 'height=500,width=900');
                popupWin.document.open();
                popupWin.document.write('<html><title>Contract</title><style>*{font-family: \'Segoe UI\', Tahoma, sans-serif; font-size:10px !important;}@media print {table { page-break-after:auto }tr    { page-break-inside:avoid; page-break-after:auto }td    { page-break-inside:avoid; page-break-after:auto }thead { display:table-header-group }tfoot { display:table-footer-group }}</style><body onload="window.print();">' );
                popupWin.document.write( toPrint.innerHTML);
                popupWin.document.write('</body></html>');
                popupWin.document.close();
        }
    }

    function tblcontract(tid, inqid){

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tenantid=' + tid + '&inquiryid=' + inqid + '&form=tblcontract',
            success: function(data){
                $("#tblcontract").html(data);
            }
        });
    }

    function viewcontract(inquiryid, tenantid, type, contractID){
        $("#viewcontractpapel").modal("show");
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'inquiryid=' + inquiryid + '&tenantid=' + tenantid + '&contractID=' + contractID + '&form=viewcontract',
        success:function(data){
                $("#termsandcondition54").html(data);
            }
        })
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data:  'inquiryid=' + inquiryid + '&tenantid=' + tenantid + '&type=' + type + '&form=tblcontractinfo',
            success: function(data){
                var arr = data.split("|");
                $("#unitaddress8").text(arr[4]);
                $("#tenant_ID8").text(arr[3]);
                $("#storename8").text(arr[0]);
                $("#address8").text(arr[6]);
                $("#authorizedsignatory8").text(arr[2]);
                $("#contactnumbers8").text(arr[11]);
                $("#natureofbusiness8").text(arr[12]);
                $("#classification8").text(arr[12]);
                $("#leaseunitfloor8").text(arr[9]);
                $("#monthlyrent8").text(arr[8]);
                $("#leaseperiod8").text(arr[10]);
                $("#startdate8").text(arr[13]);
                $("#enddate8").text(arr[14]);
            }
        })
    }

    function tblcontractinfo(tid, type){

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data:  'tenantid=' + tid + '&type=' + type + '&form=tblcontractinfo',
            success: function(data){
                var arr = data.split("|");
                $("#unitaddress").text(arr[4]);
                $("#tenant_ID").text(arr[3]);
                $("#storename").text(arr[0]);
                $("#address2").text(arr[6]);
                $("#authorizedsignatory").text(arr[2]);
                $("#contactnumbers").text(arr[11]);
                $("#natureofbusiness").text(arr[12]);
                $("#classification").text(arr[12]);
                $("#leaseunitfloor").text(arr[9]);
                $("#monthlyrent").text(arr[8]);
                $("#leaseperiod").text(arr[10]);
            }
        })
    }

    // <!--THIS IS FOR ADDING COMPLAINTS--> //JONAS
    function addcomplaints(id, name, unitname, company, building_id, unitid, floorid){
        $("#modal_addcomplaints").modal("show");
        $("#hiddenid2").attr("value", id);
        $("#hiddenidcname").attr("value", name);
        $("#hiddenunit").attr("value", unitname);
        $("#hiddencompany").attr("value",  company);
        $("#hiddenbuilding_id").attr("value", building_id);
        $("#hiddenunitid").attr("value", unitid);
        $("#hiddenfloorid").attr("value",  floorid);
        clickable();
        displaycomplaintspertenant();
    }

    function closeaddcomplaints(){
        $("#modal_addcomplaints").modal("hide");
        $(".crequired").val("");
    }

    function addcomplaintscode(){
        $("#modal_addcomplaintscode").modal("show");
    }

    function unload_addcomplaintscode(){
        $("#modal_addcomplaintscode").modal("hide");
        $(".required").val("");
    }

    function clickable() {
        $("#tbltenantlists tr").each(function(){
            $(this).click(function(){
                $("#hiddenid").attr("value", this.id);
            })
        })
    }

    function addcomplaintscode2() {
        var complaintscode = $("#complaintscode").val();
        var complaintcodedescription = $("#complaintcodedescription").val();
        var countinput = 0;
            $("#modal_addcomplaintscode .required").each(function() {
                if($(this).val() == ""){
                    countinput = countinput +1;
                }
            })

        var stats = "";
            $(".stats").each(function(){
                if ( $(this).prop("checked") ) {
                    stats = this.value;
                }
            })
        if(countinput == 0){
            $.ajax({
                type: 'POST',
                url: 'complaints/class.php',
                data: 'complaintscode=' + complaintscode + '&stats=' + stats + '&complaintcodedescription=' + complaintcodedescription + '&form=addnewcomplaintscode',
                success: function(data){
                    if(data == 1) {
                        showmodal("alert", "New complaint code successfully added.", "", null, "", null, "0");
                        unload_addcomplaintscode();
                        displaycomplaintcode();
                    }
                    else{
                        alert(data);
                    }
                }
            })
        }
        else{
            showmodal("alert", "Please fill all fields.", "", null, "", null, "0");
        }
    }


    function sendcomplaints() {
        var id = $("#hiddenid2").val();
        var hiddenidcname = $("#hiddenidcname").val();
        var hiddenunit = $("#hiddenunit").val();
        var hiddencompany = $("#hiddencompany").val();
        var complaintscode1 = $("#complaintscode1").val();
        var complaintsdescription = $("#complaintsdescription").val();
        var user = $("#lbluser").text();
        var hiddenstats = $("#hiddenstats").val();
        var hiddenbuilding_id = $("#hiddenbuilding_id").val();
        var hiddenunitid = $("#hiddenunitid").val();
        var hiddenfloorid = $("#hiddenfloorid").val();

        var countinput = 0;
        $("#modal_addcomplaints .crequired").each(function() {
            if($(this).val() == ""){
                countinput = countinput +1;
            }
        })

        if(countinput == 0){
           $.ajax({
            type: 'POST',
            url: 'complaints/class.php',
            data: 'hiddenbuilding_id=' + hiddenbuilding_id + '&hiddenunitid=' + hiddenunitid + '&hiddenfloorid=' + hiddenfloorid + '&hiddencompany='+ hiddencompany + '&id=' + id + '&user=' + user + '&hiddenunit=' + hiddenunit  + '&hiddenidcname=' + hiddenidcname + '&hiddenstats=' + hiddenstats + '&complaintscode1=' + complaintscode1  + '&complaintsdescription=' + complaintsdescription + '&form=sendcomplaints',
            success: function(data){
                if(data == 1){
                    showmodal("alert", "Complaint successfully sent.", "", null, "", null, "0");
                    closeaddcomplaints();
                    displaycomplaintcode();
                }
                else{
                    alert(data);
                }
            }
           })
       }
        else{
           showmodal("alert", "Please fill all fields.", "", null, "", null, "0");
        }
    }

    function displaycomplaintcode(){
        $.ajax({
            type: 'POST',
            url: 'complaints/class.php',
            data: 'form=displaycomplaintcode',
            success: function(data){
                // alert(data);
                $("#complaintscode1").html(data);
            }
        })
    }

    function selectcomplaintscode(id) {
        $.ajax({
            type: 'POST',
            url:"complaints/class.php",
            data: "id=" + id + "&form=displayselected",
            success: function(data) {
                var arr = data.split("|");

                $("#complaintsdescription").val(arr[0]);
                $("#hiddenstats").val(arr[1]);
            }
        })
    }

    function checkinfo(){

              var a = 0;
              $('.div_businessinfo').each(function() {
              if ( this.value === '' ) {
                  a++;
                  showmodal("alert", "Tenant INFORMATION.", "clickbusinessinfo", null, "", null, "0");
              }
              });
        }

        function clickbusinessinfo(){
          $("#div_businessinfo").click();
          $("#alertmodal").modal("hide");
          $(".div_businessinfo").css("border-color","#f2a696");
        }

        function displaycomplaintspertenant(){
            var hiddenid2 = $("#hiddenid2").val();
            var page = $("#txt_userpagepertenant").val();
            $.ajax({
                type: 'POST',
                url: 'complaints/class.php',
                data: 'hiddenid2=' + hiddenid2 + '&page=' + page + '&form=displaycomplaintspertenant',
                success:function(data){
                    $("#displaycomplaintspertenant").html(data);
                    loadentriespertenant();
                    loadpagecomplaintspertenant();
                }
            })
        }

        function loadentriespertenant(){
        var page = $("#txt_userpagepertenant").val();
        var hiddenid2 = $("#hiddenid2").val();
        $.ajax({
            type: 'POST',
            url: 'complaints/class.php',
            data: 'page=' + page + '&hiddenid2=' + hiddenid2 + '&form=loadentriespertenant',
            success: function(data){
                if(data == "no data"){
                    $("#txtcomplaintsentriespertenant").text("");
                }
                else{
                    $("#txtcomplaintsentriespertenant").text(data);
                }
            }
        });
    }

function loadpagecomplaintspertenant(){
        var page = $("#txt_userpagepertenant").val();
        var hiddenid2 = $("#hiddenid2").val();
        $.ajax({
            type: 'POST',
            url: 'complaints/class.php',
            data: 'page=' + page + '&hiddenid2=' + hiddenid2 + '&form=loadpagecomplaintspertenant',
            success: function(data){
                $("#ulpaginationcomplaintpertenant").html(data);
            }
        });
    }

    function paginationpertenant(page, pagenums){
        $(".pgnumpcomplaintspertenant").removeClass("active");
        var value = "#" + pagenums;
        $("#pgcomplaintspertenant" + pagenums).addClass("active");
        $("#txt_userpagepertenant").val(page);
        displaycomplaintspertenant();
        loadpagecomplaintspertenant();
        loadentriespertenant();
    }

    function loadfilters_tenant(module){
            $.ajax({
                type: 'POST',
                url: 'tenants/tenantmainclass.php',
                data: 'module=' + module + '&form=loadfilters_tenant',
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
                    $("#contractstart").val(arr2[0]);
                    $("#contractend").val(arr2[1]);
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
                    tbltenantlists()
                }
            })
        }

    function savetenantfilter(){
        var module = "Tenant";
        var checked = "";
        $('input:checkbox[name="form-field-checkboxtttttttt"]').each(function(){
            if($(this).is(":checked")){
                var value = $(this).attr("value");
                checked += value + "|";
            }
        })

        var checked2 = "";
        $('input:checkbox[name="form-field-checkboxtttttttt"]').each(function(){

                var value2 = $(this).attr("value");
                checked2 += value2 + "|";
        })

        var checked3 = "";
        $('input:checkbox[name="form-field-checkbox-stado"]').each(function(){
          if($(this).is(":checked"))
          {
            var value3 = $(this).attr("value");
            checked3 += value3 + "|";
          }
        })

        var tstatus = "";
        $('input:checkbox[name="form-field-checkbox-tstatus"]').each(function(){
          if($(this).is(":checked"))
          {
            var value3 = $(this).attr("value");
            tstatus += value3 + "|";
          }
        })
        var contractstart = $("#contractstart").val();
        var contractend = $("#contractend").val();

        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'module=' + module + '&checked=' + checked + '&checked2=' + checked2 + '&checked3=' + checked3 + '&tstatus=' + tstatus + '&contractstart=' + contractstart + '&contractend=' + contractend + '&form=savetenantfilter',
            success: function(data){
                loadfilters_tenant(module);
                $("#LINK_tenant_filter").click();
            }
        })
    }

    function viewhistorytenant(TenantID){
      $("#viewhistorytenant").modal("show");
      $("#tenantidnglogs").val(TenantID);
      viewhistorytenantdisplay();
    }

    function viewhistorytenantdisplay(){
        var tenantidnglogs = $("#tenantidnglogs").val();
            $.ajax({
                type: 'POST',
                url: 'tenants/tenantmainclass.php',
                data: 'tenantidnglogs=' + tenantidnglogs + '&form=viewhistorytenantdisplay',
            success: function(data){
                $("#viewhistorytenantdisplay").html(data);
            }
        })
    }

    function malltemplate(){
        var mallidprint = $("#mallidprint").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'mallidprint=' + mallidprint + '&form=malltemplate',
        success:function(data){
                $("#template").html(data);
            }
        })
    }

    function malltemplate2(){
        var mallidprint = $("#mallidprint").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'mallidprint=' + mallidprint + '&form=malltemplate',
        success:function(data){
                $("#template2").html(data);
            }
        })
    }

    function malltemplate3(){
        var mallidprint = $("#mallidprint").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'mallidprint=' + mallidprint + '&form=malltemplate',
        success:function(data){
                $("#template3").html(data);
            }
        })
    }

    function malltemplate4(){
        var mallidprint = $("#mallidprint").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'mallidprint=' + mallidprint + '&form=malltemplate',
        success:function(data){
                $("#template4").html(data);
            }
        })
    }

    function showeocdate(tenantid, inqid, appid){
        $("#hiddentenantidulet").val(tenantid);
        $("#hiddeninqidulet").val(inqid);
        $("#hiddenappidulet").val(appid);
        var id = $("#hiddentenantidulet").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'id=' + id + '&form=showeocdate',
        success:function(data){
            var arr = data.split("|");
            showmodal("confirm", "Contract date is from "+arr[0]+" To "+arr[1]+" are you sure you want to end this contract immediately?", "eoc", null, "", null,"0");
        }
        })
    }

    function eoc(){
        var tenantid = $("#hiddentenantidulet").val();
        var inqid = $("#hiddeninqidulet").val();
        var appid = $("#hiddenappidulet").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tenantid=' + tenantid + '&inqid=' + inqid + '&appid=' + appid + '&form=eoc',
        success:function(data){
            if(data == "1"){
                setTimeout(function(){
                    showmodal("alert", "Unit is now Vacant.", "tbltenantlists", null, "", null, "0");
                }, 1000)
            }else{
                alert(data);
            }
        }
        })
    }

    function selectdepartment(classification){
        $("#tenant_unitdepartment").attr("disabled", false);
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'classification=' + classification + '&form=selectdepartment',
        success:function(data){
                $("#tenant_unitdepartment").html(data);
            }
        })
    }

    function selectcategory(category){
        $("#tenant_unitcategory").attr("disabled", false);
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'category=' + category + '&form=selectcategory',
        success:function(data){
                $("#tenant_unitcategory").html(data);
            }
        })
    }

    function selectwing(){
        $("#tenant_unitwing").attr("disabled", false);
        var classification_id = $("#tenant_unitclass").val();
        var type  = "";
        $(".unittype123").each(function(){
        if ( $(this).prop("checked") ) {
            type = this.value;
            }
        })
        var mallid = $("#estes").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'classification_id=' + classification_id + '&type=' + type + '&mallid=' + mallid + '&form=selectwing',
        success:function(data){
                $("#tenant_unitwing").html(data);
            }
        })
    }

    function selectfloor(){
        $("#tenant_unitfloor").attr("disabled", false);
        var wing_id = $("#tenant_unitwing").val();
        var classification_id = $("#tenant_unitclass").val();
        var mallid = $("#estes").val();
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'wing_id=' + wing_id + '&classification_id=' + classification_id + '&mallid=' + mallid + '&form=loadinquiry_flr',
        success:function(data){
                $("#tenant_unitfloor").html(data);
            }
        })
    }

    function selectunit54(){
        var classification_id = $("#tenant_unitclass").val();
        var flr = $("#tenant_unitfloor").val();
        var type = "";
        $(".unittype123").each(function(){
        if ( $(this).prop("checked") ) {
            type = this.value;
            }
        })
        $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'classification_id='  + classification_id + '&flr=' + flr + '&type=' + type + '&form=loadinquiry_unit_lca',
        success:function(data){
              if(data == 1){
                if(classification_id != undefined){
                    showmodal("alert", "No available "+type+ " units under "+classification+" classification.", "", null, "", null, "0");
                }
              }
              else {
                if(type == "SET"){
                  $("#tenant_unitunit").html(data);
                  $("#tenant_unitunit").attr("disabled", false);
                }
                else{
                  $("#tenant_lca_unitname").html(data);
                  $("#tenant_lca_unitname").attr("disabled", false);
                }
              }
            }
        })
    }

    function displayunitinformationtab(){
        var tenantid = $("#yunzhao").val();
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tenantid=' + tenantid + '&form=displayunitinformationtab',
        success:function(data){
                var arr = data.split("|");
                $("#tenant_unitclass").html(arr[0]);
                $("#tenant_unitdepartment").html(arr[1]);
                $("#tenant_unitcategory").html(arr[2]);
                $("#tenant_unitwing").html(arr[3]);
                $("#tenant_unitfloor").html(arr[4]);
                if(arr[6] == "SET"){
                $("#tenant_unitunit").html(arr[5]);
                }
                else{
                $("#tenant_lca_unitname").html(arr[5]);
                }
            }
        })
    }

    function selectclassification(){
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'form=selectclassification',
        success:function(data){
                $("#tenant_unitclass").html(data);
            }
        })
    }

    function changeunitinformation(){
        var enable = $("#hilda").val();
        if(enable == ""){
            $("#hilda").val("1");
            $("#tenant_unitclass").attr("disabled", false);
            $("#txtnoofmonths_tenants").attr("disabled", false);
            $("#tenants_monthlyadvamt").attr("disabled", false);
            $("#tenants_monthlydepamt").attr("disabled", false);
            $("#txtnoofdays_tenants").attr("disabled", false);
            $("#pangenable").removeClass("fa fa-pencil-square-o");
            $("#pangenable").addClass("fa fa-times");
            $("#pangenable").css("color", "red");
            selectclassification();
            $("#pangsavengadd").attr("disabled", false);
            $("#pangcancelngadd").attr("disabled", false);
        }
        else{
            $("#hilda").val("");
            $("#tenant_unitclass").attr("disabled", true);
            $("#txtnoofmonths_tenants").attr("disabled", true);
            $("#tenants_monthlyadvamt").attr("disabled", true);
            $("#tenants_monthlydepamt").attr("disabled", true);
            $("#txtnoofdays_tenants").attr("disabled", true);
            $("#pangenable").removeClass("fa fa-times");
            $("#pangenable").addClass("fa fa-pencil-square-o");
            $("#pangenable").css("color", "green");
            displayunitinformationtab();
            $("#pangsavengadd").attr("disabled", true);
            $("#pangcancelngadd").attr("disabled", true);
        }
    }

    function loaddatetofunction54(){
    var months = $("#txtnoofmonths_tenants").val();
    var days = $("#txtnoofdays_tenants").val();
    var datefrom = $("#ptenant_datefrom").val();
    var type = "";
        $(".unittype123").each(function(){
        if ( $(this).prop("checked") ) {
            type = this.value;
            }
        })
        if(datefrom != ""){
          $.ajax({
            type: 'POST',
            url: 'mainclass.php',
            data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&type=' + type + '&form=loaddatetofunction',
            success: function(data)
            {
              var arr = data.split("|");
              $("#ptenant_dateto").val(arr[1]);
              loadpdcbasedonmonthentered(arr[1]);
              loadtotalamountundertable(arr[1]);
            }
          })
        }
    }

    function loadpdcbasedonmonthentered(dateto){
        var inqid = $("#alucard").val();
        var unit_id =  $("#yisunshin").val();
        var datefrom = $("#ptenant_datefrom").val();
        var ttlamnt = $("#tenant_totalsqm").val();
        var unittype123 = "";

        $(".unittype123").each(function(){
        if ( $(this).prop("checked") ) {
            unittype123 = this.value;
            }
        })
        if(unittype123 == "SET"){
            $.ajax({
                type: 'POST',
                url: 'tenants/tenantmainclass.php',
                data: 'datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + unittype123 + '&ttlamnt=' + ttlamnt + '&unit_id=' + unit_id + '&inqid=' + inqid + '&form=loadtbodypdc_inquiry3',
            success:function(data){
                    $("#tbodypdc_inquiry2").html(data);
                }
            })
        }
        else if(unittype123 == "LCA"){
            $.ajax({
                type: 'POST',
                url: 'tenants/tenantmainclass.php',
                data: 'datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + unittype123 + '&ttlamnt=' + ttlamnt + '&unit_id=' + unit_id + '&inqid=' + inqid + '&form=loadtbodypdc_inquiry4',
            success:function(data){
                    $("#tbodypdc_inquiry2").html(data);
                }
            })
        }
    }

    function loadtotalamountundertable(dateto){
        var months = $("#txtnoofmonths_tenants").val();
        var days = $("#txtnoofdays_tenants").val();
        var datefrom = $("#ptenant_datefrom").val();
        var type = "";
        $(".unittype123").each(function(){
        if ( $(this).prop("checked") ) {
            type = this.value;
            }
        })

        var unit_id = $("#yisunshin").val();
        var amt = $("#tenant_totalsqm").val();
        if(datefrom != "")
        {
        $.ajax({
          type: 'POST',
          url: 'tenants/tenantmainclass.php',
          data: 'months=' + months + '&days=' + days + '&datefrom=' + datefrom + '&dateto=' + dateto + '&type=' + type + '&unit_id=' + unit_id + '&ttlamnt=' + amt + '&form=loadtotalamountundertable',
          success: function(data){
            var arr = data.split("|");
            $("#lbltotalamountofpayment2").text("Php " + arr[0]);
          }
        })
      }
    }

    function checkunit(){
        var appid = $("#saber").val();
        var inqid = $("#alucard").val();
        var datefrom = $("#txtinq_datefrom").val();
        var dateto = $("#txtinq_dateto").val();
        var type = "";

        $(".unittype123").each(function(){
        if ( $(this).prop("checked") ) {
            type = this.value;
            }
        })

        if(type = "SET"){
           var unit = $("#tenant_unitunit").val();
           // var unit = $("#tenant_unitunit").text();
        }
        else if(type = "LCA"){
           var unit = $("#tenant_lca_unitname").val();
           // var unit = $("#tenant_lca_unitname").text();
        }

        var conttt = "";
        // if(type == "SET" && unit != "")
        // {
        $.ajax({
          type: 'POST',
          async: false,
          url: 'mainclass.php',
          data: 'unit=' + unit + '&datefrom=' + datefrom + '&dateto=' + dateto + '&appid=' + appid + '&inqid=' + inqid + '&form=chkunitfrst2',
          success: function(data)
          {
            if(data != "")
            {
              conttt = "invalid";
              $("#addstat").val("invalid");
              showmodal("alert", data, "", null, "", null, "1");

              $("#txtinq_unitunit").css("border-color", "red");
              $("#txtinq_datefrom").css("border-color", "red");

              if(parseInt($("#txtnoofmonths_tenants").val()||0) != 0)
              {
                $("#txtnoofmonths_tenants").css("border-color", "red");
              }
              else
              {
                $("#txtnoofmonths_tenants").css("border-color", "#CCC");
              }

              if(parseInt($("#txtnoofdays_inq").val()||0) != 0)
              {
                $("#txtnoofdays_inq").css("border-color", "red");
              }
              else
              {
                $("#txtnoofdays_inq").css("border-color", "#CCC");
              }
            }
            else
            {
              conttt = "valid";
              $("#addstat").val("valid");
              $("#tenant_unitunit").css("border-color", "#CCC");
              $("#txtnoofmonths_tenants").css("border-color", "#CCC");
              $("#txtnoofdays_tenants").css("border-color", "#CCC");
              $("#tenant_datefrom").css("border-color", "#CCC");
            }
          }
        })
      return conttt;
    }

    function savedesiredaddendum(){
        var pdcdup = checkpdcinput();
        var dupcount = checkunit();
        var tenantid = $("#yunzhao").val();
        var inquiryid = $("#alucard").val();
        var datefrom = $("#ptenant_datefrom").val();
        var dateto = $("#ptenant_dateto").val();
        var noofmonths = $("#txtnoofmonths_tenants").val();
        var noofdays = $("#txtnoofdays_tenants").val();
        var monthlyadv = $("#tenants_monthlyadvamt").val();
        var monthlydep = $("#tenants_monthlydepamt").val();
        var monthlyrate = $("#tenants_monthlyrate2").val().replace(",", "");
        var advamount = $("#tenants_advancepayment").val();
        var depamount = $("#tenants_depositpayment").val();
        var nakacheck = $("#nakacheck").val();
        var chineckan = $("#chineckan").val();
        var conditions = nakacheck + chineckan;
        var unittype = $("#moskov").val();
        var amount = $("#tenant_totalsqm").val().replace(",", "");
        var chknum = "";
        var bankname = "";
        var trid = "";
        var countinput = 0;

        if(unittype = "SET"){
           var unitid = $("#tenant_unitunit").val();
           var unitname = $("#tenant_unitunit").text();
           countinput = countinput - 2;
        }
        else if(unittype = "LCA"){
           var unitid = $("#tenant_lca_unitname").val();
           var unitname = $("#tenant_lca_unitname").text();
        }

        $("#tbodypdc_inquiry2 tr td .bnk").each(function(){
            var value = $(this).val();
            bankname +=  value +  ",,,";
        });

        $("#tbodypdc_inquiry2 tr td [type='text']").each(function(){
            var value2 = $(this).val();
            chknum +=  value2 +  "...";
        });

        $("#tbodypdc_inquiry2 tr").each(function(){
            trid += $(this).attr("id") + "#";
        });

        var e = 0;
        $(".required_addendum").each(function(){
          if($(this).val() == "" || $(this).val() == "0.00" || $(this).val() == "0")
          {
            e++;
            var eto = $(this).attr("id");
            $(this).css("border-color","#f2a696");
            $("#unitinfo_div").click();
            this.focus();
          }
          else
            {
              $(this).css("border-color","#D5D5D5");
            }
        });

        $("#gustokolang .tenantadd").each(function() {
            if($(this).val() == ""){
                countinput = countinput + 1;
            }
        })

        $("#tbodypdc_inquiry2 tr td [type='text']").each(function(){
            if($(this).val() == ""){
                countinput = countinput + 1;
            }
        })

        if(dupcount == "valid"){
            if(pdcdup == ""){
                if(countinput == 0){
                    $.ajax({
                        type: 'POST',
                        url: 'tenants/tenantmainclass.php',
                        data: 'amount=' + amount + '&inquiryid=' + inquiryid + '&bankname=' + bankname + '&chknum=' + chknum + '&trid=' + trid + '&noofmonths=' + noofmonths + '&advamount=' + advamount + '&depamount=' + depamount + '&noofdays=' + noofdays + '&monthlyadv=' + monthlyadv + '&monthlydep=' + monthlydep + '&monthlyrate=' + monthlyrate + '&tenantid=' + tenantid + '&datefrom=' + datefrom + '&dateto=' + dateto + '&unittype=' + unittype + '&unitid=' + unitid + '&unitname=' + unitname + '&conditions=' + conditions + '&form=savedesiredaddendum',
                    success:function(data){
                            tbltenantlists();
                            showmodal("alert", "Tenant informations successfully modified.", "", null, "", null, "0");
                            $("#modal_tenantinformation").modal("hide");
                            $("#chineckan").val("");
                            $("#pangenable").removeClass("fa fa-times");
                            $("#pangenable").addClass("fa fa-pencil-square-o");
                            $("#pangenable").css("color", "green");
                        }
                    })
                }
                else{
                    showmodal("alert", "Please fill all fields.", "", null, "", null, "0");
                }
            }
            else{
                showmodal("alert", "You entered duplicate check numbers.", "", null, "", null, "0");
            }
        }
        else{
            $("#tenant_unitunit").css("border-color", "red");
            $("#tenant_lca_unitname").css("border-color", "red");
            $("#txtnoofmonths_tenants").css("border-color", "red");
            $("#ptenant_datefrom").css("border-color", "red");
            $("#unitinfo_div").click();
        }
    }

    function addselectedtnc2(){
    var nakacheck = $("#nakacheck").val();
    var chineckan = $("#chineckan").val();
    var lahat = nakacheck+chineckan;
        $.ajax({
        type: 'POST',
        url: 'tenants/tenantmainclass.php',
        data: 'lahat=' + lahat + '&form=lamanngtabledirect2',
        success: function(data){
            $("#displayselected2").html(data);
            $("#modal_tenantstncadd").modal("hide");
        }
      })
    }

    function chkduplicatedchknum2(){
    var e = 0;
    var chk = "";
    var bankname = "";
    $("#tbodypdc_inquiry2 tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        chk +=  "|"+num;
        bankname +=  "|"+bnk;

    });

        var dup = "";
        $("#tbodypdc_inquiry2 tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        thischk.css("border-color", "#CCC");

        var arrchk = chk.split("|");
        var arrbnk = bankname.split("|");

        var b = 0;
        for(var a = 0; a<=arrchk.length; a++){
            if(arrchk[a] == num && num != "" && arrbnk[a] == bnk){
                b++;
            }
        }

        if(b >= 2){
          dup += num + "#" + bnk + "|";
        }
        });

        $("#fanny").val("");
        if(dup != ""){
            showmodal("alert", "Duplicated check number.", "focuskemseee2(\""+dup+"\")", null, "", null, "0");
            $("#fanny").val("1");
        }
    }

    function checkpdcinput(){
     var e = 0;
     var chk = "";
     var bankname = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        chk +=  "|"+num;
        bankname +=  "|"+bnk;

      });

     var dup = "";
     $("#tbodypdc_inquiry tr").each(function(){
        var thischk = $(this).find("td [type='text']");
        var thisbnk = $(this).find("td .bnk");
        var num = $(this).find("td [type='text']").val();
        var bnk = $(this).find("td .bnk").val();
        thischk.css("border-color", "#CCC");

        var arrchk = chk.split("|");
        var arrbnk = bankname.split("|");

        var b = 0;
        for(var a = 0; a<=arrchk.length; a++)
        {

          if(arrchk[a] == num && num != "" && arrbnk[a] == bnk)
          {
            // alert(arrbnk[a] +"|"+ bnk)
            b++;
          }
        }

        if(b >= 2)
        {
          dup += num + "#" + bnk + "|";
        }
      });

  return dup;
}

    function focuskemseee2(dup){
        var arr = dup.split("|");
        for(i=0; i<=arr.length-2; i++){
        var arr2 = arr[i].split("#");
        if(i == 1){
            $("#tbodypdc_inquiry tr").each(function(){
            var num = $(this).find("td [type='text']").val();
            var thischk = $(this).find("td [type='text']");
            var thisbnk = $(this).find("td .bnk");
            var bnk = $(this).find("td .bnk").val();

                if(num == arr2[0] && bnk == arr2[1]){
                    thischk.css("border-color", "#f2a696");
                    thischk.focus();
                    return false;
                }
            })
        }
        else{
          $("#tbodypdc_inquiry tr").each(function(){
            var num = $(this).find("td [type='text']").val();
            var thischk = $(this).find("td [type='text']");
            var thisbnk = $(this).find("td .bnk");
            var bnk = $(this).find("td .bnk").val();

                if(num == arr2[0] && bnk == arr2[1]){
                    thischk.css("border-color", "#f2a696");
                }
            })
        }
    }
        $("#alertmodal").modal("hide");
    }

    function activateaddendum(){
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'form=activateaddendum',
        success:function(data){
                tbltenantlists();
            }
        })
    }

    function closeinfo() {
        $('#tenantinfo').modal('hide');
        cancelpdctransaction();
        $(".thistab:first-child").children('a').click();
        $("#accdatedep").val("<?php echo date('m/d/Y'); ?>");
    }

    function bank(){
        var accbank = $("#accbank").val();
        $("#banko").text(accbank);
    }

    function showimg2(){
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("tenantupload").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("imglogo").src = oFREvent.target.result;
        };
    }

    function loaddsasasas(){
    var tag_input = $('#id-input-file-2');
        try{
            tag_input.tag(
                {
                placeholder:tag_input.attr('placeholder'),
                //enable typeahead by specifying the source array
                source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
                }
            )

            //programmatically add/remove a tag
            var $tag_obj = $('#id-input-file-2').data('tag');
            // $tag_obj.add('Programmatically Added');

            var index = $tag_obj.inValues('some tag');
            $tag_obj.remove(index);
        }
        catch(e) {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
            //autosize($('#form-field-tags'));
        }

        $('.upload_app_req').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
        });
    }

    function displaytenantER(tid){
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tid=' + tid + '&form=displaytenantER',
        success:function(data){
                $("#tenantER").html(data);
            }
        })
    }

    function displaytenantWR(tid){
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tid=' + tid + '&form=displaytenantWR',
        success:function(data){
                $("#tenantWR").html(data);
            }
        })
    }

    function displaytenantPC(tid){
        $.ajax({
            type: 'POST',
            url: 'tenants/tenantmainclass.php',
            data: 'tid=' + tid + '&form=displaytenantPC',
        success:function(data){
                $("#tenantPC").html(data);
            }
        })
    }

    function editcontactinfo(lname, fname, mname, position, address, img, imgname, conid) {
        $("#imgcontact").attr("src", img);

        $("#lname").val(lname);
        $("#conid").val(conid);
        $("#fname").val(fname);
        $("#mname").val(mname);
        $("#designation").val(position);
        $("#address").val(address);
        $("#modalcontactperson").modal("show");
    }
</script>
