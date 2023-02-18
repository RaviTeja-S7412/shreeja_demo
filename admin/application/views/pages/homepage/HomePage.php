<?php admin_header(); ?>
<style type="text/css">
<?php 
  $pid = $this->uri->segment(3);

  $about = $this->uri->segment(4);	
  $p = $this->db->get_where("fdm_va_pages",array("controller_link"=>$pid))->row();
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
                        <h4 class="page-title">Edit <?php echo $p->page_name ?> Page</h4>
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
                                        <a href="<?php echo base_url() ?>pages">Pages</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit <?php echo $p->page_name ?> Page</li>
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
									
									if($about != ""){
									?>	
									<li class=" nav-item"> <a href="#navpills-1" class="nav-link" data-toggle="tab" aria-expanded="false">Homepage Banner</a> </li>
                                    		
									<?php	
										}else{ 
									?>
                                   
                                   	<li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Homepage Banner</a> </li>
                                    
                                    <?php } ?>
                                    
                                    
                                    <li class="nav-item"> <a href="#navpills-2" class="nav-link" data-toggle="tab" aria-expanded="false">Company Overview</a> </li>
                                    
                                    <?php 
									
									if($about != ""){
									?>	
									  <li class="nav-item"> <a href="#navpills-3" class="nav-link active" data-toggle="tab" aria-expanded="true">About Us Section</a> </li>                                    
                                    <?php }else{ ?>
                                     <li class="nav-item"> <a href="#navpills-3" class="nav-link" data-toggle="tab" aria-expanded="true">About Us Section</a> </li> 
                                     
                                     
                                     <li class="nav-item"> <a href="#navpills-4" class="nav-link" data-toggle="tab" aria-expanded="true">Food Safety Policy</a> </li> 
                                     
                                    <?php } ?> 
                                </ul>
                                <div class="tab-content br-n pn">
                                   
                                   
                              <?php
									if($about != ""){
										
								?>
                                    <div id="navpills-1" class="tab-pane">
								<?php				
									}else{
								?>		
								
								 <div id="navpills-1" class="tab-pane active">
	
								<?php						
									}
									?>
                                   
                                          
                          <div class="row">
                                            
                                            <div class="col-md-6">
                                <?php 
                                
                                  $img = $this->db->get_where("fdm_va_home_slider_images")->row();
                                ?>              
                                              <form method="post" action="<?php echo base_url() ?>pages/Homepage/updateBanner" enctype="multipart/form-data">
                                                
                                                
                                                <div class="form-group">
                                                <label>Select Banner:</label>
                                                    
                                                    <input type="file" class="form-control" name="banner_image">
