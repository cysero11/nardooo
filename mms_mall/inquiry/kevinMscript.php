<script type="text/javascript">
    $(function(){
        // tblselectshortcutunit();
    });

    function tblselectshortcutunit(){
        var txtinq_mallbranch = $("#txtinq_mallbranch").val();

        if($("#radio_set").is(":checked")){
          var typeunit = "SET";
        }
        else if($("#radio_lca").is(":checked")){
          var typeunit = "LCA";
        }

        $.ajax({
            type: 'POST',
            url: 'inquiry/kevinMmainclass.php',
            data: 'typeunit='+typeunit+
            '&txtinq_mallbranch='+txtinq_mallbranch+
            '&form=tblselectshortcutunit',
            success: function(data){
                $("#tblselectshortcutunit").html(data);
            }
        });
    }

    function slctthisunit(classi, dep, categ, wing, floor, unit, mallid){
        // showmodal("confirm", "Are you sure?", "category(\""+dep+"\", \""+categ+"\")", null, "category(\"modalshortcutunit\")", null, "0");
        if($("#radio_set").is(":checked")){
          var typeunit = "SET";
        }
        else if($("#radio_lca").is(":checked")){
          var typeunit = "LCA";
        }

        $.ajax({
          type: 'POST',
          url: 'inquiry/kevinMmainclass.php',
          data: 'classi='+classi+
          '&dep='+dep+
          '&wing='+wing+
          '&floor='+floor+
          '&unit='+unit+
          '&mallid='+mallid+
          '&form=loadinquiry_department',
          success: function(data){
              var arr = data.split("|");

              $("#txtinq_unitdepartment").prop("disabled", false);
              $("#txtinq_unitcategory").prop("disabled", false);
              $("#txtinq_unitwing").prop("disabled", false);
              $("#txtinq_unitfloor").prop("disabled", false);
              $("#txtinq_unitunit").prop("disabled", false);
              $("#txtinq_lca_unitname").prop("disabled", false);

              $("#txtinq_datefrom").prop("disabled", false);
              $("#txtnoofmonths_inq").prop("disabled", false);
              $("#txtnoofdays_inq").prop("disabled", false);
              $("#txtinq_pymentterms").prop("disabled", false);
              $("#txtinq_pymenttype").prop("disabled", false);

              $("#txtinq_unitdepartment").html(arr[0]);
              $("#txtinq_unitcategory").html(arr[1]);
              $("#txtinq_unitwing").html(arr[2]);
              $("#txtinq_unitfloor").html(arr[3]);
              $("#txtinq_unitunit").html(arr[4]);
              $("#txtinq_lca_unitname").html(arr[10]);

              $("#txtinq_sqm").val(arr[5]);
              $("#txtinq_persqm").val(arr[6]);
              $("#txtinq_totalsqm").val(arr[7]);
              $("#monthlyduespang").text(arr[7]);
              $("#txtinq_sqm_width").val(arr[8]);
              $("#txtinq_sqm_length").val(arr[9]);
              $("#txtinq_assocdues").val(arr[11]);
              if(arr[11] == "0.00"){
                $("#chkassocdues").prop("checked", false);
              }else{
                $("#chkassocdues").prop("checked", true);
              }
              $("#txtmonthlymath").val(arr[7]);
              $("#txtinq_totalmonthlydues").val(arr[12]);
              if(arr[13] == "SET"){
                $("#txtinq_depositpayment").prop("disabled", false);
              }else{
                $("#txtinq_depositpayment2").prop("disabled", false);
              }
          },
          complete: function(){
              $("#txtinq_unitclass").val(classi);
              $("#txtinq_unitdepartment").val(dep);
              $("#txtinq_unitcategory").val(categ);
              $("#txtinq_unitwing").val(wing);
              $("#txtinq_unitfloor").val(floor);
              $("#txtinq_unitunit").val(unit);
              $("#txtinq_lca_unitname").val(unit);

              $("#modalshortcutunit").modal("hide");
          }
      })
        $.ajax({
        type: 'POST',
        url: 'mainclass.php',
        data: 'unit_id=' + unit + '&form=selected_unit_amenities',
        success: function(data)
        {
          $("#div_amenities_inquiry").html(data);
            $('.amenities_chk').click(function() {
              if($('.amenities_chk').is(':checked'))
              {
                $(this).prop("checked", true);
              }
              else
              {
                $(this).prop("checked", true);
              }
            });

        }
      })
    }
</script>
