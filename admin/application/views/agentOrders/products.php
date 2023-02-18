<?php 

$oid = $this->uri->segment(3);
admin_header(); ?>

 <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">

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
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb" align="right">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex no-block justify-content align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

<style type="text/css">
			
	form {
/*  width: 300px;*/
  margin: 0 auto;
  text-align: center;
  padding-top: 50px;
}

.value-button {
  display: inline-block;
  border: 1px solid #ddd;
  margin: 0px;
  width: 40px;
  height: 40px;
  text-align: center;
  vertical-align: middle;
  padding: 11px 0;
  background: #eee;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.value-button:hover {
  cursor: pointer;
}

form .decrease {
  margin-right: -4px;
  border-radius: 8px 0 0 8px;
}

form .increase {
  margin-left: -4px;
  border-radius: 0 8px 8px 0;
}

form #input-wrap {
  margin: 0px;
  padding: 0px;
}

input.number {
  text-align: center;
  border: none;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  margin: 0px;
  width: 40px;
  height: 40px;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.admin-prdct img
{
    width:80px !important;
    height:80px !important;
    border: 1px solid #d5d6d8;
    padding: 5px;
}
			
</style>          

			
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">
            <!-- ============================================================== -->
              <!-- Card -->
            <div class="card">
                
                <div class="card-body">
                    
					<div class="col-lg-12 m-b-30">
						
						<!--<form method="get" action="">
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4"></div>
							<div class="col-md-4 row">
								
									<div class="form-group col-md-8 pull-right">
										<input type="text" name="search" class="form-control" value="<? echo $this->input->get("search") ?>" required style="margin-left: 30px" placeholder="Search Products">
									</div>
									<div class="form-group col-md-4">
										<button type="submit" class="btn btn-primary btn-sm" style="margin-top: 3px;">Search</button>
									</div>	
								</form>
							</div>
						</div>-->
						

						
<!--						<h5 class="m-b-20">Accordion</h5>-->
						<!-- Accordian -->
						
									
						<div id="accordion">

	<?php

	if($oid == ""){	
		
		$search = $this->input->get("search");
		$search_value = "";
		/*if($search){
			$search_value = "and product_name like '%$search%'";
		}*/
				$cid = 0;

					$categories = $this->db->get_where("tbl_categories",array("status"=>"Active","deleted"=>0))->result();

					if(count($categories) > 0){

					$uid = $this->session->userdata("admin_id");

					$udata = $this->db->get_where("fdm_va_auths",array("id"=>$uid))->row();	
					
					foreach($categories as $cat){

					$products = $this->db->query("select * from tbl_products where status='Active' and deleted=0 and product_category='$cat->id' $search_value and assigned_to='agents' order by product_name asc")->result();


					?>	

							
							
							<div class="card m-b-5">
								<div class="card-header" id="heading<?php echo $cid ?>">
									<h5 class="mb-0">
										<a class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $cid ?>" aria-expanded="true" aria-controls="collapse<?php echo $cid ?>" style="text-decoration: none">
											<?php echo $cat->category_name ?>
										</a>
									</h5>
								</div>
								<div id="collapse<?php echo $cid ?>" class="collapse show" aria-labelledby="heading<?php echo $cid ?>" data-parent="#accordion">
								
		
									
		<div class="card-body">							
		
		<form action="<?php echo base_url("agent-products/insertOrder") ?>" method="post" enctype="multipart/form-data">							
																							
		 <?php
	
			$pkey = 0;	


			if(count($products) > 0){	

				foreach($products as $key => $pr){
					
					
					$plocation = json_decode($pr->location);

					if(in_array($udata->city,$plocation)){

					$cat = json_decode($pr->product_quantity);	  

		  ?>   							
									
								

			<div class="row">

				<div class="col-3">

					<div class="thumbnail admin-prdct" style="padding: 10px;padding-left: 50px;text-align:center;">

						<img src="<?php echo base_url().$pr->product_image ?>" class="figure-img img-fluid">
						<figcaption class="figure-caption"><?php echo $pr->product_name ?></figcaption>

					</div>

				</div>

				<div class="col-6" style="text-align:center;">
				<div class="row">								
					<div class="col-md-4 m-t-40">							
<!--						<form action="#" class="float-left label-form">-->
									<?php 
										if(count($cat->quantity) > 0){	
										$i = 0;
											foreach($cat->quantity as $qty){
									?>
										<label class="radio-inline">
											 <?php echo $qty ?>
										</label>
										
										<input type="hidden" name="category[]" value="<?php echo $qty ?>">

									<?php 
									$i++;
									}} ?>
												
			
<!--						</form>			-->
					</div>							
					<div class="col-md-4 m-t-20">
					<label>Enter Quantity</label>
							
							<input type="text" name="quantity[]" class="form-control"  value="" />
					</div>
					
					<div class="col-md-4 m-t-20">
					<label>Quantity Type</label>
							<select name="qtyType[]" class="form-control">
								
								<!--<option value="">Select Quantity</option>-->
								
								<?php foreach(json_decode($pr->qty_type) as $qType){ ?>
								
								<option value="<?php echo $qType ?>"><?php echo $qType ?></option>
								
								<?php } ?>
							</select>
							
					</div>												
					</div>						
				</div>							
											
											
							<input type="hidden" name="product_id[]" value="<?php echo $pr->id ?>">							
										
										
										
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
						
						
	<?php  }else{ ?>
		
		
<!--		<div class="card m-b-5">-->
		
		<form action="<?php echo base_url("agent-products/editOrder") ?>" method="post" enctype="multipart/form-data">							
																							
									
		<div class="card-body">

		 <?php
	
			$pkey = 0;	

		    $oProducts = $this->db->get_where("agent_orders",array("order_id"=>$oid))->result();	
				 
			if(count($oProducts) > 0){	

				foreach($oProducts as $key => $pr){

				$pros = json_decode($pr->product_id);	  

				foreach($pros as $ppp){
					
				$pData = $this->db->get_where("tbl_products",array("id"=>$ppp->productId))->row();	
		  ?>
		
			<div class="row">

				<div class="col-md-3">

					<div class="thumbnail" style="padding: 10px;padding-left: 50px">

						<img src="<?php echo base_url().$pData->product_image ?>" class="figure-img img-fluid">
						<figcaption class="figure-caption"><?php echo $pData->product_name ?></figcaption>

					</div>

				</div>
								
					<div class="col-md-3 m-t-40">							
<!--						<form action="#" class="float-left label-form">-->
									
										<label class="radio-inline">
											 <?php echo $ppp->category ?>
										</label>
										
										<input type="hidden" name="category[]" value="<?php echo $ppp->category ?>">

										<input type="hidden" name="product_id[]" value="<?php echo $ppp->productId ?>">							
			
<!--						</form>			-->
					</div>							
					<div class="col-md-2 m-t-20">
					<label>Enter Quantity</label>
							
								
					
							<input type="text" name="qty[]" class="form-control"  value="<?php echo $ppp->productQty ?>" />
					</div>
					
					<div class="col-md-2 m-t-20">
					<label>Quantity Type</label>
							<select name="qtyType[]" class="form-control">
								
								<!--<option value="">Select Quantity</option>-->
								
								<?php foreach(json_decode($pData->qty_type) as $qType){ ?>
								
								<option value="<?php echo $qType ?>" <?php echo ($qType == $ppp->qtyType) ? 'selected' : '' ?>><?php echo $qType ?></option>
								
								<?php } ?>
							</select>
							
					</div>							
																										
				</div>							
											
											
														
										
										
										
		</div>
		<?php 

			$pkey++;
			}}}
			?>

									
									
		</div>
							
							
		
		
		
		
	<?php } ?>					
						
	</div>														
	</div>	
</div>							
						<hr>
						
						
				<div class="container" id="cart">	
					
					<h3 style="margin-top: 20px;" align="center">Order Details</h3>					
																				
						<div class="row m-t-20">
						
							
						
							<div class="col-sm-12 col-md-4">
								<div class="form-group">

									<div class="col-sm-12">
									Order Date
									<div class="input-group m-t-10">
										<input type="text" class="form-control deliveryDate" name="deliveryDate" autocomplete="off" placeholder="Select Date" value="<?php echo isset($u->delivery_date) ? $u->delivery_date : '' ?>" required>
									</div>

									</div>
								</div>
							</div>							
							
							<div class="col-sm-12 col-md-4">
								<div class="form-group">

									<div class="col-sm-12">
									Order Time
									<div class="input-group m-t-10">
									
									<?php 
									$timing = isset($u->order_delivery_time) ? $u->order_delivery_time : '';	
									
									?>
									
										<select class="form-control" id="" name="deliveryTime">
										   <option value="">Select Time</option>
											<option value="morning" <?php echo ($timing == "morning") ? "selected" : "" ?>>Morning</option>
											<option value="evening" <?php echo ($timing == "evening") ? "selected" : "" ?>>Evening</option>

										</select>
									</div>

									</div>
								</div>
							</div>			
											

							<div class="col-sm-12 col-md-4">
								<div class="form-group">

									<div class="col-sm-12">
									Transaction Amount
									<div class="input-group m-t-10">
										<input type="number" id="txnAmount" class="form-control" name="txnAmount" placeholder="Transaction Amount" value="<?php echo isset($u->amount) ? $u->amount : '' ?>">
									</div>

									</div>
								</div>
							</div>	
					</div>	
					<div class="row">													
							
							<div class="col-sm-12 col-md-3">
								<div class="form-group">

									<div class="col-sm-12">
									Bank Name
									<div class="input-group m-t-10">
										<input type="text" id="txnID" class="form-control" name="bank_name" value="<?php echo isset($u->bank_name) ? $u->bank_name : '' ?>" placeholder="Bank Name">
									</div>

									</div>
								</div>
							</div>
							
							<div class="col-sm-12 col-md-3">
								<div class="form-group">

									<div class="col-sm-12">
									Transaction ID
									<div class="input-group m-t-10">
										<input type="text" id="txnID" class="form-control" name="txnID" value="<?php echo isset($u->transaction_number) ? $u->transaction_number : '' ?>" placeholder="Transaction ID">
									</div>

									</div>
								</div>
							</div> 	
	
							
							<div class="col-sm-12 col-md-3">
								<div class="form-group">

									<div class="col-sm-12">
									Transaction Date
									<div class="input-group m-t-10">
										<input type="text" class="form-control txnDate" name="txnDate" value="<?php echo isset($u->transaction_date) ? $u->transaction_date : '' ?>" autocomplete="off" placeholder="Transaction Date">
									</div>

									</div>
								</div>
							</div>
						
							<div class="col-sm-12 col-md-3">
								<div class="form-group">

									<div class="col-sm-12">
									Payment Receipt
									<div class="input-group m-t-10">
										<input type="file" id="files" class="form-control" name="files[]" multiple placeholder="Payment Receipt">
									</div>

									</div>
								</div>
							</div>
						
						</div>
						
					
				<?php if(isset($u->transaction_document)){ ?>		
					<div class="container" align="right">
						
						<a target="_blank" href="<? echo base_url('agent-products/transactiondocuments/').$u->order_id ?>" class="btn btn-info waves-effect waves-light">View Transaction Document</a>
												
					</div>
					
					
					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
					  <div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
						  <div class="modal-header" style="display: block">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Transaction Document</h4>
						  </div>
						  <div class="modal-body">
							<img src="<?php echo base_url().$u->transaction_document ?>" width="100%">
						  </div>
						  
						</div>

					  </div>
					</div>
					
					
				<?php } ?>		
						<div class="row m-t-10">
							<div class="col-md-12">
							  <div class="form-group" align="center">
							  <input type="hidden" name="order_id" value="<?php echo $oid ?>">
							  
								<button type="submit" class="btn btn-success waves-effect waves-light" style="text-align: center">Place Order</button>
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
            
          </div>  
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

            <!-- End footer -->

<script src="<?php echo base_url() ?>assets/libs/moment/moment.js"></script>

<script src="<?php echo base_url() ?>assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js"></script>
            

            <!-- End footer -->

<script type="text/javascript">
	
$(document).ready(function(){
	
	
 $('.deliveryDate').bootstrapMaterialDatePicker({ weekStart: 0, time: false,minDate: new Date() });
	
 $('.txnDate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
	
	
//$(document).ready(function(){
//	
//	$(".deliveryDate").datepicker({
//		
//		minDate : 0,
//		dateFormat : 'dd-mm-yy'
//		
//	});
//	
});	
	

$(".placeOrder").click(function(){
	
	var pid = $(this).attr("addPid");
	
	var deliveryDate = $("#deliveryDate"+pid).val();
	var deliveryTime = $(".deliveryTime"+pid).val();
	
	if(deliveryDate == ""){
		
		Swal(
		  'Error!',
		  'Please select delivery date.',
		  'error'
		);

		return false;
	}

	if(deliveryTime == ""){

		Swal(
		  'Error!',
		  'Please select delivery time.',
		  'error'
		);

		return false;
	}
	
	
	$("#product_id").val(pid);
	
	$("#cart").show();
	
	$("#accordion").hide();
	
});	
	
	
$("#confirm").on("click",function(){
	
	<?php $pcount = $this->db->query("SELECT MAX( id ) AS max FROM tbl_products")->row(); ?>
	
	var count = <?php echo $pcount->max; ?>;
	
	var pid = $("#product_id").val();
	
	for(var i = 1; i <= count; i++){
		
		if(pid == i){
			
			var price = $("#upprice"+i).val();
			var category = $("#upQty"+i).val();
			var qty = $(".qty"+i).val();
			var deliveryDate = $("#deliveryDate"+i).val();
			var deliveryTime = $(".deliveryTime"+i).val();
			var txnAmount = $("#txnAmount").val();
			var txnID = $("#txnID").val();
			var txnDate = $("#txnDate").val();
			
			if(qty < 1){
				
				Swal(
				  'Error!',
				  'Quantity Should Be Atleast 1.',
				  'error'
				);
				
				return false;
			}
			
			if(txnAmount == ""){
		
				Swal(
				  'Error!',
				  'Please enter amount .',
				  'error'
				);

				return false;
			}

			if(txnID == ""){

				Swal(
				  'Error!',
				  'Please enter transaction ID.',
				  'error'
				);

				return false;
			}
			
			if(txnDate == ""){

				Swal(
				  'Error!',
				  'Please select transaction date.',
				  'error'
				);

				return false;
			}
			
		}
	}
	
	
	
  var files = $('#files')[0].files;
  var err = $("#files").val();

 if(err==""){
   Swal(
      'Error',
      'Please Select payment receipt :)',
      'error'
    );
   return false; 
 }
  var error = '';
  var form_data = new FormData();
  for(var count = 0; count<files.length; count++)
  {
   var name = files[count].name;
   var extension = name.split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg','pdf']) == -1)
   {
     Swal(
      'Error',
      'Please Select Valid Image File :)',
      'error'
    );
     return false;
   }
   else
   {
    form_data.append("files", files[count]);
	form_data.append("pid",pid);   
	form_data.append("price",price);   
	form_data.append("category",category);   
	form_data.append("qty",qty);   
	form_data.append("deliveryDate",deliveryDate);   
	form_data.append("deliveryTime",deliveryTime);   
	form_data.append("txnAmount",txnAmount);   
	form_data.append("txnID",txnID);   
	form_data.append("txnDate",txnDate);   
   }
  }
  if(error == '')
  {
	    
	  
   $.ajax({
    beforeSend:function()
    {
//     $('#uploading').html('<button class="btn btn-info waves-effect waves-light" style="width: 100%">Uploading</button>');
    },
		
		type : "post",
		url : "<?php echo base_url("agent-products/insertOrder") ?>",
		data : form_data,
		contentType:false,
		cache:false,
		processData:false,	
//		dataType : 'json',
		success : function(data){
			
//			console.log(data);
			if(data == 1){
				
//				 Swal(
//				  'Success',
//				  'Order placed successfully',
//				  'success',
//
//				)
				
			location.reload();	
//			$(".cartCount").html(data.cartCount);	 	
				
				
			}else{
				
				Swal(
				  'Error!',
				  'Error Occured Please Try Again.',
				  'error'
				);

				
			}
			
//			if(data.status == "exist"){
//				
//				Swal(
//				  'Error!',
//				  'Already Added Into Cart.',
//				  'error'
//				);
//				
//			}
			
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
  }
	
});	
	

// Get category price 
	
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
//			$(".qty"+pid).val(1);
			
			if(data.price){
				
				$("#upprice"+pid).val(data.price);
				$("#upQty"+pid).val(cid);
				
			}
			
			if(data.dis_type == "percent"){
				
	// To update Qty			
				$("#actprice"+pid).val(data.extprice);
				
				
			}else{
				
				if(data.dis_type == "rs"){
					
					
	// To update Qty			
				$("#dPPrice"+pid).val(data.disPrice);
					
					
				}
					
			}
			
			
		},
		error : function(data){
			
			console.log(data);
		}
		
		
	});
	
});
	
			
$(".qtyplus").on("click",function(){

  var iv = $(this).attr("qty");	
  var value = parseInt($("."+iv).val(), 10);
  value = isNaN(value) ? 0 : value;
  value++;
  $("."+iv).val(value);
	
});
	
	
$(".qtyminus").on("click",function(){

  var iv = $(this).attr("qty");	
	
  if($("."+iv).val() <= 1){
	  
	  return false;
  }		
	
  var value = parseInt($("."+iv).val(), 10);
  value = isNaN(value) ? 0 : value;
  value--;
  $("."+iv).val(value);
	
});	

			
</script>			
			
			
			
 <script>

$("#city").change(function(){


	var i=$("#city").val();

	$.ajax({
		url:"<?php echo base_url();?>ajax/getAreas",
		data:{id:i},
		type:"GET",
		success:function(data){

			$("#area").html(data);
		}
	})
});	
</script>          