<?php front_inner_header() ?>

<?php

$udata = $this->db->get_where("shreeja_users",array("userid"=>$this->session->userdata("user_id")))->row();

?>
<style>
.profile-form .form-control1 {
    background: none;
    border: none;
    border-bottom: 1px solid black;
    border-radius: 0px;
    color: black;
    font-size: 13.5px;
    height: 35px;
	width: 100%;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    		<li class="profile-pic-list"><a id="nav-sample-tab" data-toggle="tab" href="#nav-sample" role="tab" aria-controls="nav-sample" aria-selected="true"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Order Free Sample</a></li>
							<li class="profile-pic-list"><a id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="true"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Payments</a></li>
							<li class="profile-pic-list"><a id="nav-offer-tab" data-toggle="tab" href="#nav-offer" role="tab" aria-controls="nav-offer" aria-selected="false"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Offers</a></li>
							<li class="profile-pic-list"><a id="nav-ref-tab" data-toggle="tab" href="#nav-ref" role="tab" aria-controls="nav-ref" aria-selected="false"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Refer & Earn</a></li>
							<li class="profile-pic-list"><a id="nav-ref-tab" data-toggle="tab" href="#nav-bank" role="tab" aria-controls="nav-ref" aria-selected="false"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Bank Details</a></li>
                   			<li class="profile-pic-list-last"><a id="nav-ref-tab" href="<?php echo base_url("admin/assets/front/") ?>assets/pdf/TandC-SMMPCL.pdf" target="_blank"><i class="fas fa-arrow-right">&nbsp;&nbsp;&nbsp; </i> Terms & Conditions</a></li>
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
							  <input type="text" class="form-control1" name="mobile" value="<?php echo $udata->user_mobile ?>" id="inputEmail3" readonly required>
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
															
											if(json_decode($op->product_data)){
											   
											   $pdata = json_decode($op->product_data);

											}else{

											  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row();	   
											}
									
											echo $pdata->product_name." ".$op->category."<br>";		
									
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
																		
											if(json_decode($op->product_data)){
											   
											   $pdata = json_decode($op->product_data);

											}else{

											  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row();	   
											}
									
											echo $pdata->product_name." ".$op->category."<br>";		
									
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
									
									if(json_decode($ford->product_data)){
											   
									   $pdata = json_decode($ford->product_data);

									}else{

									  $pdata = $this->db->get_where("tbl_products",array("id"=>$ford->product_id))->row();	   
									}
	
								?>
							  
								  <tr>
									<td><?php echo $ford->order_id ?></td>
									<td><?php 						
											echo $pdata->product_name." ".$ford->qty;		
									
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
						    
						    <!--<p>ORDER FREE SAMPLE</p>-->
						    
						    
						    	<?php
						    	
						$sordChk = $this->db->get_where("tbl_free_sample_orders",array("user_id"=>$this->session->userdata("user_id"),"order_status"=>"Success"))->num_rows();

                    	if($sordChk == 1){
                    
                    		$oc = "You have already requested for “Free sample”, will deliver you shortly.";
                    // 		$sfproducts = "";
                    
                    	}else{
                    		
                    // 		$sfproducts = $this->db->get_where("tbl_sample_products",array("status"=>"Active"))->result();
                    		$oc = "";
                    	}    	
                    
                        if ($oc != "") {
                        
                        ?>
                            <div align="center" class="sample-order">
                        
                                <div class="alert alert-success" role="alert">
                                    <p><?php echo $oc ?></p>
                                </div>
                        
                            </div>
                        <?php
                        
                        } else {
                        
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
                        
                                        $categories = $this->db->get_where("tbl_categories", array("status" => "Active", "deleted" => 0))->result();
                        
                                        if (count($categories) > 0) {
                        
                                            foreach ($categories as $cat) {
                        
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
                        
                        
                                                        if (count($sproducts) > 0) {
                        
                                                            $uid = $this->session->userdata("user_id");
                                                            $udata = $this->db->get_where("shreeja_users", array("userid" => $uid))->row();
                        
                                                            foreach ($sproducts as $key => $pr) {
                        
                                                                $plocation = json_decode($pr->location);
                                                                $uloc = isset($udata->user_location) ? $udata->user_location : "";
                                                                if (in_array($uloc, $plocation)) {
                        
                                                        ?>
                        
                        
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                                                                <div class="row">
                                                                                    <figure class="figure">
                                                                                        <img src="<?php echo base_url("admin/") . $pr->product_image ?>" class="figure-img img-fluid" />
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
                                                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4"><a href="<?php echo base_url("cart/sampleOrder/") . $prod->sid[$key] ?>" class="btn mt-3 sample-order-btn">ORDER</a></div>
                                                                        </div>
                        
                                                                    </div>
                        
                                                            <?php
                        
                        
                                                                    $pkey++;
                                                                }
                                                            }
                                                        } else {
                        
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
                                            }
                                        }
                        
                                        ?>
                        
                        
                        
                        
                                    </div>
                                </div>
                        
                            </div>
                        <?php } ?> 
						    
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

						<div class="tab-pane show fade" id="nav-bank" role="tabpanel" aria-labelledby="nav-offer-tab">
						    <div class="profile-ul-section">
						        <h4>Bank Details</h4>
						        <div class="merror"></div>
						    </div>
						<div class="profile-form">
						<form id="fileinfo" enctype="multipart/form-data" method="post">

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Account Holder Name:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="account_holder_name" value="<?php echo $udata->account_holder_name ?>" id="inputEmail3" placeholder="Account Holder Name" <?php echo ($udata->account_holder_name != "") ? 'readonly' : '' ?> required>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Account Number:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control1" name="account_number" value="<?php echo $udata->account_number ?>" id="inputEmail3" placeholder="Account Number" <?php echo ($udata->account_holder_name != "") ? 'readonly' : '' ?> required>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">IFSC Code:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="ifsc_code" value="<?php echo $udata->ifsc_code ?>" id="inputEmail3" placeholder="IFSC Code" <?php echo ($udata->account_holder_name != "") ? 'readonly' : '' ?> >
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Bank Name:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="account_bank_name" value="<?php echo $udata->account_bank_name ?>" required id="inputEmail3" placeholder="Bank Name" <?php echo ($udata->account_holder_name != "") ? 'readonly' : '' ?>>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Branch Name:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="branch_name" value="<?php echo $udata->branch_name ?>" id="inputEmail3" placeholder="Branch Name" <?php echo ($udata->account_holder_name != "") ? 'readonly' : '' ?>>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Mobile Number:</label>
							<div class="col-sm-7 input-pad">
							  <input type="text" class="form-control" name="account_mobile_number" value="<?php echo $udata->account_mobile_number ?>" id="inputEmail3" placeholder="Mobile Number" <?php echo ($udata->account_holder_name != "") ? 'readonly' : '' ?>>
							</div>
							</div>
							
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Passbook:</label>
							<div class="col-sm-7 input-pad">
							  <input type="file" class="form-control" name="bank_passbook">
							</div>
							</div>
							
							</div>
							<div>
							 	<input type="hidden" name="uid" value="<? echo $udata->userid ?>">           
						   		<input type="hidden" name="ref" value="web">
								<input type="submit" value="Update" <?php echo ($udata->account_holder_name != "") ? 'disabled' : '' ?> class="btn" />
							</div>	
						</form>
						</div>
																	
						<div class="tab-pane show fade" id="nav-ref" role="tabpanel" aria-labelledby="nav-sample-tab">
						    
						    <div class="row">
						    	
						    	<div class="col-md-6">
						    		
						    		<h4>Share On</h4>
						    		<? $actual_link = base_url('home/selectCity/').$udata->referral_id;
									?>
									<ul style="display: flex">
										<li><a href="https://www.facebook.com/sharer/sharer.php?u=<? echo $actual_link ?>&amp;src=sdkpreparse" target="_blank" style="color: black;margin-right: 18px;"><i class="fa fa-facebook-f fa-2x"></i></a></li>
										<li><a href="https://twitter.com/intent/tweet?text=<? echo $actual_link ?>" target="_blank"  style="color: black;margin-right: 18px;"><i class="fa fa-twitter fa-2x"></i></a></li>
										<li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<? echo $actual_link ?>" target="_blank" style="color: black;margin-right: 18px;"><i class="fa fa-2x fa-linkedin"></i></a></li>
										<li style="font-size: 23px;"><a href="https://api.whatsapp.com/send?phone=91<? echo $udata->user_mobile ?>&amp;text=<? echo $actual_link ?>" target="_blank" style="color: black;margin-right: 18px;"><i class="fa fa-2x fa-whatsapp"></i></a></li>
										<li style="font-size: 23px;"><a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=&su=Shreeja Milks&body=Click here to install Shreeja Milk - <? echo $actual_link ?>&ui=2&tf=1&pli=1" target="_blank" style="color: black;margin-right: 10px;"><i class="fa fa-2x fa-google"></i></a></li>
									</ul>
						    		
						    	</div>
						    	
						    	<div class="col-md-3">
						    		<h4>Referal Code</h4>
						    		<p style="background-color: lightgray;padding: 10px;text-align: center;border-radius: 5px;cursor: pointer" data-toggle="tooltip" title="copy" onClick="copyRText(<? echo $udata->referral_id ?>)"><strong><? echo $udata->referral_id ?></strong></p>
						    	</div>
						    </div>
						    
						</div>
						
						
						
					</div>
					
				</div>



    <!-- Footer Section Starts -->

  <?php front_inner_footer() ?>
  
<script>
	
$("#fileinfo").on("submit",function(e){
	e.preventDefault();
	var form_data = new FormData($("#fileinfo")[0]);
	$.ajax({
		type : "POST",
		url : "<?php echo base_url("home/updateAccountdetails") ?>",
		data: form_data,
		cache: false,
		contentType: false,
		enctype: 'multipart/form-data',
		processData: false,
		dataType:"json",
		beforeSend : function(){			
//				$('.mloader').show();
//				$("#iSubmit").hide();
		},
		success : function(data){
//				$(".merror").slideUp();	
			if(data.status){
				$(".merror").html('<div class="alert alert-success">'+data.data+'</div>');

				Swal(
				  'Success',
				  data.data,
				  'success'
				);
				setTimeout(function(){location.reload()},3000);

			}else{
				Swal(
				  'Error',
				  data.data,
				  'error'
				);
				$(".merror").html('<div class="alert alert-danger">'+data.data+'</div>');
			}
			console.log(data);

		},
		error : function(jq,txt,error){
			console.log(jq);
			$(".merror").html('<div class="alert alert-danger">'+error+'</div>');
		}

	});

});	
	
	
$(document).ready(function(){
    $(".more-info").hide();
	
  $(".view").click(function(){
	
	var view = $(this).attr("view");  
	  
    $("#"+view).toggle();
  });
});
	
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
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
	
function copyRText(str) {
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
      'Referral Code copied to clipboard',
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
  
