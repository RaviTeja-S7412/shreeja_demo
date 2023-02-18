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
						  <div class="col-md-4">   
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
				      
					      <div class="col-md-2">
					      	
					      	<button id="filter" type="button" class="btn btn-info waves-effect waves-light m-t-30">Submit</button>
					      	
					      </div> 
						      
					   </div>
                       
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive zero_config">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th data-field="sno" data-checkbox="true"></th>
                                                <th>S.No</th>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Delivery Address</th>
                                                <th>Consumer Address</th>
                                                <th>Order Type</th>
                                                <th>Shift</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Status</th>
                                                <th>Assigned To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 1;

//											$cdate = date("H");
//	
//											if($cdate >= 18){
//
//												$days = 2;
//											}else{
//												$days = 1;
//
//											}

								   $date = date("Y-m-d",strtotime("+1 day"));

								   foreach ($doo as $u) {
									   
									   
									   if($u->assigned_to == ""){
											   
											if($u->order_type == "deliveryonce"){
												
												$ddate = date("Y-m-d",strtotime($u->deliverydate));
												
											}elseif($u->order_type == "freesample"){
												
												$ddate = date("Y-m-d",strtotime($u->deliverydate));
												
											}elseif($u->order_type == "subscribe"){
												
												$sdate = $this->db->get_where("tbl_subscribed_deliveries",array("order_id"=>$u->order_id,"delivery_date"=>$date,"pause_status"=>"Inactive"))->row();
												
												$ddate = date("Y-m-d",strtotime($sdate->delivery_date));

											}
											   
											   
											if($ddate == $date){   
											  
												
										   if(json_decode($u->user_data)){
											   
											   $udata = json_decode($u->user_data);
											   
										   }else{
											   
											  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   
											   
										   }		
												
										    
//											$ucity = $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0,"status"=>1))->row()->location;
//											$uarea = $this->db->get_where("tbl_areas",array("id"=>$udata->user_area,"status"=>"Active","deleted"=>0))->row()->area_name;
//
//											$area = isset($uarea) ? $uarea : $udata->areanotlisted;

                                            
                                           ?> 

                                            <tr>
                                            
												<td style="padding: 0.5rem;">
                                                	<center>
													<input class="checkbox selectbtn" type="checkbox" order_id="<?php echo $u->order_id ?>" style="zoom: 1.3">
													</center>
                                                </td> 
                                                <td style="padding: 0.5rem;"><?php echo $i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->order_id ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $udata->user_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $udata->user_mobile ?></td>
                                                <td style="padding: 0.5rem;"><?php echo nl2br($u->shipping_address) ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $udata->user_current_address; ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->order_type ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->deliveryShift ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $ddate ?></td>
                                               
                                                <td style="padding: 0.5rem;" align="center">
                                                <?php	
											   
											   if($u->order_type == "subscribe"){
												   
												    $sstatus = isset($sdate->deliver_status) ? $sdate->deliver_status : ""; 
													if($sstatus == "Success"){
														
														echo '<span class="badge badge-success" style="color:white">Success</span>';
													}elseif($sstatus == "Pending"){
														
														echo '<span class="badge badge-warning" style="color:white">Pending</span>';
													}else{
														echo '<span class="badge badge-danger" style="color:white">Failed</span>';
													}
												   
											   }else{
													
												   
											   		if($u->delivery_status == "Success"){
														
														echo '<span class="badge badge-success" style="color:white">Success</span>';
													}elseif($u->delivery_status == "Pending"){
														
														echo '<span class="badge badge-warning" style="color:white">Pending</span>';
													}else{
														echo '<span class="badge badge-danger" style="color:white">Failed</span>';
													}
												 
											   }
												
												?>
                                               </td>
                                                <td style="padding: 0.5rem;" align="center">
                                                   
											   <?php 
												if($u->assigned_to != ""){	
											   			$aname = $this->db->get_where("fdm_va_auths",array("role"=>2,"deleted"=>0,"id"=>$u->assigned_to))->row()->name; 
													
											   			echo $aname;
													}else{
														
														echo("Not Assigned");
													}
											   ?>
                                                   
                                                </td>
                                                

                                                

                                            </tr>
                                            
                                            
                                            
                                            
                                     <?php  
                                    $i++;
                                       }}}
                                     ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                                
                                
                                
                                <div class="table-responsive zero_config1" style="display: none">
                                   <table class="table product-overview table-striped" id="zero_config1">
                                        <thead>
                                            <tr>
                                                <th data-field="sno" data-checkbox="true"></th>
                                                <th>S.No</th>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Delivery Address</th>
                                                <th>Consumer Address</th>
                                                <th>Order Type</th>
                                                <th>Shift</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Status</th>
                                                <th>Assigned To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
										</tbody>
									</table>
								   </div>
                                
                                
                                
                                <div class="container m-t-20 assign_agent" align="center" style="display: none">
                                	
									<div class="col-md-4"></div>
                               	
                               		<div class="col-md-4">	
										<div class="form-group">
										<label>Select Agent:</label>
											<select name="agent" class="form-control" id="agent">

												<option value="">Select Agent</option>

												<?php 
													$agents = $this->db->get_where("fdm_va_auths",array("role"=>2,"status"=>"Active","deleted"=>0))->result();

													foreach($agents as $ag){
												?>

												<option value="<?php echo $ag->id ?>"><?php echo $ag->name ?></option>	

												<?php } ?>
											</select>

										</div>
										<div class="form-group">
											
											<button type="button" class="btn btn-info waves-effect waves-light" id="assign">Assign Orders</button>
											
										</div>
									</div>	
										
									<div class="col-md-4"></div>                                 	
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
	
 jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",

 });
	
