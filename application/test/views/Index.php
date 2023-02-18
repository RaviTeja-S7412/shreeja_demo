<?php 

	front_header(); 

	$bann = $this->db->get_where("fdm_va_home_slider_images",array("deleted"=>0))->row();

	$comov = $this->db->get_where("tbl_company_overview",array("status"=>"Active"))->row();


?>




 	<div class="banner" style="background-image: url(<?php echo base_url("admin/").$bann->images ?>)">
		
        <div class="home">
            <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/home.png" alt="">
            <br>
            
          <?php 
			
			echo $bann->description;
			?>                  
                    
                    
        </div>

        <div class="milk">
            <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/milk.png" alt="" />
        </div>
		
		</div>
		<!-- Banner Ended -->

        <div class="flex-container">
            
			<div style="flex-grow: 3">
			<img src="<?php echo base_url("admin/").$comov->image ?>" alt="" />
			</div>
			<div style="flex-grow: 6">
			<div class="store">
				
				<?php echo $comov->description ?>
				
			</div>
			</div>
			
		</div>
		
	<!-- Tabs With Images -->
	

    <script>
            $(document).ready(function(){
                $('.tabs').tabs();
            });
        </script>

<div class="wrap">

           <?php  
			
			$products = $this->db->get_where("tbl_products",array("status"=>"Active","deleted"=>0,"assigned_to"=>'consumers'),6)->result();
				 
			if(count($products) > 0){	 
			
			?>   
   
    <div class="tabs">

        <ul class="btns">
            <h3 class="text-light text-center">Our Milk Products</h3>
            

           <?php 
			
			$pid = 0;
				
			foreach($products as $pr){	
			?>
              
            <li><a href="#ProductsTab<?php echo $pid ?>" class="<?php echo ($pid==0) ? "active" : "" ?>" data-toggle="pill" ><?php echo $pr->product_name ?></a></li>
            
            <?php 
			$pid++;
			} ?>
            
        </ul>

        <div class="conten">
               
            <?php 
			
			$ppid = 0;
				
			foreach($products as $pr1){	
				
			$categories = json_decode($pr1->product_quantity);	
			?> 
                <div id="ProductsTab<?php echo $ppid ?>" class="tab">
                    <div>
                        <div class="lists">
                        <p>Product Name: <?php echo $pr1->product_name ?></p>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <p>Pack Sizes: <?php foreach($categories->quantity as $qty){
							
								echo $qty." , ";
				
							} ?>
                       </p>
                        </div>
                        
                        
                        <div class="icons">
                        <a href="javascript:void(0)"><i class="fas fa-list-ul mr-2" data-target="#productModal<?php echo $ppid ?>" data-toggle="modal"></i></a>
                        |
                        <a href="<?php echo base_url("products") ?>">Order</i></a>
                        </div>
                        <div style="border-bottom: 2px solid #e8e8e8;clear: both;"></div>
                        </div>
                        
                        <div class="mt-3"></div>
                        
                        <img src="<?php echo base_url("admin/").$pr1->product_banner_image ?>" alt="" />
                        
                    </div>
                    
                    
 <div class="modal fade" id="productModal<?php echo $ppid ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="prdct-model-content">
      <div class="modal-header" >
        <h5 class="modal-title" id="productModalLabel"><?php echo $pr1->product_name ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" id="prdct-model-body">
            <p>Name of Product : <?php echo $pr1->product_name ?></p>
            <p>Available in Pack sizes : <?php foreach($categories->quantity as $qty){
							
								echo $qty." , ";
				
							} ?></p>
            <p>Storage condition : Under Refrigeration (Below 8° C)</p>
            <p>Nutritional Information per 100 g (approx. values )</p>
            
        <div class="container-fluid">
            <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <img src="<?php echo base_url("admin/").$pr1->product_image ?>" alt="" style="width: 100%">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
            <table class="table">
              <tbody>
                <?php 
				  $ninfo = json_decode($pr1->nutritional_info);
									
				  foreach($ninfo->name as $key => $name){

				?>
               
                <tr>
               
                 
                  <td><?php echo $name; ?>	</td>
                  <td>:</td>
                  <td><?php echo $ninfo->value[$key];  ?></td>
                  
                  
                </tr>
                
                <?php } ?>
              </tbody>
            </table>
            </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>        
                    
                    
                    
                    
                    
                    
                    
    		<?php 
			$ppid++;
			} ?>

        </div>

        <div style="clear:both"></div>
    </div>
    
    
   <?php } ?> 

