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
<?php admin_sidebar(); 

$rid = $this->uri->segment(3);


?> 
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
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>users/all-users">Roles</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Role</li>
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
                   	  <div class="col-md-8">
                    	<i class="fa fa-user"></i> Update <?php echo $u->role_name ?> role
                      </div>
                      <div class="col-md-3" style="text-align: right">
<!--
                       <a href="<?php echo base_url() ?>users/create-user">	
                    	<button class="btn btn-success waves-effect waves-light">Create Users</button>
                       </a>	
-->
                      </div>
                      <div class="col-md-1" style="text-align: right">
                       <a href="<?php echo base_url() ?>roles">	
                    	<button class="btn btn-success waves-effect waves-light">All Roles</button>
                       </a>	
                      </div>	
                   </div>
                </div>
                
                <div class="row">
                	
                	<div class="col-lg-12">
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive">
                                   
              <form method="post" action="<?php echo base_url('roles/udpate_permissions/').$rid ?>">                     
                                   
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>Modules</th>
                                                <th>Sub Modules</th>
                                            </tr>
                                        </thead>
                                        <tbody>
		   <?php 
		   
			$exRoles = $this->db->get_where("fdm_va_admin_role_access",array("role_id"=>$rid))->row();
	
			$roles = isset($exRoles->modules) ? json_decode($exRoles->modules) : [];
						
			$mids = array();							   
			$submodules = array();			
										   
			foreach($roles as $rm){
				
				$mids[] = $rm->module_id;
				$submodules[$rm->module_id] = $rm->sub_module_id;
				
			}							   
										   
			$id = 0;
			$sid = 0;
										   
                 $modules = $this->db->query("select * from fdm_va_modules where status=1 order by sort asc")->result();
                 foreach ($modules as $m) {
					 
					 
                     $smodule = $this->db->get_where("fdm_va_sub_modules",array("module_id"=>$m->module_id))->result();
		   ?> 

					<tr>
						<td style="padding: 0.5rem;">
							
							<?php 
					 			if(in_array($m->module_id,$mids)){
									
							?>		
								<div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="<?php echo $m->module_id ?>" name="moduleid[]" id="customCheck<? echo $id ?>" checked>
                                    <label class="custom-control-label" for="customCheck<? echo $id ?>"><? echo $m->module_long_name; ?></label>
                                </div>
					 				
							<?php
									
								}else{
							
							?>		
								<div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="<?php echo $m->module_id ?>" name="moduleid[]" id="customCheck<? echo $id ?>">
                                    <label class="custom-control-label" for="customCheck<? echo $id ?>"><? echo $m->module_long_name; ?></label>
                                </div>
							
							<?php				
								}
							
							?>

						</td>
						<td style="padding: 0.5rem;">
							
							<?php
					 			
					 			$ssmids = isset($submodules[$m->module_id]) ? $submodules[$m->module_id] : [];
					 		
					 			foreach($smodule as $sm){
									
					 			if(in_array($sm->sub_module_id,$ssmids)){
									
							?>		
								<div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="<?php echo $sm->sub_module_id ?>" name="smoduleid<?php echo $m->module_id ?>[]" id="Check<? echo $sid ?>" checked>
                                    <label class="custom-control-label" for="Check<? echo $sid ?>"><? echo $sm->sub_module_name; ?></label>
                                </div>
					 				
							<?php
									
								}else{
							
							?>
								<div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="<?php echo $sm->sub_module_id ?>" name="smoduleid<?php echo $m->module_id ?>[]" id="Check<? echo $sid ?>">
                                    <label class="custom-control-label" for="Check<? echo $sid ?>"><? echo $sm->sub_module_name; ?></label>
                                </div>
							
							<?php	
								}
								$sid++;	
								}
							
							?>											
																			
						</td>



					</tr>
			 <?php  

			$id++;					
			   }
			 ?> 
                                           
                                        </tbody>
                                    </table>
                                    
                                </div>
                                
                <div class="container" align="center">
                   <div class="form-group m-t-20">
                   	
                   		<button type="submit" class="btn btn-primary">Submit</button>
                   	
                   </div>   
                </div>                    
                                                                
               </form>                                     
                                
                                
                            </div>
                        </div>
                    </div>
                	
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
$('#zero_config').DataTable({
	
	pageLength : 20
	
});


</script>          