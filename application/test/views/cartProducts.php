					<h3>My Cart</h3>
						
					<?php 

					$uid = $this->session->userdata("user_id");

					echo $this->session->flashdata("err"); 
	
					$cart = $this->cart->contents();
	
					?>	
					 	
		
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
					
         			<? if($c["ref"] != "offer"){ ?>	
          				<a href="<?php echo base_url("cart/remove/").$c["rowid"] ?>" class="mt-2"><img src="<?php echo base_url("admin/assets/front/") ?>assets/images/cancel.png" /></a>
          				
          			<? } ?>	
        
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
