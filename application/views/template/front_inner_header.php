<?php $d = &get_instance(); ?><head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
	<!-- Style Sheet -->
	<link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>inner/css/style.css" />
	<link href="<?php echo base_url() ?>admin/assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	    <link href="<?php echo base_url("admin/") ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

	

	<script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/jquery-1.11.3.min.js"></script>
</head>
		
		<!-- Header Section Ended -->
		
		

        

        <div class="land-banner">
            
            <div class="land-banner-user" style="margin-right:-100px;display:flex;height: auto;
    width: auto;">
				    <ul>
				        
				<?php if($d->session->userdata("user_id")){
				    $uid = $d->session->userdata("user_id");
		            $pChk = $d->db->get_where("orders",array("user_id"=>$uid,"payment_status"=>"Success"))->num_rows();	
		            if($pChk == 0){
				        $fs = ($d->session->userdata("user_id")) ? "products/sampleOrder" : "home/selectCity";
				?>
				        <!--<li><a href="<?php echo base_url().$fs ?>" id="freeSample">Order (Free Sample)</a></li>-->
				<?php  }} ?>
				</ul>
			</div>	
            
			<div class="land-logo">
				<a href="<?php echo shreeja_url() ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/logo.jpg" alt="" /></a>
				
			</div>
			<div class="land-banner-user" style="margin-right:10px">
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
        		