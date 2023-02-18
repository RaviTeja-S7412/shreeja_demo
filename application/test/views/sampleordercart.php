<?php 
	date_default_timezone_set("Asia/Kolkata");

	$uid = $this->session->userdata("user_id");

	$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();

?><head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
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
				<a href="<?php echo base_url() ?>"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/logo.jpg" alt="" /></a>
			</div>
			
				<div class="land-banner-user">
				    
				    <ul>
				        
				<?php if($this->session->userdata("user_id")){ ?>
				        <a href="<?php echo base_url("home/profile") ?>"><li><i class="fas fa-user"></i> Profile</li></a>
				<?php  } ?>        
				        <li><a href="<?php echo base_url("cart") ?>"><i class="fas fa-shopping-cart"></i> Cart<span class="badge badge-success cartCount"><?php echo (count($this->cart->contents())) ? count($this->cart->contents()) : "" ?></span></a></li>
				        
				        
				<?php if($this->session->userdata("user_id")){ ?>
				        <a href="<?php echo base_url("home/logout") ?>"><li><i class="fas fa-sign-out-alt"></i> Logout</li></a>
				<?php }else{ ?>
				
				        <a href="<?php echo base_url("login") ?>"><li><i class="fas fa-user"></i> login</li></a>
				<?php  } ?>
				        
				        
				    </ul>
				    
				</div>
			
		</div>
        		
		<!-- Main Content Started -->
		
        <div class="main-content">
		
		<!-- Products Section Started -->
		
		<div class="container-fluid cart-page">
			
			<div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11 col-xs-12 mx-auto">
		
				<div class="row cart-row">
				
				<?php
					
				  if($ord){
					  
					$pr = $this->products_model->getProduct($ord->product_id);	
  
					if($ord->order_status != "Success"){  	
					?>
				
					<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 cart-about">
						<h3>My Cart</h3>
						
					 	
					<form method="post" action="<?php echo base_url("cart/insertSampleOrder") ?>">				
		
						
						<div class="row border-row">
					
        
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 cart-packet">
							
								<div class="cart-full-cream">
									<img src="<?php echo base_url("admin/").$pr->product_image ?>" alt="" style="width: 100%">
								</div>
								
								
							</div>
							<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
								<div class="cart-product-discription">
								<h5><?php echo $pr->product_name ?></h5>
								<p><?php echo $ord->qty ?></p>
								
								
							  
								</div>
							</div>
						</div>
						
                     
					 
						<div class="row button-row">
													
							<a href="<?php echo base_url("products/sampleOrder") ?>" class="btn btn-primary btn-rounded sample-btns">Back</a>
							
							
							<input type="submit" class="btn btn-primary btn-rounded sample-btns" value="Confirm">
						</div>
					 
					
					</div>
	<?php if($uid){ ?>
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 delivary-methods">
				
						<h5>Delivery Method</h5>
						<div class="container">
							
<!--		deliver once				-->
							<div class="row" id="updel">
							  <div class="col-md-6">
								<label>Delivery Date: </label> 
								&nbsp;
								<div class="form-group">

									<input type="text" name="delivery_date" id="delivery-date" autocomplete="off" class="form-control text-center" required>

								</div>
							  </div>
							  
							 <div class="col-md-6">	
								<label>Shift: </label> 

								<div class="form-group">
					
									<select name="delshift" class="form-control" id="delshift">
										
										<option value="">Select Shift</option>
										<option value="morning" id="delMor" <? echo (date("d-m-y") >= date("d-m-y")) ? 'disabled' : ''; ?>>Morning (5.30AM to 7.30AM)</option>
										<option value="evening" id="delEve" <? echo (date("d-m-H") >= date("d-m")."-12") ? 'disabled' : ''; ?>>Evening (6.00PM to 8.00PM)</option>
									</select>

								</div>
							  </div>
							  
							</div>
						</div>
						
						
						<div class="sampl-deliver-adress">
						<div class="deliver-head"><h5>Delivery Address</h5>
						
						<?php
				   		$ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
						$uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;
						
				   		$area = isset($uarea) ? $uarea : $udata->areanotlisted;

				   
				        ?>
						
							<div class="form-group sample-area-form">
								
								<textarea class="form-control" name="shipping_address" id="addr" cols="8" rows="5" style="white-space: pre-line" wrap="hard" readonly><?php echo $udata->house_no."\n".$area."\n".$udata->user_locality."\n".$udata->landmark."\n".$udata->user_current_address."\n".$ucity; ?></textarea>
							</div>
						
									
						</div>
<!--						<div class="change"><a href="#" style="color: #007bff" id="changeAddr">CHANGE</a></div>-->
						</div>
					</div>
	<?php }}else{ ?>				
				
				<div class="container more-orders" align="center">
					
					<?php echo $this->session->flashdata("cierr"); ?>
					<li>To view more products to order,Please <a href="<?php echo base_url("products") ?>" >Click Here</a></li>
					
				</div>
					
			<?php } ?>					
					
					<?php }else{ ?>
					  
					  <div class="container" align="center" style="margin-bottom: 10px">
					  	
					  	<img src="<?php echo base_url("assets/emptycart.png") ?>" style="width: 60%"><br>
					  	
					  	
					  	<a href="<?php echo base_url("products/sampleOrder") ?>" class="btn btn-primary btn-rounded">Continue Shopping</a>
					  	
					  </div>
					  
					  
					  
				    <?php } ?>
				    
				    
				    
					</div>
					
						
					
					</form>					
					
				</div>
			</div>
			
		</div>



    <!-- Footer Section Starts -->
    
    <div class="container-fluid footer-bottom">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 footer-logo">
						    <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/google-play.png" style="visibility:hidden;" href="" />
						<li>© 2018 Shreeja - Mahila Milk Producer Company Limited. All Rights Reserved.</li>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 footer-logo">
						    <a href="https://play.google.com/store"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/google-play.png" /></a>
						<li class="float-right"><a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/Privacy policy-SMMPCL.pdf" target="_blank">Privacy Policy</a>     |     <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/Refund policy-SMMPCL.pdf" target="_blank">Refund Policy</a>     |     <a href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/T&C-SMMPCL.pdf" target="_blank">Terms & Conditions</a></li>
						</div>
					</div>	
				</div>
			</div>

    <script src="<?php echo base_url("admin/assets/front/") ?>assets/bootstrap/js/bootstrap.js"></script>
	
	
	<script src="<?php echo base_url() ?>admin/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url("admin/assets/front/") ?>assets/plugins/jquery/tabs/js/jquery.tabs.js"></script>
    
