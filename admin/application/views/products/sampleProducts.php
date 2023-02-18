<?php 
$update = $this->uri->segment(3);


admin_header(); ?>

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
                        <h4 class="page-title"><?php echo ($update) ? "Update" : "Add" ?> Sample Product</h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">Sample Products</li>
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
                           
                        <?php if($update){ 
							
							$pr = $this->db->get_where("tbl_sample_products",array("id"=>$update))->row();
							
							?>   
                           
                            <form action="<?php echo base_url() ?>products/products/updateSampleproduct/<?php echo $update ?>" method="post">
                               <!--  <div class="card-body">
                                    <h4 class="card-title">Navbar Header</h4>
                                </div> -->
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Product Name</label>
                                                    <select class="form-control" name="pid" id="product_id" required>
                                                    <option value="">Select Product</option>
                                                    <?php
														$pro = $this->products_model->allProducts();
														foreach($pro as $p){
														    
														    $loc = json_decode($p->location)[0];
														    $city = $this->db->get_where("tbl_locations",["id"=>$loc])->row()->location;
														    
													?>
                                                   
                                                   		<option value="<?php echo $p->id ?>" <?php echo ($pr->product_id == $p->id) ? "selected" : "" ?>><?php echo $p->product_name." (".$city.")" ?></option>
                                                   		
                                                   	<?php } ?>			
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Quantity</label>
                                                    
                                                     <select name="qty" id="qty" class="form-control" required>
                                                     	<option value="">Select Quantity</option>
                                                     	<option value="<?php echo $pr->qty ?>" selected><?php echo $pr->qty ?></option>
                                                     	
                                                     </select>
                                                </div>
                                            </div>

                                           
                                            <div class="col-md-3">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success" id="msubmit" style="margin-top: 5px; width: 100%"><i class="fa fa-check"></i> Update</button>
                                                        </div>
                                                </div>
                                            </div>  
                                               
                                         
                                        </div>
  
                                   
                                </div>
                            </form>
                            
                       <?php }else{ ?>     
                            
                            
                            <form action="<?php echo base_url() ?>products/products/insertSampleproduct" method="post">
                               <!--  <div class="card-body">
                                    <h4 class="card-title">Navbar Header</h4>
                                </div> -->
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Product Name</label>
                                                    <select class="form-control" name="pid" id="product_id" required>
                                                    <option value="">Select Product</option>
                                                    <?php
														$pro = $this->products_model->allConsumerproducts();
														foreach($pro as $p){
														    
														    $loc = json_decode($p->location)[0];
														    $city = $this->db->get_where("tbl_locations",["id"=>$loc])->row()->location;
													?>
                                                   
                                                   		<option value="<?php echo $p->id ?>"><?php echo $p->product_name." (".$city.")" ?></option>
                                                   		
                                                   	<?php } ?>			
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Quantity</label>
                                                    
                                                     <select name="qty" id="qty" class="form-control" required>
                                                     	<option value="">Select Quantity</option>
                                                     	
                                                     	
                                                     </select>
                                                </div>
                                            </div>

                                           
                                            <div class="col-md-3">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success" id="msubmit" style="margin-top: 5px; width: 100%"><i class="fa fa-check"></i> Save</button>
                                                        </div>
                                                </div>
                                            </div>  
                                               
                                         
                                        </div>
  
                                   
                                </div>
                            </form>
                            
                          <?php } ?>  
                            
                            
                            </div> 
                 



                </div>            



                    <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card" style="border:0px">
                            <div class="card-body">
                               <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing Sample Products</strong></p></div>
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                     
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>City</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
										   $sm = $this->db->get_where("tbl_sample_products")->result();	
                                           foreach ($sm as $u) {  
                                            
                                                $p = $this->products_model->getProduct($u->product_id);
                                                $loc = json_decode($p->location)[0];
											    $city = $this->db->get_where("tbl_locations",["id"=>$loc])->row()->location;
                                           ?> 
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $p->product_name; ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->qty ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $city ?></td>
                                                <td style="padding: 0.5rem;">
                                                    <a href="<?php echo base_url() ?>products/edit-sample-product/<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
                                                     <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="archiveFunction(this.id)"><i class="ti-trash"></i></a>&nbsp;&nbsp;

                                                </td>
                                                    
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


<script type="text/javascript">


$("#product_id").change(function(){


	var i=$("#product_id").val();

	$.ajax({
		url:"<?php echo base_url();?>products/products/getProductquantity",
		data:{id:i},
		type:"GET",
		success:function(data){

			$("#qty").html(data);
		}
	})
});	
	
	
	
$("#zero_config").dataTable();	
	
function archiveFunction(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected Sample product!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Sample product has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>products/products/delSampleproduct/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Sample product is safe :)',
      'success',
      
    )
  }
})
    }
</script>

            <!-- End footer -->