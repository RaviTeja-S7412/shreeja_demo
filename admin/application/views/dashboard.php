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
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                   <!--  <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div> -->
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
                <!-- Info box -->
                <!-- ============================================================== -->

  <? $role = $this->admin->get_admin("role");
	 $aagt = json_decode($this->admin->get_admin("assigned_agents"));
  ?>             
                <div class="card-group">
                   
                <? if($role == 7 || $role == 11 || $role == 12){ ?> 
                    
                    
                   <? if($role == 11){ ?> 
					   <div class="col-lg-4 col-md-12">
							<div class="card">


								<div class="card-body">
									<h4 class="card-title">Teritary Incharge</h4>
									<div class="myadmin-dd-empty dd" id="nestable2">
										<ol class="dd-list">

										 <? foreach($aagt->tincharge as $ti){ ?>  

											<li class="dd-item dd3-item" data-id="13">
												<div class="dd3-content" style="font-size: 18px" align="left"> <? echo $this->admin->get_admin("name",$ti); ?></div>
											</li>

										 <? } ?>   

										</ol>
									</div>
								</div>

							</div>
						</div>
                   
                   	<? }if($role == 11 || $role == 12){ ?>
                   
                   		<div class="col-lg-4 col-md-12">
							<div class="card">


								<div class="card-body">
									<h4 class="card-title">Sales Employees</h4>
									<div class="myadmin-dd-empty dd" id="nestable2">
										<ol class="dd-list">

										 <? foreach($aagt->salesemployees as $se){ ?>  

											<li class="dd-item dd3-item" data-id="13">
												<div class="dd3-content" style="font-size: 18px" align="left"> <? echo $this->admin->get_admin("name",$se); ?></div>
											</li>

										 <? } ?>   

										</ol>
									</div>
								</div>

							</div>
						</div>
                  			
                  			
                  	<? }if($role == 11 || $role == 12 ||  $role == 7){ ?>
                   
                   		<div class="col-lg-4 col-md-12">
							<div class="card">


								<div class="card-body">
									<h4 class="card-title">Agents</h4>
									<div class="myadmin-dd-empty dd" id="nestable2">
										<ol class="dd-list">

										 <? 
											$semp = isset($aagt->salesemployees) ? $aagt->salesemployees : [];
	
											if(count($semp) > 0){						  
																	  
											foreach($semp as $agts){ 
	
											$agents = json_decode($this->admin->get_admin("assigned_agents",$agts));
											
											foreach($agents->agents as $ag){
											?>  

											<li class="dd-item dd3-item" data-id="13">
												<div class="dd3-content" style="font-size: 18px" align="left"> <? echo $this->admin->get_admin("name",$ag) ?></div>
											</li>

										 <? }}}else{ foreach($aagt->agents as $ag){
											?>  

											<li class="dd-item dd3-item" data-id="13">
												<div class="dd3-content" style="font-size: 18px" align="left"> <? echo $this->admin->get_admin("name",$ag) ?></div>
											</li>

												
												
												
										<?	}} ?>   

										</ol>
									</div>
								</div>

							</div>
						</div>
                  			
                  			
                  	<? } ?>			
                    
				  <? } ?>	
                   

                </div>
                 <!-- column -->
                
                <!-- ============================================================== -->
                <!-- Sales Summery -->

                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Email campaign chart -->
               
                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>
            
<script>

	$('#nestable2').nestable({
            group: 1
        })
				
</script>            

            <!-- End footer -->