<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 	<title>Edit Page</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png">
<link href="<?php echo base_url() ?>assets/front/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!--     <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">-->
<!--
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
-->
<!--    <link rel="stylesheet" href="stylesheets/toastr.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/grapes.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/grapesjs-preset-webpage.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/tooltip.css">
<!--    <link rel="stylesheet" href="dist/css/grapesjs-plugin-filestack.css">-->
<!--    <link rel="stylesheet" href="dist/css/demos.css">-->

<!--    <script src="http://static.filestackapi.com/v3/filestack.js"></script>-->
    <!-- <script src="js/aviary.js"></script> old //feather.aviary.com/imaging/v3/editor.js -->
<!--    <script src="js/toastr.min.js"></script>-->

<!--    <script src="js/grapes.min.js?v0.14.40"></script>-->
    <script src="<?php echo base_url() ?>assets/dist/js/grapes.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/grapesjs-preset-webpage.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/grapesjs-lory-slider.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/grapesjs-tabs.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/grapesjs-custom-code.min.js"></script>
<!--    <script src="js/grapesjs-touch.min.js?0.1.1"></script>-->
    <script src="<?php echo base_url() ?>assets/dist/js/grapesjs-parser-postcss.min.js"></script>
    
    
<!--    <script src="https://unpkg.com/grapesjs"></script>-->
    <script src="<?php echo base_url() ?>assets/dist/grapesjs-blocks-basic.min.js"></script>
       
    
    <style type="text/css">
      body, html{ height: 100%; margin: 0;}

      .gjs-block-svg {
          width: 61%;
      }

      .gjs-block-svg-path {
        fill: white;
      }
    </style>
  </head>
  <body>
 <header align="right" style="padding: 5px; background-color: #041e42">
  
    <a href="<?php echo base_url() ?>pages"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-home"></i> Home</button></a>
    
 </header>
 <?php
	
	$p = $this->db->get_where("pages",array("id"=>$this->uri->segment(3)))->row();
	
	if($p->route == "home"){ 

 ?>
<input type="hidden" class="form-control" name="pname" id="pname" value="<?php echo $p->page_name ?>">
<input type="hidden" class="form-control" name="proute" id="proute" value="<?php echo $p->route ?>">
<?php
															
	}else{
 ?>
 
 
 <div style="background-color: #F3E4E4; padding-left: 30px">

	 <div class="row">

	   <div class="col-md-4">	

		<div class="form-group">
		<label>Page Name:</label>
		
			<input type="text" class="form-control" name="pname" id="pname" value="<?php echo $p->page_name ?>">

		</div>

	   </div>

	   <div class="col-md-4">	

		<label>Page Route:</label>
		<div class="form-group">

			<input type="text" class="form-control" name="proute" id="proute" value="<?php echo $p->route ?>">

		</div>

	   </div>	

	 </div>	

 </div>    
  
 <?php } ?>
      
    <div id="gjs" style="height:0px; overflow:hidden">
    </div>
        

	  <script src="<?php echo base_url("assets/libs/jquery/dist/") ?>jquery.min.js"></script>
 
 
