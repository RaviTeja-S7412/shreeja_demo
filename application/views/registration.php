<head>
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
	<script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/jquery-1.11.3.min.js"></script>
</head>
		
		<!-- Header Section Ended -->
		
	
	<div class="land-banner">
			<div class="land-logo">
				<a href="<?php echo shreeja_url() ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/logo.jpg" alt="" /></a>
			</div>
		</div>
			
        <!-- Main Content Started -->
		
        <div class="main-content">
		
		<!-- Login Form Starts-->
		
		<h4 class="customer-head">Registration Form</h4>
			
			<div class="col-xl-6 col-lg-6 col-md-6 col-12 mx-auto text-center">
			    <div class="alert alert-danger" id="gmail" role="alert" style="display:none">
                
                </div>
			</div>
			
		<?php echo $this->session->flashdata("err"); ?>	
		<span id="" class=""></span>
				<div class="registration">
							
								<div class="registration-girl">
								<img src="<?php echo base_url("admin/assets/front/") ?>assets/images/register.jpg" alt="" />
								</div>
					            <form onsubmit="return f1()" method="post" action="<?php echo base_url("home/insertUser") ?>">			
								<div class="registration-form">
							
								<h4 class="pt-4 text-light">Create Account</h4>
								
							
								<div class="registration-box">
								<input type="text" name="username" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Name:" required>
								
								<?php 
									$mobile = $this->session->userdata("mobile_number");
								?>
								
								<input type="text" name="mobile" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Mobile Number:" value="<?php echo ($mobile) ? $mobile : "" ?>" <?php echo ($mobile) ? "readonly " : "" ?> required>
								
								<input type="email" name="email" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Email ID:" id="email" >
								
						<?php $lid = $this->session->userdata("location_id"); ?>		
								
								<select name="city1" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" <?php echo ($lid) ? "disabled" : "" ?> required>
								  <option value="">Select City</option>
								  
								  <?php $loc = $this->locations_model->getConsumercities(); 
									
									foreach($loc as $ll){
									?>
								  
								  
								  <option value="<?php echo ($lid == $ll->id) ? $lid : $ll->id ?>" <?php echo ($lid == $ll->id) ? "selected" : "" ?>><?php echo $ll->location ?></option>
								  
								   <?php  } ?>
								</select>
								<input type="hidden" name="city" value="<?php echo $lid ?>">
									
								<select name="area" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" id="area" required>
								  <option value="">Select Area</option>
								<?php $areas = $this->db->order_by("area_name","asc")->get_where("tbl_areas",array("status"=>"Active","city_id"=>$lid))->result();
									   foreach($areas as $a){
									?>  
									
								  <option value="<?php echo $a->id ?>"><?php echo $a->area_name ?></option>
								  <?php } ?>
								  <option value="others">Others</option>	
								</select>
								
								<li><a href="javascrip:void(0)" data-toggle="modal" data-target="#select-city" id="anl">Area not listed</a></li>
								
								<input type="text" name="areanotlisted" id="appendArea" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" style="display: none">
								<input type="text" name="locality" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Locality/Street Name:" required>
								
								
								<input name="house_no" type="text" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="House No:" required>
								
								<input name="landmark" type="text" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Land Mark:" required>
								
								<input name="address" type="text" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Address:" required>
								
								<!---<input name="gps" type="text" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Current GPS Location:" />--->
								
								<div class="pt-3"></div>
								
								<div>
								    <input name="password" type="password" id="password" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" min="6" maxlength="12" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Create Password:" required/>
								    <div class="fa fa-fw fa-eye-slash field-icon show-password"></div>
									<div class="fa fa-fw fa-eye field-icon hide-password" style="display: none"></div>
									
								</div>
								<input name="referral_id" type="text" class="form-control col-xl-10 col-lg-10 col-md-10 mx-auto" placeholder="Referral ID:" value="<? echo $this->session->userdata("referral_id") ?>" <? echo ($this->session->userdata("referral_id")) ? 'readonly' : '' ?>>
								
								<div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">I have read and agree to the <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/TandC-SMMPCL.pdf" target="_blank">Terms and Conditions</a>, <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/Refund policy-SMMPCL.pdf" target="_blank">Refund Policy</a> and <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/Privacy policy-SMMPCL.pdf" target="_blank">Privacy Policy</a></label>
                                </div>
								
								<input type="submit" id="rSubmit" class="register-btn" value="Submit" />
								
