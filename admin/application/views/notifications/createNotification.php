<?php admin_header(); 

$id = $this->uri->segment(3);

?>

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
                                    <li class="breadcrumb-item active" aria-current="page">Create Notification</li>
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
                    	<i class="fa fa-user"></i> Create Notification
                      </div>
                      <div class="col-md-2" style="text-align: right">
                       <a href="<?php echo base_url() ?>notifications">	
                    	<button class="btn btn-success waves-effect waves-light">All Notifications</button>
                       </a>	
                      </div>	
                   </div> 	
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>notifications/<? echo isset($id) ? 'updateNotification' : 'insertNotification' ?>" enctype="multipart/form-data">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Employee User</h4> -->
                                    <div class="row">
                                       <div class="col-sm-12 col-lg-4 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                <label>Notification Type</label>
                                                <div class="input-group">
                                                   
                                                    <select class="form-control" name="notType" required>
                                                       
                                                       <? $notType = isset($nn->notification_type) ? $nn->notification_type : '' ?>
                                                       
                                                        <option value="">Select Type</option>
                                                    
                                                    	<option value="promotional" <? echo ($notType == 'promotional') ? 'selected' : '' ?> >Promotional</option>
                                                    	<option value="productlaunch" <? echo ($notType == 'productlaunch') ? 'selected' : '' ?>>Product Launch</option>
                                                    	<option value="pricechange" <? echo ($notType == 'pricechange') ? 'selected' : '' ?>>Price Change</option>
                                                   
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12 col-lg-4 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                <label>Send Type</label>
                                                <div class="input-group">
                                                  
                                                  <? $sendType = isset($nn->sendType) ? $nn->sendType : '' ?>
                                                       
                                                    <select class="form-control" name="sendType">
                                                        <option value="">Select Send Type</option>
                                                    	<option value="alternate" <? echo ($sendType == 'alternate') ? 'selected' : '' ?>>Alternate Days</option>
                                                   
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-12 col-lg-4 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                <label>Route</label>
                                                <div class="input-group">
                                                   
                                                   <? $route = isset($nn->route) ? $nn->route : '' ?>
                                                   
                                                    <select class="form-control" name="route">
                                                        <option value="">Select Route</option>
                                                    	<option value="products" <? echo ($route == 'products') ? 'selected' : '' ?>>Products</option>
                                                    	<option value="offers" <? echo ($route == 'offers') ? 'selected' : '' ?>>Offers</option>
                                                   
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                <label>Notification Title</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Notification Title" name="notTitle" required="" value="<? echo isset($nn->title) ? $nn->title : '' ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12 col-lg-4 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                <label>Notification Icon</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" name="notIcon">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12 col-lg-4 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                <label>Message</label>
                                                <div class="input-group">
                                                    <textarea class="form-control" placeholder="Message" name="notMessage" required rows="3"><? echo isset($nn->message) ? $nn->message : '' ?></textarea>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">   
											<div class="form-group">
												<label>Select Start & End Date :</label>
												<div class="input-daterange input-group" id="date-range">
													<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Start Date" autocomplete="off" value="<? echo isset($nn->start_date) ? $nn->start_date : '' ?>"  required>
													<div class="input-group-append">
														<span class="input-group-text bg-info b-0 text-white">TO</span>
													</div>
													<input type="text" class="form-control" name="endDate" id="edate" placeholder="End Date" autocomplete="off" value="<? echo isset($nn->end_date) ? $nn->end_date : '' ?>" required/>
												</div>
											</div>
										</div>
                                        
                                        <div class="col-md-3">
											<div class="form-group has-danger">
												<label class="control-label">City</label>
												<select class="form-control" required name="city">
													<option value="">Select City</option>

												<?php 
												$cty = isset($nn->city) ? $nn->city : ""; 

												$cities = $this->locations_model->getConsumercities();
												foreach($cities as $c){
												?>    

												 <option value="<?php echo $c->id ?>" <?php echo ($cty == $c->id) ? "selected" : ""; ?>><?php echo $c->location ?></option>
												<?php } ?>
												</select>              

											</div>
										</div>
                                        
                                        <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 30px;">
                                                
                                               <!--  <div class="input-group">
                                                    <div class="input-group-prepend"> -->

                                                   <input type="hidden" name="id" value="<? echo isset($id) ? $id : '' ?>">
                                                   
                                                    <button type="submit" class="btn btn-info waves-effect waves-light" style="width: 100%"><? echo isset($id) ? 'Update' : 'Save' ?></button>
                                                  
                                                <!--   </div>
                                                    
                                                    
                                                </div> -->

                                                </div>
                                            </div>
                                        </div>        

									</div>
																


                                </div>
                              
                               
                               
                            </form>

                        

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