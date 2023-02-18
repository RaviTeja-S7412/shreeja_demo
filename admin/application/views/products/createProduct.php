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
                                    <li class="breadcrumb-item active" aria-current="page">Create Product</li>
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
                    	<i class="fa fa-user"></i> Create Product
                      </div>
                      <div class="col-md-2" style="text-align: right">
                       <a href="<?php echo base_url() ?>products">	
                    	<button class="btn btn-success waves-effect waves-light">All Products</button>
                       </a>	
                      </div>	
                   </div> 	
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>products/products/insertProduct" enctype="multipart/form-data">
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
                                                       <option value="consumers">Consumers</option> 
                                                       <option value="agents">Agents</option>
                                                       <option value="freeProduct">Free Product</option>
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
                                                    <input type="text" name="product_name" class="form-control" id="name" placeholder="Product Name" required="">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
<!--
                                         <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Products In Stock
                                                <div class="input-group m-t-10">
                                                    <input type="number" class="form-control" name="pro_in_stk" id="email" placeholder="Total Products In Stock" required="">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
-->
                                        
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Product ID
                                                <div class="input-group m-t-10">
                                                    <input type="text" class="form-control" name="product_id" placeholder="Product ID" required="">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Product Image
                                                <div class="input-group m-t-10">
                                                    <input type="file" class="form-control" name="pr_image" id="designation" required="">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
									</div>
                                        
                                        
                                    <div class="row">
