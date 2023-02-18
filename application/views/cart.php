<?php 
	front_inner_header(); 

	date_default_timezone_set("Asia/Kolkata");

?>
<?php 

	 

	$uid = $this->session->userdata("user_id");

	$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid,"user_status"=>0))->row();

	$doCharges = $this->db->get_where("tbl_charges",array("city_id"=>$udata->user_location,"chargeType"=>"deliveryCharges","deliveryType"=>"deliveryonce","status"=>"Active"))->row();

	$subCharges = $this->db->get_where("tbl_charges",array("city_id"=>$udata->user_location,"chargeType"=>"deliveryCharges","deliveryType"=>"subscription","status"=>"Active"))->row();

    $cutOffcharges = $doCharges->cutoffCharges;
    $deliveryCharges = $doCharges->deliveryCharges;

    $scutOffcharges = $subCharges->cutoffCharges;
    $sdeliveryCharges = $subCharges->deliveryCharges;
	

?>

	
<style>	
    .blink_me {	
  animation: blinker 1s linear infinite;	
  color: red !important;	
}	
@keyframes blinker {  	
  50% { opacity: 0; }	
}	
</style>
		
		<!-- Header Section Ended -->
		
		<div class="banner-cart">
		</div>
        		
		<!-- Main Content Started -->
		
        <div class="main-content">
		
		<!-- Products Section Started -->
		
		<div class="container-fluid cart-page">
		
			
			
			<div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11 mx-auto">
				
				<?php echo $this->session->flashdata("payment_status"); ?>	
				<?php echo $this->session->flashdata("err"); ?>	
				
				<form method="post" action="<?php echo base_url("cart/insertOrder") ?>">				
		
				
				<div class="row cart-row">
				
				<?php
				$cart = $this->cart->contents();
					
				  if(count($cart) > 0){
				
					?>
				
					<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 cart-about" id="cartProducts">
						<h3>My Cart</h3>
					 	
		
				<?php
				     $id = 0;
			      	  
					 foreach($cart as $c){ 
						
						$pr = $this->db->get_where("tbl_products",array("id"=>$c["product_id"]))->row();
						
						$dis = json_decode($this->products_model->getCategoryprice($c["name"],$c["product_id"]));	
						 
						$distype = isset($dis->dis_type) ?$dis->dis_type : "";	 

						$extPrice = isset($dis->extprice) ? $dis->extprice	: "";

						$percentage = isset($dis->percentage) ? $dis->percentage : "";	 
						$disPrice = isset($dis->disPrice) ? $dis->disPrice : "";	 
					?>
						
						
						<div class="row border-row">
					
          				<a href="<?php echo base_url("cart/remove/").$c["rowid"] ?>" class="mt-2"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/cancel.png" /></a>
        
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 cart-packet">
								<div class="cart-full-cream">
									<img src="<?php echo base_url("admin/").$pr->product_image ?>" alt="" style="width: 100%">
								</div>
								
							</div>
							<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
								<div class="cart-product-discription">
								<h5><?php echo $pr->product_name ?></h5>
								<p><?php echo $c["name"] ?></p>
								
								<div class="cart-sale">
								<h4 class="upprice<?php echo $c["id"] ?>">&#8377; <?php echo $c["price"] * $c["qty"] ?>.00</h4>
								
								<input type="hidden" id="exprice<?php echo $c["id"] ?>" value="<?php echo $c["price"] ?>">
								<input type="hidden" id="upprice<?php echo $c["id"] ?>" value="<?php echo $c["price"] * $c["qty"] ?>">
								
								<?php 
									if($distype == "percent" || $distype == "rs"){
									?>
									<li class="cart-list exuprice<?php echo $c["id"] ?>">&#8377;<?php echo ($extPrice) * $c["qty"] ?></li>
									
					<input type="hidden" id="disTType<?php echo $c["id"] ?>" value="<?php echo $distype ?>">
							    
							    
								    <input type="hidden" id="exuprice<?php echo $c["id"] ?>" value="<?php echo $extPrice ?>">
									<input type="hidden" id="upexuprice<?php echo $c["id"] ?>" value="<?php echo $extPrice * $c["qty"] ?>">
									
								    <input type="hidden" id="disexprice<?php echo $c["id"] ?>" value="<?php echo $disPrice ?>">
									<input type="hidden" id="disupexprice<?php echo $c["id"] ?>" value="<?php echo intval($disPrice) * intval($c["qty"]) ?>">
									
									
								<?php if($distype == "percent"){ ?>	
									<li class="cart-flat"><?php echo isset($percentage) ? $percentage : "" ?>% off</li>
								<?php } ?>
								
								<?php if($distype == "rs"){ ?>	
									<li class="cart-flat disexprice<?php echo $c["id"] ?>">&#8377;<?php echo $disPrice * $c["qty"] ?> off</li>
								<?php }} ?>
								
								</div>
							  
								</div>
							</div>
							
							    <div class="cart-full-cream-info">
								
								<div class="numer">
								
									<input type='text' name='quantity[]' value='<?php echo $c["qty"] ?>' pr_id = "<?php echo $c["id"]; ?>" class="qty qty<?php echo $c["id"]; ?>" cart_id="<?php echo $c["rowid"] ?>" <? echo ($c["ref"] == "offer") ? "readonly" : "" ?>>
								
								</div>
								<div class="butns">
								<div class="plus"><input type='button' value='+' pr_id="<?php echo $c["id"] ?>" qty="qty<?php echo $c["id"] ?>" class='qtyplus' field='quantity' cart_id="<?php echo $c["rowid"] ?>" <? echo ($c["ref"] == "offer") ? "disabled" : "" ?>></div>
								<div class="minus"><input type='button' value='-' pr_id="<?php echo $c["id"] ?>" qty="qty<?php echo $c["id"] ?>" class='qtyminus' field='quantity' product_id="<?php echo $c["product_id"] ?>" cat_id="c" cart_id="<?php echo $c["rowid"] ?>" <? echo ($c["ref"] == "offer") ? "disabled" : "" ?>></div>
								</div>
								</div>
								<input type="hidden" name="cartid[]" value="<?php echo $c["rowid"] ?>">
							
						</div>
						
                     <?php 
					 $id++;
					 } ?>
					 
					 
					 
						<div class="row button-row">
													
							<a href="<?php echo base_url("products") ?>" class="btn btn-primary btn-rounded">Back</a>
							
						<?php if($uid){ ?>	
							
							<input type="submit" class="btn btn-primary btn-rounded" value="Confirm">
							
						<?php }else{ ?>
						 
						 	<a href="<?php echo base_url("login") ?>" class="btn btn-primary btn-rounded">Login To Continue</a>
							
						 
					 	<?php }	?>																										
						</div>
					
					</div>
					
					
	<?php if($uid){ ?>
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 delivary-methods">
						<h5>Delivery Methods</h5>
						
								<label class="radio-inline pl-2">
								  <input type="radio" name="order_type" id="subscritption" class="delType" value="subscribe" checked>&nbsp; SUBSCRIPTION
								</label>
						
						&nbsp;&nbsp;
						
								<label class="radio-inline">
								  <input type="radio" name="order_type" id="deliveryonce" class="delType" value="deliveryonce">&nbsp; DELIVER ONCE
								</label>
								
								
						
						<div class="container">
							
<!--		deliver once				-->
							<div class="row" id="updel" style="display: none">
							  <div class="col-md-6">
								<label>Delivery Date: </label> 

								<div class="form-group">

									<input type="text" name="delivery_date" id="delivery-date" autocomplete="off" class="form-control text-center">

								</div>

							  </div>
							  
							  <div class="col-md-6">	
								<label>Shift: </label> 

								<div class="form-group">
					
									<select name="delshift" class="form-control" id="delshift">
										
										<option value="">Select Shift</option>
										<option value="morning" id="delMor" <? echo (date("d-m-y") >= date("d-m-y")) ? 'disabled' : ''; ?>>Morning (5.30AM to 7.30AM)</option>
<!--										<option value="evening" id="delEve" <? //echo (date("d-m-H") >= date("d-m")."-12") ? 'disabled' : ''; ?>>Evening (6.00PM to 8.00PM)</option>-->
									</select>

								</div>
							  </div>							
							  																					
							</div>
<!--		Subscription				-->
							<div class="row" id="upsub">
							 <div class="col-md-6">	
								<label>Start Date: </label> 

								<div class="form-group">

									<input type="text" id="start-date" name="sub_start_date" autocomplete="off" class="form-control text-center" required>

								</div>
							 </div>
							 
							 <div class="col-md-6">	
								<label>End Date: </label> 

								<div class="form-group">

									<input type="text" id="end-date" name="sub_end_date" autocomplete="off" class="form-control text-center" readonly>

								</div>
							 </div>
							 
							 <div class="col-md-6">	
								<label>Shift: </label> 

								<div class="form-group">

									<select name="subshift" class="form-control" id="subshift" required>
										
										<option value="">Select Shift</option>
										<option value="morning" id="subMor" <? echo (date("d-m-y") >= date("d-m-y")) ? 'disabled' : ''; ?>>Morning (5.30AM to 7.30AM)</option>
<!--										<option value="evening" id="subEve" <? //echo (date("d-H") >= date("d")."-12") ? 'disabled' : ''; ?>>Evening (6.00PM to 8.00PM)</option>-->
										
									</select>

								</div>
							 </div>		
							 						
							</div>
							
							<div class="row">
							    <div class="col-md-6">
							        <div class="form-group">
    							        <input type="radio" name="payment_type" id="mobi" value="mobikwik" required>
    							        <label for="mobi"><img src="<? echo base_url('assets/mobikwik.png') ?>" width="100%"></label>
    							     </div>   
							    </div>
							    <div class="col-md-6">
							        <div class="form-group">
    							        <input type="radio" name="payment_type" id="ccav" value="ccavenue">
    							        <label for="ccav"><img src="<? echo base_url('assets/ccavenue.png') ?>" width="100%"></label>
    							     </div>   
							    </div>
							</div>
							
						
							
									
						</div>
						
						<h5>Quantity</h5>
						
						<div class="row">
						    <div class="col-xl-6 col-lg-6 col-md-6 col-6">
								<p class="prodct-shade">Product Name</p>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-6">
								<p class="prodct-shade float-right pr-3">Quantity</p>
							</div>
						</div>
						
						<div class="row">
						
						<?php
				   		$iid = 0;	
						 
				   		foreach($cart as $ca){
							
							if($ca["ref"] != "offer"){
				   		?>
							<div class="col-md-6">
								
								<?php echo $this->db->get_where("tbl_products",array("id"=>$ca["product_id"]))->row()->product_name; ?>
								
							</div>

							<div class="col-md-6" align="right">
								<?php 
								
							
								$str = $ca["name"];
							
								$qtyMea = preg_replace('!\d+!', '', $str);
							
								$qM = str_replace(" ","",$qtyMea);
							
							
								$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);
								
							
								$lMint = $int * $ca["qty"];
							
								$fqty = number_format($int * $ca["qty"]);
								
								$tQty = round(str_replace(",",".",$fqty),2);
								
							?>
							
							
							<input type="hidden" name="upQtyy[]" value="<?php echo $lMint ?>"> 
							<input type="hidden" name="mea[]" value="<?php echo $qM ?>"> 
							
								<?php	
								if($qM == "ML" || $qM == "ml"){
								
								?>
								
     								<p class="tQty" id="tQQty<?php echo $iid ?>" style="display: none"><?php echo $tQty ?> <span><?php echo ($lMint >= 1000) ? "L" : "ML" ?></span></p>
     								<p class="dotQty"><?php echo $tQty ?> <span><?php echo ($lMint >= 1000) ? "L" : "ML" ?></span></p>
								
								<?php }else{ 
									
								?>
								
									<p class="tQty" id="tQQty<?php echo $iid ?>" style="display: none"><?php echo $tQty ?> <span><?php echo ($lMint >= 1000) ? "KG" : "gm" ?></span></p> 
									<p class="dotQty"><?php echo $tQty ?> <span><?php echo ($lMint >= 1000) ? "KG" : "gm" ?></span></p> 

								<?php } ?>
							</div>
							
						<?php 
						$iid++;
						}} ?>	
						</div>
						<h5 class="blink_me">Offer Code</h5>
						<div class="row">
							
							<div class="form-group">
								
								<input type="text" name="promo" id="promo" class="form-control promocode" placeholder="Promo Code">
								
							</div>
							
							<div class="form-group">
								
								<button type="button" class="btn btn-success promocode-button" id="promoCode">Apply</button>
								
							</div>
							
							
<!--			Promocode status				-->
							
						<input type="hidden" name="promoStatus" id="promoStatus" value="">	
						<input type="hidden" name="promoDisamount" id="promoDisamount" value="">	
						</div>
						
						
						<?php 
						 
						 	$ci = $this->cart->contents(); 
							
						 	$gstPrice = array();
							$nGst = array();	
						 
							foreach($ci as $ccc){
								
								$pinfo = $this->db->get_where("tbl_products",array("id"=>$ccc["product_id"],"assigned_to"=>'consumers'))->row();
								
								if($pinfo->gst_charges_status == "Active"){
								
									$gstPrice = $ccc["price"] * $ccc["qty"];
									$gstCharge = $pinfo->gst_charges;
									
									$nGst[] = $this->admin->gst_total($gstPrice,$gstCharge);
									
								}
								
							}
						 
						 	
							?>
						
						
						
						<h5>Price Details</h5>
						<div class="deliver-date">
						<div class="date"><li>Price (<?php echo(count($this->cart->contents())) ?> Items)</li></div>
						<div class="deliver-rate totalPrice totalPrice2 disTotal">&#8377;<?php echo ($this->cart->total()) - (array_sum($nGst)); ?></div>
						
						<div id="discount" style="display: none">
							<div class="date"><li>Discount</li></div>
							<div class="deliver-rate disAmount">&#8377;0</div>
						</div>
						
						
						
						<div id="discount">
							<div class="date"><li>GST Charges</li></div>
							<div class="deliver-rate gstAmount">&#8377;<?php echo (array_sum($nGst)) ?></div>
						</div>
						
						
						<?php
						
							$tCharges = $this->cart->total();
								
						 	if($tCharges < $cutOffcharges){
								
								$delCharges = $deliveryCharges;
								$totCharges = $this->cart->total() + $delCharges;
							}else{
								$delCharges = 0;
								$totCharges = $tCharges;
							}
						?>
						
						
						<div class="date"><li>Delivery Charges</li></div>
						<div class="deliver-rate"><li class="delCharges">&#8377; <?php echo ($delCharges != "") ? $delCharges : "Free" ?></li></div>
						</div>
						
						<div class="amount">
						<div class="date">Total Amount Payable</div>
						<div class="delivery-rate totalPrice totalPrice1">&#8377; <?php echo $totCharges ?></div>
						</div>
						
						<div class="deliver-adress">
						<div class="deliver-head"><h5>Delivery Address</h5>
						
							<div class="form-group" style="width: 143%">
								
						<?php 
				   		$ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
						$uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;
				   
				   		$area = isset($uarea) ? $uarea : $udata->areanotlisted;
				   		
				   		?>
								
								
								<textarea class="form-control mt-3" name="shipping_address" id="addr" cols="8" rows="5" style="white-space: pre-line" wrap="hard" readonly><?php echo $udata->house_no."\n".$udata->landmark."\n".$udata->user_current_address."\n".$area."\n".$ucity; ?>
								</textarea>
							</div>
						
						<input type="hidden" name="location" value="<?php echo($udata->user_location) ?>">	
									
						</div>
<!--						<div class="change"><a href="#" style="color: #007bff" id="changeAddr">Change</a></div>-->
						</div>
					</div>
	<?php } ?>				
					
					
					<?php }else{ ?>
					  
					  <div class="container" align="center" style="margin-bottom: 10px">
					  	
					  	<? 
							$oid = $this->session->userdata("order_id");	
							if($oid){ 
						  
						  	$odata = $this->db->get_where("order_products",array("order_id"=>$oid,"orderRef"=>"offer"))->row();
								
							if($odata){	
						  
							$pd = $this->db->get_where("tbl_products",array("id"=>$odata->product_id))->row();	
								
						  ?>
					  
					  		<img src="<?php echo base_url('admin/').$pd->product_image ?>" style="width: 50%"><br>
					  		
					  		<p><strong style="font-size: 18px">You have received a free product <? echo $pd->product_name." ".$odata->category ?></strong></p>
					  		
					  	<? }else{ ?>	
					  
					  		<img src="<?php echo base_url("assets/emptycart.png") ?>" style="width: 60%"><br>
					  
				  		<?	}}else{ ?>
					  	
					  		<img src="<?php echo base_url("assets/emptycart.png") ?>" style="width: 60%"><br>
					  	<? } ?>
					  	
					  	<a href="<?php echo base_url("products") ?>" class="btn btn-primary btn-rounded">Continue Shopping</a>
					  	
					  </div>
					  
					  
					  
				    <?php } ?>
					</div>
					<input type="hidden" id="totalCount" value="<?php echo ($this->cart->total()) - (array_sum($nGst)); ?>">
					<input type="hidden" id="gstCharges" value="<?php echo (array_sum($nGst)) ?>">
