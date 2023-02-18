<?php admin_header(); 
$wdata = json_decode($this->admin->get_option("welcome_note"));
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">       
       
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
<?php admin_sidebar();  ?> 

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
                        <h4 class="page-title">General</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">General</li>
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


<div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Nav Pills Tabs</h4> -->
                                <ul class="nav nav-pills m-b-30">

                                <?php if($soc || $loc || $areas){ ?>
                                    <li class=" nav-item"> <a href="#navpills-1" class="nav-link" data-toggle="tab" aria-expanded="false">Logo</a> </li>
                                <?php }else{ ?>    
                                    <li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Logo</a> </li>
                                <?php } ?>    
                                   
                                    <li class="nav-item"> <a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="true">Contact</a> </li>
                                    <li class="nav-item"> <a href="#navpills-9" class="nav-link" data-toggle="tab" aria-expanded="true">Welcome Offer</a> </li>
                                
                                <?php if($loc){ ?>        
                                    <li class="nav-item"> <a href="#navpills-4" class="nav-link active" data-toggle="tab" aria-expanded="true">Cities</a> </li>
                                <?php }else{ ?>
                                    <li class="nav-item"> <a href="#navpills-4" class="nav-link" data-toggle="tab" aria-expanded="true">Cities</a> </li>
                                <?php } ?>
                                    
                                
                                <?php if($areas){ ?>        
                                    <li class="nav-item"> <a href="#navpills-6" class="nav-link active" data-toggle="tab" aria-expanded="true">Areas</a> </li>
                                <?php }else{ ?>
                                    <li class="nav-item"> <a href="#navpills-6" class="nav-link" data-toggle="tab" aria-expanded="true">Areas</a> </li>
                                <?php } ?>            
                                                                    
                                    
                                <?php if($soc){ ?>        
                                    <li class="nav-item"> <a href="#navpills-5" class="nav-link active" data-toggle="tab" aria-expanded="true">Social Networking</a> </li>
                                <?php }else{ ?>
                                    <li class="nav-item"> <a href="#navpills-5" class="nav-link" data-toggle="tab" aria-expanded="true">Social Links</a> </li>
                                <?php } ?>
                                   
                                    <li class="nav-item"> <a href="#navpills-8" class="nav-link" data-toggle="tab" aria-expanded="true">Charges</a> </li>
                                    
                                    <li class="nav-item"> <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="true">App Deployment Mode</a> </li>
                                          
                                </ul>
                                <div class="tab-content br-n pn">
                    <?php if($soc || $loc || $areas){ ?>
                     
                        <div id="navpills-1" class="tab-pane">
                    
                    <?php }else{ ?>

    	<div id="navpills-1" class="tab-pane active">

                    <?php } ?>
                         <div id="load"></div>


                        <div class="card">
                            
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Logo</h4> -->
                                </div>
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                            
                                        <div class="col-md-6">
                                        <form action="<?php echo base_url() ?>general/insertHeaderLogo" method="post" enctype="multipart/form-data">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Header Logo</label>
                                                    <input type="file" class="form-control" required="" name="logo" id="logo1">
                                                <small style="color: red">Note: Please select 450px * 80px Image</small> 
                                                </div>
                                                
                                        <div class="container" id="">
                                            <img id="display" src="<?php echo base_url().$this->admin->getheaderLogo() ?>" alt="logo" style="width: 50%;">

                                        </div> 

                                            <!-- <div class="col-md-3"> -->
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body" style="padding-top: 10px">
                                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                            <!-- <button type="reset" class="btn btn-dark">Cancel</button> -->
                                                        </div>
                                                </div>
                                            <!-- </div> -->

                                          </form>
                                        </div>
                                          
                                      
                                       
                                    </div>   
                                   
                                </div>
                           
    	                        
				</div>
			</div>
		</div>
     
     
     <div id="navpills-9" class="tab-pane">
     			<div class="row">
				  <div class="col-md-6">      
					<div class="card-body">
<!--                                <div class="card-body">-->
                                    <h4 class="card-title">Welcome Offer</h4>
