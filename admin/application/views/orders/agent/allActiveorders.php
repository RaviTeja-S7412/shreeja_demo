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
                                    <li class="breadcrumb-item active" aria-current="page">All Active Orders</li>
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
                    <div class="col-lg-12">
                       
                       
                       <div class="row">   
						  <div class="col-md-3">   
							<div class="form-group">
								<label>Select Date :</label>
								<div class="input-group">
									<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Select Date" autocomplete="off"  required>
								</div>
							</div>
						  </div>
						 
				      	  <div class="col-md-3">   
							<div class="form-group">
								<label>Shift :</label>
								<div class="form-group">
									
									<select name="shift" id="shift" class="form-control">
										
										<option value="">Select Shift</option>
										<option value="morning">Morning</option>
										<option value="evening">Evening</option>
										
									</select>
									
								</div>
							</div>
						  </div>	
				      	
				          <div class="col-md-3">   
							<div class="form-group">
								<label>City :</label>
								<div class="form-group">
									
									<select name="city" id="city" class="form-control">
										
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
				      
					      <div class="col-md-3">
					      	
					      	<button id="filter" type="button" class="btn btn-info waves-effect waves-light m-t-30">Submit</button>
					      	
					      </div> 
						      
					   </div>
                       
                       
                       
                       
                       
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive zero_config">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Item Name</th>
                                                <th>Item Qty</th>
                                                <th>Shift</th>
                                                <th>Delivery Address</th>
                                                <th>Consumer Address</th>
                                                <th>Order Type</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           /*$i = 1;

										   $date = date("Y-m-d",strtotime("+1 day"));

                                           foreach ($doo as $u) {
											   
											if($u->order_type == "deliveryonce"){
												
												$ddate = date("Y-m-d",strtotime($u->deliverydate));
												
											}elseif($u->order_type == "freesample"){
												
												$ddate = date("Y-m-d",strtotime($u->deliverydate));
												
											}elseif($u->order_type == "subscribe"){
												
												$sdate = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u->order_id,"delivery_date"=>$date,"pause_status"=>"Inactive","deliver_status"=>'Pending'))->row();
												
												$ddate = date("Y-m-d",strtotime($sdate->delivery_date));

												
											}
											   
											   
											if($ddate == $date){   
											  
										   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	
												
											$ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
											$uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;

											$area = isset($uarea) ? $uarea : $udata->areanotlisted;
												
												
											$orderpro =	$this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();
											$oop =	$this->db->get_where("order_products",array("order_id"=>$u->order_id,"orderRef"=>"offer"))->row();	
                                            */
                                           ?> 

<!--
                                            <tr>
												<td style="padding: 0.5rem;"><?php //echo $i ?></td>
                                                <td style="padding: 0.5rem;"><?php //echo $u->order_id ?></td>
                                                <td style="padding: 0.5rem;"><?php //echo $udata->user_name ?></td>
                                                <td style="padding: 0.5rem;"><?php //echo $udata->user_mobile ?></td>
-->
                                                
                                           <?php
											   
											  // if($u->order_type == "freesample"){
											?>	   
											
<!--
                                                <td style="padding: 0.5rem;"><?php 
												  /* $pdata1 = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"assigned_to"=>"consumers"))->row(); 
			  
											   	   echo $pdata1->product_name." ".$u->qty.", <br>"; */ ?>
                                               
                                               </td>
                                                <td style="padding: 0.5rem;">1</td>
-->
												   
											<?	   
											 //  }else{
											   ?>
                                                     
<!--                                                <td style="padding: 0.5rem;">-->
                                                
                                                	<?php 
											   
												   
											   		/*	foreach($orderpro as $op){
															
															$pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row(); 
			  												
																									   			
															if($op->orderRef != "offer"){
																echo $pdata->product_name." ".$op->category.", <br>"; 
															}
													
														}
												   
												   		if($oop->orderRef == "offer"){
															$pdata = $this->db->get_where("tbl_products",array("id"=>$oop->product_id))->row(); 

															if(strtotime($date) == strtotime($u->sub_start_date) || $u->order_type == "deliveryonce"){

																echo $pdata->product_name." ".$oop->category.", <br>";
															}
														}*/
													
													?>
                                                	
