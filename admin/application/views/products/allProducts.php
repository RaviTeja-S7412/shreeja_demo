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
                        <h4 class="page-title">All Products</h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">All Products</li>
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
                                  



                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card" style="border:0px">
                            <div class="card-body">
                               <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing Products</strong></p></div>
                               <a href="<?php echo base_url("products/create-product") ?>" class="btn btn-info btn-rounded waves-effect waves-light" style="margin-bottom: 10px">Create Product</a>
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                     
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Product ID</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>GST</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Assigned To</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
										   
 										   $pro = $this->products_model->allProducts();
										  						
                                           foreach ($pro as $u) {  
										  	
											   $categories = json_decode($u->product_quantity);
											
											?> 
                                           <?php if($u->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->product_id ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->product_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_categories",array("id"=>$u->product_category))->row()->category_name; ?>
                                                <td style="padding: 0.5rem;">Quantity:
                                                	<?php foreach($categories->quantity as $qty){
												
														echo $qty.", ";
												
														} 
													?>
                                              		<br>
                                              		Price :
                                              		<?php
														foreach($categories->price as $price){
															
															echo $price." Rs, ";
														}
																	
													?>				
                                               </td>
                                               
                                                <td style="padding: 0.5rem;"><?php echo $u->gst_charges." %" ?></td>
                                               
                                                <td style="padding: 0.5rem;"><?php 
																	
												foreach(json_decode($u->location) as $loc){
													
													echo $this->db->get_where("tbl_locations",array("id"=>$loc))->row()->location."<br>"; 
													
												}
												?>
                                                </td>
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
                                                
                                                <td style="padding: 0.5rem;"><label class="badge badge-success" style="font-size: 12px"><?php echo strtoupper($u->assigned_to) ?></label></td>
                                                
                                                <td style="padding: 0.5rem;">
                                                    <a href="<?php echo base_url() ?>products/edit-product/<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
                                                     <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="archiveFunction(this.id)"><i class="ti-trash"></i></a>

                                                </td>  
                                                  
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
                    <!-- Column -->
                </div>
                
                
                
                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
          
			</div>
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
                        url:"<?php echo base_url();?>products/products/productstatus",
                        data:{id:nav_id,status:status},
                        success:function (data){
                            location. reload(true);
                        }

                    });  
        });



</script>
<script type="text/javascript">

$(".menu_icon").on("change",function(){

  var menu_id = $(this).attr("menu_id");
  $("#menu_icon").val(menu_id);


});

$(".main_icon").on("change",function(){

  var main_id = $(this).attr("main_id");
  $("#main_icon").val(main_id);


});



function archiveFunction(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected product!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected product has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>products/products/delProduct/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected product is safe :)',
      'success',
      
    )
  }
})
    }
</script>

            <!-- End footer -->