<!--					<input type="text" id="deliveryTotal" value="<?php //echo $this->cart->total(); ?>">-->
<!--		Total Amount					-->
							
							
					<input type="hidden" name="total_amount" id="totalAmount" value="<?php echo $totCharges; ?>">
					<input type="hidden" name="gstCharges" id="gstAmt" value="<?php echo (array_sum($nGst)); ?>">
					<input type="hidden" name="deliveryCharges" id="deliveryAmt" value="<?php echo $delCharges; ?>">
					<input type="hidden" name="deliveryCutoff" id="deliveryCutoff" value="<?php echo $cutOffcharges; ?>">
					<input type="hidden" name="deliveryCoff" id="deAmt" value="<?php echo $delCharges; ?>">
					
					</form>	
					
													
					
				</div>
			</div>
			
		</div>


    <!-- Footer Section Starts -->

    <?php front_inner_footer() ?>
    



<script type="text/javascript">
	
$(document).ready(function(){
    
  $(".more-info").hide();
  $(document).on("click",".view",function(){
	
	var view = $(this).attr("view");  
	  
    $("#"+view).toggle();
  });
});
	
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});	
function copyText(str) {
  function listener(e) {
    e.clipboardData.setData("text/html", str);
    e.clipboardData.setData("text/plain", str);
    e.preventDefault();
  }
  document.addEventListener("copy", listener);
  document.execCommand("copy");
  document.removeEventListener("copy", listener);
	
  Swal(
      'Success',
      'Coupon Code copied to clipboard',
      'success',
    )	
	
};	
	
