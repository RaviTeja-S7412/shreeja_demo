<?php $d = &get_instance(); ?>

<!doctype html>
<html>
<head>

<?php
//	$id  = $d->uri->segment(1);
//	
//	if($id == "search" || $id == "news-and-community" || $id == "sitemap"){
	
	?>
<title><?php echo "Freedom Bank" ?></title>
<?php //}else{  
		
//		$mdata = $d->db->get_where("fdm_va_navbar_header_menu",array("link"=>$link,"status"=>"Active","deleted"=>0))->num_rows();
//
//		$smdata = $d->db->get_where("fdm_va_navbar_header_submenu",array("sub_menu_link"=>$link,"status"=>"Active","deleted"=>0))->num_rows();
//		
//		$cmdata = $d->db->get_where("fdm_va_navbar_header_subchild_menu",array("link"=>$link,"status"=>"Active","deleted"=>0))->num_rows();
//		
//		$tmdata = $d->db->get_where("fdm_va_navbar_minibar",array("link"=>$link,"status"=>"Active","deleted"=>0))->num_rows();
//		
//		if($mdata == 1){
//
//			$meta = $d->db->get_where("fdm_va_navbar_header_menu",array("link"=>$link,"status"=>"Active","deleted"=>0))->row();
//
//		}elseif($smdata == 1){
//
//			$meta = $d->db->get_where("fdm_va_navbar_header_submenu",array("sub_menu_link"=>$link,"status"=>"Active","deleted"=>0))->row();
//
//		}elseif($cmdata == 1){
//			
//			$meta = $d->db->get_where("fdm_va_navbar_header_subchild_menu",array("link"=>$link,"status"=>"Active","deleted"=>0))->row();
//			
//		}elseif($tmdata == 1){
//			
//			$meta = $d->db->get_where("fdm_va_navbar_minibar",array("link"=>$link,"status"=>"Active","deleted"=>0))->row();
//			
//		}

		
?>

  <meta charset="UTF-8">
  <meta name="description" content="<?php //echo $page->meta_description  ?>">
  <meta name="keywords" content="<?php //echo $page->meta_keyword ?>">
<!--  <meta name="author" content="<?php //echo $page->meta_title ?>">-->
  <title><?php //echo $page->meta_title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">	
<?php //} ?>	
	
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link href="<?php echo base_url() ?>assets/front/css/style.css" rel="stylesheet">
<!-- Bootstrap -->
<link href="<?php echo base_url() ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/front/css/asmenu.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/front/css/banner.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/front/css/marquee.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Abel|Roboto:100,100i,300,300i,400,400i,500" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/front/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/front/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/jquery.selectBoxIt.css" />
 <script src="<?php echo base_url() ?>assets/front/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/front/js/jquery.selectBoxIt.min.js"></script> 
<script>
$(function() {
  var selectBox = $("select").selectBoxIt();

});


</script> 
<script type="text/javascript">
$(document).ready(function(){
    $("#sel1").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".bo").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".bo").hide();
            }
        });
    }).change();
});
</script>

<!-- End Google Tag Manager -->

<style type="text/css">
/*.atm-box1{ margin-bottom:10px;  padding:10px; border: 10px double rgb(255, 255, 255, 0.5); background:#041e42 url(images/ATM-machine.png) bottom right no-repeat; min-height:300px;}

.atm-box1 h2{font-size:20px !important; font-weight:600 !important; margin:0px; padding:0px !important;}
.atm-box1 p{font-size:14px !important; font-weight:500 !important; margin:0px; color:#fff;  width:40%; padding-top:10px;}


.atm-box2{ margin-bottom:10px;  padding:10px; border: 10px double rgb(255, 255, 255, 0.5); background:#cca147 url(images/mobile_banking.png) bottom left no-repeat; min-height:279px;}

.atm-box2 h2{font-size:20px !important; font-weight:600 !important; margin:0px; color:#041e42 !important; padding:0px !important; }
.atm-box2 h3{font-size:17px !important; font-weight:600 !important; margin:0px; color:#fff !important; }
.atm-box2 p{font-size:14px !important; font-weight:500 !important; margin:0px; color:#fff;  width:40%; float:right; padding-top:10px;}*/
</style>






</head>
<body>
<div class="header">
  <div class="container">
    <div class="col-md-4 col-xs-12"> <div  class="logo"><a href="<?php echo base_url() ?>home"> <img src="<?php echo base_url().$d->admin->getheaderLogo(); ?>"  class="img-responsive"></a>
		</div>  
   </div>
      
      <div  class="col-md-2 col-sm-4 col-xs-12 hidden-xs">
      
      </div>
    <div id="top">
 
     <ul >
      <?php
        $minibar = $d->db->query("select * from fdm_va_navbar_minibar where deleted=0 and status='Active' order by  sort asc")->result();
        if($minibar){
          foreach ($minibar as $mb) {
           
      ?>
      
        <li><a href="<?php echo $mb->link ?>" target="<?php echo $mb->target ?>" class="<?php echo $mb->class ?>"><?php echo $mb->name ?></a></li>
      
      <?php }} ?>  
      </ul>
    </div>
