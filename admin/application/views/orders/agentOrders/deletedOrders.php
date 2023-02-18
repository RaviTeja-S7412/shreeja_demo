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
                                    <li class="breadcrumb-item active" aria-current="page">Agent Cancelled Orders</li>
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
                                                <th>Agent Name</th>
                                                <th>Product Name</th>
                                                <th>Quantity (ML or Gm)</th>
                                                <th>Qty</th>
<!--
                                                <th>Delivery Date</th>
                                                <th>Delivery Time</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                           foreach ($orders as $u) { 
											
											$products = json_decode($u->product_id);   
											$pdata = $this->db->get_where("tbl_products",array("id"=>$u->product_id,"deleted"=>0))->row();   
                                            
                                           ?> 

                                            <tr>
												<td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->order_id ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("fdm_va_auths",array("id"=>$u->agent_id,"deleted"=>0))->row()->name ?></td>
                                                <td>   
												   <?php  
													foreach($products as $p){

														echo $this->db->get_where("tbl_products",array("id"=>$p->productId,"deleted"=>0))->row()->product_name."<br>"; 

													}
													?>
												</td>
												<td style="padding: 0.5rem;">
												<?php  
													foreach($products as $cat){

														echo $cat->category."<br>";

													}
													?>
												</td>
												<td style="padding: 0.5rem;">
												<?php  
													foreach($products as $qty){

														echo $qty->productQty."<br>";

													}
													?>
												</td>
<!--
                                                <td style="padding: 0.5rem;"><?php //echo date("d-M-y",strtotime($u->delivery_date)) ?></td>
                                                <td style="padding: 0.5rem;"><?php //echo $u->order_delivery_time ?></td>
-->
                                                
<!--
                                                <td style="padding: 0.5rem;" align="center">
                                                    <a href="<?php //echo base_url() ?>orders/agent-order/updateOrder/<?php //echo $u->order_id ?>" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a>
                                                    <a href="<?php //echo base_url() ?>orders/agent-order/delOrder/<?php //echo $u->order_id ?>" class="text-inverse p-r-10" onClick="return confirm('Are you sure want to cancel this order')"><i class="fas fa-trash" style="color: black"></i></a>
                                                	
                                                </td>
-->
                                                

                                                

                                            </tr>
                                     <?php  
                                    
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
$("#zero_config").dataTable();

	
</script>

            <!-- End footer -->