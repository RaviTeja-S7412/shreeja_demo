<?php $d = &get_instance(); ?>

<?php front_inner_header() ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script>
           $(document).ready(function(){
              $("#hide,body").click(function(){
                $(".modal").hide();
              });
            });
        </script>

		<!-- Main Content Started -->
	   
<? 
	
	$offers = $this->db->get_where("tbl_product_offers",array("status"=>"Active","banner !="=>""))->result(); 

	if(count($offers) > 0){
?>	   

	   	   
 <div class="modal" tabindex="-1" role="dialog" style="display:inherit;" >
  <div class="modal-dialog ofr_dialog" role="document">
    <div class="modal-content ofr_content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="hide" aria-controls="pause" >
          <span aria-hidden="true" class="offer_close_mark">&times;</span>
        </button>
        
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" pause="false">
             
             
              <div class="carousel-inner model_carousel_image">
               
               <? 
					$i = 0;	   
					foreach($offers as $o){ ?>
               
                <div class="carousel-item <? echo ($i==0) ? "active" : "" ?>">
                    <img src="<?php echo base_url("admin/").$o->banner ?>" alt="Offer1">
                </div>
                
               <? 
					$i++;	
					} ?>
              </div>
            </div>
        
      </div>
    </div>
  </div>
</div>
       
<? } ?>       
        <div class="main-content">
		
		<!-- Products Section Started -->
<div class="product-page" id="prdct_ofr">
		<div class="prodct-heading">
			<h3 class="prdct-page-head">Shreeja Products</h3>
			
			<div id="error"></div>
			
			 <span style="visibility:hidden;"><a href="<?php echo base_url("cart") ?>" style="color: black"><i class="fas fa-shopping-cart"></i> Cart</a><span class="badge badge-success cartCount"><?php echo (count($this->cart->contents())) ? count($this->cart->contents()) : "" ?></span></span>
		</div>
		<div class="prdcts">
			
	<div class="row">
		<div class="col-md-4"></div>
		
		<div id="smsg"></div>
		
		<div class="col-md-4"></div>
	</div>		
			