<!--                                </div>-->
                              <div class="form-body">
                                <form action="<?php echo base_url() ?>general/updatewelcomeoffer" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                           
                                        <div class="row">   
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Image</label>
                                                    <input type="file" class="form-control" name="image">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Status</label>
                                                    <select class="form-control" required="" name="status">
                                                    	<option value="">Select Status</option>
                                                    	<option value="Active" <? echo ($wdata->status == "Active") ? 'selected' : '' ?>>Active</option>
                                                    	<option value="Inactive" <? echo ($wdata->status == "Inactive") ? 'selected' : '' ?>>Inactive</option>
													</select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Message</label>
                                                    <textarea class="form-control" required="" name="message"><? echo $wdata->message; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">   
                                            <div class="col-md-6">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                                                            <!-- <button type="reset" class="btn btn-dark">Cancel</button> -->
                                                        </div>
                                                </div>
                                            </div>    
                                        </div>
                                       
                                   
                                </div>
                            </form>
                            
                           </div>
                         </div>  
                     </div>
                     
                     
                     <div class="col-md-4">
                     	
                     	<img class="img-thumbnail img-responsive" width="100%" src="<? echo base_url().$wdata->image ?>">
                     	
                     </div>
                    </div> 
                 </div>

     
     
     
     
     
      <div id="navpills-2" class="tab-pane">
      
                       
              <div class="row">
				<div class="col-md-3">
					<h3 class="card-title">Mandatory App Update :</h3>
				</div>
				<div class="col-md-3">
					<div class="card-body">

						<span>
							<?php 
											   $fb = $this->admin->get_option("is_mandatory_update");
												if($fb==1){ ?>
							<div class="switch">
								<!-- <a href="<?php echo base_url() ?>"> -->

								<input type="checkbox" data-on-color="info" nav_id="<?php //echo $u->id ?>" name="switch" data-off-color="success" class="check" checked>
								<!-- </a>  -->
							</div>

							<?php  }else{ ?>

							<div class="switch">
								<!-- <a href="#">  -->
								<input type="checkbox" nav_id="<?php //echo $u->id ?>" data-on-color="info" name="switch" data-off-color="success" class="check">
								<!-- </a> -->
							</div>

							<?php } ?>
						</span>
					</div>
				</div>
				
				<div class="col-md-3">
					<h3 class="card-title">Development Mode :</h3>
				</div>
				<div class="col-md-3">
					<div class="card-body">

						<span>
							<?php 
											   $fb = $this->admin->get_option("is_development_mode");
												if($fb==1){ ?>
							<div class="switch">
								<!-- <a href="<?php echo base_url() ?>"> -->

								<input type="checkbox" data-on-color="info" nav_id="<?php //echo $u->id ?>" name="switch" data-off-color="success" class="dvcheck" checked>
								<!-- </a>  -->
							</div>

							<?php  }else{ ?>

							<div class="switch">
								<!-- <a href="#">  -->
								<input type="checkbox" nav_id="<?php //echo $u->id ?>" data-on-color="info" name="switch" data-off-color="success" class="dvcheck">
								<!-- </a> -->
							</div>

							<?php } ?>
						</span>
					</div>
				</div>
                <br>                
                <div class="col-md-4">
                    <h3 class="card-title">App Version :</h3>
                    <form method="post" action="<? echo base_url('general/appversionupdate') ?>">
                        <div class="form-group">
                            <input type="text" name="app_version" class="form-control" value="<? echo $this->admin->get_option("app_version") ?>">        
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary"> Update</button>    
                        </div>
                    </form>    
                </div>
				
		  </div>                          
                                                         
                                                                          
                                                                                                            
      </div>
        <div id="navpills-3" class="tab-pane">
          <div class="col-md-6">      
            <div class="card-body">
<!--                                <div class="card-body">-->
                                    <h4 class="card-title">Contact</h4>
<!--                                </div>-->
                              <div class="form-body">
                                <form action="<?php echo base_url() ?>general/updateContact" method="post">
                                    <div class="card-body">
                                           
                                        <div class="row">   
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Company Name</label>
                                                    <input type="text" class="form-control" required="" name="cname" required="" value="<?php echo $c->company_name ?>" placeholder="Company Name">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" class="form-control" required="" name="email" required="" value="<?php echo $c->email ?>" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Mobile</label>
                                                    <input type="tel" class="form-control" required="" name="mobile" required="" value="<?php echo $c->mobile ?>" placeholder="Mobile Number">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Address</label>
                                                    <textarea class="form-control" name="address" required rows="3" placeholder="Address"><?php echo $c->address ?></textarea>

                                                </div>
                                            </div>    
                                            <div class="col-md-6">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                            <!-- <button type="reset" class="btn btn-dark">Cancel</button> -->
                                                        </div>
                                                </div>
                                            </div>    
                                        <input type="hidden" name="c_id" value="<?php echo $c->id ?>"> 
                                        </div>
                                       
                                   
                                </div>
                            </form>
                            
                           </div>
                         </div>  
                     </div>
                 </div>
                    
                    
                    
