<?php front_inner_header() ?>

<?php

$udata = $this->db->get_where("shreeja_users",array("userid"=>$this->session->userdata("user_id")))->row();

?>


<!-- Header Section Ended -->
		
	
			
        <!-- Main Content Started -->
		
        <div class="main-content">
		
		<!-- Login Form Starts-->
		
		<h4 class="customer-head">Profile:</h4>
				<div class="profile-main">
					
					<div class="profile-pic-grid" >
						<ul class="nav nav-tabs" id="nav-tab" role="tablist">
                    		<li class="profile-pic-list"><a id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> My Profile</a></li>
                    		<li class="profile-pic-list"><a id="nav-order-tab" data-toggle="tab" href="#nav-order" role="tab" aria-controls="nav-order" aria-selected="true"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> My Orders</a></li>
                    		<li class="profile-pic-list"><a id="nav-sample-tab" data-toggle="tab" href="#nav-sample" role="tab" aria-controls="nav-sample" aria-selected="true"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Oreder Free Sample</a></li>
							<li class="profile-pic-list"><a id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="true"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Payments</a></li>
							<li class="profile-pic-list-last"><a id="nav-offer-tab" data-toggle="tab" href="#nav-offer" role="tab" aria-controls="nav-offer" aria-selected="false"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Offers</a></li>
                    	</ul>
					</div>
					
					<div class="profile-update tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						    <h4>Personal Information</h4>
						<?php echo $this->session->flashdata("err"); ?>
						<div class="profile-form">
						<form action="<?php echo base_url("home/updateProfile") ?>" method="post">

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Full Name:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="username" value="<?php echo $udata->user_name ?>" id="inputEmail3" readonly required>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Mobile Number:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="mobile" value="<?php echo $udata->user_mobile ?>" id="inputEmail3" readonly required>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Email ID:</label>
							<div class="col-sm-7 input-pad">
							  <input type="email" class="form-control" name="email" value="<?php echo $udata->user_email ?>" id="inputEmail3" readonly >
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">City:</label>
							<div class="col-sm-7 input-pad">
							  <select name="city" class="form-control select" disabled required>
								  <option value="">Select City</option>
								  
								  <?php $loc = $this->locations_model->getConsumercities(); 
									
									foreach($loc as $ll){
										
									?>
								  
								  
								  <option value="<?php echo $ll->id ?>" <?php echo ($ll->id == $udata->user_location) ? "selected" : "" ?>><?php echo $ll->location ?></option>
								  
								   <?php  } ?>
								</select>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Area:</label>
							<div class="col-sm-7 input-pad">
							  <select name="area" class="form-control select" disabled id="area" required>
								  <option value="">Select Area</option>
								<?php $areas = $this->db->get_where("tbl_areas",array("status"=>"Active"))->result();
									   foreach($areas as $a){
									?>  
									
								  <option value="<?php echo $a->id ?>" <?php echo ($udata->user_area == $a->id) ? "selected" : "" ?>><?php echo $a->area_name ?></option>
								  <?php } ?>
							  </select>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Locality:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="locality" value="<?php echo $udata->user_locality ?>" required id="inputEmail3" readonly>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">House No:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="house_no" value="<?php echo $udata->house_no ?>" required id="inputEmail3" readonly>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Landmark:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="landmark" value="<?php echo $udata->landmark ?>" required id="inputEmail3" readonly>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Current Address:</label>
							<div class="col-sm-7 input-pad">
							  	<textarea name="address" class="form-control prof" rows="5" readonly required><?php echo $udata->user_current_address ?></textarea>

							</div>
							</div>
							<div id="changeAction">
								<input type="button" value="Edit Profile" id="change" class="btn" />
							</div>	
						</form>
						</div>
						</div>
						
						<div class="tab-pane show fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
						    <!--<div class="order-butns" id="pills-tab" role="tablist">-->
						        
						    <!--    <button class="btn"><a class="nav-link active" id="pills-deliver-tab" data-toggle="pill" href="#pills-deliver" role="tab" aria-controls="pills-deliver" aria-selected="true">DELIVERY ONCE</a></button>-->
						    <!--    <button class="btn"><a class="nav-link" id="pills-subscribe-tab" data-toggle="pill" href="#pills-subscribe" role="tab" aria-controls="pills-subscribe" aria-selected="true">SUBSCRIBE</a></button>-->
						    <!--</div>-->
						    <!--<p class="deliver-pass-delivery fade show active" id="pills-deliver" role="tabpanel" aria-labelledby="pills-deliver-tab">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
						    
						    <!--<p class="deliver-pass-subscribe fade" id="pills-subscribe" role="tabpanel" aria-labelledby="pills-subscribe-tab">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>-->
						    
						    
						    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
