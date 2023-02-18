<?php admin_header(); ?>

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
<?php admin_sidebar() ?> 
       
       
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice{

		background-color: #4798e8;
	}					
</style>         
       
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <div class="d-flex no-block justify-content align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

          

            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">
            <!-- ============================================================== -->
              <!-- Card -->
            <div class="card">
                <div class="card-header">
                   <div class="row">
                   	  <div class="col-md-10">
                    	<i class="fa fa-user"></i> Update Product
                      </div>
                      <div class="col-md-2" style="text-align: right">
                       <a href="<?php echo base_url() ?>products">	
                    	<button class="btn btn-success waves-effect waves-light">All Products</button>
                       </a>	
                      </div>	
                   </div> 	
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>products/products/updateProductdata" enctype="multipart/form-data">
                                <div class="card-body">
                                 <h4 class="card-title" style="margin-bottom: 10px" align="center">Product Details :</h4>                                    
                                      <div class="row">
                                      
                                      	<div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Assigned To
                                                <div class="input-group m-t-10">
                                                    <select class="form-control" id="assigned_to" name="assigned_to" required>
                                                       <option value="">Select For</option>
                                                       <option value="consumers" <?php if($p->assigned_to == 'consumers') { ?>  selected="selected"<?php } ?>>Consumers</option> 
                                                       <option value="agents" <?php if($p->assigned_to == 'agents') { ?>  selected="selected"<?php } ?>>Agents</option>
                                                       <option value="freeProduct" <?php if($p->assigned_to == 'freeProduct') { ?>  selected="selected"<?php } ?>>Free Product</option>
                                                       
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
										
                                      
									  </div>
                                      <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Product Name
                                                <div class="input-group m-t-10">
                                                    <input type="text" name="product_name" class="form-control" id="name" placeholder="Product Name" required="" value="<?php echo $p->product_name ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Product ID
                                                <div class="input-group m-t-10">
                                                    <input type="text" class="form-control" name="product_id" placeholder="Product ID" required="" value="<?php echo $p->product_id ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>                                        
                                         <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Product Image
                                                <div class="input-group m-t-10">
                                                    <input type="file" class="form-control" name="pr_image" id="designation">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
									</div>
                                        
                                        
                                    <div class="row">
                                        
                                        
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                City
                                                <div class="input-group m-t-10">
                                                    <select class="select2 form-control" name="location[]" id="select2-customize-result" style="width: 100%;" required>
														<option value="">Select City</option>
													<?php
	
														if($p->assigned_to == "freeProduct"){
															
															$ato = "consumers";
															
														}else{
															
															$ato = $p->assigned_to;
															
														}
														$loc = $this->db->get_where("tbl_locations",array("status"=>1,"deleted"=>0,"assign_to"=>$ato))->result();

														if(count($loc) > 0){
															
														foreach($loc as $l){	
													?>	
							                       
                                                           <option value="<?php echo $l->id ?>"><?php echo $l->location ?></option> 

													<?php }} ?>	
													
													</select>   
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                                
                                          
                                         <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Product Banner Image
                                                <div class="input-group m-t-10">
                                                    <input type="file" class="form-control" name="banner_image" id="designation">
                                                </div>

                                                </div>
                                            </div>
                                        </div>    
                                        
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Category
                                                <div class="input-group m-t-10">
                                                    <select class="form-control" id="" name="product_category" required>
                                                       <option value="">Select Category</option>
                                                    <?php
														$cat = $this->db->query("select * from tbl_categories where deleted=0 order by id desc")->result();

														if(count($cat) > 0){
															
														foreach($cat as $cc){	
														?>	
							                                                   
                                                   		<option value="<?php echo $cc->id ?>" <?php echo ($cc->id == $p->product_category) ? "selected" : "" ?>><?php echo $cc->category_name ?></option> 
													<?php }} ?>	
                                                   
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                         
									</div>
									
                                  
                          			<div class="row">          
                                           
                                          
                                       <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                HSN Code
                                                <div class="input-group m-t-10">
                                                    <input type="text" class="form-control" name="hsn_code" value="<?php echo $p->hsn_code ?>" placeholder="HSN Code" required="">
                                                </div>

                                                </div>
                                            </div>
                                        </div>                               
                                                                                                            
                                                                       
                                       <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                GST Charges
                                                <div class="input-group m-t-10">
                                                    <select class="form-control" id="gst_charges_status" name="gst_charges_status" required>
                                                       <option value="">Select Status</option>
 <option value="Active" <?php if($p->gst_charges_status == 'Active') { ?>  selected="selected"<?php } ?>>Active</option>
 <option value="Inactive" <?php if($p->gst_charges_status == 'Inactive') { ?> selected="selected"<?php } ?>>Inactive</option>
                                                          
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div> 	
                                        
                                        	
                                        <div class="col-sm-12 col-md-4" id="gst_charges" style="display: <?php  echo ($p->gst_charges_status == 'Active') ? "block" : "none"  ?>">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                GST Value
                                                <div class="input-group m-t-10">
													<select class="form-control" name="gst_charges">
                                                    
                                                       <option value="">Select GST Percentage</option>
                                                       <option value="0" <?php if($p->gst_charges == 0) { ?> selected="selected"<?php } ?>>0 %</option> 
                                                       <option value="5" <?php if($p->gst_charges == 5) { ?> selected="selected"<?php } ?>>5 %</option>
                                                       <option value="12" <?php if($p->gst_charges == 12) { ?> selected="selected"<?php } ?>>12 %</option>
                                                       <option value="18" <?php if($p->gst_charges == 18) { ?> selected="selected"<?php } ?>>18 %</option>
													</select>                                                 
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        						
									
									</div>
                                  
                                  	<div class="row">
                                  		
                                  		<div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Product Description
                                                <div class="input-group m-t-10">
                                                    <textarea class="form-control" name="pr_desc" id="" rows="3" placeholder="Product Description" required><?php echo $p->description ?></textarea>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                  		
										
										<div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Quantity Type
                                                <div class="input-group m-t-10">
                                                    <select class="form-control" name="qtyType[]" multiple="" id="select2-with-tags" style="width: 100%;height: 36px;">
                                                    
                                                    	<option value="">Select Quantity Type</option>
														<?php foreach(json_decode($p->qty_type) as $qtType){  ?>
														
                                                    	<option value="<?php echo $qtType ?>"><?php echo $qtType ?></option>
                                                    
														<?php } ?>
                                                    
													</select>

                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                  		
                                  	</div>
                                  			
                                   
             <h4 class="card-title" style="margin-bottom: 10px" align="center">Quantity Details :</h4> 
                                   <hr>
            
          <?php 
                                            
            $categories = json_decode($p->product_quantity);
                
		
		  ?>												
														
         <div class="row">
             <div class="col-md-3">          
                        <div class="form-group">
                          <label class="control-label">Quantity</label>
                            <div class="row m-b-10 field_wrapper">
                            
                            <?php 
							$i=0;
                            if(count($categories->quantity)>=1){   
                                foreach ($categories->quantity as $qty) {
                                 
                            ?>  
                             
                              <div class="col-md-12" style="margin-bottom: 10px">
                        
                                <input type="text" name="category[]" class="form-control col-md-11" value="<?php echo $qty ?>" placeholder="Quantity in ML" id="sh" required>
									
                             	 <?php  
								if($i==0){
									
								}else{  
							  ?>  
                            <p align="right" style="margin-top: -35px" id="rem<?php echo $i ?>" sap="rem1<?php echo $i ?>" price="rem3<?php echo $i ?>" status="rem4<?php echo $i ?>" class="remove_both">
                                <button class="btn btn-danger waves-effect waves-light" type="button" style="text-align: right"><i class="ti-close"></i>
                                </button>
                            </p>
                             <?php } ?>

                             
                              </div>
                              
                            <?php
							
							$i++;		
								}}
								?>	
                              
                          </div>
                          <small style="color: red; font-weight: bold">Note : Quantity should be as 150 ML or 150 gm </small><br>
                          
                          <button type="button" id="add_sheading" class="btn btn-info waves-effect waves-light" style="text-align: right">Add Quantity</button>
                          
                        </div>
          </div>
          <div class="col-md-2"> 
             <div class="form-group">
                          <label class="control-label">SAP Code</label>
                          
                            <div class="row m-b-15 sap_points">
                          <?php
				 			$ii = 0;	
                            if(count($categories->sap)>=1){   
                                foreach ($categories->sap as $sap) {
                                 
                            ?> 
                           
                              <div class="col-md-12" style="margin-bottom: 15px" id="rem1<?php echo $ii ?>">
                                <input type="text" name="sap[]" class="form-control" value="<?php echo $sap ?>" placeholder="SAP Code" id="sap" required>

                              </div>
                              
                            
                           <?php 
								$ii++;
								}} ?>
                            </div>
              
             </div>
                        	
          </div>       
          <div class="col-md-2"> 
             <div class="form-group">
                          <label class="control-label">Price</label>
                          
                            <div class="row m-b-15 sub_points">
                          <?php
				 			$ii = 0;	
                            if(count($categories->price)>=1){   
                                foreach ($categories->price as $price) {
                                 
                            ?> 
                           
                              <div class="col-md-12" style="margin-bottom: 15px" id="rem3<?php echo $ii ?>">
                                <input type="text" name="price[]" class="form-control" value="<?php echo $price ?>" placeholder="Quantity Price" id="points" required>

                              </div>
                              
                            
                           <?php 
								$ii++;
								}} ?>
                            </div>
              
             </div>
                        	
          </div>
          
                 
          <div class="col-md-2"> 
             <div class="form-group">
                          <label class="control-label">Status</label>
                          
                            <div class="row m-b-15 status_points">
                          <?php
				 			$iis = 0;	
                            if(count($categories->status)>=1){   
                                foreach ($categories->status as $status) {
                                 
                            ?> 
                           
                              <div class="col-md-12" style="margin-bottom: 15px" id="rem4<?php echo $iis ?>">
                                <select class="form-control" name="qtystatus[]" required>
                                	<option value="">Select Status</option>
                                	<option value="Active" <? echo ($status == "Active") ? 'selected' : '' ?> >Active</option>
                                	<option value="Inactive" <? echo ($status == "Inactive") ? 'selected' : '' ?>>Inactive</option>
                                </select>

                              </div>
                              
                            
                           <?php 
								$iis++;
								}}else{ 
								foreach ($categories->price as $price) {
								?>
                           
                           			
									<div class="col-md-12" style="margin-bottom: 15px" id="rem<?php echo $iis ?>">
										<select class="form-control" name="qtystatus[]" required>
											<option value="">Select Status</option>
											<option value="Active">Active</option>
											<option value="Inactive">Inactive</option>
										</select>

									  </div>
                           
                           <? }} ?>
                            </div>
              
             </div>
                        	
          </div>              
                                      
      </div> 
   <h4 class="card-title" style="margin-bottom: 10px" align="center">Nutritional Information :</h4> 
                  
                            <hr>
            
          <?php 
                                            
            $nifo = json_decode($p->nutritional_info);
            
		  ?>												
														
         <div class="row">
             <div class="col-md-4">          
                        <div class="form-group">
                          <label class="control-label">Name</label>
                            <div class="row m-b-10 nut_wrapper">
                            
                            <?php 
							$si=0;
                            if(count($nifo->name)>=1){   
                                foreach ($nifo->name as $name) {
                                 
                            ?>  
                             
                              <div class="col-md-12" style="margin-bottom: 10px">
                        
                                <input type="text" name="nname[]" class="form-control col-md-11" value="<?php echo $name ?>" placeholder="name" id="sh" required>
									
                             	 <?php  
								if($si==0){
									
								}else{  
							  ?>  
                            <p align="right" style="margin-top: -35px" id="rem1<?php echo $si ?>" class="remove_both1">
                                <button class="btn btn-danger waves-effect waves-light" type="button" style="text-align: right"><i class="ti-close"></i>
                                </button>
                            </p>
                             <?php } ?>

                             
                              </div>
                              
                            <?php
							
							$si++;		
								}}
								?>	
                              
                          </div>
                          <button type="button" id="add_nut" class="btn btn-info waves-effect waves-light" style="text-align: right">Add</button>
                          
                        </div>
          </div>
          <div class="col-md-4"> 
             <div class="form-group">
                          <label class="control-label">Value</label>
                          
                            <div class="row m-b-15 sub_nut">
                          <?php
				 			$ii = 0;	
                            if(count($nifo->value)>=1){   
                                foreach ($nifo->value as $value) {
                                 
                            ?> 
                           
                              <div class="col-md-12" style="margin-bottom: 15px" id="rem1<?php echo $ii ?>">
                                <input type="text" name="nvalue[]" class="form-control" value="<?php echo $value ?>" placeholder="value" id="points" required>

                              </div>
                              
                            
                           <?php 
								$ii++;
								}} ?>
                            </div>
              
             </div>
                        	
          </div>       
      </div>                        
									<div class="row">
                                       <div class="col-md-9 col-lg-9">
                                       	<input type="hidden" name="pid" value="<?php echo $p->id ?>">
                                       </div>
                                        <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 20px;">
                                                
                                               <!--  <div class="input-group">
                                                    <div class="input-group-prepend"> -->
                                                    
								      <button type="submit" id="msubmit" class="btn btn-info waves-effect waves-light" style="width: 100%">Update</button>
                                                  
                                                <!--   </div>
                                                    
                                                    
                                                </div> -->

                                                </div>
                                            </div>
                                        </div>        

									</div>			


                                </div>
                              
                               
                               
                            </form>

                        

                </div>
            </div>

            <!-- End Card  -->
            
            
            
              <div class="row">
                    <div class="col-12">
                        <div class="card">
                        
                        
								<div class="card-header">
								   <div class="row">
									  <div class="col-md-10">
										<i class="fas fa-rupee-sign"></i> <strong>Price Management</strong>
									  </div>
									  	
								   </div> 	
								</div>
                            <div class="card-body">
                              
                           <?php    
                              
							
							$did = $this->uri->segment(4);
							
							$existPm = $this->db->get_where("tbl_price_management",array("deleted"=>0,"product_id"=>$p->id,"id"=>$did))->row();
						
							$existCat = isset($existPm->price_management) ? $existPm->price_management : "";
														   
							$eec =(json_decode($existCat));
														 
							$dtype = isset($eec->discount_type) ? $eec->discount_type : "";							   
													   	
                              ?> 
                              <form method="post" action="<?php echo base_url("products/products/priceManagement") ?>"> 
                                <div class="row">
                                    <div class="col-md-4">
                                     <div class="row">   
                                      <div class="col-md-12">   
                                        <div class="form-group">
                                            <label>Select Start & End Date :</label>
                                            <div class="input-daterange input-group" id="date-range">
                                                <input type="text" class="form-control" name="startDate" placeholder="Start Date" autocomplete="off" value="<?php echo isset($existPm->startdate) ? $existPm->startdate : "" ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-info b-0 text-white">TO</span>
                                                </div>
                                                <input type="text" class="form-control" name="endDate" placeholder="End Date" autocomplete="off" value="<?php echo isset($existPm->enddate) ? $existPm->enddate : "" ?>" required/>
                                            </div>
                                        </div>
                                      </div>  
                                      </div>
                                      
                                      <div class="row">   
                                      <div class="col-md-12">   
                                        <div class="form-group">
                                            <label>Discount Type :</label>
                                            <select name="disType" class="form-control" required>
                                            	
                                            	<option value="">Select Discount Type</option>
                                            	<option value="percent" <?php echo ($dtype == "percent")? "selected" : "" ?>>Percentage</option>
                                            	<option value="Rs" <?php echo ($dtype == "Rs")? "selected" : "" ?>>Rs</option>
                                            	
                                            </select>
                                            
                                            
                                        </div>
                                      </div>  
                                      </div>
                                      
                                      
                            <label>Discount in (% or Rs) :</label> 
         					          
                            <div class="row">
         						
         						
                            <?php 	
									
							   
							$i=0;
							$rid = 1;
							$qtys = isset($categories->quantity) ? $categories->quantity : "";							   
														   
                            if(count($qtys)>=1){   
                                foreach ($qtys as $key => $qty) {
                                
								if(count(isset($eec->quantity) ? $eec->quantity : 0)  >= 1){	
									
									$extQty = in_array($qty,isset($eec->quantity) ? $eec->quantity : []);
								
								}else{
									
									$extQty = "false";
								}
									
								if($extQty == "true" && $eec->price[$key] != ""){	
                            ?>   
								
																
						  <div class="col-md-3" style="margin-top: 20px">
                             
                              <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customRadio<?php echo $i ?>" name="category[]" class="custom-control-input menu_icon" value="<?php echo $qty ?>" remove="remdisc<?php echo $key ?>" checked>
                                    <label class="custom-control-label" for="customRadio<?php echo $i ?>"><?php echo $qty ?></label>
                                    <div class="" style="margin-top: 10px">
                                        <input type="text" name="price[]" id="remdisc<?php echo $key ?>" class="form-control checkEnt" placeholder="Price" value="<?php echo $eec->price[$key] ?>">
                                    </div>
                              </div>
                          </div>
                        <?php }else{ ?>
                          <div class="col-md-3" style="margin-top: 20px">
                              <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customRadio<?php echo $i ?>" name="category[]" class="custom-control-input menu_icon" value="<?php echo $qty ?>" remove="remdisc<?php echo $key ?>">
                                    <label class="custom-control-label" for="customRadio<?php echo $i ?>"><?php echo $qty ?></label>
                                    <div class="" style="margin-top: 10px">
                                        <input type="text" name="price[]" id="remdisc<?php echo $key ?>" class="form-control checkEnt" placeholder="Price">
                                    </div>
                              </div>
                          </div>  
																								
									
							<?php		
								}
								$i++;
								}} 
							?> 
                                      		
                                      		           	 	
                                      		           	 	           	 	
                                      		           	 	           	 	           	 	
                                      		           	 	           	 	           	 	           	 	           	 	
                                       		
                                      </div>
                                      
                                      <div class="row" style="margin-top: 10px">
                                      	
                                      	<div class="col-md-12" style="text-align: right;">
                                      		
                                       		<input type="hidden" name="pid" value="<?php echo $p->id ?>">
                                       		<input type="hidden" name="did" value="<?php echo $did ?>">
                                       		
								      		<button type="submit" id="checkBtn"  class="btn btn-info waves-effect waves-light"><?php echo isset($did) ? "Update" : "Submit" ?></button>
                                      		
                                      	</div>
                                      	
                                      	
                                      </div>  
                                          
                              </form>              
                                                
                                    </div>
                                    
                                    
                                    <div class="col-md-8">
                                    	
                                    	
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="border:0px">
                            <div class="card-body">
                               <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing Discounts</strong></p></div>
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                     
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Discount Type</th>
                                                <th>Discount</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
										   
 										   $extDisc = $this->db->get_where("tbl_price_management",array("product_id"=>$p->id))->result();
										  						
                                           foreach ($extDisc as $u) {  
										  	
											   $discCat = json_decode($u->price_management);
											
											?> 
                                           <?php if($u->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;" align="center"><?php echo ($discCat->discount_type == "percent") ? "%" : "Rs" ?></td>
                                                <td style="padding: 0.5rem;">Quantity:
                                                	<?php 
												
												foreach($discCat->quantity as $key => $qty){
													
													if($discCat->price[$key] != ""){
													
														echo $qty.", ";
												
														} 
													}
													?>
                                              		<br>
                                              		Price :
                                              		<?php
														foreach($discCat->price as $price){
														 if($price != ""){	
															echo $price;
															echo ($discCat->discount_type == "percent") ? " %, " : " <i class='fas fa-rupee-sign' style='font-size:small'></i>, ";  
														 }
														}
																	
													?>				
                                               </td>
                                               
                                                <td style="padding: 0.5rem;"><?php echo date("d-M-y",strtotime($u->startdate)) ?></td>
                                               
                                                <td style="padding: 0.5rem;"><?php echo date("d-M-y",strtotime($u->enddate)) ?></td>
                                                
                                                <td style="padding: 0.5rem;">
                                                   
                                                   <?php if($u->status=="Active"){ ?>
                                               <div class="switch">
                                                   <input type="checkbox" data-on-color="info" nav_id="<?php echo $u->id ?>" name="switch" data-off-color="success" class="check" checked>
                                               </div>
                                                   <?php  }elseif($u->status=="Inactive"){ ?>
                                                <div class="switch">
                                                    <input type="checkbox" nav_id="<?php echo $u->id ?>" data-on-color="info" name="switch" data-off-color="success" class="check">
                                                   <?php } ?> 
                                                </div>    
                                                </td>
                                                <td style="padding: 0.5rem;">
                                                    <a href="<?php echo base_url() ?>products/edit-product/<?php echo $p->id."/".$u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
                                                     <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="delDisc(this.id)"><i class="ti-trash"></i></a>

                                                </td>
                                                <div class="rename">
                                                </div>    
                                            </tr>
                                        <?php } ?>
                                     <?php  
                                    
                                       } ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                    	
                                    	
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            
            
            
            
            
            
            
            
            
            
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

            <!-- End footer -->