$("#filter").click(function(){
	
	$(".zero_config").hide();
	$(".zero_config1").show();

	var sdate = $("#sdate").val();
	var edate = $("#edate").val();
	var shift = $("#shift").val();
	var city = $("#city").val();
	
	var table = $('#zero_config1').dataTable({
         "bProcessing": true,
         "ajax": {
			"url": "<?php echo base_url("orders/Activeorders/filterallActiveorders") ?>",
			"type": "POST",
			"data" : {sdate : sdate, edate : edate, shift : shift,city:city},
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
			 
               { mData: 'check' } ,
               { mData: 'sno' } ,
               { mData: 'Order_ID' },
               { mData: 'Name' },
               { mData: 'Mobile' },
               { mData: 'Address' },
               { mData: 'cAddress' },
               { mData: 'orderType' },
               { mData: 'shift' },
               { mData: 'Delivery_Date' },
               { mData: 'Status' },
               { mData: 'Assigned_To' },
			 
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
	
	
	
$('#zero_config').DataTable({
    dom: 'Bfrtip',
    buttons: [
         'csv', 'excel', 'pdf'
    ]
});	
	

	
	$("#zero_config").on("click",".selectbtn",function(){
		var val = [];
        $('.selectbtn:checked').each(function(i){
          val[i] = {order_id:$(this).attr('order_id')};
        });
        var count = val.length;
       
        if(count > 0){
			$(".assign_agent").show();
		}else{
			$(".assign_agent").hide();
		}
	});
	
	$("#zero_config1").on("click",".selectbtn",function(){
		var val = [];
        $('.selectbtn:checked').each(function(i){
          val[i] = {order_id:$(this).attr('order_id')};
        });
        var count = val.length;
       
        if(count > 0){
			$(".assign_agent").show();
		}else{
			$(".assign_agent").hide();
		}
	});
	
	
	$("#assign").on("click",function(){
		var val = [];
        $('.selectbtn:checked').each(function(i){
          val[i] = {order_id:$(this).attr('order_id')};
        });
		
		var agent = $("#agent").val();
		
		if(agent == ""){
            swal("Error", "Select Agent", "error")
			return false;
		}
		
         $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>orders/Activeorders/assignOrders",
          //data:{category_id:category_id,question_id:question_id,course_id:course_id},
          data:{orderids:JSON.stringify(val),agent:agent},
          success:function(d){
                console.log(d);
                location.reload();
          
           },error:function(d){
			   console.log(d);
		   }
        });

	});	
	
</script>

            <!-- End footer -->