<li class="nav-item mt-0">
    <a class="nav-link active ml-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">SUBSCRIPTION</a>
   </li>						    
						    
						    
  <li class="nav-item mt-0">
    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">DELIVERY ONCE</a>
  </li>
  
  <li class="nav-item mt-0">
    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-free" role="tab" aria-controls="pills-home" aria-selected="true">FREE SAMPLE</a>
  </li>
  
</ul>
<div class="tab-content" id="pills-tabContent">
 
 <div class="tab-pane show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  
  <div class="row">
  
             
      <div class="container table-responsive">
							  <table class="table table-striped" id="table3">
								<thead>
								  <tr>
									<th>Order ID</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Amount</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Order Date</th>
									<th>Shift</th>
									<th>Order Status</th>
									<th>Delivery Status</th>
									<th>Action</th>
									
								  </tr>
								</thead>
								<tbody>
							  <?php
	
								$orders = $this->db->query("select * from orders where payment_status='Success' and order_type='subscribe' and user_id='$udata->userid' order by id desc")->result();
								$id = 0;
									
								$cdate = date("H");

								if($cdate >= 18){
									$date = date("d-m-Y", strtotime("+ 1 day"));
								}else{
									$date = date("d-m-Y");
								}	
									
									
								if(count($orders) > 0){
									foreach($orders as $o){
										
									$orderProducts = $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result();
	
								?>
							  
								  <tr>
									<td><?php echo $o->order_id ?></td>
									<td><?php foreach($orderProducts as $key => $op){
																		
											echo $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row()->product_name." ".$op->category."<br>";		
									
										} ?>
									</td>
									<td><?php foreach($orderProducts as $op){
																		
											echo $op->qty."<br>";		
									
										} ?>
									</td>
									<td><?php echo $o->total_amount." Rs/-" ?></td>
									<td><?php echo date("d-M-Y",strtotime($o->sub_start_date)) ?></td>
									<td><?php echo date("d-M-Y",strtotime($o->sub_end_date)) ?></td>
									<td><?php echo date("d-m-Y",strtotime($o->date_of_order)) ?></td>
									<td><?php echo $o->deliveryShift ?></td>

									<td>
										<?php
											if($o->order_status == "Success"){
														
												echo '<span class="badge badge-success" style="color:white">Success</span>';
											}elseif($o->order_status == "Pending"){

												echo '<span class="badge badge-warning" style="color:white">Pending</span>';
											}elseif($o->order_status == "Cancelled"){
												echo '<span class="badge badge-danger" style="color:white">Cancelled</span>';
											}
									
										?>
										
									</td>
									<td>
										<?php
											if($o->delivery_status == "Success"){
														
												echo '<span class="badge badge-success" style="color:white">Success</span>';
											}elseif($o->delivery_status == "Pending"){

												echo '<span class="badge badge-warning" style="color:white">Pending</span>';
											}else{
												echo '<span class="badge badge-danger" style="color:white">Failed</span>';
											}
									
										?>
										
									</td>
								
									<td>
									
								<?php if($o->order_status != "Cancelled"){ ?>	
									
										<a href="<?php echo base_url("payment/generateInvoice/").$o->order_id ?>" target="_blank"><i class="fa fa-download" style="color: black"></i></a>&nbsp;
								<? } ?> 	
										<a href="<?php echo base_url("home/subsribedOrders/").$o->order_id ?>"><i class="fa fa-edit" style="color: black"></i></a>&nbsp;
										
									<?php if(strtotime($o->sub_start_date) >= strtotime($date)){ ?>	
<!--										<a href="javascript:void(0)" onClick="cancelOrder(this.id)" id="<?php echo $o->order_id ?>"><i class="fa fa-times" style="color: red"></i></a>-->
									<?php } ?>	
										
									</td>
								  </tr>
	
								  
								<?php 
									$id++;
									}} ?>  
								</tbody>
							  </table>
							</div>
				
				
			</div>	
  </div>
 
 
 
 
  <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  
  						    <div class="container table-responsive">
							  <table class="table table-striped" id="table2">
								<thead>
								  <tr>
									<th>Order ID</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Amount</th>
									<th>Order Status</th>
									<th>Delivery Status</th>
									<th>Order Date</th>
									<th>Shift</th>
									<th>Delivery Date</th>
									<th>Action</th>
								  </tr>
								</thead>
								<tbody>
							  <?php
	
								$orders = $this->db->query("select * from orders where payment_status='Success' and order_type='deliveryonce' and user_id='$udata->userid' order by id desc")->result();
									 
								if(count($orders) > 0){
									foreach($orders as $o){
										
									$orderProducts = $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result();
	
								?>
							  
								  <tr>
									<td><?php echo $o->order_id ?></td>
									<td><?php foreach($orderProducts as $op){
																		
											echo $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row()->product_name." ".$op->category."<br>";		
									
										} ?>
									</td>
									<td><?php foreach($orderProducts as $op){
																		
											echo $op->qty."<br>";		
									
										} ?>
									</td>
									<td><?php echo $o->total_amount." Rs/-" ?></td>
									<td>
										<?php
											if($o->order_status == "Success"){
														
												echo '<span class="badge badge-success" style="color:white">Success</span>';
											}elseif($o->order_status == "Pending"){

												echo '<span class="badge badge-warning" style="color:white">Pending</span>';
											}elseif($o->order_status == "Cancelled"){
												echo '<span class="badge badge-danger" style="color:white">Cancelled</span>';
											}
									
										?>
										
									</td>
									<td>
										<?php
											if($o->delivery_status == "Success"){
														
												echo '<span class="badge badge-success" style="color:white">Success</span>';
											}elseif($o->delivery_status == "Pending"){

												echo '<span class="badge badge-warning" style="color:white">Pending</span>';
											}else{
												echo '<span class="badge badge-danger" style="color:white">Failed</span>';
											}
									
										?>
										
									</td>
									
									<td><?php echo date("d-M-y",strtotime($o->date_of_order)) ?></td>
									<td><?php echo $o->deliveryShift ?></td>
									<td><?php echo date("d-M-y",strtotime($o->deliveryonce_date)) ?></td>
									
									
									<?php 
										$cdate = date("H");

										if($cdate >= 18){
											$date = date("d-m-Y", strtotime("+ 1 day"));
										}else{
											$date = date("d-m-Y");
										}
										
										
										$ddate = date("d-m-Y",strtotime($o->deliveryonce_date));
									?>
									
									<td>
									
								<?php if($o->order_status != "Cancelled"){ ?>	
									<a href="<?php echo base_url("payment/generateInvoice/").$o->order_id ?>" target="_blank"><i class="fa fa-download" style="color: black"></i></a>&nbsp;
<!--									<button class="btn btn-default change-action" onClick="cancelOrder(this.id)" id="<?php //echo $o->order_id ?>" <?php //echo (strtotime($ddate) <= strtotime($date)) ? "disabled" : "" ?>><i class="fa fa-times" style="color: red"></i> Cancel Order</button>-->
									
									<?php if((strtotime($ddate) >= strtotime($date))){ ?>
<!--									<a href="javascript:void(0)" onClick="cancelOrder(this.id)" id="<?php echo $o->order_id ?>"><i class="fa fa-times" style="color: red"></i></a>-->
									<?php }} ?>
									
									</td>
								  </tr>
								  
								<?php }} ?>  
								</tbody>
							  </table>
							</div>

	
  </div>
  
  <div class="tab-pane fade " id="pills-free" role="tabpanel" aria-labelledby="pills-home-tab">
  
  						    <div class="container table-responsive">
							  <table class="table table-striped" id="table3">
								<thead>
								  <tr>
									<th>Order ID</th>
									<th>Product Name</th>
									<th>Quantity</th>
