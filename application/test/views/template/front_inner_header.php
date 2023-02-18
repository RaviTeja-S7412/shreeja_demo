<?php $d = &get_instance(); ?>

<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
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
	<!-- Style Sheet -->
	<link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>inner/css/style.css" />
	<link href="<?php echo base_url() ?>admin/assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	    <link href="<?php echo base_url("admin/") ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

	

	<script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/jquery-1.11.3.min.js"></script>
</head>
		
		<!-- Header Section Ended -->
		
		

        <div class="land-banner">
			<div class="land-logo">
				<a href="<?php echo base_url() ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/logo.jpg" alt="" /></a>
				
			</div>
			<div class="land-banner-user">
				    <ul>
				        
				<?php if($d->session->userdata("user_id")){ ?>
				        <li><a href="<?php echo base_url("home/profile") ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/user2.png" /> Profile</a></li>
				<?php  } ?>        
				        <li><a href="<?php echo base_url("cart") ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/cart-icon.png" /> Cart<span class="badge badge-success cartCount inner-count"><?php echo (count($d->cart->contents())) ? count($d->cart->contents()) : "" ?></span></a></li>
				        
				        
				<?php if($d->session->userdata("user_id")){ ?>
				        <li class="log"><a href="<?php echo base_url("home/logout") ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/logout2.png" /> Logout</a></li>
				<?php }else{ ?>
				
				        <li><a href="<?php echo base_url("login") ?>"><i class="fas fa-user"></i> login</a></li>
				<?php  } ?>
				        
				        
				    </ul>
				</div>
			
        </div>
        		