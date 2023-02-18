<?php admin_header(); ?>
<style>
	.number{
		font-size: 14px;
    	border-radius: 6px;
	}

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
                        <h4 class="page-title">
<!--
                          <a href="<?php echo base_url() ?>users/create-user">	
							<button class="btn btn-success waves-effect waves-light">Create User</button>
						  </a>	
-->
                        </h4>
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
                                    <li class="breadcrumb-item active" aria-current="page">Feddback</li>
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
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Mobile number</th>
                                                <th>City</th>
                                                <th>Quality Rating</th>
                                                <th>Service Rating</th>
                                                <th>Delivery Rating</th>
                                                <th>Suggestions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                           foreach ($users as $u) {
											   $udata = json_decode($u->user_data);
                                           ?> 

                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo date("d-M-Y",strtotime($u->cdate)) ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $udata->user_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $udata->user_mobile ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_locations",array("id"=>$udata->user_location,"deleted"=>0))->row()->location; ?></td>
                                                <td style="padding: 0.5rem;" align="center"><label class="badge badge-success number"><?php echo $u->quality_rating ?></label></td>
                                                <td style="padding: 0.5rem;" align="center"><label class="badge badge-success number"><?php echo $u->service_rating ?></label></td>
                                                <td style="padding: 0.5rem;" align="center"><label class="badge badge-success number"><?php echo $u->delivery_rating ?></label></td>
                                                <td style="padding: 0.5rem;"><?php echo nl2br($u->suggestions) ?></td>
                                                
                                            </tr>
                                     <?php  
                                    
                                       }
                                     ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
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





            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>
<script type="text/javascript">

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
      'Your Selected User has been deleted.',
      'success'
    )
    $.ajax({
        method: 'POST',
        data: {'id' : id },
        url: '<?php echo base_url() ?>users/deleteUser/'+id,
        success: function(data) {
            location.reload();   
        }
    });
 
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal(
      'Cancelled',
      'Your Selected User is safe :)',
      'error'
    )
  }
})
    }
	
	
	
$("input[type='checkbox']").bootstrapSwitch({size : 'mini'});

$('#zero_config').DataTable({
	
	  "dom": 'Bfrtip',
	  "buttons": [
		 
		  
		   {
			  extend: 'excel',
			  /*exportOptions: {
				columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13]
			  }*/
		  }
	  ]
	
});
	
    $('#zero_config').on('switchChange.bootstrapSwitch','input[name="switch"]', function (e, state) {
        
          var news_id = $(this).attr("news_id"); 
                    var status;
                  
                    if ($(this).is(":checked")){
                        status = 0;
                    }else{
                        status = 1;
                    }
                    $.ajax({
                        type:"POST",
                        url:"<?php echo base_url();?>users/userstatus",
                        data:{id:news_id,status:status},
                        success:function (data){
                            
                           // location.reload();
                          if(data==1){
                                Swal(
                                  'Success!',
                                  'User Successfully Enabled.',
                                  'success'
                                )
                            }else{
                                Swal(
                                  'Success!',
                                  'User Successfully Disabled.',
                                  'success'
                                )
                            }
                        }


                    });  
        });


	
	
	
</script>

            <!-- End footer -->