<!--         Location Starts           -->
                    
                    
					<?php if($loc){ ?>
                     
                        <div id="navpills-4" class="tab-pane active">
                    
                    <?php }else{ ?>

                        <div id="navpills-4" class="tab-pane">

                    <?php } ?>

                   		<div class="row">
                            <div class="col-md-4">
                            <?php if($loc){ ?>

                                 <form method="post" action="<?php echo base_url() ?>general/editLocation" enctype="multipart/form-data">

                                                <label>Location:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="location" required="" value="<?php echo $loc->location ?>" placeholder="Location">
                                                    
                                                </div>
   
                                                <label>Assign To:</label>
                                                <div class="form-group">
                                                    
                                                    <select class="form-control" name="assign_to" required>
                                                    
                                                    	<option value="">Select Assign To</option>
                                                    	<option value="agents" <? echo ($loc->assign_to == 'agents') ? 'selected' : '' ?> >Agents</option>
                                                    	<option value="consumers" <? echo ($loc->assign_to == 'consumers') ? 'selected' : '' ?>>Consumers</option>
                                                    
													</select>
                                                    
                                                </div>
                                               
                                                <label>Location Image:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="file" class="form-control" name="image" placeholder="Location">
                                                    
                                                </div>
                                                <label>Address:</label>
                                                <div class="form-group">
                                                    
                                                    <textarea class="form-control" name="address" rows="3"><?php echo $loc->address ?></textarea>
                                                    
                                                </div>
                                                <label>GST Number:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="gst_number" value="<?php echo $loc->gst_number ?>" placeholder="GST Number">
                                                    
                                                </div>
                                                <label>PAN Number:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="pan_number" value="<?php echo $loc->pan_number ?>" placeholder="PAN Number">
                                                    
                                                </div>
                                        
                                        <input type="hidden" name="loc_id" value="<?php echo $loc->id ?>">        
                                  

                                   <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 5px">Update</button>
                                </form>




                            <?php }else{ ?>    
                                <form method="post" action="<?php echo base_url() ?>general/insertLocation" enctype="multipart/form-data">

                                                <label>Location:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="location" required="" placeholder="Location">
                                                    
                                                </div>
                                                

                                                <label>Assign To:</label>
                                                <div class="form-group">
                                                    
                                                    <select class="form-control" name="assign_to" required>
                                                    
                                                    	<option value="">Select Assign To</option>
                                                    	<option value="agents">Agents</option>
                                                    	<option value="consumers">Consumers</option>
                                                    
													</select>
                                                    
                                                </div>

                                                <label>Location Image:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="file" class="form-control" name="image" placeholder="Location" required>
                                                    
                                                </div>
                                                <label>Address:</label>
                                                <div class="form-group">
                                                    
                                                    <textarea class="form-control" name="address" rows="3"></textarea>
                                                    
                                                </div>
                                                <label>GST Number:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="gst_number" placeholder="GST Number">
                                                    
                                                </div>
                                                <label>PAN Number:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="pan_number" placeholder="PAN Number">
                                                    
                                                </div>
                                                
                                  

                                   <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right">Submit</button>
                                </form>

                            <?php } ?>    

                                           
                                            </div>
                                              
                      <div class="col-md-8">
                                              
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <h3 class="card-title">Locations</h3>
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Delivery charges</th>
                                                <th>Assign To</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                      $loc = $this->db->query("select * from tbl_locations where deleted=0 order by id desc")->result();
                                           if(count($loc) > 0){
                                           foreach ($loc as $u) {  ?> 
                                           <?php if($u->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->location ?></td>
                                                <td style="padding: 0.5rem;"><img src="<?php echo base_url().$u->image ?>" style="width: 30%"></td>
                                                <td style="padding: 0.5rem;"><i class="fa fa-rupee"></i> <?php echo $u->deliveryCharges ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->assign_to ?></td>
                                                <td style="padding: 0.5rem;">
                                                   
                                                <?php if($u->status==1){ ?>
                                               <div class="switch">
                                                   <input type="checkbox" data-on-color="info" loc_id="<?php echo $u->id ?>" name="location1" data-off-color="success" checked>
                                               </div>
                                                   <?php  }elseif($u->status==0){ ?>
                                                <div class="switch">
                                                    <input type="checkbox" loc_id="<?php echo $u->id ?>" data-on-color="info" name="location1" data-off-color="success">
                                                   <?php } ?>
                                                </div>    
                                                </td>
                                                <td style="padding: 0.5rem;">
            <a href="<?php echo base_url() ?>general/update-location/<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
           
             <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="delLocation(this.id)"><i class="ti-trash"></i></a>                                      

                                                </td>
                                                  
                                            </tr>
                                        <?php } ?>
                                     <?php  
                                     
                                       }} ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                      </div>
                     </div>
                   </div> 
                   	
                   
                   
                    </div>
                    
