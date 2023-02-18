<?php 

	$d = get_instance(); 
    
	$au = $d->db->get_where("fdm_va_auths",array("id"=>$d->session->userdata("admin_id"),"deleted"=>0,"status"=>"Active",))->row();

?>

        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            <div class="user-profile dropdown m-t-20">
                                <div class="user-pic">

                        <img src="<?php echo base_url(); ?><?php echo ($au->profile_pic) ? $au->profile_pic : 'assets/images/users/1.jpg' ?>" alt="users" class="rounded-circle img-fluid">




                                </div>
                                <div class="user-content hide-menu m-t-10">
                                    <h5 class="m-b-10 user-name font-medium">
                                    <?php
                                    
										echo $d->admin->get_admin("name")."(".$d->db->get_where("fdm_va_roles",array("id"=>$au->role))->row()->role_name.")"; 
									
                                    ?>
                                    </h5>
                                    <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="ti-settings"></i>
                                    </a>
                                    <a href="<?php echo base_url() ?>dashboard/logout" title="Logout" class="btn btn-circle btn-sm">
                                        <i class="ti-power-off"></i>
                                    </a>
                                    <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                                        <a class="dropdown-item" href="<?php echo base_url() ?>admin/profile">
                                            <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                      
                                        <a class="dropdown-item" href="<?php echo base_url() ?>dashboard/logout">
                                            <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>
                        <!-- User Profile-->
                        <!-- <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Personal</span>
                        </li> -->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?>dashboard" aria-expanded="false">
                                <i class="icon-Car-Wheel"></i>
                                <span class="hide-menu">Dashboard </span>
                            </a>

                           <!--   <a class="sidebar-link waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="icon-Car-Wheel"></i>
                                <span class="hide-menu">Panel </span>
                            </a> -->
                         <!--    <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="index.html" class="sidebar-link">
                                        <i class="icon-Record"></i>
                                        <span class="hide-menu"> Dashboard 1 </span>
                                    </a>
                                </li>

                            </ul> -->
                        </li>
        <?php 
//              if($d->admin->get_admin_role()){
	
	
			$exRoles = $d->db->get_where("fdm_va_admin_role_access",array("role_id"=>$au->role))->row();
	
			$roles = isset($exRoles->modules) ? json_decode($exRoles->modules) : [];
									   
			$mids = array();							   
			$submodules = array();			
										   
			foreach($roles as $rm){
				
				$mids[] = $rm->module_id;
				$submodules[$rm->module_id] = $rm->sub_module_id;
				
			}						   
									   
	
                 $modules = $d->db->query("select * from fdm_va_modules where status=1 order by sort asc")->result();
                 foreach ($modules as $m) {
				
				 if(in_array($m->module_id,$mids)){
					 
                     $smodule = $d->db->get_where("fdm_va_sub_modules",array("module_id"=>$m->module_id))->result();
                                
         ?>      
                        <li class="sidebar-item">
                        
         <?php if($smodule){ ?>                   
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="<?php echo base_url() ?><?php echo $m->module_link ?>" aria-expanded="false">
                                <i class="<?php echo $m->module_icon ?>"></i>
                                <span class="hide-menu"><?php echo $m->module_name ?> </span>
                            </a>
         <?php }else{ ?>
                            <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?><?php echo $m->module_link ?>" aria-expanded="false">
                                <i class="<?php echo $m->module_icon ?>"></i>
                                <span class="hide-menu"><?php echo $m->module_name ?> </span>
                            </a>

         <?php } ?>                   
        
         <?php if($smodule){  ?>

                            <ul aria-expanded="false" class="collapse  first-level">
                              <?php 
								
								$ssmids = isset($submodules[$m->module_id]) ? $submodules[$m->module_id] : [];
							
								foreach ($smodule as $sm) {
									
								if(in_array($sm->sub_module_id,$ssmids)){	
									
                                  ?>  
                                <li class="sidebar-item">
                                    <a href="<?php echo base_url() ?><?php echo $sm->sub_module_link ?>" class="sidebar-link">
                                        <i class="mdi mdi-book-multiple"></i>
                                        <span class="hide-menu"> <?php echo $sm->sub_module_name ?> </span>
                                    </a>
                                </li>
                                
                             <?php }} ?>    
                            </ul>
                        <?php } ?>
                        </li>  
                         
        <?php }} ?>

        <?php 
//             if($d->admin->get_agent_role()){ 
//
//             $mods = $d->db->query("select * from fdm_va_modules where status=1 order by sort asc")->result();
//
//             foreach ($mods as $mm) {
//
//              $smods = $d->db->get_where("fdm_va_sub_modules",array("module_id"=>$mm->module_id))->result();  
        ?>
<!--

                        <li class="sidebar-item">
        <?php //if($smods){ ?>    
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="<?php echo base_url() ?><?php //echo $mm->module_link ?>" aria-expanded="false">
                                <i class="<?php //echo $mm->module_icon ?>"></i>
                                <span class="hide-menu"><?php //echo $mm->module_name ?> </span>
                            </a>
        <?php //}else{  ?>
                             <a class="sidebar-link waves-effect waves-dark" href="<?php //echo base_url() ?><?php //echo $mm->module_link ?>" aria-expanded="false">
                                <i class="<?php //echo $mm->module_icon ?>"></i>
                                <span class="hide-menu"><?php //echo $mm->module_name ?> </span>
                             </a>        
        <?php //} ?>     

        <?php //if($smods){ ?>                   
                            <ul aria-expanded="false" class="collapse first-level">
                            <?php //foreach ($smods as $smm) {
                              ?>
                                <li class="sidebar-item">
                                    <a href="<?php //echo base_url() ?><?php //echo $smm->sub_module_link ?>" class="sidebar-link">
                                        <i class="mdi mdi-book-multiple"></i>
                                        <span class="hide-menu"> <?php //echo $smm->sub_module_name ?> </span>
                                    </a>
                                </li>
                            <?php //} ?> 
                            </ul>
                        </li>
        <?php 
//            }
//		  }
//		}

		?>  
             
-->
<!--   Other roles         -->
             
             
             
             
              
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>dashboard/logout" aria-expanded="false">
                                <i class="mdi mdi-directions"></i>
                                <span class="hide-menu">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </nav>
           
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>