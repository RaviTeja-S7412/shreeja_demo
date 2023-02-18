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
                                    <li class="breadcrumb-item active" aria-current="page">Cancelled Orders</li>
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
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Quantity</th>
                                                <th>UOM</th>
                                                <th>Consumer Name</th>
                                                <th>Mobile Number</th>
                                                <th>Address</th>
                                                <th>Order ID</th>
                                                <th>Invoice Number</th>
                                                <th>Order Date</th>
                                                <th>Cancelled Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
				   <?php 
				   $i = 0;
				   foreach ($doo as $u) { 

					   if(json_decode($u->user_data)){
											   
						   $udata = json_decode($u->user_data);

					   }else{

						  $udata = $this->db->get_where("shreeja_users",array("userid"=>$u->user_id,"user_status"=>0))->row();	   

					   }
				   $orderproducts = $this->db->get_where("order_products",array("order_id"=>$u->order_id))->result();	

				   foreach($orderproducts as $op){			
					   
					   if(json_decode($op->product_data)){
											   
						   $pdata = json_decode($op->product_data);

						}else{

						  $pdata = $this->db->get_where("tbl_products",array("id"=>$op->product_id))->row();	   
						}

				   ?> 

								<tr>

									<td style="padding: 0.5rem;"><?php echo ++$i ?></td>
									<td style="padding: 0.5rem;"><?php echo $pdata->product_id ?></td>
									<td style="padding: 0.5rem;"><?php echo $pdata->product_name ?></td>
									<td style="padding: 0.5rem;"><?php echo $op->qty ?></td>
									<td style="padding: 0.5rem;">EA</td>
									<td style="padding: 0.5rem;"><?php echo $udata->user_name ?></td>
									<td style="padding: 0.5rem;"><?php echo $udata->user_mobile ?></td>
									<td style="padding: 0.5rem;"><?php echo nl2br($u->shipping_address) ?></td>
									<td style="padding: 0.5rem;"><?php echo ($u->order_id) ?></td>
									<td style="padding: 0.5rem;"><?php echo ($u->invoice_number) ?></td>
									<td style="padding: 0.5rem;"><?php echo date("d-m-Y",strtotime($u->date_of_order)) ?></td>
									<td style="padding: 0.5rem;"><?php echo date("d-m-Y",strtotime($u->cancelledDate)) ?></td>
									
								</tr>
							 <?php  

							   }
				   
				   
					   			if($u->order_type == "freesample"){
									
									if(json_decode($u->product_data)){
											   
									   $pdata1 = json_decode($u->product_data);

									}else{

									  $pdata1 = $this->db->get_where("tbl_products",array("id"=>$u->product_id))->row();	   
									}


							 ?> 
                                          
                                <tr>

									<td style="padding: 0.5rem;"><?php echo ++$i ?></td>
									<td style="padding: 0.5rem;"><?php echo $pdata1->product_id ?></td>
									<td style="padding: 0.5rem;"><?php echo $pdata1->product_name ?></td>
									<td style="padding: 0.5rem;">1</td>
									<td style="padding: 0.5rem;">EA</td>
									<td style="padding: 0.5rem;"><?php echo $udata->user_name ?></td>
									<td style="padding: 0.5rem;"><?php echo $udata->user_mobile ?></td>
									<td style="padding: 0.5rem;"><?php echo nl2br($u->shipping_address) ?></td>
									<td style="padding: 0.5rem;"><?php echo ($u->order_id) ?></td>
									<td style="padding: 0.5rem;"><?php echo ($u->invoice_number) ?></td>
									<td style="padding: 0.5rem;"><?php echo date("d-m-Y",strtotime($u->order_date)) ?></td>
									<td style="padding: 0.5rem;"><?php echo date("d-m-Y",strtotime($u->cancelledDate)) ?></td>
									
								</tr>  
                                          
                          <? }} ?>                          
                                           
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
$("#zero_config").dataTable({
	
//	"order": [[ 9, "desc" ]],
	"dom": 'Bfrtip',
	"buttons": [
	 'csv', 'excel', 'pdf'
	 ]
});

	
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