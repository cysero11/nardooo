<?php
include("connect.php");
?>
<style>
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 2px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}

.modal-content  {
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 0px !important; 
}

.table thead th .pagination
{
  display: inline-block;
  float: right;
  padding: 0 !important;
  margin: 0!important;
  padding-bottom: 0 !important;
  padding-top: 12px!important;
  padding-right: 10px!important;
}

.table thead th .pagination ul
{ list-style: none; }

.table thead th .pagination ul li
{
  width: 30px;
  height: 25px;
  display: inline-block;
  /*font-size: 11px;*/
  text-align: center;
  border: solid 1px #8aafce;
  padding: 5px;
  margin-left: -4px;
  vertical-align: top;
  background: white;
  color: #6688a6;
  font-weight: normal;
  border-radius: 0px;
  margin: 0 1px;
  font-size: 10px;
  text-shadow: none;
}

.tabledash_footer thead th {
    padding: 0!important;
    margin: 0!important;
    border-left: 0;
    color: #FFF;
    background: white;
    text-align: left;
    font-size: 12px;
    font-weight: normal;
    border: none !important;
    /*height: */
    /*padding: 0 !important;*/
}

.table thead th .pagination ul li.active
{

  width: 30px;
  height: 25px;
  display: inline-block;
  /*font-size: 11px;*/
  text-align: center;
  border: solid 1px #428BCA;
  border-left: none;
  padding: 5px;
  margin-left: -4px;
  vertical-align: top;
  background: #428BCA;
 

  /*border-top: 1px solid #a1cdde;*/
  color: white;
  border-radius: 0px;
  margin: 0 1px;
  font-size: 10px;
  text-shadow: none;
  /*color:#005566;*/
}
.pagination 
{
  margin: 0px !important;
  height: 45px !important;
}    

tbody tr td { cursor: hand !important; cursor: pointer !important; }
</style>
<script>
	function selectref(type)
	{
		if(type == 1)
		{
			$("#div_ref_content").load("setup/referentials/ref_investigator.php");
		}
		else if(type == 2)
		{
			$("#div_ref_content").load("setup/referentials/ref_mall.php");
		}
		else if(type == 3)
		{
			$("#div_ref_content").load("setup/referentials/ref_building.php");
		}
		else if(type == 4)
		{
			$("#div_ref_content").load("setup/referentials/ref_floor.php");
		}
		else if(type == 5)
		{
			$("#div_ref_content").load("setup/referentials/ref_wing.php");
		}
		else if(type == 6)
		{
			$("#div_ref_content").load("setup/referentials/ref_unit.php");
		}
		else if(type == 7)
		{
			$("#div_ref_content").load("setup/referentials/ref_classification.php");
		}
		else if(type == 8)
		{
			$("#div_ref_content").load("setup/referentials/ref_business.php");
		}
		else if(type == 9)
		{
			$("#div_ref_content").load("setup/referentials/ref_amenities.php");
		}
		else if(type == 10)
		{
			$("#div_ref_content").load("setup/referentials/refsample.php");
		}
	}

	function selectsetup(type)
	{
		alert(type)
		if(type == 1)
		{
			$("#div_setup_content").load("setup_referentials.php");
		}
		else if(type == 2)
		{
			$("#div_setup_content").load("setup_referentials.php");
		}
		else if(type == 3)
		{
			$("#div_setup_content").load("setup_referentials.php");
		}
		else if(type == 4)
		{
			$("#div_setup_content").load("setup_referentials.php");
		}
		else if(type == 5)
		{
			$("#div_setup_content").load("ref_floorplan.php");
		}
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

       // $(".numonly").keyup(function(){
       //       $(this).val(parseFloat(($(this).val())|| 0).toFixed(2));
       // })

       $(".amount").change(function(){
            var v = parseFloat($(this).val());
            $(this).val((isNaN(v)) ? '' : v.toFixed(2));
       });
    }

    // function case() {
    //     $('.upper').keyup(function() {
    //         $(this).val($(this).val().toUpperCase());
    //     });
    // }
</script>
<div class="page-header">
	<h1>Referentials</h1>
</div><!-- /.page-header -->

<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->

		<div>
			<div class="row search-page" id="search-page-1">
				<div class="col-xs-12">
				<!-- <a href="#" id="id-btn-dialog2" class="btn btn-info btn-sm">Confirm Dialog</a> -->
				<!-- <a href="#" id="btn_investigator" class="btn btn-purple btn-sm">Modal Dialog</a> -->
					<div class="row" id="div_setup_content">
						<?php include("setup_referentials.php"); ?>
					</div>
				</div>
			</div>
		</div>

		

		<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->
<!-- /.page-content -->
</div><!-- #dialog-investigator -->

<div id="dialog-confirm" class="hide">
	<div class="alert alert-info bigger-110">
		These items will be permanently deleted and cannot be recovered.
	</div>

	<div class="space-6"></div>

	<p class="bigger-110 bolder center grey">
		<i class="ace-icon fa fa-hand-o-right blue bigger-120"></i>
		Are you sure?
	</p>