<div class="accordion" id="accordionExample">


  <?php
	
	$cid = 0;
	
	$categories = $this->db->get_where("tbl_categories",array("status"=>"Active","deleted"=>0))->result();

	if(count($categories) > 0){
		
	$uid = $this->session->userdata("user_id");
		
	$udata = $this->db->get_where("shreeja_users",array("userid"=>$uid))->row();	
		
	foreach($categories as $cat){

	$products = $this->db->query("select * from tbl_products where status='Active' and assigned_to='consumers' and deleted=0 and product_category='$cat->id' order by id asc")->result();
			
			
  ?>			
						
												
  <div class="card">
   
   
    <div class="card-header" id="heading<?php echo $cid ?>">
		<div class="row" data-toggle="collapse" data-target="#collapse<?php echo $cid ?>" aria-expanded="true" aria-controls="collapse<?php echo $cid ?>">
			<div class="col-xl-12 col-lg-12 col-md-12">
				<i class="fas fa-chevron-down ml-3"></i>
				<span class="h4 ml-2"><?php echo $cat->category_name ?></span>
			</div>
		</div>
    </div>
    
    <div id="collapse<?php echo $cid ?>" class="collapse show" aria-labelledby="heading<?php echo $cid ?>" data-parent="#accordionExample">
     
    
 <?php
	
	$pkey = 0;	


	if(count($products) > 0){	

		foreach($products as $pr){
			
		$plocation = json_decode($pr->location);
		
		$uloc = isset($udata->user_location) ? $udata->user_location : "";	
			
		if(in_array($uloc,$plocation) || $uloc == ""){
			

		$cat = json_decode($pr->product_quantity);	  
	  	
  ?>   
      <div class="card-body">
      
      
		<div class="row">
			<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
			<div class="row">
				<figure class="figure">
				  <img src="<?php echo base_url("admin/").$pr->product_image ?>" class="figure-img img-fluid" />
				  <figcaption class="figure-caption"><?php echo $pr->product_name ?></figcaption>
				</figure>
				
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
						<form action="#" class="float-left label-form">
						
						<?php 
							if(count($cat->quantity) > 0){	
							$i = 0;
								foreach($cat->quantity as $qty){
						?>
							<label class="radio-inline">
 								<input type="radio" name="optradio" class="catQty" product_id="<?php echo $pr->id ?>" cat_id="<?php echo $qty ?>" <?php echo ($i==0) ? "checked" : "" ?>> <?php echo $qty ?>
							</label>
							
							
						<?php 
						$i++;
						
						}} ?>	
					
						<label class="radio-inline" style="visibility: <?php echo $i!=0?'hidden':""  ?>;display:<?php echo $i==0?'none':""?>;">
 								<input type="radio" > <?php echo $qty ?>
							</label>
							
						
							<div class="counter">
							<div class="numer">
								<input type='text' name='quantity' min="1" value='1' pr_id="<?php echo $pr->id ?>" class="qty qty<?php echo $pr->id ?>" />
							</div>
							<div class="butns">
							<div class="plus">
								<input type='button' value='+' pr_id="<?php echo $pr->id ?>" qty="qty<?php echo $pr->id ?>" class='qtyplus' field='quantity' />
							</div>
							<div class="minus">
								<input type='button' value='-' pr_id="<?php echo $pr->id ?>" qty="qty<?php echo $pr->id ?>" class='qtyminus' field='quantity' />
							</div>
							</div>
							</div>
						</form>
					</div>
			
			<?php  
				$pdate = date("m/d/Y");		
				$pm = $this->db->query("select * from tbl_price_management where product_id = '$pr->id' AND  '$pdate' BETWEEN  startdate AND enddate and deleted=0 and status='Active'")->row();

				$discPm = json_decode(isset($pm->price_management) ? $pm->price_management : "");

				$disType = isset($discPm->discount_type) ? $discPm->discount_type : "";

				$disPrice = isset($discPm->price) ? $discPm->price : "";

			?>	
				
					<input type="hidden" id="disTType<?php echo $pr->id ?>" value="<?php echo $disType ?>">
					
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 price pl-0">
					
				  <?php 
					
					
						if($disType == "Rs" || $disType == "percent"){

					?>
					
					<input type="hidden" id="actprice<?php echo $pr->id ?>" value="<?php echo $cat->price[0] ?>">
					<input type="hidden" id="dPPrice<?php echo $pr->id ?>" value="<?php echo $cat->price[0] - $disPrice[0] ?>">
							      
						<div class="extprice<?php echo $pr->id ?>">		  
						
							<span class="label-form actual"><?php echo ($disPrice[0] != "") ? "&#8377;".$cat->price[0].".00" : "" ?></span>
							
						</div>	
						
					<?php  } ?>	
					
					
					<div class="percent<?php echo $pr->id ?>"> 	  	  

					<?php if($disType=="percent" && $disPrice[0] != ""){ ?>
					
							<span class="label-form off"><?php echo $disPrice[0] ?>% Off</span>
					<?php } ?>
					
					</div>
					
					<div class="rupees<?php echo $pr->id ?>"> 	  	  

					<?php if($disType=="Rs" && $disPrice[0] != ""){ ?>
					
							<span class="label-form off">&#8377; <?php echo $cat->price[0] - $disPrice[0] ?> Off</span>
					<?php } ?>
					
					</div>
	
						<span class="label-form h4 upprice<?php echo $pr->id ?>">&#8377; <?php echo $this->products_model->productDiscountprice($pr->id); ?>.00</span>
						
						
					</div>
					
					<?php 
						
						$dprice = $this->products_model->productDiscountprice($pr->id);
						
						?>
					
					<input type="hidden" id="upprice<?php echo $pr->id ?>"  value="<?php echo $dprice ?>">
					<input type="hidden" id="upQty<?php echo $pr->id ?>"  value="<?php echo $cat->quantity[0] ?>">
					
					
					
				</div>
			</div>
			<div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 col-4">
				<button type="button" class="btn mt-3 cart" addPid="<?php echo $pr->id ?>"><i class="fas fa-shopping-cart"></i> ADD TO CART</button>
			</div>
		</div>
		
      </div>
      
 <?php 
						
  $pkey++;
  }}} 
?>    
	  
	</div>
	
	
	
	
  </div>
  

<?php  
	$cid++;
	}}  ?>			
									
		</div>
		
	</div>

    <!-- Footer Section Starts -->

	<?php front_inner_footer() ?>
	
	