//cross product offer	
	
$(document).ready(function(){

	var totalAmount = $("#totalAmount").val();
	var delType = $("input[name='order_type']:checked").val();
	
	$.ajax({
		
		type : "post",
		data : {total : totalAmount,orderType : delType},
		url : "<? echo base_url('cart/check_value_offer_on_this_day') ?>",
		success : function(data){
			console.log(data);

//			if(data == "success"){
//				
//				
//			}else{
//				
//				return false;
//			}
			
			$("#cartProducts").load("<? echo base_url('cart/cartProducts') ?>");

			
			
		},
		error : function(data){
			
			console.log(data);
		}
		
	});
	
});	
	
	
//cross product offer end	
	

	
	
	
$("#promoCode").click(function(){

	var oType = $("input[name='order_type']:checked").val();
	
	var promo = $("#promo").val();
	var exAmt = $("#totalAmount").val();
	
	if(promo == ""){
		
		Swal(
		  'Error!',
		  'Enter Promocode',
		  'error'
		);

		return false;
		
	}
	
	if(oType == "subscribe"){
		
		if($("#start-date").val() == ""){
			
			Swal(
			  'Error!',
			  'Select Start Date',
			  'error'
			);

			return false;
		}
		
	}
	
	
	$.ajax({
		
		type : "post",
		data : {oType : oType, promocode : promo, exsAmount : exAmt},
		dataType : "json",
		url : "<?php echo base_url('cart/checkPromo') ?>",
		success : function(data){
			
			console.log(data);
			
			if(data.status == "error"){
				
				Swal(
				  'Error!',
				  data.msg,
				  'error'
				);
				
			}
			
			if(data.status == "success"){
				
				Swal(
				  'Success!',
				  data.msg,
				  'success'
				);
				
				$("#promoStatus").val("Active");
				$("#promoDisamount").val(data.disPrice);
				
				var gst = $("#gstAmt").val();
				
				var total = parseFloat(data.totalAmount);
				
	  			$(".totalPrice1").html('&#8377;'+total);
	  			$("#totalAmount").val(total);
				
// Amount Updating
					

				
				
				var gtotal = $("#totalAmount").val();
				
				var disTTotal = parseFloat(data.disPrice);
				
				$("#discount").show();
//	  			$(".disTotal").html('&#8377;'+disTTotal);
				$(".disAmount").html('&#8377;'+data.disPrice);
				
				$("#promoCode").attr("disabled","disabled")
				$("#promoCode").html("Applied")
				
				
				
				
				$.ajax({
					
					url : "<?php echo base_url("cart/getDeliverycharges") ?>",
					data : {total : total},
					type : "post",  
					dataType : "json",
					success:function(data){
						
						console.log(data);
						$("#deliveryAmt").val(data.delCharges);
			  			$(".delCharges").html('&#8377;'+data.delCharges+'');
						
						$(".totalPrice1").html('&#8377;'+total);
	  					$("#totalAmount").val(total);
						
						checkOffer();	


					},
					error:function(data){
						
						console.log(data);
						
					}
				})
				
			}else{
				
				$("#discount").hide();
				
				
			}
			
			console.log(data);
			
		},
		error : function(data){
			
			console.log(data);	
		}
		
	});
	
});	

	
$(document).on("change",".qty",function(){
	
	var qty = $(this).val();
	var cart_id = $(this).attr("cart_id");
	
	
	if(qty < 1){
				
		Swal(
		  'Error!',
		  'Quantity Should Be Atleast 1.',
		  'error'
		);

		return false;
	}
	
	
	var pr_id = $(this).attr("pr_id");
	var disType = $("#disTType"+pr_id).val();

	var exiPrice = $("#exprice"+pr_id).val();
    var updatePrice = exiPrice*qty;
	
    var actexPrice = $("#exuprice"+pr_id).val();	
    var updateactPrice = actexPrice*qty;
	
	$(".upprice"+pr_id).html('&#8377; '+updatePrice+'.00');
    $(".exuprice"+pr_id).html('&#8377; '+updateactPrice+'.00');
	$("#upprice"+pr_id).val(updatePrice);	
    $("#upexuprice"+pr_id).val(updateactPrice);
	
if(disType == "rs"){	
  var disexprice = $("#disexprice"+pr_id).val();
  var disupdatePrice = parseFloat(disexprice)*qty;
	
  $(".disexprice"+pr_id).html('&#8377; '+disupdatePrice+' off');
  $("#disupexprice"+pr_id).val(disupdatePrice);
}	
	
	
	$.ajax({
		type : "post",
		data : {qty : qty, cart_id : cart_id},
		url : "<?php echo base_url("ajax/cartUpdate") ?>",
		success : function(data){
			
			$(".totalPrice").html('&#8377;'+data+'.00');
			$("#totalCount").val(data);
			$("#deliveryTotal").val(data);
			
			location.reload();
			
		},
		error : function(data){
			
			console.log(data);
		}
		
		
	});
	
	
});	
	