<!--       Location Ends             -->

                    
<!--         Areas Starts           -->
                    
                    
					<?php if($areas){ ?>
                     
                        <div id="navpills-6" class="tab-pane active">
                    
                    <?php }else{ ?>

                        <div id="navpills-6" class="tab-pane">

                    <?php } ?>

                   		<div class="row">
                            <div class="col-md-4">
                            <?php if($areas){ ?>

                                 <form method="post" action="<?php echo base_url() ?>general/editArea" enctype="multipart/form-data">
												
                                              <label>Assign To:</label>
                                                <div class="form-group">
                                                    
                                                    <select class="form-control" name="assign_to" id="assign_to" required>
                                                    
                                                    	<option value="">Select Assign To</option>
                                                    	<option value="agents" <? echo ($areas->assign_to == 'agents') ? 'selected' : '' ?> >Agents</option>
                                                    	<option value="consumers" <? echo ($areas->assign_to == 'consumers') ? 'selected' : '' ?>>Consumers</option>
                                                    
													</select>
                                                    
                                                </div>
                                               <label>City: </label>
                                               <div class="form-group">
                                               	
                                               	<select class="form-control" name="location" id="cloc" required>
                                               		<option value="">Select City</option>
                                               		
                                               		<?php
														$locations = $this->db->get_where("tbl_locations",array("deleted"=>0))->result();
											 
											 			foreach($locations as $ll){
													?>			
													<option value="<?php echo $ll->id ?>" <?php echo ($areas->city_id == $ll->id) ? "selected" : "" ?>><?php echo $ll->location ?></option>
													<?php } ?>	
                                               	</select>
                                               	
                                               </div>
                                               
                                               
                                                <label>Area:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="area" required="" value="<?php echo $areas->area_name ?>" placeholder="Area">
                                                    
                                                </div>
         
                                        
                                        <input type="hidden" name="area_id" value="<?php echo $areas->id ?>">        
                                  

                                   <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 5px">Update</button>
                                </form>




                            <?php }else{ ?>    
                                <form method="post" action="<?php echo base_url() ?>general/insertArea">
												
                                              <label>Assign To:</label>
                                                <div class="form-group">
                                                    
                                                    <select class="form-control" name="assign_to" id="assign_to" required>
                                                    
                                                    	<option value="">Select Assign To</option>
                                                    	<option value="agents">Agents</option>
                                                    	<option value="consumers">Consumers</option>
                                                    
													</select>
                                                    
                                                </div>
                                               
                                               <label>City: </label>
                                               <div class="form-group">
                                               	
                                               	<select class="form-control" name="location" id="cloc" required>
                                               		<option value="">Select City</option>
                                               		
                                               		<?php
														$locations = $this->db->get_where("tbl_locations",array("deleted"=>0))->result();
											 
											 			foreach($locations as $ll){
													?>			
													<option value="<?php echo $ll->id ?>"><?php echo $ll->location ?></option>
													<?php } ?>	
                                               	</select>
                                               	
                                               </div>
                                               
                                                <label>Area:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="area" required="" placeholder="Area">
                                                    
                                                </div>

                                               
                                                
                                  

                                   <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right">Submit</button>
                                </form>

                            <?php } ?>    

                                           
                                            </div>
                                              
                      <div class="col-md-8">
                                              
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <h3 class="card-title">Areas</h3>
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config2">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>City Name</th>
                                                <th>Area Name</th>
                                                <th>Assigned To</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                      $are = $this->db->query("select * from tbl_areas where deleted=0 order by id desc")->result();
                                           if(count($are) > 0){
                                           foreach ($are as $u) {  ?> 
                                           <?php if($u->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_locations",array("id"=>$u->city_id))->row()->location ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->area_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->assign_to ?></td>
                                                <td style="padding: 0.5rem;">
                                                   
                                                <?php if($u->status=="Active"){ ?>
                                               <div class="switch">
                                                   <input type="checkbox" data-on-color="info" area_id="<?php echo $u->id ?>" name="area1" data-off-color="success" checked>
                                               </div>
                                                   <?php  }elseif($u->status=="Inactive"){ ?>
                                                <div class="switch">
                                                    <input type="checkbox" area_id="<?php echo $u->id ?>" data-on-color="info" name="area1" data-off-color="success">
                                                   <?php } ?>
                                                </div>    
                                                </td>
                                                <td style="padding: 0.5rem;">
            <a href="<?php echo base_url() ?>general/update-area/<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
           
             <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="delArea(this.id)"><i class="ti-trash"></i></a>                                      

                                                </td>
                                                  
                                            </tr>
                                        <?php } ?>
                                     <?php  
                                     
                                       }} ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                      </div>
                     </div>
                   </div> 
                   	
                   
                   
                    </div>
                    