<script type="text/javascript">
	
$("#assigned_to").change(function(){
	
	var id = $(this).val();
	
	$.ajax({
		
		type : "get",
		url : "<? echo base_url('ajax/getSelectedcacities') ?>",
		data : {id:id},
		success: function(data){
			
			$("#select2-customize-result").html(data);
		}
	})
	
})	
	
$("#gst_charges_status").change(function(){
	
	
	var status = $("#gst_charges_status").val();
	
	if(status == "Active"){
		
		$("#gst_charges").show();
		
	}else{
		
		$("#gst_charges").hide();
		
	}
	
	
});		
	
		
$('#select2-customize-result').val(<?php echo($p->location) ?>);
$('#select2-customize-result').trigger('change');
	
	
$("#select2-customize-result").select2({
    placeholder: "Select City",
    allowClear: true,

});	 
	
$('#select2-with-tags').val(<?php echo($p->qty_type) ?>);
$('#select2-with-tags').trigger('change');	
 
$("#select2-with-tags").select2({
    tags: true
});		

function delDisc(id) {
Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this item!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected item has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>products/products/delPm/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected item is safe :)',
      'success',
      
    )
  }
})
    }  	
	
$(document).ready(function () {
    $('#checkBtn').click(function() {
      var checked = $("input[name='category[]']:checked").length;

      if(!checked) {
        alert("You must check at least one checkbox.");
        return false;
      }

    });
});	
	

 $(document).ready(function(){
	 
	 
		
  jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",

 });
	 
	 
	 
	 

	
    $(".check").bootstrapSwitch({size : 'mini'});
    $('#zero_config').DataTable(); 

    
    $('#zero_config').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
          var nav_id = $(this).attr("nav_id"); 
		
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>products/products/discstatus",
                        data:{id:nav_id,status:status},
                        success:function (data){
                            location. reload(true);
                        }

                    });  
        });	 
	 
	 
	 
		
	  $('input[type="checkbox"]').click('.menu_icon',function(){
            if($(this).prop("checked") == true){
				
				var icon = $(this).attr("remove");
//				alert(icon);
				
				$("#"+icon).attr('required', 'required');
			
            }
            else if($(this).prop("checked") == false){

				var icon = $(this).attr("remove");
//				alert(icon+"1");
				$("#"+icon).val("");
				$("#"+icon).removeAttr('required', 'required');

            }
        });
    });			
