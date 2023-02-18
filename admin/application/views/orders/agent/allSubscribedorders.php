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
                                    <li class="breadcrumb-item active" aria-current="page">Subscribed Orders</li>
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
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Delivery Address</th>
                                                <th>Subscribed Date</th>
                                                <th>Payment Status</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                           foreach ($doo as $u) { 
											  
										   $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   
                                            
                                           ?> 

                                            <tr>
												 
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->order_id ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $udata->user_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $udata->user_mobile ?></td>
                                                <td style="padding: 0.5rem;"><?php echo nl2br($u->shipping_address) ?></td>
                                                <td style="padding: 0.5rem;">
                                                
                                                	<?php echo "Start : ".date("d-M-Y",strtotime($u->sub_start_date))."<br>"; ?>
                                                	<?php echo "End : ".date("d-M-Y",strtotime($u->sub_end_date))."<br>"; ?>
                                                	
                                                </td>
                                                <td style="padding: 0.5rem;" align="center"><?php echo ($u->payment_status == "Success") ? '<span class="badge badge-success">Success</span>' : '<span class="badge badge-danger">Failed</span>' ?></td>
                                                <td style="padding: 0.5rem;" align="center"><?php  
											   		if($u->delivery_status == "Success"){
														
														echo '<span class="badge badge-success" style="color:white">Success</span>';
													}elseif($u->delivery_status == "Pending"){
														
														echo '<span class="badge badge-warning" style="color:white">Pending</span>';
													}else{
														echo '<span class="badge badge-danger" style="color:white">Failed</span>';
													}    ?></td>
                                                <td style="padding: 0.5rem;">
                                                                                           
                                               		<a href="<?php echo base_url() ?>agent-orders/view-subscribed-order/<?php echo $u->order_id ?>" class="text-inverse p-r-10"><i class="fas fa-eye" style="color: black"></i></a>

                                                	
                                                </td>
                                                

                                                

                                            </tr>
                                     <?php  
                                    
                                       }
                                     ?> 
                                           
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
$("#zero_config").dataTable();

	
	$(".selectbtn").on("click",function(){
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
          url:"<?php echo base_url();?>orders/DeliveryOnce/assignOrders",
          //data:{category_id:category_id,question_id:question_id,course_id:course_id},
          data:{orderids:JSON.stringify(val),agent:agent},
          success:function(d){
                console.log(d);
                location.reload();
          
           }
        });

	});	
</script>

            <!-- End footer -->