$(document).on("click",".qtyplus",function(){

  var iv = $(this).attr("qty");	
  var pr_id = $(this).attr("pr_id");
  var disType = $("#disTType"+pr_id).val();

	
  var cart_id = $(this).attr("cart_id");
  	
	
  var value = parseFloat($("."+iv).val(), 10);
  value = isNaN(value) ? 0 : value;
  value++;
  $("."+iv).val(value);
  
  var exprice = $("#exprice"+pr_id).val();
  var upprice = $("#upprice"+pr_id).val();
  var updatePrice = parseFloat(upprice)+parseFloat(exprice);	
	
	
  var actexPrice = $("#exuprice"+pr_id).val();	
  var actupPrice = $("#upexuprice"+pr_id).val();
  var updateactPrice = parseFloat(actupPrice)+parseFloat(actexPrice);	
		
  $(".upprice"+pr_id).html('&#8377; '+updatePrice+'.00');
  $(".exuprice"+pr_id).html('&#8377; '+updateactPrice+'.00');
  $("#upprice"+pr_id).val(updatePrice);
  $("#upexuprice"+pr_id).val(updateactPrice);
	
if(disType == "rs"){	
  var disexprice = $("#disexprice"+pr_id).val();
  var disupprice = $("#disupexprice"+pr_id).val();
  var disupdatePrice = parseFloat(disupprice)+parseFloat(disexprice);
	
  $(".disexprice"+pr_id).html('&#8377; '+disupdatePrice+' off');
  $("#disupexprice"+pr_id).val(disupdatePrice);
}
  $.ajax({
		type : "post",
		data : {qty : value, cart_id : cart_id},
		url : "<?php echo base_url("ajax/cartUpdate") ?>",
		success : function(data){
			
			$(".totalPrice").html('&#8377;'+data+'.00');
			$("#totalCount").val(data);
			$("#deliveryTotal").val(data);
			location.reload();
		},
		error : function(data){
			
			console.log(data);
		}
		
		
	});	
	
	
});
	
	
$(document).on("click",".qtyminus",function(){

	
  var iv = $(this).attr("qty");	
  var pr_id = $(this).attr("pr_id");
  var disType = $("#disTType"+pr_id).val();

	
  var cart_id = $(this).attr("cart_id");

  if($("."+iv).val() <= 1){
	  
	  return false;
  }
	
  
	  var value = parseFloat($("."+iv).val(), 10);
	  value = isNaN(value) ? 0 : value;
	  value--;
	  $("."+iv).val(value);

	  
  var exprice = $("#exprice"+pr_id).val();
  var upprice = $("#upprice"+pr_id).val();
		
  var updatePrice = parseFloat(upprice)-parseFloat(exprice);
	
	
  var actexPrice = $("#exuprice"+pr_id).val();	
  var actupPrice = $("#upexuprice"+pr_id).val();
  var updateactPrice = parseFloat(actupPrice)-parseFloat(actexPrice);	
	
  $(".upprice"+pr_id).html('&#8377; '+updatePrice+'.00');
  $(".exuprice"+pr_id).html('&#8377; '+updateactPrice+'.00');
  $("#upprice"+pr_id).val(updatePrice);	
  $("#upexuprice"+pr_id).val(updateactPrice);
	
	
if(disType == "rs"){	
  var disexprice = $("#disexprice"+pr_id).val();
  var disupprice = $("#disupexprice"+pr_id).val();
  var disupdatePrice = parseFloat(disupprice)-parseFloat(disexprice);
	
  $(".disexprice"+pr_id).html('&#8377; '+disupdatePrice+' off');
  $("#disupexprice"+pr_id).val(disupdatePrice);
}	
	
	
	
    $.ajax({
		type : "post",
		data : {qty : value, cart_id : cart_id},
		url : "<?php echo base_url("ajax/cartUpdate") ?>",
		success : function(data){
			
			$(".totalPrice").html('&#8377;'+data+'.00');
			$("#totalCount").val(data);
			$("#deliveryTotal").val(data);
			location.reload();
		},
		error : function(data){
			
			console.log(data);
		}
		
		
	});	

});		
	
	
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
	
