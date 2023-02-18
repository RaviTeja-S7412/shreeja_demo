<!doctype html>
<html lang="en">
<?php //admin_header(); ?> 
  <head>
 <title>Create Page</title> 
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png">
<link href="<?php echo base_url() ?>assets/front/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!--     <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">-->

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
      body, html{ height: 100%; margin: 0; width: 100%}

      .gjs-block-svg {
          width: 61%;
      }

      .gjs-block-svg-path {
        fill: white;
      }
		
    </style>
  </head>
  <body>
 <?php //admin_sidebar(); ?>   
 <header align="right" style="padding: 5px; background-color: #041e42">
  
    <a href="<?php echo base_url() ?>pages"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-home"></i> Home</button></a>
    
 </header>

	   <div id="gjs" style="height:0px; overflow:hidden">
	   
       <?php		
		
	     $playout = $this->input->get("playout");
		
			if($playout == "1-col"){

				$data["layout"] = $this->load->view("grape/layout/1-column");

			}elseif($playout == "2-col"){

				$data["layout"] = $this->load->view("grape/layout/2-column");

			}elseif($playout == "3-col"){

				$data["layout"] = $this->load->view("grape/layout/3-column");

			}elseif($playout == "icon-layout"){

				$data["layout"] = $this->load->view("grape/layout/icon_layout");

			}  
		  
	  ?> 	  
			
	   </div>


		
	   				
            

 	 
<!--
   </div> 

 </div>       
-->

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <input type="hidden" name="page_name" id="pname" value="<?php echo $this->input->get("pname") ?>">  
     <input type="hidden" name="page_route" id="route" value="<?php echo $this->input->get("route") ?>"> 
     <input type="hidden" name="page_layout" id="playout" value="<?php echo $this->input->get("playout") ?>"> 


 

