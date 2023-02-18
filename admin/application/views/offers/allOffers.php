<?php admin_header(); 

$id = $this->uri->segment(3);
?>

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
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
       
   <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title"><?php echo ($id) ? "Update" : "Create" ?> Offer</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Offers</li>
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
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="margin-bottom: 0px !important">
                            <form action="<?php echo base_url() ?>offers/<?php echo ($id) ? "updateOffer" : "insertOffer" ?>" method="post" enctype="multipart/form-data">
                               <!--  <div class="card-body">
                                    <h4 class="card-title">Navbar Header</h4>
                                </div> -->
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Product</label>
                                                    <select class="form-control" required name="product" id="product_id">
                                                        <option value="">Select Product</option>
													<?php 
	
													$prId = isset($o->product_id) ? $o->product_id : "";				
													$products = $this->db->get_where("tbl_products",array("deleted"=>0,"status"=>"Active","assigned_to"=>"consumers"))->result();
													foreach($products as $pr){
													    
													    $loct = json_decode($pr->location)[0];
													    $lname = $this->db->get_where("tbl_locations",["id"=>$loct])->row()->location;
													    
													?>
                                                    	
                                                    	<option value="<?php echo $pr->id ?>" <?php echo ($prId == $pr->id) ? "selected" : "" ?>><?php echo $pr->product_name." (".$lname.")" ?></option>
                                                    
                                                    <?php } ?>

                                                    </select>                                                
                                                  </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Quantity</label>
													<select class="form-control" required name="qty" id="qty">
                                                        <option value="">Select Quantity</option>
													<?php $qty = isset($o->qty) ? $o->qty : ""; ?>	
                                                   
                                                   		<option value="<?php echo $qty ?>" <?php echo ($qty != "") ? "selected" : ""; ?>><?php echo $qty ?></option>
                                                    </select>                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Price</label>
                                                     <input type="number" step="0.01" name="price" class="form-control" placeholder="Price in RS" value="<?php echo isset($o->price) ? $o->price : ""; ?>" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">City</label>
													<select class="form-control" required name="city">
                                                        <option value="">Select City</option>
                                                        
                                                    <?php 
													$cty = isset($o->city) ? $o->city : ""; 
														
													$cities = $this->locations_model->getConsumercities(); 
														
													foreach($cities as $c){
													?>    

                                                     <option value="<?php echo $c->id ?>" <?php echo ($cty == $c->id) ? "selected" : ""; ?>><?php echo $c->location ?></option>
                                                    <?php } ?>
                                                    </select>              
                                                                                          
                                                </div>
                                            </div>
                                            
										</div>    
                                        <div class="row">
                                          
                                             <div class="col-md-3">	
												<label>Start Date: </label> 

												<div class="form-group">

													<input type="text" id="start-date" name="start_date" autocomplete="off" class="form-control text-center" placeholder="Start Date" value="<?php echo isset($o->startDate) ? $o->startDate : ""; ?>" required>

												</div>
											 </div>

											 <div class="col-md-3">	
												<label>End Date: </label> 

												<div class="form-group">

													<input type="text" id="end-date" name="end_date" autocomplete="off" class="form-control text-center" placeholder="End Date" value="<?php echo isset($o->endDate) ? $o->endDate : ""; ?>" required>

												</div>
											 </div> 
                                         
                                         	 <div class="col-md-3">
                                               
											<?php $oType = isset($o->order_type) ? $o->order_type : ""; ?>	
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Order Type</label>
													<select class="form-control" required name="orderType">
                                                        <option value="">Select Order Type</option>
														<option value="deliveryonce" <?php echo ($oType == "deliveryonce") ? "selected" : "" ?>>Delivery Once</option>
														<option value="subscribe" <?php echo ($oType == "subscribe") ? "selected" : "" ?>>Subscribe</option>
                                                    </select>                                                    
                                                </div>
                                            </div> 
                                              
                                            <div class="col-md-3">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Image</label>
                                                     <input type="file" name="image" class="form-control" <?php echo ($id) ? "" : "required" ?>>
                                                </div>
                                            </div>  	 
                                                  
										</div>
                                        <div class="row">
                                           <div class="col-md-9">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Description</label>
                                                     <textarea id="summernote" name="description" class="form-control" placeholder="Description" required><?php echo isset($o->description) ? $o->description : ""; ?></textarea>
                                                </div>
                                            </div> 
                                          
                                        	<div class="col-md-3">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                           
                                                           <input type="hidden" name="oid" value="<?php echo isset($o->id)?$o->id:""; ?>">
                                                           
                                                            <button type="submit" class="btn btn-success" id="msubmit" style="margin-top: 5px; width: 100%"><i class="fa fa-check"></i> <?php echo ($id) ? "Update" : "Save" ?></button>
                                                        </div>
                                                </div>
                                            </div>
                                  			
                                  		</div>
                                   
                                </div>
                            </form>
                            
                            </div> 
                 



                </div>            



                    <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card" style="border:0px">
                            <div class="card-body">
                               <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing Offers</strong></p></div>
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                     
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Promo Code</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>City</th>
                                                <th>Order Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                           foreach ($offers as $u) {  ?> 
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->promocode ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_products",array("id"=>$u->product_id,"status"=>"Active","deleted"=>0))->row()->product_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->qty ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->price." Rs/-" ?></td>
                                                <td style="padding: 0.5rem;"><?php echo date("d-M-y",strtotime($u->startDate)); ?></td>
                                                <td style="padding: 0.5rem;"><?php echo date("d-M-y",strtotime($u->endDate)); ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_locations",array("id"=>$u->city,"status"=>1,"deleted"=>0))->row()->location ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->order_type ?></td>
                                                
                                                <td style="padding: 0.5rem;">
                                                    <a href="<?php echo base_url() ?>offers/editOffer/<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
                                                     <a href="javascript:void(0)" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="archiveFunction(this.id)"><i class="ti-trash"></i></a>&nbsp;&nbsp;

                                                </td>
                                                <div class="rename">
                                                </div>    
                                            </tr>
                                     <?php  
                                    
                                       } ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>





            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

<script>


	

	
	
	
    $("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
    $('#zero_config').DataTable(); 



</script>
<script type="text/javascript">

$("#product_id").change(function(){


	var i=$("#product_id").val();

	$.ajax({
		url:"<?php echo base_url();?>offers/getProductquantity",
		data:{id:i},
		type:"GET",
		success:function(data){

			$("#qty").html(data);
		}
	})
});	

$(document).ready(function(){
	
	$("#summernote").summernote({
		height: 100,
		toolbar: [
			[ 'style', [ 'style' ] ],
			[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
			[ 'fontname', [ 'fontname' ] ],
			[ 'fontsize', [ 'fontsize' ] ],
			[ 'color', [ 'color' ] ],
			[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
			[ 'table', [ 'table' ] ],
			[ 'insert', [ 'link'] ],
			[ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		]
	});

	$('#start-date').datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate : 0,
			dateFormat: "dd-mm-yy",
		});

	$('#end-date').datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate : 0,
			dateFormat: "dd-mm-yy",
	});
	
});	
	

function archiveFunction(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected offer!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Offer has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>offers/delOffer/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Offer is safe :)',
      'success',
      
    )
  }
})
    }
</script>

            <!-- End footer -->