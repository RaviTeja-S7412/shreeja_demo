<?php front_header(); ?>
		
		<!-- Header Section Ended -->
		
		<div class="banner-login">
		</div>
        
		<!-- Main Content Started -->
		
		<div class="main-content">
		
		<!-- Login Form Starts-->
		
		<h4 class="customer-head">Costumer Login</h4>
					<?php echo $this->session->flashdata("err"); ?>			

				<div class="otp">
						<form method="post" action="<?php echo base_url("home/checkOtp") ?>">	
								<div class="otp-girl">
								<img src="<?php echo base_url("admin/assets/front/") ?>assets/images/otp-img.jpg" alt="" />
								</div>
								<div class="otp-form">
								<h4 class="pt-4 text-light">Verify your mobile number</h4>
								<div class="otp-box">
								<p>SMS with an OTP has been sent to your registered mobile number.&nbsp;&nbsp;<a href="<?php echo base_url() ?>login">change</a> </p>
								<input type="text" name="otp" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Enter OTP" />
								 <input type="submit" class="otp-btn" value="Submit" />
								 </div>
								</div>
								
						</form>		
				</div>



    <!-- Footer Section Starts -->

  <?php front_footer(); ?>