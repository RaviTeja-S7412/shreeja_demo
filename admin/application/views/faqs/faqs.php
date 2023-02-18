<?php admin_header(); ?>
<style type="text/css">
<?php
  $faq_id = $this->uri->segment(3);
  
	
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
                        <h4 class="page-title">Faqs</h4>
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
                                    
                                    <li class="breadcrumb-item active" aria-current="page">Faqs</li>
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
                                   
                                    <li class="nav-item"> <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="true">FAQS</a> </li> 
                                   
                                </ul>
                                <div class="tab-content br-n pn">
                                 
            		  <div id="navpills-" class="tab-pane active">
					 		   <div class="row">
									 <div class="col-md-5">

                                            <?php 
						 					if($faq_id != ""){ 

                                              $smen = $this->db->get_where("tbl_faqs",array("id"=>$faq_id))->row();

                                            ?>
                                            <form method="post" action="<?php echo base_url() ?>faqs/updateQue" enctype="multipart/form-data">

                                                <label>Question:</label>
                                                <div class="input-group">
                                                    
                                                    <textarea class="form-control" name="question" rows="2" placeholder="Question"><?php echo $smen->question ?></textarea>
                                                    
                                                </div>

                                               
                                                
                                                
                                                 <div class="form-group has-danger">
                                                    <label class="control-label">Answer:</label>
 
                                                    <textarea class="form-control" name="answer" rows="4" placeholder="Answer"><?php echo $smen->answers ?></textarea>
                                                </div>
                                                 
                                                
                                                

                                  <input type="hidden" name="faq_id" value="<?php echo $smen->id ?>"> 

                                   <button type="submit" id="msubmit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 10px">Update</button>
                                              </form>


                                          <?php  }else{ ?> 
                                              <form method="post" action="<?php echo base_url() ?>faqs/insertQue" enctype="multipart/form-data">

                                              <label>Question:</label>
                                                <div class="input-group">
                                                    
                                                    <textarea class="form-control" name="question" rows="2" placeholder="Question"></textarea>
                                                    
                                                </div>

                                               
                                                
                                                
                                                 <div class="form-group has-danger">
                                                    <label class="control-label">Answer:</label>
 
                                                    <textarea class="form-control" name="answer" rows="4" placeholder="Answer"></textarea>
                                                </div>
                                                 
                                                  
                                
                                   <button type="submit" id="msubmit" class="btn waves-effect waves-light btn-rounded btn-primary pull-right" style="margin-top: 5px">Submit</button>
                                              </form>

                                            <?php } ?>
                                            </div>
                                              
                      <div class="col-md-7">
                                              
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Existing Faqs</h3>
                                <div class="table-responsive">
                                    <table class="table product-overview" id="zero_config1">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Question</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                      $nsm = $this->db->query("select * from tbl_faqs order by id desc")->result();
                                           if($nsm){
                                           foreach ($nsm as $ns) {  ?> 
                                           <?php if($ns->deleted==0){ ?>
                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $ns->question ?></td>
                                                <td style="padding: 0.5rem;">
            <a href="<?php echo base_url() ?>faqs/edit-faq/<?php echo ($ns->id) ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
           
             <a href="#" name="delete" value="<?php echo $ns->id ?>" id="<?php echo $ns->id ?>" class="text-inverse sa-params"  onclick="delQue(this.id)"><i class="ti-trash"></i></a>                                      

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

 </div>
                             
   </div>
  <br>
                                                                                           
                              
                         



            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
<?php admin_footer(); ?>

<script type="text/javascript">


$('#zero_config1').DataTable(); 

function delQue(id) {
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
      'Your Selected Question has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>faqs/delQue/'+id,
        success: function(data) {
            //location.reload();  
          window.location = "<?php echo base_url() ?>faqs"
 
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    
    Swal(
      'Cancelled',
      'Your Selected Question is safe :)',
      'error',
      
    )
  }
})
}	
	

	
	
</script>



            <!-- End footer -->