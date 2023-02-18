<?php $d = &get_instance(); ?>

<!DOCTYPE html>
<html lang="en" prefix="og: http://nadsoltechnolabs.com/shreeja/">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="Shreeja" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://nadsoltechnolabs.com/shreeja/" />
    <meta property="og:description" content="Nadsoltechnolabs,shreeja,milksonline,milkshoponline" />
    <meta property="og:image" content="<?php echo base_url("admin/assets/front/") ?>assets/images/phone.png" />
    <meta property="og:image:url" itemprop="image" content="<?php echo base_url("admin/assets/front/") ?>assets/images/phone.png" />
    <meta property="og:image:width" content="600px" />
    <meta property="og:image:height" content="600px" />
   
    <link rel="shortcut icon" href="https://shreejamilk.com/wp-content/uploads/2017/06/favicon.png" />	
<link rel="apple-touch-icon" href="https://shreejamilk.com/wp-content/uploads/2017/06/favicon.png" />
	

<!-- wp_head() -->
<title>Shreeja &#8211; Mahila Milk Producer Company Limited</title>
	<!-- Bootstrap Links -->
    <link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>assets/bootstrap/css/bootstrap.min.css">
	<!-- jQuery Links-->
    <link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/css/jquery.tabs.css" />
	<link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/css/style.css">
	<!-- Style Sheet -->
	<link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>assets/css/style.css" />
	<link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>assets/css/responsive.css" />
	<!-- Scripts -->
	
	
	<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
	<script type="text/javascript" src="<?php echo base_url("admin/assets/front/") ?>assets/fonts/fontawesome-free-5.6.3-web/js/all.js"></script>-->
	<link href="<?php echo base_url() ?>admin/assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    
	<link href="<?php echo base_url("admin/assets/front/") ?>css/jquery-ui.css" rel="stylesheet" type="text/css"/>
	
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
	<script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/jquery-1.11.3.min.js"></script>
       
                      
</head>

<body>
	
<?php
	
$uid = $d->session->userdata("user_id");
		  
$pChk = $d->db->get_where("orders",array("user_id"=>$uid,"payment_status"=>"Success"))->num_rows();		  
?>	

			

	<!-- Header Started -->
        <div class="menu">
            <div class="logo">
                <a href="<?php echo shreeja_url() ?>"><img src="<?php echo base_url("admin/").$d->admin->getheaderLogo(); ?>" alt=""></a>
            </div>
    
            
            <div class="main-navigation">
            
            <div class="cell">
                   <li><span class="circl"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/phone.png" alt=""></span>+91-<?php echo $d->admin->info("mobile") ?></li>
                </div>
            
            <div class="nav-mould">
             <?php 
            $fs = ($d->session->userdata("user_id")) ? "products/sampleOrder" : "home/selectCity";
            $sub = ($d->session->userdata("user_id")) ? "products" : "home/selectCity";
												
												
             ?> 
             
            <?php
				
			if($pChk == 0){	
			?>	
            <div class="drop-city">
				<a href="<?php echo base_url().$fs ?>" id="freeSample"><li>Order (Free Sample)</li></a>
            </div>
            <?php } ?>
           
                <div class="subscription"><a href="<?php echo base_url().$sub ?>" id="subscription"><li>SUBSCRIPTION</li></a></div>
                <div class="login">
				<?php if($d->session->userdata("user_id")){ ?>
			    	<a href="<?php echo base_url("home/logout") ?>"><li class="pro">Logout</li></a>
           
					<a href="<?php echo base_url("home/profile") ?>"><li class="pro">Profile</li></a>
				<?php }else{ ?>
                	<a href="<?php echo base_url("login") ?>"><li>LOGIN / SIGNUP</li></a>
                
                <?php } ?>
                </div>
                <div class="head-cart"><a href="<?php echo base_url("cart") ?>"><li><i class="fas fa-shopping-cart"></i><span class="mt-0">Cart <i class="badge badge-success cartCount" style="border-radius: 10px;color: #fff; top: -37px;left: 6px;position: relative;background-color: #28a745;"><?php echo (count($d->cart->contents())) ? count($d->cart->contents()) : "" ?></i></span></li></a></div>
                
            </div>
            
			
                
            </div>
            
            
            
            
            
        </div>
		
		<div class="navigation">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                             
                <?php
			
				$mmenu = $d->db->get_where("fdm_va_navbar_header_menu",array("deleted"=>0,"status"=>"Active"))->result();
												 
				if(count($mmenu) > 0){	
					
					foreach($mmenu as $mm){
						
					$smenu = $d->db->get_where("fdm_va_navbar_header_submenu",array("status"=>"Active","deleted"=>0,"menu_type"=>"Header","menu_name"=>$mm->id))->result();	
												 
					?>
                             
                              <ul class="navbar-nav">
                              
                              
                              
								<li class="nav-item active">
								  
								<?php 
								
								if(count($smenu) > 0){
						
								?>  
									  
									  <a class="nav-link" href="<?php echo base_url().$mm->link ?>" target="<?php echo $mm->target ?>" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo strtoupper($mm->name) ?>&nbsp<i class="fas fa-caret-down"></i></a>
									  
								<?php }else{  ?>	  
									  
									  <a class="nav-link" href="<?php echo base_url().$mm->link ?>" target="<?php echo $mm->target ?>"><?php echo strtoupper($mm->name) ?></a>
									  
								<?php } ?>	  
						
							<?php 
								
								if(count($smenu) > 0){
						
								?>
									  
										<div class="dropdown">
											<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											
											<?php foreach($smenu as $sm){ ?>
											
												<a class="dropdown-item" href="<?php echo base_url().$sm->sub_menu_link ?>"  target="<?php echo $sm->sub_menu_target ?>"><?php echo $sm->sub_menu_name ?></a>
												<div class="dropdown-divider"></div>
											
											<?php } ?>
											
											</div>
										</div>
							<?php } ?>
								</li>
							
							  </ul>
                   <?php }} ?>        
                           
                            </div>

                   <?php 
						
						$soc = $d->admin->getSociallinks();
						
						if(count($soc) > 0){
							
						?>
                           
                            <ul class="social">
                               
                               <?php foreach($soc as $sc){ ?>
                               
                                <a href="<?php echo $sc->link ?>"><li class="fb"><i class="<?php echo $sc->icon ?>"></i></li></a>
                            	
                               <?php } ?>
							
                            </ul>
                            
                     <?php } ?>       
                    </nav>
            </div>
            <div class="btwn-empty"></div>
    		<!-- Main-Content Started -->
	<div class="main-content">       
          
         