</script>





 <script>
	 
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('#add_sheading'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
	var spoints = $('.sub_points')
	var sapoints = $('.sap_points')
	var statuspoints = $('.status_points')
	
    var x = 1; //Initial field counter is 1
	var y = 1;
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append('<div class="col-md-12"><input type="text" name="category[]" class="form-control col-md-11" placeholder="Quantity in ML" required> <p class="sub_p_rem'+x+'" id="remove_button" align="right" style="margin-top: -35px"><button class="btn btn-danger waves-effect waves-light" type="button"><i class="ti-close"></i></button><br></p></div>'); //Add field html
			
			$(spoints).append('<div class="col-md-12 m-b-10 sub_p_rem'+x+'"><input type="text" name="price[]" class="form-control col-md-12" placeholder="Quantity Price" required> </div>'); //Add field html
			$(sapoints).append('<div class="col-md-12 m-b-10 sub_p_rem'+x+'"><input type="text" name="sap[]" class="form-control col-md-12" placeholder="SAP Code" required> </div>'); //Add field html
			$(statuspoints).append('<div class="col-md-12 m-b-10 sub_p_rem'+x+'"> <select class="form-control" name="qtystatus[]" required><option value="">Select Status</option><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>'); //Add field html
			y++;
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '#remove_button', function(e){
        e.preventDefault();
		var id =$(this).attr('class');
		$(this).parent('div').remove(); //Remove field html
		$('.'+id).remove();
        x--; //Decrement field counter
    });
	
	$(wrapper).on('click', '.remove_both', function(e){
		var id =$(this).attr('id');
		var sap =$(this).attr('sap');
		var price =$(this).attr('price');
		var status =$(this).attr('status');
		//alert(id);
		e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
		$("#"+id).remove();
		$("#"+sap).remove();
		$("#"+price).remove();
		$("#"+status).remove();
		//$("#rem1").remove();
        x--; //Decrement field counter
    });
	
	 
  });	
	 
	 
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('#add_nut'); //Add button selector
    var wrapper = $('.nut_wrapper'); //Input field wrapper
	var spoints = $('.sub_nut')

	
    var x = 1; //Initial field counter is 1
	var y = 1;
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append('<div class="col-md-12"><input type="text" name="nname[]" class="form-control col-md-11" placeholder="name" required> <p class="sub_p_rem1'+x+'" id="remove_button1" align="right" style="margin-top: -35px"><button class="btn btn-danger waves-effect waves-light" type="button"><i class="ti-close"></i></button><br></p></div>'); //Add field html
			
			$(spoints).append('<div class="col-md-12 m-b-10 sub_p_rem1'+x+'"><input type="text" name="nvalue[]" class="form-control col-md-12" placeholder="value" required> </div>'); //Add field html
			
			y++;
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '#remove_button1', function(e){
        e.preventDefault();
		var id =$(this).attr('class');
		$(this).parent('div').remove(); //Remove field html
		$('.'+id).remove();
        x--; //Decrement field counter
    });
	
	$(wrapper).on('click', '.remove_both1', function(e){
		var id =$(this).attr('id');
		//alert(id);
		e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
		$("#"+id).remove();
		//$("#rem1").remove();
        x--; //Decrement field counter
    });
	
	 
  });	 

</script>          