<script type="text/javascript">
	
$(".qty").on("change",function(){
	
	var qty = $(this).val();
	
	if(qty < 1){
				
		Swal(
		  'Error!',
		  'Quantity Should Be Atleast 1.',
		  'error'
		);

		return false;
	}
	
	
	var pr_id = $(this).attr("pr_id");
	
	var exiPrice = $("#upprice"+pr_id).val();
    var updatePrice = exiPrice*qty;
	
    var actexPrice = $("#actprice"+pr_id).val();	
    var updateactPrice = actexPrice*qty;
	
    var dPPrice = $("#dPPrice"+pr_id).val();	
    var disPrice = dPPrice*qty;	
	
    var disType = $("#disTType"+pr_id).val();

	 
	
	$(".upprice"+pr_id).html('<h5>&#8377; '+updatePrice+'.00</h5>');
    $(".extprice"+pr_id).html('<li class="actual">&#8377; '+updateactPrice+'.00</li>');

  if(disType == "Rs"){	
  	$(".rupees"+pr_id).html('<li class="off">&#8377; '+disPrice+' Off</li>');
  }

});		
	
	
	
$(".qtyplus").on("click",function(){

  var iv = $(this).attr("qty");	
  var pr_id = $(this).attr("pr_id");
  var actPrice = $("#actprice"+pr_id).val();
  var disPrice = $("#dPPrice"+pr_id).val();
  var disType = $("#disTType"+pr_id).val();
  	
  var value = parseInt($("."+iv).val(), 10);
  value = isNaN(value) ? 0 : value;
  value++;
  $("."+iv).val(value);
  var price = $("#upprice"+pr_id).val()	
  $(".upprice"+pr_id).html('<h5>&#8377; '+price*value+'.00</h5>');
  $(".extprice"+pr_id).html('<li class="actual">&#8377; '+actPrice*value+'.00</li>');
	
  if(disType == "Rs"){	
  	$(".rupees"+pr_id).html('<li class="off">&#8377; '+disPrice*value+' Off</li>');
  }
	
});
	
	
$(".qtyminus").on("click",function(){

  var iv = $(this).attr("qty");	
  var pr_id = $(this).attr("pr_id");
  var actPrice = $("#actprice"+pr_id).val();
  var disPrice = $("#dPPrice"+pr_id).val();
  var disType = $("#disTType"+pr_id).val();
	
  if($("."+iv).val() <= 1){
	  
	  return false;
  }		
	
  var value = parseInt($("."+iv).val(), 10);
  value = isNaN(value) ? 0 : value;
  value--;
  $("."+iv).val(value);
  var price = $("#upprice"+pr_id).val()	
  $(".upprice"+pr_id).html('<h5>&#8377; '+price*value+'.00</h5>');		
  $(".extprice"+pr_id).html('<li class="actual">&#8377; '+actPrice*value+'.00</li>');

  if(disType == "Rs"){	
  	$(".rupees"+pr_id).html('<li class="off">&#8377; '+disPrice*value+' Off</li>');
  }
	
	
});	

	
	