<!--       Areas Ends             -->
                                                                                
                    <?php if($soc){ ?>
                     
                        <div id="navpills-5" class="tab-pane active">
                    
                    <?php }else{ ?>

                        <div id="navpills-5" class="tab-pane">

                    <?php } ?>
                          <div class="row">
                            <div class="col-md-4">
                            <?php if($soc){ ?>

                                 <form method="post" action="<?php echo base_url() ?>general/editSocialnetwork" enctype="multipart/form-data">

                                                <label>Title:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="title" required="" value="<?php echo $soc->title ?>" placeholder="Title">
                                                    
                                                </div>

                                               
                                                <label>Link:</label>
                                                 <div class="form-group">
                                                    <input type="text" class="form-control" name="link" placeholder="Eg: http://www.facebook.com/" value="<?php echo $soc->link ?>" required="">
                                                 </div>
                                                 
                                                <label>Icon:</label>
                                                <div class="form-group">
                                                    
                                        <input type="text" class="form-control"  name="icon" value="<?php echo $soc->icon ?>">
<!--                                        <small style="color: red">Note: Please select 35px * 35px Image</small>           -->
                                                </div>
                                        <div>
<!--	                                        <img src="<?php //echo base_url().$soc->icon ?>" id="icondisplay">-->
	                                        <span class="<?php echo $soc->icon ?> fa-3x"></span>
	                                    </div>         
                                        
                                        <input type="hidden" name="soc_id" value="<?php echo $soc->id ?>">        
                                  

                                   <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 5px">Update</button>
                                </form>




                            <?php }else{ ?>    
                                <form method="post" action="<?php echo base_url() ?>general/insertSocial" enctype="multipart/form-data">

                                                <label>Title:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" name="title" required="" placeholder="Title">
                                                    
                                                </div>

                                               
                                                <label>Link:</label>
                                                 <div class="form-group">
                                                    <input type="text" class="form-control" name="link" placeholder="Eg: http://www.facebook.com/" required="">
                                                 </div>
                                                 
                                                <label>Icon:</label>
                                                <div class="form-group">
                                                    
                                        <input type="text" class="form-control" id="icon" name="icon" required="" placeholder="Eg: fa fa-icon">
<!--                                        <small style="color: red">Note: Please select 35px * 35px Image</small>           -->
                                                </div>
                                                
                                  

                                   <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right">Submit</button>
                                </form>

                            <?php } ?>    

                                           
                                            </div>
                                              
                      <div class="col-md-8">
                                              
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <h3 class="card-title">Social Networking</h3>
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>Icon</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                      $soc = $this->db->query("select * from fdm_va_social_networking where deleted=0 order by id desc")->result();
                                           if($soc){
                                           foreach ($soc as $u) {  ?> 
                                           <?php if($u->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->title ?></td>
                                                <td style="padding: 0.5rem;">
<!--                                                    <img src="<?php //echo base_url().$u->icon ?>" style="width: 35px; height: 35px">-->
                                                <span class="<?php echo $u->icon ?> fa-3x"></span>
                                                </td>
                                                <td style="padding: 0.5rem;">
                                                   
                                                <?php if($u->status=="Active"){ ?>
                                               <div class="switch">
                                                   <input type="checkbox" data-on-color="info" soc_id="<?php echo $u->id ?>" name="social" data-off-color="success" checked>
                                               </div>
                                                   <?php  }elseif($u->status=="Inactive"){ ?>
                                                <div class="switch">
                                                    <input type="checkbox" soc_id="<?php echo $u->id ?>" data-on-color="info" name="social" data-off-color="success">
                                                   <?php } ?>
                                                </div>    
                                                </td>
                                                <td style="padding: 0.5rem;">
            <a href="<?php echo base_url() ?>general/update-social-site/<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
           
             <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="delSocialsite(this.id)"><i class="ti-trash"></i></a>                                      

                                                </td>
                                                  
                                            </tr>
                                        <?php } ?>
                                     <?php  
                                     
                                       }} ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                      </div>
                     </div>
                   </div> 
                  </div>      
