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
	
	$id = $this->uri->segment(2);

	$p = $this->db->get_where("pages",array("deleted"=>0,"id"=>$id))->row();

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
                                    <li class="breadcrumb-item active" aria-current="page">Meta Data</li>
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
              
           <?php if($id != ""){ ?>   
              
            <div class="card">
                <div class="card-header">
                   <div class="row">
                  	  
                   	  <div class="col-md-10">
                   	  
                    	<i class="mdi mdi-contact-mail"></i>
								
							Updata Meta Data	
	
                   	  
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
               
				
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>superadmin/metaData/Metadata/updateMeta">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Employee User</h4> -->
                                    <div class="row">
                                       
                                          <div class="col-sm-12 col-md-2">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12">
                                                Page Name
                                                <div class="input-group">
                                                   <select class="form-control" id="status" name="pid" required>
                                                       <?php
														
															$pages = $this->db->get_where("pages",array("status"=>"Active","deleted"=>0))->result();

															foreach($pages as $pp){
																
															if($pp->id == $p->id){			
														?>	
																	
                                                  		<option value="<?php echo $pp->id ?>" selected><?php echo $pp->page_name ?></option>
                                                  		
                                                  		<?php }else{ ?>
                                                  		
                                                  		<option value="<?php echo $pp->id ?>"><?php echo $pp->page_name ?></option>
                                                  		
                                                  		<?php }} ?>
                                                  		
                                                   </select>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                       
                                       
                                        <div class="col-sm-12 col-md-2">
                                          <div class="form-group">
                                                Meta Title
											  <div class="input-group field_wrapper">
											  
											     <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="<?php echo $p->meta_title ?>" required>
											    
											  </div>
											
										  </div>
									    </div>
                                       
                                       <div class="col-sm-12 col-md-3">
                                          <div class="form-group">
                                                Meta Keyword
											  <div class="input-group field_wrapper">
											  
											     <input type="text" name="meta_keyword" class="form-control" placeholder="Meta Keyword" value="<?php echo $p->meta_keyword ?>" required>
											    
											  </div>
											
										  </div>
									    </div>
                                       
                                       <div class="col-sm-12 col-md-3">
                                          <div class="form-group">
                                                Meta Description
											  <div class="input-group field_wrapper">
											  
											     <textarea class="form-control" name="meta_description" rows="4" placeholder="Meta Description" required><?php echo $p->meta_description ?></textarea>
											     
											  </div>
											
										  </div>
									    </div>
                                        
                                        
                                         <div class="col-sm-12 col-md-2" align="right">
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-12" style="margin-top: 20px;">
                                                
                                                    <button type="submit" class="btn btn-info waves-effect waves-light" style="width: 100%">Update</button>
                                                  
                                                
                                                </div>
                                            </div>
                                        </div>

										</div>
                                    </div>

                              
                   </form>
               
                </div>
            </div>
            
            
            <?php  } ?>
            
            <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <h4 class="card-title">Nav Pills Tabs</h4> -->
                                <ul class="nav nav-pills m-b-30">
				
                                     
                                    <li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">Meta Data</a> </li>
                                 
				             
                                </ul>
                <div class="tab-content br-n pn">
             
             
    			 <div id="navpills-1" class="tab-pane active">

             		<div class="row">
						
						<div class="col-12">
                        <div class="card" style="border:0px">
                          <div align="center" style="margin-top: 20px"><p class="text_font"><strong>Existing Meta Data</strong></p></div>
                             <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="mainmenu">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Page Name</th>
                                                <th>Title</th>
                                                <th>Keywords</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $i = 0;
										$opt = $this->db->query("select * from pages where deleted=0 order by id asc")->result();       	
                                           foreach ($opt as $u) {  
										?> 
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center"><?php echo ++$i ?></td>
                                                <td style="vertical-align: middle;"><?php echo $u->page_name ?></td>
                                                <td style="vertical-align: middle;"><?php echo $u->meta_title ?></td>
                                                <td style="vertical-align: middle;"><?php echo $u->meta_keyword ?></td>
                                                <td style="vertical-align: middle;"><?php echo $u->meta_description ?></td>
                                                <td style="vertical-align: middle;"><a href="<?php echo base_url() ?>meta-data/<?php echo $u->id ?>"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></button></a></td>    
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


	$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('#add_email'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper

	
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append('<div class="col-md-12"><input type="email" name="email[]" class="form-control col-md-11" placeholder="Email" required> <p class="sub_p_rem'+x+'" id="remove_button" align="right" style="margin-top: -35px"><button class="btn btn-danger waves-effect waves-light" type="button"><i class="ti-close"></i></button><br></p></div>'); //Add field html
			
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '#remove_button', function(e){
        e.preventDefault();
		var id =$(this).attr('class');
		$(this).parent('div').remove(); //Remove field html
		$('.'+id).remove();
        x--; //Decrement field counter
    });
		
	$(wrapper).on('click', '.remove_both', function(e){
		var id =$(this).attr('id');
		//alert(id);
		e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
		$("#"+id).remove();
		//$("#rem1").remove();
        x--; //Decrement field counter
    });	
	
	 
  }); 
	 

function delEmail(id) {
Swal({
  title: 'Are you sure?',
  text: 'You will not be able to recover this selected email!',
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, keep it'
}).then((result) => {
  if (result.value) {

    Swal(
      'Deleted!',
      'Your Selected Email has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>superadmin/contactEmails/Contactemails/delEmail/'+id,
        success: function(data) {
            
			window.location = "<?php echo base_url() ?>contact-emails"
            console.log(data);   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected Page is safe :)',
      'success',
      
    )
  }
})

}	 
	 
</script>          