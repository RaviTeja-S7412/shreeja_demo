<?php admin_header(); 
 if($this->session->userdata("admin_id")){  
     $au = $this->db->get_where("fdm_va_auths",array("id"=>$this->session->userdata("admin_id")))->row();
 }elseif($this->session->userdata("user_id")){
     $ua = $this->db->get_where("fdm_va_users",array("id"=>$this->session->userdata("user_id")))->row();
 }
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
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
            <!-- <div class="card"> -->
              
              <div class="row">
                <div class="col-lg-6">
                    <div class="user-pic" align="center">
                    <?php

//                            $emppic = $this->admin->get_admin("emp_id").".jpg"; 
//                           // $saname =  "uploads/admin/profile/superAdmin.jpg";
                            $aname =  $au->profile_pic;

                    if(file_exists($aname)){
                          ?>
                        <img src="<?php echo base_url().$aname; ?>" alt="users" class="rounded-circle img-fluid" style="height: 150px; width: 150px;">
                  
                    <?php }else{  ?>
                        <img src="<?php echo base_url() ?>uploads/admin/profile/1234.jpg" alt="users" class="rounded-circle img-fluid" style="height: 150px; width: 150px;">
                    <?php } ?>    
                    </div>
                    <div class="card-title" align="center" style="padding-top: 20px">
                        <p style="font-size: 20px"><strong>
                            <?php 
                                if($this->session->userdata("admin_id")){
                                echo $this->admin->get_admin("name"); 
                                }    
                            ?>
                        </strong></p>
                        <? if($au->role != 1){ ?>
                        	<span><strong>Referal ID : <? echo $au->referral_id ?></strong></span>
						<? } ?>
                    </div>
                    <div class="" align="center">
                        <button class="btn waves-effect waves-light btn-rounded btn-primary" id="updatePro">Update Profile</button>
                        <button class="btn waves-effect waves-light btn-rounded btn-info" id="updatePass">Update Password</button>
                    </div>

                </div>


                    <div class="col-lg-6">
                       
                            <div class="card-body">
                                <div id="uppro" style="display: none;">
                                <form class="form p-t-20" method="post" action="<?php echo base_url() ?>Dashboard/editProfile" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>User Name</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon11"><i class="ti-user"></i></span>
                                            </div>
                                            <?php  if($this->session->userdata("admin_id")){ ?>
                                                <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="admin_name" value="<?php echo $au->name ?>" aria-describedby="basic-addon11">
                                            <?php } ?>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon22"><i class="ti-email"></i></span>
                                            </div>
                                             <?php  if($this->session->userdata("admin_id")){ ?>
                                                <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="admin_email" value="<?php echo $au->email ?>" aria-describedby="basic-addon22">
                                             <?php } ?>       
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Profile Image</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon22"><i class="fa fa-user"></i></span>
                                            </div>
                                             <?php  if($this->session->userdata("admin_id")){ ?>
                                                <input type="file" class="form-control" aria-label="profile" name="profile_pic" aria-describedby="basic-addon22">
                                             <?php } ?>       
                                        </div>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-success m-r-10">Update</button>
                                    <button type="reset" class="btn btn-dark">Cancel</button>
                                </form>
                                <!-- <hr> -->
                                </div>
                                 <div id="uppass" style="display: none;">
                                <form class="form p-t-20" method="post" action="<?php echo base_url() ?>dashboard/changePassword">

                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon33"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="opass" aria-describedby="basic-addon33" required="">
                                        </div>
                                    </div>    

                                    <div class="form-group">
                                        <label>New Password</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon33"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="npass" aria-describedby="basic-addon33"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon4"><i class="ti-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" aria-label="Password" aria-describedby="basic-addon4"pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="">
                                        </div>
                                    </div>
                                     <button type="submit" class="btn btn-success m-r-10">Update</button>
                                    <button type="reset" class="btn btn-dark">Cancel</button>
                                    
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

    $("#updatePro").click(function(){
        
        $("#uppro").toggle();
        $("#uppass").hide();
        
    });
     $("#updatePass").click(function(){
        
        $("#uppass").toggle();
        $("#uppro").hide();
        
    });
</script>         