<!--									<th>Amount</th>-->
									<th>Order Status</th>
									<th>Delivery Status</th>
									<th>Order Date</th>
									<th>Shift</th>
									<th>Delivery Date</th>
									<th>Action</th>
									
								  </tr>
								</thead>
								<tbody>
							  <?php

									
								$ford = $this->db->query("select * from tbl_free_sample_orders where order_status='Success' and user_id='$udata->userid'")->row();
									 
								if($ford){
	
								?>
							  
								  <tr>
									<td><?php echo $ford->order_id ?></td>
									<td><?php 						
											echo $this->db->get_where("tbl_products",array("id"=>$ford->product_id))->row()->product_name." ".$ford->qty;		
									
										 ?>
									</td>
									<td>1
									</td>
									<td>
										<?php
											if($ford->order_status == "Success"){
														
												echo '<span class="badge badge-success" style="color:white">Success</span>';
											}elseif($ford->order_status == "Pending"){

												echo '<span class="badge badge-warning" style="color:white">Pending</span>';
											}elseif($ford->order_status == "Cancelled"){
												echo '<span class="badge badge-danger" style="color:white">Cancelled</span>';
											}
									
										?>
										
									</td>
									<td>
										<?php
											if($ford->delivery_status == "Success"){
														
												echo '<span class="badge badge-success" style="color:white">Success</span>';
											}elseif($ford->delivery_status == "Pending"){

												echo '<span class="badge badge-warning" style="color:white">Pending</span>';
											}else{
												echo '<span class="badge badge-danger" style="color:white">Failed</span>';
											}
									
										?>
										
									</td>
									
									<td><?php echo date("d-M-y",strtotime($ford->order_date)) ?></td>
									<td><?php echo $ford->deliveryShift ?></td>
									<td><?php echo date("d-M-y",strtotime($ford->delivery_date)) ?></td>
									<td>
									
									<a href="<?php echo base_url("payment/generateInvoice/").$ford->order_id ?>" target="_blank"><i class="fa fa-download" style="color: black"></i></a>&nbsp;
									
									 </td>
								  </tr>
								  
								<?php } ?>  
								</tbody>
							  </table>
							</div>

	
  </div>
  
  
  
