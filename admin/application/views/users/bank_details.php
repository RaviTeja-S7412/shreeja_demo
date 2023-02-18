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
                                    <li class="breadcrumb-item active" aria-current="page">User Bank Details</li>
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
                                                <th>Time</th>
                                                <th>Customer Name</th>
                                                <th>Mobile number</th>
                                                <th>A/c holder name</th>
                                                <th>Account number</th>
                                                <th>IFSC code</th>
                                                <th>Bank name</th>
                                                <th>Brach</th>
                                                <th>Bank city</th>
                                                <th>A/c holder mobile number</th>
                                                <th>Email id</th>
                                                <th>Bank Passbook</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $i = 0;
                                           foreach ($users as $u) {
											   
                                            
                                           ?> 

                                            <tr>
                                                <td style="padding: 0.5rem;"><?php echo ++$i ?></td>
                                                <td style="padding: 0.5rem;"><?php echo date("d-m-Y",strtotime($u->bank_details_updated_date)); ?></td>
                                                <td style="padding: 0.5rem;"><?php echo date("H:i:s",strtotime($u->bank_details_updated_date)); ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->user_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->user_mobile ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->account_holder_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->account_number ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->ifsc_code ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->account_bank_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->branch_name ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->bank_city ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->account_mobile_number ?></td>
                                                <td style="padding: 0.5rem;"><?php echo $u->user_email ?></td>
                                                <td style="padding: 0.5rem;"><a href="javascript:void(0)" class="getPassbook btn btn-primary btn-sm" img="<?php echo base_url().$u->bank_passbook ?>">View</a></td>
                                                <td style="padding: 0.5rem;">
                                                	<a href="javascrip:void(0)" uid="<? echo $u->userid ?>" account_holder_name="<? echo $u->account_holder_name ?>" account_number="<? echo $u->account_number ?>" ifsc_code="<? echo $u->ifsc_code ?>" account_bank_name="<? echo $u->account_bank_name ?>" branch_name="<? echo $u->branch_name ?>" bank_city="<? echo $u->bank_city ?>" account_mobile_number="<? echo $u->account_mobile_number ?>" class="btn btn-info btn-xs btn-rounded getOid"><i class="fa fa-edit"></i></a>
												</td>
                                                
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

           <div id="passbook" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header" style="display: block">
				  	<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Bank Passbook</h4>
				  </div>
				  <div class="modal-body">
	
				  	<div id="pimage"></div>

				  </div>
				</div>

			  </div>
			</div>   

           <div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header" style="display: block">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Update Bank Details</h4>
					<div class="merror"></div>
				  </div>
				  <div class="modal-body">

					<div class="danger"></div>
					<form method="post" id="fileinfo" enctype="multipart/form-data">

						<div class="form-group">
							<label>Account Holder Name</label>
							<input type="text" name="account_holder_name" class="form-control account_holder_name" placeholder="Account Holder Name" required>

						</div>
						<div class="form-group">
							<label>Account Number</label>
							<input type="text" name="account_number" class="form-control account_number" placeholder="Account Number" required>

						</div>
						<div class="form-group">
							<label>IFSC Code</label>
							<input type="text" name="ifsc_code" class="form-control ifsc_code" placeholder="IFSC Code">

						</div>
							
						<div class="form-group">
							<label>Bank Name</label>
							<input type="text" name="account_bank_name" class="form-control account_bank_name" placeholder="Bank Name" required>

						</div>
						<div class="form-group">
							<label>Branch Name</label>
							<input type="text" name="branch_name" class="form-control branch_name" placeholder="Branch Name">

						</div>
						<div class="form-group">
							<label>Bank City</label>
							<input type="text" name="bank_city" class="form-control bank_city" placeholder="Bank City" required>

						</div>
						<div class="form-group">
							<label>Mobile Number</label>
							<input type="number" maxlength="10" name="account_mobile_number" class="form-control account_mobile_number" placeholder="Mobile Number">

						</div>
						<div class="form-group">
							<label>Passbook</label>
							<input type="file" name="bank_passbook" class="form-control">

						</div>

						<div class="form-group">
						   <input type="hidden" name="uid" class="uid">           
						   <input type="hidden" name="ref" value="web">           
						   <button type="submit" class="btn btn-success submit" style="margin-top: 5px; width: 50%">Update</button>

						</div>
					</form>	

				  </div>
				</div>

			  </div>
			</div>   


            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<?php admin_footer(); ?>
<script type="text/javascript">
	
	$("#zero_config").on("click",".getPassbook",function(){

		var image = $(this).attr("img");
		$("#pimage").html('<img class="img-responsive" width="100%" src="'+image+'">');
		$("#passbook").modal("show");

	});	

	$("#zero_config").dataTable({
	  "dom": 'Bfrtip',
	  "buttons": [{
			  extend: 'excel'
		  }
	  ]
	});
	$("#zero_config").on("click",".getOid",function(){

		$("#myModal").modal("show");

		var uid = $(this).attr("uid");
		var account_holder_name = $(this).attr("account_holder_name");
		var account_number = $(this).attr("account_number");
		var ifsc_code = $(this).attr("ifsc_code");
		var account_bank_name = $(this).attr("account_bank_name");
		var branch_name = $(this).attr("branch_name");
		var bank_city = $(this).attr("bank_city");
		var account_mobile_number = $(this).attr("account_mobile_number");

		$(".uid").val(uid);
		$(".account_holder_name").val(account_holder_name);
		$(".account_number").val(account_number);
		$(".ifsc_code").val(ifsc_code);
		$(".account_bank_name").val(account_bank_name);
		$(".branch_name").val(branch_name);
		$(".bank_city").val(bank_city);
		$(".account_mobile_number").val(account_mobile_number);

	});	
	
	$("#fileinfo").on("submit",function(e){
		e.preventDefault();
		var form_data = new FormData($("#fileinfo")[0]);
		$.ajax({
			type : "POST",
			url : "<?php echo base_url("shreeja_api/updateAccountdetails") ?>",
			data: form_data,
		    cache: false,
		    contentType: false,
		    enctype: 'multipart/form-data',
		    processData: false,
		    dataType:"json",
			beforeSend : function(){			
//				$('.mloader').show();
//				$("#iSubmit").hide();
			},
			success : function(data){
//				$(".merror").slideUp();	
				if(data.status){
					$(".merror").html('<div class="alert alert-success">'+data.data+'</div>');
					
					Swal(
					  'Success',
					  data.data,
					  'success'
					);
					setTimeout(function(){location.reload()},3000);
					
				}else{
					Swal(
					  'Error',
					  data.data,
					  'error'
					);
					$(".merror").html('<div class="alert alert-danger">'+data.data+'</div>');
				}
				console.log(data);

			},
			error : function(jq,txt,error){
				console.log(error);
				$(".merror").html('<div class="alert alert-danger">'+error+'</div>');
			}

		});

	});			

	
	
</script>

            <!-- End footer -->