<script type="text/javascript">

	  
      var editor = grapesjs.init({
		  
        height: '100%',
//        storageManager:{ type: 'simple-storage' },
//		  storageManager: {
//			id: 'gjs-',             // Prefix identifier that will be used on parameters
//			type: "local",          // Type of the storage
//			autosave: true,         // Store data automatically
//			autoload: true,         // Autoload stored data on init
//			stepsBeforeSave: 1,     // If autosave enabled, indicates how many changes are necessary before store method is triggered
//		  },
		  
		storageManager: {
              stepsBeforeSave: 2,
			  autosave: true,
              autoload: true,
              type: 'remote',
//              urlStore: '<?php //echo base_url() ?>grape/send',
		<?php if($this->uri->segment(1)){ ?>		
			
              urlLoad: '<?php echo base_url() ?>grape/load/<?php echo $this->uri->segment(3) ?>',
			
		<?php } ?>	
              contentTypeJson: true,
              },
		  
        container : '#gjs',
        fromElement: true,
		showOffsets: 1,
		allowScripts: 1,
		  
		canvas: {
			styles: [
					 '<?php echo base_url() ?>assets/front/assets/bootstrap/css/bootstrap.min.css',
					 '<?php echo base_url() ?>assets/front/assets/plugins/jquery/tabs/css/jquery.tabs.css',
					 '<?php echo base_url() ?>assets/front/assets/plugins/jquery/tabs/css/style.css',
					 '<?php echo base_url() ?>assets/front/assets/css/style.css',
					],
			
			scripts: [
					 '<?php echo base_url() ?>assets/front/assets/fonts/fontawesome-free-5.6.3-web/js/all.js',
					 '<?php echo base_url() ?>assets/front/assets/plugins/jquery/tabs/jquery-1.11.3.min.js',
					 '<?php echo base_url() ?>assets/front/assets/bootstrap/js/bootstrap.js',
					 '<?php echo base_url() ?>assets/front/assets/plugins/jquery/tabs/js/jquery.tabs.js',
					 ],
	    },  
		 script: function () {
			// Do stuff using jquery
			$("#respMenu").aceResponsiveMenu({
                 resizeWidth: '768', // Set the same in Media query       
                 animationSpeed: 'fast', //slow, medium, fast
                 accoridonExpAll: false //Expands all the accordion menu on click
             });

		  },  
		
        assetManager: {
//          embedAsBase64: 1,
//          assets: images
//		    dropzone: 1,
//    		dropzoneContent: '<div class="dropzone-inner">Drop here your assets</div>',
			upload: 0,
			uploadName: 'files',
			assets: [
     <?php
			$gallery = $this->db->query("select * from fdm_va_gallery where deleted=0 and status='Active' order by id desc")->result();
		  	
		  	foreach($gallery as $g){
		  
		?>	
		'<?php echo base_url().$g->img_name  ?>',
				
		<?php } ?>
    ],
        },  
		styleManager: { clearProperties: 1 },  
        plugins: [
			'gjs-blocks-basic',
		 	'gjs-preset-webpage',
//          	'grapesjs-lory-slider',
			'grapesjs-tabs',
			'grapesjs-custom-code',
//			'grapesjs-touch',
			'grapesjs-parser-postcss',
		],
        pluginsOpts: {
          'gjs-blocks-basic': {},
//		  'grapesjs-lory-slider': {
//            sliderBlock: {
//              category: 'Extra'
//            }
//          },
          'grapesjs-tabs': {
            tabsBlock: {
              category: 'Extra'
            }
          },
          'gjs-preset-webpage': {
            modalImportTitle: 'Import Template',
            modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
            modalImportContent: function(editor) {
              return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
            },	
          },
		  'grapesjs-custom-code': {
			  placeholderContent : '<span>Insert here your custom code</span>'
		  },	
	   },
		  
	   customStyleManager: [{
		   
              name: 'General',
              buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'],
              properties:[{
                  name: 'Alignment',
                  property: 'float',
                  type: 'radio',
                  defaults: 'none',
                  list: [
                    { value: 'none', className: 'fa fa-times'},
                    { value: 'left', className: 'fa fa-align-left'},
                    { value: 'right', className: 'fa fa-align-right'}
                  ],
                },
                { property: 'position', type: 'select'}
              ],
            },{
                name: 'Dimension',
                open: false,
                buildProps: ['width', 'flex-width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
                properties: [{
                  id: 'flex-width',
                  type: 'integer',
                  name: 'Width',
                  units: ['px', '%'],
                  property: 'flex-basis',
                  toRequire: 1,
                },{
                  property: 'margin',
                  properties:[
                    { name: 'Top', property: 'margin-top'},
                    { name: 'Right', property: 'margin-right'},
                    { name: 'Bottom', property: 'margin-bottom'},
                    { name: 'Left', property: 'margin-left'}
                  ],
                },{
                  property  : 'padding',
                  properties:[
                    { name: 'Top', property: 'padding-top'},
                    { name: 'Right', property: 'padding-right'},
                    { name: 'Bottom', property: 'padding-bottom'},
                    { name: 'Left', property: 'padding-left'}
                  ],
                }],
              },{
                name: 'Typography',
                open: false,
                buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow'],
                properties:[
                  { name: 'Font', property: 'font-family'},
                  { name: 'Weight', property: 'font-weight'},
                  { name:  'Font color', property: 'color'},
                  {
                    property: 'text-align',
                    type: 'radio',
                    defaults: 'left',
                    list: [
                      { value : 'left',  name : 'Left',    className: 'fa fa-align-left'},
                      { value : 'center',  name : 'Center',  className: 'fa fa-align-center' },
                      { value : 'right',   name : 'Right',   className: 'fa fa-align-right'},
                      { value : 'justify', name : 'Justify',   className: 'fa fa-align-justify'}
                    ],
                  },{
                    property: 'text-decoration',
                    type: 'radio',
                    defaults: 'none',
                    list: [
                      { value: 'none', name: 'None', className: 'fa fa-times'},
                      { value: 'underline', name: 'underline', className: 'fa fa-underline' },
                      { value: 'line-through', name: 'Line-through', className: 'fa fa-strikethrough'}
                    ],
                  },{
                    property: 'text-shadow',
                    properties: [
                      { name: 'X position', property: 'text-shadow-h'},
                      { name: 'Y position', property: 'text-shadow-v'},
                      { name: 'Blur', property: 'text-shadow-blur'},
                      { name: 'Color', property: 'text-shadow-color'}
                    ],
                }],
              },{
                name: 'Decorations',
                open: false,
                buildProps: ['opacity', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
                properties: [{
                  type: 'slider',
                  property: 'opacity',
                  defaults: 1,
                  step: 0.01,
                  max: 1,
                  min:0,
                },{
                  property: 'border-radius',
                  properties  : [
                    { name: 'Top', property: 'border-top-left-radius'},
                    { name: 'Right', property: 'border-top-right-radius'},
                    { name: 'Bottom', property: 'border-bottom-left-radius'},
                    { name: 'Left', property: 'border-bottom-right-radius'}
                  ],
                },{
                  property: 'box-shadow',
                  properties: [
                    { name: 'X position', property: 'box-shadow-h'},
                    { name: 'Y position', property: 'box-shadow-v'},
                    { name: 'Blur', property: 'box-shadow-blur'},
                    { name: 'Spread', property: 'box-shadow-spread'},
                    { name: 'Color', property: 'box-shadow-color'},
                    { name: 'Shadow type', property: 'box-shadow-type'}
                  ],
                },{
                  property: 'background',
                  properties: [
                    { name: 'Image', property: 'background-image'},
                    { name: 'Repeat', property:   'background-repeat'},
                    { name: 'Position', property: 'background-position'},
                    { name: 'Attachment', property: 'background-attachment'},
                    { name: 'Size', property: 'background-size'}
                  ],
                },],
              },{
                name: 'Extra',
                open: false,
                buildProps: ['transition', 'perspective', 'transform'],
                properties: [{
                  property: 'transition',
                  properties:[
                    { name: 'Property', property: 'transition-property'},
                    { name: 'Duration', property: 'transition-duration'},
                    { name: 'Easing', property: 'transition-timing-function'}
                  ],
                },{
                  property: 'transform',
                  properties:[
                    { name: 'Rotate X', property: 'transform-rotate-x'},
                    { name: 'Rotate Y', property: 'transform-rotate-y'},
                    { name: 'Rotate Z', property: 'transform-rotate-z'},
                    { name: 'Scale X', property: 'transform-scale-x'},
                    { name: 'Scale Y', property: 'transform-scale-y'},
                    { name: 'Scale Z', property: 'transform-scale-z'}
                  ],
                }]
              },{
                name: 'Flex',
                open: false,
                properties: [{
                  name: 'Flex Container',
                  property: 'display',
                  type: 'select',
                  defaults: 'block',
                  list: [
                    { value: 'block', name: 'Disable'},
                    { value: 'flex', name: 'Enable'}
                  ],
                },{
                  name: 'Flex Parent',
                  property: 'label-parent-flex',
                  type: 'integer',
                },{
                  name      : 'Direction',
                  property  : 'flex-direction',
                  type    : 'radio',
                  defaults  : 'row',
                  list    : [{
                            value   : 'row',
                            name    : 'Row',
                            className : 'icons-flex icon-dir-row',
                            title   : 'Row',
                          },{
                            value   : 'row-reverse',
                            name    : 'Row reverse',
                            className : 'icons-flex icon-dir-row-rev',
                            title   : 'Row reverse',
                          },{
                            value   : 'column',
                            name    : 'Column',
                            title   : 'Column',
                            className : 'icons-flex icon-dir-col',
                          },{
                            value   : 'column-reverse',
                            name    : 'Column reverse',
                            title   : 'Column reverse',
                            className : 'icons-flex icon-dir-col-rev',
                          }],
                },{
                  name      : 'Justify',
                  property  : 'justify-content',
                  type    : 'radio',
                  defaults  : 'flex-start',
                  list    : [{
                            value   : 'flex-start',
                            className : 'icons-flex icon-just-start',
                            title   : 'Start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-just-end',
                          },{
                            value   : 'space-between',
                            title    : 'Space between',
                            className : 'icons-flex icon-just-sp-bet',
                          },{
                            value   : 'space-around',
                            title    : 'Space around',
                            className : 'icons-flex icon-just-sp-ar',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-just-sp-cent',
                          }],
                },{
                  name      : 'Align',
                  property  : 'align-items',
                  type    : 'radio',
                  defaults  : 'center',
                  list    : [{
                            value   : 'flex-start',
                            title    : 'Start',
                            className : 'icons-flex icon-al-start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-al-end',
                          },{
                            value   : 'stretch',
                            title    : 'Stretch',
                            className : 'icons-flex icon-al-str',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-al-center',
                          }],
                },{
                  name: 'Flex Children',
                  property: 'label-parent-flex',
                  type: 'integer',
                },{
                  name:     'Order',
                  property:   'order',
                  type:     'integer',
                  defaults :  0,
                  min: 0
                },{
                  name    : 'Flex',
                  property  : 'flex',
                  type    : 'composite',
                  properties  : [{
                          name:     'Grow',
                          property:   'flex-grow',
                          type:     'integer',
                          defaults :  0,
                          min: 0
                        },{
                          name:     'Shrink',
                          property:   'flex-shrink',
                          type:     'integer',
                          defaults :  0,
                          min: 0
                        },{
                          name:     'Basis',
                          property:   'flex-basis',
                          type:     'integer',
                          units:    ['px','%',''],
                          unit: '',
                          defaults :  'auto',
                        }],
                },{
                  name      : 'Align',
                  property  : 'align-self',
                  type      : 'radio',
                  defaults  : 'auto',
                  list    : [{
                            value   : 'auto',
                            name    : 'Auto',
                          },{
                            value   : 'flex-start',
                            title    : 'Start',
                            className : 'icons-flex icon-al-start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-al-end',
                          },{
                            value   : 'stretch',
                            title    : 'Stretch',
                            className : 'icons-flex icon-al-str',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-al-center',
                          }],
                }]
              }
            ],
         	  
		  
		  
       });
	
// Remove Blocks You Don't need
	
	const bm = editor.BlockManager;
	
	
	bm.remove("countdown");	
	bm.remove("h-navbar");	
//	bm.remove("");	
	
// End	
		
      // Add Settings Sector
        var traitsSector = $('<div class="gjs-sm-sector no-select">'+
          '<div class="gjs-sm-title"><span class="icon-settings fa fa-cog"></span> Settings</div>' +
          '<div class="gjs-sm-properties" style="display: none;"></div></div>');
        var traitsProps = traitsSector.find('.gjs-sm-properties');
        traitsProps.append($('.gjs-trt-traits'));
        $('.gjs-sm-sectors').before(traitsSector);
        traitsSector.find('.gjs-sm-title').on('click', function(){
          var traitStyle = traitsProps.get(0).style;
          var hidden = traitStyle.display == 'none';
          if (hidden) {
            traitStyle.display = 'block';
          } else {
            traitStyle.display = 'none';
          }
        });	
		
		 
	  
	var pn = editor.Panels;
      var modal = editor.Modal;
      editor.Commands.add('canvas-clear', function() {
        if(confirm('Are you sure to clean the canvas?')) {
          var comps = editor.DomComponents.clear();
          setTimeout(function(){ localStorage.clear()}, 0)
        }
      });

       // Show borders by default
      pn.getButton('options', 'sw-visibility').set('active', 1);
		
		 // Load and show settings and style manager
        var openTmBtn = pn.getButton('views', 'open-tm');
        openTmBtn && openTmBtn.set('active', 1);
        var openSm = pn.getButton('views', 'open-sm');
        openSm && openSm.set('active', 1);

		

      // Simple warn notifier
//      var origWarn = console.warn;
//      toastr.options = {
//        closeButton: true,
//        preventDuplicates: true,
//        showDuration: 250,
//        hideDuration: 150
//      };
//      console.warn = function (msg) {
//        if (msg.indexOf('[undefined]') == -1) {
//          toastr.warning(msg);
//        }
//        origWarn(msg);
//      };
	
		
		
	// Add and beautify tooltips
      [['sw-visibility', 'Show Borders'], ['preview', 'Preview'], ['fullscreen', 'Fullscreen'],
       ['export-template', 'Export'], ['undo', 'Undo'], ['redo', 'Redo'],
       ['gjs-open-import-webpage', 'Import'], ['canvas-clear', 'Clear canvas']]
      .forEach(function(item) {
        pn.getButton('options', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      [['open-sm', 'Style Manager'], ['open-layers', 'Layers'], ['open-blocks', 'Blocks']]
      .forEach(function(item) {
        pn.getButton('views', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      var titles = document.querySelectorAll('*[title]');

      for (var i = 0; i < titles.length; i++) {
        var el = titles[i];
        var title = el.getAttribute('title');
        title = title ? title.trim(): '';
        if(!title)
          break;
        el.setAttribute('data-tooltip', title);
        el.setAttribute('title', '');
      }
		
		
	  
	  

     editor.Panels.addButton
          ('options',
            [{
              id: 'save-db',
              className: 'fa fa-floppy-o',
              command: 'save-db',
              attributes: {title: 'Update'}
            }]
          );
	
 editor.Commands.add
        ('save-db',
        {
            run: function(editor, sender)
            {
              sender && sender.set('active'); // turn off the button
              editor.store();
              var htmldata = editor.getHtml();
			  var cssdata = editor.getCss();
			  var pagename = $("#pname").val();
			  var route = $("#proute").val();
//			  console.log(htmldata);
//			  console.log(cssdata);
				
//			  $.post("<?php //echo base_url() ?>grape/updatePage/<?php //echo $this->uri->segment(3) ?>",
//			  {
//				"page_name" : pagename,
//				"route" : route,  
//				"html": htmldata,
//				"css": cssdata
//			  });
//				window.location = "<?php //echo base_url() ?>pages/all-pages"; 
				
			 $.ajax({
				method: 'POST',
				data: {"pname":pagename,"route":route,"html": htmldata,"css": cssdata },
				url: '<?php echo base_url() ?>grape/updatePage/<?php echo $this->uri->segment(3) ?>',
				success: function(data) {
					window.onbeforeunload = null;
					window.location = "<?php echo base_url() ?>pages"; 
// 					alert("successfully updated");
				},
				error : function(data){
					alert("Error Occured Please Try Again");
				} 
			});			
				
                editor.on('storage:load', function(e) {
                    console.log('Loaded ', e);
              });

              editor.on('storage:store', function(e) {
                    console.log(e);
              });         
            }
        });	
	

	
	
    </script>
    
<script type="text/javascript">
	  
$("#sub").click(function(){
	
	var gs = res;
	var pname = $("#pname").val();
	var route = $("#route").val();
	
	$.ajax({
	
		type: "post",
		url:"<?php echo base_url() ?>grape/send",
		data:{content:gs,pname:pname,route:route},
		success:function(data){
		
			console.log(data);
		}
	
	
	});	
	
});	  
	  
</script>
    
    
  </body>
</html>