</div>
						</div>
						
						<div class="tab-pane show fade" id="nav-sample" role="tabpanel" aria-labelledby="nav-sample-tab">
						    
						    <p>ORDER FREE SAMPLE</p>
						    
						</div>
						
						<div class="tab-pane show fade" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
						    <h4>My Payments</h4>
						    <div class="container table-responsive">
							  <table class="table table-striped" id="table1">
								<thead>
								  <tr>
									<th>Order ID</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Amount</th>
									<th>Order Date</th>
								  </tr>
								</thead>
								<tbody>
							  <?php
	
								$orders = $this->db->query("select * from orders where payment_status='Success' and user_id='$udata->userid' order by id desc")->result();
									 
								if(count($orders) > 0){
									foreach($orders as $o){
										
									$orderProducts = $this->db->get_where("order_products",array("order_id"=>$o->order_id))->result();
	
								?>
							  
								  <tr>
									<td><?php echo $o->order_id ?></td>
									<td><?php foreach($orderProducts as $op){
																		
											echo $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row()->product_name." ".$op->category."<br>";		
									
										} ?>
									</td>
									<td><?php foreach($orderProducts as $op){
																		
											echo $op->qty."<br>";		
									
										} ?>
									</td>
									<td><?php echo $o->total_amount." Rs/-" ?></td>
									<td><?php echo $o->date_of_order ?></td>
								  </tr>
								  
								<?php }} ?>  
								</tbody>
							  </table>
							</div>

						</div>
						
						<div class="tab-pane show fade" id="nav-offer" role="tabpanel" aria-labelledby="nav-offer-tab">
						    <div class="profile-ul-section">
						        <h4>My Offers</h4>
						    </div>
						    <div class="offers-details">
					       <div class="row">
					       <?php  
							
							$date = date("Y-m-d");
							   
							$offers = $this->db->query("select * from tbl_offer_management where city='$udata->user_location' order by id desc")->result();
							
							$i = 0;   
							   
							if(count($offers)>0){	
								
							foreach($offers as $of){
								
								if(strtotime($date)  <= strtotime($of->endDate)){
								
							?>
				        
				        <div class="col-md-6">
					        
						       <div class="offers1">
						           <h3><?php echo $of->price ?> OFF* on <?php echo $this->db->get_where("tbl_products",array("deleted"=>0,"id"=>$of->product_id))->row()->product_name; ?> (<?php echo $of->qty; ?>)</h3>
						           <img src="<?php echo base_url("admin/").$of->image ?>" />
						           <div class="coupon-blog">
						               <div class="coupon-code">
						                   <li>Coupon Code for <span class="subsonce"><?php echo ($of->order_type == "subscribe") ? "Subscription" : "Delivery Once" ?></span></li>
						                   <h3><?php echo $of->promocode ?></h3>
						                   
						                   <input type="hidden" value="<?php echo $of->promocode ?>" class="copy<?php echo $of->promocode ?>">
						               </div>
						               <div class="coupon-copy">
						                   <input type="button" class="btn copy" id="<?php echo $of->promocode ?>" onClick="copyText(this.id)" value="COPY CODE" />
						               </div>
						           </div>
						           <div class="coupon-valid">
						               <div class="coupon-date">
						                   <li>Book before <?php echo date("dM Y",strtotime($of->endDate)); ?></li>
						               </div>
						               <div class="coupon-list">
						                  <li id="plus" class="view" view="view<?php echo $i ?>"><a class="show_hide" id="">+</a> <a href="javascript:void(0)" >View Details</a></li>
						               </div>
						           </div>
						           <div class="more-info" id="view<?php echo $i ?>">
						               <li><?php echo $of->description ?></li>
						           </div>
						       </div>
                           
                            </div>
                           <?php 
							$i++;
							}}} ?> 