<?php //admin_footer(); ?> 
 
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
				  setStepsBeforeSave: 2,
				  autosave: true,
              	  autoload: true,	
				  type: 'remote',
				 // urlLoad: '<?php //echo base_url() ?>grape/load_template',
				  contentTypeJson: true,
              },
		  
        container : '#gjs',
        fromElement: true,
		showOffsets: 1,
		allowScripts: 1,
		
		  
		  
		canvas: {
			
			styles: ['https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
					 '<?php echo base_url() ?>assets/front/css/style.css',
					 '<?php echo base_url() ?>assets/front/css/bootstrap.min.css',
//					 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
					 '<?php echo base_url() ?>assets/front/css/asmenu.css',
					 '<?php echo base_url() ?>assets/front/css/banner.css',
					 '<?php echo base_url() ?>assets/front/css/marquee.css',
					 'http://fonts.googleapis.com/css?family=Raleway:400,300,500',
					 'https://fonts.googleapis.com/css?family=Abel|Roboto:100,100i,300,300i,400,400i,500',
					 '<?php echo base_url() ?>assets/front/css/jquery.selectBoxIt.css',
					 'http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css',
					],
			
			scripts: ['<?php echo base_url() ?>assets/front/js/jquery.min.js',
					  '<?php echo base_url() ?>assets/front/js/bootstrap.min.js',
//					  'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
					  '<?php echo base_url() ?>assets/front/js/jquery-ui.min.js',
					  '<?php echo base_url() ?>assets/front/js/jquery.selectBoxIt.min.js',
					  '<?php echo base_url() ?>assets/front/js/asmenu.js',
					  '<?php echo base_url() ?>assets/dist/js/grapesjs-preset-webpage.min.js',

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
			//upload: false,
			//uploadName: 'files',
			assets: [
		<?php
			$gallery = $this->db->query("select * from fdm_va_gallery where deleted=0 and status='Active' order by id desc")->result();
		  	
		  	foreach($gallery as $g){
		  
		?>	
		'<?php echo base_url().$g->img_name  ?>',
				
		<?php } ?>		
				
//			 'http://placehold.it/350x250/78c5d6/fff/image1.jpg',
//			 'http://placehold.it/350x250/459ba8/fff/image2.jpg',
//			 'http://placehold.it/350x250/79c267/fff/image3.jpg'

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
//			'navbar_dropdown',
		],
        pluginsOpts: {
          
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
	
// End
	
	
//const blocks = bm.getAll();
//const toRemove = blocks.filter(block => block.get);
//console.log();	

	
//editor.AssetManager.add([
	
<?php
//	$gg = $this->db->get_where("fdm_va_gallery_types",array("deleted"=>0))->result();
//						
//	foreach($gg as $ga){
//		
//		$gallery = $this->db->query("select * from fdm_va_gallery where deleted=0 and status='Active' and gallery_type='$ga->id' order by id desc")->result();
?>	
//  {
//    // You can pass any custom property you want
//    category: '<?php //echo $ga->gallery_type ?>',
//	  
<?php
		
//		foreach($gallery as $img){ 	
?>		
//    src: '<?php //echo base_url().$img->img_name ?>',

<?php //} ?>	  
//  },
	
<?php //} ?>	
//]);
	
// Navbar dropdown plugin 
	
// function navbar_dropdown(editor){
//      editor.BlockManager.add('my-first-block', {
//        label: 'Navbar dropdown',
//		category : 'Extra',  
//        content: '<div id="container"><nav><ul><li><a href="#">Home</a></li><li><a href="#">WordPress</a><ul><li><a href="#">Themes</a></li><li><a href="#">Plugins</a></li><li><a href="#">Tutorials</a></li></ul></li><li><a href="#">Web Design</a><ul><li><a href="#">Resources</a></li><li><a href="#">Links</a></li><li><a href="#">Tutorials</a><ul><li><a href="#">HTML/CSS</a></li><li><a href="#">jQuery</a></li><li><a href="#">Other</a><ul><li><a href="#">Stuff</a></li><li><a href="#">Things</a></li><li><a href="#">Other Stuff</a></li></ul></li></ul></li></ul></li><li><a href="#">Graphic Design</a></li><li><a href="#">Inspiration</a></li><li><a href="#">Contact</a></li><li><a href="#">About</a></li></ul></nav></div>',
//		 attributes: {
//              class: 'fa fa-bars gjs-block gjs-one-bg gjs-four-color-h'
//        }
//      });
//  }
	
// end plugin	
	
	
	
	
		
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
		
		
//	var domComps = editor.DomComponents;
//		
//	domComps.addType('input', {
//    model: dModel.extend({
//      defaults: Object.assign({}, dModel.prototype.defaults, {
//        traits: [
//          // strings are automatically converted to text types
//          'name',
//          'placeholder',
//          {
//            type: 'select',
//            label: 'Type',
//            name: 'type',
//            options: [
//              {value: 'text', name: 'Text'},
//              {value: 'email', name: 'Email'},
//              {value: 'password', name: 'Password'},
//              {value: 'number', name: 'Number'},
//            ]
//          }, {
//            type: 'checkbox',
//            label: 'Required',
//            name: 'required',
//        }],
//      }),
//    }, {
//      isComponent: function(el) {
//        if(el.tagName == 'INPUT'){
//          return {type: 'input'};
//        }
//      },
//    }),
//
//    view: dView,
//});

	  
	  
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
              attributes: {title: 'Save'}
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
			  var route = $("#route").val();
			  var playout = $("#playout").val();	
			 	
			 
//			 console.log(htmldata);
				
//			  console.log(cssdata);
	
//				
//			  $.post("<?php //echo base_url() ?>grape/insert",
//			  {
//				"page_name" : pagename,
//				"route" : route,  	
//				"html": htmldata,
//				"css": cssdata
//				  
//			  });
				
			 $.ajax({
				method: 'POST',
				data: {"page_name" : pagename,"route" : route,"playout":playout, "html": htmldata,"css": cssdata },
				url: '<?php echo base_url() ?>grape/insert',
				success: function(data) {
					window.location = "<?php echo base_url() ?>pages"; 
 
				},
				error : function(data){
					alert("Error Occured Please Try Again");
				} 
			});	
				
//				
//                editor.on('storage:load', function(e) {
//                    console.log('Loaded ', e);
//              });
//
//              editor.on('storage:store', function(e) {
//                    console.log(e);
//              });         
            }
        });	
	
	// Here our `simple-storage` implementation
//const SimpleStorage = {};
//
//editor.StorageManager.add('simple-storage', {
//  /**
//   * Load the data
//   * @param  {Array} keys Array containing values to load, eg, ['gjs-components', 'gjs-style', ...]
//   * @param  {Function} clb Callback function to call when the load is ended
//   * @param  {Function} clbErr Callback function to call in case of errors
//   */
//  load(keys, clb, clbErr) {
//    const result = {};
//
//    keys.forEach(key => {
//      const value = SimpleStorage[key];
//      if (value) {
//        result[key] = value;
//      }
//    });
//
//    // Might be called inside some async method
//    clb(result);
//  },
//  /**
//   * Store the data
//   * @param  {Object} data Data object to store
//   * @param  {Function} clb Callback function to call when the load is ended
//   * @param  {Function} clbErr Callback function to call in case of errors
//   */
//  store(data, clb, clbErr) {
//    for (let key in data) {
//      SimpleStorage[key] = data[key];
//
//    }
//    // Might be called inside some async method
//    clb();
//  }
	
//});

//console.log(SimpleStorage);
//editor.load(res => console.log(LandingPage));		
    </script>
    

    
    
  </body>
</html>