<!--
                                                </td>
                                                
                                                <td style="padding: 0.5rem;">
-->
                                                
                                                	<?php 
											   
//											   			foreach($orderpro as $op){
//															if($op->orderRef != "offer"){	
//																echo $op->qty.", <br>"; 
//															}
//														}
//												   
//												   
//												   	if($oop->orderRef == "offer"){
//												   		if(strtotime($date) == strtotime($u->sub_start_date) || $u->order_type == "deliveryonce"){
//
//															echo $oop->qty.", <br>";
//														}
//													}
													
													?>
                                                	
<!--                                                </td>-->
                                            <? //} ?>    
<!--
                                                <td style="padding: 0.5rem;"><?php //echo $u->deliveryShift ?></td>
                                                <td style="padding: 0.5rem;"><?php //echo nl2br($u->shipping_address) ?></td>
                                                <td style="padding: 0.5rem;"><?php //echo $udata->house_no."<br>".$udata->landmark."<br>".$udata->user_current_address."<br>".$area."<br>".$ucity; ?></td>
                                                <td style="padding: 0.5rem;"><?php //echo $u->order_type ?></td>
                                                <td style="padding: 0.5rem;"><?php //echo $ddate ?></td>
                                               
                                                <td style="padding: 0.5rem;" align="center">
                                                <?php	
											   
//											   if($u->order_type == "subscribe"){
//												   
//												    $sstatus = isset($sdate->deliver_status) ? $sdate->deliver_status : ""; 
//													if($sstatus == "Success"){
//														
//														echo '<span class="badge badge-success" style="color:white">Success</span>';
//													}elseif($sstatus == "Pending"){
//														
//														echo '<span class="badge badge-warning" style="color:white">Pending</span>';
//													}else{
//														echo '<span class="badge badge-danger" style="color:white">Failed</span>';
//													}
//												   
//											   }else{
//													
//												   
//											   		if($u->delivery_status == "Success"){
//														
//														echo '<span class="badge badge-success" style="color:white">Success</span>';
//													}elseif($u->delivery_status == "Pending"){
//														
//														echo '<span class="badge badge-warning" style="color:white">Pending</span>';
//													}else{
//														echo '<span class="badge badge-danger" style="color:white">Failed</span>';
//													}
//												 
//											   }
												
												?>
                                               </td>
                                                <td style="padding: 0.5rem;" align="center">
                                                    <a href="javascrip:void(0)" class="text-inverse p-r-10 getOid" orderType="<?php //echo $u->order_type ?>" soid="<?php //echo isset($sdate->id) ? $sdate->id : ""; ?>" id="<?php //echo $u->order_id ?>"><i class="fas fa-edit"></i></a>
                                                	
                                                </td>
                                                

                                                

                                            </tr>
-->
                                            
                                            
                                            
                                            
                                     <?php  
//                                    $i++;
//                                       }}
                                     ?> 
                                           
                                        </tbody>
                                    </table>
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                
                                
                                <div class="table-responsive zero_config1" style="display: none">
								   <table class="table product-overview table-striped" id="zero_config1">
										<thead>
											<tr>
												<th>S.No</th>
												<th>Order ID</th>
												<th>Name</th>
												<th>Mobile</th>
												<th>Item Name</th>
												<th>Item Qty</th>
												<th>Delivery Address</th>
												<th>Consumer Address</th>
												<th>Order Type</th>
												<th>Shift</th>
												<th>Delivery Date</th>
												<th>Delivery Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>

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