<!-- End Social Networking       -->
                
                
<!--   Start Welcome Banner             -->
                
         			


                    <div id="navpills-8" class="tab-pane">

                   		<div class="row">
                            <div class="col-md-4">
                                <form method="post" action="<?php echo base_url() ?>general/insertCharges" enctype="multipart/form-data">

                                               <label>City: </label>
                                               <div class="form-group">
                                               	
                                               	<select class="form-control" name="location" required>
                                               		<option value="">Select City</option>
                                               		
                                               		<?php
														$locations = $this->db->get_where("tbl_locations",array("deleted"=>0))->result();
											 
											 			foreach($locations as $ll){
													?>			
													<option value="<?php echo $ll->id ?>"><?php echo $ll->location ?></option>
													<?php } ?>	
                                               	</select>
                                               	
                                               </div>
                                                
                                               <label>Charge Type: </label>
                                               <div class="form-group">
                                               	
                                               	<select class="form-control" name="chargeType" required>
                                               		<option value="">Select Charge Type</option>
                                               		
                                               		<option value="deliveryCharges">Delivery Charges</option>
                                               		<option value="minOrder">Minimum Order</option>
														
                                               	</select>
                                               	
                                               </div> 
                                                
                                               <label>Order Type: </label>
                                               <div class="form-group">
                                               	
                                               	<select class="form-control" name="orderType" required>
                                               		<option value="">Select Order Type</option>
                                               		<option value="deliveryonce">Delivery Once</option>
                                               		<option value="subscribe">Subscription</option>
														
                                               	</select>
                                               	
                                               </div> 
                                                
                                                
                                                <label>Delivery Charges:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="number" class="form-control" name="deliveryCharges" required="" placeholder="Delivery Charges">
                                                    
                                                </div>
                                                
                                                <label>Cut off Charges:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="number" class="form-control" name="cutoffCharges" required="" placeholder="Cut off charges">
                                                    
                                                </div>

                                                <label>Minimum Order Charges:</label>
                                                <div class="form-group">
                                                    
                                                    <input type="number" class="form-control" name="minCharges" required="" placeholder="Minimum Order Charges">
                                                    
                                                </div>
                                                
                                  

                                   <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right">Submit</button>
                                </form>

                            
                                           
                                            </div>
                                              
                      <div class="col-md-8">
                                              
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <h3 class="card-title">Charges</h3>
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config5">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>City</th>
                                                <th>Charge Type</th>
                                                <th>Order Type</th>
                                                <th>Deliver charges</th>
                                                <th>Cutoff charges</th>
                                                <th>Minimum charges</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                      $loc1 = $this->db->query("select * from tbl_charges order by id desc")->result();
                                           if(count($loc1) > 0){
                                           foreach ($loc1 as $u) {  ?> 
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_locations",array("id"=>$u->city_id))->row()->location ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->chargeType ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->deliveryType ?></td>
                                                <td style="padding: 0.5rem;"><i class="fa fa-rupee"></i> <?php echo $u->deliveryCharges ?></td>
                                                <td style="padding: 0.5rem;"><i class="fa fa-rupee"></i> <?php echo $u->cutoffCharges ?></td>
                                                <td style="padding: 0.5rem;"><i class="fa fa-rupee"></i> <?php echo $u->minimumCharges ?></td>
                                                
                                                 <td style="padding: 0.5rem;">
                                                   
                                                <?php if($u->status=="Active"){ ?>
                                               <div class="switch">
                                                   <input type="checkbox" data-on-color="info" soc_id="<?php echo $u->id ?>" name="charges" data-off-color="success" checked>
                                               </div>
                                                   <?php  }elseif($u->status=="Inactive"){ ?>
                                                <div class="switch">
                                                    <input type="checkbox" soc_id="<?php echo $u->id ?>" data-on-color="info" name="charges" data-off-color="success">
                                                   <?php } ?>
                                                </div>    
                                                </td>
                                               
                                                
                                                <td style="padding: 0.5rem;">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
           
             <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="delCharges(this.id)"><i class="ti-trash"></i></a>                                      

                                                </td>
                                                  
                                            </tr>
                                            
                                            
              <div id="myModal<?php echo $u->id ?>" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<h4 class="modal-title">Update Charges</h4>
				  </div>
				  <div class="modal-body">
				  
				  	<form method="post" action="<?php echo base_url() ?>general/updateCharges" enctype="multipart/form-data">

					   <label>City: </label>
					   <div class="form-group">

						<select class="form-control" name="location" required>
							<option value="">Select City</option>

							<?php
								$locations = $this->db->get_where("tbl_locations",array("deleted"=>0))->result();

								foreach($locations as $ll){
							?>			
							<option value="<?php echo $ll->id ?>" <? echo ($ll->id == $u->city_id) ? 'selected' : '' ?> ><?php echo $ll->location ?></option>
							<?php } ?>	
						</select>

					   </div>

					   <label>Charge Type: </label>
					   <div class="form-group">

						<select class="form-control" name="chargeType" required>
							<option value="">Select Charge Type</option>

							<option value="deliveryCharges" <? echo ($u->chargeType == 'deliveryCharges') ? 'selected' : '' ?>>Delivery Charges</option>
							<option value="minOrder" <? echo ($u->chargeType == 'minOrder') ? 'selected' : '' ?>>Minimum Order</option>

						</select>

					   </div> 

					   <label>Order Type: </label>
					   <div class="form-group">

						<select class="form-control" name="orderType" required>
							<option value="">Select Order Type</option>
							<option value="deliveryonce" <? echo ($u->deliveryType == 'deliveryonce') ? 'selected' : '' ?>>Delivery Once</option>
							<option value="subscribe" <? echo ($u->deliveryType == 'subscribe') ? 'selected' : '' ?>>Subscription</option>

						</select>

					   </div> 


						<label>Delivery Charges:</label>
						<div class="form-group">

							<input type="number" class="form-control" name="deliveryCharges" required="" value="<?php echo $u->deliveryCharges ?>" placeholder="Delivery Charges">

						</div>

						<label>Cut off Charges:</label>
						<div class="form-group">

							<input type="number" class="form-control" name="cutoffCharges" value="<?php echo $u->cutoffCharges ?>" required="" placeholder="Cut off charges">

						</div>

						<label>Minimum Order Charges:</label>
						<div class="form-group">

							<input type="number" class="form-control" name="minCharges" value="<?php echo $u->minimumCharges ?>" required="" placeholder="Minimum Order Charges">

						</div>
						
						<input type="hidden" name="c_id" value="<? echo $u->id ?>">

		   <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right">Update</button>
		</form>
				  
				  </div>
<!--
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
-->
				</div>

			  </div>
			</div>                              
                                            
                                            
                                            
                                        <?php } ?>
                                     <?php  
                                     
                                       } ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                      </div>
                     </div>
                   </div> 
                   	
                   
                   
                    </div>
                    
