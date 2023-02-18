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
       
       
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice{

		background-color: #4798e8;
	}					
</style>        
       
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
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 align-self-center">
                        <div class="d-flex no-block justify-content align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Send Notifications</li>
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
            <div class="container-fluid">
            <!-- ============================================================== -->
              <!-- Card -->
            <div class="card">
                <div class="card-header">
                   <div class="row">
                   	  <div class="col-md-10">
                    	<i class="fa fa-user"></i> Send Notifications
                      </div>
                      <div class="col-md-2" style="text-align: right">
                       <a href="<?php echo base_url() ?>notifications">	
                    	<button class="btn btn-success waves-effect waves-light">All Notifications</button>
                       </a>	
                      </div>	
                   </div> 	
                </div>
                <div class="card-body">
                	    
				<div class="row"><div class="col-md-6">	
                    <div class="table-responsive">
						<table class="table product-overview table-striped" id="zero_config">
							<thead>
								<tr>
									<th style="text-align: center">Notification Type</th>
									<th style="text-align: center">Action</th>
								</tr>
							</thead>
							<tbody>
							   <tr>
									<td style="padding: 0.5rem;" align="center">Offer</td>
									<td style="padding: 0.5rem;" align="center"><a href="<?php echo base_url() ?>notifications/sendNotification">	
									<button class="btn btn-primary waves-effect waves-light">Send</button>
								   </a>	</td>
								</tr>
						 
						 		<tr>
									<td style="padding: 0.5rem;" align="center">Subscribtion</td>
									<td style="padding: 0.5rem;" align="center"><a href="<?php echo base_url() ?>notifications/subscribtionCheck">	
									<button class="btn btn-primary waves-effect waves-light">Send</button>
								   </a>	</td>
								</tr>
								
								<tr>
									<td style="padding: 0.5rem;" align="center">Newly Registered Users</td>
									<td style="padding: 0.5rem;" align="center"><a href="<?php echo base_url() ?>notifications/newlyRegisteredusers">	
									<button class="btn btn-primary waves-effect waves-light">Send</button>
								   </a>	</td>
								</tr>
						 
						        <tr>
									<td style="padding: 0.5rem;" align="center">App Updates</td>
									<td style="padding: 0.5rem;" align="center"><a href="<?php echo base_url() ?>notifications/sendAppupdate">	
									<button class="btn btn-primary waves-effect waves-light">Send</button>
								   </a>	</td>
								</tr>
						 
							</tbody>
						</table>
                     </div>
                 </div></div>           

                </div>
            </div>

            <!-- End Card  -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

            <!-- End footer -->

 <script>
	 
 jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",

 });</script>          