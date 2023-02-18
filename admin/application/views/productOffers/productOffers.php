<?php admin_header(); 

$id = $this->uri->segment(3);

?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">       
       
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
<?php admin_sidebar();  ?> 



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
                        <h4 class="page-title">Product Offers</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Offers</li>
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


<div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Nav Pills Tabs</h4> -->
                                <ul class="nav nav-pills m-b-30">

                                    <li class="nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="true">Product Offers</a> </li>                                   
                                   
<!--                                    <li class=" nav-item"> <a href="#navpills-8" class="nav-link" data-toggle="tab" aria-expanded="false">Products</a> </li>-->
                                                                      
                                          
                                </ul>
                                <div class="tab-content br-n pn">
                 
		<div id="navpills-1" class="tab-pane active">
		<div class="row">
			<div class="col-md-12">
			
			<? if($id){ ?>
			
				<form method="post" action="<?php echo base_url() ?>offers/updateCrossoffer" enctype="multipart/form-data">
				
				<div class="row">		
					<div class="form-group col-md-3">
					<label>City: </label>
						<select class="form-control" name="location" required>
							<option value="">Select City</option>

							<?php
							$locations = $this->locations_model->getConsumercities();

							foreach ( $locations as $ll ) {
								?>
							<option value="<?php echo $ll->id ?>" <? echo ($oo->city == $ll->id) ? 'selected' : "" ?>>
								<?php echo $ll->location ?>
							</option>
							<?php } ?>
						</select>

					</div>

					<div class="form-group col-md-3">
					<label>Offer Type: </label>
						<select class="form-control" name="offerType" id="offerType" required>
							<option value="">Select Offer Type</option>
							<option value="sameProduct" <? echo ($oo->offerType == "sameProduct") ? 'selected' : "" ?>>Same Product</option>
							<option value="crossProduct" <? echo ($oo->offerType == "crossProduct") ? 'selected' : "" ?>>Cross Product</option>
							<option value="Amount" <? echo ($oo->offerType == "Amount") ? 'selected' : "" ?>>Based on amount</option>

						</select>

					</div>
					
					<div class="col-md-6">   
						<div class="form-group">
							<label>Select Start & End Date :</label>
							<div class="input-daterange input-group" id="date-range">
								<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Start Date" autocomplete="off" value="<? echo $oo->from_date ?>" required>
								<div class="input-group-append">
									<span class="input-group-text bg-info b-0 text-white">TO</span>
								</div>
								<input type="text" class="form-control" value="<? echo $oo->to_date ?>" name="endDate" id="edate" placeholder="End Date" autocomplete="off" required/>
							</div>
						</div>
					</div>
				</div>	  
					  
						 
				<div class="row">
					<div class="form-group col-md-4">
					<label>Order Type: </label>
						<select class="form-control" name="orderType" required>
							<option value="">Select Order Type</option>
							<option value="deliveryonce" <? echo ($oo->orderType == "deliveryonce") ? 'selected' : "" ?>>Delivery Once</option>
							<option value="subscribe" <? echo ($oo->orderType == "subscribe") ? 'selected' : "" ?>>Subscription</option>

						</select>

					</div>

					<div class="form-group col-md-4" id="inProduct">
					<label>Input Product: </label>
						<select class="form-control" name="inProduct">
							<option value="">Select Product</option>

							<?php
							$products = $this->db->get_where( "tbl_products", array( "deleted" => 0 , "assigned_to" => "consumers") )->result();

							foreach ( $products as $ll ) {
								?>
							<option value="<?php echo $ll->id ?>" <? echo ($oo->inputProduct == $ll->id) ? 'selected' : "" ?>>
								<?php echo $ll->product_name ?>
							</option>
							<?php } ?>
						</select>

					</div>
					
					<div class="form-group col-md-4" id="inQty">
					<label>Input Quantity:</label>
						<input type="number" class="form-control" name="inQty" value="<? echo $oo->inputQty ?>" placeholder="Input Quantity">

					</div>
					
				</div>	

				<div class="row">
				
					<div class="form-group col-md-4" id="outProduct">
					<label>Output Product: </label>
						<select class="form-control" name="outProduct">
							<option value="">Select Product</option>

							<?php
							$products1 = $this->db->get_where( "tbl_products", array( "deleted" => 0 , "assigned_to" => "freeProduct") )->result();

							foreach ( $products1 as $ll ) {
								?>
							<option value="<?php echo $ll->id ?>" <? echo ($oo->outputProduct == $ll->id) ? 'selected' : "" ?>>
								<?php echo $ll->product_name ?>
							</option>
							<?php } ?>
						</select>

					</div>
				
					<div class="form-group col-md-4" id="outQty">
					<label>Output Quantity:</label>
						<input type="number" class="form-control" name="outQty" value="<? echo $oo->outputQty ?>" placeholder="Output Quantity">

					</div>
					<div class="form-group col-md-4" id="cartValue">
					<label>Cart Value:</label>
						<input type="number" class="form-control" name="cartValue" value="<? echo $oo->cartValue ?>" placeholder="Cart Value">

					</div>
				</div>
				
				<div class="row">
				
					<div class="form-group col-md-4">
					<label>Banner Image:</label>
						<input type="file" class="form-control" name="image">

					</div>
				
					<div class="form-group col-md-4">
					<label>Description:</label>
						<textarea class="form-control" name="description" required placeholder="Offer Description"><? echo $oo->description ?></textarea>

					</div>
					
					<input type="hidden" name="id" value="<? echo $oo->id ?>">
					<div class="form-group col-md-4" style="margin-top: 25px">
						<button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary">Submit</button>

					</div>
				</div>


				</form>

			<?  }else{ ?>
			
			
				<form method="post" action="<?php echo base_url() ?>offers/insertCrossoffer" enctype="multipart/form-data">
				
				<div class="row">		
					<div class="form-group col-md-3">
					<label>City: </label>
						<select class="form-control" name="location" required>
							<option value="">Select City</option>

							<?php
							$locations = $this->locations_model->getConsumercities();

							foreach ( $locations as $ll ) {
								?>
							<option value="<?php echo $ll->id ?>">
								<?php echo $ll->location ?>
							</option>
							<?php } ?>
						</select>

					</div>

					<div class="form-group col-md-3">
					<label>Offer Type: </label>
						<select class="form-control" name="offerType" id="offerType" required>
							<option value="">Select Offer Type</option>
							<option value="sameProduct">Same Product</option>
							<option value="crossProduct">Cross Product</option>
							<option value="Amount">Based on amount</option>

						</select>

					</div>
					
					<div class="col-md-6">   
						<div class="form-group">
							<label>Select Start & End Date :</label>
							<div class="input-daterange input-group" id="date-range">
								<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Start Date" autocomplete="off"  required>
								<div class="input-group-append">
									<span class="input-group-text bg-info b-0 text-white">TO</span>
								</div>
								<input type="text" class="form-control" name="endDate" id="edate" placeholder="End Date" autocomplete="off" required/>
							</div>
						</div>
					</div>
				</div>	  
					  
						 
				<div class="row">
					<div class="form-group col-md-4">
					<label>Order Type: </label>
						<select class="form-control" name="orderType" required>
							<option value="">Select Order Type</option>
							<option value="deliveryonce">Delivery Once</option>
							<option value="subscribe">Subscription</option>

						</select>

					</div>

					<div class="form-group col-md-4" id="inProduct">
					<label>Input Product: </label>
						<select class="form-control" name="inProduct">
							<option value="">Select Product</option>

							<?php
							$products = $this->db->get_where( "tbl_products", array( "deleted" => 0 , "assigned_to" => "consumers") )->result();

							foreach ( $products as $ll ) {
								?>
							<option value="<?php echo $ll->id ?>">
								<?php echo $ll->product_name ?>
							</option>
							<?php } ?>
						</select>

					</div>
					
					<div class="form-group col-md-4" id="inQty">
					<label>Input Quantity:</label>
						<input type="number" class="form-control" name="inQty" placeholder="Input Quantity">

					</div>
					
				</div>	

				<div class="row">
				
					<div class="form-group col-md-4" id="outProduct">
					<label>Output Product: </label>
						<select class="form-control" name="outProduct">
							<option value="">Select Product</option>

							<?php
							$products1 = $this->db->get_where( "tbl_products", array( "deleted" => 0 , "assigned_to" => "freeProduct") )->result();

							foreach ( $products1 as $ll ) {
								?>
							<option value="<?php echo $ll->id ?>">
								<?php echo $ll->product_name ?>
							</option>
							<?php } ?>
						</select>

					</div>
				
					<div class="form-group col-md-4" id="outQty">
					<label>Output Quantity:</label>
						<input type="number" class="form-control" name="outQty" placeholder="Output Quantity">

					</div>
					<div class="form-group col-md-4" id="cartValue">
					<label>Cart Value:</label>
						<input type="number" class="form-control" name="cartValue" placeholder="Cart Value">

					</div>
				</div>
				
				<div class="row">
				
					<div class="form-group col-md-4">
					<label>Banner Image:</label>
						<input type="file" class="form-control" name="image" required="">

					</div>
				
					<div class="form-group col-md-4">
					<label>Description:</label>
						<textarea class="form-control" name="description" required placeholder="Offer Description"></textarea>

					</div>
					
					<div class="form-group col-md-4" style="margin-top: 25px">
						<button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary">Submit</button>

					</div>
				</div>


				</form>
			
			
			
				
			
			
			
			
			
			<? } ?>
			


			</div>	
		</div>
		
		<hr>
		
		<div class="row">
			<div class="col-md-12">

				<div class="card" style="border: 0px">
					<div class="card-body">
						<h3 class="card-title">Offers</h3>
						<div class="table-responsive">
							<table class="table product-overview table-striped" id="zero_config5">
								<thead>
									<tr>
										<th>S.No</th>
										<th>City</th>
										<th>Offer Type</th>
										<th>Order Type</th>
										<th>Date</th>
										<th>Input product & qty</th>
										<th>Output product & qty</th>
										<th>Cart Value</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									  $i = 0;
									  $loc1 = $this->db->query("select * from tbl_product_offers order by id desc")->result();
										   if(count($loc1) > 0){
										   foreach ($loc1 as $u) {  ?>
									<tr>
										<td style="padding: 0.5rem;">
											<?php echo ++$i ?>
										</td>
										<td style="padding: 0.5rem;">
											<?php echo $this->db->get_where("tbl_locations",array("id"=>$u->city))->row()->location ?>
										</td>
										<td style="padding: 0.5rem;">
											<?php echo $u->offerType ?>
										</td>
										<td style="padding: 0.5rem;">
											<?php echo $u->orderType ?>
										</td>
										<td style="padding: 0.5rem;">
											<?php echo "Start Date : ".$u->from_date."<br>"."End Date : ".$u->to_date ?>
										</td>
										<td style="padding: 0.5rem;">
											<?php echo "Product : ".$this->db->get_where("tbl_products",array("id"=>$u->inputProduct))->row()->product_name."<br>"."Qty : ".$u->inputQty ?>
										</td>
										<td style="padding: 0.5rem;">
											<?php echo "Product : ".$this->db->get_where("tbl_products",array("id"=>$u->outputProduct))->row()->product_name."<br>"."Qty : ".$u->outputQty ?>
										</td>
										<td style="padding: 0.5rem;">
										<? if($u->cartValue){ ?>
											<i class="fa fa-rupee"></i>
											<?php echo $u->cartValue; } ?>
										</td>

										<td style="padding: 0.5rem;">

											<?php if($u->status=="Active"){ ?>
											<div class="switch">
												<input type="checkbox" data-on-color="info" soc_id="<?php echo $u->id ?>" name="charges" data-off-color="success" checked>
											</div>
											<?php  }elseif($u->status=="Inactive"){ ?>
											<div class="switch">
												<input type="checkbox" soc_id="<?php echo $u->id ?>" data-on-color="info" name="charges" data-off-color="success">
												<?php } ?>
											</div>
										</td>


										<td style="padding: 0.5rem;">
											<a href="<? echo base_url('offers/editCrossoffer/').$u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>

											<a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params" onclick="delCharges(this.id)"><i class="ti-trash"></i></a>

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
		</div>

		</div>


		
                
       </div>  


</div>
</div>
                </div>
            </div>


<?php admin_footer(); ?>

<script>
	
$(document).ready(function(){
	
	var offerType = $("#offerType").val();
	
	if(offerType == "sameProduct"){
		
		$("#inProduct").show();
		$("#inQty").show();
		
		$("#outProduct").hide();
		$("#cartValue").hide();
		
	}else if(offerType == "crossProduct"){

		$("#inProduct").show();
		$("#inQty").show();		
		$("#outProduct").show();
		
		$("#cartValue").hide();
		
	}else if(offerType == "Amount"){
		
		$("#inProduct").hide();
		$("#inQty").hide();
		
		$("#outProduct").show();
		$("#cartValue").show();
		
	}
	
	
	
});
	
	
$("#offerType").change(function(){
	
	var offerType = $("#offerType").val();
	
	if(offerType == "sameProduct"){
		
		$("#inProduct").show();
		$("#inQty").show();
		
		$("#outProduct").hide();
		$("#cartValue").hide();
		
	}else if(offerType == "crossProduct"){

		$("#inProduct").show();
		$("#inQty").show();		
		$("#outProduct").show();
		
		$("#cartValue").hide();
		
	}else if(offerType == "Amount"){
		
		$("#inProduct").hide();
		$("#inQty").hide();
		
		$("#outProduct").show();
		$("#cartValue").show();
		
	}
	
	
});	
	
	

 jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",

 });	
	
	
	
// Location starts
 

function delProduct(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this product!',
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
        url: '<?php echo base_url() ?>offers/delProduct/'+id,
        success: function(data) {
            location.reload();  
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected product is safe :)',
      'error',
      
    )
  }
})
}      


//Location ends
	

	
function delCharges(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this imaginary file!',
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
        url: '<?php echo base_url() ?>offers/delCrossoffer/'+id,
        success: function(data) {
            location.reload();  
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected item is safe :)',
      'error',
      
    )
  }
})
}      
$('#zero_config5').dataTable();
$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
	
	
  $('#zero_config5').on('switchChange.bootstrapSwitch','input[name="charges"]', function (e, state) {
        
          var soc_id = $(this).attr("soc_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>offers/offerstatus",
                        data:{id:soc_id,status:status},
                        success:function (data){
                            
                            //location.reload();
                            if(data==1){
                                Swal(
                                  'Success!',
                                  'Successfully Enabled.',
                                  'success'
                                )
                            }else{
                                Swal(
                                  'Success!',
                                  'Successfully Disabled.',
                                  'success'
                                )
                            }
                        }


                    });  
        });

	
	

</script>


           

           
           
<!-- End footer -->