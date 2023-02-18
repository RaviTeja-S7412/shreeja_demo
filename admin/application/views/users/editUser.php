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
                    <div class="col-12 align-self-center">
                        <div class="d-flex no-block justify-content align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>users/all-users">Users</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Update User</li>
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
                    	<i class="fa fa-user"></i> Update User
                      </div>
                      <div class="col-md-3" style="text-align: right">
                       <a href="<?php echo base_url() ?>users/create-user">	
                    	<button class="btn btn-success waves-effect waves-light">Create Users</button>
                       </a>	
                      </div>
                      <div class="col-md-1" style="text-align: right">
                       <a href="<?php echo base_url() ?>users/all-users">	
                    	<button class="btn btn-success waves-effect waves-light">All Users</button>
                       </a>	
                      </div>	
                   </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>users/updateUser">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Employee User</h4> -->
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Name
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="ti-user"></i></span></div>
                                                    <input type="text" name="user_name" class="form-control" id="name" placeholder="Name" required="" value="<?php echo $u->name ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Email
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="ti-email"></i></span></div>
                                                    <input type="email" class="form-control" name="user_email" id="email" placeholder="Email" required="" value="<?php echo $u->email ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Designation
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="m-r-10 mdi mdi-account-circle"></i></span></div>
                                                    <input type="text" class="form-control" name="user_designation" id="designation" placeholder="Designation" required="" value="<?php echo $u->designation ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Role
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-star"></i></span></div>
                                                   <select class="form-control" id="status" name="user_role" required>
                                                    
                                                   <?php
                                                   
                                                   
                                                   $s=$this->db->get_where("fdm_va_roles")->result();
                                                   
                                                   foreach($s as $ss){
                                                       
                                                       if($ss->id==$u->role){
                                                           
                                                           echo '<option value="'.$ss->id.'" selected>'.$ss->role_name.'</option>';
                                                       }elseif($ss->id == 1){
													   
													   
													   }else{
                                                           
                                                           echo '<option value="'.$ss->id.'">'.$ss->role_name.'</option>';
                                                       }
                                                   }
                                                   
                                                   ?>

                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                     <div class="row">
                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Employee ID
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fab fa-black-tie"></i></span></div>
                                                    <input type="text" class="form-control" id="mobile" placeholder="Employee ID" name="emp_id" required="" value="<?php echo $u->emp_id ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Mobile Number
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="m-r-10 mdi mdi-cellphone"></i></span></div>
                                                    <input type="tel" class="form-control" maxlength="10" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" id="mobile" placeholder="Mobile Number" name="user_mobile_number" required="" value="<?php echo $u->mobile_number ?>">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                         
                                         <div class="col-sm-12 col-lg-3 col-md-3">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Status
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-info-circle"></i></span></div>
                                                    
                                                    <select class="form-control" id="status" name="user_status" required>
                                                       <option value="<?php echo $u->status ?>" selected><?php echo $u->status ?></option>
                                                       <?php if($u->status=="Active"){ ?>
                                                            <option value="Inactive">In Active</option>
                                                       <?php }else{ ?> 
                                                            <option value="Active">Active</option>
                                                       <?php } ?>      
                                                       
                                                    </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        
                                     
                                        <input type="hidden" name="id" value="<?php echo $u->id ?>">    

                                    </div>    
        <?php 
        $er = $this->db->get_where("fdm_va_auths",array("id"=>$u->id,"role"=>3))->num_rows();
        if($er==0){
        ?>                            
                                    <hr>
                                Modules:<br>
                                    <div class="row" style="padding-left: 10px">

                                       
                                        <?php 
                                        $i = 1;
                                        $mm = $this->db->get_where("fdm_va_modules")->result();
                                        
                                        foreach ($mm as $m) {

                                        ?>
                                        <div class="custom-control custom-checkbox mr-sm-2 m-b-15 col-md-2">

        <?php 
            $um = $this->db->get_where("fdm_va_admin_role_access",array("user_id"=>$u->id,"module_id"=>$m->module_id))->row();
                                        //foreach ($um as $uu) {
                                         if($um){
                                         if($m->module_id==$um->module_id){ ?>       
                        <input type="checkbox" name="module_id[]" class="custom-control-input" id="customCheck<?php echo $i ?>" value="<?php echo $m->module_id ?>" checked>
                                         <?php }else{ ?>
                        <input type="checkbox" name="module_id[]" class="custom-control-input" id="customCheck<?php echo $i ?>" value="<?php echo $m->module_id ?>">
                                         <?php }}else{ ?>
                        <input type="checkbox" name="module_id[]" class="custom-control-input" id="customCheck<?php echo $i ?>" value="<?php echo $m->module_id ?>">
                                            

                                       <?php  } ?>                      
                        <label class="custom-control-label" for="customCheck<?php echo $i ?>"><?php echo $m->module_name ?></label>
                                        <?php //}else{ ?>
                        <!-- <label class="custom-control-label" for="customCheck1<?php echo $i ?>"><?php echo $m->module_name ?></label> -->
                                        <?php //} ?>
                                            </div>
                                            <?php 
                                                $i++;
                                                }
                                            ?>   
                                        </div> 

			<?php 
		
		}
//		else{ 
//					
//				  $mm = $this->db->get_where("fdm_va_modules")->result();
//				
//				  $um = $this->db->get_where("fdm_va_admin_role_access",array("user_id"=>$u->id))->row();
//				
//				$mids = array();
//				
//				foreach($mm as $m){
//					
//					$mids[] = $m->module_id;
//				}
//			
//
//				  $chkuemodule = in_array($um->module_id,$mids);
//			
//				  if($chkuemodule){
					  
			?>
                               
<!--                      <input type="hidden" name="m_id" value="<?php //echo $um->module_id ?>">         -->
                               
            <?php //}else{
					  //echo("n");
				  //}} ?>                    

                                </div>
                                   <div class="row">
                                       <div class="col-md-9 col-lg-9">
                                       	
                                       </div>
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



</script>          