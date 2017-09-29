<style>
ul {
  list-style: none;
  padding: 0;
}
li .list_mall {
  padding-left: 1.3em;
}
/*close f07b*/
li .list_mall:before {
  
  display: inline-block;
  margin-left: -1.3em; /* same as padding-left set on li */
  width: 1.3em; /* same as padding-left set on li */
}

ul .unit {
  list-style: none;
  padding: 0;
}
ul .unit {
  padding-left: 1.3em;
}
ul .unit:before {
  content: "\f015"; /* FontAwesome Unicode */
  color: #666633;
  font-family: FontAwesome;
  display: inline-block;
  margin-left: -1.3em; /* same as padding-left set on li */
  width: 1.3em; /* same as padding-left set on li */
}
</style>
<style>
#group_access_list tr td { cursor: hand !important; cursor: pointer !important; }
#tblpermission tr td { cursor: hand !important; cursor: pointer !important; }
a { cursor: hand !important; cursor: pointer !important; }
#unitlist ul li, ul { cursor: hand !important; cursor: pointer !important; }
</style>

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab">
                <li class="active" id="tab_set">
                  <a data-toggle="tab" onclick="tab_set()">
                    <i class="green ace-icon fa fa-map-marker bigger-120"></i>
                    SET UNIT
                  </a>
                </li>

                <li id="tab_lca">
                  <a data-toggle="tab" onclick="tab_lca()">
                    <i class="yellow ace-icon fa fa-map-marker bigger-120"></i>
                    LCA UNIT
                  </a>
                </li>
              </ul>
          <div class="tab-content" style="display: block; height: 45em;padding-bottom:0px;padding-top: 10px;">
            <div id="div_set" class="tab-pane fade in active" style="padding:20px;">
                <div class="row form-group">
                    <div class="col-md-12 col-xs-12">
                     <?php include("../unit_history/set_history.php"); ?>
                    </div>
                </div>
            </div>

            <div id="div_lca" class="tab-pane fade" style="padding:20px;">
                <div class="row form-group">
                    <div class="col-md-12 col-xs-12">
                     <?php include("../unit_history/lca_history.php"); ?>
                    </div>
                </div>
            </div>
          </div>
        </div>
          
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
<script>
$(function(){
  $("#tbltenantinfolisthist").niceScroll({cursorcolor:"#999"});
  laodallmallsss();
  loadmall();
});

function tab_set()
{
  $("#tab_set").removeClass("active");
  $("#tab_set").addClass("active");
  $("#tab_lca").removeClass("active");
  $("#div_set").removeClass("active");
  $("#div_set").addClass("active");
  $("#div_lca").removeClass("active");
  $("#div_set").removeClass("in");
  $("#div_set").addClass("in");
  $("#div_lca").removeClass("in");
  loadmall();
}

function tab_lca()
{
  $("#tab_set").removeClass("active");
  $("#tab_lca").removeClass("active");
  $("#tab_lca").addClass("active");
  $("#div_set").removeClass("active");
  $("#div_lca").removeClass("active");
  $("#div_lca").addClass("active");
  $("#div_set").removeClass("in");
  $("#div_lca").removeClass("in");
  $("#div_lca").addClass("in");
  loadmall_lca();
}


 function chkthis_wing()
 {
  var mall = $("#txtmall").val();
  if(mall == "")
  {
    showmodal("alert", "Select Mall Branch first.", "", null, "", null, "1");
    $("#txtwing").val("");
  }
 }

 function chkthis_flr()
 {
  var wing = $("#txtwing").val();
  if(wing == "")
  {
    showmodal("alert", "Select Wing first.", "", null, "", null, "1");
    $("#txtfloor").val("");
  }
 }

  function loadwing(mallid)
  {
    $.ajax({
      type: 'POST',
      url: 'tenants/mcp_mainclass.php',
      data: 'mallid=' + mallid + '&form=loadwing',
      beforeSend:function(){
      },
      success: function(data) {
        $("#txtwing").html(data);
        loadfloor($("#txtwing option:first-child").val());
      }
    });
  }
  
  function loadfloor(wingid)
  {
    $.ajax({
      type: 'POST',
      url: 'tenants/mcp_mainclass.php',
      data: 'wingid=' + wingid + '&form=loadfloor',
      beforeSend:function(){
      },
      success: function(data) {
        $("#txtfloor").html(data);
      }
    })
  }

  function selectunit(ids)
  {
    $("#srchunittxt_date").attr("onchange", "loadunithistory(\""+ids+"\")")
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'id=' + ids + '&form=selectunit_history',
      success: function(data)
      {
        var arr = data.split("|");
        $("#txtunit_histunitname").val(arr[2]);
        $("#txtunit_histmallname").val(arr[0]);
        $("#txtunit_histclass").val(arr[14]);
        $("#txtunit_histwingname").val(arr[13]);
        $("#txtunit_histdepartment").val(arr[15]);
        $("#txtunit_histflrname").val(arr[12]);
        $("#txtunit_histcategory").val(arr[16]);
      }
    });

    var date_filter = $("#srchunittxt_date").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'id=' + ids + '&date_filter=' + date_filter + '&form=loadtbl_selectunit_history',
      beforeSend : function() {
        $('#indexloadingscreen').addClass('myspinner');
      },
      success: function(data){
        $('#indexloadingscreen').removeClass('myspinner');
        $("#tbltenantinfolisthist").html(data);
      }      
    })

  }

