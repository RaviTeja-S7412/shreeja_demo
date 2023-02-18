<?php admin_header(); 

date_default_timezone_set('Asia/Kolkata');

$udata = $this->db->get_where("shreeja_users",array("userid"=>$doo->user_id,"user_status"=>0))->row();

$orderProducts = $this->db->get_where("order_products",array("order_id"=>$doo->order_id))->result();
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
                        <h4 class="page-title">
<!--
                          <a href="<?php echo base_url() ?>users/create-user">	
							<button class="btn btn-success waves-effect waves-light">Create User</button>
						  </a>	
-->
                        </h4>
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
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>agent-orders/subscribed-orders">Subscribed Orders</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">View Order</li>
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
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                       
                       <h4 class="card-title">User Information</h4>
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="<?php echo base_url() ?>assets/images/users/1.jpg" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $udata->user_name ?></h4>
                                    <h6 class="card-subtitle"><?php echo $udata->user_email ?></h6>
                                    <div class="row text-center justify-content-md-center">
                                        <?php echo $udata->user_mobile ?>
                                    </div>
                                </center>
                            </div>
						</div>
                  
                   </div>
                   
                   <div class="col-lg-8 col-xlg-3 col-md-7">
                  	 
                   <h4 class="card-title">Order Information</h4>
                   	 <div class="card">
                        <div class="card-body">
                                
                            <table class="table no-border">
                                <tbody>
                                    <tr>
                                        <td>Order ID</td>
                                        <td class="font-medium"><?php echo $doo->order_id ?></td>
                                    </tr>
                                    <tr>
                                        <td>Product Name</td>
                                        <td class="font-medium">
                                        	
                                        	<?php
												foreach($orderProducts as $pn){
													
													echo $this->db->get_where("tbl_products",array("id"=>$pn->product_id))->row()->product_name.", ";
													
												}									
											?>	
                                        	
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quantity (In ML)</td>
                                        <td class="font-medium">
                                        	<?php
												foreach($orderProducts as $pn){
													
													echo $pn->category.", ";
													
												}									
											?>
                                        	
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Quantity</td>
                                        <td class="font-medium">
                                        	<?php
												foreach($orderProducts as $pn){
													
													echo $pn->qty.", ";
													
												}									
											?>
                                        	
                                        	
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Total Amount</td>
                                        <td class="font-medium"><?php echo $doo->total_amount." Rs/-" ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Transaction ID</td>
                                        <td class="font-medium"><?php echo $doo->txn_id ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Subsribtion Start Date</td>
                                        <td class="font-medium"><?php echo date("d-M-y",strtotime($doo->sub_start_date)) ?></td>
                                    </tr> 
                                    
                                    <tr>
                                        <td>Subsribtion End Date</td>
                                        <td class="font-medium"><?php echo date("d-M-y",strtotime($doo->sub_end_date)) ?></td>
                                    </tr>                                                                                                           
                                    <tr>
                                        <td>Delivery Address</td>
                                        <td class="font-medium"><?php echo nl2br($doo->shipping_address) ?></td>
                                    </tr>                                    
                                    <tr>
                                        <td>Payment Status</td>
                                        <td class="font-medium"><span class="badge badge-success"><?php echo $doo->payment_status ?></span></td>
                                    </tr>
                                <?php  
									if($doo->delivery_status == "Success"){
								?>	    
                                    
                                    <tr>
                                        <td>Delivery Status</td>
                                        <td class="font-medium">
                                        	<?php  
											   		if($doo->delivery_status == "Success"){
														
														echo '<span class="badge badge-success" style="color:white">Success</span>';
													}
											?>
                                        	
                                        </td>
                                    </tr>                                                                        
                                <?php } ?>    
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
				  </div>	
                    <!-- Column -->
                </div>
                
                
                
    <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Order ID</th>
                                                <th>Delivery Date</th>
                                                <th>Pause Status</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 1;
											
										   $date = date("Y-m-d");	
											
                                           foreach ($soo as $u) { 
											  
                                            $ddate = date("Y-m-d",strtotime($u->delivery_date));
											   
											   
                                           ?> 

                                            <tr>
												<td style="padding: 0.5rem;"><?php echo $i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->order_id ?></td>
                                                <td style="padding: 0.5rem;"><?php echo date("d-M-y",strtotime($u->delivery_date)); ?></td>
                                                <td style="padding: 0.5rem;" align="center"><?php echo ($u->pause_status == "Inactive") ? '<span class="badge badge-success">Inactive</span>' : '<span class="badge badge-danger">Active</span>' ?></td>
                                                <td style="padding: 0.5rem;" align="center"><?php  
											   		if($u->deliver_status == "Success"){
														
														echo '<span class="badge badge-success" style="color:white">Success</span>';
													}elseif($u->deliver_status == "Pending"){
														
														echo '<span class="badge badge-warning" style="color:white">Pending</span>';
													}elseif($u->deliver_status == "Failed"){
														echo '<span class="badge badge-danger" style="color:white">Failed</span>';
													}else{
														
														echo $u->deliver_status;
													}   
												?></td>
                                                <td style="padding: 0.5rem;" align="center">
                                                   
                                            <?php
												if($date > $ddate || $u->pause_status == "Active"){
											?>
                                                    <a href="javascrip:void(0)" class="text-inverse p-r-10"><i class="fas fa-times" style="color: red"></i></a>
                                                	
                                            <?php }else{ ?>
                                               	
                                                    <a href="javascrip:void(0)" class="text-inverse p-r-10 getOid" data-toggle="modal" data-target="#myModal<?php echo $i; ?>" soid="sordid<?php echo $u->id ?>" id="<?php echo $u->id ?>"><i class="fas fa-edit"></i></a>
                                               	    	
                                               	    	    	
                                            <?php } ?>   	    	    	    	    	
                                                	
                                                </td>
                                                
						<!-- Modal -->
						<div id="myModal<?php echo $i; ?>" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<h4 class="modal-title" align="center">Update Status</h4>
							  </div>
							  <div class="modal-body">
								<form method="post" action="<?php echo base_url("agent-orders/updateSubscribedeliverystatus") ?>">

									<div class="form-group">

										<select class="form-control" name="deliveryStatus" id="dstatus" required>

											<option value="">Select Delivery Status</option>
											<option value="Pending">Pending</option>
											<option value="Success">Success</option>
<!--
											<option value="Cancelled">Cancelled</option>
											<option value="other">Other</option>
-->

										</select>

									</div>

									<div class="form-group" id="ostatus" style="display: none">

										<input type="text" name="ostatus" placeholder="Delivery Status" class="form-control">

									</div>

									<div class="form-group">
                                           
                                       <input type="hidden" name="sordid" class="sordid<?php echo $u->id ?>" value="<?php echo $u->id ?>">           
                                       <input type="hidden" name="oid" value="<?php echo $u->order_id ?>">           
                                       <button type="submit" class="btn btn-success" style="margin-top: 5px; width: 50%">Update</button>
										
									</div>
								</form>	

							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>

						  </div>
						</div>
                                                

                                            </tr>
                                     <?php  
                                    $i++;
                                       }
                                     ?> 
                                           
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
$("#zero_config").DataTable();

$("#dstatus").change(function(){
	
	var dstatus = $("#dstatus").val();
	
	if(dstatus == "other"){
		
		$("#ostatus").show();
		
	}else{
		
		$("#ostatus").hide();
		
	}
	
});
	
$("#zero_config").on("click",".getOid",function(){
	
	var oid = $(this).attr("id");
	var soid = $(this).attr("soid");
	
	$("."+soid).val(oid);
	
});
	
	
</script>
            
            

          
            
            

            <!-- End footer -->