<!--                                                <small style="color: red">Note: Please select 1920px * 480px Image</small> -->
                                                </div>
                                                
                                                <div class="form-group">
                                                <label>Banner Description:</label>
                                                    
                                                   <textarea id="summernote1" class="form-control" name="banner_text" rows="4" required><?php echo $img->description ?></textarea>
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
                                  <img class="img" src="<?php echo base_url().$img->images ?>" style="width: 100%; height: 150px"  alt="user"/>
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
                                    <div id="navpills-2" class="tab-pane">
                                <?php 
										$w = $this->db->query("select * from tbl_company_overview")->row(); 
                                      if($w){
                                ?>  
                                      <form method="post" action="<?php echo base_url() ?>pages/Homepage/welcomenote/<?php echo $w->id ?>" enctype="multipart/form-data">
                                      <div class="row">
                                            
                                          <div class="col-md-6">  

                                                <label>Select Image:</label>
                                                <div class="input-group">
                                                    
                                                    <input type="file" class="form-control" name="image">
                                                </div>
                                              
                                                <label>Description:</label>
                                                <div class="input-group">
                                                    
                                                    <textarea class="form-control" id="summernote" name="description" required rows="6"><?php echo $w->description ?></textarea>
                                                    
                                                </div>
                                 
                                              <div class="col-md-2">
                                                
                                                  <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 25px">Submit</button>
                                                
                                              </div>
                                            </div>
                                     </div> 

                                          </form>
                                    <?php  } ?>        
                                    </div>


                            					 <?php 
						if($about != ""){ 

					 ?>	
					  <div id="navpills-3" class="tab-pane active">
					 <?php }else{ ?>

					  <div id="navpills-3" class="tab-pane">

					 <?php } ?>       
							   <div class="row">
									 <div class="col-md-5">

                                            <?php 
						 					if($about != ""){ 

                                              $smen = $this->db->get_where("tbl_about_us_homepage",array("id"=>$about))->row();

                                            ?>
                                            <form method="post" action="<?php echo base_url() ?>pages/Homepage/updateAbout" enctype="multipart/form-data">

                                                <label>Name:</label>
                                                <div class="input-group">
                                                    
                                                    <input type="text" class="form-control" name="title" required="" placeholder="Title" value="<?php echo $smen->title ?>">
                                                    
                                                </div>

                                               
                                                
                                                
                                                 <div class="form-group has-danger">
                                                    <label class="control-label">Link</label>
 
                                                     <input type="text" name="link" id="link" value="<?php echo $smen->link ?>" placeholder="Link" class="form-control" required>
                                                </div>
                                                 
                                              
                                                 <div class="form-group has-success">
                                                    <label class="control-label">Target</label>
                                                    <select class="form-control" required name="target" id="">
                                                        <option value="">Select Link Target</option>
								<option value="_blank" <?php if($smen->target == '_blank') { ?>  selected="selected"<?php } ?>>Blank</option>
								<option value="_self" <?php if($smen->target == '_self') { ?>  selected="selected"<?php } ?>>Self</option>

                                                    </select>
                                                </div>
                                              
                                                
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Description</label>
													<textarea name="desc" placeholder="Description" class="form-control" rows="4" required><?php echo $smen->description ?></textarea>
                                                </div>
                                               
                                                

                                  <input type="hidden" name="s_id" value="<?php echo $smen->id ?>"> 

                                   <button type="submit" id="msubmit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 10px">Update</button>
                                              </form>


                                          <?php  }else{ ?> 
                                              <form method="post" action="<?php echo base_url() ?>pages/Homepage/insertAbout" enctype="multipart/form-data">

                                                <label>Title:</label>
                                                <div class="input-group">
                                                    
                                                    <input type="text" class="form-control" name="title" required="" placeholder="Title" id="title">
                                                    
                                                </div>

                                              
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Link</label>
													<input type="text" name="link" id="link" placeholder="Link" class="form-control" required>
                                                </div>
                                                
                                               

                                                <div class="form-group has-success">
                                                    <label class="control-label">Target</label>
                                                    <select class="form-control" required name="target">
                                                        <option value="">Select Link Target</option>
                                                         <option value="_blank">Blank</option>
                                                         <option value="_self">Self</option>

                                                    </select>
                                                </div>
											
												
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Description</label>
													<textarea name="desc" placeholder="Description" class="form-control" rows="4" required></textarea>
                                                </div>
                                                
                                
                                   <button type="submit" id="msubmit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 5px">Submit</button>
                                              </form>

                                            <?php } ?>
                                            </div>
                                              
                      <div class="col-md-7">
                                              
                        <div class="card">
                            <div class="card-body">
