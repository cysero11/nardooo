<style>
  .zoom {
      display:inline-block;
      position: relative;
    }
    
    /* magnifying glass icon */
    .zoom:after {
      content:'';
      display:block; 
      width:33px; 
      height:33px; 
      position:absolute; 
      top:0;
      right:0;
      background:url(icon.png);
    }

    

    .zoom img::selection { background-color: transparent; }
</style>
<link rel="stylesheet" href="assets/css/easyzoom.css" />
<div class="modal fade" id="modal_view_image" role="dialog" area-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">

       <!-- Modal header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h4 class="modal-title">Leasing Application</h4> -->
      </div>

       <!-- Modal body-->
      <div class="modal-body" style="" id="modal-body-leasingapp2">
        <div class="row form-group">
          <div class="col-xs-12">
            <br/>
            <center id='content_img'>
              <div class="easyzoom easyzoom--overlay easyzoom--with-toggle">
                  <a id="img_viewed2" href="">
                      <img id="img_viewed" src="" alt="" width="380" height="400" />
                  </a>
              </div>
            </center>  
            <br/>
          </div>    
        </div>
      </div>

      <!-- Modal body-->
      <div class="modal-footer"><br /><br />
          <button class="toggle btn btn-md btn-info" style="display: none;" data-active="true"><i style='color:white !important;' class='ace-icon fa fa-search-minus bigger-120'></i></button>
      </div> 
    </div>
  </div>
</div>
    <script src="assets/dist/easyzoom.js"></script>
<script>

  function load_req_image(url)
  {
    $("#content_img").html("<div class='easyzoom easyzoom--overlay easyzoom--with-toggle'><a id='img_viewed2' href='"+url+"'><img id='img_viewed' src='"+url+"' alt=' width='100%' height='380' /></a></div>");
    funczoom(url)
  }

  function funczoom()
  {
    $("#modal_view_image").modal("show");
      var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.html("<i style='color:white !important;' class='ace-icon fa fa-search-plus bigger-120'></i>").data("active", false);
                api2.teardown();
            } else {
                $this.html("<i style='color:white !important;' class='ace-icon fa fa-search-minus bigger-120'></i>").data("active", true);
                api2._init();
            }
        });
  }
</script>