<!--       Location Ends             -->

			

			
<!--   End Welcome Banner             -->
               
               
                                          
                                    
                                                  
                              
                
                
       </div>  


</div>
</div>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                   
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

<script>
	

$(".check").bootstrapSwitch({size : 'small'});
$(".dvcheck").bootstrapSwitch({size : 'small'});
 $('.check').on('switchChange.bootstrapSwitch', function (e, state) {
  
		var status;

		if ($(this).is(":checked")){
			status = 1;
		}else{
			status = 0;
		}
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>General/mandatoryupdate",
			data:{status:status},
			success:function (data){
				//location. reload(true);
				if(data==1){
					Swal(
					  'Success!',
					  'Successfully Enabled.',
					  'success'
					)
				}else{
					Swal(
					  'Success!',
					  'Successfully Disabled.',
					  'success'
					)
				}
				console.log(data);
			},
			error:function(data){
				console.log(data);
			}

		});  
});	
	
$('.dvcheck').on('switchChange.bootstrapSwitch', function (e, state) {
  
		var status;

		if ($(this).is(":checked")){
			status = 1;
		}else{
			status = 0;
		}
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>General/dev_mode",
			data:{status:status},
			success:function (data){
				//location. reload(true);
				if(data==1){
					Swal(
					  'Success!',
					  'Successfully Enabled.',
					  'success'
					)
				}else{
					Swal(
					  'Success!',
					  'Successfully Disabled.',
					  'success'
					)
				}
				console.log(data);
			},
			error:function(data){
				console.log(data);
			}

		});  
});		
	
