<?php front_inner_header(); ?>
        		
		<!-- Main Content Started -->
		
        <div class="main-content">
		
		<!-- Login Form Starts-->
		
<!--		<h4 class="customer-head">Customer Login</h4>-->
		<div class="sign-in">
		
		<div class="cup">
		<img src="<?php echo base_url("admin/assets/front/") ?>assets/images/cup.jpg" alt="" />
		</div>
		<div class="customer-login">
		<h4 class="pt-4 text-light">Forgot Password</h4>
		<div id="error" style="margin-top: 10px;text-align: center" align="center"></div>
		<!-- <div class="customer-circle"></div> -->
		
		<form class="col-xl-11 col-lg-11 col-md-11 col-sm-12 col-12 mx-auto mt-4 bg-light pb-5">
		  
		<div id="mobile">
		  	  <div class="input-group">
                    <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-mobile text-dark"></i></div>
        </div>
				<input type="text" id="smobile" class="form-control frgt" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" placeholder="Enter Mobile Number" required />

			  </div>
	  
	  	      <input type="button" id="msubmit" class="btn btn-block mt-3 login-submit" value="Submit" />
		</div>
		
		<div id="otp" style="display: none">
			  <div class="input-group">

				<input type="tel" name="otp" id="sotp" class="form-control" placeholder="OTP">

			  </div>
							<div class="pull-right" id=""><a href="javascrip:void(0)" id="resendOtp" style="color: black">resend OTP</a></div>
	  
	  	      <input type="button" id="otpsubmit" class="btn btn-block mt-3 login-submit" value="Submit" />
		</div>
		
		
		 </form>
    </div>
		
		</div>

            

    <!-- Footer Section Starts -->
    
 <?php front_inner_footer(); ?>
 
 
<script type="text/javascript">
		
		
$("#resendOtp").click(function(){
	
	var mobile = $("#smobile").val();
	
	
	$.ajax({
		
		type : "post",
		data : {mobile :mobile},
		url : "<?php echo base_url("home/resendOtp") ?>",
		beforeSend : function(){
			
			$("#before").html('<a href="#" id="resendOtp" style="color:black">Sending</a>')	
		},
		success : function(data){
			
			if(data == "success"){
				
				$("#error").html('<div class="alert alert-success">We have resent OTP to your registered mobile number</div>');
				$("#before").html('<a href="#" id="resendOtp" style="color:black">Sent</a>')	

				
			}
			
			if(data == "error"){
				
				$("#error").html('<div class="alert alert-danger">Error Occured Please Try Again</div>')

			}
			
			console.log(data);
		},
		error : function(data){
			
			
			console.log(data);
		}
		
	});

	
	
});				
			
	
$("#msubmit").click(function(){
	
	var mobile = $("#smobile").val();
	
	if(mobile == ""){
		
		$("#error").html('<div class="alert alert-danger">Please Enter Mobile Number</div>')
		
		return false;
	}
	
	$.ajax({
		
		type : "post",
		data : {mobile :mobile},
		url : "<?php echo base_url("home/checkMobilenumber") ?>",
		success : function(data){
			
			if(data == "success"){
				
				$("#mobile").hide();
				$("#otp").show();
				$("#error").html('<div class="alert alert-success">We have sent OTP to your registered mobile number</div>');
				
			}
			
			if(data == "error"){
				
				$("#error").html('<div class="alert alert-danger">Mobile Number Not Registered With Us</div>');

			}
			
			if(data == "oerror"){
				
				$("#error").html('<div class="alert alert-danger">Error Occured Please Try Again</div>');

			}
			console.log(data);
		},
		error : function(data){
			
			
			console.log(data);
		}
		
	});
	
	
});

	
$("#otpsubmit").click(function(){
	
	var otp = $("#sotp").val();
	
	if(otp == ""){
		
		$("#error").html('<div class="alert alert-danger">Please Enter OTP</div>')
		
		return false;
	}
	
	$.ajax({
		
		type : "post",
		data : {otp :otp},
		url : "<?php echo base_url("home/otpConfirm") ?>",
		success : function(data){
			
			if(data == "success"){
				
				window.location.href = "<?php echo base_url("home/changePassword") ?>"
			}
			
			if(data == "error"){
				
				$("#error").html('<div class="alert alert-danger">Please Enter Valid OTP</div>')

			}
			
			console.log(data);
		},
		error : function(data){
			
			
			console.log(data);
		}
		
	});
	
	
});		
			
			
</script>
