<?php  front_inner_header(); ?>
			
<!-- Main Content Started -->
		
       
    
        <div class="main-content">
		
		<!-- Products Section Started -->
		
<?php
				
if($oc != ""){	

?>	
    <div align="center" class="sample-order">
        
    <div class="alert alert-success" role="alert">
          <p><?php echo $oc ?></p>
    </div>

	</div>
<?php	
			 
	}else{		

?>
		
		
<div class="product-page">
		<div class="prodct-heading">
			<h3 class="prdct-page-head">Order Free Sample</h3>
				
				<div align="center">
					<?php echo $this->session->flashdata("cerr") ?>
				</div>
		</div>
		<div class="prdcts">
			
			<div class="accordion" id="accordionExample">
			
 <?php
	
	$cid = 0;
	
	$categories = $this->db->get_where("tbl_categories",array("status"=>"Active","deleted"=>0))->result();

	if(count($categories) > 0){
		
		foreach($categories as $cat){
			
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
	$prod = json_decode($this->products_model->getSampleorderproducts($cat->id));
				
	$pkey = 0;	
			
	$sproducts = array_filter($prod->sdata);	
			
	
	if(count($sproducts) > 0){	
		
			
		foreach($sproducts as $key => $pr){

	
  ?>
      
      
      <div class="card-body">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
			<div class="row">
				<figure class="figure">
				  <img src="<?php echo base_url("admin/").$pr->product_image ?>" class="figure-img img-fluid" />
				  <figcaption class="figure-caption"><?php echo $pr->product_name ?></figcaption>
				</figure>
				
					<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
						<form action="" class="float-left sample-label">
							<label class="radio-inline pl-2">
							<input type="radio" name="optradio" checked> <?php echo $prod->quantity[$key] ?>
							</label>
						
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4"><a href="<?php echo base_url("cart/sampleOrder/").$prod->sid[$key] ?>" class="btn mt-3 sample-order-btn">ORDER</a></div>
		</div>
		
      </div>
			
	<?php
	  
		
	  $pkey++;
	  }}else{
		
	?>	
		<div class="card-body">
			
			<p>No products to display</p>
			
		</div>
			
					
	<?php		
	  }
			
	?>		
	  
    </div>
    
	  
	  
	 
    
  </div>
  

<?php 
		$cid++;
		}}
		
?>		
	
    

			
		</div>
		</div>
		
</div>
		</div>		
<?php } ?>
    <!-- Footer Section Starts -->
			
<?php  front_inner_footer(); ?>