<!-- Modal -->
<div class="modal fade" id="select-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <div class="modal-content" id="city-model-content">
      <div class="mascot">
          <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/mascot.png" alt="" />
      </div>
      <div class="mascot-content">
          <div class="modal-header" id="city-model-head">
        <h5 class="modal-title" id="select-cityLabel">Enter your Area</h5>
		  
        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="city-modal">
        <div class="registration-box">
			
		  <div id="oarea" style="text-align: center"></div>
			<p>Hi, I am delighted to see you. Kindly share your details,<br /> i will come to you shortly.</p>
			    <textarea class="form-control col-xl-9 col-lg-9 col-md-9 mx-auto" name="" rows="3" id="areanotlisted" placeholder="Address"></textarea>
			<input type="button" id="asubmit" data-dismiss="modal" class="register-btn" value="Submit" />
		</div>
      </div>
      </div>
    </div>
  </div>
</div>
								 </div>
								</div>
					</form>			
								
				</div>
				
				<?php front_inner_footer() ?>
			
			<script type="text/javascript">
			
//			function f1()
//			{
//			    var mail=document.getElementById('email').value;
//			    $('#gmail').fadeIn(5);
//			    $('#fmail').fadeIn(0);
//			    var status=true;
//			        if(!mail.match(/.com|.in/))
 //               	{
 //               	document.getElementById("gmail").innerHTML="Email Should be in .com or .in";
 //               	status=false;
//                	}
 //               	else
 //               	{
  //              	document.getElementsById("gmail").style.visibility = "hidden";
//                	}
//return status;
//			}
//			
			</script>
			
			<script>
//$("#rSubmit").on("click",function(){
			
//	var email = $("#email").val();
//	
//	var com = email.substr(email.length -3);
//	var ins = email.substr(email.length -2);
	
//	if(.com == ".com" || .ins == ".in"){
		
//			alert();
		
//	}else{
		
//        document.getElementById('gmail').innerHTML='<div  class="alert alert-danger">Email Should end with .in or .com</div>';
//		return false;
//		
//	}
	
			
//});				
				
			</script>

<script src="<?php echo base_url("admin/assets/front/") ?>assets/bootstrap/js/bootstrap.js"></script>
	
	
	<script src="<?php echo base_url() ?>admin/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/js/jquery.tabs.js"></script>

    <!-- Footer Section Starts -->

 
  
  
  
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
  
<script type="text/javascript">
	
	
//$("#email").on("change",function(){
//	alert();
//	 var emailAddress = $("#email").val();
//	 
//	 var pattern = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com)";
//     if(pattern.test(emailAddress)){
//		 
//		 alert("y");
//	 }else{
//		 alert("n");
//	 }
//	
//});
//	
	
	$("#area").on("change",function(){
		
		var area = $("#area").val();
		
		if(area == "others"){
			
			$("#area").removeAttr("required","required");
			$("#select-city").modal("show");
			
		}
		
		if(area != ""){
			
			$("#anl").hide();

		}
		
	});
	
	$("#anl").click(function(){
		
		$("#area").removeAttr("required","required");
		
	});		
		
	
	$("#asubmit").click(function(){
		var oarea = $("#areanotlisted").val();
		
		if(oarea == ""){
			
			$("#oarea").html('<div class="alert alert-danger">Enter Address</div>')
			return false;
		}
		
		$("#area").attr("disabled","disabled");
		
		$("#appendArea").show();
		var anl = $("#areanotlisted").val();
		$("#appendArea").val(anl);
	});
	
	$("#close").click(function(){
		
		$("#area").attr("required","required");
	});
			
			
</script> 
