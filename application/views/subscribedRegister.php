<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="https://shreejamilk.com/wp-content/uploads/2017/06/favicon.png" />	
<link rel="apple-touch-icon" href="https://shreejamilk.com/wp-content/uploads/2017/06/favicon.png" />
	

<!-- wp_head() -->
<title>Shreeja &#8211; Mahila Milk Producer Company Limited</title>
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
				<a href="<?php echo shreeja_url() ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/logo.jpg" alt="" /></a>
			</div>
		</div>
			
        <!-- Main Content Started -->
		
        <div class="main-content">

				<div class="land-body">
					<a href="<?php echo base_url("home/selectCity") ?>"><div class="back-icon"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/back.png" alt="" /></div></a>
						<div class="container" id="mobile" align="center">

						<h2 id="select">Enter Mobile Number</h2>
						<div id="merror"></div>
							<div class="form-group">
								
								<input type="tel" name="mobile" pattern="^\d{10}$" id="smobile" class="form-control mobile-nmbr" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" placeholder="Mobile Number" required>
								
							</div>
							
							<div class="form-group">
								<button type="button" id="msubmit" class="btn btn-info">Submit</button>
							</div>
							<li>If you are registered customer, please <a href="<?php echo base_url("login") ?>">Login</a></li>
						</div>
						
						
						
						<div class="container" id="otp" align="center" style="display: none">

						<h2 id="select">Enter OTP</h2>
						
						<div id="otperror"></div>
							<div class="form-group">
								
								<input type="tel" name="otp" id="sotp" class="form-control" placeholder="OTP" style="width: 50%; height: 45px; text-align: center" autocomplete="off">
								
							</div>
							
							<li class="resend-otp"><a href="javascrip:void(0)" id="resendOtp">Resend OTP</a></li>
							
							<div class="form-group">
								
								<button type="button" id="otpsubmit" class="btn btn-info">Submit</button>
							</div>
						</div>						
						
						
				
				</div>

       

    <!-- Footer Section Starts -->

       
			
			<?php front_inner_footer() ?>
	
	<!-- Footer Section Ends -->
		
</div>

	<!-- Main Content Ends -->
		
		
	
	
	
	<!-- Scripts -->
	<script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url("admin/assets/front/") ?>assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>



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
				
				$("#otperror").html('<div class="alert alert-success" style="width: 50%">We have resent OTP to your mobile number</div>');
				$("#before").html('<a href="#" id="resendOtp" style="color:black">Sent</a>')	

				
			}
			
			if(data == "error"){
				
				$("#otperror").html('<div class="alert alert-danger" style="width: 50%">Error Occured Please Try Again</div>')

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
		
		$("#merror").html('<div class="alert alert-danger" style="width: 50%">Please Enter Mobile Number</div>')
		
		return false;
	}
	
	$.ajax({
		
		type : "post",
		data : {mobile :mobile},
		dataType : "json",
		url : "<?php echo base_url("home/sendOtp") ?>",
		success : function(data){
			
			if(data.status == "success"){
				
				if(data.steps_completed == 3){
				    
				    var r = confirm("Your mobile number is already verified please continue to register");
				    
				    if(r){
					
					    window.location.href = "<? echo base_url('home/register') ?>";
					    
				    }
					
				}else if(data.steps_completed == 4){
					
				    var r = confirm("User already registered please login to continue");
				    
				    if(r){
				    
					    window.location.href = "<? echo base_url('login') ?>"
					
				    }
				}else{
				
					$("#mobile").hide();
					$("#otp").show();
					$("#otperror").html('<div class="alert alert-success" style="width: 50%">We have sent OTP to your mobile number</div>');
				}
			}
			
			if(data.status == "error"){
				
				$("#merror").html('<div class="alert alert-danger" style="width: 50%">Error Occured Please Try Again</div>')

			}
			
//			if(data == "exists"){
//				
//				$("#merror").html('<div class="alert alert-danger" style="width: 50%">Mobile Number Already Registered.</div>')
//
//			}
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
		
		$("#otperror").html('<div class="alert alert-danger" style="width: 50%">Please Enter OTP</div>')
		
		return false;
	}
	
	$.ajax({
		
		type : "post",
		data : {otp :otp},
		url : "<?php echo base_url("home/otpConfirm") ?>",
		success : function(data){
			
			if(data == "success"){
				
				window.location.href = "<?php echo base_url("register") ?>"
			}
			
			if(data == "error"){
				
				$("#otperror").html('<div class="alert alert-danger" style="width: 50%">Please Enter Valid OTP</div>')

			}
			
			console.log(data);
		},
		error : function(data){
			
			
			console.log(data);
		}
		
	});
	
	
});
	
</script>




