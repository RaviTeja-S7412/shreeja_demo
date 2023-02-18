<?php

admin_header(); ?>

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
                          <a href="<?php echo base_url('referals/createReferals') ?>">	
							<button class="btn btn-success waves-effect waves-light">Create Referals</button>
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
                                    <li class="breadcrumb-item active" aria-current="page">Referal List</li>
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
                                                <th>Referer Name</th>
                                                <th>Mobile Number</th>
                                                <th>Referer Name</th>
                                                <th>Referee Count</th>
                                                <th>Referer Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;

										   $users = $this->db->order_by("user_name","asc")->select("user_name,referral_id,userid,user_mobile")->get_where("shreeja_users",["steps_completed"=>4,"user_status"=>0])->result();
										   $agents = $this->db->order_by("name","asc")->select("id,name,role,referral_id,mobile_number")->get_where("fdm_va_auths",["status"=>"Active","deleted"=>0,"role !="=>1])->result();

                                           foreach ($users as $u) {  
                                             
                                           ?> 

                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->user_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->user_mobile ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->referral_id ?></td>
                                                <td style="padding: 0.5rem;" align="center"><label class="badge badge-primary" style="border-radius: 10px;font-size: 14px;"><?php echo $this->db->get_where("tbl_user_referrals",array("referrer_id"=>$u->userid))->num_rows(); ?></label></td>
                                                <td style="padding: 0.5rem;"><?php echo "Consumer" ?></td>
                                                <td style="padding: 0.5rem;">
                                                    <a href="<? echo base_url('referals/viewReferers/').$u->userid."/Customer" ?>" class="text-inverse p-r-10"><i class="fa fa-eye"></i></a>
                                                </td>

                                            </tr>
                                     <?php  
                                    
                                       }
										foreach ($agents as $au) {  
                                             
                                           ?> 

                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $au->name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $au->mobile_number ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $au->referral_id ?></td>
                                                <td style="padding: 0.5rem;"><label class="badge badge-primary" style="border-radius: 10px;font-size: 14px;"><?php echo $this->db->get_where("tbl_user_referrals",array("referrer_id"=>$au->id))->num_rows(); ?></label></td>
                                                <td style="padding: 0.5rem;"><?php echo $this->db->get_where("fdm_va_roles",["id"=>$au->role])->row()->role_name; ?></td>
                                                <td style="padding: 0.5rem;">
                                                    <a href="<? echo base_url('referals/viewReferers/').$au->id."/Agent" ?>" class="text-inverse p-r-10"><i class="fa fa-eye"></i></a>
                                                </td>

                                            </tr>
                                       <? } ?>     
                                           
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