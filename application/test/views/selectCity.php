<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
	<!-- Bootstrap Links -->
	<link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
	<!-- Style Sheet -->
	<link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>assets/css/style.css" />
	<link rel="stylesheet" href="<?php echo base_url("admin/assets/front/") ?>assets/css/responsive.css" />
   
</head>
<body>
        <!-- Header Section Started -->
		
		
		<!-- Header Section Ended -->
		
		<div class="land-banner">
			<div class="land-logo">
				<a href="<?php echo base_url() ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/logo.jpg" alt="" /></a>
			</div>
		</div>
			
        <!-- Main Content Started -->
		
        <div class="main-content">
            
				<div class="land-body">
				    <a href="<?php echo base_url() ?>"><div class="back-icon"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/back.png" alt="" /></div></a>
						<h2>Select your city</h2>
						
						
				<?php 
					$loc = $this->locations_model->getConsumercities();
					
					foreach($loc as $l){
					?>		
						<div class="city-icon">
						<a href="<?php echo base_url("home/selectLocation/").$l->id ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/tir.png" alt="" /></a>
						<div class="city-title">
										<li><? echo $l->location ?></li>
									</div>
						</div>
						

						
				<?php  } ?>		
				</div>



    <!-- Footer Section Starts -->

       <?php front_inner_footer() ?>
			
		<!--	<div class="container-fluid footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 footer-logo">
						    <a href="https://play.google.com/store"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/google-play.png" alt="" style="visibility:hidden" /></a>
						<li>© 2018 Shreeja - Mahila Milk Producer Company Limited. All Rights Reserved.</li>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 footer-logo">
						    <a href="https://play.google.com/store/apps/details?id=com.sreeja.nadsol&hl=en"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/google-play.png" alt="" /></a>
						<li class="float-right"><a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/Privacy policy-SMMPCL.pdf" target="_blank">Privacy Policy</a>     |     <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/Refund policy-SMMPCL.pdf" target="_blank">Refund Policy</a>     |     <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/T&C-SMMPCL.pdf" target="_blank">Terms & Conditions</a> </li>
						</div>
					</div>	
				</div>
			</div>
	
	 Footer Section Ends -->
		
</div>

	<!-- Main Content Ends -->
		
		
	
	
	
	<!-- Scripts -->
	<script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url("admin/assets/front/") ?>assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>