$(".catQty").on("click",function(){
	
	var pid = $(this).attr("product_id");
	var cid = $(this).attr("cat_id")
	
	
	$.ajax({
		
		type : "post",
		url : "<?php echo base_url("ajax/getCategoryprice") ?>",
		data : {pid : pid, cid : cid},
		dataType : 'json',
		success : function(data){
			console.log(data);
			$(".qty"+pid).val(1);
			
			if(data.dis_type == "ext"){
				
				$(".upprice"+pid).html('<h5>&#8377; '+data.price+'</h5>');
				$("#upprice"+pid).val(data.price);
				$("#upQty"+pid).val(cid);
				$(".percent"+pid).hide();
				$(".rupees"+pid).hide();
				
				
			}
			
			if(data.dis_type == "percent"){
				
				$(".extprice"+pid).show();
				$(".percent"+pid).show();
				
				$(".extprice"+pid).html('<li class="actual">&#8377; '+data.extprice+'</li>');
				$(".percent"+pid).html('<li class="off">'+data.percentage+'%Off</li>');
				$(".upprice"+pid).html('<h5>&#8377; '+data.price+'</h5>');
				$(".rupees"+pid).hide();
	// To update Qty			
				$("#actprice"+pid).val(data.extprice);
				$("#upprice"+pid).val(data.price);
				$("#upQty"+pid).val(cid);
				
			}else{
				
				if(data.dis_type == "rs"){
					$(".rupees"+pid).show();
					$(".extprice"+pid).show();
					
					$(".extprice"+pid).html('<li class="actual">&#8377; '+data.extprice+'</li>');
					$(".percent"+pid).hide();
					$(".rupees"+pid).html('<li class="off">&#8377; '+data.disPrice+' Off</li>');
					$(".upprice"+pid).html('<h5>&#8377; '+data.price+'</h5>');
	// To update Qty			
				$("#dPPrice"+pid).val(data.disPrice);
				$("#upprice"+pid).val(data.price);
				$("#upQty"+pid).val(cid);
					
				}else{
					
					$(".extprice"+pid).hide();
					$(".percent"+pid).hide();
				}
					
			}
			
			
		},
		error : function(data){
			
			console.log(data);
		}
		
		
	});
	
});

	

$(".cart").on("click",function(){
	
	<?php $pcount = $this->db->query("SELECT MAX( id ) AS max FROM tbl_products")->row(); ?>
	
	
	var count = <?php echo $pcount->max; ?>;
	
	var pid = $(this).attr("addPid");
		
	for(var i = 1; i <= count; i++){
		
		if(pid == i){
			
			var price = $("#upprice"+i).val();
			var category = $("#upQty"+i).val();
			var qty = $(".qty"+i).val();
			
			
			if(qty < 1){
				
				Swal(
				  'Error!',
				  'Quantity Should Be Atleast 1.',
				  'error'
				);
				
				return false;
			}
			
		}
	}
	
	
	$.ajax({
		
		type : "post",
		url : "<?php echo base_url("products/cartInsert") ?>",
		data : {pid : pid, price : price, category : category, qty : qty},
		dataType : 'json',
		success : function(data){
			
			console.log(data);
			if(data.status == 1){
				
//				 Swal(
//				  'Success',
//				  'Added To Cart',
//				  'success',
//
//				)
				
				$("#error").show();
				
				$("#error").html('<div class="alert alert-success mt-3 mb-0 success-alert" role="alert"><li>Successfully Added to Cart !</li</div>')
				
				setInterval(function(){ $("#error").hide(); }, 3000);
				
				
				
			$(".cartCount").html(data.cartCount);	 	
				
				
			}else{
				
//				Swal(
//				  'Error!',
//				  'Error Occured Please Try Again.',
//				  'error'
//				);
				
				$("#error").show();
				
				$("#error").html('<div class="alert alert-danger mt-3 mb-0 success-alert" role="alert"><li>Error Occured Please Try Again.</li</div>')
				
				setInterval(function(){ $("#error").hide(); }, 3000);
				

				
			}
			
			if(data.status == "exist"){
				
//				Swal(
//				  'Error!',
//				  'Already Added Into Cart.',
//				  'error'
//				);
				
				$("#error").show();
				
				$("#error").html('<div class="alert alert-danger mt-3 mb-0 success-alert" role="alert"><li>Already Added Into Cart.</li</div>')
				
				setInterval(function(){ $("#error").hide(); }, 3000);
				

				
			}
			
		},
		error : function(data){
			
			console.log(data);
			
			Swal(
				  'Error!',
				  'Error Occured Please Try Again.',
				  'error'
				);

		}
		
	});
	
});


</script>



	
	