<script type="text/javascript">
<?php
	
	$cdate = date("H");
	
		if($cdate >= 12){
			
	$date = 1;
}elseif($cdate >= 17){
			
	$date = 2;
}else{
	$date = 0;
}
?>	
	
$(document).ready(function(){
	
	
  $("#delivery-date").datepicker({
		minDate: <? echo $date ?>,
		dateFormat: "dd-mm-yy",
	    changeMonth: true,
	  });
	});
	
		$("#delivery-date").on("change",function(){
		
		$("#delshift").val("");
	
	
		var date = $("#delivery-date").val();
		var pdate = "<?php echo date("d-m-Y") ?>";
		var prdate = "<?php echo date("d-m-H") ?>";
		
	
		if(date == pdate){
			
			if(prdate < "<? echo date("d-m-")."12" ?>"){
				
				$("#delEve").removeAttr("disabled","disabled");
				
			}else{
				
				$("#delMor").attr("disabled","disabled");
				$("#delEve").attr("disabled","disabled");
				
			}
			
		}else{

			$("#delMor").removeAttr("disabled","disabled");
			$("#delEve").removeAttr("disabled","disabled");
			
			
		}	
		
		var fdate = "<? echo date('d-m-Y', strtotime('+1 day', strtotime(date("d-m-Y")))) ?>";
		
	    if(date ==  fdate){
		
			if(prdate >= "<? echo date("d-m-")."17" ?>"){

				$("#delMor").attr("disabled","disabled");

			}
	
		}

			
	})

	

	$("#changeAddr").click(function(){
		
		
		$("#addr").removeAttr("readonly");
		
	});
	

</script> 
  