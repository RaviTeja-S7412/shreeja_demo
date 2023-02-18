<?php admin_header(); ?>

<link href="<? echo base_url() ?>dist/css/lightgallery.css" rel="stylesheet">       
       
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
                                    <li class="breadcrumb-item active" aria-current="page">Deposit Orders</li>
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
                      
                      <div class="row">   
						  <div class="col-md-5">   
							<div class="form-group">
								<label>Select Start & End Date :</label>
								<div class="input-daterange input-group" id="date-range">
									<input type="text" class="form-control" name="startDate" id="sdate" placeholder="Start Date" autocomplete="off"  required>
									<div class="input-group-append">
										<span class="input-group-text bg-info b-0 text-white">TO</span>
									</div>
									<input type="text" class="form-control" name="endDate" id="edate" placeholder="End Date" autocomplete="off" required/>
								</div>
							</div>
						  </div>
						  
						  <div class="col-md-2">   
							<div class="form-group">
								<label>Select Shift :</label>
								
								<select class="form-control" name="shift" id="shift">
								    
								    <option value="">Select Shift</option>
								    <option value="morning">Morning</option>
								    <option value="evening">Evening</option>
								    
								</select>
								
							</div>	
						  </div>
						 
					      <div class="col-md-2">
					      	
					      	<button id="filter" type="button" class="btn btn-info waves-effect waves-light m-t-30">Submit</button>
					      	
					      </div> 
						      
					   </div>
                       
                        <div class="card" style="border: 0px">
                            <div class="card-body">
                                <div class="table-responsive zero_config">
                                    <table class="table product-overview table-striped" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
<!--
                                                <th>Customer Number</th>
                                                <th>Customer Name</th>
-->
                                                <th>Deposit Date</th>
                                                <th>Bank Name</th>
                                                <th>Transaction ID</th>
                                                <th>Transaction amount</th>
                                                <th>Image</th>
<!--                                                <th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
		   <?php 
		   $i = 0;
		   foreach ($orders as $u) { 

		   $products = json_decode($u->product_id);	    	

		      

		   ?> 

					<tr>
						<td style="padding: 0.5rem;"><?php echo ++$i ?></td>
						
						<td style="padding: 0.5rem;"><?php echo ($u->transaction_date != "") ? date("d.m.Y",strtotime($u->transaction_date)) : "" ?></td>
						<td style="padding: 0.5rem;"><?php echo $u->bank_name ?></td>
						<td style="padding: 0.5rem;"><?php echo $u->transaction_number ?></td>
						<td style="padding: 0.5rem;"><?php echo $u->amount ?></td>
						
						<?php $image = ($u->transaction_document != "") ? '<a target="_blank" href="'.base_url('agent-products/transactiondocuments/').$u->order_id.'" class="btn btn-info waves-effect waves-light">View</a>' : "";  ?>
						
						<td style="padding: 0.5rem;"><?php echo $image ?></td>
						
						
<!--
						<td style="padding: 0.5rem;" align="center">
							<a href="<?php echo base_url() ?>agent-products/updateOrder/<?php echo $u->order_id ?>" class="text-inverse p-r-10"><i class="fas fa-edit" style="color: black"></i></a>
							<a href="<?php echo base_url() ?>agent-products/delOrder/<?php echo $u->order_id ?>" class="text-inverse p-r-10" onClick="return confirm('Are you sure want to cancel this order')"><i class="fas fa-trash" style="color: black"></i></a>

						</td>
-->

						<!-- Modal -->
						<div id="myModal<? echo $i ?>" class="modal fade" role="dialog">
						  <div class="modal-dialog modal-lg">

							<!-- Modal content-->
							<div class="modal-content">
							  <div class="modal-header" style="display: block">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Transaction Documents</h4>
							  </div>
							  <div class="modal-body">
							  
							  	<ul id="" class="list-unstyled lightgallery row">
							  	
							  	<? $images = explode(",",$u->transaction_document); 
									   foreach($images as $img){	
									?>
									<li class="col-xs-6 col-sm-4 col-md-3 ihide" mid="myModal<? echo $i ?>" data-responsive="img/1-375.jpg 375, img/1-480.jpg 480, img/1.jpg 800" data-src="<? echo base_url().$img ?>" data-sub-html="">
										<a href="">
											<img class="img-responsive" src="<? echo base_url().$img ?>" width="100%">
										</a>
									</li>
								<? } ?>	
								  </ul>	
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>

						  </div>
						</div>	


					</tr>
			 <?php  

			   }
			 ?> 
                                           
                                        </tbody>
                                    </table>
                                </div>
                                
                                
                                
                                  <div class="table-responsive zero_config1" style="display: none">

										<table class="table product-overview table-striped" id="zero_config1">
											<thead>
												<tr>
													<th>S.No</th>
	<!--
													<th>Customer Number</th>
													<th>Customer Name</th>
	-->
													<th>Deposit Date</th>
													<th>Bank Name</th>
													<th>Transaction ID</th>
													<th>Transaction amount</th>
													<th>Image</th>
	<!--                                                <th>Action</th>-->
												</tr>
											</thead>

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

<script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
<script src="<? echo base_url() ?>dist/js/lightgallery-all.min.js"></script>
<script src="<? echo base_url() ?>dist/js/jquery.mousewheel.min.js"></script>

<script type="text/javascript">


$(document).on("click",".ihide",function(){
	
	var id  = $(this).attr("mid");
	$("#"+id).modal("hide");
	
})	
$("#zero_config").dataTable();

jQuery('#date-range').datepicker({
        toggleActive: true,
		minDate: 0,
		dateFormat: "dd-mm-yy",

 });
	
	$(document).ready(function(){
		
		var gallery = $('.lightgallery').lightGallery();
		
		$("#filter").click(function(){

			$(".zero_config").hide();
			$(".zero_config1").show();

			var sdate = $("#sdate").val();
			var edate = $("#edate").val();
			var shift = $("#shift").val();

			$(".lightgallery").data("lightGallery").destroy(true);
			 
			$('#zero_config1 tbody td tr .lightgallery1').lightGallery();


			var table = $('#zero_config1').dataTable({
				 "bProcessing": true,
				 "ajax": {
					"url": "<?php echo base_url("agent-products/filterdepositorders") ?>",
					"type": "POST",
					"data" : {sdate : sdate, edate : edate,shift:shift},
		//			"success" : function(data){
		//				
		//				console.log(data);
		//				
		//			},
		//			"error" : function(data){
		//				
		//				console.log(data);
		//				
		//			} 
				  },
				 "aoColumns": [
					   { mData: 'sno' } ,
					   { mData: 'transaction_date' } ,
					   { mData: 'bank_name' } ,
					   { mData: 'transaction_number' } ,
					   { mData: 'amount' },
					   { mData: 'image' }
					 ],
				  "aaSorting": [[ 0, "asc" ]],
				  "bLengthChange": true,
				  "pageLength":10,
				  "destroy" : 'true',
				  "dom": 'Bfrtip',
				  "buttons": [
					 'csv', 'excel', 'pdf'
				  ]	
			  });
			});
		});
	
</script>

            <!-- End footer -->