<!--
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Link
                                                <div class="input-group m-t-10">
                                                    <input type="text" name="link" class="form-control" id="link" placeholder="Product URL Link" required="">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Target
                                                <div class="input-group m-t-10">
                                                    <select class="form-control" id="" name="target" required>
                                                       <option value="">Select Status</option>
                                                       <option value="_self">Self</option> 
                                                       <option value="_blank">Blank</option>
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
-->
                                        
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                City
                                                <div class="input-group m-t-10">
                                                    <select class="select2 form-control" name="location[]" id="select2-customize-result" style="width: 100%;" required>
														<option value="">Select City</option>
													<?php
														$loc = $this->locations_model->getConsumercities();

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
                                                    <input type="file" class="form-control" name="banner_image" id="designation" required="">
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
							                                                   
                                                           <option value="<?php echo $cc->id ?>"><?php echo $cc->category_name  ?></option> 
                                                       
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
                                                    <input type="text" class="form-control" name="hsn_code" placeholder="HSN Code" required="">
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
                                                           <option value="Active">Active</option> 
                                                           <option value="Inactive">Inactive</option> 
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-sm-12 col-md-4" id="gst_charges" style="display: none">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                GST Value
                                                <div class="input-group m-t-10">
                                                    <select class="form-control" name="gst_charges">
                                                    
                                                       <option value="">Select GST Percentage</option>
                                                       <option value="0">0 %</option> 
                                                       <option value="5">5 %</option>
                                                       <option value="12">12 %</option>
                                                       <option value="18">18 %</option>
													</select> 
                                                    
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
                                                    	<option value="L">L</option>
                                                    	<option value="Kg">Kg</option>
                                                    	<option value="EA">EA</option>
                                                    
                                                    
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
                                                    <textarea class="form-control" name="pr_desc" id="" rows="3" placeholder="Product Description" required></textarea>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                  		
                                  	</div>	
                                   

             <h4 class="card-title" style="margin-bottom: 10px" align="center">Quantity Details :</h4> 
									
              <hr>
                                   
                                   
       <div class="row">
                                                 	
                                   	
                                   	
             <div class="col-md-3">          
                        <div class="form-group">
                          <label class="control-label">Quantity</label>
                            <div class="row m-b-15 field_wrapper">
                              <div class="col-md-12" style="margin-bottom: 10px">
                        
                                <input type="text" name="category[]" class="form-control" placeholder="Quantity in ML" id="sh" required>

                              </div>
                              
                          </div>
                          <small style="color: red; font-weight: bold">Note : Quantity should be as 150 ML or 150 gm </small><br>
                          <button type="button" id="add_sheading" class="btn btn-info waves-effect waves-light" style="text-align: right">Add Quantity</button>
                          
                        </div>
          </div>
          
          <div class="col-md-2"> 
             <div class="form-group">
                          <label class="control-label">SAP Code</label>
                            <div class="row m-b-15 sap_points">
                              <div class="col-md-12" style="margin-bottom: 10px">
                                <input type="text" name="sap[]" class="form-control" placeholder="SAP Code" id="sap" required>

                              </div>
                              
                            </div>
             </div>
                        	
          </div>
          
          <div class="col-md-2"> 
             <div class="form-group">
                          <label class="control-label">Price</label>
                            <div class="row m-b-15 sub_points">
                              <div class="col-md-12" style="margin-bottom: 10px">
                                <input type="text" name="price[]" class="form-control" placeholder="Quantity Price" id="points" required>

                              </div>
                              
                            </div>
             </div>
                        	
          </div>
          <div class="col-md-2"> 
             <div class="form-group">
                          <label class="control-label">Status</label>
                            <div class="row m-b-15 status_points">
                              <div class="col-md-12" style="margin-bottom: 10px">
                                <select class="form-control" name="qtystatus[]" required>
                                	<option value="">Select Status</option>
                                	<option value="Active">Active</option>
                                	<option value="Inactive">Inactive</option>
                                </select>
                              </div>
                              
                            </div>
             </div>
                        	
          </div>       
      </div> 
                
   <h4 class="card-title" style="margin-bottom: 10px" align="center">Nutritional Information :</h4> 
    <hr>                                                    
  <div class="row">
                                                 	
                                   	
                                   	
             <div class="col-md-4">          
                        <div class="form-group">
                          <label class="control-label">Name</label>
                            <div class="row m-b-15 nut_wrapper">
                              <div class="col-md-12" style="margin-bottom: 10px">
                        
                                <input type="text" name="nname[]" class="form-control" placeholder="Name" id="sh" required>

                              </div>
                              
                          </div>
                          <button type="button" id="add_nut" class="btn btn-info waves-effect waves-light" style="text-align: right">Add</button>
                          
                        </div>
          </div>
          <div class="col-md-4"> 
             <div class="form-group">
                          <label class="control-label">Value</label>
                            <div class="row m-b-15 sub_nuts">
                              <div class="col-md-12" style="margin-bottom: 10px">
                                <input type="text" name="nvalue[]" class="form-control" placeholder="Value" id="nut_value" required>

                              </div>
                              
                            </div>
             </div>
                        	
          </div>       
      </div> 
                
                                    
									<div class="row">
                                       <div class="col-md-9 col-lg-9">
                                       	
                                       </div>
                                        <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 20px;">
                                                
                                               <!--  <div class="input-group">
                                                    <div class="input-group-prepend"> -->

                                                    <button type="submit" id="msubmit" class="btn btn-info waves-effect waves-light" style="width: 100%">Save</button>
                                                  
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
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

            <!-- End footer -->

<script>
	
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
	 
// Single Select Placeholder
$("#select2-customize-result").select2({
    placeholder: "Select City",
    allowClear: true
});	 
	 
$("#select2-with-tags").select2({
    tags: true
});	 
	 
// Quantity Info	 
	 
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
	
	 
  });	

	 
// Nutrition Info
	 
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('#add_nut'); //Add button selector
    var wrapper = $('.nut_wrapper'); //Input field wrapper
	var spoints = $('.sub_nuts')

	
    var x = 1; //Initial field counter is 1
	var y = 1;
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append('<div class="col-md-12"><input type="text" name="nname[]" class="form-control col-md-11" placeholder="Name" required> <p class="sub_p_rem1'+x+'" id="remove_button1" align="right" style="margin-top: -35px"><button class="btn btn-danger waves-effect waves-light" type="button"><i class="ti-close"></i></button><br></p></div>'); //Add field html
			
			$(spoints).append('<div class="col-md-12 m-b-10 sub_p_rem1'+x+'"><input type="text" name="nvalue[]" class="form-control col-md-12" placeholder="Value" required> </div>'); //Add field html
			
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
	
	 
  });	
	 
	 
</script>          