</div>
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script src="jquery.nicescroll.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery-ui.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>




		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$("#sys_body").niceScroll({cursorcolor:"#999"});
				$( "#datepicker" ).datepicker({
					showOtherMonths: true,
					selectOtherMonths: false,
					//isRTL:true,
			
					
					/*
					changeMonth: true,
					changeYear: true,
					
					showButtonPanel: true,
					beforeShow: function() {
						//change button colors
						var datepicker = $(this).datepicker( "widget" );
						setTimeout(function(){
							var buttons = datepicker.find('.ui-datepicker-buttonpane')
							.find('button');
							buttons.eq(0).addClass('btn btn-xs');
							buttons.eq(1).addClass('btn btn-xs btn-success');
							buttons.wrapInner('<span class="bigger-110" />');
						}, 0);
					}
			*/
				});
			
			
				//override dialog's title function to allow for HTML titles
				$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
					_title: function(title) {
						var $title = this.options.title || '&nbsp;'
						if( ("title_html" in this.options) && this.options.title_html == true )
							title.html($title);
						else title.text($title);
					}
				}));
			
			
				
				//autocomplete
				 var availableTags = [
					"ActionScript",
					"AppleScript",
					"Asp",
					"BASIC",
					"C",
					"C++",
					"Clojure",
					"COBOL",
					"ColdFusion",
					"Erlang",
					"Fortran",
					"Groovy",
					"Haskell",
					"Java",
					"JavaScript",
					"Lisp",
					"Perl",
					"PHP",
					"Python",
					"Ruby",
					"Scala",
					"Scheme"
				];
				$( "#tags" ).autocomplete({
					source: availableTags
				});
			
				//custom autocomplete (category selection)
				$.widget( "custom.catcomplete", $.ui.autocomplete, {
					_create: function() {
						this._super();
						this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
					},
					_renderMenu: function( ul, items ) {
						var that = this,
						currentCategory = "";
						$.each( items, function( index, item ) {
							var li;
							if ( item.category != currentCategory ) {
								ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
								currentCategory = item.category;
							}
							li = that._renderItemData( ul, item );
								if ( item.category ) {
								li.attr( "aria-label", item.category + " : " + item.label );
							}
						});
					}
				});
				
				 var data = [
					{ label: "anders", category: "" },
					{ label: "andreas", category: "" },
					{ label: "antal", category: "" },
					{ label: "annhhx10", category: "Products" },
					{ label: "annk K12", category: "Products" },
					{ label: "annttop C13", category: "Products" },
					{ label: "anders andersson", category: "People" },
					{ label: "andreas andersson", category: "People" },
					{ label: "andreas johnson", category: "People" }
				];
				$( "#search" ).catcomplete({
					delay: 0,
					source: data
				});
				
				
				//tooltips
				$( "#show-option" ).tooltip({
					show: {
						effect: "slideDown",
						delay: 250
					}
				});
			
				$( "#hide-option" ).tooltip({
					hide: {
						effect: "explode",
						delay: 250
					}
				});
			
				$( "#open-event" ).tooltip({
					show: null,
					position: {
						my: "left top",
						at: "left bottom"
					},
					open: function( event, ui ) {
						ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
					}
				});
			
			
				//Menu
				$( "#menu" ).menu();
			
			
				//spinner
				var spinner = $( "#spinner" ).spinner({
					create: function( event, ui ) {
						//add custom classes and icons
						$(this)
						.next().addClass('btn btn-success').html('<i class="ace-icon fa fa-plus"></i>')
						.next().addClass('btn btn-danger').html('<i class="ace-icon fa fa-minus"></i>')
						
						//larger buttons on touch devices
						if('touchstart' in document.documentElement) 
							$(this).closest('.ui-spinner').addClass('ui-spinner-touch');
					}
				});
			
				//slider example
				$( "#slider" ).slider({
					range: true,
					min: 0,
					max: 500,
					values: [ 75, 300 ]
				});
			
			
			
				//jquery accordion
				$( "#accordion" ).accordion({
					collapsible: true ,
					heightStyle: "content",
					animate: 250,
					header: ".accordion-header"
				}).sortable({
					axis: "y",
					handle: ".accordion-header",
					stop: function( event, ui ) {
						// IE doesn't register the blur when sorting
						// so trigger focusout handlers to remove .ui-state-focus
						ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
					}
				});
				//jquery tabs
				$( "#tabs" ).tabs();
				
				
				//progressbar
				$( "#progressbar" ).progressbar({
					value: 37,
					create: function( event, ui ) {
						$(this).addClass('progress progress-striped active')
							   .children(0).addClass('progress-bar progress-bar-success');
					}
				});
			
				
				//selectmenu
				 $( "#number" ).css('width', '200px')
				.selectmenu({ position: { my : "left bottom", at: "left top" } })
					
			});
		</script>