</div>

    <div class="customer">
        
            <div class="row mx-auto">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="card sample">
                                    <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/sample.jpg" alt="">
                                    <span class="h4">Ask for Sample</span>
                                    <p>Try our milk sample by 
                                        dropping your details in enquiry form 
                                        or call us on: +91-877-224 2173</p>
                                  </div>
                    </div>

                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                        <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/indicator.png" class="mt-5 pt-4" alt="">
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card happy" style="width:18rem;">
                            <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/happy.jpg" alt="">
                            <span class="h4">Are you Happy?</span>
                            <p>Woohoo…We are glad that you liked Shreeja Milk, it’s time we ask “How could you let us serve you” </p>
                        </div>
                    </div>

                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                            <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/indicator.png" class="mt-5 pt-4" alt="">
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                        <div class="card subscribe">
                            <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/subscription.jpg" alt="">
                            <span class="h4">Go for Subscription</span>
                            <p>Register through [Registration Link] or call us today to get started for 
                                subscription with us.</p>
                        </div>
                    </div>
            </div>
        
    </div>

	<!-- About Section Started -->

    <div class="container-fluid about mb-0">
        <div class="row">
            
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 ">
                
                <div class="about-tab">
                        <div class="pt-5 about-head"><span class="h3">About Shreeja Milks</span></div>
                        <div class="milk-tab">
                                <div class="tab head-tab">
                                       
                      <?php
						
						$abtus = $this->db->get_where("tbl_about_us_homepage",array("deleted"=>0,"status"=>"Active"),4)->result();
				 		
				 		$id = 0;
				 		if(count($abtus) > 0){
						
							foreach($abtus as $au){
					  ?>		
                                       
                             <button class="tablinks" onclick="openCity(event, 'tab<?php echo $id ?>')" id="<?php echo ($id == 0) ? "defaultOpen" : "" ?>"><?php echo $au->title ?></button>
                                       
                      <?php 
							$id++;
							}} ?>                 
                                </div>
                        </div>
                          
                      <?php
					
                    	$id1 = 0;
				 		if(count($abtus) > 0){
						
							foreach($abtus as $au1){
					  ?>      
                          
                          <div id="tab<?php echo $id1 ?>" class="tabcontent">
                            <p><?php echo nl2br($au1->description) ?></p>
                            
                            
                            <a href="<?php echo base_url().$au1->link ?>"  target="<?php echo $au1->target ?>"><i class="fas fa-angle-double-right"></i> Read More</a>
                          </div>
                          
        			  <?php 
							$id1++;
							}} ?>	
                          
                </div>
				
<!--				<li><a href="#"><i class="fas fa-angle-double-right"></i> Read More</a></li>-->
                     
            </div>

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                    <div class="box"></div>
                <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/staff.jpg" class="about-img" alt="">
            </div>

        </div>
    </div>
	
	<!-- About Section Ended -->


		<!-- Food Saftey policy Started -->	
		
    <?php 
		
		$fsp = $this->db->get_where("tbl_home_foodsafetypolicy",array("status"=>"Active","deleted"=>0))->row();
					 
		if($fsp){
	?>
       
        <div class="container-fluid policy">
            <span class="h2">
                Food Safety Policy
            </span>
            <p>
              	<?php echo nl2br($fsp->description); ?>
            </p>

            <a href="<?php echo base_url().$fsp->link ?>" target="<?php echo $fsp->target ?>" class="btn btn-primary btn-lg">READ MORE</a>
        </div>
	<?php } ?>	
		<!-- Food Saftey policy Ended -->


		<!-- Faqs Section Started -->

        <div class="container-fluid faqs">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-4 col-sm-12 col-12 think">
                    <span class="h2">FAQs</span>

                    <img src="<?php echo base_url("admin/assets/front/") ?>assets/images/faqs.jpg" alt="">
                </div>

                <div class="col-xl-7 col-lg-7 col-md-8 col-sm-12 col-12">
                   
                    <div class="panel-group" id="accordion" role="tablist">
                        
                  <?php
					$fid = 0;
					
					$faqs = $this->db->get_where("tbl_faqs",array("deleted"=>0))->result();
						
					if(count($faqs)){
						
						foreach($faqs as $faq){
					?>
                         
                        
                        
                        

		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading<?php echo $fid ?>">
				<h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $fid ?>" aria-expanded="true" aria-controls="collapse<?php echo $fid ?>">
						
						<?php echo $faq->question ?> <i class="fas fa-caret-down"></i>
					</a>
				</h4>
			</div>
			<div id="collapse<?php echo $fid ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $fid ?>">
				<div class="panel-body">
					  <?php echo $faq->answers ?>
				</div>
			</div>
		</div>
                        
                        
                        
                        
                     <?php 
						$fid++;
						}} ?>   
                        
                        
                        
                      </div>
	
                </div>

            </div>
        </div>
		
		<!-- Faqs Section Ended -->


<?php front_footer() ?>
<!--
<div class="modal fade bs-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal" data-backdrop="static" style="padding-right: 17px;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
          <span aria-hidden="true" class="close" data-dismiss="modal" aria-label="Close">×</span>
      </div>
      <div class="modal-body">
        <p>Select your city</p>
			<form action="<?php //echo base_url("home/selectLocation") ?>" method="post">
			<select name="location">
			<?php
//				$loc = $this->db->get_where("tbl_locations",array("status"=>1,"deleted"=>0))->result();
//
//				if(count($loc) > 0){
//				foreach($loc as $l){	
			?>
				<option value="<?php //echo $l->id ?>"><?php //echo $l->location ?></option>
				
			<?php //}} ?>
			</select>
			<input type="submit" class="bg-dark text-light" value="Ok">
			</form>
      </div>
    </div>
  </div>
</div>	    
-->
	        
	        
	        