</div>
                            </div>
						</div>
						
					</div>
					
				</div>



    <!-- Footer Section Starts -->

  <?php front_inner_footer() ?>
  
<script>
$(document).ready(function(){
    $(".more-info").hide();
	
  $(".view").click(function(){
	
	var view = $(this).attr("view");  
	  
    $("#"+view).toggle();
  });
});
</script>



<script type="text/javascript">
	
//function copyText(element) {
//  var promocode = element;
////  alert(promocode)	
//	
//	promocode.select();
//  
//	document.execCommand("copy");
//	
//	Swal(
//      'Success',
//      'Coupon Code copied to clipboard',
//      'success',
//    )
//}	
function copyText(str) {
  function listener(e) {
    e.clipboardData.setData("text/html", str);
    e.clipboardData.setData("text/plain", str);
    e.preventDefault();
  }
  document.addEventListener("copy", listener);
  document.execCommand("copy");
  document.removeEventListener("copy", listener);
	
  Swal(
      'Success',
      'Coupon Code copied to clipboard',
      'success',
    )	
	
};	
	
	
$(document).ready(function(){

	
	
//$(".copy").click(function(){
//	
//	var code = $(this).attr("id");
//	
//	var promocode = $("."+code).val();
//	
//	alert(promocode)
//	promocode.select();
//  
//	document.execCommand("copy");
//	
//	Swal(
//      'Success',
//      'Coupon Code copied to clipboard',
//      'success',
//    )
//	
//});	
	
	
	
	$("#table1").dataTable({
		
		"order": [[ 5, "desc" ]]
	     
	});
	
	$("#table2").dataTable({
		
		"order": [[ 7, "desc" ]]
	     
	});
	
	$("#table3").dataTable({
		
		"order": [[ 7, "desc" ]]
	     
	});	
	
});	

function cancelOrder(id) {
       Swal({
  title: 'Are you sure?',
  text: 'want to cancel the order!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes',
  cancelButtonText: 'No'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Order has been cancelled.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>cart/cancelOrder/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Order is safe :)',
      'success',
      
    )
  }
})
    }	
	
	
$(".cModal").click(function(){
	
	var id = $(this).attr("aid");
	
	var oid = $(this).attr("oid");
	
	$("."+id).val(oid);
	
});	
	
	
	
$("#psubmit").click(function(){
	
	var sdate = $("#start-date").val();
	var edate = $("#end-date").val();
	var oid = $(this).attr("oid");
	
	alert(oid);
	
});
	
	
	
	$("#change").click(function(){
		
		$(".form-control").removeAttr("readonly","readonly");
		$(".select").removeAttr("disabled","disabled");
		$("#changeAction").html('<input type="submit" value="Update" class="btn">');
		
		
	});	
	
	
	
			
</script>  
  
