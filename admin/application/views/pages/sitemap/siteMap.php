<?php admin_header(); ?>
<style type="text/css">
<?php
  $nw_id = $this->uri->segment(2);
  
  $nchk = $this->db->get_where("fdm_va_news_and_community",array("id"=>base64_decode($nw_id)))->num_rows();
 	
  if($nchk == 1){
	  
	  $news_id = $this->uri->segment(2);
	  $side_menu = "";
	  
  }else{
	  
	  $news_id = "";
	  $side_menu = $this->uri->segment(2);
	  
  }	
	
  //$pid = $this->uri->segment(3);

?>

/*.img {
  background: url('http://thinkfuture.com/wp-content/uploads/2013/10/loading_spinner.gif') no-repeat;
}*/
</style>

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
                        <h4 class="page-title">Site Map</h4>
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
                                    
                                    <li class="breadcrumb-item active" aria-current="page">Site Map</li>
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
                <!-- Start Page Content -->
                <!-- ============================================================== -->
           <!--  <div class="card-header"> 
            <button class="btn waves-effect waves-light btn-rounded btn-info" data-toggle="modal" data-target="#responsive-modal"><i class="fa fa-plus"></i>&nbsp;Add Page</button>
            </div> -->

         
                    

        <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Nav Pills Tabs</h4> -->
                                <ul class="nav nav-pills m-b-30">
                                   
                                    <?php 
										if($side_menu != ""){ 

									  ?>
                                    
                                    <li class="nav-item"> <a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="true">Banner</a> </li> 
   									<?php }else{ ?>
                                    <li class="nav-item"> <a href="#navpills-3" class="nav-link active" data-toggle="tab" aria-expanded="true">Banner</a> </li> 
                                     <?php } ?>
                                    
                                      <?php 
										if($side_menu != ""){ 

									  ?>
                                     <li class="nav-item"> <a href="#navpills-2" class="nav-link active" data-toggle="tab" aria-expanded="false">Side Menu</a> </li>
                                     
   									  <?php }else{ ?>
                                     <li class="nav-item"> <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">Side Menu</a> </li>
                                     
                                     <?php } ?>
                                   
                                </ul>
                                <div class="tab-content br-n pn">
                                 
              <?php 
				if($side_menu != ""){ 

			   ?>	                   
               <div id="navpills-3" class="tab-pane">
              
              <?php }else{ ?>				
               <div id="navpills-3" class="tab-pane active">
              
              <?php } ?>                    
                                   
                          <div class="row">
                                            
                                            <div class="col-md-6">
                                <?php 
                                
                                  $img = $this->db->get_where("fdm_va_sitemap_banner",array("deleted"=>0))->row();
                                ?>              
                                              <form method="post" action="<?php echo base_url() ?>pages/sitemap/updateBanner" enctype="multipart/form-data">
                                                <div class="form-group">
                                                <label>Banner Description:</label>
                                                    
                                                   <textarea class="form-control" name="banner_text" rows="4" required><?php echo $img->description ?></textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                <label>Select Banner:</label>
                                                    
                                                    <input type="file" class="form-control" name="banner_image">
                                                <small style="color: red">Note: Please select 1920px * 480px Image</small> 
                                                </div>
                                                
                                                <div class="col-md-2">
                                               
                                               <input type="hidden" name="bid" value="<?php echo $img->id ?>"> 

                                                <button class="btn waves-effect waves-light btn-rounded btn-primary" type="submit">Update</button>


                                              </form>
                                            </div>
                                            </div>
                                            
                                              
                                            <div class="col-md-6">
                                              
                                                 <div id="uploaded_images">
                                                      <!-- <div class="row"> -->
                                              <div id="loading">
                                              </div>
              <div class="row el-element-overlay">
  <?php 


    if($img){ 
  ?>
                                       <!--        <div class="loading">
                                              </div> -->
                    <div class="col-md-6" class="image-wrapper">
                        <div class="card">
                            <div class="el-card-item" style="margin-bottom: -20px; padding-bottom: 0px">
                                <div class="el-card-avatar el-overlay-1"> 
                                  <img class="img" src="<?php echo base_url().$img->img ?>" style="width: 100%; height: 150px"  alt="user"/>
                                    <div class="el-overlay">
                                        <ul class="list-style-none el-info">
                                            <li class="el-item">

                                              <!-- <a class="btn default btn-outline image-popup-vertical-fit el-link" id="<?php //echo $img->id; ?>" onclick="editBannerstatus(this.id)"><i class="fa fa-edit"></i></a> -->
                                            </li>
                                            <!-- <li class="el-item">
                                              <a class="btn default btn-outline el-link" id="<?php //echo $img->id; ?>" onclick="delImg(this.id)"><i class="fa fa-trash"></i></a>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

    <?php } ?>
   
                </div>                    
      		 </div>
		</div>
	 <!-- Column -->
        </div> 
	</div> 			 
				 
				 
				 
				 
				 
					 <?php 
						if($side_menu != ""){ 

					 ?>	
					  <div id="navpills-2" class="tab-pane active">
					 <?php }else{ ?>

					  <div id="navpills-2" class="tab-pane">

					 <?php } ?>       
							   <div class="row">
									 <div class="col-md-5">

                                            <?php 
						 					if($side_menu != ""){ 

                                              $smen = $this->db->get_where("fdm_va_sitemap_side_menu",array("id"=>$side_menu))->row();

                                            ?>
                                            <form method="post" action="<?php echo base_url() ?>pages/sitemap/updateSidemenu" enctype="multipart/form-data">

                                                <label>Name:</label>
                                                <div class="input-group">
                                                    
                                                    <input type="text" class="form-control" name="name" required="" placeholder="Name" value="<?php echo $smen->name ?>">
                                                    
                                                </div>

                                                <br>
                                                
                                                
                                                 <div class="form-group has-danger">
                                                    <label class="control-label">Link</label>
 
                                                     <input type="text" name="link" id="link" value="<?php echo $smen->link ?>" placeholder="Link" class="form-control" required>
                                                </div>
                                                 
                                                <br>
                                                 <div class="form-group has-success">
                                                    <label class="control-label">Target</label>
                                                    <select class="form-control custom-select select" required name="target" id="">
                                                        <option value="">Select Link Target</option>
								<option value="_blank" <?php if($smen->target == '_blank') { ?>  selected="selected"<?php } ?>>Blank</option>
								<option value="_self" <?php if($smen->target == '_self') { ?>  selected="selected"<?php } ?>>Self</option>

                                                    </select>
                                                </div>
                                               
                                                

                                  <input type="hidden" name="s_id" value="<?php echo $smen->id ?>"> 

                                   <button type="submit" id="msubmit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 10px">Update</button>
                                              </form>


                                          <?php  }else{ ?> 
                                              <form method="post" action="<?php echo base_url() ?>pages/sitemap/insertSidemenu" enctype="multipart/form-data">

                                                <label>Name:</label>
                                                <div class="input-group">
                                                    
                                                    <input type="text" class="form-control" name="name" required="" placeholder="Name" id="title">
                                                    
                                                </div>

                                                <br>
												
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Link</label>
													<input type="text" name="link" id="link" placeholder="Link" class="form-control" required>
                                                </div>
                                                
                                                <br>

                                                <div class="form-group has-success">
                                                    <label class="control-label">Target</label>
                                                    <select class="form-control custom-select select" required name="target" id="">
                                                        <option value="">Select Link Target</option>
                                                         <option value="_blank">Blank</option>
                                                         <option value="_self">Self</option>

                                                    </select>
                                                </div>

                                                
                                
                                   <button type="submit" id="msubmit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 5px">Submit</button>
                                              </form>

                                            <?php } ?>
                                            </div>
                                              
                      <div class="col-md-7">
                                              
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Existing Side Menus</h3>
                                <div class="table-responsive">
                                    <table class="table product-overview" id="zero_config1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