<!--     <div class="top">-->
      <div class="login">
        <div class="btn-group show-on-hover">
          <button type="button" class="btnn button dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-lock" aria-hidden="true"></i> LOGIN <span class="caret"></span> </button>
          <ul class="dropdown-menu" role="menu"> 
            <li><a href="https://web13.secureinternetbank.com/PBI_PBI1151/Login/056009123" target="_blank">Personal Banking</a></li>
            <hr>
            <li><a href="https://web13.secureinternetbank.com/EBC_EBC1961/EBC1961.ashx?WCI=Process&WCE=Request&RID=3000&RTN=056009123&MFA=2" target="_blank">Business Banking</a></li>
             <hr>
            <li><a href="https://web13.secureinternetbank.com/PBI_PBI1151/Enroll/056009123" target="_blank">Enroll Now</a></li>
          </ul>
        </div>
      </div>
<!--    </div>-->
</div>  
    <div class="clearfix"></div>
  <div class="menu-bg">
   <div class="container">
    <div class="col-md-12">
      <nav> 
        <!-- Menu Toggle btn-->
        <div class="menu-toggle">
          <h3>Menu</h3>
          <button type="button" id="menu-btn"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <!-- Responsive Menu Structure--> 
        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
        <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
    <?php 
        $nav = $d->db->query("select * from fdm_va_navbar_header_menu where deleted=0 and status='Active' order by sort asc")->result();
        if($nav){
        foreach ($nav as $n) {
          $sm = $d->db->query("select * from fdm_va_navbar_header_submenu where deleted=0 and status='Active' and menu_name=$n->id")->num_rows(); 
    ?>
      <li>
     <?php if($sm>=1){ ?>
           <a  href="<?php echo $n->link ?>" target="<?php echo $n->target ?>" class="<?php echo $n->class ?>"> <span class="title"><img src="<?php echo base_url('uploads/icons/MainMenu/') ?><?php echo $n->menu_icon ?>"/>&nbsp;<?php echo $n->name ?></span> </a>

      <?php }else{ ?> 
           <a  href="<?php echo $n->link ?>" target="<?php echo $n->target ?>" class="<?php echo $n->class ?>"> <span class="title"><img src="<?php echo base_url('uploads/icons/MainMenu/') ?><?php echo $n->menu_icon ?>"/>&nbsp;<?php echo $n->name ?></span> </a>

      <?php } 

         if($sm>=1){
        ?>
      <!-- Level Two-->
            <ul>
              <?php  
             $smm = $d->db->query("select * from fdm_va_navbar_header_submenu where deleted=0 and status='Active' and menu_name=$n->id")->result();
             foreach ($smm as $s) {
            
              ?>
             <li> 
             
             	<a href="<?php echo base_url() ?><?php echo $s->sub_menu_link ?>" target="<?php echo $s->sub_menu_target ?>"><?php echo $s->sub_menu_name ?></a>
             	
             	 <?php  
				  $cmenu = $d->db->get_where("fdm_va_navbar_header_subchild_menu",array("deleted"=>0,"status"=>"Active","sub_menu_id"=>$s->id))->result();
				  if(count($cmenu) >= 1){
					  
				  ?>
             	<ul>
             		<?php foreach($cmenu as $cm){ 
						   
					      $menu = $d->db->get_where("fdm_va_navbar_header_menu",array("deleted"=>0,"status"=>"Active","id"=>$cm->menu_id))->row();
					
					?>
             		
					<li> <a href="<?php echo base_url() ?><?php echo $cm->link ?>" target="<?php echo $cm->target ?>"><?php echo $cm->sub_child_menu_name ?></a></li>
             		
             		<?php } ?>
             	</ul>
             
             	<?php } ?>
             </li>
            <?php } ?>
            </ul>
            <?php } ?>
          </li>
          <?php }} ?>
         

         <?php  if($d->admin->get_option("search_bar")==1){ ?>
         
          <span class="custom-search-input">
           <!-- <form action="<?php echo base_url() ?>search" method="post"> -->
			  <div class="input-group col-md-3 pull-ss">
				<input type="text" name="name" class="search-query form-control" placeholder="Search" />
				<span class="input-group-btn">
				<button class="btn btn-danger" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> </button>
				</span> 
			  </div>
           <!-- </form> -->
          </span>
          
        <?php } ?>
        </ul>
      </nav>
    </div>
    </div>
  </div>
  <div class="clearfix"></div>
  </div>
</div>