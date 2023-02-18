<?php admin_header(); ?>

<?php 
    $id = $this->uri->segment(3);

    $hid = $this->db->get_where("fdm_va_navbar_header_submenu",array("id"=>$id))->row()->menu_name;

	$main_menu = $this->db->get_where("fdm_va_navbar_header_menu",array("id"=>$hid))->row()


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
       
   <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Edit Sub Menu</h4>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex no-block justify-content-end align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="<?php echo base_url() ?>menus/sub-menu/<?php echo $sm->menu_name ?>"><?php //echo $main_menu->name ?>Sub Menus</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit <?php echo $sm->sub_menu_name ?></li>
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
                <!-- ============================================================== -->
            


                

<!-- Navbar Sub Menu  -->
            <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="card">
                            <form action="<?php echo base_url() ?>navbar/navbar_menu/editNavbarsubmenu" method="post">
                               <!--  <div class="card-body">
                                    <h4 class="card-title">Navbar Header</h4>
                                </div> -->
                                
                                <div class="form-body">
                                    <div class="card-body">
                                        <div class="row">
                                             <div class="col-md-4">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Menu Name</label>
                                                     
                                                     <select class="form-control" name="menu_name">
                                                       <?php 
                                $mm = $this->db->query("select * from fdm_va_navbar_header_menu where deleted=0 and status='Active'")->result();
                                                            foreach ($mm as $m) {
                                                            if($sm->menu_name==$m->id){
                                                        ?>
                                                        <option value="<?php echo $m->id ?>" selected><?php echo $m->name ?></option> 
                                                       <?php }else{ ?>
                                                        <option value="<?php echo $m->id ?>"><?php echo $m->name ?></option>
                                                       <?php }} ?>
                                                    </select>
                                                     </select>
                                                </div>
                                            </div>
  
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Sub Menu Name</label>
                                                    <input class="form-control" placeholder="Sub Menu Name" name="sub_menu_name" value="<?php echo $sm->sub_menu_name ?>" required="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Sub Menu Link</label>
  
                                                     <input type="text" name="sub_menu_link" id="link" value="<?php echo $sm->sub_menu_link ?>" placeholder="Sub Menu Link" class="form-control" required>

                                                     
                                                </div>
                                            </div>
                                            
									</div>        
                                            
									<div class="row">		
                                            <div class="col-md-4">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Link Target</label>
                                                    <select class="form-control" required name="sub_menu_target">
<option value="_blank" <?php if($sm->sub_menu_target == '_blank') { ?>  selected="selected"<?php } ?>>Blank</option>
<option value="_self" <?php if($sm->sub_menu_target == '_self') { ?>  selected="selected"<?php } ?>>Self</option>

                                                    </select>
                                                </div>
                                            </div>
                                               
                                             
                                            <div class="col-md-4">
                                                <div class="form-group has-success">
                                                    <label class="control-label">Menu Type</label>
                                                    <select class="form-control" required name="menu_type">
<option value="Header" <?php if($sm->menu_type == 'Header') { ?>  selected="selected"<?php } ?>>Header</option>
<option value="Footer" <?php if($sm->menu_type == 'Footer') { ?>  selected="selected"<?php } ?>>Footer</option>

                                                    </select>
                                                </div>
                                            </div>   
                                                   
                                               
                                         	<div class="col-md-4" style="margin-top: 5px">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success" id="msubmit"> <i class="fa fa-check"></i> Update</button>
                                                        </div>
                                                </div>
                                              </div> 
                                         	
                                        </div>
                                        
                                        
                                        
<!--
                                          <div class="row">
                                        	 <div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Meta Title</label>
														<input type="text" class="form-control" value="<?php //echo $sm->meta_title ?>" placeholder="Meta Title" name="meta_title" required="">
													</div>
											 </div>

											 <div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Meta Keyword</label>
														<input type="text" class="form-control" value="<?php //echo $sm->meta_keyword ?>" placeholder="Meta Keyword" name="meta_keyword" required="">
													</div>
											 </div>


											  <div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Meta Description</label>
														<textarea class="form-control" placeholder="Meta Description" name="meta_description" required rows="3"><?php //echo $sm->meta_description ?></textarea>
													</div>
											  </div>
                                                  
                                              <div class="col-md-2" style="margin-top: 5px">
                                                <div class="form-actions">
                                                    <br>
                                                        <div class="card-body">
                                                            <button type="submit" class="btn btn-success" id="msubmit" style="width: 100%"> <i class="fa fa-check"></i> Update</button>
                                                             <button type="reset" class="btn btn-dark">Cancel</button> 
                                                        </div>
                                                </div>
                                              </div>                                                                           
                                                   
                                        	
                                        </div>
-->
                                       <input type="hidden" name="id" value="<?php echo $sm->id ?>">
                                   
                                </div>
                            </form>
                            
                            </div>    
                        </div>

                    </div>
 <!-- End Navbar Sub Menu  -->   
 
                             
                                                         
                   




            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>

<script>


	
// Child Menu Status Starts
	
$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
$('#zero_config1').DataTable();

    $('#zero_config1').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
        
          var nav_id = $(this).attr("nav_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>navbar/navbar_menu/childmenustatus",
                        data:{id:nav_id,status:status},
                        success:function (data){
                            location. reload(true);
                        }

                    });  
        });
	
	
// Child Menu Status Ends
		



 
 
</script>

<script type="text/javascript">


function archiveFunction(id) {
       Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected child menu!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Child Menu has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>navbar/navbar_menu/delChildmenu/'+id,
        success: function(data) {
            //location.reload();  
            window.location = "<?php echo base_url() ?>navbar/edit-sub-menu/<?php echo $id ?>" 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Child Menu is safe :)',
      'success',
      
    )
  }
})
    }
</script>


            <!-- End footer -->