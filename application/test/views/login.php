<?php front_inner_header() ?>
		<!-- Main Content Started -->
		
        <div class="main-content">
		
		<!-- Login Form Starts-->
		
		<h4 class="customer-head">Customer Login</h4>
		<div class="sign-in">
		
		<div class="cup">
		<img src="<?php echo base_url("admin/assets/front/") ?>assets/images/register.jpg" alt="" />
		</div>
		<div class="customer-login">
		<h4 class="pt-4 text-light">Customer Login</h4>
		
		
			<?php echo $this->session->flashdata("err"); ?>			
	
		<!-- <div class="customer-circle"></div> -->
		
		<form class="col-xl-11 col-lg-11 col-md-11 col-sm-12 col-12 mx-auto mt-4 bg-light pb-5 mb-4" method="post" action="<?php echo base_url("home/do_login") ?>">
		
		  <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-mobile text-dark"></i></div>
        </div>
        <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile Number" required>
      </div>
      
       <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-lock text-dark"></i></div>
        </div>
        
        
        <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" min="6" maxlength="12" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="form-control" id="password" placeholder="Enter Password" required>
        <div class="fa fa-fw fa-eye-slash field-icon show-password login-eye"></div>
        <div class="fa fa-fw fa-eye field-icon hide-password login-eye" style="display:none"></div>
      </div>
      
      
      
      <div class="frgt-paswrd">
	  <li><a href="<?php echo base_url("home/forgotPassword") ?>">Forgot Password ?</a></li>
	  </div>
	  
	  <input type="submit" class="btn btn-block mt-4 login-submit" value="Login" />
	  <li class="mt-4">New to Shreeja?</li>
	  <hr />
	  
	  
	  
			<a class="btn signup-submit btn-block mt-4" href="<?php echo base_url("home/selectCity") ?>">New Customer</a>
	  
	  </form>
    </div>
		
		</div>
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
<?php front_inner_footer() ?>
	