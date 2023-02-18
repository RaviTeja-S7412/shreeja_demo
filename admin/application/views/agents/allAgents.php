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
                          <a href="<?php echo base_url() ?>agents/create-agent">	
							<button class="btn btn-success waves-effect waves-light">Create Agent</button>
						  </a>	
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
                                    <li class="breadcrumb-item active" aria-current="page">Agents</li>
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
                                                <th>Agent ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>City</th>
                                                <th>Area</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th>Referal ID</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                           foreach ($agents as $u) {  
                                            if($u->role==1){

                                            }else{
                                           ?> 

                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->agent_id ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->email ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->mobile_number ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_locations",array("id"=>$u->city,"deleted"=>0))->row()->location; ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("tbl_areas",array("id"=>$u->area,"deleted"=>0))->row()->area_name; ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->address ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("fdm_va_roles",array("id"=>$u->role))->row()->role_name; ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->referral_id ?></td>
                                                <td style="padding: 0.5rem;">
                                                    <?php switch($u->status){ 
                                                            case "Active":
                                                            echo '<label class="label label-success">Active</label>';
                                                            break;

                                                            case "Inactive":
                                                            echo '<label class="label label-danger">Inactive</label>';
                                                            break;

                                                            default:
                                                            echo '<label class="label label-success">Active</label>';
                                                            break;
                                                          }
                                                    ?>    
                                                        
                                                </td>

                                                <td style="padding: 0.5rem;">
                                                    <a href="<?php echo base_url() ?>agents/update-agent/<?php echo $u->id ?>" class="text-inverse p-r-10"><i class="ti-marker-alt"></i></a>
                                                    <a href="#" name="delete" value="<?php echo $u->id ?>" id="<?php echo $u->id ?>" class="text-inverse sa-params"  onclick="archiveFunction(this.id)"><i class="ti-trash"></i></a>
                                                   

                                                </td>

                                            </tr>
                                     <?php  
                                    
                                       }}
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
$("#zero_config").dataTable();

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
        url: '<?php echo base_url() ?>agents/deleteUser/'+id,
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
</script>

            <!-- End footer -->