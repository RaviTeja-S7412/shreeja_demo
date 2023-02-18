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
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo base_url() ?>assets/front/assets/images/banner.jpg) no-repeat;">
            <div class="auth-box on-sidebar">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="<?php echo base_url() ?>assets/front/assets/images/logo.jpg" alt="logo" /></span>
                        <h5 class="font-medium m-b-20 m-t-10">Sign In to Admin / Agent</h5>
                        <div id="display"></div>
                        <?php echo $this->session->flashdata("fmsg"); ?>
                    </div>
                    <!-- Admin Form -->
                    <div class="row" id="admin">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" id="loginform" method="post" action="<?php echo base_url() ?>login/do_login">
   
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Mobile Number" aria-label="Username" name="email" id="uname" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="pass" id="pass" aria-describedby="basic-addon1">
                                </div>
                                <!-- <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                                            <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" type="submit" id="">Log In</button>
                                    </div>
                                </div>
                               
                                <div class="form-group m-b-0 m-t-10">
                                    <div class="col-sm-12 text-center">
                                        All rights Reserved Shreeja Milk 
                                        <!-- <a href="authentication-register1.html" class="text-info m-l-5"><b>Sign Up</b></a> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Super Admin Form -->

                     
                                <!-- <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                        Login To <a href="#" id="switch">Super Admin</a>
                                    </div>
                                </div> -->

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
	
$(document).ready(function(){
   $('#pass').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});	

$('.form-control').on('blur', function() {
if($.trim($(this).val())=='')
{
$(this).val(''); 
return false;
}
    
});


    $("#switch").click(function(){
        
        $("#superadmin").toggle();
        //$("#admin").hide();
        
    });
    
</script>
<?php 
if($this->session->userdata("admin_id")){
    $uid = $this->session->userdata("admin_id");
}else{
    $uid = 0;
}
?>
<script type="text/javascript">
    $("#submit").click(function(){
        var eid = $("#eid").val();
        var uname = $("#uname").val();
        var pass = $("#pass").val();

        $.ajax({
            url : "<?php echo base_url() ?>login/do_login",
            type : "post",
            data : {eid:eid,email:uname,pass:pass},
            success : function(data){
                    var cotp =  localStorage.getItem("admin_id");
                    if(cotp==<?php echo $uid ?>){
                        window.location.href = "<?php echo base_url() ?>dashboard";    
                    }else{
                        window.location.href = "<?php echo base_url() ?>login/enterOtp";
                    }    
            },
            error : function(data){
                console.log(data);
            }


        });
    });

</script>