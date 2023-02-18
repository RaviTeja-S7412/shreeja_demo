<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.ico">
    <title>Admin</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url() ?>assets/images/background/login-register.jpg) no-repeat center center;">
            <div class="auth-box on-sidebar">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="<?php echo base_url() ?>assets/images/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Sign In to Admin</h5>
                        <div id="error"></div>
                        <?php //echo $this->session->flashdata("fmsg"); ?>
                    </div>
                    <!-- Admin Form -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-horizontal m-t-20">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Enter Authentication Code" max="8" aria-label="emp_id" name="otp" id="otp" aria-describedby="basic-addon1" required>
                                </div>
                                
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="button" id="submit">Submit</button>
                                    </div>
                                </div>
                               
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        All rights Reserved Freedom Bank 
                                        <!-- <a href="authentication-register1.html" class="text-info m-l-5"><b>Sign Up</b></a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Super Admin Form -->

                     
                </div>
                
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>
</body>

</html>

<script type="text/javascript">

$('.form-control').on('blur', function() {
if($.trim($(this).val())=='')
{
$(this).val(''); 
return false;
}
    
});

</script>

<script>
$(document).ready(function() {
var value = localStorage.getItem("admin_id");
//alert(value);
if(value==<?php echo $this->session->userdata("admin_id") ?>){
    
    <?php //$this->db->delete("fdm_va_otp",array("user_id"=>$this->session->userdata("admin_id"))); ?>
    window.location.href = "<?php echo base_url() ?>dashboard";
}
});    

<?php

	
	
?>	
	
$("#submit").click(function(){
	
var otp = $("#otp").val();
	
if(otp == ""){
	
	$("#error").html('<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Enter OTP</div>');
	
	return false;
}	
	
var id = <?php echo $this->session->userdata("admin_id"); ?>;

 $.ajax({
         url: "<?php echo base_url() ?>login/otpVerification",
         type: "post",
         data: {otp: otp},
         success : function(data){
			
			 if(data == 1){	 
				 
				 localStorage.setItem("admin_id",id);
          		 window.location = "<?php echo base_url() ?>dashboard"
			
			 }else{
				 
				 $("#error").html('<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Please Enter Correct OTP</div>');
				 
				 return false;

			 }
         },
         error : function(data){
             	 $("#error").html('<div class="alert alert-danger alert-dismissable"><button type = "button" class ="close" data-dismiss = "alert" aria-hidden = "true">&times;</button>Error Occured Please Try Again</div>');
				 return false;
         }
 });

localStorage.setItem("admin_id",id);

});    



// $.ajax({
//         url: "<?php echo base_url() ?>login/otpVerification",
//         type: "post",
//         data: {email: value},
//         success : function(data){
//             console.log(data);
//         },
//         error : function(data){
//             console.log(data);
//         }
// });



</script>