$( function() {
  var dateToday = new Date();
		
  var dates = $("#start-date").datepicker({
//    defaultDate: "+2d",
    changeMonth: true,
//    numberOfMonths: 1,
    minDate: <?php echo $date ?>,
    dateFormat: "dd-mm-yy",
    onSelect: function(selectedDate) {
	  
		$("#delshift").val("");
		$("#subshift").val("");
	  	  
        var option = this.id == "start-date" ? "minDate" : "maxDate",
        instance = $(this).data("datepicker"),
        date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);

            var date2 = $('#start-date').datepicker('getDate');
            date2.setDate(date2.getDate()+29);
	  
	  		var endDate = formatDate(date2);	
	  	
         	$('#end-date').val(endDate);
	  
	  		var totalPrice = Math.round(parseFloat($("#totalCount").val()) * 30);
	  
	  		var totalGST = Math.round(parseFloat($("#gstCharges").val()) * 30);
	  
	  
	  		var totalDelivery = <? echo isset($sdeliveryCharges) ? $sdeliveryCharges : 0 ?>;
	  		var deliveryCutoff = <? echo isset($scutOffcharges) ? $scutOffcharges : 0 ?>;
	  
	  		var total = parseFloat(totalPrice) + parseFloat(totalGST);
	  		var stotal = parseFloat(totalPrice);
	  
	  
	  		if(total < deliveryCutoff){
	  
	  			var delCharges = totalDelivery;
				var udelCharges = totalDelivery;	
				var gTotal = total + parseFloat(totalDelivery);
	  
  			}else{
										  
				var delCharges = "Free";
				var udelCharges = 0;
				var gTotal = total;						  
										  
			}
	  
	  		$(".totalPrice1").html('&#8377;'+gTotal+'');
	  		$(".totalPrice2").html('&#8377;'+stotal+'');
	  		$(".gstAmount").html('&#8377;'+totalGST+'');
	  		$(".delCharges").html('&#8377;'+delCharges+'');
	  
	  
	  		$("#totalAmount").val(gTotal);
	  		$("#gstAmt").val(totalGST);
	  		$("#deliveryAmt").val(udelCharges);

	  
// Quantity calculations
	  
	  $(".tQty").show();
	  $(".dotQty").hide();
	  
	  
	  		var qtys = document.getElementsByName('upQtyy[]');
			var mea = document.getElementsByName('mea[]');


			var qty = [];
			var meas = [];

	  
			for (var i = 0; i < qtys.length; i++) {

				meas[i] = mea[i].value;

				qty[i] =qtys[i].value;


			}
	  
	  
	  
	  $.ajax({
	  
	  	type : "post",
	  	data : {qty : qty, measurement : meas},
	  	url : "<?php echo base_url("ajax/getsubQuantity") ?>",
		dataType : "json",								  
	  	success : function(data){
	  
	  
	  $.each(data.qty, function(i, obj) {
		  $("#tQQty"+i).html(obj);
		  
		});
	  
	  
  		},
		error : function(data){
			
			console.log(data);
		}	
	  
  		});
	  
	
		var date = $("#start-date").val();
		var pdate = "<?php echo date("d-m-Y") ?>";
		var prdate = "<?php echo date("d-m-H") ?>";
		
	
		if(date == pdate){
			
			if(prdate < "<? echo date("d-m-")."12" ?>"){
				
				$("#subEve").removeAttr("disabled","disabled");
				
			}else{
				
				$("#subMor").attr("disabled","disabled");
				$("#subEve").attr("disabled","disabled");
				
			}
			
		}else{

			$("#subMor").removeAttr("disabled","disabled");
			$("#subEve").removeAttr("disabled","disabled");
			
			
		}	
	
		var fdate = "<? echo date('d-m-Y', strtotime('+1 day', strtotime(date("d-m-Y")))) ?>";
		
		
	    if(date ===  fdate){
		   
			if(prdate >= "<? echo date("d-m-")."17" ?>"){

				$("#subMor").attr("disabled","disabled");

			}
	
		}
	
	  	checkOffer();	
	
        return false;
    }
  });
});	

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day, month, year].join('-');
}	
	

	
$(document).ready(function(){
	
$("#deliveryonce").click(function(){
        
		$("#delshift").val("");
		$("#subshift").val("");
		
        $("#updel").toggle();
        $("#upsub").hide();
		
		$("#delivery-date").attr('required', 'required');
		$("#delshift").attr('required', 'required');
		$("#start-date").removeAttr('required', 'required');
		$("#end-date").removeAttr('required', 'required');
		$("#subshift").removeAttr('required', 'required');
		
		
		$("#start-date").val("");
		$("#end-date").val("");
		
		var updelcharges = $("#deliveryAmt").val($("#deAmt").val());
		
		
		var dTotal = $("#totalCount").val();
		var dGst = $("#gstCharges").val();
		
		
		var totalDelivery = parseFloat($("#deliveryAmt").val());
		var deliveryCutoff = parseFloat($("#deliveryCutoff").val());
		
		var total = parseFloat(dTotal)+parseFloat(dGst);
		
//		alert(total+" "+deliveryCutoff);
		
		if(total < deliveryCutoff){

			var delCharges = totalDelivery;
			var udelCharges = totalDelivery;
			var gTotal = total + parseFloat(totalDelivery);

		}else{

			var delCharges = "Free";
			var udelCharges = 0;
			var gTotal = total;
		}
		
		if($("#start-date").val() == ""){
			
	  		$(".totalPrice2").html('&#8377;'+dTotal+'');
	  		$(".totalPrice1").html('&#8377;'+gTotal+'');
	  		$(".gstAmount").html('&#8377;'+dGst+'');
			$(".delCharges").html('&#8377;'+delCharges+'');
	  
	  
	  		$("#deliveryAmt").val(udelCharges);
	  		$("#totalAmount").val(gTotal);
	  		$("#gstAmt").val(dGst);
		}
		
	  $(".tQty").hide();
	  $(".dotQty").show();
		
	  checkOffer();		
		
        
    });
	
$("#subscritption").click(function(){
  		$("#delshift").val("");
		$("#subshift").val("");

		 
        $("#upsub").toggle();
        $("#updel").hide();
		 
		var updelcharges = $("#deliveryAmt").val($("#deAmt").val());
 
		 
		$("#delivery-date").removeAttr('required', 'required');
		$("#delshift").removeAttr('required', 'required');
		$("#start-date").attr('required', 'required');
		$("#end-date").attr('required', 'required');
		$("#subshift").attr('required', 'required');
 		$("#delivery-date").val("");
	
	    checkOffer();	
        
    });
			
$("#delivery-date").datepicker({
    minDate: <?php echo $date ?>,
    dateFormat: "dd-mm-yy",
    changeMonth: true,
	onSelect : function(){
	
		$("#delshift").val("");
		$("#subshift").val("");
	
		checkOffer();
	
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
	}

  });
	
});
	
function checkOffer(){
	
	
	var delType = $("input[name='order_type']:checked").val();
	var totalAmount = $("#totalAmount").val();
		
	$.ajax({
		
		type : "post",
		data : {total : totalAmount,orderType : delType},
		url : "<? echo base_url('cart/check_value_offer_on_this_day') ?>",
		success : function(data){
			console.log(data);

//			if(data == "success"){
//				alert();
//				$("#cartProducts").load("<? echo base_url('cart/cartProducts') ?>");
//				
//			}else{
//				
//				return false;
//			}
			
			$("#cartProducts").load("<? echo base_url('cart/cartProducts') ?>");

			
		},
		error : function(data){
			
			console.log(data);
		}
		
	});
	
	
}	

	
	
	

</script> 
  