$("#assign_to").change(function(){

	var i=$("#assign_to").val();

	$.ajax({
		url:"<?php echo base_url();?>ajax/getAssignedcities",
		data:{id:i},
		type:"GET",
		success:function(data){

			$("#cloc").html(data);
		}
	})
});		
	
	
$('#zero_config').DataTable(); 

 function socialUrl(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#icondisplay').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#icon").change(function() {
  socialUrl(this);
});


// Social network starts

function socialFunction(id) {
  
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>general/editSocial/'+id,
        success: function(data) {
            //location.reload();  
         // window.location = "<?php //echo base_url() ?>pages/news-and-community/<?php //echo $pid ?>"
            console.log(data);
        }
    });
 
  } 


$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
      $('#zero_config').on('switchChange.bootstrapSwitch','input[name="social"]', function (e, state) {
        
          var soc_id = $(this).attr("soc_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>general/socialsitestatus",
                        data:{id:soc_id,status:status},
                        success:function (data){
                            
                            //location.reload();
                            if(data==1){
                                Swal(
                                  'Success!',
                                  'Social Site Successfully Enabled.',
                                  'success'
                                )
                            }else{
                                Swal(
                                  'Success!',
                                  'Social Site Successfully Disabled.',
                                  'success'
                                )
                            }
                        }


                    });  
        });

function delSocialsite(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this imaginary file!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Social Site has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>general/delSocialsite/'+id,
        success: function(data) {
            location.reload();  
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected Social Site is safe :)',
      'error',
      
    )
  }
})
}      


//social network ends


// Location starts
 
$('#zero_config1').dataTable();

$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
      $('#zero_config1').on('switchChange.bootstrapSwitch','input[name="location1"]', function (e, state) {
        
          var loc_id = $(this).attr("loc_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = 1;
                    }else{
                        status = 0;
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>general/Locationstatus",
                        data:{id:loc_id,status:status},
                        success:function (data){
                            
                            //location.reload();
                            if(data==1){
                                Swal(
                                  'Success!',
                                  'Location Successfully Enabled.',
                                  'success'
                                )
                            }else{
                                Swal(
                                  'Success!',
                                  'Location Successfully Disabled.',
                                  'success'
                                )
                            }
                        }


                    });  
        });

function delLocation(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this location!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Location has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>general/delLocation/'+id,
        success: function(data) {
            location.reload();  
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected Location is safe :)',
      'error',
      
    )
  }
})
}      


//Location ends
	
	

	
// Area starts
 
$('#zero_config2').dataTable();

$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
      $('#zero_config2').on('switchChange.bootstrapSwitch','input[name="area1"]', function (e, state) {
        
          var loc_id = $(this).attr("area_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>general/areastatus",
                        data:{id:loc_id,status:status},
                        success:function (data){
                            
                            //location.reload();
                            if(data==1){
                                Swal(
                                  'Success!',
                                  'Area Successfully Enabled.',
                                  'success'
                                )
                            }else{
                                Swal(
                                  'Success!',
                                  'Area Successfully Disabled.',
                                  'success'
                                )
                            }
                        }


                    });  
        });

function delArea(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this area!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Area has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>general/delArea/'+id,
        success: function(data) {
            location.reload();  
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected Area is safe :)',
      'error',
      
    )
  }
})
}      


//Area ends
	
	
	
	
	
	
	

// Logo

 function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#display').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#logo1").change(function() {
  readURL(this);
});

 function readURL1(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#display1').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#logo2").change(function() {
  readURL1(this);
});
	
	
function delCharges(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this imaginary file!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected item has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>general/delCharges/'+id,
        success: function(data) {
            location.reload();  
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected item is safe :)',
      'error',
      
    )
  }
})
}      
$('#zero_config5').dataTable();
  $('#zero_config5').on('switchChange.bootstrapSwitch','input[name="charges"]', function (e, state) {
        
          var soc_id = $(this).attr("soc_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>general/chargestatus",
                        data:{id:soc_id,status:status},
                        success:function (data){
                            
                            //location.reload();
                            if(data==1){
                                Swal(
                                  'Success!',
                                  'Successfully Enabled.',
                                  'success'
                                )
                            }else{
                                Swal(
                                  'Success!',
                                  'Successfully Disabled.',
                                  'success'
                                )
                            }
                        }


                    });  
        });

	
	

</script>


           

           
           
<!-- End footer -->