<!--                                <h3 class="card-title">Existing Side Menus</h3>-->
                                <div class="table-responsive">
                                    <table class="table product-overview" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Title</th>
                                                <th>Link</th> 
                                                <th>Target</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                      $nsm = $this->db->query("select * from tbl_about_us_homepage order by id desc")->result();
                                           if($nsm){
                                           foreach ($nsm as $ns) {  ?> 
                                           <?php if($ns->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $ns->title ?></td>
                                               
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
            <a href="<?php echo base_url() ?>pages/dynamic-page/homepage/<?php echo ($ns->id) ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
           
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
                    
                    
                    
                    
           		  <div id="navpills-4" class="tab-pane">    
                    
        					<div class="row">
									 <div class="col-md-6">

                                            <?php  

                                              $fsp = $this->db->get_where("tbl_home_foodsafetypolicy")->row();

                                            ?>
                                            <form method="post" action="<?php echo base_url() ?>pages/Homepage/updatefsp" enctype="multipart/form-data">

                                                
                                                 <div class="form-group has-danger">
                                                    <label class="control-label">Link</label>
 
                                                     <input type="text" name="link" id="link1" value="<?php echo $fsp->link ?>" placeholder="Link" class="form-control" required>
                                                </div>
                                                 
                                              
                                                 <div class="form-group has-success">
                                                    <label class="control-label">Target</label>
                                                    <select class="form-control" required name="target" id="">
                                                        <option value="">Select Link Target</option>
								<option value="_blank" <?php if($fsp->target == '_blank') { ?>  selected="selected"<?php } ?>>Blank</option>
								<option value="_self" <?php if($fsp->target == '_self') { ?>  selected="selected"<?php } ?>>Self</option>

                                                    </select>
                                                </div>
                                              
                                                
                                                <div class="form-group has-danger">
                                                    <label class="control-label">Description</label>
													<textarea name="desc" placeholder="Description" class="form-control" rows="4" required><?php echo $fsp->description ?></textarea>
                                                </div>
                                               
                                                

                                  <input type="hidden" name="f_id" value="<?php echo $fsp->id ?>"> 

                                   <button type="submit" id="bsubmit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 10px">Update</button>
                                              </form>

                   
									</div>
                    		</div>
				  </div>                         

                    <!-- Column -->
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


$(document).ready(function(){
		
		
		$("#summernote").summernote({
			height: 200,
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

		
		$("#summernote1").summernote({
			height: 200,
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

$(document).ready(function(){

 setTimeout(function(){},3000);
 $('.img').fadeIn();
}); 
    
$(document).ready(function(){
 $('#submit').click(function(){
  var files = $('#files')[0].files;
  var err = $("#files").val();

 if(err==""){
   Swal(
      'Error',
      'Please Select File :)',
      'error'
    );
     return false;
   return false; 
 }
  var error = '';
  var form_data = new FormData();
  for(var count = 0; count<files.length; count++)
  {
   var name = files[count].name;
   var extension = name.split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
     Swal(
      'Error',
      'Please Select Valid Image File :)',
      'error'
    );
     return false;
   }
   else
   {
    form_data.append("files[]", files[count]);
   }
  }
  if(error == '')
  {
   $.ajax({
    beforeSend:function()
    {
     $('#uploading').html('<button class="btn waves-effect waves-light btn-rounded btn-primary">Uploading</button>');
    },
    url:"<?php echo base_url(); ?>pages/Homepage/insertImages", //base_url() return http://localhost/tutorial/codeigniter/
    method:"POST",
    data:form_data,
    contentType:false,
    cache:false,
    processData:false,
   
    success:function(data)
    {
       //$('#uploaded_images').html(data);
    //$('#files').val('');
        Swal(
              'success!',
              'Successfully Uploaded.',
              'success'
            )
         //$("#load").html('<div class="alert alert-success">Successfully Uploaded</div>');
         setTimeout(function(){ location.reload(); }, 2000);
    },
    error:function(data){
        console.log(data);
         //$("#load").html('<div class="alert alert-danger">Error Occured While Uploading Images</div>');
         Swal(
              'Error',
              'Error Occured While Uploading Images :)',
              'error'
            );
         return false;
    }   
   })
  }
  else
  {
   alert(error);
  }
 });
});

</script>
<script type="text/javascript">


function editImg(id) {
       Swal({
  title: 'Are you sure?',
  text: 'Selected Changes Will Be Reflected At Front End!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Update it!',
  cancelButtonText: 'No, Leave it'
}).then((result) => {
  if (result.value) {

    
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>pages/Homepage/updateImg',
        success: function(data) {
          if(data==1){
            Swal(
              'Disabled!',
              'Your Selected Image has been Successfully Disabled.',
              'success'
            )
            setTimeout(function(){ location.reload(); }, 2000);
            console.log(data);
            return false;
           }
           if(data==2){
            Swal(
              'Enabled!',
              'Your Selected Image has been Successfully Enabled.',
              'success'
            )
            setTimeout(function(){ location.reload(); }, 2000);
            console.log(data);
            return false;
           } 
               
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Image Is Not Updated :)',
      'error'
    )
    console.log(data);
  }
})
    }

function delImg(id) {
       Swal({
  title: 'Are you sure?',
  text: 'Selected Image Will Be Permanently Deleted!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Delete it!',
  cancelButtonText: 'No, Leave it'
}).then((result) => {
  if (result.value) {

    
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>pages/Homepage/delImg',
        success: function(data) {
          console.log(data);
          if(data==1){
            Swal(
              'Deleted!',
              'Your Selected Image has been Successfully Deleted.',
              'success'
            )
            setTimeout(function(){ location.reload(); }, 2000);

            console.log(data);
            return false;
           }
           if(data==0){
            Swal(
              'Error!',
              'Error Occured While Deleting File.',
              'error'
            )
            console.log(data);
            return false;
           } 
               
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Image Is Not Deleted :)',
      'error'
    )
  }
})
    }    

	
// End Home Banner	
	
	
// About Us Script	
	
	
$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});
$('#zero_config').DataTable();

    $('#zero_config').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
        
          var news_id = $(this).attr("news_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = "Active";
                    }else{
                        status = "Inactive";
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>pages/Homepage/aboutstatus",
                        data:{id:news_id,status:status},
                        success:function (data){
                            
                           // location.reload();
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
      'Your Selected Item has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>pages/Homepage/delAbout/'+id,
        success: function(data) {
            //location.reload();  
          window.location = "<?php echo base_url() ?>pages/dynamic-page/homepage"
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected Item is safe :)',
      'error',
      
    )
  }
})
}	
	
	
	
	
</script>



            <!-- End footer -->