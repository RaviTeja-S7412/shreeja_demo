<?php front_inner_header() ?>
		
		<!-- Header Section Ended -->
		
        		
		<!-- Main Content Started -->
		
        <div class="main-content">
		
		<!-- Login Form Starts-->
		
<!--		<h4 class="customer-head">Customer Login</h4>-->
		<div class="sign-in">
		
		<div class="cup">
		<img src="<?php echo base_url("admin/assets/front/") ?>assets/images/cup.jpg" alt="" />
		</div>
		<div class="customer-login">
		<h4 class="pt-4 text-light">Update Password</h4>
		<div style="margin-top: 10px;text-align: center" align="center"><?php echo $this->session->flashdata("err") ?></div>
		<!-- <div class="customer-circle"></div> -->
		
		<form class="col-xl-11 col-lg-11 col-md-11 col-sm-12 col-12 mx-auto mt-4 bg-light pb-5" method="post" action="<?php echo base_url("home/updatePassword") ?>">
		
		  <div class="input-group">
<!--        <input type="text" class="form-control frgt" name="npass" placeholder="Create New Password" />-->
        
        
								    
		<div class="fa fa-fw fa-eye-slash field-icon show-password" style="visibility:hidden;" ></div>
		<div class="fa fa-fw fa-eye field-icon hide-password" style="display: none;visibility:hidden;"></div>

		
      </div>
      
                                <div>
        <input name="npass" type="password" id="password" class="form-control col-xl-12 col-lg-12 col-md-12 mx-auto" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" min="6" maxlength="12" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Create Password:" required/>								    
								    <div class="fa fa-fw fa-eye-slash field-icon show-password"></div>
									<div class="fa fa-fw fa-eye field-icon hide-password" style="display: none"></div>
									
								</div>
	  
<!--
	  <div class="input-group">
        <input type="text" class="form-control frgt" name="cpass" placeholder="Re-Type Password" />
		
      </div>
-->
	  
	  <div class="frgt-paswrd">
	  <li><a href="" style="visibility:hidden;">Forget Password ?</a></li>
	  </div>
	  
	  <input type="submit" class="btn btn-block mt-2 login-submit" value="Submit" />
	  
	  
	  
	  
	  
	  
	  
	  </form>
    </div>
		
		</div>



    <!-- Footer Section Starts -->

 <?php front_inner_footer() ?>
 

  <script type="text/javascript">
      
	$(".show-password").click(function() {
		$("#password").attr("type", "text");
		$(".show-password").hide();
		$(".hide-password").show();
	});
	$(".hide-password").click(function() {
		$("#password").attr("type", "password");
		$(".hide-password").hide();
		$(".show-password").show();
	});
  			
			
</script>




