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
                                    <li class="breadcrumb-item active" aria-current="page">Agent Orders Update History</li>
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
                                                <th>History</th>
                                                <th>Date</th>
                                                <th>Created By</th>
                                                <th>Updated By</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                           foreach ($orders as $u) {
											   
//											   $cby = $this->db->get_where("agent_orders",array("order_id"=>$u->agent_order_id))->row()->created_by;
											
                                           ?> 

                                            <tr>
												<td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->agent_order_id ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("fdm_va_auths",array("id"=>$u->agent_id,"deleted"=>0))->row()->name ?></td>
                                                <td>   
												   <?php  
													echo $u->description;
													?>
												</td>
												<td style="padding: 0.5rem;">
												<?php  
													echo $u->updated_time;
													?>
												</td>
												
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("fdm_va_auths",array("id"=>$u->agent_id,"deleted"=>0))->row()->name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("fdm_va_auths",array("id"=>$u->updated_by,"deleted"=>0))->row()->name ?></td>

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