<!--                                                 <th>Created Date</th>-->
                                                <th>Link</th> 
                                                <th>Target</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                      $nsm = $this->db->query("select * from fdm_va_sitemap_side_menu order by id desc")->result();
                                           if($nsm){
                                           foreach ($nsm as $ns) {  ?> 
                                           <?php if($ns->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $ns->name ?></td>
                                               
                                                <td style="padding: 0.5rem;"><?php echo $ns->link ?></td>
                                                <td style="padding: 0.5rem;"><?php switch($ns->target){
                                                      case "_top":
                                                        echo "Top";
                                                      break;  
                                                      case "_self":
                                                        echo "Self";
                                                      break;  
                                                      case '_parent':
                                                        echo "Parent";
                                                      break;  
                                                      case '_blank':
                                                      echo "Blank";   
                                                      break;
                                                      default:
                                                      echo "Blank";
                                                      break;
                                                    }      


                                                ?></td>
                                                <td style="padding: 0.5rem;">
                                                   
                                               <?php if($ns->status=="Active"){ ?>
                                               <div class="switch">
                                                   <input type="checkbox" data-on-color="info" news_id="<?php echo $ns->id ?>" name="switch" data-off-color="success" class="check" checked>
                                               </div>
                                                   <?php  }elseif($ns->status=="Inactive"){ ?>
                                                <div class="switch">
                                                    <input type="checkbox" news_id="<?php echo $ns->id ?>" data-on-color="info" name="switch" data-off-color="success" class="check">
                                                   <?php } ?> 
                                                </div> 
                                                </div>    
                                                </td>
                                                <td style="padding: 0.5rem;">
            <a href="<?php echo base_url() ?>site-map/<?php echo ($ns->id) ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
           
             <a href="#" name="delete" value="<?php echo $ns->id ?>" id="<?php echo $ns->id ?>" class="text-inverse sa-params"  onclick="delSidemenu(this.id)"><i class="ti-trash"></i></a>                                      

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
<br>            
<?php admin_footer(); ?>

<script type="text/javascript">

$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
$('#zero_config1').DataTable();

    $('#zero_config1').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
        
          var news_id = $(this).attr("news_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>pages/sitemap/sidemenustatus",
                        data:{id:news_id,status:status},
                        success:function (data){
                            
                           // location.reload();
                          if(data==1){
                                Swal(
                                  'Success!',
                                  'Side Menu Successfully Enabled.',
                                  'success'
                                )
                            }else{
                                Swal(
                                  'Success!',
                                  'Side Menu Successfully Disabled.',
                                  'success'
                                )
                            }
                        }


                    });  
        });




 function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#displayimage').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#image").change(function() {
  readURL(this);
});

// News and community
$('#zero_config').DataTable(); 

$('#zero_config1').DataTable(); 

function archiveFunction(id) {
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
      'Your Selected News has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>pages/Newscommunity/delNews/'+id,
        success: function(data) {
            //location.reload();  
          window.location = "<?php echo base_url() ?>news-and-community"
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected News is safe :)',
      'error',
      
    )
  }
})
}
	$(document).ready(function(){
		
		
		$("#summernote").summernote({
			height: 100,
			toolbar: [
				[ 'style', [ 'style' ] ],
				[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
				[ 'fontname', [ 'fontname' ] ],
				[ 'fontsize', [ 'fontsize' ] ],
				[ 'color', [ 'color' ] ],
				[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
				[ 'table', [ 'table' ] ],
				[ 'insert', [ 'link'] ],
				[ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
			]
    	});

		
	});

//news and community ends
	
// Side menu
	
function delSidemenu(id) {
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
      'Your Selected Menu has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>pages/sitemap/delSidemenu/'+id,
        success: function(data) {
            //location.reload();  
          window.location = "<?php echo base_url() ?>site-map"
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected Menu is safe :)',
      'error',
      
    )
  }
})
}	
	
	
	
</script>



            <!-- End footer -->