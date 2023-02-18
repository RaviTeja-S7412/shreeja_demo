<?php  admin_header();
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
              
       
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
                                    <li class="breadcrumb-item active" aria-current="page">Create Referals</li>
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
                    	<i class="fa fa-user"></i> Create Referal
                      </div>
                      <div class="col-md-2" style="text-align: right">
                       <a href="<?php echo base_url() ?>referals/referalslist">	
                    	<button class="btn btn-success waves-effect waves-light">Referal List</button>
                       </a>	
                      </div>	
                   </div> 	
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>referals/insertReferal">
                                <div class="card-body">
                                    
									<div class="row">
                                        
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Referrer Name
                                                <div class="input-group m-t-10">
                                                   
                                                	<select class="form-control tinch" name="referer" style="width: 100%;height: 36px;" data-live-search="true" required>
                                                		<option value="">Select Referrer</option>
														<?php 
														
														$users = $this->db->select("user_name,referral_id,userid")->get_where("shreeja_users",["steps_completed"=>4,"user_status"=>0])->result();
														$agents = $this->db->select("name,role,referral_id")->get_where("fdm_va_auths",["status"=>"Active","deleted"=>0,"role !="=>1])->result();
														
														foreach($users as $r){
														
														?>
                                                      
                                                      		<option value="<?php echo $r->referral_id ?>"><?php echo $r->user_name." - ".$r->referral_id ?></option>
                                                      
                                                        <?php } 
														foreach($agents as $ar){
															$role = $this->db->get_where("fdm_va_roles",["id"=>$ar->role])->row()->role_name;
														?>
                                                      
                                                      		<option value="<?php echo $ar->referral_id ?>"><?php echo $ar->name." (".$role.")" ?></option>
                                                      
                                                        <?php } ?>
														
												    </select>

                                                </div>

                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Referee Name
                                                <div class="input-group m-t-10">
                                                   
                                                	<select class="form-control tinch" name="referee" style="width: 100%;height: 36px;" data-live-search="true" required>
                                                		<option value="">Select Referee</option>
														<?php 
														
														foreach($users as $r2){
															
															$chkref = $this->db->get_where("tbl_user_referrals",["referee_id"=>$r2->userid])->num_rows();
															
															if($chkref == 0){
														
														?>
                                                      
                                                      		<option value="<?php echo $r2->userid ?>"><?php echo $r2->user_name." - ".$r2->referral_id ?></option>
                                                      
                                                        <?php }} 
														?>
												    </select>

                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                          
                                        <div class="col-sm-12 col-lg-3 col-md-3" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 30px;">
                                                
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
 <script>
	 
$('.tinch').selectpicker();	
</script>          