<div id="myModal<?php //echo $i; ?>" class="modal fade" role="dialog">
						  <div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header">
								<h4 class="modal-title" align="center">Update Status</h4>
							  </div>
							  <div class="modal-body">
							  
								<div class="danger"></div>
								<form method="post" action="<?php echo base_url("agent-orders/updateActivedeliverystatus") ?>">

									<div class="form-group">

										<select class="form-control dstatus" name="deliveryStatus" id="" required>

											<option value="">Select Delivery Status</option>
											<option value="Pending">Pending</option>
											<option value="Success">Success</option>
<!--											<option value="Cancelled">Cancelled</option>-->
<!--											<option value="other">Other</option>-->

										</select>

									</div>

<!--
									<div class="form-group ostatus" id="" style="display: none">

										<input type="text" name="ostatus" placeholder="Delivery Status" class="form-control">

									</div>
-->

									<div class="form-group">
                                       <input type="hidden" name="sordid" class="sordid">    
                                           
                                       <input type="hidden" name="oid" class="ordid">           
                                       <input type="hidden" name="orderType" class="orderType">           
                                       <button type="submit" class="btn btn-success submit" style="margin-top: 5px; width: 50%">Update</button>
										
									</div>
								</form>	

							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script type="text/javascript">
	
$(document).ready(function(){	
	var date = new Date();
	date.setDate(date.getDate());

	jQuery('#sdate').datepicker({
		autoclose: true,
		todayHighlight: true,
		startDate: date
	});
});	
	
$('#zero_config').DataTable({
    dom: 'Bfrtip',
    buttons: [
         'csv', 'excel', 'pdf'
    ]
});	

$("#filter").click(function(){
	
	$(".zero_config").hide();
	$(".zero_config1").show();

	var sdate = $("#sdate").val();
//	var edate = $("#edate").val();
	var shift = $("#shift").val();
	var city = $("#city").val();
	
	var table = $('#zero_config1').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("agent-orders/filterallactiveorders") ?>",
			"type": "POST",
			"data" : {sdate : sdate, shift : shift,city:city},
//			"success" : function(data){
//				
//				console.log(data);
//				
//			},
//			"error" : function(data){
//				
//				console.log(data);
//				
//			} 
  		  },
         "aoColumns": [
			 
               { mData: 'sno' } ,
               { mData: 'Order_ID' },
               { mData: 'Name' },
               { mData: 'Mobile' },
               { mData: 'itemName' },
               { mData: 'qty' },
               { mData: 'Address' },
               { mData: 'cAddress' },
               { mData: 'orderType' },
               { mData: 'shift' },
               { mData: 'Delivery_Date' },
               { mData: 'Status' },
               { mData: 'action' },
			 
             ],
          "aaSorting": [[ 0, "asc" ]],
          "bLengthChange": true,
          "pageLength":10,
		  "destroy" : 'true',
		  "dom": 'Bfrtip',
		  "buttons": [
			 'csv', 'excel', 'pdf'
		  ]	
      });
	
})	
	

	
$(".dstatus").change(function(){
	
	var dstatus = $(".dstatus").val();
	
	if(dstatus == "other"){
		
		$(".ostatus").show();
		
		$(".ostatus").attr("required","required");
		
	}else{
		
		$(".ostatus").hide();
		$(".ostatus").removeAttr("required","required");		
	}
	
});
	

	
$("#zero_config").on("click",".getOid",function(){
	
	$("#myModal").modal("show");
	
	var oid = $(this).attr("id");
	var soid = $(this).attr("soid");
	var oType = $(this).attr("orderType");
	
	$(".sordid").val(soid);
	$(".ordid").val(oid);
	$(".orderType").val(oType);
	
});
	
$("#zero_config1").on("click",".getOid",function(){
	
	$("#myModal").modal("show");
	
	var oid = $(this).attr("id");
	var soid = $(this).attr("soid");
	var oType = $(this).attr("orderType");
	
	$(".sordid").val(soid);
	$(".ordid").val(oid);
	$(".orderType").val(oType);
	
});	
	
	
</script>

            <!-- End footer -->