function selectunit_lca(ids)
{
    $("#srchunittxt_date_lca").attr("onchange", "loadunithistory_lca(\""+ids+"\")")
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'id=' + ids + '&form=selectunit_history',
      success: function(data)
      {
        var arr = data.split("|");
        $("#txtunit_histunitname_lca").val(arr[2]);
        $("#txtunit_histmallname_lca").val(arr[0]);
        $("#txtunit_histclass_lca").val(arr[14]);
        $("#txtunit_histwingname_lca").val(arr[13]);
        $("#txtunit_histdepartment_lca").val(arr[15]);
        $("#txtunit_histflrname_lca").val(arr[12]);
        $("#txtunit_histcategory_lca").val(arr[16]);
      }
    });

    var date_filter = $("#srchunittxt_date_lca").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'id=' + ids + '&date_filter=' + date_filter + '&form=loadtbl_selectunit_history',
      beforeSend : function() {
          $('#indexloadingscreen').addClass('myspinner');
      },
      success: function(data){
          $('#indexloadingscreen').removeClass('myspinner');
        $("#tbltenantinfolisthist_lca").html(data);
      }      
    })  
}

function loadunithistory_lca(ids)
{
  var date_filter = $("#srchunittxt_date_lca").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'id=' + ids + '&date_filter=' + date_filter + '&form=loadtbl_selectunit_history',
      beforeSend : function() {
          $('#indexloadingscreen').addClass('myspinner');
      },
      success: function(data){
          $('#indexloadingscreen').removeClass('myspinner');
        $("#tbltenantinfolisthist_lca").html(data);
      }      
    })
}

function loadunithistory(ids)
{
  var date_filter = $("#srchunittxt_date").val();
    $.ajax({
      type: 'POST',
      url: 'mainclass.php',
      data: 'id=' + ids + '&date_filter=' + date_filter + '&form=loadtbl_selectunit_history',
      beforeSend : function() {
          $('#indexloadingscreen').addClass('myspinner');
      },
      success: function(data){
          $('#indexloadingscreen').removeClass('myspinner');
        $("#tbltenantinfolisthist").html(data);
      }      
    })
}

function laodallmallsss()
{
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'form=laodallmallsss',
    success: function(data)
    {
      $("#txtmall").html(data);
      $("#txtmall_lca").html(data);
    }
  })
}

function loadmall()
{
  var key = $("#srchunittxt").val();
  var mall = $("#txtmall").val();
  var wing = $("#txtwing").val();
  var floor = $("#txtfloor").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'key=' + key + '&mall=' + mall + '&wing=' + wing + '&floor=' + floor + '&form=loadallmalls_SET',
    beforeSend : function() {
        $('#indexloadingscreen').addClass('myspinner');
    },
    success: function(data){
        $('#indexloadingscreen').removeClass('myspinner');
      $("#unitlist").html(data);
      $(".list_mall li").on("click", function (e) {
        e.stopPropagation();
        $(this).children('ul').toggle();
        var icon = $(this).find("i");
        icon.toggleClass("fa-folder-open fa-folder");
      });

      if(key == "" && wing == "" && floor == "")
      {
        $("li .clickme").each(function(){
          $(this).click();
        })
      }

    }
  })
}

function loadmall_lca()
{
  var key = $("#srchunittxt_lca").val();
  var mall = $("#txtmall_lca").val();
  $.ajax({
    type: 'POST',
    url: 'mainclass.php',
    data: 'key=' + key + '&mall=' + mall + '&form=loadallmalls_LCA',
    beforeSend : function() {
      $('#indexloadingscreen').addClass('myspinner');
    },
    success: function(data){
      $('#indexloadingscreen').removeClass('myspinner');
      $("#unitlist_lca").html(data);
      $(".list_mall li").on("click", function (e) {
        e.stopPropagation();
        $(this).children('ul').toggle();
        var icon = $(this).find("i");
        icon.toggleClass("fa-folder-open fa-folder");
      });

      if(key == "" && wing == "" && floor == "")
      {
        $("li .clickme").each(function(){
          $(this).click();
        })
      }

    }
  })
}

function loadmall_lca_first()
{
  var mall = $("#txtmall_lca").val();
  if(mall == "")
  {
    showmodal("alert", "Select Mall Branch first.", "", null, "", null, "1");
    $("#srchunittxt_lca").val("");
  }
  else
  {
     loadmall_lca();
  }
}

    $('.input-daterange').datepicker({autoclose:true});
    
    
    //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
    // $('input[name=date-range-picker]').daterangepicker({
    //     'applyClass' : 'btn-sm btn-success',
    //     'cancelClass' : 'btn-sm btn-default',
    //     locale: {
    //         applyLabel: 'Apply',
    //         cancelLabel: 'Cancel',
    //     }
    // }) 
</script>