<?php admin_header(); ?>

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
<?php
	
	$rid = $this->uri->segment(3);
	
	$r1 = $this->db->get_where("tbl_categories",array("id"=>$rid))->num_rows();

	
?>        
        
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
                    <div class="col-12 align-self-center">
                        <div class="d-flex no-block justify-content align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Category</li>
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
                    	<i class="fa fa-user"></i> Create Category
                      </div>
<!--
                      <div class="col-md-2" style="text-align: right">
                       <a href="<?php //echo base_url() ?>users/all-users">	
                    	<button class="btn btn-success waves-effect waves-light">All Users</button>
                       </a>	
                      </div>	
-->
                   </div> 	
                </div>
    
                
                <div class="card-body">
                <?php if($r1 == 1){ ?>

                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>products/categories/categories/updateCategory">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Employee User</h4> -->
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Category Name
                                                <div class="input-group">
                                                    
                                                    <input type="text" name="cat_name" class="form-control" id="name" placeholder="Category Name" required="" value="<?php echo $cat->category_name ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="cid" value="<?php echo $cat->id ?>">
                                         <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 20px;">
                                                
                                               <!--  <div class="input-group">
                                                    <div class="input-group-prepend"> -->

                                                    <button type="submit" class="btn btn-info waves-effect waves-light" style="width: 100%">Update</button>
                                                  
                                                <!--   </div>
                                                    
                                                    
                                                </div> -->

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                              </div>
                              
                   </form>
                <?php }else{ ?>
                
                   <form class="form-horizontal" method="post" action="<?php echo base_url() ?>products/categories/categories/insertCategory">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Employee User</h4> -->
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Category Name
                                                <div class="input-group">
                                                    
                                                    <input type="text" name="cat_name" class="form-control" id="name" placeholder="Category Name" required="">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 20px;">
                                                
                                               <!--  <div class="input-group">
                                                    <div class="input-group-prepend"> -->

                                                    <button type="submit" class="btn btn-info waves-effect waves-light" style="width: 100%">Save</button>
                                                  
                                                <!--   </div>
                                                    
                                                    
                                                </div> -->

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                              </div>
                              
                   </form>
                      
                         
                <?php } ?>               

                </div>
            </div>
            
            <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Nav Pills Tabs</h4> -->
                                <ul class="nav nav-pills m-b-30">
					<!--	Main Menu		-->   
                                    <li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Categories</a> </li>
                                                  
                                            
                                </ul>
                <div class="tab-content br-n pn">

    			 <div id="navpills-1" class="tab-pane active">

					<div class="row">
						
						<div class="col-lg-8">
                        <div class="card" style="border:0px">
                          <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing Categories</strong></p></div>
                             <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="mainmenu">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                        $i = 0;
										$opt = $this->db->query("select * from tbl_categories order by id desc")->result();       	
                                           foreach ($opt as $u) {  ?> 
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center"><?php echo ++$i ?></td>
                                                <td style="vertical-align: middle;"><?php echo $u->category_name ?></td>
                                                <td style="vertical-align: middle; padding: 0px">
 												
                                                    <a href="<?php echo base_url("products/edit-category/").$u->id ?>" class="text-inverse sa-params"  ><i class="ti-marker-alt"></i></a>&nbsp;
                                                    <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php //echo $u->id ?>" class="text-inverse sa-params"  onclick="delBsolution(this.id)"><i class="ti-trash"></i></a>
                                                
                                                </td>
                                                    
                                            </tr>
                                        <?php } ?> 
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
						
				  </div>
							
                        
				 </div>
     
      			    
                    
                    
                    
                   
				</div>     
			</div> 
			
		</div>        
      </div> 
   </div>        
                        
                
<!--   End trending Bar             -->         
               

                
                

            

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
 	  
 // Main Menu Script Starts	
	 
	 $('#mainmenu').DataTable(); 
	 
	 

// Main Menu Script Ends
	 
	 
// Footer Menu Script Starts	
	 
	 $('#footermenu').DataTable(); 
	 
	 

// Footer Menu Script Ends
	 
	 
// Top Menu Script Starts	
	 
	 $('#topmenu').DataTable(); 
	 
	 

// Top Menu Script Ends	
	 

// Location Menu Script Starts	
	 
	 $('#locmenu').DataTable(); 
	 
	 

// Location Menu Script Ends		 
</script>          